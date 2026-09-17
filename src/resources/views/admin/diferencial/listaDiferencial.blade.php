<main class="app-main"><section class="admin-list-page"><div class="app-content-header admin-page-header"><div class="container-fluid"><div class="row"><div class="col-sm-6"><h1 class="mb-0 fs-3">Diferenciais</h1></div><div class="col-sm-6"><nav aria-label="breadcrumb"><ol class="breadcrumb float-sm-end"><li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li><li class="breadcrumb-item active">Diferenciais</li></ol></nav></div></div></div></div><div class="app-content"><div class="container-fluid"><div class="row"><div class="col-12"><div class="card admin-data-card mb-4">
<div class="card-header"><div class="row g-2 align-items-center"><div class="col-12 col-md-4"><h3 class="card-title">Diferenciais cadastrados</h3></div><div class="col-12 col-md-8"><div class="d-flex flex-wrap justify-content-md-end gap-2"><input type="search" class="form-control form-control-sm admin-search-input w-auto" placeholder="Pesquisar diferenciais"><select class="form-select form-select-sm w-auto"><option>Todos</option><option>Ativos</option><option>Inativos</option></select><button class="btn btn-sm btn-primary" disabled title="Disponível na próxima etapa"><i class="bi bi-plus-lg me-1"></i>Novo Diferencial</button></div></div></div></div>
<div class="card-body p-0"><div class="table-responsive">
<table class="table table-hover align-middle m-0">
<thead>
<tr>
<th>ID</th>
<th>Ícone</th>
<th>Título</th>
<th>Descrição</th>
<th>Status</th>
<th class="text-end">Ações</th>
</tr>
</thead>
<tbody>@forelse($diferenciais as $item)<tr>
<td>{{ $item->id_diferencial }}</td>
<td><img class="rounded admin-table-thumbnail" src="{{ asset('vs-cuidadora/' . $item->icone_diferencial) }}" alt="Ícone de {{ $item->titulo_diferencial }}"></td>
<td><span class="admin-record-label">{{ $item->titulo_diferencial }}</span></td>
<td>{{ Str::limit($item->texto_diferencial,80) }}</td>
<td>
<span class="badge text-bg-{{ $item->status_diferencial==='ATIVO'?'success':'warning' }}">{{ $item->status_diferencial==='ATIVO'?'Ativo':'Inativo' }}</span>
</td>
<td class="text-end"><span class="badge text-bg-secondary" title="Disponível na próxima etapa">Em breve</span></td>
</tr>@empty<tr>
<td colspan="6" class="text-center py-4 text-muted">Nenhum diferencial encontrado.</td>
</tr>@endforelse</tbody>
</table></div></div>
<div class="card-footer clearfix"><div class="float-start pt-1 fs-7 text-body-secondary">Total de diferenciais: <strong>{{ $diferenciais->count() }}</strong></div><ul class="pagination pagination-sm m-0 float-end"><li class="page-item disabled"><span class="page-link">&laquo;</span></li><li class="page-item active"><span class="page-link">1</span></li><li class="page-item disabled"><span class="page-link">&raquo;</span></li></ul>
</div></div></div></div></div></section></main>
