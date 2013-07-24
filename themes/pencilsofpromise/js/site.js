var isiPad = navigator.userAgent.match(/iPad/i) != null;
var numOld = .32;
var num = 25;
$(function() {
	
	/******************************************/
	/* Season of 1000 Promises */
	/******************************************/


	var ticker = function() {
		setTimeout(function(){
			$('#ticker ul.ticker li:first').animate( {marginTop: '-52px'}, 800, function() {
				$(this).detach().appendTo('ul.ticker').removeAttr('style');
			});
			
			ticker();
		}, 4000);
	};
	ticker();
	
	/******************************************/
	/* Project filtered items hover */
	/******************************************/
	
	$('#projects .item a').hover(
		function() {
			$(this).children('.item-info').stop(true, false).animate( {top: 0}, 200 );
		},
		function() {
			$(this).children('.item-info').stop(true, false).animate( {top: '185px'}, 200 );
		}
	);
	
	/******************************************/
	/* Slider */
	/******************************************/
	$('#slider').slider({
		'min'     : 10,
		'max'     : 1000,
		'step'    : 1,
		'animate' : 'fast',
		'slide'   : function(evt, ui) {
			var raw = ui.value;
			calculateDonation(raw, num, 'child');                    
		},
		'create'   : function(evt, ui) {
			var raw = $('#input-amt').val();
			calculateDonation(raw, num, 'child');                      
                }                          
	});
	
	/******************************************/
	/* Blur event for slider */
	/******************************************/
	
	$('#input-amt, #input-amt2').blur(function() {
		var raw_value = $(this).val().split(',');
		var new_value = raw_value[0] + raw_value[1];
		if(new_value != '') {
			var first_value = new_value.substr(0, 1);
			if(first_value == '$') {
				new_value = parseInt(new_value.substr(1));	
			} else {
				new_value = parseInt(new_value);
			}
                        if (new_value<5 || isNaN(new_value)) { new_value=5; }
			calculateDonation(new_value, num, 'child');
		}
	});
	
	$('#input-days, #input-days2').blur(function() {
		var raw_value = $(this).val().split(',');
		var new_value = raw_value[0];
		
		if(raw_value[1] != undefined) {
			new_value += raw_value[1];
		}
		
		if(new_value != '') {
			var new_days = calculateDonation(new_value, num, 'money');
		}
	});
	
	/******************************************/
	/* Uses enter key to calc donation */
	/******************************************/
	
	$('#input-amt, #input-amt2').keydown(function(evt) {
		if(evt.keyCode == '13') {
			var raw_value = $(this).val().split(',');
			var new_value = raw_value[0] + raw_value[1];
			var first_value = new_value.substr(0, 1);
			if(first_value == '$') {
				new_value = parseInt(new_value.substr(1));	
			} else {
				new_value = parseInt(new_value);
			}
			calculateDonation(new_value, num, 'child');
		}
	});
	
	$('#input-days, #input-days2').keydown(function(evt) {
		if(evt.keyCode == '13') {
			var raw_value = $(this).val().split(',');
			var new_value = raw_value[0];
			
			if(raw_value[1] != undefined) {
				new_value += raw_value[1];
			}

			if(new_value != '') {
				var new_days = calculateDonation(new_value, num, 'money');
			}
		}
	});
	
	/******************************************/
	/* Calculates donation amount in days or money */
	/******************************************/
	
	function calculateDonation(amount, d, type) {
		var time = $('.amount-copy-days').text();
		if(isNaN(amount)) {
			amount = 0;
		}
		if(type == 'child') {
			var donation = amount / d;
                        donation = Math.floor(donation);			    
			if(amount<25) {
                                if (donation==0 && amount>0) { donation=1; }
                                months=Math.floor((amount/25)*12); 
                                if (months==0) { months=1; }
				$('.amount-copy-days').text('child');
                                $('#input-days, #input-days2').val(donation);
                                $('#span-days2').html(donation);
                                if (months==1) { 
                                    $('.amount-copy-days').text('child ' + months + ' month of education');
                                    //$('.amount-copy-extra').text(months + ' month of education');
                                }
                                else {
                                    $('.amount-copy-days').text('child ' + months + ' months of education');
                                    //$('.amount-copy-extra').text(months + ' months of education');  
                                }
			} else {
                                if (donation==1) {
                                    $('.amount-copy-days').text('child access to education');
                                }
                                else {
                                    $('.amount-copy-days').text('children access to education');   
                                }
                                $('.amount-copy-extra').text('');
                                $('#input-days, #input-days2').val(donation);
                                $('#span-days2').html(donation);
			}
			var newer_value = amountForSlider(amount);
		}
                else {	
                        var donation = amount*d;
                        if (donation==1) {
                            $('.amount-copy-days').text('child  access to education');
                        }
                        else {
                            $('.amount-copy-days').text('children access to education');   
                        }
			var donation_amt = Math.round(donation);
			var newer_value = amountForSlider(donation_amt);
		}
		$('a.ui-slider-handle').text(newer_value.ldecimals);
		$("#slider").slider("option", "value", newer_value.ldecimals);
		$('input[name=Payment_Amount], input[name=amount]').val(newer_value.ldecimals);
		$('#input-amt, #input-amt2').val(newer_value.hdecimals);
	}
	
	/******************************************/
	/* Our Approach accordions */
	/******************************************/
	
	$('#approach-accordion .title a').click(function(evt) {
		var that = $(this);
		
		if(that.hasClass('active')) {
			that.removeClass('active').parent().next().slideUp(200);
		} else {
			that.addClass('active').parent().next().slideDown(200);
		}		
		return false;
	});
	
	/******************************************/
	/* PoP video on homepage */
	/******************************************/
	
	$('.launch-video').click(function() {
		launchVideo();
		
		return false;
	});
	
	$('#featurebox a[href="#welcome"]').click(function(e) {
		launchVideo();
		
		return false;
	});
	
	$('#jumpToProject #page_id').change(function() {
		$('#jumpToForm').submit();
	});
        
	/******************************************/
	/* Featured image slider */
	/******************************************/
	alert($('#home .featureSlider'));
	
	try {
		$('#home .featureSlider').anythingSlider({
			easing			: "swing",	// Anything other than "linear" or "swing" requires the easing plugin
			width 			: 990,
			height 			: 370, 
			resizeContents 	: false,
			autoPlay		: true,		// This turns off the entire FUNCTIONALITY, not just if it starts running or not
			startStopped	: false,	// If autoPlay is on, this can force it to start stopped
			delay			: 6000,		// How long between slide transitions in AutoPlay mode
			animationTime	: 600,		// How long the slide transition takes
			hashTags		: false,	// Should links change the hashtag in the URL?
			buildArrows		: false,	// If true, builds the forwards and backwards buttons
			buildNavigation	: true,		// If true, builds and list of anchor links to link to each slide
			pauseOnHover	: true,		// If true, and autoPlay is enabled, the show will pause on hover
			startText		: "",	// Start text
			stopText		: "",	// Stop text
			navigationFormatter: null	// Advanced Use
		});
	} catch (error) {
		alert(error);
	}

	/******************************************/
	/* Search */
	/******************************************/
	
	$('#search-button').click(function() {
		launchSearch();
		
		return false;
	});
	
	/******************************************/
	/* Donate Money - Only one checkbox can be */
	/* checked at a time */
	/******************************************/
	
	$('.recur_type').click(function() {
		var id = $(this).val();
		
		if(id == 'Month') {
			$('.recur_type[value=Year]').attr('checked', false);
		} else {
			$('.recur_type[value=Month]').attr('checked', false);
		}

		
		/*if($(this).attr('checked') == false) {
			$('input[name=direct_payment]').parent().fadeIn(200).prev().fadeIn(200);
		} else {
			$('input[name=direct_payment]').parent().fadeOut(200).prev().fadeOut(200);
		}*/
		
	});
	
	$('div.d-5 img').hover(
		function() {
			$('#last-step-extra').stop(true, false).fadeIn(200);
		},
		function() {
			$('#last-step-extra').stop(true, false).fadeOut(200);
		}
	);
	
	/******************************************/
	/* Donation error lightbox */
	/******************************************/
	
	$('.payment-type input, .donate-submit input').click(function() {
		if(parseInt($('#payment_amount').val()) > 10000) {
			$('html, body').animate({scrollTop: 0}, 500);
			var id = $('#sorry-box');
			$('#sorry-box p span').text(addCommas($('#payment_amount').val()));
			var boxY = $(window).height()/2 - ((id.height()/2)+60);
			var boxX = $(window).width()/2 - id.width()/2;
			id.css( {'top': boxY, 'left': boxX} ).fadeIn(200);

			var maskHeight = $(document).height();
			var maskWidth = $(window).width();

			$('#mask').css( {'width': maskWidth, 'height': maskHeight} ).fadeIn(200);

			$('#mask').click(function() {
				$(this).fadeOut(200);
				id.fadeOut(200);
			});

			$('#sorry-box-close').click(function() {
				$('#sorry-box, #mask').fadeOut(200);

				return false;
			});
			
			return false;
		}
	});


	/******************************************/
	/* Twitter lightbox */
	/******************************************/
	
	$('#twitter').click(function() {
		var id = $('#twitter-box');
		var boxY = $(window).height()/2 - ((id.height()/2)+60);
		var boxX = $(window).width()/2 - id.width()/2;
		id.css( {'top': boxY, 'left': boxX} ).fadeIn(200);
		
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();

		$('#mask').css( {'width': maskWidth, 'height': maskHeight} ).fadeIn(200);
		
		try {
			_gaq.push(['_trackEvent', 'Donate Twitter', 'Preview Message']);
		} catch (err) {}

		$('input#submit').click(function() {
			var textarea = $('#twitter-box textarea').val();

			if(textarea != '') {
				var message = textarea;
				window.open('http://twitter.com/share?url=http://www.pencilsofpromise.org&text='+message, 'Update', "status=0, width=600, height=300, left=400, top=100");
			}
			
			try {
				_gaq.push(['_trackEvent', 'Donate Twitter', 'Launch Twitter.com Popup']);
			} catch (err) {}

			return false;
		});
		
		$('#mask').click(function() {
			$(this).fadeOut(200);
			$('#twitter-box').fadeOut(200);
		});
		
		$('input#cancel').click(function() {
			$('#twitter-box, #mask').fadeOut(200);
			
			return false;
		});
		
		return false;
	});

	/******************************************/
	/* iPromise Team lightbox */
	/******************************************/
	
	$('.teamraise').click(function() {
                $('html, body').animate({scrollTop: 0}, 500);
		var id = $('#team-box');
		var boxY = $(window).height()/2 - ((id.height()/2)+60);
		var boxX = $(window).width()/2 - id.width()/2;
		id.css( {'top': boxY, 'left': boxX} ).fadeIn(200);
		
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();

		$('#mask').css( {'width': maskWidth, 'height': maskHeight} ).fadeIn(200);
		
		$('#mask').click(function() {
			$(this).fadeOut(200);
			$('#team-box').fadeOut(200);
		});
		return false;
	});

	/******************************************/
	/* Impact Trips Join lightbox */
	/******************************************/
	
	$('.join-trip').click(function() {
                $('html, body').animate({scrollTop: 0}, 500);
		var id = $('#join-trip');
		var boxY = $(window).height()/2 - ((id.height()/2)+30);
		var boxX = $(window).width()/2 - id.width()/2;
		id.css( {'top': boxY, 'left': boxX} ).fadeIn(200);
		
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();

		$('#mask').css( {'width': maskWidth, 'height': maskHeight} ).fadeIn(200);
		
		$('#mask').click(function() {
			$(this).fadeOut(200);
			$('#join-trip').fadeOut(200);
		});
		return false;
	});

	/******************************************/
	/* Events tabs */
	/******************************************/
	
	$('.tabs a').click(function() {
		var goto = $(this).attr('href');
		$('.tabs a').removeClass('active');
		$('.event').hide();
		$(this).addClass('active');
		$('.no-events').remove();
		if(goto == 'upcoming') {
			$('.'+goto+':not(.local)').show();
		} else if(goto == 'local') {
			if($('.local').length == 0) {
				$('.events').append('<p class="no-events">There are no local events yet!</p>');
			} else {
				$('.'+goto).show();
			}
		} else {
			$('.'+goto).show();
		}
		
		return false;
	});
	
	/******************************************/
	/* Handled "Go Back" on confirm page */
	/******************************************/
	
	$('input[name=back_button]').click(function() {
		window.location = $(this).val();
		return false;
	});
	
	/******************************************/
	/* Newsletter signup */
	/******************************************/
	$('#newsletter-submit').click(function() {
		var form_inputs = $('.newsletter').serialize();
		
		$.ajax({
			url: 'wp-content/themes/pencilsofpromise/newsletter_signup.php',
			type: 'POST',
			data: form_inputs,
			dataType: 'json',
			success: function(data) {
				console.log(data);
			}
		});
		
		return false;
	});
	
	/*********
	*  Projects
	**********/
	
	$('#map-view').addClass("active");
	
	$('#list').hide();	
	
	$('#map-view').click(function(){
			$(this).addClass("active");
			$('#list-view').removeClass("active");
			$('#maps').show();
			$('#list').hide();
			$.cookie("our-projects", "maps");
		}
	);
	
	$('#list-view').click(function(){
			$(this).addClass("active");
			$('#map-view').removeClass("active");
			$('#list').show();
			$('#maps').hide();
			$.cookie("our-projects", "list");
		}
	);
	
	if ($.cookie("our-projects") == "list") {
		$('#list-view').trigger("click");
	}
	
	$('.project-status li').click(function(){
		$(this).find('div').toggleClass("active");
	});
		
	$('#featured .pentry').last().css('margin-right', '0');
	
	$('#toggle-all').click(function(){
		$(this).addClass('active');
		$('#toggle-laos, #toggle-guat, #toggle-nic').removeClass('active');
	});
	
	$('#toggle-laos').click(function(){
		$(this).addClass('active');
		$('#toggle-all, #toggle-guat, #toggle-nic').removeClass('active');
	});
	
	$('#toggle-guat').click(function(){
		$(this).addClass('active');
		$('#toggle-laos, #toggle-all, #toggle-nic').removeClass('active');
	});
	
	$('#toggle-nic').click(function(){
		$(this).addClass('active');
		$('#toggle-laos, #toggle-guat, #toggle-all').removeClass('active');
	});
	
	$('#toggle-est, #toggle-cur, #toggle-up').click(function(){
		$(this).toggleClass('active');
	});
	
	jQuery.fn.equalHeight = function () {
		var tallest = 0;
		this.each(function() {
			tallest = ($(this).height() > tallest)? $(this).height() : tallest;
		});
		return this.height(tallest);	
	}
	
});



