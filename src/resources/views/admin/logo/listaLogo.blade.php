{{-- Listagem administrativa: cabeçalho, filtros, tabela, ações e paginação. --}}
<section class="admin-list-page">
<div class="app-content-header admin-page-header">
<div class="container-fluid">
<div class="row">
<div class="col-sm-6">
<h1 class="mb-0 fs-3">Logo</h1>
</div>
<div class="col-sm-6">
<nav aria-label="breadcrumb">
<ol class="breadcrumb float-sm-end">
<li class="breadcrumb-item">
<a href="{{ route('admin.dashboard') }}">Home</a>
</li>
<li class="breadcrumb-item active" aria-current="page">Logo</li>
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
<h3 class="card-title">Logos cadastrados</h3>
</div>
<div class="col-12 col-md-8">
<div class="d-flex flex-wrap justify-content-md-end gap-2">
<div class="input-group input-group-sm w-auto">
<span class="input-group-text">
<i class="bi bi-search" aria-hidden="true">
</i>
</span>
<input type="search" id="logo-search" class="form-control admin-search-input" placeholder="Pesquisar logos" aria-label="Pesquisar logos" />
</div>
<select id="logo-status-filter" class="form-select form-select-sm w-auto" aria-label="Filtrar por status">
<option value="all" selected>Todos</option>
<option value="ativo">Ativos</option>
<option value="inativo">Inativos</option>
</select>
<button 
    type="button" 
    class="btn btn-sm btn-primary" 
    title="Novo registro"
    data-bs-toggle="modal"
    data-bs-target="#modalNovaLogo"
>
<i class="bi bi-plus-lg me-1" aria-hidden="true">
</i>Novo registro</button>
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
<th>Status</th>
<th class="text-end">Ações</th>
</tr>
</thead>
<tbody>
@forelse ($logos as $logo)
<tr>
<td>{{ $logo->id_logo }}</td>
<td>
@if ($logo->img_logo)
<img src="{{ asset('vs-cuidadora/assets/' . $logo->img_logo) }}" alt="Logo {{ $logo->id_logo }}" class="rounded admin-table-thumbnail" />@else
<span class="text-muted">Sem imagem</span>
@endif
</td>
<td>
@if ($logo->status_logo === 'ATIVO')
<span class="badge text-bg-success">Ativo</span>
@else
<span class="badge text-bg-warning">Inativo</span>
@endif
</td>
<td class="text-end">
<div class="btn-group btn-group-sm">
<button 
    type="button"
    data-bs-toggle="modal"
    data-bs-target="#modalEditarLogo"
    data-id="{{$logo->id_logo}}"
    data-logo="{{ asset('vs-cuidadora/assets/' . $logo->img_logo)}}"
    data-status="{{$logo->status_logo}}"
    data-url="{{ route('admin.logo.update', $logo->id_logo)}}" 
    class="btn btn-outline-secondary" 
    title="Editar" 
    aria-label="Editar"
>
<i class="bi bi-pencil" aria-hidden="true">
</i>
</button>
<form 
    action="{{ route('admin.logo.status', $logo->id_logo)}}" 
    method="post"
    class="d-inline"
>
@csrf
@method('PATCH')

@if($logo->status_logo === 'ATIVO')
<button 
    type="submit" 
    class="btn btn-outline-danger" 
    title="Desativar" 
    aria-label="Desativar"
>
<i class="bi bi-eye-slash-fill" aria-hidden="true">
</i>
</button>
@else
<button 
    type="submit" 
    class="btn btn-outline-success" 
    title="Ativar" 
    aria-label="Ativar"
>
<i class="bi bi-eye-fill" aria-hidden="true">
</i>
</button>
@endif
</form>
</div>
</td>
</tr>
@empty
<tr>
<td colspan="4" class="text-center py-4 text-muted">Nenhuma logo encontrada.</td>
</tr>
@endforelse
</tbody>
</table>
</div>
</div>
<div class="card-footer clearfix">
<div class="float-start pt-1 fs-7 text-body-secondary">Total de logos: <strong>{{ $logos->count() }}</strong>
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

