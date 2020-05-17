
var beerCalc = 0.65;
var sodaCalc = 0.65;
var pizzaCalc = 0;
var icecreamCalc = 0.2;
var frutas = 0;




var beerCalcPrice = 95;
//var sodaCalcPrice = 95;
var sodaCalcPrice = 100;
//var sodaCalcPriceDiet = 107;
var sodaCalcPriceDiet = 200;
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
	var epaCost = parseIntValue($("#beer-epa-cost").val());
	var ipaCost = parseIntValue($("#beer-ipa-cost").val());

	
	if(beerQtyValidation(epaQty, ipaQty)) {
		if(((epaQty % 9) == 0) && ((ipaQty % 9) == 0)){
		    
			//window.totalBeer = epaQty + ipaQty;
			//window.priceBeer = totalBeer * beerCalcPrice;
			var totalBeer = epaQty + ipaQty;
			var priceBeerEpa = epaQty * epaCost;
    		var priceBeerIpa = ipaQty * ipaCost;
			var priceBeer = priceBeerEpa + priceBeerIpa;
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
	var normalColaCost = parseIntValue($("#normal-cola-cost").val());
	var dietColaCost = parseIntValue($("#diet-cola-cost").val());
	

	if(sodaQtyValidation()){
		$(".size-tres").each(function() {
			sizeTres += Number($(this).val());
			totLtrSizeTres = sizeTres * 3;
			//totalSodaNormal = sizeTres * sodaCalcPrice;
			totalSodaNormal = sizeTres * normalColaCost;
		});

		$(".size-tres-diet").each(function() {
			sizeTresDiet += Number($(this).val());
			totLtrSizeTresDiet = sizeTresDiet * 3;
			//totalSodaDiet = sizeTresDiet * sodaCalcPriceDiet;
			totalSodaDiet = sizeTresDiet * dietColaCost;
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
	var pizza1 = parseIntValue($("#pizza-1").val(), 0);
	var pizza2 = parseIntValue($("#pizza-2").val(), 0);
	var pizza3 = parseIntValue($("#pizza-3").val(), 0);
	var pizza4 = parseIntValue($("#pizza-4").val(), 0);
	var pizza5 = parseIntValue($("#pizza-5").val(), 0);
	var pizza6 = parseIntValue($("#pizza-6").val(), 0);
	var pizza7 = parseIntValue($("#pizza-7").val(), 0);
	var pizza8 = parseIntValue($("#pizza-8").val(), 0);
	var mediaPizza1 = parseIntValue($("#media-pizza-1").val(), 0);
	var mediaPizza2 = parseIntValue($("#media-pizza-2").val(), 0);
	var mediaPizza3 = parseIntValue($("#media-pizza-3").val(), 0);
	var mediaPizza4 = parseIntValue($("#media-pizza-4").val(), 0);
	var mediaPizza5 = parseIntValue($("#media-pizza-5").val(), 0);
	var mediaPizza6 = parseIntValue($("#media-pizza-6").val(), 0);
	var mediaPizza7 = parseIntValue($("#media-pizza-7").val(), 0);
	var mediaPizza8 = parseIntValue($("#media-pizza-8").val(), 0);
	
	var pizza1Cost = parseIntValue($("#pizza-1-cost").val());
	var pizza2Cost = parseIntValue($("#pizza-2-cost").val());
	var pizza3Cost = parseIntValue($("#pizza-3-cost").val());
	var pizza4Cost = parseIntValue($("#pizza-4-cost").val());
	var pizza5Cost = parseIntValue($("#pizza-5-cost").val());
	var pizza6Cost = parseIntValue($("#pizza-6-cost").val());
	var pizza7Cost = parseIntValue($("#pizza-7-cost").val());
	var pizza8Cost = parseIntValue($("#pizza-8-cost").val());
	var mediaPizza1Cost = parseIntValue($("#media-pizza-1-cost").val());
	var mediaPizza2Cost = parseIntValue($("#media-pizza-2-cost").val());
	var mediaPizza3Cost = parseIntValue($("#media-pizza-3-cost").val());
	var mediaPizza4Cost = parseIntValue($("#media-pizza-4-cost").val());
	var mediaPizza5Cost = parseIntValue($("#media-pizza-5-cost").val());
	var mediaPizza6Cost = parseIntValue($("#media-pizza-6-cost").val());
	var mediaPizza7Cost = parseIntValue($("#media-pizza-7-cost").val());
	var mediaPizza8Cost = parseIntValue($("#media-pizza-8-cost").val());
	
	
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
		var totPizza1 = pizza1 * pizza1Cost;
		var totMediaPizza1 = mediaPizza1 * mediaPizza1Cost;
		var totPizza2 = pizza2 * pizza2Cost;
		var totMediaPizza2 = mediaPizza2 * mediaPizza2Cost;
		var totPizza3 = pizza3 * pizza3Cost;
		var totMediaPizza3 = mediaPizza3 * mediaPizza3Cost;
		var totPizza4 = pizza4 * pizza4Cost;
		var totMediaPizza4 = mediaPizza4 * mediaPizza4Cost;
		var totPizza5 = pizza5 * pizza5Cost;
		var totMediaPizza5 = mediaPizza5 * mediaPizza5Cost;
		var totPizza6 = pizza6 * pizza6Cost;
		var totMediaPizza6 = mediaPizza6 * mediaPizza6Cost;
		var totPizza7 = pizza7 * pizza7Cost;
		var totMediaPizza7 = mediaPizza7 * mediaPizza7Cost;
		var totPizza8 = pizza8 * pizza8Cost;
		var totMediaPizza8 = mediaPizza8 * mediaPizza8Cost;
		
		var pricePizza = totPizza1 + totMediaPizza1 + totPizza2 + totMediaPizza2 + totPizza3 + totMediaPizza3 + totPizza4 + totMediaPizza4 + totPizza5 + totMediaPizza5 + totPizza6 + totMediaPizza6 + totPizza7 + totMediaPizza7 + totPizza8 + totMediaPizza8
		
		console.log(totPizza1, totMediaPizza1, totPizza2, totMediaPizza2, pricePizza);
		//window.pricePizza = totalPizzaGral * pizzaCalcPrice;

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
	
	
	var flav1Qty = parseIntValue($("#flav-1").val(), 0);
	var flav1MedioQty = parseIntValue($("#flav-1-medio").val(), 0);
	var flav1TercioQty = parseIntValue($("#flav-1-tercio").val(), 0);
	var flav2Qty = parseIntValue($("#flav-2").val(), 0);
	var flav2MedioQty = parseIntValue($("#flav-2-medio").val(), 0);
	var flav2TercioQty = parseIntValue($("#flav-2-tercio").val(), 0);
	var flav3Qty = parseIntValue($("#flav-3").val(), 0);
	var flav3MedioQty = parseIntValue($("#flav-3-medio").val(), 0);
	var flav3TercioQty = parseIntValue($("#flav-3-tercio").val(), 0);
	var flav4Qty = parseIntValue($("#flav-4").val(), 0);
	var flav4MedioQty = parseIntValue($("#flav-4-medio").val(), 0);
	var flav4TercioQty = parseIntValue($("#flav-4-tercio").val(), 0);
	var flav5Qty = parseIntValue($("#flav-5").val(), 0);
	var flav5MedioQty = parseIntValue($("#flav-5-medio").val(), 0);
	var flav5TercioQty = parseIntValue($("#flav-5-tercio").val(), 0);
	var flav6Qty = parseIntValue($("#flav-6").val(), 0);
	var flav6MedioQty = parseIntValue($("#flav-6-medio").val(), 0);
	var flav6TercioQty = parseIntValue($("#flav-6-tercio").val(), 0);
	var flav7Qty = parseIntValue($("#flav-7").val(), 0);
	var flav7MedioQty = parseIntValue($("#flav-7-medio").val(), 0);
	var flav7TercioQty = parseIntValue($("#flav-7-tercio").val(), 0);
	var flav8Qty = parseIntValue($("#flav-8").val(), 0);
	var flav8MedioQty = parseIntValue($("#flav-8-medio").val(), 0);
	var flav8TercioQty = parseIntValue($("#flav-8-tercio").val(), 0);
    var flav9Qty = parseIntValue($("#flav-9").val(), 0);
	var flav9MedioQty = parseIntValue($("#flav-9-medio").val(), 0);
	var flav9TercioQty = parseIntValue($("#flav-9-tercio").val(), 0);
    var flav10Qty = parseIntValue($("#flav-10").val(), 0);
	var flav10MedioQty = parseIntValue($("#flav-10-medio").val(), 0);
	var flav10TercioQty = parseIntValue($("#flav-10-tercio").val(), 0);
	
	var flav1Cost = parseIntValue($("#flav-1-cost").val());
	var flav1MedioCost = parseIntValue($("#flav-1-medio-cost").val());
	var flav1TercioCost = parseIntValue($("#flav-1-tercio-cost").val());
	var flav2Cost = parseIntValue($("#flav-2-cost").val());
	var flav2MedioCost = parseIntValue($("#flav-2-medio-cost").val());
	var flav2TercioCost = parseIntValue($("#flav-2-tercio-cost").val());
	var flav3Cost = parseIntValue($("#flav-3-cost").val());
	var flav3MedioCost = parseIntValue($("#flav-3-medio-cost").val());
	var flav3TercioCost = parseIntValue($("#flav-3-tercio-cost").val());
	var flav4Cost = parseIntValue($("#flav-4-cost").val());
	var flav4MedioCost = parseIntValue($("#flav-4-medio-cost").val());
	var flav4TercioCost = parseIntValue($("#flav-4-tercio-cost").val());
	var flav5Cost = parseIntValue($("#flav-5-cost").val());
	var flav5MedioCost = parseIntValue($("#flav-5-medio-cost").val());
	var flav5TercioCost = parseIntValue($("#flav-5-tercio-cost").val());
	var flav6Cost = parseIntValue($("#flav-6-cost").val());
	var flav6MedioCost = parseIntValue($("#flav-6-medio-cost").val());
	var flav6TercioCost = parseIntValue($("#flav-6-tercio-cost").val());
	var flav7Cost = parseIntValue($("#flav-7-cost").val());
	var flav7MedioCost = parseIntValue($("#flav-7-medio-cost").val());
	var flav7TercioCost = parseIntValue($("#flav-7-tercio-cost").val());
	var flav8Cost = parseIntValue($("#flav-8-cost").val());
	var flav8MedioCost = parseIntValue($("#flav-8-medio-cost").val());
	var flav8TercioCost = parseIntValue($("#flav-8-tercio-cost").val());
    var flav9Cost = parseIntValue($("#flav-9-cost").val());
	var flav9MedioCost = parseIntValue($("#flav-9-medio-cost").val());
	var flav9TercioCost = parseIntValue($("#flav-9-tercio-cost").val());
    var flav10Cost = parseIntValue($("#flav-10-cost").val());
	var flav10MedioCost = parseIntValue($("#flav-10-medio-cost").val());
	var flav10TercioCost = parseIntValue($("#flav-10-tercio-cost").val());
	
	var cucuruchoQty = parseIntValue($("#cucurucho").val(), 0);
	var cucuruchoCost = parseIntValue($("#cucurucho-cost").val());

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
        
        var totFlav1 = flav1Qty * flav1Cost;
		var totFlav1Medio = flav1MedioQty * flav1MedioCost;
		var totFlav1Tercio = flav1TercioQty * flav1TercioCost;
		var totFlav2 = flav2Qty * flav2Cost;
		var totFlav2Medio = flav2MedioQty * flav2MedioCost;
		var totFlav2Tercio = flav2TercioQty * flav2TercioCost;
		var totFlav3 = flav3Qty * flav3Cost;
		var totFlav3Medio = flav3MedioQty * flav3MedioCost;
		var totFlav3Tercio = flav3TercioQty * flav3TercioCost;
		var totFlav4 = flav4Qty * flav4Cost;
		var totFlav4Medio = flav4MedioQty * flav4MedioCost;
		var totFlav4Tercio = flav4TercioQty * flav4TercioCost;
		var totFlav5 = flav5Qty * flav5Cost;
		var totFlav5Medio = flav5MedioQty * flav5MedioCost;
		var totFlav5Tercio = flav5TercioQty * flav5TercioCost;
		var totFlav6 = flav6Qty * flav6Cost;
		var totFlav6Medio = flav6MedioQty * flav6MedioCost;
		var totFlav6Tercio = flav6TercioQty * flav6TercioCost;
		var totFlav7 = flav7Qty * flav7Cost;
		var totFlav7Medio = flav7MedioQty * flav7MedioCost;
		var totFlav7Tercio = flav7TercioQty * flav7TercioCost;
		var totFlav8 = flav8Qty * flav8Cost;
		var totFlav8Medio = flav8MedioQty * flav8MedioCost;
		var totFlav8Tercio = flav8TercioQty * flav8TercioCost;
		var totFlav9 = flav9Qty * flav9Cost;
		var totFlav9Medio = flav9MedioQty * flav9MedioCost;
		var totFlav9Tercio = flav9TercioQty * flav9TercioCost;
		var totFlav10 = flav10Qty * flav10Cost;
		var totFlav10Medio = flav10MedioQty * flav10MedioCost;
		var totFlav10Tercio = flav10TercioQty * flav10TercioCost;
		
		var totCucurucho = cucuruchoQty * cucuruchoCost
		
		//window.cucuPriceTotal = cucuruchPrice * cucuruchoQty
		window.totalIcecream = totI + totMedFlav + totTercFlav;
		//window.priceIcecream = (totalIcecream * icecreamCalcPrice) + cucuPriceTotal;
		
		var priceIcecream = totFlav1 + totFlav1Medio + totFlav1Tercio + totFlav2 + totFlav2Medio + totFlav2Tercio + totFlav3 + totFlav3Medio + totFlav3Tercio + totFlav4 + totFlav4Medio + totFlav4Tercio + totFlav5 + totFlav5Medio + totFlav5Tercio + totFlav6 + totFlav6Medio + totFlav6Tercio + totFlav7 + totFlav7Medio + totFlav7Tercio + totFlav8 + totFlav8Medio + totFlav8Tercio + totFlav9 + totFlav9Medio + totFlav9Tercio + totFlav10 + totFlav10Medio + totFlav10Tercio + totCucurucho; 

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
