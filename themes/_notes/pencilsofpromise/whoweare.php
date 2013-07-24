<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Who We Are
*/
?>

<?php get_header(); ?>

<div id="whoweare">
	<?php 
		if (have_posts()) : while (have_posts()) : the_post(); 
		$thumb_id = get_post_thumbnail_id(get_the_ID());
		$thumb = wp_get_attachment_image_src($thumb_id, 'feature-image-thumb');	
	?>
	<div id="introduction" style="background: url('<?php echo $thumb[0]; ?>');">
		<div id="intro-content">
			<?php the_content(); ?>
		</div>
	</div>
	<?php endwhile; endif; ?>
	<div id="paper-content">
		<div id="sections">
			<div class="section" id="our-story"><a href="<?php bloginfo('url'); ?>/who-we-are/our-story"></a></div>
			<div class="section" id="our-people"><a href="<?php bloginfo('url'); ?>/who-we-are/our-people"></a></div>
                        <div class="section" id="our-blog"><a href="<?php bloginfo('url'); ?>/our-blog"></a></div>
			<div class="section" id="our-approach"><a href="<?php bloginfo('url'); ?>/our-approach"></a></div>
			<div class="section" id="our-partners"><a href="<?php bloginfo('url'); ?>/who-we-are/our-partners"></a></div>
                        <div class="section" id="our-financials"><a href="<?php bloginfo('url'); ?>/who-we-are/our-financials"></a></div>
                        <div class="clearfix"></div>
		</div>
	</div>
        <div class="clearfix"></div>
	<h2 id="progress-header">Our progress so far</h2>
	<div id="progress">
		<div class="progress-cont" style="margin: 0">
			<img src="<?php bloginfo('template_directory'); ?>/gfx/whoweare1.png" alt="" />
		</div>
		<div class="progress-cont">
			<img src="<?php bloginfo('template_directory'); ?>/gfx/whoweare2.png" alt="" />
		</div>
		<div id="progress-promotion">
			<img src="<?php bloginfo('template_directory'); ?>/gfx/whoweare3.png" alt="" />
		</div>
	</div>
</div>

<?php get_footer(); ?>
