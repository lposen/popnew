<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Platform Error
*/
?>

<?php get_header(); ?>

<?php
//PLATFORM DISPLAY PAGE INIT
$mySforceConnection = doSalesforceConnect();
$loginId;$groupId;$fundId;$contactId;
$loginId = doPlatformLogin($current_user,$mySforceConnection);
$groupId = $_GET["g"];
$fundId = $_GET["f"];
$contactId=$_GET["u"];
$marketing=$_GET["m"];
?>

<?php
//PLATFORM DISPLAY PAGE INIT
$error=$_GET["e"];
?>

<div id="platform-formpage">

    <div id="platform-popup" class="clearfix">

    <div  id="error">We're sorry, but an error has occurred. If you continue to have a problem please <a href="/contact">Contact us</a>.</div>
    <br/><br/>
    <div  id="error" style="font-size:10px; font-style:italic">
    <?php 
    $platform_options = get_option( 'pop_platform_options' );
    if ($platform_options['platform_errors']) {
        echo stripslashes(urldecode($error)); 
    } 
    ?>
    </div>
    
 </div>
 </div>
                
<?php get_footer(); ?>
                