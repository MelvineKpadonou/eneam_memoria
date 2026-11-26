<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>ENEAM Mémoria - Bibliothèque numérique des mémoires</title>
  <meta name="description" content="Bibliothèque numérique des mémoires de l'ENEAM">
  <meta name="keywords" content="ENEAM, mémoires, bibliothèque, numérique">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto">
        <!-- Vous pouvez remplacer par le logo de l'ENEAM -->
        <h1 class="sitename">ENEAM Mémoria</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Accueil</a></li>
          <!-- Liens pour visiteurs : Connexion et Inscription -->
          <li><a href="{{ route('login') }}">Se connecter</a></li>
          @if (Route::has('register'))
            <li><a href="{{ route('register') }}">S'inscrire</a></li>
          @endif
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="zoom-out">
            <h1>La bibliothèque numérique des mémoires de l'ENEAM</h1>
            <p>Consultez, recherchez et explorez les travaux de recherche des étudiants de l'École Nationale d'Économie Appliquée et de Management.</p>
            <div class="d-flex">
              <a href="{{ route('login') }}" class="btn-get-started">Se connecter</a>
              @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn-watch-video d-flex align-items-center ms-3">
                  <i class="bi bi-person-plus"></i><span>Créer un compte étudiant</span>
                </a>
              @endif
            </div>
          </div>
          <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="200">
            <!-- Remplacez cette image par une illustration de livres ou de l'école -->
            <img src="{{ asset('assets/img/hero-img.png') }}" class="img-fluid animated" alt="Bibliothèque numérique">
          </div>
        </div>
      </div>
    </section><!-- /Hero Section -->

    <!-- About Section (Présentation du projet) -->
    <section id="about" class="about section">
      <div class="container section-title" data-aos="fade-up">
        <h2>À propos de la plateforme</h2>
      </div>

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
            <p>
              ENEAM Mémoria est un outil conçu pour centraliser, sécuriser et valoriser le travail de recherche des étudiants de l'école.
            </p>
            <ul>
              <li><i class="bi bi-check2-circle"></i> <span>Un catalogue centralisé de tous les mémoires.</span></li>
              <li><i class="bi bi-check2-circle"></i> <span>Un circuit de validation rigoureux avant publication.</span></li>
              <li><i class="bi bi-check2-circle"></i> <span>Une lecture en ligne sécurisée et respectueuse des droits d'auteur.</span></li>
            </ul>
          </div>
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <p>Les étudiants peuvent déposer leurs travaux en format PDF, suivre l'état d'avancement de leur validation et être notifiés dès que leur mémoire est publié. Les enseignants et la direction disposent quant à eux d'un outil fiable pour archiver et consulter les travaux.</p>
          </div>
        </div>
      </div>
    </section><!-- /About Section -->

    <!-- Services Section (Ce que propose la plateforme) -->
    <section id="services" class="services section light-background">
      <div class="container section-title" data-aos="fade-up">
        <h2>Ce que vous pouvez faire</h2>
        <p>Un accès simple et sécurisé pour toute la communauté de l'ENEAM.</p>
      </div>

      <div class="container">
        <div class="row gy-4">

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item position-relative">
              <div class="icon"><i class="bi bi-search icon"></i></div>
              <h4>Rechercher</h4>
              <p>Trouvez un mémoire par titre, auteur, filière, année académique ou mot-clé.</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item position-relative">
              <div class="icon"><i class="bi bi-book icon"></i></div>
              <h4>Lire en ligne</h4>
              <p>Consultez directement les mémoires dans votre navigateur sans les télécharger.</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item position-relative">
              <div class="icon"><i class="bi bi-cloud-arrow-up icon"></i></div>
              <h4>Déposer</h4>
              <p>Les étudiants en fin de cycle peuvent soumettre leur mémoire en PDF.</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="400">
            <div class="service-item position-relative">
              <div class="icon"><i class="bi bi-bookmark-heart icon"></i></div>
              <h4>Suivre</h4>
              <p>Gardez une trace de vos lectures avec les favoris et l'historique.</p>
            </div>
          </div>

        </div>
      </div>
    </section><!-- /Services Section -->

    <!-- Work Process Section (Comment ça marche) -->
    <section id="work-process" class="work-process section">
      <div class="container section-title" data-aos="fade-up">
        <h2>Comment ça marche ?</h2>
        <p>Trois étapes simples pour accéder à la bibliothèque.</p>
      </div>

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-5">

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="steps-item">
              <div class="steps-content">
                <div class="steps-number">01</div>
                <h3>Créez votre compte</h3>
                <p>Inscrivez-vous avec votre matricule ou votre e-mail institutionnel pour rejoindre la plateforme.</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
            <div class="steps-item">
              <div class="steps-content">
                <div class="steps-number">02</div>
                <h3>Recherchez un mémoire</h3>
                <p>Utilisez la barre de recherche pour trouver le mémoire qui vous intéresse par filière, auteur ou mot-clé.</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="400">
            <div class="steps-item">
              <div class="steps-content">
                <div class="steps-number">03</div>
                <h3>Lisez ou déposez</h3>
                <p>Consultez les mémoires en ligne, ou déposez le vôtre si vous êtes en fin de cycle.</p>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section><!-- /Work Process Section -->

    <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section dark-background">
      <div class="container">
        <div class="row" data-aos="zoom-in" data-aos-delay="100">
          <div class="col-xl-9 text-center text-xl-start">
            <h3>Prêt à commencer ?</h3>
            <p>Rejoignez la communauté ENEAM Mémoria et accédez à des centaines de travaux de recherche.</p>
          </div>
          <div class="col-xl-3 cta-btn-container text-center">
            <a class="cta-btn align-middle" href="{{ route('login') }}">Se connecter</a>
          </div>
        </div>
      </div>
    </section><!-- /Call To Action Section -->

    <!-- Contact Section (Coordonnées de l'école) -->
    <section id="contact" class="contact section">
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <p>Une question ? Contactez la bibliothèque de l'ENEAM.</p>
      </div>

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4">
          <div class="col-lg-5">
            <div class="info-wrap">
              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                <i class="bi bi-geo-alt flex-shrink-0"></i>
                <div>
                  <h3>Adresse</h3>
                  <p>ENEAM, Campus de l'Université d'Abomey-Calavi, Bénin</p>
                </div>
              </div>

              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                <i class="bi bi-envelope flex-shrink-0"></i>
                <div>
                  <h3>Email</h3>
                  <p>bibliotheque@eneam.bj</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- /Contact Section -->

  </main>

  <!-- Footer -->
  <footer id="footer" class="footer">
    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="{{ url('/') }}" class="d-flex align-items-center">
            <span class="sitename">ENEAM Mémoria</span>
          </a>
          <div class="footer-contact pt-3">
            <p>Bibliothèque numérique des mémoires de l'ENEAM.</p>
            <p class="mt-3"><strong>Email:</strong> <span>bibliotheque@eneam.bj</span></p>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Liens utiles</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="{{ route('login') }}">Se connecter</a></li>
            @if (Route::has('register'))
              <li><i class="bi bi-chevron-right"></i> <a href="{{ route('register') }}">S'inscrire</a></li>
            @endif
          </ul>
        </div>

        <div class="col-lg-4 col-md-12">
          <h4>Suivez-nous</h4>
          <p>Restez informé des dernières publications de mémoires.</p>
          <div class="social-links d-flex">
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">ENEAM Mémoria</strong> <span>All Rights Reserved</span></p>
    </div>
  </footer>

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
