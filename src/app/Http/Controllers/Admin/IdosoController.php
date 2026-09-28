<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Idoso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IdosoController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | LISTAGEM DOS IDOSOS
    |--------------------------------------------------------------------------
    |
    | Alteração da Gabriele - mostra os idosos cadastrados
    | junto com o cliente responsável por cada um.
    |
    */

    public function index()
    {
        $idosos = Idoso::with('cliente')
            ->orderByDesc('id_idoso')
            ->get();


        return view(
            'admin.idoso.index',
            compact('idosos')
        );
    }



    /*
    |--------------------------------------------------------------------------
    | EDITAR IDOSO
    |--------------------------------------------------------------------------
    |
    | Alteração da Gabriele - a Vânia pode atualizar os dados
    | do idoso, mas não pode trocar o cliente responsável
    | nem alterar o status por esse formulário.
    |
    | O status possui uma ação separada na listagem.
    |
    */

    public function update(Request $request, int $id)
    {

        /*
         * Alteração da Gabriele - remove pontuação do CPF
         * antes da validação.
         */
        $cpf = preg_replace(
            '/\D/',
            '',
            $request->cpf_idoso
        );


        /*
         * Alteração da Gabriele - remove pontuação
         * do telefone antes da validação.
         */
        $telefone = preg_replace(
            '/\D/',
            '',
            $request->telefone_idoso
        );


        // coloca os valores limpos de volta na requisição
        $request->merge([
            'cpf_idoso' => $cpf,
            'telefone_idoso' => $telefone,
        ]);



        /*
         * Alteração da Gabriele - valida somente os campos
         * que a Vânia realmente pode editar.
         */
        $dados = $request->validate([

            'nome_idoso' => [
                'required',
                'string',
                'max:75',
            ],

            'sexo_idoso' => [
                'required',
                'string',
                'max:15',
            ],

            'telefone_idoso' => [
                'required',
                'digits_between:10,11',
            ],

            'cpf_idoso' => [
                'required',
                'digits:11',
            ],

            'endereco_idoso' => [
                'required',
                'string',
            ],

            'idade_idoso' => [
                'required',
                'integer',
                'min:0',
                'max:120',
            ],

            'situacao_idoso' => [
                'required',
                'string',
            ],

            'ponto_principal_idoso' => [
                'required',
                'string',
            ],

        ]);



        /*
         * Alteração da Gabriele - formata novamente o CPF
         * antes de salvar.
         *
         * 12345678900
         * vira:
         * 123.456.789-00
         */
        $dados['cpf_idoso'] = preg_replace(
            '/(\d{3})(\d{3})(\d{3})(\d{2})/',
            '$1.$2.$3-$4',
            $dados['cpf_idoso']
        );



        /*
         * Alteração da Gabriele - formata o telefone.
         *
         * Se tiver 11 números, considera celular.
         * Se tiver 10, considera telefone fixo.
         */
        if (strlen($dados['telefone_idoso']) === 11) {

            $dados['telefone_idoso'] = preg_replace(
                '/(\d{2})(\d{5})(\d{4})/',
                '($1)$2-$3',
                $dados['telefone_idoso']
            );

        } else {

            $dados['telefone_idoso'] = preg_replace(
                '/(\d{2})(\d{4})(\d{4})/',
                '($1)$2-$3',
                $dados['telefone_idoso']
            );

        }



        // procura o idoso que será atualizado
        $idoso = Idoso::findOrFail($id);


        try {

            /*
             * Alteração da Gabriele - atualiza somente
             * as informações permitidas.
             *
             * NÃO altera:
             * id_cliente
             * id_login_vania
             * status_idoso
             */
            $idoso->update([

                'nome_idoso' =>
                    $dados['nome_idoso'],

                'sexo_idoso' =>
                    $dados['sexo_idoso'],

                'telefone_idoso' =>
                    $dados['telefone_idoso'],

                'cpf_idoso' =>
                    $dados['cpf_idoso'],

                'endereco_idoso' =>
                    $dados['endereco_idoso'],

                'idade_idoso' =>
                    $dados['idade_idoso'],

                'situacao_idoso' =>
                    $dados['situacao_idoso'],

                'ponto_principal_idoso' =>
                    $dados['ponto_principal_idoso'],

            ]);


            return redirect()
                ->route('admin.idoso.index')
                ->with(
                    'sucesso',
                    'Idoso atualizado com sucesso!'
                );


        } catch (\Throwable $erro) {

            report($erro);


            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'erro',
                    'Não foi possível atualizar o idoso. Tente novamente mais tarde!'
                );

        }

    }



    /*
    |--------------------------------------------------------------------------
    | ATIVAR / DESATIVAR
    |--------------------------------------------------------------------------
    |
    | Alteração da Gabriele - o status possui uma ação
    | própria para não misturar status com edição de dados.
    |
    */

    public function status(int $id)
    {

        try {

            /*
             * Alteração da Gabriele - trava o registro
             * enquanto o status está sendo alterado.
             */
            $novoStatus = DB::transaction(
                function () use ($id) {

                    $idoso = Idoso::lockForUpdate()
                        ->findOrFail($id);


                    /*
                     * Se estiver ATIVO, fica INATIVO.
                     *
                     * Qualquer registro antigo que ainda esteja
                     * como "0" também passará para ATIVO
                     * quando essa ação for utilizada.
                     */
                    $novoStatus =
                        $idoso->status_idoso === 'ATIVO'
                            ? 'INATIVO'
                            : 'ATIVO';


                    $idoso->update([
                        'status_idoso' => $novoStatus,
                    ]);


                    return $novoStatus;
                }
            );



            if ($novoStatus === 'ATIVO') {

                $mensagem =
                    'Idoso ativado com sucesso!';

            } else {

                $mensagem =
                    'Idoso desativado com sucesso!';

            }



            return redirect()
                ->route('admin.idoso.index')
                ->with(
                    'sucesso',
                    $mensagem
                );


        } catch (\Throwable $erro) {

            report($erro);


            return redirect()
                ->back()
                ->with(
                    'erro',
                    'Não foi possível alterar o status do idoso. Tente novamente mais tarde!'
                );

        }

    }

}