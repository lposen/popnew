<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Platform Fundraiser
*/
?>


<?php get_header(); ?>

<!--<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>-->

<script type="text/javascript">
$(document).ready(function(){
    var campaign = ["birthday", "mixer", "campaign"];
    
})

</script>


<?php
//----------------------------- BACKEND CODE SECTION--------------------------------------//
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
    $cacheId = $fundId;
    $cacheHolder = array();
    $hasCache=false;
    if ($doCache) {
        require_once ('Cache/Lite.php');
        $cacheOptions = array(
            'cacheDir' => 'platform-cache/fundraiser/',
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
    //GATHER ALL THE DATA IN ARRAYS AND OBJECTS (and sort out caching)
    //FUNDRAISER as object
    $isGroup = false;
    $fund;
    if ($fundId) {
        if ($hasCache) {
            $fund = $cacheHolder['fund'];
        }
        else {
            $query = "SELECT Name, Type__c, Impact__c, Description__c, Status__c, Photo_URL__c, Video_URL__c, Goal__c, Total_Raised__c, Marketing_Campaign__c, isClub__c FROM Fundraiser__c WHERE Id = '".$fundId."' LIMIT 1";
            $response = $mySforceConnection->query($query);
            foreach ($response->records as $record) {
                $fund = new Fundraiser($record->Id,$record->fields->Name,$record->fields->Type__c,$record->fields->Impact__c,$record->fields->Description__c,$record->fields->Status__c,$record->fields->Goal__c,$record->fields->Total_Raised__c,$record->fields->Photo_URL__c,$record->fields->Video_URL__c,$record->fields->Marketing_Campaign__c,$record->fields->isClub__c);
                if ($doCache) { $cacheHolder['fund']=$fund;}
            };
        }
    }
    if ($fund->marketing) {
        $marketing=$fund->marketing;
    }
    //GROUP and CONTACT as objects
    $group;$contact;
    $isAdmin=false;
    $isGroup=false;
    if ($fund->isclub && $fund->isclub!="No") {
        $isGroup=true;     
    }
    if ($isGroup) { //it's a group fundraiser
        if ($hasCache) {
            $group = $cacheHolder['group'];
        }
        else {        
            $query = "SELECT id,Name,Description__c,Members__c,Total_Raised__c,Goal__c,Photo_URL__c,Fundraisers__c FROM Group__c WHERE id IN (SELECT Group__c FROM Group_Fundraiser__c WHERE Fundraiser__c = '".$fundId."') LIMIT 1";
            $response = $mySforceConnection->query($query);
             foreach ($response->records as $record) {
                $group=new GroupQuick($record->Id,$record->fields->Name,$record->fields->Description__c,$record->fields->Members__c,$record->fields->Total_Raised__c,$record->fields->Goal__c,$record->fields->Photo_URL__c,$record->fields->Fundraisers__c);
            };
            if ($doCache) { $cacheHolder['group']=$group; }
        }
        if ($loginId) { //check if this is a group admin
            $query = "SELECT id,Admin__c FROM Group_Member__c WHERE Contact__c = '".$loginId."' AND Group__c = '".$group->id."' LIMIT 1";
            $response = $mySforceConnection->query($query);
            foreach ($response->records as $record) {
                if ($record->fields->Admin__c=='true') {
                    $isAdmin=true;
                }           
            };
        }
    }
    $hasContact=false;
    if ($hasCache) {
        $contact = $cacheHolder['contact'];
        $hasContact = $cacheHolder['hasContact'];
    }
    else {
        $query = "SELECT id,Name,Photo_URL__c,Ripple_Effect__c,Marketing_Campaign__c FROM Contact WHERE id IN (SELECT Contact__c FROM Contact_Fundraiser__c WHERE Fundraiser__c = '".$fundId."') LIMIT 1";
        $response = $mySforceConnection->query($query);
        foreach ($response->records as $record) {
            $contact = new ContactQuick($record->Id,$record->fields->Name,$record->fields->Photo_URL__c,$record->fields->Ripple_Effect__c,$record->fields->Marketing_Campaign__c);
            if ($doCache) { $cacheHolder['contact']=$contact; }
            $hasContact=true;
            if ($doCache) { $cacheHolder['hasContact']=$hasContact; }
        }
    }
    if ($hasContact && $contact->id == $loginId) {
        $isAdmin=true;
    }        
    //DONATIONS in Array
    $donateArray = array();
    if (($fund->raised) > 0) {
        if ($hasCache) {
            $donateArray=$cacheHolder['donateArray'];
        }
        else {
            $query = "SELECT id,CloseDate,Name,Amount,Platform_User__c,Fundraiser__c,Anonymous__c FROM Opportunity WHERE Fundraiser__c = '".$fundId."' LIMIT 400";
            $response = $mySforceConnection->query($query);
            foreach ($response->records as $record) {
                $donateArray[]=new Donation($record->Id,$record->fields->CloseDate,$record->fields->Name,$record->fields->Amount,$record->fields->Platform_User__c,$record->fields->Fundraiser__c,$record->fields->Anonymous__c);
            };
            if ($doCache) { $cacheHolder['donateArray'] = $donateArray; }
        }
    }
    if ($doCache && !$hasCache) {
        $cache->save($cacheHolder, $cacheId);
    }
?>



<?php
//----------------------------- DISPLAY CODE SECTION--------------------------------------//
?>
<div id="platform">

<!-----------------------------------------NEW-------------------------------------->    
        <div id="fundraising">
            
                <?php
                if ($marketing) {
                    $assets = new Pod('ipromise_campaign');
                    $assets->findRecords('t.name ASC', -1, 't.salesforce_identifier LIKE "'.$marketing.'"');
                    while($assets->fetchRecord()) {
                    $image_raw = $assets->get_field('fundraiser_banner');
                    $image = $image_raw[0]['guid'];
                    }
                ?>   
                    <img src="<?php echo $image; ?>">   
                <?php
                } else {
                ?>
                    <img src="<?php bloginfo('template_directory'); ?>/gfx/platform_images/banner_fundraising2.jpg">
                <?php
                }
                ?>            
            
            <div id="fundraising_body">
                <div id="section1">                 
                    <div id="fundraising_main">
                       <div id="fundraising_stats">
                            <div id="fundraising_stats_button">
                                <div id="fundraising_stats_amt">
                                    <div class="BebasNeue ">
                                        $<?php echo number_format($fund->raised,2); ?>
                                    </div>
                                    <p>
                                        <?php echo intval($fund->raised)/25; ?>
                                        students educated
                                    </p>
                                </div>
                                <div id="title">Amount Raised</div>
                            </div>
                            <div id="fundraising_stats_button">
                                <div id="fundraising_stats_amt">
                                    <div class="BebasNeue ">
                                        $<?php echo number_format($fund->goal,0); ?>
                                    </div>
                                    <p>
                                        <?php echo intval($fund->goal)/25; ?>
                                        students educated
                                    </p>
                                </div>
                                <div id="title">Goal</div>
                            </div>
                        </div>
                        <div id="fundraising_thermometer">
                           <div style="background:#ececec; width: 100%; height: 50px; margin-top: 10px; -webkit-border-radius: 5px;-moz-border-radius: 5px; border-radius: 5px;">
                               <div style="background-color:#FEBC11; -webkit-border-radius: 5px;-moz-border-radius: 5px; border-radius: 5px; height:100%; width:<?php echo percent($fund->raised, $fund->goal); ?>%;"></div>
                           </div>
                           <div id="percent_complete" style="margin-top: 12px;"><?php echo percent($fund->raised, $fund->goal); ?>% complete</div>
                       </div>
                        <div id="fundraising_donate">
                            <a id="fundraising_donate_button" class="gold_button" href="/join-the-movement/donate?f=<?php echo $fundId; ?>&d=25" >DONATE $25 </a>
                            <a id="fundraising_donate_button" class="gold_button" href="/join-the-movement/donate?f=<?php echo $fundId; ?>&d=100">DONATE $100</a>
                            <a id="fundraising_donate_button" class="gold_button" href="/join-the-movement/donate?f=<?php echo $fundId; ?>&d=250">DONATE $250</a>
                            <a id="fundraising_donate_button" class="gold_button" href="/join-the-movement/donate?f=<?php echo $fundId; ?>&d=25">ANOTHER AMOUNT</a>
                            <span class="stretch"></span>
                        </div>
                        
                        
                    </div>                    
                    <div id="section1_leftsidebar">
                        
                        <?php
                        $photopath = '/wp-content/themes/pencilsofpromise/gfx/platform_avatar_blank.png';
                        if ($fund->photo!='') {
                            $photopath = $fund->photo;
                        }
                        else if ($isGroup && !$hasContact && $group->photo!=null) {
                            $photopath = $group->photo;  
                        }
                        else if ($contact->photo!=null) {
                            $photopath = $contact->photo; 
                        }
                        ?>                        
                        
                        <div id="profile_picture">
                            <img src="<?php echo $photopath; ?>">
                        </div>   
                        <div id="fundraising_header" class="p_link">
                             <?php 
                                $casualName = '';
                                if ($isGroup && !$hasContact) {
                                $casualName = $group->name;
                            ?>
                            <a href="/groups/group?g=<?php echo $group->id; ?>" style="font-weight: lighter;">A Campaign by <?php echo $group->name; ?></a>
                                <?php } else { 
                                    $casualName = current(explode(' ',$contact->name));
                                    ?>
                                    <a href="/userprofile?u=<?php echo $contact->id; ?>" style="font-weight: lighter;">A Campaign by <?php echo $contact->name; ?></a>    
                                    <?php 
                                    if ($isGroup) {
                                    ?>
                                        <a href="/groups/group?g=<?php echo $group->id; ?>" style="font-weight: lighter;">supporting <?php echo $group->name; ?></a> 
                                    <?php 
                                    }
                                    ?> 
                                <?php } ?>  
                        </div>
                        <div id="fundraising_header_links" class="gray_link">
                            <?php
                            if ($isAdmin) {
                            ?>
                            <span style="border-right: 1px solid gray; padding-right: 5px;"><a href="/userprofile">My user profile</a></span>
                            <span style="padding-left: 5px;"><a href="/fundraise/manage?f=<?php echo $fundId; ?>">Edit campaign</a></span>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <hr>
                <div id="section2">
                    <div id="video" class="right">
                         <?php
                            if ($fund->video && strpos($fund->video,'youtube.com/watch?v=')) {
                                $videoid=substr($fund->video,strpos($fund->video,'youtube.com/watch?v=')+20);
                        ?>
                        <h1 style="text-transform:uppercase;">Watch <?php echo $casualName; ?>'s Video</h1>
                        <div id="fundraising_video">
                            <iframe width="600" height="350" src="http://www.youtube.com/embed/<?php echo $videoid ?>" frameborder="0" allowfullscreen></iframe>
                        </div>
                        <?php
                            } else {
                        ?>
                        <!-- <h1>THE NEXT 50 SCHOOLS.</h1> -->
                        <div id="fundraising_video">
                            <iframe width="600" height="338" src="http://www.youtube.com/embed/7CQ8r-9SUvA" frameborder="0" allowfullscreen=""></iframe>
                        </div>                        
                        <?php
                            }
                        ?>          
                    </div>
                    <div id="fundraising_info">
                        <h1><?php echo $fund->name; ?></h1>
                        <div id="social" class="social" style="padding: 10px 0px 20px 0px;">
                            <span class='st_twitter_hcount' displayText='Tweet' st_url="" st_title=""></span>
                            <span class='st_facebook_hcount' displayText='Facebook' ></span><!--<div class="fb-like" data-send="true" data-width="450" data-show-faces="false"></div>-->                                                                                            
                        </div>
                        <p><?php 
                            //if it's not a custom description then reset it
                            if ($fund->description == "|defaultdescription|") {
                                $platform_options = get_option('pop_platform_options');
                                $placeholder = $platform_options['platform_fundraiser_copy'];                              
                                $fund->description = $placeholder;
                            }
                            echo $fund->description;                
                        ?></p>
                        <div>
                            <span class="BebasNeue" style="margin-right: 5px; vertical-align: middle;   ">Page URL:</span><input type="text" style="width:120px; font-size:11px;" onclick="selectAll('bitly-link')" id="bitly-link" value="<?php echo bitlyLink(curPageURL()); ?>"/>
                        </div>
                    </div>
                </div>
                <hr style="clear: both;">
                <div id="section3a">
                    <img src="<?php bloginfo('template_directory'); ?>/gfx/platform_images/wave.png" style="position: relative; left: 15px;">
                    <div style="text-align: justify; position: relative;" id="fund_ripple">
                        <div id="ripple">Ripple Effect</div>
                        <?php /*
                        <!--<div id="fundraising_stats_button">
                            <div id="fundraising_stats_amt">
                                <div class="BebasNeue ">
                                    $<?php echo number_format($contact->ripple,2); ?>
                                </div>
                                <p>
                                    <?php echo number_format($contact->ripple,2)/25; ?>
                                    students educated
                                </p>
                            </div>
                        </div>-->
                        */ ?>
                        <img src="<?php bloginfo('template_directory'); ?>/gfx/arrow.png">
                        <span class="ripple_link">
                            <a class="tt-ripple">
                                <span>
                                    <em>COMING SOON: </em>When friends create their own campaign through your page, we credit this towards your Ripple Effect. 
                                </span>
                            </a>
                        </span>
                            <?php if ($loginId) { ?>
                            <a  class="gold_button" href="/fundraise/manage?l=<?php echo $contact->id ?>">Create a Page <br> Like This</a>
                            <?php } else { ?>
                            <a  class="gold_button" href="/signup?l=<?php echo $contact->id ?>">Create a Page <br> Like This</a>
                            <?php } ?>
                        
                        <span class="stretch"></span>
                    </div>
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
                <hr style="clear: both; position: relative; top: -60px;">
                <div id="section3" style="position: relative; top: -70px;">
                    
                    <div id="section3_donors" class="p_link">
                        <div id="section3_donors_heading" class="BebasNeue heading">Most Generous Donors</div>
                        <?php
                                usort($donateArray, array("Donation", "sort_amount"));
                                $donateArray = array_slice($donateArray, 0, 9);
                                foreach ($donateArray as &$donation) {
                                    ?>                          
                                    <div id="section3_activity_user">
                                        <?php $pieces = explode(" Donation to ", $donation->name); 
                                        if ($donation->anonymous=='true') {
                                        ?>
                                        <div id="section3_user_info">Anonymous donated $<?php echo number_format($donation->amount,2); ?> <!--donated to <a href="/fundraise/fundraiser?f=<?php echo $donation->fundraiser; ?>"><?php echo $pieces[1]; ?></a>--></div>
                                        <?php
                                        }
                                        else {
                                        ?>
                                        <div id="section3_user_info"><?php echo $pieces[0]; ?> donated $<?php echo number_format($donation->amount,2); ?><!--donated to <a href="/fundraise/fundraiser?f=<?php echo $donation->fundraiser; ?>"><?php echo $pieces[1]; ?></a>--></div>
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
                    </div>
                    <div id="section3_activity" class="p_link">
                        <div id="section3_activity_header" class="BebasNeue heading">Activity Feed</div>
                        <?php
                                usort($donateArray, array("Donation", "sort_date"));
                                $donateArray = array_slice($donateArray, 0, 9);
                                foreach ($donateArray as &$donation) {
                                    ?>                          
                                    <div id="section3_activity_user">
                                        <?php $pieces = explode(" Donation to ", $donation->name); 
                                        if ($donation->anonymous=='true') {
                                        ?>
                                        <div id="section3_user_info"><!--<?php echo $i; ?>.--> $<?php echo number_format($donation->amount,2); ?> was donated by Anonymous <!-- to <a href="/fundraise/fundraiser?f=<?php echo $donation->fundraiser; ?>"><?php echo $pieces[1]; ?></a>--></div>
                                        <?php
                                        }
                                        else {
                                        ?>
                                        <div id="section3_user_info"><!--<?php echo $i; ?>.--> $<?php echo number_format($donation->amount,2); ?> was donated by <?php $donation->contact; echo $pieces[0]; ?> <!-- to <a href="/fundraise/fundraiser?f=<?php echo $donation->fundraiser; ?>"><?php echo $pieces[1]; ?></a>--></div>
                                        <?php
                                        }
                                        ?>                                        
                                    </div> 
                                    <?php
                                } 
                                if (count($donateArray)==0) {
                                    ?>
                                    No Recent Activity
                                    <?php
                                }
                        ?>                         
                    </div>

                </div>

            <hr>
            </div>
        </div>    
    
<!-----------------------------------------NEW-------------------------------------->        
    
    
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
   
< 


    
<?php get_footer(); ?>

