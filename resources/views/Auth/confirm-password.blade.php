@extends('layouts.auth')

@section('titre', 'Confirmation du mot de passe')

@section('content')
    <h5 class="card-title mb-4">Confirmation requise</h5>

    <p class="text-muted">
        Cette zone est protégée. Confirmez votre mot de passe pour continuer.
    </p>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="mb-4">
            <label for="password" class="form-label">Mot de passe</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                   name="password" required autocomplete="current-password" autofocus>
            @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Confirmer</button>
    </form>
@endsection
