function validate_message(responseText){
    let response = JSON.parse(responseText);
    let objs = [];

    for (let prop in  response.errors) {
        objs.push(`${response.errors[prop]}`);
    }

    return objs.join(', ');
}

function add_rutine(rutine_id = 0){

    $.ajax({
        url: document.location.origin + "/exercise/0",
        type: "GET",
        dataType: "json",
        async: false,
        success: function(result){
            let select = "";
            for(var i=0; i<result.length; i++){
                select += "<option value='"+result[i].id+"' " +
                    "data-calories_waste='"+result[i].calories_waste+"' " +
                    "data-unit_of_measure='"+result[i].unit_of_measure+"' " +
                    "data-minimun_value='"+result[i].minimun_value+"'>"+result[i].name+"</option>";
            }
            var exercise, how_much_play, unit_of_measure, calories;
            if(rutine_id){
                exercise = parseInt($('#exercise_' + rutine_id).attr('data-exercise_id'));
                how_much_play = parseInt($('#how_much_play_' + rutine_id).text());
                unit_of_measure = $('#unit_of_measure_' + rutine_id).text();
                calories = parseInt($('#calories_' + rutine_id).text());
            }

            console.log(unit_of_measure);
            let html = ((rutine_id)? "":"<tr>") +
                            "<td>" +
                                "<select class='form-control' name='exercise_id' onchange='calculateCalories()' id='select-rutine'>"+select+"</select>" +
                            "</td>" +
                            "<td>" +
                                "<input class='form-control'  onkeyup='calculateCalories()' type='number' name='how_much_play' id='input-rutine' min='1'>" +
                            "</td>" +
                            "<td id='unit-rutine'></td>"+
                            "<td id='cal-rutine'></td>" +
                            "<td>" +
                                "<div class='btn-group' role='group' aria-label='Basic example'>" +
                                    "<button type='button' onclick=\"submitRutine(this, "+rutine_id+")\" class='btn btn-success'>Agregar</button>" +
                                    "<button type='button' class='btn btn-danger' onclick='cancelRutine(this,"+rutine_id+")'>Cancelar</button>" +
                                "</div>" +
                            "</td>" +
                        ((rutine_id)? "":"</tr>");
            if(rutine_id){
                $('#rutine_'+rutine_id).html(html);
            }else{
                $('#table-rutine tbody').append(html);
            }
            $('#add-rutine').attr('disabled', true);
            $('.edit-rutine').each(function (index, elem){
                $(elem).attr('disabled', true);
            });

            if(rutine_id){
                $('#select-rutine').val(exercise);
                $('#input-rutine').val(how_much_play);
                $('#unit-rutine').text(unit_of_measure);
                $('#cal-rutine').text(calories);
            }
        },
    });
}

function calculateCalories(){
    var calories = parseInt($('#select-rutine option:selected').attr('data-calories_waste'));
    var unit_of_measure = $('#select-rutine option:selected').attr('data-unit_of_measure');
    var minimun_value = parseInt($('#select-rutine option:selected').attr('data-minimun_value'));
    var number_of_units = parseInt($('#input-rutine').val());
    if( !isNaN(number_of_units) && number_of_units <= 0){
        alert('El numero de unidades debe ser mayor a 0');
        return;
    }
    if (isNaN(number_of_units)){
        return;
    }
    var total_cals = (calories * (isNaN(number_of_units)? 0:number_of_units) ) / minimun_value;

    $('#input-rutine').attr('placeholder', 'Numero de unidades (' + unit_of_measure + ')');
    $('#cal-rutine').text(total_cals);
}

function cancelRutine(elem, rutine_id = 0){
    if(rutine_id){
        let exercise = $('#select-rutine'+" option:selected").text();
        let exercise_id = $('#select-rutine').val();
        let how_much_play = parseInt($('#input-rutine').val());
        let calories = parseInt($('#cal-rutine').text());
        let html =
            "<td id='exercise_"+rutine_id+"' data-exercise_id='"+exercise_id+"'>" +
                exercise +
            "</td>" +
            "<td id='how_much_play_"+rutine_id+"'>" +
                how_much_play +
            "</td>" +
            "<td id='calories_"+rutine_id+"'>" +
                calories +
            "</td>" +
            "<td>" +
                "<div class='btn-group' role='group' aria-label='Basic example'>" +
                    "<button type='button' class='btn btn-secondary edit-rutine' onclick=\"add_rutine("+rutine_id+")\">Editar</button>" +
                    "<button type='button' class='btn btn-secondary' onclick='if(confirm(\"Desea eliminar esta rutina?\")){ deleteRutine("+rutine_id+"); }'>Eliminar</button>" +
                "</div>" +
            "</td>";
        $('#rutine_'+rutine_id).html(html);
    }else{
        $(elem).parent().parent().parent().remove();
    }
    $('#add-rutine').attr('disabled', false);
    $('.edit-rutine').each(function (index, elem){
        $(elem).attr('disabled', false);
    });
}

