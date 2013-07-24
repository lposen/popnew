<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Projects Filter
*/
?>

<?php get_header(); ?>

<div id="projects">
	<?php 
		if (have_posts()) : while (have_posts()) : the_post(); 
		$thumb_id = get_post_thumbnail_id(get_the_ID());
		$thumb = wp_get_attachment_image_src($thumb_id, 'feature-image-thumb');
	?>
	<div id="introduction" style="background: url('<?php echo $thumb[0]; ?>')">
		<div id="intro-content">
			<?php the_content(); ?>
		</div>
		<div class="clearfix"></div>
	</div>
	<?php endwhile; endif; ?>
	
	<div id="paper-content-projects">
		<div class="tile">
			<a href="/our-projects/established" class="<?php if(is_page('Completed Schools')) echo 'active'; ?>">
				<h3><?php echo countProjects('Completed Schools', false); ?></h3>
				<img src="<?php bloginfo('template_directory'); ?>/gfx/projectsEstablished.png" alt="Completed Schools" />
				<span class="gotoProject"></span>
			</a>
		</div>
		<div class="tile middle">
			<a href="/our-projects/current" class="<?php if(is_page('Ongoing Builds')) echo 'active'; ?>">
				<h3><?php echo countProjects('Ongoing Builds', false); ?></h3>
				<img src="<?php bloginfo('template_directory'); ?>/gfx/projectsCurrent.png" alt="Ongoing Builds" />
				<span class="gotoProject"></span>
			</a>
		</div>
		<div class="tile">
			<a href="/our-projects/upcoming" class="<?php if(is_page('Upcoming Builds')) echo 'active'; ?>">
				<h3><?php echo countProjects('Upcoming Builds', false); ?></h3>
				<img src="<?php bloginfo('template_directory'); ?>/gfx/projectsUpcoming.png" alt="Upcoming Builds" />
				<span class="gotoProject"></span>
			</a>
		</div>
	</div>
	<div id="items">
		<?php
			global $wp_query, $post;
			$pages_query = new WP_Query();
		    $all_pages = $pages_query->query(array('post_type' => 'page', 'posts_per_page' => -1));
			$page_id = $post->ID;
			$projects = get_page_children($page_id, $all_pages);
			$i = 1;
			foreach($projects as $project) :
				$cat = simple_fields_get_post_value($project->ID, array(1, 6), true);
			?>
			<div class="item <?php if($i%2 == 0) echo 'dark'; ?>">
				<a href="<?php echo get_permalink($project->ID); ?>">
					<?php echo get_the_post_thumbnail($project->ID, 'project-small-thumbnail'); ?>
					<div class="item-info">
						<span class="gotoProject"></span>
						<p><strong><?php echo $project->post_title; ?></strong></p>
						<p><?php echo truncate($project->post_content, 25); ?></p>
					</div>
				</a>
			</div>
		<?php $i++; endforeach; ?>
		<div class="clearfix"></div>
	</div>
	
</div>

<?php get_footer(); ?>
