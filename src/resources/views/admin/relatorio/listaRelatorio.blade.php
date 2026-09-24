{{-- Alteração da Gabriele - listagem dos relatórios --}}
<section class="admin-list-page">

    {{-- cabeçalho da página --}}
    <div class="app-content-header admin-page-header">

        <div class="container-fluid">

            <div class="row">

                <div class="col-sm-6">

                    <h1 class="mb-0 fs-3">
                        Relatórios
                    </h1>

                </div>


                {{-- caminho da página --}}
                <div class="col-sm-6">

                    <nav aria-label="breadcrumb">

                        <ol class="breadcrumb float-sm-end">

                            <li class="breadcrumb-item">

                                <a href="{{ route('admin.dashboard') }}">
                                    Dashboard
                                </a>

                            </li>

                            <li class="breadcrumb-item active">
                                Relatórios
                            </li>

                        </ol>

                    </nav>

                </div>

            </div>

        </div>

    </div>



    {{-- conteúdo --}}
    <div class="app-content">

        <div class="container-fluid">


            {{-- mostra os erros --}}
            @if ($errors->any())

                <div
                    class="alert alert-danger alert-dismissible fade show"
                    role="alert"
                >

                    <strong>
                        Não foi possível salvar o relatório.
                    </strong>

                    <ul class="mb-0 mt-2">

                        @foreach ($errors->all() as $erro)

                            <li>
                                {{ $erro }}
                            </li>

                        @endforeach

                    </ul>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                    ></button>

                </div>

            @endif



            <div class="row">

                <div class="col-12">

                    <div class="card admin-data-card mb-4">


                        {{-- topo da tabela --}}
                        <div class="card-header">

                            <div class="row g-2 align-items-center">


                                <div class="col-12 col-md-4">

                                    <h3 class="card-title">
                                        Relatórios cadastrados
                                    </h3>

                                </div>



                                <div class="col-12 col-md-8">

                                    <div class="d-flex flex-wrap justify-content-md-end gap-2">


                                        {{-- pesquisa --}}
                                        <div class="input-group input-group-sm w-auto">

                                            <span class="input-group-text">

                                                <i class="bi bi-search"></i>

                                            </span>

                                            <input
                                                type="search"
                                                id="relatorio-search"
                                                class="form-control admin-search-input"
                                                placeholder="Pesquisar relatórios"
                                            >

                                        </div>



                                        {{-- filtro --}}
                                        <select
                                            id="relatorio-status-filter"
                                            class="form-select form-select-sm w-auto"
                                        >

                                            <option value="all">
                                                Todos
                                            </option>

                                            <option value="RASCUNHO">
                                                Rascunhos
                                            </option>

                                            <option value="SALVO">
                                                Finalizados
                                            </option>

                                            <option value="ENVIADO">
                                                Enviados
                                            </option>

                                        </select>



                                        {{-- abre o modal de novo relatório --}}
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalNovoRelatorio"
                                        >

                                            <i class="bi bi-plus-lg me-1"></i>

                                            Novo Relatório

                                        </button>

                                    </div>

                                </div>

                            </div>

                        </div>



                        {{-- tabela --}}
                        <div class="card-body p-0">

                            <div class="table-responsive">

                                <table class="table table-hover align-middle m-0">

                                    <thead>

                                        <tr>

                                            <th>Id</th>
                                            <th>Idoso</th>
                                            <th>Responsável</th>
                                            <th>Data</th>
                                            <th>Horário</th>
                                            <th>Status</th>
                                            <th class="text-end">Ações</th>

                                        </tr>

                                    </thead>


                                    <tbody id="relatorio-table-body">

                                        @forelse ($relatorios as $relatorio)

                                            <tr
                                                class="relatorio-row"

                                                {{-- dados usados na pesquisa --}}
                                                data-pesquisa="{{ strtolower(
                                                    ($relatorio->nome_relatorio_vania ?? '') . ' ' .
                                                    ($relatorio->idoso->nome_idoso ?? '') . ' ' .
                                                    ($relatorio->cliente->nome_cliente ?? '')
                                                ) }}"

                                                data-status="{{ $relatorio->status_relatorio_vania }}"
                                            >


                                                {{-- id --}}
                                                <td>
                                                    {{ $relatorio->id_relatorio_vania }}
                                                </td>



                                                {{-- idoso --}}
                                                <td>

                                                    @if ($relatorio->idoso)

                                                        <span class="admin-record-label">

                                                            {{ $relatorio->idoso->nome_idoso }}

                                                        </span>

                                                    @else

                                                        <span class="text-muted">
                                                            Idoso não encontrado
                                                        </span>

                                                    @endif

                                                </td>



                                                {{-- responsável --}}
                                                <td>

                                                    @if ($relatorio->cliente)

                                                        {{ $relatorio->cliente->nome_cliente }}

                                                    @else

                                                        <span class="text-muted">
                                                            Cliente não encontrado
                                                        </span>

                                                    @endif

                                                </td>



                                                {{-- data --}}
                                                <td>

                                                    {{ date(
                                                        'd/m/Y',
                                                        strtotime($relatorio->data_relatorio_vania)
                                                    ) }}

                                                </td>



                                                {{-- horário --}}
                                                <td>

                                                    {{ date(
                                                        'H:i',
                                                        strtotime($relatorio->horario_relatorio_vania)
                                                    ) }}

                                                </td>



                                                {{-- status atual --}}
                                                <td>

                                                    @if ($relatorio->status_relatorio_vania === 'ENVIADO')

                                                        <span class="badge text-bg-success">
                                                            Enviado
                                                        </span>

                                                    @elseif ($relatorio->status_relatorio_vania === 'SALVO')

                                                        <span class="badge text-bg-primary">
                                                            Finalizado
                                                        </span>

                                                    @else

                                                        <span class="badge text-bg-warning">
                                                            Rascunho
                                                        </span>

                                                    @endif

                                                </td>



                                                {{-- ações --}}
                                                <td class="text-end">

                                                    <div class="btn-group btn-group-sm">


                                                        {{--
                                                            Alteração da Gabriele -
                                                            agora o lápis abre o modal de editar
                                                        --}}
                                                        <button
                                                            type="button"
                                                            class="btn btn-outline-secondary btn-editar-relatorio"
                                                            title="Editar relatório"

                                                            data-id="{{ $relatorio->id_relatorio_vania }}"

                                                            data-url="{{ route(
                                                                'admin.relatorio.update',
                                                                $relatorio->id_relatorio_vania
                                                            ) }}"

                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalEditarRelatorio"
                                                        >

                                                            <i class="bi bi-pencil"></i>

                                                        </button>



                                                        {{--
                                                            Alteração da Gabriele -
                                                            esse botão vai enviar pro cliente.

                                                            Ainda não fazemos isso pq essa
                                                            parte depende da área do cliente.
                                                        --}}
                                                        <button
                                                            type="button"
                                                            class="btn btn-outline-success"
                                                            title="Enviar relatório"
                                                            disabled
                                                        >

                                                            <i class="bi bi-check-lg"></i>

                                                        </button>

                                                    </div>

                                                </td>

                                            </tr>


                                        @empty

                                            <tr>

                                                <td
                                                    colspan="7"
                                                    class="text-center py-4 text-muted"
                                                >
                                                    Nenhum relatório cadastrado.
                                                </td>

                                            </tr>

                                        @endforelse



                                        {{-- aparece quando a pesquisa não acha nada --}}
                                        <tr
                                            id="relatorio-sem-resultado"
                                            class="d-none"
                                        >

                                            <td
                                                colspan="7"
                                                class="text-center py-4 text-muted"
                                            >
                                                Nenhum relatório encontrado.
                                            </td>

                                        </tr>

                                    </tbody>

                                </table>

                            </div>

                        </div>



                        {{-- rodapé --}}
                        <div class="card-footer clearfix">

                            <div class="float-start pt-1 fs-7 text-body-secondary">

                                Total de relatórios:

                                <strong>
                                    {{ $relatorios->count() }}
                                </strong>

                            </div>


                            {{-- paginação visual por enquanto --}}
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



