<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Platform Login
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
    
    <div style="float:right; width:360px; margin-right:20px">
        <div id="platform-pagetitle-small" class="BebasNeue">Login with Email</div> 
            <?php            
                if (isset($_GET['e'])) {
                    echo '<div class="account_error">';
                    echo 'Incorrect email address or password<br />';
                    echo '</div>';
                }
                if(isset($_GET['p'])) {
                    $p = urlencode($_GET['p']);
                } else if(isset($_POST['p'])) {
                    $p = $_POST['p'];
                } else {
                    $p = urlencode($_SERVER['HTTP_REFERER']);
                }
                if(isset($_GET['dest'])) {
                    $dest = urlencode($_GET['dest']);
                }
                else {
                    $dest="";
                }
            ?>    
            <div class="account_error" id="account_error_js" style="display:none;"></div>
            <br/><br/>
            <form method='POST' id="platform_login_form" name="platform_login_form" action='/process' onsubmit="doLoginForm();" >     
            <label for="platform_user_login" style="padding-top: 5px; width:140px; text-align:left; margin-bottom: 10px;">Email Address &nbsp;</label><br />
            <input type="text" maxlength="255" id="platform_user_login" name="platform_user_login" value="" style="width:308px; margin-bottom: 20px;"/><br />
            <label for="platform_user_password" style="padding-top: 5px; width:140px; text-align:left; margin-bottom: 10px;">Password &nbsp;</label><br />
            <input type="password"  maxlength="10" id="platform_user_password" name="platform_user_password" value="" style="width:308px"/><br /><br/>
            <input type="submit" value="Login" class="gold_button platform-button-big" style="float:right; margin-right: 50px;padding: 10px 42px;font-size: 14px;margin-bottom: 5px;"/><br />
            <input type="hidden" name="p" value="<?php echo $p ?>" /><input type="hidden" name="dest" value="<?php echo $dest ?>" /><br />
            </form>
            <div class="clearfix"></div>
            <a href="/forgot-your-password" class="p_link" style="float:right; font-size:11px; margin-right: 50px; margin-top: 5px;">Forgot Your Password?</a>
    </div>    

    <div style="float:right; width:310px; margin-right:70px; border-right:1px solid #e9e9e9;">
        <div id="platform-pagetitle-small" class="BebasNeue">Login with Facebook</div>
        <br/><br/>
        <div id="fb-auth" style="cursor:pointer;"><img src="<?php bloginfo('template_directory'); ?>/gfx/platform_login_facebook.png"/></div>
    </div>    
    
    <div class="clearfix"></div>
    <br/>
    <hr/>
    <br/>
    <div id="platform-login-signup">Don't have an account yet? <a href="/signup">Sign up now</a></div>
    
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
                    button = document.getElementById('fb-auth');
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
