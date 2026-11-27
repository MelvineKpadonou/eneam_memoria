<?php

namespace App\Http\Controllers\Admin;

use App\Models\Memoire;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ValidationMemoireController extends Controller
{
    public function show(Memoire $memoire): View
    {
        return view('Validateur.show', ['memoire' => $memoire]);
    }

    public function prendreEnCharge(Memoire $memoire): RedirectResponse
    {
        return redirect()->route('validateur.index');
    }

    public function valider(Memoire $memoire): RedirectResponse
    {
        return redirect()->route('validateur.index');
    }

    public function rejeter(Memoire $memoire): RedirectResponse
    {
        return redirect()->route('validateur.index');
    }
}
