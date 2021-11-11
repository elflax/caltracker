@extends('layouts.app')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.bundle.min.js"></script>
<script>

window.onload = function() {


};
    </script>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Calorias consumidas hoy por comida') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if($datacakeexists==0)
                    Aun no hay datos para mostrar
                    <p></p>
                    @else
                    @include('statistics.cake')
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Calorias consumidas día a día esta semana') }}</div>
                <div class="card-body">
                @if($databarexists==0)
                    Aun no hay datos para mostrar
                    <p></p>
                    @else
                    @include('statistics.weekBar')
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Estos son los 5 platos que mas consumiste esta semana') }}</div>
                <div class="card-body">
                @if($totalCaloriesWeek!=0)   
                @include('statistics.top5')
                @else
                No hay suficientes datos para mostrar tus estadisticas de consumo.
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection