<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Platform User Manage
*/
?>

<?php get_header(); ?>
<script src="/wp-content/themes/pencilsofpromise/js/platform.js" type="text/javascript" charset="utf-8"></script>
<script src="/wp-content/themes/pencilsofpromise/js/ajax-uploader/client/fileuploader.js" type="text/javascript" charset="utf-8"></script>
<script src="/wp-content/themes/pencilsofpromise/js/jquery.dirtyforms.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="/wp-content/themes/pencilsofpromise/js/ajax-uploader/client/fileuploader.css" type="text/css" media="screen" />
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
    //User as object
    $user;
    if ($loginId) {
        $query = "SELECT Id, Name, Email, Description__c, Status__c, Birthdate, Photo_URL__c, Goal__c, MailingPostalCode FROM Contact WHERE Id = '".$loginId."' LIMIT 1";
        $response = $mySforceConnection->query($query);
        $current_user = wp_get_current_user();  
        foreach ($response->records as $record) {
            $user = new User($record->Id,$current_user->user_firstname,$current_user->user_lastname,$record->fields->Description__c,$record->fields->Status__c,$record->fields->Goal__c,$record->fields->Photo_URL__c,$record->fields->Birthdate,$current_user->user_email,$record->fields->MailingPostalCode);   
        };
        if ($user==null) {
            throw new Exception('Account does not exist');
        }
    }
?>
  
<?php
//----------------------------- DISPLAY CODE SECTION --------------------------------------//
?>    

<div id="main">
        
<div id="platform-pagetitle" class="BebasNeue">Manage Your Account</div>
<div class="account_error" id="account_error_js" style="display:none;"></div>

</div>
<br/>
<form method='POST' id="platform_account_form" name="platform_account_form" action='/process' onsubmit="doAccountForm();">    
<input type="hidden" size="40" id="usermanage" name="usermanage" value="1"/>
<input type="hidden" size="40" id="userid" name="userid" value="<?php echo $loginId; ?>" />
    <div class="platform-form-number">  
    </div>
    <div id="platform-group-step-three">    
         <?php 
                //PHOTO UPLOAD 
            ?>
            
            <input type="hidden" size="40" id="userphoto" value="<?php echo $user->photo; ?>" name="userphoto"/>           
            <div id="platform-form-snapshot" style="float: right; width: 45%;">
                <h2 style=" margin-bottom: 10px;">Profile Snapshot</h2>
                <div id="preview">
                    <?php
                    $photopath = '/wp-content/themes/pencilsofpromise/gfx/platform_avatar_blank.png';
                    if ($user->photo!='') {
                        $photopath = $user->photo;
                    }
                    ?>
                    <img width="140px" height="140px" src="<?php echo $photopath ?>" id="thumb">
                </div>
                <div id="upload" style="float: right; width: 220px; text-align: justify;">
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
                            action: '/wp-content/themes/pencilsofpromise/js/ajax-uploader/server/php.php',
                            params: {
                                type: 'profile'
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
                                    $('#userphoto').val(response.filename);
                            }                   
                        });                
                });   
            </script>  
    <div style="width: 45%; float: right; clear: right;">
                <label>Your Status: &nbsp;</label><br>
                <input type="text" maxlength="255" id="platform_register_status" name="platform_register_status" value="<?php echo $user->status; ?>" style="width:370px"/><br /><br />          
                <label>About Yourself: &nbsp;</label><br>
                <textarea style="height:80px; width:370px;" maxlength="1024" id="platform_register_description" name="platform_register_description"><?php echo $user->description;;?></textarea><br/>    
    </div>
      <div class="platform-form-hbreak"></div>     
               
                    
            <span class="clear"></span>
    <div class="platform-form-hbreak"></div>           
    <div style="width: 50%;float: left;position: relative;top: -410px;border-right: 1px solid #E2E2E2;">        
                <label>First Name: &nbsp;</label>
                <label>Last Name: &nbsp;</label><br>
                <input type="text" maxlength="40" id="platform_register_first_name" name="platform_register_first_name" value="<?php echo $user->firstname; ?>" style="width: 165px; margin-top: 5px; margin-right: 35px; margin-bottom: 50px;"/>
                <input type="text" maxlength="80" id="platform_register_last_name" name="platform_register_last_name" value="<?php echo $user->lastname; ?>" style="width: 165px; margin-top: 5px; margin-bottom: 50px;"/><br>
                <label style="width:  auto; margin-bottom: 60px;">Email: &nbsp;</label>
                <label style="margin-bottom: 60px;"><?php echo $user->email; ?></label> <br>
                <label>Change Password: &nbsp;</label>
                <label>Change Password Confirm: &nbsp;</label><br>
                <input type="password" id="platform_register_password" maxlength="10" name="platform_register_password" value="<?php echo $register_password ?>" style="width: 165px; margin-right: 40px; margin-bottom: 60px;"/>
                
                <input type="password" id="platform_register_password_confirm" maxlength="10" name="platform_register_password_confirm" value="<?php echo $register_password_confirm ?>" style="width: 165px; margin-bottom: 30px;"/>
                <?php
                    $birthday;$birthmonth;$birthyear;
                    if ($user->birthdate) {
                        $pizza  = "piece1 piece2 piece3 piece4 piece5 piece6";
                        $pieces = explode("-", $user->birthdate);
                        $birthday=$pieces[1];
                        $birthmonth=$pieces[2];
                        $birthyear=$pieces[0];
                    }
                ?>
                <label>Birthday (mm/dd/yyyy): &nbsp;</label>
                <label>Postal Code: &nbsp;</label><br>
                <input type="text" id="platform_register_birthday_day" name="platform_register_birthday_day" maxlength="2" value="<?php echo $birthday; ?>" style="width:25px"/>&nbsp;/&nbsp;<input type="text" maxlength="2" id="platform_register_birthday_month" name="platform_register_birthday_month" value="<?php echo $birthmonth; ?>" style="width:25px"/>&nbsp;/&nbsp;<input type="text" maxlength="4" id="platform_register_birthday_year" name="platform_register_birthday_year" value="<?php echo $birthyear; ?>" style="width:45px"/>
                
                <input type="text" id="platform_register_zip" name="platform_register_zip" maxlength="100" value="<?php echo $user->postcode; ?>" style="width:60px; margin-left: 75px;"/>
    </div>

    <input type="submit" value="Save" class="grey_button platform-button-big" style="float:right;"/><br />
    <a href="userprofile" style=" text-align: right; clear: both; display: block; position: relative; top: -280px; ">Go to your profile</a><br />



</div>
 
</form>

</div>

</div>        
        
<?php
}
}
catch (Exception $e) {
    ?>
   <script type="text/javascript">
      window.location= "/error?e=.<?php echo urlencode($e); ?>";
   </script>
   <?php
}
?>    
    
<?php get_footer(); ?>
