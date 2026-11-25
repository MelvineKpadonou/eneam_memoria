<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('titre', 'Authentification') - ENEAM MEMORIA</title>
    <link rel="icon" href="{{ asset('eneam-memoria/favicon.ico') }}">

    <script type="module" crossorigin src="{{ asset('eneam-memoria/assets/scripts/main-Df65xusa.js') }}"></script>
    <link rel="stylesheet" crossorigin href="{{ asset('eneam-memoria/assets/styles/main.css') }}">
    <style>
        .eneam-logo { font-weight: 700; letter-spacing: .04em; color: #3f6ad8; white-space: nowrap; }
        .auth-wrapper { min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 24px; background: #f7f9fc; }
        .auth-card { width: 100%; max-width: 520px; }
        .auth-logo { margin-bottom: 24px; font-size: 1.5rem; }
    </style>
    @stack('styles')
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-card">
            <div class="text-center auth-logo">
                <span class="eneam-logo">ENEAM MEMORIA</span>
            </div>

            <div class="main-card mb-3 card">
                <div class="card-body">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
