<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Impact Trips
*/
?>

<?php get_header(); ?>

<div id="impact-trips">
	<?php 
		if (have_posts()) : while (have_posts()) : the_post(); 	
	?>   
    
    <?php the_content(); ?>
    
    <div id="join-trip">
	<h2>JOIN A TRIP</h2>
        <div>
            <?php gravity_form(8, false, false); ?>
	</div>
    </div> 
    
	<?php endwhile; endif; ?>
</div>
<?php get_footer(); ?>