<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Sobre;
use App\Models\SobrePainel;
use App\Models\SobreResumo;

class SobreController extends Controller{

public function sobre(){

    $Sobre = Sobre::where('status_sobre', 'ATIVO')->first();

    $SobrePainel = SobrePainel::where('status_sobre_painel', 'ATIVO')->first();
    // dd($SobrePainel);

    $SobreResumo = SobreResumo::where('status_sobre_resumo', 'ATIVO')->first();


    return view('site.sobre.sobre', compact('Sobre', 'SobrePainel', 'SobreResumo'));
}
}
