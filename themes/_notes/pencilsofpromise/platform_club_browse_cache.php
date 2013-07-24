<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Platform Clubs Browse
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

<?php
//initiate the cache
require_once ('Cache/Lite.php');
$cache_options = array(
    'cacheDir' => 'platform-cache/',
    'lifeTime' => 3600
);
$cache_id = $_SERVER["REQUEST_URI"];
$cache_html;
$cache = new Cache_Lite($cache_options);
?>

<div id="platform">
	<?php 
		if (have_posts()) : while (have_posts()) : the_post(); 
		$thumb_id = get_post_thumbnail_id(get_the_ID());
		$thumb = wp_get_attachment_image_src($thumb_id, 'feature-image-thumb');
	?>

	<?php endwhile; endif; ?>

<div id="main">

    
    <h1>Browse Clubs</h1>
 
    <div class="platformsection">  
    <ul>
    <?php
        if (($cache_html = $cache->get($cache_id)) === false) {
            $query = "SELECT id,Name FROM Group__c LIMIT 100";
            $response = $mySforceConnection->query($query);
             foreach ($response->records as $record) {
                $cache_html.='<li><a href="/clubs/club?cid='.$record->Id.'">'.$record->fields->Name.'</a></li>';
                //echo '<li><a href="/clubs/club?cid='.$record->Id.'">'.$record->fields->Name.'</a></li>';
             };   
            $cache->save($cache_html, $cache_id);
        }    
        echo $cache_html;
    ?>
    </ul>
    </div>
    
</div>
<?php get_footer(); ?>
