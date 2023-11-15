<?php
ini_set('error_reporting', -1);
ini_set('display_errors', 1);
ini_set('html_errors', 1); // I use this because I use xdebug.

session_start();
require_once "../connection_db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recolectar los datos del POST
    $cat_id = $_POST['cat_id'];
    $cat_name = $_POST['cat_name'];
    $cat_description = $_POST['cat_description'];
    // Prepara la consulta
    $sql = $conn->prepare("UPDATE inv_categories SET name = ?, description = ? WHERE id = ?");
    // Vincula los parámetros
    $sql->bind_param("ssi", $cat_name, $cat_description, $cat_id);

    // Ejecuta la consulta
    if ($sql->execute() === TRUE) {
        echo json_encode(['success' => true, 'message' => 'Sala actualizada correctamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $sql->error]);
    }
    // Cierra la conexión
    $conn->close();
}
