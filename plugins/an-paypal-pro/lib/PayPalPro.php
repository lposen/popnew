<?php
/**
 * Class PayPalPro
 * Provides main functionality for the two payment types of PayPal Website Payments Pro 
 * or Payflow Pro which are Express Checkout and Direct Payment. 
 * If Email is activated - after each successful Payment an email will be sent to the 
 * donator and a copy to the site owner (if is set)
 *
 *
 * @author Sebastian Born
 */
require_once (dirname(__FILE__) . '/an_generic_functions.php');
require_once (dirname(__FILE__) . '/an_website_payment_pro.php');
require_once (dirname(__FILE__) . '/an_payflow_pro.php');
class PayPalPro
{
    var $adminOptionsName = "ANPayPalProAdminOptions";
    var $tableNamePPTransactionLog = "an_pp_transaction_log";
    var $tableNamePPErrorLog = "an_pp_error_log";
    var $tableNameFlowErrorLog = "an_flow_error_log";
    var $tableNameRecurringPaymentsProfiles = "an_pp_recurring_payments_profiles";
    var $an_pppro_db_version = "1.21";
    var $payment_type;
    var $api_username;
    var $api_password;
    var $api_signature;
    var $api_endpoint;
    var $flow_username;
    var $flow_password;
    var $flow_vendor;
    var $flow_partner;
    var $flow_endpoint;
    var $paypal_url;
    var $direct_payment_url;
    var $express_confirmation_url;
    var $express_cancel_url;
    var $success_page_url;
    var $error_page_url;
    var $login_url;
    var $donation_dashboard_url;
    var $cancel_recurring_donation_url;
    var $edit_account_url;
    var $forgot_your_password_url;
    var $modify_payment_method_url;
    var $modify_recurring_donation_url;
    var $pay_form_title;
    var $send_email;
    var $email_subject;
    var $email_body;
    var $email_from;
    var $notification_email_addr;
    var $error_email_addr;
    var $activate_recurring_payments;
    var $cancel_recurring_payments_url;
    function __construct ()
    {
        $this->InitAdminOptions();
    }
    function Init ()
    {
        //$this->GetAdminOptions();
        $this->InstallTransactionLogTable();
        $this->InstallPPErrorLogTable();
        $this->InstallRecurringPaymentsProfilesTable();
    }
    // prepare the database to store the transaction logs
    function InstallTransactionLogTable ()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . $this->tableNamePPTransactionLog;
        if ($wpdb->get_var("show tables like '$table_name'") != $table_name) {
            $sql = "CREATE TABLE " . $table_name . " (
                    log_id INT( 11 ) NOT NULL AUTO_INCREMENT  PRIMARY KEY  ,
                    program_id INT( 6 ) NULL COMMENT 'FK donation program id',
                    timestamp VARCHAR( 40 ) NOT NULL ,
                    correlationid VARCHAR( 40 ) NOT NULL ,
                    ack VARCHAR( 20 ) NOT NULL ,
                    version VARCHAR( 20 ) NOT NULL ,
                    transactionid VARCHAR( 40 ) NOT NULL ,
                    transactiontype VARCHAR( 40 ) NOT NULL ,
                    amount VARCHAR( 20 ) NOT NULL ,
                    currencycode VARCHAR( 10 ) NOT NULL ,
                    paymentstatus VARCHAR( 40 ) NULL COMMENT 'only with expresscheckout ',
                    pendingreason VARCHAR( 255 ) NULL COMMENT 'only with expresscheckout ',
                    reasoncode VARCHAR( 40 ) NULL COMMENT 'only with expresscheckout ',
                    INDEX ( program_id )
                    ) ENGINE = MYISAM ;
                ";
            require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
            add_option("an_pppro_db_version", $this->an_pppro_db_version);
        }
    }
    // prepare the database to store the error logs
    function InstallPPErrorLogTable ()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . $this->tableNamePPErrorLog;
        if ($wpdb->get_var("show tables like '$table_name'") != $table_name) {
            $sql = "CREATE TABLE " . $table_name . " (
                    error_id INT( 11 ) NOT NULL AUTO_INCREMENT  PRIMARY KEY  ,
                    timestamp VARCHAR( 40 ) NOT NULL ,
                    correlationid VARCHAR( 40 ) NOT NULL ,
                    ack VARCHAR( 20 ) NOT NULL ,
                    version VARCHAR( 20 ) NOT NULL ,
                    l_errorcode VARCHAR( 20 ) NOT NULL ,
                    l_shortmessage VARCHAR( 255 ) NOT NULL ,
                    l_longmessage TEXT NOT NULL ,
                    l_severitycode VARCHAR( 20 ) NOT NULL ,
                    error_location VARCHAR( 40 ) NOT NULL
                    ) ENGINE = MYISAM ;
                ";
            require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
        }
    }
    
    // prepare the database to store the recurring payments
    function InstallRecurringPaymentsProfilesTable ()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . $this->tableNameRecurringPaymentsProfiles;
        if ($wpdb->get_var("show tables like '$table_name'") != $table_name) {
             
            $sql =   "CREATE TABLE IF NOT EXISTS " . $table_name . " (
                      rp_id int(11) NOT NULL AUTO_INCREMENT,
                      user_id bigint(20) unsigned NOT NULL,
                      profile_id varchar(40) NOT NULL,
                      profile_start_date datetime NOT NULL,
                      billingperiod varchar(10) NOT NULL,
                      amount varchar(20) NOT NULL,
                      cardtype varchar(20) NOT NULL,
                      last_four_digits int(4) NOT NULL,
                      last_change_date datetime NOT NULL,
                      email varchar(200) DEFAULT NULL,
                      first_name varchar(50) DEFAULT NULL,
                      last_name varchar(50) DEFAULT NULL,
                      PRIMARY KEY (rp_id)
                    ) ENGINE=MyISAM AUTO_INCREMENT=1 ;";
            require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
            add_option("an_pppro_db_version", $this->an_pppro_db_version);
        }
    }
    
    // prepare the database to store the error logs
    function InstallFlowErrorLogTable ()
    {}
    //Returns an array of admin options
    function GetAdminOptions ()
    {
        $paypalproAdminOptions = array('api_username' => '', 
        'api_password' => '', 'api_signature' => '', 'api_partner' => '', 
        'api_vendor' => '', 'api_endpoint' => '', 'paypal_url' => '');
        $devOptions = get_option($this->adminOptionsName);
        if (! empty($devOptions)) {
            foreach ($devOptions as $key => $option) {
                $paypalproAdminOptions[$key] = $option;
            }
        }
        update_option($this->adminOptionsName, $paypalproAdminOptions);
        return $paypalproAdminOptions;
    }
    //Returns an array of admin options
    function InitAdminOptions ()
    {
        $devOptions = get_option($this->adminOptionsName);
        if (! empty($devOptions)) {
            foreach ($devOptions as $key => $option) {
                $this->$key = $option;
            }
        }
        $this->payment_type = 2; // 1 would be Paypal Flow, 2 is Website Payment Pro
    }
    // Prints out the admin page
    function PrintAdminPage ()
    {
        $devOptions = $this->GetAdminOptions();
        if (isset($_POST['update_PaypalProSettings'])) {
            if (isset($_POST['api_username'])) {
                $devOptions['api_username'] = $_POST['api_username'];
            }
            if (isset($_POST['api_password'])) {
                $devOptions['api_password'] = $_POST['api_password'];
            }
            if (isset($_POST['api_signature'])) {
                $devOptions['api_signature'] = $_POST['api_signature'];
            }
            if (isset($_POST['api_endpoint'])) {
                $devOptions['api_endpoint'] = $_POST['api_endpoint'];
            }
            if (isset($_POST['flow_username'])) {
                $devOptions['flow_username'] = $_POST['flow_username'];
            }
            if (isset($_POST['flow_password'])) {
                $devOptions['flow_password'] = $_POST['flow_password'];
            }
            if (isset($_POST['flow_vendor'])) {
                $devOptions['flow_vendor'] = $_POST['flow_vendor'];
            }
            if (isset($_POST['flow_partner'])) {
                $devOptions['flow_partner'] = $_POST['flow_partner'];
            }
            if (isset($_POST['flow_endpoint'])) {
                $devOptions['flow_endpoint'] = $_POST['flow_endpoint'];
            }
            if (isset($_POST['paypal_url'])) {
                $devOptions['paypal_url'] = $_POST['paypal_url'];
            }
            if (isset($_POST['direct_payment_url'])) {
                $devOptions['direct_payment_url'] = $_POST['direct_payment_url'];
            }
            if (isset($_POST['express_confirmation_url'])) {
                $devOptions['express_confirmation_url'] = $_POST['express_confirmation_url'];
            }
            if (isset($_POST['express_cancel_url'])) {
                $devOptions['express_cancel_url'] = $_POST['express_cancel_url'];
            }
            if (isset($_POST['login_page_url'])) {
                $devOptions['login_page_url'] = $_POST['login_page_url'];
            }
            if (isset($_POST['dashboard_page_url'])) {
                $devOptions['dashboard_page_url'] = $_POST['dashboard_page_url'];
            }
            if (isset($_POST['success_page_url'])) {
                $devOptions['success_page_url'] = $_POST['success_page_url'];
            }
            if (isset($_POST['error_page_url'])) {
                $devOptions['error_page_url'] = $_POST['error_page_url'];
            }
            if (isset($_POST['donation_dashboard_url'])) {
                $devOptions['donation_dashboard_url'] = $_POST['donation_dashboard_url'];
            }
            if (isset($_POST['cancel_recurring_donation_url'])) {
                $devOptions['cancel_recurring_donation_url'] = $_POST['cancel_recurring_donation_url'];
            }
            if (isset($_POST['edit_account_url'])) {
                $devOptions['edit_account_url'] = $_POST['edit_account_url'];
            }
            if (isset($_POST['forgot_your_password_url'])) {
                $devOptions['forgot_your_password_url'] = $_POST['forgot_your_password_url'];
            }
            if (isset($_POST['login_url'])) {
                $devOptions['login_url'] = $_POST['login_url'];
            }
            if (isset($_POST['modify_payment_method_url'])) {
                $devOptions['modify_payment_method_url'] = $_POST['modify_payment_method_url'];
            }
            if (isset($_POST['modify_recurring_donation_url'])) {
                $devOptions['modify_recurring_donation_url'] = $_POST['modify_recurring_donation_url'];
            }
            if (isset($_POST['pay_form_title'])) {
                $devOptions['pay_form_title'] = $_POST['pay_form_title'];
            }
            if (isset($_POST['send_email'])) {
                if (isset($_POST['send_email'])) {
                    $devOptions['send_email'] = $_POST['send_email'];
                }
            } else {
                $devOptions['send_email'] = 0;
            }
            if (isset($_POST['email_subject'])) {
                $devOptions['email_subject'] = $_POST['email_subject'];
            }
            if (isset($_POST['email_body'])) {
                $devOptions['email_body'] = $_POST['email_body'];
            }
            if (isset($_POST['email_from'])) {
                $devOptions['email_from'] = $_POST['email_from'];
            }
            if (isset($_POST['notification_email_addr'])) {
                $devOptions['notification_email_addr'] = $_POST['notification_email_addr'];
            }
            if (isset($_POST['error_email_addr'])) {
                $devOptions['error_email_addr'] = $_POST['error_email_addr'];
            }
            if (isset($_POST['activate_recurring_payments'])) {
                $devOptions['activate_recurring_payments'] = $_POST['activate_recurring_payments'];
            } else {
                $devOptions['activate_recurring_payments'] = 0;
            }
            if (isset($_POST['cancel_recurring_payments_url'])) {
                $devOptions['cancel_recurring_payments_url'] = $_POST['cancel_recurring_payments_url'];
            }
            update_option($this->adminOptionsName, $devOptions);
            ?>
<div class="updated">
<p><strong><?php
            _e("Settings Updated.", "PayPalPro");
            ?></strong></p>
</div>
<?php
        }
        $send_email_checked = "";
        if ($devOptions['send_email'] == 1) {
            $send_email_checked = " checked";
        }
        $activate_recurring_payments_checked = "";
        if ($devOptions['activate_recurring_payments'] == 1) {
            $activate_recurring_payments_checked = " checked";
        }
        $payflow_radio = "";
        $website_payment_pro_radio = "";
        if ($devOptions['payment_type'] == 1) {
            $payflow_radio = " checked";
        } else {
            $website_payment_pro_radio = " checked";
        }
        ?>
<style>
#div_an_pppro_admin li {
	padding-bottom: 20px;
	width: 500px;
}

