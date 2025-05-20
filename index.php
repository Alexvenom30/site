<?php
session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $password = trim($_POST['password']);

    if (!empty($nombre) && !empty($password)) {
        $stmt = $conn->prepare("SELECT password FROM usuarios WHERE nombre = ?");
        $stmt->bind_param("s", $nombre);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($passwordHash);
            $stmt->fetch();

            if (password_verify($password, $passwordHash)) {
                $_SESSION['nombre'] = $nombre;
                header("Location: bienvenido.php");
                exit();
            } else {
                header("Location: index.php?error=1");
                exit();
            }
        } else {
            header("Location: index.php?error=1");
            exit();
        }
        $stmt->close();
    } else {
        header("Location: index.php?error=2");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #3c9c3b, #1b5e20); /* Verde fútbol */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #ffffff;
            padding: 40px 40px 30px 40px;
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 380px;
            text-align: center;
            border: 2px solid #388e3c;
        }

        h1 {
            color: #388e3c;
            font-size: 26px;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .input-field {
            width: 100%;
            padding: 14px;
            margin: 12px 0;
            border-radius: 6px;
            border: 1px solid #388e3c;
            box-sizing: border-box;
            font-size: 16px;
            background-color: #f1f8e9;
        }

        .submit-btn {
            width: 100%;
            padding: 14px;
            background-color: #388e3c;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 6px;
            margin-top: 20px;
            transition: background-color 0.3s;
        }

        .submit-btn:hover {
            background-color: #2c6e2e;
        }

        .error-message {
            color: #e53935;
            margin: 10px 0;
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

<div class="login-container">
    <!-- Logo del sitio -->
    <img src="2.png" alt="Logo de la Nube Deportiva" class="logo">

    <h1>Iniciar sesión</h1>

    <?php 
    if (isset($_GET['error'])) {
        if ($_GET['error'] == 1) {
            echo "<p class='error-message'>¡Usuario o contraseña incorrectos!</p>";
        } elseif ($_GET['error'] == 2) {
            echo "<p class='error-message'>Todos los campos son obligatorios.</p>";
        }
    }
    ?>

    <form action="index.php" method="POST">
        <input type="text" name="nombre" id="nombre" class="input-field" placeholder="Usuario" required><br>
        <input type="password" name="password" id="password" class="input-field" placeholder="Contraseña" required><br>
        <button type="submit" class="submit-btn">Entrar</button>
    </form>

    <div class="register-link">
        <p>¿No tienes una cuenta? <a href="registro.php">Crea una aquí</a>.</p>
    </div>
</div>

</body>
</html>
