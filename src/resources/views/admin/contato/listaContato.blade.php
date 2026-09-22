{{-- Listagem administrativa dos contatos --}}
<section class="admin-list-page">

    <div class="app-content-header admin-page-header">

        <div class="container-fluid">

            <div class="row">

                <div class="col-sm-6">
                    <h1 class="mb-0 fs-3">Contato</h1>
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
                                Contato
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
                                        Contatos cadastrados
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
                                                id="contato-search"
                                                class="form-control admin-search-input"
                                                placeholder="Pesquisar contatos"
                                            >

                                        </div>


                                        {{-- Alteração da Gabriele - filtro por status --}}
                                        <select
                                            id="contato-status-filter"
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


                                        {{-- Alteração da Gabriele - novo contato --}}
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalNovoContato"
                                        >

                                            <i class="bi bi-plus-lg me-1"></i>

                                            Novo Contato

                                        </button>

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
                                            <th>Redes sociais</th>
                                            <th>Endereço</th>
                                            <th>Horário relacionado</th>
                                            <th>Status</th>
                                            <th class="text-end">Ações</th>

                                        </tr>

                                    </thead>


                                    <tbody>


                                        @forelse ($contatos as $contato)

                                            {{-- Alteração da Gabriele - dados para pesquisa e filtro --}}
                                            <tr
                                                class="contato-row"
                                                data-pesquisa="{{ strtolower(
                                                    $contato->redes_sociais_contato . ' ' .
                                                    $contato->endereco_contato . ' ' .
                                                    $contato->horario_horarios . ' ' .
                                                    $contato->regiao_horarios
                                                ) }}"
                                                data-status="{{ $contato->status_contato }}"
                                            >


                                                <td>
                                                    {{ $contato->id_contato }}
                                                </td>


                                                <td>
                                                    {{ Str::limit($contato->redes_sociais_contato, 70) }}
                                                </td>


                                                <td>
                                                    {{ Str::limit($contato->endereco_contato, 70) }}
                                                </td>


                                                {{-- Alteração da Gabriele - mostra dados do horário relacionado --}}
                                                <td>

                                                    @if ($contato->horario_horarios)

                                                        <span class="admin-record-label">
                                                            {{ $contato->horario_horarios }}
                                                        </span>

                                                        <small class="d-block text-body-secondary">
                                                            {{ $contato->formato_horarios }}
                                                        </small>

                                                        <small class="d-block text-body-secondary">
                                                            {{ trim($contato->regiao_horarios) }}
                                                        </small>

                                                    @else

                                                        <span class="text-muted">
                                                            Horário não encontrado
                                                        </span>

                                                    @endif

                                                </td>


                                                <td>

                                                    @if ($contato->status_contato === 'ATIVO')

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


                                                        {{-- Alteração da Gabriele - editar --}}
                                                        <button
                                                            type="button"
                                                            class="btn btn-outline-secondary btn-editar-contato"
                                                            title="Editar contato"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalEditarContato"

                                                            data-id="{{ $contato->id_contato }}"

                                                            data-redes="{{ $contato->redes_sociais_contato }}"

                                                            data-icone="{{ $contato->icones_redes_sociais_contato }}"

                                                            data-endereco="{{ $contato->endereco_contato }}"

                                                            data-horario="{{ $contato->id_horarios }}"

                                                            data-status="{{ $contato->status_contato }}"
                                                        >

                                                            <i class="bi bi-pencil"></i>

                                                        </button>



                                                        {{-- Alteração da Gabriele - ativar ou desativar --}}
                                                        @if ($contato->status_contato === 'ATIVO')

                                                            <button
                                                                type="button"
                                                                class="btn btn-outline-danger btn-status-contato"
                                                                title="Desativar contato"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modalStatusContato"

                                                                data-url="{{ route('admin.contato.status', $contato->id_contato) }}"

                                                                data-status="ATIVO"
                                                            >

                                                                <i class="bi bi-eye-fill"></i>

                                                            </button>

                                                        @else

                                                            <button
                                                                type="button"
                                                                class="btn btn-outline-success btn-status-contato"
                                                                title="Ativar contato"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modalStatusContato"

                                                                data-url="{{ route('admin.contato.status', $contato->id_contato) }}"

                                                                data-status="INATIVO"
                                                            >

                                                                <i class="bi bi-eye-slash-fill"></i>

                                                            </button>

                                                        @endif


                                                    </div>

                                                </td>

                                            </tr>


                                        @empty

                                            <tr>

                                                <td
                                                    colspan="6"
                                                    class="text-center py-4 text-muted"
                                                >
                                                    Nenhum contato encontrado.
                                                </td>

                                            </tr>

                                        @endforelse


                                        {{-- Alteração da Gabriele - nenhum resultado --}}
                                        <tr
                                            id="contato-sem-resultado"
                                            class="d-none"
                                        >

                                            <td
                                                colspan="6"
                                                class="text-center py-4 text-muted"
                                            >
                                                Nenhum contato encontrado.
                                            </td>

                                        </tr>


                                    </tbody>

                                </table>

                            </div>

                        </div>



                        <div class="card-footer clearfix">

                            <div class="float-start pt-1 fs-7 text-body-secondary">

                                Total de contatos:

                                <strong>
                                    {{ $contatos->count() }}
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



