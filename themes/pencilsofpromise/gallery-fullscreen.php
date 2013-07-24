<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Fullscreen Gallery Page
*/
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=0.5,user-scalable=no">
        <title>Galleria Fullscreen Theme Demo</title>
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <script src="<?php bloginfo('template_directory'); ?>/js/galleria/galleria-1.2.5.min.js"></script>
        <!-- load flickr plugin -->
        <script src="<?php bloginfo('template_directory'); ?>/js/galleria/flickr/galleria.flickr.js"></script>
        <style>
        	body{ background:#000; }
        </style>
</head>
<body>
    <div id="galleria"></div>
    <script>
    // Load fullscreen theme
        $(document).ready( function() {
        Galleria.loadTheme('<?php bloginfo('template_directory'); ?>/js/galleria/fullscreen/galleria.fullscreen.min.js');
        $('#galleria').galleria({
            flickr: 'set:72157627874042649',          
            flickrOptions: {
            sort: 'interestingness-desc',
            max: 100,
            description: true
        },imagePosition:'center',showImagenav:true,fullscreenCrop:false,idleMode:false,autoplay:7000,carousel:true,transition:'fade',showInfo:false 
        });
        });
    </script>
</body>
</html>
<?php endwhile; endif; ?>|