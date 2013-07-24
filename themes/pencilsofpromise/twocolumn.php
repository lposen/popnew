<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Two column
*/
?>

<?php get_header(); ?>

<div id="whoweare">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div id="twocol-header-box">
			<div id="twocol-info">
				<h2><?php the_title(); ?></h2>
				<p><?php the_excerpt(); ?></p>
				<!--<p style="margin: 20px 0 0 20px">Call to action or links if necessary</p>-->
			</div>
			<div id="twocol-image">
				<?php the_post_thumbnail(); ?>
			</div>
		</div>
		<div id="twocol-content">
			<h2><?php the_title(); ?></h2>
			<?php the_content(); ?>
		</div>
	<?php endwhile; endif; ?>
	
	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>