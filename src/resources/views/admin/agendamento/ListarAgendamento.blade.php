<section class="admin-list-page">

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <strong>Não foi possível atualizar o agendamento:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $mensagemErro)
                    <li>{{ $mensagemErro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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
                                            <th>Data</th>
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
                                            data-nome="{{ strtolower($lista->AgendamentoCliente?->nome_cliente ?? '') }}"
                                            data-status="{{ $lista->status_agendamento_cliente }}">


                                            <td>
                                                {{ $lista->id_agendamento_cliente }}
                                            </td>

                                            <td>
                                                {{ $lista->AgendamentoCliente?->nome_cliente ?? 'Cliente não encontrado' }}
                                            </td>

                                            <td>
                                                {{ $lista->idoso?->nome_idoso ?? 'Idoso não encontrado' }}
                                            </td>

                                            <td>
                                                {{ $lista->servicoAgendamento?->servico_servico_login ?? 'Serviço não encontrado' }}
                                            </td>

                                            <td>

                                                @if ($lista->dia_agendamento_cliente)

                                                {{ \Carbon\Carbon::parse($lista->dia_agendamento_cliente)->format('d/m/Y') }}

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
                                                        class="btn btn-outline-secondary btn-editar-agendamento"
                                                        title="Editar agendamento"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalEditarAgendamento"

                                                        data-id="{{ $lista->id_agendamento_cliente }}"

                                                        data-url="{{ route('admin.agendamento.update', $lista->id_agendamento_cliente) }}"

                                                        data-cliente="{{ $lista->id_cliente }}"

                                                        data-idoso="{{ $lista->id_idoso }}"

                                                        data-servico="{{ $lista->id_servico_login }}"

                                                        data-dia="{{ \Carbon\Carbon::parse($lista->dia_agendamento_cliente)->format('Y-m-d') }}"

                                                        data-horario="{{ substr((string) $lista->horario_agendamento_cliente, 0, 5) }}"

                                                        data-status="{{ $lista->status_agendamento_cliente }}">

                                                        <i class="bi bi-pencil"></i>

                                                    </button>




                                                    @if ($lista->status_agendamento_cliente === 'ATIVO')

                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-danger btn-status-agendamento"
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
                                                        class="btn btn-outline-success btn-status-agendamento"
                                                        title="Ativar agendamento"
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
                                    {{ $listaAgendamento->count() }}
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

                <h1 class="mb-3 fs-3">Resumo semanal</h1>

                @php
                    $inicioSemana = \Carbon\CarbonImmutable::now()->startOfWeek(\Carbon\Carbon::MONDAY);
                    $nomesDias = ['Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado', 'Domingo'];
                @endphp

                <div class="row g-3 mb-4">
                    @for ($i = 0; $i < 7; $i++)
                        @php
                            $diaSemana = $inicioSemana->addDays($i);
                            $ehHoje = $diaSemana->isToday();
                            $quantidadeAgendamentos = $listaAgendamento->filter(function ($agendamento) use ($diaSemana) {
                                return \Carbon\Carbon::parse($agendamento->dia_agendamento_cliente)->isSameDay($diaSemana);
                            })->count();
                        @endphp

                        <div class="col-6 col-md-4 col-xl">
                            <div class="card h-100 text-center shadow-sm {{ $ehHoje ? 'text-bg-success border-success' : 'border-secondary-subtle' }}">
                                <div class="card-body py-3">
                                    <div class="{{ $ehHoje ? 'text-white' : 'text-muted' }}">{{ $nomesDias[$i] }}</div>
                                    <strong class="fs-2">{{ $diaSemana->format('d') }}</strong>
                                    <div class="small {{ $ehHoje ? 'text-white' : 'text-muted' }}">
                                        {{ $quantidadeAgendamentos }} {{ $quantidadeAgendamentos === 1 ? 'agendamento' : 'agendamentos' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>


        </div>

    </div>

</section>







<!-- EDIÇÃO -->
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
                data-update-base="{{ url('/admin/agendamento') }}"
                action="{{ old('_agendamento_id') ? route('admin.agendamento.update', old('_agendamento_id')) : route('admin.agendamento.update') }}">

                @csrf
                @method('PUT')
                <input type="hidden" name="_agendamento_id" id="editar_id_agendamento" value="{{ old('_agendamento_id') }}">


                <div class="modal-body">


                    <div class="mb-3">

                        <label class="form-label">
                            Cliente
                        </label>

                        <select
                            id="editar_cliente_agendamento"
                            name="id_cliente"
                            class="form-select"
                            required>
                            @foreach ($listaCliente as $cliente)
                            <option value="{{ $cliente->id_cliente }}">{{ $cliente->nome_cliente }}</option>
                            @endforeach
                        </select>

                    </div>



                    <div class="mb-3">

                        <label class="form-label">
                            Idoso
                        </label>

                        <select
                            id="editar_idoso_agendamento"
                            name="id_idoso"
                            class="form-select"
                            required>
                            @foreach ($listaIdoso as $idoso)
                            <option value="{{ $idoso->id_idoso }}">{{ $idoso->nome_idoso }}</option>
                            @endforeach
                        </select>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Serviço
                        </label>

                        <select
                            id="editar_servico_agendamento"
                            name="id_servico_login"
                            class="form-select"
                            required>
                            @foreach ($listaServico as $servico)
                            <option value="{{ $servico->id_servico_login }}">{{ $servico->servico_servico_login }}</option>
                            @endforeach
                        </select>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Data
                        </label>

                        <input
                            type="date"
                            id="editar_dia_agendamento"
                            name="dia_agendamento_cliente"
                            class="form-control"
                            required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Horário
                        </label>

                        <input
                            type="time"
                            id="editar_horario_agendamento"
                            name="horario_agendamento_cliente"
                            class="form-control"
                            required>

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



<!-- STATUS -->
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
                        id="tituloModalStatusAgendamento">
                        Alterar status
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>

                </div>


                <div class="modal-body">

                    <p
                        id="textoModalStatusAgendamento"
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
                        id="btnConfirmarStatusAgendamento"
                        class="btn btn-success">
                        Confirmar
                    </button>

                </div>

            </div>

        </form>

    </div>

</div>


<!-- MODAL EDIÇÃO -->
<script>
    const modalEditarAgendamento = document.getElementById('modalEditarAgendamento');
    let botaoQueAbriuEdicao = null;
    const formularioEditarAgendamento = document.getElementById('formEditarAgendamento');

    formularioEditarAgendamento.addEventListener('submit', function(event) {
        const idAgendamento = document.getElementById('editar_id_agendamento').value;

        if (!idAgendamento) {
            event.preventDefault();
            alert('Não foi possível identificar qual agendamento deve ser atualizado. Feche e abra o modal novamente.');
            return;
        }

        this.action = this.dataset.updateBase + '/' + encodeURIComponent(idAgendamento);
    });

    modalEditarAgendamento.addEventListener('show.bs.modal', function(event) {
        botaoQueAbriuEdicao = event.relatedTarget || null;

        if (botaoQueAbriuEdicao) {
            const formulario = document.getElementById('formEditarAgendamento');
            formulario.action = botaoQueAbriuEdicao.dataset.url;
            document.getElementById('editar_id_agendamento').value = botaoQueAbriuEdicao.dataset.id;
        }
    });

    modalEditarAgendamento.addEventListener('hide.bs.modal', function() {
        if (modalEditarAgendamento.contains(document.activeElement)) {
            document.activeElement.blur();
        }
    });

    modalEditarAgendamento.addEventListener('hidden.bs.modal', function() {
        if (botaoQueAbriuEdicao && botaoQueAbriuEdicao.isConnected) {
            botaoQueAbriuEdicao.focus();
        }
    });

    document
        .querySelectorAll('.btn-editar-agendamento')
        .forEach(function(botao) {

            botao.addEventListener('click', function() {

                const dia =
                    this.dataset.dia;


                const horario =
                    this.dataset.horario;

                const status =
                    this.dataset.status;


                document
                    .getElementById('editar_cliente_agendamento')
                    .value = this.dataset.cliente || '';


                document
                    .getElementById('editar_idoso_agendamento')
                    .value = this.dataset.idoso;


                document
                    .getElementById('editar_dia_agendamento')
                    .value = dia;

                document
                    .getElementById('editar_servico_agendamento')
                    .value = this.dataset.servico;

                document
                    .getElementById('editar_horario_agendamento')
                    .value = horario;

                document
                    .getElementById('editar_status_agendamento')
                    .value = status;


                document
                    .getElementById('formEditarAgendamento')
                    .action = this.dataset.url;

                document
                    .getElementById('editar_id_agendamento')
                    .value = this.dataset.id;



            });

        });
</script>

@if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('modalEditarAgendamento');
            if (modal && window.bootstrap) {
                bootstrap.Modal.getOrCreateInstance(modal).show();
            }
        });
    </script>
@endif



<!-- ATIVAR / DESATIVAR -->
<script>
    const modalStatusAgendamento =
        document.getElementById('modalStatusAgendamento');


    modalStatusAgendamento.addEventListener(
        'show.bs.modal',
        function(event) {

            const botao =
                event.relatedTarget;


            const url =
                botao.dataset.url;

            const status =
                botao.dataset.status;


            const formulario =
                document.getElementById('formStatusAgendamento');


            const titulo =
                document.getElementById('tituloModalStatusAgendamento');


            const texto =
                document.getElementById('textoModalStatusAgendamento');


            const botaoConfirmar =
                document.getElementById('btnConfirmarStatusAgendamento');


            formulario.action = url;



            if (status === 'ATIVO') {

                titulo.textContent =
                    'Desativar agendamento';

                texto.textContent =
                    'Tem certeza que deseja desativar este agendamento?';

                botaoConfirmar.textContent =
                    'Desativar';

                botaoConfirmar.className =
                    'btn btn-danger';

            }

            // avaliação está inativo e será ativado
            else {

                titulo.textContent =
                    'Ativar agendamento';

                texto.textContent =
                    'Tem certeza que deseja ativar este agendamento?';

                botaoConfirmar.textContent =
                    'Ativar';

                botaoConfirmar.className =
                    'btn btn-success';

            }

        }
    );
</script>



<!-- FILTRAGEM -->
<script>
    const campoPesquisa =
        document.getElementById('agendamento-search');


    const filtroStatus =
        document.getElementById('agendamento-status-filter');


    function filtrarAgendamento() {

        // Texto pesquisado
        const pesquisa =
            campoPesquisa.value
            .toLowerCase()
            .trim();


        // Status escolhido
        const statusSelecionado =
            filtroStatus.value;


        const linhas =
            document.querySelectorAll('.agendamento-row');


        let quantidadeVisivel = 0;


        linhas.forEach(function(linha) {

            const nome =
                linha.dataset.nome;


            const status =
                linha.dataset.status;


            // Verifica se o título contém o texto pesquisado
            const encontrouPesquisa =
                nome.includes(pesquisa);


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
            document.getElementById('agendamento-sem-resultado');


        if (quantidadeVisivel === 0) {

            semResultado.classList.remove('d-none');

        } else {

            semResultado.classList.add('d-none');

        }

    }


    // Pesquisa enquanto digita
    campoPesquisa.addEventListener(
        'input',
        filtrarAgendamento
    );


    // Filtra quando muda o status
    filtroStatus.addEventListener(
        'change',
        filtrarAgendamento
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
