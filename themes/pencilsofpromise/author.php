<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>

<?php
	if(get_query_var('author_name')) :
	    $curauth = get_user_by('slug', get_query_var('author_name'));
	else :
	    $curauth = get_userdata(get_query_var('author'));
	endif;
	$temp = $wp_query;
	$wp_query = null;
	$wp_query = new WP_Query();
	$wp_query->query('posts_per_page=2&author='.$curauth->ID.'&paged='.$paged);
?>

<?php if ($wp_query->have_posts()) : ?>
<div id="subheader" class="orange author-subheader">
	<h2><strong>Listing Posts Written by</strong> <?php echo $curauth->first_name . ' ' . $curauth->last_name; ?></h2>
	<span></span>
</div>
<div id="whoweare">
	<div id="ourblog">
 	  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
		<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

		<div class="entry" <?php post_class(); ?>>
			<?php the_post_thumbnail(); ?>
			<h2><?php the_title(); ?></h2>
			<span><strong>Written by: <?php the_author_link(); ?></strong></span>
			<span><?php the_time("M, d Y"); ?></span>
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
	<?php else :?>
	<div id="subheader" class="orange author-subheader">
	<h2>Listing Posts Written by <?php echo $curauth->first_name . ' ' . $curauth->last_name; ?></h2>
		<span></span>
	</div>
	<div id="whoweare">
		<div id="ourblog">
		<?
	  		get_search_form();
	  	?>
	  	<img src="<?php bloginfo('template_directory'); ?>/gfx/emptyAuthorsImg.jpg" alt="Your search didn't return any results" id="empty" />
	  </div>
	  </div>
	<?php endif; ?>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
