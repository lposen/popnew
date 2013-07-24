<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Donate Voice
*/
?>

<?php get_header(); ?>

<div id="movement">
	<div id="fb-message-box">
		<h2><img src="<?php bloginfo('template_directory'); ?>/gfx/donateVoicePopUpTitle.png" alt="Spread the word to Facebook" /></h2>
		<div id="voicebg">
			<h3>You've seen the potential distance your voice can carry, now it's time to let your friends hear.</h3>
			<div id="prewritten">
				<img src="<?php bloginfo('template_directory'); ?>/gfx/facebookPoPThumb.png" alt="PoP on facebook" />
				<div id="prewritten-content">
					<strong>Pencils of Promise - Donate Your Voice</strong>
					<p>A voice is a powerful thing. A voice can change the world. All it takes is a champion, a simple idea, and the courage to demand a more ideal world. Don't believe us? Try it yourself. See how your voice can be a powerful agent of social good.</p>
				</div>
			</div>
			<div class="clearfix"></div>
			<div id="writeyourown">
				<p>Or you can write your own message</p>
				<textarea cols="30" rows="4" id="custom"></textarea>
			</div>
			<input type="submit" value="Post to Facebook" id="submit" />
			<input type="submit" value="Cancel" id="cancel" />
		</div>
	</div>
	<!--
<div id="donate-title">
		<div id="back"><a href="#">Back</a></div>
		<p>Donate Voice</p>
	</div>
