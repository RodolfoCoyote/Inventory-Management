<?php
ini_set('error_reporting', -1);
ini_set('display_errors', 1);
ini_set('html_errors', 1); // I use this because I use xdebug.

session_start();
require_once "../connection_db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// Recolectar los datos del POST
	$uploadedFile = $_FILES['supplie_img'];
	$supplie_name = $_POST['supplie_name'];
	$supplie_measure = $_POST['supplie_measure'];
	$supplie_image = "Temp";
	$supplie_cat = $_POST['supplie_cat'];
	$supplie_store = 1;

	$sql = $conn->prepare("INSERT INTO inv_supplies (name, measure, image, cat_id, store_id) VALUES (?, ?, ?, ?, ?)");
	// Vincula los parámetros
	$sql->bind_param("sssii", $supplie_name, $supplie_measure, $supplie_image, $supplie_cat, $supplie_store);

	// Ejecuta la consulta
	if ($sql->execute() === TRUE) {
		$supply_id = $conn->insert_id;
		// Iterar sobre los campos
		for ($i = 0; isset($_POST["supplie_room_$i"]); $i++) {
			$room_id = $_POST["supplie_room_$i"];
			$initial_stock = $_POST["supplie_room_qty_$i"];

			$sql = $conn->prepare("INSERT INTO inv_supplies_per_room (room_id, supply_id, initial_stock, current_stock) VALUES (?, ?, ?, ?)");
			// Vincula los parámetros
			$sql->bind_param("iiii", $room_id, $supply_id, $initial_stock, $initial_stock);
			$sql->execute();
		}


		$uploadDirectory = '../../assets/images/supplies/';
		$uploadFileExtension = explode(".", $uploadedFile['name']);
		$uploadFileExtension = $uploadFileExtension[1];

		$uniqueFilename = $supply_id . '.' . $uploadFileExtension;

		$targetPath = $uploadDirectory . $uniqueFilename;

		if (move_uploaded_file($uploadedFile['tmp_name'], $targetPath)) {
			$sql = $conn->prepare("UPDATE inv_supplies SET image = ? WHERE id = ?");
			$sql->bind_param("si", $supplie_image, $supply_id);

			if ($sql->execute() === TRUE) {
				echo json_encode(['success' => true, 'alert_title' => 'Insumo agregado', 'alert_text' => '']);
			}
		} else {
			echo 'Error al subir la imagen.';
		}
	} else {
		echo "Error al insertar: " . $sql->error;
	}
	// Cierra la conexión
	$conn->close();
}
