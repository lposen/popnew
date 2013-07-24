<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Salesforce Testing Display
*/
?>

<?php get_header(); ?>

<div id="testing">
	<?php 
		if (have_posts()) : while (have_posts()) : the_post(); 
		$thumb_id = get_post_thumbnail_id(get_the_ID());
		$thumb = wp_get_attachment_image_src($thumb_id, 'feature-image-thumb');
	?>
    
	<?php endwhile; endif; ?>

<div id="main" style="padding:30px;">
    
<div id="loginSection">    
    <h2>LOGIN</h2>
    <p>Hardcoded email "jezras@yahoo.com"</p>
    <?php
    define("USERNAME", "database@pencilsofpromise.org.developbox");
    define("PASSWORD", "12345PoP");
    define("SECURITY_TOKEN", "OrNHntKSnvpodypgMY1N9425");
    require_once ('soapclient/SforcePartnerClient.php');
    $mySforceConnection = new SforcePartnerClient();
    $mySforceConnection->createConnection("soapclient/partner.wsdl.xml");
    $mySforceConnection->login(USERNAME, PASSWORD.SECURITY_TOKEN);


    //assume we are logged in and get this email: jezras@yahoo.com
    $loginId = '0';
    $query = "SELECT FirstName,Id FROM Contact WHERE Email = 'jezras@yahoo.com' LIMIT 1";
    $response = $mySforceConnection->query($query);
    foreach ($response->records as $record) {
        $loginId = $record->fields->Id;
    }
    ?>

    <p>Contact Id for loggedin user is <?php echo $loginId; ?></p>
</div>

<div id="clubSection"> 
    <h2>CREATE TEST OBJECTS</h2>  
    <div>
        <form action="club-create-test">
            <label for="clubname">Create a PoP Club named: </label><input type="text" size="20" id="clubname" name="clubname"/><br/>
            <label for="clubdescription">with description: </label><input type="text" size="40" id="clubdescription" name="clubdescription"/><br/>
            <label for="clublocation">with location: </label><input type="text" size="20" id="clublocation" name="clublocation"/><br/>
            <label for="clubadmin">admin contact id:</label><input type="text" size="40" id="clubadmin" name="clubadmin" value="<?php echo $loginId; ?>"/><br/>              
            <input type="submit"/>
        </form>
    </div>
    <div>
        <form action="club-create-test">
            <label for="clubname">Create a Fundraiser named: </label><input type="text" size="20" id="fundname" name="fundname"/><br/>
            <label for="clubdescription">With description this: </label><input type="text" size="40" id="funddescription" name="funddescription"/><br/>
            <label for="clublocation">Attached to this Contact: </label><input type="text" size="20" id="fundcontact" name="fundcontact" value="<?php echo $loginId; ?>"/><br/>     
            <label for="clublocation">Attached to this Club: </label><input type="text" size="20" id="fundclub" name="fundclub"/><br/>
            <input type="submit"/>
        </form>
    </div>    
</div>
    
<div id="clubSection"> 
    <h2>CLUBS LISTING</h2>    
    <?php
    //get the counts
    $clubCount = 0;
    $query = "SELECT COUNT() FROM PoP_Club__c WHERE Published__c = TRUE";
    $response = $mySforceConnection->query($query);
    $clubCount=$response->size;
    ?>     
    <p>Total number of published PoP clubs: <?php echo $clubCount;?></p>   
    <h3>MY CLUBS (is admin)</h3>
    <ul>
    <?php 
    $adminClubDetailId;
    $query = "SELECT id,Name FROM PoP_Club__c WHERE Published__c = TRUE AND id IN (SELECT PoP_Club__c FROM Club_Admin__c WHERE Contact__c = '".$loginId."') LIMIT 100";
    $response = $mySforceConnection->query($query);
    foreach ($response->records as $record) {
        if ($adminClubDetailId==null) { 
            $adminClubDetailId = $record->Id;
        }
        echo '<li>'.$record->fields->Name.'</li>';
    }; 
    ?>
    </ul>

    <h3>OTHER CLUBS (not admin)</h3> 
    <ul>
    <?php  
    $query = "SELECT id,Name FROM PoP_Club__c WHERE Published__c = TRUE AND id NOT IN (SELECT PoP_Club__c FROM Club_Admin__c WHERE Contact__c = '".$loginId."') LIMIT 100";
    $response = $mySforceConnection->query($query);
    foreach ($response->records as $record) {
        echo '<li>'.$record->fields->Name.'</li>';
    }; 
    ?>
    </ul>    
    
