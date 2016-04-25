$(document).ready(function() {

  function retrieve() {
    var school_id = $('#chart').data('id');

     $.ajax({url: school_id+"/update_chart", success: function(result){
        data = [];

        $.each(result, function(i, row) {
            data.push({
              day: row.date,
              turnover: row.turnover,
              transaction: row.nbTransaction
            });
        });

        generateChart(data);
      }});
  }

  function generateChart(data) {
    Morris.Area({
          element: 'chart',
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
});
