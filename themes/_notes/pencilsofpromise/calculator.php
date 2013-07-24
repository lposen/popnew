<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Donation Calculator
*/
?>

<?php get_header(); ?>

<div id="movement">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<p id="calc-intro">Introduction copy for the donation calculator</p>
	<div id="calc-slider">
		<div class="slider-box"><strong>Donation Calculator</strong></div>
		<div id="slider"></div>
		<span id="equals">=</span>
		<div class="slider-box"><span>14</span></div>
		<div class="slider-box">Textbook Image</div>
		<div id="donatenow"><a href="#">Donate Now</a></div>
	</div>
	<div id="proceeds">
		<div id="proceeds-img">
			<?php the_post_thumbnail(); ?>
		</div>
		<?php the_content(); ?>
	</div>
	<?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>