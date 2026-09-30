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

    public function avaliacao()
    {
        $listaAvaliacao = Avaliacao::orderByDesc('id_avaliacao')
            ->get();
        return view('admin.avaliacao.index', compact('listaAvaliacao'));
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
