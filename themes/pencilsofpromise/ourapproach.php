<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Our Approach
*/
?>

<?php get_header(); ?>

<div id="whoweare">
	<?php 
		if (have_posts()) : while (have_posts()) : the_post(); 
		$thumb_id = get_post_thumbnail_id(get_the_ID());
		$thumb = wp_get_attachment_image_src($thumb_id, 'feature-image-thumb');
	?>
	<div id="approachnew-header" style="background: url('<?php echo $thumb[0]; ?>');">		
                <div id="intro-content">
                     <?php the_content(); ?>
		</div>
        </div>
	<div class="approach-wrapper">          
<div id="approachnew-content">
    <div class="approachBox approachBoxIdentify">
        <a href="<?php bloginfo('url'); ?>/our-approach/identify/"><div class="word"><span></span></div><h2 class="two">sites to build educational structures</h2><p class="two">Before we commit to building a school in a village, we create a village profile that assesses the community based on five key categories: Need, Sustainability, Cost Efficiency, Impact, and Commitment.</p></a>
    </div>

    <div class="approachBox approachBoxBuild" >
        <a href="<?php bloginfo('url'); ?>/our-approach/build/"><div class="word"><span></span></div><h2 class="three">with local labor and materials, in conjunction with the community</h2><p class="three">We use high-quality materials at local prices to create long-lasting structures. As part of their display of commitment to education, the village agrees to provide 10-20% of the build costs, usually in the form of materials and labor.</p></a>
    </div>

    <div class="approachBox approachBoxSupport">
        <a href="<?php bloginfo('url'); ?>/our-approach/support/"><div class="word"><span></span></div><h2 class="two">projects through ongoing education programs</h2><p class="two">We design PoP involvement to be 100% sustainable. Beyond building a school, we also offer education programs to our villages: SHINE curriculum, Sister School program, and Scholarship program.</p></a>
    </div>

    <div class="approachBox approachBoxHire">
        <a href="<?php bloginfo('url'); ?>/our-approach/hire/"><div class="word"><span></span></div><h2 class="one">and invest in local talent</h2><p class="one">PoP provides its local staff with professional development training beyond any other job opportunities in their region. We use our professional development tools to empower staff members (many of whom are females and minorities) to grow as individuals and professionals and take on leadership and mentorship roles.</p></a>
    </div>    
    
    <div class="approachBox approachBoxMonitor">
        <a href="<?php bloginfo('url'); ?>/our-approach/monitor/"><div class="word"><span></span></div><h2 class="one">and evaluate program impact</h2><p class="two">We know that the only way to design and modify effective programs is through data analysis and conversations with our communities. Local teams on the ground are dedicated to baselining, monitoring, and evaluating our impact.</p></a>
    </div> 

    <div class="approachBox">
        <img src="<?php bloginfo('template_directory'); ?>/gfx/approach_landing_photo.jpg"/>
    </div>     
<span class="clearfix"></span>
<h3 style="color:#ffcc00; text-transform:uppercase;font-weight: lighter;font-size: 20px;margin: 30px 0 30px 17px;position: relative;top: 20px;">Learn About Our For-Purpose Approach</h3>
<iframe src="http://player.vimeo.com/video/62209649" width="930" height="500" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" style="
    margin-left: 17px;
"></iframe>
    
</div>   
	</div>
	<?php endwhile; endif; ?>
</div>


<?php get_footer(); ?>