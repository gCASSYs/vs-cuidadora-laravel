{{-- Alteração da Gabriele - listagem dos idosos cadastrados pelos clientes --}}
<section class="admin-list-page">

    <div class="app-content-header admin-page-header">

        <div class="container-fluid">

            <div class="row">

                <div class="col-sm-6">

                    <h1 class="mb-0 fs-3">
                        Idosos
                    </h1>

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
                                Idosos
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

                        {{-- Cabeçalho --}}
                        <div class="card-header">

                            <div class="row g-2 align-items-center">

                                <div class="col-12 col-md-4">

                                    <h3 class="card-title">
                                        Idosos cadastrados
                                    </h3>

                                </div>


                                <div class="col-12 col-md-8">

                                    <div class="d-flex flex-wrap justify-content-md-end gap-2">


                                        {{-- Alteração da Gabriele - pesquisa --}}
                                        <div class="input-group input-group-sm w-auto">

                                            <span class="input-group-text">

                                                <i class="bi bi-search"></i>

                                            </span>


                                            <input
                                                type="search"
                                                id="idoso-search"
                                                class="form-control admin-search-input"
                                                placeholder="Pesquisar idosos"
                                            >

                                        </div>



                                        {{-- Alteração da Gabriele - filtro por status --}}
                                        <select
                                            id="idoso-status-filter"
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



                        {{-- Tabela --}}
                        <div class="card-body p-0">

                            <div class="table-responsive">

                                <table class="table table-hover align-middle m-0">

                                    <thead>

                                        <tr>

                                            <th>
                                                ID
                                            </th>

                                            <th>
                                                Nome
                                            </th>

                                            <th>
                                                Responsável
                                            </th>

                                            <th>
                                                Sexo
                                            </th>

                                            <th>
                                                Idade
                                            </th>

                                            <th>
                                                Telefone
                                            </th>

                                            <th>
                                                Situação
                                            </th>

                                            <th>
                                                Status
                                            </th>

                                            <th class="text-end">
                                                Ações
                                            </th>

                                        </tr>

                                    </thead>


                                    <tbody>

                                        @forelse ($idosos as $idoso)

                                            @php

                                                /*
                                                 * Alteração da Gabriele - texto usado
                                                 * pela pesquisa da tabela.
                                                 */
                                                $textoPesquisa = strtolower(
                                                    $idoso->nome_idoso . ' ' .
                                                    ($idoso->cliente->nome_cliente ?? '') . ' ' .
                                                    $idoso->telefone_idoso . ' ' .
                                                    $idoso->cpf_idoso . ' ' .
                                                    $idoso->idade_idoso . ' ' .
                                                    $idoso->situacao_idoso
                                                );

                                            @endphp


                                            <tr
                                                class="idoso-row"
                                                data-pesquisa="{{ $textoPesquisa }}"
                                                data-status="{{ $idoso->status_idoso }}"
                                            >


                                                {{-- ID --}}
                                                <td>

                                                    {{ $idoso->id_idoso }}

                                                </td>



                                                {{-- Nome --}}
                                                <td>

                                                    <strong>
                                                        {{ $idoso->nome_idoso }}
                                                    </strong>

                                                </td>



                                                {{-- Responsável --}}
                                                <td>

                                                    @if ($idoso->cliente)

                                                        {{ $idoso->cliente->nome_cliente }}

                                                    @else

                                                        <span class="text-muted">
                                                            Não informado
                                                        </span>

                                                    @endif

                                                </td>



                                                {{-- Sexo --}}
                                                <td>

                                                    {{ $idoso->sexo_idoso }}

                                                </td>



                                                {{-- Idade --}}
                                                <td>

                                                    {{ $idoso->idade_idoso }} anos

                                                </td>



                                                {{-- Telefone --}}
                                                <td>

                                                    {{ $idoso->telefone_idoso }}

                                                </td>



                                                {{-- Situação --}}
                                                <td>

                                                    {{ \Illuminate\Support\Str::limit(
                                                        $idoso->situacao_idoso,
                                                        45
                                                    ) }}

                                                </td>



                                                {{-- Status --}}
                                                <td>

                                                    @if ($idoso->status_idoso === 'ATIVO')

                                                        <span class="badge text-bg-success">
                                                            Ativo
                                                        </span>

                                                    @else

                                                        <span class="badge text-bg-warning">
                                                            Inativo
                                                        </span>

                                                    @endif

                                                </td>



                                                {{-- Ações --}}
                                                <td class="text-end">

                                                    <div class="btn-group btn-group-sm">


                                                        {{-- Visualizar --}}
                                                        <button
                                                            type="button"
                                                            class="btn btn-outline-primary btn-ver-idoso"

                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalVerIdoso"

                                                            data-nome="{{ $idoso->nome_idoso }}"

                                                            data-cliente="{{ $idoso->cliente->nome_cliente ?? 'Não informado' }}"

                                                            data-sexo="{{ $idoso->sexo_idoso }}"

                                                            data-telefone="{{ $idoso->telefone_idoso }}"

                                                            data-cpf="{{ $idoso->cpf_idoso }}"

                                                            data-endereco="{{ $idoso->endereco_idoso }}"

                                                            data-idade="{{ $idoso->idade_idoso }}"

                                                            data-situacao="{{ $idoso->situacao_idoso }}"

                                                            data-ponto="{{ $idoso->ponto_principal_idoso }}"

                                                            data-status="{{ $idoso->status_idoso }}"

                                                            title="Ver detalhes"

                                                            aria-label="Ver detalhes"
                                                        >

                                                            <i class="bi bi-card-text"></i>

                                                        </button>



                                                        {{-- Editar --}}
                                                        <button
                                                            type="button"
                                                            class="btn btn-outline-secondary btn-editar-idoso"

                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalEditarIdoso"

                                                            data-nome="{{ $idoso->nome_idoso }}"

                                                            data-cliente="{{ $idoso->cliente->nome_cliente ?? 'Não informado' }}"

                                                            data-sexo="{{ $idoso->sexo_idoso }}"

                                                            data-telefone="{{ $idoso->telefone_idoso }}"

                                                            data-cpf="{{ $idoso->cpf_idoso }}"

                                                            data-endereco="{{ $idoso->endereco_idoso }}"

                                                            data-idade="{{ $idoso->idade_idoso }}"

                                                            data-situacao="{{ $idoso->situacao_idoso }}"

                                                            data-ponto="{{ $idoso->ponto_principal_idoso }}"

                                                            data-url="{{ route(
                                                                'admin.idoso.update',
                                                                $idoso->id_idoso
                                                            ) }}"

                                                            title="Editar"

                                                            aria-label="Editar"
                                                        >

                                                            <i class="bi bi-pencil"></i>

                                                        </button>



                                                        {{-- Ativar ou desativar --}}
                                                        <form
                                                            action="{{ route(
                                                                'admin.idoso.status',
                                                                $idoso->id_idoso
                                                            ) }}"
                                                            method="POST"
                                                            class="d-inline"
                                                        >

                                                            @csrf
                                                            @method('PATCH')


                                                            @if ($idoso->status_idoso === 'ATIVO')

                                                                <button
                                                                    type="submit"
                                                                    class="btn btn-outline-danger"
                                                                    title="Desativar idoso"
                                                                    aria-label="Desativar idoso"
                                                                >

                                                                    <i class="bi bi-eye-fill"></i>

                                                                </button>

                                                            @else

                                                                <button
                                                                    type="submit"
                                                                    class="btn btn-outline-success"
                                                                    title="Ativar idoso"
                                                                    aria-label="Ativar idoso"
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
                                                    colspan="9"
                                                    class="text-center py-4 text-muted"
                                                >

                                                    Nenhum idoso cadastrado.

                                                </td>

                                            </tr>

                                        @endforelse



                                        {{-- Alteração da Gabriele - mensagem da pesquisa --}}
                                        <tr
                                            id="idoso-sem-resultado"
                                            class="d-none"
                                        >

                                            <td
                                                colspan="9"
                                                class="text-center py-4 text-muted"
                                            >

                                                Nenhum idoso encontrado.

                                            </td>

                                        </tr>

                                    </tbody>

                                </table>

                            </div>

                        </div>



                        {{-- Rodapé --}}
                        <div class="card-footer clearfix">

                            <div class="float-start pt-1 fs-7 text-body-secondary">

                                Total de idosos:

                                <strong>
                                    {{ $idosos->count() }}
                                </strong>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>



