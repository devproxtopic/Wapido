function parseIntValue(e,t){return e&&""!=e?parseInt(e,10):t}function quantityValidation(e){return 0>e?(alert("msje"),!1):!0}function peopleQty(){window.numQty=parseInt($("#people-number").val());var e=numQty*beerCalc,t=numQty*pizzaCalc,a=numQty*icecreamCalc;$(".beer").html((Math.round(100*e)/100).toFixed(1)),$(".pizza").html((Math.round(100*t)/100).toFixed(1)),$(".icecream").html((Math.round(100*a)/100).toFixed(1))}function beerQtyValidation(e,t){return quantityValidation(e)&&quantityValidation(t)?!0:!1}function beerQtyCalc(){var e=parseIntValue($("#beer-epa").val(),0),t=parseIntValue($("#beer-ipa").val(),0);if(beerQtyValidation(e,t)&&(window.totalBeer=e+t,window.priceBeer=totalBeer*beerCalcPrice,$(".total-ltr").html((Math.round(100*totalBeer)/100).toFixed(0)),$(".total-price-beer").html((Math.round(100*priceBeer)/100).toFixed(0)),numQty>0)){var a=totalBeer/numQty;$(".people-ltr").html((Math.round(100*a)/100).toFixed(2))}}function pizzaQtyValidation(){var e=!0;return $(".pizza-model").each(function(){e=e&&quantityValidation(Number($(this).val()))}),e?!0:!1}function pizzaQtyCalc(){var e=0;pizzaQtyValidation()&&($(".pizza-model").each(function(){e+=Number($(this).val())}),window.totalPizza=.5*e,window.pricePizza=totalPizza*pizzaCalcPrice,$(".total-meters").html((Math.round(100*totalPizza)/100).toFixed(1)),$(".total-price-pizza").html((Math.round(100*pricePizza)/100).toFixed(0)))}function icecreamQtyValidation(){var e=!0;return $(".icecream-flav").each(function(){e=e&&quantityValidation(Number($(this).val()))}),e?!0:!1}function icecreamQtyCalc(){var e=0,t=0;icecreamQtyValidation()&&($(".icecream-flav").each(function(){e+=Number($(this).val())}),$.each($("input.check-flavor:checked"),function(){t+=Number($(this).val())}),window.totalIcecream=e+t,window.priceIcecream=totalIcecream*icecreamCalcPrice,$(".total-ltr-ice").html((Math.round(100*totalIcecream)/100).toFixed(1)),$(".total-price-icecream").html((Math.round(100*priceIcecream)/100).toFixed(0)))}var beerCalc=.65,pizzaCalc=.2,icecreamCalc=.2,beerCalcPrice=95,pizzaCalcPrice=640,icecreamCalcPrice=280,numQty,totalPrice,totalBeer,priceBeer=0,totalPizza,pricePizza=0,totalIcecream,priceIcecream=0;totalPrice=priceBeer+pricePizza+priceIcecream,$(".total-price").html((Math.round(100*totalPrice)/100).toFixed(0));