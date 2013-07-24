<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
 /*
	Template Name: Page with custom header
*/


get_header(); ?>
	<div id="generic" class="nosidebar">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
                        <div id="subheader">
                                <h2 style="margin:15px 0 0 15px; "><?php echo wp_get_attachment_image(simple_fields_get_post_value(get_the_id(), 'Page Header Image', true), 'full'); ?></h2>
                        </div>                  
			<div class="generic-content">
				<div class="entry">
					<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
	
					<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
	
				</div>
			</div>
		</div>
		<?php endwhile; endif; ?>
		<div class="generic-content">
		<?php //edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
		
		<?php comments_template(); ?>
		</div>
	</div>
<?php get_footer(); ?>
