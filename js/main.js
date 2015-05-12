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

function scrollR(id){
	$('#'+id).scrollLeft($('#'+id).scrollLeft() + 300);
}

function scrollL(id){
	$('#'+id).scrollLeft($('#'+id).scrollLeft() - 300);
}

CountDownTimer('05/12/2015 11:40 AM', 'time');
CountDownTimer('02/20/2012 10:1 AM', 'time2');

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

        document.getElementById(id).innerHTML = days + '<span>d </span>';
        document.getElementById(id).innerHTML += hours + '<span>h </span>';
        document.getElementById(id).innerHTML += minutes + '<span>m </span>';
        document.getElementById(id).innerHTML += seconds + '<span>s</span>';
    }

    timer = setInterval(showRemaining, 1000);
}
