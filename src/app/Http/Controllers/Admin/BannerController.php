<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;

class BannerController extends Controller
{
    /**
     * Exibe os banners em modo somente leitura.
     */
    public function index()
    {
        return view('admin.banner.index', [
            'banners' => Banner::orderByDesc('id_banner')->get(),
        ]);
    }
}
