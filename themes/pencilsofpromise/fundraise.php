<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Fundraise
*/
?>
<?php get_header(); ?>
<script src="http://code.jquery.com/jquery-1.9.0.min.js"></script>
<div id="ipromise">
	<?php 
		if (have_posts()) : while (have_posts()) : the_post(); 
		$thumb_id = get_post_thumbnail_id(get_the_ID());
		$thumb = wp_get_attachment_image_src($thumb_id, 'feature-image-thumb');	
	?>
	<div id="fundraise-introduction" style="background: url('<?php echo $thumb[0]; ?>');">    
        <div id="fundraise-intro-content">
        	<h2>RALLY YOUR FRIENDS.</h2>
            <p>Donate your upcoming birthday, run a mile,<br> get creative to build a school.</p>
        	<a href="http://fundraise.pencilsofpromise.org/fundraise/create?eid=15845" class="gold_button">Start A Fundraiser</a>
		</div>
	</div>
	<div id="scrolltriangle"></div>
	
	<div id="ipromise-items">
<div id="main">

            <div id="fundraise-title">             
                <h1 class="BebasNeue">HOW MANY LIVES WOULD YOU LIKE TO IMPACT?</h1>
            </div>   
         
<div class="fundraise-sub-menu">
	<a href="http://fundraise.pencilsofpromise.org/fundraise/create?eid=15845&goal=25"    onmouseover="$('.vector-1').show();$('.vector-1-dot').show();$('.vector-2').hide();$('.vector-2-dot').hide();$('.vector-3').hide();$('.vector-3-dot').hide();$('.vector-4').hide();$('.vector-4-dot').hide();$('.vector-5').hide();$('.vector-5-dot').hide();">Educate One Child</a>
	<a href="http://fundraise.pencilsofpromise.org/fundraise/create?eid=15845&goal=250"    onmouseover="$('.vector-1').hide();$('.vector-1-dot').hide();$('.vector-2').show();$('.vector-2-dot').show();$('.vector-3').hide();$('.vector-3-dot').hide();$('.vector-4').hide();$('.vector-4-dot').hide();$('.vector-5').hide();$('.vector-5-dot').hide();">Educate Ten Children</a>
	<a href="http://fundraise.pencilsofpromise.org/fundraise/create?eid=15845&goal=2500"    onmouseover="$('.vector-1').hide();$('.vector-1-dot').hide();$('.vector-2').hide();$('.vector-2-dot').hide();$('.vector-3').show();$('.vector-3-dot').show();$('.vector-4').hide();$('.vector-4-dot').hide();$('.vector-5').hide();$('.vector-5-dot').hide();">Sponsor a Classroom</a>
	<a href="http://fundraise.pencilsofpromise.org/fundraise/create?eid=15845&goal=10000"    onmouseover="$('.vector-1').hide();$('.vector-1-dot').hide();$('.vector-2').hide();$('.vector-2-dot').hide();$('.vector-3').hide();$('.vector-3-dot').hide();$('.vector-4').show();$('.vector-4-dot').show();$('.vector-5').hide();$('.vector-5-dot').hide();">Build a Classroom</a>
	<a href="http://fundraise.pencilsofpromise.org/fundraise/create?eid=15845&goal=25000"    onmouseover="$('.vector-1').hide();$('.vector-1-dot').hide();$('.vector-2').hide();$('.vector-2-dot').hide();$('.vector-3').hide();$('.vector-3-dot').hide();$('.vector-4').hide();$('.vector-4-dot').hide();$('.vector-5').show();$('.vector-5-dot').show();" >Build a School</a>
</div>
       
<div id="fundraising-canvas">

<div class="vector-1">
<div class="vector-1-dot vector-info">	<div class="vector-info">
	<h1 class="BebasNeue">$25</h1>
	<p>One pencil helps finance an education <br> for a year. It’s pretty simple, yet will have <br> a huge impact on a child’s future.</p>
	<a href="http://fundraise.pencilsofpromise.org/fundraise/create?eid=15845&goal=25">Get Started ></a>
	</div>
</div>
</div>

<div class="vector-2">
<div class="vector-2-dot vector-info">	<div class="vector-info">
	<h1 class="BebasNeue">$250</h1>
	<p>Give a community a chance to grow and flourish. This provides an education <br> for ten future community leaders.</p>
	<a href="http://fundraise.pencilsofpromise.org/fundraise/create?eid=15845&goal=250">Get Started ></a>
	</div>
</div>
</div>

<div class="vector-3">
<div class="vector-3-dot vector-info">	<div class="vector-info">
	<h1 class="BebasNeue">$2,500</h1>
	<p>This will sponsor an entire classroom for a year. That means books, teachers, paper and a whole lot of learning.</p>
	<a href="http://fundraise.pencilsofpromise.org/fundraise/create?eid=15845&goal=2500">Get Started ></a>
	</div>
</div>
</div>

<div class="vector-4">
<div class="vector-4-dot vector-info">	<div class="vector-info">
	<h1 class="BebasNeue">$10,000</h1>
	<p>A classroom is not just a place to learn, it’s a place where children grow and develop into the next generation of leaders.</p>
	<a href="http://fundraise.pencilsofpromise.org/fundraise/create?eid=15845&goal=10000">Get Started ></a>
	</div>
