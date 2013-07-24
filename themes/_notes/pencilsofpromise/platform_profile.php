<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Platform Profile
*/
?>

<?php get_header(); ?>

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
    $cacheId = $contactId;
    $cacheHolder = array();
    $hasCache=false;
    if (!$contactId) { $doCache=false; }
    if ($doCache) {
        require_once ('Cache/Lite.php');
        $cacheOptions = array(
            'cacheDir' => 'platform-cache/profile/',
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
<div id="platform">

<?php
if ($loginId==null && $contactId==null) {
    ?>
   <script type="text/javascript">
      window.location= "/login?p=.<?php echo urlencode($_SERVER["REQUEST_URI"]); ?>";
   </script>
   <?php
}
else {
?>

 <?php
    //GATHER ALL THE DATA IN ARRAYS AND OBJECTS
    //CONTACT as object
    $contact;
    if ($hasCache) {
        $contact=$cacheHolder['contact'];
    }
    else {    
        if ($contactId) { //not the profile of the logged in user
            $query = "SELECT id,Name,Description__c,Status__c,Goal__c,Total_Raised__c,npo02__TotalOppAmount__c,Photo_URL__c, Ripple_Effect__c FROM Contact WHERE id = '".$contactId."' AND Platform_User__c=true LIMIT 1";            
        }
        else {
            $query = "SELECT id,Name,Description__c,Status__c,Goal__c,Total_Raised__c,npo02__TotalOppAmount__c,Photo_URL__c,Ripple_Effect__c,Marketing_Campaign__c FROM Contact WHERE id = '".$loginId."' AND Platform_User__c=true LIMIT 1";            
        }
        $response = $mySforceConnection->query($query);
        foreach ($response->records as $record) {
            $contact = new Contact($record->Id,$record->fields->Name,$record->fields->Description__c,$record->fields->Status__c,$record->fields->Goal__c,$record->fields->Total_Raised__c,$record->fields->npo02__TotalOppAmount__c,$record->fields->Photo_URL__c,$record->fields->Ripple_Effect__c, $record->fields->Marketing_Campaign__c);
        }; 
        if ($doCache) { $cacheHolder['contact'] = $contact; }        
    }
    if ($contact==null) {
        throw new Exception('Account does not exist');
    }      
    //FUNDRAISERS in Array
    $fundraisersArray = array();
    if ($hasCache) {
        $fundraisersArray=$cacheHolder['fundraisersArray'];
    }
    else {          
        $query = "SELECT id,Name,Description__c,Goal__c,Total_Raised__c,Photo_URL__c,Marketing_Campaign__c FROM Fundraiser__c WHERE id IN (SELECT Fundraiser__c FROM Contact_Fundraiser__c WHERE Contact__c = '".$contact->id."') LIMIT 100";
        $response = $mySforceConnection->query($query);
        foreach ($response->records as $record) {
            $fundraisersArray[]=new FundraiserQuick($record->Id,$record->fields->Name,$record->fields->Description__c,$record->fields->Goal__c,$record->fields->Total_Raised__c,$record->fields->Photo_URL__c,$record->fields->Marketing_Campaign__c);
        };
        if ($doCache) { $cacheHolder['fundraisersArray'] = $fundraisersArray; }
    }
    //GROUPS in Array
    $groupsArray = array();
    if ($hasCache) {
        $groupsArray=$cacheHolder['groupsArray'];
    }
    else {    
        $query = "SELECT id,Name,Description__c,Members__c,Total_Raised__c,Goal__c,Photo_URL__c FROM Group__c WHERE id IN (SELECT Group__c FROM Group_Member__c WHERE Contact__c = '".$contact->id."') LIMIT 100";
        $response = $mySforceConnection->query($query);
         foreach ($response->records as $record) {
            $groupsArray[]=new GroupQuick($record->Id,$record->fields->Name,$record->fields->Description__c,$record->fields->Members__c,$record->fields->Total_Raised__c,$record->fields->Goal__c,$record->fields->Photo_URL__c,$record->fields->Fundraisers__c);
        };
        if ($doCache) { $cacheHolder['groupsArray'] = $groupsArray; }
    }
    //DONATIONS in Array
    $donateArray = array();
    if ($hasCache) {
        $donateArray=$cacheHolder['donateArray'];
    }
    else {     
        if (($contact->raised) > 0) {
            if ($contactId) {
                $query = "SELECT id,CloseDate,Name,Amount,Platform_User__c,Fundraiser__c,Anonymous__c FROM Opportunity WHERE Fundraiser__c in (SELECT Fundraiser__c FROM Contact_Fundraiser__c WHERE Contact__c = '".$contactId."') LIMIT 40";
            }
            else {
                $query = "SELECT id,CloseDate,Name,Amount,Platform_User__c,Fundraiser__c,Anonymous__c FROM Opportunity WHERE Fundraiser__c in (SELECT Fundraiser__c FROM Contact_Fundraiser__c WHERE Contact__c = '".$loginId."') LIMIT 40";
            }
            $response = $mySforceConnection->query($query);
            foreach ($response->records as $record) {
                $donateArray[]=new Donation($record->Id,$record->fields->CloseDate,$record->fields->Name,$record->fields->Amount,$record->fields->Platform_User__c,$record->fields->Fundraiser__c,$record->fields->Anonymous__c);
            };
        }
        if ($doCache) { $cacheHolder['donateArray'] = $donateArray; }
    }
    if ($doCache && !$hasCache) {
        $cache->save($cacheHolder, $cacheId);
    }    
 ?>
  
 <?php
//----------------------------- DISPLAY CODE SECTION --------------------------------------//
?>
       
<div id="profile">
            <div id="profile_header"  class="p_link">
                <span><a href="#"><?php echo $contact->name; ?>'s Profile</a></span>
<?php
if (!$contactId) {
?>                
                <span class="gray_link right"><a href="/usermanage">Edit Profile</a></span>
<?php
}
?>      
            </div>    
            <hr>
            <div id="profile_body">
                <div id="section1">
                    <div id="section1_main">
                       <div id="section1_buttons">
                            <div id="profile_button" class="even"><a href="/fundraise/manage" class="gold_button">Create Campaign</a></div>
                            <div id="profile_button" class="even"><a href="/groups/manage" class="gold_button">Create Group</a></div>
                            <?php //build the url for 
                            $UrlForBitly = curPageURL();
                            if (strpos($UrlForBitly,'?u=')==-1) {
                                $UrlForBitly.='?u='.$contact->id;
                            }
                            ?>
                            <div id="profile_button" class="light_grey even p_link" style="padding: 7px 23px;"><span class="BebasNeue" style="margin-right: 15px;">Copy This Link:</span><input type="text" onclick="selectAll('bitly-link')" id="bitly-link" value="<?php echo bitlyLink($UrlForBitly); ?>"/></div>
                            <span class="stretch"></span>                       
                        </div>​
                        <div id="section1_progress">
                            <div class="BebasNeue heading">Progress</div>
                            <div id="section1_progress_donated" >
                                <!--<div id="progress_box" class="light_grey even">
                                    <div id="progress_title">Donated</div>
                                    <div id="progress_info" class="BebasNeue text_gold">$<?php echo number_format($contact->donated,2); ?></div>
                                </div>-->
                                <div id="progress_box" class="light_grey even">
                                    <div id="progress_title">Raised</div>
                                    <div id="progress_info" class="BebasNeue text_gold">$<?php echo number_format($contact->raised,2); ?></div>
                                </div>
                                <div id="progress_box" class="light_grey even">
                                    <div id="progress_title">Ripple Effect</div>
                                    <div id="progress_info" class="BebasNeue text_gold">$<?php echo number_format($contact->ripple,2); ?></div>
                                </div>
                                <div id="progress_box" class="light_grey even">
                                    <div id="progress_title">Share <?php echo current(explode(' ',$contact->name)); ?>'s<br> Progress</div>
                                    <div id="social">
                                        <span class='st_twitter_custom' displayText='Tweet' st_url="" st_title=""><img src="<?php bloginfo('template_directory'); ?>/gfx/platform_images/twittericon.png"></span>
                                        <span class='st_facebook_custom' displayText='Facebook' st_url="" st_title=""><img src="<?php bloginfo('template_directory'); ?>/gfx/platform_images/facebookicon.png"></span>
                                        <!--<span class='st_email_custom' displayText='Email' st_url="" st_title=""><img src="<?php bloginfo('template_directory'); ?>/gfx/platform_images/email.png"></span>-->
                                    </div>
                                </div>
                            </div>​​​
                        </div>
                        <div id="section1_campaigns">
                            <span class="BebasNeue heading heading_private">Campaigns</span>
                            <?php
                            if (!$contactId) {
                            ?>                            
                            <span class="profile_link"><a href="/fundraise/browse">+<span>browse</span></a></span> &nbsp; <span class="profile_link"><a href="/fundraise/manage">+<span>create new</span></a></span>
                            <?php
                            }
                            ?>                            
                            
        <?php                        
        foreach ($fundraisersArray as &$fund) {
        ?>
                            <div id="section1_campaign" class="light_grey">
                                <span id="section1_campaigns_status" class="p_link"><a href="/join-the-movement/donate?f=<?php echo $fund->id; ?>">DONATE</a></span>
                                <div id="section1_campaign_private">
                                    <span id="section1_campaigns_heading" class="p_link"><a href="/fundraise/fundraiser?f=<?php echo $fund->id; ?>"><?php echo $fund->name; ?></a></span>
                                    <?php
                                    if (!$contactId) {
                                    ?>
                                    <span class="profile_link" style="margin-left: 10px;"><a href="/fundraise/manage?f=<?php echo $fund->id; ?>">+<span>manage</span></a></span>
                                    <?php
                                    }
                                    ?>
                                    <span class="stretch"></span>
                                </div>
                                <div id="section1_campaign_table">
                                            <div id="campaign_stats" class="even border"><span class="BebasNeue">$<?php echo number_format($fund->goal,0); ?></span>  Goal</div>
                                            <div id="campaign_stats" class="even border"><span  class="BebasNeue">$<?php echo number_format($fund->raised,0); ?></span>  Raised</div>
                                            <div id="campaign_stats" class="even"><span  class="BebasNeue"><?php echo percent($fund->raised, $fund->goal); ?>% </span> Complete</div>
                                            <span class="stretch"></span>
                                </div>
                            </div>                  
        <?php
        };
        if (count($fundraisersArray)==0) {
            ?>
            <div id="club_fundraiser_box" class="light_grey p_link">
                No Campaigns to display.
            </div>
        <?php
        }
        ?>                       
                        </div>
                    </div>
                    <div id="section1_leftsidebar">
                        <div id="profile_picture">
                            <a href="#">
                                    <?php
                                    $photopath = '/wp-content/themes/pencilsofpromise/gfx/platform_avatar_blank.png';
                                    if ($contact->photo!='') {
                                        $photopath = $contact->photo;
                                    }
                                    ?>
                                <img src="<?php echo $photopath; ?>">
                            </a>
                            <?php
                            if (!$contactId) {
                            ?>
                            <div class="profile_link profile_link_block"><a href="/usermanage">+<span>change profile picture</span></a></div>                            
                            <?php
                            }
                            ?>
                        </div>
                        <div id="groups">
                            <span id="groups_heading" class="BebasNeue heading heading_private" style="font-size: 22px;">Groups</span>
                            <?php
                            if (!$contactId) {
                            ?>
                            <span class="profile_link clearfix"><a href="/groups/browse">+<span>browse</span></a></span> <span class="profile_link"> &nbsp <a href="/groups/manage">+<span>create new</span></a></span>   
                            <?php
                            }
                            ?>                            
                        <?php
                                foreach ($groupsArray as &$group) {
                                    $photopath = '/wp-content/themes/pencilsofpromise/gfx/platform_avatar_blank.png';
                                    if ($group->photo!='') {
                                        $photopath = $group->photo;
                                    }                                    
                        ?>
                            <div id="group" class="light_grey">
                                <div id="group_name" class="p_link"><a href="/groups/group?g=<?php echo $group->id; ?>"><?php echo $group->name; ?></a></div>
                                <div id="group_pic"><a href="/groups/group?g=<?php echo $group->id; ?>"><img class="img_centered" src="<?php echo $photopath;?>"></a></div>
                                <div id="group_members"><?php echo number_format($group->members,0); ?> Members</div>
                                <div id="group_amtraised">$<?php echo number_format($group->raised,2); ?> Raised</div>
                            </div>                            
                                <?php
                             };       
                        ?>                            
                        </div>
                    </div>
                    
                </div>
            <hr style="clear: both; margin-top: 50px;">
                <div id="section2">
                    <div id="section2_donors" class="p_link">
                        <div id="section3_donors_heading" class="BebasNeue heading">Most Generous Donors</div>
                        <?php
                                usort($donateArray, array("Donation", "sort_amount"));
                                foreach ($donateArray as &$donation) {
                                    ?>                          
                                    <div id="section3_activity_user">
                                        <?php $pieces = explode(" Donation to ", $donation->name); 
                                        if ($donation->anonymous=='true') {
                                        ?>
                                        <div id="section3_user_info">Anonymous - $<?php echo number_format($donation->amount,2); ?> donated to <a href="/fundraise/fundraiser?f=<?php echo $donation->fundraiser; ?>"><?php echo $pieces[1]; ?></a></div>
                                        <?php
                                        }
                                        else {
                                        ?>
                                        <div id="section3_user_info"><?php $donation->contact; echo $pieces[0]; ?> - $<?php echo number_format($donation->amount,2); ?> to <a href="/fundraise/fundraiser?f=<?php echo $donation->fundraiser; ?>"><?php echo $pieces[1]; ?></a></div>
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
                    <div id="section2_activity" class="p_link" style="margin-right: 40px; ">
                        <div id="section3_activity_header" class="BebasNeue heading">Activity Feed</div>
                        <?php
                                usort($donateArray, array("Donation", "sort_date"));
                                foreach ($donateArray as &$donation) {
                                    ?>                          
                                    <div id="section3_activity_user">
                                        <?php $pieces = explode(" Donation to ", $donation->name); 
                                        if ($donation->anonymous=='true') {
                                        ?>
                                        <div id="section3_user_info">$<?php echo number_format($donation->amount,2); ?> donated to <a href="/fundraise/fundraiser?f=<?php echo $donation->fundraiser; ?>"><?php echo $pieces[1]; ?></a> by Anonymous</div>
                                        <?php
                                        }
                                        else {
                                        ?>
                                        <div id="section3_user_info">$<?php echo number_format($donation->amount,2); ?> donated to <a href="/fundraise/fundraiser?f=<?php echo $donation->fundraiser; ?>"><?php echo $pieces[1]; ?></a> by <?php $donation->contact; echo $pieces[0]; ?></div>
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
                    </div>                    
                    <div id="section2_leftsidebar">
                        <div id="section2_intro">
                            <?php
                            if (!$contactId) {
                            ?>
                            <span class="profile_link right"><a href="/usermanage">+<span>edit</span></a></span>
                            <?php
                            }
                            ?>
                            <div id="section2_intro_heading" class="BebasNeue heading">Meet <?php echo current(explode(' ',$contact->name)); ?></div>
                            <div id="section2_intro_info"><?php echo $contact->description; ?></div>
                        </div>
                        <hr>
                        <div id="section2_status">
                            <?php
                            if (!$contactId) {
                            ?>
                            <span class="profile_link right"><a href="/usermanage">+<span>update</span></a></span>
                            <?php
                            }
                            ?>
                            <div id="section2_status_heading" class="BebasNeue heading">Status</div>
                            <div id="section2_status_info" style="font-size: 14px; font-style: italic;"><?php echo $contact->status; ?></div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    
<?php
}
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
