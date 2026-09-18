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
        <a href="{{ route('home') }}" class="nav-link" target="_blank" rel="noopener">
          <i class="bi bi-box-arrow-up-right me-1" aria-hidden="true"></i>
          Ver site
        </a>
      </li>
    </ul>
    {{-- Informações e controle de tela cheia à direita. --}}
    <ul class="navbar-nav ms-auto align-items-center">
      <li class="nav-item d-none d-md-block">
        <span class="navbar-text vs-admin-context">
          <i class="bi bi-heart-pulse-fill" aria-hidden="true"></i>
          Painel da Vânia
        </span>
      </li>

      <li class="nav-item">
        <button
          type="button"
          class="nav-link vs-topbar-button"
          data-admin-toggle="fullscreen"
          aria-label="Ativar tela cheia"
          aria-pressed="false"
        >
          <i class="bi bi-arrows-fullscreen" data-fullscreen-icon="expand" aria-hidden="true"></i>
          <i class="bi bi-fullscreen-exit d-none" data-fullscreen-icon="collapse" aria-hidden="true"></i>
        </button>
      </li>
    </ul>
  </div>
</nav>
