<div>
    <canvas id="chart_revenue"></canvas>
</div>

<script>
    new Chart("chart_revenue", {
      type: "bar",
      data: {
        labels: <?php echo json_encode($ravenue['years']) ?>,
        datasets: [{
            label: 'Income',
            barThickness: 30,
            backgroundColor: '#a4bfeb',
            data: <?php echo json_encode($ravenue['ravenue_income']) ?>
        }, {
            label: 'Expenses',
            barThickness: 30,
            backgroundColor: '#ff6392',
            data: <?php echo json_encode($ravenue['ravenue_expenses']) ?>
        }]
      },
      options: {
        title: {
          display: true,
          text: "Yearly Revenue for the past 5 years"
        },
        scales: {
            xAxes: [{
                gridLines: {
                    color: "#F2F2F3",
                }
            }],
            yAxes: [{
                gridLines: {
                    color: "#F2F2F3",
                }
            }]
        }
      }
    });
</script>
