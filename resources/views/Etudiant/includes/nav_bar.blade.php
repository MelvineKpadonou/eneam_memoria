<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        {{-- Logo : redirige vers home si visiteur, welcome si connecté --}}
        <a href="{{ auth()->check() ? route('welcome') : url('/') }}" class="logo d-flex align-items-center">
            
            <span class="d-none d-lg-block">ENEAM MEMORIA</span>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                @auth
                    {{-- Liens visibles uniquement par les utilisateurs CONNECTÉS --}}
                    <li>
                        <a href="{{ route('memoires.index') }}"
                            class="{{ request()->routeIs('memoires.index', 'memoires.show') ? 'active' : '' }}">
                            Catalogue
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('favoris.index') }}"
                            class="{{ request()->routeIs('favoris.*') ? 'active' : '' }}">
                            Mes favoris
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('historique.index') }}"
                            class="{{ request()->routeIs('historique.*') ? 'active' : '' }}">
                            Mon historique
                        </a>
                    </li>

                    {{-- Notifications : on vérifie que la route existe et que l'utilisateur est connecté --}}
                    @if(Route::has('notifications.index'))
                        <li>
                            <a href="{{ route('notifications.index') }}"
                                class="{{ request()->routeIs('notifications.*') ? 'active' : '' }}">
                                Notifications
                                @if(auth()->user()->unreadNotifications->count() > 0)
                                    <span class="badge bg-danger">
                                        {{ auth()->user()->unreadNotifications->count() }}
                                    </span>
                                @endif
                            </a>
                        </li>
                    @endif

                    <li>
                        <a href="{{ Route::has('profile.edit') ? route('profile.edit') : '#' }}"
                            class="{{ request()->routeIs('profile.*') ? 'active' : '' }}">
                            Mon profil
                        </a>
                    </li>
                @endauth

                @guest
                    {{-- Liens visibles uniquement par les VISITEURS --}}
                    <li>
                        <a href="{{ route('login') }}">Se connecter</a>
                    </li>
                    @if (Route::has('register'))
                        <li>
                            <a href="{{ route('register') }}">S'inscrire</a>
                        </li>
                    @endif
                @endguest
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        {{-- Bouton de déconnexion (uniquement si connecté) --}}
        @auth
            <a class="btn-getstarted" href="#"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Déconnexion
            </a>
            <form id="logout-form" method="POST" action="{{ route('logout') }}" class="d-none">
                @csrf
            </form>
        @endauth
    </div>
</header>