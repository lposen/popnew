<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Ipromise
*/
?>

<?php get_header(); ?>

<div id="ipromise">
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
	<div id="ipromise-items">
<div id="main">
            <div class="pentry one">
                <h3>Educate 1 Child</h3>
		<div class="the-image">
                    <div class="viewport">
			<img width="300" height="200" src="<?php bloginfo('template_directory'); ?>/gfx/ipromise/OneKidSmall.jpg">
			<div class="amount"><span>$25</span></div>
		    </div>
		</div>
		<div class="buttonsOne"><a class="donate-btn" href="<?php bloginfo('url'); ?>/join-the-movement/donate/?d=25">Donate</a></div>
            </div>            
            
            <div class="pentry two">
		<h3>Educate 10 Children</h3>
		<div class="the-image">
                    <div class="viewport">
			<img width="300" height="200" src="<?php bloginfo('template_directory'); ?>/gfx/ipromise/10KidsSmall.jpg">
			<div class="amount"><span>$250</span></div>
		    </div>
		</div>
		<div class="buttonsOne"><a class="fundraise-btn" href="http://www.stayclassy.org/pop/create?goal=250">Fundraise</a></div>
            </div>
        
            
        <div class="pentry three">
		<h3>Sponsor a Full Classroom</h3>
		<div class="the-image">
                    <div class="viewport">
			<img width="300" height="200" src="<?php bloginfo('template_directory'); ?>/gfx/ipromise/ClassroomSmall.jpg">
			<div class="amount"><span>$2,500</span></div>
		    </div>
		</div>
		<div class="buttonsOne"><a class="fundraise-btn" href="http://www.stayclassy.org/pop/create?goal=2500">Fundraise</a></div>
        </div>
      
            
        <div class="pentry four">
		<h3>Build a Full Classroom</h3>
		<div class="the-image">
                    <div class="viewport">
			<img width="300" height="200" src="<?php bloginfo('template_directory'); ?>/gfx/ipromise/ClassroomAltSmall.jpg">
			<div class="amount"><span>$10,000</span></div>
		    </div>
		</div>
            <div class="buttonsTwo"><a class="teamraise-btn teamraise" href="#">Join a Team</a></div>
        </div>
        
            
        <div class="pentry five">
		<h3>Build & Sponsor<br/>a Full School</h3>
		<div class="the-image">
                    <div class="viewport">
			<img width="300" height="200" src="<?php bloginfo('template_directory'); ?>/gfx/ipromise/SchoolSmall.jpg">
			<div class="amount"><span>$25,000</span></div>
		    </div>
		</div>
		<div class="buttonsTwo"><a class="teamraise-btn teamraise" href="#">Join a Team</a></div>
        </div>
            

    <div id="ipromise-stats">
        <div id="board" class="board">
            <div class="boardtop"></div>
            <div class="boardTable"></div>
            <div class="boardbottom"></div>
        </div>
    </div>            
</div>
	<div id="stats">    
            <span class="item">Amount Raised So Far: <span class="yellow" id="amount-raised"></span></span><span class="item">Donors: <span class="yellow" id="num-donors"></span></span><span class="item">Fundraisers: <span class="yellow" id="num-fundraisers"></span></span><span class="item">Teams: <span class="yellow" id="num-teams"></span></span>
	</div>              
            
	</div>
       
    
    <div id="team-box">
	<h2><img src="<?php bloginfo('template_directory'); ?>/gfx/teamHeader.png" alt="Join a Team" /></h2>
	<p>Team fundraising is a great way to reach bigger goals like building a classroom ($10,000), or building and sponsoring an entire school ($25,000).</p><p>To get started, just create your fundraising page below, and look for the "join a team" option.</p><p><a class="fundraise-btn" href="http://www.stayclassy.org/pop/create?goal=500">Fundraise</a></div></p>
    </div>
    
	<?php endwhile; endif; ?>
</div>
<?php get_footer(); ?>