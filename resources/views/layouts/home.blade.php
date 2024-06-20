<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="shortcut icon" href="{{ asset('img/favicon.jpg') }}" type="image/x-icon">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="h-screen bg-fixed bg-no-repeat bg-cover bg-light dark:bg-dark md:p-8">
        @include('layouts.cookies')
        @include('layouts.accessibility')
        <div class="flex-row hidden h-full bg-white dark:bg-black dark:bg-opacity-60 bg-opacity-5 rounded-xl backdrop-blur-md" id="page_content">
            @include('layouts.navbar')

            <div class="relative w-full h-full overflow-y-auto lg:border-l-2 lg:border-l-gray-500 dark:border-l-gray-800" id="content">
                @include('layouts.header')
                <main class="flex flex-col justify-between gap-3 p-5 overflow-auto">
                    @if(Breadcrumbs::has())
                        <p class="p-3 text-white bg-white dark:bg-black bg-opacity-20 dark:bg-opacity-20 rounded-xl">
                            @foreach(Breadcrumbs::current() as $crumbs)
                                @if($crumbs->url() && !$loop->last)
                                    <span>
                                        <a href="{{ $crumbs->url() }}" class="text-gray-300 border-b border-gray-300 hover:text-gray-500 hover:border-gray-500 breadcrumb-item">{{ $crumbs->title() }}</a> /
                                    </span>
                                @else
                                    <span>
                                        {{ $crumbs->title() }}
                                    </span>
                                @endif
                            @endforeach
                        </p>
                    @endif
                    {{ $slot }}
                    @include('layouts.footer')
                </main>
            </div>
        </div>
        @if(isset($edt_script))
            {{ $edt_script }}
        @endif
        <script>
            const acceptbutton = document.querySelector('#acceptbutton');
            const refusebutton = document.querySelector('#refusebutton');
            const cookie_gestion = document.querySelector('#cookie_gestion');
            const page_content = document.querySelector('#page_content');
                console.log(localStorage.getItem('cookies'));

            acceptbutton.addEventListener('click', () => {
                cookie_gestion.classList.add('hidden');
                page_content.classList.remove('hidden');
                page_content.classList.add('flex');
                // ajout au cache que les cookies ont étés acceptés
                localStorage.setItem('cookies', 'accepted');
            });
            refusebutton.addEventListener('click', () => {
                cookie_gestion.classList.add('hidden');
                page_content.classList.remove('hidden');
                page_content.classList.add('flex');
                // ajout au cache que les cookies ont étés refusés
                localStorage.setItem('cookies', 'refused');
            });
            // si les cookies sont acceptés, on n'affiche plus le bandeau cookie_gestion au reload de la page
            if (localStorage.getItem('cookies') == 'accepted'){
                cookie_gestion.classList.add('hidden');
                page_content.classList.remove('hidden');
                page_content.classList.add('flex');
            }

            if (localStorage.getItem('cookies') == 'refused'){
                cookie_gestion.classList.add('hidden');
                page_content.classList.remove('hidden');
                page_content.classList.add('flex');
            }

        </script>
    </body>
</html>
