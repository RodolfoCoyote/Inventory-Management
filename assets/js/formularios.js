$(document).ready(function(){
	moment.locale('es');
	getForms(0,0,'all');

	$('.filtros').click(function() {
	$("#daterange").fadeOut();
		$('.filtros').removeClass('selected'); // Remueve la clase 'selected' de todos los elementos
		$(this).addClass('selected'); // Agrega la clase 'selected' al elemento clickeado
	});

	$('input[name="daterange"]').daterangepicker();

	$("#all_forms").click(function(){
		getForms(0,0,'all');
	});

	$("#unread").click(function(){
		getForms(0,0,'unread');
	});

	$("#sort_date").click(function(){
		$('input[name="daterange"]').fadeIn("slow");
	});

	$('#daterange').on('apply.daterangepicker', function(ev, picker) {
		let date = $("#daterange").val();
				date = date.split("-");
		console.log(date);
		let startDate = date[0];
			let partes = startDate.split('/');            
			startDate = partes[1] + '/' + partes[0] + '/' + partes[2];
			
		let endDate = date[1].trim();
			let partes2 = endDate.split('/');
			endDate = partes2[1]+"/"+partes2[0]+"/"+partes2[2];
			console.log(startDate);
			console.log(endDate);

			getForms(startDate,endDate,'custom');
	});
});
			
$(document).on('click', '.simplebar-content li', function() {
	let form_id = $(this).data('formid');
	$.ajax({
			data: { form_id: form_id },
			dataType: 'json',
			method: 'POST',
			url: './scripts/get_unique_form.php'
	}).done(function(user) {
		var $formInfo = $('#form_info');

		$formInfo.fadeOut(400, function() {
			// Cambiar el contenido
			// Aparecer con animación
			$formInfo.fadeIn(400);
		});
		let form_info = `<div class="chat-list chat active-chat" data-user-id="1">
											<div class="hstack align-items-start mb-7 pb-1 align-items-center justify-content-between">
												<div class="d-flex align-items-center gap-3">
													<img src="https://www.losreyesdelinjerto.com/assets/img/leon-footer.webp" alt="user4" width="36" height="50" class="rounded-circle" />
													<div>
														<h2 class="fw-semibold fs-4 mb-0">${user.nombre}</h2>
														<h6 class="fw-semibold mb-0">${user.genero}</h6>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-4 mb-7">
													<p class="mb-1 fs-2">Teléfono</p>
													<h6 class="fw-semibold mb-0">${user.telefono}</h6>
												</div>
												<div class="col-4 mb-7">
													<p class="mb-1 fs-2">Clínica</p>
													<h6 class="fw-semibold mb-0 text-danger">${user.clinica}</h6>
												</div>
												<div class="col-4 mb-9">
													<p class="mb-1 fs-2">Tiempo con Alopecia</p>
													<h6 class="fw-semibold mb-0">  ${user.tiempo_alopecia === 'na' ? 'N/A' : user.tiempo_alopecia} año(s) </h6>
												</div>
												<div class="col-4 mb-7">
													<p class="mb-1 fs-2">Tipo Alopecia</p>
													<h6 class="fw-semibold mb-0"> ${user.tipo_alopecia === '0' ? 'N/A' : user.tipo_alopecia} </h6>
												</div>
												<div class="col-4 mb-7">
													<p class="mb-1 fs-2">Antecedentes</p>
													<h6 class="fw-semibold mb-0">  ${user.antecedentes === 'si' || user.antecedentes === 'no' ? user.antecedentes : 'N/A'} </h6>
												</div>
												<div class="col-12 mb-7">
													<p class="mb-1 fs-2">Mensaje</p>
													<h6 class="fw-semibold mb-0">  ${user.antecedentes === 'si' || user.antecedentes === 'no' ? 'N/A' : user.antecedentes } </h6>
												</div>
											</div>
											
											<div class="d-flex align-items-center gap-2">
												<button class="btn btn-primary fs-2 copy" data-formid=${user.id}>Copiar al portapapeles</button>
												<!-- <button class="btn btn-danger fs-2">Enviar a </button> -->
											</div>
										</div>`;
		$("#form_info").html(form_info);
		var mySimpleBar = new SimpleBar(document.getElementById('form_info'));
		
		if( user.tiempo_alopecia === "na" ){
			var copyText = `*Nuevo Lead*\r\n\r\n*Nombre*:${user.nombre}\r\n*Teléfono:* ${user.telefono}\r\n*Clínica:* ${user.clinica}\r\n*Tipo de Injerto:* ${user.genero}\r\n*Mensaje:* ${user.antecedentes}`;
		}else{
			var copyText = `*Nuevo Lead*\r\n\r\n*Nombre*:${user.nombre}\r\n*Teléfono:* ${user.telefono}\r\n*Clínica:* ${user.clinica}\r\n*Genero:* ${user.genero}\r\n*Tiempo Alopecia:* ${user.tiempo_alopecia} año(s)\r\n*Tipo Alopecia:* ${user.tipo_alopecia}\r\n*Antecedentes fam.:* ${user.antecedentes}`;
		}
		$("#copyText").val(copyText);

	}).fail(function(jqXHR, textStatus, errorThrown) {
			var myToastEl = document.getElementById('myToast');
				var myToast = new bootstrap.Toast(myToastEl);
				

				$(".toast-body").html("No se obtuvieron resultados con los filtros seleccionados");
				myToast.show();
				setTimeout(function() {
						myToast.hide();
				}, 3000);
	});
});

