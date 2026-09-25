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
                <a href="{{ route('admin.dashboard') }}">
                  Dashboard
                </a>
              </li>

              <li class="breadcrumb-item active">
                Avaliações
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
                    Avaliações cadastrados
                  </h3>

                </div>


                <div class="col-12 col-md-8">

                  <div class="d-flex flex-wrap justify-content-md-end gap-2">


                    {{-- Alteração da Gabriele - pesquisa --}}
                    <div class="input-group input-group-sm w-auto">

                      <span class="input-group-text">

                        <i
                          class="bi bi-search"
                          aria-hidden="true"></i>

                      </span>

                      <input
                        type="search"
                        id="avaliacao-search"
                        class="form-control admin-search-input"
                        placeholder="Pesquisar Avaliações"
                        aria-label="Pesquisar Avaliações">

                    </div>



                    <select
                      id="avaliacao-status-filter"
                      class="form-select form-select-sm w-auto">

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
                      <th>Id Cliente</th>
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
                    @forelse ($listaAvaliacao as $lista)
                    <tr>
                      <td>{{ $lista->id_avaliacao }}</td>

                      <td>{{ $lista->id_cliente }}</td>

                      <td>
                        @if ($lista->img_avaliacao)
                        <img src="{{ asset('vs-cuidadora/assets/' . $lista->img_avaliacao) }}" alt="{{ $lista->titulo_avaliacao }}" class="rounded admin-table-thumbnail" />
                        @else
                        <span class="text-muted">Sem imagem</span>
                        @endif
                      </td>
                      <td>
                        <span class="admin-record-label">{{ $lista->titulo_avaliacao }}</span>
                      </td>
                      <td>{{ $lista->mensagem_avaliacao }}</td>
                      <td>{{ $lista->AvaliacaoCliente?->nome_cliente ?? 'Cliente não encontrado' }}</td>
                      <td>{{ $lista->estrela_avaliacao }}/5</td>
                      <td>
                        @if ($lista->status_avaliacao === 'ATIVO')
                        <span class="badge text-bg-success">Ativo</span>
                        @else
                        <span class="badge text-bg-warning">Inativo</span>
                        @endif
                      </td>
                      <td class="text-end">

                        <div class="btn-group btn-group-sm">


                      


                          <!-- BOTÃO STATUS AVALIÇÃO -->
                          @if ($lista->status_avaliacao === 'ATIVO')

                          <button
                            type="button"
                            class="btn btn-outline-danger btn-status-avaliacao"
                            title="Desativar avaliação"
                            data-bs-toggle="modal"
                            data-bs-target="#modalStatusAvaliacao"

                            data-url="{{ route('admin.avaliacao.status', $lista->id_avaliacao) }}"

                            data-status="ATIVO">


                            <i class="bi bi-eye-fill"></i>

                          </button>

                          @else

                          <button
                            type="button"
                            class="btn btn-outline-success btn-status-avaliacao"
                            title="Ativar avaliaçõa"
                            data-bs-toggle="modal"
                            data-bs-target="#modalStatusAvaliacao"

                            data-url="{{ route('admin.avaliacao.status', $lista->id_avaliacao) }}"

                            data-status="INATIVO">


                            <i class="bi bi-eye-slash-fill"></i>

                          </button>

                          @endif


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

              <div class="float-start pt-1 fs-7 text-body-secondary">

                Total de Avaliações:

                <strong>
                  {{ $lista->count() }}
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






<!-- INÍCIO MODAL EDITAR -->
<div
  class="modal fade"
  id="modalEditarAvaliacao"
  tabindex="-1"
  aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">


      <div class="modal-header">

        <h5 class="modal-title">
          Editar Avaliação
        </h5>

        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"></button>

      </div>


      <form
        id="formEditarAvaliacao"
        method="POST"
        enctype="multipart/form-data">

        @csrf
        @method('PUT')


        <div class="modal-body">


          <div class="mb-3">

            <label class="form-label">
              Título da Avaliação
            </label>

            <input
              type="text"
              id="editar_titulo_avaliacao"
              name="titulo_avaliacao"
              class="form-control"
              maxlength="35"
              required>

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
                style="max-height: 220px;">

            </div>

          </div>


          <div class="mb-3">

            <label class="form-label">
              Nova imagem
            </label>

            <input
              type="file"
              id="editar_img_avaliacao"
              name="img_avaliacao"
              class="form-control"
              accept=".jpg,.jpeg,.png,.webp">

            <small class="text-muted">
              Deixe vazio para manter a imagem atual.
            </small>

          </div>

          <div class="mb-3">

            <label
              for="mensagem_avaliacao"
              class="form-label">
              Depoimento
            </label>

            <input
              type="text"
              class="form-control"
              id="editar_mensagem_avaliacao"
              name="mensagem_avaliacao"
              maxlength="35"
              required>
          </div>


          <div class="mb-3">

            <label
              for="nome_cliente"
              class="form-label">
              Nome Cliente
            </label>

            <input
              type="text"
              class="form-control"
              id="editar_nome_cliente"
              name="nome_cliente"
              maxlength="35"
              required>
          </div>


          <div class="mb-3">

            <label
              for="estrela_avaliacao"
              class="form-label">
              Estrelas
            </label>

            <input
              type="text"
              class="form-control"
              id="editar_estrela_avaliacao"
              name="estrela_avaliacao"
              maxlength="35"
              placeholder="n° estrelas / n° total "
              required>

          </div>


          <div class="mb-3 text-center">

            <img
              id="previewAvaliacaoEditar"
              src=""
              alt="Prévia"
              class="img-fluid rounded d-none"
              style="max-height: 220px;">

          </div>


          <div class="mb-3">

            <label class="form-label">
              Status
            </label>

            <select
              id="editar_status_avaliacao"
              name="status_avaliacao"
              class="form-select">

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
            Salvar alterações
          </button>

        </div>

      </form>

    </div>

  </div>

