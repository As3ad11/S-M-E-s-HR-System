<div class="w-full h-full">
    <canvas id="chart_task"></canvas>
</div>

<script>
    new Chart("chart_task", {
      type: "doughnut",
      data: {
        labels: ['New', 'In Progress', 'Completed'],
        datasets: [{
            backgroundColor: ['#0081a7', '#e1dd8f', '#ee6c4d'],
            data: <?php echo json_encode($task) ?>
        }]
      },
      options: {
        title: {
          display: true,
          text: "Employee Performance"
        },
        cutoutPercentage: 80
      }
    });
</script>