/******************************************/
/* Homepage Spash */
/******************************************/

function launchSplash() {
        var id = $('#splash-box');
        var boxY = $(window).height()/2 - ((id.height()/2)+60);
        var boxX = $(window).width()/2 - id.width()/2;
        if (boxY<0) { boxY=5; }
        id.css( {'top': boxY, 'left': boxX} ).show();
        var maskHeight = $(document).height();
        var maskWidth = $(window).width();

        $('#maskSplash').css( {'width': maskWidth, 'height': maskHeight} );

        $('#maskSplash').click(function() {
                $(this).fadeOut(200);
                $('#splash-box').fadeOut(200);
        });

        $('#splashClose').click(function() {
                $('#splash-box, #maskSplash').fadeOut(200);
                return false;
        });

        return false;
}

function dontSplash() {
  $("#maskSplash").hide();  
}

function amountForSlider(amount) {
	if(isNaN(amount)) {
		amount = 10;
	}	
	if(amount >= 1000) {
        $('#donatemessagehonor').hide();
		$('#donatemessage').fadeIn(200);
	}
	else if(amount >= 500) {
                $('#donatemessage').hide();
		$('#donatemessagehonor').fadeIn(200);
	}
	else {
                $('#donatemessage').hide();
		$('#donatemessagehonor').hide();
	}	
	var higher_value;
	var lower_value
	if(amount < 1000 && (amount.toString()).indexOf(".")==-1) {
		higher_value = amount+'.00';
	} else {
		higher_value = amount;
	}
	if (amount < 100 && (amount.toString()).indexOf(".")==-1) {
		lower_value = amount+'.00';
	} else {
		lower_value = amount;
	}
	return {'hdecimals': higher_value, 'ldecimals': lower_value};
}

