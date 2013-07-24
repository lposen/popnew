<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Gala
*/
?>

<?php get_header(); ?>

<div id="gala">
	<?php 
		if (have_posts()) : while (have_posts()) : the_post(); 
		$thumb_id = get_post_thumbnail_id(get_the_ID());
		$thumb = wp_get_attachment_image_src($thumb_id, 'feature-image-thumb');	
	?>
	<div id="introduction" style="background: url('<?php echo $thumb[0]; ?>');">    
            <div id="intro-content">
                     <?php the_content(); ?>
            </div>
	</div>
	<div id="gala-items">         
                    <div id="gala-form">
			<?php gravity_form(8, false, false); ?>
		    </div>  
                    <div id="gala-details">
                        <h3>Event Details</h3>
                        <h4>When</h4>
                        <p>Thursday, November 17, 2011</p>
                        <p>Cocktails begin at 7:00pm</p>
                        <h4>Where</h4>
                        <p>espace</p>
                        <p>635 West 42nd Street</p>
                        <p>New York, NY, 10036</p>
                        <h4>Special Honorees</h4>
                        <p>Justin Bieber</p>
                        <p>Scott "Scooter" Braun</p>
                        <p>AgencyNet</p> 
                        <h4>Location Map</h4>
                        <iframe width="300" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps/ms?msa=0&amp;msid=201466845916042947275.0004ad8b464b78c8cc184&amp;ie=UTF8&amp;t=m&amp;vpsrc=6&amp;ll=40.761675,-73.999979&amp;spn=0.004876,0.006437&amp;z=16&amp;output=embed"></iframe>
		    </div>   
                    <div style="margin: 20px 40px; border:0;"><a href="http://www.boomset.com/apps/eventpage/450"><img width="910" border="0" src="<?php bloginfo('template_directory'); ?>/gfx/galahosts.png"/></a></div>
                    <div id="gala-purchase" style="height:150px;"><a name="check"></a>
                        <h3>Check Instructions</h3>                        
                            <p>To purchase tickets by check, please first view <a href="http://www.boomset.com/apps/eventpage/450">the purchase options</a>. Please include a contact phone number on the check, and indicate the number of tickets/ table sponsorship level you wish to purchase. Make checks payable to:<br/>
                            <p style="margin: 10px 0 10px 60px;"><i>Pencils of Promise<br/>
                            c/o Tom Casazzone<br/>
                            195 Chrystie Street<br/>
                            Suite 401 A<br/>
                            New York, NY 10002</i></p>
                            <p>If you have questions, please contact <a href="mailto:gala@pencilsofpromise.org">gala@pencilsofpromise.org</a> or call (212) 777-3170.<p>
                    </p>                  
                   </div>              
	</div>
	<?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>