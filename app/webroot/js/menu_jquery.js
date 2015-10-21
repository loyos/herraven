$( document ).ready(function() {
	$('.active').find('ul').show(); 
	// if($(".active a").hasClass( "main_active" )){
		// $('a.main_active').css('background-image', 'url(../img/menu-right.png)');
		// console.debug('pass');
	// }
$('#cssmenu > ul > li > a').click(function() {
  $('#cssmenu li').removeClass('active');
  $('#cssmenu li a').removeClass('main_active');
	if($(this).closest('li a').hasClass('no-sub') || $(this).closest('li a').hasClass('chicleto') ){
		$(this).closest('li a').addClass('main_active');
	}else{
		$(this).closest('li').addClass('active');
	}
  var checkElement = $(this).next();
  if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
    $(this).closest('li').removeClass('active');
    checkElement.slideUp('normal');
  }
  if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
    $('#cssmenu ul ul:visible').slideUp('normal');
    checkElement.slideDown('normal');
  }
  if($(this).closest('li').find('ul').children().length == 0) {
    return true;
  } else {
    return false;
  }	
	
});
});