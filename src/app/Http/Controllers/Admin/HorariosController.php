<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Horario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class HorariosController extends Controller
{
    public function index()
    {
        $listaHorario = Horario::orderByDesc('id_horarios')
            ->get();

        return view('admin.horarios.index', compact('listaHorario'));
    }

    public function store(Request $request){

        $dados =$request->validate([
           'telefone_horarios' => 'required|string|max:15',                                
            'formato_horarios' => 'required|string|max:50',                
            'regiao_horarios' => 'required|string|max:50',                                
            'horario_horarios' => 'required|string|max:50',                                
            'status_horarios' => 'required|in:ATIVO,INATIVO',                                
        ]);

        $horario = Horario::create([
           'telefone_horarios' => $dados['telefone_horarios'],                                
            'formato_horarios' => $dados['formato_horarios'],                
            'regiao_horarios' =>  $dados['regiao_horarios'],                                
            'horario_horarios' => $dados['horario_horarios'],                                
            'status_horarios' =>  $dados['status_horarios'], 
        ]);

          return redirect()
            ->route('admin.horarios.index')
            ->with('sucesso', 'Horário cadastrado com sucesso!');
    }

  public function update(Request $request, int $id)
    {
        // Validação dos dados
        $dados = $request->validate([
            'telefone_horarios' => 'required|string|max:15',                                
            'formato_horarios' => 'required|string|max:50',                
            'regiao_horarios' => 'required|string|max:50',                                
            'horario_horarios' => 'required|string|max:50',                                
            'status_horarios' => 'required|in:ATIVO,INATIVO',  
        ]);


        
        $horario = Horario::findOrFail($id);


       
        // Atualiza o registro
        $horario->update([
      'telefone_horarios' => $dados['telefone_horarios'],                                
            'formato_horarios' => $dados['formato_horarios'],                
            'regiao_horarios' =>  $dados['regiao_horarios'],                                
            'horario_horarios' => $dados['horario_horarios'],                                
            'status_horarios' =>  $dados['status_horarios'], 
        ]);


        return redirect()
            ->route('admin.horarios.index')
            ->with('sucesso', 'Horário atualizado com sucesso!');
    }

    
    public function status(int $id){

        $horario = Horario::findOrFail($id);

        if($horario->status_horarios === 'ATIVO'){
            $horario->status_horarios = 'INATIVO';
            $mensagem = 'Horário desativado com sucesso';
        } else {
            $horario->status_horarios = 'ATIVO';
            $mensagem = 'Horário ativado com sucesso';
        } 

        $horario->save();

        return redirect()
        ->route('admin.horarios.index')
        ->with('sucesso', $mensagem);

    }
}
