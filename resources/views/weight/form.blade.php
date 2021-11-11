<form method="POST" action="{{ route('weights.store') }}">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="form-group row">
      <div class="col-12">
        <label for="weight" class="col-form-label">Peso actual</label>
        <input type="number" class="form-control" name='weight' id="weight" value="{{ $weight ?? '' }}"
            placeholder="Peso actual">

        @error('weight')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
  </div>

  <div class="form-group row">
      <div class="col-12">
        <label for="height" class="col-form-label">Altura (cm)</label>
        <input type="number" class="form-control" name='height' id="height" value="{{ $height ?? '' }}"
            placeholder="Altura">

        @error('height')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
  </div>

  <div class="form-group row">
      <div class="col-12">
        <label for="ideal_weight" class=" col-form-label">Peso ideal</label>
        <input type="number" class="form-control" name='ideal_weight' id="ideal_weight" value="{{ $ideal_weight ?? '' }}"
            placeholder="Peso ideal">

        @error('ideal_weight')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
  </div>
  <div>
      <label> Tu indice actual de masa corporal es: </label>

      <label name="imc" id="imc" for="imc" >-</label>
  </div>
  <button type="submit" class="btn btn-success mb-2">Guardar</button>
</form>