function submitRutine(elem, rutine_id = 0){
    if(rutine_id){
        var url = document.location.origin + "/rutine/" + rutine_id;
        var method = "PUT";
    }else{
        var url = document.location.origin + "/rutine";
        var method = "POST";
    }
    $.ajax({
        url: url,
        type: method,
        dataType: "json",
        data: $('#form-rutine').serialize(),
        async: false,
        success: function(result){
          console.log(result);
            let html =
                            "<td id='exercise_"+result.id+"' data-exercise_id='" + result.exercise_id + "'>" +
                                result.exercise +
                            "</td>" +
                            "<td id='how_much_play_"+result.id+"'>" +
                                result.how_much_play +
                            "</td>" +
                            "<td id='unit_of_measure_"+result.id+"'>" +
                                result.unit_of_measure +
                            "</td>" +
                            "<td id='calories_"+result.id+"'>" +
                                result.calories +
                            "</td>" +
                            "<td>" +
                                "<div class='btn-group' role='group' aria-label='Basic example'>" +
                                    "<button type='button' class='btn btn-secondary edit-rutine' onclick=\"add_rutine("+((rutine_id)? rutine_id:result.id)+")\">Editar</button>" +
                                    "<button type='button' class='btn btn-secondary' onclick='if(confirm(\"Desea eliminar esta rutina?\")){ deleteRutine("+result.id+"); }'>Eliminar</button>" +
                                "</div>" +
                            "</td>";

            if(!rutine_id){
                $(elem).parent().parent().parent().attr('id', 'rutine_' + result.id);
                rutine_id = result.id;
            }
            $('#rutine_' + rutine_id).html(html);
            $('#add-rutine').attr('disabled', false);
            $('.edit-rutine').each(function (index, elem){
                $(elem).attr('disabled', false);
            });
        },
        error: function (jqXHR, exception) {
            var msg = '';
            if (jqXHR.status === 0) {
                msg = 'Not connect.\n Verify Network.';
            } else if (jqXHR.status == 404) {
                msg = 'Requested page not found. [404]';
            } else if (jqXHR.status == 500) {
                msg = 'Internal Server Error [500].';
            } else if (exception === 'parsererror') {
                msg = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
                msg = 'Time out error.';
            } else if (exception === 'abort') {
                msg = 'Ajax request aborted.';
            } else {

                msg = validate_message(jqXHR.responseText);
            }
            alert(msg);
            $('#add-rutine').attr('disabled', false);
            $('.edit-rutine').each(function (index, elem){
                $(elem).attr('disabled', false);
            });
        },
    });
}

function deleteRutine(rutine_id){
  console.log(rutine_id);
    $.ajax({
        url: document.location.origin + "/rutine/"+rutine_id,
        type: "DELETE",
        dataType: "json",
        data: {
          '_token': $('[name="_token"]:first').val()
        },
        async: false,
        success: function(result){
            alert('Rutina eliminada');

            $('#rutine_'+rutine_id).remove();
        },
        error: function (jqXHR, exception) {
            var msg = '';
            if (jqXHR.status === 0) {
                msg = 'Not connect.\n Verify Network.';
            } else if (jqXHR.status == 404) {
                msg = 'Requested page not found. [404]';
            } else if (jqXHR.status == 500) {
                msg = 'Internal Server Error [500].';
            } else if (exception === 'parsererror') {
                msg = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
                msg = 'Time out error.';
            } else if (exception === 'abort') {
                msg = 'Ajax request aborted.';
            } else {
                msg = 'Uncaught Error.\n' + jqXHR.responseText;
            }
            alert(msg);
        },
    });
}