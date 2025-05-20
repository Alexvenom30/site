<?php
session_start();
if (!isset($_SESSION['nombre'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #1c5b70, #125a6f); /* Fondo de color oscuro para un tema futbolero */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .welcome-container {
            background-color: white;
            padding: 50px;
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 1000px;
            text-align: center;
        }

        h1 {
            color: #333;
            font-size: 30px;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .welcome-message {
            font-size: 20px;
            color: #444;
            margin-bottom: 40px;
        }

        .function-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr); /* Dos columnas para los servicios de fútbol */
            gap: 40px;
            margin-top: 30px;
        }

        .function-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            background-color: #f3f3f3;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .function-item:hover {
            transform: scale(1.05); /* Efecto de zoom */
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .function-item img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 15px;
        }

        .function-item p {
            color: #333;
            font-size: 16px;
            margin-top: 10px;
        }

        .cloud-message {
            font-size: 18px;
            color: #333;
            margin-top: 40px;
            background-color: #e3f2fd;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .logout-btn {
            display: inline-block;
            padding: 16px 28px;
            background-color: #f44336;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            margin-top: 35px;
            transition: background-color 0.3s;
        }

        .logout-btn:hover {
            background-color: #e53935;
        }

    </style>
</head>
<body>

<div class="welcome-container">
    <h1>¡Bienvenido al Fútbol!</h1>
    <p class="welcome-message">¡Hola, <?php echo htmlspecialchars($_SESSION['nombre']); ?>! Esta es tu página para disfrutar del mejor fútbol en la nube.</p>
    
    <div class="function-container">
        <div class="function-item">
            <img src="4.png" alt="Partidos en vivo">
            <p>Disfruta de partidos en vivo desde cualquier dispositivo.</p>
        </div>
        <div class="function-item">
            <img src="5.png" alt="Resumen de Partidos">
            <p>Mira resúmenes de los partidos más importantes en cualquier momento.</p>
        </div>
        <div class="function-item">
            <img src="6.png" alt="Noticias de Fútbol">
            <p>Entérate de todas las noticias y novedades del mundo del fútbol.</p>
        </div>
        <div class="function-item">
            <img src="7.png" alt="Estadísticas">
            <p>Accede a estadísticas detalladas de equipos y jugadores.</p>
        </div>
    </div>

    <div class="cloud-message">
        <p>¡Todo el contenido de fútbol que amas, accesible en cualquier momento y lugar! No te pierdas ni un solo gol, partido o noticia importante.</p>
    </div>

    <a href="logout.php" class="logout-btn">Cerrar sesión</a>
</div>

</body>
</html>

