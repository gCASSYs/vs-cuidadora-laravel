<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agendamento;

class AgendamentoController extends Controller
{
    public function agendamento()
    {
        $listaAgendamento = Agendamento::orderByDesc('id_agendamento_cliente')
            ->get();
        return view('admin.agendamento.index', compact('listaAgendamento'));
    }

    public function status(int $id)
    {
        $agendamento = Agendamento::findOrFail($id);
        $agendamento->status_agendamento_cliente =
            $agendamento->status_agendamento_cliente === 'ATIVO' ? 'INATIVO' : 'ATIVO';
        $agendamento->save();

        return redirect()
            ->route('admin.agendamento.index')
            ->with('sucesso', 'Status do agendamento atualizado com sucesso!');
    }

    public function update(\Illuminate\Http\Request $request, int $id)
    {
        $dados = $request->validate([
            'dia_agendamento_cliente' => 'required|date',
            'horario_agendamento_cliente' => 'required|string|max:50',
            'status_agendamento_cliente' => 'required|in:ATIVO,INATIVO',
        ]);

        Agendamento::findOrFail($id)->update($dados);

        return redirect()->route('admin.agendamento.index')
            ->with('sucesso', 'Agendamento atualizado com sucesso!');
    }
}
