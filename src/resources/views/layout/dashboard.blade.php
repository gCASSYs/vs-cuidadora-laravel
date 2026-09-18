<!doctype html>
<html lang="pt-BR">
<head>
    {{-- Configurações básicas e título da página administrativa. --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Painel administrativo')</title>
    {{-- AdminLTE fornece os componentes Bootstrap usados pelo painel. --}}
    <link href="{{ asset('admin/css/adminlte.css') }}" rel="stylesheet">
    {{-- Biblioteca responsável pelos ícones exibidos nos botões e menus. --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">
    {{-- Personalização visual da VS Cuidadora; a versão evita cache antigo. --}}
    <link href="{{ asset('admin/css/style.css') }}?v={{ filemtime(public_path('admin/css/style.css')) }}" rel="stylesheet">
</head>
<body class="vs-admin-body">
    {{-- Estrutura principal: menu lateral à esquerda e área de trabalho à direita. --}}
    <div class="d-flex vs-admin-shell">
        @include('partials.admin.menu-lateral')
        <div class="vs-admin-workspace">
            @include('partials.admin.topo')

            {{-- Conteúdo específico enviado por cada página administrativa. --}}
            <main class="vs-admin-main">
                {{-- Cabeçalho opcional; as listagens o ocultam para não duplicar seus títulos. --}}
                @if (trim($__env->yieldContent('show-page-header', 'true')) !== 'false')
                    <div class="vs-admin-heading border-bottom pb-3 mb-4">
                        <h1 class="h3 mb-0">@yield('title', 'Painel administrativo')</h1>
                    </div>
                @endif
                {{-- Mensagens de retorno das operações administrativas. --}}
                @if (session('sucesso')) <div class="alert alert-success">{{ session('sucesso') }}</div> @endif
                @if (session('erro')) <div class="alert alert-danger">{{ session('erro') }}</div> @endif
                @yield('content')
            </main>
        </div>
    </div>
    {{-- Scripts base do Bootstrap, AdminLTE e comportamentos próprios do painel. --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('admin/js/adminlte.js') }}"></script>
    <script src="{{ asset('vs-cuidadora/js/admin.js') }}"></script>
</body>
</html>
