<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Join Our Movement
*/
?>

<?php get_header(); ?>

<div id="movement">
	<div id="twitter-box">
		<h2><img src="<?php bloginfo('template_directory'); ?>/gfx/twitterHeader.png" alt="Tweet Donation" /></h2>
		<p>You can either select pre-determined text, or write your own message.</p>
		<textarea cols="30" rows="5" id="fb-message">Everyone has the right to an education. Help @PencilsOfPromis bring education where it's needed most.</textarea>
		<input type="submit" value="Post message" id="submit" />
		<input type="submit" value="Cancel" id="cancel" />
	</div>
	<?php 
		if (have_posts()) : while (have_posts()) : the_post(); 
		$thumb_id = get_post_thumbnail_id(get_the_ID());
		$thumb = wp_get_attachment_image_src($thumb_id, 'feature-image-thumb');	
	?>
 	<div id="introduction">
		<img src="<?php bloginfo('template_directory'); ?>/gfx/headerTakeAction.png" width="990" alt="" />
	</div>
 
        <?php the_content(); ?>
    
        </div>

	<?php endwhile; endif; ?>
<!---
    <div class="mailInDonations">
    	<img src="wp-content/themes/pencilsofpromise/gfx/donationCallOutHeader.png" alt="Hey!" width="237" height="58" />
    	<span class="mailInDonationsInstruc">
        	If you prefer to donate via check, that's cool too! Mail to our address:
        </span>
        <span class="mailInDonationsAddress">
            Attn: Outreach Team <br />
            195 Chrystie St. Suite 401 A. <br />
            New York, NY 10002
      </span>
  </div>    --->
</div>
<?php get_footer(); ?>