{{-- Listagem administrativa dos clientes --}}
<section class="admin-list-page">

    <div class="app-content-header admin-page-header">

        <div class="container-fluid">

            <div class="row">

                <div class="col-sm-6">
                    <h1 class="mb-0 fs-3">Clientes</h1>
                </div>


                <div class="col-sm-6">

                    <nav aria-label="breadcrumb">

                        <ol class="breadcrumb float-sm-end">

                            <li class="breadcrumb-item">

                                <a href="{{ route('admin.dashboard') }}">
                                    Dashboard
                                </a>

                            </li>

                            <li class="breadcrumb-item active">
                                Clientes
                            </li>

                        </ol>

                    </nav>

                </div>

            </div>

        </div>

    </div>



    <div class="app-content">

        <div class="container-fluid">

            <div class="row">

                <div class="col-12">

                    <div class="card admin-data-card mb-4">


                        <div class="card-header">

                            <div class="row g-2 align-items-center">

                                <div class="col-12 col-md-4">

                                    <h3 class="card-title">
                                        Clientes cadastrados
                                    </h3>

                                </div>


                                <div class="col-12 col-md-8">

                                    <div class="d-flex flex-wrap justify-content-md-end gap-2">


                                        {{-- Alteração da André - pesquisa --}}
                                        <div class="input-group input-group-sm w-auto">

                                            <span class="input-group-text">
                                                <i class="bi bi-search"></i>
                                            </span>

                                            <input
                                                type="search"
                                                id="cliente-search"
                                                class="form-control admin-search-input"
                                                placeholder="Pesquisar clientes"
                                            >

                                        </div>


                                        {{-- Alteração da André - filtro por status --}}
                                        <select
                                            id="cliente-status-filter"
                                            class="form-select form-select-sm w-auto"
                                        >

                                            <option value="all">
                                                Todos
                                            </option>

                                            <option value="ATIVO">
                                                Ativos
                                            </option>

                                            <option value="INATIVO">
                                                Inativos
                                            </option>

                                        </select>

                                    </div>

                                </div>

                            </div>

                        </div>



                        <div class="card-body p-0">

                            <div class="table-responsive">

                                <table class="table table-hover align-middle m-0">

                                    <thead>

                                        <tr>

                                            <th>Id</th>
                                            <th>Nome</th>
                                            <th>Telefone</th>
                                            <th>CPF</th>
                                            <th>Idade</th>
                                            <th>Endereço</th>
                                            <th>Login relacionado</th>
                                            <th>Status</th>
                                            <th class="text-end">Ações</th>

                                        </tr>

                                    </thead>


                                    <tbody>


                                        @forelse ($clientes as $cliente)

                                        @php

                                        $login = $cliente->clienteLogin

                                        @endphp

                                            {{-- Alteração da André - dados para pesquisa e filtro --}}
                                            <tr
                                                class="contato-row"
                                                data-pesquisa="{{ strtolower(
                                                    $cliente->nome_cliente . ' ' .
                                                    $cliente->telefone_cliente . ' ' .
                                                    $cliente->cpf_cliente . ' ' .
                                                    $cliente->idade_cliente . ' ' .
                                                    $cliente->endereco_cliente . ' ' .
                                                    $cliente->clienteLogin->email_login
                                                ) }}"
                                                data-status="{{ $cliente->status_cliente }}"
                                            >


                                                <td>
                                                    {{ $cliente->id_cliente }}
                                                </td>

                                                <td>
                                                    {{ $cliente->nome_cliente }}
                                                </td>

                                                <td>
                                                    {{ Str::limit($cliente->telefone_cliente, 70) }}
                                                </td>

                                                <td>
                                                    {{ Str::limit($cliente->cpf_cliente, 70) }}
                                                </td>

                                                <td>
                                                    {{ $cliente->idade_cliente }}
                                                </td>

                                                <td>
                                                    {{ Str::limit($cliente->endereco_cliente, 70) }}
                                                </td>

                                                <td>
                                                    {{ Str::limit($login->email_login, 70) }}
                                                </td>

                                                <td>

                                                    @if ($cliente->status_cliente === 'ATIVO')

                                                        <span class="badge text-bg-success">
                                                            Ativo
                                                        </span>

                                                    @else

                                                        <span class="badge text-bg-warning">
                                                            Inativo
                                                        </span>

                                                    @endif

                                                </td>


                                                <td class="text-end">

                                                    <div class="btn-group btn-group-sm">


                                                        {{-- Alteração da André - editar --}}
                                                        <button
                                                            type="button"
                                                            class="btn btn-outline-secondary btn-editar-contato"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalEditarCliente"
                                                            data-id="{{$cliente->id_cliente}}"
                                                            data-nome="{{$cliente->nome_cliente}}"
                                                            data-tel="{{$cliente->telefone_cliente}}"
                                                            data-cpf="{{$cliente->cpf_cliente}}"
                                                            data-endereco="{{$cliente->endereco_cliente}}"
                                                            data-idade="{{$cliente->idade_cliente}}"
                                                            data-email="{{$cliente->id_login}}"
                                                            data-status="{{$cliente->status_cliente}}"
                                                            data-url="{{ route('admin.cliente.update', $cliente->id_cliente) }}"
                                                            title="Editar"
                                                            aria-label="Editar"
                                                        >

                                                            <i class="bi bi-pencil"></i>

                                                        </button>



                                                        <form 
                                                            action="{{ route('admin.cliente.status', $cliente->id_cliente) }}" 
                                                            method="post" 
                                                            class="d-inline"
                                                        >
                                                        @csrf
                                                        @method('PATCH')
                                                    
                                                        {{-- Alteração da André - ativar ou desativar --}}
                                                        @if ($cliente->status_cliente === 'ATIVO')

                                                            <button
                                                                type="submit"
                                                                class="btn btn-outline-danger btn-status-contato"
                                                                title="Desativar cliente"
                                                                aria-label="Desativar"
                                                            >

                                                                <i class="bi bi-eye-fill"></i>

                                                            </button>

                                                        @else

                                                            <button
                                                                type="submit"
                                                                class="btn btn-outline-success btn-status-contato"
                                                                title="Ativar cliente"
                                                                aria-label="Ativar"
                                                            >

                                                                <i class="bi bi-eye-slash-fill"></i>

                                                            </button>

                                                        @endif
                                                        </form>
                                                    </div>

                                                </td>

                                            </tr>


                                        @empty

                                            <tr>

                                                <td
                                                    colspan="6"
                                                    class="text-center py-4 text-muted"
                                                >
                                                    Nenhum cliente encontrado.
                                                </td>

                                            </tr>

                                        @endforelse


                                        {{-- Alteração da André - nenhum resultado --}}
                                        <tr
                                            id="cliente-sem-resultado"
                                            class="d-none"
                                        >

                                            <td
                                                colspan="6"
                                                class="text-center py-4 text-muted"
                                            >
                                                Nenhum cliente encontrado.
                                            </td>

                                        </tr>


                                    </tbody>

                                </table>

                            </div>

                        </div>



                        <div class="card-footer clearfix">

                            <div class="float-start pt-1 fs-7 text-body-secondary">

                                Total de clientes:

                                <strong>
                                    {{ $clientes->count() }}
                                </strong>

                            </div>


                            <ul class="pagination pagination-sm m-0 float-end">

                                <li class="page-item disabled">
                                    <span class="page-link">&laquo;</span>
                                </li>

                                <li class="page-item active">
                                    <span class="page-link">1</span>
                                </li>

                                <li class="page-item disabled">
                                    <span class="page-link">&raquo;</span>
                                </li>

                            </ul>

                        </div>


                    </div>

                </div>

            </div>

        </div>

    </div>

