<?php
require_once (dirname(__FILE__) . '/an_generic_functions.php');
require_once(ABSPATH . 'wp-includes/registration.php');

class ANRecurring {
    function FormLogin ()
    {       
        global $login_errors;
?>
<?php
        if (isset($login_errors)) {
        	echo '<div class="account_error">';
            foreach ($login_errors as $error) {
                echo $error.'<br />';
            }
            echo '</div>';
        }
        
        if(isset($_GET['dest'])) {
            $dest = urlencode($_GET['dest']);
        } else if(isset($_POST['dest'])) {
            $dest = $_POST['dest'];
        } else {
            $dest = urlencode($_SERVER['HTTP_REFERER']);
        }
        
        $request_uri = explode("?", $_SERVER['REQUEST_URI']);
        
?>
<div class="loginbox">
<form method='POST' id="login_form" name="login_form"
	action='<?php
        echo $request_uri[0];
        ?>'>
<label>Username</label>
<input type="text" name="user_login" value="" class="textinput" /><br />
<label>Password</label>
<input type="password" name="user_password" value="" class="textinput" /><br />
<input type="submit" name="login" value="Login" class="formsubmit" /><br />
<input type="hidden" name="dest" value="<?php echo $dest ?>" /><br />
</form>
<div class="clearfix"></div>
<a href="/join-the-movement/forgot-your-password">Forgot Your Password?</a>
</div>
<?php
    }

    function FormRegister ()
    {       
        global $register_errors, $register_name, $register_email;
        global $register_password, $register_password_confirm;
?>
<?php
        if($register_errors) {
        	echo '<div class="account_error">';
            foreach ($register_errors as $error) {
                echo $error.'<br />';
            }
            echo '</div>';
        }

        if(isset($_GET['dest'])) {
            $dest = urlencode($_GET['dest']);
        } else if(isset($_POST['dest'])) {
            $dest = $_POST['dest'];
        } else {
            $dest = urlencode($_SERVER['HTTP_REFERER']);
        }
                
        $request_uri = explode("?", $_SERVER['REQUEST_URI']);
?>
<div class="loginbox" id="registerbox">
<form method='POST' id="register_form" name="register_form"
	action='<?php
        echo $request_uri[0];
        ?>'>
<label>Username</label>
<input type="text" name="register_name" value="<?php echo $register_name ?>" class="textinput" /><br />
<label>Email</label>
<input type="text" name="register_email" value="<?php echo $register_email ?>" class="textinput" /><br />
<label>Password</label>
<input type="password" name="register_password" value="<?php echo $register_password ?>" class="textinput" /><br />
<label>Password Confirm</label>
<input type="password" name="register_password_confirm" value="<?php echo $register_password_confirm ?>" class="textinput" /><br />
<p class="fieldsrequired">*All fields required</p>
<input type="submit" name="register" value="Register" class="formsubmit" /><br />
<input type="hidden" name="dest" value="<?php echo $dest ?>" /><br />
</form>
</div>
<?php
    }
    
    
    function ProcessLoginErrors()
    {
        global $login_errors;
        
        $login_errors[] = "Unknown username or wrong password.";
    }
    
    function CreateUser($register_name, $register_email, $register_password, $register_password_confirm)
    {
        global $register_errors;
        
        if ($register_name == "") {
            $register_errors[] = "Please provide an Username";
        }
        
        if ($register_email == "") {
            $register_errors[] = "Please provide an Email";
        }

        if ($register_password == "") {
            $register_errors[] = "Please provide a Password";
        }
        
        if ($register_password_confirm == "") {
            $register_errors[] = "Please confirm Password";
        }
        
        if (count($register_errors) > 0) {
            return false;
        }
        
        if (username_exists($register_name)) {
            $register_errors[] = "Username already exists.";
        }
        
        // check email
        if (!validEmail($register_email)) {
            $register_errors[] = "Please use a valid email address.";
        }
        if (email_exists($register_email)) {
            $register_errors[] = "Email already exists.";
        }
                
        // check password
        if ($register_password != $register_password_confirm) {
            $register_errors[] = "The passwords don't match.";
        }

        if (count($register_errors) > 0) {
            return false;
        } else {
            $register_id = wp_create_user($register_name, $register_password, $register_email );
            if (!$register_id) {
                $register_errors[] = "Unknown problem.";
                return false;
            } else {
                $creds['user_login'] = $register_name;
                $creds['user_password'] = $register_password;
                $creds['remember'] = false;
    
                $user = wp_signon( $creds, false );
            }
        }
        return $user;
    }
    
