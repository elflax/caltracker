@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="alert alert-warning alert-dismissible fade {{ session('result')? "show":"" }}" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    {{ session('result') }}
                    <button type="button" class="btn btn-close" data-bs-dismiss="alert" onclick="$(this).parent().removeClass('show');">X</button>
                </div>
                <div class="card">
                    <div class="card-header d-flex">
                        <span class="flex-child exercise-title">{{ __('Ejercicios registrados') }}</span>
                        <div class="flex-child text-right">
                            <a href="{{ route('exercise.create') }}" class="btn btn-success margin-top-5">Crear Ejercicios</a>
                        </div>
                    </div>

                    <div class="card-body text-center">
                        <table class="table" id="table-exercise">
                            <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Calorías</th>
                                <th scope="col">Valor mínimo</th>
                                <th scope="col">Unidad de medida</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($exercises as $exercise)
                            <tr>
                                <th scope="row">{{ $exercise->name }}</th>
                                <td>{{ $exercise->calories_waste }}</td>
                                <td>{{ $exercise->minimun_value }}</td>
                                <td>{{ $exercise->unit_of_measure }}</td>
                                <td>
                                    <form action="{{ route('exercise.destroy', ['exercise' => $exercise->id ]) }}" method="POST" class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('exercise.edit', ['exercise' => $exercise->id ]) }}" class="btn btn-secondary d-inline">Editar</a>
                                            <button type="button" onclick="if(confirm('Desea eliminar este ejercicio?')) { $(this).parent().parent().submit(); }" class="btn btn-danger">Eliminar</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="application/javascript" src="{{asset('js/meal.js')}}"></script>
    <script>
        $(document).ready(function() {
            $.noConflict();
            $('#table-exercise').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json"
                }
            });
        } );
    </script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/exercise.css') }}">
@endsection