{{-- ================================================================ --}}
{{-- MODAL NOVO RELATÓRIO --}}
{{-- ================================================================ --}}

<div
    class="modal fade"
    id="modalNovoRelatorio"
    tabindex="-1"
    aria-labelledby="modalNovoRelatorioLabel"
    aria-hidden="true"
>

    {{-- modal com scroll próprio --}}
    <div class="modal-dialog modal-dialog-scrollable">


        <form
            class="modal-content"
            action="{{ route('admin.relatorio.store') }}"
            method="POST"
        >

            @csrf

            {{-- ajuda a saber de qual formulário veio um possível erro --}}
            <input
                type="hidden"
                name="form_origem"
                value="novo"
            >



            {{-- cabeçalho --}}
            <div class="modal-header">

                <h5
                    class="modal-title"
                    id="modalNovoRelatorioLabel"
                >
                    Novo Relatório
                </h5>


                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>



            {{-- corpo com scroll --}}
            <div class="modal-body">


                {{-- ======================================================== --}}
                {{-- DADOS DO ATENDIMENTO --}}
                {{-- ======================================================== --}}

                <h6 class="mb-3">
                    Dados do atendimento
                </h6>



                {{-- cliente --}}
                <div class="mb-3">

                    <label
                        for="id_cliente"
                        class="form-label"
                    >
                        Cliente responsável
                    </label>


                    <select
                        id="id_cliente"
                        name="id_cliente"
                        class="form-select"
                        required
                    >

                        <option value="">
                            Selecione o cliente
                        </option>


                        @foreach ($clientes as $cliente)

                            <option
                                value="{{ $cliente->id_cliente }}"
                                @selected(
                                    old('id_cliente') == $cliente->id_cliente
                                )
                            >

                                {{ $cliente->nome_cliente }}

                            </option>

                        @endforeach

                    </select>

                </div>



                {{-- idoso --}}
                <div class="mb-3">

                    <label
                        for="id_idoso"
                        class="form-label"
                    >
                        Idoso
                    </label>


                    <select
                        id="id_idoso"
                        name="id_idoso"
                        class="form-select"
                        required
                    >

                        <option value="">
                            Selecione o idoso
                        </option>


                        @foreach ($idosos as $idoso)

                            <option
                                value="{{ $idoso->id_idoso }}"
                                @selected(
                                    old('id_idoso') == $idoso->id_idoso
                                )
                            >

                                {{ $idoso->nome_idoso }}

                            </option>

                        @endforeach

                    </select>

                </div>



                {{-- tipo --}}
                <div class="mb-3">

                    <label
                        for="tipo_atendimento_relatorio_vania"
                        class="form-label"
                    >
                        Tipo de atendimento
                    </label>


                    <input
                        type="text"
                        id="tipo_atendimento_relatorio_vania"
                        name="tipo_atendimento_relatorio_vania"
                        class="form-control"
                        value="{{ old('tipo_atendimento_relatorio_vania') }}"
                        placeholder="Ex: acompanhamento domiciliar"
                        maxlength="75"
                        required
                    >

                </div>



                <div class="row">


                    {{-- data --}}
                    <div class="col-12 col-md-6 mb-3">

                        <label
                            for="data_relatorio_vania"
                            class="form-label"
                        >
                            Data
                        </label>


                        <input
                            type="date"
                            id="data_relatorio_vania"
                            name="data_relatorio_vania"
                            class="form-control"
                            value="{{ old('data_relatorio_vania') }}"
                            required
                        >

                    </div>



                    {{-- início --}}
                    <div class="col-12 col-md-6 mb-3">

                        <label
                            for="horario_relatorio_vania"
                            class="form-label"
                        >
                            Horário de início
                        </label>


                        <input
                            type="time"
                            id="horario_relatorio_vania"
                            name="horario_relatorio_vania"
                            class="form-control"
                            value="{{ old('horario_relatorio_vania') }}"
                            required
                        >

                    </div>



                    {{-- fim --}}
                    <div class="col-12 mb-3">

                        <label
                            for="horario_fim_relatorio_vania"
                            class="form-label"
                        >
                            Horário de término
                        </label>


                        <input
                            type="time"
                            id="horario_fim_relatorio_vania"
                            name="horario_fim_relatorio_vania"
                            class="form-control"
                            value="{{ old('horario_fim_relatorio_vania') }}"
                        >

                    </div>

                </div>



                <hr class="my-4">



                {{-- ======================================================== --}}
                {{-- CUIDADOS --}}
                {{-- ======================================================== --}}

                <h6 class="mb-1">
                    Cuidados realizados
                </h6>

                <p class="text-muted small mb-3">
                    Marque somente oq foi feito durante o atendimento.
                </p>



                <div class="form-check mb-2">

                    <input
                        type="checkbox"
                        id="medicacao_relatorio_vania"
                        name="medicacao_relatorio_vania"
                        class="form-check-input"
                        value="1"
                        @checked(old('medicacao_relatorio_vania'))
                    >

                    <label
                        for="medicacao_relatorio_vania"
                        class="form-check-label"
                    >
                        Medicação
                    </label>

                </div>



                <div class="form-check mb-2">

                    <input
                        type="checkbox"
                        id="alimentacao_relatorio_vania"
                        name="alimentacao_relatorio_vania"
                        class="form-check-input"
                        value="1"
                        @checked(old('alimentacao_relatorio_vania'))
                    >

                    <label
                        for="alimentacao_relatorio_vania"
                        class="form-check-label"
                    >
                        Alimentação
                    </label>

                </div>



                <div class="form-check mb-2">

                    <input
                        type="checkbox"
                        id="hidratacao_relatorio_vania"
                        name="hidratacao_relatorio_vania"
                        class="form-check-input"
                        value="1"
                        @checked(old('hidratacao_relatorio_vania'))
                    >

                    <label
                        for="hidratacao_relatorio_vania"
                        class="form-check-label"
                    >
                        Hidratação
                    </label>

                </div>



                <div class="form-check mb-2">

                    <input
                        type="checkbox"
                        id="higiene_relatorio_vania"
                        name="higiene_relatorio_vania"
                        class="form-check-input"
                        value="1"
                        @checked(old('higiene_relatorio_vania'))
                    >

                    <label
                        for="higiene_relatorio_vania"
                        class="form-check-label"
                    >
                        Higiene
                    </label>

                </div>



                <div class="form-check mb-2">

                    <input
                        type="checkbox"
                        id="sono_relatorio_vania"
                        name="sono_relatorio_vania"
                        class="form-check-input"
                        value="1"
                        @checked(old('sono_relatorio_vania'))
                    >

                    <label
                        for="sono_relatorio_vania"
                        class="form-check-label"
                    >
                        Sono / descanso
                    </label>

                </div>



                <div class="form-check mb-2">

                    <input
                        type="checkbox"
                        id="atividade_relatorio_vania"
                        name="atividade_relatorio_vania"
                        class="form-check-input"
                        value="1"
                        @checked(old('atividade_relatorio_vania'))
                    >

                    <label
                        for="atividade_relatorio_vania"
                        class="form-check-label"
                    >
                        Caminhada / atividade
                    </label>

                </div>



                <div class="form-check mb-2">

                    <input
                        type="checkbox"
                        id="companhia_relatorio_vania"
                        name="companhia_relatorio_vania"
                        class="form-check-input"
                        value="1"
                        @checked(old('companhia_relatorio_vania'))
                    >

                    <label
                        for="companhia_relatorio_vania"
                        class="form-check-label"
                    >
                        Companhia / conversa
                    </label>

                </div>



                <div class="form-check mb-2">

                    <input
                        type="checkbox"
                        id="consulta_relatorio_vania"
                        name="consulta_relatorio_vania"
                        class="form-check-input"
                        value="1"
                        @checked(old('consulta_relatorio_vania'))
                    >

                    <label
                        for="consulta_relatorio_vania"
                        class="form-check-label"
                    >
                        Acompanhamento em consulta
                    </label>

                </div>



                <hr class="my-4">



                {{-- ======================================================== --}}
                {{-- CONDIÇÃO DO IDOSO --}}
                {{-- ======================================================== --}}

                <h6 class="mb-3">
                    Como o idoso estava
                </h6>



                {{-- humor --}}
                <div class="mb-3">

                    <label
                        for="humor_relatorio_vania"
                        class="form-label"
                    >
                        Humor
                    </label>


                    <select
                        id="humor_relatorio_vania"
                        name="humor_relatorio_vania"
                        class="form-select"
                    >

                        <option value="">Selecione</option>

                        <option value="BEM">
                            Bem
                        </option>

                        <option value="TRANQUILO">
                            Tranquilo
                        </option>

                        <option value="AGITADO">
                            Agitado
                        </option>

                        <option value="TRISTE">
                            Triste
                        </option>

                    </select>

                </div>



                {{-- apetite --}}
                <div class="mb-3">

                    <label
                        for="apetite_relatorio_vania"
                        class="form-label"
                    >
                        Apetite
                    </label>


                    <select
                        id="apetite_relatorio_vania"
                        name="apetite_relatorio_vania"
                        class="form-select"
                    >

                        <option value="">Selecione</option>
                        <option value="BOM">Bom</option>
                        <option value="REGULAR">Regular</option>
                        <option value="BAIXO">Baixo</option>

                    </select>

                </div>



                {{-- mobilidade --}}
                <div class="mb-3">

                    <label
                        for="mobilidade_relatorio_vania"
                        class="form-label"
                    >
                        Mobilidade
                    </label>


                    <select
                        id="mobilidade_relatorio_vania"
                        name="mobilidade_relatorio_vania"
                        class="form-select"
                    >

                        <option value="">Selecione</option>
                        <option value="NORMAL">Normal</option>
                        <option value="COM_AJUDA">Com ajuda</option>
                        <option value="LIMITADA">Limitada</option>

                    </select>

                </div>



                {{-- comunicação --}}
                <div class="mb-3">

                    <label
                        for="comunicacao_relatorio_vania"
                        class="form-label"
                    >
                        Comunicação
                    </label>


                    <select
                        id="comunicacao_relatorio_vania"
                        name="comunicacao_relatorio_vania"
                        class="form-select"
                    >

                        <option value="">Selecione</option>
                        <option value="NORMAL">Normal</option>
                        <option value="POUCA">Pouca</option>
                        <option value="DIFICULDADE">Com dificuldade</option>

                    </select>

                </div>



                {{-- dor --}}
                <div class="mb-3">

                    <label
                        for="dor_relatorio_vania"
                        class="form-label"
                    >
                        Dor ou desconforto
                    </label>


                    <select
                        id="dor_relatorio_vania"
                        name="dor_relatorio_vania"
                        class="form-select"
                    >

                        <option value="">Selecione</option>
                        <option value="NAO">Não</option>
                        <option value="LEVE">Leve</option>
                        <option value="MODERADA">Moderada</option>
                        <option value="FORTE">Forte</option>

                    </select>

                </div>



                {{-- sinais --}}
                <div class="mb-3">

                    <label
                        for="sinais_relatorio_vania"
                        class="form-label"
                    >
                        Sinais observados
                    </label>


                    <textarea
                        id="sinais_relatorio_vania"
                        name="sinais_relatorio_vania"
                        class="form-control"
                        rows="2"
                    >{{ old('sinais_relatorio_vania') }}</textarea>

                </div>



                <hr class="my-4">



                {{-- ======================================================== --}}
                {{-- RESUMO --}}
                {{-- ======================================================== --}}

                <h6 class="mb-3">
                    Resumo do atendimento
                </h6>



                <div class="mb-3">

                    <label
                        for="texto_relatorio_vania"
                        class="form-label"
                    >
                        Resumo do dia
                    </label>


                    <textarea
                        id="texto_relatorio_vania"
                        name="texto_relatorio_vania"
                        class="form-control"
                        rows="4"
                        required
                    >{{ old('texto_relatorio_vania') }}</textarea>

                </div>



                <div class="mb-3">

                    <label
                        for="observacoes_relatorio_vania"
                        class="form-label"
                    >
                        Observações
                    </label>


                    <textarea
                        id="observacoes_relatorio_vania"
                        name="observacoes_relatorio_vania"
                        class="form-control"
                        rows="3"
                    >{{ old('observacoes_relatorio_vania') }}</textarea>

                </div>



                <div class="mb-3">

                    <label
                        for="recomendacoes_relatorio_vania"
                        class="form-label"
                    >
                        Recomendações para a família
                    </label>


                    <textarea
                        id="recomendacoes_relatorio_vania"
                        name="recomendacoes_relatorio_vania"
                        class="form-control"
                        rows="3"
                    >{{ old('recomendacoes_relatorio_vania') }}</textarea>

                </div>



                <div class="mb-3">

                    <label
                        for="intercorrencias_relatorio_vania"
                        class="form-label"
                    >
                        Intercorrências
                    </label>


                    <textarea
                        id="intercorrencias_relatorio_vania"
                        name="intercorrencias_relatorio_vania"
                        class="form-control"
                        rows="3"
                    >{{ old('intercorrencias_relatorio_vania') }}</textarea>

                </div>

            </div>



            {{-- botões --}}
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

                    <i class="bi bi-floppy me-1"></i>

                    Salvar relatório

                </button>

            </div>

        </form>

    </div>

