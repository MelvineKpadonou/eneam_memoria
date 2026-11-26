@extends('layout')

@section('titre', 'Lecture - ' . $memoire->titre)

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-read icon-gradient bg-mean-fruit"></i>
                </div>
                <div>
                    {{ $memoire->titre }}
                    <div class="page-title-subheading">Lecture en ligne du document PDF</div>
                </div>
            </div>
            <div class="page-title-actions">
                <a href="{{ route('memoires.show', $memoire) }}" class="btn-shadow btn btn-secondary me-2">
                    Retour à la fiche
                </a>

                @if ($memoire->telechargement_autorise)
                    <a href="{{ route('memoires.telecharger', $memoire) }}" class="btn-shadow btn btn-primary">
                        Télécharger
                    </a>
                @endif
            </div>
        </div>
    </div>

    <div class="main-card mb-3 card">
        <div class="card-header">
            <i class="fa fa-file-pdf-o me-2"></i>
            Document PDF
        </div>
        <div class="card-body p-0 bg-light">
            <iframe
                src="{{ route('memoires.fichier', $memoire) }}#toolbar=1&navpanes=0&view=FitH"
                title="Lecture de {{ $memoire->titre }}"
                class="w-100"
                style="height: calc(100vh - 260px); min-height: 600px; border: 0;"
            ></iframe>
        </div>
    </div>
@endsection
