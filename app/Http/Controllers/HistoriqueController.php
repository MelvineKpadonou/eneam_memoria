<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class HistoriqueController extends Controller
{
    public function index(): View
    {
        return view('Historique.index');
    }
}
