<?php
ini_set('error_reporting', -1);
ini_set('display_errors', 1);
ini_set('html_errors', 1); // I use this because I use xdebug.

session_start();
require_once "../connection_db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recolectar los datos del POST
    $store_name = $_POST['store_name'];
    $store_description = $_POST['store_description'];
    // Prepara la consulta
    $sql = $conn->prepare("INSERT INTO inv_stores (name, description) VALUES (?, ?)");
    // Vincula los parámetros
    $sql->bind_param("ss", $store_name, $store_description);

    // Ejecuta la consulta
    if ($sql->execute() === TRUE) {
        echo json_encode(['success' => true, 'message' => 'Comercio agregado correctamente']);
    } else {
        echo "Error al insertar: " . $sql->error;
    }
    // Cierra la conexión
    $conn->close();
}
