<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Our Blog
*/
?>

<?php get_header(); ?>

<div id="whoweare">
	<div id="ourblog">
		<?php
			$temp = $wp_query;
			$wp_query = null;
			$wp_query = new WP_Query();
			$wp_query->query('cat=-148&posts_per_page=4&paged='.$paged);
		?>
		<?php if ($wp_query->have_posts()) : while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
			<div class="entry" id="post-<?php the_ID(); ?>">
				<?php the_post_thumbnail(); ?>
				<h2><?php the_title(); ?></h2>
				<span><strong>Written by: <?php the_author_link(); ?></strong> <span class="date"><?php the_time('F jS, Y'); ?></span></span>
				<?php the_excerpt(); ?>
				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
				<div class="entry-footer">
					<a class="gotoLink" href="<?php the_permalink(); ?>">Read more</a>
				</div>
			</div>
			<hr class="post-divider" />
		<?php endwhile; ?>
			<div id="pagination">
				<div class="readmore pagelonger goright"><?php previous_posts_link('Newer Articles'); ?></div>
				<div class="readmore pagelonger goleft"><?php next_posts_link('Older Articles'); ?></div>
			</div>
			<?php $wp_query = null; $wp_query = $temp;?>
		<?php endif; ?>
	</div>
    
</div>

<?php get_footer(); ?>