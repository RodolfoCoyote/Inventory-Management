<?php
ini_set('error_reporting', -1);
ini_set('display_errors', 1);
ini_set('html_errors', 1); // TS
header('Content-Type: application/json');

require_once "../connection_db.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$supply_id = $_POST['supply_id'];

	$sql = "SELECT spr.id,spr.room_id,(spr.initial_stock - spr.current_stock) qty_requested, inv_rooms.name room_name FROM inv_supplies_per_room spr LEFT JOIN inv_rooms ON spr.room_id = inv_rooms.id WHERE supply_id = $supply_id;";
	$query = $conn->query($sql);

	if ($query->num_rows > 0) {
		// Inicializar un array para almacenar los resultados
		$supply_per_room = array();

		// Iterar sobre los resultados y almacenarlos en el array
		while ($row = $query->fetch_assoc()) {
			$supply_per_room[] = $row;
		}

		$sql = "SELECT inv_supplies.id, inv_supplies.name,inv_supplies.measure, inv_categories.name cat_name FROM inv_supplies INNER JOIN inv_categories ON inv_supplies.cat_id = inv_categories.id WHERE inv_supplies.id = $supply_id;";
		$query = $conn->query($sql);

		if ($query->num_rows > 0) {
			$supply_info = $query->fetch_assoc();
		}

		$json_resultados = json_encode(["success" => true, "supply_per_room" => $supply_per_room, "supply_info" => $supply_info]);
	} else {
		$json_resultados = json_encode(["success" => false]);
	}
	echo $json_resultados;
}
