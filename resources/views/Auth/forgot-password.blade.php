@extends('layouts.auth')

@section('titre', 'Mot de passe oublié')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <h5 class="card-title mb-4">Mot de passe oublié</h5>

    <p class="text-muted">
        Indiquez votre adresse e-mail pour recevoir un lien de réinitialisation.
    </p>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-4">
            <label for="email" class="form-label">Adresse e-mail</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                   name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('login') }}" class="text-sm">Retour à la connexion</a>

            <button type="submit" class="btn btn-primary">Envoyer le lien</button>
        </div>
    </form>
@endsection
