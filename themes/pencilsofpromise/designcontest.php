<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Design Contest
*/
?>

<?php get_header(); ?>
<ul id="subnav" class="sub-menu">
	<li><a href="<?php bloginfo('url'); ?>/join-the-movement" class="subnav-goback">Back to Join the Movement</a></li>
</ul>
<div id="events">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="paperbg">
		<div id="subheader" class="paper contest">
			<h2><img src="<?php bloginfo('template_directory'); ?>/gfx/donationEventTitle.png" alt="Donation Event" /></h2>
			<span></span>
		</div>
		<div id="event-left">
			<h2><?php the_title(); ?></h2>
			<?php the_content(); ?>
			<a class="moreinfo" style="float: right;" href="<?php echo simple_fields_get_post_value(get_the_id(), array(2, 1), true); ?>">Submit a design</a>
		</div>
		<div id="event-right">
			<div id="event-thumb"><a href="#"><?php the_post_thumbnail('contest-post-thumbnail'); ?></a></div>
		</div>
	</div>
	<?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>