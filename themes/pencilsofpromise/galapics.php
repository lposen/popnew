<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Gala Pics    
*/
?>

<?php get_header(); ?>
<script src="<?php bloginfo('stylesheet_directory'); ?>/js/galleria-1.2.8.min.js"></script>
<!-- load flickr plugin -->
<script src="<?php bloginfo('stylesheet_directory'); ?>/js/galleria.flickr.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/modernizr.custom.53451.js"></script>

<div class="heading BebasNeue text_gold" style="font-size: 35px; padding: 20px 0 0 50px;">2012 Gala</div>
	<div id="galleria" style="clear: both; height: 600px; width: 900px; margin-left: 20px;"></div>
	<div class="clearfix"></div>

<script>
// Load the classic theme
Galleria.loadTheme('<?php bloginfo('stylesheet_directory'); ?>/js/galleria.classic.min.js');
// Initialize Galleria
Galleria.run('#galleria', {
    transition: 'fade',
    autoplay: 4000,
    transitionSpeed: 500,
    showImagenav: true,
    responsive: true,
    showCounter: true,
    transition: 'slide',
    lightbox: true,
    showImagenav: true,
    easing: 'swing',
    flickr: 'set:72157632023250849',
    flickrOptions: {
        sort: 'interestingness-desc',
        user: 'pencilsofpromise'

    }
});
</script>

<?php get_footer(); ?>
