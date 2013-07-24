<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 Template Name: Edit Account
*/
do_action('ajaxDecideNextStep');

$current_user = wp_get_current_user();

$new_username = "";
if (isset($_REQUEST['new_username'])){
    $new_username = $_REQUEST['new_username'];
} else {
    $new_username = $current_user->user_login;
}
$new_email = "";
if (isset($_REQUEST['new_email'])){
    $new_email = $_REQUEST['new_email'];
} else {
    $new_email = $current_user->user_email;
}

if ( (isset($_REQUEST['save_account'])) && ((!isset($register_errors)) || (count($register_errors) == 0)) ){
?>
<script>
$(document).ready(function()
{
	closeMe(true);
});
</script>
<?php 
}
?>
<div>
<div class="account_error modal_error">
<?php
if (isset($register_errors)) {
    foreach ($register_errors as $error) {
        echo $error . "<br />";
    } 
}
?>
</div>
<form method='POST' id="edit_account_form" name="edit_account_form">
<div class="form-body">
<label>Username</label><br />
<input type="text" name="new_username" value="<?php echo $new_username ?>" class="textinput" />
<label>Email</label><br />
<input type="text" name="new_email" value="<?php echo $new_email ?>" class="textinput" />
<label>Password</label><br />
<input type="password" name="new_password" value="" class="textinput" />
<label>Confirm Password</label><br />
<input type="password" name="new_password_confirm" value="" class="textinput" />
<input type="hidden" name="save_account" value="Save" class="textinput" />
</div>
<div class="clearfix"></div>
<input type="button" onclick="sendData('<?php echo $_SERVER['REQUEST_URI']; ?>', 'edit_account_form', 530, 509);" value="Save" class="formsubmit" />
<input type="button" onclick="closeMe(false);" name="close" value="Close" class="formsubmit" />
</form>
</div>