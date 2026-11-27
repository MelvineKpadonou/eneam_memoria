<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\View\View;

class ValidateurController extends Controller
{
    public function index(): View
    {
        return view('Validateur.index');
    }
}
