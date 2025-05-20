<?php
include 'conexion.php'; // Incluir la conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $password = trim($_POST['password']);

    if (!empty($nombre) && !empty($password)) {
        // Verificar si el usuario ya existe en la base de datos
        $stmt = $conn->prepare("SELECT id FROM usuarios WHERE nombre = ?");
        $stmt->bind_param("s", $nombre);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 0) { // Si el usuario no existe, se registra
            // Cifrar la contraseña
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            // Insertar el nuevo usuario en la base de datos
            $stmt = $conn->prepare("INSERT INTO usuarios (nombre, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $nombre, $passwordHash);
            
            if ($stmt->execute()) {
                // Redirigir al usuario a la página de bienvenida después del registro exitoso
                header("Location: bienvenido.php");
                exit();
            } else {
                $errorMessage = "Error al registrar el usuario.";
            }
        } else {
            $errorMessage = "El usuario ya existe.";
        }
        $stmt->close();
    } else {
        $errorMessage = "Todos los campos son obligatorios.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #3c9c3b, #1b5e20); /* Verde fútbol */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
            border: 2px solid #388e3c;
        }

        h1 {
            color: #388e3c;
            font-size: 26px;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .form-message {
            font-size: 16px;
            color: #333;
            margin-bottom: 20px;
        }

        .error-message {
            color: #e53935;
            font-size: 14px;
        }

        .success-message {
            color: #388e3c;
            font-size: 14px;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
            box-sizing: border-box;
        }

        button {
            padding: 12px 20px;
            background-color: #388e3c;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            margin-top: 20px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #2c6e2e;
        }

        .register-link {
            margin-top: 20px;
            font-size: 14px;
        }

        .register-link a {
            color: #388e3c;
            text-decoration: none;
            font-weight: bold;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .logo {
            width: 120px;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

<div class="form-container">
    <!-- Logo del sitio -->
    <img src="3.png" alt="Logo de la Nube Deportiva" class="logo">

    <h1>Registro de Usuario</h1>

    <?php
    if (isset($successMessage)) {
        echo "<p class='success-message'>$successMessage</p>";
    } elseif (isset($errorMessage)) {
        echo "<p class='error-message'>$errorMessage</p>";
    }
    ?>

    <form action="registro.php" method="POST">
        <label for="nombre">Usuario:</label>
        <input type="text" name="nombre" id="nombre" required><br>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required><br>

        <button type="submit">Registrar</button>
    </form>

    <div class="register-link">
        <p>¿Ya tienes cuenta? <a href="index.php">Inicia sesión aquí</a>.</p>
    </div>
</div>

</body>
</html>
