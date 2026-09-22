{{-- Listagem administrativa dos serviços --}}
<section class="admin-list-page">

    <div class="app-content-header admin-page-header">

        <div class="container-fluid">

            <div class="row">

                <div class="col-sm-6">
                    <h1 class="mb-0 fs-3">Serviços</h1>
                </div>


                <div class="col-sm-6">

                    <nav aria-label="breadcrumb">

                        <ol class="breadcrumb float-sm-end">

                            <li class="breadcrumb-item">

                                <a href="{{ route('admin.dashboard') }}">
                                    Dashboard
                                </a>

                            </li>

                            <li
                                class="breadcrumb-item active"
                                aria-current="page"
                            >
                                Serviços
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
                                        Serviços cadastrados
                                    </h3>

                                </div>


                                <div class="col-12 col-md-8">

                                    <div class="d-flex flex-wrap justify-content-md-end gap-2">


                                        {{-- Alteração da Gabriele - pesquisa --}}
                                        <div class="input-group input-group-sm w-auto">

                                            <span class="input-group-text">

                                                <i
                                                    class="bi bi-search"
                                                    aria-hidden="true"
                                                ></i>

                                            </span>


                                            <input
                                                type="search"
                                                id="servico-search"
                                                class="form-control admin-search-input"
                                                placeholder="Pesquisar serviços"
                                                aria-label="Pesquisar serviços"
                                            >

                                        </div>


                                        {{-- Alteração da Gabriele - filtro por status --}}
                                        <select
                                            id="servico-status-filter"
                                            class="form-select form-select-sm w-auto"
                                            aria-label="Filtrar por status"
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


                                        {{-- Alteração da Gabriele - abre modal de cadastro --}}
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalNovoServico"
                                        >

                                            <i class="bi bi-plus-lg me-1"></i>

                                            Novo Serviço

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
                                            <th>Imagem</th>
                                            <th>Título</th>
                                            <th>Subtítulo</th>
                                            <th>Descrição</th>
                                            <th>Status</th>
                                            <th class="text-end">Ações</th>

                                        </tr>

                                    </thead>


                                    <tbody>


                                        @forelse ($servicos as $servico)

                                            {{-- Alteração da Gabriele - dados usados na pesquisa e filtro --}}
                                            <tr
                                                class="servico-row"
                                                data-pesquisa="{{ strtolower(
                                                    $servico->titulo_servico_ancora . ' ' .
                                                    $servico->subtitulo_servico_ancora . ' ' .
                                                    $servico->texto_servico_ancora
                                                ) }}"
                                                data-status="{{ $servico->status_servico_ancora }}"
                                            >


                                                <td>
                                                    {{ $servico->id_servico_ancora }}
                                                </td>


                                                <td>

                                                    @if ($servico->img_servico_ancora)

                                                        <img
                                                            src="{{ asset('vs-cuidadora/assets/' . $servico->img_servico_ancora) }}"
                                                            alt="{{ $servico->titulo_servico_ancora }}"
                                                            class="rounded admin-table-thumbnail"
                                                        >

                                                    @else

                                                        <span class="text-muted">
                                                            Sem imagem
                                                        </span>

                                                    @endif

                                                </td>


                                                <td>

                                                    <span class="admin-record-label">

                                                        {{ $servico->titulo_servico_ancora }}

                                                    </span>

                                                </td>


                                                <td>

                                                    {{ $servico->subtitulo_servico_ancora }}

                                                </td>


                                                <td>

                                                    {{ Str::limit($servico->texto_servico_ancora, 80) }}

                                                </td>


                                                <td>

                                                    @if ($servico->status_servico_ancora === 'ATIVO')

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


                                                        {{-- Alteração da Gabriele - editar serviço --}}
                                                        <button
                                                            type="button"
                                                            class="btn btn-outline-secondary btn-editar-servico"
                                                            title="Editar serviço"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalEditarServico"

                                                            data-id="{{ $servico->id_servico_ancora }}"

                                                            data-titulo="{{ $servico->titulo_servico_ancora }}"

                                                            data-subtitulo="{{ $servico->subtitulo_servico_ancora }}"

                                                            data-texto="{{ $servico->texto_servico_ancora }}"

                                                            data-imagem="{{ asset('vs-cuidadora/assets/' . $servico->img_servico_ancora) }}"

                                                            data-status="{{ $servico->status_servico_ancora }}"
                                                        >

                                                            <i class="bi bi-pencil"></i>

                                                        </button>



                                                        {{-- Alteração da Gabriele - ativar ou desativar --}}
                                                        @if ($servico->status_servico_ancora === 'ATIVO')

                                                            <button
                                                                type="button"
                                                                class="btn btn-outline-danger btn-status-servico"
                                                                title="Desativar serviço"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modalStatusServico"

                                                                data-url="{{ route('admin.servico.status', $servico->id_servico_ancora) }}"

                                                                data-status="ATIVO"
                                                            >

                                                                <i class="bi bi-eye-fill"></i>

                                                            </button>

                                                        @else

                                                            <button
                                                                type="button"
                                                                class="btn btn-outline-success btn-status-servico"
                                                                title="Ativar serviço"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modalStatusServico"

                                                                data-url="{{ route('admin.servico.status', $servico->id_servico_ancora) }}"

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
                                                    colspan="7"
                                                    class="text-center py-4 text-muted"
                                                >
                                                    Nenhum serviço encontrado.
                                                </td>

                                            </tr>

                                        @endforelse


                                        {{-- Alteração da Gabriele - nenhum resultado da pesquisa --}}
                                        <tr
                                            id="servico-sem-resultado"
                                            class="d-none"
                                        >

                                            <td
                                                colspan="7"
                                                class="text-center py-4 text-muted"
                                            >
                                                Nenhum serviço encontrado.
                                            </td>

                                        </tr>


                                    </tbody>

                                </table>

                            </div>

                        </div>



                        <div class="card-footer clearfix">

                            <div class="float-start pt-1 fs-7 text-body-secondary">

                                Total de serviços:

                                <strong>
                                    {{ $servicos->count() }}
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