{{-- ========================================================== --}}
{{-- MODAL - VISUALIZAR --}}
{{-- ========================================================== --}}

<div
    class="modal fade"
    id="modalVerIdoso"
    tabindex="-1"
    aria-labelledby="modalVerIdosoLabel"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-scrollable">

        <div class="modal-content">

            <div class="modal-header">

                <h5
                    class="modal-title"
                    id="modalVerIdosoLabel"
                >
                    Dados do idoso
                </h5>


                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Fechar"
                ></button>

            </div>



            <div class="modal-body">

                <div class="mb-3">

                    <strong>
                        Nome
                    </strong>

                    <p
                        id="verIdosoNome"
                        class="mb-0"
                    ></p>

                </div>



                <div class="mb-3">

                    <strong>
                        Cliente responsável
                    </strong>

                    <p
                        id="verIdosoCliente"
                        class="mb-0"
                    ></p>

                </div>



                <div class="row">

                    <div class="col-md-6 mb-3">

                        <strong>
                            Sexo
                        </strong>

                        <p
                            id="verIdosoSexo"
                            class="mb-0"
                        ></p>

                    </div>


                    <div class="col-md-6 mb-3">

                        <strong>
                            Idade
                        </strong>

                        <p
                            id="verIdosoIdade"
                            class="mb-0"
                        ></p>

                    </div>

                </div>



                <div class="mb-3">

                    <strong>
                        Telefone
                    </strong>

                    <p
                        id="verIdosoTelefone"
                        class="mb-0"
                    ></p>

                </div>



                <div class="mb-3">

                    <strong>
                        CPF
                    </strong>

                    <p
                        id="verIdosoCpf"
                        class="mb-0"
                    ></p>

                </div>



                <div class="mb-3">

                    <strong>
                        Endereço
                    </strong>

                    <p
                        id="verIdosoEndereco"
                        class="mb-0"
                    ></p>

                </div>



                <div class="mb-3">

                    <strong>
                        Situação atual
                    </strong>

                    <p
                        id="verIdosoSituacao"
                        class="mb-0"
                    ></p>

                </div>



                <div class="mb-3">

                    <strong>
                        Ponto principal de atenção
                    </strong>

                    <p
                        id="verIdosoPonto"
                        class="mb-0"
                    ></p>

                </div>



                <div>

                    <strong>
                        Status
                    </strong>

                    <p
                        id="verIdosoStatus"
                        class="mb-0"
                    ></p>

                </div>

            </div>



            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                >
                    Fechar
                </button>

            </div>

        </div>

    </div>

