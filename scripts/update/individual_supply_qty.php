<?php
ini_set('error_reporting', -1);
ini_set('display_errors', 1);
ini_set('html_errors', 1); // TS
header('Content-Type: application/json');

require_once "../connection_db.php";

/* ========== ========== ========== ========== ========== ========== ========== ========== ========== ========== 
    Este script solo actualiza la cantidad del insumo desde updateQtyModal en supplies.php
    Para modificar información general del insumo, hacerlo desde ./scripts/load/individual_supply_info.php
========== ========== ========== ========== ========== ========== ========== ========== ========== ========== */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $success = true;
    for ($i = 0; isset($_POST["view_spr_id_$i"]); $i++) {
        $row_affected = $_POST["view_spr_id_$i"];
        $qty_updated = $_POST["view_qty_$i"];

        $sql = $conn->prepare("UPDATE inv_supplies_per_room SET current_stock = current_stock + ? WHERE id = ?");
        // Vincula los parámetros
        $sql->bind_param("ii", $qty_updated, $row_affected);
        if ($sql->execute() === TRUE) {
            $success = true;
        } else {
            $success = false;
        }
    }
    $json_resultados = json_encode(["success" => $success, "alert_title" => 'Hecho', "alert_text" => "Cambios guardados"]);
} else {
    $json_resultados = json_encode(["success" => false]);
}
echo $json_resultados;