{{-- Alteração da Gabriele - modal para cadastrar novo serviço --}}
<div
    class="modal fade"
    id="modalNovoServico"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    Novo Serviço
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>


            <form
                action="{{ route('admin.servico.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf


                <div class="modal-body">


                    {{-- Alteração da Gabriele - título --}}
                    <div class="mb-3">

                        <label
                            for="titulo_servico_ancora"
                            class="form-label"
                        >
                            Título
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="titulo_servico_ancora"
                            name="titulo_servico_ancora"
                            maxlength="35"
                            required
                        >

                    </div>


                    {{-- Alteração da Gabriele - subtítulo --}}
                    <div class="mb-3">

                        <label
                            for="subtitulo_servico_ancora"
                            class="form-label"
                        >
                            Subtítulo
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="subtitulo_servico_ancora"
                            name="subtitulo_servico_ancora"
                            maxlength="80"
                        >

                    </div>


                    {{-- Alteração da Gabriele - descrição --}}
                    <div class="mb-3">

                        <label
                            for="texto_servico_ancora"
                            class="form-label"
                        >
                            Descrição
                        </label>

                        <textarea
                            class="form-control"
                            id="texto_servico_ancora"
                            name="texto_servico_ancora"
                            rows="4"
                        ></textarea>

                    </div>


                    {{-- Alteração da Gabriele - imagem --}}
                    <div class="mb-3">

                        <label
                            for="img_servico_ancora"
                            class="form-label"
                        >
                            Imagem
                        </label>

                        <input
                            type="file"
                            class="form-control"
                            id="img_servico_ancora"
                            name="img_servico_ancora"
                            accept=".jpg,.jpeg,.png,.webp"
                            required
                        >


                        {{-- Alteração da Gabriele - prévia --}}
                        <div class="mt-3 text-center">

                            <img
                                id="previewNovoServico"
                                src=""
                                alt="Prévia do serviço"
                                class="img-fluid rounded d-none"
                                style="max-height: 250px;"
                            >

                        </div>

                    </div>


                    {{-- Alteração da Gabriele - status --}}
                    <div class="mb-3">

                        <label
                            for="status_servico_ancora"
                            class="form-label"
                        >
                            Status
                        </label>

                        <select
                            class="form-select"
                            id="status_servico_ancora"
                            name="status_servico_ancora"
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



