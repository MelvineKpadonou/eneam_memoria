<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="{{ route('dashboard') }}" class="logo d-flex align-items-center me-auto">
            {{-- <img src="{{ asset('assets/img/logo.webp') }}" alt="ENEAM Mémoria"> --}}
            <h1 class="sitename">ENEAM Mémoria</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
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

                <li>
                    <a href="{{ Route::has('notifications.index') ? route('notifications.index') : '#' }}"
                        class="{{ request()->routeIs('notifications.*') ? 'active' : '' }}">
                        Notifications
                        @if (Route::has('notifications.index') && auth()->user()->unreadNotifications->count() > 0)
                            <span class="badge bg-danger">{{ auth()->user()->unreadNotifications->count() }}</span>
                        @endif
                    </a>
                </li>

                <li>
                    <a href="{{ Route::has('profile.edit') ? route('profile.edit') : '#' }}"
                        class="{{ request()->routeIs('profile.*') ? 'active' : '' }}">
                        Mon profil
                    </a>
                </li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a class="btn-getstarted" href="#"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Déconnexion
        </a>

        {{-- Formulaire caché : la déconnexion doit se faire en POST --}}
        <form id="logout-form" method="POST" action="{{ route('logout') }}" class="d-none">
            @csrf
        </form>

    </div>
</header>
