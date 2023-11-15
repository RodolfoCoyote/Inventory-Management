<?php
ini_set('error_reporting', -1);
ini_set('display_errors', 1);
ini_set('html_errors', 1); // I use this because I use xdebug.

session_start();
require_once "../connection_db.php";
$sql_executed = true;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $room_id = $_POST['room_id'];

    $sql = $conn->prepare("DELETE FROM inv_rooms WHERE id = ?");
    // Vincula los parámetros
    $sql->bind_param("i", $room_id);


    $sql_executed = ($sql->execute()) ? true : false;
    $conn->close();
} else {
    $sql_executed = false;
}


if ($sql_executed) {
    echo json_encode(['success' => true, 'message' => 'Sala eliminada correctamente']);
} else {
    echo json_encode(["success" => false]);
}
