<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Platform Fundraiser
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
    $isClub = false;
    $fund;
    $club;
    $contact;
    if ($fundId) {
        $query = "SELECT Name, Description__c, Photo_URL__c, Video_URL__c, Goal__c, Total_Raised__c, Type__c, Impact__c, isClub__c FROM Fundraiser__c WHERE Id = '".$fundId."' LIMIT 1";
        $response = $mySforceConnection->query($query);
        foreach ($response->records as $record) {
            $fund->name=$record->fields->Name;
            $fund->video=$record->fields->Photo_URL__c;
            $fund->photo=$record->fields->Video_URL__c;
            $fund->description=$record->fields->Description__c;
            $fund->goal=$record->fields->Goal__c;
            $fund->type=$record->fields->Type__c;
            $fund->impact=$record->fields->Impact__c;
            $fund->isclub=$record->fields->isClub__c;
            $fund->raised=$record->fields->Total_Raised__c;
        };
    }
    $isClub=$fund->isclub;
    if ($isClub=='true') { //its a club
        $query = "SELECT id,Name FROM Group__c WHERE id IN (SELECT Group__c FROM Group_Fundraiser__c WHERE Fundraiser__c = '".$fundId."') LIMIT 1";
        $response = $mySforceConnection->query($query);
        foreach ($response->records as $record) {
            $club->name=$record->fields->Name;
            $club->id=$record->Id;
        };           
    }
    else { //its a contact
        $query = "SELECT id,Name FROM Contact WHERE id IN (SELECT Contact__c FROM Contact_Fundraiser__c WHERE Fundraiser__c = '".$fundId."') LIMIT 1";
        $response = $mySforceConnection->query($query);
        foreach ($response->records as $record) {
            $contact->name=$record->fields->Name;
            $contact->id=$record->Id;
        };    
    }
    ?>
    
    <h1><?php echo $fund->name?></h1>
    <?php if ($isClub=='true') { ?>
    <h3>A fundraiser by <a href="/clubs/club?cid=<?php echo $club->id?>"><?php echo $club->name?></a></h3>
    <?php } else { ?>
    <h3>A fundraiser by <a href="/userprofile?uid=<?php echo $contact->id?>"><?php echo $contact->name?></a></h3>
    <?php } ?>
    <div class="leftcolumn"> 

        <div class="platformsection-left">
            <p>Type: <?php echo $fund->type?></p>
            <p>Goal: $<?php echo number_format($fund->goal,2)?></p>
            <p>Amount Raised: $<?php echo number_format($fund->raised,2)?></p>
            <p>Supporting: <?php echo $fund->impact?></p>
        </div> 

        <div class="platformsection-left">
            <?php echo $fund->description?>
        </div> 

        <div class="platformsection-left">
            Affiliated Project TBD
        </div>    

    </div>

    <div class="rightcolumn"> 

        <div class="platformsection-right">
            Video/Picture TBD
        </div>

        <div class="platformsection-right">
            <a href="/join-the-movement/donate?fid=<?php echo $fundId; ?>">Make a Donation to this Fundraiser</a> 
        </div>

        <div class="platformsection-right">
            <ul>
        <?php
            //get the donor if any
            if (($fund->raised) > 0) {
                $query = "SELECT id,Name, Amount FROM Opportunity WHERE Fundraiser__c = '".$fundId."' LIMIT 100";
                $response = $mySforceConnection->query($query);
                foreach ($response->records as $record) {
                    $contact->name=$record->fields->Name;
                    $contact->id=$record->Id;
                    ?>
                    <li><?php echo $record->fields->Name; ?> - $<?php echo number_format($record->fields->Amount,2); ?></li>
                    <?php
                };         
            }
        ?>
            </ul>
        </div>        

    </div>    

</div>
<?php get_footer(); ?>