</section>
{{-- FIM DA LISTAGEM --}}

{{-- Alteração de André - edição de CLIENTE --}}
<div 
    class="modal fade" 
    id="modalEditarCliente" 
    tabindex="-1" 
    aria-labelledby="modalEditarClienteLabel" 
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarClienteLabel">
                    Editar CLIENTE
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Fechar">
                </button>
            </div>

            <form
                id="formEditarCliente"
                method="POST">

                @csrf
                @method('PUT')

                <div class="modal-body">

                    <div class="mb-3">
                        <label for="editarClienteNome" class="form-label">
                            Nome do cliente
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="editarClienteNome"
                            name="nome_cliente"
                            maxlength="35"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="editarClienteTel" class="form-label">
                            Telefone
                        </label>

                        <input
                            type="tel"
                            class="form-control"
                            id="editarClienteTel"
                            name="telefone_cliente"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="editarClienteCPF" class="form-label">
                            CPF
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="editarClienteCPF"
                            name="cpf_cliente"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="editarClienteEndereco" class="form-label">
                            Endereço
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="editarClienteEndereco"
                            name="endereco_cliente"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="editarClienteIdade" class="form-label">
                            Idade
                        </label>

                        <input
                            type="number"
                            class="form-control"
                            id="editarClienteIdade"
                            name="idade_cliente"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="editarClienteLogin" class="form-label">
                            Email - Não recomendado alterar
                        </label>

                        <select
                            class="form-select"
                            id="editarClienteLogin"
                            name="id_login"
                            disabled
                            required>


                            @forelse($clientes as $cliente)
                            <option value="{{ $cliente->clienteLogin->id_login_usuario }}">
                                {{  $cliente->clienteLogin->id_login_usuario }} - {{ $cliente->clienteLogin->email_login }}
                            </option>
                            @empty
                            <span>Nenhum e-mail encontrado.</span>
                            @endforelse

                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="editarClienteStatus" class="form-label">
                            Status
                        </label>

                        <select
                            class="form-select"
                            id="editarClienteStatus"
                            name="status_cliente"
                            required>

                            <option value="ATIVO">
                                Ativo
                            </option>

                            <option value="INATIVO">
                                Inativo
                            </option>

                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                        Cancelar
                    </button>

                    <button
                        type="submit"
                        class="btn btn-primary">
                        Salvar
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

