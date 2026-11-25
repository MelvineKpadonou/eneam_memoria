<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('titre', 'Accueil') - ENEAM MEMORIA</title>
    <link rel="icon" href="{{ asset('eneam-memoria/favicon.ico') }}">

    <script type="module" crossorigin src="{{ asset('eneam-memoria/assets/scripts/main-Df65xusa.js') }}"></script>
    <link rel="stylesheet" crossorigin href="{{ asset('eneam-memoria/assets/styles/main.css') }}">
    <style>
        .eneam-logo { font-weight: 700; letter-spacing: .04em; color: #3f6ad8; white-space: nowrap; }
    </style>
    @stack('styles')
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">

        @include('layouts.header')

        <div class="app-main">

            @include('layouts.sidebar')

            <div class="app-main__outer">
                <div class="app-main__inner">
                    @yield('content')
                </div>

                @include('layouts.footer')
            </div>
        </div>
    </div>

    @stack('scripts')
</body>

</html>
