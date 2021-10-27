<form method="POST" action="{{ route('weights.store') }}">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="form-group row">
      <div class="col-12">
        <label for="weight" class="col-form-label">Peso actual</label>
        <input type="number" class="form-control" name='weight' id="weight" value="{{ $weight ?? '' }}"
            placeholder="Peso actual">

        @error('weight')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
  </div>

  <div class="form-group row">
      <div class="col-12">
        <label for="height" class="col-form-label">Altura (cm)</label>
        <input type="number" class="form-control" name='height' id="height" value="{{ $height ?? '' }}"
            placeholder="Altura">

        @error('height')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
  </div>

  <div class="form-group row">
      <div class="col-12">
        <label for="ideal_weight" class=" col-form-label">Peso ideal</label>
        <input type="number" class="form-control" name='ideal_weight' id="ideal_weight" value="{{ $ideal_weight ?? '' }}"
            placeholder="Peso ideal">

        @error('ideal_weight')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
        @enderror
      </div>
  </div>
  <div>
      <label> Tu indice actual de masa corporal es: </label>

      <label name="imc" id="imc" for="imc">-</label>
  </div>
  <button type="submit" class="btn btn-success mb-2">Guardar</button>
</form>

<script>
  $(document).ready(function() {
      var imc = 0;
      var alt =
          $("#height").blur(function(event) {
              var height = $("#height").val();
              var weight = $("#weight").val();
              if (weight > 0 && height > 0) {
                  $("#imc").text((weight / Math.pow(height/100, 2)).toFixed(2));
              } else {
                  $("#imc").text('No se puede calcular');
              }

          });
  });
</script>