function initDonate(page) {
	if(page == 1) {
		var amount = $('#input-amt').val();
	} else {
		var amount = $('#input-amt2').val();
	}
	var first_value = amount.substr(0, 1);
	if(first_value == '$') {
		amount = parseInt(amount.substr(1));	
	} else {
		amount = parseInt(amount);
	}
        var donation = amount / num;
        donation = Math.floor(donation);			    
        if(amount<25) {
                if (donation==0) { donation=1; }
                months=Math.floor((amount/25)*12); 
                if (months==0) { months=1; }
                $('.amount-copy-days').text('child');
                $('#input-days, #input-days2').val(donation);
                $('#span-days2').html(donation);
                if (months==1) { 
                    $('.amount-copy-days').text('child ' + months + ' month of education');
                    //$('.amount-copy-extra').text(months + ' month of education');
                }
                else {
                    $('.amount-copy-days').text('child ' + months + ' months of education');
                    //$('.amount-copy-extra').text(months + ' months of education');  
                }
        } else {
                if (donation==1) {
                    $('.amount-copy-days').text('child access to education');
                }
                else {
                    $('.amount-copy-days').text('children access to education');   
                }
                $('.amount-copy-extra').text('');
                $('#input-days, #input-days2').val(donation);
                $('#span-days2').html(donation);
        }
	
	if(page === 1) {
		if(amount < 100 && (amount.toString()).indexOf(".")==-1) {
			amount += '.00';
		}
		$('a.ui-slider-handle').text(amount);
		if(amount > 100 && (amount.toString()).indexOf(".")==-1) {
			amount += '.00';
		}
		$('#input-days').val(donation);
		$('#input-amt').val('$'+amount);
		$("#slider").slider("option", "value", amount);
	} else {
		$('#input-days2').val(donation);
                $('#span-days2').html(donation);
	}
}

