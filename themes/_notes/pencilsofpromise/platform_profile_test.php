<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Platform Profile Test
*/
?>

<?php get_header(); ?>

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
//$loginEmail='jezras@yahoo.com'; //to be replaced by FB connect
$loginEmail=$current_user->user_email;
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
  
    <?php
        $contact;
        $isLogin = false;
        if ($contactId) {
            $query = "SELECT id,Name FROM Contact WHERE id = '".$contactId."' LIMIT 1";
            $response = $mySforceConnection->query($query);
            foreach ($response->records as $record) {
                $contact->name=$record->fields->Name;
                $contact->id=$record->Id;
            }; 
        }
        else {
            $query = "SELECT id,Name FROM Contact WHERE id = '".$loginId."' LIMIT 1";
            $response = $mySforceConnection->query($query);
            foreach ($response->records as $record) {
                $contact->name=$record->fields->Name;
                $contact->id=$record->Id;
            };             
        }
    ?>    
    
    <h1><?php echo $contact->name; ?></h1>
    <div>    
        <div class="leftcolumn"> 

            <div class="platformsection-left">       
               <p>Impact TBD</p>
            </div>

        </div>

        <div class="rightcolumn"> 

            <div class="platformsection-right">
                Video/Picture TBD
            </div>      

        </div>  
    </div>   
    
    <h2>Fundraisers</h2>    
    <div class="platformsection">  
    <ul>
    <?php
        $query = "SELECT id,Name,Goal__c FROM Fundraiser__c WHERE id IN (SELECT Fundraiser__c FROM Contact_Fundraiser__c WHERE Contact__c = '".$contact->id."') LIMIT 100";
        $response = $mySforceConnection->query($query);
         foreach ($response->records as $record) {
            echo '<li><a href="/fundraise/fundraiser?fid='.$record->Id.'">'.$record->fields->Name.'</a>';
            echo ' &nbsp; [<a href="/fundraise/manage?fid='.$record->Id.'">edit</a>]';    
            echo '</li>';
         };       
    ?>
    </ul>
    </div>

    <h2>Club Memberships</h2>  
    <div class="platformsection">
        <h3>AS ADMIN</h3>
            <ul>
            <?php
                $query = "SELECT id,Name FROM Group__c WHERE id IN (SELECT Group__c FROM Group_Admin__c WHERE Contact__c = '".$contact->id."') LIMIT 100";
                $response = $mySforceConnection->query($query);
                 foreach ($response->records as $record) {
                    echo '<li><a href="/groups/group?cid='.$record->Id.'">'.$record->fields->Name.'</a>';
                    echo ' &nbsp; [<a href="/groups/manage?cid='.$record->Id.'">edit</a>]';    
                    echo '</li>';
                 };       
            ?>
            </ul>
        <h3>AS MEMBER</h3>
            <ul>
            <?php
                $query = "SELECT id,Name FROM Group__c WHERE id IN (SELECT Group__c FROM Group_Member__c WHERE Contact__c = '".$contact->id."') LIMIT 100";
                $response = $mySforceConnection->query($query);
                 foreach ($response->records as $record) {
                    echo '<li><a href="/userprofile?cid='.$record->Id.'">'.$record->fields->Name.'</a></li>';
                };       
            ?>
            </ul>
    </div>       
    
</div>
<?php get_footer(); ?>
