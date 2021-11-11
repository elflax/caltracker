

<canvas id="myChartCake" width="300" height="300"></canvas>


<script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js"></script>


<script>

  
var config = {
type: 'polarArea',
data: {
  labels: [
    "Desayuno",
    "Almuerzo",
    "Cena",
    "Snacks"
  ],
  datasets: [{
    data: [{{ $desayunos }}, {{ $almuerzos }}, {{ $cenas }}, {{ $snacks }}],
    backgroundColor: [
      "rgba(255, 87, 34, 0.7)",
      "rgba(3, 169, 244, 0.5)",
      "rgba(233, 30, 99, 0.5)",
      "rgba(255, 193, 7, 0.5)",
    ],
  }],
},
options: {
  scale: {
    reverse: false,
    ticks: {
      min: 0,
      max: 1000
    }
  }
}
};


var config2={
              type: 'bar',
              data: {
                  labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                  datasets: [{
                      label: '# of Votes',
                      data: [12, 19, 3, 5, 2, 3],
                      backgroundColor: [
                          'rgba(255, 99, 132, 0.2)',
                          'rgba(54, 162, 235, 0.2)',
                          'rgba(255, 206, 86, 0.2)',
                          'rgba(75, 192, 192, 0.2)',
                          'rgba(153, 102, 255, 0.2)',
                          'rgba(255, 159, 64, 0.2)'
                      ],
                      borderColor: [
                          'rgba(255, 99, 132, 1)',
                          'rgba(54, 162, 235, 1)',
                          'rgba(255, 206, 86, 1)',
                          'rgba(75, 192, 192, 1)',
                          'rgba(153, 102, 255, 1)',
                          'rgba(255, 159, 64, 1)'
                      ],
                      borderWidth: 1
                  }]
              },
              options: {
                  scales: {
                      y: {
                          beginAtZero: true
                      }
                  }
              }
          };


window.onload = function() {
window.myChartCake = new Chart(document.getElementById("myChartCake"), config);
window.myChartBar = new Chart(document.getElementById("myChartBar"), config2);
};


</script>