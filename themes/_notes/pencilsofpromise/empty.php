<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Empty Template
*/
?>

<?php get_header(); ?>

<div id="generic">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<div class="generic-content">
            
			<?php the_content(); ?>

	<?php endwhile; endif; ?>
    
    <div class="clearfix"></div>
</div>

<?php get_footer(); ?>