</div>
</div>

<div class="vector-5">
<div class="vector-5-dot vector-info">
	<div class="vector-info">
	<h1 class="BebasNeue">$25,000</h1>
	<p>An entire school? Now we’re getting somewhere. Your contribution can transform a whole region for years to come.</p>
	<a href="25000">Get Started ></a>
	</div>
</div>
</div>
    
</div>     
<?php /*
<div id="fundraiseBorderUpper"></div>
    
    <div id="fundraiseTitleChallenge" class="BebasNeue">OUR PROGRESS</div>
    
    <!--<div id="fundraiseClock">
        <div id="fundraiseClockText">
            <img style="padding-top:0px;position: absolute;" src="<?php bloginfo( 'template_url' ); ?>/gfx/fundraise_bg_clockticking.png" width="200">
        </div>
        <div id="fundraiseClockCounter">
            <div id="fundraiseCounter"></div>
            <!--<div id="fundraiseCounterNumbers">days &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; hours &nbsp; minutes seconds</div>-->
        <!--</div>        
    </div> -->  
    
    <div id="fundraiseBottomStats">
        <div class="fundraiseSchool" style="margin:0 20px 0 140px;">
            <div class="BebasNeue schoolNumber"><?php echo countProjects("Completed Schools", false); ?></div>
            <div class="schoolLabel">Completed Schools</div>
        </div>
        <div class="fundraiseSchool" style="margin:0 10px 0 10px;">
            <div class="BebasNeue schoolNumber"><?php echo (100 - (countProjects("Completed Schools", false))); ?></div> 
            <div class="schoolLabel">Schools Remaining</div> 
        </div>
        <!--<div class="fundraiseStats">
            <div class="BebasNeue statItem"><div class="statLabel">Amount Raised </div><div id="amount-raised" class="statStat"></div></div>
            <div class="BebasNeue statItem"><div class="statLabel">Fundraisers </div><div id="num-fundraisers" class="statStat"></div></div>
            <div class="BebasNeue statItem"><div class="statLabel">Fundraising Teams </div><div id="lives-impacted" class="statStat"></div></div>
        </div>-->
        </div>    

          
    
    <div id="fundraiseBorderLower"></div>
    
    <div id="fundraiseBottomTitles">
        <div id="fundraiseTitleToolkits" class="BebasNeue">ACTION TOOLKITS</div>
        <!--<div id="fundraiseTitleTop" class="BebasNeue">OUR TOP FUNDRAISERS</div>   -->   
    </div>
	<div id="fundraiseBottomStats">
    <div id="fundraise-action-toolkit-caption"></div>
            <div id="fundraiseTitleToolkit">
                <div id="fundraise-action-toolkit-donate-a-day">
                	<a href="http://www.pencilsofpromise.org/wp-content/uploads/2010/11/100924-Donate-your-birthday.pdf"><img width="343" height="157" src="wp-content/themes/pencilsofpromise/gfx/fundraise_action_1.png" class="attachment-contest-post-thumbnail wp-post-image" alt="Donate Your Birthday" title="Donate Your Birthday"></a>
            	</div>
       		</div>
            
            <div id="board" class="board">
            	<div id="fundraise-action-toolkit-lemonade">
                <a href="http://www.pencilsofpromise.org/wp-content/uploads/2010/11/100924-PoP-Lemonade-Stand.pdf"><img width="343" height="157" src="wp-content/themes/pencilsofpromise/gfx/fundraise_action_2.png" class="attachment-contest-post-thumbnail wp-post-image" alt="Organize a Lemonade Stand" title="Organize a Lemonade Stand"></a>
            </div>
            </div>
    </div>
    
    <!-- Original Code that allows inclusion of Board statistics
    		Uncomment and replace for use
            
            <div id="fundraiseBottomStats">
        <div id="fundraiseTitleToolkit">
            <div id="fundraise-action-toolkit-caption">
                <p>Here are a few ways you can help us reach our goal of 100 schools! Please click photo to download pdf.</p>
            </div>
            <div id="fundraise-action-toolkit-donate-a-day">
                <a href="http://www.pencilsofpromise.org/wp-content/uploads/2010/11/100924-Donate-your-birthday.pdf"><img width="343" height="157" src="wp-content/themes/pencilsofpromise/gfx/fundraise_action_1.png" class="attachment-contest-post-thumbnail wp-post-image" alt="Donate Your Birthday" title="Donate Your Birthday"></a>
            </div>
            <div id="fundraise-action-toolkit-lemonade">
                <a href="http://www.pencilsofpromise.org/wp-content/uploads/2010/11/100924-PoP-Lemonade-Stand.pdf"><img width="343" height="157" src="wp-content/themes/pencilsofpromise/gfx/fundraise_action_2.png" class="attachment-contest-post-thumbnail wp-post-image" alt="Organize a Lemonade Stand" title="Organize a Lemonade Stand"></a>
            </div>
        </div>
        <div id="ipromise-stats">
            <div id="board" class="board">
                <div class="boardtop"></div>
                <div class="boardTable"></div>
                <div class="boardbottom"></div>
            </div>    
        </div>
    </div>    
    
    -->
   	*/ ?>
</div>
 
	<?php endwhile; endif; ?>
</div>
<?php get_footer(); ?>