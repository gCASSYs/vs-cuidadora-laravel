<section class="admin-list-page">

    <div class="app-content-header admin-page-header">

        <div class="container-fluid">

            <div class="row">

                <div class="col-sm-6">
                    <h1 class="mb-0 fs-3">Horários</h1>
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
                                Horários
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
                                        Horários cadastrados
                                    </h3>

                                </div>


                                <div class="col-12 col-md-8">

                                    <div class="d-flex flex-wrap justify-content-md-end gap-2">



                                        <div class="input-group input-group-sm w-auto">

                                            <span class="input-group-text">

                                                <i
                                                    class="bi bi-search"
                                                    aria-hidden="true"></i>

                                            </span>

                                            <input
                                                type="search"
                                                id="horario-search"
                                                class="form-control admin-search-input"
                                                placeholder="Pesquisar horários"
                                                aria-label="Pesquisar horários">

                                        </div>



                                        <select
                                            id="horario-status-filter"
                                            class="form-select form-select-sm w-auto">

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



                                        <button
                                            type="button"
                                            class="btn btn-sm btn-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalNovoHorario">

                                            <i class="bi bi-plus-lg me-1"></i>

                                            Novo horário

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
                                            <th>Telefone</th>
                                            <th>Formato</th>
                                            <th>Região</th>
                                            <th>Horário</th>
                                            <th>Status</th>
                                            <th class="text-end">Ações</th>

                                        </tr>

                                    </thead>


                                    <tbody id="banner-table-body">


                                        @forelse ($listaHorario as $lista)


                                        <tr
                                            class="horario-row"
                                            data-status="{{ $lista->status_horarios }}">


                                            <td>
                                                {{ $lista->id_horarios }}
                                            </td>


                                            <td>

                                                @if ($lista->telefone_horarios)

                                                <span class="text-muted">
                                                    {{ $lista->telefone_horarios}}
                                                </span>

                                                @else

                                                <span class="text-muted">
                                                    Sem telefone
                                                </span>

                                                @endif

                                            </td>


                                            <td>

                                                <span class="admin-record-label">
                                                    {{ $lista->formato_horarios }}
                                                </span>

                                            </td>

                                            <td>

                                                <span class="admin-record-label">
                                                    {{ $lista->regiao_horarios }}
                                                </span>

                                            </td>

                                            <td>

                                                <span class="admin-record-label">
                                                    {{ $lista->horario_horarios }}
                                                </span>

                                            </td>

                                            <td>

                                                @if ($lista->status_horarios === 'ATIVO')

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



                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-secondary btn-editar-horario"
                                                        title="Editar horário"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalEditarHorario"

                                                        data-id="{{ $lista->id_horarios }}"

                                                        data-telefone="{{ $lista->telefone_horarios }}"

                                                        data-formato="{{ $lista->formato_horarios }}"

                                                        data-regiao="{{ $lista->regiao_horarios }}"

                                                        data-horario="{{ $lista->horario_horarios }}"

                                                        data-status="{{ $lista->status_horarios }}">

                                                        <i class="bi bi-pencil"></i>

                                                    </button>




                                                    @if ($lista->status_horarios === 'ATIVO')

                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-danger btn-status-horario"
                                                        title="Desativar horário"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalStatusHorario"

                                                        data-url="{{ route('admin.horarios.status', $lista->id_horarios) }}"

                                                        data-status="ATIVO">


                                                        <i class="bi bi-eye-fill"></i>

                                                    </button>

                                                    @else

                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-success btn-status-horario"
                                                        title="Ativar horario"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalStatusHorario"

                                                        data-url="{{ route('admin.horarios.status', $lista->id_horarios) }}"

                                                        data-status="INATIVO">


                                                        <i class="bi bi-eye-slash-fill"></i>

                                                    </button>

                                                    @endif


                                                </div>

                                            </td>

                                        </tr>


                                        @empty

                                        <tr>

                                            <td
                                                colspan="5"
                                                class="text-center py-4 text-muted">
                                                Nenhum horário encontrado.
                                            </td>

                                        </tr>

                                        @endforelse


                                        <tr
                                            id="horario-sem-resultado"
                                            class="d-none">

                                            <td
                                                colspan="5"
                                                class="text-center py-4 text-muted">
                                                Nenhum horário encontrado.
                                            </td>

                                        </tr>


                                    </tbody>

                                </table>

                            </div>

                        </div>



                        <div class="card-footer clearfix">

                            <div class="float-start pt-1 fs-7 text-body-secondary">

                                Total de horários:

                                <strong>
                                    {{ $lista->count() }}
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



