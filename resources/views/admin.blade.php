<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <title>@yield('title') -- Admin Dashboard</title>

        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

        <script src="{{ mix('/js/manifest.js') }}" defer></script>
        <script src="{{ mix('/js/vendor.js') }}" defer></script>
        <script src="{{ mix('/js/app.js') }}" defer></script>
    </head>
    <body class="antialiased" x-data="{sidebarOpen: false}"> 
        <div class="relative lg:flex min-h-screen">
            @include('shared.admin-sidebar')

            <div class="relative z-0 lg:flex-grow h-screen">
                <div class="flex flex-col justify-between h-full">
                    @include('shared.admin-header')

                    <main class="overflow-y-auto p-6 h-full bg-gray-200 ">
                        @yield('content')
                    </main>

                    <footer class="w-full bg-slate-700 text-white flex flex-col items-center py-3">
                        @include('shared.footer')
                    </footer>
                </div>
            </div>
        </div>

        @livewireScripts
    </body>
</html>
