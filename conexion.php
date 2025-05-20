<?php
$servidor = "localhost";
$usuario = "root";
$clave = "12345678";
$base_de_datos = "mi_aplicacion";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli($servidor, $usuario, $clave, $base_de_datos);
    $conn->set_charset("utf8"); // Evita problemas con caracteres especiales
} catch (Exception $e) {
    error_log("Error de conexión: " . $e->getMessage());
    die("Error en la conexión a la base de datos, inténtelo más tarde.");
}
?>