{{-- Alteração da Gabriele - modal único para editar serviço --}}
<div
    class="modal fade"
    id="modalEditarServico"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    Editar Serviço
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>


            <form
                id="formEditarServico"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf
                @method('PUT')


                <div class="modal-body">


                    <div class="mb-3">

                        <label class="form-label">
                            Título
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="editar_titulo_servico"
                            name="titulo_servico_ancora"
                            maxlength="35"
                            required
                        >

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Subtítulo
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="editar_subtitulo_servico"
                            name="subtitulo_servico_ancora"
                            maxlength="80"
                        >

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Descrição
                        </label>

                        <textarea
                            class="form-control"
                            id="editar_texto_servico"
                            name="texto_servico_ancora"
                            rows="4"
                        ></textarea>

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Imagem atual
                        </label>

                        <div class="text-center">

                            <img
                                id="editar_imagem_servico_atual"
                                src=""
                                alt="Imagem atual"
                                class="img-fluid rounded"
                                style="max-height: 250px;"
                            >

                        </div>

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Nova imagem
                        </label>

                        <input
                            type="file"
                            class="form-control"
                            id="editar_img_servico"
                            name="img_servico_ancora"
                            accept=".jpg,.jpeg,.png,.webp"
                        >

                        <small class="text-muted">
                            Deixe vazio para manter a imagem atual.
                        </small>

                    </div>


                    {{-- Alteração da Gabriele - prévia da nova imagem --}}
                    <div class="mb-3 text-center">

                        <img
                            id="previewEditarServico"
                            src=""
                            alt="Prévia"
                            class="img-fluid rounded d-none"
                            style="max-height: 250px;"
                        >

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Status
                        </label>

                        <select
                            class="form-select"
                            id="editar_status_servico"
                            name="status_servico_ancora"
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



{{-- Alteração da Gabriele - modal ativar/desativar serviço --}}
<div
    class="modal fade"
    id="modalStatusServico"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog">

        <form
            id="formStatusServico"
            method="POST"
        >

            @csrf
            @method('PATCH')


            <div class="modal-content">

                <div class="modal-header">

                    <h5
                        class="modal-title"
                        id="tituloModalStatusServico"
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
                        id="textoModalStatusServico"
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
                        id="btnConfirmarStatusServico"
                        class="btn"
                    >
                        Confirmar
                    </button>

                </div>

            </div>

        </form>

    </div>

</div>



{{-- Alteração da Gabriele - prévia da imagem no cadastro --}}
<script>

    document
        .getElementById('img_servico_ancora')
        .addEventListener('change', function() {

            const arquivo = this.files[0];

            const preview =
                document.getElementById('previewNovoServico');


            if (arquivo) {

                preview.src =
                    URL.createObjectURL(arquivo);

                preview.classList.remove('d-none');

            }

        });

</script>



