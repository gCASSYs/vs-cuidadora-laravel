<?php

namespace App\Providers;

use App\Models\Servico;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        View::composer('partials.topo', function($view){

            $categoriaServico = Servico::query()
            ->where('status_servico_ancora', 'ATIVO')
            ->orderBy('titulo_servico_ancora')
            ->get();

            $view->with('categoriaServico', $categoriaServico);
        });
    }
}