$(document).on('click', '.copy', function() {
	var form_id = $(this).data('formid');
	var textoACopiar = document.getElementById('copyText');
	textoACopiar.select();
	document.execCommand('copy');
	
	var myToastEl = document.getElementById('myToast');
	var myToast = new bootstrap.Toast(myToastEl);
	$(".toast-body").html('Lead copiado al portapapeles!');
	myToast.show();
	setTimeout(function() {
			myToast.hide();
	}, 3000);
	$.ajax({
			data: { form_id: form_id },
			method: 'POST',
			url: './scripts/form_read.php'
	}).done(function(response) {
		
			if(response) $('li[data-formid="'+form_id+'"]').removeClass('form-unread');
	}).fail(function(jqXHR, textStatus, errorThrown) {
			console.log(textStatus + ': ' + errorThrown);
	});
});

function getForms(startDate,endDate,date){
		
		$.ajax({
				data: { startDate: startDate, endDate: endDate, date: date },
				dataType: 'json',
				method: 'POST',
				url: './scripts/get_forms.php'
		}).done(function(response) {
				$("#forms_list").html(''); 

				$.each(response, function(index, item) {
						const status_form = item.status == 0 ? '' : 'form-unread';

						let form_contact = `<li class="simplebar-content ${status_form}" data-formid="${item.id}">
													<a href="#" class="px-4 py-3 bg-hover-light-black d-flex align-items-center chat-user" id="chat_user_${item.id}" data-user-id="${item.id}">
														<span class="position-relative">
															
														</span>
														<div class="ms-6 d-inline-block w-75">
															<h6 class="mb-1 fw-semibold chat-title" data-nameid="${item.id}">${item.nombre}</h6>
															<span class="fs-2 text-body-color d-block" data-nameid="${item.id}">${item.clinica} - ${item.fecha}</span>
														</div>
													</a>
												</li>`;
						$("#forms_list").append(form_contact); 
				});   
			var mySimpleBar = new SimpleBar(document.getElementById('forms_list'));
			//$('#forms_list').SimpleBar.recalculate();
		}).fail(function(jqXHR, textStatus, errorThrown) {

		$("#forms_list").html('');
			var myToastEl = document.getElementById('myToast');
				var myToast = new bootstrap.Toast(myToastEl);
				

				$(".toast-body").html("No se obtuvieron resultados con los filtros seleccionados");
				myToast.show();
				setTimeout(function() {
						myToast.hide();
				}, 3000);
		});
}