#div_an_pppro_admin ul {
	list-style: none;
}

#keyword_list li {
	padding-bottom: 0px;
}
</style>

<div id="div_an_pppro_admin">
<form method="post"
	action="<?php
        echo $_SERVER["REQUEST_URI"];
        ?>">
<h2>Agencynet PayPal Pro</h2>
<h3>Receive donations via Website Payment Pro or Payflow Pro</h3>
<ul>
	<li>Website Payment Pro API Information</li>
	<li><b>API Username</b><br />
	Supplied with your PayPal Business Account.<br />
	<input type='text' name='api_username'
		value='<?php
        _e($devOptions['api_username'], 'PayPalPro')?>'
		size='50'></li>
	<li><b>API Password</b><br />
	Supplied with your PayPal Business Account.<br />
	<input type='text' name='api_password'
		value='<?php
        _e($devOptions['api_password'], 'PayPalPro')?>'
		size='20'></li>
	<li><b>API Signature</b><br />
	Supplied with your PayPal Business Account. Fill this out if you have
	choosen <i>Website Payment Pro</i>.<br />
	<input type='text' name='api_signature'
		value='<?php
        _e($devOptions['api_signature'], 'PayPalPro')?>'
		size='70'></li>
	<li><b>PayPal API Endpoint</b><br />
	Supplied with your PayPal Business Account.<br />
	<input type='text' name='api_endpoint'
		value='<?php
        _e($devOptions['api_endpoint'], 'PayPalPro')?>'
		size='50'></li>
	<li><b>PayPal URL for Express Checkout</b><br />
	<input type='text' name='paypal_url'
		value='<?php
        _e($devOptions['paypal_url'], 'PayPalPro')?>'
		size='90'></li>
	<li>
	<hr />
	</li>
	<li>Payflow Pro API Information</li>
	<li><b>Merchant ID:</b><br />
	Supplied with your PayPal Business Account.<br />
	<input type='text' name='flow_username'
		value='<?php
        _e($devOptions['flow_username'], 'PayPalPro')?>'
		size='50'></li>
	<li><b>Password</b><br />
	Supplied with your PayPal Business Account.<br />
	<input type='text' name='flow_password'
		value='<?php
        _e($devOptions['flow_password'], 'PayPalPro')?>'
		size='20'></li>
	<li><b>Vendor</b><br />
	Supplied with your PayPal Business Account. Fill this out if you have choosen <i>Payflow Pro</i>.<br />
	<input type='text' name='flow_vendor'
		value='<?php
        _e($devOptions['flow_vendor'], 'PayPalPro')?>'
		size='70'></li>
	<li><b>Partner</b><br />
	Supplied with your PayPal Business Account. Fill this out if you have choosen <i>Payflow Pro</i>.<br />
	<input type='text' name='flow_partner'
		value='<?php
        _e($devOptions['flow_partner'], 'PayPalPro')?>'
		size='70'></li>
	<li><b>Payflow Server</b><br />
	Production (Live): https://payflowpro.paypal.com<br />
	Pilot (Test): https://pilot-payflowpro.paypal.com<br />
	<input type='text' name='flow_endpoint'
		value='<?php
        _e($devOptions['flow_endpoint'], 'PayPalPro')?>'
		size='50'></li>
	<li>
	<hr />
	</li>
	<li>Url's</li>
	<li><b>Direct Payment Form URL</b><br />
	The Link to the donation form, if the user decides to pay with credit
	card.<br />
	<input type='text' name='direct_payment_url'
		value='<?php
        _e($devOptions['direct_payment_url'], 'PayPalPro')?>'
		size='70'></li>
	<li><b>Express Checkout Confirmation URL</b><br />
	If the user decides to take the PayPal Express Checkout, we need a
	confirmation URL, on our side, where he confirms the donation.<br />
	<input type='text' name='express_confirmation_url'
		value='<?php
        _e($devOptions['express_confirmation_url'], 'PayPalPro')?>'
		size='70'></li>
	<li><b>Express Checkout Cancel URL</b><br />
	If the user decides to cancel while he is on the PayPal site, we need a
	return URL.<br />
	<input type='text' name='express_cancel_url'
		value='<?php
        _e($devOptions['express_cancel_url'], 'PayPalPro')?>'
		size='70'></li>
	<li><b>Success Page URL</b><br />
	The URL of the page to send the customer to after payment.<br />
	<input type='text' name='success_page_url'
		value='<?php
        _e($devOptions['success_page_url'], 'PayPalPro')?>'
		size='70'></li>
	<li><b>Error Page URL</b><br />
	The URL of the page to send the customer if an severe PayPal API error
	occurs.<br />
	<input type='text' name='error_page_url'
		value='<?php
        _e($devOptions['error_page_url'], 'PayPalPro')?>'
		size='70'></li>
	<li><b>Donation Dashboard URL</b><br />
	The donator can see here his recurring donations.<br />
	<input type='text' name='donation_dashboard_url'
		value='<?php
        _e($devOptions['donation_dashboard_url'], 'PayPalPro')?>'
		size='70'></li>
	<li><b>Cancel Recurring Donation URL</b><br />
	The donator can cancel a recurring donation.<br />
	<input type='text' name='cancel_recurring_donation_url'
		value='<?php
        _e($devOptions['cancel_recurring_donation_url'], 'PayPalPro')?>'
		size='70'></li>
	<li><b>Edit Account URL</b><br />
	The donator can change his credentials.<br />
	<input type='text' name='edit_account_url'
		value='<?php
        _e($devOptions['edit_account_url'], 'PayPalPro')?>'
		size='70'></li>
	<li><b>Forgot Your Password URL</b><br />
	Send a new password.<br />
	<input type='text' name='forgot_your_password_url'
		value='<?php
        _e($devOptions['forgot_your_password_url'], 'PayPalPro')?>'
		size='70'></li>
	<li><b>Login URL</b><br />
	Login or Register URL<br />
	<input type='text' name='login_url'
		value='<?php
        _e($devOptions['login_url'], 'PayPalPro')?>'
		size='70'></li>
	<li><b>Modify Payment Method URL</b><br />
	Modify Address, Payment Data URL<br />
	<input type='text' name='modify_payment_method_url'
		value='<?php
        _e($devOptions['modify_payment_method_url'], 'PayPalPro')?>'
		size='70'></li>
	<li><b>Modify Recurring Donation URL</b><br />
	<input type='text' name='modify_recurring_donation_url'
		value='<?php
        _e($devOptions['modify_recurring_donation_url'], 'PayPalPro')?>'
		size='70'></li>
	<li>
	<hr />
	</li>
	<li>Email Configuration</li>
	<li><b>Email Address in case of severe PayPal API error</b><br />
	In case a severe API error occurs during Express Checkout an email will
	be sent to this address.<br />
	Leave blank, if you don't want to get an email. The error will still be
	logged in the database.<br />
	<input type='text' name='error_email_addr'
		value='<?php
        _e($devOptions['error_email_addr'], 'PayPalPro')?>'
		size='70'></li>
	<li><b>Send Payment Notification Email?</b> <input
		style="margin-left: 10px;" type='checkbox' name='send_email' value='1'
		<?php
        echo $send_email_checked?>></li>
	<li><b>Payment Notification Email Subject</b><br />
	The subject of the email notification that is sent to the customer
	after donation.<br />
	<input type='text' name='email_subject'
		value='<?php
        _e($devOptions['email_subject'], 'PayPalPro')?>'
		size='70'></li>
	<li><b>Payment Notification Email Body</b><br />
	The body of the email notification that is sent to the customer after
	donation.<br />
	Available code words:<br />
	<ul id="keyword_list">
		<li>|fname| for first name</li>
		<li>|lname| for last name</li>
		<li>|amount| for payment amount</li>
		<li>|date| for payment date</li>
		<li>|getupdates| for what they'd like to be updated on
	</ul>
	Please use the code words with the surrounding vertical lines.<br />
	<textarea name="email_body" cols="60" rows="5"><?php
        _e($devOptions['email_body'], 'PayPalPro')?></textarea></li>
	<li><b>Payment Notification FROM Address</b><br />
	The return address of the email notification that is sent to the
	customer after donation.<br />
	<input type='text' name='email_from'
		value='<?php
        _e($devOptions['email_from'], 'PayPalPro')?>'
		size='70'></li>
	<li><b>Payment Notification Copy-To Email Address</b><br />
	To send a copy of the email notification to the site owner after
	donation.<br />
	Leave blank, if you don't want a copy after each donation.<br />
	<input type='text' name='notification_email_addr'
		value='<?php
        _e($devOptions['notification_email_addr'], 'PayPalPro')?>'
		size='70'></li>	
	</ul>
<div class="submit"><input type="submit"
	name="update_PaypalProSettings"
	value="<?php
    _e('Update Settings', 'PayPalPro')?>" /></div>
