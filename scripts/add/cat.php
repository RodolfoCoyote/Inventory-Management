<?php
ini_set('error_reporting', -1);
ini_set('display_errors', 1);
ini_set('html_errors', 1); // I use this because I use xdebug.

session_start();
require_once "../connection_db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recolectar los datos del POST
    $cat_name = $_POST['cat_name'];
    $cat_description = $_POST['cat_description'];
    // Prepara la consulta
    $sql = $conn->prepare("INSERT INTO inv_categories (name, description) VALUES (?, ?)");
    // Vincula los parámetros
    $sql->bind_param("ss", $cat_name, $cat_description);

    // Ejecuta la consulta
    if ($sql->execute() === TRUE) {
        echo json_encode(['success' => true, 'message' => 'Categoría agregada correctamente']);
    } else {
        echo "Error al insertar: " . $sql->error;
    }
    // Cierra la conexión
    $conn->close();
}