</div>



{{-- ================================================================ --}}
{{-- MODAL EDITAR RELATÓRIO --}}
{{-- ================================================================ --}}

<div
    class="modal fade"
    id="modalEditarRelatorio"
    tabindex="-1"
    aria-labelledby="modalEditarRelatorioLabel"
    aria-hidden="true"
>

    {{-- usa o msm scroll do modal de novo --}}
    <div class="modal-dialog modal-dialog-scrollable">


        {{--
            Alteração da Gabriele -
            o action vai ser colocado pelo JS quando clicar no lápis.
        --}}
        <form
            id="formEditarRelatorio"
            class="modal-content"
            method="POST"
        >

            @csrf
            @method('PUT')


            {{-- guarda o id caso a gente precise depois --}}
            <input
                type="hidden"
                id="edit_id_relatorio"
                name="id_relatorio_edicao"
            >


            <input
                type="hidden"
                name="form_origem"
                value="editar"
            >



            {{-- cabeçalho --}}
            <div class="modal-header">

                <h5
                    class="modal-title"
                    id="modalEditarRelatorioLabel"
                >
                    Editar Relatório
                </h5>


                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>



            {{-- corpo com scroll --}}
            <div class="modal-body">


                {{-- ======================================================== --}}
                {{-- DADOS DO ATENDIMENTO --}}
                {{-- ======================================================== --}}

                <h6 class="mb-3">
                    Dados do atendimento
                </h6>



                {{-- cliente --}}
                <div class="mb-3">

                    <label
                        for="edit_id_cliente"
                        class="form-label"
                    >
                        Cliente responsável
                    </label>


                    <select
                        id="edit_id_cliente"
                        name="id_cliente"
                        class="form-select"
                        required
                    >

                        <option value="">
                            Selecione o cliente
                        </option>


                        @foreach ($clientes as $cliente)

                            <option value="{{ $cliente->id_cliente }}">

                                {{ $cliente->nome_cliente }}

                            </option>

                        @endforeach

                    </select>

                </div>



                {{-- idoso --}}
                <div class="mb-3">

                    <label
                        for="edit_id_idoso"
                        class="form-label"
                    >
                        Idoso
                    </label>


                    <select
                        id="edit_id_idoso"
                        name="id_idoso"
                        class="form-select"
                        required
                    >

                        <option value="">
                            Selecione o idoso
                        </option>


                        @foreach ($idosos as $idoso)

                            <option value="{{ $idoso->id_idoso }}">

                                {{ $idoso->nome_idoso }}

                            </option>

                        @endforeach

                    </select>

                </div>



                {{-- tipo --}}
                <div class="mb-3">

                    <label
                        for="edit_tipo_atendimento"
                        class="form-label"
                    >
                        Tipo de atendimento
                    </label>


                    <input
                        type="text"
                        id="edit_tipo_atendimento"
                        name="tipo_atendimento_relatorio_vania"
                        class="form-control"
                        maxlength="75"
                        required
                    >

                </div>



                <div class="row">


                    {{-- data --}}
                    <div class="col-12 col-md-6 mb-3">

                        <label
                            for="edit_data_relatorio"
                            class="form-label"
                        >
                            Data
                        </label>


                        <input
                            type="date"
                            id="edit_data_relatorio"
                            name="data_relatorio_vania"
                            class="form-control"
                            required
                        >

                    </div>



                    {{-- início --}}
                    <div class="col-12 col-md-6 mb-3">

                        <label
                            for="edit_horario_relatorio"
                            class="form-label"
                        >
                            Horário de início
                        </label>


                        <input
                            type="time"
                            id="edit_horario_relatorio"
                            name="horario_relatorio_vania"
                            class="form-control"
                            required
                        >

                    </div>



                    {{-- fim --}}
                    <div class="col-12 mb-3">

                        <label
                            for="edit_horario_fim"
                            class="form-label"
                        >
                            Horário de término
                        </label>


                        <input
                            type="time"
                            id="edit_horario_fim"
                            name="horario_fim_relatorio_vania"
                            class="form-control"
                        >

                    </div>

                </div>



                <hr class="my-4">



                {{-- ======================================================== --}}
                {{-- CUIDADOS --}}
                {{-- ======================================================== --}}

                <h6 class="mb-1">
                    Cuidados realizados
                </h6>

                <p class="text-muted small mb-3">
                    Marque somente oq foi feito durante o atendimento.
                </p>



                <div class="form-check mb-2">

                    <input
                        type="checkbox"
                        id="edit_medicacao"
                        name="medicacao_relatorio_vania"
                        class="form-check-input"
                        value="1"
                    >

                    <label
                        for="edit_medicacao"
                        class="form-check-label"
                    >
                        Medicação
                    </label>

                </div>



                <div class="form-check mb-2">

                    <input
                        type="checkbox"
                        id="edit_alimentacao"
                        name="alimentacao_relatorio_vania"
                        class="form-check-input"
                        value="1"
                    >

                    <label
                        for="edit_alimentacao"
                        class="form-check-label"
                    >
                        Alimentação
                    </label>

                </div>



                <div class="form-check mb-2">

                    <input
                        type="checkbox"
                        id="edit_hidratacao"
                        name="hidratacao_relatorio_vania"
                        class="form-check-input"
                        value="1"
                    >

                    <label
                        for="edit_hidratacao"
                        class="form-check-label"
                    >
                        Hidratação
                    </label>

                </div>



                <div class="form-check mb-2">

                    <input
                        type="checkbox"
                        id="edit_higiene"
                        name="higiene_relatorio_vania"
                        class="form-check-input"
                        value="1"
                    >

                    <label
                        for="edit_higiene"
                        class="form-check-label"
                    >
                        Higiene
                    </label>

                </div>



                <div class="form-check mb-2">

                    <input
                        type="checkbox"
                        id="edit_sono"
                        name="sono_relatorio_vania"
                        class="form-check-input"
                        value="1"
                    >

                    <label
                        for="edit_sono"
                        class="form-check-label"
                    >
                        Sono / descanso
                    </label>

                </div>



                <div class="form-check mb-2">

                    <input
                        type="checkbox"
                        id="edit_atividade"
                        name="atividade_relatorio_vania"
                        class="form-check-input"
                        value="1"
                    >

                    <label
                        for="edit_atividade"
                        class="form-check-label"
                    >
                        Caminhada / atividade
                    </label>

                </div>



                <div class="form-check mb-2">

                    <input
                        type="checkbox"
                        id="edit_companhia"
                        name="companhia_relatorio_vania"
                        class="form-check-input"
                        value="1"
                    >

                    <label
                        for="edit_companhia"
                        class="form-check-label"
                    >
                        Companhia / conversa
                    </label>

                </div>



                <div class="form-check mb-2">

                    <input
                        type="checkbox"
                        id="edit_consulta"
                        name="consulta_relatorio_vania"
                        class="form-check-input"
                        value="1"
                    >

                    <label
                        for="edit_consulta"
                        class="form-check-label"
                    >
                        Acompanhamento em consulta
                    </label>

                </div>



                <hr class="my-4">



                {{-- ======================================================== --}}
                {{-- CONDIÇÃO DO IDOSO --}}
                {{-- ======================================================== --}}

                <h6 class="mb-3">
                    Como o idoso estava
                </h6>



                {{-- humor --}}
                <div class="mb-3">

                    <label
                        for="edit_humor"
                        class="form-label"
                    >
                        Humor
                    </label>


                    <select
                        id="edit_humor"
                        name="humor_relatorio_vania"
                        class="form-select"
                    >

                        <option value="">Selecione</option>
                        <option value="BEM">Bem</option>
                        <option value="TRANQUILO">Tranquilo</option>
                        <option value="AGITADO">Agitado</option>
                        <option value="TRISTE">Triste</option>

                    </select>

                </div>



                {{-- apetite --}}
                <div class="mb-3">

                    <label
                        for="edit_apetite"
                        class="form-label"
                    >
                        Apetite
                    </label>


                    <select
                        id="edit_apetite"
                        name="apetite_relatorio_vania"
                        class="form-select"
                    >

                        <option value="">Selecione</option>
                        <option value="BOM">Bom</option>
                        <option value="REGULAR">Regular</option>
                        <option value="BAIXO">Baixo</option>

                    </select>

                </div>



                {{-- mobilidade --}}
                <div class="mb-3">

                    <label
                        for="edit_mobilidade"
                        class="form-label"
                    >
                        Mobilidade
                    </label>


                    <select
                        id="edit_mobilidade"
                        name="mobilidade_relatorio_vania"
                        class="form-select"
                    >

                        <option value="">Selecione</option>
                        <option value="NORMAL">Normal</option>
                        <option value="COM_AJUDA">Com ajuda</option>
                        <option value="LIMITADA">Limitada</option>

                    </select>

                </div>



                {{-- comunicação --}}
                <div class="mb-3">

                    <label
                        for="edit_comunicacao"
                        class="form-label"
                    >
                        Comunicação
                    </label>


                    <select
                        id="edit_comunicacao"
                        name="comunicacao_relatorio_vania"
                        class="form-select"
                    >

                        <option value="">Selecione</option>
                        <option value="NORMAL">Normal</option>
                        <option value="POUCA">Pouca</option>
                        <option value="DIFICULDADE">Com dificuldade</option>

                    </select>

                </div>



                {{-- dor --}}
                <div class="mb-3">

                    <label
                        for="edit_dor"
                        class="form-label"
                    >
                        Dor ou desconforto
                    </label>


                    <select
                        id="edit_dor"
                        name="dor_relatorio_vania"
                        class="form-select"
                    >

                        <option value="">Selecione</option>
                        <option value="NAO">Não</option>
                        <option value="LEVE">Leve</option>
                        <option value="MODERADA">Moderada</option>
                        <option value="FORTE">Forte</option>

                    </select>

                </div>



                {{-- sinais --}}
                <div class="mb-3">

                    <label
                        for="edit_sinais"
                        class="form-label"
                    >
                        Sinais observados
                    </label>


                    <textarea
                        id="edit_sinais"
                        name="sinais_relatorio_vania"
                        class="form-control"
                        rows="2"
                    ></textarea>

                </div>



                <hr class="my-4">



                {{-- ======================================================== --}}
                {{-- RESUMO --}}
                {{-- ======================================================== --}}

                <h6 class="mb-3">
                    Resumo do atendimento
                </h6>



                <div class="mb-3">

                    <label
                        for="edit_texto_relatorio"
                        class="form-label"
                    >
                        Resumo do dia
                    </label>


                    <textarea
                        id="edit_texto_relatorio"
                        name="texto_relatorio_vania"
                        class="form-control"
                        rows="4"
                        required
                    ></textarea>

                </div>



                <div class="mb-3">

                    <label
                        for="edit_observacoes"
                        class="form-label"
                    >
                        Observações
                    </label>


                    <textarea
                        id="edit_observacoes"
                        name="observacoes_relatorio_vania"
                        class="form-control"
                        rows="3"
                    ></textarea>

                </div>



                <div class="mb-3">

                    <label
                        for="edit_recomendacoes"
                        class="form-label"
                    >
                        Recomendações para a família
                    </label>


                    <textarea
                        id="edit_recomendacoes"
                        name="recomendacoes_relatorio_vania"
                        class="form-control"
                        rows="3"
                    ></textarea>

                </div>



                <div class="mb-3">

                    <label
                        for="edit_intercorrencias"
                        class="form-label"
                    >
                        Intercorrências
                    </label>


                    <textarea
                        id="edit_intercorrencias"
                        name="intercorrencias_relatorio_vania"
                        class="form-control"
                        rows="3"
                    ></textarea>

                </div>

            </div>



            {{-- botões --}}
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

                    <i class="bi bi-floppy me-1"></i>

                    Salvar alterações

                </button>

            </div>

        </form>

    </div>