{{-- INÍCIO MODAL NOVO HORÁRIO --}}
<div
    class="modal fade"
    id="modalNovoHorario"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">


            <div class="modal-header">

                <h5 class="modal-title">
                    Novo horário
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"></button>

            </div>


            <form
                action="{{ route('admin.horarios.store') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf


                <div class="modal-body">


                    <div class="mb-3">

                        <label
                            for="telefone_horarios"
                            class="form-label">
                            Telefone
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="telefone_horarios"
                            name="telefone_horarios"
                            maxlength="35"
                            required>

                    </div>

                    <div class="mb-3">

                        <label
                            for="formato_horarios"
                            class="form-label">
                            Formato
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="formato_horarios"
                            name="formato_horarios"
                            maxlength="35"
                            required>

                    </div>





                    <div class="mb-3">

                        <label class="form-label">
                            Região
                        </label>

                        <input
                            type="text"
                            id="editar_regiao_horario"
                            name="regiao_horarios"
                            class="form-control"
                            maxlength="35"
                            required>

                    </div>



                    <div class="mb-3">

                        <label class="form-label">
                            Horário
                        </label>

                        <input
                            type="text"
                            id="editar_horario_horario"
                            name="horario_horarios"
                            class="form-control"
                            maxlength="35"
                            required>

                    </div>




                    <div class="mb-3">

                        <label
                            for="status_horarios"
                            class="form-label">
                            Status
                        </label>

                        <select
                            class="form-select"
                            id="status_horarios"
                            name="status_horarios">

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
{{-- FIM MODAL NOVO BANNER --}}



{{-- INÍCIO MODAL EDIÇÃO --}}
<div
    class="modal fade"
    id="modalEditarHorario"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">


            <div class="modal-header">

                <h5 class="modal-title">
                    Editar horário
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"></button>

            </div>


            <form
                id="formEditarHorario"
                method="POST"
                enctype="multipart/form-data">

                @csrf
                @method('PUT')


                <div class="modal-body">


                    <div class="mb-3">

                        <label class="form-label">
                            Telefone
                        </label>

                        <input
                            type="text"
                            id="editar_telefone_horario"
                            name="telefone_horarios"
                            class="form-control"
                            maxlength="35"
                            required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Formato
                        </label>

                        <input
                            type="text"
                            id="editar_formato_horario"
                            name="formato_horarios"
                            class="form-control"
                            maxlength="35"
                            required>

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Região
                        </label>

                        <input
                            type="text"
                            id="editar_regiao_horario"
                            name="regiao_horarios"
                            class="form-control"
                            maxlength="35"
                            required>

                    </div>



                    <div class="mb-3">

                        <label class="form-label">
                            Horário
                        </label>

                        <input
                            type="text"
                            id="editar_horario_horario"
                            name="horario_horarios"
                            class="form-control"
                            maxlength="35"
                            required>

                    </div>




                    <div class="mb-3">

                        <label class="form-label">
                            Status
                        </label>

                        <select
                            id="editar_status_horario"
                            name="status_horarios"
                            class="form-select">

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
                        Salvar alterações
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
{{-- FIM MODAL EDIÇÃO --}}


{{-- INÍCIO MODAL STATUS --}}
<div
    class="modal fade"
    id="modalStatusHorario"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog">

        <form
            id="formStatusHorario"
            method="POST">

            @csrf
            @method('PATCH')


            <div class="modal-content">


                <div class="modal-header">

                    <h5
                        class="modal-title"
                        id="tituloModalStatusHorario">
                        Alterar status
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>

                </div>


                <div class="modal-body">

                    <p
                        id="textoModalStatusHorario"
                        class="mb-0"></p>

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
                        id="btnConfirmarStatusHorario"
                        class="btn btn-success">
                        Confirmar
                    </button>

                </div>

            </div>

        </form>

    </div>

</div>
{{-- FIM MODAL STATUS --}}

{{-- SCRIPT --}}






