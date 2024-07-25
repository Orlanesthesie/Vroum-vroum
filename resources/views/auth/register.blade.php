<!DOCTYPE html>
<html>
<head>
    <title>Registro de Usuario</title>
</head>
<body>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- Nombre -->
        <div>
            <label for="name">Nombre</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
        </div>

        <!-- Email -->
        <div>
            <label for="email">Correo Electrónico</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required>
        </div>

        <!-- Contraseña -->
        <div>
            <label for="password">Contraseña</label>
            <input id="password" type="password" name="password" required>
        </div>

        <!-- Confirmar Contraseña -->
        <div>
            <label for="password_confirmation">Confirmar Contraseña</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required>
        </div>

        <!-- Avatar -->
        <div>
            <label for="avatar">Avatar</label>
            <input id="avatar" type="file" name="avatar">
        </div>

        <div>
            <button type="submit">Registrar</button>
        </div>
    </form>
</body>
</html>