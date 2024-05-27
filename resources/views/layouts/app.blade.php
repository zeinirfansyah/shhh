<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{ config("app.name", "Laravel") }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link
            href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
            rel="stylesheet"
        />

        <!-- aos -->
        <link
            href="https://unpkg.com/aos@2.3.1/dist/aos.css"
            rel="stylesheet"
        />
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

        <!-- styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" />

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <header>@include('layouts.navigation')</header>
        <main>
            {{ $slot }}
        </main>
        <!-- footer -->
        <footer class="bg-black text-white py-4">
            <div
                class="container mx-auto px-4 justify-center items-center text-center text-cabin"
            >
                <a href="https://zeinirfansyah.me" target="_blank"
                    >© 2024 shhh. All rights reserved.</a
                >
            </div>
        </footer>
        <script>
            AOS.init();
        </script>
    </body>
</html>
