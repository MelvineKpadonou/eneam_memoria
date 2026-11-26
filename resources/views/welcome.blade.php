@extends('Etudiant.includes.layout')

@section('titre', 'Accueil')

@section('content')

    <style>
        /* Animation des livres (page d'accueil connectée) */
        .eneam-books {
            display: block;
            width: 100%;
            max-width: 520px;
            height: auto;
            margin: 0 auto;
        }

        .eneam-books .book {
            transform-box: fill-box;
            transform-origin: 50% 100%;
            animation: eneam-pull 6s ease-in-out infinite;
            animation-delay: calc(var(--i) * .45s);
        }

        @keyframes eneam-pull {

            0%,
            60%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            72%,
            84% {
                transform: translateY(-18px) rotate(-2.5deg);
            }
        }

        .eneam-books .open-book {
            animation: eneam-float 4s ease-in-out infinite;
        }

        @keyframes eneam-float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-12px);
            }
        }

        .eneam-books .flip-page {
            transform-box: fill-box;
            transform-origin: 0% 50%;
            animation: eneam-flip 5s ease-in-out infinite;
        }

        @keyframes eneam-flip {

            0%,
            10% {
                transform: scaleX(1);
                opacity: 1;
            }

            45% {
                transform: scaleX(-1);
                opacity: 1;
            }

            55% {
                transform: scaleX(-1);
                opacity: 0;
            }

            56% {
                transform: scaleX(1);
                opacity: 0;
            }

            70%,
            100% {
                transform: scaleX(1);
                opacity: 1;
            }
        }

        .eneam-books .spark {
            opacity: 0;
            animation: eneam-rise 5s linear infinite;
            animation-delay: calc(var(--i) * 1.2s);
        }

        @keyframes eneam-rise {
            0% {
                transform: translateY(0);
                opacity: 0;
            }

            20% {
                opacity: .9;
            }

            100% {
                transform: translateY(-70px);
                opacity: 0;
            }
        }

        @media (prefers-reduced-motion: reduce) {

            .eneam-books *,
            .eneam-books {
                animation: none !important;
            }

            .eneam-books .spark {
                opacity: .8;
            }
        }
    </style>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section dark-background">

            <div class="container">
                <div class="row gy-4 align-items-center">
                    <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="zoom-out">
                        <h1>Bienvenue, {{ auth()->user()->prenom }}</h1>
                        <p>Retrouvez ici tous les mémoires de l'ENEAM : consultez le catalogue, lisez en ligne, gardez vos
                            favoris et, si vous êtes étudiant, déposez votre propre mémoire.</p>
                        <div class="d-flex">
                            <a href="{{ route('memoires.index') }}" class="btn-get-started">Parcourir le catalogue</a>

                            @if (auth()->user()->role === 'etudiant')
                                <a href="{{ route('memoires.create') }}" class="btn-watch-video d-flex align-items-center">
                                    <i class="bi bi-cloud-arrow-up"></i><span>Déposer un mémoire</span>
                                </a>
                            @else
                                <a href="{{ route('favoris.index') }}" class="btn-watch-video d-flex align-items-center">
                                    <i class="bi bi-bookmark-heart"></i><span>Mes favoris</span>
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-6 order-1 order-lg-2" data-aos="zoom-out" data-aos-delay="200">
                        <svg class="eneam-books" viewBox="0 0 480 400" role="img"
                            aria-label="Livres de la bibliothèque numérique ENEAM Mémoria">
                            <ellipse cx="240" cy="352" rx="200" ry="11" fill="rgba(0,0,0,.2)" />
                            <rect x="40" y="330" width="400" height="14" rx="4" fill="#c58b4e" />
                            <rect x="40" y="330" width="400" height="4" rx="2" fill="#d9a56a" />
                            <g class="book" style="--i:0">
                                <rect x="62" y="212" width="38" height="118" rx="3" fill="#47b2e4" />
                                <rect x="62" y="228" width="38" height="5" fill="rgba(255,255,255,.55)" />
                                <rect x="62" y="304" width="38" height="5" fill="rgba(255,255,255,.55)" />
                                <rect x="95" y="212" width="5" height="118" rx="2" fill="rgba(0,0,0,.12)" />
                            </g>
                            <g class="book" style="--i:1">
                                <rect x="104" y="180" width="30" height="150" rx="3" fill="#f4b942" />
                                <rect x="104" y="196" width="30" height="5" fill="rgba(255,255,255,.55)" />
                                <rect x="104" y="304" width="30" height="5" fill="rgba(255,255,255,.55)" />
                                <rect x="129" y="180" width="5" height="150" rx="2" fill="rgba(0,0,0,.12)" />
                            </g>
                            <g class="book" style="--i:2">
                                <rect x="138" y="226" width="42" height="104" rx="3" fill="#e4572e" />
                                <rect x="138" y="242" width="42" height="5" fill="rgba(255,255,255,.55)" />
                                <rect x="138" y="304" width="42" height="5" fill="rgba(255,255,255,.55)" />
                                <rect x="175" y="226" width="5" height="104" rx="2" fill="rgba(0,0,0,.12)" />
                            </g>
                            <g class="book" style="--i:3">
                                <rect x="184" y="196" width="34" height="134" rx="3" fill="#76b947" />
                                <rect x="184" y="212" width="34" height="5" fill="rgba(255,255,255,.55)" />
                                <rect x="184" y="304" width="34" height="5" fill="rgba(255,255,255,.55)" />
                                <rect x="213" y="196" width="5" height="134" rx="2" fill="rgba(0,0,0,.12)" />
                            </g>
                            <g class="book" style="--i:4">
                                <rect x="222" y="214" width="40" height="116" rx="3" fill="#9b7ede" />
                                <rect x="222" y="230" width="40" height="5" fill="rgba(255,255,255,.55)" />
                                <rect x="222" y="304" width="40" height="5" fill="rgba(255,255,255,.55)" />
                                <rect x="257" y="214" width="5" height="116" rx="2" fill="rgba(0,0,0,.12)" />
                            </g>
                            <g class="book" style="--i:5">
                                <rect x="266" y="184" width="32" height="146" rx="3" fill="#f4f1ea" />
                                <rect x="266" y="200" width="32" height="5" fill="#1e3a5f" />
                                <rect x="266" y="304" width="32" height="5" fill="#1e3a5f" />
                                <rect x="293" y="184" width="5" height="146" rx="2" fill="rgba(0,0,0,.12)" />
                            </g>
                            <g class="book" style="--i:6">
                                <rect x="302" y="208" width="38" height="122" rx="3" fill="#2ec4b6" />
                                <rect x="302" y="224" width="38" height="5" fill="rgba(255,255,255,.55)" />
                                <rect x="302" y="304" width="38" height="5" fill="rgba(255,255,255,.55)" />
                                <rect x="335" y="208" width="5" height="122" rx="2" fill="rgba(0,0,0,.12)" />
                            </g>
                            <g class="book" style="--i:7">
                                <rect x="344" y="192" width="34" height="138" rx="3" fill="#ff8fa3" />
                                <rect x="344" y="208" width="34" height="5" fill="rgba(255,255,255,.55)" />
                                <rect x="344" y="304" width="34" height="5" fill="rgba(255,255,255,.55)" />
                                <rect x="373" y="192" width="5" height="138" rx="2" fill="rgba(0,0,0,.12)" />
                            </g>
                            <g class="book" style="--i:8">
                                <rect x="382" y="222" width="38" height="108" rx="3" fill="#3a8fd6" />
                                <rect x="382" y="238" width="38" height="5" fill="rgba(255,255,255,.55)" />
                                <rect x="382" y="304" width="38" height="5" fill="rgba(255,255,255,.55)" />
                                <rect x="415" y="222" width="5" height="108" rx="2" fill="rgba(0,0,0,.12)" />
                            </g>
                            <g transform="translate(0,-45)">
                                <g class="open-book">
                                    <path
                                        d="M128 118 Q190 98 240 124 Q290 98 352 118 L352 204 Q290 186 240 212 Q190 186 128 204 Z"
                                        fill="#1e3a5f" />
                                    <path d="M240 128 Q196 106 140 116 L140 196 Q196 186 240 208 Z" fill="#ffffff" />
                                    <path d="M240 128 Q284 106 340 116 L340 196 Q284 186 240 208 Z" fill="#eef3fa" />
                                    <path d="M156 138 H222 M156 152 H222 M156 166 H222 M156 180 H208" stroke="#b8c4d6"
                                        stroke-width="3" stroke-linecap="round" fill="none" />
                                    <path d="M258 138 H324 M258 152 H324 M258 166 H324 M258 180 H310" stroke="#c7d1e0"
                                        stroke-width="3" stroke-linecap="round" fill="none" />
                                    <g class="flip-page">
                                        <path d="M240 128 Q284 106 340 116 L340 196 Q284 186 240 208 Z" fill="#ffffff" />
                                        <path d="M258 138 H324 M258 152 H324 M258 166 H324 M258 180 H310" stroke="#b8c4d6"
                                            stroke-width="3" stroke-linecap="round" fill="none" />
                                    </g>
                                    <path d="M240 128 V208" stroke="#cdd6e4" stroke-width="2" />
                                </g>
                            </g>
                            <circle class="spark" style="--i:0" cx="92" cy="150" r="4" fill="#ffffff" />
                            <circle class="spark" style="--i:1" cx="402" cy="140" r="5" fill="#f4b942" />
                            <circle class="spark" style="--i:2" cx="330" cy="60" r="4" fill="#ffffff" />
                            <circle class="spark" style="--i:3" cx="150" cy="70" r="5" fill="#47b2e4" />
                        </svg>
                    </div>
                </div>
            </div>

        </section><!-- /Hero Section -->

        <!-- Apports Section -->
        <section id="apports" class="services section light-background">

            <div class="container section-title" data-aos="fade-up">
                <h2>Ce que ENEAM Mémoria apporte</h2>
                <p>Un seul outil pour conserver, valider et partager le travail de recherche des étudiants.</p>
            </div>

            <div class="container">
                <div class="row gy-4">

                    <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="bi bi-collection icon"></i></div>
                            <h4>Un catalogue centralisé</h4>
                            <p>Fini les mémoires dispersés sur des clés USB ou dans des armoires. Retrouvez-les par titre,
                                auteur, filière, année ou mot-clé.</p>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="bi bi-cloud-arrow-up icon"></i></div>
                            <h4>Dépôt et validation en ligne</h4>
                            <p>L'étudiant dépose son mémoire en PDF et suit son statut. Le validateur l'examine, le valide
                                ou le rejette en indiquant un motif.</p>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="bi bi-shield-lock icon"></i></div>
                            <h4>Une lecture sécurisée</h4>
                            <p>Lecture directement dans le navigateur. Téléchargement, embargo et accès restreint protègent
                                le travail des auteurs.</p>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="400">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="bi bi-bookmark-heart icon"></i></div>
                            <h4>Un suivi personnalisé</h4>
                            <p>Favoris, historique de lecture et notifications : chacun garde la trace de ses lectures et de
                                ses dépôts.</p>
                        </div>
                    </div>

                </div>
            </div>

        </section><!-- /Apports Section -->

        <!-- Fonctionnement Section -->
        <section id="fonctionnement" class="services section">

            <div class="container section-title" data-aos="fade-up">
                <h2>Comment ça marche</h2>
                <p>Trois gestes pour profiter de la bibliothèque.</p>
            </div>

            <div class="container">
                <div class="row gy-4 justify-content-center">

                    <div class="col-lg-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="bi bi-search icon"></i></div>
                            <h4><a href="{{ route('memoires.index') }}" class="stretched-link">1. Parcourez le catalogue</a>
                            </h4>
                            <p>Recherchez un mémoire par titre, auteur, filière, année académique ou mot-clé.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="bi bi-book icon"></i></div>
                            <h4><a href="{{ route('historique.index') }}" class="stretched-link">2. Lisez et gardez la
                                    trace</a></h4>
                            <p>Lisez en ligne, ajoutez vos mémoires préférés aux favoris et retrouvez votre historique de
                                lecture.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="bi bi-patch-check icon"></i></div>
                            <h4>
                                @if (auth()->user()->role === 'etudiant')
                                    <a href="{{ route('memoires.mes') }}" class="stretched-link">3. Déposez et suivez votre
                                        mémoire</a>
                                @else
                                    3. Déposez et suivez votre mémoire
                                @endif
                            </h4>
                            <p>Les étudiants déposent leur PDF, suivent sa validation et sont notifiés dès qu'il est publié.
                            </p>
                        </div>
                    </div>

                </div>
            </div>

        </section><!-- /Fonctionnement Section -->

    </main>
@endsection
