<canvas id="myChartBar" width="300" height="300"></canvas>

<script>


    var config2 =
    {
        type: 'bar',
        data: {
            labels: ['Día 1', 'Día 2', 'Día 3', 'Día 4', 'Día 5', 'Día 6', 'HOY'],
            datasets: [{
                label: '',
                data: [ {{ $caloriesxday[0] }} , {{ $caloriesxday[1] }}, {{$caloriesxday[2]}}, {{$caloriesxday[3]}}, {{$caloriesxday[4]}}, {{$caloriesxday[5]}}, {{$caloriesxday[6]}}],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    "rgba(255, 87, 34, 0.2)"
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    "rgba(255, 87, 34, 1)"
                ],
                borderWidth: 1
            }]
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };

    window.myChartBar = new Chart(document.getElementById("myChartBar"), config2);
</script>