</div>



{{-- ========================================================== --}}
{{-- MODAL - EDITAR --}}
{{-- ========================================================== --}}

<div
    class="modal fade"
    id="modalEditarIdoso"
    tabindex="-1"
    aria-labelledby="modalEditarIdosoLabel"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-scrollable">

        <div class="modal-content">

            <div class="modal-header">

                <h5
                    class="modal-title"
                    id="modalEditarIdosoLabel"
                >
                    Editar idoso
                </h5>


                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Fechar"
                ></button>

            </div>



            <form
                id="formEditarIdoso"
                method="POST"
            >

                @csrf
                @method('PUT')


                <div class="modal-body modal-body-idoso-scrollavel">


                    {{-- Alteração da Gabriele - responsável somente para consulta --}}
                    <div class="mb-3">

                        <label
                            for="editarIdosoCliente"
                            class="form-label"
                        >
                            Cliente responsável
                        </label>


                        <input
                            type="text"
                            class="form-control"
                            id="editarIdosoCliente"
                            disabled
                        >


                        <div class="form-text">

                            O responsável não pode ser alterado pelo painel.

                        </div>

                    </div>



                    {{-- Nome --}}
                    <div class="mb-3">

                        <label
                            for="editarIdosoNome"
                            class="form-label"
                        >
                            Nome do idoso
                        </label>


                        <input
                            type="text"
                            class="form-control"
                            id="editarIdosoNome"
                            name="nome_idoso"
                            maxlength="75"
                            required
                        >

                    </div>



                    {{-- Sexo --}}
                    <div class="mb-3">

                        <label
                            for="editarIdosoSexo"
                            class="form-label"
                        >
                            Sexo
                        </label>


                        <select
                            class="form-select"
                            id="editarIdosoSexo"
                            name="sexo_idoso"
                            required
                        >

                            <option value="FEMININO">
                                Feminino
                            </option>

                            <option value="MASCULINO">
                                Masculino
                            </option>

                            <option value="OUTRO">
                                Outro
                            </option>

                        </select>

                    </div>



                    {{-- Telefone --}}
                    <div class="mb-3">

                        <label
                            for="editarIdosoTelefone"
                            class="form-label"
                        >
                            Telefone
                        </label>


                        <input
                            type="tel"
                            class="form-control"
                            id="editarIdosoTelefone"
                            name="telefone_idoso"
                            required
                        >

                    </div>



                    {{-- CPF --}}
                    <div class="mb-3">

                        <label
                            for="editarIdosoCpf"
                            class="form-label"
                        >
                            CPF
                        </label>


                        <input
                            type="text"
                            class="form-control"
                            id="editarIdosoCpf"
                            name="cpf_idoso"
                            required
                        >

                    </div>



                    {{-- Endereço --}}
                    <div class="mb-3">

                        <label
                            for="editarIdosoEndereco"
                            class="form-label"
                        >
                            Endereço
                        </label>


                        <textarea
                            class="form-control"
                            id="editarIdosoEndereco"
                            name="endereco_idoso"
                            rows="2"
                            required
                        ></textarea>

                    </div>



                    {{-- Idade --}}
                    <div class="mb-3">

                        <label
                            for="editarIdosoIdade"
                            class="form-label"
                        >
                            Idade
                        </label>


                        <input
                            type="number"
                            class="form-control"
                            id="editarIdosoIdade"
                            name="idade_idoso"
                            min="0"
                            max="120"
                            required
                        >

                    </div>



                    {{-- Situação --}}
                    <div class="mb-3">

                        <label
                            for="editarIdosoSituacao"
                            class="form-label"
                        >
                            Situação atual
                        </label>


                        <textarea
                            class="form-control"
                            id="editarIdosoSituacao"
                            name="situacao_idoso"
                            rows="3"
                            required
                        ></textarea>

                    </div>



                    {{-- Ponto principal --}}
                    <div class="mb-3">

                        <label
                            for="editarIdosoPonto"
                            class="form-label"
                        >
                            Ponto principal de atenção
                        </label>


                        <textarea
                            class="form-control"
                            id="editarIdosoPonto"
                            name="ponto_principal_idoso"
                            rows="3"
                            required
                        ></textarea>

                    </div>


                    {{-- Alteração da Gabriele -
                         status não fica nesse modal.
                         Ele possui botão próprio na listagem. --}}

                </div>



                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Cancelar
                    </button>


                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Salvar alterações
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>



