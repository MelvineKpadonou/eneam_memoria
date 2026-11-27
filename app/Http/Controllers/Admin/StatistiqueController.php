<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\View\View;

class StatistiqueController extends Controller
{
    public function index(): View
    {
        return view('Admin.statistiques');
    }
}
