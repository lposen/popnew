<?php
ob_start();
?>
<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 Template Name: Platform Confirm Express Donation
*/
?>
<?php 
	get_header();
	
	if (have_posts()) : while (have_posts()) : the_post();
	?>
<div id="donate-header" style="background: url('http://staging.pencilsofpromise.org/wp-content/themes/pencilsofpromise/gfx/banner_donate_now.jpg');"></div>        

    <div id="confirm-container" >
        <h3 class="BebasNeue">Just to confirm...</h3>
        <strong>You have generously agreed to donate  dollars.</strong>
        <p>If this is correct, please click the "Confirm Donation" below. If
        there was an error, please go back one step and resubmit the correct
        amount. Thank you.</p>
        <form id="confirm_payment_form"
            action='/join-the-movement/donate/confirm-your-donation'
            METHOD='POST'>
            <p>
                <input name='confirm_button' type="submit" value="Confirm Donation"/>
                <input name="back_button" type="submit" value="Go Back" />
            </p>
            <input type='hidden' name='fname' value="" /> 
            <input type='hidden' name='lname' value="" /> 
            <input type='hidden' name='eaddr' value="" />
        </form>
    </div>
<?php endwhile; endif; get_footer(); ?>
<?php
ob_end_flush();
?>