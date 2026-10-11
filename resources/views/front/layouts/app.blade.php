<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>
        @yield('title', 'Signo')
    </title>

    <meta
        name="description"
        content="@yield('description', 'SIGNO, spécialiste de la signalétique, du conseil, des études et de la production en Tunisie depuis 1998.')"
    >

    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="{{ asset('assets/css/styles.css') }}"
    >

    @stack('styles')
</head>

<body>

<div class="site-shell">

    @include('front.layouts.header')

    <main>
        @yield('content')
    </main>

    @include('front.layouts.footer')

</div>


<script>

</script>

<script src="{{ asset('assets/js/main.js') }}"></script>


</body>
</html>
