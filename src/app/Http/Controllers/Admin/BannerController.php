<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    public function index()
    {
        return view('admin.banner.index', ['banners' => Banner::orderByDesc('id_banner')->get()]);
    }

    public function create()
    {
        return view('admin.banner.form', ['banner' => new Banner()]);
    }

    public function store(Request $request)
    {
        $dados = $this->validar($request);
        $caminhoArquivo = null;

        try {
            DB::beginTransaction();
            $banner = Banner::create([
                'titulo_banner' => $dados['titulo_banner'],
                'img_banner' => 'banner/placeholder.png',
                'status_banner' => $dados['status_banner'],
            ]);

            $nomeImagem = $this->nomeImagem($dados['titulo_banner'], $banner->id_banner, $dados['img_banner']);
            $pasta = public_path('vs-cuidadora/assets/banner');
            File::ensureDirectoryExists($pasta);
            $dados['img_banner']->move($pasta, $nomeImagem);
            $caminhoArquivo = $pasta . DIRECTORY_SEPARATOR . $nomeImagem;

            $banner->update(['img_banner' => 'banner/' . $nomeImagem]);
            DB::commit();

            return redirect()->route('admin.banner.index')->with('sucesso', 'Banner cadastrado com sucesso.');
        } catch (\Throwable $erro) {
            if (DB::transactionLevel() > 0) {
                DB::rollBack();
            }
            if ($caminhoArquivo && File::exists($caminhoArquivo)) {
                File::delete($caminhoArquivo);
            }
            report($erro);
            return back()->withInput()->with('erro', 'Não foi possível cadastrar o banner.');
        }
    }

    public function edit(Banner $banner)
    {
        return view('admin.banner.form', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $dados = $this->validar($request, false);
        $imagemAnterior = $banner->img_banner;
        $caminhoNovo = null;

        try {
            DB::beginTransaction();
            $banner->fill([
                'titulo_banner' => $dados['titulo_banner'],
                'status_banner' => $dados['status_banner'],
            ]);

            if ($request->hasFile('img_banner')) {
                $nomeImagem = $this->nomeImagem($dados['titulo_banner'], $banner->id_banner, $dados['img_banner']);
                $pasta = public_path('vs-cuidadora/assets/banner');
                File::ensureDirectoryExists($pasta);
                $dados['img_banner']->move($pasta, $nomeImagem);
                $caminhoNovo = $pasta . DIRECTORY_SEPARATOR . $nomeImagem;
                $banner->img_banner = 'banner/' . $nomeImagem;
            }

            $banner->save();
            DB::commit();

            if ($caminhoNovo && $imagemAnterior !== $banner->img_banner) {
                File::delete(public_path('vs-cuidadora/assets/' . $imagemAnterior));
            }

            return redirect()->route('admin.banner.index')->with('sucesso', 'Banner atualizado com sucesso.');
        } catch (\Throwable $erro) {
            if (DB::transactionLevel() > 0) {
                DB::rollBack();
            }
            if ($caminhoNovo && File::exists($caminhoNovo)) {
                File::delete($caminhoNovo);
            }
            report($erro);
            return back()->withInput()->with('erro', 'Não foi possível atualizar o banner.');
        }
    }

    public function status(Banner $banner)
    {
        $banner->update(['status_banner' => $banner->status_banner === 'ATIVO' ? 'INATIVO' : 'ATIVO']);
        return back()->with('sucesso', 'Status do banner atualizado.');
    }

    private function validar(Request $request, bool $imagemObrigatoria = true): array
    {
        $imagem = $imagemObrigatoria ? 'required|' : 'nullable|';
        return $request->validate([
            'titulo_banner' => 'required|string|max:35|unique:tbl_banner,titulo_banner' . ($request->route('banner') ? ',' . $request->route('banner')->id_banner . ',id_banner' : ''),
            'img_banner' => $imagem . 'image|mimes:jpg,jpeg,png,webp|max:4096',
            'status_banner' => 'required|in:ATIVO,INATIVO',
        ]);
    }

    private function nomeImagem(string $titulo, int $id, $imagem): string
    {
        return Str::limit(Str::slug($titulo, '_'), 42, '') . '_' . $id . '.' . $imagem->extension();
    }
}
