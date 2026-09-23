<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Servico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ServicoController extends Controller
{
    /**
     * Exibe os serviços cadastrados.
     */
    public function index()
    {
        return view('admin.servico.index', [
            'servico' => Servico::orderByDesc('id_servico_ancora')->get()
        ]);
    }


    // Alteração da Gabriele - cadastrar novo serviço
    public function store(Request $request)
    {
        // Alteração da Gabriele - valida os campos do formulário
        $dados = $request->validate([
            'titulo_servico_ancora' => 'required|string|max:35',
            'subtitulo_servico_ancora' => 'nullable|string|max:80',
            'texto_servico_ancora' => 'nullable|string',
            'img_servico_ancora' => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
            'status_servico_ancora' => 'required|in:ATIVO,INATIVO',
        ]);


        // Alteração da Gabriele - cadastra primeiro para gerar o ID
        $servico = Servico::create([
            'titulo_servico_ancora' => $dados['titulo_servico_ancora'],
            'subtitulo_servico_ancora' => $dados['subtitulo_servico_ancora'] ?? null,
            'texto_servico_ancora' => $dados['texto_servico_ancora'] ?? null,
            'img_servico_ancora' => 'servico/sem-imagem.jpg',
            'status_servico_ancora' => $dados['status_servico_ancora'],
        ]);


        // Alteração da Gabriele - recebe a imagem enviada
        $imagem = $request->file('img_servico_ancora');


        // Alteração da Gabriele - cria nome da imagem usando título + ID
        $nomeImagem = Str::slug($dados['titulo_servico_ancora'], '_')
            . '_'
            . $servico->id_servico_ancora
            . '.'
            . $imagem->extension();


        // Alteração da Gabriele - pasta das imagens de serviços
        $pastaServico = public_path('vs-cuidadora/assets/servico');


        // Alteração da Gabriele - garante que a pasta exista
        File::ensureDirectoryExists($pastaServico);


        // Alteração da Gabriele - salva a imagem
        $imagem->move($pastaServico, $nomeImagem);


        // Alteração da Gabriele - atualiza caminho da imagem no banco
        $servico->img_servico_ancora = 'servico/' . $nomeImagem;
        $servico->save();


        return redirect()
            ->route('admin.servico.index')
            ->with('sucesso', 'Serviço cadastrado com sucesso!');
    }


    // Alteração da Gabriele - atualizar serviço
    public function update(Request $request, int $id)
    {
        // Alteração da Gabriele - valida os campos
        $dados = $request->validate([
            'titulo_servico_ancora' => 'required|string|max:35',
            'subtitulo_servico_ancora' => 'nullable|string|max:80',
            'texto_servico_ancora' => 'nullable|string',
            'img_servico_ancora' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'status_servico_ancora' => 'required|in:ATIVO,INATIVO',
        ]);


        // Alteração da Gabriele - busca o serviço pelo ID
        $servico = Servico::findOrFail($id);


        // Alteração da Gabriele - mantém a imagem atual por padrão
        $caminhoImagem = $servico->img_servico_ancora;


        // Alteração da Gabriele - verifica se uma nova imagem foi enviada
        if ($request->hasFile('img_servico_ancora')) {

            $imagem = $request->file('img_servico_ancora');


            // Alteração da Gabriele - nome da nova imagem
            $nomeImagem = Str::slug($dados['titulo_servico_ancora'], '_')
                . '_'
                . $servico->id_servico_ancora
                . '.'
                . $imagem->extension();


            $pastaServico = public_path('vs-cuidadora/assets/servico');

            File::ensureDirectoryExists($pastaServico);


            // Alteração da Gabriele - caminho físico da imagem antiga
            $imagemAntiga = public_path(
                'vs-cuidadora/assets/' . $servico->img_servico_ancora
            );


            // Alteração da Gabriele - remove a imagem antiga
            if (File::exists($imagemAntiga)) {
                File::delete($imagemAntiga);
            }


            // Alteração da Gabriele - salva a nova imagem
            $imagem->move($pastaServico, $nomeImagem);


            $caminhoImagem = 'servico/' . $nomeImagem;
        }


        // Alteração da Gabriele - atualiza o registro
        $servico->update([
            'titulo_servico_ancora' => $dados['titulo_servico_ancora'],
            'subtitulo_servico_ancora' => $dados['subtitulo_servico_ancora'] ?? null,
            'texto_servico_ancora' => $dados['texto_servico_ancora'] ?? null,
            'img_servico_ancora' => $caminhoImagem,
            'status_servico_ancora' => $dados['status_servico_ancora'],
        ]);


        return redirect()
            ->route('admin.servico.index')
            ->with('sucesso', 'Serviço atualizado com sucesso!');
    }


    // Alteração da Gabriele - ativar ou desativar serviço
    public function status(int $id)
    {
        // Alteração da Gabriele - busca o serviço
        $servico = Servico::findOrFail($id);


        // Alteração da Gabriele - alterna o status
        if ($servico->status_servico_ancora === 'ATIVO') {

            $servico->status_servico_ancora = 'INATIVO';

            $mensagem = 'Serviço desativado com sucesso!';

        } else {

            $servico->status_servico_ancora = 'ATIVO';

            $mensagem = 'Serviço ativado com sucesso!';
        }


        $servico->save();


        return redirect()
            ->route('admin.servico.index')
            ->with('sucesso', $mensagem);
    }
}