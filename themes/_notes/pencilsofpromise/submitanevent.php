<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Submit an Event
*/
?>

<?php get_header(); ?>

<div id="movement" class="submitHeader">
	<?php 
		if (have_posts()) : while (have_posts()) : the_post(); 
		$thumb_id = get_post_thumbnail_id(get_the_ID());
		$thumb = wp_get_attachment_image_src($thumb_id, 'feature-image-thumb');	
	?>
	<div id="introduction" class="join" style="background: url('<?php echo $thumb[0]; ?>'); background-position: 0 -100px;">
		<div id="intro-content">
			<h2>Got a great idea?<br /> <span>Want to host your own event?</span></h2>
			<p>We’re glad to hear it! Use the form below to let us know and we’ll post it on the site.<br/>If you need help, send us a note or check out some of our downloadable toolkits.<br/>They’ll have pointers to get you started.</p>
		</div>
		<div class="clearfix"></div>
	</div>
	<?php endwhile; endif; ?>
	<div id="join-content">
		<div id="join-form">
			<div id="subheader" class="paper team">
				<h2>
					<img src="<?php bloginfo('template_directory'); ?>/gfx/submitEventTitle.jpg" alt="Submit an Event" />
					<span></span>
				</h2>
			</div>
			<?php gravity_form(2, false, false); ?>
		</div>
		<div id="aside">
			<?php
			global $wp_query;
			$post_id = $wp_query->post->ID;
			$banners = simple_fields_get_post_group_values($post_id, 5, false, 2);
			foreach ($banners as $banner) {
				echo '<a href="'.$banner[2].'">'. wp_get_attachment_image($banner[1], "full") .'</a>';
			}
			?>
		</div>
	</div>
</div>
<?php get_footer(); ?>