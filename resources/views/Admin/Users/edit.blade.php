@extends('layout')

@section('titre', 'Modifier l\'utilisateur')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-user icon-gradient bg-mean-fruit"></i>
                </div>
                <div>
                    Modifier l'utilisateur
                    <div class="page-title-subheading">Modification des informations de l'utilisateur</div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-lg shadow p-6">
                <form action="{{ route('admin.users.update', $user) }}" method="POST"
                      class="space-y-4">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" name="nom" id="nom" value="{{ $user->nom }}"
                               class="form-control @error('nom') is-invalid @enderror">
                        @error('nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="prenom">Prénom</label>
                        <input type="text" name="prenom" id="prenom" value="{{ $user->prenom }}"
                               class="form-control @error('prenom') is-invalid @enderror">
                        @error('prenom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="{{ $user->email }}"
                               class="form-control @error('email') is-invalid @enderror">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="role">Rôle</label>
                        <select name="role" id="role" required
                                class="form-control @error('role') is-invalid @enderror">
                            <option value="" disabled {{ old('role') ? '' : 'selected' }}>Sélectionner un rôle</option>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="validateur" {{ $user->role == 'validateur' ? 'selected' : '' }}>Validateur</option>
                            <option value="auteur" {{ $user->role == 'auteur' ? 'selected' : '' }}>Auteur</option>
                            <option value="etudiant" {{ $user->role == 'etudiant' ? 'selected' : '' }}>Étudiant</option>
                        </select>
                        @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="role_verifie">Rôle vérifié</label>
                        <select name="role_verifie" id="role_verifie"
                                class="form-control @error('role_verifie') is-invalid @enderror">
                            <option value="true" {{ old('role_verifie') == 'true' ? 'selected' : '' }}>Oui</option>
                            <option value="false" {{ old('role_verifie') == 'false' ? 'selected' : '' }}>Non</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="filiere_id">Filière</label>
                        <select name="filiere_id" id="filiere_id"
                                class="form-control @error('filiere_id') is-invalid @enderror">
                            <option value="" disabled {{ old('filiere_id') ? '' : 'selected' }}>Sélectionner une filière</option>
                            @foreach ($filieres as $filiere)
                                <option value="{{ $filiere->id }}" {{ old('filiere_id') == $filiere->id ? 'selected' : '' }}>
                                    {{ $filiere->nom }}
                                </option>
                            @endforeach
                        </select>
                        @error('filiere_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="annee_academique_id">Année académique</label>
                        <select name="annee_academique_id" id="annee_academique_id"
                                class="form-control @error('annee_academique_id') is-invalid @enderror">
                            <option value="" disabled {{ old('annee_academique_id') ? '' : 'selected' }}>Sélectionner une année</option>
                            @foreach ($anneesAcademiques as $annee)
                                <option value="{{ $annee->id }}" {{ old('annee_academique_id') == $annee->id ? 'selected' : '' }}>
                                    {{ $annee->libelle }}
                                </option>
                            @endforeach
                        </select>
                        @error('annee_academique_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="text-right">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                            <i class="pe-7s-back"></i> Annuler
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="pe-7s-save"></i> Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
