<section class="admin-list-page">

    <div class="app-content-header admin-page-header">

        <div class="container-fluid">

            <div class="row">

                <div class="col-sm-6">
                    <h1 class="mb-0 fs-3">Agendamentos</h1>
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
                                Agendamentos
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
                                        Agendamentos cadastrados
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
                                                id="agendamento-search"
                                                class="form-control admin-search-input"
                                                placeholder="Pesquisar agendamentos"
                                                aria-label="Pesquisar agendamentos">

                                        </div>



                                        <select
                                            id="agendamento-status-filter"
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
                                            <th>Cliente</th>
                                            <th>Idoso</th>
                                            <th>Serviço</th>
                                            <th>Horário</th>
                                            <th>Status</th>
                                            <th class="text-end">Ações</th>

                                        </tr>

                                    </thead>


                                    <tbody id="agendamento-table-body">


                                        @forelse ($listaAgendamento as $lista)


                                        <tr
                                            class="agendamento-row"
                                            data-dia="{{ strtolower($lista->dia_agendamento_cliente) }}"
                                            data-status="{{ $lista->status_agendamento_cliente }}">


                                            <td>
                                                {{ $lista->id_agendamento_cliente }}
                                            </td>

                                            <td>
                                                {{ $lista->id_agendamento_cliente }}
                                            </td>

                                            <td>
                                                {{ $lista->id_agendamento_cliente }}
                                            </td>

                                            <td>

                                                @if ($lista->dia_agendamento_cliente)

                                                {{ $lista->dia_agendamento_cliente}}

                                                @else

                                                <span class="text-muted">
                                                    Sem agendamento
                                                </span>

                                                @endif

                                            </td>


                                            <td>

                                                <span class="admin-record-label">
                                                    {{ $lista->horario_agendamento_cliente }}
                                                </span>

                                            </td>


                                            <td>

                                                @if ($lista->status_agendamento_cliente === 'ATIVO')

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
                                                        class="btn btn-outline-secondary btn-editar-banner"
                                                        title="Editar agendamento"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalEditarAgendamento"

                                                        data-id="{{ $lista->id_agendamento_cliente }}"

                                                        data-dia="{{ $lista->dia_agendamento_cliente }}"

                                                        data-horario="{{ $lista->horario_agendamento_cliente }}"

                                                        data-status="{{ $lista->status_agendamento_cliente }}">

                                                        <i class="bi bi-pencil"></i>

                                                    </button>



                                                    
                                                    @if ($lista->status_agendamento_cliente === 'ATIVO')

                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-danger btn-status-banner"
                                                        title="Desativar agendamento"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalStatusAgendamento"

                                                        data-url="{{ route('admin.agendamento.status', $lista->id_agendamento_cliente) }}"

                                                        data-status="ATIVO">

                                                        
                                                        <i class="bi bi-eye-fill"></i>

                                                    </button>

                                                    @else

                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-success btn-status-banner"
                                                        title="Ativar banner"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalStatusAgendamento"

                                                        data-url="{{ route('admin.agendamento.status', $lista->id_agendamento_cliente) }}"

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
                                                Nenhum agendamento encontrado.
                                            </td>

                                        </tr>

                                        @endforelse


                                       
                                        <tr
                                            id="agendamento-sem-resultado"
                                            class="d-none">

                                            <td
                                                colspan="5"
                                                class="text-center py-4 text-muted">
                                                Nenhum agendamento encontrado.
                                            </td>

                                        </tr>


                                    </tbody>

                                </table>

                            </div>

                        </div>



                        <div class="card-footer clearfix">

                            <div class="float-start pt-1 fs-7 text-body-secondary">

                                Total de agendamento:

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







{{-- Alteração da Gabriele - modal único de edição --}}
<div
    class="modal fade"
    id="modalEditarAgendamento"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">


            <div class="modal-header">

                <h5 class="modal-title">
                    Editar agendamento
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"></button>

            </div>


            <form
                id="formEditarAgendamento"
                method="POST"
                enctype="multipart/form-data">

                @csrf
                @method('PUT')


                <div class="modal-body">


                    <div class="mb-3">

                        <label class="form-label">
                            Dia
                        </label>

                        <input
                            type="date"
                            id="editar_dia_agendamento"
                            name="dia_agendamento_cliente"
                            class="form-control"
                            maxlength="35"
                            required>

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Horário
                        </label>

                        <div class="text-center">

                            <input
                                type="time"
                                id="editar_horario_agendamento"
                                name="horario_agendamento_cliente"
                                class="form-control"
                                required>

                        </div>

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Status
                        </label>

                        <select
                            id="editar_status_agendamento"
                            name="status_agendamento_cliente"
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

<script>
document.querySelectorAll('.btn-editar-banner').forEach(function (botao) {
    botao.addEventListener('click', function () {
        document.getElementById('editar_dia_agendamento').value = this.dataset.dia;
        document.getElementById('editar_horario_agendamento').value = this.dataset.horario;
        document.getElementById('editar_status_agendamento').value = this.dataset.status;
        document.getElementById('formEditarAgendamento').action = '/admin/agendamento/' + this.dataset.id;
    });
});
</script>



{{-- Alteração da Gabriele - modal de confirmação para status --}}
<div
    class="modal fade"
    id="modalStatusAgendamento"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog">

        <form
            id="formStatusAgendamento"
            method="POST">

            @csrf
            @method('PATCH')


            <div class="modal-content">


                <div class="modal-header">

                    <h5
                        class="modal-title"
                        id="tituloModalStatusBanner">
                        Alterar status
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>

                </div>


                <div class="modal-body">

                    <p
                        id="textoModalStatusBanner"
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
                        id="btnConfirmarStatusBanner"
                        class="btn btn-success">
                        Confirmar
                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

<script>
document.querySelectorAll('.btn-status-banner').forEach(function (botao) {
    botao.addEventListener('click', function () {
        document.getElementById('formStatusAgendamento').action = this.dataset.url;
    });
});
</script>
