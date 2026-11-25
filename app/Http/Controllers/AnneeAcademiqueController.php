<?php

namespace App\Http\Controllers;

use App\Models\AnneeAcademique;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AnneeAcademiqueController extends Controller
{
    public function index(): View
    {
        return view('Admin.Annees.index');
    }

    public function create(): View
    {
        return view('Admin.Annees.create');
    }

    public function store(): RedirectResponse
    {
        return redirect()->route('admin.annees.index');
    }

    public function show(AnneeAcademique $anneeAcademique): RedirectResponse
    {
        return redirect()->route('admin.annees.index');
    }

    public function edit(AnneeAcademique $anneeAcademique): View
    {
        return view('Admin.Annees.edit', ['anneeAcademique' => $anneeAcademique]);
    }

    public function update(AnneeAcademique $anneeAcademique): RedirectResponse
    {
        return redirect()->route('admin.annees.index');
    }

    public function destroy(AnneeAcademique $anneeAcademique): RedirectResponse
    {
        return redirect()->route('admin.annees.index');
    }
}
