{{-- Listagem administrativa: cabeçalho, filtros, tabela, ações e paginação. --}}
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
<a href="{{ route('admin.dashboard') }}">Home</a>
</li>
<li class="breadcrumb-item active" aria-current="page">Serviços</li>
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
<h3 class="card-title">Serviços cadastrados</h3>
</div>
<div class="col-12 col-md-8">
<div class="d-flex flex-wrap justify-content-md-end gap-2">
<div class="input-group input-group-sm w-auto">
<span class="input-group-text">
<i class="bi bi-search" aria-hidden="true">
</i>
</span>
<input type="search" id="servico-search" class="form-control admin-search-input" placeholder="Pesquisar serviços" aria-label="Pesquisar serviços" />
</div>
<select id="servico-status-filter" class="form-select form-select-sm w-auto" aria-label="Filtrar por status">
<option value="all" selected>Todos</option>
<option value="ativo">Ativos</option>
<option value="inativo">Inativos</option>
</select>
<button type="button" class="btn btn-sm btn-primary" title="Novo registro">
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
<th>Título</th>
<th>Subtítulo</th>
<th>Descrição</th>
<th>Status</th>
<th class="text-end">Ações</th>
</tr>
</thead>
<tbody>
@forelse ($servicos as $servico)
<tr>
<td>{{ $servico->id_servico_ancora }}</td>
<td>
@if ($servico->img_servico_ancora)
<img src="{{ asset('vs-cuidadora/assets/' . $servico->img_servico_ancora) }}" alt="{{ $servico->titulo_servico_ancora }}" class="rounded admin-table-thumbnail" />@else
<span class="text-muted">Sem imagem</span>
@endif
</td>
<td>
<span class="admin-record-label">{{ $servico->titulo_servico_ancora }}</span>
</td>
<td>{{ $servico->subtitulo_servico_ancora }}</td>
<td>{{ Str::limit($servico->texto_servico_ancora, 80) }}</td>
<td>
@if ($servico->status_servico_ancora === 'ATIVO')
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
<td colspan="7" class="text-center py-4 text-muted">Nenhum serviço encontrado.</td>
</tr>
@endforelse
</tbody>
</table>
</div>
</div>
<div class="card-footer clearfix">
<div class="float-start pt-1 fs-7 text-body-secondary">Total de serviços: <strong>{{ $servicos->count() }}</strong>
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
