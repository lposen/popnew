<?php
session_start();

/*
  Plugin Name: Agencynet PayPal Website Payments Pro
  Plugin URI: http://www.agencynetnet.com
  Version: 1.01
  Author: <a href="http://www.agencynetnet.com/">Agencynet</a>
  Description: A plugin for <a href="http://www.paypal.com">PayPal Website Payments Pro</a>. */

// include the main class, which handles the paypal operations
if (!class_exists("PayPalPro")) {
    include('lib/PayPalPro.php');
}

// include the main class, which handles the recurring payments
if (!class_exists("ANRecurring")) {
    include('lib/ANRecurring.php');
}

if (class_exists("PayPalPro")) {
    $my_paypalpro = new PayPalPro();
}

if (class_exists("ANRecurring")) {
    $my_anrecurring = new ANRecurring();
}

//Actions and Filters
if (isset($my_paypalpro)) {
    //Initialize the admin panel
    if (!function_exists("PayPalPro_ap")) {

        function PayPalPro_ap() {
            global $my_paypalpro;
            if (!isset($my_paypalpro)) {
                return;
            }
            if (function_exists('add_options_page')) {
                add_options_page('Agencynet PayPal Pro Plugin', 'PayPalPro', 9, basename(__FILE__), array(&$my_paypalpro, 'printAdminPage'));
            }
        }
    }

    function DoDirectPaymentActivity() {
        global $my_paypalpro;

        // user only has to be logged in, if he want recurring payments
        if ( isset($_SESSION['do_as_recurring_payments']) && ($_SESSION['do_as_recurring_payments'] != "") ) {
            $current_user = wp_get_current_user();
            if ($current_user->ID > 0) {        
                if (!function_exists("FormDirectPayment")) {
                    $my_paypalpro->FormDirectPayment();
                }
            } else {
                header("Location: " . $my_paypalpro->login_url . "?dest=" . urlencode($my_paypalpro->direct_payment_url));
                exit;                
            }
        } else {
            $my_paypalpro->FormDirectPayment();
        }       
    }

    function DoChoosePaymentActivity() {
        global $my_paypalpro;
        if (!function_exists("FormChoosePayment")) {
            $my_paypalpro->FormChoosePayment();
        }
    }

    function DoConfirmPaymentActivity() {
        global $my_paypalpro;
        if (!function_exists("FormConfirmPayment")) {
            $my_paypalpro->FormConfirmPayment();
        }
    }

    function DoLoginActivity() {
        global $my_anrecurring;
        if (!function_exists("FormLogin")) {
            $my_anrecurring->FormLogin();
        }
    }
    
    function DoRegisterActivity() {
        global $my_anrecurring;
        if (!function_exists("FormRegister")) {
            $my_anrecurring->FormRegister();
        }
    }
    
    function DoDonationDashboardActivity() {
        global $my_paypalpro;
        
        $current_user = wp_get_current_user();
        if ($current_user->ID > 0) {        
            if (!function_exists("PP_GetDonationList")) {
                $my_paypalpro->PP_GetDonationList();
            }
        } else {
            header("Location: " . $my_paypalpro->login_url . "?dest=" . urlencode($my_paypalpro->donation_dashboard_url));
            exit;                
        }
    }

    function DoModifyDonationAmountActivity() {
        global $my_paypalpro;
        $current_user = wp_get_current_user();
        if ($current_user->ID > 0) {        
            if (!function_exists("PP_GetDonation")) {            
                $my_paypalpro->PP_GetDonation();
            }
        } else {
            header("Location: " . $my_paypalpro->login_url . "?dest=" . urlencode($my_paypalpro->donation_dashboard_url));
            exit;                
        }
    }
    
    function DoModifyPaymentMethodActivity() {
        global $my_paypalpro;
        if (!function_exists("PP_GetPaymentData")) {
            
            $my_paypalpro->PP_GetPaymentData();
        }
    }
    
    
    // this will be called on each request
    function DecideNextStep() {
        global $my_paypalpro, $my_anrecurring, $do_as_recurring_payments;

			//print_r($_REQUEST);

        if (isset($_REQUEST['do_as_recurring_payments'])) {
            if ($_REQUEST['do_as_recurring_payments']!="OneTime") {
                $do_as_recurring_payments = $_REQUEST['do_as_recurring_payments'];
                $_SESSION['do_as_recurring_payments'] = $_REQUEST['do_as_recurring_payments'];
            }
        }

			//if (isset($_REQUEST['get_updates'])) {
			//	$_SESSION["get_updates"] = $_REQUEST['get_updates'];
			//}
			
			//print_r($_SESSION);
        
        // User clicked the "Checkout with PayPal" Button
        if (isset($_REQUEST['express_checkout_x'])) {
            $my_paypalpro->PP_DoExpressCheckout();
        } else if (isset($_REQUEST['direct_payment_x'])) { // User clicked "Pay with Credit Card"
            if (isset($_REQUEST['Payment_Amount'])) {
                unset($_SESSION['Payment_Amount']);
                $_SESSION['Payment_Amount'] = $_REQUEST['Payment_Amount'];
            }
            if (isset($_REQUEST['anonymous'])) {
                $_SESSION['Anonymous'] = $_REQUEST['anonymous'];
            }
            else {
                $_SESSION['Anonymous'] = '0';   
            }
            header("Location: " . $my_paypalpro->direct_payment_url);
            exit;                
        } else if (isset($_REQUEST['login'])) { // User submits the "FormLogin"
            require_once('wp-includes/registration.php');
            require('wp-blog-header.php');
            
            $creds = array();
            $creds['user_login'] = $_REQUEST['user_login'];
            $creds['user_password'] = $_REQUEST['user_password'];

            $user = wp_signon( $creds, false );
            if ( is_wp_error($user) ) {
               $my_anrecurring->ProcessLoginErrors($user);
            } else {
                if ($user->ID > 0) {
                    if ( (isset($_REQUEST['dest'])) && ($_REQUEST['dest'] != "") ) {
                        header("Location: " . urldecode($_REQUEST['dest']));
                        exit;                
                    }
                    header("Location: donate");
                    exit;                
                }
            }            
        } else if (isset($_REQUEST['register'])) { // User submits the "FormRegister"
            require_once('wp-includes/registration.php');
            require('wp-blog-header.php');
            global $register_name, $register_email;
            global $register_password, $register_password_confirm;

            $register_name = $_REQUEST['register_name'];
            $register_email = $_REQUEST['register_email'];
            $register_password = $_REQUEST['register_password'];
            $register_password_confirm = $_REQUEST['register_password_confirm'];
            
            $user = $my_anrecurring->CreateUser($register_name, $register_email, $register_password, $register_password_confirm);
                        
            if ($user->ID > 0) {
                if ( (isset($_REQUEST['dest'])) && ($_REQUEST['dest'] != "") ) {
                    header("Location: " . urldecode($_REQUEST['dest']));
                    exit;                
                }
                header("Location: donate");
                exit;                
            }            
        } else if (isset($_REQUEST['send_email'])) { // User submits the "FormRegister"            
            $my_anrecurring->SendNewPassword($my_paypalpro->email_from);
        } else if (isset($_REQUEST['submitpayment_x'])) { // User submits the "FormDirectPayment"
            if (isset($_REQUEST['amount'])) {
                unset($_SESSION['Payment_Amount']);
                $_SESSION['Payment_Amount'] = $_REQUEST['amount'];
            }            
            $my_paypalpro->PP_ProcessPayment();
        } else if (isset($_REQUEST['confirm_button_x'])) { // User submits the "FormConfirmPayment"
            $my_paypalpro->PP_ConfirmPayment();
        } else if (isset($_REQUEST['token'])) { // User comes back from PayPal and has to review the payment
            $my_paypalpro->PP_ProcessReview();
        } else if (isset($_REQUEST['save_modify_amount'])) { // User saves the new payment amount
            $my_paypalpro->PP_SaveModifyDonation();
        } else if (isset($_REQUEST['save_modify_method'])) { // User saves the payment modification
            global $pp_errors;
            $my_paypalpro->PP_SaveModifyMethod();
            if ((!isset($pp_errors)) || (count($pp_errors) == 0) ){
                header("Location: " . $my_paypalpro->donation_dashboard_url);
            }
        } else if (isset($_REQUEST['cancel_donation_button'])) { // User cancels his recurring donation
            $cancel = trim(stripslashes($_POST['cancel_donation_button']));
            if ($cancel == "Yes") {
                $my_paypalpro->PP_CancelDonation();
            }
        } else if (isset($_REQUEST['save_account'])) { // User saves his account changes
            global $new_username, $new_email;
            global $new_password, $new_password_confirm;
            $new_username = $_REQUEST['new_username'];
            $new_email = $_REQUEST['new_email'];
            $new_password = $_REQUEST['new_password'];
            $new_password_confirm = $_REQUEST['new_password_confirm'];
            $success = $my_anrecurring->EditUser($new_username, $new_email, $new_password, $new_password_confirm);
        }
    }
    
    if(isset($_POST["notify_email"])) {
        global $wpdb; global $responseMessage;
        include_once (dirname(__FILE__) . '/lib/an_generic_functions.php');
        $emailToNotify = strtolower(trim(stripslashes($_POST['notify_email'])));
        
        if (validEmail($emailToNotify)) {
            $row = $wpdb->get_row(
            "SELECT count(email) as emailExists 
            FROM wp_notify_me 
            WHERE email = '$emailToNotify'");        
            if ( (isset($row->emailExists)) && ($row->emailExists > 0)){
                $responseMessage = "<p class='color=red;'>Your email is already in our list, we will notify you when you can create recurring payments with your credit card. Thank you!</p>";
            } else {
                $wpdb->insert("wp_notify_me", 
                array('email' => $emailToNotify, 
                'date' => date("Y-m-d H:i:s")
                ));
                $responseMessage = "<p class='color=green;'>Your email has been added to our list, we will notify you when you can create recurring payments with your credit card. Thank you!</p>";
            }
        }else{
            $responseMessage = "<p class='color=red;'>Please enter a valid email address</p>";
        }
    }

    // Actions
    // http://codex.wordpress.org/Plugin_API/Action_Reference/wp_head
    add_action('wp_head', 'DecideNextStep', 1);
    add_action('ajaxDecideNextStep', 'DecideNextStep', 1);
    
    register_activation_hook(dirname(__FILE__) . "/an-paypal-pro.php", array(&$my_paypalpro, 'Init'));
    add_action('admin_menu', 'PayPalPro_ap');
    add_action('pp_direct_payment_form', 'DoDirectPaymentActivity');
    add_action('pp_choose_payment_form', 'DoChoosePaymentActivity');
    add_action('pp_confirm_payment_form', 'DoConfirmPaymentActivity');
    add_action('pp_login_form', 'DoLoginActivity');
    add_action('pp_register_form', 'DoRegisterActivity');
    add_action('pp_donation_dashboard', 'DoDonationDashboardActivity');
    add_action('pp_modify_donation_amount', 'DoModifyDonationAmountActivity');
    add_action('pp_modify_payment_method', 'DoModifyPaymentMethodActivity');
}
?>