</div>



{{-- ================================================================ --}}
{{-- JAVASCRIPT DOS RELATÓRIOS --}}
{{-- ================================================================ --}}

<script>

    /*
     * Alteração da Gabriele -
     * traz os relatórios do Laravel pro JavaScript.
     *
     * Assim conseguimos preencher o modal de editar
     * sem precisar criar outra página.
     */
    const relatoriosDados = @json($relatorios);


    /*
     * Alteração da Gabriele -
     * procura um relatório pelo id.
     */
    function buscarRelatorio(id) {

        return relatoriosDados.find(function (relatorio) {

            return String(relatorio.id_relatorio_vania) === String(id);

        });

    }



    /*
     * Função pequena só pra facilitar o preenchimento
     * dos campos de texto e select.
     */
    function colocarValor(idCampo, valor) {

        const campo = document.getElementById(idCampo);

        if (campo) {

            campo.value = valor ?? '';

        }

    }



    /*
     * Alteração da Gabriele -
     * recebe true/false ou 1/0 do banco
     * e marca o checkbox certo.
     */
    function marcarCheckbox(idCampo, valor) {

        const campo = document.getElementById(idCampo);

        if (campo) {

            campo.checked = Number(valor) === 1;

        }

    }



    /*
     * Alteração da Gabriele -
     * quando clicar no lápis buscamos o relatório
     * e colocamos os dados dentro do modal.
     */
    document
        .querySelectorAll('.btn-editar-relatorio')
        .forEach(function (botao) {

            botao.addEventListener(
                'click',
                function () {

                    // pega o id que está no botão
                    const idRelatorio =
                        botao.dataset.id;


                    // busca os dados desse relatório
                    const relatorio =
                        buscarRelatorio(idRelatorio);


                    // evita erro caso não encontre
                    if (!relatorio) {

                        return;

                    }


                    /*
                     * Coloca a rota certa no formulário.
                     *
                     * Ex:
                     * /admin/relatorios/1
                     */
                    document.getElementById(
                        'formEditarRelatorio'
                    ).action = botao.dataset.url;



                    // id
                    colocarValor(
                        'edit_id_relatorio',
                        relatorio.id_relatorio_vania
                    );


                    // cliente
                    colocarValor(
                        'edit_id_cliente',
                        relatorio.id_cliente
                    );


                    // idoso
                    colocarValor(
                        'edit_id_idoso',
                        relatorio.id_idoso
                    );


                    // tipo do atendimento
                    colocarValor(
                        'edit_tipo_atendimento',
                        relatorio.tipo_atendimento_relatorio_vania
                    );


                    // data
                    colocarValor(
                        'edit_data_relatorio',
                        relatorio.data_relatorio_vania
                    );


                    /*
                     * O banco pode devolver 08:00:00.
                     * O input time fica mais simples usando 08:00.
                     */
                    colocarValor(
                        'edit_horario_relatorio',
                        relatorio.horario_relatorio_vania
                            ? relatorio.horario_relatorio_vania.substring(0, 5)
                            : ''
                    );


                    // horário final
                    colocarValor(
                        'edit_horario_fim',
                        relatorio.horario_fim_relatorio_vania
                            ? relatorio.horario_fim_relatorio_vania.substring(0, 5)
                            : ''
                    );



                    // checkboxes
                    marcarCheckbox(
                        'edit_medicacao',
                        relatorio.medicacao_relatorio_vania
                    );

                    marcarCheckbox(
                        'edit_alimentacao',
                        relatorio.alimentacao_relatorio_vania
                    );

                    marcarCheckbox(
                        'edit_hidratacao',
                        relatorio.hidratacao_relatorio_vania
                    );

                    marcarCheckbox(
                        'edit_higiene',
                        relatorio.higiene_relatorio_vania
                    );

                    marcarCheckbox(
                        'edit_sono',
                        relatorio.sono_relatorio_vania
                    );

                    marcarCheckbox(
                        'edit_atividade',
                        relatorio.atividade_relatorio_vania
                    );

                    marcarCheckbox(
                        'edit_companhia',
                        relatorio.companhia_relatorio_vania
                    );

                    marcarCheckbox(
                        'edit_consulta',
                        relatorio.consulta_relatorio_vania
                    );



                    // condição do idoso
                    colocarValor(
                        'edit_humor',
                        relatorio.humor_relatorio_vania
                    );

                    colocarValor(
                        'edit_apetite',
                        relatorio.apetite_relatorio_vania
                    );

                    colocarValor(
                        'edit_mobilidade',
                        relatorio.mobilidade_relatorio_vania
                    );

                    colocarValor(
                        'edit_comunicacao',
                        relatorio.comunicacao_relatorio_vania
                    );

                    colocarValor(
                        'edit_dor',
                        relatorio.dor_relatorio_vania
                    );

                    colocarValor(
                        'edit_sinais',
                        relatorio.sinais_relatorio_vania
                    );



                    // textos finais
                    colocarValor(
                        'edit_texto_relatorio',
                        relatorio.texto_relatorio_vania
                    );

                    colocarValor(
                        'edit_observacoes',
                        relatorio.observacoes_relatorio_vania
                    );

                    colocarValor(
                        'edit_recomendacoes',
                        relatorio.recomendacoes_relatorio_vania
                    );

                    colocarValor(
                        'edit_intercorrencias',
                        relatorio.intercorrencias_relatorio_vania
                    );

                }
            );

        });



    {{-- ============================================================ --}}
    {{-- PESQUISA E FILTRO --}}
    {{-- ============================================================ --}}

    const relatorioSearch =
        document.getElementById('relatorio-search');

    const relatorioStatusFilter =
        document.getElementById('relatorio-status-filter');

    const relatorioSemResultado =
        document.getElementById('relatorio-sem-resultado');


    /*
     * pesquisa e filtro usam a msm função
     * pq os dois mexem nas mesmas linhas
     */
    function filtrarRelatorios() {

        const pesquisa =
            relatorioSearch.value.toLowerCase();

        const status =
            relatorioStatusFilter.value;

        const linhas =
            document.querySelectorAll('.relatorio-row');

        let encontrados = 0;


        linhas.forEach(function (linha) {

            const dadosPesquisa =
                linha.dataset.pesquisa;

            const statusRelatorio =
                linha.dataset.status;


            const passouPesquisa =
                dadosPesquisa.includes(pesquisa);


            const passouStatus =
                status === 'all'
                || statusRelatorio === status;


            if (passouPesquisa && passouStatus) {

                linha.classList.remove('d-none');

                encontrados++;

            } else {

                linha.classList.add('d-none');

            }

        });


        // mostra mensagem se não achar nada
        if (encontrados === 0 && linhas.length > 0) {

            relatorioSemResultado.classList.remove('d-none');

        } else {

            relatorioSemResultado.classList.add('d-none');

        }

    }


    // pesquisa enquanto digita
    relatorioSearch.addEventListener(
        'input',
        filtrarRelatorios
    );


    // filtra quando muda o status
    relatorioStatusFilter.addEventListener(
        'change',
        filtrarRelatorios
    );

</script>



{{-- ================================================================ --}}
{{-- ABRE O MODAL NOVAMENTE SE O NOVO RELATÓRIO DER ERRO --}}
{{-- ================================================================ --}}

@if ($errors->any() && old('form_origem') !== 'editar')

    <script>

        document.addEventListener(
            'DOMContentLoaded',
            function () {

                /*
                 * se der erro no cadastro,
                 * abre o modal de novo
                 */
                const modalNovoRelatorio =
                    new bootstrap.Modal(
                        document.getElementById('modalNovoRelatorio')
                    );


                modalNovoRelatorio.show();

            }
        );

    </script>

@endif



{{-- ================================================================ --}}
{{-- FECHA AS MENSAGENS DEPOIS DE 3 SEGUNDOS --}}
{{-- ================================================================ --}}

<script>

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            setTimeout(function () {

                // pega as mensagens abertas
                const alertas =
                    document.querySelectorAll('.alert');


                alertas.forEach(function (alerta) {

                    const alertaBootstrap =
                        bootstrap.Alert.getOrCreateInstance(alerta);


                    alertaBootstrap.close();

                });

            }, 3000);

        }
    );

</script>