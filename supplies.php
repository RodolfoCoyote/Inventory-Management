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
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<!--  Favicon -->
	<link rel="shortcut icon" type="image/png" href="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/favicon.ico" />
	<!-- Owl Carousel  -->

	<!-- Core Css -->
	<link id="themeColors" rel="stylesheet" href="assets/css/styles.min.css" />

	<style>
		.highlight {
			color: #e0ac44;
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
			<div class="container-fluid">
				<div class="card position-relative overflow-hidden">
					<div class="shop-part d-flex w-100">
						<div class="shop-filters flex-shrink-0 border-end d-none d-lg-block">
							<h6 class="my-3 mx-4 fw-semibold">Filtrar por Salas</h6>
							<ul class="list-group list-rooms pt-2 border-bottom rounded-0">
							</ul>
							<h6 class="my-3 mx-4 fw-semibold">Filtrar por Categoría</h6>
							<div class="filter-buttons">
								<li data-filter="*">Todos</li>
								<ul class="list-group list-cats pt-2 border-bottom rounded-0">
								</ul>
							</div>
							<h6 class="my-3 mx-4 fw-semibold">Filtrar por Tienda / Proveedor</h6>
							<div class="filter-buttons">
								<ul class="list-group list-stores pt-2 border-bottom rounded-0">
								</ul>
							</div>
							<!-- <h6 class="mt-4 mb-3 mx-4 fw-semibold">Ordenar por</h6> -->
							<!-- <div class="by-gender border-bottom rounded-0">
								<div class="pb-4 px-4">
									<div class="form-check py-2 mb-0">
										<input class="form-check-input p-2" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
										<label class="form-check-label d-flex align-items-center ps-2" for="exampleRadios1">
											Más caro
										</label>
									</div>
								</div>
							</div> -->
							<div class="p-4">
								<a href="supplies.php" class="btn btn-primary w-100">Limpiar filtros</a>
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
								<input type="text" id="search" placeholder="Buscar por nombre">

								<!-- <form class="position-relative">
									<input type="text" class="form-control search-chat py-2 ps-5" id="text-srh" placeholder="Search Product">
									<i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
								</form> -->
							</div>
							<div class="row" id="showProducts">
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
	<div class="modal fade" id="viewSupplyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Gestionar insumos</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form id="updateQtySupply" method="POST" action="#">
					<div class="modal-body">
					</div>
					<div class="modal-footer">
					</div>
				</form>
			</div>
		</div>
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
							<label>Se mide en:</label>
							<select id="supplie_measure" name="supplie_measure" class="form-control" required>
								<option value="Caja">Caja</option>
								<option value="Galón">Galón</option>
								<option value="Garrafón">Garrafón</option>
								<option value="Paquete">Paquete</option>
								<option value="Pieza">Pieza</option>
								<option value="Rollo">Rollo</option>
							</select>
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
						<div class="row" id="newRoom">
							<div class="col-6">
								<label>Se encuentra en la sala:</label>
								<select class="form-control select_rooms" name="supplie_room_0" id="supplie_room_0" required>
								</select>
							</div>
							<div class="col-6">
								<label>Y debe tener en existencia:</label>
								<input type="number" class="form-control" name="supplie_room_qty_0" id="supplie_room_qty_0" min=0 required>
							</div>
						</div>
						<div class="d-flex justify-content-center">
							<button class="mt-4 btn btn-outline-success" id="btnAddNewRoom">El insumo tambien aparece en...</button>
						</div>
						<div class="row text-center" id="addNewRoom">
						</div>

						<div class="mb-3">
							<label for="imagen">Selecciona una imagen de referencia:</label>
							<input type="file" class="form-control" name="supplie_img" id="supplie_img" accept="image/*">
						</div>
						<div class="modal-footer">
							<button class="btn btn-xs btn-outline-success" type="submit">Guardar</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!--  Import Js Files -->
	<script src=" assets/libs/jquery/dist/jquery.min.js"></script>
	<script src="assets/libs/simplebar/dist/simplebar.min.js"></script>
	<script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
	<!--  core files -->
	<script src="assets/js/app.min.js"></script>
	<script src="assets/js/sidebarmenu.js"></script>
	<script src="assets/js/custom.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js"></script>

	<script>
		var count_room = 0;

		$(document).ready(function() {
			getRooms();
			getCats();
			getStores();
			getSupplies();

			$("#add_supplie").on("submit", function(e) {
				e.preventDefault();
				let url = './scripts/add/supply.php';

				let formTexts = $(this).serializeArray();

				console.log(formTexts);
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
							location.reload()
							/*getSupplies();

							$("#modalSupplie").modal('hide');

							sweetAlert(response.alert_title, response.alert_text, 'success', true);*/
						}
					})
					.fail(function(response) {
						console.log(response);
						sweetAlert('Ocurrió un error', 'Contacta a administración', 'error', false);
					});
			});

			$("#btnAddNewRoom").on("click", function(e) {
				e.preventDefault();
				$.ajax({
						dataType: "json",
						method: "POST",
						url: "./scripts/load/rooms.php",
					})
					.done(function(response) {
						let newRoom = `
							<div class="row" id="newRoom_${count_room}">
								<div class="col-6">
									<label>Se encuentra en la sala:</label>
									<select class="form-control select_rooms" name="supplie_room_${count_room}" id="supplie_room_${count_room}" required>
									</select>
								</div>
								<div class="col-6">
									<label>Y debe tener en existencia:</label>
									<input type="number" class="form-control" name="supplie_room_qty_${count_room}" id="supplie_room_qty_${count_room}" min=0 required>
								</div>
							</div>`;
						$("#addNewRoom").append(newRoom);

						var roomSelect = $("#supplie_room_" + count_room);
						roomSelect.empty();
						var defaultOption = new Option('Selecciona', 0, true, true);
						defaultOption.disabled = true;
						roomSelect.append(defaultOption);

						$.each(response.rooms, function(index, room) {

							var newRoom = new Option(room.name, room.id);
							roomSelect.append(newRoom)
						});
					})
					.fail(function(response) {});

				count_room++;
			});

			$(document).on("click", ".seeDetails", function(e) {
				e.preventDefault();
				const supply_id = $(this).data('supplyid');
				getIndividualSupply(supply_id);
			});

			$(document).on("click", ".list-room-item", function(e) {
				let roomid = $(this).data('roomid');
				getSupplies(roomid);
			});
			$(document).on("submit", "#updateQtySupply", function(e) {
				e.preventDefault();
				let formData = $(this).serialize();
				console.log(formData)
				$.ajax({
						data: formData,
						dataType: "json",
						method: "POST",
						url: './scripts/update/individual_supply_qty.php',
					})
					.done(function(response) {
						if (response.success) {
							getSupplies();
							$("#updateQtySupply").modal('hide');
							sweetAlert(response.alert_title, response.alert_text, 'success', true);
						}
					})
					.fail(function(response) {
						console.log(response);
						sweetAlert('Ocurrió un error', 'Contacta a administración', 'error', false);
					});
			});

			$(document).on("click", "#closeViewSupplyModal", function(e) {
				$("#viewSupplyModal").modal("hide");
			});

			function getRooms(roomid) {
				$.ajax({
						dataType: "json",
						method: "POST",
						url: "./scripts/load/rooms.php?room_id=" + roomid,
					})
					.done(function(response) {
						$(".list-rooms").html("");

						if (response.registers) {
							var roomSelect = $("#supplie_room_0");

							roomSelect.empty();
							var defaultOption = new Option('Selecciona', 0, true, true);
							defaultOption.disabled = true;
							roomSelect.append(defaultOption);

							$.each(response.rooms, function(index, room) {

								$('.list-rooms').append(`
									<!-- start row -->
										<li data-roomid="${room.id}" class="list-room-item list-group-item border-0 p-0 mx-4 mb-2">
											<a class="li-room d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-6 rounded-1" href="#"><i class="ti ti-circles fs-5"></i>${room.name}
											</a>
										</li>
									<!-- end row -->
								`);
								var newRoom = new Option(room.name, room.id);
								roomSelect.append(newRoom);
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
									<li data-filter=".category${cat.id}" class="list-group-item border-0 p-0 mx-4 mb-2">
										<a class="li-cat d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-6 rounded-1" href="#"><i class="ti ti-circles fs-5"></i>${cat.name}
										</a>
									</li>
								<!-- end row -->
							`);
								var newCat = new Option(cat.name, cat.id);
								catSelect.append(newCat);
							});
						} else {
							$('.list-cats').append(`No se encontraron registros`);
						}
					})
					.fail(function(response) {
						console.log(response);
					});
			}

			function getStores() {
				$.ajax({
						dataType: "json",
						method: "POST",
						url: "./scripts/load/stores.php",
					})
					.done(function(response) {
						$(".list-stores").html("");
						if (response.registers) {
							var storeSelect = $("#supplie_stores");

							storeSelect.empty();
							var defaultOption = new Option('Selecciona', 0, true, true);
							defaultOption.disabled = true;
							storeSelect.append(defaultOption);

							$.each(response.stores, function(index, store) {

								$('.list-stores').append(`
								<!-- start row -->
								<li data-filter=".store${store.id}" class="list-group-item border-0 p-0 mx-4 mb-2">
									<a class="li-cat d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-6 rounded-1" href="#"><i class="ti ti-circles fs-5"></i>${store.name}
									</a>
								</li>
								<!-- end row -->
							`);
								var newStore = new Option(store.name, store.id);
								storeSelect.append(newStore);
							});



						} else {
							$('.list-stores').append(`No se encontraron registros`);
						}
					})
					.fail(function(response) {
						console.log(response);
					});
			}

			function activateIsotope() {
				var $productContainer = $('#showProducts');

				// Inicializar Isotope
				var $grid = $productContainer.isotope({
					itemSelector: '.product'
				});
				if ($grid.isotope('destroy')) {
					console.log('Isotope se ha destruído');
				}
				var $grid = $productContainer.isotope({
					itemSelector: '.product'
				});
				// Imprimir en la consola el número de elementos detectados por Isotope
				var numberOfElements = $productContainer.data('isotope').filteredItems.length;
				console.log('Isotope ha detectado ' + numberOfElements + ' elementos.');

				// Manejar eventos de filtro
				$('.filter-buttons').on('click', 'li', function() {
					var filterValue = $(this).attr('data-filter');
					$productContainer.isotope({
						filter: filterValue
					});
				});

				$("#search").keyup(function() {
					var searchText = $(this).val().toLowerCase();
					$grid.isotope({
						filter: function() {
							var text = $(this).text().toLowerCase();
							return text.includes(searchText);
						}
					});
				});
			}

			function getSupplies(roomid) {
				$("#showProducts").html("");
				let url = "./scripts/load/supplies_grid.php?room_id=" + roomid;
				$.ajax({
						dataType: "json",
						method: "POST",
						url: url,
					})
					.done(function(response) {
						$.each(response.supplies, function(index, supply) {
							let supply_card = `
							<div class="product store${supply.store_id} category${supply.cat_id} col-lg-3 col-6">
								<div class="card hover-img overflow-hidden rounded-2">
									<div class="position-relative">
									<img src="assets/images/supplies/${supply.id}.jpg" alt="..." width="200px" height="200px">
										<a data-supplyid=${supply.id} href="#" class="text-bg-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3 seeDetails"><i class="ti ti-eye fs-4"></i></a>
									</div>
									<div class="card-body pt-3 p-4">
										<h6 class="fw-semibold fs-4">${supply.name}</h6>
										<strong>Debe haber:</strong> ${supply.initial_stock} ${supply.measure}(s) <br>
										<strong>En existencia:</strong> ${supply.current_stock}
									</div>
								</div>
							</div>`;

							$("#showProducts").append(supply_card);
						});
						activateIsotope();
					})
					.fail(function(response) {
						console.log(response);
					});
			}

			function getIndividualSupply(supply_id) {
				$.ajax({
						data: {
							supply_id: supply_id
						},
						dataType: "json",
						method: "POST",
						url: './scripts/load/individual_supply.php',
					})
					.done(function(response) {
						if (response.success) {
							var count = 0;
							let supply_info = response.supply_info;
							console.log(response);
							console.log(response.supply_info);

							let modal_body =
								`<div class="row">
									<div class="col-3">
										<img src="assets/images/supplies/${supply_info.id}.jpg" class="img-fluid">
									</div>
									<div class="col-9">
										<div class="text-center">
											<h4>Producto: <strong class="highlight">${supply_info.name}</strong> <br><br></h4>
											Unidad de medida: <span class="highlight">${supply_info.measure}</span> <br>
											Categoría: <span class="highlight">${supply_info.cat_name}</span> <br>
										</div>
									</div>
								</div>
								<div class=" col-12 text-center mt-4">
									<h5 id="txtActualizar">Actualizar existencias:</h5>
								</div>
								`;

							$("#viewSupplyModal .modal-body").html(modal_body);

							$.each(response.supply_per_room, function(index, spr) {
								if (spr.qty_requested > 0) {
									let supply_per_room_info = (spr.qty_requested > 0) ?
										`<div class="row mt-4">
										<div class="col-9 d-flex align-items-center">
											<h6>En ${spr.room_name}, de ${spr.qty_requested} solicitados, abastecí: </h6>
											<input type="hidden" id="view_spr_id_${count}" name="view_spr_id_${count}" value="${spr.id}">
										</div>
										<div class="col-3 d-flex align-items-center">
											<input type="number" id="view_qty_${count}" name="view_qty_${count}" min="0" max="${spr.qty_requested}" class="form-control ml-2" required>
										</div>
									</div>
									<hr>` :
										`
									`;
									$("#viewSupplyModal .modal-body").append(supply_per_room_info);
									count++;
								}
							});
							if (count > 0) {
								$("#viewSupplyModal .modal-footer").html(`
										<button class="btn btn-xs btn-outline-success" type="submit">Actualizar</button>`);
							} else {
								$("#txtActualizar").css('display', 'none');
								$("#viewSupplyModal .modal-footer").html(`
										<button type="button" class="btn btn-danger" id="closeViewSupplyModal">Cerrar</button>`);
							}
							$("#viewSupplyModal").modal("show");
						}
					})
					.fail(function(response) {
						console.log(response);
						sweetAlert('Ocurrió un error', 'Contacta a administración', 'error', false);
					});

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