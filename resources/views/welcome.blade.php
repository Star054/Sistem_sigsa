<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bienvenido al sistema  651651</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background: linear-gradient(45deg, #003577, #5fc6b3, #31818e, #070e19, #e91e63); /* Degradado con colores vibrantes */
            background-size: 300% 300%;
            animation: backgroundShift 15s ease infinite; /* Animación para cambio de color */
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Animación de cambio de fondo */
        @keyframes backgroundShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .container {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 1200px;
            width: 100%;
            overflow: hidden;
        }

        header {
            padding: 2rem;
            text-align: center;
            background: linear-gradient(90deg, #1d4e89, #e91e63); /* Degradado del encabezado */
            color: white;
            position: relative;
        }

        header h1 {
            font-size: 2.5rem;
            font-weight: bold;
        }

        nav {
            margin-top: 1.5rem;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 0 1rem;
            padding: 0.75rem 1.5rem;
            border: 1px solid transparent;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.2);
            transition: background-color 0.3s, color 0.3s;
        }

        nav a:hover {
            background-color: #fff;
            color: #FF2D20;
        }

        main {
            padding: 2rem;
            text-align: center;
        }

        .welcome-container h1 {
            font-size: 2.8rem;
            color: #1e40af;
            margin-bottom: 1rem;
            font-weight: 700;
            background: linear-gradient(90deg, #1d4e89, #e91e63);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .welcome-container p {
            font-size: 1.2rem;
            line-height: 1.8;
            color: #555;
            margin-bottom: 2.5rem;
        }

        .welcome-container {
            padding: 2.5rem;
            background-color: #f7f7f7;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            max-width: 1000px;
            margin: 0 auto;
            text-align: center;
        }

        footer {
            padding: 1rem;
            background-color: #f8f9fa;
            color: #555;
            font-size: 0.9rem;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }

        @media (min-width: 768px) {
            header h1 {
                font-size: 3rem;
            }

            .welcome-container h1 {
                font-size: 3rem;
            }

            .welcome-container p {
                font-size: 1.4rem;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <header>
        <h1>Bienvenido al Sistema</h1>
        @if (Route::has('login'))
            <nav>
                @auth
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Iniciar sesión</a>
{{--                    @if (Route::has('register'))--}}
{{--                        <a href="{{ route('register') }}">Registrarse</a>--}}
{{--                    @endif--}}
                @endauth
            </nav>
        @endif
    </header>

    <main>
        <div class="welcome-container">
            <h1>Área de Inmunizaciones</h1>
            <p>
                El área de inmunizaciones se enfoca en la administración de vacunas para proteger a las personas contra enfermedades infecciosas graves. A través del proceso de vacunación o inmunización, se introduce una
                pequeña cantidad de un virus o bacteria debilitada o inactiva, lo que permite que el sistema inmunológico desarrolle defensas sin causar la enfermedad. La inmunización es una de las herramientas más eficaces
                para prevenir enfermedades, ayudando a reducir la propagación de infecciones y salvando millones de vidas cada año. El objetivo del área de inmunizaciones del Distrito de Salud Cante es que todas las personas,
                especialmente las poblaciones más vulnerables, reciban las vacunas necesarias para protegerse de enfermedades como el sarampión, la poliomielitis, la hepatitis y muchas más.
            </p>
        </div>
    </main>

    <footer>
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
    </footer>
</div>
</body>
</html>
