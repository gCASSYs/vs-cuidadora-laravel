<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; use Illuminate\Support\Facades\DB;
class HorariosController extends Controller { public function index() { return view('admin.horarios.index', ['horarios' => DB::table('tbl_horarios')->orderByDesc('id_horarios')->get()]); } }
