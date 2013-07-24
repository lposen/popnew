<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>
<div id="subheader" class="orange author-subheader">
	<h2><strong>The Following Articles Match Your Search Query:</strong> &ldquo;<?php echo $_GET['s']; ?>&rdquo;</h2>
	<span></span>
</div>
<div id="whoweare">
	<div id="ourblog">
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
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

	<?php else : ?>
		<?php get_search_form(); ?>
		<img src="<?php bloginfo('template_directory'); ?>/gfx/emptySearchImg.jpg" alt="Your search didn't return any results" id="empty" />

	<?php endif; ?>
	</div>
</div>

<?php get_footer(); ?>
