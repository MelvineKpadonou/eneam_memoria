@extends('Etudiant.includes.layout')

@section('titre', 'Catalogue des mémoires')

@section('content')
    <section id="memoire-catalogue" class="memoire-catalogue section">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6">
            <div class="section-header mb-5">
              <span class="sub-header">Catalogue des mémoires</span>
              <h2>Explorez les mémoires validés</h2>
            </div>
          </div>
          <div class="col-lg-6 text-right">
            <div class="search-box">
              <input type="text" placeholder="Rechercher un mémoire...">
              <button class="btn-search"><i class="bi bi-search"></i></button>
            </div>
          </div>
        </div>

        <div class="memoire-grid">
          @if(count($memoires) > 0)
          @foreach($memoires as $memoire)
          <div class="memoire-card">
            <div class="memoire-img">
              <img src="{{ asset('assets/img/placeholder-memoire.jpg') }}" alt="{{ $memoire->titre }}">
            </div>
            <div class="memoire-content">
              <div class="memoire-meta">
                <span>{{ $memoire->filiere->nom }}</span>
                <span>{{ $memoire->anneeAcademique->annee }}</span>
              </div>
              <h3><a href="{{ route('memoires.show', $memoire) }}">{{ $memoire->titre }}</a></h3>
              <p>{{ substr($memoire->resume, 0, 100) }}...</p>
              <div class="memoire-actions">
                <a href="{{ route('memoires.show', $memoire) }}" class="btn btn-primary btn-sm">Lire en ligne</a>
                @if (auth()->user() && auth()->user()->role === 'etudiant')
                  <a href="{{ route('memoires.telecharger', $memoire) }}" class="btn btn-secondary btn-sm">Télécharger</a>
                @endif
              </div>
            </div>
          </div>
          @endforeach
          @else
          <div class="no-results">
            <i class="bi bi-folder-fill"></i>
            <h3>Aucun mémoire trouvé</h3>
            <p>Aucun mémoire n'est actuellement disponible dans le catalogue.</p>
          </div>
          @endif
        </div>

        {{ $memoires->links() }}
      </div>
    </section>
@endsection