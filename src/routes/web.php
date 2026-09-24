<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\SobreController;
use App\Http\Controllers\Site\ServicoController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\AvaliacaoController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\DiferencialController;
use App\Http\Controllers\Admin\SobreController as AdminSobreController;
use App\Http\Controllers\Admin\ServicoController as AdminServicoController;
use App\Http\Controllers\Admin\BannerSecaoController;
use App\Http\Controllers\Admin\LogoController;
use App\Http\Controllers\Admin\ContatoController;
use App\Http\Controllers\Admin\HorariosController;

// Alteração da Gabriele - controller dos relatórios
use App\Http\Controllers\Admin\RelatorioVaniaController;

use App\Http\Controllers\Auth\LoginController;


/*
|--------------------------------------------------------------------------
| ROTAS PÚBLICAS DO SITE
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'home'])
    ->name('home');

Route::get('/sobre', [SobreController::class, 'sobre'])
    ->name('sobre');

Route::get('/servico', [ServicoController::class, 'servico'])
    ->name('servico');

Route::get('/servico/{id_servico_ancora}', [ServicoController::class, 'servico'])
    ->name('servico.categoria');


/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
|
| Alteração da Gabriele - essas rotas só funcionam
| enquanto o usuário ainda não estiver logado.
|
*/

Route::middleware('guest')->group(function () {

    // mostra a tela de login
    Route::get('/login', [LoginController::class, 'index'])
        ->name('login');


    // faz o login
    Route::post('/login', [LoginController::class, 'login'])
        ->name('login.auth');
});


/*
|--------------------------------------------------------------------------
| ÁREA RESTRITA
|--------------------------------------------------------------------------
|
| Alteração da Gabriele - tudo aqui dentro precisa de login.
|
*/

Route::middleware('auth')->group(function () {


    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    // encerra a sessão
    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');


    /*
    |--------------------------------------------------------------------------
    | PAINEL ADMINISTRATIVO
    |--------------------------------------------------------------------------
    */

    Route::prefix('admin')
        ->name('admin.')
        ->group(function () {


            /*
            |--------------------------------------------------------------------------
            | DASHBOARD
            |--------------------------------------------------------------------------
            */

            Route::get('/dashboard', [AdminController::class, 'dashboard'])
                ->name('dashboard');


            /*
            |--------------------------------------------------------------------------
            | BANNER
            |--------------------------------------------------------------------------
            */

            Route::get('/banner', [BannerController::class, 'index'])
                ->name('banner.index');


            // cadastra um novo banner
            Route::post('/banner', [BannerController::class, 'store'])
                ->name('banner.store');


            // atualiza um banner
            Route::put('/banner/{id}', [BannerController::class, 'update'])
                ->name('banner.update');


            // muda o status do banner
            Route::patch('/banner/{id}', [BannerController::class, 'status'])
                ->name('banner.status');


            /*
            |--------------------------------------------------------------------------
            | DEPOIMENTOS
            |--------------------------------------------------------------------------
            */

            Route::get('/depoimentos', [AvaliacaoController::class, 'index'])
                ->name('avaliacao.index');


            /*
            |--------------------------------------------------------------------------
            | FAQ
            |--------------------------------------------------------------------------
            */

            Route::get('/faq', [FaqController::class, 'index'])
                ->name('faq.index');


            /*
            |--------------------------------------------------------------------------
            | DIFERENCIAIS
            |--------------------------------------------------------------------------
            */

            Route::get('/diferenciais', [DiferencialController::class, 'index'])
                ->name('diferencial.index');


            /*
            |--------------------------------------------------------------------------
            | SOBRE
            |--------------------------------------------------------------------------
            */

            Route::get('/sobre', [AdminSobreController::class, 'index'])
                ->name('sobre.index');


            /*
            |--------------------------------------------------------------------------
            | SERVIÇOS
            |--------------------------------------------------------------------------
            */

            Route::get('/servico', [AdminServicoController::class, 'index'])
                ->name('servico.index');


            // cadastra um novo serviço
            Route::post('/servico', [AdminServicoController::class, 'store'])
                ->name('servico.store');


            // atualiza um serviço
            Route::put('/servico/{id}', [AdminServicoController::class, 'update'])
                ->name('servico.update');


            // muda o status do serviço
            Route::patch('/servico/{id}', [AdminServicoController::class, 'status'])
                ->name('servico.status');


            /*
            |--------------------------------------------------------------------------
            | BANNERS DE SEÇÃO
            |--------------------------------------------------------------------------
            */

            Route::get('/banners-secao', [BannerSecaoController::class, 'index'])
                ->name('banner-secao.index');


            /*
            |--------------------------------------------------------------------------
            | LOGO
            |--------------------------------------------------------------------------
            */

            Route::get('/logos', [LogoController::class, 'index'])
                ->name('logo.index');


            /*
            |--------------------------------------------------------------------------
            | CONTATO
            |--------------------------------------------------------------------------
            */

            Route::get('/contato', [ContatoController::class, 'index'])
                ->name('contato.index');


            // cadastra um novo contato
            Route::post('/contato', [ContatoController::class, 'store'])
                ->name('contato.store');


            // atualiza um contato
            Route::put('/contato/{id}', [ContatoController::class, 'update'])
                ->name('contato.update');


            // muda o status do contato
            Route::patch('/contato/{id}', [ContatoController::class, 'status'])
                ->name('contato.status');


            /*
            |--------------------------------------------------------------------------
            | HORÁRIOS
            |--------------------------------------------------------------------------
            */

            Route::get('/horarios', [HorariosController::class, 'index'])
                ->name('horarios.index');


            /*
            |--------------------------------------------------------------------------
            | RELATÓRIOS
            |--------------------------------------------------------------------------
            |
            */


            // mostra a listagem dos relatórios
            Route::get('/relatorios', [RelatorioVaniaController::class, 'index'])
                ->name('relatorio.index');


            // salva um novo relatório vindo do modal
            Route::post('/relatorios', [RelatorioVaniaController::class, 'store'])
                ->name('relatorio.store');


            // atualiza um relatório que já existe
            Route::put('/relatorios/{id}', [RelatorioVaniaController::class, 'update'])
                ->name('relatorio.update');


            // muda o status do relatório
            Route::patch('/relatorios/{id}', [RelatorioVaniaController::class, 'status'])
                ->name('relatorio.status');

        });
});