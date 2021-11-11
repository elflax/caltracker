@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Necesitamos saber m&aacute;s de ti</div>

                    <div class="card_body">
                        <div class="row justify-content-center">
                            <h6 class="mt-2 mb-1">Algunos c&aacute;lculos necesitan m&aacute;s informaci&oacute;n &iexcl;Hoy empiezas a perder peso!</h6>
                        </div>
                        <div class="row justify-content-center">
                            @include('weight.form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            var height = $("#height").val();
            var weight = $("#weight").val();
            if (weight > 0 && height > 0) {
                $("#imc").text((weight / Math.pow(height/100, 2)).toFixed(2));
            }
            var imc = 0;
            $("#height").blur(function(event) {
                var height = $("#height").val();
                var weight = $("#weight").val();
                if (weight > 0 && height > 0) {
                    $("#imc").text((weight / Math.pow(height/100, 2)).toFixed(2));
                }
            });

            $("#weight").blur(function(event) {
                var height = $("#height").val();
                var weight = $("#weight").val();
                if (weight > 0 && height > 0) {
                    $("#imc").text((weight / Math.pow(height/100, 2)).toFixed(2));
                }
            });

        });
    </script>
@endsection
