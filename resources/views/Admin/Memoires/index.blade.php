@extends('layout')

@section('titre', 'Catalogue des mémoires')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-albums icon-gradient bg-mean-fruit"></i>
                </div>
                <div>
                    Catalogue des mémoires
                    <div class="page-title-subheading">Liste de tous les mémoires validés</div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="space-y-4">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-medium text-gray-900">Mémoires</h2>
                        <a href="{{ route('admin.memoires.create') }}" class="btn btn-primary">
                            <i class="pe-7s-plus"></i> Nouveau mémoire
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Titre</th>
                                    <th>Auteur</th>
                                    <th>Filière</th>
                                    <th>Année</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($memoires as $memoire)
                                <tr>
                                    <td>{{ $memoire->titre }}</td>
                                    <td>{{ $memoire->etudiant->name }}</td>
                                    <td>{{ $memoire->filiere->nom }}</td>
                                    <td>{{ $memoire->anneeAcademique->annee }}</td>
                                    <td>
                                        <a href="{{ route('admin.memoires.show', $memoire) }}" class="btn btn-sm btn-icon"><i class="pe-7s-eye"></i></a>
                                        <a href="{{ route('admin.memoires.edit', $memoire) }}" class="btn btn-sm btn-icon"><i class="pe-7s-edit"></i></a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Aucun mémoire trouvé.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $memoires->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
