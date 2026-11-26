@extends('Etudiant.includes.layout')

@section('titre', 'Historique de lecture')

@section('content')
    <section id="historique" class="historique section">
      <div class="container">
        <div class="row gy-4">
          <div class="col-12">
            <div class="section-header mb-5">
              <span class="sub-header">Historique de lecture</span>
              <h2>Votre historique de lecture</h2>
            </div>
          </div>
        </div>

        @if(count($lectures) > 0)
        <div class="historique-list">
          @foreach($lectures as $lecture)
          <div class="historique-item">
            <div class="historique-info">
              <h3>{{ $lecture->memoire->titre }}</h3>
              <span class="historique-date">{{ $lecture->date_lecture->format('d/m/Y') }}</span>
            </div>
            <div class="historique-action">
              <a href="{{ route('memoires.show', $lecture->memoire) }}" class="btn btn-link">Revoir</a>
            </div>
          </div>
          @endforeach
        </div>
        @else
        <div class="no-history">
          <i class="bi bi-clock-empty"></i>
          <h3>Aucune lecture</h3>
          <p>Aucun mémoire n'a été lu pour le moment. Commencez par explorer le catalogue.</p>
        </div>
        @endif
      </div>
    </section>
@endsection