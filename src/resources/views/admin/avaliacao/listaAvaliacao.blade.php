{{-- Listagem administrativa: cabeçalho, filtros, tabela, ações e paginação. --}}
<section class="admin-list-page">
  <div class="app-content-header admin-page-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
<h1 class="mb-0 fs-3">Avaliações</h1>
</div>
        <div class="col-sm-6">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb float-sm-end">
              <li class="breadcrumb-item">
<a href="{{ route('admin.dashboard') }}">Home</a>
</li>
              <li class="breadcrumb-item active" aria-current="page">Avaliações</li>
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
<h3 class="card-title">Avaliações cadastradas</h3>
</div>
                <div class="col-12 col-md-8">
                  <div class="d-flex flex-wrap justify-content-md-end gap-2">
                    <div class="input-group input-group-sm w-auto">
                      <span class="input-group-text">
<i class="bi bi-search" aria-hidden="true">
</i>
</span>
                      <input type="search" id="avaliacao-search" class="form-control admin-search-input" placeholder="Pesquisar avaliações" aria-label="Pesquisar avaliações" />
                    </div>
                    <select id="avaliacao-status-filter" class="form-select form-select-sm w-auto" aria-label="Filtrar por status">
                      <option value="all" selected>Todos</option>
                      <option value="ativo">Ativos</option>
                      <option value="inativo">Inativos</option>
                    </select>
                    <button type="button" class="btn btn-sm btn-primary" title="Novo registro">
                      <i class="bi bi-plus-lg me-1" aria-hidden="true">
</i>Novo registro
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
<th>Mensagem</th>
<th>Cliente</th>
<th>Estrelas</th>
<th>Status</th>
<th class="text-end">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                    {{-- Conteúdo vindo de tbl_avaliacao e da relação com tbl_info_cliente. --}}
                    @forelse ($avaliacoes as $avaliacao)
                      <tr>
                        <td>{{ $avaliacao->id_avaliacao }}</td>
                        <td>
                          @if ($avaliacao->img_avaliacao)
                            <img src="{{ asset('vs-cuidadora/assets/' . $avaliacao->img_avaliacao) }}" alt="{{ $avaliacao->titulo_avaliacao }}" class="rounded admin-table-thumbnail" />
                          @else
                            <span class="text-muted">Sem imagem</span>
                          @endif
                        </td>
                        <td>
<span class="admin-record-label">{{ $avaliacao->titulo_avaliacao }}</span>
</td>
                        <td>{{ $avaliacao->mensagem_avaliacao }}</td>
                        <td>{{ $avaliacao->AvaliacaoCliente?->nome_cliente ?? 'Cliente não encontrado' }}</td>
                        <td>{{ $avaliacao->estrela_avaliacao }}/5</td>
                        <td>
                          @if ($avaliacao->status_avaliacao === 'ATIVO')
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
<td colspan="8" class="text-center py-4 text-muted">Nenhuma avaliação encontrada.</td>
</tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>

            <div class="card-footer clearfix">
              <div class="float-start pt-1 fs-7 text-body-secondary">Total de avaliações: <strong>{{ $avaliacoes->count() }}</strong>
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
