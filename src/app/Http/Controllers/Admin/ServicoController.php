<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 
use App\Models\Servico;

class ServicoController extends Controller { 
    
    
    public function index() 
    
    { 
        
        return view('admin.servico.index', ['servicos' => Servico::orderByDesc('id_servico_ancora')->get()]); 
    
    } 

}
