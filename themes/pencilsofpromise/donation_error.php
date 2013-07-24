<?php
ob_start();
?>
<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 Template Name: Donation Error
*/
?>

<?php 
	get_header();
	
	if (have_posts()) : while (have_posts()) : the_post();
	?>

<div id="donate-header" style="background: url('<?php bloginfo('template_directory'); ?>/gfx/banner_donate_now.jpg');"></div>        
<div id="confirm-container">
	<h2 id="oops">Oops...</h2>
	<strong>It looks like Pay Pal is having some difficulties. Please try your donation again later.</strong>
</div>

<?php endwhile; endif; get_footer(); ?>
<?php
ob_end_flush();
?>