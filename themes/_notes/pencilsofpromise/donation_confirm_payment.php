<?php
ob_start();
?>
<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 Template Name: Confirm Express Donation
*/
?>
<?php 
	get_header();
	
	if (have_posts()) : while (have_posts()) : the_post();
	?>
<div id="donate-header" style="background: url('<?php bloginfo('template_directory'); ?>/gfx/banner_donate_now.jpg');"></div>        

<?php do_action('pp_confirm_payment_form') ?>

<?php endwhile; endif; get_footer(); ?>
<?php
ob_end_flush();
?>