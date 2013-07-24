<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Our Financials
*/
?>

<?php get_header(); ?>

<div id="finance">
	<?php 
		if (have_posts()) : while (have_posts()) : the_post(); 
		$thumb_id = get_post_thumbnail_id(get_the_ID());
		$thumb = wp_get_attachment_image_src($thumb_id, 'feature-image-thumb');
	?>
<div id="introduction">
		<img width="990" alt="" src="<?php bloginfo('template_directory'); ?>/gfx/headerOurFinancials.png">
</div>  

	<?php the_content(); ?>  
	<?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>