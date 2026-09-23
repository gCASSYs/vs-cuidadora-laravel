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


Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/sobre', [SobreController::class, 'sobre'])->name('sobre');
Route::get('/servico', [ServicoController::class, 'servico'])->name('servico');
Route::get('/servico/{id_servico_ancora}', [ServicoController::class, 'servico'])->name('servico.categoria');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    Route::get('/banner', [BannerController::class, 'index'])->name('banner.index');
    // Alteração da Gabriele - cadastrar novo banner
    Route::post('/banner', [BannerController::class, 'store'])
    ->name('banner.store');
    // Alteração da Gabriele - atualizar banner
    Route::put('/banner/{id}', [BannerController::class, 'update'])
    ->name('banner.update');

    // Alteração da Gabriele - ativar ou desativar banner
    Route::patch('/banner/{id}', [BannerController::class, 'status'])
    ->name('banner.status');
    
    Route::get('/depoimentos', [AvaliacaoController::class, 'index'])->name('avaliacao.index');
    Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');
    
    // Alteração de André - CRUD DIFERENCIAL
    Route::get('/diferenciais', [DiferencialController::class, 'index'])->name('diferencial.index');
    Route::post('/diferenciais', [DiferencialController::class, 'store'])->name('diferencial.store');
    Route::put('/diferenciais/{id}', [DiferencialController::class, 'update'])->name('diferencial.update');
    Route::patch('/diferenciais/{id}', [DiferencialController::class, 'status'])->name('diferencial.status');
    
    Route::get('/sobre', [AdminSobreController::class, 'index'])->name('sobre.index');
    Route::get('/servicos', [AdminServicoController::class, 'index'])->name('servico.index');
    Route::get('/banners-secao', [BannerSecaoController::class, 'index'])->name('banner-secao.index');

    // Alteração de André - CRUD LOGOS
    Route::get('/logos', [LogoController::class, 'index'])->name('logo.index');
    Route::post('/logos', [LogoController::class, 'store'])->name('logo.store');
    Route::put('/logos/{id}', [LogoController::class, 'update'])->name('logo.update');
    Route::patch('/logos/{id}', [LogoController::class, 'status'])->name('logo.status');

    Route::get('/contato', [ContatoController::class, 'index'])->name('contato.index');
    Route::get('/horarios', [HorariosController::class, 'index'])->name('horarios.index');
});