    function EditUser($register_name, $register_email, $register_password, $register_password_confirm)
    {
        global $wpdb, $register_errors;
        $new_credentials = array();
        $current_user = wp_get_current_user();
        
        $new_credentials['ID'] = $current_user->ID;        
                
        if ( ($register_email != "") && ($register_email != $current_user->user_email) ) {
            // check email
            if (!validEmail($register_email)) {
                $register_errors[] = "Please use a valid email address.";
            } else {
                $new_credentials['user_email'] = $register_email;
            }
        }

        if ($register_password != "") {
            // check password
            if ($register_password != $register_password_confirm) {
                $register_errors[] = "The passwords don't match.";
            } else {
                $new_credentials['user_pass'] = $register_password;
            }
        }

        if ( ($register_name != "") && ($register_name != $current_user->user_login) ) {
            $user_id = username_exists($register_name);
            if ($user_id) {
                $register_errors[] = "Username already exists.";
            } else if (preg_match('/[^0-9A-Za-z\_\-]/',$register_name)) {
                // Check if the new name has other chars than the allowed 0-9A-Za-z\_\-
                $register_errors[] = "Username can only contain alphanumeric and _ - characters";
            } else {
                // uer_login can't be change via wp_update_user, so we have to do it directly
                
                if(count($register_errors) == 0) {
                    $wpdb->query("UPDATE $wpdb->users SET user_login = '$register_name' WHERE ID = '$current_user->ID'");
                }
            }
        }
        
        if (count($register_errors) > 0) {
            return false;
        } else {
            if (count($new_credentials) > 1) {            
                $register_id = wp_update_user($new_credentials) ;
            
                if (!$register_id) {
                    $register_errors[] = "Unknown problem.";
                    return false;
                }
            }
        }
        return true;
    }
    
    function SendNewPassword($from) {
        global $wpdb, $errormsg, $successmsg;
        $errormsg = array();
        $successmsg = array();
        
        $email = $_REQUEST['email'];
        if (!validEmail($email)) {   
            $errormsg[] = "Please provide a valid email address.";
            return;
        }
        
        $row = $wpdb->get_row("
        	SELECT ID, user_login
        	FROM " . $wpdb->prefix . "users 
        	WHERE user_email = '$email'");
        
        if ( (isset($row->user_login)) && ($row->user_login != "")){
        } else {
            $errormsg[] = "Email address doesn't match our records.";
            return;
        }
        
        $newPassword = substr(md5("MehtXweut" . date("D M j G:i:s T Y")), 2, 8);
        $new_credentials['ID'] = $row->ID;
        $new_credentials['user_pass'] = $newPassword;
        
        $subject = "New Password";
        $message = "Username: ".$row->user_login." \n";
        $message .= "Password: ".$newPassword."\n";
        $message = wordwrap($message, 70);
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/plain; charset=utf-8\r\n";
        $headers .= "Content-Transfer-Encoding: quoted-printable\r\n";
        $headers .= "From: " . $from . "\r\n";
        $headers .= "Return-Path: " . $from . "\r\n";
        $success = mail($email, $subject, $message, $headers);
        if($success) {
            wp_update_user($new_credentials);
            $successmsg[] = "<p>E-Mail has been sent.</p>";
        } else {
            $successmsg[] = "<p>Error sending E-Mail.</p>";
        }
        
    }    
}
?>