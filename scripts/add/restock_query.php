<?php

ini_set('error_reporting', -1);
ini_set('display_errors', 1);
ini_set('html_errors', 1); // TS
header('Content-Type: application/json');
session_start();
require_once "../connection_db.php";
//if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$user_id = $_SESSION['user_id'];
$sql = "SELECT room_id, token FROM inv_temp_tokens WHERE user_id = $user_id;";
$query = $conn->query($sql);

$row = $query->fetch_assoc();
$room_id = $row['room_id'];
$token = $row['token'];

$sql = "SELECT * FROM inv_restock_requests WHERE room_id = $room_id AND request_id = '$token';";
$query = $conn->query($sql);

if ($query->num_rows > 0) {
    while ($row = $query->fetch_assoc()) {
        $supply_id = $row['supply_id'];
        $room_id = $row['room_id'];
        $qty_requested = $row['qty_requested'];

        $sql = $conn->prepare("UPDATE inv_supplies_per_room SET current_stock = (current_stock - ?) WHERE room_id = ? AND supply_id = ?");
        // Vincula los parámetros
        $sql->bind_param("iii", $qty_requested, $room_id, $supply_id);

        // Ejecuta la consulta
        if ($sql->execute() === TRUE) {


            $sql = $conn->prepare("DELETE FROM inv_temp_tokens WHERE user_id = ? AND token = ?");
            // Vincula los parámetros
            $sql->bind_param("is", $user_id, $token);
            if ($sql->execute() === TRUE) {
            }
        }
    }
}
//}
