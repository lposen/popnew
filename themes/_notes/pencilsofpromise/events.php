<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Events
*/
?>

<?php get_header(); ?>

<div id="events">
	
	<?php 
		if (have_posts()) : while (have_posts()) : the_post(); 
		$thumb_id = get_post_thumbnail_id(get_the_ID());
		$thumb = wp_get_attachment_image_src($thumb_id, 'feature-image-thumb');
	?>
	<div id="introduction" style="background: url('<?php echo $thumb[0]; ?>');">
		<div id="intro-content">
			<?php the_content(); ?>
			<div class="gotobutton1"><a href="<?php echo simple_fields_get_post_value(get_the_id(), array(2, 1), true); ?>">Read more</a></div>
		</div>
		<div class="clearfix"></div>
	</div>
	<?php endwhile; endif; ?>
	<div id="news">
		<h2 class="project-title">Event News</h2>
		<?php
			$event_posts = new WP_Query();
			$event_posts->query('cat=5&posts_per_page=3');
			
			if ($event_posts->have_posts()): while ($event_posts->have_posts()): $event_posts->the_post();
		?>
		<div class="pentry">
			<?php the_post_thumbnail("event-news"); ?>
			<h2><?php the_title(); ?></h2>
				<span><strong>Written by: <?php the_author_posts_link(); ?></strong></span>
				<span><?php the_time("M, d Y"); ?></span>
			<p><?php the_excerpt(); ?></p>
			<a href="<?php the_permalink(); ?>" class="viewall-authors">Read More</a>
			<div class="clearfix"></div>
		</div>
		<hr class="post-divider" />
		<?php endwhile; endif; ?>
		
		<a href="/join-the-movement/events/submit-an-event" class="submitAnEvent"></a>
	</div>
	
	<div id="aside">
		<div id="upcoming">
			<div class="tabs">
				<a href="upcoming" class="active">Upcoming Events</a>
				<a href="local">Local&nbsp; Events</a>
				<a href="archive-events" style="border: none;">Archive</a>
			</div>
			<div class="events">
			<?php
				$upcoming = new Pod('events');
				$upcoming->findRecords('date DESC');
				$upcoming_total = $upcoming->getTotalRows();
				$date_now = time();
				
				if($upcoming_total > 0) : 
					while($upcoming->fetchRecord()) :
						$name = $upcoming->get_field('name');
						$intro = $upcoming->get_field('event_intro');
						$thumb = $upcoming->get_field('thumb_url');
						$thumb_src = wp_get_attachment_image_src($thumb[0]['ID']);
						$purchase = $upcoming->get_field('purchase_url');
						$raw_date = strtotime($upcoming->get_field('date'));
						$date = date('m/d/o', strtotime($upcoming->get_field('date')));
						$type = $upcoming->get_field('event_type');
						if($type == 'local' && ($raw_date >= $date_now)) {
							$class = 'local upcoming';				
						} elseif(($raw_date >= $date_now)) {
							$class = 'upcoming';
						} else {
							$class = 'archive-events';
						}
						?>					
					<div class="event <?php echo $class; ?>">
						<div class="thumb">
							<img src="<?php echo $thumb_src[0]; ?>" alt="<?php echo $name; ?>" />
						</div>
						<h3><?php echo $name; ?> - <?php echo $date; ?></h3>
						<p><?php echo $intro; ?></p>
						<a class="viewall-authors" href="<?php echo $purchase; ?>">More Info</a>
					</div>
			<?php endwhile; endif; ?>
			</div>
			<div id="upcoming-footer"></div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
