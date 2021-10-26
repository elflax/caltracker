@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Registro de calorias') . " "}}
                        <a href="{{ route('meal.index') . '?date=' . \Carbon\Carbon::createFromFormat('m-d-Y', $date)->addDay(-1)->format('m-d-Y') }}"><b><</b></a>
                        {{ \Carbon\Carbon::createFromFormat('m-d-Y', $date)->format('d/m/Y') }}
                        @if( \Carbon\Carbon::createFromFormat('m-d-Y', $date)->lt(\Carbon\Carbon::now()->addDay(-1)) )
                        <a href="{{ route('meal.index') . '?date=' . \Carbon\Carbon::createFromFormat('m-d-Y', $date)->addDay(1)->format('m-d-Y') }}"><b>></b></a>
                        @endif
                    </div>

                    <div class="card-body text-center">
                        <h3>Bienvenido {{ Auth::user()? Auth::user()->name:"" }}</h3>
                        <h5>Le damos la bienvenida a CalTracker, la aplicación que le ayudara a mantener su peso bajo control</h5>
                        <p>En esta seccion puedes ingresar los platos que has consumido durante las comidas</p>
                        <ul>
                            <li>Puede ingresar un plato de nuestra lista con platos precargados</li>
                            <li>En caso que encuentre una opcion adecuada puedes crear un plato nuevo dando <a href="#">click aquí</a></li>
                        </ul>
                        <div id="accordion">
                            @foreach($meal_types as $meal_type)
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{ $meal_type->description }}" aria-expanded="true" aria-controls="collapse{{ $meal_type->description }}">
                                            {{ $meal_type->description }}
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapse{{ $meal_type->description }}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        <form id="form-{{ $meal_type->description }}">
                                            @csrf
                                            <table class="table" id="table-{{ $meal_type->description }}">
                                                <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">Plato</th>
                                                    <th scope="col">Raciones</th>
                                                    <th scope="col">Calorias</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($meals as $meal)
                                                    @if($meal_type->id == $meal->meal_type_id)
                                                    <tr id="meal_{{ $meal->id }}">
                                                        <td id="food_{{ $meal->id }}" data-food_id="{{ $meal->food->id }}">{{ $meal->food->name }}</td>
                                                        <td id="how_much_ate_{{ $meal->id }}">{{ $meal->how_much_ate }}</td>
                                                        <td id="calories_{{ $meal->id }}">{{ ($meal->how_much_ate * $meal->food->calories ) / $meal->food->minimun_value }}</td>
                                                        <td>
                                                            <div class='btn-group' role='group' aria-label='Basic example'>
                                                                <button type='button' class='btn btn-secondary' onclick="add_meal('{{ $meal_type->description }}', {{ $meal->id }})">Editar</button>
                                                                <button type='button' class='btn btn-secondary' onclick="if(confirm('Desea eliminar esta comida?')){ deleteMeal({{ $meal->id }}); }">Eliminar</button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                            <input type="hidden" name="meal_type_id" value="{{ $meal_type->id }}">
                                            <input type="hidden" name="date" value="{{ date('Y-m-d') }}">
                                        </form>
                                        <div class='btn-group' role='group' aria-label='Basic example'>
                                            <button class="btn btn-success" id="add-{{ $meal_type->description }}" onclick="add_meal('{{ $meal_type->description }}')">Agrega plato</button>
                                            <button class="btn btn-secondary">Crear plato</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="application/javascript" src="{{asset('js/meal.js')}}"></script>
@endsection
