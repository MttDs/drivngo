$(document).ready(function() {

  function retrieve() {

    var data = {};

    var dateMin = $('#dateMin').val();
    var dateMax = $('#dateMax').val();

    if (dateMin != "" && dateMax != "")
            data = { dateMin: dateMin, dateMax: dateMax };

     $.ajax({url: "update_charts", data: data, success: function(result){

        $.each(result, function(i, row) {
          value = [];

          $.each(row, function(v, col) {
            value.push({
              day: col.date,
              turnover: col.turnover,
              transaction: col.nbTransaction
            });
          });

          generateChart(i, value);
        });
      }});
  }

  function generateChart(school_id, data) {
    $('#chart_'+school_id).empty();

    Morris.Area({
          element: 'chart_'+school_id,
          data: data,
          xkey: 'day',
          xLabels: 'day',
          xLabelFormat: function(d) {
              return ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov', 'Dec'][d.getMonth()] + ' ' + d.getDate();
          },
          ykeys: ['turnover', 'transaction'],
          labels: ["Chiffre d'affaire", 'Transactions'],
          pointSize: 2,
          hideHover: 'auto',
          resize: true
      });
  }

  retrieve();

  $('#updateChart').on('click', function() { retrieve() });
});
