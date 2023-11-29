<?php
ini_set('error_reporting', -1);
ini_set('display_errors', 1);
ini_set('html_errors', 1); // TS
header('Content-Type: application/json');

require_once "../connection_db.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (isset($_GET['room_id']) && $_GET['room_id'] != "undefined") {
		$room_id = $_GET['room_id'];

		$sql = "SELECT s.id, r.room_id, s.name, s.measure, SUM(r.initial_stock) initial_stock, SUM(r.current_stock) current_stock, s.cat_id, s.store_id FROM inv_supplies s LEFT JOIN inv_supplies_per_room r ON s.id = r.supply_id WHERE room_id = $room_id GROUP BY r.supply_id ORDER BY s.name ASC;";
	} else {
		$sql = "SELECT s.id, r.room_id, s.name, s.measure, SUM(r.initial_stock) initial_stock, SUM(r.current_stock) current_stock, s.cat_id, s.store_id FROM inv_supplies s LEFT JOIN inv_supplies_per_room r ON s.id = r.supply_id GROUP BY r.supply_id ORDER BY s.name ASC;";
	}
	$query = $conn->query($sql);

	if ($query->num_rows > 0) {
		// Inicializar un array para almacenar los resultados
		$resultados = array();

		// Iterar sobre los resultados y almacenarlos en el array
		while ($row = $query->fetch_assoc()) {
			$resultados[] = $row;
		}

		$json_resultados = json_encode(["supplies" => $resultados, "registers" => true]);
	} else {
		$json_resultados = json_encode(["supplies" => 0, "registers" => false]);
	}
	echo $json_resultados;
}
