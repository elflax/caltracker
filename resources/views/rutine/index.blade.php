@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Registro de Rutina') . " "}}
                        <a href="{{ route('rutine.index') . '?date=' . \Carbon\Carbon::createFromFormat('m-d-Y', $date)->addDay(-1)->format('m-d-Y') }}"><b><</b></a>
                        {{ \Carbon\Carbon::createFromFormat('m-d-Y', $date)->format('d/m/Y') }}
                        @if( \Carbon\Carbon::createFromFormat('m-d-Y', $date)->lt(\Carbon\Carbon::now()->addDay(-1)) )
                        <a href="{{ route('rutine.index') . '?date=' . \Carbon\Carbon::createFromFormat('m-d-Y', $date)->addDay(1)->format('m-d-Y') }}"><b>></b></a>
                        @endif
                    </div>

                    <div class="card-body text-center">
                        <h3>Bienvenido {{ Auth::user()? Auth::user()->name:"" }}</h3>
                        <h5>Le damos la bienvenida a CalTracker, la aplicación que le ayudara a mantener su peso bajo control</h5>
                        <p>En esta seccion puedes tu rutina de ejercicios que has realizado durante el día.</p>
                        <ul>
                            <li>Puede ingresar un ejercicio de nuestra lista con ejercicios precargados</li>
                            <li>En caso que no encuentre una opcion adecuada puedes crear un ejercicio nuevo dando <a href="{{ route('exercise.create') }}">click aquí</a></li>
                        </ul>

                        <div class="card">
                            <form id="form-rutine">
                                @csrf
                                <table class="table" id="table-rutine">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Ejercicio</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Unidades</th>
                                        <th scope="col">Calorias</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($rutines as $rutine)
                                        <tr id="rutine_{{ $rutine->id }}">
                                            <td id="exercise_{{ $rutine->id }}" data-exercise_id="{{ $rutine->exercise->id }}">{{ $rutine->exercise->name }}</td>
                                            <td id="how_much_play_{{ $rutine->id }}">{{ $rutine->how_much_play }}</td>
                                            <td id="unit_of_measure_{{ $rutine->id }}" data-unit_of_measure="{{ $rutine->exercise->unit_of_measure }}">{{ $rutine->exercise->unit_of_measure }}</td>
                                            <td id="calories_{{ $rutine->id }}">{{ ($rutine->how_much_play * $rutine->exercise->calories_waste ) / $rutine->exercise->minimun_value }}</td>
                                            <td>
                                                <div class='btn-group' role='group' aria-label='Basic example'>
                                                    <button type='button' class='btn btn-secondary' onclick="add_rutine({{ $rutine->id }})">Editar</button>
                                                    <button type='button' class='btn btn-secondary' onclick="if(confirm('Desea eliminar este ejercicio?')){ deleteRutine({{ $rutine->id }}); }">Eliminar</button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                <input type="hidden" name="date" value="{{ date('Y-m-d') }}">
                            </form>
                            <div class='btn-group' role='group' aria-label='Basic example'>
                                <button class="btn btn-success" id="add-rutine" onclick="add_rutine()">Agregar ejercicio</button>
                                <a class="btn btn-secondary" href="{{ route('exercise.create') }}">Crear ejercicio</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="application/javascript" src="{{asset('js/rutine.js')}}"></script>
@endsection
