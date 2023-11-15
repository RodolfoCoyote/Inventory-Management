<?php
ini_set('error_reporting', -1);
ini_set('display_errors', 1);
ini_set('html_errors', 1); // I use this because I use xdebug.

session_start();
require_once "../connection_db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recolectar los datos del POST
    $room_id = $_POST['room_id'];
    $room_name = $_POST['room_name'];
    $room_description = $_POST['room_description'];
    // Prepara la consulta
    $sql = $conn->prepare("UPDATE inv_rooms SET name = ?, description = ? WHERE id = ?");
    // Vincula los parámetros
    $sql->bind_param("ssi", $room_name, $room_description, $room_id);

    // Ejecuta la consulta
    if ($sql->execute() === TRUE) {
        echo json_encode(['success' => true, 'message' => 'Sala actualizada correctamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $sql->error]);
    }
    // Cierra la conexión
    $conn->close();
}
