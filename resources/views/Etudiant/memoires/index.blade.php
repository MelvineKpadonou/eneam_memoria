@extends('Etudiant.includes.layout')

@section('titre', 'Catalogue des mémoires')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">Liste des mémoires</h5>
                    <a href="{{ route('memoires.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg"></i> Nouveau mémoire
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Titre</th>
                                    <th>Auteur</th>
                                    <th>Filière</th>
                                    <th>Année</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($memoires as $memoire)
                                <tr>
                                    <td>{{ $memoire->titre }}</td>
                                    {{-- ⚠️ Vérifiez la relation : est-ce auteur->nom ou etudiant->name ? --}}
                                    <td>{{ $memoire->auteur->nom ?? 'Inconnu' }} {{ $memoire->auteur->prenom ?? '' }}</td>
                                    <td>{{ $memoire->filiere->nom }}</td>
                                    <td>{{ $memoire->anneeAcademique->annee }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('memoires.show', $memoire) }}" class="btn btn-sm btn-outline-primary" title="Voir">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('memoires.edit', $memoire) }}" class="btn btn-sm btn-outline-secondary" title="Modifier">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        Aucun mémoire trouvé.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $memoires->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection