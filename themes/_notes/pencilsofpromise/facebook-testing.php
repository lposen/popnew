<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Facebook O Auth
*/
?>


<?php get_header(); ?>
    <body>


<!---  ######################### need to add auto submit thisform   Input Form Area -->	
		<form id="User_Info" action="<?php echo esc_url( home_url( '/' ) ); ?>facebook-2" method="post">
		<input name="hdnFBAccessToken" id="hdnFBAccessToken" value="77be63197633c3a557a48b78c6c3fad6">
		<input name="hdnFBAppId" id="hdnAppId" value="197934993616615">
		<input id="User_Full_Name" name="User_Full_Name" value="testingerrorfullname">
		<input id="User_First_Name" name="User_First_Name" value="testingerrorfirstname">
		<input id="User_Last_Name" name="User_Last_Name" value="testingerrorlastname">
		<input id="User_Sex" name="User_Sex" value="testingerrorsex">
		<input id="User_Email" name="User_Email" value="testingerroremail">
		<input id="User_About_Me" name="User_About_Me" value="testingerroraboutme">
		<input id="User_Movies" name="User_Movies" value="testingerrormovies">
		<input id="User_Profile_Pic" name="User_Profile_Pic" value="testingerrorprofilepic">
		<input type="submit" name="confirm" id="confirm" value="Confirm">
		</form>

						
<!---  #########################   Facebook App API -->										
        <div id="fb-root"></div>
      
					
					
        <h3>PoP | FBConnect JavaScript SDK & OAuth 2.0</h3>
	<input type="button" id="fb-auth" onclick="start()" value="Login">
        <div id="loader" style="display:none">
            <img src="ajax-loader.gif" alt="loading" />
        </div>
        <br />
        <div id="user-info"></div>
        <br />
        <div id="debug"></div>

<!---  #########################   Call Facebook API Function -->
      	  <div id="other" style="display:none">
	            <a href="#" onclick="showStream()">Publish on Facebook Wall Post</a> |
	            <a href="#" onclick="share()">Share With Your Friends</a> |
	            <a href="#" onclick="donationStreamPublish()">Publish Automatic (Graph API) Stream on Donation</a> |
	            <a href="#" onclick="fqlQuery()">FQL Query Example</a>

	            <br />
	            <textarea id="status" cols="50" rows="5">Write your Facebook status here and click 'Post'</textarea>
	            <br />
	            <a href="#" onclick="setStatus()">Post Message on my Facebook Wall</a>
	

	        </div>
	

	    </body>

		
	<?php get_footer(); ?>
	</html>