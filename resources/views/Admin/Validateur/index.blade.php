@extends('layout')

@section('titre', 'Mémoires à vérifier')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-albums icon-gradient bg-mean-fruit"></i>
                </div>
                <div>
                    Mémoires à vérifier
                    <div class="page-title-subheading">Liste des mémoires en attente de validation</div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="space-y-4">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-medium text-gray-900">Mémoires en attente</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Titre</th>
                                    <th>Auteur</th>
                                    <th>Filière</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($memoires as $memoire)
                                <tr>
                                    <td>{{ $memoire->titre }}</td>
                                    <td>{{ $memoire->etudiant->name }}</td>
                                    <td>{{ $memoire->filiere->nom }}</td>
                                    <td>
                                        <a href="{{ route('validateur.show', $memoire) }}" class="btn btn-sm btn-icon btn-secondary"><i class="pe-7s-eye"></i></a>
                                        <a href="{{ route('validateur.prendre', $memoire) }}" class="btn btn-sm btn-icon btn-warning"><i class="pe-7s-check"></i></a>
                                        <a href="{{ route('validateur.rejeter', $memoire) }}" class="btn btn-sm btn-icon btn-danger"><i class="pe-7s-close"></i></a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">Aucun mémoire en attente.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
