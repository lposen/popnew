<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Form Thank You
*/
?>

<?php get_header(); ?>

<div id="movement" class="submitHeader">
	<div id="join-content">
		<!--
<div id="subheader" class="paper team">
			<h2>
				<img src="<?php bloginfo('template_directory'); ?>/gfx/formThankYou.png" alt="Submit an Event" />
				<span></span>
			</h2>
		</div>
-->
		<div class="paperbg" id="form-thanks">
		<div class="donate-container" id="thankyou"> 
			<h2>Thank you for contacting us!</h2>  
			<p>We will get in touch with you shortly. In the meantime, here are some other ways you can get involved with the PoP Movement.</p> 
			<div id="thankyou-cont"> 
				<div class="thankyou-box" style="margin: 0;"> 
					Donate Money
					<a href="<?php bloginfo('url'); ?>/join-the-movement/donate" class="gotop tygoto"></a> 
				</div> 
				<div class="thankyou-box"> 
					Download Toolkit 
					<a href="<?php bloginfo('url'); ?>/join-the-movement/advocacy" class="gotop tygoto"></a> 
				</div> 
				<div class="thankyou-box"> 
					Share with friends 
					<a href="<?php bloginfo('url'); ?>/join-the-movement/donate-voice" class="gotop tygoto"></a> 
				</div> 
			</div> 
		</div> 
		</div>
	</div>
</div>
<?php get_footer(); ?>