{{-- Barra superior fixa da área administrativa. --}}
<nav class="app-header navbar navbar-expand bg-body">

  {{-- Agrupa os controles dos lados esquerdo e direito. --}}
  <div class="container-fluid">


    {{-- Controles à esquerda: menu lateral e acesso ao site público. --}}
    <ul class="navbar-nav align-items-center">

      <li class="nav-item">

        <button
          type="button"
          class="nav-link vs-topbar-button"
          data-admin-toggle="sidebar"
          aria-label="Abrir ou fechar menu lateral"
          aria-controls="admin-sidebar"
          aria-expanded="true"
        >

          <i class="bi bi-list" aria-hidden="true"></i>

        </button>

      </li>


      <li class="nav-item d-none d-sm-block">

        <a
          href="{{ route('home') }}"
          class="nav-link"
          target="_blank"
          rel="noopener"
        >

          <i
            class="bi bi-box-arrow-up-right me-1"
            aria-hidden="true"
          ></i>

          Ver site

        </a>

      </li>

    </ul>



    {{-- Alteração da Gabriele - informações e controles do lado direito --}}
    <ul class="navbar-nav ms-auto align-items-center">


      {{-- Mantém a identificação original do painel --}}
      <li class="nav-item d-none d-md-block">

        <span class="navbar-text vs-admin-context">

          <i
            class="bi bi-heart-pulse-fill"
            aria-hidden="true"
          ></i>

          Painel da Vânia

        </span>

      </li>



      {{-- Mantém o controle de tela cheia --}}
      <li class="nav-item">

        <button
          type="button"
          class="nav-link vs-topbar-button"
          data-admin-toggle="fullscreen"
          aria-label="Ativar tela cheia"
          aria-pressed="false"
        >

          <i
            class="bi bi-arrows-fullscreen"
            data-fullscreen-icon="expand"
            aria-hidden="true"
          ></i>

          <i
            class="bi bi-fullscreen-exit d-none"
            data-fullscreen-icon="collapse"
            aria-hidden="true"
          ></i>

        </button>

      </li>



      {{-- Alteração da Gabriele - card do usuário autenticado --}}
      <li class="nav-item dropdown user-menu">


        {{-- Usuário exibido no topo --}}
        <a
          href="#"
          class="nav-link dropdown-toggle"
          data-bs-toggle="dropdown"
          aria-expanded="false"
        >


          {{-- Alteração da Gabriele - usa foto se existir, senão mostra avatar padrão --}}
          @if (auth()->user()->foto)

            <img
              src="{{ asset('vs-cuidadora/assets/' . auth()->user()->foto) }}"
              class="user-image rounded-circle shadow"
              alt="{{ auth()->user()->name }}"
            >

          @else

            <span
              class="vs-user-avatar"
              aria-hidden="true"
            >

              <i class="bi bi-person-fill"></i>

            </span>

          @endif


          <span class="d-none d-md-inline">

            {{ auth()->user()->name }}

          </span>

        </a>



        {{-- Dropdown do usuário --}}
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">


          {{-- Alteração da Gabriele - cabeçalho do usuário --}}
          <li class="user-header vs-user-header">


            @if (auth()->user()->foto)

              <img
                src="{{ asset('vs-cuidadora/assets/' . auth()->user()->foto) }}"
                class="rounded-circle shadow"
                alt="{{ auth()->user()->name }}"
              >

            @else

              <div class="vs-user-avatar-lg">

                <i class="bi bi-person-fill"></i>

              </div>

            @endif


            <p>

              {{ auth()->user()->name }}

              <small>

                {{ ucfirst(strtolower(auth()->user()->nivel)) }}

              </small>

            </p>

          </li>



          {{-- Alteração da Gabriele - informações do usuário --}}
          <li class="user-body">

            <div class="row">

              <div class="col-12">


                <p class="mb-1">

                  <strong>E-mail:</strong>

                  {{ auth()->user()->email }}

                </p>


                <p class="mb-1">

                  <strong>Nível:</strong>

                  {{ ucfirst(strtolower(auth()->user()->nivel)) }}

                </p>


                <p class="mb-0">

                  <strong>Status:</strong>


                  @if (auth()->user()->status === 'ATIVO')

                    <span class="badge text-bg-success">

                      Ativo

                    </span>

                  @else

                    <span class="badge text-bg-danger">

                      Inativo

                    </span>

                  @endif

                </p>

              </div>

            </div>

          </li>



          {{-- Alteração da Gabriele - rodapé do card --}}
          <li class="user-footer">


            {{-- Mantido igual à ideia apresentada pelo professor.
                 A página de perfil ainda poderá ser criada depois. --}}
            <a
              href="#"
              class="btn btn-outline-secondary"
            >

              <i class="bi bi-person me-1"></i>

              Perfil

            </a>



            {{-- Alteração da Gabriele - logout --}}
            <form
              action="{{ route('logout') }}"
              method="POST"
              class="d-inline float-end"
            >

              @csrf


              <button
                type="submit"
                class="btn btn-outline-danger"
              >

                <i class="bi bi-box-arrow-right me-1"></i>

                Sair

              </button>

            </form>

          </li>


        </ul>

      </li>


    </ul>

  </div>

</nav>