</form>
</div>
<?php
    } //End function PrintAdminPage()
    function FormDirectPayment ()
    {
        global $pp_errors, $state_select, $province_select, $country_select;
        global $credit_cards, $paypalproAdminOptions, $fname, $lname;
        global $address1, $city, $state, $province, $zip, $country, $eaddr; 
        global $cc_type, $cc_num, $cc_exp_month, $cc_exp_year, $cc_cvc;
        global $pp_amount, $pay_success;
        if (isset($_SESSION['Payment_Amount'])) {
            $_SESSION['Payment_Amount_bak'] = $_SESSION['Payment_Amount'];
            $pp_amount = $_SESSION['Payment_Amount'];
            //unset($_SESSION['Payment_Amount']);
        }
        if (isset($_REQUEST['program_id'])) {
            $_SESSION['program_id'] = $_REQUEST['program_id'];
        }
        $input_error_class = " class='inputerror'";
        
        $do_as_recurring_payments = "";
        if (isset($_SESSION['do_as_recurring_payments'])) {
            $do_as_recurring_payments = $_SESSION['do_as_recurring_payments'];
        }
        
        $do_as_recurring_payments_monthly_checked = "";
        $do_as_recurring_payments_annually_checked = "";
        if ($do_as_recurring_payments == 'Month') {
            $do_as_recurring_payments_monthly_checked = "checked";
        }
        if ($do_as_recurring_payments == 'Year') {
            $do_as_recurring_payments_annually_checked = "checked";
        }
        ?>



<h2 id="p_almost-there">Almost finished...</h2>
<hr class="dotted_grey">
<div class="clearfix"></div>

<?php
        if (! $pay_success) {
            if (count($pp_errors) > 0) {
                echo "<div id='general-error' style='margin-left:385px;'><div id='general-error-cont'>Please correct the following:";
                if (isset($pp_errors['pp_error']))
                    echo $pp_errors['pp_error'];
                echo "</div></div><div class='clearfix'></div>";
            }
        }
            ?>
<?php 
if ($do_as_recurring_payments != "") {
?>
<div id="recurring">
<?php
    if ($do_as_recurring_payments == 'Month') {
?>
Your donation will recur <span>monthly</span>.
<?php
    }
    if ($do_as_recurring_payments == 'Year') {
?>
Your donation will recur <span>yearly</span>.
<?php
    }
?>
</div>
<div class="clearfix"></div>
<?php 
}
?>




<div class="p_step">
<div class="step-number"><img src="<?php bloginfo('template_directory'); ?>/gfx/platform_form_number_four.png"></div>
<div class="explanation">Review the donation and the impact it will make</div>
<div class="form-container">
<div class="step-padding<?php if (isset($pp_errors['amount'])) echo " error"?>">
<div id="change-amount"></div>
<div style="display:block; float:left; margin-top:12px">$ </div><input type='text' id="input-amt2" maxlength="8" name='amount'
    value='<?php
        echo $pp_amount;
        ?>' /> <span class="amount-copy-provides">enables</span> <span id="span-days2" style="width:30px; font-size:20px;"></span> <span
    class="amount-copy-days">Days</span>
<div class="clearfix"></div>
                <?php
    if (isset($pp_errors['amount'])) {
        ?>
                <div class="errortext"><?php
        echo $pp_errors['amount']?></div>
                <?php
    }
    ?>
</div>
</div></div>
<hr class="dotted_grey"/>
<form method='POST' id="ppp_form" name="ppp_form"
	action='<?php
        echo $_SERVER['REQUEST_URI'];
        ?>'>
<div class="p_step">
<div class="step-number"><img src="<?php bloginfo('template_directory'); ?>/gfx/platform_form_number_five.png"></div>
<div class="explanation">Fill in the form to submit your donation with
card of choice.</div>
<div class="form-container">
<div
	class="step-padding<?php if (isset($pp_errors['fname'])) echo " error"?>">
<span>First Name: </span><input type='text' id='fname' name='fname' class="input-donate"
	value='<?php
        echo htmlSafe($fname);
        ?>' />
                    <?php
        if (isset($pp_errors['fname'])) {
            ?>
                    <div class="errortext"><?php
            echo $pp_errors['fname']?></div>
<span class="input-error"></span>
                    <?php
        }
        ?>
			</div>
<div class="form-divider"></div>
<div
	class="step-padding<?php if (isset($pp_errors['lname'])) echo " error"?>">
<span>Last Name: </span><input type='text' id='lname' name='lname' class="input-donate"
	value='<?php
        echo htmlSafe($lname);
        ?>' />
                    <?php
        if (isset($pp_errors['lname'])) {
            ?>
                    <div class="errortext"><?php
            echo $pp_errors['lname']?></div>
<span class="input-error"></span>
                    <?php
        }
        ?>
			</div>
<div class="form-divider"></div>

<div
	class="step-padding<?php if (isset($pp_errors['address1'])) echo " error"?>">
<span>Billing Address: </span><input type='text' id='address1' name='address1' class="input-donate"
	value='<?php
        echo htmlSafe($address1);
        ?>' />
                    <?php
        if (isset($pp_errors['address1'])) {
            ?>
                    <div class="errortext"><?php
            echo $pp_errors['address1']?></div>
<span class="input-error"></span>
                    <?php
        }
        ?></div>
<div class="form-divider"></div>

<div
	class="step-padding<?php if (isset($pp_errors['city'])) echo " error"?>">
<span>City: </span><input type='text' id='city' name='city' class="input-donate"
	value='<?php
        echo htmlSafe($city);
        ?>' />
                    <?php
        if (isset($pp_errors['city'])) {
            ?>
                    <div class="errortext"><?php
            echo $pp_errors['city']?></div>
<span class="input-error"></span>
                    <?php
        }
        ?>
</div>
<div class="form-divider"></div>

<div id="provincerow"
	class="step-padding<?php if (isset($pp_errors['province'])) echo " error"?>"><label
	for="province">Province:</label>
<div class="form-selects">                    
<?php
        echo formSelect('province', $province, $province_select, 
            '-- Select --');
        if (isset($pp_errors['province'])) {
            ?>
                    <div class="errortext"><?php
            echo $pp_errors['province']?></div>
<span class="input-error"></span>
                    <?php
        }
        ?>
</div>
<div class="clearfix"></div>
</div>

<div id="staterow"
    class="step-padding<?php if (isset($pp_errors['state'])) echo " error"?>"><label
    for="state">State:</label>
<div class="form-selects">                                   
<?php echo formSelect('state', $state, $state_select, '-- Select --'); ?>
</div>
<?php if (isset($pp_errors['state'])) {
            ?>
                    <div class="errortext"><?php
            echo $pp_errors['state']?></div>
<span class="input-error"></span>
                    <?php
        } ?>
<div class="clearfix"></div>
</div>

<div class="form-divider"></div>

<div
	class="step-padding<?php if (isset($pp_errors['zip'])) echo " error"?>">
<span>Zip Code: </span><input type='text' id='zip' name='zip' class="input-donate"
	value='<?php
        echo htmlSafe($zip);
        ?>' />
                    <?php
        if (isset($pp_errors['zip'])) {
            ?>
                    <div class="errortext"><?php
            echo $pp_errors['zip']?></div>
<span class="input-error"></span>
                    <?php
        }
        ?></div>
<div class="form-divider"></div>

<div
	class="step-padding<?php if (isset($pp_errors['country'])) echo " error"?>"><label
	for="country">Country:</label>
<div class="form-selects">                    
<?php echo formSelect('country', $country, $country_select);?>
</div>
<?php if (isset($pp_errors['country'])) {
            ?>
                    <div class="errortext"><?php
            echo $pp_errors['country']?></div>
<span class="input-error"></span>
                    <?php
        } ?>
<div class="clearfix"></div>
</div>
<div class="form-divider"></div>

<div
	class="step-padding<?php if (isset($pp_errors['eaddr'])) echo " error"?>">
<span>Email: </span><input type='text' id='eaddr' name='eaddr' class="input-donate"
	value='<?php
        echo htmlSafe($eaddr);
        ?>' />
                    <?php
        if (isset($pp_errors['eaddr'])) {
            ?>
                    <div class="errortext"><?php
            echo $pp_errors['eaddr']?></div>
<span class="input-error"></span>
                    <?php
        }
        ?></div>
<div class="form-divider"></div>

<div class="step-padding"><label for="cc_type">Credit card type:</label>
<div class="form-selects">                    <?php
        echo formSelect('cc_type', $cc_type, $credit_cards);
        ?>
</div>
<div class="clearfix"></div>
</div>
<div class="form-divider"></div>
<div
	class="step-padding<?php if (isset($pp_errors['cc_num'])) echo " error"?>">
<span>Card Number: </span><input type='text' id='cc_num' name='cc_num' class="input-donate"
	value='<?php
        echo htmlSafe($cc_num);
        ?>' />
                    <?php
        if (isset($pp_errors['cc_num'])) {
            ?>
                    <div class="errortext"><?php
            echo $pp_errors['cc_num']?></div>
<span class="input-error"></span>
                    <?php
        }
        ?></div>
<div class="form-divider"></div>
<div class="step-padding"><label for="expiration-month">Expiration:</label>
<div class="form-selects">
<?php
        echo expMonthDropdown('cc_exp_month', $cc_exp_month);
        ?>
<?php

        echo expYearDropdown('cc_exp_year', $cc_exp_year);
        ?>
</div>
<div class="clearfix"></div>
</div>
<div class="form-divider"></div>
<div
	class="step-padding<?php if (isset($pp_errors['cc_cvc'])) echo " error"?>">
<div id="cvv-help"><strong>Where's my CVV?</strong> <img
	src="<?php
        bloginfo('template_directory');
        ?>/gfx/donateMoney2CVV.png"
	alt="Where's my CVV?" /> <!-- <span>Amex: Front</span> --> <span>Visa/MC/Discover:
Back</span></div>
<span>CVV: </span><input type='text' id='cc_cvc' name='cc_cvc' class="input-donate"
	value='<?php
        echo htmlSafe($cc_cvc);
        ?>' style="margin-bottom: 20px;"/>
                    <?php
        if (isset($pp_errors['cc_cvc'])) {
            ?>
                    <div class="errortext"><?php
            echo $pp_errors['cc_cvc']?></div>
<span class="input-error"></span>
                    <?php
        }
        ?></div>
<div class="form-divider"></div>
</div>
<div class="clearfix"></div>
<p id="required">All fields required</p>
</div>
<hr class="dotted_grey"/>
<div class="p_step">
<div class="step-number"><img src="<?php bloginfo('template_directory'); ?>/gfx/platform_form_number_six.png"></div>
<div class="explanation">Submit your donation to be processed</div>
<div>
<div><input type="hidden" id="payment_amount" name="amount"
	value="<?php echo currency($pp_amount); ?>" /><input type="hidden" id="fundraiser" name="fundraiser"
	value="<?php echo $_SESSION['Fundraiser']; ?>" /><input type="hidden" id="anonymous" name="anonymous"
	value="<?php echo $_SESSION['Anonymous']; ?>" /><input type="hidden" name="submitpayment_x" value="1"/><input type="submit"
	name="submitpayment" value="Click to submit donation" 
	class="gold_button p_link" onClick="_gaq.push(['_trackEvent', 'Payment', 'Submit', 'Donation', <?php echo $pp_amount; ?>]);"/></div>
</div>
</div>
</form>

<?php
    }
    // END FUNCTION FormDirectPayment()
    function FormChoosePayment ()
    {
        global $pp_errors, $do_as_recurring_payments;
        
        /*if (isset($_REQUEST['f'])) {
            $_SESSION['Fundraiser'] = $_REQUEST['f'];
        }  */      
        if (isset($_REQUEST['program_id'])) {
            $_SESSION['program_id'] = $_REQUEST['program_id'];
        }
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            unset($_SESSION['do_as_recurring_payments']);
            unset($_SESSION['billing_cycles']);
            unset($_SESSION['paypal']);
            unset($_SESSION['destination_after_login']);
        }

        $do_as_recurring_payments_monthly_checked = "";
        $do_as_recurring_payments_annually_checked = "";
        if ($do_as_recurring_payments == 'Month') {
            $do_as_recurring_payments_monthly_checked = "checked";
        }
        if ($do_as_recurring_payments == 'Year') {
            $do_as_recurring_payments_annually_checked = "checked";
        }
        $input_error_class = " class='inputerror'";
        if (!empty($_GET['d'])) {
                                $d_test = (int) $_GET['d'];
                                if (is_nan($d_test)) {
                                    $d_amount = (int) '100.00';
                                }
                                else if ($d_test<10) {
                                    $d_amount = (int) '10.00';
                                }
                                else {
                                    $d_amount = (int) $d_test.'.00';
                                }
        }
        elseif(isset($_SESSION['Payment_Amount'])) {
        	$d_amount = $_SESSION['Payment_Amount'];
        } elseif(isset($_SESSION['Payment_Amount_bak'])) {
        	$d_amount = $_SESSION['Payment_Amount_bak'];
        } else {
                $d_amount = (int) '100.00';
        }
        
    	if(isset($_GET['recurring'])) {
    		$recurring = $_GET['recurring'];
    		$check_monthly = '';
    		$check_yearly = '';
    		if($recurring == 'monthly') {
    			$check_monthly = 'checked';
    		} elseif($recurring == 'yearly') {
    			$check_yearly = 'checked';
    		}
    	}
               
        ?>

