<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RelatorioVania;
use App\Models\Cliente;
use App\Models\Idoso;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RelatorioVaniaController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LISTAGEM DOS RELATÓRIOS
    |--------------------------------------------------------------------------
    |
    | Alteração da Gabriele - aqui mostramos os relatórios e tbm buscamos
    | os clientes e idosos pq o modal fica dentro da própria listagem.
    |
    */

    public function index()
    {
        // busca os relatórios do mais recente pro mais antigo
        $relatorios = RelatorioVania::with([
            'cliente',
            'idoso'
        ])
            ->orderByDesc('id_relatorio_vania')
            ->get();


        // busca os clientes pro select do modal
        $clientes = Cliente::orderBy('nome_cliente')
            ->get();


        // busca os idosos pro outro select do modal
        $idosos = Idoso::orderBy('nome_idoso')
            ->get();


        // manda tudo pra mesma tela
        return view('admin.relatorio.index', [
            'relatorios' => $relatorios,
            'clientes' => $clientes,
            'idosos' => $idosos,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | CADASTRAR NOVO RELATÓRIO
    |--------------------------------------------------------------------------
    |
    | Alteração da Gabriele - recebe os dados do modal e salva
    | um novo relatório no banco.
    |
    */

    public function store(Request $request)
    {
        /*
         * Alteração da Gabriele - valida os campos principais.
         *
         * Os campos maiores são nullable pq nem sempre a Vânia
         * vai precisar preencher todos eles.
         */
        $dados = $request->validate([

            // cliente e idoso
            'id_cliente' => 'required|integer|exists:tbl_info_cliente,id_cliente',
            'id_idoso' => 'required|integer|exists:tbl_info_idoso,id_idoso',

            // dados do atendimento
            'tipo_atendimento_relatorio_vania' => 'required|string|max:75',
            'data_relatorio_vania' => 'required|date',
            'horario_relatorio_vania' => 'required',
            'horario_fim_relatorio_vania' => 'nullable',

            // checklist
            'medicacao_relatorio_vania' => 'nullable|boolean',
            'alimentacao_relatorio_vania' => 'nullable|boolean',
            'hidratacao_relatorio_vania' => 'nullable|boolean',
            'higiene_relatorio_vania' => 'nullable|boolean',
            'sono_relatorio_vania' => 'nullable|boolean',
            'atividade_relatorio_vania' => 'nullable|boolean',
            'companhia_relatorio_vania' => 'nullable|boolean',
            'consulta_relatorio_vania' => 'nullable|boolean',

            // condição do idoso
            'humor_relatorio_vania' => 'nullable|string|max:30',
            'apetite_relatorio_vania' => 'nullable|string|max:30',
            'mobilidade_relatorio_vania' => 'nullable|string|max:30',
            'comunicacao_relatorio_vania' => 'nullable|string|max:30',
            'dor_relatorio_vania' => 'nullable|string|max:30',
            'sinais_relatorio_vania' => 'nullable|string',

            // resumo e observações
            'texto_relatorio_vania' => 'required|string',
            'observacoes_relatorio_vania' => 'nullable|string',
            'recomendacoes_relatorio_vania' => 'nullable|string',
            'intercorrencias_relatorio_vania' => 'nullable|string',
        ]);


        /*
         * Alteração da Gabriele - confere se o idoso escolhido
         * realmente pertence ao cliente escolhido.
         *
         * Fazemos isso pq os dois selects ainda aparecem separados.
         */
        $idoso = Idoso::where('id_idoso', $dados['id_idoso'])
            ->where('id_cliente', $dados['id_cliente'])
            ->first();


        // se não pertencer ao cliente, volta pro formulário
        if (!$idoso) {

            return redirect()
                ->route('admin.relatorio.index')
                ->withErrors([
                    'id_idoso' => 'O idoso selecionado não pertence a esse cliente.'
                ])
                ->withInput();
        }


        /*
         * Alteração da Gabriele - gera o nome sozinho
         * pra Vânia não ter que digitar mais um campo.
         *
         * Ex:
         * Relatório - Helena Maria - 24/09/2026
         */
        $nomeRelatorio = 'Relatório - '
            . $idoso->nome_idoso
            . ' - '
            . date('d/m/Y', strtotime($dados['data_relatorio_vania']));


        // limita em 75 pq esse é o tamanho da coluna no banco
        $nomeRelatorio = Str::limit(
            $nomeRelatorio,
            75,
            ''
        );


        /*
         * Alteração da Gabriele - cadastra o relatório.
         *
         * Os checkboxes usam has() pq quando não estão marcados
         * eles nem chegam no formulário.
         */
        RelatorioVania::create([

            // cliente e idoso
            'id_cliente' => $dados['id_cliente'],
            'id_idoso' => $dados['id_idoso'],

            // informações principais
            'nome_relatorio_vania' => $nomeRelatorio,
            'tipo_atendimento_relatorio_vania' => $dados['tipo_atendimento_relatorio_vania'],
            'texto_relatorio_vania' => $dados['texto_relatorio_vania'],
            'data_relatorio_vania' => $dados['data_relatorio_vania'],
            'horario_relatorio_vania' => $dados['horario_relatorio_vania'],
            'horario_fim_relatorio_vania' => $dados['horario_fim_relatorio_vania'] ?? null,

            // checklist
            'medicacao_relatorio_vania' => $request->has('medicacao_relatorio_vania'),
            'alimentacao_relatorio_vania' => $request->has('alimentacao_relatorio_vania'),
            'hidratacao_relatorio_vania' => $request->has('hidratacao_relatorio_vania'),
            'higiene_relatorio_vania' => $request->has('higiene_relatorio_vania'),
            'sono_relatorio_vania' => $request->has('sono_relatorio_vania'),
            'atividade_relatorio_vania' => $request->has('atividade_relatorio_vania'),
            'companhia_relatorio_vania' => $request->has('companhia_relatorio_vania'),
            'consulta_relatorio_vania' => $request->has('consulta_relatorio_vania'),

            // condição do idoso
            'humor_relatorio_vania' => $dados['humor_relatorio_vania'] ?? null,
            'apetite_relatorio_vania' => $dados['apetite_relatorio_vania'] ?? null,
            'mobilidade_relatorio_vania' => $dados['mobilidade_relatorio_vania'] ?? null,
            'comunicacao_relatorio_vania' => $dados['comunicacao_relatorio_vania'] ?? null,
            'dor_relatorio_vania' => $dados['dor_relatorio_vania'] ?? null,
            'sinais_relatorio_vania' => $dados['sinais_relatorio_vania'] ?? null,

            // observações
            'observacoes_relatorio_vania' => $dados['observacoes_relatorio_vania'] ?? null,
            'recomendacoes_relatorio_vania' => $dados['recomendacoes_relatorio_vania'] ?? null,
            'intercorrencias_relatorio_vania' => $dados['intercorrencias_relatorio_vania'] ?? null,

            /*
             * Todo relatório novo começa como rascunho.
             * Depois a Vânia pode finalizar.
             */
            'status_relatorio_vania' => 'RASCUNHO',

            /*
             * Como acabou de ser criado, o cliente ainda não viu.
             */
            'visu_relatorio' => 'NAO_VISTO',
        ]);


        // volta pra listagem depois de salvar
        return redirect()
            ->route('admin.relatorio.index')
            ->with('sucesso', 'Relatório cadastrado com sucesso!');
    }


    /*
    |--------------------------------------------------------------------------
    | ATUALIZAR RELATÓRIO
    |--------------------------------------------------------------------------
    |
    | Alteração da Gabriele - atualiza um relatório que já existe.

    |
    */

    public function update(Request $request, int $id)
    {
        // valida os campos recebidos
        $dados = $request->validate([

            // cliente e idoso
            'id_cliente' => 'required|integer|exists:tbl_info_cliente,id_cliente',
            'id_idoso' => 'required|integer|exists:tbl_info_idoso,id_idoso',

            // dados do atendimento
            'tipo_atendimento_relatorio_vania' => 'required|string|max:75',
            'data_relatorio_vania' => 'required|date',
            'horario_relatorio_vania' => 'required',
            'horario_fim_relatorio_vania' => 'nullable',

            // checklist
            'medicacao_relatorio_vania' => 'nullable|boolean',
            'alimentacao_relatorio_vania' => 'nullable|boolean',
            'hidratacao_relatorio_vania' => 'nullable|boolean',
            'higiene_relatorio_vania' => 'nullable|boolean',
            'sono_relatorio_vania' => 'nullable|boolean',
            'atividade_relatorio_vania' => 'nullable|boolean',
            'companhia_relatorio_vania' => 'nullable|boolean',
            'consulta_relatorio_vania' => 'nullable|boolean',

            // condição do idoso
            'humor_relatorio_vania' => 'nullable|string|max:30',
            'apetite_relatorio_vania' => 'nullable|string|max:30',
            'mobilidade_relatorio_vania' => 'nullable|string|max:30',
            'comunicacao_relatorio_vania' => 'nullable|string|max:30',
            'dor_relatorio_vania' => 'nullable|string|max:30',
            'sinais_relatorio_vania' => 'nullable|string',

            // resumo e observações
            'texto_relatorio_vania' => 'required|string',
            'observacoes_relatorio_vania' => 'nullable|string',
            'recomendacoes_relatorio_vania' => 'nullable|string',
            'intercorrencias_relatorio_vania' => 'nullable|string',
        ]);


        // busca o relatório que vamos editar
        $relatorio = RelatorioVania::findOrFail($id);


        // confere novamente se o idoso pertence ao cliente
        $idoso = Idoso::where('id_idoso', $dados['id_idoso'])
            ->where('id_cliente', $dados['id_cliente'])
            ->first();


        // se não pertencer, não deixa atualizar
        if (!$idoso) {

            return redirect()
                ->route('admin.relatorio.index')
                ->withErrors([
                    'id_idoso' => 'O idoso selecionado não pertence a esse cliente.'
                ])
                ->withInput();
        }


        // atualiza o nome automático caso data ou idoso tenham mudado
        $nomeRelatorio = 'Relatório - '
            . $idoso->nome_idoso
            . ' - '
            . date('d/m/Y', strtotime($dados['data_relatorio_vania']));


        // garante que o nome não passe do limite do banco
        $nomeRelatorio = Str::limit(
            $nomeRelatorio,
            75,
            ''
        );


        // atualiza os dados do relatório
        $relatorio->update([

            // cliente e idoso
            'id_cliente' => $dados['id_cliente'],
            'id_idoso' => $dados['id_idoso'],

            // informações principais
            'nome_relatorio_vania' => $nomeRelatorio,
            'tipo_atendimento_relatorio_vania' => $dados['tipo_atendimento_relatorio_vania'],
            'texto_relatorio_vania' => $dados['texto_relatorio_vania'],
            'data_relatorio_vania' => $dados['data_relatorio_vania'],
            'horario_relatorio_vania' => $dados['horario_relatorio_vania'],
            'horario_fim_relatorio_vania' => $dados['horario_fim_relatorio_vania'] ?? null,

            // checklist
            'medicacao_relatorio_vania' => $request->has('medicacao_relatorio_vania'),
            'alimentacao_relatorio_vania' => $request->has('alimentacao_relatorio_vania'),
            'hidratacao_relatorio_vania' => $request->has('hidratacao_relatorio_vania'),
            'higiene_relatorio_vania' => $request->has('higiene_relatorio_vania'),
            'sono_relatorio_vania' => $request->has('sono_relatorio_vania'),
            'atividade_relatorio_vania' => $request->has('atividade_relatorio_vania'),
            'companhia_relatorio_vania' => $request->has('companhia_relatorio_vania'),
            'consulta_relatorio_vania' => $request->has('consulta_relatorio_vania'),

            // condição do idoso
            'humor_relatorio_vania' => $dados['humor_relatorio_vania'] ?? null,
            'apetite_relatorio_vania' => $dados['apetite_relatorio_vania'] ?? null,
            'mobilidade_relatorio_vania' => $dados['mobilidade_relatorio_vania'] ?? null,
            'comunicacao_relatorio_vania' => $dados['comunicacao_relatorio_vania'] ?? null,
            'dor_relatorio_vania' => $dados['dor_relatorio_vania'] ?? null,
            'sinais_relatorio_vania' => $dados['sinais_relatorio_vania'] ?? null,

            // observações finais
            'observacoes_relatorio_vania' => $dados['observacoes_relatorio_vania'] ?? null,
            'recomendacoes_relatorio_vania' => $dados['recomendacoes_relatorio_vania'] ?? null,
            'intercorrencias_relatorio_vania' => $dados['intercorrencias_relatorio_vania'] ?? null,
        ]);


        // volta pra listagem
        return redirect()
            ->route('admin.relatorio.index')
            ->with('sucesso', 'Relatório atualizado com sucesso!');
    }


    /*
    |--------------------------------------------------------------------------
    | MUDAR STATUS
    |--------------------------------------------------------------------------
    |
    | Alteração da Gabriele - por enquanto faz só:
    |
    | RASCUNHO <-> SALVO
    |
    | O ENVIADO vai ser usado mais pra frente quando fizermos
    | a parte do cliente.
    |
    */

    public function status(int $id)
    {
        // busca o relatório
        $relatorio = RelatorioVania::findOrFail($id);


        /*
         * Se está como rascunho, finaliza.
         * Se está finalizado, volta pra rascunho.
         */
        if ($relatorio->status_relatorio_vania === 'RASCUNHO') {

            $relatorio->status_relatorio_vania = 'SALVO';

            $mensagem = 'Relatório finalizado com sucesso!';

        } else {

            $relatorio->status_relatorio_vania = 'RASCUNHO';

            $mensagem = 'Relatório voltou para rascunho!';
        }


        // salva a mudança
        $relatorio->save();


        // volta pra listagem
        return redirect()
            ->route('admin.relatorio.index')
            ->with('sucesso', $mensagem);
    }
}