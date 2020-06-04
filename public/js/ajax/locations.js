$(document).ready(function() {
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    var baseUrl = $('#url_base').val();

    $('#country_id').change(function(){
        $.ajax({
            url : baseUrl + '/ajax/states/' + $(this).val(),
            type:'get',
            dataType: 'json',
            success: function(response) {
               $("#state_id").attr('disabled', false);
               $("#state_id").append('<option value="">Seleccione una opción</option>');
               $.each(response, function (key, value) {
                   $("#state_id").append('<option value="' + value.id + '">' + value.name + '</option>');
               });
            }
        });
    });

    $('#state_id').change(function () {
        $.ajax({
            url: baseUrl + '/ajax/cities/' + $(this).val(),
            type: 'get',
            dataType: 'json',
            success: function (response) {
                $("#city_id").attr('disabled', false);
                $("#city_id").append('<option value="">Seleccione una opción</option>');
                $.each(response, function (key, value) {
                    $("#city_id").append('<option value="' + value.id + '">' + value.name + '</option>');
                });
            }
        });
    });

    $('#city_id').change(function () {
        $.ajax({
            url: baseUrl + '/ajax/locations/' + $(this).val(),
            type: 'get',
            dataType: 'json',
            success: function (response) {
                $("#location_id").attr('disabled', false);
                $("#location_id").append('<option value="">Seleccione una opción</option>');
                $.each(response, function (key, value) {
                    $("#location_id").append('<option value="' + value.id + '">' + value.name + '</option>');
                });
            }
        });
    });
});
