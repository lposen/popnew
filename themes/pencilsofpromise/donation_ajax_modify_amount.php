<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 Template Name: Modify Recurring Donation Amount
*/
do_action('ajaxDecideNextStep');

do_action('pp_modify_donation_amount');

$amount = 0;
if (isset($_REQUEST['new_amount'])){
    $amount = $_REQUEST['new_amount'];
} else if (isset($_REQUEST['current_amount'])){
    $amount = $_REQUEST['current_amount'];
}  



if ( (isset($_REQUEST['save_modify_amount'])) && ((!isset($donation_errors)) || (count($donation_errors) == 0)) ){
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
<script>
$(document).ready(function()
{
	ConvertToDays(document.getElementById('money').value, .32);
});
</script>
<div>
<div class="account_error modal_error">
<?php
if (isset($donation_errors)) {
    foreach ($donation_errors as $error) {
        echo $error . "<br />";
    } 
}
?>
</div>
<form method='POST' id="modify_donation_form" name="modify_donation_form">
<div class="donationfield">
	<label for="money">New Amount:</label> <input type="text" name="new_amount" value="<?php echo $amount ?>" id="money" maxlength="9" class="paymenttextfield" /> <span>dollar(s)</span>
</div>
<div class="donationfield">
	<label for="days">Converts to:</label> <input type="text" id="days" maxlength="9" class="paymenttextfield" /> <span class="days-text">day(s)</span>
</div>
<span class="nextcharge">Next charge will be on <?php echo date("F j, Y", $nextBillingDate) ?>.</span>
<br />
<input type="hidden" name="rp_id" value="<?php if (isset($_REQUEST['rp_id'])) echo $_REQUEST['rp_id'] ?>" />
<input type="hidden" name="current_amount" value="<?php if (isset($_REQUEST['current_amount'])) echo $_REQUEST['current_amount'] ?>" />
<input type="hidden" name="save_modify_amount" value="Save" /><br />
<input type="button" onclick="sendData('<?php echo $_SERVER['REQUEST_URI']; ?>', 'modify_donation_form', 325, 509);" value="Save" class="formsubmit" />
<input type="button" onclick="closeMe(false);" name="close" value="Close" class="formsubmit" /><br />
</form>
</div>