{{-- Alteração de André - Script para o EDITAR CLIENTE --}}  
<script>
        // document = seleciona dentro de todo o site
        // getElementBy ID = seleciona um ID específico dentro do site
        const modalEditarCliente   = document.getElementById('modalEditarCliente');
        const formEditarCliente    = document.getElementById('formEditarCliente');
        const editNome             = document.getElementById('editarClienteNome');
        const editTel              = document.getElementById('editarClienteTel');
        const editCPF              = document.getElementById('editarClienteCPF');
        const editEndereco         = document.getElementById('editarClienteEndereco');
        const editIdade            = document.getElementById('editarClienteIdade');
        const editLogin            = document.getElementById('editarClienteLogin');
        const editStatus           = document.getElementById('editarClienteStatus');

        // Carregar as informações no modal
        modalEditarCliente.addEventListener('show.bs.modal', function(event){

          const botao  = event.relatedTarget;

          const nome     = botao.getAttribute('data-nome');
          const tel      = botao.getAttribute('data-tel');
          const cpf      = botao.getAttribute('data-cpf');
          const endereco = botao.getAttribute('data-endereco');
          const idade    = botao.getAttribute('data-idade');
          const email    = botao.getAttribute('data-email');
          const status   = botao.getAttribute('data-status');
          const url      = botao.getAttribute('data-url');

          // Form Action
          formEditarCliente.action = url;

          // Preencher
          editNome.value     = nome;
          editTel.value      = tel;
          editCPF.value      = cpf;
          editEndereco.value = endereco;
          editIdade.value    = idade;
          editLogin.value    = email;
          editStatus.value   = status;

        })

</script>

{{-- Alteração de André - Timer para a mensagem de alerta --}}    
<script>

    setTimeout(() => {
            
        const alertas = document.querySelectorAll('.alert');

        alertas.forEach(function(alerta){
            
            const instancia = bootstrap.Alert.getOrCreateInstance(alerta);

            instancia.close();

        })

    }, 5000);

</script>

{{-- Pesquisa e filtro --}}
<script>

    const pesquisaCliente =
        document.getElementById('cliente-search');


    const filtroCliente =
        document.getElementById('cliente-status-filter');


    function filtrarClientes() {

        const pesquisa =
            pesquisaCliente.value
                .toLowerCase()
                .trim();


        const statusSelecionado =
            filtroCliente.value;


        const linhas =
            document.querySelectorAll('.contato-row');


        let quantidadeVisivel = 0;


        linhas.forEach(function(linha) {

            const encontrouPesquisa =
                linha.dataset.pesquisa.includes(pesquisa);


            const encontrouStatus =
                statusSelecionado === 'all'
                || linha.dataset.status === statusSelecionado;


            if (encontrouPesquisa && encontrouStatus) {

                linha.classList.remove('d-none');

                quantidadeVisivel++;

            } else {

                linha.classList.add('d-none');

            }

        });


        const semResultado =
            document.getElementById('contato-sem-resultado');


        if (quantidadeVisivel === 0) {

            semResultado.classList.remove('d-none');

        } else {

            semResultado.classList.add('d-none');

        }

    }


    pesquisaCliente.addEventListener(
        'input',
        filtrarClientes
    );


    filtroCliente.addEventListener(
        'change',
        filtrarClientes
    );

</script>