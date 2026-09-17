<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; use App\Models\Diferencial;
class DiferencialController extends Controller { public function index() { return view('admin.diferencial.index', ['diferenciais' => Diferencial::orderByDesc('id_diferencial')->get()]); } }
