$(document).ready(function() {
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    var baseUrl = $('#url_base').val();

    $('#country_id').change(function(){
        $("#city_id").html('');
        $("#state_id").html('');
        $("#location_id").html('');

        $("#city_id").attr('disabled', true);
        $("#state_id").attr('disabled', true);
        $("#location_id").attr('disabled', true);

        $.ajax({
            url : baseUrl + '/ajax/states/' + $(this).val(),
            type:'get',
            dataType: 'json',
            success: function(response) {
               $("#state_id").html('');
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
                $("#city_id").html('');
                $("#city_id").attr('disabled', false);
                $("#city_id").append('<option value="">Seleccione una opción</option>');
                $.each(response, function (key, value) {
                    var selected = ($("#reqCity").val() == value.id) ? 'selected' : '';
                    $("#city_id").append('<option ' + selected + 'value="' + value.id + '">' + value.name + '</option>');
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
                $("#location_id").html('');
                $("#location_id").attr('disabled', false);
                $("#location_id").append('<option value="">Seleccione una opción</option>');
                $.each(response, function (key, value) {
                    var selected = ($("#reqLocation").val() == value.id) ? 'selected' : '';
                    $("#location_id").append('<option '+ selected +'value="' + value.id + '">' + value.name + '</option>');
                });
            }
        });
    });

    if ($("#country_id").find('option:selected').val() != 0) {
        ($('#reqCity').val() != 0) ? $("#city_id").attr('disabled', false) : $("#city_id").attr('disabled', true);
        ($('#reqState').val() != 0) ? $("#state_id").attr('disabled', false): $("#state_id").attr('disabled', true);
        ($('#reqLocation').val() != 0) ? $("#location_id").attr('disabled', false): $("#location_id").attr('disabled', true);
        $.ajax({
            url: baseUrl + '/ajax/states/' + $(this).val(),
            type: 'get',
            dataType: 'json',
            success: function (response) {
                $("#state_id").html('');
                $("#state_id").attr('disabled', false);
                $("#state_id").append('<option value="">Seleccione una opción</option>');
                $.each(response, function (key, value) {
                    var selected = ($("#reqState").val() == value.id) ? 'selected' : '';
                    $("#state_id").append('<option ' + selected + 'value="' + value.id + '">' + value.name + '</option>');
                });
            }
        });
    }

    if ($("#reqCity").val() != "") {
        $.ajax({
            url: baseUrl + '/ajax/cities/' + $(this).val(),
            type: 'get',
            dataType: 'json',
            success: function (response) {
                $("#city_id").html('');
                $("#city_id").attr('disabled', false);
                $("#city_id").append('<option value="">Seleccione una opción</option>');
                $.each(response, function (key, value) {
                    var selected = ($("#reqCity").val() == value.id) ? 'selected' : '';
                    $("#city_id").append('<option ' + selected + 'value="' + value.id + '">' + value.name + '</option>');
                });
            }
        });
    }

    if ($("#reqLocation").val() != "") {
        $.ajax({
            url: baseUrl + '/ajax/locations/' + $(this).val(),
            type: 'get',
            dataType: 'json',
            success: function (response) {
                $("#location_id").html('');
                $("#location_id").attr('disabled', false);
                $("#location_id").append('<option value="">Seleccione una opción</option>');
                $.each(response, function (key, value) {
                    var selected = ($("#reqLocation").val() == value.id) ? 'selected' : '';
                    $("#location_id").append('<option ' + selected + 'value="' + value.id + '">' + value.name + '</option>');
                });
            }
        });
    }
});
