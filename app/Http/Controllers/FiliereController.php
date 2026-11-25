<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class FiliereController extends Controller
{
    public function index(): View
    {
        return view('Admin.Filieres.index');
    }

    public function create(): View
    {
        return view('Admin.Filieres.create');
    }

    public function store(): RedirectResponse
    {
        return redirect()->route('admin.filieres.index');
    }

    public function show(Filiere $filiere): RedirectResponse
    {
        return redirect()->route('admin.filieres.index');
    }

    public function edit(Filiere $filiere): View
    {
        return view('Admin.Filieres.edit', ['filiere' => $filiere]);
    }

    public function update(Filiere $filiere): RedirectResponse
    {
        return redirect()->route('admin.filieres.index');
    }

    public function destroy(Filiere $filiere): RedirectResponse
    {
        return redirect()->route('admin.filieres.index');
    }
}
