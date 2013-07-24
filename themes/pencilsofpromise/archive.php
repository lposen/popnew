<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>
<div id="subheader" class="orange author-subheader">
	<?php /* If this is a category archive */ if (is_category()) { ?>
	<h2><strong><?php printf('Archive for the &#8216;%s&#8217; Category', single_cat_title('', false)); ?></strong></h2>
	<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
	<h2><strong>Posts Tagged</strong> &ldquo;<?php echo single_tag_title('', false); ?>&rdquo;</h2>
	<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
	<h2><strong><?php printf('Archive for %s|Daily archive page', get_the_time('F jS, Y')); ?></strong></h2>
	<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
	<h2><strong><?php printf('Archive for %s|Monthly archive page', get_the_time('F, Y')); ?></strong></h2>
	<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
	<h2><strong><?php printf('Archive for %s|Yearly archive page', get_the_time('Y')); ?></strong></h2>
	<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
	<h2>Blog Archives</h2>
	<?php } ?>
</div>
<div id="whoweare">
	<div id="ourblog">

		<?php if (have_posts()) : ?>

 	  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

		<?php while (have_posts()) : the_post(); ?>
		<div class="entry" <?php post_class(); ?>>
			<?php the_post_thumbnail(); ?>
			<h2><?php the_title(); ?></h2>
			<span><strong>Written by: <?php the_author_link(); ?></strong> <span class="date"><?php the_time('F jS, Y'); ?></span></span>
			<?php the_excerpt(); ?>
			<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			<div class="entry-footer">
				<div class="readmore"><a href="<?php the_permalink(); ?>">Read more</a></div>
			</div>
		</div>
		<hr class="post-divider" />
		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries'); ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;'); ?></div>
		</div>
	<?php else :

		if ( is_category() ) { // If this is a category archive
			printf("<h2 class='center'>Sorry, but there aren't any posts in the %s category yet.</h2>", single_cat_title('',false));
		} else if ( is_date() ) { // If this is a date archive
			echo("<h2>Sorry, but there aren't any posts with this date.</h2>");
		} else if ( is_author() ) { // If this is a category archive
			$userdata = get_userdatabylogin(get_query_var('author_name'));
			printf("<h2 class='center'>Sorry, but there aren't any posts by %s yet.</h2>", $userdata->display_name);
		} else {
			echo("<h2 class='center'>No posts found.</h2>");
		}
	  get_search_form();
	endif;
?>

	</div>
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