function launchVideo() {
	$('html, body').animate({scrollTop: 0}, 500);

	var id = $('#video-box');
	var boxY = $(window).height()/2 - ((id.height()/2));
	var boxX = $(window).width()/2 - id.width()/2;
	id.css( {'top': boxY, 'left': boxX} );

	var maskHeight = $(document).height();
	var maskWidth = $(window).width();
        $('#mask').css( {'width': maskWidth, 'height': maskHeight} );
       
        if ($("#popupVideoFrame").attr('src') == "/wp-content/themes/pencilsofpromise/blanker.html") { 
            $("#popupVideoFrame").attr('src', "/video-overlay");
       }

	$(id).fadeIn(200);
	$('#mask').fadeIn(200);

	$('#video-box-close').click(function() {
		$('#video-box, #mask').fadeOut(200);
		$("#popupVideoFrame").attr('src', "/wp-content/themes/pencilsofpromise/blanker.html");
		return false;
	});

	$('#mask').click(function() {
		$(this).fadeOut(200);
		$('#video-box').fadeOut(200);
	});
	
	$(window).resize(function() {
		recenterVideo(id);
	});
}

function recenterVideo(id) {
	var boxY = $(window).height()/2 - ((id.height()/2));
	var boxX = $(window).width()/2 - id.width()/2;
	id.css( {'top': boxY, 'left': boxX} );

	var maskHeight = $(document).height();
	var maskWidth = $(window).width();
}