<script>
    document
        .querySelectorAll('.btn-editar-horario')
        .forEach(function(botao) {

            botao.addEventListener('click', function() {

                const id =
                    this.dataset.id;

                const telefone =
                    this.dataset.telefone;

                const regiao =
                    this.dataset.regiao;


                const formato =
                    this.dataset.formato;
                              
                const horario =
                    this.dataset.horario;

                const status =
                    this.dataset.status;


                document
                    .getElementById('editar_formato_horario')
                    .src = formato;


                document
                    .getElementById('editar_regiao_horario')
                    .src = regiao;

                document
                    .getElementById('editar_horario_horario')
                    .src = horario;


                document
                    .getElementById('editar_status_horario')
                    .value = status;


                document
                    .getElementById('formEditarHorario')
                    .action = '/admin/horarios/' + id;




            });

        });
</script>



<!-- ATIVAR/DESATIVAR HORÁRIO -->
<script>
    const modalStatusBannerSecao =
        document.getElementById('modalStatusHorario');


    modalStatusBannerSecao.addEventListener(
        'show.bs.modal',
        function(event) {

            const botao =
                event.relatedTarget;


            const url =
                botao.dataset.url;

            const status =
                botao.dataset.status;


            const formulario =
                document.getElementById('formStatusHorario');



            const titulo =
                document.getElementById('tituloModalStatusHorario');


            const texto =
                document.getElementById('textoModalStatusHorario');



            const botaoConfirmar =
                document.getElementById('btnConfirmarStatusHorario');


            formulario.action = url;


            // Banner está ativo e será desativado
            if (status === 'ATIVO') {

                texto.textContent =
                    'Desativar horário';

                texto.textContent =
                    'Tem certeza que deseja desativar este horário?';

                botaoConfirmar.textContent =
                    'Desativar';

                botaoConfirmar.className =
                    'btn btn-danger';

            }

            // Banner está inativo e será ativado
            else {

                texto.textContent =
                    'Ativar horário';

                texto.textContent =
                    'Tem certeza que deseja ativar este horário?';

                botaoConfirmar.textContent =
                    'Ativar';

                botaoConfirmar.className =
                    'btn btn-success';

            }

        }
    );
</script>



<!-- FILTRAR -->
<script>
    const campoPesquisa =
        document.getElementById('horario-search');


    const filtroStatus =
        document.getElementById('horario-status-filter');


    function filtrarHorarios() {

        // Texto pesquisado
        const pesquisa =
            campoPesquisa.value
            .toLowerCase()
            .trim();


        // Status escolhido
        const statusSelecionado =
            filtroStatus.value;


        const linhas =
            document.querySelectorAll('.horario-row');


        let quantidadeVisivel = 0;


        linhas.forEach(function(linha) {

            const telefone =
                linha.dataset.telefone;


            const status =
                linha.dataset.status;


            // Verifica se o título contém o texto pesquisado
            const encontrouPesquisa =
                telefone.includes(pesquisa);


            // Verifica o status
            const encontrouStatus =
                statusSelecionado === 'all' ||
                status === statusSelecionado;


            // Mostra somente quando os dois filtros são verdadeiros
            if (encontrouPesquisa && encontrouStatus) {

                linha.classList.remove('d-none');

                quantidadeVisivel++;

            } else {

                linha.classList.add('d-none');

            }

        });


        // Alteração da Gabriele - mensagem quando nenhum resultado é encontrado
        const semResultado =
            document.getElementById('horario-sem-resultado');


        if (quantidadeVisivel === 0) {

            semResultado.classList.remove('d-none');

        } else {

            semResultado.classList.add('d-none');

        }

    }


    // Pesquisa enquanto digita
    campoPesquisa.addEventListener(
        'input',
        filtrarHorarios
    );


    // Filtra quando muda o status
    filtroStatus.addEventListener(
        'change',
        filtrarHorarios
    );
</script>



<!-- ALERTA -->
<script>
    document.addEventListener(
        'DOMContentLoaded',
        function() {

            setTimeout(function() {

                const alertas =
                    document.querySelectorAll('.alert');


                alertas.forEach(function(alerta) {

                    // Usa o próprio Bootstrap para fechar suavemente
                    const alertaBootstrap =
                        bootstrap.Alert.getOrCreateInstance(alerta);

                    alertaBootstrap.close();

                });

            }, 3000);

        }
    );
</script>