{{-- Listagem administrativa: cabeçalho, filtros, tabela, ações e paginação. --}}
<section class="admin-list-page">
<div class="app-content-header admin-page-header">
<div class="container-fluid">
<div class="row">
<div class="col-sm-6">
<h1 class="mb-0 fs-3">Diferenciais</h1>
</div>
<div class="col-sm-6">
<nav aria-label="breadcrumb">
<ol class="breadcrumb float-sm-end">
<li class="breadcrumb-item">
<a href="{{ route('admin.dashboard') }}">Home</a>
</li>
<li class="breadcrumb-item active" aria-current="page">Diferenciais</li>
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
<h3 class="card-title">Diferenciais cadastrados</h3>
</div>
<div class="col-12 col-md-8">
<div class="d-flex flex-wrap justify-content-md-end gap-2">
<div class="input-group input-group-sm w-auto">
<span class="input-group-text">
<i class="bi bi-search" aria-hidden="true">
</i>
</span>
<input type="search" id="diferencial-search" class="form-control admin-search-input" placeholder="Pesquisar diferenciais" aria-label="Pesquisar diferenciais" />
</div>
<select id="diferencial-status-filter" class="form-select form-select-sm w-auto" aria-label="Filtrar por status">
<option value="all" selected>Todos</option>
<option value="ativo">Ativos</option>
<option value="inativo">Inativos</option>
</select>
<!-- Alteração de André: CADASTRO -->
<button 
    type="button" 
    class="btn btn-sm btn-primary" 
    title="Novo registro"
    data-bs-toggle="modal"
    data-bs-target="#modalNovoDiferencial"
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
<th>Ícone</th>
<th>Título</th>
<th>Texto</th>
<th>Status</th>
<th class="text-end">Ações</th>
</tr>
</thead>
<tbody>
@forelse ($diferenciais as $diferencial)
<tr>
<td>{{ $diferencial->id_diferencial }}</td>
<td>
@if ($diferencial->icone_diferencial)
<img src="{{ asset('vs-cuidadora/' . $diferencial->icone_diferencial) }}" alt="{{ $diferencial->titulo_diferencial }}" class="rounded admin-table-thumbnail" />@else
<span class="text-muted">Sem ícone</span>
@endif
</td>
<td>
<span class="admin-record-label">{{ $diferencial->titulo_diferencial }}</span>
</td>
<td>{{ Str::limit($diferencial->texto_diferencial, 80) }}</td>
<td>
@if ($diferencial->status_diferencial === 'ATIVO')
<span class="badge text-bg-success">Ativo</span>
@else
<span class="badge text-bg-warning">Inativo</span>
@endif
</td>
<td class="text-end">
    <!-- Alteração de André: Botões EDITAR & ATUALIZAR STATUS -->
<div class="btn-group btn-group-sm">
<button 
    type="button"
    data-bs-toggle="modal"
    data-bs-target="#modalEditarDiferencial"
    data-id="{{$diferencial->id_diferencial}}"
    data-titulo="{{$diferencial->titulo_diferencial}}"
    data-cont="{{$diferencial->texto_diferencial}}"
    data-icone="{{ asset('vs-cuidadora/' . $diferencial->icone_diferencial)}}"
    data-status="{{$diferencial->status_diferencial}}"
    data-url="{{ route('admin.diferencial.update', $diferencial->id_diferencial)}}" 
    class="btn btn-outline-secondary" 
    title="Editar" 
    aria-label="Editar"
>
<i class="bi bi-pencil" aria-hidden="true">
</i>
</button>
<form 
    action="{{ route('admin.diferencial.status', $diferencial->id_diferencial)}}" 
    method="post"
    class="d-inline"
>
@csrf
@method('PATCH')

