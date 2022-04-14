<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <title>@yield('title') -- DanielSink.dev</title>

        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

        <script src="{{ mix('/js/manifest.js') }}" defer></script>
        <script src="{{ mix('/js/vendor.js') }}" defer></script>
        <script src="{{ mix('/js/app.js') }}" defer></script>
    </head>
    <body class="antialiased">
        <div>
            @include('shared.header')

            <main class="mt-20">
                @yield('content')
            </main>
        </div>

        @livewireScripts
    </body>
</html>
