{{-- Listagem administrativa: cabeçalho, filtros, tabela, ações e paginação. --}}
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
<a href="{{ route('admin.dashboard') }}">Home</a>
</li>
<li class="breadcrumb-item active" aria-current="page">Banners</li>
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
<h3 class="card-title">Banners cadastrados</h3>
</div>
<div class="col-12 col-md-8">
<div class="d-flex flex-wrap justify-content-md-end gap-2">
<div class="input-group input-group-sm w-auto">
<span class="input-group-text">
<i class="bi bi-search" aria-hidden="true">
</i>
</span>
<input type="search" id="banner-search" class="form-control admin-search-input" placeholder="Pesquisar banners" aria-label="Pesquisar banners" />
</div>
<select id="banner-status-filter" class="form-select form-select-sm w-auto" aria-label="Filtrar por status">
<option value="all" selected>Todos</option>
<option value="ativo">Ativos</option>
<option value="inativo">Inativos</option>
</select>
{{-- Alteração da Gabriele - abre o modal de cadastro --}}
<button
    type="button"
    class="btn btn-sm btn-primary"
    title="Novo registro"
    data-bs-toggle="modal"
    data-bs-target="#modalNovoBanner"
>
    <i class="bi bi-plus-lg me-1" aria-hidden="true"></i>
    Novo registro
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
<tbody>
@forelse ($banners as $banner)
<tr>
<td>{{ $banner->id_banner }}</td>
<td>
@if ($banner->img_banner)
<img src="{{ asset('vs-cuidadora/assets/' . $banner->img_banner) }}" alt="{{ $banner->titulo_banner }}" class="rounded admin-table-thumbnail" />@else
<span class="text-muted">Sem imagem</span>
@endif
</td>
<td>
<span class="admin-record-label">{{ $banner->titulo_banner }}</span>
</td>
<td>
@if ($banner->status_banner === 'ATIVO')
<span class="badge text-bg-success">Ativo</span>
@else
<span class="badge text-bg-warning">Inativo</span>
@endif
</td>
<td class="text-end">
<div class="btn-group btn-group-sm">
<button type="button" class="btn btn-outline-secondary" title="Editar" aria-label="Editar">
<i class="bi bi-pencil" aria-hidden="true">
</i>
</button>
<button type="button" class="btn btn-outline-danger" title="Deletar" aria-label="Deletar">
<i class="bi bi-trash" aria-hidden="true">
</i>
</button>
</div>
</td>
</tr>
@empty
<tr>
<td colspan="5" class="text-center py-4 text-muted">Nenhum banner encontrado.</td>
</tr>
@endforelse
</tbody>
</table>
</div>
</div>
<div class="card-footer clearfix">
<div class="float-start pt-1 fs-7 text-body-secondary">Total de banners: <strong>{{ $banners->count() }}</strong>
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
{{-- Fim da listagem administrativa. --}}

{{-- Alteração da Gabriele - modal para cadastrar novo banner --}}
<div class="modal fade" id="modalNovoBanner" tabindex="-1" aria-labelledby="modalNovoBannerLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalNovoBannerLabel">
                    Novo Banner
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Fechar">
                </button>
            </div>

            <form
                action="{{ route('admin.banner.store') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                <div class="modal-body">

                    <div class="mb-3">
                        <label for="titulo_banner" class="form-label">
                            Título do banner
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="titulo_banner"
                            name="titulo_banner"
                            maxlength="35"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="img_banner" class="form-label">
                            Imagem
                        </label>

                        <input
                            type="file"
                            class="form-control"
                            id="img_banner"
                            name="img_banner"
                            accept=".jpg,.jpeg,.png,.webp"
                            required>

                            {{-- Alteração da Gabriele - prévia da imagem selecionada --}}
                            <div class="mt-3 text-center">
                                <img
                                    id="previewBanner"
                                    src=""
                                    alt="Prévia do banner"
                                    class="img-fluid rounded d-none"
                                    style="max-height: 220px;">
                            </div>
                    </div>

                    <div class="mb-3">
                        <label for="status_banner" class="form-label">
                            Status
                        </label>

                        <select
                            class="form-select"
                            id="status_banner"
                            name="status_banner"
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


{{-- Alteração da Gabriele - mostra a imagem selecionada antes de salvar --}}
<script>
    document.getElementById('img_banner').addEventListener('change', function(event) {

        const arquivo = event.target.files[0];
        const preview = document.getElementById('previewBanner');

        if (arquivo) {
            preview.src = URL.createObjectURL(arquivo);
            preview.classList.remove('d-none');
        } else {
            preview.src = '';
            preview.classList.add('d-none');
        }

    });
</script>