{{-- Alteração da Gabriele - modal cadastrar contato --}}
<div
    class="modal fade"
    id="modalNovoContato"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog">

        <div class="modal-content">


            <div class="modal-header">

                <h5 class="modal-title">
                    Novo Contato
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>


            <form
                action="{{ route('admin.contato.store') }}"
                method="POST"
            >

                @csrf


                <div class="modal-body">


                    {{-- Alteração da Gabriele - redes sociais --}}
                    <div class="mb-3">

                        <label class="form-label">
                            Redes sociais
                        </label>

                        <textarea
                            class="form-control"
                            name="redes_sociais_contato"
                            rows="3"
                            required
                        ></textarea>

                    </div>


                    {{-- Alteração da Gabriele - ícone --}}
                    <div class="mb-3">

                        <label class="form-label">
                            Ícone da rede social
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            name="icones_redes_sociais_contato"
                            maxlength="65"
                            placeholder="Ex.: bi bi-instagram"
                            required
                        >

                    </div>


                    {{-- Alteração da Gabriele - endereço --}}
                    <div class="mb-3">

                        <label class="form-label">
                            Endereço / região
                        </label>

                        <textarea
                            class="form-control"
                            name="endereco_contato"
                            rows="3"
                            required
                        ></textarea>

                    </div>


                    {{-- Alteração da Gabriele - horário relacionado --}}
                    <div class="mb-3">

                        <label class="form-label">
                            Horário relacionado
                        </label>

                        <select
                            class="form-select"
                            name="id_horarios"
                            required
                        >

                            <option value="">
                                Selecione
                            </option>


                            @foreach ($horarios as $horario)

                                <option value="{{ $horario->id_horarios }}">

                                    {{ $horario->horario_horarios }}
                                    -
                                    {{ $horario->formato_horarios }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Alteração da Gabriele - status --}}
                    <div class="mb-3">

                        <label class="form-label">
                            Status
                        </label>

                        <select
                            class="form-select"
                            name="status_contato"
                            required
                        >

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
                        data-bs-dismiss="modal"
                    >
                        Cancelar
                    </button>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Salvar
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>



