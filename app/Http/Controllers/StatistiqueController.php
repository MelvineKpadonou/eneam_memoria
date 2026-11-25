<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class StatistiqueController extends Controller
{
    public function index(): View
    {
        return view('Admin.statistiques');
    }
}
