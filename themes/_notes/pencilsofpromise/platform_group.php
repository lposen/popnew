<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Platform Group
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
    $cacheId = $groupId;
    $cacheHolder = array();
    $hasCache=false;
    if ($doCache) {
        require_once ('Cache/Lite.php');
        $cacheOptions = array(
            'cacheDir' => 'platform-cache/group/',
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
    //GATHER ALL THE DATA IN ARRAYS AND OBJECTS
    //GROUP as object
    $group;
    if ($groupId) {
        if ($hasCache) {
            $group = $cacheHolder['group'];
        }
        else {
            $query = "SELECT Name, Description__c, Zip_Code__c, Total_Raised__c, Goal__c, School_Company_Affiliation__c, Photo_URL__c, Video_URL__c, Join_Type__c, Members__c,Fundraisers__c,Status__c FROM Group__c WHERE Id = '".$groupId."' AND Published__c = TRUE LIMIT 1";
            $response = $mySforceConnection->query($query);
            foreach ($response->records as $record) {
                $group=new Group($record->Id,$record->fields->Name,$record->fields->Description__c,$record->fields->Zip_Code__c,$record->fields->School_Company_Affiliation__c,$record->fields->Members__c,$record->fields->Goal__c,$record->fields->Total_Raised__c,$record->fields->Photo_URL__c,$record->fields->Join_Type__c,$record->fields->Fundraisers__c,$record->fields->Status__c);   
            };
            if ($group==null) { throw new Exception('Group does not exist'); }   
            if ($doCache) { $cacheHolder['group']=$group; }
        }
    }
    //is this user a member or admin of this group?
    $isMember=false; $isAdmin=false;
    if ($loginId) {
        $query = "SELECT id, Admin__c FROM Group_Member__c WHERE Group__c = '".$groupId."' AND Contact__c = '".$loginId."' LIMIT 1";
        $response = $mySforceConnection->query($query);
        foreach ($response->records as $record) {
            if ($record->fields->Admin__c=='true') {
                $isAdmin=true;
            } 
            else {
                $isMember=true;  
            }   
        }
    }
    //FUNDRAISERS in array
    $fundraisersArray = array();
    if ($hasCache) {
        $fundraisersArray=$cacheHolder['fundraisersArray'];
    }
    else {    
        $query = "SELECT id,Name,Description__c,Goal__c,Total_Raised__c,Photo_URL__c,Marketing_Campaign__c,isClub__c FROM Fundraiser__c WHERE id IN (SELECT Fundraiser__c FROM Group_Fundraiser__c WHERE Group__c = '".$groupId."') LIMIT 100";
        $response = $mySforceConnection->query($query);
        foreach ($response->records as $record) {
            $fundraisersArray[]=new FundraiserQuick($record->Id,$record->fields->Name,$record->fields->Description__c,$record->fields->Goal__c,$record->fields->Total_Raised__c,$record->fields->Photo_URL__c,$record->fields->Marketing_Campaign__c,$record->fields->isClub__c);
        };
        if ($doCache) { $cacheHolder['fundraisersArray'] = $fundraisersArray; }
    }
    //CLUB MEMBERS in array
    $membersArray = array();
    if ($hasCache) {
        $membersArray=$cacheHolder['membersArray'];
    }
    else {      
        $query = "SELECT id,Name,Photo_URL__c,Ripple_Effect__c FROM Contact WHERE id IN (SELECT Contact__c FROM Group_Member__c WHERE Group__c = '".$groupId."' AND Active__c = true) LIMIT 100";
        $response = $mySforceConnection->query($query);
        foreach ($response->records as $record) {
            $membersArray[]=new ContactQuick($record->Id,$record->fields->Name,$record->fields->Photo_URL__c,$record->fields->Ripple_Effect__c);
        };
        if ($doCache) { $cacheHolder['membersArray'] = $membersArray; }
    }
    //DONATIONS in Array
    $donateArray = array();
    if ($hasCache) {
        $donateArray=$cacheHolder['donateArray'];
    }
    else {
        if (($group->raised) > 0) {
            $query = "SELECT id,CloseDate,Name,Amount,Platform_User__c,Fundraiser__c, Anonymous__c FROM Opportunity WHERE Fundraiser__c in (SELECT Fundraiser__c FROM Group_Fundraiser__c WHERE Group__c = '".$groupId."') LIMIT 40";
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
<div id="platform">
        <div id="club">
            <div id="club_header">
                <span><?php echo $group->name; ?></span>
                <?php
                            if ($isMember && !$isAdmin) {
                               ?>
                               <?php
                            }
                            else if ($loginId && !$isAdmin && $group->jointype == "Open Join") {
                               ?>
                <span class="profile_link" class="gold_button" style="margin-left: 10px;"><a href="/process?g=<?php echo $groupId; ?>&u=<?php echo $loginId; ?>&groupjoin=1">+<span>Join This Group</span></a></span></div>      
                               <?php
                            } 
                            else if (!$loginId){
                                ?>
                <span class="profile_link"  class="gold_button" style="margin-left: 10px;"><a href="/signup">+<span>Sign Up to join groups</span></a></span></div>  
                                <?php
                            }
                            ?>
                <?php if ($isAdmin) { ?>
                <span class="gray_link right"><a href="/groups/manage?g=<?php echo $groupId; ?>">Edit Group Profile</a></span>
                <?php } ?>
            </div>
            <hr>
            <div id="club_body">
                <div id="section1">
                    <div id="club_main">
                        <div id="club_progress_external">
                            <div class="BebasNeue heading">Our Progress</div>
                            <div id="club_stats">
                                <div id="club_box" class="light_grey">
                                    <div id="club_box_heading">Total Raised</div>
                                    <div id="club_box_stats" class="text_gold BebasNeue">$<?php echo number_format($group->raised,2); ?></div>
                                </div>
                            </div>
                            <div id="club_stats" class="light_grey">
                                <div id="club_box">
                                    <div id="club_box_heading" >Overall Goal</div>
                                    <div id="club_box_stats" class="text_gold BebasNeue">$<?php echo number_format($group->goal,0); ?></div>
                                </div>
                            </div>
                            <div id="club_stats" class="light_grey">
                                <div id="club_box">
                                    <div id="club_box_heading">Fundraisers</div>
                                    <div id="club_box_stats" class="text_gold BebasNeue"><?php echo number_format($group->fundraisers,0); ?></div>
                                </div>
                            </div>
                            <div id="club_stats" class="light_grey">
                                <div id="club_box">
                                    <div id="club_box_heading">% Complete</div>
                                    <div id="club_box_stats" class="text_gold BebasNeue"><?php echo percent($group->raised, $group->goal); ?>%</div>
                                </div>
                            </div>
                            <span class="stretch"></span>
                        </div>
                        <div id="club_status_external">
                            <div  id="club_status_heading" class="BebasNeue heading inline" style="width: auto;">Status</div>
                            <?php if ($isAdmin) { ?>
                            <span class="profile_link" style="margin-left: 10px;"><a href="/groups/manage?g=<?php echo $groupId; ?>">+<span>edit status</span></a></span>
                            <?php } ?>  
                            
                            <div id="club_status_info_external">
                                <?php echo $group->status; ?>
                            </div>
                                                 
                        </div>​
                        <div id="club_info_box_external">
                            <span id="club_info_heading_external" class="BebasNeue heading inline">Meet <?php echo $group->name; ?></span>
                            <span id="location"><?php echo $group->zip; ?></span>
                            <?php if ($isAdmin) { ?>
                            <span class="profile_link"><a href="/groups/manage?g=<?php echo $groupId; ?>">+<span>edit group</span></a></span>
                            <?php } ?>  
                            <div id="club_info_external" >
                                <?php 
                                if ($group->description == "|defaultdescription|") {
                                    $platform_options = get_option('pop_platform_options');
                                    $placeholder = $platform_options['platform_group_copy'];                              
                                    $group->description = $placeholder;
                                }
                                echo $group->description; 
                                ?> 
                            </div>​​​                            
                            
                        </div>
                        <div id="club_buttons_external">
                            <?php
                            if ($isMember && !$isAdmin) {
                               ?>
                                <div class="platform-button-big" style="float:left; height:60px; width:200px;"><a style="margin-left: 0;" class="grey_button" href="/process?g=<?php echo $groupId; ?>&u=<?php echo $loginId; ?>&groupleave=1"/>Leave This Group</a></div>
                               <?php
                            }
                            else if ($loginId && !$isAdmin && $group->jointype == "Open Join") {
                               ?>
                                <a style="margin-left: 0; margin-top: 20px; padding: 15px 50px;" style="float:left; height:60px; width:200px;" class="grey_button" href="/process?g=<?php echo $groupId; ?>&u=<?php echo $loginId; ?>&groupjoin=1"/>Join This Group</a>    
                               <?php
                            }
                            ?>
                           <!-- <a style="margin-top: 20px; padding: 15px 40px;" class="grey_button" href="/join-the-movement/donate?g=<?php echo $groupId; ?>"/>Donate</a>  -->
                        </div>​
                    </div>
                    <div id="section1_leftsidebar">
                        <?php
                        $photopath = '/wp-content/themes/pencilsofpromise/gfx/platform_avatar_blank.png';
                        if ($group->photo!='') {
                            $photopath = $group->photo;
                        }
                        ?>                        
                        <div id="club_picture"><img src="<?php echo $photopath; ?>" ></div>
                        <?php if ($isAdmin) { ?>
                        <span class="profile_link profile_link_block" style="margin-top: 5px;"><a href="/groups/manage?g=<?php echo $groupId; ?>&n=1">+<span>edit group picture</span></a></span>
                        <?php } ?>                         
                        <div id="members">
                            <div id="club_members_header">
                            <?php
                                $members=0;
                                foreach ($membersArray as &$contact) {
                                    if ($contact->hasName) {
                                        $members++;   
                                    }
                                }
                            ?>
                                <span style="padding-right: 10px;"><?php echo number_format($members,0); ?> Member<?php if ($group->members > 1) { echo 's'; } ?></span>
                                <?php
                                if ($groups->members > 4 && 1==2) { //hiding for now
                                ?>
                                    <span style="padding-left: 10px; display: inline-block; border-left: 2px solid black;"><a href="#">See All</a></span>    
                                <?php
                                }
                                ?>
                            
                            </div>
                            <div id="members_pic">                                    
                            <?php
                                foreach ($membersArray as &$contact) {
                                    if ($contact->hasName) {
                                        $photopath = '/wp-content/themes/pencilsofpromise/gfx/platform_images/User.png';
                                        if ($contact->photo!='') {
                                            $photopath = $contact->photo;
                                        }
                                ?>

                                <?php // This checks if the current user id matches the userSalesForce ID
                                    if($contact->id == $current_user->userSalesforce) {
                                ?>
                                    <div><a href="/userprofile" title="<?php echo $contact->name; ?>"><img width="60" height="60" class="img_centered" src="<?php echo $photopath; ?>"></a></div>
                                <?php } else { ?>
                                    <div><a href="/userprofile?u=<?php echo $contact->id; ?>" title="<?php echo $contact->name; ?>"><img width="60" height="60" class="img_centered" src="<?php echo $photopath; ?>"></a></div>
                                <?php // end of its not admin and else
                                    }
                                ?>

                                <?php
                                        }
                                    };       
                                ?>
                               
                            </div>
                            <?php if ($isAdmin) { ?>
                            <span class="profile_link"><a href="/groups/manage?g=<?php echo $groupId; ?>&n=2">+<span>manage members</span></a></span>
                            <?php } ?>  
                        </div>
                        <div id="club_social">
                            <span class="st_facebook_custom" id="facebook" st_title="<?php echo $group->name; ?>" st_image="<?php echo $group->photo; ?>"  st_summary="<?php echo $group->description; ?>"><img src="<?php bloginfo('template_directory'); ?>/gfx/platform_images/facebookicon.png"></span>
                            <span class='st_twitter_custom' displayText='Tweet' st_title="<?php echo $group->name; ?>" st_image="<?php echo $group->photo; ?>" st_summary="<?php echo $group->description; ?>"><img src="<?php bloginfo('template_directory'); ?>/gfx/platform_images/twittericon.png"></span>
                            <!--<span class='st_email_custom' displayText='Email' st_url="" st_title=""><img src="<?php bloginfo('template_directory'); ?>/gfx/platform_images/email.png"></span>-->
                            <div>Tell your friends about this group</div>
                        </div>
                        </div>
                    </div>
                      
            <hr style="margin-top: 35px; clear: both;">
            <div id="section2">
                <div id="club_fundraisers_external">
                                <span class="BebasNeue heading heading_private">Campaigns</span>
                                <?php if ($isAdmin) { ?>
                                <span class="profile_link"><a href="/fundraise/manage?g=<?php echo $groupId; ?>&t=g">+<span>create a new group campaign</span></a></span>&nbsp; &nbsp;
                                <?php } ?>       
                                <?php if ($isMember || $isAdmin) { ?>
                                <span class="profile_link"><a href="/fundraise/manage?g=<?php echo $groupId; ?>&t=p">+<span>create a personal campaign supporting this group</span></a></span>
                                <?php } ?> 
        <?php                        
        foreach ($fundraisersArray as &$fund) {
        ?>
                                 <div id="club_fundraiser_box" class="light_grey p_link">
                                    <span id="fundraiser_status" class="text_gold"><a href="/join-the-movement/donate?f=<?php echo $fund->id; ?>">DONATE</a></span>
                                    <div id="section1_campaign_private">
                                        <span id="fundraiser_heading" class="p_link"><a href="/fundraise/fundraiser?f=<?php echo $fund->id; ?>"><?php echo $fund->name; ?></a></span>
                                        <?php if ($fund->isclub=='Club Campaign') { ?>
                                        <span class="profile_link textright"><a href="/fundraise/manage?f=<?php echo $fund->id; ?>">+<span>manage</span></a></span>
                                        <?php } ?>
                                        <span class="stretch"></span>
                                    </div>
                                    <div id="fundraiser_table">
                                                <div id="fundraiser_stats" class="even border"><span class="BebasNeue">$<?php echo number_format($fund->goal,0); ?></span>  Goal</div>
                                                <div id="fundraiser_stats" class="even border"><span  class="BebasNeue">$<?php echo number_format($fund->raised,0); ?></span>  Raised</div>
                                                <div id="fundraiser_stats" class="even"><span  class="BebasNeue"><?php echo percent($fund->raised, $fund->goal); ?>% </span> Complete</div>
                                                <span class="stretch"></span>
                                    </div>
                                </div>                   
        <?php
        };
        if (count($fundraisersArray)==0) {
            ?>
            <div id="club_fundraiser_box" class="light_grey p_link">
                You Don't Have Any Campaigns
            </div>
        <?php
        }
        ?>
                               <?php /*<span class="private_link" style="float:right;"><a href="#">+<span>view all campaigns</span></a></span>*/ ?>
                    </div>
                      <div id="calendar_external"  class="p_link">
                            <span id="calendar_heading" class="BebasNeue heading heading_private" style="font-size: 22px;">Calendar</span>
                            <?php /*
                            <span class="profile_link"><a>+<span>create new event</span></a></span>
                            <div id="calendar_box" class="light_grey">
                                <span id="calendar_date">04/10/2012</span>
                                <span id="calendar_time">7:30 AM</span>
                                <div id="calendar_fundraiser_name"><a href="#">CENTRAL PARK 5k</a></div>
                                <div id="calendar_fundraiser_location">Central Park West and 80 St.</div>
                                <div id="calendar_social">
                                    <span id="social_icon" class="twitter"><a href="#"><img src="<?php bloginfo('template_directory'); ?>/gfx/platform_images/twittericon.png"></a></span>
                                    <span id="social_icon" class="facebook"><a href="#"><img src="<?php bloginfo('template_directory'); ?>/gfx/platform_images/facebookicon.png"></a></span>
                                    <span id="social_icon" class="googleplus"><a href="#"><img src="<?php bloginfo('template_directory'); ?>/gfx/platform_images/googleplusicon.png"></a></span>
                                </div>
                                <div id="calendar_button"><a href="#">+ Sign Up</a></div>
                                
                            </div>
                             */?>
                            <br/><br/>Coming Soon
                                
                </div>
            </div>
            <hr style="clear: both; margin-top: 60px;">
                <div id="section3"  class="p_link">
                    <div id="section3_donors">
                        <div id="section3_donors_heading" class="BebasNeue heading">Most Generous Donors</div>
                        <?php
                                usort($donateArray, array("Donation", "sort_date"));
                                foreach ($donateArray as &$donation) {
                                    ?>                          
                                    <div id="section3_activity_user">
                                        <?php $pieces = explode(" Donation to ", $donation->name); 
                                        if ($donation->anonymous=='true') {
                                        ?>
                                        <div id="section3_user_info">Anonymous donated $<?php echo number_format($donation->amount,2); ?> to <a href="/fundraise/fundraiser?f=<?php echo $donation->fundraiser; ?>"><?php echo $pieces[1]; ?></a></div>
                                        <?php
                                        }
                                        else {
                                        ?>
                                        <div id="section3_user_info"><a href="userprofile?=<?php echo $donation->contact ?>"><?php echo $pieces[0]; ?></a> donated $<?php echo number_format($donation->amount,2); ?> to <a href="/fundraise/fundraiser?f=<?php echo $donation->fundraiser; ?>"><?php echo $pieces[1]; ?></a></div>
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
                        <div id="section3_activity_content">                        
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
                                    No Recent Activity
                                    <?php
                                }
                        ?>                    
                         </div>
                    </div>
                </div>
            <hr>
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