<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Platform Activate
*/
?>

<?php get_header(); ?>

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
if ($_GET["a"]) { //we are activating a club member
    $objectId;
    $sObject = new sObject();
    $sObject->fields = array('Active__c' => true);    
    $sObject->type = 'Group_Member__c';
    $sObject->Id=($_GET["a"]);
    try {
        $results = $mySforceConnection->update(array($sObject));
        foreach ($results as $i => $result) {
            ?>
            <div id="activate">Your groups membership has been activated. To see your group and start fundraising with friends <a href="<?php bloginfo('url'); ?>/signup">Sign up for an iPromise account.</a></div>

            <?php
        }

    }
    catch (exception $e) {
        echo 'fail:' . $e ;  
    }
}
?>

            </div></div>
 
<?php
}
catch (Exception $e) {
    ?>
    
    <script type="text/javascript">
      window.location= "/error";
    </script>
   <?php
}
?>

<?php get_footer(); ?>
                