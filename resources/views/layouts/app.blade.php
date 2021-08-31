<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <ul class="navbar-nav">
            <li class="nav-item {{ Route::currentRouteName() == 'advertisement.index' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('advertisement.index') }}">Classifieds board</a>
            </li>
            <li class="nav-item {{ Route::currentRouteName() == 'advertisement.create' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('advertisement.create') }}">Post ad</a>
            </li>
        </ul>
    </nav>
    <main class="mx-5 my-3">
        @if (Session::has('message') && Session::has('message_type'))
            <p class="alert alert-{{ Session::get('message_type') }}">{{ Session::get('message') }}</p>
        @endif
        @yield('content')
    </main>
</body>

</html>
