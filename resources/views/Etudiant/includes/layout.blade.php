<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>@yield('titre', 'Accueil')</title>

  @include('Etudiant.includes.css')

  <!-- CSS POUR LA NAV BAR ET LE STICKY FOOTER -->
  <style>
    /* --- NAV BAR --- */
    .header {
        background-color: #ffffff !important;
        box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.1) !important;
        padding: 10px 0 !important;
    }
    .navmenu a, .navmenu a:focus {
        color: #333333 !important;
        font-weight: 500 !important;
    }
    .navmenu a:hover, .navmenu .active {
        color: #47b2e4 !important;
    }
    .header .logo .sitename {
        color: #333333 !important;
    }
    body.index-page main {
        padding-top: 100px !important;
    }
    .btn-getstarted {
        margin-left: 20px;
    }

    /* --- STICKY FOOTER (LE SECRET EST ICI) --- */
    /* On force le body à faire au moins la taille de l'écran et à être un flex container */
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }
    
    /* On force le contenu principal à prendre tout l'espace disponible */
    main.main {
        flex: 1 0 auto; /* Prend tout l'espace restant */
    }
    
    /* On empêche le footer de rétrécir */
    footer.footer {
        flex-shrink: 0; 
    }
  </style>
</head>

<body class="index-page">

  @include('Etudiant.includes.nav_bar')

  <main class="main">
      @yield('content')
  </main>

  @include('Etudiant.includes.footer')

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
  <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>