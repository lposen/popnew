<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Media and Press
*/
?>

<?php get_header(); ?>

<div id="gallery">
	<?php 
		if (have_posts()) : while (have_posts()) : the_post(); 
		$thumb_id = get_post_thumbnail_id(get_the_ID());
		$thumb = wp_get_attachment_image_src($thumb_id, 'feature-image-thumb');	
	?>
	<div id="introduction" style="background: url('<?php echo $thumb[0]; ?>');">
            <div style="position:absolute;">
            <div class="overlay-video">
                <a href="/" id="launch-video" class="launch-video"></a>
            </div>      
		<div id="intro-content">
			<?php the_content(); ?>
		</div>
            </div>
	</div>
	<div id="gallery-items">
		<div id="paper-content">
			<div id="photos" class="gallery"><a href="/media-gallery/photo"></a></div>
			<div id="videos" class="gallery"><a href="/media-gallery/video"></a></div>
                        <div id="press" class="gallery"><a href="/media-gallery/press"></a></div>
			<div id="downloads" class="gallery"><a href="/media-gallery/downloads"></a></div>
                        <div id="blog" class="gallery"><a href="/our-blog"></a></div>		
                        <div id="annual" class="gallery"><a href="/wp-content/uploads/2010/09/Pencils-of-Promise-2011-Annual-Report.pdf"></a></div>		
                </div>
	</div>
	<?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>