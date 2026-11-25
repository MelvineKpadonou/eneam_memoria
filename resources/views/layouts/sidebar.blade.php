<div class="app-sidebar sidebar-shadow">
    @include('layouts.logo')

    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">

                <li class="app-sidebar__heading">Accueil</li>
                <li>
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-home"></i>
                        Tableau de bord
                    </a>
                </li>

                <li class="app-sidebar__heading">Bibliothèque</li>
                <li>
                    <a href="{{ route('memoires.index') }}"
                        class="{{ request()->routeIs('memoires.index', 'memoires.show') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-albums"></i>
                        Catalogue des mémoires
                    </a>
                </li>
                <li>
                    <a href="{{ route('memoires.create') }}"
                        class="{{ request()->routeIs('memoires.create') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-upload"></i>
                        Déposer un mémoire
                    </a>
                </li>
                <li>
                    <a href="{{ route('memoires.mes') }}"
                        class="{{ request()->routeIs('memoires.mes') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-note2"></i>
                        Mes mémoires
                    </a>
                </li>
                <li>
                    <a href="{{ route('favoris.index') }}"
                        class="{{ request()->routeIs('favoris.*') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-like"></i>
                        Mes favoris
                    </a>
                </li>
                <li>
                    <a href="{{ route('historique.index') }}"
                        class="{{ request()->routeIs('historique.*') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-clock"></i>
                        Historique de lecture
                    </a>
                </li>

                {{-- Visible seulement par le validateur et l'admin --}}
                @if (in_array(auth()->user()?->role, ['validateur', 'admin']))
                    <li class="app-sidebar__heading">Validation</li>
                    <li>
                        <a href="{{ route('validateur.index') }}"
                            class="{{ request()->routeIs('validateur.*') ? 'mm-active' : '' }}">
                            <i class="metismenu-icon pe-7s-check"></i>
                            Mémoires à vérifier
                        </a>
                    </li>
                @endif

                {{-- Visible seulement par l'admin --}}
                @if (auth()->user()?->role === 'admin')
                    <li class="app-sidebar__heading">Administration</li>
                    <li>
                        <a href="{{ route('admin.users.index') }}"
                            class="{{ request()->routeIs('admin.users.*') ? 'mm-active' : '' }}">
                            <i class="metismenu-icon pe-7s-users"></i>
                            Utilisateurs
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.filieres.index') }}"
                            class="{{ request()->routeIs('admin.filieres.*') ? 'mm-active' : '' }}">
                            <i class="metismenu-icon pe-7s-culture"></i>
                            Filières
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.annees.index') }}"
                            class="{{ request()->routeIs('admin.annees.*') ? 'mm-active' : '' }}">
                            <i class="metismenu-icon pe-7s-date"></i>
                            Années académiques
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.mots-cles.index') }}"
                            class="{{ request()->routeIs('admin.mots-cles.*') ? 'mm-active' : '' }}">
                            <i class="metismenu-icon pe-7s-bookmarks"></i>
                            Mots-clés
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.statistiques') }}"
                            class="{{ request()->routeIs('admin.statistiques') ? 'mm-active' : '' }}">
                            <i class="metismenu-icon pe-7s-graph3"></i>
                            Statistiques
                        </a>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</div>
