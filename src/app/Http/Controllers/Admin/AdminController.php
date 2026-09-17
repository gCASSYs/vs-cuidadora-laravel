<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Avaliacao;
use App\Models\Banner;
use App\Models\Diferencial;
use App\Models\FAQ;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'totais' => [
                'Banners' => Banner::count(),
                'Depoimentos' => Avaliacao::count(),
                'FAQ' => FAQ::count(),
                'Diferenciais' => Diferencial::count(),
            ],
        ]);
    }
}