function launchSearch() {
	$('html, body').animate({scrollTop: 0}, 500);
	
	var id = $('#search-box');
	var boxY = 150;
	var boxX = $(window).width()/2 - id.width()/2;
	id.css( {'top': boxY, 'left': boxX} );

	var maskHeight = $(document).height();
	var maskWidth = $(window).width();

	$('#mask').css( {'width': maskWidth, 'height': maskHeight} );

	$(id).fadeIn(200);
	$('#mask').fadeIn(200);
	
	$('#search-input').focus();

	$('#search-box-close').click(function() {
		$('#search-box, #mask').fadeOut(200);

		return false;
	});

	$('#mask').click(function() {
		$(this).fadeOut(200);
		$('#search-box').fadeOut(200);
	});

	return false;
}

function addCommas(nStr) {
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}
Cufon.replace('.BebasNeue', {fontFamily: 'Bebas Neue'})
Cufon.replace('#paper-content-projects h3, .hometouts .home span, .step-number, .fancy-serif, .the-image .viewport .amount', { fontFamily: 'Sketch Rockwell', hover: true });
if (isiPad) {
	Cufon.replace('#header #friends .numbers', { fontFamily: 'Sketch Rockwell' });
}

function selectAll(id) {
  document.getElementById(id).focus();
  document.getElementById(id).select();
}

$(function(){
    $("ul.dropdown li").hover(function(){
        $(this).addClass("hover");
        $('ul:first',this).css('visibility', 'visible');
    
    }, function(){
    
        $(this).removeClass("hover");
        $('ul:first',this).css('visibility', 'hidden');
    
    });
    
    $("ul.dropdown li ul li:has(ul)").find("a:first").append(" &raquo; ");

});

