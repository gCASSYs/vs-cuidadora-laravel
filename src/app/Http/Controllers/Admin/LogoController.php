<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; use Illuminate\Support\Facades\DB;
class LogoController extends Controller { public function index() { return view('admin.logo.index', ['logos' => DB::table('tbl_logo')->orderByDesc('id_logo')->get()]); } }
