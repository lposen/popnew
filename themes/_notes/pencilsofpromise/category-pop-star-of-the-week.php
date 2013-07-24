<?php get_header(); ?>


<div id="ourpeople">
    
<div id="introduction">
		<img width="990" alt="" src="<?php bloginfo('template_directory'); ?>/gfx/headerOurPeople.png">
</div>    
<div class="headercufon">
	<h3>Meet the PoP Stars</h3>
</div>
        
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
        <?php 
        $thetitle = $post->post_title;
        $pos1 = strrpos($thetitle, "tar of the Week:");
        $pos3 = strrpos($thetitle, "tar of the Month:");
        $pos2 = strrpos($thetitle, ":");
        if ($pos1 || $pos2) {
        $displaytitle = substr($thetitle,$pos2+2); // returns "d"
        ?>
	<div id="popstars">
	<div class="member">
	<a href="'. $user_link .'">
            <div class="avatar medium"><?php the_post_thumbnail( array(130,130) ); ?></div>
        <p><strong><?php echo $displaytitle; ?></strong></a></div></div>
        <?php
        }
        ?>
	<?php endwhile; endif; 	?>
</div>

<?php get_footer(); ?>
