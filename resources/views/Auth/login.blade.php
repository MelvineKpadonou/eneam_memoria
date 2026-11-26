@extends('layouts.auth')

@section('titre', 'Connexion')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <h5 class="card-title mb-4">Connexion</h5>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Adresse e-mail</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required autofocus autocomplete="username">
            @error('email')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required autocomplete="current-password">
            @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="form-check mb-0">
                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                <label for="remember_me" class="form-check-label">Se souvenir de moi</label>
            </div>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="small">Mot de passe oublié ?</a>
            @endif
        </div>

        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary">Se connecter</button>
        </div>

        @if (Route::has('register'))
            <p class="text-center mb-0">
                Pas encore de compte ?
                <a href="{{ route('register') }}">S'inscrire</a>
            </p>
        @endif
    </form>
@endsection
