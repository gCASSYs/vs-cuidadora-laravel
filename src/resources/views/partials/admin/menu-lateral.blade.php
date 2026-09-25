<aside
    id="admin-sidebar"
    class="bg-dark text-white p-3"
    style="width: 250px"
>

    {{-- Marca do painel; ao clicar, retorna ao dashboard --}}
    <div class="sidebar-brand">

        <a
            class="brand-link"
            href="{{ route('admin.dashboard') }}"
            aria-label="Ir para o dashboard"
        >

            <img
                src="{{ asset('vs-cuidadora/assets/logo_inteira.svg') }}"
                alt="Logo Vânia Cuidadora"
                class="brand-image"
            />

        </a>

    </div>

    {{-- Navegação principal do painel administrativo --}}
    <nav
        class="nav flex-column gap-1"
        aria-label="Navegação administrativa"
    >

        {{-- Dashboard --}}
        <a
            class="nav-link text-white
            {{ request()->routeIs('admin.dashboard') ? 'bg-secondary rounded' : '' }}"
            href="{{ route('admin.dashboard') }}"
        >
            Dashboard
        </a>

        <small class="text-white-50 mt-3 px-2">
            GESTÃO
        </small>

        {{-- Alteração da Gabriele - opções de gestão --}}

        <a
            class="nav-link text-white {{ request()->routeIs('admin.cliente.*') ? 'bg-secondary rounded' : '' }}"
            href="{{ route('admin.cliente.index') }}"
        >
            Clientes
        </a>

        <a
            class="nav-link text-white"
            href="#"
        >
            Idosos
        </a>

        <a
            class="nav-link text-white"
            href="#"
        >
            Agendamentos
        </a>

        <a
            class="nav-link text-white
            {{ request()->routeIs('admin.relatorio.*') ? 'bg-secondary rounded' : '' }}"
            href="{{ route('admin.relatorio.index') }}"
        >
            Relatórios
        </a>


        {{-- ============================================================ --}}
        {{-- CONTEÚDO DO SITE --}}
        {{-- ============================================================ --}}

        <small class="text-white-50 mt-3 px-2">
            CONTEÚDO DO SITE
        </small>



        {{-- Banners --}}
        <a
            class="nav-link text-white
            {{ request()->routeIs('admin.banner.*') ? 'bg-secondary rounded' : '' }}"
            href="{{ route('admin.banner.index') }}"
        >
            Banners
        </a>



        {{-- Banners de seção --}}
        <a
            class="nav-link text-white
            {{ request()->routeIs('admin.banner-secao.*') ? 'bg-secondary rounded' : '' }}"
            href="{{ route('admin.banner-secao.index') }}"
        >
            Banners de seção
        </a>



        {{-- Sobre --}}
        <a
            class="nav-link text-white
            {{ request()->routeIs('admin.sobre.*') ? 'bg-secondary rounded' : '' }}"
            href="{{ route('admin.sobre.index') }}"
        >
            Sobre
        </a>



        {{-- Serviços --}}
        <a
            class="nav-link text-white
            {{ request()->routeIs('admin.servico.*') ? 'bg-secondary rounded' : '' }}"
            href="{{ route('admin.servico.index') }}"
        >
            Serviços
        </a>



        {{-- Diferenciais --}}
        <a
            class="nav-link text-white
            {{ request()->routeIs('admin.diferencial.*') ? 'bg-secondary rounded' : '' }}"
            href="{{ route('admin.diferencial.index') }}"
        >
            Diferenciais
        </a>



        {{-- Depoimentos --}}
        <a
            class="nav-link text-white
            {{ request()->routeIs('admin.avaliacao.*') ? 'bg-secondary rounded' : '' }}"
            href="{{ route('admin.avaliacao.index') }}"
        >
            Depoimentos
        </a>



        {{-- FAQ --}}
        <a
            class="nav-link text-white
            {{ request()->routeIs('admin.faq.*') ? 'bg-secondary rounded' : '' }}"
            href="{{ route('admin.faq.index') }}"
        >
            FAQ
        </a>



        {{-- Contato --}}
        <a
            class="nav-link text-white
            {{ request()->routeIs('admin.contato.*') ? 'bg-secondary rounded' : '' }}"
            href="{{ route('admin.contato.index') }}"
        >
            Contato
        </a>



        {{-- Horários --}}
        <a
            class="nav-link text-white
            {{ request()->routeIs('admin.horarios.*') ? 'bg-secondary rounded' : '' }}"
            href="{{ route('admin.horarios.index') }}"
        >
            Horários
        </a>

        {{-- Logo --}}
        <a
            class="nav-link text-white
            {{ request()->routeIs('admin.logo.*') ? 'bg-secondary rounded' : '' }}"
            href="{{ route('admin.logo.index') }}"
        >
            Logo
        </a>

        {{-- ============================================================ --}}
        {{-- CONFIGURAÇÕES --}}
        {{-- ============================================================ --}}

        <small class="text-white-50 mt-3 px-2">
            CONFIGURAÇÕES
        </small>


        <a
            class="nav-link text-white"
            href="#"
        >
            Conta
        </a>


    </nav>

</aside>