<?php

namespace App\Http\Controllers;

use App\Models\Memoire;
use App\Models\User;
use App\Models\ValidationMemoire;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_memoires' => Memoire::count(),
            'memoires_validees' => ValidationMemoire::where('decision', 'validée')->count(),
            'memoires_en_attente' => ValidationMemoire::where('decision', 'en attente')->count(),
            'memoires_rejetees' => ValidationMemoire::where('decision', 'rejetée')->count(),
            'total_etudiants' => User::where('role', 'etudiant')->count(),
            'total_validateurs' => User::where('role', 'validateur')->count(),
        ];

        return response()->json($stats);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show()
    {
        //
    }

    public function edit()
    {
        //
    }

    public function update(Request $request)
    {
        //
    }

    public function destroy()
    {
        //
    }
}
