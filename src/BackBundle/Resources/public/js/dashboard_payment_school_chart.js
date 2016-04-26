$(document).ready(function() {

    function retrieve() {
        var school_id = $('#chart').data('id');

        var data = {};

        var dateMin = $('#dateMin').val();
        var dateMax = $('#dateMax').val();

        if (dateMin != "" && dateMax != "")
            data = { dateMin: dateMin, dateMax: dateMax };

           $.ajax({url: school_id+"/update_chart", data: data, success: function(result){
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
        $('#chart').empty();

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

    $('#updateChart').on('click', function() { retrieve() });
});
