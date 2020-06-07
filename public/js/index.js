function subtotalCalculation(category_id){
    var list = $('.list-' + category_id + ' div');
    var star = $('.star-' + category_id);
    var quantity = $('.quantity-' + category_id);
    var amount = $('.amount-' + category_id);
    var total = $('.total-price');
    let total_star = 0;
    let subtotal_amount = 0;
    let total_quantity = 0;
    var subtotales = 0;

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

    $('.subtotal').each(function() {
        if(parseFloat($(this).val()) > 0){
            subtotales += parseFloat($(this).val());
        }
    });

    total.text(subtotales);
    $('#total_amount').val(subtotales);

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

    showSlidesPromotions();
});

let slideIndexPromotion = 0;

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
