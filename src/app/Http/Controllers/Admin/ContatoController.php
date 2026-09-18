<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ContatoController extends Controller
{
    /**
     * Lista os contatos com os dados legíveis do horário relacionado.
     */
    public function index()
    {
        $contatos = DB::table('tbl_contato')
            ->leftJoin('tbl_horarios', 'tbl_horarios.id_horarios', '=', 'tbl_contato.id_horarios')
            ->select([
                'tbl_contato.*',
                'tbl_horarios.horario_horarios',
                'tbl_horarios.formato_horarios',
                'tbl_horarios.regiao_horarios',
            ])
            ->orderByDesc('tbl_contato.id_contato')
            ->get();

        return view('admin.contato.index', compact('contatos'));
    }
}
