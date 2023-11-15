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
							<ul class="list-group pt-2 border-bottom rounded-0">
								<h6 class="my-3 mx-4 fw-semibold">Filtrar por Tienda / Proveedor</h6>
								<li class="list-group-item border-0 p-0 mx-4 mb-2">
									<a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-6 rounded-1" href="javascript:void(0)"><i class="ti ti-ad-2 fs-5"></i>Newest
									</a>
								</li>
							</ul>
							<div class="by-gender border-bottom rounded-0">
								<h6 class="mt-4 mb-3 mx-4 fw-semibold">Ordenar por</h6>
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
								<div class="col-sm-6 col-xl-4">
									<div class="card hover-img overflow-hidden rounded-2">
										<div class="position-relative">
											<a href="javascript:void(0)"><img src="https://static.wixstatic.com/media/f172bd_8b2bbf8ff78d45039aa07a568b8d7f58~mv2.jpg" class="card-img-top rounded-0" alt="..."></a>
											<a href="javascript:void(0)" class="text-bg-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart"><i class="ti ti-basket fs-4"></i></a>
										</div>
										<div class="card-body pt-3 p-4">
											<h6 class="fw-semibold fs-4">Rod</h6>
											<div class="d-flex align-items-center justify-content-between">
												<h6 class="fw-semibold fs-4 mb-0">$285 <span class="ms-2 fw-normal text-muted fs-3"></span></h6>
												<ul class="list-unstyled d-flex align-items-center mb-0">
													<li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a>
													</li>
													<li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a>
													</li>
													<li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a>
													</li>
													<li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a>
													</li>
													<li><a class="" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-6 col-xl-4">
									<div class="card hover-img overflow-hidden rounded-2">
										<div class="position-relative">
											<a href="javascript:void(0)"><img src="https://static.wixstatic.com/media/f172bd_8b2bbf8ff78d45039aa07a568b8d7f58~mv2.jpg" class="card-img-top rounded-0" alt="..."></a>

										</div>
										<div class="card-body pt-3 p-4">
											<h6 class="fw-semibold fs-4">MacBook Air Pro</h6>
											<div class="d-flex align-items-center justify-content-between">
												<h6 class="fw-semibold fs-4 mb-0">$650 <span class="ms-2 fw-normal text-muted fs-3"><del>$900</del></span></h6>
												<ul class="list-unstyled d-flex align-items-center mb-0">
													<li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a>
													</li>
													<li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a>
													</li>
													<li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a>
													</li>
													<li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a>
													</li>
													<li><a class="" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
							<div class="offcanvas-body shop-filters w-100 p-0">
								<ul class="list-group pt-2 border-bottom rounded-0">
									<h6 class="my-3 mx-4 fw-semibold">Filter by Category</h6>
									<li class="list-group-item border-0 p-0 mx-4 mb-2">
										<a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-6 rounded-1" href="javascript:void(0)"><i class="ti ti-circles fs-5"></i>All
										</a>
									</li>
									<li class="list-group-item border-0 p-0 mx-4 mb-2">
										<a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-6 rounded-1" href="javascript:void(0)"><i class="ti ti-hanger fs-5"></i>Fashion
										</a>
									</li>
									<li class="list-group-item border-0 p-0 mx-4 mb-2">
										<a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-6 rounded-1" href="javascript:void(0)"><i class="ti ti-notebook fs-5"></i></i>Books
										</a>
									</li>
									<li class="list-group-item border-0 p-0 mx-4 mb-2">
										<a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-6 rounded-1" href="javascript:void(0)"><i class="ti ti-mood-smile fs-5"></i>Toys
										</a>
									</li>
									<li class="list-group-item border-0 p-0 mx-4 mb-2">
										<a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-6 rounded-1" href="javascript:void(0)"><i class="ti ti-device-laptop fs-5"></i>Electronics
										</a>
									</li>
								</ul>
								<ul class="list-group pt-2 border-bottom rounded-0">
									<h6 class="my-3 mx-4 fw-semibold">Sort By</h6>
									<li class="list-group-item border-0 p-0 mx-4 mb-2">
										<a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-6 rounded-1" href="javascript:void(0)"><i class="ti ti-ad-2 fs-5"></i>Newest
										</a>
									</li>
									<li class="list-group-item border-0 p-0 mx-4 mb-2">
										<a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-6 rounded-1" href="javascript:void(0)"><i class="ti ti-sort-ascending-2 fs-5"></i>Price: High-Low
										</a>
									</li>
									<li class="list-group-item border-0 p-0 mx-4 mb-2">
										<a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-6 rounded-1" href="javascript:void(0)"><i class="ti ti-sort-descending-2 fs-5"></i></i>Price: Low-High
										</a>
									</li>
									<li class="list-group-item border-0 p-0 mx-4 mb-2">
										<a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-6 rounded-1" href="javascript:void(0)"><i class="ti ti-ad-2 fs-5"></i>Discounted
										</a>
									</li>
								</ul>
								<div class="by-gender border-bottom rounded-0">
									<h6 class="mt-4 mb-3 mx-4 fw-semibold">By Gender</h6>
									<div class="pb-4 px-4">
										<div class="form-check py-2 mb-0">
											<input class="form-check-input p-2" type="radio" name="exampleRadios" id="exampleRadios10" value="option1" checked>
											<label class="form-check-label d-flex align-items-center ps-2" for="exampleRadios10">
												All
											</label>
										</div>
										<div class="form-check py-2 mb-0">
											<input class="form-check-input p-2" type="radio" name="exampleRadios" id="exampleRadios11" value="option1">
											<label class="form-check-label d-flex align-items-center ps-2" for="exampleRadios11">
												Men
											</label>
										</div>
										<div class="form-check py-2 mb-0">
											<input class="form-check-input p-2" type="radio" name="exampleRadios" id="exampleRadios12" value="option1">
											<label class="form-check-label d-flex align-items-center ps-2" for="exampleRadios12">
												Women
											</label>
										</div>
										<div class="form-check py-2 mb-0">
											<input class="form-check-input p-2" type="radio" name="exampleRadios" id="exampleRadios13" value="option1">
											<label class="form-check-label d-flex align-items-center ps-2" for="exampleRadios13">
												Kids
											</label>
										</div>
									</div>
								</div>
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
								<div class="by-colors border-bottom rounded-0">
									<h6 class="mt-4 mb-3 mx-4 fw-semibold">By Colors</h6>
									<div class="pb-4 px-4">
										<ul class="list-unstyled d-flex flex-wrap align-items-center gap-2 mb-0">
											<li class="shop-color-list"><a class="shop-colors-item rounded-circle d-block shop-colors-1" href="javascript:void(0)"></a></li>
											<li class="shop-color-list"><a class="shop-colors-item rounded-circle d-block shop-colors-2" href="javascript:void(0)"></a></li>
											<li class="shop-color-list"><a class="shop-colors-item rounded-circle d-block shop-colors-3" href="javascript:void(0)"></a></li>
											<li class="shop-color-list"><a class="shop-colors-item rounded-circle d-block shop-colors-4" href="javascript:void(0)"></a></li>
											<li class="shop-color-list"><a class="shop-colors-item rounded-circle d-block shop-colors-5" href="javascript:void(0)"></a></li>
											<li class="shop-color-list"><a class="shop-colors-item rounded-circle d-block shop-colors-6" href="javascript:void(0)"></a></li>
											<li class="shop-color-list"><a class="shop-colors-item rounded-circle d-block shop-colors-7" href="javascript:void(0)"></a></li>
										</ul>
									</div>
								</div>
								<div class="p-4">
									<a href="javascript:void(0)" class="btn btn-primary w-100">Reset Filters</a>
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
	<script>
		$(document).ready(function() {
			getRooms();
			getCats();

			function getRooms() {
				$.ajax({
						dataType: "json",
						method: "POST",
						url: "./scripts/load/rooms.php",
					})
					.done(function(response) {
						$(".list-rooms").html("");
						console.log(response.rooms)
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
						console.log(response.cats)
						if (response.registers) {
							$.each(response.cats, function(index, cats) {
								$('.list-cats').append(`
                  <!-- start row -->
									<li data-catid="${cat.id}" class="list-group-item border-0 p-0 mx-4 mb-2">
										<a class="li-cat d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-6 rounded-1" href="#"><i class="ti ti-circles fs-5"></i>${cat.name}
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
		});
	</script>
</body>

</html>