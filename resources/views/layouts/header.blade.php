<div class="app-header header-shadow">
    @include('layouts.logo')

    <div class="app-header__content">

        {{-- Partie gauche : recherche et liens --}}
        <div class="app-header-left">
            <div class="search-wrapper">
                <div class="input-holder">
                    <input type="text" class="search-input" placeholder="Rechercher un mémoire">
                    <button class="search-icon"><span></span></button>
                </div>
                <button class="btn-close"></button>
            </div>
            <ul class="header-menu nav">
                <li class="nav-item">
                    <a href="{{ route('memoires.index') }}" class="nav-link">
                        <i class="nav-link-icon fa fa-book"> </i>
                        Catalogue
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('memoires.create') }}" class="nav-link">
                        <i class="nav-link-icon fa fa-upload"></i>
                        Déposer un mémoire
                    </a>
                </li>
            </ul>
        </div>

        {{-- Partie droite : utilisateur connecté --}}
        <div class="app-header-right">
            @auth
                <div class="header-btn-lg pe-0">
                    <div class="widget-content p-0">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left">
                                <div class="btn-group">
                                    <a data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                        <img width="42" class="rounded-circle"
                                            src="{{ asset('eneam-memoria/assets/images/avatars/1.jpg') }}" alt="">
                                        <i class="fa fa-angle-down ms-2 opacity-8"></i>
                                    </a>
                                    <div tabindex="-1" role="menu" aria-hidden="true"
                                        class="dropdown-menu dropdown-menu-right">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Se déconnecter</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content-left ms-3 header-user-info">
                                <div class="widget-heading">{{ auth()->user()->nom }}</div>
                                <div class="widget-subheading">{{ ucfirst(auth()->user()->role) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endauth
        </div>

    </div>
</div>
