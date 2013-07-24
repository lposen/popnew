<?php
ob_start();

/**
 * @package WordPress
 * @subpackage Default_Theme
 Template Name: Donation Choose Payment
*/
?>
<!-- Google Analytics Content Experiment code -->
<script>function utmx_section(){}function utmx(){}(function(){var
k='21145547-6',d=document,l=d.location,c=d.cookie;
if(l.search.indexOf('utm_expid='+k)>0)return;
function f(n){if(c){var i=c.indexOf(n+'=');if(i>-1){var j=c.
indexOf(';',i);return escape(c.substring(i+n.length+1,j<0?c.
length:j))}}}var x=f('__utmx'),xx=f('__utmxx'),h=l.hash;d.write(
'<sc'+'ript src="'+'http'+(l.protocol=='https:'?'s://ssl':
'://www')+'.google-analytics.com/ga_exp.js?'+'utmxkey='+k+
'&utmx='+(x?x:'')+'&utmxx='+(xx?xx:'')+'&utmxtime='+new Date().
valueOf()+(h?'&utmxhash='+escape(h.substr(1)):'')+
'" type="text/javascript" charset="utf-8"><\/sc'+'ript>')})();
</script><script>utmx('url','A/B');</script>
<!-- End of Google Analytics Content Experiment code -->


<?php
	get_header(); 
	
	if (have_posts()) : while (have_posts()) : the_post();
	?>
    <script type="text/javascript">
		$(function() {
			initDonate(1);
			
			<?php if (isset($_REQUEST['for'])) : ?>
			//$('#get_updates').val('<?php echo $_REQUEST['for']; ?>');
			<?php endif; ?>
		});
	</script>

    <img src="<?php bloginfo('template_directory'); ?>/gfx/donate/seasonsofpromise_donate.jpg" style="margin-bottom: 15px;">
    <img src="<?php bloginfo('template_directory'); ?>/gfx/donate/seasonofpromises_underline.png">
    <p style="color: #919191; font-size: 12px; text-align:center;">100% of your online donation goes directly to our programs on the ground.</p>
    	
        <div id="content">
	<script type="text/javascript">
		$(function() {
			initDonate(1);
			
					});
	</script>
        
        <?php
	do_action('pp_choose_payment_form'); 
	?>
    <img src="<?php bloginfo('template_directory'); ?>/gfx/donate/seasonofpromises_ribbon.png" style=" width: 700px; margin: 15px auto 65px auto; display: block;">
    <?php 
	endwhile; 
	endif;

	get_footer();

	ob_end_flush();
?>
 