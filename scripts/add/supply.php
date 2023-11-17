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
    $supplie_measure = "Temp";
    $supplie_image = "Temp";
    $supplie_cat = $_POST['supplie_cat'];
    $supplie_store = 1;

    $sql = $conn->prepare("INSERT INTO inv_supplies (name, measure, image, cat_id, store_id) VALUES (?, ?, ?, ?, ?)");
    // Vincula los parámetros
    $sql->bind_param("sssii", $supplie_name, $supplie_measure, $supplie_image, $supplie_cat, $supplie_store);

    // Ejecuta la consulta
    if ($sql->execute() === TRUE) {
        $supplie_id = $conn->insert_id;

        $uploadDirectory = '../../assets/images/supplies/';
        $uniqueFilename = $supplie_id . '_' . $uploadedFile['name'];

        $targetPath = $uploadDirectory . $uniqueFilename;

        if (move_uploaded_file($uploadedFile['tmp_name'], $targetPath)) {
            $sql = $conn->prepare("UPDATE inv_supplies SET image = ? WHERE id = ?");
            $sql->bind_param("si", $supplie_image, $supplie_id);

            if ($sql->execute() === TRUE) {
                echo json_encode(['success' => true, 'alert_title' => 'Insumo agregado', 'alert_text' => 'Recuerda que debes configurarlo en el Organizador']);
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
