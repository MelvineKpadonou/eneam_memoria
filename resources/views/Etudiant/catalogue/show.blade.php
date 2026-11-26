@extends('Etudiant.includes.layout')

@section('titre', 'Détails du mémoire')

@section('content')
    <section id="memoire-detail" class="memoire-detail section">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6">
            <div class="memoire-img">
              <img src="{{ asset('assets/img/placeholder-memoire.jpg') }}" alt="{{ $memoire->titre }}">
            </div>
          </div>
          <div class="col-lg-6">
            <div class="memoire-info">
              <span class="memoire-filiere">{{ $memoire->filiere->nom }}</span>
              <span class="memoire-annee">{{ $memoire->anneeAcademique->annee }}</span>
              <h2>{{ $memoire->titre }}</h2>
              <p class="memoire-auteur">Auteur : {{ $memoire->etudiant->name }}</p>
              <div class="memoire-meta">
                <span>Mots-clés:</span>
                @foreach ($memoire->motsCles as $motCle)
                  <span class="badge bg-indigo-400 ms-1">{{ $motCle->libelle }}</span>
                @endforeach
              </div>
              <p class="memoire-resume">{{ $memoire->resume }}</p>
              <div class="actions-memoires">
                @if (auth()->user())
                  @if ($memoire->telechargement_autorise)
                    <a href="{{ route('memoires.telecharger', $memoire) }}" class="btn btn-primary">
                      <i class="bi bi-download me-2"></i> Télécharger
                    </a>
                  @endif
                  <a href="{{ route('memoires.lire', $memoire) }}" class="btn btn-outline-secondary">
                    <i class="bi bi-eye me-2"></i> Lire en ligne
                  </a>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection