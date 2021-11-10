@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Crear nuevo ejercicio') }}</div>

                    <div class="card-body text-center">
                        <form method="POST" action="@if(\Illuminate\Support\Facades\Route::currentRouteName() == "exercise.create"){{ route('exercise.store') }}@else{{ route('exercise.update', ['exercise' => $exercise]) }}@endif">
                            @csrf
                            @if(\Illuminate\Support\Facades\Route::currentRouteName() == "exercise.edit")
                                @method('PUT')
                            @endif
                            <div class="form-group required row">
                                <label for="name" class="col-md-4 col-form-label text-md-right control-label">{{ __('Nombre') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ (!old('name') && isset($exercise))? $exercise->name:old('name')  }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group required row">
                                <label for="calories_waste" class="col-md-4 col-form-label text-md-right control-label">{{ __('Calorías') }}</label>

                                <div class="col-md-6">
                                    <input id="calories_waste" type="number" min="1" class="form-control @error('calories_waste') is-invalid @enderror" name="calories_waste" value="{{ (!old('calories_waste') && isset($exercise))? $exercise->calories_waste:old('calories_waste') }}" placeholder="Solo se permiten numeros enteros" required autocomplete="calories_waste" autofocus>

                                    @error('calories_waste')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group required row">
                                <label for="minimun_value" class="col-md-4 col-form-label text-md-right control-label">{{ __('Valor Mínimo') }}</label>

                                <div class="col-md-6">
                                    <input id="minimun_value" type="number" min="1" class="form-control @error('minimun_value') is-invalid @enderror" name="minimun_value" value="{{ (!old('minimun_value') && isset($exercise))? $exercise->minimun_value:old('minimun_value') }}" placeholder="Solo se permiten numeros enteros" required autocomplete="minimun_value" autofocus>

                                    @error('minimun_value')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group required row">
                                <label for="unit_of_measure" class="col-md-4 col-form-label text-md-right control-label">{{ __('Unidad de medida') }}</label>

                                <div class="col-md-6">
                                    <input id="unit_of_measure" type="text" class="form-control @error('unit_of_measure') is-invalid @enderror" name="unit_of_measure" value="{{ (!old('unit_of_measure') && isset($exercise))? $exercise->unit_of_measure:old('unit_of_measure') }}" maxlength="3" placeholder="Debe consistir en máximo 3 letras (ej: kg, min)" required autocomplete="unit_of_measure" autofocus>

                                    @error('unit_of_measure')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Guardar') }}
                                        </button>
                                        <a href="{{ route('exercise.index') }}" class="btn btn-secondary">Regresar</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="application/javascript" src="{{asset('js/rutine.js')}}"></script>
@endsection