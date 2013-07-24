<?php
ob_start();
?>
<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 Template Name: Mobile Thank You
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
        <p class="copy-success" style="margin-top: -5px;">for signing up for the Schools4All mobile list</p>
	
	<div id="thank-you">
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