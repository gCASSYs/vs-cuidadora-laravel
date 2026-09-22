{{-- Listagem administrativa dos banners --}}
<section class="admin-list-page">

    <div class="app-content-header admin-page-header">

        <div class="container-fluid">

            <div class="row">

                <div class="col-sm-6">
                    <h1 class="mb-0 fs-3">Banners</h1>
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
                                Banners
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
                                        Banners cadastrados
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
                                                id="banner-search"
                                                class="form-control admin-search-input"
                                                placeholder="Pesquisar banners"
                                                aria-label="Pesquisar banners"
                                            >

                                        </div>


                                        {{-- Alteração da Gabriele - filtro por status --}}
                                        <select
                                            id="banner-status-filter"
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


                                        {{-- Alteração da Gabriele - botão novo banner --}}
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalNovoBanner"
                                        >

                                            <i class="bi bi-plus-lg me-1"></i>

                                            Novo Banner

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
                                            <th>Status</th>
                                            <th class="text-end">Ações</th>

                                        </tr>

                                    </thead>


                                    <tbody id="banner-table-body">


                                        @forelse ($banners as $banner)

                                            {{-- Alteração da Gabriele - dados usados na pesquisa e filtro --}}
                                            <tr
                                                class="banner-row"
                                                data-titulo="{{ strtolower($banner->titulo_banner) }}"
                                                data-status="{{ $banner->status_banner }}"
                                            >


                                                <td>
                                                    {{ $banner->id_banner }}
                                                </td>


                                                <td>

                                                    @if ($banner->img_banner)

                                                        <img
                                                            src="{{ asset('vs-cuidadora/assets/' . $banner->img_banner) }}"
                                                            alt="{{ $banner->titulo_banner }}"
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
                                                        {{ $banner->titulo_banner }}
                                                    </span>

                                                </td>


                                                <td>

                                                    @if ($banner->status_banner === 'ATIVO')

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


                                                        {{-- Alteração da Gabriele - editar banner --}}
                                                        <button
                                                            type="button"
                                                            class="btn btn-outline-secondary btn-editar-banner"
                                                            title="Editar banner"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalEditarBanner"

                                                            data-id="{{ $banner->id_banner }}"

                                                            data-titulo="{{ $banner->titulo_banner }}"

                                                            data-imagem="{{ asset('vs-cuidadora/assets/' . $banner->img_banner) }}"

                                                            data-status="{{ $banner->status_banner }}"
                                                        >

                                                            <i class="bi bi-pencil"></i>

                                                        </button>



                                                        {{-- Alteração da Gabriele - ativar ou desativar banner --}}
                                                        @if ($banner->status_banner === 'ATIVO')

                                                            <button
                                                                type="button"
                                                                class="btn btn-outline-danger btn-status-banner"
                                                                title="Desativar banner"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modalStatusBanner"

                                                                data-url="{{ route('admin.banner.status', $banner->id_banner) }}"

                                                                data-status="ATIVO"
                                                            >

                                                                {{-- Olho aberto = banner ativo --}}
                                                                <i class="bi bi-eye-fill"></i>

                                                            </button>

                                                        @else

                                                            <button
                                                                type="button"
                                                                class="btn btn-outline-success btn-status-banner"
                                                                title="Ativar banner"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modalStatusBanner"

                                                                data-url="{{ route('admin.banner.status', $banner->id_banner) }}"

                                                                data-status="INATIVO"
                                                            >

                                                                {{-- Olho fechado = banner inativo --}}
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
                                                    class="text-center py-4 text-muted"
                                                >
                                                    Nenhum banner encontrado.
                                                </td>

                                            </tr>

                                        @endforelse


                                        {{-- Alteração da Gabriele - aparece quando pesquisa não encontra nada --}}
                                        <tr
                                            id="banner-sem-resultado"
                                            class="d-none"
                                        >

                                            <td
                                                colspan="5"
                                                class="text-center py-4 text-muted"
                                            >
                                                Nenhum banner encontrado.
                                            </td>

                                        </tr>


                                    </tbody>

                                </table>

                            </div>

                        </div>



                        <div class="card-footer clearfix">

                            <div class="float-start pt-1 fs-7 text-body-secondary">

                                Total de banners:

                                <strong>
                                    {{ $banners->count() }}
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



