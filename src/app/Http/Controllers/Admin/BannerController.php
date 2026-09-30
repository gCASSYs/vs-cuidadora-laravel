<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class BannerController extends Controller
{
    /**
     * Exibe os banners cadastrados.
     */
    public function index()
    {
        return view('admin.banner.index', [
            'banners' => Banner::orderByDesc('id_banner')->get(),
        ]);
    }


    // Alteração da Gabriele - cadastrar novo banner
    public function store(Request $request)
    {
        // Validação dos dados recebidos pelo formulário
        $dados = $request->validate([
            'titulo_banner' => 'required|string|max:35',
            'img_banner' => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
            'status_banner' => 'required|in:ATIVO,INATIVO',
        ]);


        // Alteração da Gabriele - cadastra primeiro para gerar o ID
        $banner = Banner::create([
            'titulo_banner' => $dados['titulo_banner'],
            'img_banner' => 'banner/sem-imagem.jpg',
            'status_banner' => $dados['status_banner'],
        ]);


        // Alteração da Gabriele - recebe a imagem
        $imagem = $request->file('img_banner');


        // Alteração da Gabriele - nome da imagem com título + ID
        $nomeImagem = Str::slug($dados['titulo_banner'], '_')
            . '_'
            . $banner->id_banner
            . '.'
            . $imagem->extension();


        // Pasta das imagens
        $pastaBanner = public_path('vs-cuidadora/assets/banner');

        File::ensureDirectoryExists($pastaBanner);


        // Salva a imagem
        $imagem->move($pastaBanner, $nomeImagem);


        // Atualiza o caminho da imagem no banco
        $banner->img_banner = 'banner/' . $nomeImagem;
        $banner->save();


        return redirect()
            ->route('admin.banner.index')
            ->with('sucesso', 'Banner cadastrado com sucesso!');
    }


    // Alteração da Gabriele - atualizar banner
    public function update(Request $request, int $id)
    {
        // Validação dos dados
        $dados = $request->validate([
            'titulo_banner' => 'required|string|max:35',
            'img_banner' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'status_banner' => 'required|in:ATIVO,INATIVO',
        ]);


        // Busca o banner
        $banner = Banner::findOrFail($id);


        // Mantém a imagem atual por padrão
        $caminhoImagem = $banner->img_banner;


        // Alteração da Gabriele - verifica se uma nova imagem foi enviada
        if ($request->hasFile('img_banner')) {

            $imagem = $request->file('img_banner');


            // Nome da nova imagem com título + ID
            $nomeImagem = Str::slug($dados['titulo_banner'], '_')
                . '_'
                . $banner->id_banner
                . '.'
                . $imagem->extension();


            $pastaBanner = public_path('vs-cuidadora/assets/banner');

            File::ensureDirectoryExists($pastaBanner);


            // Caminho da imagem antiga
            $imagemAntiga = public_path(
                'vs-cuidadora/assets/' . $banner->img_banner
            );


            // Remove a imagem antiga
            if (File::exists($imagemAntiga)) {
                File::delete($imagemAntiga);
            }


            // Salva a nova imagem
            $imagem->move($pastaBanner, $nomeImagem);


            $caminhoImagem = 'banner/' . $nomeImagem;
        }


        // Atualiza o registro
        $banner->update([
            'titulo_banner' => $dados['titulo_banner'],
            'img_banner' => $caminhoImagem,
            'status_banner' => $dados['status_banner'],
        ]);


        return redirect()
            ->route('admin.banner.index')
            ->with('sucesso', 'Banner atualizado com sucesso!');
    }


    // Alteração da Gabriele - ativar ou desativar banner
    public function status(int $id)
    {
        // Busca o banner pelo ID
        $banner = Banner::findOrFail($id);

        // Faz todo o processo dentro do DB transaction por segurança
            $novoStatus = DB::transaction(function () use ($id) {
                // lockForUpdate = Bloqueia que dois processos modifiquem o mesmo registro no banco
                $banner = Banner::lockForUpdate()->findOrFail($id);
                $novoStatus = $banner->status_banner === 'ATIVO' ? 'INATIVO' : 'ATIVO';

                $banner->update(['status_banner' => $novoStatus]);

                if ($novoStatus === 'ATIVO') {
                    $this->ativarBanner($banner);
                }

                return $novoStatus;
            });

            $mensagem = $novoStatus === 'ATIVO' ? 'Logo ATIVADA com sucesso!' : 'Logo DESATIVADA com sucesso!';


        // Salva a alteração
        $banner->save();


        return redirect()
            ->route('admin.banner.index')
            ->with('sucesso', $mensagem);
    }

    private function ativarBanner(Banner $banner): void
    {

        Banner::where('id_banner', '!=', $banner->id_banner)
            ->where('status_banner', 'ATIVO')
            ->update(['status_banner' => 'INATIVO']);

        /* Se a logo principal não estiver ativa ? ative ela */
        if ($banner->status_banner !== 'ATIVO') {
            $banner->update(['status_banner' => 'ATIVO']);
        }
    }
}