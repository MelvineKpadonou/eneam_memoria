@extends('layout')

@section('titre', 'Vérification des rôles')

@section('content')
<div class="container py-5">
    <h1>Utilisateurs en attente de vérification</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Matricule</th>
                <th>Rôle déclaré</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($usersEnAttente as $user)
            <tr>
                <td>{{ $user->nom }}</td>
                <td>{{ $user->prenom }}</td>
                <td>{{ $user->matricule }}</td>
                <td>
                    <span class="badge bg-info">{{ $user->role }}</span>
                </td>
                <td>
                    <form action="{{ route('admin.users.valider', $user) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-sm btn-success">Valider le rôle</button>
                    </form>

                    <form action="{{ route('admin.users.changerRole', $user) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <select name="nouveau_role" class="form-select form-select-sm d-inline w-auto">
                            <option value="lecteur">Lecteur</option>
                            <option value="auteur">Auteur</option>
                        </select>
                        <button class="btn btn-sm btn-warning">Changer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Aucun utilisateur en attente de vérification.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $usersEnAttente->links() }}
</div>
@endsection
