@extends('layout')

@section('titre', 'Statistiques')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-statistiques icon-gradient bg-mean-fruit"></i>
                </div>
                <div>
                    Statistiques
                    <div class="page-title-subheading">Tableau de bord statistiques</div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="grid grid-cols-2 gap-4">
                    <div class="p-4 bg-gray-100 rounded">
                        <div class="text-3x font-bold text-indigo-600">{{ $nombreMemoires }}</div>
                        <div class="text-sm text-gray-600">Mémoires total</div>
                    </div>
                    <div class="p-4 bg-gray-100 rounded">
                        <div class="text-3x font-bold text-success">0</div>
                        <div class="text-sm text-gray-600">Validés</div>
                    </div>
                    <div class="p-4 bg-gray-100 rounded">
                        <div class="text-3x font-bold text-warning">0</div>
                        <div class="text-sm text-gray-600">En attente</div>
                    </div>
                    <div class="p-4 bg-gray-100 rounded">
                        <div class="text-3x font-bold text-danger">0</div>
                        <div class="text-sm text-gray-600">Rejetés</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