function photoGallery(type) {
    if (type=="album") {
    // Dynamically add nav buttons as these are not needed in non-JS browsers
      var prevNext = '<div id="album-nav"><button ' +
                       'class="prev">&laquo; Previous' +
                       '</button><button class="next">' +
                       'Next &raquo;</button></div>';
      $(prevNext).insertAfter('.album:last');
      // Add a wrapper around all .albums and hook jquery.cycle onto this
      $('.album').wrapAll('<div id="photo-albums"></div>');
      $('#photo-albums').cycle({
        fx:     'turnDown',
        speed:  500,
        timeout: 0,
        next:   '.next',
        prev:   '.prev'
      });
      // Remove the intro on first click -- just for the fun of it
      $('.prev,.next').click(function () {
        $('#intro:visible').slideToggle();
      });
      // Add lightbox to images
      $('.album a').lightBox();
    }
    else {
      $('.boximage a').lightBox();
    }
}

function products() {
  $(".product-tout").colorbox({inline:true, transition:"none", width:"652px", height:"534px"});
  $.panzoom();
}

function videos() {
  $(".video-tout").colorbox({iframe:true, transition:"none", innerWidth:600, innerHeight:486});
}

function iPromise() {
    $(document).ready(function(){
            now = new Date();
            y2k = new Date("Dec 31 2012 23:59:59");
            days = (y2k - now) / 1000 / 60 / 60 / 24;
            daysRound = Math.floor(days);
            if (daysRound<10) { daysRound="0"+daysRound; }
            hours = (y2k - now) / 1000 / 60 / 60 - (24 * daysRound);
            hoursRound = Math.floor(hours);
            if (hoursRound<10) { hoursRound="0"+hoursRound; }
            minutes = (y2k - now) / 1000 /60 - (24 * 60 * daysRound) - (60 * hoursRound);
            minutesRound = Math.floor(minutes);
            if (minutesRound<10) { minutesRound="0"+minutesRound; }
            seconds = (y2k - now) / 1000 - (24 * 60 * 60 * daysRound) - (60 * 60 * hoursRound) - (60 * minutesRound);
            secondsRound = Math.round(seconds);
            if (secondsRound<10) { secondsRound="0"+secondsRound; }
            $('#fundraiseCounter').countdown({
                image: 'wp-content/themes/pencilsofpromise/gfx/digits.png',
                stepTime: 60,
                format: "ddd:hh:mm:ss",
                digitWidth: 17,
                digitHeight: 25,
                startTime: ''+daysRound+':'+hoursRound+':'+minutesRound+':'+secondsRound+''
            });
            if ($.browser.msie) {
              $("#fundraiseTitleTop").hide();
              $(".statLabel").hide();
            }
            else {
                    $.getJSON("http://www.stayclassy.org/api/charity-info?cid=5417",
                    function(data) {
                         $('#amount-raised').append("$" + addCommas(Math.round(data['total_raised'])));
                         //$('#num-donors').append(addCommas(Math.round(data['total_supporters'])));
                         $('#num-fundraisers').append(addCommas(Math.round(data['total_fund_pages'])));
                         //$('#num-teams').append(Math.round(data['total_fund_teams']));
                         $('#lives-impacted').append(addCommas(Math.round(data['total_fund_teams'])));
                         Cufon.replace('#amount-raised, #num-fundraisers, #lives-impacted', {fontFamily: 'Bebas Neue'})
                    });
                    $.getJSON("http://www.stayclassy.org/api/get-top-fundraisers?cid=5417&limit=10",
                    function(data) {
                            $("#ipromise-stats #board .boardTable").append('<table class="boardTableTable" cellspacing="0" cellpadding="3" border="0"></table>');
                            $('#ipromise-stats #board .boardTable .boardTableTable').append('<tbody></tbody>');
                            $.each(data, function(i,item){
                                $('#ipromise-stats #board .boardTable .boardTableTable tbody').append('<tr><td class="big heavy">'+(i+1)+'.</td><td class="name">'+item['member_name']+'</td><td class="middle">$'+addCommas(Math.round(item['total_raised']))+'</td></tr>');
                            });
                    });                 
            }
    });
}
function addCommas(nStr)
{
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}

function setupLabel() {
    if ($('.label_check input').length) {
        $('.label_check').each(function(){ 
            $(this).removeClass('c_on');
        });
        $('.label_check input:checked').each(function(){ 
            $(this).parent('label').addClass('c_on');
        });                
    };
    if ($('.label_radio input').length) {
        $('.label_radio').each(function(){ 
            $(this).removeClass('r_on');
        });
        $('.label_radio input:checked').each(function(){ 
            $(this).parent('label').addClass('r_on');
        });
    };
};