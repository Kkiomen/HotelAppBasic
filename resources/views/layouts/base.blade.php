<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @hasSection('title')

            <title>@yield('title') - {{ config('app.name') }}</title>
        @else
            <title>{{ config('app.name') }}</title>
        @endif

        <!-- Favicon -->
		<link rel="shortcut icon" href="{{ url(asset('favicon.ico')) }}">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            clifford: '#da373d',
                        }
                    }
                }
            }
        </script>
{{--        @vite(['resources/sass/app.scss', 'resources/js/app.js'])--}}

        @livewireStyles
        @livewireScripts

        @stack('scripts')
        <style>
            .json-description td{
                padding-top: 15px;
            }
        </style>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.min.js" integrity="sha512-/9uQgrROuVyGVQMh4f61rF2MTLjDVN+tFGn20kq66J+kTZu/q83X8oJ6i4I9MCl3psbB5ByQfIwtZcHDHc2ngQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.min.css" integrity="sha512-PW9BfYtoXV6XYb/4FTkBoJEBM92TrGk7N324cCmF5i2dY02YvBg6ZPEAnSOZ5i2/nGPbsYFQwVzDxVVoWEKWww==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>

    <body>
        @yield('body')
    </body>
</html>
