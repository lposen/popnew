<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Our Blog5
*/
?>

<?php get_header(); ?>

<div id="whoweare">
	<div id="ourblog">
            <?php global $more;    // Declare global $more (before the loop). ?>
            <?php query_posts('&cat=-148&posts_per_page=4&paged='.$paged); ?>
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div class="entry" id="post-<?php the_ID(); ?>">
				<?php the_post_thumbnail(); ?>
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				<span><strong><?php the_author_link(); ?></strong> <span class="date"><?php the_time('F jS, Y'); ?></span></span>
				<?php 
                                $more = 0;       // Set (inside the loop) to display content above the more tag.
                                the_content('read more...'); ?>
								<div id="posts"><?php wp_related_posts()?>
                                </div>
				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
              
				<?php /*<div class="entry-footer">
					<a class="gotoLink" href="<?php the_permalink(); ?>">Read more</a>
				</div>*/ ?>
			</div>
			<hr class="post-divider" />
		<?php endwhile; ?>
			<div id="pagination">
				<div class="readmore pagelonger goright"><?php previous_posts_link('Newer Articles'); ?></div>
				<div class="readmore pagelonger goleft"><?php next_posts_link('Older Articles'); ?></div>
			</div>
		<?php endif; ?>
	</div>
    
</div>

<?php get_footer(); ?>