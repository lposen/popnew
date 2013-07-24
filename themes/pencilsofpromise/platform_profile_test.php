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

<link rel="stylesheet" href="/wp-content/themes/pencilsofpromise/platform_style.css" type="text/css" media="screen" />

<?php
//Get the Platform Options
$platform_options = get_option( 'pop_platform_options' );
?>

				<?PHP
	$User_First_Name = $_POST['User_First_Name'];
	$User_Last_Name = $_POST['User_Last_Name'];
	$User_Sex = $_POST['User_Sex'];
	$User_Email = $_POST['User_Email'];
	$User_About_Me = $_POST['User_About_Me'];
	$User_Movies = $_POST['User_Movies'];
	$User_Profile_Pic = $_POST['User_Profile_Pic'];

	echo 'Full Name: '. $User_Full_Name = $_POST['User_Full_Name'];
	echo "<br>";
	echo "<br>";
	echo 'First Name: '. $User_First_Name = $_POST['User_First_Name'];
	echo "<br>";
	echo 'Last Name: '.$User_Last_Name = $_POST['User_Last_Name'];
	echo "<br>";
	echo 'Sex: '.$User_Sex = $_POST['User_Sex'];
	echo "<br>";
	echo 'Email: '.$User_Email = $_POST['User_Email'];
	echo "<br>";
	echo "<br>";
	echo 'About Me: '.$User_About_Me = $_POST['User_About_Me'];
	echo "<br>";
	echo "<br>";
	echo 'Movies: '.$User_Movies = $_POST['User_Movies'];
	echo "<br>";
	$pic_url = $User_Profile_Pic = $_POST['User_Profile_Pic'];
	echo "<br>";
	echo "<img src='$pic_url'></img>"
				?>

				<div id="other" style="display:none">
			            <a href="#" onclick="showStream(); return false;">Publish on Facebook Wall Post</a> |
			            <a href="#" onclick="share(); return false;">Share With Your Friends</a> |
			            <a href="#" onclick="donationStreamPublish(); return false;">Publish Automatic (Graph API) Stream on Donation</a> |
			            <a href="#" onclick="fqlQuery(); return false;">FQL Query Example</a>

			            <br />
			            <textarea id="status" cols="50" rows="5">Write your Facebook status here and click 'Post'</textarea>
			            <br />
			            <a href="#" onclick="setStatus(); return false;">Post Message on my Facebook Wall</a>


			        </div>


	<?php if (username_exists( $User_Full_Name )){
	 	$creds = array();
		$creds['user_login'] = $User_Full_Name;
		$creds['user_password'] = $User_Last_Name;
		$creds['remember'] = true;
		$user = wp_signon( $creds, false );
		if ( is_wp_error($user) )
		   echo $user->get_error_message();
	// wp_redirect(get_bloginfo('url'));
	}else{

		wp_create_user( $User_Full_Name, $User_Last_Name, $User_Email);
	echo "success created";}
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
wp_get_current_user();
$loginEmail=$current_user->user_email;

//Initiate the Platform Variables
//$loginEmail='jezras@yahoo.com'; //to be replaced by FB connect
$loginId;$groupId;$fundId;
$query = "SELECT FirstName,Id FROM Contact WHERE Email = '".$loginEmail."' LIMIT 1";
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
                    echo '<li><a href="/clubs/club?cid='.$record->Id.'">'.$record->fields->Name.'</a>';
                    echo ' &nbsp; [<a href="/clubs/manage?cid='.$record->Id.'">edit</a>]';
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
