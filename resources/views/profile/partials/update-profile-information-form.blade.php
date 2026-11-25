<h5 class="card-title mb-4">Informations du profil</h5>

<form id="send-verification" method="POST" action="{{ route('verification.send') }}">
    @csrf
</form>

<form method="POST" action="{{ route('profile.update') }}">
    @csrf
    @method('PATCH')

    <div class="mb-3">
        <label for="nom" class="form-label">Nom</label>
        <input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror"
               name="nom" value="{{ old('nom', $user->nom) }}" required autofocus>
        @error('nom')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="prenom" class="form-label">Prénom</label>
        <input id="prenom" type="text" class="form-control @error('prenom') is-invalid @enderror"
               name="prenom" value="{{ old('prenom', $user->prenom) }}" required>
        @error('prenom')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="matricule" class="form-label">Matricule</label>
        <input id="matricule" type="text" class="form-control @error('matricule') is-invalid @enderror"
               name="matricule" value="{{ old('matricule', $user->matricule) }}" required>
        @error('matricule')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label for="email" class="form-label">Adresse e-mail</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
               name="email" value="{{ old('email', $user->email) }}" required autocomplete="username">
        @error('email')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="mt-2">
                <p class="text-muted small">
                    Votre adresse e-mail n’est pas vérifiée.
                    <button form="send-verification" class="btn btn-link p-0">Renvoyer le lien</button>
                </p>
            </div>
        @endif
    </div>

    <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>
