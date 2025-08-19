<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Judul Default')</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logos/small-logo.png') }}" />

    @vite('resources/css/app.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        article img {
            width: 100%
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="font-lato">
    @include('partials.header')
    <main>
        @yield('content')
    </main>
    @include('partials.footer')
    @yield('script')
</body>

</html>
