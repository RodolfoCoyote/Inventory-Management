<?php
ini_set('error_reporting', -1);
ini_set('display_errors', 1);
ini_set('html_errors', 1); // I use this because I use xdebug.

session_start();
require_once "../connection_db.php";
$sql_executed = true;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $token = $_GET['token'];
    $user_id = $_SESSION['user_id'];

    $sql = $conn->prepare("DELETE FROM inv_restock_requests WHERE request_id = ?");
    // Vincula los parámetros
    $sql->bind_param("s", $token);
    $sql_executed = ($sql->execute()) ? true : false;


    $sql = $conn->prepare("DELETE FROM inv_temp_tokens WHERE token = ?");
    // Vincula los parámetros
    $sql->bind_param("s", $token);
    $sql_executed = ($sql->execute()) ? true : false;

    $conn->close();
} else {
    $sql_executed = false;
}


if ($sql_executed) {
    header("Location: ../../start_request.php");
} else {
    echo "Ocurrió un error. Contacta a administración.";
}
