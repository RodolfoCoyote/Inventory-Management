<?php
ini_set('error_reporting', -1);
ini_set('display_errors', 1);
ini_set('html_errors', 1); // TS
header('Content-Type: application/json');
session_start();
require_once "../connection_db.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT room_id, token FROM inv_temp_tokens WHERE user_id = $user_id;";
    $query = $conn->query($sql);

    $row = $query->fetch_assoc();
    $room_id = $row['room_id'];
    $token = $row['token'];


    $sql = "SELECT r.id, r.supply_id, r.room_id, r.request_date, r.request_id, r.qty_requested, s.id globalid, s.name FROM inv_restock_requests r INNER JOIN inv_supplies s ON r.supply_id = s.id WHERE room_id = $room_id AND request_id = $token;";
    $query = $conn->query($sql);

    if ($query->num_rows > 0) {
        // Inicializar un array para almacenar los resultados
        $main = array();
        $child = array();
        // Iterar sobre los resultados y almacenarlos en el array
        while ($row = $query->fetch_assoc()) {
            if ($row['qty_requested'] == 0) {
                $main[] = $row;
            } else {
                $child[] = $row;
            }
        }

        $json_resultados = json_encode(["main" => $main, "child" => $child, "registers" => true]);
    } else {
        $json_resultados = json_encode(["supplies" => 0, "registers" => false]);
    }
    echo $json_resultados;
}
