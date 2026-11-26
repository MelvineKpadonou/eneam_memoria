@extends('layout')

@section('titre', 'Validation du mémoire')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-albums icon-gradient bg-mean-fruit"></i>
                </div>
                <div>
                    Validation du mémoire
                    <div class="page-title-subheading">Détails du mémoire en cours de validation</div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="space-y-4">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Titre du mémoire</h3>
                        <p class="mt-1 text-gray-600">{{ $memoire->titre }}</p>
                    </div>

                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Auteur</h3>
                        <p class="mt-1 text-gray-600">{{ $memoire->etudiant->name }}</p>
                    </div>

                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Résumé</h3>
                        <p class="mt-1 text-gray-600">{{ $memoire->resume }}</p>
                    </div>

                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Mots clés</h3>
                        <p class="mt-1 text-gray-600">
                            @foreach ($memoire->motsCles as $motCle)
                                <span class="inline-block px-2 py-1 mr-2 mb-1 text-xs font-medium text-gray-700 bg-gray-100 rounded-full">{{ $motCle->libelle }}</span>
                            @endforeach
                            @if ($memoire->motsCles->isEmpty)
                                <span class="text-gray-500">Aucun mot clé</span>
                            @endif
                        </p>
                    </div>

                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Année académique</h3>
                        <p class="mt-1 text-gray-600">{{ $memoire->anneeAcademique->annee }}</p>
                    </div>

                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Filière</h3>
                        <p class="mt-1 text-gray-600">{{ $memoire->filiere->nom }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6 text-center">
        <a href="{{ route('validateur.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 font-medium text-sm rounded-md hover:bg-gray-200">
            <i class="pe-7s-left mr-2"></i>
            Retour à la liste
        </a>
    </div>
@endsection
