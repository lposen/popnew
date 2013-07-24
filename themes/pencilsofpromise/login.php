<?php
ob_start();

/**
 * @package WordPress
 * @subpackage Default_Theme
 Template Name: Login For Recurring Payments
*/

get_header();

?>
<div>
	<div id="logincontainerbox">
		<div class="logincontainer">
			<h1 id="login">Login</h1>
		    <?php
		    do_action('pp_login_form');
		    ?> 
		</div>
		<div id="login-or">or</div>
		<div class="logincontainer">
			<h1 id="register">Register</h1>
		    <?php
		    do_action('pp_register_form');
		    ?> 
		</div>
	</div>
</div>
<?php

get_footer();

ob_end_flush();
?>