</div>

<div id="clubSection"> 
    <h2>CLUB DETAIL</h2>

    <?php    
    $clubId = $_GET["cid"];
    if ($clubId!='') {
        ?>
            <p>Showing details for club id: <?php echo $clubId; ?></p>
        <?php
    }
    else {
        $clubId = $adminClubDetailId;
        ?>
            <p>Showing first admin club for this user with id: <?php echo $clubId; ?></p>
        <?php    
    }
    $query = "SELECT Name, Description__c, Location__c FROM PoP_Club__c WHERE Id = '".$clubId."' AND Published__c = TRUE LIMIT 1";
    $response = $mySforceConnection->query($query);
    foreach ($response->records as $record) {
        echo '<p>Club Name: '.$record->fields->Name.'</br>';
        echo 'Description: '.$record->fields->Description__c.'</br>';
        echo 'Location: '.$record->fields->Location__c.'</p>';
    };
    ?>    
</div>
<div id="clubSection">
    <h3>CLUB FUNDRAISERS</h3>
    <ul>
    <?php
        $fundraiserId;
        $query = "SELECT id,Name FROM Fundraiser__c WHERE id IN (SELECT Fundraiser__c FROM Club_Fundraiser__c WHERE PoP_Club__c = '".$clubId."') LIMIT 100";
        $response = $mySforceConnection->query($query);
         foreach ($response->records as $record) {
            if ($fundraiserId==null) { 
                $fundraiserId = $record->Id;
            }
            echo '<li>Fundraiser: '.$record->fields->Name.'</li>';
        };       
    ?>
    </ul>
</div>
<div id="clubSection">
    <h3>CLUB MEMBERS</h3>
    <ul>
    <?php 
        $query = "SELECT id,Name FROM Contact WHERE id IN (SELECT Contact__c FROM Club_Member__c WHERE PoP_Club__c = '".$clubId."') LIMIT 100";
        $response = $mySforceConnection->query($query);
         foreach ($response->records as $record) {
            echo '<li>Member: '.$record->fields->Name.'</li>';
        };
    ?>
    </ul>
</div>
<div id="clubSection">
    <h3>CLUB ADMINS</h3>
    <ul>
    <?php 
        $query = "SELECT id,Name FROM Contact WHERE id IN (SELECT Contact__c FROM Club_Admin__c WHERE PoP_Club__c = '".$clubId."') LIMIT 100";
        $response = $mySforceConnection->query($query);
         foreach ($response->records as $record) {
            echo '<li>Admin: '.$record->fields->Name.'</li>';
        };       
    ?>
    </ul>
</div>
    
<div id="clubSection"> 
    <h2>FUNDRAISER DETAIL</h2>

    <?php  
    if ($_GET["fid"]) {
        $fundraiserId = $_GET["fid"];
    }
    if ($fundraiserId!='') {
        ?>
            <p>Showing details for fundraiser id: <?php echo $fundraiserId; ?></p>
        <?php
    }
    else {
        ?>
            <p>Showing first fundraiser for this club with id: <?php echo $fundraiserId; ?></p>
        <?php    
    }
    $query = "SELECT Name, Description__c FROM Fundraiser__c WHERE Id = '".$fundraiserId."' AND Published__c = TRUE LIMIT 1";
    $response = $mySforceConnection->query($query);
    foreach ($response->records as $record) {
        echo '<p>Fundraiser Name: '.$record->fields->Name.'</br>';
        echo 'Description: '.$record->fields->Description__c.'</br>';
    };
    ?>    
</div>    
    
</div>
<?php get_footer(); ?>
