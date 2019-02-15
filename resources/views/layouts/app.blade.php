<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @stack('head')
</head>

<body>

    @stack('begin')

    <header>
        @include('layouts._header')
    </header>

    <main role="main">
        <div class="container mt-5">
            @yield('content')
        </div>
        @include('layouts._footer')
    </main>

    <script src="{{ asset('js/app.js') }}"></script>
    @include('layouts.partials.notify')
    @stack('end')

</body>

</html>
