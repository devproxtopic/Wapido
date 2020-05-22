$(document).ready(function() {
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    var baseUrl = $('#url_base').val();

    $('#category_id').change(function(){
        $.ajax({
            url : baseUrl + '/ajax/measures-categories/' + $(this).val(),
            type:'get',
            dataType: 'json',
            success: function(response) {
                $(".field_wrapper").html('<div></div>');

                for (let index = 0; index < response.length; index++) {
                    $(".field_wrapper").append('<div class="form-group row">'+
                        '<div class="col-md-6 offset-md-4">'+
                        '<div class="row">'+
                            '<label for="quantity" class="col-form-label text-md-right">Cantidad</label>'+
                            '<div class="col-md-4">'+
                                '<input readonly type="text" class="form-control" name="quantity[]" required value="'+response[index]+'">'+
                            '</div>'+
                            '<label for="price" class="col-form-label text-md-right">Precio</label>'+
                            '<div class="col-md-4">'+
                                '<input type="number" class="form-control @error("price") is-invalid @enderror" name="price[]" required>'+
                            '</div>'+
                        '</div>'+
                        '</div>'+
                    '</div>');
                }
            }
        });
    });


});
