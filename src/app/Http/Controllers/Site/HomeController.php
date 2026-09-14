<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\FAQ;
use App\Models\SobreResumo;
use App\Models\ServicoTopico;
use App\Models\Diferencial;
use App\Models\Avaliacao;
use App\Models\Cliente;

class HomeController extends Controller
{
    public function home()
    {

      $listaFaq = FAQ::where('status_faq', 'ATIVO')->get();
      // dd($listaFaq);

      $SobreResumo = SobreResumo::where('status_sobre_resumo', 'ATIVO')->first();

      $listaTopico = ServicoTopico::where('status_servico', 'ATIVO')
        ->inRandomOrder()
        ->get(); 

      $listaDiferencial = Diferencial::where('status_diferencial', 'ATIVO')
      ->inRandomOrder()
      ->get();

      $listaAvaliacao = Cliente::with('ClienteAvaliacao')
      ->where('status_cliente', 'ATIVO')
      ->inRandomOrder()
      ->get();
      

      return view('site.home.home', compact('listaTopico', 'listaDiferencial', 'listaAvaliacao', 'listaFaq', 'SobreResumo'));
    }
}