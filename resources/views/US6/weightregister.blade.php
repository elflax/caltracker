@extends('layouts.app')

@section('content')
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>

<h1>Necesitamos saber m&aacute;s de ti</h1>
<h3>Algunos c&aacute;lculos necesitan m&aacute;s informaci&oacute;n &iexcl;Hoy empiezas a perder peso!</h3>

<div class="justify-content-center">
    <form method="POST" action="{{ route('weightsave') }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group row ">      
    <div class="col-md-1">
        <label for="inputweight" class="col-form-label">Peso actual</label>
    </div>
        <div class="col-xs-6">
        <input type="number" class="form-control" name='inputweight' id="inputweight" placeholder="Peso actual">
        </div>
    </div>
    
    <div class="form-group row">
        <div class="col-md-1">
        <label for="inputheight" class="col-form-label">Altura</label>
    </div>
        <div class="col-xs-6">
        <input type="number" class="form-control" name='inputheight' id="inputheight" placeholder="Altura">
        </div>
    </div>

    <div class="form-group row">
    <div class="col-md-1">
        <label for="inputDreamWeight" class=" col-form-label">Peso ideal</label>
    </div>
        <div class="col-xs-3">
        <input type="number" class="form-control" name ='inputDreamWeight' id="inputDreamWeight" placeholder="Peso ideal">
        </div>
    </div>
    <div>
    <label> Tu indice actual de masa corporal es: </label>

    <label name="imc" id="imc" for="imc">-</label>
</div>
    <button type="submit" class="btn btn-success">Guardar</button>
</div>

<script>
$(document).ready(function() {
      var imc = 0;
      var alt= 
      $("#inputheight").blur(function(event) {
          var height = $("#inputheight").val();
          var weight = $("#inputweight").val();
          if(weight>0 && height>0)
          {
          $("#imc").text((weight/Math.pow(height,2)).toFixed(2));
          }else
          {
          $("#imc").text('No se puede calcular');
          }

      });});

 </script>
</form>

@endsection

