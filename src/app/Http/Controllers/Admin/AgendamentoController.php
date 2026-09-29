<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agendamento;
use App\Models\Cliente;
use App\Models\Idoso;
use App\Models\ServicoLogin;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AgendamentoController extends Controller
{
    public function agendamento()
    {
        $listaAgendamento = Agendamento::with(['AgendamentoCliente', 'idoso', 'servicoAgendamento'])
            ->orderByDesc('id_agendamento_cliente')
            ->get();
        $listaCliente = Cliente::orderBy('nome_cliente')->get();
        $listaIdoso = Idoso::orderBy('nome_idoso')->get();
        $listaServico = ServicoLogin::orderBy('servico_servico_login')->get();

        return view('admin.agendamento.index', compact('listaAgendamento', 'listaCliente', 'listaIdoso', 'listaServico'));
    }

    public function update(Request $request, ?int $id = null)
    {
        $idAgendamento = $id ?? $request->input('_agendamento_id');

        if (!$idAgendamento) {
            return back()->with('erro', 'Não foi possível identificar o agendamento para atualizar. Feche e abra novamente o formulário de edição.');
        }

        $agendamento = Agendamento::findOrFail($idAgendamento);

        $dados = $request->validate([
            '_agendamento_id' => $id === null
                ? 'required|integer|exists:tbl_agendamento_cliente,id_agendamento_cliente'
                : 'sometimes|nullable|integer|exists:tbl_agendamento_cliente,id_agendamento_cliente',
            'id_cliente' => 'sometimes|required|integer|exists:tbl_info_cliente,id_cliente',
            'id_idoso' => 'sometimes|required|integer|exists:tbl_info_idoso,id_idoso',
            'id_servico_login' => 'sometimes|required|integer|exists:tbl_servico_login,id_servico_login',
            'dia_agendamento_cliente' => 'sometimes|required|date_format:Y-m-d',
            'horario_agendamento_cliente' => 'sometimes|required|date_format:H:i',
            'status_agendamento_cliente' => 'sometimes|required|in:ATIVO,INATIVO',
        ]);

        unset($dados['_agendamento_id']);

        $dados = array_merge([
            'id_cliente' => $agendamento->id_cliente,
            'id_idoso' => $agendamento->id_idoso,
            'id_servico_login' => $agendamento->id_servico_login,
            'dia_agendamento_cliente' => $agendamento->dia_agendamento_cliente,
            'horario_agendamento_cliente' => $agendamento->horario_agendamento_cliente,
            'status_agendamento_cliente' => $agendamento->status_agendamento_cliente,
        ], $dados);



        return redirect()
            ->route('admin.agendamento.index')
            ->with('sucesso', 'Agendamento atualizado com sucesso!');
    }

    public function status(int $id)
    {
        $agendamento = Agendamento::findOrFail($id);

        if ($agendamento->status_agendamento_cliente === 'ATIVO') {
            $agendamento->status_agendamento_cliente = 'INATIVO';
            $mensagem = 'Agendamento desativado com sucesso';
        } else {
            $agendamento->status_agendamento_cliente = 'ATIVO';
            $mensagem = 'Agendamento ativado com sucesso';
        }

        $agendamento->save();

        return redirect()
            ->route('admin.agendamento.index')
            ->with('sucesso', $mensagem);
    }
}