<div id="platform" class="p_link">
    <div id="donation_body">
        <div id="section1">
            <div id="rsb">
                <div id="top" style="position: relative; top: -25px; margin-bottom: 20px;">
                    <img src="<?php bloginfo('template_directory'); ?>/gfx/platform_images/parthenon.png">
                </div>
                <div id="text">
                    <p>Pencils of Promise, Inc. is recognized as tax exempt under Section 501(c)(3) of the Internal Revenue Code. For a copy of our IRS 501(c)(3) ruling, <a href="http://www.pencilsofpromise.org/wp-content/uploads/2010/10/100712-Pencils-of-Promise-501c3-approval.pdf">click here</a>.</p>
                </div>
            </div> 
            <div id="main">
                <div id="top">
                    $25
                </div>
                <div id="text">
                    <p>It only takes $25 to provide one year of sustainable education to one child. With your help, we can provide a lot more help than that.</p>
                </div>
            </div> 
            <div id="lsb">
                <div id="top">
                    100%
                </div>
                <div id="text">
                    <p>We promise that 100% of all funds donated or raised online will go directly towards education programs, 0% towards overhead.</p>
                </div>
            </div>
        </div>
        
<form id="choose_payment_form"
	action='<?php
        echo $_SERVER['REQUEST_URI'];
        ?>'
	METHOD='POST'>
<?php /*       
    if (isset($_REQUEST['f']) || isset($_REQUEST['g'])) { //is this a club or fundraiser donation
        ?>
            <?php
            try { //page error handling
            //platform init
            $mySforceConnection = doSalesforceConnect();
            $loginId;$groupId;$fundId;$contactId;
            $loginId = doPlatformLogin($current_user,$mySforceConnection);
            $groupId = $_GET["g"];
            $fundId = $_GET["f"];
            $contactId=$_GET["u"];
            ?>
            <?php
            if ($fundId) {
                $query = "SELECT Name, Description__c, Photo_URL__c, Video_URL__c, Goal__c, Total_Raised__c, Type__c, Impact__c, isClub__c FROM Fundraiser__c WHERE Id = '".$fundId."' LIMIT 1";
                $response = $mySforceConnection->query($query);
                foreach ($response->records as $record) {
                    $fund->name=$record->fields->Name;
                    $fund->video=$record->fields->Photo_URL__c;
                    $fund->photo=$record->fields->Video_URL__c;
                    $fund->description=$record->fields->Description__c;
                    $fund->goal=$record->fields->Goal__c;
                    $fund->type=$record->fields->Type__c;
                    $fund->impact=$record->fields->Impact__c;
                    $fund->isclub=$record->fields->isClub__c;
                    $fund->raised=$record->fields->Total_Raised__c;
                };
                ?>
                <div id="donation_campaign" class="p_link">
                        This donation is for the campaign: <b><?php echo $fund->name; ?></b>.<br/>
                </div>
                <?php
            }
            else if ($groupId) {
                $group;
                $query = "SELECT Name, Goal__c FROM Group__c WHERE Id = '".$groupId."' AND Published__c = TRUE LIMIT 1";
                $response = $mySforceConnection->query($query);
                foreach ($response->records as $record) {
                    $group->name=$record->fields->Name;
                    $group->goal=$record->fields->Goal__c;    
                };
                ?>
                <div id="donation_campaign" class="p_link">
                        This donation is for the club:  <?php echo $group->name; ?>.<br/>
                </div>
                <?php                
            }
            }
            catch (Exception $e) {
                header ('Location: /error?e='.urlencode($e));
                exit;
            }
              
            
        }*/
?>
<?php
        if (isset($pp_errors['Payment_Amount'])) {
            ?>
<p class="errortext"><?php
            echo $pp_errors['Payment_Amount']?></p>
<?php
        }
        ?>        
        
<div id="donation_amt">
            <div id="lsb"><span id="number">1</span></div>
            <div id="mid">Enter your desired donation amount which will show the impact your donation will make</div>
            <div id="rsb" style="font-weight: bold;">
                ENTER AMOUNT
                <div style="background: #e2e2e2; height:36px; padding: 5px 10px; width: 245px; margin-bottom: 10px;">
                    <span style="display:block; float:left; margin-top:12px">$ </span><input name='Payment_Amount' type="text" value='<?php echo $d_amount; ?>' maxlength="8" id="donation_input" style="width: 200px;"/>
                </div>
                <br/><input type="checkbox" id="anonymous" name="anonymous" value="1"/>&nbsp;<label for="anonymous" style="width:247px;"/>Make my donation anonymous</label>
            </div>
</div>
<?php /*    
<div class="step">
	<div class="step-number black">3.</div>
	<div class="explanation black">Which projects would you like to receive updates from:</div>
		<?php
		$pages_query	= new WP_Query();
		$all_projects	= array();
		$all_pages		= $pages_query->query(array('post_type' => 'page', 'posts_per_page' => -1, 'orderby' => 'title'));
		
		$page_id			= get_page_by_title('Current Projects');
		$projects		= get_page_children($page_id->ID, $all_pages);
		foreach ($projects as $project) {
			$all_projects[] = $project->post_title;
		}
		
		$page_id			= get_page_by_title('Established Projects');
		$projects		= get_page_children($page_id->ID, $all_pages);
		foreach ($projects as $project) {
			$all_projects[] = $project->post_title;
		}
		
		$page_id			= get_page_by_title('Upcoming Projects');
		$projects		= get_page_children($page_id->ID, $all_pages);
		foreach ($projects as $project) {
			$all_projects[] = $project->post_title;
		}
		
		sort($all_projects);
		?>
		<div style="float:right; margin: 15px 0 0 23px; padding: 0 10px 0 0;">
			<select id="get_updates" name="get_updates" style="width: 450px;">
				<?php foreach ($all_projects as $project) { 
					echo '<option value="'.$project.'">'.$project.'</option>';
				} ?>
				<option value="None">None</option>
			</select>
		</div>
</div>
*/?>
<div id="donation_recurring">
    <div id="lsb"><span id="number">2</span></div>
    <div id="mid">Increase your impact by making your donation recurring.</div>

    <div id="rsb">
        <div id="donation_button">
            <input name="do_as_recurring_payments" id="checkbox-00" value="OneTime" class="recur_type" type="radio" <?php if ($do_as_recurring_payments_monthly_checked!="checked" && $check_monthly != "checked" && $do_as_recurring_payments_monthly_checked!="checked" && $check_monthly != "checked") { echo "checked"; } ?> />
            <input name="do_as_recurring_payments" id="checkbox-01" value="Month" class="recur_type" type="radio" <?php echo $do_as_recurring_payments_monthly_checked; echo $check_monthly; ?> />
            <input name="do_as_recurring_payments" id="checkbox-02" value="Year" class="recur_type" type="radio" <?php echo $do_as_recurring_payments_annually_checked; echo $check_yearly;?> />
        </div>
    </div>
</div>
<div id="donation_pay">
    <div id="lsb"><span id="number">3</span></div>
    <div id="mid">Select your payment type to submit your donation.</div>
    <div id="rsb">
    <div class="form-container-nobg">
        <?php
                $payment_amt = ($d_amount != '') ? $d_amount : '100.00';
        ?>
        <div class="payment-type"><input type="hidden" id="fundraiser" name="fundraiser"
                value="<?php echo $_REQUEST['f']; ?>" /><input name="express_checkout"
                type="image"
                src="<?php
                bloginfo('template_directory');
                ?>/gfx/iconPaypal.png" /></div>
        <div id="icon-or">OR</div>
        <div class="payment-type"><input name="direct_payment" type="image"
                src="<?php
                bloginfo('template_directory');
                ?>/gfx/iconCreditCards.png" /></div>
        </div>    
    </div>
</div>
</form>
    </div>
</div>

