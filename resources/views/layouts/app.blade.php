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
        <link rel="shortcut icon" href="https://tailwindui.com/img/logos/workflow-mark-purple-600.svg" type="image/x-icon">

        <title>{{ config('app.name', 'Laravel') }} - {{ __('Expert System for Diagnosis of Anxiety Disorders') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

    </head>
    <body class="font-sans antialiased text-gray-900">
        <x-jet-banner />

        <section class="min-h-screen bg-gray-100">
            <!-- Navigation Bar -->
            @livewire('navigation-menu')

            <div class="grid grid-cols-12 min-h-screen">
                <!-- Side Bar -->
                @livewire('side-navigation')

                <div class="col-span-9">
                    <!-- Page Heading -->
                    @if (isset($header))
                        <header class="bg-purple-500 shadow">
                            <div class="py-6 px-3 lg:px-6">
                                {{ $header }}
                            </div>
                        </header>
                    @endif

                    <!-- Page Content -->
                    <main>
                        {{ $slot }}
                    </main>
                </div>
            </div>
        </section>

        @stack('modals')

        @livewireScripts

        <!-- Main JS -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        @yield('script')
    </body>
</html>