{{-- Alteração da Gabriele - modal para cadastrar banner --}}
<div
    class="modal fade"
    id="modalNovoBanner"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog">

        <div class="modal-content">


            <div class="modal-header">

                <h5 class="modal-title">
                    Novo Banner
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>


            <form
                action="{{ route('admin.banner.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf


                <div class="modal-body">


                    <div class="mb-3">

                        <label
                            for="titulo_banner"
                            class="form-label"
                        >
                            Título do banner
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="titulo_banner"
                            name="titulo_banner"
                            maxlength="35"
                            required
                        >

                    </div>


                    <div class="mb-3">

                        <label
                            for="img_banner"
                            class="form-label"
                        >
                            Imagem
                        </label>

                        <input
                            type="file"
                            class="form-control"
                            id="img_banner"
                            name="img_banner"
                            accept=".jpg,.jpeg,.png,.webp"
                            required
                        >


                        {{-- Alteração da Gabriele - prévia da imagem --}}
                        <div class="mt-3 text-center">

                            <img
                                id="previewBanner"
                                src=""
                                alt="Prévia do banner"
                                class="img-fluid rounded d-none"
                                style="max-height: 220px;"
                            >

                        </div>

                    </div>


                    <div class="mb-3">

                        <label
                            for="status_banner"
                            class="form-label"
                        >
                            Status
                        </label>

                        <select
                            class="form-select"
                            id="status_banner"
                            name="status_banner"
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



{{-- Alteração da Gabriele - modal único de edição --}}
<div
    class="modal fade"
    id="modalEditarBanner"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog">

        <div class="modal-content">


            <div class="modal-header">

                <h5 class="modal-title">
                    Editar Banner
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>


            <form
                id="formEditarBanner"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf
                @method('PUT')


                <div class="modal-body">


                    <div class="mb-3">

                        <label class="form-label">
                            Título do banner
                        </label>

                        <input
                            type="text"
                            id="editar_titulo_banner"
                            name="titulo_banner"
                            class="form-control"
                            maxlength="35"
                            required
                        >

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Imagem atual
                        </label>

                        <div class="text-center">

                            <img
                                id="editar_imagem_atual"
                                src=""
                                alt="Imagem atual"
                                class="img-fluid rounded"
                                style="max-height: 220px;"
                            >

                        </div>

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Nova imagem
                        </label>

                        <input
                            type="file"
                            id="editar_img_banner"
                            name="img_banner"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.webp"
                        >

                        <small class="text-muted">
                            Deixe vazio para manter a imagem atual.
                        </small>

                    </div>


                    <div class="mb-3 text-center">

                        <img
                            id="previewBannerEditar"
                            src=""
                            alt="Prévia"
                            class="img-fluid rounded d-none"
                            style="max-height: 220px;"
                        >

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Status
                        </label>

                        <select
                            id="editar_status_banner"
                            name="status_banner"
                            class="form-select"
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



{{-- Alteração da Gabriele - modal de confirmação para status --}}
<div
    class="modal fade"
    id="modalStatusBanner"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog">

        <form
            id="formStatusBanner"
            method="POST"
        >

            @csrf
            @method('PATCH')


            <div class="modal-content">


                <div class="modal-header">

                    <h5
                        class="modal-title"
                        id="tituloModalStatusBanner"
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
                        id="textoModalStatusBanner"
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
                        id="btnConfirmarStatusBanner"
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
        .getElementById('img_banner')
        .addEventListener('change', function() {

            const arquivo = this.files[0];

            const preview =
                document.getElementById('previewBanner');


            if (arquivo) {

                preview.src =
                    URL.createObjectURL(arquivo);

                preview.classList.remove('d-none');

            }

        });

</script>



