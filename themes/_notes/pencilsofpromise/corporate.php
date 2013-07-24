<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Corporate
*/
?>

<?php get_header(); ?>

<div id="subpage-sidebar">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<div id="subheader" class="paper contest" style="margin: 0;">
            <h2><img src="<?php bloginfo('template_directory'); ?>/gfx/subheadCorporate.png" alt="Corporate for PoP"/></h2>
            <span></span>
        </div>
        <div id="subpage-content">
		<div id="main-column">
                    
        <div style="clear:both;"></div>                     
                    <?php the_content(); ?>        
                    <div id="corporate-form">
			<?php gravity_form(7, false, false); ?>
		    </div>
		</div>    
		<div id="aside">
               <a href="<?php bloginfo('url'); ?>/who-we-are/our-partners"><img src="<?php bloginfo('template_directory'); ?>/gfx/tout-corporate-partners.png"/></a>
               <br/>
               <a href="<?php bloginfo('url'); ?>/who-we-are/our-financials"><img src="<?php bloginfo('template_directory'); ?>/gfx/tout-corporate-financials.png"/></a>
            </div>
	</div>
    
        <?php endwhile; endif; ?>
 
</div>

<?php get_footer(); ?>