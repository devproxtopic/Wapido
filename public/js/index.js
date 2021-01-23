function totalAmountOrder() {
    var subtotales = 0;
    var total = $('.total-price');

    $('.subtotal').each(function () {
        if (parseFloat($(this).val()) > 0) {
            subtotales += parseFloat($(this).val());
        }
    });

    console.log(subtotales);

    total.text(subtotales);
    $('#total_amount').val(subtotales);
}

function subtotalCalculation(category_id){
    var list = $('.list-' + category_id + ' div');
    var star = $('.star-' + category_id);
    var quantity = $('.quantity-' + category_id);
    var amount = $('.amount-' + category_id);
    var total_star = 0;
    var subtotal_amount = 0;
    var total_quantity = 0;

    var inputs = [];

    $(list).find('input, select, button').each(function() {
        if(parseFloat($(this).val()) > 0){

            var objectInput = new Object;
            objectInput.price = $(this).data('price');
            objectInput.quantity = $(this).val();
            objectInput.identity = $(this).attr('id');
            objectInput.quantity_db = $(this).data('quantity');

            inputs.push(objectInput);

        }
    });

    star.text(0);
    quantity.text(0);
    amount.text(0);
    $('#subtotal-' + category_id).val(0);

    if(inputs.length > 0){
        $(inputs).each(function(key, item){
            subtotal_amount += parseFloat(item.price * item.quantity);
            total_quantity += parseFloat(parseFloat(item.quantity_db) * item.quantity);
        });

        total_star = inputs.length;

        star.text(total_star);
        quantity.text(total_quantity);
        amount.text(subtotal_amount);

        $('#subtotal-' + category_id).val(subtotal_amount);

    }

    totalAmountOrder();
}

function orderExists(order, client) {
    $('#email').val(client.email);
    $('#email').attr('readonly', true);
    $('#fullname').val(client.fullname);
    $('#fullname').attr('readonly', true);
    $('#phone').val(client.phone);
    $('#phone').attr('readonly', true);
    $('#address').val(client.address);
    $('#address').attr('readonly', true);

    $(order).each(function (key, item) {
        $('#quantity-'+item.category_id+'-'+item.item_id+'-'+item.measure).val(item.quantity);
        subtotalCalculation(item.category_id);
    });

}

$(document).ready(function () {

    var baseUrl = $('#url_base').val();

    $('#slides').superslides({
        play: 2500,
        animation: 'fade'
    });

    $("#email").on("keyup", function() {
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url : baseUrl + '/ajax/emails/' + $(this).val(),
            type:'get',
            dataType: 'json',
            success: function(response) {
                $('#email').val(response.email);
                $('#fullname').val(response.fullname);
                $('#phone').val(response.phone);
                $('#address').val(response.address);
            }
        });
    });

    $("#zipcode").on("keyup", function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: baseUrl + '/' + $('#slug').val() + '/ajax/branches/' + $(this).val(),
            type: 'get',
            dataType: 'json',
            success: function (response) {
                $("#branch_id").html('');
                $("#branch_id").attr('disabled', false);
                $("#branch_id").append('<option value="">Seleccione una opción</option>');
                $.each(response, function (key, value) {
                    $("#branch_id").append('<option value="' + value.id + '">' + value.name + '</option>');
                });
            }
        });
    });

    $('input[name=apply_delivery]').on('change', function () {
        if ($('input[name=apply_delivery]:checked').val() == 1) {
            $('#zipcode').attr('readonly', false);
        }

        if ($('input[name=apply_delivery]:checked').val() == 0) {
            $('#zipcode').attr('readonly', true);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: baseUrl + '/' + $('#slug').val() + '/ajax/branches/todos',
                type: 'get',
                dataType: 'json',
                success: function (response) {
                    $("#branch_id").html('');
                    $("#branch_id").attr('disabled', false);
                    $("#branch_id").append('<option value="">Seleccione una opción</option>');
                    $.each(response, function (key, value) {
                        $("#branch_id").append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                }
            });
        }
    });

    showSlidesPromotions();

    totalAmountOrder();
});

var slideIndexPromotion = 0;

function showSlidesPromotions() {
    var i;
    var slidesPromotions = document.getElementsByClassName("mySlides-promotions");

    for (i = 0; i < slidesPromotions.length; i++) {
        slidesPromotions[i].style.display = "none";
    }

    slideIndexPromotion++;
    if (slideIndexPromotion > slidesPromotions.length) {
        slideIndexPromotion = 1;
    }

    var itemSlides = slidesPromotions.item([slideIndexPromotion - 1]);

    if(itemSlides) {
        itemSlides.style.display = "block";
        setTimeout(showSlidesPromotions, 2000); // Change image every 2 seconds
    }
}

// Next/previous controls
function plusSlidesPromotions(n) {
    showSlidesPromotionsChange(slideIndexPromotion += n);
}

// Thumbnail image controls
function currentSlidePromotions(n) {
    showSlidesPromotionsChange(slideIndexPromotion = n);
}

function showSlidesPromotionsChange(n) {
    var i;
    var slidesPromotions = document.getElementsByClassName("mySlides-promotions");
    var dots = document.getElementsByClassName("dot-promotions");
    if (n > slidesPromotions.length) {
        slideIndexPromotion = 1;
    }
    if (n < 1) {
        slideIndexPromotion = slidesPromotions.length;
    }
    for (i = 0; i < slidesPromotions.length; i++) {
        slidesPromotions[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slidesPromotions[slideIndexPromotion - 1].style.display = "block";
    dots[slideIndexPromotion - 1].className += " active";
}

function subtotalCalculationFood(category_id){
    var list = $('.list-food-' + category_id + ' div');
    var star = $('.star-food-' + category_id);
    var quantity = $('.quantity-food-' + category_id);
    var amount = $('.amount-food-' + category_id);
    var total = $('.total-price-food');
    var total_star = 0;
    var subtotal_amount = 0;
    var total_quantity = 0;

    var inputs = [];

    $(list).find('input, select, button').each(function () {
        if (parseFloat($(this).val()) > 0) {

            var objectInput = new Object;
            objectInput.price = $(this).data('price');
            objectInput.quantity = $(this).val();
            objectInput.identity = $(this).attr('id');
            objectInput.quantity_db = $(this).data('quantity');

            inputs.push(objectInput);

        }
    });

    star.text(0);
    quantity.text(0);
    amount.text(0);
    $('#subtotal-food-' + category_id).val(0);

    if (inputs.length > 0) {
        $(inputs).each(function (key, item) {
            subtotal_amount += parseFloat(item.price * item.quantity);
            total_quantity += parseFloat(parseFloat(item.quantity_db) * item.quantity);
        });

        total_star = inputs.length;

        star.text(total_star);
        quantity.text(total_quantity);
        amount.text(subtotal_amount);

        $('#subtotal-food-' + category_id).val(subtotal_amount);

    }

    totalAmountOrder();
}

function stepDownNumbers(id, category_id){
    var element = 'quantity-'+id;
    document.getElementById(element).stepDown();
    // console.log(element);
    subtotalCalculation(category_id);
}

function stepUpNumbers(id, category_id){
    var element = 'quantity-'+id;
    // console.log(element);
    document.getElementById(element).stepUp();
    subtotalCalculation(category_id);
}
