<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header();
?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<!--<div class="navigation">
			<div class="alignleft"><?php previous_post_link( '%link', '&laquo; %title' ) ?></div>
			<div class="alignright"><?php next_post_link( '%link', '%title &raquo;' ) ?></div>
		</div>-->
	
	<div id="blog_single">
	<div id="ourblog">
	<div class="entry">
 
		<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
			<h2><?php the_title(); ?></h2>
			<span><strong><?php the_author_link(); ?></strong> <span class="date"><?php the_time('F jS, Y'); ?></span></span>
			<!--<?php the_post_thumbnail('blog-thumbnail'); ?>-->
			<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
			<div class="clearfix"></div>
			<?php do_action( 'addthis_widget' ); ?>
			<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			<a class="gold_button" href="<?php bloginfo('url'); ?>/join-the-movement/donate">Donate</a>
			<?php the_tags( '<p>Tags: ', ', ', '</p>'); ?>
			</div>
		</div>
        <div id="posts" class="single">
        	<?php wp_related_posts()?>
        </div>
       
       <div class="clearfix"></div>
		<hr class="post-divider" />
			<div id="comments" class="odd">
				<?php comments_template(); ?>
			</div>
		</div>
		<?php get_sidebar(); ?>
		</div>

	<?php endwhile; else: ?>

		<p>Sorry, no posts matched your criteria.</p>

<?php endif; ?>

<?php get_footer(); ?>
