<?php
ini_set('error_reporting', -1);
ini_set('display_errors', 1);
ini_set('html_errors', 1); // TS
header('Content-Type: application/json');

require_once "../connection_db.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "SELECT * FROM inv_stores ORDER BY id ASC;";
    $query = $conn->query($sql);

    if ($query->num_rows > 0) {
        // Inicializar un array para almacenar los resultados
        $resultados = array();

        // Iterar sobre los resultados y almacenarlos en el array
        while ($row = $query->fetch_assoc()) {
            $resultados[] = $row;
        }

        $json_resultados = json_encode(["stores" => $resultados, "registers" => true]);
    } else {
        $json_resultados = json_encode(["stores" => 0, "registers" => false]);
    }
    echo $json_resultados;
}
