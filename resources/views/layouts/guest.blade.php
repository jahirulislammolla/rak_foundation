<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title> Dr. Md Saifuzzaman</title>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="{{ asset('assets/images/background/icon.ico') }}" type="image/x-icon">
        <!-- Scripts -->
        <link href="{{ asset('assets/css/app_update.css') }}" rel="stylesheet">
        <style>
            .div_background{
                background: rgb(34,193,195);
                background: linear-gradient(40deg, rgba(236, 114, 61, 0.943) 13%, rgba(37, 73, 110, 0.915) 91%);
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        @include('components.header')
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-white div_background">
            <div>
                <a href="/">
                    <img class="w-28 sm:w-32 lg:w-32 text-center" src="{{ asset('assets/images/logo/logo_2.png') }}" alt="logo">
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4  bg-sky-800/20 shadow-lg overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
