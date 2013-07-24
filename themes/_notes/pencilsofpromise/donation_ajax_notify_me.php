<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 Template Name: Donation Notify Me
*/

if (isset($responseMessage)) {
    echo $responseMessage;
}

?>
<p class="notice"><strong>Don't have a PayPal account?</strong> We will have recurring credit card payments up in a week. Enter your email here and we will let you know when it's up and running! Thanks in advance for making your promise!</p>
<form id="formNotifyMe">
	<input type="text" name="notify_email" class="notifyText" value="" />
	<input type="button" onclick="sendNotifyMe();" id="notify_button" value="Notify me"/>
</form>
