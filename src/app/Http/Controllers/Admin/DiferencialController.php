<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; 
use App\Models\Diferencial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class DiferencialController extends Controller { 

    public function index() { 

        return view('admin.diferencial.index', ['diferenciais' => Diferencial::orderByDesc('id_diferencial')->get()]); 

    } 

    // CRUD DIFERENCIAL: C
    public function store(Request $request) {

        $dados = $request->validate([
            'titulo_diferencial' => 'required|max:35',
            'texto_diferencial' => 'required',
            'icone_diferencial' => 'required|image|mimes:jpg,png,webp,jpeg|max:4096',
            'status_diferencial' => 'required|in:ATIVO,INATIVO'
        ]);

        $caminhoArquivo = null;

        try{

            DB::beginTransaction();

            $icone = $request->file('icone_diferencial');
            $tituloImg = Str::slug($dados['titulo_diferencial']);
            $extensao = strtolower($icone->getClientOriginalExtension());
            $nomeImg = $tituloImg . '.' . $extensao;
            
            $pasta = public_path('vs-cuidadora/assets');

            if(!is_dir($pasta)){
                mkdir($pasta, 0775, true);
            }

            $icone->move($pasta, $nomeImg);

            $caminhoArquivo = $pasta . DIRECTORY_SEPARATOR . $nomeImg;


            //cadastrar no banco
            $diferencial = Diferencial::create([
                'titulo_diferencial' => $dados['titulo_diferencial'],
                'texto_diferencial' => $dados['texto_diferencial'],
                'icone_diferencial' => 'assets/' . $nomeImg,
                'status_diferencial' => $dados['status_diferencial']
            ]);

            DB::commit();

            return redirect()
                ->route('admin.diferencial.index')
                ->with('sucesso', 'DIFERENCIAL cadastrado com sucesso!');

        }catch(\Throwable $erro){

            DB::rollBack();

            if($caminhoArquivo && file_exists($caminhoArquivo)){
                unlink($caminhoArquivo);
            }

            report($erro);

            return redirect()
                ->back()
                ->withInput()
                ->with('erro', 'Não foi possível cadastrar o diferencial. Tente novamente mais tarde!');

        }

    }

    // CRUD DIFERENCIAL: U
    public function update(Request $request, int $id) {

        $dados = $request->validate([
            'titulo_diferencial' => 'required|max:35',
            'texto_diferencial' => 'required',
            'icone_diferencial' => 'nullable|image|mimes:jpg,png,webp,jpeg|max:4096',
            'status_diferencial' => 'required|in:ATIVO,INATIVO'
        ]);

        $diferencial = Diferencial::findOrFail($id);

        try{
            $tituloSlug = Str::slug($dados['titulo_diferencial']);
            $pasta = public_path('vs-cuidadora/assets');
            $caminhoArquivo = $diferencial->icone_diferencial;
            $imgAntiga = public_path('vs-cuidadora/' . $diferencial->icone_diferencial);

            // NOVO ICONE
            if($request->hasFile('icone_diferencial')){
                
                $icone = $request->file('icone_diferencial');
                $extensao = strtolower($icone->getClientOriginalExtension());
                $nomeImg = $tituloSlug . '.' . $extensao;

                if(file_exists($imgAntiga)) {
                    unlink($imgAntiga);
                }

                $icone->move($pasta, $nomeImg);

                $caminhoArquivo = 'assets/' . $nomeImg;

            }elseif($diferencial->titulo_diferencial !== $request->titulo_diferencial){
                
                $extensao = pathinfo($diferencial->icone_diferencial, PATHINFO_EXTENSION);
                $nomeImg = $tituloSlug . '.' . $extensao;

                $novoIcone = public_path('vs-cuidadora/assets/' . $nomeImg);

                if(file_exists($imgAntiga)){

                    rename($imgAntiga, $novoIcone);

                    $caminhoArquivo = 'assets/' . $nomeImg;

                }

            }

            //atualizar no banco
            $diferencial->update([
                'titulo_diferencial' => $dados['titulo_diferencial'],
                'texto_diferencial' => $dados['texto_diferencial'],
                'icone_diferencial' => $caminhoArquivo,
                'status_diferencial' => $dados['status_diferencial']
            ]);

            return redirect()
                ->route('admin.diferencial.index')
                ->with('sucesso', 'DIFERENCIAL foi atualizado com sucesso!');

        }catch(\Throwable $erro){

            report($erro);

            return redirect()
                ->back()
                ->with('erro', ' Não foi possível atualizar o diferencial. MENSAGEM DE ERRO: ' . $erro->getMessage());

        }

    }

    //CRUD DIFERENCIAL: D (U)
    public function status(Request $request, int $id) {

        try{
        
            $diferencial = Diferencial::findOrFail($id);

            $novoStatus = $diferencial->status_diferencial === 'ATIVO' ? 'INATIVO' : 'ATIVO';

            $diferencial->update([
                'status_diferencial' => $novoStatus
            ]);

            $mensagem = $novoStatus === 'ATIVO' ? 'Diferencial ATIVADO com sucesso!' : 'Diferencial DESATIVADO com sucesso!';

            return redirect()
                ->route('admin.diferencial.index')
                ->with('sucesso', $mensagem);

        }catch(\Throwable $erro){

            report($erro);

            return redirect()
                ->back()
                ->with('erro', 'Não foi possível alterar o status do card diferencial. Tente novamente mais tarde!');

        }
    }
}
