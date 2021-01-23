<!DOCTYPE html>
<html lang="{{ getCurrentLocale() }}" dir="{{ getCurrentLocaleDirection() }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <!-- font awesome -->
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}" />
    <!-- Main Style -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
    <!-- aos cdn -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Title -->

    <title>
        @yield('title', getSiteName())
    </title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>

<body>


    <main>
        @include('site.partials.header')
        @yield('content')
    </main>

    @include('site.partials.footer')

    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- bootstrap -->
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- aos -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- nice scroll -->
    <script src="{{ asset('js/jquery.nicescroll.min.js') }}"></script>
    <!-- Main Scripts -->
    <script src="{{ asset('js/scripts.js') }}"></script>
</body>

</html>
