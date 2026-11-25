<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class ValidateurController extends Controller
{
    public function index(): View
    {
        return view('Validateur.index');
    }
}
