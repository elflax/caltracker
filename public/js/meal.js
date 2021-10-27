function add_meal(meal_type, meal_id = 0 ){
    $('#add-'+meal_type).attr('disabled', true);
    $('.edit-' + meal_type).each(function (index, elem){
        $(elem).attr('disabled', true);
    });
    $.ajax({
        url: "http://127.0.0.1:8000/food/0",
        type: "GET",
        dataType: "json",
        async: false,
        success: function(result){
            let select = "";
            for(var i=0; i<result.length; i++){
                select += "<option value='"+result[i].id+"' " +
                    "data-calories='"+result[i].calories+"' " +
                    "data-unit_of_measure='"+result[i].unit_of_measure+"' " +
                    "data-minimun_value='"+result[i].minimun_value+"'>"+result[i].name+"</option>";
            }
            var food, how_much_ate, calories;
            if(meal_id){
                food = parseInt($('#food_' + meal_id).attr('data-food_id'));
                how_much_ate = parseInt($('#how_much_ate_' + meal_id).text());
                calories = parseInt($('#calories_' + meal_id).text());
            }
            let html = ((meal_id)? "":"<tr>") +
                            "<td>" +
                                "<select class='form-control' name='food_id' onchange='calculateCalories(\""+meal_type+"\")' id='select-"+meal_type+"'>"+select+"</select>" +
                            "</td>" +
                            "<td>" +
                                "<input class='form-control'  onkeyup='calculateCalories(\""+meal_type+"\")' type='number' name='how_much_ate' id='input-"+meal_type+"' min='0'>" +
                            "</td>" +
                            "<td id='cal-"+meal_type+"'></td>" +
                            "<td>" +
                                "<div class='btn-group' role='group' aria-label='Basic example'>" +
                                    "<button type='button' onclick=\"submitMeal(this, '" + meal_type + "', "+meal_id+")\" class='btn btn-success'>Agregar</button>" +
                                    "<button type='button' class='btn btn-danger' onclick='cancelMeal(this, \""+meal_type+"\", "+meal_id+")'>Cancelar</button>" +
                                "</div>" +
                            "</td>" +
                        ((meal_id)? "":"</tr>");
            if(meal_id){
                $('#meal_'+meal_id).html(html);
            }else{
                $('#table-' + meal_type + ' tbody').append(html);
            }
            $('#add-'+meal_type).attr('disabled', true);
            $('.edit-' + meal_type).each(function (index, elem){
                $(elem).attr('disabled', true);
            });
            console.log(food);
            if(meal_id){
                $('#select-' + meal_type).val(food);
                $('#input-' + meal_type).val(how_much_ate);
                $('#cal-' + meal_type).text(calories);
            }
        },
    });
}

function calculateCalories(meal_type){
    var calories = parseInt($('#select-'+meal_type+' option:selected').attr('data-calories'));
    var unit_of_measure = $('#select-'+meal_type+' option:selected').attr('data-unit_of_measure');
    var minimun_value = parseInt($('#select-'+meal_type+' option:selected').attr('data-minimun_value'));
    var rations = parseInt($('#input-'+meal_type).val());
    var total_cals = (calories * (isNaN(rations)? 0:rations) ) / minimun_value;

    $('#input-'+meal_type).attr('placeholder', 'Numero de raciones (' + unit_of_measure + ')');
    $('#cal-'+meal_type).text(total_cals);



}

function cancelMeal(elem, meal_type, meal_id = 0){
    if(meal_id){
        let food = $('#select-' + meal_type+" option:selected").text();
        let food_id = $('#select-' + meal_type).val();
        let how_much_ate = parseInt($('#input-' + meal_type).val());
        let calories = parseInt($('#cal-' + meal_type).text());
        let html =
            "<td id='food_"+meal_id+"' data-food_id='"+food_id+"'>" +
                food +
            "</td>" +
            "<td id='how_much_ate_"+meal_id+"'>" +
                how_much_ate +
            "</td>" +
            "<td id='calories_"+meal_id+"'>" +
                calories +
            "</td>" +
            "<td>" +
                "<div class='btn-group' role='group' aria-label='Basic example'>" +
                    "<button type='button' class='btn btn-secondary edit-"+meal_type+"' onclick=\"add_meal('"+meal_type+"', "+meal_id+")\">Editar</button>" +
                    "<button type='button' class='btn btn-secondary' onclick='if(confirm(\"Desea eliminar esta comida?\")){ deleteMeal("+meal_id+"); }'>Eliminar</button>" +
                "</div>" +
            "</td>";
        $('#meal_'+meal_id).html(html);
    }else{
        $(elem).parent().parent().parent().remove();
    }
    $('#add-'+meal_type).attr('disabled', false);
    $('.edit-' + meal_type).each(function (index, elem){
        $(elem).attr('disabled', false);
    });
}

function submitMeal(elem, meal_type, meal_id = 0){
    if(meal_id){
        var url = "http://127.0.0.1:8000/meal/" + meal_id;
        var method = "PUT";
    }else{
        var url = "http://127.0.0.1:8000/meal/";
        var method = "POST";
    }
    $.ajax({
        url: url,
        type: method,
        dataType: "json",
        data: $('#form-'+meal_type).serialize(),
        async: false,
        success: function(result){
            let html =
                            "<td>" +
                                result.food +
                            "</td>" +
                            "<td>" +
                                result.how_much_ate +
                            "</td>" +
                            "<td>" +
                                result.calories +
                            "</td>" +
                            "<td>" +
                                "<div class='btn-group' role='group' aria-label='Basic example'>" +
                                    "<button type='button' class='btn btn-secondary edit-"+meal_type+"' onclick=\"add_meal('"+meal_type+"', "+((meal_id)? meal_id:result.id)+")\">Editar</button>" +
                                    "<button type='button' class='btn btn-secondary' onclick='if(confirm(\"Desea eliminar esta comida?\")){ deleteMeal("+result.id+"); }'>Eliminar</button>" +
                                "</div>" +
                            "</td>";
            if(meal_id){
                $('#meal_' + meal_id).html(html);
            }else{
                $(elem).parent().parent().parent().html(html);
            }
            $('#add-' + meal_type).attr('disabled', false);
            $('.edit-' + meal_type).each(function (index, elem){
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
                msg = 'Uncaught Error.\n' + jqXHR.responseText;
            }
            alert(msg);
            $('#add-' + meal_type).attr('disabled', false);
            $('.edit-' + meal_type).each(function (index, elem){
                $(elem).attr('disabled', false);
            });
        },
    });
}

function deleteMeal(meal_id){
    $.ajax({
        url: "http://127.0.0.1:8000/meal/"+meal_id,
        type: "DELETE",
        dataType: "json",
        data: {
          '_token': $('[name="_token"]:first').val()
        },
        async: false,
        success: function(result){
            alert('Comida eliminada');

            $('#meal_'+meal_id).remove();
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
