<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Join the Team3
*/
?>

<?php get_header(); ?>

<div id="movement">
	<?php 
		if (have_posts()) : while (have_posts()) : the_post(); 
		$thumb_id = get_post_thumbnail_id(get_the_ID());
		$thumb = wp_get_attachment_image_src($thumb_id, 'feature-image-thumb');	
	?>
	<div id="introduction" class="join" style="background: url('<?php echo $thumb[0]; ?>');">
		<div id="intro-content">
			<?php the_content(); ?>
		</div>
		<div class="clearfix"></div>
	</div>
	<?php endwhile; endif; ?>
	<div id="join-content">
		<div id="join-form">
			<div id="subheader" class="paper team">
				<h2>
					<img src="<?php bloginfo('template_directory'); ?>/gfx/joinTeamTitle.png" alt="Join the team" />
					<span></span>
				</h2>
			</div><a class="gold_button" href="<?php bloginfo('url'); ?>/join-the-movement/donate">Donate</a>
			<?php gravity_form(12, false, false); ?>
		</div>
		<div id="aside">
			<?php
			global $wp_query;
			$post_id = $wp_query->post->ID;
			$banners = simple_fields_get_post_group_values($post_id, 5, false, 2);
			//echo print_r($banners);
			foreach ($banners as $banner) {
				echo '<a href="'.$banner[2].'">'. wp_get_attachment_image($banner[1], "full") .'</a>';
			}
			?>
		</div>
	</div>
</div>
<?php get_footer(); ?>