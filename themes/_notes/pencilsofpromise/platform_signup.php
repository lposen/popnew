<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Platform Signup
*/
?>
<?php get_header(); ?>
<script src="<?php bloginfo('template_directory'); ?>/js/platform.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/ajax-uploader/client/fileuploader.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.dirtyforms.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/js/ajax-uploader/client/fileuploader.css" type="text/css" media="screen" />
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
if ($loginId) {
    ?>
   <script type="text/javascript">
      window.location= "/fundraise?p=.<?php echo urlencode($_SERVER["REQUEST_URI"]); ?>";
   </script>
   <?php
}
else {
?>

<?php
//----------------------------- DISPLAY CODE SECTION --------------------------------------//
?>

<div id="main">

    <div style="float:right; width:380px; margin-right:20px">
        <div id="platform-pagetitle-small" class="BebasNeue">Sign up</div>
            <?php
                if (isset($_GET['e'])) {
                    echo '<div class="account_error">';
                    echo urldecode($_GET['e']);
                    echo '</div>';
                }
                if(isset($_GET['l'])) {
                    $l = urlencode($_GET['l']);
                }
                else {
                    $l='';
                }
                if(isset($_GET['c'])) {
                    $c = urldecode($_GET['c']);
                }
                else {
                    $c='';
                }               
                if(isset($_GET['p'])) {
                    $p = urlencode($_GET['p']);
                } else if(isset($_POST['p'])) {
                    $p = $_POST['p'];
                } else {
                    $p = urlencode($_SERVER['HTTP_REFERER']);
                }
            ?>
            <div class="account_error" id="account_error_js" style="display:none;"></div>
            <br/><br/>
            <form method='POST' id="platform_signup_form" name="platform_signup_form" action='/process' onsubmit="doSignupForm();" >
                
                    <?php if ($c) { ?>
                        <label style="width:160px; text-align:left;margin-bottom: 5px;">Your Impossible &nbsp;</label><br />
                        <input type="text" maxlength="255" id="c" name="c" value="<?php echo $c; ?>" style="width:395px; margin-bottom: 20px;"/><br /><br />
                    <?php } ?>
                
                    <label style="width:175px; text-align:left;margin-bottom: 5px;">First Name &nbsp;</label>
                    <label style="width:175px; text-align:left;margin-bottom: 5px; margin-left: 25px;">Last Name &nbsp;</label><br />
                    <input type="text" maxlength="40" id="platform_register_first_name" name="platform_register_first_name" value="<?php echo $_SESSION['register_vars']['platform_register_first_name']; ?>" style="width:175px; margin-bottom: 20px; float: left;"/>
                    <input type="text" maxlength="80" id="platform_register_last_name" name="platform_register_last_name" value="<?php echo $_SESSION['register_vars']['platform_register_last_name']; ?>" style="width:175px; margin-bottom: 20px; float: right;"/><br /><br />
               
                    <label style="width:175px; text-align:left; margin-bottom: 5px;">Email &nbsp;</label><br />
                    <input type="text" maxlength="255" id="platform_register_email" name="platform_register_email" value="<?php echo $_SESSION['register_vars']['platform_register_email']; ?>" style="width:375px; margin-bottom: 20px;"/><br /><br />
                
                    <label style="width:175px; text-align:left; margin-bottom: 5px;">Password &nbsp;</label><br />
                    <label style="width:175px; text-align:left; margin-bottom: 5px; margin-left: 25px;">Password Confirm &nbsp;</label><br />

                    <input type="password" maxlength="10" id="platform_register_password" name="platform_register_password" value="<?php echo $register_password ?>" style="width:175px; margin-bottom: 20px; float: left;"/>
               
                    <input type="password" maxlength="10" id="platform_register_password_confirm" name="platform_register_password_confirm" value="<?php echo $register_password_confirm ?>" style="width:175px; margin-bottom: 20px; float: right;"/><br /><br />
                
                    <label style="width:175px; text-align:left; margin-bottom: -10px;">Birthday (mm/dd/yyyy) &nbsp;</label><br />
                    <label style="width:175px; text-align:left; margin-bottom: 5px; margin-left: 25px;">Postal Code &nbsp;</label><br />

                    <input type="text" id="platform_register_birthday_day" name="platform_register_birthday_day" maxlength="2" value="<?php echo $_SESSION['register_vars']['platform_register_birthday_day']; ?>" style="width:35px; margin-bottom: 10px;"/>&nbsp;/&nbsp;
                    <input type="text" maxlength="2" id="platform_register_birthday_month" name="platform_register_birthday_month" value="<?php echo $_SESSION['register_vars']['platform_register_birthday_month']; ?>" style="width:35px; margin-bottom: 10px;"/>&nbsp;/&nbsp;
                    <input type="text" maxlength="4" id="platform_register_birthday_year" name="platform_register_birthday_year" value="<?php echo $_SESSION['register_vars']['platform_register_birthday_year']; ?>" style="width:60px; margin-bottom: 10px;"/>
                
                    <input type="text" maxlength="100" id="platform_register_zip" name="platform_register_zip" value="<?php echo $_SESSION['register_vars']['platform_register_zip']; ?>" style="width:175px; margin-bottom: 10px; float: right;"/><br /><br />
                
                <p class="fieldsrequired" style="position: relative; top: -15px;">*All fields required</p>
                <input type="submit" value="Register" class="gold_button platform-button-big" style="float:right;"/><br />
                <input type="hidden" name="referrer" value="<?php echo $l ?>" /><br />
                <input type="hidden" name="m" value="<?php echo $marketing ?>" /><br />
                <input type="hidden" name="p" value="<?php echo $p ?>" /><br />
            </form>
            <div class="clearfix"></div><br/>
            <a href="/forgot-your-password" id="platform-forgotpw"class="p_link" style="float:right; font-size:11px;">Forgot Your Password?</a>
    </div>

    <div style="float:right; width:310px; margin-right:70px; border-right:1px solid #e9e9e9;">
        <div id="platform-pagetitle-small" class="BebasNeue">Sign up with Facebook</div>
        <br/><br/><br/>
        <a id="fb-auth" style="cursor:pointer;"><img src="<?php bloginfo('template_directory'); ?>/gfx/platform_signup_facebook.png"/></a>
    </div>
    <div class="clearfix"></div>
    <br/>
    <hr/>
    <br/>
    <div id="platform-login-signup" class="p_link">Already have an account? <a href="/login">Login now</a></div>
</div>

</div>

</div>
        <div id="fb-root"></div>
        <script type="text/javascript">
            var button;
            var userInfo;
            window.fbAsyncInit = function() { 
                FB.init({ appId: '449055625110934', status: true, cookie: true, xfbml: true, oauth: true});
                
                function setUp(response) {
                    button       =   document.getElementById('fb-auth');
                    button.onclick = function() {
                        FB.login(function(response) {
                            if (response.authResponse) {
                                FB.api('/me', function(info) {
                                    login(response, info);
                                });
                            } else {
                                //user cancelled login or did not grant authorization
                            }
                        }, {scope:'email,user_birthday,user_about_me'});
                    }
                }
                FB.getLoginStatus(setUp);
            };
            (function() {
                var e = document.createElement('script'); e.async = true;
                e.src = document.location.protocol
                    + '//connect.facebook.net/en_US/all.js';
                document.getElementById('fb-root').appendChild(e);
            }());


            function login(response, info){
                if (response.authResponse) {
                    var accessToken = response.authResponse.accessToken;
                    var query_result_sex;
                    var query_result_pic;
                    var query_result_bdate;
					FB.api('/me', function(response) {
						var query =  FB.Data.query('select name, birthday_date, sex, pic_big from user where uid={0}', response.id);
						query.wait(function(rows) {
						   query_result_bdate = rows[0].birthday_date;
						   query_result_sex = rows[0].sex;
						   query_result_pic = rows[0].pic_big;
                                                   var url = "<?php bloginfo('url'); ?>/process?fb_connect=1";
						   if ((window.location.search).indexOf('l=')!=-1) {
                                                       var qs = "";
                                                       if (window.location.search.indexOf('?l=')!=-1) {
                                                            var id = window.location.search.substring(window.location.search.indexOf('?l=')+1,window.location.search.length);
                                                       }
                                                       else if (window.location.search.indexOf('?m=')!=-1) {
                                                            var id = window.location.search.substring(window.location.search.indexOf('?m=')+1,window.location.search.length);   
                                                       }
                                                       url+="&"+id;
                                                   }
                                                   location.href=url;
						 });
					});
                }
            }

        </script>
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
