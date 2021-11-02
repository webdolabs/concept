<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('option.app_name', 'Webdo stránka') }}</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
        <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
        <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
        <script>
            FilePond.registerPlugin(FilePondPluginFileValidateType);
            FilePond.registerPlugin(FilePondPluginFileValidateSize);
        </script>
    </head>
    <body class="font-sans antialiased bg-gray-100">
        <livewire:flash-messages />
        @if(isset($fullscreen))
            @if(View::hasSection('fullscreen_title') || View::hasSection('fullscreen_right'))
                <div class="flex items-center justify-between w-full h-20 px-6 bg-white shadow-sm">
                    <h1 class="py-2 pl-4 text-xl font-bold text-blue-gray-900">
                        @yield('fullscreen_title')
                    </h1>
                    <div class="flex items-center pr-4 space-x-4">
                        @yield('fullscreen_right')
                    </div>
                </div>
            @endif
            <div>
                {{ $slot }}
            </div>
        @else
            <div class="min-h-screen md:flex md:flex-row">
                <aside class="flex-none w-full bg-white md:w-64 md:min-h-screen" x-data="{ open: false }">
                    <div class="fixed inset-x-0 top-0 z-50 flex items-center justify-between px-6 py-6 text-xl font-bold bg-white md:relative text-blue-gray-700">
                        <div>
                            {{ config('option.app_name', 'Webdo stránka') }}
                        </div>
                        <button class="md:hidden" type="button" @click="open = !open">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="fixed inset-0 z-40 pt-24 pb-6 mx-auto bg-black bg-opacity-50 md:relative md:py-0 md:bg-white" :class="{ 'hidden md:block': open == false }">
                        @include('layouts.partials.navbar')
                    </div>
                </aside>
                <main class="w-full">
                    <div class="flex items-center justify-between px-6 py-3 mt-20 md:px-12 md:bg-gray-50 md:mt-0">
                        <h1 class="py-2 text-xl font-bold text-blue-gray-900">
                            @yield('title')
                        </h1>
                        <div class="hidden md:block">
                            @include('layouts.partials.userpanel')
                        </div>
                    </div>
                    <div class="w-full max-w-5xl p-6 mx-auto">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        @endif
        @livewireScripts
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
    {{-- <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body> --}}
</html>
