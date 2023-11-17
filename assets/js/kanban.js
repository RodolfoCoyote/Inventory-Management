$(function () {
  var usedSupplyIds = new Set();

  function mainKanbanSortable() {
    $(".main").sortable({
      connectWith: ".child",
      items: ".card",
      cursor: "move",
      placeholder: "ui-state-highlight",
      refreshPosition: false,
      start: function (event, ui) {
        //$(".main").append(ui.item[0]);
        //alert("start");
      },
      stop: function (event, ui) {
        //$(".main").append(ui.item[0]);
        //alert("stop");
      },
      update: function (event, ui) {
        console.log(ui.item[0]);
        let item_draggable = $(ui.item[0]);
        let supplyid = item_draggable.data("supplyid");
        let supplyname = item_draggable.data("supplyname");
        let supplyqty = item_draggable.data("supplyqty");
        // Verifica si el supplyId ya está en el conjunto
        if (!usedSupplyIds.has(supplyid)) {
          // No está duplicado
          usedSupplyIds.add(supplyid);
          openQtyModal(supplyid, supplyname, supplyqty);
        } else {
          sweetAlert("Error", "Ya existe el elemento en la sala", "error");
          ui.item.remove(); // Elimina la card duplicada
        }
        //getSupplies();
        //alert("update");
      },
    });
  }
  function childKanbanSortable() {
    $(".child").sortable({
      items: ".card",
      cursor: "pointer",
      placeholder: "ui-state-highlight",
      receive: function (event, ui) {
        // Código a ejecutar cuando se recibe un elemento en un contenedor no arrastrable
        console.log("Recibido en contenedor no arrastrable:", ui.item);
      },
    });
  }

  function sweetAlert(title, text, icon) {
    Swal.fire({
      title: title,
      text: text,
      icon: icon,
      timer: 1400, // Tiempo en milisegundos (1.4 segundos)
      background: "white",
      timerProgressBar: true, // Muestra una barra de progreso
      showConfirmButton: false, // No muestra el botón de confirmación
    });
  }

  mainKanbanSortable();
  childKanbanSortable();
});
