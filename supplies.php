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
				<div class="card position-relative overflow-hidden">
					<div class="shop-part d-flex w-100">
						<div class="shop-filters flex-shrink-0 border-end d-none d-lg-block">
							<h6 class="my-3 mx-4 fw-semibold">Filtrar por Salas</h6>
							<ul class="list-group list-rooms pt-2 border-bottom rounded-0">

							</ul>
							<h6 class="my-3 mx-4 fw-semibold">Filtrar por Categoría</h6>
							<ul class="list-group list-cats pt-2 border-bottom rounded-0">
							</ul>
							<h6 class="my-3 mx-4 fw-semibold">Filtrar por Tienda / Proveedor</h6>
							<ul class="list-group list-stores pt-2 border-bottom rounded-0">
							</ul>
							<h6 class="mt-4 mb-3 mx-4 fw-semibold">Ordenar por</h6>
							<div class="by-gender border-bottom rounded-0">
								<div class="pb-4 px-4">
									<div class="form-check py-2 mb-0">
										<input class="form-check-input p-2" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
										<label class="form-check-label d-flex align-items-center ps-2" for="exampleRadios1">
											Más caro
										</label>
									</div>
								</div>
							</div>
							<div class="p-4">
								<a href="javascript:void(0)" class="btn btn-primary w-100">Limpiar filtros</a>
							</div>
							<div class="p-4">
								<a type="button" class="btn btn-outline-warning w-100" data-bs-toggle="modal" data-bs-target="#modalSupplie">
									Nuevo insumo
								</a>
							</div>
						</div>
						<div class="card-body p-4 pb-0">
							<div class="d-flex justify-content-between align-items-center mb-4">
								<a class="btn btn-primary d-lg-none d-flex" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
									<i class="ti ti-menu-2 fs-6"></i>
								</a>
								<h5 class="fs-5 fw-semibold mb-0 d-none d-lg-block">Productos</h5>
								<form class="position-relative">
									<input type="text" class="form-control search-chat py-2 ps-5" id="text-srh" placeholder="Search Product">
									<i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
								</form>
							</div>
							<div class="row">
								<?php for ($i = 0; $i < 4; $i++) { ?>
									<!-- <div class="col-lg-3 col-6 mx-auto">
										<div class="card hover-img overflow-hidden rounded-2">
											<div class="position-relative">
												<a href="javascript:void(0)"><img src="https://static.wixstatic.com/media/f172bd_8b2bbf8ff78d45039aa07a568b8d7f58~mv2.jpg" class="img-fluid" alt="..." width="200px" height="200px"></a>
												<a href="javascript:void(0)" class="text-bg-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart"><i class="ti ti-pencil fs-4"></i></a>
											</div>
											<div class="card-body pt-3 p-4">
												<h6 class="fw-semibold fs-4">Jeringa 3 ML</h6>
												<div class="d-flex align-items-center justify-content-between">
													<h6 class="fw-semibold fs-4 mb-0"> <span class="ms-2 fw-normal text-muted fs-3"></span></h6>
												</div>
											</div>
										</div>
									</div> -->
								<?php } ?>
							</div>
						</div>
						<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
							<div class="offcanvas-body shop-filters w-100 p-0">
								<h6 class="my-3 mx-4 fw-semibold">Filtrar por Salas</h6>
								<ul class="list-group list-rooms pt-2 border-bottom rounded-0">
								</ul>
								<h6 class="my-3 mx-4 fw-semibold">Filtrar por Salas</h6>
								<ul class="list-group list-cats pt-2 border-bottom rounded-0">
								</ul>
								<h6 class="mt-4 mb-3 mx-4 fw-semibold">Filtrar por Tienda / Proveedor</h6>
								<div class="by-pricing border-bottom rounded-0">
									<h6 class="mt-4 mb-3 mx-4 fw-semibold">By Pricing</h6>
									<div class="pb-4 px-4">
										<div class="form-check py-2 mb-0">
											<input class="form-check-input p-2" type="radio" name="exampleRadios" id="exampleRadios14" value="option1" checked>
											<label class="form-check-label d-flex align-items-center ps-2" for="exampleRadios14">
												All
											</label>
										</div>
										<div class="form-check py-2 mb-0">
											<input class="form-check-input p-2" type="radio" name="exampleRadios" id="exampleRadios15" value="option1">
											<label class="form-check-label d-flex align-items-center ps-2" for="exampleRadios15">
												0-50
											</label>
										</div>
										<div class="form-check py-2 mb-0">
											<input class="form-check-input p-2" type="radio" name="exampleRadios" id="exampleRadios16" value="option1">
											<label class="form-check-label d-flex align-items-center ps-2" for="exampleRadios16">
												50-100
											</label>
										</div>
										<div class="form-check py-2 mb-0">
											<input class="form-check-input p-2" type="radio" name="exampleRadios" id="exampleRadios17" value="option1">
											<label class="form-check-label d-flex align-items-center ps-2" for="exampleRadios17">
												100-200
											</label>
										</div>
										<div class="form-check py-2 mb-0">
											<input class="form-check-input p-2" type="radio" name="exampleRadios" id="exampleRadios18" value="option1">
											<label class="form-check-label d-flex align-items-center ps-2" for="exampleRadios18">
												Over 200
											</label>
										</div>
									</div>
								</div>
								<div class="p-4">
									<a href="javascript:void(0)" class="btn btn-primary w-100">Limpiar filtros</a>
								</div>

								<div class="p-4">
									<a href="javascript:void(0)" class="btn btn-primary w-100">Agregar nuevo insumo</a>
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
	<div class="modal fade" id="modalSupplie" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Gestionar insumos</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form id="add_supplie" method="POST" enctype="multipart/form-data">
						<div class="mb-3">
							<input type="hidden" class="form-control" name="supplie_id" id="supplie_id" value=0>
							<label>Nombre del Insumo:</label>
							<input type="text" class="form-control" name="supplie_name" id="supplie_name" required>
						</div>
						<div class="mb-3">
							<label>Pertenece a la categoría:</label>
							<select class="form-control" name="supplie_cat" id="supplie_cat" required>
							</select>
						</div>
						<div class="mb-3">
							<label>Suele comprarse en:</label>
							<select class="form-control" name="supplie_store" id="supplie_store">
							</select>
						</div>
						<div class="mb-3">
							<label for="imagen">Selecciona una imagen de referencia:</label>
							<input type="file" class="form-control" name="supplie_img" id="supplie_img" accept="image/*">
						</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-xs btn-outline-success" type="submit">Guardar</button>
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
	<script>
		$(document).ready(function() {
			getRooms();
			getCats();
			getStores();

			$("#add_supplie").on("submit", function(e) {
				e.preventDefault();
				let url = './scripts/add/supply.php';

				let formTexts = $(this).serializeArray();
				let formData = new FormData();
				$.each(formTexts, function(i, field) {
					formData.append(field.name, field.value);
				});
				formData.append('supplie_img', $('#supplie_img')[0].files[0]);

				$.ajax({
						data: formData,
						processData: false,
						contentType: false,
						dataType: "json",
						method: "POST",
						url: url,
					})
					.done(function(response) {
						if (response.success) {
							$("#modalSupplie").modal('hide');

							sweetAlert(response.alert_title, response.alert_text, 'success', true);
						}
					})
					.fail(function(response) {
						console.log(response);
						sweetAlert('Ocurrió un error', 'Contacta a administración', 'error', false);
					});
			});

			function getRooms() {
				$.ajax({
						dataType: "json",
						method: "POST",
						url: "./scripts/load/rooms.php",
					})
					.done(function(response) {
						$(".list-rooms").html("");

						if (response.registers) {
							$.each(response.rooms, function(index, room) {
								$('.list-rooms').append(`
                  <!-- start row -->
									<li data-roomid="${room.id}" class="list-group-item border-0 p-0 mx-4 mb-2">
										<a class="li-room d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-6 rounded-1" href="#"><i class="ti ti-circles fs-5"></i>${room.name}
										</a>
									</li>
                  <!-- end row -->
              	`);

							});
						} else {
							$('.list-rooms').append(`No se encontraron registros`);
						}
					})
					.fail(function(response) {
						console.log(response);
					});
			}

			function getCats() {
				$.ajax({
						dataType: "json",
						method: "POST",
						url: "./scripts/load/cats.php",
					})
					.done(function(response) {
						$(".list-cats").html("");
						if (response.registers) {
							var catSelect = $("#supplie_cat");

							catSelect.empty();
							var defaultOption = new Option('Selecciona', 0, true, true);
							defaultOption.disabled = true;
							catSelect.append(defaultOption);

							$.each(response.cats, function(index, cat) {

								$('.list-cats').append(`
                  <!-- start row -->
									<li data-catid="${cat.id}" class="list-group-item border-0 p-0 mx-4 mb-2">
										<a class="li-cat d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-6 rounded-1" href="#"><i class="ti ti-circles fs-5"></i>${cat.name}
										</a>
									</li>
                  <!-- end row -->
              	`);
								var newCat = new Option(cat.name, cat.id);
								catSelect.append(newCat);
							});



						} else {
							$('.list-rooms').append(`No se encontraron registros`);
						}
					})
					.fail(function(response) {
						console.log(response);
					});
			}

			function getStores() {
				return true;
			}

			function sweetAlert(title, text, icon, showbtn) {
				Swal.fire({
					title: title,
					text: text,
					icon: icon,
					//backdrop: "linear-gradient(yellow, orange)",
					background: "white",
					showConfirmButton: showbtn, // No muestra el botón de confirmación
				});
			}
		});
	</script>
</body>

</html>