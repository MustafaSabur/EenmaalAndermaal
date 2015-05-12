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

function scroll(id, pos){
	$('#'+id).scrollLeft($('#'+id).scrollLeft() + pos);
}

$('#time').html(Date());