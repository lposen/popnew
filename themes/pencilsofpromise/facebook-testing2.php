<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Facebook-2
*/
?>

<?php get_header(); ?>


    <body>
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

	    </body>

		
	<?php get_footer(); ?>
	</html>