<?php
session_start();
require_once "scripts/connection_db.php";

if (!isset($_SESSION['user_name'])) {
	header('Location: login.php'); // Redirigir al formulario de inicio de sesión
	exit();
}
$user_id = $_SESSION['user_id'];

$sql = "SELECT room_id, token FROM inv_temp_tokens WHERE user_id = $user_id;";
$query = $conn->query($sql);

if ($query->num_rows <= 0) {
	header('Location: index.php'); // Redirigir al formulario de inicio de sesión
}

$row = $query->fetch_assoc();
$room_id = $row['room_id'];
$token = $row['token'];

$sql = "SELECT name FROM inv_rooms WHERE id = $room_id;";
$query = $conn->query($sql);
$row = $query->fetch_assoc();
$room_name = $row['name'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!--  Title -->
	<title>Registro de Inventario | Inventario RDI</title>
	<!--  Required Meta Tag -->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="handheldfriendly" content="true" />
	<meta name="MobileOptimized" content="width" />
	<meta name="author" content="" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<!--  Favicon -->
	<link rel="shortcut icon" type="image/png" href="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/favicon.ico" />
	<!-- Owl Carousel  -->

	<!-- Core Css -->
	<link id="themeColors" rel="stylesheet" href="assets/css/styles.min.css" />
</head>

<body>
	<!-- Preloader -->
	<div class="preloader">
		<img src="assets/images/preloader.webp" alt="loader" class="lds-ripple img-fluid" />
	</div>
	<!--  Body Wrapper -->
	<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
		<!-- Sidebar Start -->
		<?php include_once  __DIR__ . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'sidebar.php'; ?>

		<!--  Sidebar End -->
		<!--  Main wrapper -->
		<div class="body-wrapper">
			<!--  Header Start -->
			<?php include_once  __DIR__ . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'header.php'; ?>
			<!--  Header End -->
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<div class="card card-body">
							<div class="row">
								<div class="col-12 mx-auto text-center">
									<div class="container mt-5">
										<form>
											<h3>¡Hola <?= $_SESSION['user_name']; ?>! Tienes un inventario en curso de <strong><?= $room_name; ?></strong><br>¿deseas continuarlo o comenzar uno nuevo?</h3>
											<div class="btn-group mt-3" role="group" aria-label="Respuesta">
												<a href="index.php?continue=1" type="button" id="btnContinue" class="btn btn-primary mx-2">Continuar donde lo dejé</a>
												<a href="scripts/delete/restock_request.php?token=<?= $token; ?>" type=" button" id="btnReset" class="btn btn-danger mx-2">Comenzar uno nuevo</a>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="dark-transparent sidebartoggler"></div>
		<div class="dark-transparent sidebartoggler"></div>

		<!-- Modal -->
		<div class="modal fade" id="modalRoom" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Gestionar salas</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form id="room" method="POST">
							<div class="mb-3">
								<input type="hidden" class="form-control" name="room_id" id="room_id" value=0>
								<label>Nombre de la sala:</label>
								<input type="text" class="form-control" name="room_name" id="room_name" required>
							</div>
							<div class="mb-3">
								<label>Descripción:</label>
								<textarea class="form-control" name="room_description" id="room_description"></textarea>
							</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-xs btn-outline-success" type="submit">Guardar</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--  Customizer -->
	<!--  Import Js Files -->
	<script src="assets/libs/jquery/dist/jquery.min.js"></script>
	<script src="assets/libs/simplebar/dist/simplebar.min.js"></script>
	<script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
	<!--  core files -->
	<script src="assets/js/app.min.js"></script>
	<script src="assets/js/sidebarmenu.js"></script>

	<script src="assets/js/custom.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="assets/js/contact.js"></script>
	<!--  current page js files -->
	<script>

	</script>
</body>

</html>