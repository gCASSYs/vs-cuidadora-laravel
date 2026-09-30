<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Avaliacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class AvaliacaoController extends Controller
{

    public function index()
    {
        $listaAvaliacao = Avaliacao::orderByDesc('id_avaliacao')
            ->get();
        return view('admin.avaliacao.index', compact('listaAvaliacao'));
    }

    public function update(Request $request, int $id)
    {
        $dados = $request->validate([
            'titulo_avaliacao' => 'required|string|max:35',
            'mensagem_avaliacao' => 'required|string|max:255',
            'estrela_avaliacao' => 'required|string|max:35',
            'status_avaliacao' => 'required|in:ATIVO,INATIVO',
            'img_avaliacao' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $avaliacao = Avaliacao::findOrFail($id);
        $campos = collect($dados)->except('img_avaliacao')->all();

        if ($request->hasFile('img_avaliacao')) {
            $imagem = $request->file('img_avaliacao');
            $nome = Str::slug(pathinfo($imagem->getClientOriginalName(), PATHINFO_FILENAME))
                . '_' . $avaliacao->id_avaliacao . '.' . $imagem->extension();
            $pasta = public_path('vs-cuidadora/assets/avaliacao');
            File::ensureDirectoryExists($pasta);
            $imagem->move($pasta, $nome);
            $campos['img_avaliacao'] = 'avaliacao/' . $nome;
        }

        $avaliacao->update($campos);

        return Redirect()->route('admin.avaliacao.index')
            ->with('sucesso', 'Avaliação atualizada com sucesso!');
    }

   
  
    public function status(int $id){

        $avaliacao = Avaliacao::findOrFail($id);

        if($avaliacao->status_avaliacao === 'ATIVO'){
            $avaliacao->status_avaliacao = 'INATIVO';
            $mensagem = 'Avaliação desativada com sucesso!';
        } else {
            $avaliacao->status_avaliacao = 'ATIVO';
            $mensagem = 'Avaliação ativada com sucesso!';
        }

        $avaliacao->save();

        return Redirect()
        ->route('admin.avaliacao.index')
        ->with('sucesso', $mensagem);
    }
}
