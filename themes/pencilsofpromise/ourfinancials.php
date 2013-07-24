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
<div class="aside">
   <script id="gsWidgetScript8832329h1" type="text/javascript">    (function() { function a() { var a = document.createElement("script"); a.type = "text/javascript"; a.async = true; a.src = "http://widgets.guidestar.org/gxseal2?o=8832329&l=h1&async=1"; var b = document.getElementsByTagName("script")[0]; b.parentNode.insertBefore(a, b) } if (window.attachEvent) window.attachEvent("onload", a); else window.addEventListener("load", a, false) })()</script>
   </div> 
	<?php the_content(); ?>  
	<?php endwhile; endif; ?>
   
    
</div>

<?php get_footer(); ?>