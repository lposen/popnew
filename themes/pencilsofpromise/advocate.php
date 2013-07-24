<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Advocate
*/
?>

<?php get_header(); ?>
<div id="events">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="paperbg">
		<div id="subheader" class="paper contest">
			<h2><?php echo wp_get_attachment_image(simple_fields_get_post_value(get_the_id(), 'Page Header Image', true), 'full'); ?></h2>
			<span></span>
		</div>
		<div id="event-left">
			<?php the_content(); ?>
			<div id="toolkits">
            <?php $attachments = new Attachments( 'attachments' ); ?>
			<?php if( $attachments->exist() ) : ?>
				<h3>Download Our Toolkits</h3>
				<ul style="margin-bottom:10px;">
				<?php /*
					$att = attachments_get_attachments();
					$i = 1;
					if(count($att) > 0) {
						foreach($att as $attachment) {
							if($i == (floor((count($att))/2))) {
								echo '</ul><ul style="margin-bottom:10px;">';
							}
								
							echo '<li><a href="' . $attachment['location'] . '">' . $attachment['title'] . '</a></li>';
							$i++;
						}
					}
				?>
				</ul> */ ?>
    <?php while( $attachments->get() ) : ?>
      <li>
        <a href="<?php echo $attachments->url(); ?>"><?php echo $attachments->display( 'title' ); ?></a>
      </li>
    <?php endwhile; ?>
  </ul>
<?php endif; ?>
			</div>
		</div>
		<div id="event-right">
			<div id="event-thumb"><a href="#"><?php the_post_thumbnail('contest-post-thumbnail'); ?></a></div>
		</div>
	</div>
	<?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>