@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Crear nueva comida') }}</div>

                    <div class="card-body text-center">
                        <form method="POST" action="@if(\Illuminate\Support\Facades\Route::currentRouteName() == "food.create"){{ route('food.store') }}@else{{ route('food.update', ['food' => $food->id]) }}@endif">
                            @csrf
                            @if(\Illuminate\Support\Facades\Route::currentRouteName() == "food.edit")
                                @method('PUT')
                            @endif
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ (isset($food))? $food->name:old('name')  }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="calories" class="col-md-4 col-form-label text-md-right">{{ __('Calorías') }}</label>

                                <div class="col-md-6">
                                    <input id="calories" type="number" min="1" class="form-control @error('calories') is-invalid @enderror" name="calories" value="{{ (isset($food))? $food->calories:old('calories') }}" placeholder="Solo se permiten numeros enteros" required autocomplete="calories" autofocus>

                                    @error('calories')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="unit_of_measure" class="col-md-4 col-form-label text-md-right">{{ __('Unidad de medida') }}</label>

                                <div class="col-md-6">
                                    <input id="unit_of_measure" type="text" class="form-control @error('unit_of_measure') is-invalid @enderror" name="unit_of_measure" value="{{ (isset($food))? $food->unit_of_measure:old('unit_of_measure') }}" maxlength="2" placeholder="Debe consistir en solo dos letras (ej: kg)" required autocomplete="unit_of_measure" autofocus>

                                    @error('unit_of_measure')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="minimun_value" class="col-md-4 col-form-label text-md-right">{{ __('Valor Mínimo') }}</label>

                                <div class="col-md-6">
                                    <input id="minimun_value" type="number" min="1" class="form-control @error('minimun_value') is-invalid @enderror" name="minimun_value" value="{{ (isset($food))? $food->minimun_value:old('minimun_value') }}" placeholder="Solo se permiten numeros enteros" required autocomplete="minimun_value" autofocus>

                                    @error('minimun_value')
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
                                        <a href="{{ route('food.index') }}" class="btn btn-secondary">Regresar</a>
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
    <script type="application/javascript" src="{{asset('js/meal.js')}}"></script>
@endsection
