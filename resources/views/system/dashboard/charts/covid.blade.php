<div class="w-full h-full">
    <canvas id="chart_covid"></canvas>
</div>

<script>
    new Chart("chart_covid", {
        type: "pie",
        data: {
        labels: ['Infected', 'Vaccinated', 'Fully Vaccinated'],
        datasets: [{
            backgroundColor: ['#227c9d', '#ffcb77', '#74a57f'],
            data: <?php echo json_encode($covid) ?>
        }]
        },
        options: {
            title: {
                display: true,
                text: "Covid Cases"
            }
        }
    });
</script>
