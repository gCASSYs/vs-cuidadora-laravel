<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\SobreController;
use App\Http\Controllers\Site\ServicoController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\DiferencialController;
use App\Http\Controllers\Admin\SobreController as AdminSobreController;
use App\Http\Controllers\Admin\ServicoController as AdminServicoController;
use App\Http\Controllers\Admin\BannerSecaoController;
use App\Http\Controllers\Admin\LogoController;
use App\Http\Controllers\Admin\ContatoController;
use App\Http\Controllers\Admin\AgendamentoController;
use App\Http\Controllers\Admin\HorariosController;
use App\Http\Controllers\Admin\AvaliacaoController;

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
            | AGENDAMENTO
            |--------------------------------------------------------------------------
            */


            Route::get('/agendamento', [AgendamentoController::class, 'agendamento'])
                ->name('agendamento.index');

            
            Route::post('/agendamento', [AgendamentoController::class, 'store'])
                ->name('agendamento.store');


            
            Route::put('/agendamento/{id}', [AgendamentoController::class, 'update'])
                ->name('agendamento.update');


            
            Route::patch('/agendamento/{id}', [AgendamentoController::class, 'status'])
                ->name('agendamento.status');

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
            | AVALIAÇÃO
            |--------------------------------------------------------------------------
            */

            Route::get('/avaliacao', [AvaliacaoController::class, 'avaliacao'])->name('avaliacao.index');
            Route::post('/avaliacao', [AvaliacaoController::class, 'store'])->name('avaliacao.store');
            Route::put('/avaliacao/{id}', [AvaliacaoController::class, 'update'])->name('avaliacao.update');
            Route::patch('/avaliacao/{id}', [AvaliacaoController::class, 'status'])->name('avaliacao.status');

            /*
            |--------------------------------------------------------------------------
            | BANNER-SEÇÃO
            |--------------------------------------------------------------------------
            */

            Route::get('/banner-secao', [BannerSecaoController::class, 'index'])->name('bannerSecao.index');
            Route::post('/banner-secao', [BannerSecaoController::class, 'store'])->name('bannerSecao.store');
            Route::put('/banner-secao/{id}', [BannerSecaoController::class, 'update'])->name('bannerSecao.update');
            Route::patch('/banner-secao/{id}', [BannerSecaoController::class, 'status'])->name('bannerSecao.status');;



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
            Route::get('/horarios', [HorariosController::class, 'index'])->name('horarios.index');
            Route::post('/horarios', [HorariosController::class, 'store'])->name('horarios.store');
            Route::put('/horarios/{id}', [HorariosController::class, 'update'])->name('horarios.update');
            Route::patch('/horarios/{id}', [HorariosController::class, 'status'])->name('horarios.status');;


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
