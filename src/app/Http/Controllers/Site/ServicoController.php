<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Servico;



class ServicoController extends Controller{

    public function servico(?int $idServico = null){

        $listaAncora = Servico::where('status_servico_ancora', 'ATIVO')
        ->get();

        $listaFuncional = Servico::with('FuncionalServico')
        ->where('status_servico_ancora', 'ATIVO')
        ->get();
        //dd($listaFuncional);
        
        $listaIncluir = Servico::with('IncluirServico')
        ->where('status_servico_ancora', 'ATIVO')
        ->get();
        //dd($listaIncluir);


        $listaCuidado = Servico::with('CuidadoServico')
        ->where('status_servico_ancora', 'ATIVO')
        ->get();

        if($idServico === null){
            $servicoSelecionado = $listaAncora->first();
        }else{
            $servicoSelecionado = $listaAncora->firstWhere('id_servico_ancora', $idServico);
        }

        abort_if($servicoSelecionado === null, 404, 'Serviço não Encontrado');

        $ancoras = Servico::query()
        ->where('id_servico_ancora', $servicoSelecionado->id_servico_ancora)
        ->where('id_servico_ancora', 'ATIVO')
        ->orderBy('titulo_servico_ancora')
        ->get();
        
 


        return view('site.servico.servico', compact('listaAncora', 'listaFuncional', 'listaIncluir', 'listaCuidado', 'servicoSelecionado', 'ancoras'));
    }
}