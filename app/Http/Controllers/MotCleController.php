<?php

namespace App\Http\Controllers;

use App\Models\MotCle;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class MotCleController extends Controller
{
    public function index(): View
    {
        return view('Admin.Mots-cles.index');
    }

    public function create(): View
    {
        return view('Admin.Mots-cles.create');
    }

    public function store(): RedirectResponse
    {
        return redirect()->route('admin.mots-cles.index');
    }

    public function show(MotCle $motCle): RedirectResponse
    {
        return redirect()->route('admin.mots-cles.index');
    }

    public function edit(MotCle $motCle): View
    {
        return view('Admin.Mots-cles.edit', ['motCle' => $motCle]);
    }

    public function update(MotCle $motCle): RedirectResponse
    {
        return redirect()->route('admin.mots-cles.index');
    }

    public function destroy(MotCle $motCle): RedirectResponse
    {
        return redirect()->route('admin.mots-cles.index');
    }
}
