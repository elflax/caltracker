function add_meal(meal_type){
    $('#add-'+meal_type).attr('disabled', true);
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
            let html = "<tr>" +
                            "<td>" +
                                "<select class='form-control' name='food_id' onchange='calculateCalories(\""+meal_type+"\")' id='select-"+meal_type+"'>"+select+"</select>" +
                            "</td>" +
                            "<td>" +
                                "<input class='form-control'  onkeyup='calculateCalories(\""+meal_type+"\")' type='number' name='how_much_ate' id='input-"+meal_type+"' min='0'>" +
                            "</td>" +
                            "<td id='cal-"+meal_type+"'></td>" +
                            "<td>" +
                                "<div class='btn-group' role='group' aria-label='Basic example'>" +
                                    "<button type='button' onclick=\"submitMeal(this, '" + meal_type + "')\" class='btn btn-success'>Agregar</button>" +
                                    "<button type='button' class='btn btn-danger'>Cancelar</button>" +
                                "</div>" +
                            "</td>" +
                        "</tr>";
            $('#table-' + meal_type + ' tbody').append(html);
            $('#add-'+meal_type).attr('disabled', true);
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

function submitMeal(elem, meal_type){
    $.ajax({
        url: "http://127.0.0.1:8000/meal/",
        type: "POST",
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
                                "<button type='button' class='btn btn-secondary'>Editar</button>" +
                            "</td>";
            $(elem).parent().parent().parent().html(html);
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

function deleteMeal(user_id, food_id, meal_type_id, date){
    $.ajax({
        url: "http://127.0.0.1:8000/meal/"+user_id+"_"+food_id+"_"+meal_type_id+"_"+date,
        type: "DELETE",
        dataType: "json",
        data: {
          '_token': $('[name="_token"]:first').val()
        },
        async: false,
        success: function(result){
            alert('Comida eliminada');
            console.log(user_id+"_"+food_id+"_"+meal_type_id+"_"+date);
            $('#meal_'+user_id+"_"+food_id+"_"+meal_type_id+"_"+date).remove();
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
