<?php
ob_start();

/**
 * @package WordPress
 * @subpackage Default_Theme
 Template Name: Donation Choose Payment
*/

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
	     

<?php
	do_action('pp_choose_payment_form'); 
	
	endwhile; 
	endif;

	get_footer();

	ob_end_flush();
?>