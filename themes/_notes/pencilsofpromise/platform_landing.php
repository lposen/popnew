<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
  Template Name: Platform Landing
 */
?>

<?php get_header(); ?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.iconmenu.js"></script>
<script type="text/javascript">


$(document).ready(function(){

    $('.flying1 .flying-text').css({opacity:0});
    $('.flying1 .active-text').animate({opacity:1}, 1500); //animate first text
    var int = setInterval(changeText, 2000);    // call changeText function every 5 seconds

function changeText(){  
    var $activeText = $(".flying1 .active-text");     //get current text    
    var $nextText = $activeText.next();  //get next text
    if($activeText.next().length == 0) $nextText = $('.flying1 .flying-text:first');

    $activeText.animate({opacity:1, top: "0px"}, 1500);
    $activeText.animate({opacity: 0});

     if ($activeText.next().length == 0) {
        $nextText = $('.flying1 .flying-text:first'); //if it is last text, loop back to first text

        // To fade all out
       // var $allText = $(".flying1 div");
        //$allText .animate({bottom: '30px'}, 1000);
        
    }

    $nextText.css({opacity: 0}).addClass('active-text').animate({top: "0px"}, 1500, function(){

        $activeText.removeClass('active-text')
    });
}
});
</script>
<script type="text/javascript">
        $(function() {
                $('#splash_donors_inner #sti-menu').iconmenu({
                        animMouseenter	: {
                                'mText' : {speed : 400, easing : 'easeOutExpo', delay : 0, dir : -1},
                                'sText' : {speed : 300, easing : 'easeOutExpo', delay : 0, dir : -1},
                                'icon'  : {speed : 400, easing : 'easeOutExpo', delay : 0, dir : -1}
                        },
                        animMouseleave	: {
                                'mText' : {speed : 400, easing : 'easeInExpo', delay : 0, dir : -1},
                                'sText' : {speed : 300, easing : 'easeInExpo', delay : 0, dir : -1},
                                'icon'  : {speed : 400, easing : 'easeInExpo', delay : 280, dir : -1}
                        }
                });
                $('#splash_campaigns #sti-menu').iconmenu({
                        animMouseenter	: {
                                'mText' : {speed : 400, easing : 'easeOutExpo', delay : 0, dir : -1},
                                'sText' : {speed : 400, easing : 'easeOutExpo', delay : 0, dir : -1},
                                'icon'  : {speed : 400, easing : 'easeOutExpo', delay : 0, dir : -1}
                        },
                        animMouseleave	: {
                                'mText' : {speed : 400, easing : 'easeInExpo', delay : 0, dir : -1},
                                'sText' : {speed : 400, easing : 'easeInExpo', delay : 0, dir : -1},
                                'icon'  : {speed : 400, easing : 'easeInExpo', delay : 280, dir : -1}
                        }
                });
        });
</script>

<?php
//----------------------------- BACKEND CODE SECTION --------------------------------------//
?>

