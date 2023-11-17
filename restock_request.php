<?php
session_start();
require_once "scripts/connection_db.php";
if (!isset($_SESSION['user_name'])) {
	header('Location: login.php'); // Redirigir al formulario de inicio de sesión
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!--  Title -->
	<title>Insumos</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="author" content="" />
	<meta name="keywords" content="Mordenize" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<!--  Favicon -->
	<link rel="shortcut icon" type="image/png" href="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/favicon.ico" />
	<!-- Owl Carousel  -->

	<!-- Core Css -->
	<link id="themeColors" rel="stylesheet" href="assets/css/styles.min.css" />
	<style>
		.room_image {
			cursor: pointer;
		}

		.child {
			cursor: pointer !important;
		}
	</style>
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
			<?php
			if (isset($_GET['continue']) && $_GET['continue'] == 1) {
				$user_id = $_SESSION['user_id'];
				$sql = "SELECT room_id, token FROM inv_temp_tokens WHERE user_id = $user_id;";
				$query = $conn->query($sql);

				$row = $query->fetch_assoc();
				$room_id = $row['room_id'];
				$token = $row['token'];

				$sql = "SELECT name FROM inv_rooms WHERE id = $room_id;";
				$query = $conn->query($sql);
				$row = $query->fetch_assoc();

				$room_name = $row['name'];
			?>
				<div class="container-fluid">
					<div class="card">
						<div class="text-center">
							<h2 class="mb-0 fs-5 fw-semibold" class="">REGISTRO DE INVENTARIO en <?= $room_name; ?></h2>
						</div>
						<div class="row scrumboard mt-4" id="cancel-row">
							<div class="col-lg-12 layout-spacing pb-3" data-simplebar="">
								<div class="task-list-section">
									<div data-item="item-todo" class="task-list-container" data-action="sorting">
										<div class="connect-sorting connect-sorting-todo">
											<div class="task-container-header">
												<h6 class="item-head mb-0 fs-4 fw-semibold" data-item-title="Todo">Insumos por inventariar</h6>
											</div>
											<div class="connect-sorting-content main" data-sortable="true">

											</div>
										</div>
									</div>
									<div data-item="item-inprogress" class="task-list-container" data-action="sorting">
										<div class="connect-sorting connect-sorting-inprogress">
											<div class="task-container-header">
												<h6 class="item-head mb-0 fs-4 fw-semibold" data-item-title="In Progress">Insumos inventariados</h6>
												<div class="hstack gap-2">

												</div>
											</div>
											<div class="connect-sorting-content child" data-sortable="true">

											</div>
										</div>
									</div>

								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="text-center">
								<button class="btn btn-outline-warning btn-lg" type="button">Enviar inventario a Jair</button>
							</div>
						</div>
					</div>
				</div>
			<?php } else { ?>
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
							<div class="card card-body">
								<div class="row">
									<div class="col-12 mx-auto text-center">
										<div class="container mt-5">
											<form>
												<h3>¡Hola <?= $_SESSION['user_name']; ?>! Selecciona la sala de la que realizarás inventario</h3>
												<div class="row" id="loadImages">
												</div>

										</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
		</div>
	<?php } ?>
	</div>
	<div class="dark-transparent sidebartoggler"></div>
	<div class="dark-transparent sidebartoggler"></div>

	</div>

	<!-- Modal -->
	<div class="modal fade" id="childQtyModal" tabindex="-1" aria-labelledby="miModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="miModalLabel">Título del Modal</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
				</div>
				<div class="modal-body">
					<p>Contenido del modal...</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-primary">Guardar cambios</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="updateQtyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Actualizar inventario</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form id="formQtySupply" method="POST">
						<div class="row">
							<div class="col-6 mx-auto text-center">
								<img id="supply_img" class="img-fluid" width="150px" height="150px">
								<h5 id="supply_name"></h5>
							</div>
							<div class="col-6">
								<div class="d-flex align-items-center justify-content-center" style="min-height: 20vh;">
									<div class="text-center">
										<input type="hidden" class="form-control" name="input_supply_id" id="input_supply_id" required>
										<label class="fw-bold">Cantidad existente en sala:</label>
										<input type="number" min=0 class="form-control" name="input_supply_qty" id="input_supply_qty" required>
										<button class="mt-4 btn btn-xs btn-outline-success" type="submit">Guardar</button>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
					</form>
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


	<script src="https://bootstrapdemos.adminmart.com/modernize/dist/assets/libs/jquery-ui/dist/jquery-ui.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>

	<script>
		$(document).ready(function() {
			getRooms();
			getSuppliesRestockRequest();

			$(document).on("click", ".room_image", function() {
				let room_id = $(this).data('roomid');
				$.ajax({
						data: {
							room_id: room_id
						},
						dataType: "json",
						method: "POST",
						url: "./scripts/add/restock_request.php",
					})
					.done(function(response) {
						if (response.success) {
							window.location.href = 'restock_request.php?continue=1';
						}
					})
					.fail(function(response) {
						console.log(response);
						sweetAlert('Ocurrió un error', 'Contacta a administración', 'error')
					});
			});

			$(document).on("click", ".child-card", function(e) {
				e.preventDefault();
				let supplyid = $(this).data('supplyid');
				let supplyname = $(this).data('supplyname');
				let supplyqty = $(this).data('supplyqty');
				openQtyModal(supplyid, supplyname, supplyqty);
			});

			$("#formQtySupply").on("submit", function(e) {
				e.preventDefault();

				let updated_supply_id = $("#input_supply_id").val();
				let updated_supply_qty = $("#input_supply_qty").val();
				let formData = $(this).serialize();

				$.ajax({
						data: formData,
						dataType: "json",
						method: "POST",
						url: "./scripts/update/restock_request.php",
					})
					.done(function(response) {
						if (response.success) {
							$('div[data-supplyid="' + updated_supply_id + '"]').data('supplyqty', updated_supply_qty);

							$("#updateQtyModal").modal("hide");
							sweetAlert('Hecho!', '', 'success', 'false')
						}
					})
					.fail(function(response) {
						console.log(response)
					});
			});
		});

		function getSuppliesRestockRequest() {
			$.ajax({
					dataType: "json",
					method: "POST",
					url: "./scripts/load/supplies_restock_request.php",
				})
				.done(function(response) {
					$(".main").html("");

					if (response.registers) {
						$.each(response.main, function(index, supply) {

							var supply_draggable_card =
								`<div data-supplyqty="${supply.qty_requested}" data-supplyname="${supply.name}" data-supplyid="${supply.globalid}" data-draggable="true" class="card">
									<div class="card-body">
										<div class="task-header">
											<div class="">
												<h4>
												<span class="badge text-bg-primary fs-1">${supply.globalid}</span> ${supply.name}
												</h4>
											</div>
										</div>
									</div>
								</div>`;


							$('.main').append(supply_draggable_card);
						});

						$.each(response.child, function(index, supply) {

							var supply_draggable_card =
								`<div data-supplyqty="${supply.qty_requested}" data-supplyname="${supply.name}" data-supplyid="${supply.globalid}" data-draggable="true" class="child-card card">
								<div class="card-body">
									<div class="task-header">
										<div class="">
											<h4>
											<span class="badge text-bg-primary fs-1">${supply.globalid}</span> ${supply.name}
											</h4>
										</div>
									</div>
								</div>
							</div>`;

							$('.child').append(supply_draggable_card);
						});
					} else {
						$('#tbodyRooms').append(`No se encontraron registros`);
					}
				})
				.fail(function(response) {
					console.log(response);
				});
		}

		function getRooms() {
			$.ajax({
					dataType: "json",
					method: "POST",
					url: "./scripts/load/rooms.php",
				})
				.done(function(response) {
					$("#loadImages").html("");

					if (response.registers) {

						$.each(response.rooms, function(index, room) {

							let div_per_image = `
							<div data-roomid=${room.id} class="room_image col-xs-12 col-md-4 col-lg-4 mx-auto text-center mt-4">
								<img src="assets/images/rooms/${room.id}.jpg" class="img-fluid">
								<span>${room.name}</span>
							</div>`;

							$('#loadImages').append(div_per_image);
						});
					} else {
						$('#loadImages').append(`No se encontraron registros`);
					}
				})
				.fail(function(response) {
					console.log(response);
				});
		}

		function sweetAlert(title, text, icon) {
			Swal.fire({
				title: title,
				text: text,
				icon: icon,
				background: "white",
				timer: 1400, // Tiempo en milisegundos (en este caso, 3000 ms = 3 segundos)
				timeProgressBar: true,
				showConfirmButton: false, // No muestra el botón de confirmación
			});
		}

		function openQtyModal(supplyid, supplyname, supplyqty) {
			let src = "assets/images/supplies/" + supplyid + ".jpg";
			$("#supply_img").attr("src", src);
			$("#supply_name").html(supplyname);

			$("#input_supply_id").val(supplyid);
			$("#input_supply_qty").val(supplyqty);
			$("#updateQtyModal").modal("show");
		}
	</script>
	<script src="assets/js/kanban.js"></script>

</body>

</html>