{{-- Alteração da Gabriele - modal editar contato --}}
<div
    class="modal fade"
    id="modalEditarContato"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog">

        <div class="modal-content">


            <div class="modal-header">

                <h5 class="modal-title">
                    Editar Contato
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>


            <form
                id="formEditarContato"
                method="POST"
            >

                @csrf
                @method('PUT')


                <div class="modal-body">


                    <div class="mb-3">

                        <label class="form-label">
                            Redes sociais
                        </label>

                        <textarea
                            id="editar_redes_contato"
                            class="form-control"
                            name="redes_sociais_contato"
                            rows="3"
                            required
                        ></textarea>

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Ícone da rede social
                        </label>

                        <input
                            type="text"
                            id="editar_icone_contato"
                            class="form-control"
                            name="icones_redes_sociais_contato"
                            maxlength="65"
                            required
                        >

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Endereço / região
                        </label>

                        <textarea
                            id="editar_endereco_contato"
                            class="form-control"
                            name="endereco_contato"
                            rows="3"
                            required
                        ></textarea>

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Horário relacionado
                        </label>

                        <select
                            id="editar_horario_contato"
                            class="form-select"
                            name="id_horarios"
                            required
                        >

                            @foreach ($horarios as $horario)

                                <option value="{{ $horario->id_horarios }}">

                                    {{ $horario->horario_horarios }}
                                    -
                                    {{ $horario->formato_horarios }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Status
                        </label>

                        <select
                            id="editar_status_contato"
                            class="form-select"
                            name="status_contato"
                            required
                        >

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



{{-- Alteração da Gabriele - modal status --}}
<div
    class="modal fade"
    id="modalStatusContato"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog">

        <form
            id="formStatusContato"
            method="POST"
        >

            @csrf
            @method('PATCH')


            <div class="modal-content">

                <div class="modal-header">

                    <h5
                        id="tituloModalStatusContato"
                        class="modal-title"
                    >
                        Alterar status
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                    ></button>

                </div>


                <div class="modal-body">

                    <p
                        id="textoModalStatusContato"
                        class="mb-0"
                    ></p>

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
                        id="btnConfirmarStatusContato"
                        class="btn"
                    >
                        Confirmar
                    </button>

                </div>

            </div>

        </form>

    </div>

</div>



{{-- Alteração da Gabriele - preenche modal de edição --}}
<script>

    document
        .querySelectorAll('.btn-editar-contato')
        .forEach(function(botao) {

            botao.addEventListener('click', function() {

                const id =
                    this.dataset.id;

                document
                    .getElementById('editar_redes_contato')
                    .value = this.dataset.redes;

                document
                    .getElementById('editar_icone_contato')
                    .value = this.dataset.icone;

                document
                    .getElementById('editar_endereco_contato')
                    .value = this.dataset.endereco;

                document
                    .getElementById('editar_horario_contato')
                    .value = this.dataset.horario;

                document
                    .getElementById('editar_status_contato')
                    .value = this.dataset.status;


                document
                    .getElementById('formEditarContato')
                    .action = '/admin/contato/' + id;

            });

        });

</script>



{{-- Alteração da Gabriele - ativar/desativar --}}
<script>

    const modalStatusContato =
        document.getElementById('modalStatusContato');


    modalStatusContato.addEventListener(
        'show.bs.modal',
        function(event) {

            const botao =
                event.relatedTarget;


            const status =
                botao.dataset.status;


            document
                .getElementById('formStatusContato')
                .action = botao.dataset.url;


            const titulo =
                document.getElementById('tituloModalStatusContato');


            const texto =
                document.getElementById('textoModalStatusContato');


            const confirmar =
                document.getElementById('btnConfirmarStatusContato');


            if (status === 'ATIVO') {

                titulo.textContent =
                    'Desativar Contato';

                texto.textContent =
                    'Tem certeza que deseja desativar este contato?';

                confirmar.textContent =
                    'Desativar';

                confirmar.className =
                    'btn btn-danger';

            } else {

                titulo.textContent =
                    'Ativar Contato';

                texto.textContent =
                    'Tem certeza que deseja ativar este contato?';

                confirmar.textContent =
                    'Ativar';

                confirmar.className =
                    'btn btn-success';

            }

        }
    );

</script>



{{-- Alteração da Gabriele - pesquisa e filtro --}}
<script>

    const pesquisaContato =
        document.getElementById('contato-search');


    const filtroContato =
        document.getElementById('contato-status-filter');


    function filtrarContatos() {

        const pesquisa =
            pesquisaContato.value
                .toLowerCase()
                .trim();


        const statusSelecionado =
            filtroContato.value;


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


    pesquisaContato.addEventListener(
        'input',
        filtrarContatos
    );


    filtroContato.addEventListener(
        'change',
        filtrarContatos
    );

</script>



{{-- Alteração da Gabriele - remove mensagens automaticamente --}}
<script>

    document.addEventListener(
        'DOMContentLoaded',
        function() {

            setTimeout(function() {

                document
                    .querySelectorAll('.alert')
                    .forEach(function(alerta) {

                        const alertaBootstrap =
                            bootstrap.Alert.getOrCreateInstance(alerta);

                        alertaBootstrap.close();

                    });

            }, 3000);

        }
    );

</script>