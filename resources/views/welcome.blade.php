<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('css/test/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/test/product.css')}}" rel="stylesheet">
    <link href="{{asset('css/test/css')}}" rel="stylesheet">
    <link href="{{asset('css/test/materialdesignicons.min.css')}}" rel="stylesheet">
</head>

<body>
        {{--  @if (Route::has('login'))
        <div class="top-right links">
            @auth
            <a href="{{ url('/home') }}">Home</a>
            @else
            <a href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
            @endif
            @endauth
        </div>
        @endif  --}}

        <nav class="site-header sticky-top py-1">
            <div class="container d-flex flex-column flex-md-row">
                <a class="py-2 d-none d-md-inline-block" href="/about">About</a>
                <a class="py-2 pl-3 d-none d-md-inline-block" href="/table">Table</a>
            </div>
        </nav>
        <div class="container-scroller" id="app">
            {!! $component !!}
        </div>

        <script src="{{asset('js/vendor.bundle.base.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
</body>

</html>