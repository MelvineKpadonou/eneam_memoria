@extends('layouts.auth')

@section('titre', 'Inscription')

@section('content')
    <h5 class="card-title mb-4">Créer un compte</h5>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror"
                   name="nom" value="{{ old('nom') }}" required autofocus autocomplete="family-name">
            @error('nom')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input id="prenom" type="text" class="form-control @error('prenom') is-invalid @enderror"
                   name="prenom" value="{{ old('prenom') }}" required autocomplete="given-name">
            @error('prenom')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="matricule" class="form-label">Matricule</label>
            <input id="matricule" type="text" class="form-control @error('matricule') is-invalid @enderror"
                   name="matricule" value="{{ old('matricule') }}" required>
            @error('matricule')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Adresse e-mail</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                   name="email" value="{{ old('email') }}" required autocomplete="username">
            @error('email')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                   name="password" required autocomplete="new-password">
            @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
            <input id="password_confirmation" type="password" class="form-control"
                   name="password_confirmation" required autocomplete="new-password">
        </div>

        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('login') }}" class="text-sm">Déjà inscrit ?</a>

            <button type="submit" class="btn btn-primary">S'inscrire</button>
        </div>
    </form>
@endsection
