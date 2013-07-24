<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Platform Fundraisers Browse
*/
?>

<?php get_header(); ?>

<link rel="stylesheet" href="/wp-content/themes/pencilsofpromise/platform_style.css" type="text/css" media="screen" />

<?php
//Get the Platform Options
$platform_options = get_option( 'pop_platform_options' );
?>

<?php
//Initiate the Platform Connection
define("USERNAME", $platform_options['platform_sf_un']);
define("PASSWORD", $platform_options['platform_sf_pw']);
define("SECURITY_TOKEN", $platform_options['platform_sf_api']);
require_once ('soapclient/SforcePartnerClient.php');
$mySforceConnection = new SforcePartnerClient();
$mySforceConnection->createConnection("soapclient/partner.wsdl.xml");
$mySforceConnection->login(USERNAME, PASSWORD.SECURITY_TOKEN);
?>

<?php
//Initiate the Platform Variables
$loginEmail='jezras@yahoo.com'; //to be replaced by FB connect
$loginId;$groupId;$fundId;
$query = "SELECT FirstName,Id FROM Contact WHERE Email = 'jezras@yahoo.com' LIMIT 1";
$response = $mySforceConnection->query($query);
foreach ($response->records as $record) {
    $loginId = $record->fields->Id;
}
$groupId = $_GET["cid"];
$fundId = $_GET["fid"];
$contactId=$_GET["uid"];
?>

<div id="platform">
	<?php 
		if (have_posts()) : while (have_posts()) : the_post(); 
		$thumb_id = get_post_thumbnail_id(get_the_ID());
		$thumb = wp_get_attachment_image_src($thumb_id, 'feature-image-thumb');
	?>

	<?php endwhile; endif; ?>

<div id="main">

    
    <h1>Browse Fundraisers</h1>
 
    <div class="platformsection">  
    <ul>
    <?php
        $query = "SELECT id,Name,Goal__c FROM Fundraiser__c LIMIT 100";
        $response = $mySforceConnection->query($query);
         foreach ($response->records as $record) {
            echo '<li><a href="/fundraise/fundraiser?fid='.$record->Id.'">'.$record->fields->Name.'</a></li>';
         };       
    ?>
    </ul>
    </div>
    
</div>
<?php get_footer(); ?>
