// $(window).scroll(function(){
// if  ($(window).scrollTop() >= 100){
//      $('#header').addClass('header-mini');
//      $('#logo').addClass('col-xs-offset-1');
//      $('#logo').removeClass('col-sm-7');
//      $('#logo').addClass('col-sm-6');
//      $('#login').removeClass('col-md-3');
//      $('#keurmerk').addClass('hidden');
//      $('#name').removeClass('col-sm-12');
//      $('#password').removeClass('col-sm-12');
//      $('#login-links').addClass('hidden');
//      $('#login-submit').removeClass('col-sm-4');
//      $('#login-submit').removeClass('col-sm-push-8');
//      // $('.zoekbalk').css({'margin-top':'70px'});

// }
// else {
//     $('#header').removeClass('header-mini');
//     $('#logo').removeClass('col-xs-offset-1');
//     $('#logo').addClass('col-sm-7');
//     $('#logo').removeClass('col-sm-6');
//     $('#login').addClass('col-md-3');
//     $('#keurmerk').removeClass('hidden');
//     $('#name').addClass('col-sm-12');
//     $('#password').addClass('col-sm-12');
//     $('#login-links').removeClass('hidden');
//     $('#login-submit').addClass('col-sm-4');
//     $('#login-submit').addClass('col-sm-push-8');
//     // $('.zoekbalk').css({'margin-top':'5px'});
//     }
// });

// $(window).scroll(function(){
// 	if ($(window).scrollTop() > 100) {
// 		if($(window).scrollTop() + $(window).height() < $(document).height() - 150){
// 			var fromTop = $(window).scrollTop();
// 			$('nav').css({'margin-top':fromTop});
// 		}
// 	}
// 	if ($(window).scrollTop() < 100) {
// 		$('nav').css({'margin-top':'0px'});
// 	}

// });
setInterval(function() {
    arrow('l-minute', 14);
    arrow('populair', 14);
    arrow('recent', 14); }, 500);

function arrow(id, items){
    if ($('#'+id).scrollLeft() == 0 ) {
        $('.'+id+' .arrow-left img:nth-child(2)').css({
            visibility: 'visible'
        });
    } else {
        $('.'+id+' .arrow-left img:nth-child(2)').css({
            visibility: 'hidden'
        });
    }

    if ($('#'+id).scrollLeft() >= (($('.product:nth-child(2)').outerWidth()*items+80) - ($('#'+id).width()))) {
        $('.'+id+' .arrow-right img:nth-child(2)').css({
            visibility: 'visible'
        });
    } else {
        $('.'+id+' .arrow-right img:nth-child(2)').css({
            visibility: 'hidden'
        });
    }
}


function scrollR(id){
    $('#'+id).animate({
        scrollLeft: $('#'+id).scrollLeft() + $('.product:nth-child(2)').outerWidth()},
        800);
}

function scrollL(id){
    $('#'+id).animate({
        scrollLeft: $('#'+id).scrollLeft() - $('.product:nth-child(2)').outerWidth()},
        800);
}

// Last Minutes
CountDownTimer('07/20/2015 11:39 AM', 'time');
CountDownTimer('07/20/2015 00:40 PM', 'time2');
CountDownTimer('07/21/2015 01:40 AM', 'time3');
CountDownTimer('07/22/2015 02:40 AM', 'time4');
CountDownTimer('07/23/2015 03:40 AM', 'time5');
CountDownTimer('07/24/2015 04:40 AM', 'time6');
CountDownTimer('07/25/2015 05:40 AM', 'time7');
CountDownTimer('07/26/2015 06:40 AM', 'time8');
CountDownTimer('07/27/2015 07:40 AM', 'time9');
CountDownTimer('07/28/2015 08:40 AM', 'time10');
CountDownTimer('07/29/2015 09:40 AM', 'time11');
CountDownTimer('08/01/2015 10:40 AM', 'time12');
CountDownTimer('08/01/2015 10:40 AM', 'time13');
CountDownTimer('08/01/2015 10:40 AM', 'time14');

// Populair

CountDownTimer('07/20/2015 11:39 AM', 'time15');
CountDownTimer('07/20/2015 00:40 PM', 'time16');
CountDownTimer('07/21/2015 01:40 AM', 'time17');
CountDownTimer('07/22/2015 02:40 AM', 'time18');
CountDownTimer('07/23/2015 03:40 AM', 'time19');
CountDownTimer('07/24/2015 04:40 AM', 'time20');
CountDownTimer('07/25/2015 05:40 AM', 'time21');
CountDownTimer('07/26/2015 06:40 AM', 'time22');
CountDownTimer('07/27/2015 07:40 AM', 'time23');
CountDownTimer('07/28/2015 08:40 AM', 'time24');
CountDownTimer('07/29/2015 09:40 AM', 'time25');
CountDownTimer('08/01/2015 10:40 AM', 'time26');
CountDownTimer('08/01/2015 10:40 AM', 'time27');
CountDownTimer('08/01/2015 10:40 AM', 'time28');

// Meest Recent

CountDownTimer('07/20/2015 11:39 AM', 'time29');
CountDownTimer('07/20/2015 00:40 PM', 'time30');
CountDownTimer('07/21/2015 01:40 AM', 'time31');
CountDownTimer('07/22/2015 02:40 AM', 'time32');
CountDownTimer('07/23/2015 03:40 AM', 'time33');
CountDownTimer('07/24/2015 04:40 AM', 'time34');
CountDownTimer('07/25/2015 05:40 AM', 'time35');
CountDownTimer('07/26/2015 06:40 AM', 'time36');
CountDownTimer('07/27/2015 07:40 AM', 'time37');
CountDownTimer('07/28/2015 08:40 AM', 'time38');
CountDownTimer('07/29/2015 09:40 AM', 'time39');
CountDownTimer('08/01/2015 10:40 AM', 'time40');
CountDownTimer('08/01/2015 10:40 AM', 'time41');
CountDownTimer('08/01/2015 10:40 AM', 'time42');

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

        document.getElementById(id).innerHTML = days + '<span>D </span>';
        document.getElementById(id).innerHTML += hours + '<span>H </span>';
        document.getElementById(id).innerHTML += minutes + '<span>M </span>';
        document.getElementById(id).innerHTML += seconds + '<span>S</span>';
    }

    timer = setInterval(showRemaining, 1000);
}

function autocomplet() {
    var min_length = 2; // min tekens voor autocomplete
    var keyword = $('#zoeken').val();
    if (keyword.length >= min_length) {
        $.ajax({
            url: 'includes/ajax_zoeken.php',
            type: 'POST',
            data: {keyword:keyword},
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
    // change input value
    $('#zoeken').val(item);
    // hide proposition list
    $('#zoeklijst').hide();
}
