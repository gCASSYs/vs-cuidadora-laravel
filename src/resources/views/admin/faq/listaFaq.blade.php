{{-- Listagem administrativa: cabeçalho, filtros, tabela, ações e paginação. --}}
<section class="admin-list-page">
<div class="app-content-header admin-page-header">
<div class="container-fluid">
<div class="row">
<div class="col-sm-6">
<h1 class="mb-0 fs-3">FAQ</h1>
</div>
<div class="col-sm-6">
<nav aria-label="breadcrumb">
<ol class="breadcrumb float-sm-end">
<li class="breadcrumb-item">
<a href="{{ route('admin.dashboard') }}">Home</a>
</li>
<li class="breadcrumb-item active" aria-current="page">FAQ</li>
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
<h3 class="card-title">Perguntas frequentes cadastradas</h3>
</div>
<div class="col-12 col-md-8">
<div class="d-flex flex-wrap justify-content-md-end gap-2">
<div class="input-group input-group-sm w-auto">
<span class="input-group-text">
<i class="bi bi-search" aria-hidden="true">
</i>
</span>
<input type="search" id="faq-search" class="form-control admin-search-input" placeholder="Pesquisar FAQ" aria-label="Pesquisar FAQ" />
</div>
<select id="faq-status-filter" class="form-select form-select-sm w-auto" aria-label="Filtrar por status">
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
<th>Fundo</th>
<th>Título</th>
<th>Pergunta</th>
<th>Resposta</th>
<th>Status</th>
<th class="text-end">Ações</th>
</tr>
</thead>
<tbody>
@forelse ($faqs as $faq)
<tr>
<td>{{ $faq->id_faq }}</td>
<td>
@if ($faq->fundo_faq)
<img src="{{ asset('vs-cuidadora/assets/' . $faq->fundo_faq) }}" alt="Fundo do FAQ {{ $faq->titulo_faq }}" class="rounded admin-table-thumbnail" />@else
<span class="text-muted">Sem imagem</span>
@endif
</td>
<td>
<span class="admin-record-label">{{ $faq->titulo_faq }}</span>
</td>
<td>{{ $faq->titulo_duvida }}</td>
<td>{{ $faq->resposta_duvida }}</td>
<td>
@if ($faq->status_faq === 'ATIVO')
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
<td colspan="7" class="text-center py-4 text-muted">Nenhum FAQ encontrado.</td>
</tr>
@endforelse
</tbody>
</table>
</div>
</div>
<div class="card-footer clearfix">
<div class="float-start pt-1 fs-7 text-body-secondary">Total de perguntas: <strong>{{ $faqs->count() }}</strong>
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
