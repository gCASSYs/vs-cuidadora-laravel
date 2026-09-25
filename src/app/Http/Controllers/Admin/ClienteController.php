<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; 
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

Class ClienteController extends Controller {

    public function index() {

        $clientes = Cliente::with('ClienteLogin')
                      ->orderByDesc('id_cliente')
                                          ->get();

        //dd($listaClientes);

        return view('admin.cliente.index', compact('clientes'));

    }

    //Alteração de André: CRUD CLIENTE: EDITAR
    public function update(Request $request, int $id){

        // tratando cpf
        $cpf = preg_replace('/\D/', '', $request->cpf_cliente);

        // tratando telefone
        $telefone = preg_replace('/\D/', '', $request->telefone_cliente);

        $request->merge([
            'cpf_cliente' => $cpf,
            'telefone_cliente' => $telefone
        ]);

        // Validação dos dados
        $dados = $request->validate([
            'nome_cliente' => 'required|string|max:75',
            'telefone_cliente' => 'required|digits:11',
            'cpf_cliente' => 'required|digits:11',
            'endereco_cliente' => 'required|string|',
            'idade_cliente' => 'required|integer|min:18|max:99',
            'status_cliente' => 'required|in:ATIVO,INATIVO',
        ]);

        // Formatando CPF
        $dados['cpf_cliente'] = preg_replace(
            '/(\d{3})(\d{3})(\d{3})(\d{2})/',
            '$1.$2.$3-$4',
            $dados['cpf_cliente']
        );

        // Formatando Telefone
        $dados['telefone_cliente'] = preg_replace(
            '/(\d{2})(\d{5})(\d{4})/',
            '($1)$2-$3',
            $dados['telefone_cliente']
        );

        // Busca o banner
        $cliente = Cliente::findOrFail($id);


        try{
            
            // Atualiza o registro
            $cliente->update([
                'nome_cliente'     => $dados['nome_cliente'],
                'telefone_cliente' => $dados['telefone_cliente'],
                'cpf_cliente'      => $dados['cpf_cliente'],
                'endereco_cliente' => $dados['endereco_cliente'],
                'idade_cliente'    => $dados['idade_cliente'],
                'status_cliente'   => $dados['status_cliente']
            ]);

            return redirect()
            ->route('admin.cliente.index')
            ->with('sucesso', 'Cliente atualizado com sucesso!');

        }catch(\Throwable $erro){

            report($erro);

            return redirect()
                ->back()
                ->withInput()
                ->with('erro', 'Não foi possível atualizar este registro. Tente novamente mais tarde!');

        }
    }

    //Alteração de André: CRUD CLIENTE: D (U)
    public function status(Request $request, int $id) {

        try{
        
            // Faz todo o processo dentro do DB transaction por segurança
            $novoStatus = DB::transaction(function () use ($id) {
                // lockForUpdate = Bloqueia que dois processos modifiquem o mesmo registro no banco
                $cliente = Cliente::lockForUpdate()->findOrFail($id);
                $novoStatus = $cliente->status_cliente === 'ATIVO' ? 'INATIVO' : 'ATIVO';

                $cliente->update(['status_cliente' => $novoStatus]);

                return $novoStatus;
            });

            $mensagem = $novoStatus === 'ATIVO' ? 'Cliente ATIVADO com sucesso!' : 'Cliente DESATIVADO com sucesso!';

            return redirect()
                ->route('admin.cliente.index')
                ->with('sucesso', $mensagem);

        }catch(\Throwable $erro){

            report($erro);

            return redirect()
                ->back()
                ->with('erro', 'Não foi possível alterar o status do cliente. Tente novamente mais tarde!');

        }
    }

}