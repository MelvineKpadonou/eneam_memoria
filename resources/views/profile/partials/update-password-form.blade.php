<h5 class="card-title mb-4">Modifier le mot de passe</h5>

<form method="POST" action="{{ route('password.update') }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="current_password" class="form-label">Mot de passe actuel</label>
        <input id="current_password" type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
               name="current_password" autocomplete="current-password">
        @error('current_password', 'updatePassword')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Nouveau mot de passe</label>
        <input id="password" type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror"
               name="password" autocomplete="new-password">
        @error('password', 'updatePassword')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
        <input id="password_confirmation" type="password" class="form-control"
               name="password_confirmation" autocomplete="new-password">
    </div>

    <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>
