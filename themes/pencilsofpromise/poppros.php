<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: PoPPro
*/
?>

<?php get_header(); ?>
<div id="events">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="paperbg">
		<div id="subheader" class="paper contest">
			<h2><img src="<?php bloginfo('template_directory'); ?>/gfx/pageProsTitle.png" alt="Donation Event" /></h2>
		  <span></span>
		</div>
		<div id="event-left">
			<?php the_content(); ?>
			<div id="toolkits">
            	<?php $attachments = new Attachments( 'attachments' ); ?>
				<?php if( $attachments->exist() ) : ?>
				<h3>Download the PoP Pro Toolkits</h3>
				<ul>
				<?php /*
					$att = attachments_get_attachments();
					$i = 1;
					if(count($att) > 0) {
						foreach($att as $attachment) {
							if($i == 8) {
								echo '</ul><ul>';
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