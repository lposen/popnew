<?php
ob_start();
?>
<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 Template Name: Donation Thank You
*/
?>
<?php 
    unset($_SESSION['Payment_Amount']);
	get_header();
	
	if (have_posts()) : while (have_posts()) : the_post();
	?>
<!--<div id="donate-header" style="background: url('<?php bloginfo('template_directory'); ?>/gfx/banner_donate_now.jpg');"></div>      -->  
<div class="donate-box">
	<h2 id="voice-success" class="BebasNeue text_gold">Thank you!</h2>
        <iframe width="853" height="480" style=" display: block; margin: 0 auto; "
                src="http://www.youtube.com/embed/QAgHJCeu-mQ?rel=0" frameborder="0" allowfullscreen></iframe>
    <?php
    if ( (isset($_SESSION['do_as_recurring_payments'])) && ($_SESSION['do_as_recurring_payments'] != '') && (isset($_SESSION['paypal'])) ) {
    ?>
    <p class="copy-success">To edit your recurring payment schedule, please login to your PayPal account <a href="https://www.paypal.com/" target="_blank">here</a>.</p>
    <?php
    } 
    ?>
	<p class="copy-success">To view more ways to get involved, please click the button below.</p>
	<div id="thank-you">
	<div id="voice-step-btn-fb">
          <!-- <a href="javascript:void(0);" onClick="streampublish_dialogs();">-->
            <span class='st_twitter_custom' displayText='Tweet' st_url="" st_title=""><img src="<?php bloginfo('template_directory'); ?>/gfx/platform_images/twittericon.png"></span>
            <span class='st_facebook_custom' displayText='Facebook' st_url="" st_title=""><img src="<?php bloginfo('template_directory'); ?>/gfx/platform_images/facebookicon.png"></span>
            <span class='st_email_custom' displayText='Email' st_url="" st_title=""><img src="<?php bloginfo('template_directory'); ?>/gfx/platform_images/email.png"></span>
          <!---  </a> --->
        </div>
	<div id="voice-step-btn"><a href="<?php bloginfo('url'); ?>/join-the-movement">More ways to get involved</a></div>
	</div>
	
	 <!-- <script type="text/javascript" src="http://connect.facebook.net/en_US/all.js"></script>
	<script type="text/javascript">
		window.fbAsyncInit = function() {
			FB.init({
			  appId   : '351184528238204', // should be replaced with your Facebook Application ID
			  status  : true, // check login status
			  cookie  : true, // enable cookies to allow the server to access the session
			  xfbml   : true // parse XFBML
			});
		};
	</script>
	<script type="text/javascript">	
		function streampublish_dialogs()
		{
			FB.ui(
			{
				method: 'feed',
				name: 'Pencils of Promise',
				link: 'http://pencilsofpromise.org/',
				picture: 'http://www.pencilsofpromise.org/wp-content/themes/pencilsofpromise/gfx/whoweareImage3.png',

				description: 'Pencils of Promise partners with local communities to build schools and increase educational opportunities in the developing world. We focus on early education, high potential females and empowering a new generation of passionate young leaders to create profound good.',
				message: 'Please help me advocate Pencils of Promise and build schools in the developing world one pencil at a time.'
				});
		}
	</script>    --->

	
	
    <?php
    if ( (isset($_SESSION['do_as_recurring_payments'])) && ($_SESSION['do_as_recurring_payments'] != '') && (!isset($_SESSION['paypal'])) ) {
    ?>
	<div id="voice-step-btn" style="margin-left: 15px; float: left;"><a class="grey_button p_link" href="<?php bloginfo('url'); ?>/join-the-movement/donation-dashboard">Manage your donations</a></div>
    <?php
    } 
    ?>
    </div>
<?php endwhile; endif; get_footer(); ?>
<?php
ob_end_flush();
?>