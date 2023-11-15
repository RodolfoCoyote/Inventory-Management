<?php
ini_set('error_reporting', -1);
ini_set('display_errors', 1);
ini_set('html_errors', 1); // I use this because I use xdebug.

session_start();
require_once "../connection_db.php";
$sql_executed = true;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cat_id = $_POST['cat_id'];

    $sql = $conn->prepare("DELETE FROM inv_categories WHERE id = ?");
    // Vincula los parámetros
    $sql->bind_param("i", $cat_id);


    $sql_executed = ($sql->execute()) ? true : false;
    $conn->close();
} else {
    $sql_executed = false;
}


if ($sql_executed) {
    echo json_encode(['success' => true, 'message' => 'Categoría eliminada correctamente']);
} else {
    echo json_encode(["success" => false]);
}
