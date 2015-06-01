

//roept navMovement functie aan als er gescrolled wordt.
$(document).scroll(navMovement);


//Regelt de beweging van die <nav> element, waarin de rubrieken worden weer gegeven.
function navMovement(){
    var fromTop = $(window).scrollTop();
    if ($(window).scrollTop() < 100) $('nav').stop(true, false).animate({top: (154 - fromTop)},300);
    else if ($(window).scrollTop() > 100) $('nav').stop(true, false).animate({top: 20},300);

}

//Maakt een globale veriable aan waarin de breedte van de product div wordt vastgelegd
//(-40 vanwege de extra padding op de eerste product in product-row div).
$(window).load(function() {
    productWidth = $('.product').outerWidth() - 40;
});


//roept arrow() functie elke seconde op nadat de DOM geladen is.
$(window).load(function() {
    var nArtikelen = 30;

    setInterval(function() {
        arrow('l-minute', nArtikelen);
        arrow('populair', nArtikelen);
        arrow('recent', nArtikelen); 
    }, 1000);

});


//houdt bij hoe ver de product-row div gescrolled is en of de pijltjes aan of uit moeten.
function arrow(id, items){
    productBoxWidth = $('.product-box').width();
    if ($('#'+id).scrollLeft() == 0 ) {
        $('.'+id+' .arrow-left img:nth-child(2)').css({
            visibility: 'visible'
        });
    } else {
        $('.'+id+' .arrow-left img:nth-child(2)').css({
            visibility: 'hidden'
        });
    }
    
    if ($('#'+id).scrollLeft() >= productWidth * items - productBoxWidth + 39) {
        $('.'+id+' .arrow-right img:nth-child(2)').css({
            visibility: 'visible'
        });
    } else {
        $('.'+id+' .arrow-right img:nth-child(2)').css({
            visibility: 'hidden'
        });
    }
}

//Regelt de beweging van de product-row div als er op de rechter pijl wordt gedrukt.
function scrollR(id){
    $('#'+id).stop(true, false).animate({
        scrollLeft: $('#'+id).scrollLeft() + productWidth},
        800);
}

//Regelt de beweging van de product-row div als er op de linker pijl wordt gedrukt.
function scrollL(id){
    $('#'+id).stop(true, false).animate({
        scrollLeft: $('#'+id).scrollLeft() - productWidth},
        800);
}


function CountDownTimer(dt, id){
    var end = new Date(dt);

    var _second = 1000;
    var _minute = _second * 60;
    var _hour = _minute * 60;
    var _day = _hour * 24;
    var timer;

    function showRemaining() {
        var now = new Date();
        var distance = end - now;
        if (distance < 0) {
            clearInterval(timer);
            document.getElementById(id).innerHTML = '<span>VERLOPEN!</span>';
            return;
        }
        var days = Math.floor(distance / _day);
        var hours = Math.floor((distance % _day) / _hour);
        var minutes = Math.floor((distance % _hour) / _minute);
        var seconds = Math.floor((distance % _minute) / _second);

        if (days < 1) {
            if (hours < 1) {
                document.getElementById(id).innerHTML = minutes + 'm ';
                document.getElementById(id).innerHTML += seconds + 's ';
            }else {
                document.getElementById(id).innerHTML = hours + 'h ';
                document.getElementById(id).innerHTML += minutes + 'm ';
                document.getElementById(id).innerHTML += seconds + 's ';
            }          
        }else if (days == 1) {
            document.getElementById(id).innerHTML = 'Nog ' + days + ' Dag';
        }else {
            clearInterval(timer);
            document.getElementById(id).innerHTML = 'Nog ' + days + ' Dagen';
        }

    }

    timer = setInterval(showRemaining, 1000);
}

//zoekbalk autocomplete
function autocomplet() {
    var min_lengte = 2; // min tekens voor autocomplete
    var zoekterm = $('#zoeken').val();
    var inRubriek = $('#zoekInRubriek').val();
    if (zoekterm.length >= min_lengte) {
        $.ajax({
            url: 'includes/functions.php',
            method: 'POST',
            data: {zoekterm:zoekterm, inRubriek:inRubriek},
            success:function(data){
                $('#zoeklijst').show();
                $('#zoeklijst').html(data);
            }
        });
    } else {
        $('#zoeklijst').hide();
    }
}
 
// dit wordt uitgevoerd wanneer er een resultaat wordt gekozen uit de autocomplet resultaten
function set_item(item) {
    $('#zoeken').val(item);
    $('#zoeklijst').hide();
}
