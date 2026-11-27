<?php

namespace App\Http\Controllers\Etudiant;

use Illuminate\Contracts\View\View;

class HistoriqueController extends Controller
{
    public function index(): View
    {
        return view('Historique.index');
    }
}
