<main class="app-main"><section class="admin-list-page"><div class="app-content-header admin-page-header"><div class="container-fluid"><div class="row"><div class="col-sm-6"><h1 class="mb-0 fs-3">Sobre</h1></div><div class="col-sm-6"><nav aria-label="breadcrumb"><ol class="breadcrumb float-sm-end"><li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li><li class="breadcrumb-item active">Sobre</li></ol></nav></div></div></div></div><div class="app-content"><div class="container-fluid"><div class="row"><div class="col-12"><div class="card admin-data-card mb-4">
<div class="card-header"><div class="row g-2 align-items-center"><div class="col-12 col-md-4"><h3 class="card-title">Conteúdo principal</h3></div><div class="col-12 col-md-8"><div class="d-flex flex-wrap justify-content-md-end gap-2"><input type="search" class="form-control form-control-sm admin-search-input w-auto" placeholder="Pesquisar conteúdo"><button class="btn btn-sm btn-primary" disabled title="Disponível na próxima etapa"><i class="bi bi-plus-lg me-1"></i>Novo registro</button></div></div></div></div>
<div class="card-body p-0"><div class="table-responsive">
<table class="table table-hover align-middle m-0">
<thead>
<tr>
<th>ID</th>
<th>Imagem</th>
<th>Título</th>
<th>Subtítulo</th>
<th>Texto</th>
<th class="text-end">Ações</th>
</tr>
</thead>
<tbody>@forelse($sobre as $item)<tr>
<td>{{ $item->id_sobre }}</td>
<td><img class="rounded admin-table-thumbnail" src="{{ asset('vs-cuidadora/assets/' . $item->img_sobre) }}" alt="{{ $item->titulo_sobre }}"></td>
<td><span class="admin-record-label">{{ $item->titulo_sobre }}</span></td>
<td>{{ $item->subtitulo_sobre }}</td>
<td>{{ Str::limit($item->texto_sobre,90) }}</td>
<td class="text-end"><span class="badge text-bg-secondary" title="Disponível na próxima etapa">Em breve</span></td>
</tr>@empty<tr>
<td colspan="6" class="text-center py-4 text-muted">Nenhum conteúdo encontrado.</td>
</tr>@endforelse</tbody>
</table></div></div>
<div class="card-footer clearfix"><div class="float-start pt-1 fs-7 text-body-secondary">Total de registros: <strong>{{ $sobre->count() }}</strong></div><ul class="pagination pagination-sm m-0 float-end"><li class="page-item disabled"><span class="page-link">&laquo;</span></li><li class="page-item active"><span class="page-link">1</span></li><li class="page-item disabled"><span class="page-link">&raquo;</span></li></ul>
</div></div></div></div></div></section></main>