@if($diferencial->status_diferencial === 'ATIVO')
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
<td colspan="6" class="text-center py-4 text-muted">Nenhum diferencial encontrado.</td>
</tr>
@endforelse
</tbody>
</table>
</div>
</div>
<div class="card-footer clearfix">
<div class="float-start pt-1 fs-7 text-body-secondary">Total de diferenciais: <strong>{{ $diferenciais->count() }}</strong>
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
    id="modalNovoDiferencial" 
    tabindex="-1" 
    aria-labelledby="modalNovoDiferencialLabel" 
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalNovoDiferencialLabel">
                    Novo DIFERENCIAL
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Fechar">
                </button>
            </div>

            <form
                action="{{ route('admin.diferencial.store') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                <div class="modal-body">

                    <div class="mb-3">
                        <label for="titulo_diferencial" class="form-label">
                            Título do diferencial
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="titulo_diferencial"
                            name="titulo_diferencial"
                            placeholder="Método de Trabalho"
                            maxlength="35"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="texto_diferencial" class="form-label">
                            Conteúdo
                        </label>

                        <textarea 
                            class="form-control"
                            id="texto_diferencial"
                            name="texto_diferencial"
                            rows="4"
                            placeholder="Nosso método de trabalho se baseia em..."
                            required
                        >
                        </textarea>
                    </div>

                    <div class="mb-3">
                        <label for="icone_diferencial" class="form-label">
                            ícone
                        </label>

                        <input
                            type="file"
                            class="form-control"
                            id="icone_diferencial"
                            name="icone_diferencial"
                            accept=".jpg,.jpeg,.png,.webp"
                            required>

                            <div class="mt-3 text-center">
                                <img
                                    id="previewBanner"
                                    src=""
                                    alt="Prévia do ícone"
                                    class="img-fluid rounded d-none"
                                    style="max-height: 220px;">
                            </div>
                    </div>

                    <div class="mb-3">
                        <label for="status_diferencial" class="form-label">
                            Status
                        </label>

                        <select
                            class="form-select"
                            id="status_diferencial"
                            name="status_diferencial"
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
    id="modalEditarDiferencial" 
    tabindex="-1" 
    aria-labelledby="modalEditarDiferencialLabel" 
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarDiferencialLabel">
                    Editar DIFERENCIAL
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Fechar">
                </button>
            </div>

            <form
                id="formEditarDiferencial"
                method="POST"
                enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="modal-body">

                    <div class="mb-3">
                        <label for="editarDiferencialTitulo" class="form-label">
                            Título do diferencial
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="editarDiferencialTitulo"
                            name="titulo_diferencial"
                            maxlength="35"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="editarDiferencialTexto" class="form-label">
                            Conteúdo
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="editarDiferencialTexto"
                            name="texto_diferencial"
                            rows="4"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="editarDiferencialIcone" class="form-label">
                            ícone
                        </label>

                        <input
                            type="file"
                            class="form-control"
                            id="editarDiferencialIcone"
                            name="icone_diferencial"
                            accept=".jpg,.jpeg,.png,.webp"
                            >

                            <div class="mt-3 text-center">
                                <img
                                    id="editarDiferencialMostrar"
                                    src=""
                                    alt="diferencial"
                                    class="img-fluid rounded d-none"
                                    style="max-height: 220px;">
                            </div>
                    </div>

                    <div class="mb-3">
                        <label for="editarDiferencialStatus" class="form-label">
                            Status
                        </label>

                        <select
                            class="form-select"
                            id="editarDiferencialStatus"
                            name="status_diferencial"
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
    document.getElementById('icone_diferencial').addEventListener('change', function(event) {

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

{{-- Alteração de André - Script para o EDITAR DIFERENCIAL --}}  
<script>
        // document = seleciona dentro de todo o site
        // getElementBy ID = seleciona um ID específico dentro do site
        const modalEditarDiferencial = document.getElementById('modalEditarDiferencial');
        const formEditarDiferencial    = document.getElementById('formEditarDiferencial');
        const editTitulo        = document.getElementById('editarDiferencialTitulo');
        const editConteudo = document.getElementById('editarDiferencialTexto');
        const editStatus        = document.getElementById('editarDiferencialStatus');
        const editIcone        = document.getElementById('editarDiferencialIcone');
        const editMostrar       = document.getElementById('editarDiferencialMostrar');

        // Carregar as informações no modal
        modalEditarDiferencial.addEventListener('show.bs.modal', function(event){

          const botao  = event.relatedTarget;

          const id     = botao.getAttribute('data-id');
          const titulo = botao.getAttribute('data-titulo');
          const conteudo = botao.getAttribute('data-cont');
          const status = botao.getAttribute('data-status');
          const icone = botao.getAttribute('data-icone');
          const url    = botao.getAttribute('data-url');

          // Form Action
          formEditarDiferencial.action = url;

          // Preencher
          editTitulo.value = titulo;
          editStatus.value = status;
          editConteudo.value = conteudo;
          editMostrar.src  = icone;
          editMostrar.classList.remove('d-none');

          // Imagem vem vazia
          editIcone.value = '';

        })

        //VER FOTO PARA EDITAR
        editIcone.addEventListener('change', function() {
    
            const arquivo = this.files[0];
    
            if (arquivo) {
    
                editMostrar.src = URL.createObjectURL(arquivo);
                editMostrar.classList.remove('d-none');
    
            }
    
        });


</script>

{{-- Alteração de André - Timer para a mensagem de alerta --}}    
<script>

    setTimeout(() => {
            
        const alertas = document.querySelectorAll('.alert');

        alertas.forEach(function(alerta){
            
            const instancia = bootstrap.Alert.getOrCreateInstance(alerta);

            instancia.close();

        })

    }, 5000);

</script>