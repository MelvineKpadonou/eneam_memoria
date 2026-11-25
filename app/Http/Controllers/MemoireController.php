<?php

namespace App\Http\Controllers;

use App\Models\Memoire;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class MemoireController extends Controller
{
    public function index(): View
    {
        return view('Memoires.index');
    }

    public function create(): View
    {
        return view('Memoires.create');
    }

    public function store(): RedirectResponse
    {
        return redirect()->route('memoires.index');
    }

    public function show(Memoire $memoire): View
    {
        return view('Memoires.show', ['memoire' => $memoire]);
    }

    public function edit(Memoire $memoire): View
    {
        return view('Memoires.edit', ['memoire' => $memoire]);
    }

    public function update(Memoire $memoire): RedirectResponse
    {
        return redirect()->route('memoires.index');
    }

    public function destroy(Memoire $memoire): RedirectResponse
    {
        return redirect()->route('memoires.index');
    }

    public function lire(Memoire $memoire): View
    {
        return view('Memoires.lire', ['memoire' => $memoire]);
    }

    public function telecharger(Memoire $memoire): RedirectResponse
    {
        return redirect()->route('memoires.index');
    }

    public function mesMemoires(): View
    {
        return view('Memoires.mes-memoires');
    }
}
