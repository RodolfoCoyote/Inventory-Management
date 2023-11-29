<?php
ini_set('error_reporting', -1);
ini_set('display_errors', 1);
ini_set('html_errors', 1); // I use this because I use xdebug.

session_start();
require_once "../connection_db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recolectar los datos del POST
    $store_id = $_POST['store_id'];
    $store_name = $_POST['store_name'];
    $store_description = $_POST['store_description'];
    // Prepara la consulta
    $sql = $conn->prepare("UPDATE inv_stores SET name = ?, description = ? WHERE id = ?");
    // Vincula los parámetros
    $sql->bind_param("ssi", $store_name, $store_description, $store_id);

    // Ejecuta la consulta
    if ($sql->execute() === TRUE) {
        echo json_encode(['success' => true, 'message' => 'Sala actualizada correctamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $sql->error]);
    }
    // Cierra la conexión
    $conn->close();
}
