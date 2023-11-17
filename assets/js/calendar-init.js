$(document).ready(function() {
  
    let newDate = new Date(); // Nueva Fecha

    /* 
        ? Obtener El Mes Actual. Añadir 1 para tenerlo del rango (1-12) . Si es < 10 agregar 0 a la izquierda.
    */
    function getDynamicMonth() { 
        let getMonthValue = newDate.getMonth();
        let _getUpdatedMonthValue = getMonthValue + 1;
        if (_getUpdatedMonthValue < 10) {
            return `0${_getUpdatedMonthValue}`;
        } else {
            return `${_getUpdatedMonthValue}`;
        }
    }

    let getModalTitleEl = $("#event-title");            // Titulo del Evento
    let getModalStartDateEl = $("#event-start-date");   // Fecha de inicio del evento
    let getModalEndDateEl = $("#event-end-date");       // Fecha Término Evento
    let getModalAddBtnEl = $(".btn-add-event");         // Boton "Añadir evento"
    let getModalUpdateBtnEl = $(".btn-update-event");   // Botón "Guardar cambios"
    let getModalDeleteBtnEl = $(".btn-delete-event");   // Botón "Eliminar Evento"

    let calendarsEvents = {
        Danger: "danger",
        Success: "success",
        Primary: "primary",
        Warning: "warning",
    };

    let calendarEl = $("#calendar");

    let checkWidowWidth = function() {
        if (window.innerWidth <= 1199) {
            return true;
        } else {
            return false;
        }
    };

    let calendarHeaderToolbar = {
        left: "prev next addEventButton",
        center: "title",
        right: "dayGridMonth",
    };


    function getCalendarEventsList(){
        return new Promise(function(resolve, reject) {
                $.ajax({
                method: 'POST',
                url: 'scripts/get_events.php',
                async: true
            }).done(function(response, textStatus, jqXHR) {
                if (jqXHR.status === 204) {
                    // No Content: No hay eventos
                    resolve([]);
                } else {
                    var calendarEventsList = JSON.parse(response);
                    resolve(calendarEventsList);
                }
            }).fail(function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus + ': ' + errorThrown);
                reject(errorThrown);
            });

        });
    }

    async function fetchCalendarEvents() {
    try {
        let calendarEventsList = await getCalendarEventsList();
        
        let calendar = new FullCalendar.Calendar(calendarEl[0], {
            locale: 'es',
            selectable: true,
            height: checkWidowWidth() ? 900 : 1052,
            initialView: checkWidowWidth() ? "listWeek" : "dayGridMonth",
            initialDate: `${newDate.getFullYear()}-${getDynamicMonth()}-07`,
            headerToolbar: calendarHeaderToolbar,
            events: calendarEventsList,
            select: calendarSelect,
            unselect: function() {
                
            },
            customButtons: {
                addEventButton: {
                    text: "Añadir Evento",
                    click: calendarAddEvent,
                },
            },
            eventClassNames: function({ event: calendarEvent }) {
                const getColorValue = calendarsEvents[calendarEvent._def.extendedProps.calendar];
                return [
                    "event-fc-color fc-bg-primary" 
                    //+ getColorValue,
                ];
            },
            eventClick: calendarEventClick,
            windowResize: function(arg) {
                if (checkWidowWidth()) {
                    calendar.changeView("listWeek");
                    calendar.setOption("height", 900);
                } else {
                    calendar.changeView("dayGridMonth");
                    calendar.setOption("height", 1052);
                }
            },
        });
        calendar.render();
    } catch (error) {
        console.error(error);
    }
    }
    fetchCalendarEvents();

    let calendarSelect = function(info) {        
        getModalAddBtnEl.show();
        getModalUpdateBtnEl.hide();
        getModalDeleteBtnEl.hide();
        

        const startDate = `${info.startStr}T00:00`;
            getModalStartDateEl.val(startDate);
        const endDate = `${info.endStr}T00:00`;
        getModalEndDateEl.val(endDate);

        $.ajax({
            url: 'scripts/get_users.php',
            method: 'POST',
            dataType: 'json',
            success: function(data) {
                // Si la petición es exitosa
                if (data && data.length > 0) {
                // Obtener el elemento select
                var select = $('#miSelect');
                select.empty();
                // Iterar sobre los datos y añadir opciones al select
                data.forEach(function(user) {
                    var nuevaOpcion = new Option(user.nombre, user.id);
                    select.append(nuevaOpcion);
                });
                // Inicializar Select2
                select.select2();
                }
            },
            error: function(xhr, status, error) {
                // Si hay un error en la petición
                console.error('Error en la petición:', error);
            }
        });

        myModal.show();
    };
    /*========================== Botón "Añadir Evento" ==========================*/
    let calendarAddEvent = function() {
        let currentDate = new Date();
        let dd = String(currentDate.getDate()).padStart(2, "0");
        let mm = String(currentDate.getMonth() + 1).padStart(2, "0");
        let yyyy = currentDate.getFullYear();
        let combineDate = `${yyyy}-${mm}-${dd}T00:00:00`;

        $.ajax({
            url: 'scripts/get_users.php',
            method: 'POST',
            dataType: 'json',
            success: function(data) {
                // Si la petición es exitosa
                if (data && data.length > 0) {
                // Obtener el elemento select
                var select = $('#miSelect');
                select.empty();
                // Iterar sobre los datos y añadir opciones al select
                data.forEach(function(user) {
                    var nuevaOpcion = new Option(user.nombre, user.id);
                    select.append(nuevaOpcion);
                });
                // Inicializar Select2
                select.select2();
                }
            },
            error: function(xhr, status, error) {
                // Si hay un error en la petición
                console.error('Error en la petición:', error);
            }
        });

        getModalAddBtnEl.show();
        getModalUpdateBtnEl.hide();
        getModalDeleteBtnEl.hide();        
        getModalStartDateEl.val(combineDate);
        getModalEndDateEl.val(combineDate);

        myModal.show();
    };

    let calendarEventClick = function(info) {
        let eventObj = info.event;

        let getModalEventId = eventObj._def.publicId;
        let getModalEventDateStart = convertirFecha(eventObj._instance.range.start);
        
        let getModalEventDateEnd = convertirFecha(eventObj._instance.range.end);
        let getModalEventDescription = eventObj._def.extendedProps['description'];

        let getModalEventSharedWith = eventObj._def.extendedProps['shared_with'];
            getModalEventSharedWith = getModalEventSharedWith.split(",").map(function(numero){
                return parseInt(numero, 10); // convertirlo a numero
                //return numero; // dejarlo como cadena
            });
            console.log(getModalEventSharedWith);
        
        let getModalEventLevel = eventObj._def.extendedProps["calendar"];
        let getModalCheckedRadioBtnEl = $(`input[value="${getModalEventLevel}"]`);

        $("#event-start-date").val(getModalEventDateStart);
        $("#event-end-date").val(getModalEventDateEnd);
        $("#event-description").val(getModalEventDescription);

        
        $.ajax({
            url: 'scripts/get_users.php',
            method: 'POST',
            dataType: 'json',
            async: true,
        }).done(function(data) {
            if (data && data.length > 0) {
                // Obtener el elemento select
                var select = $('#miSelect');
                select.empty();
                
                // Iterar sobre los datos y añadir opciones al select
                data.forEach(function(user) {
                    var nuevaOpcion = new Option(user.nombre, user.id);
                    select.append(nuevaOpcion);
                    
                    if(getModalEventSharedWith.includes(parseInt(user.id,10))){
                        nuevaOpcion.selected = true;
                    }
                });
                // Inicializar Select2
                select.select2();
            }
        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus + ': ' + errorThrown);
        });
        
        
        getModalTitleEl.val(eventObj.title);
        getModalCheckedRadioBtnEl.prop("checked", true);
        getModalUpdateBtnEl.data("fc-event-public-id", getModalEventId);
        getModalDeleteBtnEl.data("fc-event-public-id", getModalEventId);
        getModalAddBtnEl.hide();
        getModalUpdateBtnEl.show();
        getModalDeleteBtnEl.show();
        myModal.show();
    };

    getModalDeleteBtnEl.on("click", function() {
        let event_id = $(this).data('fc-event-public-id');

        Swal.fire({
            title: '¿Estás seguro(a) de eliminar este evento?',
            text: "Esta acción no se puede deshacer.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar evento',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                
                $.ajax({
                    method: 'POST',
                    url: 'scripts/delete_event.php',
                    data: {event_id : event_id},
                }).done(function(response) {
                    $("#eventModal").modal("hide");
                    fetchCalendarEvents();

                    Swal.fire(
                        'Evento eliminado',
                        'El evento ha sido eliminado correctamente.',
                        'success'
                    );
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus + ': ' + errorThrown);
                });
                
            }
        });
        
    });

    getModalUpdateBtnEl.on("click", function() {
        let getPublicID = $(this).data("fc-event-public-id");

        var title = $('#event-title').val();
        var description = $('#event-description').val();
        var start_date = $('#event-start-date').val();
        var end_date = $('#event-end-date').val();
        var share_with = $('#miSelect').val();
        var event_level = $('input[name="event-level"]:checked').val();

        // Crear un objeto con los datos recolectados
        var eventData = {
            title: title,
            description: description,
            start_date: start_date,
            end_date: end_date,
            share_with: share_with,
            event_level: event_level,
            id:getPublicID
        };

        $.ajax({
            method: 'POST',
            url: 'scripts/update_event.php',
            data: eventData,
        }).done(function(response) {
            
            fetchCalendarEvents();
            $("#eventModal").modal("hide");

            var myToastEl = document.getElementById('myToast');
				var myToast = new bootstrap.Toast(myToastEl);
				

				$(".toast-body").html("Cambios guardados exitosamente.");
				myToast.show();
				setTimeout(function() {
						myToast.hide();
				}, 3000);

        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus + ': ' + errorThrown);
        });
        
    });

    getModalAddBtnEl.on("click", function() {
        
        if (validarCamposEnModal()) {
            // Todos los campos requeridos están llenos, puedes proceder con la acción
        // Recolectar los valores de los campos
        var title = $('#event-title').val();
        var description = $('#event-description').val();
        var start_date = $('#event-start-date').val();
        var end_date = $('#event-end-date').val();
        var share_with = $('#miSelect').val();
        var event_level = $('input[name="event-level"]:checked').val();

        // Crear un objeto con los datos recolectados
        var eventData = {
            title: title,
            description: description,
            start_date: start_date,
            end_date: end_date,
            share_with: share_with,
            event_level: event_level
        };

        // Enviar los datos por AJAX
        $.ajax({
            url: 'scripts/add_event.php',
            method: 'POST',
            data: eventData,
            success: function(response) {
                // Manejar la respuesta del servidor si es necesario                
                fetchCalendarEvents();
                $("#eventModal").modal("hide");
            },
            error: function(xhr, status, error) {
                // Manejar errores de la petición
                console.log('Error en la petición:', error);
            }
        });
        }else{
            Swal.fire({
                title: 'Ups',
                text: 'Faltan datos esenciales para configurar el evento',
                icon: 'error',
                timer: 1900, // Tiempo en milisegundos (en este caso, 3000 ms = 3 segundos)
                timerProgressBar: true, // Muestra una barra de progreso
                showConfirmButton: false // No muestra el botón de confirmación
              });
        }
    });

    
    let myModal = new bootstrap.Modal($("#eventModal")[0]);
    let modalToggle = $(".fc-addEventButton-button ");
    $("#eventModal").on("hidden.bs.modal", function(event) {
            $(this).find('input[type="text"], textarea, select').val('');
            $(this).find('select').val(null).trigger('change'); // Reiniciar el select2 si se está utilizando
            $(this).find('input[type="radio"]').prop('checked', false);
    });
});

function validarCamposEnModal() {
    // Obtener todos los elementos con el atributo "required" dentro de la modal
    var camposRequeridos = $('#eventModal [required]');
  
    // Variable para rastrear si todos los campos requeridos están llenos
    var todosLlenos = true;
  
    camposRequeridos.each(function() {
        var valor = $(this).val() + ''; // Convierte el valor a cadena
        if (valor.trim() === '') {
            todosLlenos = false;
        }
    });
  
    return todosLlenos;
}


function convertirFecha(fechaString) {
// Convertir la cadena de fecha a un objeto Date
let fecha = new Date(fechaString);

// Obtener los componentes de la fecha
let year = fecha.getFullYear();
let month = String(fecha.getUTCMonth() + 1).padStart(2, '0');
let day = String(fecha.getUTCDate()).padStart(2, '0');
let hours = String(fecha.getUTCHours()).padStart(2, '0');
let minutes = String(fecha.getUTCMinutes()).padStart(2, '0');

// Crear la cadena de fecha en el formato deseado
let fechaFormateada = `${year}-${month}-${day}T${hours}:${minutes}`;

return fechaFormateada;
console.log(fechaFormateada);
}