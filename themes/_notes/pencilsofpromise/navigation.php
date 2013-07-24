<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Navigation
*/
?>

<?php get_header(); ?>


<div id="main">
    <script>
    $(document).ready(function() {  
        $('#nav_menu').mouseenter(function(){
                $('#nav').slideToggle();
        });
        $('#nav').mouseleave(function(){
            $('#nav').slideToggle();
        });
    });
        
    </script>   
    <div  id="nav_menu"><a href="#"><img src="<?php bloginfo('template_directory'); ?>/gfx/ipromise/ipromise_logo.png"></a></div>
    <div id="nav">
        <div id="login">
            <a href="#" class="gold_button">Login</a><br />
            <a href="#"  class="gold_button">Sign Up</a>
        </div>
        <ul id="create">
            <li>Create</li>
            <li><a href="<?php bloginfo('template_directory'); ?>/groups/manage">+<span>Groups</span></a></li>
            <li><a href="<?php bloginfo('template_directory'); ?>/fundraise/manage">+<span>Campaigns</span></a></li>
        </ul>
        <ul id="browse">
            <li >Browse</li>
            <li><a href="<?php bloginfo('template_directory'); ?>/groups/browse">+<span>Groups</span></a></li>
            <li><a href="<?php bloginfo('template_directory'); ?>/fundraise/browse">+<span>Campaigns</span></a></li>
            <li><a href="<?php bloginfo('template_directory'); ?>/fundraise/downloads">+<span>Downloads</span></a></li>
        </ul>
    </div>
</div>

    

    
<?php get_footer(); ?>

