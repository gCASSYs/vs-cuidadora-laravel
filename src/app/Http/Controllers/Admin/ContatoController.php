<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContatoController extends Controller
{
    /**
     * Lista os contatos com os dados legíveis do horário relacionado.
     */
    public function index()
    {
        // Alteração da Gabriele - busca os contatos com os dados do horário relacionado
        $contatos = DB::table('tbl_contato')
            ->leftJoin(
                'tbl_horarios',
                'tbl_horarios.id_horarios',
                '=',
                'tbl_contato.id_horarios'
            )
            ->select([
                'tbl_contato.*',
                'tbl_horarios.horario_horarios',
                'tbl_horarios.formato_horarios',
                'tbl_horarios.regiao_horarios',
            ])
            ->orderByDesc('tbl_contato.id_contato')
            ->get();


        // Alteração da Gabriele - horários disponíveis para os modais
        $horarios = DB::table('tbl_horarios')
            ->orderByDesc('id_horarios')
            ->get();


        return view(
            'admin.contato.index',
            compact('contatos', 'horarios')
        );
    }


    // Alteração da Gabriele - cadastrar contato
    public function store(Request $request)
    {
        // Alteração da Gabriele - valida os campos
        $dados = $request->validate([
            'redes_sociais_contato' => 'required|string',
            'icones_redes_sociais_contato' => 'required|string|max:65',
            'endereco_contato' => 'required|string',
            'id_horarios' => 'required|integer|exists:tbl_horarios,id_horarios',
            'status_contato' => 'required|in:ATIVO,INATIVO',
        ]);


        // Alteração da Gabriele - cadastra o contato
        DB::table('tbl_contato')->insert([
            'redes_sociais_contato' => $dados['redes_sociais_contato'],
            'icones_redes_sociais_contato' => $dados['icones_redes_sociais_contato'],
            'endereco_contato' => $dados['endereco_contato'],
            'id_horarios' => $dados['id_horarios'],
            'status_contato' => $dados['status_contato'],
        ]);


        return redirect()
            ->route('admin.contato.index')
            ->with('sucesso', 'Contato cadastrado com sucesso!');
    }


    // Alteração da Gabriele - atualizar contato
    public function update(Request $request, int $id)
    {
        // Alteração da Gabriele - valida os campos
        $dados = $request->validate([
            'redes_sociais_contato' => 'required|string',
            'icones_redes_sociais_contato' => 'required|string|max:65',
            'endereco_contato' => 'required|string',
            'id_horarios' => 'required|integer|exists:tbl_horarios,id_horarios',
            'status_contato' => 'required|in:ATIVO,INATIVO',
        ]);


        // Alteração da Gabriele - verifica se o contato existe
        $contato = DB::table('tbl_contato')
            ->where('id_contato', $id)
            ->first();


        abort_if(!$contato, 404);


        // Alteração da Gabriele - atualiza o contato
        DB::table('tbl_contato')
            ->where('id_contato', $id)
            ->update([
                'redes_sociais_contato' => $dados['redes_sociais_contato'],
                'icones_redes_sociais_contato' => $dados['icones_redes_sociais_contato'],
                'endereco_contato' => $dados['endereco_contato'],
                'id_horarios' => $dados['id_horarios'],
                'status_contato' => $dados['status_contato'],
            ]);


        return redirect()
            ->route('admin.contato.index')
            ->with('sucesso', 'Contato atualizado com sucesso!');
    }


    // Alteração da Gabriele - ativar ou desativar contato
    public function status(int $id)
    {
        // Alteração da Gabriele - busca o contato
        $contato = DB::table('tbl_contato')
            ->where('id_contato', $id)
            ->first();


        abort_if(!$contato, 404);


        // Alteração da Gabriele - troca o status
        if ($contato->status_contato === 'ATIVO') {

            $novoStatus = 'INATIVO';

            $mensagem = 'Contato desativado com sucesso!';

        } else {

            $novoStatus = 'ATIVO';

            $mensagem = 'Contato ativado com sucesso!';
        }


        // Alteração da Gabriele - salva o novo status
        DB::table('tbl_contato')
            ->where('id_contato', $id)
            ->update([
                'status_contato' => $novoStatus,
            ]);


        return redirect()
            ->route('admin.contato.index')
            ->with('sucesso', $mensagem);
    }
}