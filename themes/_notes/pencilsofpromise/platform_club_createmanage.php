<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Platform Create Manage Club
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
    
<?php if ($groupId) {  ?>
    <h1>Manage a Club</h1>
<?php } else {  ?>    
    <h1>Create a Club</h1>
<?php }  ?> 
    
    <h2>Step 1: Club Information</h2>    
    <?php
    if ($groupId) {
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
    }
    ?>
    
    <div class="platformsection">       
        <form action="/platform-process" >
            <input type="hidden" id="clubadmin" name="clubadmin" value="<?php echo $loginId; ?>"/>
            <input type="hidden" id="clubid" name="clubid" value="<?php echo $groupId; ?>"/>
            <label for="clubname">Club Name: </label><input type="text" size="20" id="clubname" value="<?php echo $club->name; ?>" name="clubname"/><br/>
            <label for="clubdescription">Club Location: </label><input type="text" size="40" id="clublocation" value="<?php echo $club->location; ?>" name="clublocation"/><br/>
            <label for="clublocation">Schools / Company Affiliation: </label><input type="text" size="20" id="clubaffiliation" value="<?php echo $club->affiliation; ?>" name="clubaffiliation"/><br/>
            <label for="clubadmin">Video URL:</label><input type="text" size="40" id="clubvideo" value="<?php echo $club->video; ?>" name="clubvideo" value=""/><br/>              
            <label for="clubadmin">Photo URL:</label><input type="text" size="40" id="clubphoto" value="<?php echo $club->photo; ?>" name="clubphoto" value=""/><br/> 
            <label for="clubdescription">Club Description: </label><input type="text" size="40" id="clubdescription" value="<?php echo $club->description; ?>" name="clubdescription"/><br/>
            <input type="submit"/>
        </form>
        
    </div>
    
<?php 
if ($groupId) {
?>
    <h2>Step 2: Manage Members</h2>    
    <div class="platformsection">
            <h3>CLUB MEMBERS</h3>
            <ul>
            <?php 
                $query = "SELECT id,Name,Email FROM Contact WHERE id IN (SELECT Contact__c FROM Group_Member__c WHERE Group__c = '".$groupId."') LIMIT 100";
                $response = $mySforceConnection->query($query);
                 foreach ($response->records as $record) {
                    $removeString='?clubremove=true&clubid='.$groupId.'&clubremovetype=Group_Member__c&clubcontact='.$record->Id;
                    $promoteString='?clubpromote=true&clubid='.$groupId.'&clubcontact='.$record->Id;
                    echo '<li>Member: '.$record->fields->Name.' ('.$record->fields->Email.') [<a href="club-create-test'.$promoteString.'">promote to admin</a>] [<a href="club-create-test'.$removeString.'">remove</a>]</li>';
                };       
            ?>
            </ul>
            <h3>CLUB ADMINS</h3>
            <ul>
            <?php
                $query = "SELECT id,Name,Email FROM Contact WHERE id IN (SELECT Contact__c FROM Group_Admin__c WHERE Group__c = '".$groupId."') LIMIT 100";
                $response = $mySforceConnection->query($query);
                 foreach ($response->records as $record) {
                    $removeString='?clubremove=true&clubid='.$groupId.'&clubremovetype=Group_Admin__c&clubcontact='.$record->Id;
                    $demoteString='?clubdemote=true&clubid='.$groupId.'&clubcontact='.$record->Id;
                    echo '<li>'.$record->fields->Name.' ('.$record->fields->Email.') [<a href="club-create-test'.$demoteString.'">demote to member</a>] [<a href="club-create-test'.$removeString.'">remove</a>]</li>';
                };       
            ?>
            </ul>
            <h3>INVITE MEMBERS</h3>
            <form action="/platform-process">
                <input type="hidden" id="clubid" name="clubid" value="<?php echo $groupId; ?>"/>
                <textarea id="clubinvitees" name="clubinvitees"></textarea><br/>
                <input type="submit"/>
            </form>
    </div>    
    
    <h2>Step 3: Manage Fundraisers</h2>    
    <div class="platformsection">  
    <ul>
    <?php
        $fundraiserId;
        $query = "SELECT id,Name,Goal__c FROM Fundraiser__c WHERE id IN (SELECT Fundraiser__c FROM Group_Fundraiser__c WHERE Group__c = '".$groupId."') LIMIT 100";
        $response = $mySforceConnection->query($query);
         foreach ($response->records as $record) {
            echo '<li><b>'.$record->fields->Name.'</b> Goal:'.$record->fields->Goal__c.' [<a href="/fundraise/fundraiser?fid='.$record->Id.'">view</a>] [<a href="/fundraise/manage?fid='.$record->Id.'">manage</a>]</li>';
        };       
    ?>
    </ul>        
     <input type="button" value="Create a New Club Fundraiser" onclick="location.href='/fundraise/manage?cid=<?php echo $groupId; ?>'"/>
    </div>

<?php 
}
?>    
    
</div>
<?php get_footer(); ?>
