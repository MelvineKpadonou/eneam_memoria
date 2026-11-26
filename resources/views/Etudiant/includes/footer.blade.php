<footer id="footer" class="footer">

    <div class="container footer-top">
      <div class="row gy-4">

        {{-- Informations de la bibliothèque --}}
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="{{ route('dashboard') }}" class="d-flex align-items-center">
            <span class="sitename">ENEAM Mémoria</span>
          </a>
          <div class="footer-contact pt-3">
            <p>École Nationale d'Économie Appliquée et de Management (ENEAM)</p>
            <p>Université d'Abomey-Calavi</p>
            <p>Cotonou, Bénin</p>
            <p class="mt-3">
              <strong>Site web :</strong>
              <span><a href="http://eneam.uac.bj/" target="_blank" rel="noopener">eneam.uac.bj</a></span>
            </p>

            <p><strong>Téléphone :</strong> <span>...</span></p>
            <p><strong>E-mail :</strong> <span>...</span></p>
            --}}
          </div>
        </div>

        {{-- Liens de la bibliothèque --}}
        <div class="col-lg-3 col-md-6 footer-links">
          <h4>Bibliothèque</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="{{ route('memoires.index') }}">Catalogue des mémoires</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="{{ route('favoris.index') }}">Mes favoris</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="{{ route('historique.index') }}">Mon historique de lecture</a></li>
            @if (Route::has('notifications.index'))
              <li><i class="bi bi-chevron-right"></i> <a href="{{ route('notifications.index') }}">Notifications</a></li>
            @endif
            @if (Route::has('profile.edit'))
              <li><i class="bi bi-chevron-right"></i> <a href="{{ route('profile.edit') }}">Mon profil</a></li>
            @endif
          </ul>
        </div>

        {{-- Espace réservé aux étudiants --}}
        @if (auth()->user()->role === 'etudiant')
          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Étudiants</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="{{ route('memoires.create') }}">Déposer un mémoire</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="{{ route('memoires.mes') }}">Mes mémoires</a></li>
            </ul>
          </div>
        @endif

        {{-- Le projet --}}
        <div class="col-lg-3 col-md-6">
          <h4>Le projet</h4>
          <p>ENEAM Mémoria conserve, valide et met à disposition les mémoires des étudiants de l'école, pour valoriser leur travail de recherche et le rendre accessible à toute la communauté.</p>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>{{ date('Y') }}</span> <strong class="px-1 sitename">ENEAM Mémoria</strong> <span>Tous droits réservés</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        Template conçu par <a href="https://bootstrapmade.com/">BootstrapMade</a> &amp; <a href="https://foliopage.com">FolioPage</a>
      </div>
    </div>

  </footer>
