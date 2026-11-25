@extends('layouts.auth')

@section('titre', 'Vérification de l’e-mail')

@section('content')
    <h5 class="card-title mb-4">Vérifiez votre adresse e-mail</h5>

    <p class="text-muted">
        Merci pour votre inscription. Confirmez votre adresse e-mail en cliquant sur le lien envoyé.
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success">
            Un nouveau lien de vérification a été envoyé.
        </div>
    @endif

    <div class="d-flex align-items-center justify-content-between mt-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-primary">Renvoyer le lien</button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-link">Se déconnecter</button>
        </form>
    </div>
@endsection