<?php
    }
    function FormConfirmPayment ()
    {
        global $pp_errors, $email, $firstName, $lastName;
        $_SESSION['Payment_Amount_bak'] = $_SESSION['Payment_Amount'];
        ?>
<div id="confirm-container">
<h2>Just to confirm...</h2>
	<?php if (isset($pp_errors["pp_error"])) {
            echo "<p class='confirm-error'>" . $pp_errors["pp_error"] . "</p>";
        }
    ?>
    <?php
    if ( (isset($_SESSION['do_as_recurring_payments'])) && ($_SESSION['do_as_recurring_payments'] == 'Month') ) {
    ?>
	<strong>You have generously agreed to donate <?php echo $_SESSION['Payment_Amount']; ?> dollars with a monthly recurrence.</strong>
    <?php        
    } 
    else if ( (isset($_SESSION['do_as_recurring_payments'])) && ($_SESSION['do_as_recurring_payments'] == 'Year') ) {
    ?>
	<strong>You have generously agreed to donate <?php echo $_SESSION['Payment_Amount']; ?> dollars with a yearly recurrence.</strong>
    <?php
    } else {
    ?>
	<strong>You have generously agreed to donate <?php echo $_SESSION['Payment_Amount']; ?> dollars.</strong>
    <?php
    }
    ?>
	<p>If this is correct, please click the "Confirm Donation" below. If
there was an error, please go back one step and resubmit the correct
amount. Thank you.</p>
<form id="confirm_payment_form"
	action='<?php
        echo $_SERVER['REQUEST_URI'];
        ?>'
	METHOD='POST'>
<p><input name='confirm_button' type="image"
	src="<?php bloginfo('template_directory'); ?>/gfx/donateMoney2ConfirmSubmit.png" />
<input name="back_button" type="image"
	src="<?php bloginfo('template_directory'); ?>/gfx/donateMoney2ConfirmBack.png"
	value="<?php bloginfo('url'); ?>/join-the-movement/donate" /></p>
<input type='hidden' name='fname'
	value="<?php
        echo $firstName?>" /> <input type='hidden' name='lname'
	value="<?php
        echo $lastName?>" /> <input type='hidden' name='eaddr'
	value="<?php
        echo $email?>" /></form>
</div>
<?php
    }
    ///////////////////////////////////////
    // Processes submitted payment form
    function PP_ProcessPayment ()
    {
        global $pp_errors, $pay_success, $credit_cards;
        global $fname, $lname, $address1, $city, $state, $province, $zip, $country, $eaddr, $cc_type, $cc_num, $cc_exp_month, $cc_exp_year, $cc_cvc, $pp_amount, $description, $custom;
        global $wpdb;
        $pay_success = FALSE;
        $pp_errors = array();
        // Handle payment submit, if any
        if ($_SERVER['REQUEST_METHOD'] == "POST" &&
         isset($_POST['submitpayment_x'])) {
            $do_as_recurring_payments = "";
            if (isset($_SESSION['do_as_recurring_payments'])) {
                $do_as_recurring_payments = $_SESSION['do_as_recurring_payments'];
            }
             
            // Validate data
            $fname = trim(stripslashes($_POST['fname']));
            $lname = trim(stripslashes($_POST['lname']));
            $address1 = trim(stripslashes($_POST['address1']));
            $city = trim(stripslashes($_POST['city']));
            $state = trim(stripslashes($_POST['state']));
            $province = trim(stripslashes($_POST['province']));
            $zip = trim(stripslashes($_POST['zip']));
            $country = trim(stripslashes($_POST['country']));
            $description = trim(stripslashes($_POST['description']));         
            $pp_amount = currency(trim(stripslashes($_POST['amount'])));
            $eaddr = trim(stripslashes($_POST['eaddr']));
            if ($fname == '')
                $pp_errors['fname'] = "First Name is required.";
            if ($lname == '')
                $pp_errors['lname'] = "Last Name is required.";
            if ($address1 == '')
                $pp_errors['address1'] = "Street Address is required.";
            if ($city == '')
                $pp_errors['city'] = "City is required.";
            if ($zip == '')
                $pp_errors['zip'] = "Zip is required.";
            if ($country == 'US' && $state == '')
                $pp_errors['state'] = "State is required.";
            if ($country == 'CA' && $province == '')
                $pp_errors['province'] = "Province is required.";
            if (! validEmail($eaddr)) {
                $pp_errors['eaddr'] = "A valid email address is required.";
            }
            if (! validAmount($pp_amount)) {
                $pp_errors['amount'] = "Please enter a valid donation amount.";
            }
            if ($country == 'CA')
                $state = $province;
            if (($country != 'US') && ($country != 'CA'))
                $state = "";
            $cc_type = $_POST['cc_type'];
            $cc_num = allNumbers($_POST['cc_num']);
            $cc_exp_month = $_POST['cc_exp_month'];
            $cc_exp_year = $_POST['cc_exp_year'];
            $cc_exp = $cc_exp_month . $cc_exp_year;
            $cc_cvc = allNumbers($_POST['cc_cvc']);
            if ( (strlen($cc_num) < 15) || (strlen($cc_num) > 16) ) {
                $pp_errors['cc_num'] = "Invalid credit card number.";
            }
            if ( (strlen($cc_cvc) < 3) || (strlen($cc_cvc) > 4) ) {
                $pp_errors['cc_cvc'] = "Invalid security code.";
            }
            $amount = $pp_amount;
            // Attempt to process, if no errors
            if (count($pp_errors) == 0) {
                // cc_type. one of Visa MasterCard Discover Amex
                if ($cc_type == 4) {
                    $creditCardType = urlencode("Amex");
                } else {
                    $creditCardType = urlencode($credit_cards[$cc_type]);
                }
                $creditCardNumber = urlencode($cc_num);
                $cvv2Number = urlencode($cc_cvc);
                $firstName = urlencode($fname);
                $lastName = urlencode($lname);
                $Beaddr = urlencode($eaddr);
                $Baddress = urlencode($address1);
                $Bcity = urlencode($city);
                $Bstate = urlencode($state);
                $Bzip = urlencode($zip);
                $Bamount = urlencode(number_format($amount, 2, '.', ''));
                $currencyCode = "USD";
                $description = "";
                $custom = "Direct";
                if (isset($_SESSION['Fundraiser'])) {
                    $custom = $_SESSION['Fundraiser'].'|'.$_SESSION['Anonymous'];    
                }
                $recurring_payment_emailtext = "";
                $my_WebsitePaymentPro = new WebsitePaymentPro(
                $this->api_username, $this->api_password, $this->api_signature, 
                $this->paypal_url, $this->api_endpoint);
                if ($do_as_recurring_payments == "") {                    
                    $pp_action_name = "doDirectPayment";
                    $resArray = $my_WebsitePaymentPro->DirectPayment($Bamount, 
                    $creditCardType, $creditCardNumber, $cc_exp, $cvv2Number, 
                    $Beaddr, $firstName, $lastName, $Baddress, $Bcity, $Bstate, $Bzip, 
                    $country, $currencyCode, $description, $custom);
                } else {
                    $pp_action_name = "CreateRecurringPaymentsProfile";
                    $current_user = wp_get_current_user();
                    if (! $current_user->ID > 0) {
                        // user has to login
                        header("location: " . $this->login_url);
                    }
                    $resArray = $my_WebsitePaymentPro->RecurringPaymentWithDirectPayment($Bamount, 
                    $creditCardType, $creditCardNumber, $cc_exp, $cvv2Number, $Beaddr,
                    $firstName, $lastName, $Baddress, $city, $state, $zip, $country, 
                    $currencyCode, $do_as_recurring_payments, $description, $custom);

//                    $my_PayflowPro = new PayflowPro($this->flow_username, 
//                    $this->flow_password, $this->flow_vendor, $this->flow_partner, 
//                    $this->paypal_url, $this->flow_endpoint);
//                    $pp_action_name = "CreateRecurringPaymentsProfile";
//                    $current_user = wp_get_current_user();
//                    if (! $current_user->ID > 0) {
//                        // user has to login
//                        header("location: " . $this->login_url);
//                    }
//                    $resArray = $my_PayflowPro->RecurringPaymentWithDirectPayment(
//                    $Bamount, $creditCardNumber, $cc_exp, $eaddr,
//                    $Baddress, $city, $zip, $do_as_recurring_payments);

//                    // temporary switch, delete all later
//                    $current_user = wp_get_current_user();
//                    $pp_action_name = "Fake_CreateRecurringPaymentsProfile";
//                    if (! $current_user->ID > 0) {
//                        // user has to login
//                        header("location: " . $this->login_url);
//                    }
//                    $resArray = $my_WebsitePaymentPro->DirectPayment($Bamount, 
//                    $creditCardType, $creditCardNumber, $cc_exp, $cvv2Number, 
//                    $firstName, $lastName, $Baddress, $Bcity, $Bstate, $Bzip, 
//                    $country, $currencyCode);
//                    $resArray["PROFILEID"] = $resArray["TRANSACTIONID"];
//                    $resArray['PROFILESTARTDATE'] = date("Y-m-d H:i:s");
//                    $recurring_payment_emailtext = "\r\nTo cancel or modify your recurring payment please contact Pencils of Promise at email@email.com or 1-212-PHONE\r\n";
                }
                $ack = strtoupper($resArray["ACK"]);
                if (trim($ack) == "SUCCESS") {
                    if ( (isset($resArray["PROFILEID"])) && ($resArray["PROFILEID"] != "") ) {
                        $lastFourDigits = substr($creditCardNumber, count($creditCardNumber) - 5);
                        $this->PP_CreateProfile($current_user->ID, $resArray["PROFILEID"], $resArray["PROFILESTARTDATE"], $do_as_recurring_payments, $Bamount, $creditCardType, $lastFourDigits, $eaddr, $fname, $lname);
                    }                    
                    //                    print_r($resArray);
                    //                    die();
                    $program_id = 0;
                    if ((isset($_SESSION['program_id'])) &&
                     (is_numeric($_SESSION['program_id']))) {
                        $program_id = $_SESSION['program_id'];
                    }
                    $this->PP_LogTransaction($resArray, $program_id, 
                    $pp_action_name);
                    if ($this->send_email) {
                        // Send thank you email address/receipt
                        $p_date = date("M d, Y");
                        $subject = $this->email_subject;
                        $message = $this->email_body;
                        $message = str_ireplace("|fname|", $fname, $message);
                        $message = str_ireplace("|lname|", $lname, $message);
                        $message = str_ireplace("|date|", date('F j, Y'), $message);
                        $message = str_ireplace("|amount|", $Bamount, $message);
			//$message = str_ireplace("|getupdates|", $_SESSION['get_updates'], $message);
                        $message .= $recurring_payment_emailtext; 
                        $message = wordwrap($message, 70);
                        $headers = "MIME-Version: 1.0\n";
                        $headers .= "Content-type: text/plain; charset=utf-8\n";
                        $headers .= "Content-Transfer-Encoding: quoted-printable\n";
                        $headers .= "From: " . $this->email_from . "\n";
                        $headers .= "Return-Path: " . $this->email_from . "\n";
                        mail($eaddr, $subject, $message, $headers);
                        if (($this->notification_email_addr != "") &&
                         (validEmail($this->notification_email_addr))) {
                            mail($this->notification_email_addr, 
                            "Notification of - " . $subject, $message, $headers);
                        }
                        //send the fundraiser notification email here 
                       /* if ($custom) {
                            //try to send a fundraiser notification email    
                            try { 
                                $mySforceConnection = doSalesforceConnect();                          
                                if (strpos($custom,'a')===0 && strpos($custom,'|')>0) {
                                    $fundId = substr($custom,0,strpos($custom,'|')); 
                                    $query = "SELECT id,Name,Email,Goal__c,Total_Raised__c FROM Contact WHERE id IN (SELECT Contact__c FROM Contact_Fundraiser__c WHERE Fundraiser__c = '".$fundId."') LIMIT 1";
                                    $response = $mySforceConnection->query($query);
                                    $fund_email;$fund_name;
                                    foreach ($response->records as $record) {
                                      $fund_email=$record->fields->Email;
                                      $fund_name=stripslashes($record->fields->Name);
                                    };
                                    $platform_options = get_option('pop_platform_options');
                                    $message = $platform_options['platform_fundraiser_notify'];
                                    $message = str_ireplace("|profilelink|", site_url('', 'http') . "/userprofile", $message);
                                    $message = str_ireplace("|fundraisername|", $fund_name, $message);
                                    $message = str_ireplace("|amount|", $Bamount, $message);
                                    $message = wordwrap($message, 70);
                                    $headers = "MIME-Version: 1.0\r\n";
                                    $headers .= "Content-type: text/plain; charset=utf-8\r\n";
                                    $headers .= "From: info@pencilsofpromise.org\r\n";
                                    $headers .= "Return-Path: info@pencilsofpromise.org\r\n";              
                                    mail($fund_email, "Fundraising Page Donation Notification", $message, $headers);                                    
                                }
                            }
                            catch (Exception $e) {
                                header ('Location: /error?e='.urlencode($e));
                                exit;
                            }
                       }*/
                        
                        
                    }
                    // Header, if set
                    if ($this->success_page_url > "") {
                        header("location: " . $this->success_page_url);
                        exit();
                    }
                    $pay_success = TRUE;
                } else {
                    // we only log general API errors here
                    // https://cms.paypal.com/us/cgi-bin/?cmd=_render-content&content_ID=developer/e_howto_api_nvp_errorcodes
                    // rest of the errors will occur because of wrong person and cc infos
                    $err_code = $resArray["L_ERRORCODE0"];
                    if (($err_code == "10002") || ($err_code == "10006") ||
                     ($err_code == "10008") || ($err_code == "10101")) {
                        $resArray["L_ERRORCODE0"] = urldecode(
                        $resArray["L_ERRORCODE0"]);
                        $resArray["L_SHORTMESSAGE0"] = urldecode(
                        $resArray["L_SHORTMESSAGE0"]);
                        $resArray["L_LONGMESSAGE0"] = urldecode(
                        $resArray["L_LONGMESSAGE0"]);
                        $resArray["L_SEVERITYCODE0"] = urldecode(
                        $resArray["L_SEVERITYCODE0"]);
                        $this->PP_LogErrors($resArray, "doDirectPayment");
                        //Display a user friendly Error on the page
                        if ($this->error_page_url != "") {
                            header("location: " . $this->error_page_url);
                            exit();
                        } else {
                            die();
                        }
                    } else {
                        $err_msg = "Error - " .
                         $resArray["L_LONGMESSAGE0"];
                        // Remove 'and type' from message
                        $err_msg = str_replace(
                        ' and type', '', $err_msg);
                        $pp_errors['pp_error'] = $err_msg;
                    }
                }
            }
        }
    }
    //	} // FUNCTION processPayment
    // Website Payment Pro
    function PP_DoExpressCheckout ()
    {
        global $pp_errors, $do_as_recurring_payments;
        $do_as_recurring_payments = "";
        if (isset($_REQUEST['do_as_recurring_payments'])) {
            if ($_REQUEST['do_as_recurring_payments']!="OneTime") {
                $do_as_recurring_payments = $_REQUEST['do_as_recurring_payments'];
                $_SESSION['do_as_recurring_payments'] = $_REQUEST['do_as_recurring_payments'];
            }
        }
        $pp_amount = currency(trim(stripslashes($_REQUEST['Payment_Amount'])));
        $pp_fundraiser = trim(stripslashes($_REQUEST['fundraiser']));
        $pp_anonymous = trim(stripslashes($_REQUEST['anonymous']));
        if (!$pp_fundraiser && isset($_SESSION['Fundraiser'])) {
            $pp_fundraiser = $_SESSION['Fundraiser'];  
        }
        $_SESSION["Fundraiser"] = $pp_fundraiser;        
        if (! validAmount($pp_amount)) {
            $pp_errors['Payment_Amount'] = "Please enter a valid donation amount.";
            return;
        }
        $_SESSION["Payment_Amount"] = $pp_amount;
	//$_SESSION["get_updates"] = $_POST['get_updates'];
        $paymentAmount = $pp_amount;
        $currencyCodeType = "USD";
        $custom = $pp_fundraiser.'|'.$pp_anonymous;
        if ($this->payment_type == 1) {
            $my_PayflowPro = new PayflowPro($this->api_username, 
            $this->api_password, $this->flow_vendor, $this->flow_partner, 
            $this->paypal_url, $this->api_endpoint);
            $resArray = $my_PayflowPro->CallShortcutExpressCheckout(
            $paymentAmount, $currencyCodeType, $this->express_confirmation_url, 
            $this->express_cancel_url, $do_as_recurring_payments,$custom);
            $ack = strtoupper($resArray["RESPMSG"]);
            if ($ack == "APPROVED") {
                $my_PayflowPro->RedirectToPayPal($resArray["TOKEN"]);
            } else {
                //                // Log PayPal Errors, because if an error occurs here, it might be more serious
                //                $resArray["L_ERRORCODE0"] = urldecode(
                //                $resArray["L_ERRORCODE0"]);
                //                $resArray["L_SHORTMESSAGE0"] = urldecode(
                //                $resArray["L_SHORTMESSAGE0"]);
                //                $resArray["L_LONGMESSAGE0"] = urldecode($resArray["L_LONGMESSAGE0"]);
                //                $resArray["L_SEVERITYCODE0"] = urldecode(
                //                $resArray["L_SEVERITYCODE0"]);
                //                $this->PP_LogErrors($resArray, "expresscheckout");
                //                //Display a user friendly Error on the page
                if ($this->error_page_url !=
                 "") {
                    header("location: " . $this->error_page_url);
                    exit();
                } else {
                    die();
                }
            }
        } else {
            $my_WebsitePaymentPro = new WebsitePaymentPro($this->api_username, 
            $this->api_password, $this->api_signature, $this->paypal_url, 
            $this->api_endpoint);
            $resArray = $my_WebsitePaymentPro->CallShortcutExpressCheckout(
            $paymentAmount, $currencyCodeType, $this->express_confirmation_url, 
            $this->express_cancel_url, $do_as_recurring_payments,$custom);
            $ack = strtoupper($resArray["ACK"]);
            if ($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING") {
                $my_WebsitePaymentPro->RedirectToPayPal($resArray["TOKEN"]);
            } else {
                // Log PayPal Errors, because if an error occurs here, it might be more serious
                $resArray["L_ERRORCODE0"] = urldecode(
                $resArray["L_ERRORCODE0"]);
                $resArray["L_SHORTMESSAGE0"] = urldecode(
                $resArray["L_SHORTMESSAGE0"]);
                $resArray["L_LONGMESSAGE0"] = urldecode(
                $resArray["L_LONGMESSAGE0"]);
                $resArray["L_SEVERITYCODE0"] = urldecode(
                $resArray["L_SEVERITYCODE0"]);
                $this->PP_LogErrors($resArray, "expresscheckout");
                //Display a user friendly Error on the page
                if ($this->error_page_url != "") {
                    header("location: " . $this->error_page_url);
                    exit();
                } else {
                    die();
                }
            }
        }
    }
    function PP_ProcessReview ()
    {
        global $email, $firstName, $lastName;
        /*==================================================================
         PayPal Express Checkout Call
         ===================================================================
        */
        // Check to see if the Request object contains a variable named 'token'
        $token = "";
        if (isset($_REQUEST['token'])) {
            $token = $_REQUEST['token'];
        }
        // If the Request object contains the variable 'token' then it means that the user is coming from PayPal site.
        if ($token != "") {
            /*
            '------------------------------------
            ' Calls the GetExpressCheckoutDetails API call
            '
            ' The GetShippingDetails function is defined in PayPalFunctions.jsp
            ' included at the top of this file.
            '-------------------------------------------------
            */
            if ($this->payment_type == 1) {
                $my_PayflowPro = new PayflowPro($this->api_username, 
                $this->api_password, $this->flow_vendor, $this->flow_partner, 
                $this->paypal_url, $this->api_endpoint);
                $resArray = $my_PayflowPro->GetShippingDetails($token);
                $ack = strtoupper($resArray["RESPMSG"]);
                if ($ack == "APPROVED") {} else {
                    if ($this->error_page_url != "") {
                        header("location: " . $this->error_page_url);
                        exit();
                    } else {
                        die();
                    }
                }
            } else {
                $my_WebsitePaymentPro = new WebsitePaymentPro(
                $this->api_username, $this->api_password, $this->api_signature, 
                $this->paypal_url, $this->api_endpoint);
                $resArray = $my_WebsitePaymentPro->GetShippingDetails($token);
                $ack = strtoupper($resArray["ACK"]);
                if ($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING") {} else {
                    // Log PayPal Errors, because if an error occurs here, it might be more serious
                    $resArray["L_ERRORCODE0"] = urldecode(
                    $resArray["L_ERRORCODE0"]);
                    $resArray["L_SHORTMESSAGE0"] = urldecode(
                    $resArray["L_SHORTMESSAGE0"]);
                    $resArray["L_LONGMESSAGE0"] = urldecode(
                    $resArray["L_LONGMESSAGE0"]);
                    $resArray["L_SEVERITYCODE0"] = urldecode(
                    $resArray["L_SEVERITYCODE0"]);
                    $this->PP_LogErrors($resArray, "getshippingdetails");
                    //Display a user friendly Error on the page
                    if ($this->error_page_url != "") {
                        header("location: " . $this->error_page_url);
                        exit();
                    } else {
                        die();
                    }
                }
            }
            if ($ack == "SUCCESS" || $ack == "SUCESSWITHWARNING" ||
             $ack == "APPROVED") {
                /*
                ' The information that is returned by the GetExpressCheckoutDetails call should be integrated by the partner into his Order Review
                ' page
                */
                $email = $resArray["EMAIL"]; // ' Email address of payer.
                //                $payerId 		= $resArray["PAYERID"]; // ' Unique PayPal customer account identification number.
                //                $payerStatus		= $resArray["PAYERSTATUS"]; // ' Status of payer. Character length and limitations: 10 single-byte alphabetic characters.
                //                $salutation		= $resArray["SALUTATION"]; // ' Payer's salutation.
                $firstName = $resArray["FIRSTNAME"]; // ' Payer's first name.
                //                $middleName		= $resArray["MIDDLENAME"]; // ' Payer's middle name.
                $lastName = $resArray["LASTNAME"]; // ' Payer's last name.
            //                $suffix		= $resArray["SUFFIX"]; // ' Payer's suffix.
            //                $cntryCode		= $resArray["COUNTRYCODE"]; // ' Payer's country of residence in the form of ISO standard 3166 two-character country codes.
            //                $business		= $resArray["BUSINESS"]; // ' Payer's business name.
            //                $shipToName		= $resArray["SHIPTONAME"]; // ' Person's name associated with this address.
            //                $shipToStreet		= $resArray["SHIPTOSTREET"]; // ' First street address.
            //                $shipToStreet2	= $resArray["SHIPTOSTREET2"]; // ' Second street address.
            //                $shipToCity		= $resArray["SHIPTOCITY"]; // ' Name of city.
            //                $shipToState		= $resArray["SHIPTOSTATE"]; // ' State or province
            //                $shipToCntryCo        = $resArray["SHIPTOCOUNTRYCODE"]; // ' Country code.
            //                $shipToZip		= $resArray["SHIPTOZIP"]; // ' U.S. Zip code or other country-specific postal code.
            //                $addressStatus	= $resArray["ADDRESSSTATUS"]; // ' Status of street address on file with PayPal
            //                $invoiceNumber	= $resArray["INVNUM"]; // ' Your own invoice or tracking number, as set by you in the element of the same name in SetExpressCheckout request .
            //                $phonNumber		= $resArray["PHONENUM"]; // ' Payer's contact telephone number. Note:  PayPal returns a contact telephone number only if your Merchant account profile settings require that the buyer enter one.
            }
        }
    }
    function PP_ConfirmPayment ()
    {
        global $pp_errors, $email, $firstName, $lastName;
        global $wpdb;
        $logtext = "";
        /*==================================================================
         PayPal Express Checkout Call
         ===================================================================
        */
        /*
        '------------------------------------
        ' The paymentAmount is the total value of
        ' the shopping cart, that was set
        ' earlier in a session variable
        ' by the shopping cart page
        '------------------------------------
        */
        //print_r($_SESSION);
        //die();
        if ( (isset($_SESSION["Payment_Amount"])) && ($_SESSION["Payment_Amount"] != "") ){
            $finalPaymentAmount = $_SESSION["Payment_Amount"];
        } else {
            $finalPaymentAmount = $_SESSION["Payment_Amount_bak"]; // quick fix for the server
        }
        /*
        '------------------------------------
        ' Calls the DoExpressCheckoutPayment API call
        '
        ' The ConfirmPayment function is defined in the file PayPalFunctions.jsp,
        ' that is included at the top of this file.
        '-------------------------------------------------
        */
        if ((isset($_SESSION['do_as_recurring_payments'])) &&
         ($_SESSION['do_as_recurring_payments'] != "")) {
            $logtext = "recurringPayment";
            if ($this->payment_type == 1) {
                $my_PayflowPro = new PayflowPro($this->api_username, 
                $this->api_password, $this->flow_vendor, $this->flow_partner, 
                $this->paypal_url, $this->api_endpoint);
                $resArray = $my_PayflowPro->RecurringPayment(
                $finalPaymentAmount);
            } else {
                $my_WebsitePaymentPro = new WebsitePaymentPro(
                $this->api_username, $this->api_password, $this->api_signature, 
                $this->paypal_url, $this->api_endpoint);
                $resArray = $my_WebsitePaymentPro->RecurringPayment(
                $finalPaymentAmount);
            }
        } else {
            $logtext = "expresscheckout";
            if ($this->payment_type == 1) {
                $my_PayflowPro = new PayflowPro($this->api_username, 
                $this->api_password, $this->flow_vendor, $this->flow_partner, 
                $this->paypal_url, $this->api_endpoint);
                $resArray = $my_PayflowPro->ConfirmPayment($finalPaymentAmount);
            } else {
                $my_WebsitePaymentPro = new WebsitePaymentPro(
                $this->api_username, $this->api_password, $this->api_signature, 
                $this->paypal_url, $this->api_endpoint);
                $resArray = $my_WebsitePaymentPro->ConfirmPayment(
                $finalPaymentAmount);
            }
        }
        $ack = strtoupper($resArray["ACK"]);
        $program_id = 0;
        if ((isset($_SESSION['program_id'])) &&
         (is_numeric($_SESSION['program_id']))) {
            $program_id = $_SESSION['program_id'];
        }
        if ($ack == "APPROVED") {
            // insert in flow transaction
        }
        if ($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING") {
            $this->PP_LogTransaction($resArray, $program_id, $logtext);
        } else {
            $err_code = $resArray["L_ERRORCODE0"];
            // error code 10415 occurs, when some trys to donate a second time with the
            // same token
            if ($err_code == "10415") {
                $pp_errors["pp_error"] = urldecode($resArray["L_LONGMESSAGE0"]);
                return;
            } else {
                // Log PayPal Errors, because if an error occurs here, it might be more serious
                $resArray["L_ERRORCODE0"] = urldecode(
                $resArray["L_ERRORCODE0"]);
                $resArray["L_SHORTMESSAGE0"] = urldecode(
                $resArray["L_SHORTMESSAGE0"]);
                $resArray["L_LONGMESSAGE0"] = urldecode(
                $resArray["L_LONGMESSAGE0"]);
                $resArray["L_SEVERITYCODE0"] = urldecode(
                $resArray["L_SEVERITYCODE0"]);
                $this->PP_LogErrors($resArray, "expresscheckout");
                //Display a user friendly Error on the page
                if ($this->error_page_url != "") {
                    header("location: " . $this->error_page_url);
                    exit();
                } else {
                    die();
                }
            }
        }
        if ($this->send_email) {
            // Send thank you email address/receipt
            $p_date = date("M d, Y");
            $fname = $_REQUEST['fname'];
            $lname = $_REQUEST['lname'];
            $Bamount = $finalPaymentAmount;
            $eaddr = $_REQUEST['eaddr'];
            $subject = $this->email_subject;
            $message = $this->email_body;
            $message = str_ireplace("|fname|", $fname, $message);
            $message = str_ireplace("|lname|", $lname, $message);
            $message = str_ireplace("|date|", date('F j, Y'), $message);
            $message = str_ireplace("|amount|", $Bamount, $message);
	    //$message = str_ireplace("|getupdates|", $_SESSION["get_updates"], $message);
            $message = wordwrap($message, 70);
            $headers = "MIME-Version: 1.0\n";
            $headers .= "Content-type: text/plain; charset=utf-8\n";
            $headers .= "Content-Transfer-Encoding: quoted-printable\n";
            $headers .= "From: " . $this->email_from . "\n";
            $headers .= "Return-Path: " . $this->email_from . "\n";
            if (($eaddr != "") && (validEmail($eaddr))) {
                mail($eaddr, $subject, $message, $headers);
            }
            if (($this->notification_email_addr != "") &&
             (validEmail($this->notification_email_addr))) {
                mail($this->notification_email_addr, 
                "Notification of - " . $subject, $message, $headers);
            }
        }
        // Header, if set
        if ($this->success_page_url > "") {
            $_SESSION['paypal'] = true;
            header("location: " . $this->success_page_url);
            exit();
        }
    } // End function PP_ConfirmPayment
    private function PP_LogErrors ($resArray, $errorLocation)
    {
        global $wpdb;
        $wpdb->insert($wpdb->prefix . $this->tableNamePPErrorLog, 
        array('timestamp' => $resArray["TIMESTAMP"], 
        'correlationid' => $resArray["CORRELATIONID"], 'ack' => $resArray["ACK"], 
        'version' => $resArray["VERSION"], 
        'l_errorcode' => $resArray["L_ERRORCODE0"], 
        'l_shortmessage' => $resArray["L_SHORTMESSAGE0"], 
        'l_longmessage' => $resArray["L_LONGMESSAGE0"], 
        'l_severitycode' => $resArray["L_SEVERITYCODE0"], 
        'error_location' => $errorLocation));
        // send notification email in case of an error
        if (($this->error_email_addr != "") &&
         (validEmail($this->error_email_addr))) {
            $subject = "PayPal API Error occured.";
            $message .= "Plugin Name: Agencynet PayPal Pro\n";
            $message .= "PayPal Message:\n";
            $message .= $resArray["L_LONGMESSAGE0"] . "\n\n";
            $message .= "More information in database table: " . $wpdb->prefix .
             $this->tableNamePPErrorLog . "\n";
            $message .= "Id: " . $wpdb->insert_id . "\n";
            $message = wordwrap($message, 70);
            $headers = "MIME-Version: 1.0\n";
            $headers .= "Content-type: text/plain; charset=utf-8\n";
            $headers .= "Content-Transfer-Encoding: quoted-printable\n";
            $headers .= "From: " . $this->email_from . "\n";
            $headers .= "Return-Path: " . $this->email_from . "\n";
            mail($this->error_email_addr, $subject, $message, $headers);
        }
    }
    private function PP_LogTransaction ($resArray, $program_id, $transactionType)
    {
        global $wpdb;
        $wpdb->insert($wpdb->prefix . $this->tableNamePPTransactionLog, 
        array('program_id' => $program_id, 
        'timestamp' => $resArray["TIMESTAMP"], 
        'correlationid' => $resArray["CORRELATIONID"], 'ack' => $resArray["ACK"], 
        'version' => $resArray["VERSION"], 
        'transactionid' => $resArray["TRANSACTIONID"], 
        'transactiontype' => $transactionType, 'amount' => $resArray["AMT"], 
        'currencycode' => $resArray["CURRENCYCODE"], 
        'paymentstatus' => $resArray["PAYMENTSTATUS"], 
        'pendingreason' => $resArray["PENDINGREASON"], 
        'reasoncode' => $resArray["REASONCODE"]));
    }
    
    private function PP_CreateProfile ($userId, $profileId, $profileStartDate, $billingperiod, $amount, $cardType, $lastFourDigits, $email, $fname, $lname)
    {
        global $wpdb;
        $wpdb->insert($wpdb->prefix . $this->tableNameRecurringPaymentsProfiles, 
        array('user_id' => $userId, 
        'profile_id' => $profileId, 
        'profile_start_date' => $profileStartDate, 
        'billingperiod' => $billingperiod, 
        'amount' => $amount, 
        'cardtype' => $cardType, 
        'last_four_digits' => $lastFourDigits, 
        'last_change_date' => date("Y-m-d H:i:s"),
        'email' => $email,
        'first_name' => $fname,
        'last_name' => $lname
        ));
    }
    
    private function PP_UpdateProfile ($userId, $profileId, $cardType, $lastFourDigits)
    {
        global $wpdb;
        
        $wpdb->update( $wpdb->prefix . $this->tableNameRecurringPaymentsProfiles, array( 'cardtype' => $cardType, 'last_four_digits' => $lastFourDigits, 'last_change_date' => date("Y-m-d H:i:s") ), array( 'profile_id' => $profileId, 'user_id' => $userId ), array( '%s', '%s', '%s' ), array( '%s', '%s' ) );
    }
    
    public function PP_GetDonationList()
    {
        global $wpdb, $profiles;
        $current_user = wp_get_current_user();
        
        $sql = "
        	SELECT rp_id, billingperiod, amount, cardtype, last_four_digits  
        	FROM " . $wpdb->prefix . $this->tableNameRecurringPaymentsProfiles . " 
        	WHERE user_id = $current_user->ID
        	ORDER BY profile_start_date";
        
        $profiles = $wpdb->get_results($sql);
        
    }
    
    public function PP_GetDonation()
    {
        global $wpdb, $nextBillingDate;
        if (!isset($_REQUEST['rp_id'])) {
            return;
        }
        $rp_id = trim(stripslashes($_REQUEST['rp_id']));        
        $current_user = wp_get_current_user();
        $row = $this->GetProfile($rp_id, $current_user->ID); 
        if ( (isset($row->profile_id)) && ($row->profile_id != "")){                
            $my_WebsitePaymentPro = new WebsitePaymentPro(
            $this->api_username, $this->api_password, $this->api_signature, 
            $this->paypal_url, $this->api_endpoint);
            
            $resArray = $my_WebsitePaymentPro->GetRecurringPaymentProfile($row->profile_id);
            $ack = strtoupper($resArray["ACK"]);
            if ($ack == "SUCCESS") {
                $nextBillingDate = $resArray["NEXTBILLINGDATE"];
                $nextBillingDate = substr($nextBillingDate, 0, 10);
                $datepartsArray = explode("-", $nextBillingDate);
                $nextBillingDate = mktime(10, 0, 0, $datepartsArray[1], $datepartsArray[2], $datepartsArray[0]);
            } else {
                $this->PP_LogErrors($resArray, "GetRecurringPayment");
            }
        }
    }
    
    public function PP_GetPaymentData()
    {
        global $wpdb, $credit_cards;
        global $fname, $lname, $address1, $city, $state, $province, $zip, $country, $eaddr, $cc_type, $cc_num, $cc_exp_month, $cc_exp_year, $cc_cvc;

        $rp_id = trim(stripslashes($_REQUEST['rp_id']));        
        $current_user = wp_get_current_user();
        $row = $this->GetProfile($rp_id, $current_user->ID);
        if ( (isset($row->profile_id)) && ($row->profile_id != "")){                
            $my_WebsitePaymentPro = new WebsitePaymentPro(
            $this->api_username, $this->api_password, $this->api_signature, 
            $this->paypal_url, $this->api_endpoint);
            
            $resArray = $my_WebsitePaymentPro->GetRecurringPaymentProfile($row->profile_id);
            $ack = strtoupper($resArray["ACK"]);
            if ($ack == "SUCCESS") {
                $fname = $resArray['FIRSTNAME'];
                $lname = $resArray['LASTNAME'];
                $address1 = $resArray['STREET'];
                $city = $resArray['CITY'];
                $state = $resArray['STATE'];
                $country = $resArray['COUNTRYCODE'];
                if ($country == 'CA'){
                    $province = $state;
                }
                $zip = $resArray['ZIP'];
                $eaddr = $resArray['EMAIL'];
                $cc_type = $resArray['CREDITCARDTYPE'];
                $cc_num = $resArray['ACCT'];
                
                if ($cc_type == "Amex") {
                    $cc_num = "****-******-*" . $cc_num; 
                } else {
                    $cc_num = "****-****-****-" . $cc_num; 
                }
                
                // transfer text to index
                if ($cc_type == "Amex") {
                    $cc_type = "American Express";
                }
                $credit_card_names = array_flip($credit_cards);
                $cc_type = $credit_card_names[$cc_type];
                
                $cc_exp_month = substr($resArray['EXPDATE'], 0, 2);
                $cc_exp_year = substr($resArray['EXPDATE'], 2);
                $cc_cvc = $resArray['CVV2']; //will be empty
            } else {
                $this->PP_LogErrors($resArray, "GetRecurringPaymentProfile");
            }
        }
    }
    
    
    public function PP_SaveModifyDonation() {
        global $wpdb, $donation_errors;
        $new_amount = currency(trim(stripslashes($_POST['new_amount'])));
        $current_amount = currency(trim(stripslashes($_POST['current_amount'])));
        if ($new_amount == $current_amount) {
            return;
        }
        
        if (! validAmount($new_amount)) {
            $donation_errors[] = "<p>Please insert a valid donation amount.</p>";
            return;
        }
        $rp_id = trim(stripslashes($_POST['rp_id']));        
        $current_user = wp_get_current_user();
        $row = $this->GetProfile($rp_id, $current_user->ID);
        if ( (isset($row->profile_id)) && ($row->profile_id != "")){                
            $my_WebsitePaymentPro = new WebsitePaymentPro(
            $this->api_username, $this->api_password, $this->api_signature, 
            $this->paypal_url, $this->api_endpoint);
            
            $resArray = $my_WebsitePaymentPro->ModifyRecurringPaymentAmount($row->profile_id, $new_amount, 'USD');
            $ack = strtoupper($resArray["ACK"]);
            if ($ack == "SUCCESS") {
                $wpdb->update( $wpdb->prefix . $this->tableNameRecurringPaymentsProfiles, array( 'amount' => $new_amount, 'last_change_date' => date("Y-m-d H:i:s") ), array( 'profile_id' => $row->profile_id, 'user_id' => $current_user->ID ), array( '%s', '%s' ), array( '%s', '%s' ) );
            } else {
                $this->PP_LogErrors($resArray, "ModifyRecurringPaymentAmount");
                $donation_errors[] = "<p>An error occured while updating the donation amount.</p>";
            }
        }
    }
    
    public function PP_SaveModifyMethod() {
        global $pp_errors, $credit_cards;
        global $fname, $lname, $address1, $city, $state, $province, $zip, $country, $eaddr, $cc_type, $cc_num, $cc_exp_month, $cc_exp_year, $cc_cvc;
        global $wpdb;
        $pp_errors = array();
        
             
        // Validate data
        $rp_id = trim(stripslashes($_POST['rp_id']));        
        $current_user = wp_get_current_user();
        $row = $this->GetProfile($rp_id, $current_user->ID);
        
        if ($row->profile_id == "") {
            return;
        }
        
        $fname = trim(stripslashes($_POST['fname']));
        $lname = trim(stripslashes($_POST['lname']));
        $address1 = trim(stripslashes($_POST['address1']));
        $city = trim(stripslashes($_POST['city']));
        $state = trim(stripslashes($_POST['state']));
        $province = trim(stripslashes($_POST['province']));
        $zip = trim(stripslashes($_POST['zip']));
        $country = trim(stripslashes($_POST['country']));
        $eaddr = trim(stripslashes($_POST['eaddr']));
        if ($fname == '')
            $pp_errors['fname'] = "First Name is required.";
        if ($lname == '')
            $pp_errors['lname'] = "Last Name is required.";
        if ($address1 == '')
            $pp_errors['address1'] = "Street Address is required.";
        if ($city == '')
            $pp_errors['city'] = "City is required.";
        if ($zip == '')
            $pp_errors['zip'] = "Zip is required.";
        if ($country == 'US' && $state == '')
            $pp_errors['state'] = "State is required.";
        if ($country == 'CA' && $province == '')
            $pp_errors['province'] = "Province is required.";
        if (! validEmail($eaddr)) 
            $pp_errors['eaddr'] = "A valid email address is required.";
        
        if ($country == 'CA')
            $state = $province;
        if (($country != 'US') && ($country != 'CA'))
            $state = "";
            
        
        //check if cc data has changed
        $cc_data_changed = false;
        if ($_POST['cc_type'] != $_POST['old_cc_type']) {
            $cc_data_changed = true;
        }
        if ($_POST['cc_num'] != $_POST['old_cc_num']) {
            $cc_data_changed = true;
        }
        if ($_POST['cc_exp_month'] != $_POST['old_cc_exp_month']) {
            $cc_data_changed = true;
        }
        if ($_POST['cc_exp_year'] != $_POST['old_cc_exp_year']) {
            $cc_data_changed = true;
        }
        
        $cc_type = $_POST['cc_type'];
        $cc_num = $_POST['cc_num'];
        $cc_exp_month = $_POST['cc_exp_month'];
        $cc_exp_year = $_POST['cc_exp_year'];
        $cc_exp = $cc_exp_month . $cc_exp_year;
        $cc_cvc = allNumbers($_POST['cc_cvc']);
        if ($cc_data_changed) {
            $cc_num = allNumbers($_POST['cc_num']);
            if ( (strlen($cc_num) < 15) || (strlen($cc_num) > 16) ) {
                $pp_errors['cc_num'] = "Invalid credit card number.";
            }
            if ( (strlen($cc_cvc) < 3) || (strlen($cc_cvc) > 4) ) {
                $pp_errors['cc_cvc'] = "Invalid security code.";
            }
        }
        // Attempt to process, if no errors
        if (count($pp_errors) == 0) {
            // cc_type. one of Visa MasterCard Discover Amex
            if ($cc_type == 4) {
                $creditCardType = urlencode("Amex");
            } else {
                $creditCardType = urlencode($credit_cards[$cc_type]);
            }
            $creditCardNumber = urlencode($cc_num);
            $cvv2Number = urlencode($cc_cvc);
            $firstName = urlencode($fname);
            $lastName = urlencode($lname);
            $Baddress = urlencode($address1);
            $Bcity = urlencode($city);
            $Bstate = urlencode($state);
            $Bzip = urlencode($zip);
            $my_WebsitePaymentPro = new WebsitePaymentPro(
            $this->api_username, $this->api_password, $this->api_signature, 
            $this->paypal_url, $this->api_endpoint);

            $pp_action_name = "UpdateRecurringPaymentsProfile";
            $resArray = $my_WebsitePaymentPro->UpdateRecurringPaymentsProfile($row->profile_id,
            $creditCardType, $creditCardNumber, $cc_exp, $cvv2Number, $eaddr,
            $firstName, $lastName, $Baddress, $Bcity, $Bstate, $Bzip, $country, $cc_data_changed);
            
            $ack = strtoupper($resArray["ACK"]);
            if (trim($ack) == "SUCCESS") {
                if ($cc_data_changed) {
                    $lastFourDigits = substr($creditCardNumber, count($creditCardNumber) - 5);
                    $this->PP_UpdateProfile($current_user->ID, $row->profile_id, $creditCardType, $lastFourDigits);
                }
            } else {
                // we only log general API errors here
                // https://cms.paypal.com/us/cgi-bin/?cmd=_render-content&content_ID=developer/e_howto_api_nvp_errorcodes
                // rest of the errors will occur because of wrong person and cc infos
                $err_code = $resArray["L_ERRORCODE0"];
                if (($err_code == "10002") || ($err_code == "10006") ||
                 ($err_code == "10008") || ($err_code == "10101")) {
                    $resArray["L_ERRORCODE0"] = urldecode(
                    $resArray["L_ERRORCODE0"]);
                    $resArray["L_SHORTMESSAGE0"] = urldecode(
                    $resArray["L_SHORTMESSAGE0"]);
                    $resArray["L_LONGMESSAGE0"] = urldecode(
                    $resArray["L_LONGMESSAGE0"]);
                    $resArray["L_SEVERITYCODE0"] = urldecode(
                    $resArray["L_SEVERITYCODE0"]);
                    $this->PP_LogErrors($resArray, "UpdateRecurringPaymentsProfile");
                    //Display a user friendly Error on the page
                    if ($this->error_page_url != "") {
                        header("location: " . $this->error_page_url);
                        exit();
                    } else {
                        die();
                    }
                } else {
                    $err_msg = "Error $err_code: " .
                     $resArray["L_LONGMESSAGE0"];
                    // Remove 'and type' from message
                    $err_msg = str_replace(
                    ' and type', '', $err_msg);
                    $pp_errors['pp_error'] = $err_msg;
                }
            }
        }
    }
    
    public function PP_CancelDonation() {
        global $wpdb;
        $rp_id = trim(stripslashes($_POST['rp_id']));        
        $current_user = wp_get_current_user();
        $row = $wpdb->get_row(
        "SELECT profile_id 
        FROM " . $wpdb->prefix . $this->tableNameRecurringPaymentsProfiles . " 
        WHERE rp_id = $rp_id 
        AND user_id = $current_user->ID");        
        if ( (isset($row->profile_id)) && ($row->profile_id != "")){                
            $my_WebsitePaymentPro = new WebsitePaymentPro(
            $this->api_username, $this->api_password, $this->api_signature, 
            $this->paypal_url, $this->api_endpoint);
            
            $resArray = $my_WebsitePaymentPro->CancelRecurringPayment($row->profile_id);
            $ack = strtoupper($resArray["ACK"]);
            if ($ack == "SUCCESS") {
                $wpdb->query("
                	DELETE FROM " . $wpdb->prefix . $this->tableNameRecurringPaymentsProfiles . " 
                	WHERE rp_id = $rp_id ");                
            } else {
                $this->PP_LogErrors($resArray, "CancelRecurringPayment");
            }
        }
    }
    
    private function GetProfile($rp_id, $userId){
        global $wpdb;
        
        $row = $wpdb->get_row(
        "SELECT profile_id 
        FROM " . $wpdb->prefix . $this->tableNameRecurringPaymentsProfiles . " 
        WHERE rp_id = $rp_id 
        AND user_id = $userId");        
        if ( (isset($row->profile_id)) && ($row->profile_id != "")){
            return $row;  
        }
        return false;
    }
} // End Class PayPalPro
?>
