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
| Alteração da Gabriele - estas rotas só podem ser acessadas
| quando o usuário ainda não estiver autenticado.
|
*/

Route::middleware('guest')->group(function () {

    // Alteração da Gabriele - exibe a tela de login
    Route::get('/login', [LoginController::class, 'index'])
        ->name('login');


    // Alteração da Gabriele - processa o login
    Route::post('/login', [LoginController::class, 'login'])
        ->name('login.auth');
});


/*
|--------------------------------------------------------------------------
| ÁREA RESTRITA
|--------------------------------------------------------------------------
|
| Alteração da Gabriele - todas as rotas dentro deste grupo
| exigem que o usuário esteja autenticado.
|
*/

Route::middleware('auth')->group(function () {


    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    // Alteração da Gabriele - encerra a sessão do usuário
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


            // Alteração da Gabriele - cadastrar novo banner
            Route::post('/banner', [BannerController::class, 'store'])
                ->name('banner.store');


            // Alteração da Gabriele - atualizar banner
            Route::put('/banner/{id}', [BannerController::class, 'update'])
                ->name('banner.update');


            // Alteração da Gabriele - ativar ou desativar banner
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

            // Alteração de André - CRUD DIFERENCIAL
            Route::get('/diferenciais', [DiferencialController::class, 'index'])->name('diferencial.index');
            Route::post('/diferenciais', [DiferencialController::class, 'store'])->name('diferencial.store');
            Route::put('/diferenciais/{id}', [DiferencialController::class, 'update'])->name('diferencial.update');
            Route::patch('/diferenciais/{id}', [DiferencialController::class, 'status'])->name('diferencial.status');


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


            // Alteração da Gabriele - cadastrar novo serviço
            Route::post('/servico', [AdminServicoController::class, 'store'])
                ->name('servico.store');


            // Alteração da Gabriele - atualizar serviço
            Route::put('/servico/{id}', [AdminServicoController::class, 'update'])
                ->name('servico.update');


            // Alteração da Gabriele - ativar ou desativar serviço
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

            // Alteração de André - CRUD LOGOS
            Route::get('/logos', [LogoController::class, 'index'])
                ->name('logo.index');
            Route::post('/logos', [LogoController::class, 'store'])->name('logo.store');
            Route::put('/logos/{id}', [LogoController::class, 'update'])->name('logo.update');
            Route::patch('/logos/{id}', [LogoController::class, 'status'])->name('logo.status');


            /*
            |--------------------------------------------------------------------------
            | CONTATO
            |--------------------------------------------------------------------------
            */

            Route::get('/contato', [ContatoController::class, 'index'])
                ->name('contato.index');


            // Alteração da Gabriele - cadastrar contato
            Route::post('/contato', [ContatoController::class, 'store'])
                ->name('contato.store');


            // Alteração da Gabriele - atualizar contato
            Route::put('/contato/{id}', [ContatoController::class, 'update'])
                ->name('contato.update');


            // Alteração da Gabriele - ativar ou desativar contato
            Route::patch('/contato/{id}', [ContatoController::class, 'status'])
                ->name('contato.status');


            /*
            |--------------------------------------------------------------------------
            | HORÁRIOS
            |--------------------------------------------------------------------------
            */

            Route::get('/horarios', [HorariosController::class, 'index'])
                ->name('horarios.index');

        });
});