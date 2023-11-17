$(document).ready(function () {
  $.ajax({
    url: "scripts/get_categories.php",
    method: "POST",
    dataType: "json",
    success: function (data) {
      // Si la petición es exitosa
      if (data && data.length > 0) {
        // Obtener el elemento select
        var select = $("#cat_id");
        select.empty();
        // Iterar sobre los datos y añadir opciones al select
        var defaultOption = new Option("Selecciona", 0);
        $(defaultOption).attr("selected", true).attr("disabled", true);
        select.append(defaultOption);

        data.forEach(function (cat) {
          var nuevaOpcion = new Option(cat.name, cat.id);
          select.append(nuevaOpcion);
        });
      }
    },
    error: function (xhr, status, error) {
      // Si hay un error en la petición
      console.error("Error en la petición:", error);
    },
  });

  getTransactions();

  let formNewExpense = $("#formNewExpense");
  let formNewIncome = $("#formNewIncome");
  let btnAddPaymentMethod = $("#add-payment-method");
  let paymentMethodNumber = 1;

  $("#expenseTable th").click(function () {
    var columna = $(this).data("column");
    var orden = $(this).hasClass("asc") ? "desc" : "asc";

    $("#expenseTable th").removeClass("asc desc");
    $(this).addClass(orden);

    var tbody = $("#expenseTable tbody");
    var filas = tbody.find("tr").get();

    filas.sort(function (a, b) {
      var valorA = $(a)
        .find('td[data-column="' + columna + '"]')
        .text()
        .toUpperCase();
      var valorB = $(b)
        .find('td[data-column="' + columna + '"]')
        .text()
        .toUpperCase();

      if (orden === "asc") {
        return valorA < valorB ? -1 : valorA > valorB ? 1 : 0;
      } else {
        return valorA > valorB ? -1 : valorA < valorB ? 1 : 0;
      }
    });

    $.each(filas, function (index, row) {
      tbody.append(row);
    });
  });

  $("#addNewExpense").click(function () {
    $(".btn-delete-event").hide();
    $(".btn-update-event").hide();
    $("#expenseModal").modal("show");
  });

  $("#addNewIncome").click(function () {
    $(".btn-delete-event").hide();
    $(".btn-update-event").hide();
    $("#dynamic-payment-methods").html("");
    paymentMethodNumber = 1;
    $("#incomeModal").modal("show");
  });

  formNewExpense.on("submit", function (e) {
    e.preventDefault();
    var formData = $(this).serialize();
    console.log(formData);
    $.ajax({
      method: "POST",
      url: "scripts/add_transaction.php?type=expense",
      data: formData,
      dataType: "json",
    })
      .done(function (response, textStatus, jqXHR) {
        $("#expenseModal").modal("hide");
        getTransactions();
        console.log(response);
      })
      .fail(function (response) {
        console.log(response.responseText);
      });
  });

  formNewIncome.on("submit", function (e) {
    e.preventDefault();
    var formData = $(this).serialize();

    console.log(formData);
    $.ajax({
      method: "POST",
      url: "scripts/add_transaction.php?type=income",
      data: formData,
      dataType: "json",
    })
      .done(function (response, textStatus, jqXHR) {
        console.log(response);
      })
      .fail(function (response) {
        console.log(response.responseText);
      });
  });

  btnAddPaymentMethod.on("click", function () {
    paymentMethodNumber++;

    let dynamicPaymentMethodDiv = `<div class="row">
                                        <div class="col-md-6 mt-4">
                                          <div class="">
                                            <label for="share-with">Método de Pago:</label>
                                            <select id="payment_method_id_${paymentMethodNumber}" name="payment_method_id" class="form-control">
                                              <option value=0 select readonly>Selecciona ...</option>
                                              <option value=1>Opción 1</option>
                                              <option value=2>Opción 2</option>
                                              <option value=3>Opción 3</option>
                                              <option value=4>Opción 4</option>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="col-md-6 mt-4">
                                          <div class="">
                                            <label for="share-with">Monto del Ingreso: </label>
                                            <input id="amount_${paymentMethodNumber}" name="amount" type="number" step="0.01" < class="form-control" placeholder="" />
                                          </div>
                                        </div>
                                      </div>`;
    $("#dynamic-payment-methods").append(dynamicPaymentMethodDiv);
  });

  $(".transactionsModal").on("hidden.bs.modal", function (event) {
    $(".formTransactions")[0].reset();
  });
});

$(document).on("swipeleft", "tbody tr", function (e) {
  $(this).off("click").blur();
  let a = $(this).nextAll("td").first().html();
  console.log(a);

  $(this).css({
    transform: "translateX(-210px)",
  });
});

$(document).on("swiperight", "tr", function () {
  $(this).prevAll("span").removeClass("show");
  $(this)
    .css({
      transform: "translateX(0)",
    })
    .blur();
});

function getTransactions() {
  $.ajax({
    method: "POST",
    url: "scripts/get_transactions.php",
    dataType: "json",
  })
    .done(function (response, textStatus, jqXHR) {
      let tBodyExpenseTable = $("#tBodyExpenseTable");

      tBodyExpenseTable.html("");

      let expensed_amount = formatearNumero(response.expensed_amount);
      $("#expensedAmountLabel").html(expensed_amount);

      let income_amount = formatearNumero(response.income_amount);
      $("#incomeAmountLabel").html(income_amount);

      console.log(response);

      let id = 0;
      $.each(response.transactions, function (index, transaction) {
        id++;
        let date = convertirFecha(transaction.date);
        let amount = formatearNumero(transaction.amount);
        let direction_arrow = transaction.amount < 0 ? "up" : "down";

        var trTransaction = `
                        <tr>
                            <td data-column="evento" scope="row">${transaction.name}<span class="fa fa-stethoscope mr-1"></span> </td>
                            <td data-column="pago"><span></span><span class="fa fa-cc-mastercard"></span></td>
                            <td data-column="fecha" class="text-muted">${date}</td>
                            <td data-column="monto" class="">${amount}
                                <span class="fa fa-long-arrow-${direction_arrow} mr-1"></span>
                            </td>
                        </tr>;
            `; // ${transaction.columna1}
        tBodyExpenseTable.append(trTransaction);
      });
    })
    .fail(function (response) {
      console.log(response.responseText);
    });
}

function formatearNumero(numero) {
  return numeral(numero).format("$0,0.00");
}

function convertirFecha(fechaString) {
  var fecha = new Date(fechaString);

  var dia = fecha.getDate().toString().padStart(2, "0");
  var mes = (fecha.getMonth() + 1).toString().padStart(2, "0");
  var anio = fecha.getFullYear().toString().slice(-2); // Obtiene los dos últimos dígitos del año

  var horas = fecha.getHours().toString().padStart(2, "0");
  var minutos = fecha.getMinutes().toString().padStart(2, "0");

  return `${dia}/${mes}/${anio} ${horas}:${minutos}`;
}
