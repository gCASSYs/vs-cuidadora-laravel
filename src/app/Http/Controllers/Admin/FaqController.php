<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; use App\Models\FAQ;
class FaqController extends Controller { public function index() { return view('admin.faq.index', ['faqs' => FAQ::orderByDesc('id_faq')->get()]); } }