<?php
try { //page error handling
//platform init
$mySforceConnection = doSalesforceConnect();
$loginId;$groupId;$fundId;$contactId;
$loginId = doPlatformLogin($current_user,$mySforceConnection);
$groupId = $_GET["g"];
$fundId = $_GET["f"];
$contactId=$_GET["u"];
$marketing=$_GET["m"];
?>
<?php
    //initiate the cache
    $doCache=doCache();
    $cacheId = 'landing-50';
    $cacheHolder = array();
    $hasCache=false;
    if ($doCache) {
        require_once ('Cache/Lite.php');
        $cacheOptions = array(
            'cacheDir' => 'platform-cache/',
            'lifeTime' => 3600,
            'automaticSerialization' => true 
        );
        $cache = new Cache_Lite($cacheOptions);
        $refreshCache=isset($_GET["r"]);
        if (!$refreshCache) {
            if (($cacheHolder = $cache->get($cacheId)) === false) {
                $hasCache = false;
            }
            else {
                $hasCache = true;     
            }
        }
    }
?>
 <?php
    //get the counts
    $stats;
    if ($hasCache) {
        $stats = $cacheHolder['stats'];
    }
    else {
        $groupCount;$fundCount;$campaignTotal; 
        $query = "SELECT COUNT() FROM Group__c WHERE Published__c=true";
        $response = $mySforceConnection->query($query);
        $groupCount=$response->size;
        $query = "SELECT COUNT() FROM Fundraiser__c WHERE Published__c=true";
        $response = $mySforceConnection->query($query);
        $fundCount=$response->size;
        $query = "SELECT id, AmountWonOpportunities FROM Campaign WHERE name LIKE 'Platform%'";
        $response = $mySforceConnection->query($query);
        $campaignTotal = 0;
        foreach ($response->records as $record) {
            $campaignTotal+=intval($record->fields->AmountWonOpportunities);
        };        
        $stats=new PlatformStats($groupCount,$fundCount,$campaignTotal);
        if ($doCache) { $cacheHolder['stats']=$stats;}
    }
    $fund;
    if ($hasCache) {
        $fund = $cacheHolder['fund'];
    }
    else {
        $query = "SELECT id,Name,Type__c, Impact__c, Description__c, Status__c, Photo_URL__c, Video_URL__c, Goal__c, Total_Raised__c,Marketing_Campaign__c, isClub__c FROM Fundraiser__c WHERE Featured__c=true AND Published__c=true LIMIT 1";
        $response = $mySforceConnection->query($query);
        foreach ($response->records as $record) {
            $fund = new Fundraiser($record->Id,$record->fields->Name,$record->fields->Type__c,$record->fields->Impact__c,$record->fields->Description__c,$record->fields->Status__c,$record->fields->Goal__c,$record->fields->Total_Raised__c,$record->fields->Photo_URL__c,$record->fields->Video_URL__c,$record->fields->Marketing_Campaign__c,$record->fields->isClub__c);
            if ($doCache) { $cacheHolder['fund']=$fund;}
        };
    }
    //FUNDRAISERS in Array
    $fundraisersArray = array();
    if ($hasCache) {
        $fundraisersArray=$cacheHolder['fundraisersArray'];
    }
    else {    
        $query = "SELECT id,Name,Description__c,Goal__c,Total_Raised__c,Photo_URL__c,Marketing_Campaign__c FROM Fundraiser__c WHERE Total_Raised__c>0 AND Published__c=true ORDER BY Total_Raised__c DESC LIMIT 4";
        $response = $mySforceConnection->query($query);
        foreach ($response->records as $record) {
            $fundraisersArray[]=new FundraiserQuick($record->Id,$record->fields->Name,$record->fields->Description__c,$record->fields->Goal__c,$record->fields->Total_Raised__c,$record->fields->Photo_URL__c,$record->fields->Marketing_Campaign__c);
        };
        if ($doCache) { $cacheHolder['fundraisersArray'] = $fundraisersArray; }
    }    
    if ($doCache && !$hasCache) {
        $cache->save($cacheHolder, $cacheId);
    }
    //DONATIONS in Array
    $donateArray = array();
    if ($hasCache) {
        $donateArray=$cacheHolder['donateArray'];
    }
    else {
        $query = "SELECT id,CloseDate,Name,Amount,Platform_User__c,Fundraiser__c,Anonymous__c FROM Opportunity WHERE Fundraiser__c!=null AND Platform_User__c!=null ORDER BY Amount DESC LIMIT 4";
        $response = $mySforceConnection->query($query);
        foreach ($response->records as $record) {
            $donateArray[]=new Donation($record->Id,$record->fields->CloseDate,$record->fields->Name,$record->fields->Amount,$record->fields->Platform_User__c,$record->fields->Fundraiser__c,$record->fields->Anonymous__c);
        };
        if ($doCache) { $cacheHolder['donateArray'] = $donateArray; }
    }
    if ($doCache && !$hasCache) {
        $cache->save($cacheHolder, $cacheId);
    }
 ?>
<div id="platform">
    <div id="main" style="margin-top:25px;">
        <div id="landing_banner"> 
                <h1 class="text_gold BebasNeue" style="text-align: center; font-size: 40px; margin-bottom: 20px;">Your<span style="display:inline-block; width: 235px; border-bottom: 2px solid #FEBC11; position: relative; top: 5px;"></span>could build a school.</h1>
                <div class="flying1">
                    <div class="flying-text active-text"><a class="text_gold BebasNeue" href="/fundraise/manage">birthday</a></div>                  
                    <div class="flying-text"><a class="text_gold BebasNeue" href="/fundraise/manage"  >special event</a></div>                      
                    <div class="flying-text"><a class="text_gold BebasNeue"  href="/fundraise/manage" >mixer</a></div>
                    <div class="flying-text"><a  class="text_gold BebasNeue" href="/fundraise/manage" >next challenge</a></div>
                    <div class="flying-text text_gold BebasNeue" ><a  class="text_gold"  style="font-size: 40px; position: relative; top: 0px;" href="/fundraise/manage">Campaign</a></div> 
                    <div class="flying-text"><a class="text_gold BebasNeue"  href="/fundraise/manage" >wedding</a></div>
                    <div class="flying-text"><a class="text_gold BebasNeue"  href="/fundraise/manage" >graduation</a></div>
                    <div class="flying-text"><a class="text_gold BebasNeue"  href="/fundraise/manage" >marathon</a></div>
                    <div class="flying-text"><a class="text_gold BebasNeue" href="/fundraise/manage" >baby shower</a></div>
                    <div class="flying-text text_gold BebasNeue"><a  class="text_gold"  style="font-size: 40px; position: relative; top: 0px;" href="/fundraise/manage">Campaign</a></div> 
                    <div class="flying-text"><a  class="text_gold BebasNeue" href="/fundraise/manage" >road trip</a></div>
                    <div class="flying-text"><a  class="text_gold BebasNeue" href="/fundraise/manage" >function</a></div>
                    <div class="flying-text"><a  class="text_gold BebasNeue" href="/fundraise/manage" >sweet sixteen</a></div>
                    <div class="flying-text"><a  class="text_gold BebasNeue" href="/fundraise/manage" >next milestone</a></div>
                    <div class="flying-text text_gold BebasNeue"><a  class="text_gold"  style="font-size: 40px; position: relative; top: -40px;" href="/fundraise/manage">Campaign</a></div>         
                </div>
                <span class="clear"></span>
                <img src="<?php bloginfo('template_directory'); ?>/gfx/school_builder_banner.png">
        </div>
        <div id="landing_campaignsteps">
            <a href="/fundraise/manage"><img src="<?php bloginfo('template_directory'); ?>/gfx/landing_createcampaign.png"></a>
            <img src="<?php bloginfo('template_directory'); ?>/gfx/landing_arrow.png">
            <a href="/fundraise/manage"><img src="<?php bloginfo('template_directory'); ?>/gfx/landing_campaigngoal.png"></a>
            <img src="<?php bloginfo('template_directory'); ?>/gfx/landing_arrow.png">
            <a href="/fundraise/manage"><img src="<?php bloginfo('template_directory'); ?>/gfx/landing_spreadtheword.png"></a>
            <a class="gold_button platform-button-big" href="/fundraise/manage" style="position: relative; top: -5px; left: 75px;">Create a Campaign</a>   
        </div>

        <?php /* !-------------------------------OLD STUFF------------------------------->
<div>            
            <!--<div id="fundraise-title">-->
           <!-- <div id="fundraise-tooltip"></div>    -->            
                <!--<h1 class="BebasNeue" style="font-size:36px; margin: 0 0px 0 10px;">HOW MANY LIVES WOULD YOU LIKE TO IMPACT?</h1>-->
            <!--</div>   -->
      
<!--<div class="fundraise-sub-menu">
	<a href="/fundraise/manage?a=25"  onmouseover="$('.vector-1').show();$('.vector-1-dot').show();$('.vector-2').hide();$('.vector-2-dot').hide();$('.vector-3').hide();$('.vector-3-dot').hide();$('.vector-4').hide();$('.vector-4-dot').hide();$('.vector-5').hide();$('.vector-5-dot').hide();">Educate One Child</a>
	<a href="/fundraise/manage?a=250"    onmouseover="$('.vector-1').hide();$('.vector-1-dot').hide();$('.vector-2').show();$('.vector-2-dot').show();$('.vector-3').hide();$('.vector-3-dot').hide();$('.vector-4').hide();$('.vector-4-dot').hide();$('.vector-5').hide();$('.vector-5-dot').hide();">Educate Ten Children</a>
	<a href="/fundraise/manage?a=2500"    onmouseover="$('.vector-1').hide();$('.vector-1-dot').hide();$('.vector-2').hide();$('.vector-2-dot').hide();$('.vector-3').show();$('.vector-3-dot').show();$('.vector-4').hide();$('.vector-4-dot').hide();$('.vector-5').hide();$('.vector-5-dot').hide();">Sponsor a Classroom</a>
	<a href="/fundraise/manage?a=10000"    onmouseover="$('.vector-1').hide();$('.vector-1-dot').hide();$('.vector-2').hide();$('.vector-2-dot').hide();$('.vector-3').hide();$('.vector-3-dot').hide();$('.vector-4').show();$('.vector-4-dot').show();$('.vector-5').hide();$('.vector-5-dot').hide();">Build a Classroom</a>
	<a href="/fundraise/manage?a=25000"    onmouseover="$('.vector-1').hide();$('.vector-1-dot').hide();$('.vector-2').hide();$('.vector-2-dot').hide();$('.vector-3').hide();$('.vector-3-dot').hide();$('.vector-4').hide();$('.vector-4-dot').hide();$('.vector-5').show();$('.vector-5-dot').show();" style="padding-right: 0px;">Build a School</a>
        
</div>
       
<div id="fundraising-canvas">

<div class="vector-1">
<div class="vector-1-dot vector-info">
	<h1 class="BebasNeue" style="font-size: 80px; margin-bottom: 40px;">$25</h1>
	One pencil helps finance an education for a year. It’s pretty simple, yet will have a huge impact on a child’s future.<br/><br/><br/>
	<a href="/fundraise/manage?a=25">Get Started ></a>
</div>
</div>

<div class="vector-2">
<div class="vector-2-dot vector-info">
	<h1 class="BebasNeue" style="font-size: 80px;">$250</h1>
	Give a community a chance to grow and flourish. This provides an education <br> for ten future community leaders.<br/><br/><br/>
	<a href="/fundraise/manage?a=250">Get Started ></a>
</div>
</div>

<div class="vector-3">
<div class="vector-3-dot vector-info">
	<h1 class="BebasNeue" style="font-size: 80px;">$2,500</h1>
	This will sponsor an entire classroom for a year. That means books, teachers, paper and a whole lot of learning.<br/><br/><br/>
	<a href="/fundraise/manage?a=2500">Get Started ></a>
</div>
</div>

<div class="vector-4">
<div class="vector-4-dot vector-info">
	<h1 class="BebasNeue" style="font-size: 80px;">$10,000</h1>
	A classroom is not just a place to learn, it’s a place where children grow and develop into the next generation of leaders.<br/><br/><br/>
	<a href="/fundraise/manage?a=10000">Get Started ></a>
</div>
</div>

<div class="vector-5">
<div class="vector-5-dot vector-info">
	<h1 class="BebasNeue" style="font-size: 80px;">$25,000</h1>
	An entire school? Now we’re getting somewhere. Your contribution can transform a whole region for years to come.<br/><br/><br/>
	<a href="/fundraise/manage?a=25000">Get Started ></a>
</div>
</div>
    
</div>     
         
</div>  -->
<!-------------------------------OLD STUFF------------------------------->              

        <!--  <div id="section1"> 
            
          <div id="splash_video"><iframe width="650" height="366" src="http://www.youtube.com/embed/7CQ8r-9SUvA" frameborder="0" allowfullscreen></iframe></div>-->
         
               <!-- <div id="splash_login" class="p_link">  -->
                    
   <!-- <?php 
        if ($loginId) {
    ?>
                    <div class="platform-button-big"><a class="gold_button" href="/fundraise/manage">Create a Campaign</a></div>                    
     <?php 
        } else {
    ?>   
                    <div class="platform-button-big"><a class="gold_button" href="/signup">Create a Campaign</a></div><br/>
                    <div class="platform-button-big"><a class="gold_button" href="/login">Login</a></div><br/>
     <?php 
        }
     ?>
                </div>
                 
            <span class="clear"></span>      
        
        </div>-->


         // end of OLD STUFF, commented in PHP to avoid any possible issues 
         */ ?>

        <div id="section2">
            <div id="splash_infobar">
                <!--<div id="splash_box" class="light_grey even">
                    <div id="infobar_title">Schools Completed</div>
                    <div id="infobar_info" class="BebasNeue"><?php echo countProjects("Completed Schools", false); ?></div>
                </div>-->
                <div id="splash_box" class="light_grey even" >
                    <div id="infobar_title">Raised in 2012</div>
                    <hr>
                    <div id="infobar_info" class="BebasNeue">$<?php echo number_format($stats->campaignTotal,0); ?></div>
                </div>
                <!--<div id="splash_box" class="light_grey even">
                    <div id="infobar_title">Total Donors</div>
                    <hr>
                </div>-->
                <div id="splash_box" class="light_grey even">
                    <div id="infobar_title">Total Campaigns</div>
                    <hr>
                    <div id="infobar_info" class="BebasNeue"><?php echo $stats->fundCount; ?></div>
                </div>
                <div id="splash_box" class="light_grey even">
                    <div id="infobar_title">Total Groups</div>
                    <hr>
                    <div id="infobar_info" class="BebasNeue"><?php echo $stats->groupCount; ?></div>
                </div>
                <div id="splash_box" class="light_grey even">
                    <div id="infobar_title">Classrooms Built</div>
                    <hr>
                    <div id="infobar_info" class="BebasNeue"><?php echo number_format($stats->campaignTotal,0)/10; ?></div>
                </div>
                <!--<div id="splash_box" class="light_grey even">
                    <div id="infobar_title">Children Educated</div>
                    <hr>
                </div>-->
                <span class="stretch"></span> 
            </div>
            <span class="clear"></span>
           
            
        </div>
        <div class="impact_graphic">
                <div id="impact_graphic">
                        <ul class="tt-wrapper">
				<li><a class="tt-gplus" href="#"><span>$25 can provide a student with one full year of access to education.</span></a></li>
				<li style="left: 125px;"><a class="tt-twitter" href="#"><span>$250 trains one teacher to better prepare a classroom of students to succeed.</span></a></li>
				<li  style="left: 250px;"><a class="tt-dribbble" href="#"><span>$10,000 allows a community to build a new school classroom.</span></a></li>
				<li style="left: 375px;"><a class="tt-facebook" href="#"><span>$25,000 funds the building of a brand new school that will change lives for years.</span></a></li>
                                <span class="stretch"></span>
			</ul>
                        <div>
                            <div class="rotate">Student</div>
                            <div class="rotate">Teacher</div>
                            <div class="rotate">Classroom</div>
                            <div class="rotate">School</div>
                            <span class="stretch"></span>
                        </div>
                        <div>
                            <div id="amt">$25</div>
                            <div id="amt">$250</div>
                            <div id="amt">$10,000</div>
                            <div id="amt">$25,000</div>
                            <span class="stretch"></span>
                        </div>
                    </div>
                    <div id="understand" class="text_gold"><img src="<?php bloginfo('template_directory'); ?>/gfx/understand_your_impact.png"></div>
        </div>    
        <div class="clearfix"></div>
        <?php /* ><div id="section3">
                    <div id="splash_donors" class="p_link">
                        <div  id="splash_donors_inner">
                            <div id="splash_section3_header" class="BebasNeue text_gold">Most Generous Donors</div>
                            <!--<ul id="sti-menu" class="sti-menu">
                            <?php
                                    usort($donateArray, array("Donation", "sort_amount"));
                                    foreach ($donateArray as &$donation) {
                                        ?>  
                               <!-- <li data-hovercolor="black">
                                    <a href="/userprofile?u=<?php echo $donation->contact ?>">
                                        <?php $pieces = explode(" Donation to ", $donation->name); 
                                        if ($donation->anonymous=='true') {
                                        ?>
                                        <!--<img src="<?php echo $photopath ?>"  data-type="icon" class="sti-icon sti-icon-care sti-item">-->
                                    <!--    <h2 data-type="mText" class="sti-item">Anonymous<br /><span> donated $<?php echo number_format($donation->amount,2); ?> to </span></h2>
                                        <h3 data-type="sText" class="sti-item"><?php echo $pieces[1]; ?></h3>
                                        <span data-type="icon" class="sti-icon sti-icon-care sti-item"></span>
                                            <?php
                                        }
                                        else {
                                        ?>
                                        <!--<img src="<?php echo $photopath ?>" data-type="icon" class="sti-icon sti-icon-care sti-item">-->
                                    <!--    <h2 data-type="mText"  class="sti-item"> <?php echo $pieces[0]; ?><br /><span>donated $<?php echo number_format($donation->amount,2); ?> to </span></h2>
                                        <h3 data-type="sText" class="sti-item"><?php echo $pieces[1]; ?></h3>
                                        <span data-type="icon" class="sti-icon sti-icon-care sti-item"></span>
                                            <?php
                                        }
                                        ?> 
                                        </a>
                                </li>-->
                                
                                    <div id="section3_activity_user">
                                        <!-- <div id="section3_user_date"><?php echo $donation->date; ?></div>-->
                                        <?php $pieces = explode(" Donation to ", $donation->name); 
                                        if ($donation->anonymous=='true') {
                                        ?>
                                        <div id="section3_user_info">Anonymous - $<?php echo number_format($donation->amount,2); ?> donated to <a href="/fundraise/fundraiser?f=<?php echo $donation->fundraiser; ?>"><?php echo $pieces[1]; ?></a></div>
                                        <?php
                                        }
                                        else {
                                        ?>
                                       <div id="section3_user_info"><?php $donation->contact; echo $pieces[0]; ?> - $<?php echo number_format($donation->amount,2); ?> donated to <a href="/fundraise/fundraiser?f=<?php echo $donation->fundraiser; ?>"><?php echo $pieces[1]; ?></a></div>
                                        <?php
                                        }
                                        ?>                                        
                                    </div>
                                        <?php
                                    } 
                                    if (count($donateArray)==0) {
                                        ?>
                                        No Donations to Display
                                        <?php
                                    }
                            ?>   
                                        </ul>
                            </div>
                        </div>
                        <div id="splash_campaigns" class="p_link">
                        <div id="splash_section3_header" class="BebasNeue text_gold">Featured Fundraisers</div>
                        <ul id="sti-menu" class="sti-menu">
                        <?php
                                $i=-1;
                                foreach ($fundraisersArray as &$fund) {
                                    $i++;
                        ?>
                        <?php if ($fund->id!='a0GU0000004ykBtMAI') { ?>
                            <li data-hovercolor="black">
                                
                                    <a href="/fundraise/fundraiser?f=<?php echo $fund->id; ?>">
                                            <h2 data-type="mText" class="sti-item" style="font-size: 14px;">
                                                <span style="font-size: 20px;"><?php echo $i; ?><br /></span>
                                                    <?php echo $fund->name; ?>
                                            </h2>
                                            <h3 data-type="sText" class="BebasNeue sti-item" style="font-size: 30px; margin-top: 0;">$<?php echo number_format($fund->raised,0); ?></h3>
                                            <span data-type="icon" class="sti-icon sti-icon-care sti-item"></span>
            </span>
                                    </a>
                                
                            </li>
                            <?php } ?>
                        
                                    <!--<div id="section3_donors_content">
                                        <div id="donor_name"><?php echo $i; ?>. <a href="/fundraise/fundraiser?f=<?php echo $fund->id; ?>"><?php echo $fund->name; ?></a></div>
                                        <div id="donor_amt" class="BebasNeue">$<?php echo number_format($fund->raised,0); ?></div>
                                    </div>  -->                    
                                   <!-- <?php
                                } 
                                if (count($fundraisersArray)==0) {
                                    ?>
                                    No Fundraisers to Display
                                    <?php
                                }
                        ?>  -->
                                    </ul>
                        </div></div>< */ ?>
        <span class="clear"></span>
            <div style="margin: 30px 0px 50px 0px;">
             <div id="splash_find">
                <div  id="splash_find_inner">
                    <div id="featured_header" class="BebasNeue text_gold">Find a Campaign or Group</div>
                    <a class="grey_button" href="/fundraise/browse">Browse Campaigns</a>
                    <a class="grey_button" href="/groups/browse">Browse Groups</a>
                </div>
                
            </div>
            <div id="splash_featured">
                <div>
                    <div id="featured_header" class="BebasNeue text_gold p_link">Campaign of the Week</div>
                        <?php
                        $photopath = '/wp-content/themes/pencilsofpromise/gfx/platform_avatar_blank.png';
                        if ($fund->photo!='') {
                            $photopath = $fund->photo;
                        }
                        ?>
                <div id="featured_image"><a href="/fundraise/fundraiser?f=<?php echo $fund->id; ?>"><img src="<?php echo $photopath; ?>"></a></div>
                <div id="featured_title" class="p_link"><a href="/fundraise/fundraiser?f=<?php echo $fund->id; ?>"><?php echo $fund->name; ?></a></div>
                <div id="featured_status"><strong><?php echo percent($fund->raised, $fund->goal); ?>%</strong> of the <strong>$<?php echo number_format($fund->goal,0); ?></strong> campaign goal completed.</div>
                <div id="featured_donate" class="platform-button"><a class="gold_button" href="/join-the-movement/donate?f=<?php echo $fund->id; ?>">Donate</a></div>
                <div id="featured_info"><?php echo $fund->description; ?></div>
                <!--<span class="profile_link textright" style="margin-right: 50px;"><a href="/fundraise/fundraiser?f=<?php echo $fund->id; ?>">+<em>learn more</em></a></span>-->
                </div>
            </div>  
                </div>
            <span class="clear"></span> 
        </div>
    </div>
</div>

<?php
}
catch (Exception $e) {
    ?>
   <script type="text/javascript">
      <?php /* window.location= "/error?e=.<?php echo urlencode($e); ?>"; */ ?>
      window.location= "/error";
   </script>
   <?php
}
?>   
<?php get_footer(); ?>