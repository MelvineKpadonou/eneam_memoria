<h5 class="card-title mb-4 text-danger">Supprimer le compte</h5>

<p class="text-muted">
    Cette action est définitive. Téléchargez vos données avant de continuer.
</p>

<form method="POST" action="{{ route('profile.destroy') }}">
    @csrf
    @method('DELETE')

    <div class="mb-3">
        <label for="delete_password" class="form-label">Mot de passe</label>
        <input id="delete_password" type="password" class="form-control @error('password', 'userDeletion') is-invalid @enderror"
               name="password" placeholder="Mot de passe">
        @error('password', 'userDeletion')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-danger">Supprimer mon compte</button>
</form>
