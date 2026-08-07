<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\SobreController;
use App\Http\Controllers\Site\ServicoController;


Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/sobre', [SobreController::class, 'sobre'])->name('sobre');
Route::get('/servico', [ServicoController::class, 'servico'])->name('servico');
Route::get('/servico/{id_servico_ancora}', [ServicoController::class, 'servico'])->name('servico.categoria');