<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
?>
		<div class="clearfix"></div>
	</div>
	<div id="footer">
		<div class="aside">
			<p class="search"><a href="#" id="search-button">Search this site</a></p>
			<div class="social">
                            <div class="right" style="width:70px; float:right; margin-top:5px;">
                                <a href="https://plus.google.com/113501606134993950609/posts/?prsrc=3" target="_blank" class="google" style="text-decoration: none;"></a>
                                <a href="http://www.facebook.com/pencilsofpromise" target="_blank" class="facebook"></a>
                                <a href="http://twitter.com/pencilsofpromis" target="_blank" class="twitter"></a>
                                <a href="/contact-us/" class="email"></a>
                            </div>
                            <div class="left" style="width:135px; float:left; margin-top:5px;">How to Keep in Touch:</div>
                        </div>
		</div>
		<?php wp_nav_menu(array('theme_location'=>'footer-nav', 'container'=>'', 'fallback_cb'=>'', 'before'=>'')); ?>
		<div class="tag">
			<img src="<?php bloginfo('template_directory'); ?>/gfx/logo30.png" alt="Pencils of Promise Logo" />
			<p>&copy; 2008 - <?php echo date('Y'); ?><br />
			37 West 28th St. 3rd Fl.<br />
			New York, NY 10001<br />
                        (212) 777-3170<br />
			<a href="/disclosures-notices/">Disclosures/Notices</a><br />
            <a href="<?php bloginfo('url'); ?>/join-the-movement/donation-dashboard" id="managedonate">Manage My Donations</a>
            </p>
		</div>
		<div class="tl"></div>
		<div class="tr"></div>
		<div class="bl"></div>
		<div class="br"></div>
		<div class="clearfix"></div>
	</div>
</div>
<div id="search-box">
	<div id="search-box-close">X</div>
	<form method="get" action="<?php bloginfo('url'); ?>">
		<input type="text" size="18" value="" name="s" id="search-input" />
		<input type="submit" value="" id="search-submit" />
	</form>
</div>

<?php /* 
<div id="sorry-box">
	<div id="sorry-box-close">X</div>
	<p>Hi, we noticed you are trying to donate $<span></span>. Our online processing system does not allow us to process such a high amount. Please contact Mimi at 1-646-801-8232 to complete this donation. Thank-you.</p>
</div>  */ ?>
		<?php wp_footer(); ?>
		<!-- <?php printf('%d queries. %s seconds.', get_num_queries(), timer_stop(0, 3)); ?> -->
		<script type="text/javascript"> Cufon.now(); /* addthis.button('#share-button'); */ </script>
</body>
</html>