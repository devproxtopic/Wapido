
var beerCalc = 0.65;
var sodaCalc = 0.65;
var pizzaCalc = 0;
var icecreamCalc = 0.2;
var frutas = 0;

var beerCalcPrice = 95;
var sodaCalcPrice = 95;
var sodaCalcPriceDiet = 107;
var pizzaCalcPrice = 140;
var jitomateCalcPrice = 100;
var icecreamCalcPrice = 280;
var cucuruchPrice = 18;

var peopleQty = 0;
var totalPrice = 0;
var peopleTotalPrice = 0;

var totalBeer;
var priceBeer = 0;

var totalSoda;
var priceSoda = 0;

var totalPizza;
var pricePizza = 0;

var totalFrutas
var priceFrutas = 0;

var totalIcecream;
var priceIcecream = 0;

var cucuPriceTotal = 0;


// generic functions
function parseIntValue(value, defaultValue) {
	if(!value || value == "") {
		return defaultValue;
	} else {
		return parseInt(value, 10);
	}
}

function quantityValidation(qtyValue){
	if(qtyValue < 0) {
		alert("msje");
		return false;
	} else {
		return true;
	}
}

// PEOPLE
function peopleQtyCalc() {
	var peopleQty = parseInt($("#people-number").val());
    var beerQty = peopleQty * beerCalc;
    var sodaQty = peopleQty * sodaCalc;
    var pizzaQty = peopleQty * pizzaCalc;
    var icecreamQty = peopleQty * icecreamCalc;

    $('.beer').html((Math.round(beerQty * 100) / 100).toFixed(1));
    $('.soda').html((Math.round(sodaQty * 100) / 100).toFixed(1));
    $('.pizza').html((Math.round(pizzaQty * 100) / 100).toFixed(1));
    $('.icecream').html((Math.round(icecreamQty * 100) / 100).toFixed(1)); 
    $('.pepole-event').html((Math.round(peopleQty * 100) / 100).toFixed(0));
}

