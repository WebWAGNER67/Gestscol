<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="shortcut icon" href="{{ asset('img/favicon.jpg') }}" type="image/x-icon">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="flex justify-between h-screen bg-fixed bg-no-repeat bg-cover bg-light dark:bg-dark">
        <div></div>
        <div class="lg:w-1/2 w-full h-full bg-gradient-to-br from-[#0F123B] to-[#090D2E]">
            <div class="flex flex-col items-center justify-center h-full p-4">
                <div>
                    {{ $slot }}
                </div>
            </div>
        </div>

        <script>
            const eye = document.querySelector('#feather-eye');
            const eyeOff = document.querySelector('#feather-eye-off');
            const password = document.querySelector('#password');

            eye.addEventListener('click', () => {
                eye.classList.add('hidden');
                eyeOff.classList.remove('hidden');
                password.type = 'text';
            });

            eyeOff.addEventListener('click', () => {
                eye.classList.remove('hidden');
                eyeOff.classList.add('hidden');
                password.type = 'password';
            });

        </script>

    </body>

</html>
