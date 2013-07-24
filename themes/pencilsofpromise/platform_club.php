<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Platform Club
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
?>

<div id="platform">
	<?php 
		if (have_posts()) : while (have_posts()) : the_post(); 
		$thumb_id = get_post_thumbnail_id(get_the_ID());
		$thumb = wp_get_attachment_image_src($thumb_id, 'feature-image-thumb');
	?>

	<?php endwhile; endif; ?>

<div id="main">
  
    <?php
        $club;
        $query = "SELECT Name, Description__c, Location__c, School_Company_Affiliation__c, Photo_URL__c, Video_URL__c FROM Group__c WHERE Id = '".$groupId."' AND Published__c = TRUE LIMIT 1";
        $response = $mySforceConnection->query($query);
        foreach ($response->records as $record) {
            $club->name=$record->fields->Name;
            $club->location=$record->fields->Location__c;
            $club->affiliation=$record->fields->School_Company_Affiliation__c;
            $club->video=$record->fields->Photo_URL__c;
            $club->photo=$record->fields->Video_URL__c;
            $club->description=$record->fields->Description__c;
        };
    ?>    
    
    <h1><?php echo $club->name; ?></h1>
    <div>    
        <div class="leftcolumn"> 

            <div class="platformsection-left">       
               <p>Club Location: <?php echo $club->location; ?></p>
               <p>Schools / Company Affiliation: <?php echo $club->affiliation; ?></p>
               <p>Video URL: <?php echo $club->video; ?></p>        
               <p>Photo URL: <?php echo $club->photo; ?></p>
               <p>Club Description: <?php echo $club->description; ?></p>
            </div>

        </div>

        <div class="rightcolumn"> 

            <div class="platformsection-right">
                Video/Picture TBD
            </div>      

        </div>  
    </div>

    <h2>Club Fundraisers</h2>    
    <div class="platformsection">  
    <ul>
    <?php
        $fundraiserId;
        $query = "SELECT id,Name,Goal__c FROM Fundraiser__c WHERE id IN (SELECT Fundraiser__c FROM Group_Fundraiser__c WHERE Group__c = '".$groupId."') LIMIT 100";
        $response = $mySforceConnection->query($query);
         foreach ($response->records as $record) {
            echo '<li><a href="/fundraise/fundraiser?fid='.$record->Id.'">'.$record->fields->Name.'</a></li>';
        };       
    ?>
    </ul>
    </div> 
    
    <h2>Club Members</h2>  
    <div class="platformsection">
            <ul>
            <?php
                $query = "SELECT id,Name FROM Contact WHERE id IN (SELECT Contact__c FROM Group_Member__c WHERE Group__c = '".$groupId."') LIMIT 100";
                $response = $mySforceConnection->query($query);
                 foreach ($response->records as $record) {
                    echo '<li><a href="/userprofile?uid='.$record->Id.'">'.$record->fields->Name.'</a></li>';
                };       
            ?>
            </ul>
    </div>    
    
</div>
<?php get_footer(); ?>
