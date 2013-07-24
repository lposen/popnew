<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Our Approach Subpage
*/
?>

<?php get_header(); ?>

<div id="whoweare">
	<?php
		if (have_posts()) : while (have_posts()) : the_post();
		$thumb_id = get_post_thumbnail_id(get_the_ID());
		$thumb = wp_get_attachment_image_src($thumb_id, 'feature-image-thumb');
	?>
	
    
        <?php 
        
        if (is_page('identify')) {
            ?><div id="approach-sub-header" style="background: url('<?php bloginfo('template_directory'); ?>/gfx/approach_identify_banner.jpg');"></div><?php      
        }
        else if (is_page('build')) {
            ?><div id="approach-sub-header" style="background: url('<?php bloginfo('template_directory'); ?>/gfx/approach_build_banner.jpg');"></div><?php
        }
        else if (is_page('support')) {
            ?><div id="approach-sub-header" style="background: url('<?php bloginfo('template_directory'); ?>/gfx/approach_support_banner.jpg');"></div><?php
        }
        else if (is_page('monitor')) {
            ?><div id="approach-sub-header" style="background: url('<?php bloginfo('template_directory'); ?>/gfx/approach_monitor_banner.jpg');"></div><?php
        }
        else if (is_page('hire')) {
            ?><div id="approach-sub-header" style="background: url('<?php bloginfo('template_directory'); ?>/gfx/approach_hire_banner.jpg');"></div><?php
        }
        else if (is_page('shine')) {
            ?><div id="approach-sub-header" style="background: url('<?php bloginfo('template_directory'); ?>/gfx/approach_shine_banner.jpg');"></div><?php
        }    
        ?>
	<div class="approach-sub-wrapper">
		<div id="approach-sub-content">
                    
                    <?php the_content(); ?>
 
                    <?php if (is_page('hire')) { ?>
                                        
                        <div id="gallery">

                <div class="anythingSlider activeSlider" style="width: 900px; height: 500px; "><span class="arrow back"><a href="#">«</a></span><span class="arrow forward"><a href="#">»</a></span><div class="anythingWindow"><ul id="slider1" class="anythingBase" style="width: 6400px; ">

                            
	<?php
		$links = new Pod('staff_feature');
		$links->findRecords('display_order ASC', -1, '');
		$links_total = $links->getTotalRows();
		$i = 1;
		
		if($links_total > 0) : 
			while($links->fetchRecord()) :
				$link = $links->get_field('link');
				$image_raw = $links->get_field('image');
                                $image = $image_raw[0]['guid'];
       ?>
                                
       <li class="panel" style="width: 900px; height: 500px; "><a href="<?php echo $link; ?>"><img src="<?php echo $image; ?>"></a></li>
                                                        
       <?php endwhile; endif; ?>                              
                                    
			</ul></div></div>                            
                          
<script>
  $('#gallery .anythingSlider').anythingSlider({
  // Appearance
  width               : null,      // Override the default CSS width
  height              : null,      // Override the default CSS height
  resizeContents      : true,      // If true, solitary images/objects in the panel will expand to fit the viewport

  // Navigation
  startPanel          : 1,         // This sets the initial panel
  hashTags            : true,      // Should links change the hashtag in the URL?
  buildArrows         : false,      // If true, builds the forwards and backwards buttons
  buildNavigation     : true,      // If true, buildsa list of anchor links to link to each panel
  navigationFormatter : null,      // Details at the top of the file on this use (advanced use)
  forwardText         : "&raquo;", // Link text used to move the slider forward (hidden by CSS, replaced with arrow image)
  backText            : "&laquo;", // Link text used to move the slider back (hidden by CSS, replace with arrow image)

  // Slideshow options
  autoPlay            : true,      // This turns off the entire slideshow FUNCTIONALY, not just if it starts running or not
  startStopped        : false,     // If autoPlay is on, this can force it to start stopped
  pauseOnHover        : true,      // If true & the slideshow is active, the slideshow will pause on hover
  resumeOnVideoEnd    : true,      // If true & the slideshow is active & a youtube video is playing, it will pause the autoplay until the video has completed
  stopAtEnd           : false,     // If true & the slideshow is active, the slideshow will stop on the last page
  playRtl             : false,     // If true, the slideshow will move right-to-left
  startText           : "",   // Start button text
  stopText            : "",    // Stop button text
  delay               : 5000,      // How long between slideshow transitions in AutoPlay mode (in milliseconds)
  animationTime       : 600,       // How long the slideshow transition takes (in milliseconds)
  easing              : "swing"    // Anything other than "linear" or "swing" requires the easing plugin
});
</script>

</div>

<div style="width:900px; margin:30px auto 20px;"><iframe width="900" height="500" src="http://www.youtube.com/embed/CZFUeY3mnU4" frameborder="0" allowfullscreen></iframe></div>
                            


                    </div>                    
                            
                    <?php } ?>     
                    
                </div>
	</div>
	<?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>