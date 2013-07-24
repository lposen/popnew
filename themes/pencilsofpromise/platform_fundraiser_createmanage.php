<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Platform Create Manage Fundraiser
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
    
<?php if ($fundId) {  ?>
    <h1>Manage a Fundraiser</h1>
<?php } else {  ?>    
    <h1>Create a Fundraiser</h1>
<?php }  ?>
    
<?php if ($groupId) {  ?>
    <p>You are creating a club fundraiser.</p><br/>
<?php } else if (!$fundId) {  ?>    
    <p>You are creating a personal fundraiser.</p><br/>
<?php }  ?> 
    
    <h2>Step 1: Choose Fundraiser Type</h2>    
    <?php
    if ($fundId) {
        $fund;
        $query = "SELECT Name, Description__c, Photo_URL__c, Video_URL__c, Goal__c, Type__c, Impact__c FROM Fundraiser__c WHERE Id = '".$fundId."' LIMIT 1";
        $response = $mySforceConnection->query($query);
        foreach ($response->records as $record) {
            $fund->name=$record->fields->Name;
            $fund->video=$record->fields->Photo_URL__c;
            $fund->photo=$record->fields->Video_URL__c;
            $fund->description=$record->fields->Description__c;
            $fund->goal=$record->fields->Goal__c;
            $fund->type=$record->fields->Type__c;
            $fund->impact=$record->fields->Impact__c;
        };
    }
    ?>
<form action="/platform-process" >  
<?php if (!$groupId) { ?> 
    <input type="hidden" id="fundcontact" name="fundcontact" value="<?php echo $loginId; ?>"/>
<?php } else { ?>  
    <input type="hidden" id="fundclub" name="fundclub" value="<?php echo $groupId; ?>"/>    
<?php } ?>
    <input type="hidden" id="fundid" name="fundid" value="<?php echo $fundId; ?>"/>
    <div class="platformsection">       
    <label for="fundtype">Achieve Your Impossible</label><input type="radio" id="fundtype" name="fundtype" value="Achieve Your Impossible" <?php if ($fund->type == 'Achieve Your Impossible') {echo 'checked'; } ?>/><br/>
    <label for="fundtype">Donate a Day</label><input type="radio" id="fundtype" name="fundtype" value="Donate a Day" <?php if ($fund->type == 'Donate a Day') {echo 'checked'; } ?>/><br/>
    <label for="fundtype">Support Our Work</label><input type="radio" id="fundtype" name="fundtype" value="Support Our Work" <?php if ($fund->type == 'Support Our Work') {echo 'checked'; } ?>/><br/>
    </div>
    
    <h2>Step 2: Set Your Goal</h2>    
    <div class="platformsection">
    <label for="fundgoal">$25</label><input type="radio" id="fundgoal" name="fundgoal" value="25" <?php if ($fund->goal == '25') {echo 'checked'; } ?>/><br/>
    <label for="fundgoal">$250</label><input type="radio" id="fundgoal" name="fundgoal" value="250" <?php if ($fund->goal == '250') {echo 'checked'; } ?>/><br/>
    <label for="fundgoal">$2,500</label><input type="radio" id="fundgoal" name="fundgoal" value="2500" <?php if ($fund->goal == '2500') {echo 'checked'; } ?>/><br/>
    <label for="fundgoal">$10,000</label><input type="radio" id="fundgoal" name="fundgoal" value="10000" <?php if ($fund->goal == '10000') {echo 'checked'; } ?>/><br/>
    <label for="fundgoal">$25,000</label><input type="radio" id="fundgoal" name="fundgoal" value="25000" <?php if ($fund->goal == '25000') {echo 'checked'; } ?>/>
    </div>    
    
    <h2>Step 3: Direct Your Impact</h2>    
    <div class="platformsection">       
        <h3>BY COUNTRY</h3>
            <label for="fundimpact">Projects in Laos</label><input type="radio" id="fundimpact" name="fundimpact" value="Laos" <?php if ($fund->impact == 'Laos') {echo 'checked'; } ?>/><br/>
            <label for="fundimpact">Projects in Guatemala</label><input type="radio" id="fundimpact" name="fundimpact" value="Guatemala" <?php if ($fund->impact == 'Guatemala') {echo 'checked'; } ?>/><br/>
            <label for="fundimpact">Projects in Nicaragua</label><input type="radio" id="fundimpact" name="fundimpact" value="Nicaragua" <?php if ($fund->impact == 'Nicaragua') {echo 'checked'; } ?>/><br/>        
        
        <h3>BY PROJECT TYPE</h3>
            <label for="fundimpact">Preschool Projects</label><input type="radio" id="fundimpact" name="fundimpact" value="Preschool" <?php if ($fund->impact == 'Preschools') {echo 'checked'; } ?>/><br/>
            <label for="fundimpact">Primary School Projects</label><input type="radio" id="fundimpact" name="fundimpact" value="Primary Schools" <?php if ($fund->impact == 'Primary Schools') {echo 'checked'; } ?>/><br/>
            <label for="fundimpact">Mixed Use Projects</label><input type="radio" id="fundimpact" name="fundimpact" value="Mixed Use" <?php if ($fund->impact == 'Mixed Use') {echo 'checked'; } ?>/><br/>        
        <h3>LEAVE IT UP TO US</h3>
            <label for="fundimpact">Use my Money Where Most Needed</label><input type="radio" id="fundimpact" name="fundimpact" value="Wherever" <?php if ($fund->impact == 'Wherever') {echo 'checked'; } ?>/><br/>
    </div>

    <h2>Step 4: Make Your Appeal</h2>    
    <div class="platformsection">       
        <label for="clubname">Fundraiser Name: </label><input type="text" size="20" id="fundname" value="<?php echo $fund->name; ?>" name="fundname"/><br/>
        <label for="fundvideo">Video URL:</label><input type="text" size="40" id="fundvideo" value="<?php echo $fund->video; ?>" name="fundvideo" value=""/><br/>              
        <label for="file_upload">Profile Photo:</label><input type="file" name="file_upload" id="file_upload" /><br/> 
        <label for="clubdescription">Fundraiser Description: </label><input type="text" size="40" id="funddescription" value="<?php echo $fund->description; ?>" name="funddescription"/><br/>
    </div>
    <input type="submit"/>
</form>
    
</div>
<?php get_footer(); ?>
