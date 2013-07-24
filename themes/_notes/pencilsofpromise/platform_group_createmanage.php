<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Platform Create Manage Groups
*/
?>

<?php get_header(); ?>
<script src="/wp-content/themes/pencilsofpromise/js/platform.js" type="text/javascript" charset="utf-8"></script>
<script src="/wp-content/themes/pencilsofpromise/js/ajax-uploader/client/fileuploader.js" type="text/javascript" charset="utf-8"></script>
<script src="/wp-content/themes/pencilsofpromise/js/jquery.dirtyforms.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="/wp-content/themes/pencilsofpromise/js/ajax-uploader/client/fileuploader.css" type="text/css" media="screen" />

<script>
$(document).ready(function() {
//var maskHeight = $(document).height()-168;var maskWidth = $(window).width();$('#mask').css( {'top':168, 'width': maskWidth, 'height': maskHeight, 'z-index': 9 } );$('#mask').fadeIn(200);var id = $('#platform-popup');var boxY = $(window).height()/2 - ((id.height()/2));var boxX = $(window).width()/2 - id.width()/2; id.css( {'top': 200, 'left': boxX} );
$('#platform-group-step-one form').dirtyForms();
});
</script>

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
<div id="platform-formpage" class="p_link">

    <div id="platform-popup" class="clearfix">

 <?php
