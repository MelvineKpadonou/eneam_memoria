@extends('Etudiant.includes.layout')

@section('titre', 'Mes mémoires')

@section('content')
    <section id="mes-memoires" class="mes-memoires section">
      <div class="container">
        <div class="row gy-4">
          <div class="col-12">
            <div class="section-header mb-5">
              <span class="sub-header">Mes mémoires</span>
              <h2>Mes mémoires déposés</h2>
            </div>
          </div>
        </div>

        @if($memoires->count() > 0)
        <div class="memoires-grid">
          @foreach($memoires as $memoire)
          <div class="memoire-card-small">
            <div class="memoire-img-small">
              <img src="{{ asset('assets/img/placeholder-memoire.jpg') }}" alt="{{ $memoire->titre }}">
            </div>
            <div class="memoire-info-small">
              <span class="memoire-filiere">{{ $memoire->filiere->nom }}</span>
              <h3><a href="{{ route('memoires.show', $memoire) }}">{{ $memoire->titre }}</a></h3>
              <p>{{ substr($memoire->resume, 0, 60) }}...</p>
              <div class="memoires-actions">
                <a href="{{ route('memoires.show', $memoire) }}" class="btn btn-link">Voir</a>
                @if ($memoire->telechargement_autorise)
                  <a href="{{ route('memoires.telecharger', $memoire) }}" class="btn btn-link">Télécharger</a>
                @endif
              </div>
            </div>
          </div>
          @endforeach
        </div>
        @else
        <div class="no-memoires">
          <i class="bi bi-folder"></i>
          <h3>Aucun mémoire déposé</h3>
          <p>Vous n'avez encore déposé aucun mémoire. Cliquez ci-dessous pour déposer votre premier mémoire.</p>
          <a href="{{ route('memoires.create') }}" class="btn btn-primary">Déposer un mémoire</a>
        </div>
        @endif
      </div>
    </section>
@endsection