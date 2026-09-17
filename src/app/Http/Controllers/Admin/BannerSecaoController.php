<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; use Illuminate\Support\Facades\DB;
class BannerSecaoController extends Controller { public function index() { return view('admin.bannerSecao.index', ['bannersSecao' => DB::table('tbl_banner_secao')->orderByDesc('id_banner_secao')->get()]); } }
