$(document).ready(function() {

  function retrieve(dateMin, dateMax) {
     $.ajax({url: "update_charts", success: function(result){
        $.each(result, function(i, row) {
          data = [];
          tmp = [];
          $.each(row, function(v, col) {
            data.push({
              day: col.date,
              turnover: col.turnover,
              transaction: col.nbTransaction
            });
            //console.log(col.date);
            //console.log(col.nbTransaction);
            //onsole.log(col.turnover);
          });

          generateChart(i, data);
        });
      }});
  }


  retrieve("", "");

  function generateChart(school_id, data) {
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

});