// BEER
function beerQtyValidation(epaValue, ipaValue) {
	if (quantityValidation(epaValue)){
		if(quantityValidation(ipaValue)){
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}

function beerQtyCalc() {	
	var epaQty = parseIntValue($("#beer-epa").val(), 0);
	var ipaQty = parseIntValue($("#beer-ipa").val(), 0);
	if(beerQtyValidation(epaQty, ipaQty)) {
		if(((epaQty % 9) == 0) && ((ipaQty % 9) == 0)){
			window.totalBeer = epaQty + ipaQty;
			window.priceBeer = totalBeer * beerCalcPrice;
			$('.total-ltr').html((Math.round(totalBeer * 100) / 100).toFixed(0));
			$('.total-price-beer').html((Math.round(priceBeer * 100) / 100).toFixed(0));

			totalPriceCalc();

			if (peopleQty > 0) {
				var peopleLtr = totalBeer / peopleQty;
				$('.people-ltr').html((Math.round(peopleLtr * 100) / 100).toFixed(1));
			}
		}
		else {
			$(".overlay").css("display", "block");
		}
	}
}

// SODA
function sodaQtyValidation() {
	var isValid =  true;
	$(".soda-flavors").each(function() {
		isValid = isValid && quantityValidation(Number($(this).val()));		
	});
	if (isValid){
		return true;
	} else {
		return false;
	}
}

function sodaQtyCalc() {
	var sizeTres = 0;
	var totLtrSizeTres = 0;
	var sizeTresDiet = 0;
	var totLtrSizeTresDiet = 0;

	if(sodaQtyValidation()){
		$(".size-tres").each(function() {
			sizeTres += Number($(this).val());
			totLtrSizeTres = sizeTres * 3;
			totalSodaNormal = sizeTres * sodaCalcPrice;
		});

		$(".size-tres-diet").each(function() {
			sizeTresDiet += Number($(this).val());
			totLtrSizeTresDiet = sizeTresDiet * 3;
			totalSodaDiet = sizeTresDiet * sodaCalcPriceDiet;
		});

		window.totalSoda = totLtrSizeTres + totLtrSizeTresDiet;
		window.priceSoda = totalSodaDiet + totalSodaNormal;

		$('.total-ltr-soda').html((Math.round(totalSoda * 100) / 100).toFixed(1));
		$('.total-price-soda').html((Math.round(priceSoda * 100) / 100).toFixed(0));

		totalPriceCalc();

		if (peopleQty > 0) {
			var peopleLtrSoda = totalSoda / peopleQty;
			$('.people-ltr-soda').html((Math.round(peopleLtrSoda * 100) / 100).toFixed(1));
		}
	}
}

// PIZZA
function pizzaQtyValidation() {
	var isValid =  true;
	$(".pizza-model").each(function() {
		isValid = isValid && quantityValidation(Number($(this).val()));		
	});
	if (isValid){
		return true;
	} else {
		return false;
	}
}

function pizzaQtyCalc() {
	var totPizza = 0;
	var totPizzaMedio = 0;
	if(pizzaQtyValidation()){
		$(".pizza-model").each(function() {
			totPizza += Number($(this).val());
		});

		$(".pizza-model-medio").each(function() {
			totPizzaMedio += Number($(this).val());
		});

		window.totalPizzaMedio = totPizzaMedio * 0.25;
		window.totalPizza = totPizza * 1;
		window.totalPizzaGral = totalPizza + totalPizzaMedio;
		window.pricePizza = totalPizzaGral * pizzaCalcPrice;

		$('.total-meters').html((Math.round(totalPizzaGral * 100) / 100).toFixed(2));
		$('.total-price-pizza').html((Math.round(pricePizza * 100) / 100).toFixed(0));

		totalPriceCalc();
	}
}


// ICE CREAM
function icecreamQtyValidation() {
	var isValid =  true;
	$(".icecream-flav").each(function() {
		isValid = isValid && quantityValidation(Number($(this).val()));		
	});
	if (isValid){
		return true;
	} else {
		return false;
	}
}

function icecreamQtyCalc() {
	var totI = 0;

	var totMed = 0;
	var totMedFlav = 0;

	var totTerc = 0;
	var totTercFlav = 0;

	var totCheck = 0;

	if(icecreamQtyValidation()){
		$(".icecream-flav").each(function() {
			totI += Number($(this).val());
		});

		$(".icecream-flav-medio").each(function() {
			totMed += Number($(this).val());
			totMedFlav = totMed * 0.5;
		});

		$(".icecream-flav-tercio").each(function() {
			totTerc += Number($(this).val());
			totTercFlav = totTerc * 0.3;
		});

		$.each($("input.check-flavor:checked"), function(){
			totCheck += Number($(this).val());
		});

		var cucuruchoQty = parseIntValue($("#cucurucho").val(), 0);
		
		window.cucuPriceTotal = cucuruchPrice * cucuruchoQty
		window.totalIcecream = totI + totMedFlav + totTercFlav;
		window.priceIcecream = (totalIcecream * icecreamCalcPrice) + cucuPriceTotal;

		$('.total-ltr-ice').html((Math.round(totalIcecream * 100) / 100).toFixed(1));
		$('.total-price-icecream').html((Math.round(priceIcecream * 100) / 100).toFixed(0));

		totalPriceCalc();
	}
}

$(document).ready(function() {
    $('.extras').click(function() {
        if ($(this).is(':checked')) {
        	totalPrice = totalPrice + parseInt($(this).val());
			$('.total-price').html((Math.round(totalPrice * 100) / 100).toFixed(0));
        } else {
			totalPrice = totalPrice - parseInt($(this).val());
			$('.total-price').html((Math.round(totalPrice * 100) / 100).toFixed(0));
        }

        if (peopleQty > 0) {
        	peopleTotalPrice = totalPrice / peopleQty;
        	$('.people-total-price').html((Math.round(peopleTotalPrice * 100) / 100).toFixed(0));
        } else {
        	peopleTotalPrice = 0;
        	$('.people-total-price').html((Math.round(peopleTotalPrice * 100) / 100).toFixed(0));
        }
    });

    // Button
    $("#close-button").click(function() {
		$(".flash-error").parent().css( "display", "none" );
	});
});

function totalPriceCalc() {
	totalPrice = 0;
	// Beer
	totalPrice = totalPrice + priceBeer
	peopleTotalPrice = totalPrice / peopleQty;

	// Beer
	totalPrice = totalPrice + priceSoda
	peopleTotalPrice = totalPrice / peopleQty;

	// Pizza
	totalPrice = totalPrice + pricePizza;
	peopleTotalPrice = totalPrice / peopleQty;

	// Icre Cream
	totalPrice = totalPrice + priceIcecream;
	$('.total-price').html((Math.round(totalPrice * 100) / 100).toFixed(0));

	if (peopleQty > 0) {
		peopleTotalPrice = totalPrice / peopleQty;
		$('.people-total-price').html((Math.round(peopleTotalPrice * 100) / 100).toFixed(0));
	} else {
		peopleTotalPrice = 0;
		$('.people-total-price').html((Math.round(peopleTotalPrice * 100) / 100).toFixed(0));
	}
}
