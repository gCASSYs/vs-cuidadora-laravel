<main class="app-main"><section class="admin-list-page"><div class="app-content-header admin-page-header"><div class="container-fluid"><div class="row"><div class="col-sm-6"><h1 class="mb-0 fs-3">Logo</h1></div><div class="col-sm-6"><nav aria-label="breadcrumb"><ol class="breadcrumb float-sm-end"><li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li><li class="breadcrumb-item active">Logo</li></ol></nav></div></div></div></div><div class="app-content"><div class="container-fluid"><div class="row"><div class="col-12"><div class="card admin-data-card mb-4">
<div class="card-header"><div class="row g-2 align-items-center"><div class="col-12 col-md-4"><h3 class="card-title">Logos cadastradas</h3></div><div class="col-12 col-md-8"><div class="d-flex flex-wrap justify-content-md-end gap-2"><input type="search" class="form-control form-control-sm admin-search-input w-auto" placeholder="Pesquisar logos"><select class="form-select form-select-sm w-auto"><option>Todos</option><option>Ativas</option><option>Inativas</option></select><button class="btn btn-sm btn-primary" disabled title="Disponível na próxima etapa"><i class="bi bi-plus-lg me-1"></i>Nova Logo</button></div></div></div></div>
<div class="card-body p-0"><div class="table-responsive">
<table class="table table-hover align-middle m-0">
<thead>
<tr>
<th>ID</th>
<th>Imagem</th>
<th>Status</th>
<th class="text-end">Ações</th>
</tr>
</thead>
<tbody>@forelse($logos as $item)<tr>
<td>{{ $item->id_logo }}</td>
<td><img class="rounded admin-table-thumbnail" src="{{ asset('vs-cuidadora/assets/' . $item->img_logo) }}" alt="Logo"></td>
<td>
<span class="badge text-bg-{{ $item->status_logo==='ATIVO'?'success':'warning' }}">{{ $item->status_logo==='ATIVO'?'Ativo':'Inativo' }}</span>
</td>
<td class="text-end"><span class="badge text-bg-secondary" title="Disponível na próxima etapa">Em breve</span></td>
</tr>@empty<tr>
<td colspan="4" class="text-center py-4 text-muted">Nenhuma logo encontrada.</td>
</tr>@endforelse</tbody>
</table></div></div>
<div class="card-footer clearfix"><div class="float-start pt-1 fs-7 text-body-secondary">Total de logos: <strong>{{ $logos->count() }}</strong></div><ul class="pagination pagination-sm m-0 float-end"><li class="page-item disabled"><span class="page-link">&laquo;</span></li><li class="page-item active"><span class="page-link">1</span></li><li class="page-item disabled"><span class="page-link">&raquo;</span></li></ul>
</div></div></div></div></div></section></main>
