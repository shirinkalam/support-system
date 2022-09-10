
// var $select = $("<select></select>");
// $("#menu").append($select);
$(document).ready(function(){
	var $navbar_header = $('<div class="navbar-header"></div>');

	var $button = $("<button></button>");
	var $span = $('<span class="icon-bar"></span>');

	for (var i = 0; i < 3; i++) {
	  $button.append($span.clone());
	}

	$button.addClass('navbar-toggle');

	$navbar_header.append($button);

	$("#menu .container").prepend($navbar_header);


	$('.navbar-toggle').on('click', function(){
				$('#navbar').toggle();
	});


function navbarDisplay(){
      var win = $(this); //this = window
      if (win.width() >= 768) {
		$('#navbar').css('display', 'block');

  		}
  	if(win.width()< 768){
  		$('#navbar').css('display', 'none');

  	}
  }

$(window).on('resize', _.debounce(navbarDisplay, 0));


});





