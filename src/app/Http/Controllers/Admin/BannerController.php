<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    /**
     * Exibe os banners em modo somente leitura.
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
            'status_banner' => 'required',
        ]);

        // Recebe a imagem enviada
        $imagem = $request->file('img_banner');

        // Cria um nome seguro para a imagem
        $nomeImagem = Str::slug($dados['titulo_banner'], '_')
            . '_'
            . time()
            . '.'
            . $imagem->extension();

        // Pasta onde a imagem será salva
        $pastaBanner = public_path('vs-cuidadora/assets/banner');

        // Garante que a pasta exista
        File::ensureDirectoryExists($pastaBanner);

        // Salva a imagem
        $imagem->move($pastaBanner, $nomeImagem);

        // Cadastra o banner no banco
        Banner::create([
            'titulo_banner' => $dados['titulo_banner'],
            'img_banner' => 'banner/' . $nomeImagem,
            'status_banner' => $dados['status_banner'],
        ]);

        // Retorna para a listagem
        return redirect()
            ->route('admin.banner.index')
            ->with('sucesso', 'Banner cadastrado com sucesso!');
    }
}