<?php
ini_set('error_reporting', -1);
ini_set('display_errors', 1);
ini_set('html_errors', 1); // TS
header('Content-Type: application/json');

session_start();
require_once "../connection_db.php";
$sql_success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $room_id = $_POST['room_id'];
    $user_id = $_SESSION['user_id'];

    $request_id = uniqid("inv_");
    $qty_requested = 0;

    $sql = $conn->prepare("INSERT INTO inv_temp_tokens (user_id, room_id, token) VALUES (?, ?, ?)");
    // Vincula los parámetros
    $sql->bind_param("iis", $user_id, $room_id, $request_id);

    if ($sql->execute()) {
        $sql = "SELECT * FROM inv_supplies_per_room WHERE room_id = $room_id ORDER BY id ASC;";
        $query = $conn->query($sql);

        if ($query->num_rows > 0) {

            // Iterar sobre los resultados y almacenarlos en el array
            while ($row = $query->fetch_assoc()) {
                $supply_id = $row['supply_id'];
                $request_date = date("Y-m-d");
                $sql = $conn->prepare("INSERT INTO inv_restock_requests (supply_id, room_id, request_date, request_id, qty_requested) VALUES (?, ?, ?, ?, ?)");
                // Vincula los parámetros
                $sql->bind_param("iissi", $supply_id, $room_id, $request_date, $request_id, $qty_requested);

                // Ejecuta la consulta
                if ($sql->execute() === TRUE) {
                    $sql_success = true;
                }
            }
        }
        $json_resultados = json_encode(["success" => true]);
    } else {
        $json_resultados = json_encode(["success" => false]);
    }
    echo $json_resultados;
}
