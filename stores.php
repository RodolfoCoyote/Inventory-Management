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
	<title>Control de Tiendas | Inventario RDI</title>
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
				<div class="card bg-light-info shadow-none position-relative overflow-hidden">
					<div class="card-body px-4 py-3">
						<div class="row align-items-center">
							<div class="col-12 text-center">
								<h4 class="fw-semibold mb-8">TIENDAS / PROVEEDORES</h4>
								<nav aria-label="breadcrumb">
								</nav>
							</div>

						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="card card-body">
							<div class="row">
								<!-- <div class="col-md-4 col-xl-3">
                  <form class="position-relative">
                    <input type="text" class="form-control product-search ps-5" id="input-search" placeholder="Buscar..." />
                    <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
                  </form>
                </div> -->
								<div class="col-md-12 col-xl-12 text-end d-flex justify-content-md-end justify-content-center mt-3 mt-md-0">
									<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#storeModal">
										Nueva tienda / proveedor
									</button>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-body">
								<div class="table-responsive">
									<table class="table search-table align-middle text-nowrap">
										<thead class="header-item">
											<th>Nombre</th>
											<th>Descripción</th>
											<th>Acciones</th>
										</thead>
										<tbody id="tbodyStores">
										</tbody>
									</table>
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
		<div class="modal fade" id="storeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Gestionar Tiendas / Proveedores</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form id="store" method="POST">
							<div class="mb-3">
								<input type="hidden" class="form-control" name="store_id" id="store_id" value=0>
								<label>Nombre de la tienda o proveedor:</label>
								<input type="text" class="form-control" name="store_name" id="store_name" required>
							</div>
							<div class="mb-3">
								<label>Comentarios:</label>
								<textarea class="form-control" name="store_description" id="store_description"></textarea>
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
		$(document).ready(function() {
			getStores();

			$("#store").on('submit', function(e) {
				e.preventDefault();
				let formData = $(this).serialize();
				const store_id = $("#store_id").val();
				const url = (store_id == 0) ? "./scripts/add/store.php" : './scripts/update/store.php';

				$.ajax({
						data: formData,
						dataType: "json",
						method: "POST",
						url: url,
					})
					.done(function(response) {
						if (response.success) {
							$("#storeModal").modal('hide');
							sweetAlert(response.message, '', 'success');
							getStores();
						}
					})
					.fail(function(response) {
						sweetAlert('Ocurrió un error', 'Contacta a administración', 'error');
					});
			});
			$(document).on("click", ".edit-store", function(e) {
				e.preventDefault();
				const store_id = $(this).data('storeid');
				// Encuentra el padre <tr> (fila de la tabla)
				let row = $(this).closest('tr');

				// Accede al primer <td> y encuentra el <span> con clase "store_name"
				let store_name = row.find('.store_name');

				// Accede al segundo <td> y encuentra el <span> con clase "store_description"
				let store_description = row.find('.store_description');

				$("#store_id").val(store_id);
				$("#store_name").val(store_name.text());
				$("#store_description").val(store_description.text());
				$("#storeModal").modal("show");
			});
			$(document).on("click", ".delete-store", function(e) {
				e.preventDefault();
				const store_id = $(this).data('storeid');
				askDelete(store_id);
			});
		});

		function sweetAlert(title, text, icon) {
			Swal.fire({
				title: title,
				text: text,
				icon: icon,
				//backdrop: "linear-gradient(yellow, orange)",
				background: "white",
				timer: 1400, // Tiempo en milisegundos (en este caso, 3000 ms = 3 segundos)
				timerProgressBar: true, // Muestra una barra de progreso
				showConfirmButton: false, // No muestra el botón de confirmación
			});
		}

		function getStores() {
			$.ajax({
					dataType: "json",
					method: "POST",
					url: "./scripts/load/stores.php",
				})
				.done(function(response) {
					$("#tbodyStores").html("");
					console.log(response.stores)
					if (response.registers) {
						$.each(response.stores, function(index, store) {
							$('#tbodyStores').append(`
                  <!-- start row -->
                  <tr class="search-items" data-storeid='${store.id}'>
                    <td>
                      <span class="store_name">${store.name}</span>
                    </td>
                    <td>
                      <span class="store_description">${store.description}</span>
                    </td>
                    <td>
                      <div class="action-btn">
                        <a data-storeid='${store.id}' href="#" class="edit-store">
                          <i class="ti ti-pencil fs-5"></i>
                        </a>
                        <a data-storeid='${store.id}' href="#" class="delete-store text-danger ms-2">
                          <i class="ti ti-trash fs-5"></i>
                        </a>
                      </div>
                    </td>
                  </tr>
                  <!-- end row -->
              `);
						});
					} else {
						$('#tbodyStores').append(`No se encontraron registros`);
					}
				})
				.fail(function(response) {
					console.log(response);
				});
		}

		function askDelete(store_id) {
			// Muestra el cuadro de diálogo de confirmación
			Swal.fire({
				title: "¿Estás seguro?",
				text: "Esta acción no se puede revertir.",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#d33",
				cancelButtonColor: "#3085d6",
				confirmButtonText: "Sí, eliminar",
				cancelButtonText: "Cancelar",
			}).then((result) => {
				if (result.isConfirmed) {
					// Ejecuta la acción de eliminación si se confirma
					deleteStore(store_id);
				}
			});
		}

		function deleteStore(store_id) {
			$.ajax({
					data: {
						store_id: store_id
					},
					dataType: "json",
					method: "POST",
					url: "./scripts/delete/store.php",
				})
				.done(function(response) {
					var $elementoLi = $('tr[data-storeid="' + store_id + '"]');
					// Hacer algo con el elemento <li> encontrado
					if ($elementoLi.length > 0) {
						$elementoLi.fadeOut();
						$elementoLi.remove();
					}
					$(".app-email-chatting-box").hide();
					sweetAlert(response.message, "", "success");
				})
				.fail(function(response) {
					console.log(response.responseText);
					sweetAlert("Ocurrió un error", "Contacta a administración", "error");
				});
		}
	</script>
</body>

</html>