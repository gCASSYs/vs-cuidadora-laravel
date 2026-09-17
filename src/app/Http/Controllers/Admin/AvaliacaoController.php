<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; use App\Models\Avaliacao;
class AvaliacaoController extends Controller { public function index() { return view('admin.avaliacao.index', ['avaliacoes' => Avaliacao::with('AvaliacaoCliente')->orderByDesc('id_avaliacao')->get()]); } }