</div>
<!-- FIM MODAL EDITAR -->


<!-- INÍCIO MODAL -->
<div
  class="modal fade"
  id="modalStatusAvaliacao"
  tabindex="-1"
  aria-hidden="true">

  <div class="modal-dialog">

    <form
      id="formStatusAvaliacao"
      method="POST">

      @csrf
      @method('PATCH')


      <div class="modal-content">


        <div class="modal-header">

          <h5
            class="modal-title"
            id="tituloModalStatusAvaliacao">
            Alterar status
          </h5>

          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"></button>

        </div>


        <div class="modal-body">

          <p
            id="textoModalStatusAvaliacao"
            class="mb-0"></p>

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
            id="btnConfirmarStatusAvaliacao"
            class="btn btn-success">
            Confirmar
          </button>

        </div>

      </div>

    </form>

  </div>


</div>
<!-- FIM MODAL STATUS -->

<!-- SCRIPT -->
<script>
  document
    .getElementById('img_avaliacao')
    .addEventListener('change', function() {

      const arquivo = this.files[0];

      const preview =
        document.getElementById('previewAvaliacao');


      if (arquivo) {

        preview.src =
          URL.createObjectURL(arquivo);

        preview.classList.remove('d-none');

      }

    });
</script>



<!-- MODAL EDIÇÃO -->
<script>
  document
    .querySelectorAll('.btn-editar-avaliacao')
    .forEach(function(botao) {

      botao.addEventListener('click', function() {

        const id =
          this.dataset.id;

        const titulo =
          this.dataset.titulo;

        const imagem =
          this.dataset.imagem;


        const depoimento =
          this.dataset.depoimento;

        const cliente =
          this.dataset.cliente;

        const estrela =
          this.dataset.estrela;

        const status =
          this.dataset.status;


        document
          .getElementById('editar_titulo_avaliacao')
          .value = titulo;


        document
          .getElementById('editar_imagem_atual')
          .src = imagem;


        document
          .getElementById('editar_mensagem_avaliacao')
          .src = imagem;

        document
          .getElementById('editar_nome_cliente')
          .value = cliente;

        document
          .getElementById('editar_status_avaliacao')
          .value = status;

        document
          .getElementById('editar_estrela_avaliacao')
          .value = estrela;

        document
          .getElementById('formEditarAvaliacao')
          .action = '/admin/avaliacao/' + id;


        // Limpa uma nova imagem selecionada anteriormente
        document
          .getElementById('editar_img_avaliacao')
          .value = '';


        const preview =
          document.getElementById('previewAvaliacaoEditar');

        preview.src = '';

        preview.classList.add('d-none');

      });

    });



  // Alteração da Gabriele - prévia da nova imagem
  document
    .getElementById('editar_img_avaliacao')
    .addEventListener('change', function() {

      const arquivo = this.files[0];

      const preview =
        document.getElementById('previewAvaliacaoEditar');


      if (arquivo) {

        preview.src =
          URL.createObjectURL(arquivo);

        preview.classList.remove('d-none');

      }

    });
</script>



<!-- ATIVAR / DESATIVAR -->
<script>
  const modalStatusAvaliacao =
    document.getElementById('modalStatusAvaliacao');


  modalStatusAvaliacao.addEventListener(
    'show.bs.modal',
    function(event) {

      const botao =
        event.relatedTarget;


      const url =
        botao.dataset.url;

      const status =
        botao.dataset.status;


      const formulario =
        document.getElementById('formStatusAvaliacao');


      const titulo =
        document.getElementById('tituloModalStatusAvaliacao');


      const texto =
        document.getElementById('textoModalStatusAvaliacao');


      const botaoConfirmar =
        document.getElementById('btnConfirmarStatusAvaliacao');


      formulario.action = url;


      // Banner está ativo e será desativado
      if (status === 'ATIVO') {

        titulo.textContent =
          'Desativar avaliação';

        texto.textContent =
          'Tem certeza que deseja desativar este avaliação?';

        botaoConfirmar.textContent =
          'Desativar';

        botaoConfirmar.className =
          'btn btn-danger';

      }

      // avaliação está inativo e será ativado
      else {

        titulo.textContent =
          'Ativar avaliação';

        texto.textContent =
          'Tem certeza que deseja ativar este avaliação?';

        botaoConfirmar.textContent =
          'Ativar';

        botaoConfirmar.className =
          'btn btn-success';

      }

    }
  );
</script>



<!-- FILTRAGEM -->
<script>
  const campoPesquisa =
    document.getElementById('avaliacao-search');


  const filtroStatus =
    document.getElementById('avaliacao-status-filter');


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
      document.querySelectorAll('.avaliacao-row');


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
        statusSelecionado === 'all' ||
        status === statusSelecionado;


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
      document.getElementById('avaliacao-sem-resultado');


    if (quantidadeVisivel === 0) {

      semResultado.classList.remove('d-none');

    } else {

      semResultado.classList.add('d-none');

    }

  }


  // Pesquisa enquanto digita
  campoPesquisa.addEventListener(
    'input',
    filtrarAvaliacoes
  );


  // Filtra quando muda o status
  filtroStatus.addEventListener(
    'change',
    filtrarAvaliacoes
  );
</script>



<!-- ALERTA -->
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