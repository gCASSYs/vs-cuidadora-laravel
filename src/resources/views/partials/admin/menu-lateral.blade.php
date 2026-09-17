<aside class="bg-dark text-white p-3" style="width: 250px">
    <a class="text-white text-decoration-none fw-bold fs-5 d-block mb-4" href="{{ route('admin.dashboard') }}">VS Cuidadora</a>
    <nav class="nav flex-column gap-1">
        <a class="nav-link text-white {{ request()->routeIs('admin.dashboard') ? 'bg-secondary rounded' : '' }}" href="{{ route('admin.dashboard') }}">Dashboard</a>
        <small class="text-white-50 mt-3 px-2">CONTEÚDO DO SITE</small>
        <a class="nav-link text-white {{ request()->routeIs('admin.banner.*') ? 'bg-secondary rounded' : '' }}" href="{{ route('admin.banner.index') }}">Banners</a>
        <a class="nav-link text-white" href="{{ route('admin.avaliacao.index') }}">Depoimentos</a>
        <a class="nav-link text-white" href="{{ route('admin.faq.index') }}">FAQ</a>
        <a class="nav-link text-white" href="{{ route('admin.diferencial.index') }}">Diferenciais</a>
        <a class="nav-link text-white" href="{{ route('admin.sobre.index') }}">Sobre</a>
        <a class="nav-link text-white" href="{{ route('admin.servico.index') }}">Serviços</a>
        <small class="text-white-50 mt-3 px-2">CONFIGURAÇÕES</small>
        <a class="nav-link text-white" href="{{ route('admin.banner-secao.index') }}">Banners de seção</a>
        <a class="nav-link text-white" href="{{ route('admin.logo.index') }}">Logo</a>
        <a class="nav-link text-white" href="{{ route('admin.contato.index') }}">Contato</a>
        <a class="nav-link text-white" href="{{ route('admin.horarios.index') }}">Horários</a>
    </nav>
</aside>
