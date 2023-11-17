<?php
ini_set('error_reporting', -1);
ini_set('display_errors', 1);
ini_set('html_errors', 1); // I use this because I use xdebug.

session_start();
require_once "../connection_db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recolectar los datos del POST
    $supply_id_requested = $_POST['input_supply_id'];
    $supply_qty_requested = $_POST['input_supply_qty'];
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT * FROM inv_temp_tokens WHERE user_id = $user_id;";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();
    $request_id = $row['token'];

    // Prepara la consulta
    $sql = $conn->prepare("UPDATE inv_restock_requests SET qty_requested = ? WHERE request_id = ? AND supply_id = ? ");
    // Vincula los parámetros
    $sql->bind_param("isi", $supply_qty_requested, $request_id, $supply_id_requested);

    // Ejecuta la consulta
    if ($sql->execute() === TRUE) {
        echo json_encode(['success' => true, 'message' => $sql]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $sql->error]);
    }
    // Cierra la conexión
    $conn->close();
}
