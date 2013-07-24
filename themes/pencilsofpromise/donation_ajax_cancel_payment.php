<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 Template Name: Cancel Recurring Payment
*/

?>

<div>
<p class="cancel-donation">Are you sure you want to cancel your recurring donation?</p>
<form method='POST' id="cancel_donation_form" name="cancel_donation_form"
	action='<?php echo $my_paypalpro->dashboard_page_url ?>'>
<input type="hidden" name="rp_id" value="<?php echo $_REQUEST['rp_id'] ?>" />
<div style="text-align: center;">
<input type="submit" name="cancel_donation_button" value="Yes" class="formsubmit" />
<input type="button" onclick="closeMe(false);" name="close" value="No" class="formsubmit" />
</div>
</form>
</div>