{{-- Alteração de André - cadastro de diferencial --}}
<div 
    class="modal fade" 
    id="modalNovaLogo" 
    tabindex="-1" 
    aria-labelledby="modalNovaLogoLabel" 
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalNovaLogoLabel">
                    Nova LOGO
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Fechar">
                </button>
            </div>

            <form
                action="{{ route('admin.logo.store') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                <div class="modal-body">

                    <div class="mb-3">
                        <label for="img_logo" class="form-label">
                            logo
                        </label>

                        <input
                            type="file"
                            class="form-control"
                            id="img_logo"
                            name="img_logo"
                            accept=".jpg,.jpeg,.png,.webp"
                            required>

                            <div class="mt-3 text-center">
                                <img
                                    id="previewBanner"
                                    src=""
                                    alt="Prévia da logo"
                                    class="img-fluid rounded d-none"
                                    style="max-height: 220px;">
                            </div>
                    </div>

                    <div class="mb-3">
                        <label for="status_logo" class="form-label">
                            Status
                        </label>

                        <div class="form-text mb-2">
                            Ao ativar esta logo, qualquer outra logo ativa será desativada automaticamente.
                        </div>

                        <select
                            class="form-select"
                            id="status_logo"
                            name="status_logo"
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

{{-- Alteração de André - editar diferencial --}}
<div 
    class="modal fade" 
    id="modalEditarLogo" 
    tabindex="-1" 
    aria-labelledby="modalEditarLogoLabel" 
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarLogoLabel">
                    Editar LOGO
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Fechar">
                </button>
            </div>

            <form
                id="formEditarLogo"
                method="POST"
                enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="modal-body">

                    <div class="mb-3">
                        <label for="editarLogoImagem" class="form-label">
                            Logo
                        </label>

                        <input
                            type="file"
                            class="form-control"
                            id="editarLogoImagem"
                            name="img_logo"
                            accept=".jpg,.jpeg,.png,.webp"
                            >

                            <div class="mt-3 text-center">
                                <img
                                    id="editarLogoMostrar"
                                    src=""
                                    alt="Logo"
                                    class="img-fluid rounded d-none"
                                    style="max-height: 220px;">
                            </div>
                    </div>

                    <div class="mb-3">
                        <label for="editarLogoStatus" class="form-label">
                            Status
                        </label>

                        <div class="form-text mb-2">
                            Ao ativar esta logo, qualquer outra logo ativa será desativada automaticamente.
                        </div>

                        <select
                            class="form-select"
                            id="editarLogoStatus"
                            name="status_logo"
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

{{-- Alteração de André - mostra a imagem selecionada antes de salvar --}}
<script>
    document.getElementById('img_logo').addEventListener('change', function(event) {

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

{{-- Alteração de André - Script para o EDITAR LOGO --}}  
<script>
        // document = seleciona dentro de todo o site
        // getElementBy ID = seleciona um ID específico dentro do site
        const modalEditarLogo = document.getElementById('modalEditarLogo');
        const formEditarLogo    = document.getElementById('formEditarLogo');
        const editStatus        = document.getElementById('editarLogoStatus');
        const editLogo        = document.getElementById('editarLogoImagem');
        const editMostrar       = document.getElementById('editarLogoMostrar');

        // Carregar as informações no modal
        modalEditarLogo.addEventListener('show.bs.modal', function(event){

          const botao  = event.relatedTarget;

          const id     = botao.getAttribute('data-id');
          const status = botao.getAttribute('data-status');
          const logo = botao.getAttribute('data-logo');
          const url    = botao.getAttribute('data-url');

          // Form Action
          formEditarLogo.action = url;

          // Preencher
          editStatus.value = status;
          editMostrar.src  = logo;
          editMostrar.classList.remove('d-none');

          // Imagem vem vazia
          editLogo.value = '';

        })

        //VER FOTO PARA EDITAR
        editLogo.addEventListener('change', function() {
    
            const arquivo = this.files[0];
    
            if (arquivo) {
    
                editMostrar.src = URL.createObjectURL(arquivo);
                editMostrar.classList.remove('d-none');
    
            }
    
        });


</script>
