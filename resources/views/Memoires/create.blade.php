@extends('layout')

@section('titre', 'Déposer un mémoire')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-albums icon-gradient bg-mean-fruit"></i>
                </div>
                <div>
                    Déposer un mémoire
                    <div class="page-title-subheading">Ajoutez un nouveau mémoire</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="main-card mb-3 card">
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            Le formulaire contient des erreurs. Corrigez les champs en rouge.
                        </div>
                    @endif

                    <form action="{{ route('memoires.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Auteur : l'étudiant connecté (non modifiable) --}}
                        <div class="form-group">
                            <label for="auteur">Auteur</label>
                            <input type="text" id="auteur" class="form-control"
                                   value="{{ auth()->user()->prenom }} {{ auth()->user()->nom }}" disabled>
                        </div>

                        <div class="form-group">
                            <label for="titre">Titre du mémoire</label>
                            <input type="text" name="titre" id="titre" value="{{ old('titre') }}" required
                                   class="form-control @error('titre') is-invalid @enderror">
                            @error('titre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label for="resume">Résumé</label>
                            <textarea name="resume" id="resume" rows="5" required minlength="50"
                                      class="form-control @error('resume') is-invalid @enderror">{{ old('resume') }}</textarea>
                            <small class="form-text text-muted">50 caractères minimum.</small>
                            @error('resume') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="filiere_id">Filière</label>
                                <select name="filiere_id" id="filiere_id" required
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

                            <div class="form-group col-md-6">
                                <label for="annee_academique_id">Année académique</label>
                                <select name="annee_academique_id" id="annee_academique_id" required
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
                        </div>

                        <div class="form-group">
                            <label for="encadreur_id">Encadreur</label>
                            <select name="encadreur_id" id="encadreur_id"
                                    class="form-control @error('encadreur_id') is-invalid @enderror">
                                <option value="">Aucun / non défini</option>
                                @foreach ($encadreurs as $encadreur)
                                    <option value="{{ $encadreur->id }}" {{ old('encadreur_id') == $encadreur->id ? 'selected' : '' }}>
                                        {{ $encadreur->prenom }} {{ $encadreur->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('encadreur_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label>Mots-clés</label>
                            <div>
                                @foreach ($motCles as $motCle)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="mot_cles[]"
                                               id="mot_cle_{{ $motCle->id }}" value="{{ $motCle->id }}"
                                               {{ in_array($motCle->id, old('mot_cles', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="mot_cle_{{ $motCle->id }}">
                                            {{ $motCle->libelle }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            @error('mot_cles') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label for="fichier">Fichier du mémoire (PDF)</label>
                            <input type="file" name="fichier" id="fichier" accept="application/pdf" required
                                   class="form-control-file @error('fichier') is-invalid @enderror">
                            <small class="form-text text-muted">Format PDF uniquement, 20 Mo maximum.</small>
                            @error('fichier') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>

                        <div class="text-right">
                            <a href="{{ route('memoires.index') }}" class="btn btn-secondary">
                                <i class="pe-7s-back"></i> Annuler
                            </a>
                            <button type="reset" class="btn btn-outline-secondary">
                                <i class="pe-7s-close"></i> Effacer
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="pe-7s-upload"></i> Soumettre
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
