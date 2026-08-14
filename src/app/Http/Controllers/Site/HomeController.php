<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\FAQ;
use App\Models\SobreResumo;

class HomeController extends Controller
{
    public function home()
    {

        $listaFaq = FAQ::where('status_faq', 'ATIVO')->get();
        // dd($listaFaq);

        $SobreResumo = SobreResumo::where('status_sobre_resumo', 'ATIVO')->first();

        return view('site.home.home', compact('listaFaq', 'SobreResumo'));
    }
}