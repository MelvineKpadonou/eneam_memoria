<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('titre', 'Accueil') - ENEAM Mémoria</title>
    <link rel="icon" href="{{ asset('architectui/favicon.ico') }}">

    <script type="module" crossorigin src="{{ asset('architectui/assets/scripts/main-Df65xusa.js') }}"></script>
    <link rel="stylesheet" crossorigin href="{{ asset('architectui/assets/styles/main.css') }}">
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
