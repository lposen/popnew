<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Photo Gallery
*/
?>

<?php get_header(); ?>

<div id="whoweare">
	<?php
		if (have_posts()) : while (have_posts()) : the_post();
		$thumb_id = get_post_thumbnail_id(get_the_ID());
		$thumb = wp_get_attachment_image_src($thumb_id, 'feature-image-thumb');
	?>
	<div id="special-sub-header" style="background: url('<?php bloginfo('template_directory'); ?>/gfx/mgpage_banner.png');"></div>
	<div id="photo-album-gallery" style="height:2200px;">
<div class="album">
    <?php the_content(); ?>
</div>
	<?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>