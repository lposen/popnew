<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Platform Create Manage Fundraiser
*/
?>

<?php get_header(); ?>
<script src="/wp-content/themes/pencilsofpromise/js/platform.js" type="text/javascript" charset="utf-8"></script>
<script src="/wp-content/themes/pencilsofpromise/js/ajax-uploader/client/fileuploader.js" type="text/javascript" charset="utf-8"></script>
<script src="/wp-content/themes/pencilsofpromise/js/jquery.dirtyforms.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="/wp-content/themes/pencilsofpromise/js/ajax-uploader/client/fileuploader.css" type="text/css" media="screen" />

<script>
$(document).ready(function() {
    $('#fundgoal-amt:input').bind('keypress keydown keyup change',function(){
    var fundgoal = parseFloat($(':input[name="fundgoal"]').val());
    
    var v = '';
    var w = '';
    var x = '';
    var y = '';
    var z = '';
    
    if ((fundgoal)==25) {
        v = "<br><span>one child</span><br>";
    }
    else if ((fundgoal==0) || (fundgoal==NaN) || (fundgoal=='')) {
        v = "<br><span>no children</span><br>";
    }
    else if ((fundgoal!=25) && (fundgoal!=='') && (fundgoal!==NaN)){
       
        v = "<br><span>" + (fundgoal / 25).toFixed(0) + "  children</span><br>";
    }
    
   
    if (v == "<br><span>NaN  children</span><br>") {
        v = "<br><span>no children</span><br>";
    }
        
    $('#fundgoal-text').html("your campaign" + x  + w + " will educate" + z + v + y);
});
})
</script>
<!--<script type="text/javascript">
    $(document).ready(function() {
        $('#fundgoal-amt:input').bind('keypress keydown keyup change',function(){
        var fundgoal = parseFloat($(':input[name="fundgoal"]').val());

        var v = '';
        var w = '';
        var x = '';
        var y = '';
        var z = '';

        if ((fundgoal)==25) {
            v = "<br><span>one child</span><br>";
        }
        else if ((fundgoal==0) || (fundgoal==NaN) || (fundgoal=='')) {
            v = "<br><span>no children</span><br>";
        }
        else if ((fundgoal!=25) && (fundgoal!=='') && (fundgoal!==NaN)){

            v = "<br><span>" + (fundgoal / 25).toFixed(0) + "  children</span><br>";
        }



        if ((fundgoal)>=10000) {
            if (fundgoal<20000) {
                w = " will build <span><br>" + (fundgoal / 10000).toFixed(0) + "<br></span> classroom which ";   
                y= " over the schools lifetime";   
            }
            else if ((fundgoal>=20000) && (fundgoal<50000)) {
                w = " will build <span><br>" + (fundgoal / 10000).toFixed(0) + " classrooms <br></span> which";
            }
            else if (fundgoal>=50000) {
                w = " will have <span><br>" + (fundgoal / 10000).toFixed(0) + " classrooms<br></span> which";
            }
                if ((fundgoal>=20000)) {
                    y= " over the schools lifetime";   
                }
            z= " a total of";
        }

        if ((fundgoal)>=25000) {
            if (fundgoal<50000) {
                x = " will build <br><span>" + (fundgoal / 25000).toFixed(0) + " school</span><br> which ";
                                }
            if ((fundgoal / 25000)>=2) {
                x = " will build <span><br>" + (fundgoal / 25000).toFixed(0) + "  schools</span><br> which ";
                                }
        }

        if (v == "<br><span>NaN  children</span><br>") {
            v = "<br><span>no children</span><br>";
        }

        $('#fundgoal-text').html("your campaign" + x  + w + " will educate" + z + v + y);
    });
    });
​</script>-->
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
<div id="platform-formpage">

    <div id="platform-popup" class="clearfix fundraiser">

