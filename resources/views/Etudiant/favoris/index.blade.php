@extends('Etudiant.includes.layout')

@section('titre', 'Mes favoris')

@section('content')
    <section id="favoris" class="favorites section">
      <div class="container">
        <div class="row gy-4">
          <div class="col-12">
            <div class="section-header mb-5">
              <span class="sub-header">Mes favoris</span>
              <h2>Mémoires en favoris</h2>
            </div>
          </div>
        </div>

        @if(count($memoires) > 0)
        <div class="favorites-grid">
          @foreach($memoires as $memoire)
          <div class="favourite-card">
            <div class="favourite-img">
              <img src="{{ asset('assets/img/placeholder-memoire.jpg') }}" alt="{{ $memoire->titre }}">
            </div>
            <div class="favourite-content">
              <div class="favourite-meta">
                <span>{{ $memoire->filiere->nom }}</span>
                <span>{{ $memoire->anneeAcademique->annee }}</span>
              </div>
              <h3><a href="{{ route('memoires.show', $memoire) }}">{{ $memoire->titre }}</a></h3>
              <p>{{ substr($memoire->resume, 0, 80) }}...</p>
              <a href="{{ route('memoires.show', $memoire) }}" class="btn btn-link">Voir détails</a>
            </div>
          </div>
          @endforeach
        </div>
        @else
        <div class="no-favorites">
          <i class="bi bi-heart-empty"></i>
          <h3>Aucun favori</h3>
          <p>Vous n'avez aucun mémoire en favoris. Cliquez sur le cœur pour ajouter des mémoires à vos favoris.</p>
        </div>
        @endif
      </div>
    </section>
@endsection