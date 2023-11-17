$(function () {
  // =====================================
  // Revenue Updates
  // =====================================
  var options = {
    series: [
      {
        name: "Footware",
        data: [1.5, 2.7, 2.2, 3.6, 1.5],
      },
      {
        name: "Fashionware",
        data: [-2.8, -1.1, -2.5, -1.5, -1.2],
      },
    ],
    chart: {
      toolbar: {
        show: false,
      },
      type: "bar",
      fontFamily: "Plus Jakarta Sans,sans-serif",
      foreColor: "#adb0bb",
      height: 270,
      stacked: true,
      offsetX: -20,
    },
    colors: ["var(--bs-primary)", "var(--bs-secondary)"],
    plotOptions: {
      bar: {
        horizontal: false,
        barHeight: "70%",
        columnWidth: "20%",
        borderRadius: [5],
        borderRadiusApplication: "end",
        borderRadiusWhenStacked: "all",
      },
    },
    dataLabels: {
      enabled: false,
    },
    legend: {
      show: false,
    },
    grid: {
      show: false,
    },
    yaxis: {
      min: -4,
      max: 4,
      tickAmount: 4,
    },
    xaxis: {
      categories: ["Jan", "Fab", "Mar", "Apr", "May"],
      show: false,
      axisTicks: {
        show: false,
      },
      axisBorder: {
        show: false,
      },
    },
    tooltip: {
      theme: "dark",
    },
  };

  var chart = new ApexCharts(document.querySelector("#revenue-chart"), options);
  chart.render();

  // =====================================
  // Revenue Updates
  // =====================================
  var options = {
    color: "#ffcb92",
    series: [23450, 73450],
    labels: ["Gastos", "Ingresos"],
    chart: {
      type: "donut",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#ffcb92",
    },
    plotOptions: {
      pie: {
        donut: {
          size: "80%",
          background: "transparent",
          labels: {
            show: true,
            name: {
              show: true,
              offsetY: 7,
            },
            value: {
              show: false,
            },
            total: {
              show: true,
              color: "#7C8FAC",
              fontSize: "20px",
              fontWeight: "600",
              label: "+ $50,020",
            },
          },
        },
      },
    },
    stroke: {
      show: false,
    },
    dataLabels: {
      enabled: false,
    },

    legend: {
      show: false,
    },
    colors: ["var(--bs-danger)", "var(--bs-success)", ""],

    tooltip: {
      theme: "dark",
      fillSeriesColor: false,
    },
  };

  var chart = new ApexCharts(
    document.querySelector("#sales-overview"),
    options
  );
  chart.render();

  // =====================================
  // monthly-earning
  // =====================================
  var options = {
    chart: {
      id: "monthly-earning",
      type: "area",
      height: 56,
      sparkline: {
        enabled: true,
      },
      group: "sparklines",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
    },
    series: [
      {
        name: "monthly earnings",
        color: "var(--bs-primary)",
        data: [25, 66, 20, 40, 12, 58, 20],
      },
    ],
    stroke: {
      curve: "smooth",
      width: 2,
    },
    fill: {
      type: "gradient",
      gradient: {
        shadeIntensity: 0,
        inverseColors: false,
        opacityFrom: 0.1,
        opacityTo: 0,
        stops: [20, 180],
      },
    },

    markers: {
      size: 0,
    },
    tooltip: {
      theme: "dark",
      fixed: {
        enabled: true,
        position: "right",
      },
      x: {
        show: false,
      },
    },
  };
  new ApexCharts(document.querySelector("#monthly-earning"), options).render();

  // =====================================
  // weekly-stats
  // =====================================
  var options = {
    chart: {
      id: "weekly-stats",
      type: "area",
      height: 120,
      sparkline: {
        enabled: true,
      },
      group: "sparklines",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
    },
    series: [
      {
        name: "Weekly Stats",
        color: "var(--bs-primary)",
        data: [5, 15, 5, 10, 5],
      },
    ],
    stroke: {
      curve: "smooth",
      width: 2,
    },
    fill: {
      type: "gradient",
      gradient: {
        shadeIntensity: 0,
        inverseColors: false,
        opacityFrom: 0.18,
        opacityTo: 0,
        stops: [20, 180],
      },
    },

    markers: {
      size: 0,
    },
    tooltip: {
      theme: "dark",
      fixed: {
        enabled: true,
        position: "right",
      },
      x: {
        show: false,
      },
    },
  };
  new ApexCharts(document.querySelector("#weekly-stats"), options).render();

  var daysOfWeek = [
    "Dom",
    "Lun",
    "Mar",
    "Mie",
    "Jue",
    "Vie",
    "Sáb",
    "Dom",
    "Lun",
    "Mar",
    "Mie",
    "Jue",
    "Vie",
    "Sáb",
  ];
  var date = new Date();
  var thisDay = date.getDay();
  var nombreDia = daysOfWeek[thisDay];

  /* $.ajax({
    url: "./scripts/load/index_data.php", // URL de ejemplo
    method: "POST",
    dataType: "json",
  })
    .done(function (response) {
      let expenses_per_day = response.expenses_per_day;
      expenses_per_day = Object.entries(expenses_per_day);

      let daysOfChart = {
        day1: 0,
        day2: 0,
        day3: 0,
        day4: 0,
        day5: 0,
        day6: 0,
        day7: 0,
      };
      console.log(expenses_per_day);

      for (let i = 0; i < expenses_per_day.length; i++) {
        let index = i + 1;
        let dayName = "day" + index;
        if (expenses_per_day[i] !== undefined) {
          daysOfChart[dayName] = expenses_per_day[i];
        }
      }
      console.log(daysOfChart);
      // Ahora, variables.variable1 contendrá el valor de expenses_per_day[0] o 0 si no existe.
      // variables.variable2 contendrá el valor de expenses_per_day[1] o 0 si no existe.
      // Y así sucesivamente hasta variables.variable7.

      // =====================================
      // Salary
      // =====================================
      var options = {
        series: [
          {
            name: "Últimos Gastos",
            data: [10, 3000, 500, 3400, 4200, 1900, 3910],
          },
        ],

        chart: {
          toolbar: {
            show: false,
          },
          offsetX: -20,
          height: 250,
          type: "bar",
          fontFamily: "Plus Jakarta Sans', sans-serif",
          foreColor: "#adb0bb",
        },
        colors: [
          "var(--bs-primary)",
          "var(--bs-primary)",
          "var(--bs-primary)",
          "var(--bs-primary)",
          "var(--bs-primary)",
          "var(--bs-primary)",
          "var(--bs-primary)",
        ],
        plotOptions: {
          bar: {
            borderRadius: 5,
            columnWidth: "45%",
            distributed: true,
            endingShape: "rounded",
          },
        },

        dataLabels: {
          enabled: false,
        },
        legend: {
          show: false,
        },
        grid: {
          yaxis: {
            lines: {
              show: false,
            },
          },
          xaxis: {
            lines: {
              show: false,
            },
          },
        },
        xaxis: {
          categories: [
            [daysOfWeek[thisDay + 1]],
            [daysOfWeek[thisDay + 2]],
            [daysOfWeek[thisDay + 3]],
            [daysOfWeek[thisDay + 4]],
            [daysOfWeek[thisDay + 5]],
            [daysOfWeek[thisDay + 6]],
            [daysOfWeek[thisDay + 7]],
          ],
          axisBorder: {
            show: true,
          },
          axisTicks: {
            show: false,
          },
        },
        yaxis: {
          labels: {
            show: false,
          },
        },
        tooltip: {
          theme: "dark",
        },
      };

      var chart = new ApexCharts(document.querySelector("#salary"), options);
      chart.render();
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
      alert(1);
    }); */

  // =====================================
  // table-chart
  // =====================================
  var options = {
    chart: {
      id: "table-chart",
      type: "area",
      width: 76,
      height: 18,
      sparkline: {
        enabled: true,
      },
      group: "table-chart",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
    },
    series: [
      {
        color: "#DFE5EF",
        data: [25, 66, 20, 40, 12, 58, 20],
      },
    ],
    stroke: {
      curve: "smooth",
      width: 2,
    },
    fill: {
      colors: ["#f3feff"],
      type: "solid",
      opacity: 0.05,
    },

    markers: {
      size: 0,
    },
    tooltip: {
      enabled: false,
    },
  };
  new ApexCharts(document.querySelector("#table-chart"), options).render();

  // =====================================
  // table-chart
  // =====================================
  var options = {
    chart: {
      id: "table-chart-1",
      type: "area",
      width: 76,
      height: 18,
      sparkline: {
        enabled: true,
      },
      group: "table-chart-1",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
    },
    series: [
      {
        color: "var(--bs-primary)",
        data: [25, 66, 20, 40, 12, 58, 20],
      },
    ],
    stroke: {
      curve: "smooth",
      width: 2,
    },
    fill: {
      type: "gradient",
      gradient: {
        shadeIntensity: 0,
        inverseColors: false,
        opacityFrom: 0.12,
        opacityTo: 0,
        stops: [20, 180],
      },
    },

    markers: {
      size: 0,
    },
    tooltip: {
      enabled: false,
    },
  };
  new ApexCharts(document.querySelector("#table-chart-1"), options).render();

  // =====================================
  // table-chart
  // =====================================
  var options = {
    chart: {
      id: "#table-chart-2",
      type: "area",
      width: 76,
      height: 18,
      sparkline: {
        enabled: true,
      },
      group: "#table-chart-2",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
    },
    series: [
      {
        color: "#DFE5EF",
        data: [25, 66, 20, 40, 12, 58, 20],
      },
    ],
    stroke: {
      curve: "smooth",
      width: 2,
    },
    fill: {
      colors: ["#f3feff"],
      type: "solid",
      opacity: 0.05,
    },

    markers: {
      size: 0,
    },
    tooltip: {
      enabled: false,
    },
  };
  new ApexCharts(document.querySelector("#table-chart-2"), options).render();

  // =====================================
  // table-chart
  // =====================================
  var options = {
    chart: {
      id: "table-chart-3",
      type: "area",
      width: 76,
      height: 18,
      sparkline: {
        enabled: true,
      },
      group: "table-chart-3",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
    },
    series: [
      {
        color: "var(--bs-primary)",
        data: [25, 66, 20, 40, 12, 58, 20],
      },
    ],
    stroke: {
      curve: "smooth",
      width: 2,
    },
    fill: {
      type: "gradient",
      gradient: {
        shadeIntensity: 0,
        inverseColors: false,
        opacityFrom: 0.12,
        opacityTo: 0,
        stops: [20, 180],
      },
    },

    markers: {
      size: 0,
    },
    tooltip: {
      enabled: false,
    },
  };
  new ApexCharts(document.querySelector("#table-chart-3"), options).render();

  // =====================================
  // expense
  // =====================================
  var expense = {
    series: [60, 25, 15],
    labels: ["", "", ""],
    chart: {
      height: 110,
      type: "donut",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#c6d1e9",
    },

    tooltip: {
      theme: "dark",
      fillSeriesColor: false,
    },

    colors: ["var(--bs-primary)", "var(--bs-secondary)", "var(--bs-yellow)"],
    dataLabels: {
      enabled: false,
    },

    legend: {
      show: false,
    },

    stroke: {
      show: false,
    },

    plotOptions: {
      pie: {
        donut: {
          size: "70%",
          background: "none",
          labels: {
            show: true,
            name: {
              show: true,
              fontSize: "18px",
              color: undefined,
              offsetY: -10,
            },
            value: {
              show: false,
              color: "#98aab4",
            },
          },
        },
      },
    },
  };

  var chart = new ApexCharts(document.querySelector("#expense"), expense);
  chart.render();

  // =====================================
  // Sales
  // =====================================
  var options = {
    series: [
      {
        name: "a",
        data: [25, 35, 20, 25, 40, 25],
      },
    ],
    chart: {
      type: "bar",
      height: 200,
      width: "80%",
      stacked: true,
      stackType: "100%",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      toolbar: {
        show: false,
      },
      sparkline: {
        enabled: true,
      },
    },
    colors: ["var(--bs-primary)", "var(--bs-secondary)", "var(--bs-gray-200)"],
    grid: {
      show: false,
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: "50%",
        borderRadius: [3],
        borderRadiusApplication: "around",
        borderRadiusWhenStacked: "around",
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: false,
      width: 1,
      colors: ["rgba(0,0,0,0.01)"],
    },
    xaxis: {
      axisBorder: {
        show: false,
      },
      axisTicks: {
        show: false,
      },
      labels: {
        show: false,
      },
    },
    yaxis: {
      labels: {
        show: false,
      },
    },
    axisBorder: {
      show: false,
    },
    fill: {
      opacity: 1,
    },
    tooltip: {
      theme: "dark",
      x: {
        show: false,
      },
    },
  };

  var chart = new ApexCharts(document.querySelector("#sales"), options);
  chart.render();

  // =====================================
  // Sales two
  // =====================================
  var options = {
    series: [
      {
        name: "",
        data: [3200, 4490, 7400, 3100, 4901, 2200, 1290],
      },
    ],
    chart: {
      type: "bar",
      height: 150,
      fontFamily: "Plus Jakarta Sans', sans-serif",
      toolbar: {
        show: false,
      },
      sparkline: {
        enabled: true,
      },
    },
    colors: ["var(--bs-primary)"],
    grid: {
      show: false,
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: "100%",
        borderRadius: 4,
        distributed: true,
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 5,
      colors: ["rgba(0,0,0,0.01)"],
    },
    xaxis: {
      axisBorder: {
        show: false,
      },
      axisTicks: {
        show: false,
      },
      labels: {
        show: false,
      },
    },
    yaxis: {
      labels: {
        show: false,
      },
    },
    axisBorder: {
      show: false,
    },
    fill: {
      opacity: 1,
    },
    tooltip: {
      theme: "dark",
      x: {
        show: false,
      },
    },
  };

  var chart = new ApexCharts(document.querySelector("#sales-two"), options);
  chart.render();

  // =====================================
  // growth
  // =====================================
  var options = {
    chart: {
      id: "growth",
      type: "area",
      height: 25,
      sparkline: {
        enabled: true,
      },
      group: "growth",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
    },
    series: [
      {
        colors: ["var(--bs-primary)"],
        data: [
          0, 10, 10, 10, 35, 45, 30, 30, 30, 50, 52, 30, 25, 45, 50, 80, 60, 65,
        ],
      },
    ],
    stroke: {
      curve: "smooth",
      width: 2,
    },
    fill: {
      colors: ["#f3feff"],
      type: "solid",
      opacity: 0,
    },

    markers: {
      size: 0,
    },
    tooltip: {
      enabled: false,
    },
  };
  new ApexCharts(document.querySelector("#growth"), options).render();
});
