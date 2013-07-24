<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Our Story 1
*/
?>

<?php get_header(); ?>

<div id="whoweare"> 
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div id="story-header"></div>
	<div id="story-content">
		<?php the_content(); ?>
        <a href="http://fundraise.pencilsofpromise.org/fundraise/create?eid=15845" class="gold_button">Create Fundraiser</a>
	</div>
	<div id="story-image">
		<div id="story-image-cont">
			<?php the_post_thumbnail('our-story-image'); ?>
		</div>
	</div>
	<?php endwhile; endif; ?>
</div>	

<?php get_footer(); ?>