{{-- Alteração da Gabriele - modal de edição --}}
<script>

    document
        .querySelectorAll('.btn-editar-banner')
        .forEach(function(botao) {

            botao.addEventListener('click', function() {

                const id =
                    this.dataset.id;

                const titulo =
                    this.dataset.titulo;

                const imagem =
                    this.dataset.imagem;

                const status =
                    this.dataset.status;


                document
                    .getElementById('editar_titulo_banner')
                    .value = titulo;


                document
                    .getElementById('editar_imagem_atual')
                    .src = imagem;


                document
                    .getElementById('editar_status_banner')
                    .value = status;


                document
                    .getElementById('formEditarBanner')
                    .action = '/admin/banner/' + id;


                // Limpa uma nova imagem selecionada anteriormente
                document
                    .getElementById('editar_img_banner')
                    .value = '';


                const preview =
                    document.getElementById('previewBannerEditar');

                preview.src = '';

                preview.classList.add('d-none');

            });

        });



    // Alteração da Gabriele - prévia da nova imagem
    document
        .getElementById('editar_img_banner')
        .addEventListener('change', function() {

            const arquivo = this.files[0];

            const preview =
                document.getElementById('previewBannerEditar');


            if (arquivo) {

                preview.src =
                    URL.createObjectURL(arquivo);

                preview.classList.remove('d-none');

            }

        });

</script>



{{-- Alteração da Gabriele - ativar/desativar banner --}}
<script>

    const modalStatusBanner =
        document.getElementById('modalStatusBanner');


    modalStatusBanner.addEventListener(
        'show.bs.modal',
        function(event) {

            const botao =
                event.relatedTarget;


            const url =
                botao.dataset.url;

            const status =
                botao.dataset.status;


            const formulario =
                document.getElementById('formStatusBanner');


            const titulo =
                document.getElementById('tituloModalStatusBanner');


            const texto =
                document.getElementById('textoModalStatusBanner');


            const botaoConfirmar =
                document.getElementById('btnConfirmarStatusBanner');


            formulario.action = url;


            // Banner está ativo e será desativado
            if (status === 'ATIVO') {

                titulo.textContent =
                    'Desativar Banner';

                texto.textContent =
                    'Tem certeza que deseja desativar este banner?';

                botaoConfirmar.textContent =
                    'Desativar';

                botaoConfirmar.className =
                    'btn btn-danger';

            }

            // Banner está inativo e será ativado
            else {

                titulo.textContent =
                    'Ativar Banner';

                texto.textContent =
                    'Tem certeza que deseja ativar este banner?';

                botaoConfirmar.textContent =
                    'Ativar';

                botaoConfirmar.className =
                    'btn btn-success';

            }

        }
    );

</script>



{{-- Alteração da Gabriele - pesquisar e filtrar banners --}}
<script>

    const campoPesquisa =
        document.getElementById('banner-search');


    const filtroStatus =
        document.getElementById('banner-status-filter');


    function filtrarBanners() {

        // Texto pesquisado
        const pesquisa =
            campoPesquisa.value
                .toLowerCase()
                .trim();


        // Status escolhido
        const statusSelecionado =
            filtroStatus.value;


        const linhas =
            document.querySelectorAll('.banner-row');


        let quantidadeVisivel = 0;


        linhas.forEach(function(linha) {

            const titulo =
                linha.dataset.titulo;


            const status =
                linha.dataset.status;


            // Verifica se o título contém o texto pesquisado
            const encontrouPesquisa =
                titulo.includes(pesquisa);


            // Verifica o status
            const encontrouStatus =
                statusSelecionado === 'all'
                || status === statusSelecionado;


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
            document.getElementById('banner-sem-resultado');


        if (quantidadeVisivel === 0) {

            semResultado.classList.remove('d-none');

        } else {

            semResultado.classList.add('d-none');

        }

    }


    // Pesquisa enquanto digita
    campoPesquisa.addEventListener(
        'input',
        filtrarBanners
    );


    // Filtra quando muda o status
    filtroStatus.addEventListener(
        'change',
        filtrarBanners
    );

</script>



{{-- Alteração da Gabriele - remove as mensagens automaticamente --}}
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