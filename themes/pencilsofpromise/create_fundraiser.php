<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Create Fundraiser
*/
?>

<?php get_header(); ?>

<div id="create">
	<?php 
		if (have_posts()) : while (have_posts()) : the_post(); 
		$thumb_id = get_post_thumbnail_id(get_the_ID());
		$thumb = wp_get_attachment_image_src($thumb_id, 'feature-image-thumb');	
	?>
	<div id="introduction" style="background: url('<?php echo $thumb[0]; ?>');">   
            <div style="position:absolute">
            				<a href="<?php echo simple_fields_get_post_value(get_the_id(), 'Create url', true); ?>" id="createbox" class="bottomBox" style="margin-right:10px;">
					<div id="fundraiseBoxImg"></div>
					<p style="padding-top:26px;">Get Started</p>
					</a>
            
					<a href="<?php echo simple_fields_get_post_value(get_the_id(), 'Login url', true); ?>" id="loginbox" class="bottomBox">
						<div id="loginBoxImg"></div>
						<p style="padding-top:26px;">Log in</p>
					</a>                                        
            
            </div>
        </div>
	<div class="generic-content">
            <?php the_content(); ?>
	</div>
	<?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>