<?php
if ($loginId==null) {
    ?>
   <script type="text/javascript">
      window.location= "/signup?p=.<?php echo urlencode($_SERVER["REQUEST_URI"]); ?>";
   </script>
   <?php
}
else {
?>

<?php
    //GATHER ALL THE DATA IN ARRAYS AND OBJECTS
    //FUNDRAISER as object
    $fund;
    $isGroup = false;
    $groupCampaignType;
    if ($groupId && !$fundId) {
        $isGroup=true;
        $groupCampaignType=$_GET["t"];
    }
    if ($fundId) {
        $query = "SELECT Name, Type__c, Impact__c, Description__c, Status__c, Photo_URL__c, Video_URL__c, Goal__c, Total_Raised__c, Marketing_Campaign__c, isClub__c FROM Fundraiser__c WHERE Id = '".$fundId."' LIMIT 1";
        $response = $mySforceConnection->query($query);
        foreach ($response->records as $record) {
            $fund = new Fundraiser($record->Id,$record->fields->Name,$record->fields->Type__c,$record->fields->Impact__c,$record->fields->Description__c,$record->fields->Status__c,$record->fields->Goal__c,$record->fields->Total_Raised__c,$record->fields->Photo_URL__c,$record->fields->Video_URL__c,$record->fields->Marketing_Campaign__c,$record->fields->isClub__c);
        };
        if ($fund==null) {
            throw new Exception('Campaign does not exist');
        }
    }
    if ($fund->marketing) {
        $marketing=$fund->marketing;
    }    
    //get groups too
    $groupsArray = array(); 
    $query = "SELECT id,Name,Description__c,Members__c,Total_Raised__c,Goal__c,Photo_URL__c FROM Group__c WHERE id IN (SELECT Group__c FROM Group_Member__c WHERE Contact__c = '".$loginId."') LIMIT 100";
    $response = $mySforceConnection->query($query);
     foreach ($response->records as $record) {
        $groupsArray[]=new GroupQuick($record->Id,$record->fields->Name,$record->fields->Description__c,$record->fields->Members__c,$record->fields->Total_Raised__c,$record->fields->Goal__c,$record->fields->Photo_URL__c,$record->fields->Fundraisers__c);
    }; 
    $group;
    if ($fund->isclub) {
            $query = "SELECT id,Name,Description__c,Members__c,Total_Raised__c,Goal__c,Photo_URL__c,Fundraisers__c FROM Group__c WHERE id IN (SELECT Group__c FROM Group_Fundraiser__c WHERE Fundraiser__c = '".$fundId."') LIMIT 1";
            $response = $mySforceConnection->query($query);
             foreach ($response->records as $record) {
                $group=new GroupQuick($record->Id,$record->fields->Name,$record->fields->Description__c,$record->fields->Members__c,$record->fields->Total_Raised__c,$record->fields->Goal__c,$record->fields->Photo_URL__c,$record->fields->Fundraisers__c);
            };
    }
    $preSetGoal=$_GET["a"];
    $campaignName = stripslashes($_GET["c"]);
?>

<?php
//get any marketing campaign specific stuff
$campaignVideo = 'http://www.youtube.com/watch?v=7CQ8r-9SUvA';
$isSkipFirstStep = false;
$presetCampaign;
if ($marketing) {
    $assets = new Pod('ipromise_campaign');
    $assets->findRecords('t.name ASC', -1, 't.salesforce_identifier LIKE "'.$marketing.'"');
    while($assets->fetchRecord()) {
        $campaignVideo = $assets->get_field('campaign_video');
        $presetCampaign = $assets->get_field('default_type');
        $fundraisingText = $assets->get_field('fundraiser_copy');
    }
    if ($presetCampaign) {
        $isSkipFirstStep = true;
    }
}
?>    
   
<?php
//----------------------------- DISPLAY CODE SECTION --------------------------------------//
?>    

<div id="main">
<script>
$(document).ready(function(){ 
        $('#fundForm').dirtyForms();
	$('#fundtype-day').screwDefaultButtons({
		checked: 	"url(/wp-content/themes/pencilsofpromise/gfx/platform_form_fund_bday_on.png)",
		unchecked:	"url(/wp-content/themes/pencilsofpromise/gfx/platform_form_fund_bday.png)",
		width:		245,
		height:		224
	});
	$('#fundtype-spc').screwDefaultButtons({
		checked: 	"url(/wp-content/themes/pencilsofpromise/gfx/platform_form_fund_spc_on.png)",
		unchecked:	"url(/wp-content/themes/pencilsofpromise/gfx/platform_form_fund_spc.png)",
		width:		245,
		height:		224
	});
	$('#fundtype-set').screwDefaultButtons({
		checked: 	"url(/wp-content/themes/pencilsofpromise/gfx/platform_form_fund_set_on.png)",
		unchecked:	"url(/wp-content/themes/pencilsofpromise/gfx/platform_form_fund_set.png)",
		width:		245,
		height:		224
	}); 
	$('#fundtype-bld').screwDefaultButtons({
		checked: 	"url(/wp-content/themes/pencilsofpromise/gfx/platform_form_fund_bld_on.png)",
		unchecked:	"url(/wp-content/themes/pencilsofpromise/gfx/platform_form_fund_bld.png)",
		width:		245,
		height:		224
	});
	$('#fundgoal-0250').screwDefaultButtons({
		checked: 	"url(/wp-content/themes/pencilsofpromise/gfx/platform_form_fund_0250_on.png)",
		unchecked:	"url(/wp-content/themes/pencilsofpromise/gfx/platform_form_fund_0250.png)",
		width:		245,
		height:		224
	});
	$('#fundgoal-2500').screwDefaultButtons({
		checked: 	"url(/wp-content/themes/pencilsofpromise/gfx/platform_form_fund_2500_on.png)",
		unchecked:	"url(/wp-content/themes/pencilsofpromise/gfx/platform_form_fund_2500.png)",
		width:		245,
		height:		224
	});
	$('#fundgoal-10k').screwDefaultButtons({
		checked: 	"url(/wp-content/themes/pencilsofpromise/gfx/platform_form_fund_10k_on.png)",
		unchecked:	"url(/wp-content/themes/pencilsofpromise/gfx/platform_form_fund_10k.png)",
		width:		245,
		height:		224
	}); 
	$('#fundgoal-25k').screwDefaultButtons({
		checked: 	"url(/wp-content/themes/pencilsofpromise/gfx/platform_form_fund_25k_on.png)",
		unchecked:	"url(/wp-content/themes/pencilsofpromise/gfx/platform_form_fund_25k.png)",
		width:		245,
		height:		224
	});         
});
</script>

<form id="fundForm" class="platform-form" method="POST" action="/process"> 
<?php if ($fundId) {  ?>
    <div id="platform-form-pagetitle"><span  class="BebasNeue">Manage Your Campaign<span>You are editing your campaign.
    <input id="fund-action" name="fund-action" type="hidden" value="edit">
<?php } else {  ?>    
    <div id="platform-form-pagetitle"><span  class="BebasNeue">Create a Campaign
<?php }  ?>
    </span>
<?php if ($groupId) {  ?>
    <?php if ($groupCampaignType=='p') { ?>
        <span class="platform-form-subtitle">You are creating a campaign supporting a group.</span><br/>
    <?php } else {  ?>
        <span class="platform-form-subtitle">You are creating a group campaign.</span><br/>
    <?php }  ?> 
<?php } else if (!$fundId) {  ?>    
    <!--<span class="platform-form-subtitle">You are creating a personal campaign.</span>--><br/>
<?php }  ?> 
    </div>
<?php
$showStep = 1;
if ($isSkipFirstStep) {
    $showStep = 2;
}
if (isset($_GET["n"])) {
    $showStep = $_GET["n"];
}
?>    
    
<div id="showOne" style="<?php if ($showStep!=1) { echo 'display:none'; }; ?>">

    <div class="platform-form-number">  
        <div class="active even">1</div>
        <div class="even">2</div>
        <div class="even">3</div>
        <span class="stretch"></span>
    </div>
    <div id="platform-group-step-one">    
    
        <h2 class="platform-form-subtitle">Choose Campaign Type</h2>       
     
<?php if (($groupId && $groupCampaignType=='p') || !$groupId) { ?> 
    <input type="hidden" id="fundcontact" name="fundcontact" value="<?php echo $loginId; ?>"/>
<?php } 
      if ($groupId) { ?>  
    <input type="hidden" id="fundclub" name="fundclub" value="<?php echo $groupId; ?>"/>
<?php } ?>
    <input type="hidden" id="fundid" name="fundid" value="<?php echo $fundId; ?>"/>
    <input type="hidden" name="m" value="<?php echo $marketing; ?>"/>
    <input type="hidden" id="next" name="next" value=""/>
    <div id="fundraiser-radios" class="platformsection">  
            <input name="fundtype" type="radio" id="fundtype-day" value="Donate Your Birthday" <?php if ($fund->type == 'Donate Your Birthday') {echo 'checked'; } else if ($presetCampaign == 'Donate Your Birthday') {echo 'checked'; } ?>/>
       
            <input name="fundtype" type="radio" id="fundtype-spc" value="Donate a Special Occasion" <?php if ($fund->type == 'Donate a Special Occasion') {echo 'checked'; } else if ($presetCampaign == 'Donate a Special Occasion') {echo 'checked'; } ?> />
        
            <input name="fundtype" type="radio" id="fundtype-bld" value="Build a School" <?php if ($fund->type == 'Build a School') {echo 'checked'; } else if ($presetCampaign == 'Build a School') {echo 'checked'; } ?> />
        
            <input name="fundtype" type="radio" id="fundtype-set" value="Set a Goal" <?php if ($fund->type == 'Set a Goal') {echo 'checked'; } else if ($presetCampaign == 'Set a Goal') {echo 'checked'; } ?> />
            <input name="fundtype" type="radio" id="fundtype-imp" value="Pledge Your Impossible" <?php if ($fund->type == 'Pledge Your Impossible') {echo 'checked'; } else if ($presetCampaign == 'Pledge Your Impossible') {echo 'checked'; } ?> style="display:none;"/>
                 
    </div>
    <div class="clearfix"></div>
    <div class="account_error" id="account_error_js_1" style="display:none;"></div> 
    </div>
    <span class="clear"></span>
    <div class="platform-form-nextlinks">
<?php /* if ($fundId) { ?>
	<!--<div id="profile_button" class="even">
		<a onclick="doFundForm(1,$('#fundForm').dirtyForms('isDirty', null), $('#fundForm'),'<?php echo $fundId; ?>','delete','<?php echo $preSetGoal; ?>');" class="gold_button">Delete Campaign</a>
	</div>-->
	<div id="profile_button" class="even">
        <a onclick="doFundForm(1,$('#fundForm').dirtyForms('isDirty', null), $('#fundForm'),'<?php echo $fundId; ?>','save','<?php echo $preSetGoal; ?>');" class="gold_button savelink">Save Changes</a>
   </div>
<?php } */ ?>       
        <a style="float: right" onclick="doFundForm(1,$('#fundForm').dirtyForms('isDirty', null), $('#fundForm'),'<?php echo $fundId; ?>','submit','<?php echo $preSetGoal; ?>');"><img width="117px" height="92px" src="<?php bloginfo('template_directory'); ?>/gfx/platform_form_next.png"></a>

        <div class="pagination">1 of 3</div>
    </div>     
    
</div>
<div id="showTwo" style="<?php if ($showStep!=2) { echo 'display:none'; }; ?>">

    <div class="platform-form-number">  
        <?php if ($isSkipFirstStep) { ?>
                <div class="active even">1</div>
                <div class="even">2</div>
                <div class="even">3</div>
                <span class="stretch"></span>
        <?php } else { ?>
                <div class="even">1</div>
                <div class="active even">2</div>
                <div class="even">3</div>
                <span class="stretch"></span>
        <?php } ?>
    </div>
    <div id="platform-group-step-one">    
    
    <h2 class="platform-form-subtitle">Set Campaign Goal</h2>   

    <div id="fundraiser-radios" class="platformsection">
            <?php
                $goal = 0;
                if ($fund->goal) {                             
                    $goal = $fund->goal;
                }
                else {
                    $goal=250;
                }
            ?>
        <span style="position: relative;left: 10px;font-size: 30px;">$</span><input name="fundgoal" type="text" value="<?php echo number_format($goal,0,'.',''); ?>" id="fundgoal-amt" /><div class="Bebas Neue uppercase" id="fundgoal-text"></div>​​​​​​​​​​​​
           <!-- <input name="fundgoal" type="radio" id="fundgoal-0250" value="250" <?php if ($fund->goal == '250' || $preSetGoal == '250') {echo 'checked'; } ?>/>
            <input name="fundgoal" type="radio" id="fundgoal-2500" value="2500" <?php if ($fund->goal == '2500' || $preSetGoal == '2500') {echo 'checked'; } ?> />
            <input name="fundgoal" type="radio" id="fundgoal-10k" value="10000" <?php if ($fund->goal == '10000' || $preSetGoal == '10000') {echo 'checked'; } ?> />
            <input name="fundgoal" type="radio" id="fundgoal-25k" value="25000" <?php if ($fund->goal == '25000' || $preSetGoal == '25000') {echo 'checked'; } ?> />-->
    </div>       
        <div class="right">
            <div class="left BebasNeue text_gold">
                <div>$250</div>
                <div>$2,500</div>
                <div>$10,000</div>
                <div>$25,000</div>
            </div>
            <div class="right">
                <div>Educate Ten Children</div>
                <div>Sponsor One Classroom</div>
                <div>Build and Sponsor One Classroom</div>
                <div>Build and Sponsor One School</div>
            </div>
        </div>
                        
    
    <div class="clearfix"></div>    
    <div class="account_error" id="account_error_js_2" style="display:none;"></div>
    
    </div>

    <span class="clear"></span>
    <div class="platform-form-nextlinks">
<?php /*if ($fundId) {  ?>          
        <a onclick="doFundForm(2,$('#fundForm').dirtyForms('isDirty', null), $('#fundForm'),'<?php echo $fundId; ?>','submit',null);" class="savelink">Save Changes</a>
<?php } */ ?>        
        <a onclick="doFundForm(2,$('#fundForm').dirtyForms('isDirty', null), $('#fundForm'),'<?php echo $fundId; ?>','submit',null);"><img width="117px" height="92px" src="<?php bloginfo('template_directory'); ?>/gfx/platform_form_next.png"></a>
        <?php if ($isSkipFirstStep) { ?>
        <div class="pagination">1 of 2</div>
        <?php } else { ?>
        <div class="pagination">2 of 3</div>
        <?php } ?>
    </div>     
    <?php if (!$isSkipFirstStep) { ?>
    <div class="platform-form-backlinks">
        <a onclick="doFundForm(2,$('#fundForm').dirtyForms('isDirty', null), $('#fundForm'),'<?php echo $fundId; ?>','back',null);"><img width="117px" height="92px" src="<?php bloginfo('template_directory'); ?>/gfx/platform_form_back.png"></a>
    </div>
    <?php } ?>
        
</div>
<div id="showThree" style="<?php if ($showStep!=3) { echo 'display:none'; }; ?>">

    <div class="platform-form-number">  
        <?php if ($isSkipFirstStep) { ?>
                <div class="even">1</div>
                <div class="even active">2</div>
                <div class="even">3</div>
                <span class="stretch"></span>
        <?php } else { ?>
                <div class="even">1</div>
                <div class="even">2</div>
                <div class="even active">3</div>
                <span class="stretch"></span>
        <?php } ?>
    </div>
    <div id="platform-group-step-three">    
    
    <h2 class="platform-form-subtitle">Personalize Your Campaign</h2>    
    <div class="form_left">
        <div style="width: 100%;"> 
            <?php
                if ($fundId) { //passed in from somewhere
                   $campaignName=$fund->name;
                }
            ?>
            <label for="fundname">Name Your Campaign: </label><input type="text" maxlength="80" id="fundname" value="<?php echo $campaignName; ?>" name="fundname"/><br/>
            <?php 
            $placeholder="";
            if ($marketing) {
                $placeholder = $fundraisingText;
            }
            else {
                $platform_options = get_option('pop_platform_options');
                $placeholder = $platform_options['platform_fundraiser_copy'];
            }
            if (!$fundId) { 
            ?>
                <label for="funddescription">Describe Your Campaign: </label><textarea maxlength="1024" style="height:160px; width: 350px; margin-left: 0px; margin-bottom: 30px;" id="funddescription" placeholder="<?php echo $fund->description;?>" name="funddescription"><?php echo $placeholder; ?></textarea><br/>
            <?php } else { 
                if ($fund->description == "|defaultdescription|") {                             
                    $fund->description = $placeholder;
                }            
            ?>
                <label for="funddescription">Describe Your Campaign: </label><textarea maxlength="1024" style="height:160px; width: 350px; margin-left: 0px; margin-bottom: 30px;" id="funddescription" placeholder="<?php echo str_replace('<br/>',"\r\n",$fund->description);?>" name="funddescription"><?php echo str_replace('<br/>',"\r\n",$fund->description);?></textarea><br/>
            <?php } ?>    
            <?php if (count($groupsArray)>0) { ?>
            <label for="fundGroupChoice">Attach this campaign to an existing group</label>
            <select name="fundGroupChoice">
                <option value='No'>Not attached</option>
                    <?php
                        foreach ($groupsArray as &$agroup) {
                    ?>
                        <option value='<?php echo $agroup->id; ?>' <?php if ($group->id == $agroup->id) { echo 'selected'; }; ?>><?php echo $agroup->name; ?></option>
                    <?php               
                        }                                    
                    ?> 
            </select>
            <?php } ?>
        </div> 
        <div class="clearfix"></div>    
        <div class="account_error" id="account_error_js_3" style="display:none;"></div>              
        <div class="platform-form-hbreak"></div>
    </div>
    <div class="form_right">
        <label>Campaign Photo</label><br>
                <?php 
                    //PHOTO UPLOAD 
                ?>
                <input type="hidden" size="40" id="fundphoto" value="<?php echo $fund->photo; ?>" name="fundphoto" value=""/>           
                <div id="platform-form-snapshot">
                    <div id="preview">
                        <?php
                        $photopath = '/wp-content/themes/pencilsofpromise/gfx/platform_avatar_blank.png';
                        if ($fund->photo!='') {
                            $photopath = $fund->photo;
                        }
                        ?>
                        <img width="140px" height="140px" src="<?php echo $photopath ?>" id="thumb">
                    </div>
                    <div id="upload">
                        <h3>Select an image from your computer</h3>
                        <p>Suggested size: 200x200 px (500kb Max)</p>
                        <div id="upload-area"></div><div id="loading"></div>
                    </div>
                </div>
                <script>
                    $(document).ready(function(){
                            var thumb = $('#thumb');
                            var uploader = new qq.FileUploader({
                                element: document.getElementById('upload-area'),
                                allowedExtensions: [],
                                sizeLimit: 0, // max size
                                minSizeLimit: 0, // min size
                                action: '/wp-content/themes/pencilsofpromise/js/ajax-uploader/server/php.php',
                                params: {
                                    type: 'fundraisers'
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
                                        $('#fundphoto').val(response.filename);
                                        $('#fundForm').dirtyForms('setDirty', null)
                                }                   
                            });                
                    });   
                </script>      

        <div class="platform-form-hbreak"></div>  
        <span class="clear"></span>

        <div id="video">       
            <label for="fundvideo">Featured Video</label> 
            <span class="clear"></span>
            <img width="117px" height="92px" style="padding-right: 10px; float: left;" src="<?php bloginfo('template_directory'); ?>/gfx/platform_form_video.png">
            <input type="text" size="40" id="fundvideo" value="<?php echo $fund->video; ?>" name="fundvideo" style="width: 244px; margin-top: 30px;float: right;" value="" placeholder="<?php echo $campaignVideo; ?>"/>
        </div> 
    </div>

            
    
</div>
    <span class="clear"></span>
    <div style="margin-top: 40px;" class="platform-form-nextlinks">
<?php /* if ($fundId) {  ?>         
        <a onclick="doFundForm(3,$('#fundForm').dirtyForms('isDirty', null), $('#fundForm'),'<?php echo $fundId; ?>','save',null);" class="savelink">Save Changes</a>
<?php } */  ?>
        <a onclick="doFundForm(3,$('#fundForm').dirtyForms('isDirty', null), $('#fundForm'),'<?php echo $fundId; ?>','submit',null);"><img width="117px" height="92px" src="<?php bloginfo('template_directory'); ?>/gfx/platform_form_next.png"></a>
        <?php if ($isSkipFirstStep) { ?>
        <div class="pagination">2 of 2</div>
        <?php } else { ?>
        <div class="pagination">3 of 3</div>
        <?php } ?>
    </div>
    <div style="margin-top: 40px;" class="platform-form-backlinks">
        <a onclick="doFundForm(3,$('#fundForm').dirtyForms('isDirty', null), $('#fundForm'),'<?php echo $fundId; ?>','back',null);"><img width="117px" height="92px" src="<?php bloginfo('template_directory'); ?>/gfx/platform_form_back.png"></a>
    </div>       
    
</div>
    
</form>    
 
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
