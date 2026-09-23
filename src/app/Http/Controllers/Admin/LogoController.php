<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Logo; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogoController extends Controller { 

    public function index() { 

        return view('admin.logo.index', ['logos' => Logo::orderByDesc('id_logo')->get()]); 

    }

    //Alteração de André: CRUD LOGO: C
    public function store(Request $request) {

        $dados = $request->validate([
            'img_logo' => 'required|image|mimes:jpg,png,webp,jpeg|max:4096',
            'status_logo' => 'required|in:ATIVO,INATIVO'
        ]);

        $caminhoArquivo = null;

        try{

            DB::beginTransaction();

            // A nova logo é criada inativa primeiro. Caso ela tenha sido
            // selecionada como ativa, as demais são desativadas na mesma transação.
            $logo = Logo::create([
                'img_logo' => 'logo/sem-foto.png',
                'status_logo' => 'INATIVO'
            ]);

            $imgLogo = $request->file('img_logo');
            $tituloLogo = 'logo_vania';
            $extensao = strtolower($imgLogo->getClientOriginalExtension());
            $nomeLogo = $tituloLogo . '_' . $logo->id_logo .  '.' . $extensao;
            
            $pasta = public_path('vs-cuidadora/assets/logo');

            if(!is_dir($pasta)){
                mkdir($pasta, 0775, true);
            }

            $imgLogo->move($pasta, $nomeLogo);

            $caminhoArquivo = $pasta . DIRECTORY_SEPARATOR . $nomeLogo;


            //atualizar img no banco
            $logo->img_logo = 'logo/' . $nomeLogo;
            $logo->save();

            if ($dados['status_logo'] === 'ATIVO') {
                $this->ativarLogo($logo);
            }

            DB::commit();

            return redirect()
                ->route('admin.logo.index')
                ->with('sucesso', 'LOGO cadastrada com sucesso!');

        }catch(\Throwable $erro){

            DB::rollBack();

            if($caminhoArquivo && file_exists($caminhoArquivo)){
                unlink($caminhoArquivo);
            }

            report($erro);

            return redirect()
                ->back()
                ->withInput()
                ->with('erro', 'Não foi possível cadastrar a logo. Tente novamente mais tarde!');

        }

    }

    //Alteração de André: CRUD LOGO: U
    public function update(Request $request, int $id) {

        $dados = $request->validate([
            'img_logo' => 'nullable|image|mimes:jpg,png,webp,jpeg|max:4096',
            'status_logo' => 'required|in:ATIVO,INATIVO'
        ]);

        try{
            // Faz todo o processo dentro do DB transaction por segurança
            DB::transaction(function () use ($request, $dados, $id) {
                $logo = Logo::lockForUpdate()->findOrFail($id);
                // lockForUpdate = Bloqueia que dois processos modifiquem o mesmo registro no banco
                $caminhoArquivo = $logo->img_logo;

                if ($request->hasFile('img_logo')) {
                    $imgLogo = $request->file('img_logo');
                    $extensao = strtolower($imgLogo->getClientOriginalExtension());
                    $nomeLogo = 'logo_vania_' . $logo->id_logo . '.' . $extensao;
                    $pasta = public_path('vs-cuidadora/assets/logo');

                    if (! is_dir($pasta)) {
                        mkdir($pasta, 0775, true);
                    }

                    $imgLogo->move($pasta, $nomeLogo);
                    $caminhoArquivo = 'logo/' . $nomeLogo;
                }

                $logo->update([
                    'img_logo' => $caminhoArquivo,
                    'status_logo' => $dados['status_logo'],
                ]);

                if ($dados['status_logo'] === 'ATIVO') {
                    $this->ativarLogo($logo);
                }
            });

            return redirect()
                ->route('admin.logo.index')
                ->with('sucesso', 'LOGO atualizada com sucesso!');

        }catch(\Throwable $erro){

            report($erro);

            return redirect()
                ->back()
                ->with('erro', ' Não foi possível atualizar a logo. Tente novamente mais tarde!');

        }

    }

    //Alteração de André: CRUD LOGO: D (U)
    public function status(Request $request, int $id) {

        try{
        
            // Faz todo o processo dentro do DB transaction por segurança
            $novoStatus = DB::transaction(function () use ($id) {
                // lockForUpdate = Bloqueia que dois processos modifiquem o mesmo registro no banco
                $logo = Logo::lockForUpdate()->findOrFail($id);
                $novoStatus = $logo->status_logo === 'ATIVO' ? 'INATIVO' : 'ATIVO';

                $logo->update(['status_logo' => $novoStatus]);

                if ($novoStatus === 'ATIVO') {
                    $this->ativarLogo($logo);
                }

                return $novoStatus;
            });

            $mensagem = $novoStatus === 'ATIVO' ? 'Logo ATIVADA com sucesso!' : 'Logo DESATIVADA com sucesso!';

            return redirect()
                ->route('admin.logo.index')
                ->with('sucesso', $mensagem);

        }catch(\Throwable $erro){

            report($erro);

            return redirect()
                ->back()
                ->with('erro', 'Não foi possível alterar o status da logo.Mensagem de erro: ' . $erro->getMessage());

        }
    }

    /* Alteração de André:: Mantém somente a logo informada como ativa */
    /* Void não devolve valor mas a função continua sendo executada */
    private function ativarLogo(Logo $logo): void
    {
        /* Atualiza para Inativo outras logos que estejam ativas se não forem a principal */
        Logo::where('id_logo', '!=', $logo->id_logo)
            ->where('status_logo', 'ATIVO')
            ->update(['status_logo' => 'INATIVO']);

        /* Se a logo principal não estiver ativa ? ative ela */
        if ($logo->status_logo !== 'ATIVO') {
            $logo->update(['status_logo' => 'ATIVO']);
        }
    }
}
