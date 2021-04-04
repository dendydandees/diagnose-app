<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="title" content="{{ config('app.name', 'Laravel') }}">
        <meta name="author" content="Dendy Dharmawan">
        <meta name="description" content="Diagnose merupakan sistem pakar untuk melakukan diagnosa dini mengenai gangguan kecemasan.">
        <meta name="keywords" content="{{ config('app.name', 'Laravel') }}, sistem pakar, gangguan kecemasan" />

        <title>{{ config('app.name', 'Laravel') }} - {{ __('Expert System for Diagnosis of Anxiety Disorders') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Main Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles
    </head>
    <body class="font-sans antialiased">

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-bar-guest')

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @livewireScripts

        <!-- Main JS -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </body>
</html>
