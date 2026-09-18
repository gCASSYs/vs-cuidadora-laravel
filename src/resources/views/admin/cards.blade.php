<div class="row g-3">
    <div class="col-sm-6 col-xl-3">
        <div class="card h-100 border-primary shadow-sm">
            <div class="card-body">
                <div class="text-muted">Banners</div>
                <strong class="fs-2">{{ $totais['Banners'] }}</strong>
            </div>
            <a href="{{ route('admin.banner.index') }}" class="card-footer text-decoration-none">Gerenciar banners</a>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card h-100 border-success shadow-sm">
            <div class="card-body">
                <div class="text-muted">Depoimentos</div>
                <strong class="fs-2">{{ $totais['Depoimentos'] }}</strong>
            </div>
            <a href="{{ route('admin.avaliacao.index') }}" class="card-footer text-decoration-none">Ver depoimentos</a>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card h-100 border-warning shadow-sm">
            <div class="card-body">
                <div class="text-muted">Perguntas frequentes</div>
                <strong class="fs-2">{{ $totais['FAQ'] }}</strong>
            </div>
            <a href="{{ route('admin.faq.index') }}" class="card-footer text-decoration-none">Gerenciar FAQ</a>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card h-100 border-info shadow-sm">
            <div class="card-body">
                <div class="text-muted">Diferenciais</div>
                <strong class="fs-2">{{ $totais['Diferenciais'] }}</strong>
            </div>
            <a href="{{ route('admin.diferencial.index') }}" class="card-footer text-decoration-none">Ver diferenciais</a>
        </div>
    </div>
</div>
