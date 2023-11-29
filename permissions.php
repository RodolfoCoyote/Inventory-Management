<html>

<head>
	<title>Asignación de Permisos</title>
</head>

<body>
	<?php if (!isset($_GET['user_id'])) { ?>
		<h2>Elige el usuario:</h2>
		<form id="form_user_permissions" method="POST" action="user_permission.php">
			<select id="select_user" name="user_id" required></select>
			<input type="submit">
		</form>
	<?php } ?>
	<script src=" assets/libs/jquery/dist/jquery.min.js"></script>

	<script>
		$(document).ready(function() {
			$.ajax({
				url: 'scripts/load/users.php',
				method: 'POST',
				dataType: 'json',
				success: function(data) {
					// Si la petición es exitosa
					if (data && data.length > 0) {
						// Obtener el elemento select
						var select = $('#select_user');
						select.empty();
						// Iterar sobre los datos y añadir opciones al select
						data.forEach(function(user) {
							var nuevaOpcion = new Option(user.nombre, user.id);
							select.append(nuevaOpcion);
						});
					}
				},
				error: function(xhr, status, error) {
					// Si hay un error en la petición
					console.error('Error en la petición:', error);
				}
			});
		});
	</script>
</body>

</html>