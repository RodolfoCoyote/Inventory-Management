<?php

ini_set('error_reporting', -1);
ini_set('display_errors', 1);
ini_set('html_errors', 1); // TS
header('Content-Type: application/json');


session_start();
require_once "../connection_db.php";
$my_user_id = $_SESSION['user_id'];
// Query para obtener los datos de la base de datos
$sql = "SELECT id, nombre FROM usuarios WHERE id != ?";
$sql = $conn->prepare($sql);

$sql->bind_param("i", $my_user_id);

// Ejecutar la consulta
$sql->execute();

// Obtener el resultado
$result = $sql->get_result();

// Manejar los resultados (por ejemplo, imprimir los resultados)
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Devolver los resultados como JSON
echo json_encode($data);

// Cerrar la conexión
$conn->close();
