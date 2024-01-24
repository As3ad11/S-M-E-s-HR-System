<div>
    <canvas id="chart_salary"></canvas>
</div>

<script>
    new Chart("chart_salary", {
        type: "line",
        data: {
            labels: <?php echo json_encode($salary['months']) ?>,
            datasets: [{
                data: <?php echo json_encode($salary['current_year_salary']) ?>,
                borderColor: "rgb(93, 163, 153)",
                fill: false,
                label: 'Current Year'
            }, {
                data: <?php echo json_encode($salary['last_year_salary']) ?>,
                borderColor: "rgb(241, 156, 121)",
                fill: false,
                label: 'Previous Year'
            }]
        },
        options: {
            title: {
                display: true,
                text: "Employee Salary"
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
