<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Detectar el tema antes de cargar la página para prevenir parpadeo -->
    <script>
        (function() {
            // Verificar si hay un tema almacenado en localStorage
            const theme = localStorage.getItem('theme');
            // Si el tema es 'dark', aplicar la clase 'dark' a <html> antes de cargar la página
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom Styles for Dark Mode and Light Mode Switch -->
    <style>

        html {
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* Botón flotante en el costado izquierdo */
        #toggle-dark-mode {
            position: fixed;
            left: 20px;  /* Cambiado de right a left */
            bottom: 20px;
            z-index: 50;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #007bff;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }

        #toggle-dark-mode:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100 dark:bg-gray-900 transition-colors duration-300">
    <!-- Navegación principal -->
    @include('layouts.navigation')

    <!-- Botón flotante para cambiar entre modo oscuro y claro -->
    <button id="toggle-dark-mode" class="text-white">
        <!-- Icono de Sol (Día) -->
        <svg id="sun-icon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500 dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v2m0 14v2m8-10h-2M4 12H2m15.364-6.364l-1.414 1.414M7.05 16.95l-1.414 1.414m12.728 0l-1.414-1.414M7.05 7.05l-1.414-1.414M12 5a7 7 0 110 14 7 7 0 010-14z" />
        </svg>
        <!-- Icono de Luna (Noche) -->
        <svg id="moon-icon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white hidden dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12.79A9 9 0 1111.21 3a7 7 0 009.79 9.79z" />
        </svg>
    </button>

    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    <!-- Contenido principal -->
    <main>
        {{ $slot }}
    </main>
</div>

<script>
    // Detectar el tema actual y actualizar los iconos
    function updateIcons() {
        const isDarkMode = document.documentElement.classList.contains('dark');
        document.getElementById('sun-icon').classList.toggle('hidden', isDarkMode);
        document.getElementById('moon-icon').classList.toggle('hidden', !isDarkMode);
    }

    // Función para alternar entre modo oscuro y claro
    function toggleDarkMode() {
        const html = document.documentElement;
        if (html.classList.contains('dark')) {
            html.classList.remove('dark');
            localStorage.setItem('theme', 'light'); // Guardar en localStorage
        } else {
            html.classList.add('dark');
            localStorage.setItem('theme', 'dark'); // Guardar en localStorage
        }
        updateIcons();
    }

    // Al cargar la página, aplicar el tema almacenado en localStorage y actualizar los iconos
    document.addEventListener('DOMContentLoaded', function() {
        const theme = localStorage.getItem('theme');
        if (theme === 'dark') {
            document.documentElement.classList.add('dark');
        }
        updateIcons();
    });

    // Vincular el botón para cambiar el tema con la función toggleDarkMode
    document.getElementById('toggle-dark-mode').addEventListener('click', toggleDarkMode);
</script>
</body>
</html>
