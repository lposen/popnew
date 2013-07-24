<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Our Story2
*/
?>

<?php get_header(); ?>

<div id="whoweare"> 
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div id="story-header"></div>
	<div id="story-content">
		<?php the_content(); ?>
        <a href="<?php bloginfo('url'); ?>/join-the-movement/donate" class="gold_button">Donate</a>
	</div>
	<div id="story-image">
		<div id="story-image-cont">
			<?php the_post_thumbnail('our-story-image'); ?>
		</div>
	</div>
	<?php endwhile; endif; ?>
</div>	

<?php get_footer(); ?>