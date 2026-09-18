<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sobre;
use App\Models\SobreResumo;

class SobreController extends Controller
{
    /**
     * Lista o conteúdo principal com seu diferencial e os resumos da página.
     */
    public function index()
    {
        return view('admin.sobre.index', [
            'sobre' => Sobre::with('diferencial')->orderByDesc('id_sobre')->get(),
            'resumos' => SobreResumo::orderByDesc('id_sobre_resumo')->get(),
        ]);
    }
}
