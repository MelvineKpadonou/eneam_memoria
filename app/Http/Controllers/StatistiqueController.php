<?php

namespace App\Http\Controllers;

use App\Models\Memoire;
use App\Models\User;
use App\Models\ValidationMemoire;
use Illuminate\Http\Request;

class StatistiqueController extends Controller
{
    public function index()
    {
        $stats = [
            'total_memoires' => Memoire::count(),
            'memoires_par_filiere' => Memoire::withCount('filiere')->get(['id', 'filiere_id'])->groupBy('filiere_id'),
            'memoires_validees' => ValidationMemoire::where('decision', 'validée')->count(),
            'memoires_en_attente' => ValidationMemoire::where('decision', 'en attente')->count(),
            'memoires_rejetees' => ValidationMemoire::where('decision', 'rejetée')->count(),
            'total_etudiants' => User::where('role', 'etudiant')->count(),
            'total_validateurs' => User::where('role', 'validateur')->count(),
            'validations_par_mois' => ValidationMemoire::selectRaw('YEAR(date_decision) as year, MONTH(date_decision) as month, COUNT(*) as count')
                ->groupBy('year', 'month')
                ->orderBy('year', 'month')
                ->get(),
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
