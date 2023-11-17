<?php
session_start();

if (!isset($_SESSION['user_name'])) {
	header('Location: login.php'); // Redirigir al formulario de inicio de sesión
	exit();
}
// Resto del contenido de la página aquí
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
				<div class="">
					<div class="action-btn layout-top-spacing mb-7 d-flex align-items-center justify-content-between">
						<h5 class="mb-0 fs-5 fw-semibold">Administrar salas e insumos</h5>
					</div>
					<div class="row scrumboard" id="cancel-row">
						<div class="col-lg-12 layout-spacing pb-3" data-simplebar="">
							<div class="task-list-section">
								<div data-item="item-todo" class="task-list-container" data-action="sorting">
									<div class="connect-sorting connect-sorting-todo">
										<div class="task-container-header">
											<h6 class="item-head mb-0 fs-4 fw-semibold" data-item-title="Todo">Insumos Registrados</h6>
										</div>
										<div class="connect-sorting-content main" data-sortable="true">

										</div>
									</div>
								</div>
								<div data-item="item-inprogress" class="task-list-container" data-action="sorting">
									<div class="connect-sorting connect-sorting-inprogress">
										<div class="task-container-header">
											<h6 class="item-head mb-0 fs-4 fw-semibold" data-item-title="In Progress">Sala Procedimiento 1</h6>
											<div class="hstack gap-2">
												<div class="dropdown">
													<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink-1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
														<i class="ti ti-dots-vertical text-dark"></i>
													</a>
													<div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink-1">
														<a class="dropdown-item list-edit" href="javascript:void(0);">Edit</a>
														<a class="dropdown-item list-delete" href="javascript:void(0);">Delete</a>
														<a class="dropdown-item list-clear-all" href="javascript:void(0);">Clear All</a>
													</div>
												</div>
											</div>
										</div>
										<div class="connect-sorting-content child" data-sortable="true">

										</div>
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
					<form id="room" method="POST">
						<div class="mx-auto text-center">
							<img id="supply_img" class="img-fluid" width="150px" height="150px">
							<h5 id="supply_name">Abatelenguas</h5>
						</div>
						<div class="mb-3">
							<div class="col-10 mx-auto text-center">
								<input type="text" class="form-control" name="input_supply_id" id="input_supply_id" required>
								<label class="fw-bold">Cantidad existente en sala:</label>
							</div>
							<div class="col-3 mx-auto">
								<input type="number" min=0 class="form-control" name="input_supply_qty" id="input_supply_qty" required>
							</div>
						</div>
						<div class="modal-footer">
							<button class="btn btn-xs btn-outline-success" type="submit">Actualizar</button>
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

			getSupplies();
		});

		function getSupplies() {
			$.ajax({
					dataType: "json",
					method: "POST",
					url: "./scripts/load/supplies.php",
				})
				.done(function(response) {
					$(".main").html("");

					if (response.registers) {
						$.each(response.supplies, function(index, supply) {

							var supply_draggable_card =
								`<div data-supplyid="${supply.id}" data-draggable="true" class="card">
									<div class="card-body">
										<div class="task-header">
											<div class="">
												<h4 class="" data-item-title="">
												<span class="badge text-bg-primary fs-1">${supply.id}</span> ${supply.name}
												</h4>
											</div>
											<div class="dropdown">
												<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink-1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
													<i class="ti ti-dots-vertical text-dark"></i>
												</a>
												<div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink-1">
													<a class="dropdown-item kanban-item-edit cursor-pointer d-flex align-items-center gap-1" href="javascript:void(0);"><i class="ti ti-pencil fs-5"></i>Edit</a>
													<a class="dropdown-item kanban-item-delete cursor-pointer d-flex align-items-center gap-1" href="javascript:void(0);"><i class="ti ti-trash fs-5"></i>Delete</a>
												</div>
											</div>
										</div>
									</div>
								</div>`;


							$('.main').append(supply_draggable_card);
						});
					} else {
						$('#tbodyRooms').append(`No se encontraron registros`);
					}
				})
				.fail(function(response) {
					console.log(response);
				});
		}
	</script>
	<script src="assets/js/kanban.js"></script>

</body>

</html>