-->
	<div id="visible-content">
	<ul id="donatevoice">
		
		<li>
			<div class="donate-box">
				<div id="voice-step-1">
					<h2>See how far your voice can carry</h2>
					<p>A voice is a powerful thing.  A voice can change the world.  All it takes is a champion, a simple idea, and the courage to demand a more ideal world. Don't believe us?  Try it yourself.  See how your voice can be a powerful agent of social good.</p>
					<div id="voice-step-btn" class="voice-btn firstbtn"><a href="#">Connect to Facebook to start</a></div>
				</div>
				<div id="voice-video">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<div id="voice-video-cont">
						<?php echo simple_fields_get_post_value(get_the_id(), array(3, 1), true); ?>
					</div>
					<?php endwhile; endif; ?>
					<p>(CLICK THE VIDEO TO SEE HOW IT WORKS)</p>
				</div>
				<div class="clearfix"></div>
				<div id="voice-extra">
					<h3>How It Works</h3>
					<h4>(Just in case you didn't watch the video)</h4>
					<p>Social media is one of the most powerful tools to create social change.  Imagine if today you send out a call encouraging all your friends to learn about Pencils of Promise and, when they're done, pay it forward and repost the message to all of their friends.<br />  <strong>Simple, right?  Costs nothing. Takes only a second.</strong></p>
					<p><strong>But if everyone did just this small thing... well... <a href="#" class="firstbtn">see for yourself</a>.</strong></p>
				</div>
			</div>
		</li>
		<li>
			<div class="donate-box">
				<h2 id="step-2">Look how far your voice can carry</h2>
				<div class="friends" id="tier1">357</div>
				<div class="friends" id="tier2">35,745</div>
				<div class="friends" id="tier3">357,345</div>
				<div class="friends" id="tier4">3,574,457</div>
			</div>
			<div id="voice-step-2-btn" class="voice-btn"><a href="#">Spread the Word and See Your Voice Carry Further</a></div>
		</li>
		<li>
			<div class="donate-box">
				<h2 id="voice-success">Thank you!</h2>
				<p class="copy-success">To view more ways to get involved, please click the button below.</p>
				<div id="voice-step-btn"><a href="<?php bloginfo('url'); ?>/join-the-movement">More ways to get involved</a></div>
			</div>
		</li>
	</ul>
	</div>
</div>

<!-- Facebook API -->
<div id="fb-root"></div>
<script type="text/javascript">
    window.fbAsyncInit = function() {
        FB.init({appId: '258424570844871', status: true, cookie: true, xfbml: true});

		$('.firstbtn').bind('click', function() {
			FB.login(function(response) {
				if (response.session) {
		             login();
		         }
			}, {perms: 'publish_stream'});
			
			try {
				_gaq.push(['_trackEvent', 'Donate Voice', 'Log In']);
			} catch (err) {}
			
			return false;
		});

	     FB.getLoginStatus(function(response) {
	         if (response.session) {
	             //login();
	         }
	     });
		
    };

    (function() {
        var e = document.createElement('script');
        e.type = 'text/javascript';
        e.src = document.location.protocol +
            '//connect.facebook.net/en_US/all.js';
        e.async = true;
        document.getElementById('fb-root').appendChild(e);
    }());

	function login() {
		FB.api('me/friends', function(response3) {
			var num_friends = response3.data.length;
			var num_friends2 = num_friends*130;
			var num_friends3 = num_friends2*130;
			var num_friends4 = num_friends3*130;
			$('#tier1').text(addCommas(num_friends));
			$('#tier2').text(addCommas(num_friends2));
			$('#tier3').text(addCommas(num_friends3));
			$('#tier4').text(addCommas(num_friends4));
		});
		
		FB.api('/me/friends', {limit: 10}, function(response2) {
	  		for(var i=0; i<response2.data.length; i++) {
				var friend = response2.data[i];
				var friend_id = response2.data[i].id;
				var pic = '<img src="http://graph.facebook.com/'+friend.id+'/picture" alt="Profile pic" />';
			}
			
			$("#donate-voice-video").attr('src', "/blanker.htm");
			donateVoiceSlider();
		});
		
			try {
				_gaq.push(['_trackEvent', 'Display Number of Friends', 'Log In']);
			} catch (err) {}
	}
	
	$('#voice-step-2-btn').click(function() {
		$('html, body').animate({scrollTop: 0}, 500);
		
		var id = $('#fb-message-box');
		var boxY = $(window).height()/2 - ((id.height()/2)+60);
		var boxX = $(window).width()/2 - id.width()/2;
		
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();

		$('#mask').css( {'width': maskWidth, 'height': maskHeight} ).fadeIn(200);
		id.css( {'top': boxY, 'left': boxX} ).fadeIn(200);
		
		try {
			_gaq.push(['_trackEvent', 'Donate Voice', 'Preview Update Status']);
		} catch (err) {}

		$('input#submit').click(function() {
			var textarea = $('#writeyourown textarea').val();

			if(textarea != '') {
				var message = textarea;
			} else {
				var message = "A voice is a powerful thing. A voice can change the world. All it takes is a champion, a simple idea, and the courage to demand a more ideal world. Don't believe us? Try it yourself. See how your voice can be a powerful agent of social good.";
			}
			
			var name = 'Pencils of Promise';
			var picture = '<?php bloginfo('template_directory'); ?>/gfx/facebookPoPThumb.png';
			var link = 'http://www.pencilsofpromise.org/';
		
			FB.api('/me/feed', 'post', {message: message, name: name, picture: picture, link: link}, function(response) {
			 	if (!response || response.error) {
					alert('Error occured: '+response.error);
				} else {
					$('#fb-message-box, #mask').fadeOut(200);
					
					try {
						_gaq.push(['_trackEvent', 'Donate Voice', 'Posted to Facebook']);
					} catch (err) {}
					
				   donateVoiceSlider();
				}
			});

			return false;
		});
		
		$('#mask').click(function() {
			$(this).fadeOut(200);
			$('#fb-message-box').fadeOut(200);
		});
		
		$('#fb-message-box textarea').focus(function() {
			$('input[type=radio]:checked').attr('checked', false);
		});
		
		$('input#cancel').click(function() {
			$('#fb-message-box, #mask').fadeOut(200);
			
			return false;
		});
	});
	
	function donateVoiceSlider() {
		var ul = $('#donatevoice');
		var cur_left = (isNaN(parseInt(ul.css('margin-left')))) ? 0 : parseInt(ul.css('margin-left'));
		var li_width = 980;
		
		ul.animate( {'margin-left': cur_left-li_width+'px'} );
	}
</script>

<?php get_footer(); ?>