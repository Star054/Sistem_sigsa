<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0d253f, #1d4e89, #283e51, #000);
            background-size: 300% 300%;
            animation: backgroundShift 10s ease infinite;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        @keyframes backgroundShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .register-container {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            max-width: 500px;
            width: 100%;
            padding: 2rem;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .register-container:hover {
            transform: scale(1.01);
        }

        h2 {
            font-size: 2rem;
            font-weight: 600;
            color: #0d253f; /* Azul oscuro */
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            text-align: left;
        }

        label {
            font-weight: 600;
            color: #333; /* Color más oscuro para el texto */
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            display: inline-block;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #1d4e89;
            box-shadow: 0 0 10px rgba(29, 78, 137, 0.5);
            outline: none;
        }

        .error {
            font-size: 0.8rem;
            color: #e74c3c;
            margin-top: 0.5rem;
        }

        .login-link {
            display: inline-block;
            margin-top: 1.5rem;
            color: #0d253f; /* Azul oscuro */
            font-size: 0.9rem;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .login-link:hover {
            color: #42a5f5; /* Azul más claro en hover */
        }

        .register-btn {
            width: 100%;
            background-color: #0d253f; /* Botón azul oscuro */
            color: white;
            padding: 0.75rem;
            font-size: 1rem;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .register-btn:hover {
            background-color: #1d4e89; /* Azul más claro */
            transform: scale(1.05);
        }

    </style>
</head>
<body>

<div class="register-container">
    <h2>Registro de Usuario</h2>

    <form action="{{ route('simple-register.store') }}" method="POST">
        @csrf

        <!-- Nombre -->
        <div class="form-group">
            <label for="name">Nombre</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
            @if ($errors->get('name'))
                <div class="error">{{ $errors->first('name') }}</div>
            @endif
        </div>

        <!-- Correo Electrónico -->
        <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
            @if ($errors->get('email'))
                <div class="error">{{ $errors->first('email') }}</div>
            @endif
        </div>

        <!-- Contraseña -->
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input id="password" type="password" name="password" required autocomplete="new-password">
            @if ($errors->get('password'))
                <div class="error">{{ $errors->first('password') }}</div>
            @endif
        </div>

        <!-- Confirmar Contraseña -->
        <div class="form-group">
            <label for="password_confirmation">Confirmar Contraseña</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
            @if ($errors->get('password_confirmation'))
                <div class="error">{{ $errors->first('password_confirmation') }}</div>
            @endif
        </div>

        <div class="form-group">
            <label for="rol">Rol</label>
            <select id="rol" name="rol" required>
                <option value="usuario" {{ old('rol') == 'usuario' ? 'selected' : '' }}>Usuario</option>
                <option value="admin" {{ old('rol') == 'admin' ? 'selected' : '' }}>Administrador</option>
            </select>
            @if ($errors->get('rol'))
                <div class="error">{{ $errors->first('rol') }}</div>
            @endif
        </div>


        <button type="submit" class="register-btn">Registrarse</button>
    </form>

    <a href="{{ route('login') }}" class="login-link">¿Ya tienes cuenta? Inicia sesión</a>
</div>

</body>
</html>
