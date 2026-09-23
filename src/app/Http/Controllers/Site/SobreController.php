<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Sobre;
use App\Models\Diferencial;
use App\Models\SobreResumo;


class SobreController extends Controller{

public function sobre(){

    // A migration de tbl_sobre_principal não possui status_sobre.
    $Sobre = Sobre::first();

    // tbl_sobre_painel não existe nas migrations; mantém o bloco como conteúdo estático.
    $SobrePainel = (object) [
        'titulo_sobre_painel' => 'Cuidado feito com presença e respeito',
        'subtitulo_sobre_painel' => 'Atendimento pensado para cada família',
        'primeiro_ponto_sobre_painel' => 'Atenção à rotina e às necessidades do idoso.',
        'segundo_ponto_sobre_painel' => 'Comunicação clara e acolhedora com a família.',
        'terceiro_ponto_sobre_painel' => 'Compromisso com segurança, respeito e bem-estar.',
    ];

    $listaDiferencial = Diferencial::where('status_diferencial', 'ATIVO')
      ->inRandomOrder()
      ->get();

    $SobreResumo = SobreResumo::where('status_sobre_resumo', 'ATIVO')->first();


    return view('site.sobre.sobre', compact('Sobre', 'listaDiferencial', 'SobrePainel', 'SobreResumo'));
}
}
