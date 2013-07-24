<?php
ob_start();

/**
 * @package WordPress
 * @subpackage Default_Theme
 Template Name: Forgot Your Password
*/

	get_header();
?>
<script>
function GoBack() {
	window.location = "login";
}
</script>
<div id="platform-formpage">
    <div id="platform-popup" class="clearfix p_link">
        <div id="forgot">
        <h1 id="platform-pagetitle-small" class="BebasNeue">Forgot Something?</h1>
        <?php
        if (isset($errormsg)) {
                    foreach($errormsg as $msg){
                        echo '<div class="account_error">' . $msg . '</div>';
                    }
                }
                if (isset($successmsg)) {
                    foreach($successmsg as $msg){
                        echo '<p class="success">' . $msg . '</p>';
                    }
                }
                ?>
        <div id="forgot_pw" class="grey_border">
                Send me my username and a new password to my email address:<br />

                <form method='POST' id="register_form" name="register_form"
                        action='<?php
                        echo $_SERVER['REQUEST_URI'];
                        ?>'>
                <input type="text" name="email" value="" id="enteremail" /><br />
                <input class="gold_button" type="submit" name="send_email" value="Send Email" id="emailsubmit" />
                <a onclick="GoBack(); return false;" href="#" style="font-size: 12px; margin-left: 10px;">Back to Login</a>
                </form>
        </div>
    </div>
</div>

<?php
	
	get_footer();

	ob_end_flush();
?>