{{-- ========================================================== --}}
{{-- JAVASCRIPT --}}
{{-- ========================================================== --}}

<script>

    document.addEventListener('DOMContentLoaded', function () {


        /*
         * Alteração da Gabriele - pesquisa e filtro.
         */
        const pesquisaIdoso =
            document.getElementById('idoso-search');

        const filtroIdoso =
            document.getElementById('idoso-status-filter');

        const semResultado =
            document.getElementById('idoso-sem-resultado');



        /*
         * Filtra as linhas da tabela.
         */
        function filtrarIdosos() {

            const pesquisa =
                pesquisaIdoso.value
                    .toLowerCase()
                    .trim();


            const status =
                filtroIdoso.value;


            const linhas =
                document.querySelectorAll('.idoso-row');


            let quantidadeVisivel = 0;


            linhas.forEach(function (linha) {

                const encontrouPesquisa =
                    linha.dataset.pesquisa.includes(pesquisa);


                const encontrouStatus =
                    status === 'all'
                    || linha.dataset.status === status;


                if (
                    encontrouPesquisa
                    && encontrouStatus
                ) {

                    linha.classList.remove('d-none');

                    quantidadeVisivel++;

                } else {

                    linha.classList.add('d-none');

                }

            });



            if (quantidadeVisivel === 0) {

                semResultado.classList.remove('d-none');

            } else {

                semResultado.classList.add('d-none');

            }

        }



        pesquisaIdoso.addEventListener(
            'input',
            filtrarIdosos
        );


        filtroIdoso.addEventListener(
            'change',
            filtrarIdosos
        );



        /*
         * Alteração da Gabriele - modal
         * para visualizar o idoso.
         */
        const modalVerIdoso =
            document.getElementById('modalVerIdoso');


        modalVerIdoso.addEventListener(
            'show.bs.modal',
            function (event) {

                const botao =
                    event.relatedTarget;


                document
                    .getElementById('verIdosoNome')
                    .textContent =
                    botao.getAttribute('data-nome');


                document
                    .getElementById('verIdosoCliente')
                    .textContent =
                    botao.getAttribute('data-cliente');


                document
                    .getElementById('verIdosoSexo')
                    .textContent =
                    botao.getAttribute('data-sexo');


                document
                    .getElementById('verIdosoIdade')
                    .textContent =
                    botao.getAttribute('data-idade')
                    + ' anos';


                document
                    .getElementById('verIdosoTelefone')
                    .textContent =
                    botao.getAttribute('data-telefone');


                document
                    .getElementById('verIdosoCpf')
                    .textContent =
                    botao.getAttribute('data-cpf');


                document
                    .getElementById('verIdosoEndereco')
                    .textContent =
                    botao.getAttribute('data-endereco');


                document
                    .getElementById('verIdosoSituacao')
                    .textContent =
                    botao.getAttribute('data-situacao');


                document
                    .getElementById('verIdosoPonto')
                    .textContent =
                    botao.getAttribute('data-ponto');


                document
                    .getElementById('verIdosoStatus')
                    .textContent =
                    botao.getAttribute('data-status');

            }
        );



        /*
         * Alteração da Gabriele - elementos
         * do modal de edição.
         */
        const modalEditarIdoso =
            document.getElementById('modalEditarIdoso');

        const formEditarIdoso =
            document.getElementById('formEditarIdoso');

        const editCliente =
            document.getElementById('editarIdosoCliente');

        const editNome =
            document.getElementById('editarIdosoNome');

        const editSexo =
            document.getElementById('editarIdosoSexo');

        const editTelefone =
            document.getElementById('editarIdosoTelefone');

        const editCpf =
            document.getElementById('editarIdosoCpf');

        const editEndereco =
            document.getElementById('editarIdosoEndereco');

        const editIdade =
            document.getElementById('editarIdosoIdade');

        const editSituacao =
            document.getElementById('editarIdosoSituacao');

        const editPonto =
            document.getElementById('editarIdosoPonto');



        /*
         * Alteração da Gabriele - preenche
         * o modal com o idoso escolhido.
         */
        modalEditarIdoso.addEventListener(
            'show.bs.modal',
            function (event) {

                const botao =
                    event.relatedTarget;


                formEditarIdoso.action =
                    botao.getAttribute('data-url');


                editCliente.value =
                    botao.getAttribute('data-cliente');


                editNome.value =
                    botao.getAttribute('data-nome');


                editSexo.value =
                    botao.getAttribute('data-sexo');


                editTelefone.value =
                    botao.getAttribute('data-telefone');


                editCpf.value =
                    botao.getAttribute('data-cpf');


                editEndereco.value =
                    botao.getAttribute('data-endereco');


                editIdade.value =
                    botao.getAttribute('data-idade');


                editSituacao.value =
                    botao.getAttribute('data-situacao');


                editPonto.value =
                    botao.getAttribute('data-ponto');

            }
        );

    });

</script>
