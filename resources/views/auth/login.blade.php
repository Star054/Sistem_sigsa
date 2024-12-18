<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1d4e89, #f60000, #ffb74d, #e91e63);
            background-size: 300% 300%;
            animation: backgroundShift 10s ease infinite;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            position: relative;
        }

        @keyframes backgroundShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .login-container {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
            padding: 2rem;
            text-align: center;
            transition: transform 0.3s ease;
            position: relative;
        }

        .login-container:hover {
            transform: scale(1.01);
        }

        h2 {
            font-size: 2rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            text-align: left;
        }

        label {
            font-weight: 600;
            color: #555;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            display: inline-block;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #1d4e89;
            box-shadow: 0 0 10px rgba(29, 78, 137, 0.3);
            outline: none;
        }

        .form-group input[type="checkbox"] {
            width: 1.2rem;
            height: 1.2rem;
            margin-right: 0.75rem;
            cursor: pointer;
        }

        .form-group .checkbox-label {
            font-size: 1rem;
            font-weight: 600;
            color: #555;
        }

        .forgot-password {
            display: inline-block;
            margin-bottom: 1.5rem;
            color: #1d4e89;
            font-size: 0.9rem;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: #e91e63;
        }

        .login-btn {
            width: 100%;
            background-color: #1d4e89;
            color: white;
            padding: 0.75rem;
            font-size: 1rem;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .login-btn:hover {
            background-color: #e91e63;
            transform: scale(1.05);
        }

        .register-link {
            margin-top: 1.5rem;
            display: block;
            color: #555;
            font-size: 0.9rem;
        }

        .register-link a {
            color: #1d4e89;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .register-link a:hover {
            color: #e91e63;
        }


        .alert {
            color: #ff0000;
            font-size: 0.875rem;
            font-weight: 400;
            margin-top: 1rem;
            padding: 0;
        }

        .alert ul {
            list-style-type: none;
            padding-left: 0;
        }

        .alert li {
            margin-bottom: 0.5rem;
        }

        /* Estilos adicionales de los botones de error */
        .alert-danger {
            margin-top: 10px;
        }

        /* Botón de logo en la parte superior */
        .logo-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            width: 60px;
            height: 60px;
            background: none;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            outline: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        .logo-btn img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

    </style>
</head>
<body>

<!-- Botón con el logo -->
<button class="logo-btn" style="position: fixed; top: 20px; left: 20px; background: none; border: none; cursor: pointer; z-index: 999;">
    <img src="{{ asset('images/pexels.jpg') }}" alt="Logo" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover;">
</button>



<div class="login-container">
    <h2>Iniciar Sesión</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input id="email" type="email" name="email" required autofocus autocomplete="username" value="{{ old('email') }}">
            <!-- Alerta de error debajo del correo electrónico -->
            @if ($errors->has('email'))
                <div class="alert alert-danger">
                    {{ $errors->first('email') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="password">Contraseña</label>
            <input id="password" type="password" name="password" required autocomplete="current-password">
            <!-- Alerta de error debajo de la contraseña -->
            @if ($errors->has('password'))
                <div class="alert alert-danger">
                    {{ $errors->first('password') }}
                </div>
            @endif
        </div>

        <a href="{{ route('password.request') }}" class="forgot-password">¿Olvidaste tu contraseña?</a>

        <button type="submit" class="login-btn">Iniciar sesión</button>
    </form>
    @if (session('status'))
        <div class="alert alert-danger">
            {{ session('status') }}
        </div>
    @endif
</div>


</body>
</html>
