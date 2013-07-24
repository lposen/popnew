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
	<img src="http://www.pencilsofpromise.org/wp-content/uploads/2012/12/Thank-You-«-Pencils-of-Promise_03.png" >
        <iframe width="560" height="315" style=" display: block; margin: 0 auto;" src="http://www.youtube.com/embed/QAgHJCeu-mQ?rel=0" frameborder="0" allowfullscreen></iframe>
    <?php
    if ( (isset($_SESSION['do_as_recurring_payments'])) && ($_SESSION['do_as_recurring_payments'] != '') && (isset($_SESSION['paypal'])) ) {
    ?>
    <p class="copy-success">To edit your recurring payment schedule, please login to your PayPal account <a href="https://www.paypal.com/" target="_blank">here</a>.</p>
    <?php
    } 
    ?>
        	<div id="matching">
        	<h2>Will my company match my gift?</h2>
        
        <div id="hep">
        	<div class="text">
            <div>
            <span>Run a search for your company</span><span class="arrow-right"></span><br>
            </div>
            
            <p>If your company appears in the search results, then they will match your gift!</p><br>
            <p>Ask your company for their gift-matching form, fill it out and send it to:</p><br>
            <p>Pencils of Promise<br>
            37 West 28th St. 3rd Fl.<br>
			New York, NY 10001
            </p>
            
            </div>
            <div class="iframe">
            	
            	<iframe src="http://www1.matchinggifts.com/pencilsofpromise_iframe/" width="400" height="400" scrolling="auto" frameborder="0"></iframe>
            </div> 
            
            </div>
		</div>
	
	<div id="thank-you">
    <div id="voice-step-btn"><a href="<?php bloginfo('url'); ?>/join-the-movement">More ways to get involved</a></div>
	<?php /*<div id="voice-step-btn-fb">
          <!-- <a href="javascript:void(0);" onClick="streampublish_dialogs();">-->
            <span class='st_twitter_custom' displayText='Tweet' st_url="" st_title=""><img src="<?php bloginfo('template_directory'); ?>/gfx/platform_images/twittericon.png"></span>
            <span class='st_facebook_custom' displayText='Facebook' st_url="" st_title=""><img src="<?php bloginfo('template_directory'); ?>/gfx/platform_images/facebookicon.png"></span>
            <span class='st_email_custom' displayText='Email' st_url="" st_title=""><img src="<?php bloginfo('template_directory'); ?>/gfx/platform_images/email.png"></span>
          <!---  </a> --->
        </div> */ ?>
	
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
<!-- Google Code for Donation Conversion Page -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-10494909-1']);
  _gaq.push(['_trackPageview']);
  _gaq.push(['_addTrans',
    '<?php echo $profileId; ?>',           // transaction ID - required
	'',
    '<?php echo $amount; ?>',          // total - required
	'',
	'',
    '<?php echo htmlSafe($city); ?>',       // city
    '<?php echo htmlSafe($state); ?>',     // state or province
    '<?php echo htmlSafe($country); ?>'            // country
  ]);

   // add item might be called for every item in the shopping cart
   // where your ecommerce engine loops through each item in the cart and
   // prints out _addItem for each
  _gaq.push(['_addItem',
    '<?php echo $profileId; ?>',           // transaction ID - required
    'DD44',           // SKU/code - required
	'Donate',        // product name
	'',
    '<?php echo $amount; ?>',          // unit price - required
    '1'               // quantity - required
  ]);
  _gaq.push(['_trackTrans']); //submits transaction to the Analytics servers

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<!-- Google Code for test Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1013448764;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "41G2CJSA8AQQvICg4wM";
var google_conversion_value = <?php echo $pp_amount; ?>;
/* ]]> */
</script>
<script type="text/javascript" src="https://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="https://www.googleadservices.com/pagead/conversion/1013448764/?value=%3C?php%20echo%20$pp_amount;%20?%3E&amp;label=41G2CJSA8AQQvICg4wM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<?php endwhile; endif; get_footer(); ?>
<?php
ob_end_flush();
?>