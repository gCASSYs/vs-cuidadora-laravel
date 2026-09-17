<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; use Illuminate\Support\Facades\DB;
class ContatoController extends Controller { public function index() { return view('admin.contato.index', ['contatos' => DB::table('tbl_contato')->orderByDesc('id_contato')->get()]); } }
