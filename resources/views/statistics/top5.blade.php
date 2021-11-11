<style type="text/css">
.tftable {font-size:12px;color:#333333;width:100%;border-width: 1px;border-color: #729ea5;border-collapse: collapse;}
.tftable th {font-size:12px;background-color:#acc8cc;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;text-align:left;}
.tftable tr {background-color:#d4e3e5;}
.tftable td {font-size:12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;}
.tftable tr:hover {background-color:#ffffff;}
</style>
                
@if($totalCaloriesWeek!=0)
<table class="tftable" border="1">
<tr><th>Plato</th><th>Calorias acumuladas</th><th>Porcentaje</th></tr>
@foreach($foodRanking as $food)
<tr><td>{{$food->name}}</td><td>{{$food->amount}}</td><td>{{round($food->amount/$totalCaloriesWeek*100,2)}}%</td></tr>
@endforeach
</table>
@else
No hay suficientes datos para mostrar tus estadisticas de consumo.
@endif