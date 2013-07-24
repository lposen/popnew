<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Media and Press Gallery
*/
?>

<?php get_header(); ?>

<div id="media-subpage">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php if(is_page('Photo Gallery')) { ?>
                    <img width="990" alt="" src="<?php bloginfo('template_directory'); ?>/gfx/headerPhoto.png">
        <?php } else if(is_page('Video Gallery')) { ?>
               <img width="990" alt="" src="<?php bloginfo('template_directory'); ?>/gfx/headerVideo.png">     
        <?php } else { ?>
            <div id="subheader" class="paper contest" style="margin: 0;">
                <h2><?php echo wp_get_attachment_image(simple_fields_query_posts(get_the_id(), 'Title image name', true), 'approach-image-crop'); ?></h2>
                <span></span>
                <p>Pencils of Promise builds schools in the developing world and trains young leaders to take action at home and abroad.</p>
            </div>
        <?php } ?>
	<div class="generic-content">
            <div class="gallery-content">
            
		<?php the_content(); ?>
        <?php if(is_page('Photo Gallery')) { ?>
                <a href="/media-gallery/photo/fullscreen" target="_blank"><img width="915" alt="" src="<?php bloginfo('template_directory'); ?>/gfx/photoGalleryLaunch.png"></a>
            
        
        <?php } else if(is_page('Press')) { ?>
                <div id="press-links">
	<?php
		$links = pods('logo_link');
		$links->find('display_order ASC', -1, '');
		$links_total = $links->total_found();
		
		
		if($links_total > 0) : 
			while($links->fetch()) :
				$name = $links->display('name');
				$link = $links->display('link');
                $page = $links->display('page');
                if ($page == 'press') {
				?>
                                <div class="press-link" style="background:url(<?php echo $links->display('logo'); ?>) no-repeat center">
						<a href="<?php echo $link; ?>" ></a>
                                </div>
                                <?php } ?>
			<?php endwhile; endif; ?>         
 
                </div>
        <?php } ?>
                
			<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?> 
                
                
            </div>
          <?php if(!is_page('Photo Gallery') && !is_page('Video Gallery')) { ?>  
            <div id="aside">
                <a href="/join-the-movement/donate"><img width="275" height="315" src="/wp-content/uploads/2010/09/DonateNow_275x315.jpg" class="attachment-full" alt="DonateNow_275x315" title="DonateNow_275x315"></a>
                <a href="/join-the-movement"><img width="275" height="315" src="/wp-content/uploads/2010/09/JoinTheMovement_275x315.jpg" class="attachment-full" alt="JoinTheMovement_275x315" title="JoinTheMovement_275x315"></a>
            </div>
         <?php } ?>
        </div>
    
    
	<?php endwhile; endif; ?>
    
    <div class="clearfix"></div>
</div>

<?php get_footer(); ?>