if ($loginId==null) {
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
    //GROUP as object
    $group;
    if ($groupId) {
        $query = "SELECT Name, Description__c, Zip_Code__c, Total_Raised__c, Goal__c, School_Company_Affiliation__c, Photo_URL__c, Video_URL__c, Join_Type__c, Fundraisers__c, Status__c FROM Group__c WHERE Id = '".$groupId."' AND Published__c = TRUE LIMIT 1";
        $response = $mySforceConnection->query($query);
        foreach ($response->records as $record) {
            $group=new Group($record->Id,$record->fields->Name,$record->fields->Description__c,$record->fields->Zip_Code__c,$record->fields->School_Company_Affiliation__c,$record->fields->Members__c,$record->fields->Goal__c,$record->fields->Total_Raised__c,$record->fields->Photo_URL__c,$record->fields->Join_Type__c,$record->fields->Fundraisers__c,$record->fields->Status__c);   
        };
        if ($group==null) {
            throw new Exception('Group does not exist');
        }
    }
    //FUNDRAISERS in array
    $fundraisersArray = array();
    $query = "SELECT id,Name,Description__c,Goal__c,Total_Raised__c,Photo_URL__c,Marketing_Campaign__c,isClub__c FROM Fundraiser__c WHERE id IN (SELECT Fundraiser__c FROM Group_Fundraiser__c WHERE Group__c = '".$groupId."') LIMIT 100";
    $response = $mySforceConnection->query($query);
    foreach ($response->records as $record) {
        $fundraisersArray[]=new FundraiserQuick($record->Id,$record->fields->Name,$record->fields->Description__c,$record->fields->Goal__c,$record->fields->Total_Raised__c,$record->fields->Photo_URL__c,$record->fields->Marketing_Campaign__c,$record->fields->isClub__c);
    };               
    //THIS USERS FUNDRAISERS in array
    $adminFundraisersArray = array();
    $query = "SELECT id,Name,Description__c,Goal__c,Total_Raised__c,Photo_URL__c,Marketing_Campaign__c,isClub__c FROM Fundraiser__c WHERE id IN (SELECT Fundraiser__c FROM Contact_Fundraiser__c WHERE Contact__c = '".$loginId."') LIMIT 100";
    $response = $mySforceConnection->query($query);
    foreach ($response->records as $record) {
        $adminFundraisersArray[]=new FundraiserQuick($record->Id,$record->fields->Name,$record->fields->Description__c,$record->fields->Goal__c,$record->fields->Total_Raised__c,$record->fields->Photo_URL__c,$record->fields->Marketing_Campaign__c,$record->fields->isClub__c);
    };
    //ADMIN CLUB MEMBERS in array
    $adminMembersArray = array();
    $query = "SELECT id,Name,Photo_URL__c,Ripple_Effect__c,Email FROM Contact WHERE id IN (SELECT Contact__c FROM Group_Member__c WHERE Group__c = '".$groupId."' AND Admin__c = true AND Active__c = true) LIMIT 100";
    $response = $mySforceConnection->query($query);
    foreach ($response->records as $record) {
        $adminMembersArray[]=new ContactQuick($record->Id,$record->fields->Name,$record->fields->Photo_URL__c,$record->fields->Ripple_Effect__c,$record->fields->Email);
    };     
    //NORMAL CLUB MEMBERS in array
    $normalMembersArray = array();
    $query = "SELECT id,Name,Photo_URL__c,Email FROM Contact WHERE id IN (SELECT Contact__c FROM Group_Member__c WHERE Group__c = '".$groupId."' AND Admin__c = false AND Active__c = true) LIMIT 100";
    $response = $mySforceConnection->query($query);
    foreach ($response->records as $record) {
        $normalMembersArray[]=new ContactQuick($record->Id,$record->fields->Name,$record->fields->Photo_URL__c,$record->fields->Ripple_Effect__c,$record->fields->Email);
    }; 
    //PENDING CLUB MEMBERS in array
    $pendingMembersArray = array();
    $query = "SELECT id,Name,Photo_URL__c,Email FROM Contact WHERE id IN (SELECT Contact__c FROM Group_Member__c WHERE Group__c = '".$groupId."' AND Active__c = false) LIMIT 100";
    $response = $mySforceConnection->query($query);
    foreach ($response->records as $record) {
        $pendingMembersArray[]=new ContactQuick($record->Id,$record->fields->Name,$record->fields->Photo_URL__c,$record->fields->Ripple_Effect__c,$record->fields->Email);
    };     
 ?>    

 <?php
    $showStep = 1;
    if (isset($_GET["n"])) {
        $showStep = $_GET["n"];
    }
 ?>

<?php
    if ($showStep==1) {
?>
    
    <div class="platform-form-number">  
        <div class="active even">1</div>
        <div class="even">2</div>
        <div class="even">3</div>
        <span class="stretch"></span>
    </div>
    <?php if ($groupId) {  ?>
        <div id="platform-form-pagetitle"><span class="BebasNeue">Manage Your Group
    <?php } else {  ?>    
        <div id="platform-form-pagetitle"><span class="BebasNeue">Create a Group
    <?php }  ?> 
            </span><span class="platform-form-subtitle">Group Information</span> 
            <div>A group page allows people to donate directly to your event</div>
        </div>
    <div id="platform-group-step-one">
        <form class="platform-form" action="/process" method="POST"> 
        <div class="account_error" id="account_error_js_1" style="display:none;"></div> 
        <br/><br/> 
        <div class="form_left">
           <input type="hidden" id="next" name="next" value="2"/>
            <input type="hidden" id="clubadmin" name="clubadmin" value="<?php echo $loginId; ?>"/>
            <input type="hidden" id="clubid" name="clubid" value="<?php echo $groupId; ?>"/>
            <label for="clubname">Group Name: </label><input type="text" maxlength="80" style="" id="clubname" value="<?php echo $group->name; ?>" name="clubname"/><br/>
            <label for="clubaffiliation">School or Company Affiliation: </label><input type="text" maxlength="255" style="" id="clubaffiliation" value="<?php echo $group->affiliation; ?>" name="clubaffiliation"/><br/>
            <div>
                <label for="clubzip">Zip Code: </label><input type="text" maxlength="100" id="clubzip" style="width:100px;" value="<?php echo $group->zip; ?>" name="clubzip"/><br/>
            </div>
            <div>
                <label for="clubgoal">Overall Fundraising Goal: </label>
                    <select name="clubgoal" id="clubgoal">
                        <option value="250" <?php if ($group->goal==250) { echo 'selected'; } ?>>$250</option>
                        <option value="2500" <?php if ($group->goal==2500) { echo 'selected'; } ?>>$2,500</option>
                        <option value="10000" <?php if ($group->goal==10000) { echo 'selected'; } ?>>$10,000</option>
                        <option value="25000" <?php if ($group->goal==25000) { echo 'selected'; } ?>>$25,000</option>
                        <option value="100000" <?php if ($group->goal==100000) { echo 'selected'; } ?>>$100,000</option>
                        <option value="1000000" <?php if ($group->goal==1000000) { echo 'selected'; } ?>>$1,000,000</option>
                    </select>
            </div>
            <span class="clear"></span>
            <?php
            $platform_options = get_option('pop_platform_options');
            $placeholder = $platform_options['platform_group_copy'];            
            if (!$groupId) { 
            ?>
                <label for="clubdescription">Describe Your Group: </label><textarea style="height: 100px; width: 350px; margin-left: 0; margin-bottom: 30px;" maxlength="1024" id="clubdescription" name="clubdescription"><?php echo str_replace('<br/>',"\r\n",$placeholder); ?></textarea><br/>
            <?php } else { 
                if ($group->description == "|defaultdescription|") {                             
                    $group->description = $placeholder;
                }               
            ?>   
                <label for="clubdescription">Describe Your Group: </label><textarea style="height: 100px; width: 350px; margin-left: 0; margin-bottom: 30px;" maxlength="1024" id="clubdescription" name="clubdescription"><?php echo str_replace('<br/>',"\r\n",$group->description);?></textarea><br/>        
            <?php } ?> 
                <label>Your Group Status: &nbsp;</label>
                <input type="text" id="clubstatus" maxlength="255" name="clubstatus" value="<?php echo $group->status; ?>" style="width:300px"/><br /><br />
            <?php
            if (!$groupId) {
            ?>
                <label for="clubjointype"></label>
                <span class="clear"></span>
                <input type="checkbox" name="clubjointype" value="Invitation Only"/>
                <span>Make this group invitation only</span><br/>
            <?php
            }
            ?>
                </div>
        <div class="form_right">
            <?php 
                //PHOTO UPLOAD 
            ?>
            <h2>Group Snapshot</h2>
            <input class="grey_button" type="hidden" size="40" id="clubphoto" value="<?php echo $group->photo; ?>" name="clubphoto" value=""/>           
            <div id="platform-form-snapshot">
                <div id="upload">
                        <h3>Select an image from your computer</h3>
                        <p>Suggested size: 200x200 px (500kb Max)</p>
                        <div id="upload-area"></div><div id="loading"></div>
                </div>
                <div id="preview">
                    <?php
                    $photopath = '/wp-content/themes/pencilsofpromise/gfx/platform_avatar_blank.png';
                    if ($group->photo!='') {
                        $photopath = $group->photo;
                    }
                    ?>
                    <img width="140px" height="140px" src="<?php echo $photopath ?>" id="thumb">
                </div>
                
            </div>
            <script>
                $(document).ready(function(){
                        var thumb = $('#thumb');
                        var uploader = new qq.FileUploader({
                            // pass the dom node (ex. $(selector)[0] for jQuery users)
                            element: document.getElementById('upload-area'),
                            action: '/wp-content/themes/pencilsofpromise/js/ajax-uploader/server/php.php',
                            params: {
                                type: 'groups'
                            },
                            onSubmit: function(file, extension) {
                                    $('#platform-form-snapshot #loading').show();
                            },
                            onComplete: function(id, fileName, response) {
                                    thumb.load(function(){
                                            $('#platform-form-snapshot #loading').hide();
                                            thumb.unbind();
                                    });
                                    thumb.attr('src', '/wp-content/uploads-platform/temp/'+response.filename);
                                    $('#clubphoto').val(response.filename);
                                    $('#platform-group-step-one form').dirtyForms('setDirty', null)
                            }                   
                        });                
                });   
            </script>
        </form>           
        </div>
            
    </div>
                <span class="clear"></span>
    <div class="platform-form-nextlinks">
            <?php
            if ($groupId) {
            ?>
                <?php /*
                <a onclick="doGroupForm(1,$('#platform-group-step-one form').dirtyForms('isDirty', null), $('#platform-group-step-one form'),'<?php echo $groupId; ?>','save');" class="savelink">Save Changes</a> 
                */ ?>
                <a onclick="doGroupForm(1,$('#platform-group-step-one form').dirtyForms('isDirty', null), $('#platform-group-step-one form'),'<?php echo $groupId; ?>','submit');"><img width="117px" height="92px" src="<?php bloginfo('template_directory'); ?>/gfx/platform_form_next.png" id="thumb"></a>        
            <?php
            } else {
            ?>
                <?php /*
                <a onclick="doGroupForm(1,true, $('#platform-group-step-one form'),'<?php echo $groupId; ?>','save');" class="savelink">Save Changes</a>
                 */ ?>
                <a onclick="doGroupForm(1,true, $('#platform-group-step-one form'),'<?php echo $groupId; ?>','submit');"><img width="117px" height="92px" src="<?php bloginfo('template_directory'); ?>/gfx/platform_form_next.png" id="thumb"></a>        
            <?php
            }
            ?>                
        <div class="pagination">1 of 3</div>
    </div>  
 
<?php
    }
    else if ($showStep==2) { 
?>  
    
    <div class="platform-form-number">  
        <div class="even">1</div>
        <div class="active even">2</div>
        <div class="even">3</div>
        <span class="stretch"></span>
    </div>  
    <div id="platform-group-step-two">  
        <?php if ($groupId) {  ?>
        <div id="platform-form-pagetitle"><span  class="BebasNeue">Manage Your Group
    <?php } else {  ?>    
        <div id="platform-form-pagetitle"><span  class="BebasNeue">Create a Group
    <?php }  ?> 
            </span><span class="platform-form-subtitle">Manage Membership</span> 
            <div>A group page allows people to donate directly to your event</div>
        </div>
<?php 
if ($groupId) {
?>
    <div class="platform-form-left-block"> 
            <h3 class="platform-form-subsubtitle">ADMINISTRATORS</h3>
            <ul class="platform-members-admin">
            <?php
                foreach ($adminMembersArray as &$contact) {
                    $removeString='?clubremove=true&clubid='.$groupId.'&clubcontact='.$contact->id;
                    $demoteString='?clubdemote=true&clubid='.$groupId.'&clubcontact='.$contact->id;
                    ?>
                    <li>
                        <div class="name"><?php echo $contact->name; ?></div>
                        <span class="option profile_link"><span>+</span> <a href="/process<?php echo $demoteString; ?>">Disable admin privileges</a></span>
                        <span class="option profile_link"><span>+</span> <a href="/process<?php echo $removeString; ?>">Remove</a></span>
                    </li>
                    <?php
                };
            ?>
            </ul>        
            <h3 class="platform-form-subsubtitle">MEMBERS</h3>          
            <ul class="platform-members-admin">
            <?php 
                foreach ($normalMembersArray as &$contact) {
                    $removeString='?clubremove=true&clubid='.$groupId.'&clubcontact='.$contact->id;
                    $promoteString='?clubpromote=true&clubid='.$groupId.'&clubcontact='.$contact->id;
                    ?>
                    <li>
                        <div class="name"><?php if ($contact->hasName) { echo $contact->name; } else { echo $contact->email; } ?></div>
                        <span class="option profile_link" style="margin-left:20px"><span>+</span> <a href="/process<?php echo $promoteString; ?>">Promote to admin</a></span>
                    <?php
                    if ($club->jointype != 'Invitation Only') {
                    ?>
                        <span class="option profile_link" style="margin-left:20px"><span>+</span> <a href="/process<?php echo $removeString; ?>">Remove</a></span>
                    <?php
                    }
                    ?>                
                    </li>
                    <?php                    
                };       
            ?>
            </ul>
            <h3 class="platform-form-subsubtitle">PENDING</h3>
            <ul class="platform-members-admin">
            <?php 
                foreach ($pendingMembersArray as &$contact) {
                    $removeString='?clubremove=true&clubid='.$groupId.'&clubcontact='.$contact->id;
                    ?>
                    <li>
                        <div class="name"><?php echo $contact->email; ?></div>
                        <span class="option profile_link" style="margin-left:20px"><span>+</span> <a href="/process<?php echo $removeString; ?>">Remove</a></span>
                    </li>
                    <?php
                };       
            ?>
            </ul>
    </div>
    <div class="platform-form-right-block">
            <h2 class="platform-form-subtitle">Invite Members</h2> 
            <p>Please enter the email addresses of up to five friends that you want to invite to join your group.</p><br/>
            <form action="/process" method="POST">
                <input type="hidden" id="next" name="next" value="3"/>
                <input type="hidden" id="clubid" name="clubid" value="<?php echo $groupId; ?>"/>
                <input type="hidden" id="clubname" name="clubname" value="<?php echo $club->name; ?>"/>
                <div id="input1" style="margin-bottom:4px;" class="clonedInput">
                    <input type="text" name="invite1" maxlength="255" id="invite1" style="width:250px;"/>
                </div>
                <div>                     
                    <a class="platform-plusminus" id="btnAdd" onclick="addMemberInvite()"/>+</a>
                    <a class="platform-plusminus" id="btnDel" onclick="removeMemberInvite()" style="display:none;"/>-</a>               
                    <input type="hidden" id="clubinvitees" name="clubinvitees"><br/>
                </div>
            </form>
    </div>
    </div>
        <span class="clear"></span>
        <div class="platform-form-nextlinks">   
            <?php /*
            <a onclick="doGroupForm(2,null, $('#platform-group-step-two form'),'<?php echo $groupId; ?>','save');" class="savelink">Save Changes</a>
            */ ?>
            <a onclick="doGroupForm(2,null, $('#platform-group-step-two form'),'<?php echo $groupId; ?>','submit');"><img width="117px" height="92px" src="<?php bloginfo('template_directory'); ?>/gfx/platform_form_next.png" id="thumb"></a>
            <div class="pagination">2 of 3</div>
        </div>
        <div class="platform-form-backlinks">
            <a onclick="doGroupForm(2,null, null,'<?php echo $groupId; ?>','back');"><img width="117px" height="92px" src="<?php bloginfo('template_directory'); ?>/gfx/platform_form_back.png"></a>
        </div> 

<?php
    }
    }
    else if ($showStep==3) { 
?>     
    
    
    <div class="platform-form-number">  
        <div class="even">1</div>
        <div class="even">2</div>
        <div class="active even">3</div>
        <span class="stretch"></span>
    </div>    
    <div id="platform-group-step-three">  
        <?php if ($groupId) {  ?>
        <div id="platform-form-pagetitle"><span  class="BebasNeue">Manage Your Group
    <?php } else {  ?>    
        <div id="platform-form-pagetitle"><span  class="BebasNeue">Create a Group
    <?php }  ?> 
            </span><span class="platform-form-subtitle">Manage Fundraisers</span> 
            <div>A group page allows people to donate directly to your event</div>
        </div>
        
    <div class="platform-form-left-block">
            <h3 class="platform-form-subsubtitle">Group Campaigns</h3>
            <ul class="platform-fundraisers-admin">
            <?php
                $count=0;
                foreach ($fundraisersArray as &$fund) {
                    if ($fund->isclub=='Club Campaign') {
                        $count++;
                    ?>
                    <li>
                        <div class="name"><a href="/fundraise/fundraiser?f=<?php echo $fund->id; ?>"><?php echo $fund->name; ?></a></div>
                        <div class="option"><span>+</span> <a href="/fundraise/fundraiser?f=<?php echo $fund->id; ?>">view</a></div>
                        <?php if ($fund->isclub=='Club Campaign') { ?>
                            <div class="option"><span>+</span> <a href="/fundraise/manage?f=<?php echo $fund->id; ?>">manage</a></div>
                        <?php } ?>
                    </li>
                    <?php
                    }
                }
                if ($count==0) {
                    echo '<li><div class="name">&nbsp;</div></li>';
                }
            ?>
            </ul> 
            <h3 class="platform-form-subsubtitle">Personal Campaigns</h3>
            <ul class="platform-fundraisers-admin">
            <?php
                $count=0;
                foreach ($fundraisersArray as &$fund) {
                    if ($fund->isclub=='Personal Campaign Supporting Club') {
                        $count++;
                    ?>
                    <li>
                        <div class="name"><?php echo $fund->name; ?></div>
                        <span class="option profile_link"><span>+</span> <a href="/fundraise/fundraiser?f=<?php echo $fund->id; ?>">view</a></span>
                        <span class="option profile_link"><span>+</span> <a href="/fundraise/manage?f=<?php echo $fund->id; ?>">manage</a></span>
                    </li>
                    <?php
                    }
                }
                if ($count==0) {
                    echo '<li><div class="option">&nbsp;</div></li>';
                }
            ?>  
            </ul>
            <?php if (count($adminFundraisersArray)>0) { ?>
                <br/><br/>
                <form action="/process" method="POST">
                <input type="hidden" id="clubid" name="clubid" value="<?php echo $groupId; ?>"/>
                <label style="width:auto;" for="groupFundChoice">Attach a campaign to this group</label><br/>
                <select style="float: left; clear: both;" name="groupFundChoice">
                    <option value='none'>Select a Campaign</option>
                        <?php
                            foreach ($adminFundraisersArray as &$fund) {
                        ?>
                            <option value='<?php echo $fund->id; ?>'><?php echo $fund->name; ?></option>
                        <?php               
                            }                                    
                        ?> 
                </select><br/><br/>
                <input style="margin-top: 8px;" type="submit" value="Add"/>
                </form>
                <br/>
            <?php } ?>
            
            
    </div>
        
    <div class="platform-form-right-block">
        <div class="platform-button-big"><a class="gold_button" style="width: 200px;" onclick="location.href='/fundraise/manage?g=<?php echo $groupId; ?>'"/>Create a Campaign</a></div>
        <br/>
        <div class="platform-button-big"><a class="gold_button" style="width: 200px;" onclick="location.href='/groups/group?g=<?php echo $groupId; ?>&r=1'"/>Visit Your Group Page</a></div>       
    </div>

    </div> 
      <span class="clear"></span>  
    <div class="platform-form-backlinks">
        <a onclick="doGroupForm(3,null, null,'<?php echo $groupId; ?>','back');"><img width="117px" height="92px" src="<?php bloginfo('template_directory'); ?>/gfx/platform_form_back.png"></a>
    </div>    
    
<?php 
}
}
?>    
    
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
