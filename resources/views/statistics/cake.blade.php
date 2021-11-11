

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
  maintainAspectRatio: false,
  scale: {
    reverse: false,
    ticks: {
      min: 0,
      max: 1000
    }
  }
}
};


window.myChartCake = new Chart(document.getElementById("myChartCake"), config);

</script>