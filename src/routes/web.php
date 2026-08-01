<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\HomeController;


Route::get('/', [HomeController::class, 'home'])->name('home');