{{-- Alteração da Gabriele - preenche o modal de edição --}}
<script>

    document
        .querySelectorAll('.btn-editar-servico')
        .forEach(function(botao) {

            botao.addEventListener('click', function() {

                const id =
                    this.dataset.id;

                const titulo =
                    this.dataset.titulo;

                const subtitulo =
                    this.dataset.subtitulo;

                const texto =
                    this.dataset.texto;

                const imagem =
                    this.dataset.imagem;

                const status =
                    this.dataset.status;


                document
                    .getElementById('editar_titulo_servico')
                    .value = titulo;


                document
                    .getElementById('editar_subtitulo_servico')
                    .value = subtitulo;


                document
                    .getElementById('editar_texto_servico')
                    .value = texto;


                document
                    .getElementById('editar_imagem_servico_atual')
                    .src = imagem;


                document
                    .getElementById('editar_status_servico')
                    .value = status;


                document
                    .getElementById('formEditarServico')
                    .action = '/admin/servicos/' + id;


                // Alteração da Gabriele - limpa nova imagem
                document
                    .getElementById('editar_img_servico')
                    .value = '';


                const preview =
                    document.getElementById('previewEditarServico');


                preview.src = '';

                preview.classList.add('d-none');

            });

        });



    // Alteração da Gabriele - prévia da nova imagem
    document
        .getElementById('editar_img_servico')
        .addEventListener('change', function() {

            const arquivo = this.files[0];

            const preview =
                document.getElementById('previewEditarServico');


            if (arquivo) {

                preview.src =
                    URL.createObjectURL(arquivo);

                preview.classList.remove('d-none');

            }

        });

</script>



{{-- Alteração da Gabriele - ativar ou desativar serviço --}}
<script>

    const modalStatusServico =
        document.getElementById('modalStatusServico');


    modalStatusServico.addEventListener(
        'show.bs.modal',
        function(event) {

            const botao =
                event.relatedTarget;


            const url =
                botao.dataset.url;

            const status =
                botao.dataset.status;


            const formulario =
                document.getElementById('formStatusServico');


            const titulo =
                document.getElementById('tituloModalStatusServico');


            const texto =
                document.getElementById('textoModalStatusServico');


            const botaoConfirmar =
                document.getElementById('btnConfirmarStatusServico');


            formulario.action = url;


            if (status === 'ATIVO') {

                titulo.textContent =
                    'Desativar Serviço';

                texto.textContent =
                    'Tem certeza que deseja desativar este serviço?';

                botaoConfirmar.textContent =
                    'Desativar';

                botaoConfirmar.className =
                    'btn btn-danger';

            } else {

                titulo.textContent =
                    'Ativar Serviço';

                texto.textContent =
                    'Tem certeza que deseja ativar este serviço?';

                botaoConfirmar.textContent =
                    'Ativar';

                botaoConfirmar.className =
                    'btn btn-success';

            }

        }
    );

</script>



{{-- Alteração da Gabriele - pesquisa e filtro --}}
<script>

    const campoPesquisaServico =
        document.getElementById('servico-search');


    const filtroStatusServico =
        document.getElementById('servico-status-filter');


    function filtrarServicos() {

        const pesquisa =
            campoPesquisaServico.value
                .toLowerCase()
                .trim();


        const statusSelecionado =
            filtroStatusServico.value;


        const linhas =
            document.querySelectorAll('.servico-row');


        let quantidadeVisivel = 0;


        linhas.forEach(function(linha) {

            const conteudo =
                linha.dataset.pesquisa;


            const status =
                linha.dataset.status;


            const encontrouPesquisa =
                conteudo.includes(pesquisa);


            const encontrouStatus =
                statusSelecionado === 'all'
                || status === statusSelecionado;


            if (encontrouPesquisa && encontrouStatus) {

                linha.classList.remove('d-none');

                quantidadeVisivel++;

            } else {

                linha.classList.add('d-none');

            }

        });


        const semResultado =
            document.getElementById('servico-sem-resultado');


        if (quantidadeVisivel === 0) {

            semResultado.classList.remove('d-none');

        } else {

            semResultado.classList.add('d-none');

        }

    }


    campoPesquisaServico.addEventListener(
        'input',
        filtrarServicos
    );


    filtroStatusServico.addEventListener(
        'change',
        filtrarServicos
    );

</script>



{{-- Alteração da Gabriele - remove mensagem automaticamente --}}
<script>

    document.addEventListener(
        'DOMContentLoaded',
        function() {

            setTimeout(function() {

                const alertas =
                    document.querySelectorAll('.alert');


                alertas.forEach(function(alerta) {

                    const alertaBootstrap =
                        bootstrap.Alert.getOrCreateInstance(alerta);

                    alertaBootstrap.close();

                });

            }, 3000);

        }
    );

</script>