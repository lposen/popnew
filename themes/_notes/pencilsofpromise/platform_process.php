<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Platform Process
*/
?>

<?php
session_start();
try { //page error handling
//platform init
$mySforceConnection = doSalesforceConnect();
$loginId;$groupId;$fundId;$contactId;
$loginId = doPlatformLogin($current_user,$mySforceConnection);
$groupId = $_REQUEST["g"];
$fundId = $_REQUEST["f"];
$contactId=$_REQUEST["u"];
$marketing=$_REQUEST["m"];
?>

<?php
if ($_POST["platform_user_login"]) { //we are logging in the user
    require_once('wp-includes/registration.php');
    require('wp-blog-header.php');

    $creds = array();
    $creds['user_login'] = $_REQUEST['platform_user_login'];
    $creds['user_password'] = $_REQUEST['platform_user_password'];

    $user = wp_signon( $creds, false );
    if ( is_wp_error($user) ) {
       header("Location: login?e=1&dest=".$_REQUEST['dest']);
    } else {
        if ($user->ID > 0) {
            if ( (isset($_REQUEST['dest'])) && ($_REQUEST['dest'] != "") ) {
                echo $_REQUEST['dest'];
                header("Location: " . urldecode($_REQUEST['dest']));
                exit;                
            }            
            else {
                header("Location: userprofile");
                exit;  
            }
        }
    }    
}
else if ($_REQUEST["fb_connect"]) { //we are doing a facebook connect login or signup
    require_once("facebook/facebook.php");
    $config = array();
    $config['appId'] = '449055625110934';
    $config['secret'] = 'd937c67ed75da9af78af22d031710050';
    $config['fileUpload'] = false; // optional
    $facebook = new Facebook($config);    
    $user = $facebook->getUser();
    if ($user) { //this is not a trick (valid facebook session)
        $userInfo = $facebook->api('/me');
        $fb_first_name = $userInfo['first_name'];    
        $fb_last_name = $userInfo['last_name'];
        $fb_email = $userInfo['email'];
        $fb_name = $userInfo['email'];  
        $fb_id = $user;
        $fb_bdate;$fb_gender;
        //try to get the birthday too
        try {
            $fql    =   "select sex, birthday_date from user where uid=" . $user;
            $param  =   array(
                'method'    => 'fql.query',
                'query'     => $fql,
                'callback'  => ''
            );
            $fqlResult   =   $facebook->api($param);
            foreach($fqlResult as $result) {
              $fb_bdate = $result['birthday_date'];
              $fb_gender = $result['sex'];
            }   
        }
        catch(Exception $o){
            //nothing
        }        
        if ($fb_bdate) {
            if (strrpos($fb_bdate,'/')==5) {
                $register_birthday_day=intval(substr($fb_bdate,0,2));  
                $register_birthday_month=intval(substr($fb_bdate,3,2)); 
                $register_birthday_year=intval(substr($fb_bdate,6,4)); 
                $fb_bdate = gmdate("Y-m-d\TH:i:s\Z",mktime(0, 0, 0, $register_birthday_day, $register_birthday_month, $register_birthday_year));
            }
        }
        if (username_exists($fb_name)) { //logging in
            //do some special validation here    
            $creds = array();
            $creds['user_login'] = $fb_email;
            $creds['user_password'] = ''; 
            add_filter('authenticate','forceLogin',0,3);        
            $user = wp_signon( $creds, false );        
            remove_filter('authenticate','forceLogin',0,3);       
            if ( is_wp_error($user) ) {
               header("Location: login?e=2");
               exit;
            } else {
                if ($user->ID > 0) {
                    if ( (isset($_REQUEST['p'])) && ($_REQUEST['p'] != "") ) {
                        header("Location: " . urldecode($_REQUEST['p']));
                        exit;                
                    }
                    header("Location: userprofile");
                    exit;                
                }
            }
        }
        else if (email_exists($fb_name)) { //email exists but not as a pkatform user (tough to remedy)
            header("Location: signup?e=".urlencode('This email address is already registered under a different username and cannot be used with Facebook Connect.'));   
        }
        else { //signing up
            $register_id = wp_insert_user( array ('user_login' => $fb_email, 'user_pass' => 'no_direct_login', 'user_email' => $fb_email, 'first_name' => $fb_first_name, 'last_name' => $fb_last_name) ) ;
            if ($register_id) {
                $referrer = $_REQUEST['l'];
                $exists = false;
                $didPhoto = false;
                $objectId;
                $userphotopath='';
                $hasPhoto=false;
                $query = "SELECT id,Photo_URL__c FROM Contact WHERE Email = '".$fb_email."' LIMIT 1";
                $response = $mySforceConnection->query($query);
                foreach ($response->records as $record) {
                    $exists=true;
                    if ($record->fields->Photo_URL__c!='') {
                        $hasPhoto=true;
                    }
                    $objectId = $record->Id;
                    echo 'id='.$objectId;
                }             
                $sObject = new sObject();
                if ($fb_bdate) {
                    $sObject->fields = array('Email' => $fb_email, 'FirstName' => mysql_real_escape_string(htmlspecialchars(strip_tags($fb_first_name))), 'LastName' => mysql_real_escape_string(htmlspecialchars(strip_tags($fb_last_name))), 'Birthdate' => $fb_bdate, 'Photo_URL__c' => $userphotopath, 'Referrer__c' => $referrer, 'Platform_User__c' => 'true', 'Marketing_Campaign__c' =>$marketing);
                }
                else {
                    $sObject->fields = array('Email' => $fb_email, 'FirstName' => mysql_real_escape_string(htmlspecialchars(strip_tags($fb_first_name))), 'LastName' => mysql_real_escape_string(htmlspecialchars(strip_tags($fb_last_name))),'Photo_URL__c' => $userphotopath, 'Referrer__c' => $referrer, 'Platform_User__c' => 'true', 'Marketing_Campaign__c' =>$marketing);
                }
                $sObject->type = 'Contact';        
                if (!$exists) {
                    $results = $mySforceConnection->create(array($sObject));
                    foreach ($results as $i => $result) {
                        $objectId = $result->id;
                        echo 'id='.$objectId;
                    }            
                }
                else {
                    $sObject->Id = $objectId;
                    $results = $mySforceConnection->update(array($sObject));
                    foreach ($results as $i => $result) {
                        echo 'id='.$objectId;
                    }            
                }
                //do the photo
                if (!$hasPhoto) {
                    include 'js/ajax-uploader/server/WideImage/WideImage.php';
                    $img = file_get_contents('https://graph.facebook.com/'.$fb_id.'/picture?type=large');
                    $userphotopath = 'wp-content/uploads-platform/profiles/'.$objectId. '.jpg';
                    file_put_contents($userphotopath, $img);
                    WideImage::load($userphotopath)->resize(null, 200, 'inside', 'any')->crop('center', 'center', 200, 200)->saveToFile($userphotopath);
                    $userphotopath = "/" . $userphotopath;
                    $bObject = new sObject();
                    $bObject->Id=$objectId;
                    $bObject->type = 'Contact';            
                    $bObject->fields = array('Photo_URL__c' => $userphotopath);
                    $results = $mySforceConnection->update(array($bObject)); 
                    foreach ($results as $i => $result) {
                        echo $result->id . "<br/>\n";
                        $didPhoto = true;    
                    } 
                }
                $creds['user_login'] = $fb_name;
                $creds['user_password'] = 'no_direct_login';
                $creds['remember'] = false;
                $user = wp_signon( $creds, false );
                update_usermeta($user->ID, 'userSalesforce', $objectId);
                $message;
                $subject = "Welcome to SchoolBuilder!";
                if ($marketing) { //if its a special campaing get the message from the pod
                    $assets = new Pod('ipromise_campaign');
                    $assets->findRecords('t.name ASC', -1, 't.salesforce_identifier LIKE "'.$marketing.'"');
                    while($assets->fetchRecord()) {
                        $message = $assets->get_field('welcome_email');
                        $subject = "Welcome to " . $assets->get_field('name') . "!";
                    }                  
                }
                if (!$message) {
                    $platform_options = get_option('pop_platform_options');
                    $message = $platform_options['platform_email_welcome'];                 
                }
                $message = str_ireplace("|welcomelink|", site_url('', 'http') . "/fundraise", $message);
                $message = wordwrap($message, 70);
                $headers = "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/plain; charset=utf-8\r\n";
                $headers .= "From: info@pencilsofpromise.org\r\n";
                $headers .= "Return-Path: info@pencilsofpromise.org\r\n";              
                mail($fb_email, $subject, $message, $headers);
                if ($didPhoto) {
                    update_user_meta($register_id, 'userPlatformPhoto', $userphotopath);
                }
                header("Location: /usermanage");
                exit;
            }
            else {
              header("Location: login?e=4");  
            }
        }
    }
    else {
        header("Location: login?e=5");
    }
}
else if ($_REQUEST["platform_register_email"] || $_REQUEST["usermanage"]) { //we are signing up a non-facebook user or editing any users account info
    require_once('wp-includes/registration.php');
    require('wp-blog-header.php');
    $error;
    $register_first_name = $_REQUEST['platform_register_first_name'];    
    $register_last_name = $_REQUEST['platform_register_last_name'];
    $register_email = $_REQUEST['platform_register_email'];
    $register_name = $_REQUEST['platform_register_email'];
    $register_birthday_day = $_REQUEST['platform_register_birthday_day'];    
    $register_birthday_month = $_REQUEST['platform_register_birthday_month'];
    $register_birthday_year = $_REQUEST['platform_register_birthday_year'];       
    $register_zip = $_REQUEST['platform_register_zip'];  
    $register_password = $_REQUEST['platform_register_password'];
    $register_password_confirm = $_REQUEST['platform_register_password_confirm'];
    $register_description = $_REQUEST['platform_register_description'];
    $register_status = $_REQUEST['platform_register_status'];
    $register_referrer = $_REQUEST['referrer'];
    $campaign_name=$_REQUEST["c"];
    $DOB = null;
    if (is_int(intval($register_birthday_day)) && is_int(intval($register_birthday_month)) && is_int(intval($register_birthday_year))) {
        $DOB=gmdate("Y-m-d\TH:i:s\Z",mktime(0, 0, 0, $register_birthday_day, $register_birthday_month, $register_birthday_year));    
    }    
    if (!isset($_REQUEST["usermanage"])) {
        $_SESSION['register_vars']['platform_register_first_name'] = $register_first_name;    
        $_SESSION['register_vars']['platform_register_last_name'] = $register_last_name; 
        $_SESSION['register_vars']['platform_register_email'] = $register_email; 
        $_SESSION['register_vars']['platform_register_birthday_day'] = $register_birthday_day; 
        $_SESSION['register_vars']['platform_register_birthday_month'] = $register_birthday_month; 
        $_SESSION['register_vars']['platform_register_birthday_year'] = $register_birthday_year; 
        $_SESSION['register_vars']['platform_register_zip'] = $register_zip;     
        if (username_exists($register_name)) {
            $error = "Username already exists.";
        }
        else if (!validEmail($register_email)) {
            $error = "Please use a valid email address.";
        }
        else if (email_exists($register_email)) {
            $error = "Email already exists.";
        } 
        if ($DOB) {
            //validate age
            $age_requirement = 13;
            $bdate = strtotime($register_birthday_year.'-'.$register_birthday_month.'-'.$register_birthday_day);
            $difference = floor((time() - $bdate)/(60*60*24*365));
            if ($difference < $age_requirement) { 
                $error = "You must be at least 13 years of age to create an SchoolBuilder account";
            }
        }
        else {
            //need to validate age
            $error = "You must be at least 13 years of age to create an SchoolBuilder account";
            //$sObject->fields = array('Email' => mysql_real_escape_string(htmlspecialchars(strip_tags(stripslashes($register_email)))), 'FirstName' => mysql_real_escape_string(htmlspecialchars(strip_tags(stripslashes($register_first_name)))), 'LastName' => mysql_real_escape_string(htmlspecialchars(strip_tags(stripslashes($register_last_name)))),'Photo_URL__c' => $userphotopath, 'Description__c' => mysql_real_escape_string(htmlspecialchars(strip_tags(stripslashes($register_description)))), 'Referrer__c' => $register_referrer, 'Status__c' => mysql_real_escape_string(htmlspecialchars(strip_tags(stripslashes($register_status)))), 'MailingPostalCode' => mysql_real_escape_string(htmlspecialchars(strip_tags(stripslashes($register_zip)))), 'Platform_User__c' => 'true', 'Marketing_Campaign__c' =>$marketing);
        }        
    }
    if ($error) {
        if (isset($_REQUEST["usermanage"])) {        
            header("Location: usermanage?e=".urlencode($error));
        }
        else {
            header("Location: signup?m=".$marketing."&c=".$campaign_name."&e=".urlencode($error));
        }
        exit;
    }
    if (isset($_REQUEST["usermanage"])) { 
        $current_user = wp_get_current_user();  
        if ($register_password) {
            $register_id = wp_update_user( array ('ID' => $current_user->ID, 'user_pass' => $register_password, 'first_name' => $register_first_name, 'last_name' => $register_last_name) ) ;  
        }
        else {
            $register_id = wp_update_user( array ('ID' => $current_user->ID, 'first_name' => $register_first_name, 'last_name' => $register_last_name) ) ;    
        }
    }
    else {
        $register_id = wp_insert_user( array ('user_login' => $register_email, 'user_pass' => $register_password, 'user_email' => $register_email, 'first_name' => $register_first_name, 'last_name' => $register_last_name) ) ;
    }
    if (!$register_id) {
        $error = "An unknown error has occured.";
        if (isset($_REQUEST["usermanage"])) {
            header("Location: usermanage?e=".urlencode($error));            
        }
        else {
            header("Location: signup?m=".$marketing."&c=".$campaign_name."&e=".urlencode($error));            
        }
    } 
    else {    
        $exists = false;
        $didPhoto = false;
        $objectId;
        $userphotopath='';
        if (isset($_REQUEST["usermanage"])) { 
            $objectId = $_REQUEST["userid"];
            if ($_REQUEST["userphoto"]) {
                if (strpos($_REQUEST["userphoto"],'temp'===false)) {
                    $userphotopath = $_REQUEST["userphoto"];
                }
                else {
                    $extension = end(explode('.', $_REQUEST['userphoto']));
                    $newname = 'wp-content/uploads-platform/profiles/'.$_REQUEST["userid"] . '.' . $extension;
                    rename('wp-content/uploads-platform/temp/'.stripslashes($_REQUEST['userphoto']),$newname);
                    $userphotopath = '/'.$newname;                    
                }
                $didPhoto = true;
            }             
            $exists = true;
        }
        else {
            $query = "SELECT Id FROM Contact WHERE Email = '".$register_email."' LIMIT 1";
            $response = $mySforceConnection->query($query);
            foreach ($response->records as $record) {
                $exists=true;
                $objectId = $record->Id;
            }
        }
        $sObject = new sObject();
        $sObject->fields = array('Email' => mysql_real_escape_string(htmlspecialchars(strip_tags(stripslashes($register_email)))), 'FirstName' => mysql_real_escape_string(htmlspecialchars(strip_tags(stripslashes($register_first_name)))), 'LastName' => mysql_real_escape_string(htmlspecialchars(strip_tags(stripslashes($register_last_name)))), 'Birthdate' => $DOB, 'Photo_URL__c' => $userphotopath, 'Description__c' => mysql_real_escape_string(htmlspecialchars(strip_tags(stripslashes($register_description)))), 'Referrer__c' => $register_referrer, 'Status__c' => mysql_real_escape_string(htmlspecialchars(strip_tags(stripslashes($register_status)))), 'MailingPostalCode' => mysql_real_escape_string(htmlspecialchars(strip_tags(stripslashes($register_zip)))), 'Platform_User__c' => 'true', 'Marketing_Campaign__c' =>$marketing);
        $sObject->type = 'Contact';  
        if (!$exists) {
            $results = $mySforceConnection->create(array($sObject));
            foreach ($results as $i => $result) {
                $objectId = $result->id;
                echo 'id='.$objectId;
            }            
        }
        else {
            $sObject->Id = $objectId;
            $results = $mySforceConnection->update(array($sObject));
            foreach ($results as $i => $result) {
                $objectId = $result->id;
                echo 'id='.$objectId;
            }            
        }
        if (!isset($_REQUEST["usermanage"])) { 
            $creds['user_login'] = $register_name;
            $creds['user_password'] = $register_password;
            $creds['remember'] = false;
            $user = wp_signon( $creds, false );
            update_usermeta($user->ID, 'userSalesforce', $objectId);
            $message;
            if ($marketing) { //if its a special campaing get the message from the p od
                $assets = new Pod('ipromise_campaign');
                $assets->findRecords('t.name ASC', -1, 't.salesforce_identifier LIKE "'.$marketing.'"');
                while($assets->fetchRecord()) {
                    $message = $assets->get_field('welcome_email');
                }                  
            }
            if (!$message) {
                $platform_options = get_option('pop_platform_options');
                $message = $platform_options['platform_email_welcome'];                 
            }            
            $message = str_ireplace("|welcomelink|", site_url('', 'http') . "/fundraise", $message);
            $message = wordwrap($message, 70);
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/plain; charset=utf-8\r\n";
            $headers .= "From: info@pencilsofpromise.org\r\n";
            $headers .= "Return-Path: info@pencilsofpromise.org\r\n";              
            mail($register_email, "Welcome to SchoolBuilder!", $message, $headers);
            if ($marketing=="Impossible") {
                mail($register_email, "Welcome to Impossible Ones!", $message, $headers);
                header("Location: /fundraise/manage?m=".$marketing."&c=".$campaign_name);
                exit;
            }
            else {
                header("Location: /usermanage");
            }
          
        }
        else if ($didPhoto) {
            $current_user = wp_get_current_user();
            update_usermeta($current_user->ID, 'userPlatformPhoto', $userphotopath);
        }
        header("Location: /usermanage");
        exit;  
    }
}
else if ($_REQUEST["groupFundChoice"]) { //adding a fundraiser to a group from step 3 of group creation
    $objectId;
    $sObject = new sObject();
    $sObject->type = 'Fundraiser__c';
    $sObject->Id=($_REQUEST["groupFundChoice"]);
    $objectId=$_REQUEST["groupFundChoice"];
    $sObject->fields = array('isClub__c' => 'Personal Campaign Supporting Club');
    try {
        $results = $mySforceConnection->update(array($sObject));
        foreach ($results as $i => $result) {
            $deleteid;
            $query = "SELECT id FROM Group_Fundraiser__c WHERE Fundraiser__c = '".$objectId."' LIMIT 1";
            $response = $mySforceConnection->query($query);
            foreach ($response->records as $record) {
              $deleteid=$record->Id;
              echo $deleteid;
            }; 
            $results = $mySforceConnection->delete(array($deleteid));           
            foreach ($results as $i => $result) {
                echo "Record deleted with id " . $result->id . "<br/>\n";    
            }
            $aObject = new sObject();
            $aObject->fields = array('Fundraiser__c' => ($objectId),'Group__c' => stripslashes($_REQUEST["clubid"]));
            $aObject->type = 'Group_Fundraiser__c';
            $results = $mySforceConnection->create(array($aObject));
            foreach ($results as $i => $result) {
                echo "Record created with id " . $result->id . "<br/>\n";    
            }
            header ('Location: groups/group?g='.stripslashes($_REQUEST["clubid"]).'&r=1');
        }
    }
    catch (exception $e) {
     throw new Exception("Form Processing Exception",0,$e);   
    }     
}
//------GROUP SECTION-----------------------------------------------------//
else if ($_REQUEST["clubdescription"]) { //we are making a group
    $objectId;
    $sObject = new sObject();
    $joinType = 'Open Join';
    if (stripslashes($_REQUEST["clubjointype"])=='Invitation Only') {
        $joinType='Invitation Only';
    }
    $clubphotopath = '';
    $didPhoto = false;
    $sObject->type = 'Group__c';
    if ($_REQUEST["clubid"]) { //we are updating not creating so set the id
        $sObject->Id=($_REQUEST["clubid"]);
        $objectId=$_REQUEST["clubid"];
        if ($_REQUEST["clubphoto"]) {
            $extension = end(explode('.', $_REQUEST['clubphoto']));
            $newname = 'wp-content/uploads-platform/groups/'.$_REQUEST["clubid"] . '.' . $extension;
            rename('wp-content/uploads-platform/temp/'.stripslashes($_REQUEST['clubphoto']),$newname);
            $clubphotopath = '/'.$newname;
            $didPhoto = true;
        }      
    }
    //did the user change the default description at all?
    $platform_options = get_option('pop_platform_options');
    $placeholder = $platform_options['platform_group_copy'];
    $description = stripslashes($_REQUEST["clubdescription"]);
    if ($description == $placeholder) {
      $description="|defaultdescription|";
    }    
    if ($_REQUEST["clubphoto"]) {
        $sObject->fields = array('Name' => mysql_real_escape_string(htmlspecialchars(strip_tags(stripslashes($_REQUEST["clubname"])))),'Description__c' => mysql_real_escape_string(htmlspecialchars(strip_tags($description))),'Status__c' => mysql_real_escape_string(htmlspecialchars(strip_tags(stripslashes($_REQUEST["clubstatus"])))),'Zip_Code__c' => mysql_real_escape_string(htmlspecialchars(strip_tags(stripslashes($_REQUEST["clubzip"])))),'School_Company_Affiliation__c' => mysql_real_escape_string(htmlspecialchars(strip_tags(stripslashes($_REQUEST["clubaffiliation"])))),'Goal__c' => stripslashes($_REQUEST["clubgoal"]),'Photo_URL__c' => $clubphotopath,'Join_Type__c' => $joinType);
    }
    else {
        $sObject->fields = array('Name' => mysql_real_escape_string(htmlspecialchars(strip_tags(stripslashes($_REQUEST["clubname"])))),'Description__c' => stripslashes(mysql_real_escape_string(htmlspecialchars(strip_tags($description)))),'Status__c' => mysql_real_escape_string(htmlspecialchars(strip_tags(stripslashes($_REQUEST["clubstatus"])))),'Zip_Code__c' => mysql_real_escape_string(htmlspecialchars(strip_tags(stripslashes($_REQUEST["clubzip"])))),'School_Company_Affiliation__c' => mysql_real_escape_string(htmlspecialchars(strip_tags(stripslashes($_REQUEST["clubaffiliation"])))),'Goal__c' => stripslashes($_REQUEST["clubgoal"]),'Join_Type__c' => $joinType);
    }
    try {
        if ($_REQUEST["clubid"]) {
            $results = $mySforceConnection->update(array($sObject));
        }
        else {
            $results = $mySforceConnection->create(array($sObject)); 
        }
        foreach ($results as $i => $result) {
            echo "Record created/updated with id " . $result->id . "<br/>\n";
            $objectId=$result->id;
            if (!($_REQUEST["clubid"])) { //it's a new record so we need to create the admin association
                $aObject = new sObject();
                $aObject->fields = array('Group__c' => ($result->id),'Contact__c' => stripslashes($_REQUEST["clubadmin"]),'Admin__c' => 'true','Active__c' => 'true');
                $aObject->type = 'Group_Member__c';
                $results = $mySforceConnection->create(array($aObject));
                foreach ($results as $i => $result) { 
                    echo $result->id . "<br/>\n";
                }
            }
            if (!$didPhoto && $_REQUEST["clubphoto"]) {
                $bObject = new sObject();
                $bObject->Id=$objectId;
                $bObject->type = 'Group__c';
                $extension = end(explode('.', $_REQUEST['clubphoto']));
                $newname = 'wp-content/uploads-platform/groups/'. $objectId . '.' . $extension;
                rename('wp-content/uploads-platform/temp/'.stripslashes($_REQUEST['clubphoto']),$newname);
                $clubphotopath = '/'.$newname;            
                $bObject->fields = array('Photo_URL__c' => $clubphotopath);
                $results = $mySforceConnection->update(array($bObject)); 
                foreach ($results as $i => $result) {
                    echo $result->id . "<br/>\n";
                }
            }            
        }
        header ('Location: groups/manage?g='.$objectId.'&n='.$_REQUEST["next"]);
    }
    catch (exception $e) {
        throw new Exception("Form Processing Exception",0,$e); 
    }
}
else if ($_REQUEST["clubinvitees"]) { //we are adding group members
    $temp = str_replace(" ", ":", stripslashes($_REQUEST["clubinvitees"]));
    $temp = str_replace(",", ":", $temp);
    $temparray = explode(":", $temp);
    $SingleEmailMessages = array();
    if (count($temparray)>=5) {
        array_slice($temparray, 0, 5);   
    }
    foreach ($temparray as &$value) { //for a single email address
        if ($value && strpos($value,'@') && strpos($value,'.')) { //is it valid
            //check for existing user with that email
            $exists = false;
            $emailParameter;
            $query = "SELECT Id FROM Contact WHERE Email = '".$value."' LIMIT 1";
            $response = $mySforceConnection->query($query);
            foreach ($response->records as $record) {
                $exists=true;
                //make an association record for this contact
                $aObject = new sObject();
                $aObject->fields = array('Group__c' => $_REQUEST["clubid"],'Contact__c' => $record->Id);
                $aObject->type = 'Group_Member__c';
                $results = $mySforceConnection->create(array($aObject));
                foreach ($results as $i => $result) { 
                    $emailParameter=$result->id;
                }       
            }
            try {         
                if (!$exists) {
                    //make a basic contact record and associate it with the club
                    $sObject = new sObject();
                    $sObject->fields = array('Email' => $value, LastName => "Platform Anonymous", Referrer__c => $loginId);
                    $sObject->type = 'Contact';       
                    $results = $mySforceConnection->create(array($sObject));
                    foreach ($results as $i => $result) {
                        //make an association record for this contact
                        $aObject = new sObject();
                        $aObject->fields = array('Group__c' => $_REQUEST["clubid"],'Contact__c' => $result->id);
                        $aObject->type = 'Group_Member__c';
                        $results = $mySforceConnection->create(array($aObject));
                        foreach ($results as $i => $result) { 
                            $emailParameter=$result->id;
                        }
                    }
                } else {}
                //compile the email
                $activationLink = site_url('', 'http') . '/activate?a='.$emailParameter.'&g='.$_REQUEST["clubid"];
                $platform_options = get_option('pop_platform_options');
                $message = $platform_options['platform_email_invite'];
                $message = str_ireplace("|activationlink|", $activationLink, $message);
                $message = str_ireplace("|groupname|", stripslashes($_REQUEST["clubname"]), $message);
                $headers = "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/plain; charset=utf-8\r\n";
                $headers .= "From: info@pencilsofpromise.org\r\n";
                $headers .= "Return-Path: info@pencilsofpromise.org\r\n";                
                mail($value, "Pencils of Promise Group Invitation", $message, $headers);
            }
            catch (exception $e) {
                throw new Exception("Form Processing Exception",0,$e);  
            }
        }
    }
    $emailResponse = $mySforceConnection->sendSingleEmail($SingleEmailMessages);
    header ('Location: groups/manage?g='.$_REQUEST["clubid"].'&n='.$_REQUEST["next"]);
}
else if ($_REQUEST["clubremove"]) { //we are removing a group member or admin
    $deleteid;
    $query = "SELECT id FROM Group_Member__c WHERE Group__c = '".$_REQUEST["clubid"]."' AND Contact__c = '".$_REQUEST["clubcontact"]."' LIMIT 1";
    $response = $mySforceConnection->query($query);
    foreach ($response->records as $record) {
      $deleteid=$record->Id;
      echo $deleteid;
    };
    try {    
        $results = $mySforceConnection->delete(array($deleteid));
        foreach ($results as $i => $result) {
            echo "Record deleted with id " . $result->id . "<br/>\n";
        }
        header ('Location: groups/manage?g='.$_REQUEST["clubid"]);        
    }
    catch (exception $e) {
        echo 'fail:' . $e ;
    }    
}
else if ($_REQUEST["clubpromote"] || $_REQUEST["clubdemote"]) { //we are promoting or demoting a club member
    $query = "SELECT id FROM Group_Member__c WHERE Group__c = '".$_REQUEST["clubid"]."' AND Contact__c = '".$_REQUEST["clubcontact"]."' LIMIT 1";
    $response = $mySforceConnection->query($query);
    foreach ($response->records as $record) {
        $assocId=$record->Id;
        try {    
            $sObject->Id=($assocId);
            $sObject->type='Group_Member__c'; 
            if ($_REQUEST["clubpromote"]) {
                $sObject->fields = array('Admin__c' => 'true');
            }
            else {
                $sObject->fields = array('Admin__c' => 'false');
            }
            $results = $mySforceConnection->update(array($sObject));      
            foreach ($results as $i => $result) {
                header('Location: groups/manage?g='.$_REQUEST["clubid"]);
            }
        }
        catch (exception $e) {
            throw new Exception("Form Processing Exception",0,$e); 
        }      
    }
}
else if ($_REQUEST["groupjoin"] || $_REQUEST["groupleave"]) { //we are adding or removing somebody from a group
    if ($_REQUEST["groupleave"]) {
        $query = "SELECT id FROM Group_Member__c WHERE Group__c = '".$groupId."' AND Contact__c = '".$contactId."' LIMIT 1";
        $response = $mySforceConnection->query($query);
        foreach ($response->records as $record) {    
            $results = $mySforceConnection->delete(array($record->Id));
            foreach ($results as $i => $result) {
                header('Location: groups/group?g='.$groupId.'&r=1');
            }
        }
    }
    else if ($_REQUEST["groupjoin"]) {
        $aObject = new sObject();
        $aObject->fields = array('Group__c' => $groupId,'Contact__c' => $contactId,'Active__c' => true);
        $aObject->type = 'Group_Member__c';
        $results = $mySforceConnection->create(array($aObject));
        foreach ($results as $i => $result) { 
            header('Location: groups/group?g='.$groupId.'&r=1');
        }        
    }
}
//------FUNDRAISER SECTION-----------------------------------------------------//
else if ($_REQUEST["fundname"]) { //we are making a fundraising campaign
    $next = $_REQUEST["next"]; //what step are we send the user back to
    $objectId;
    $sObject = new sObject();
    $fundphotopath = '';
    $didPhoto = false;
    $sObject->type = 'Fundraiser__c';
    if ($_REQUEST["fundid"]) { //we are updating not creating so set the id
    	$sObject->Id=($_REQUEST["fundid"]);
        $objectId=$_REQUEST["fundid"];
		
		//handle delete
		if($_REQUEST["fund-action"] == "delete"){
				echo "DELETE <br>";
				//delete from group
				$deleteid;
                $query = "SELECT id FROM Group_Fundraiser__c WHERE Fundraiser__c = '".$objectId."' LIMIT 1";
                $response = $mySforceConnection->query($query);
                foreach ($response->records as $record) {
                  $deleteid=$record->Id;
                  echo $deleteid;
                }; 
                /*$results = $mySforceConnection->delete(array($deleteid));           
                foreach ($results as $i => $result) {
                    echo "Record deleted with id " . $result->id . "<br/>\n";    
                }*/
			
				//delete campaign
				$query = "SELECT Name, Type__c, Impact__c, Description__c, Status__c, Photo_URL__c, Video_URL__c, Goal__c, Total_Raised__c, Marketing_Campaign__c, isClub__c FROM Fundraiser__c WHERE Id = '".$objectId."' LIMIT 1";
    			$response = $mySforceConnection->query($query);
    			var_dump($response);
    			//$results = $mySforceConnection->delete(array($sObject));
				//var_dump($result);
				return;
    	}
		
        if ($_REQUEST["fundphoto"]) {
            $extension = end(explode('.', $_REQUEST['fundphoto']));
            $newname = 'wp-content/uploads-platform/fundraisers/'.$_REQUEST["fundid"] . '.' . $extension;
            rename('wp-content/uploads-platform/temp/'.stripslashes($_REQUEST['fundphoto']),$newname);
            $fundphotopath = '/'.$newname;
            $didPhoto = true;
        }        
    }
    //did the user change the default descriptions at all?
    $platform_options = get_option('pop_platform_options');
    $placeholder = $platform_options['platform_fundraiser_copy'];
    $description = stripslashes($_REQUEST["funddescription"]);
    if ($description == $placeholder) {
      $description="|defaultdescription|";
    }
    if ($_REQUEST["fundGroupChoice"] && $_REQUEST["fundGroupChoice"]!='No') {
        $sObject->fields = array('Name' => mysql_real_escape_string(htmlspecialchars(strip_tags(stripslashes($_REQUEST["fundname"])))),'Description__c' => mysql_real_escape_string(htmlspecialchars(strip_tags($description))),'Video_URL__c' => mysql_real_escape_string(htmlspecialchars(strip_tags(stripslashes($_REQUEST["fundvideo"])))),'Photo_URL__c' => $fundphotopath,'Goal__c' => stripslashes($_REQUEST["fundgoal"]),'Type__c' => stripslashes($_REQUEST["fundtype"]),'isClub__c' => 'Personal Campaign Supporting Club','Marketing_Campaign__c' => $marketing);
    }
    else if ($_REQUEST["fundclub"]) {
        $sObject->fields = array('Name' => mysql_real_escape_string(htmlspecialchars(strip_tags(stripslashes($_REQUEST["fundname"])))),'Description__c' => mysql_real_escape_string(htmlspecialchars(strip_tags($description))),'Video_URL__c' => mysql_real_escape_string(htmlspecialchars(strip_tags(stripslashes($_REQUEST["fundvideo"])))),'Photo_URL__c' => $fundphotopath,'Goal__c' => stripslashes($_REQUEST["fundgoal"]),'Type__c' => stripslashes($_REQUEST["fundtype"]),'isClub__c' => 'Club Campaign','Marketing_Campaign__c' => $marketing);
    }
    else {
        $sObject->fields = array('Name' => mysql_real_escape_string(htmlspecialchars(strip_tags(stripslashes($_REQUEST["fundname"])))),'Description__c' => mysql_real_escape_string(htmlspecialchars(strip_tags($description))),'Video_URL__c' => mysql_real_escape_string(htmlspecialchars(strip_tags(stripslashes($_REQUEST["fundvideo"])))),'Photo_URL__c' => $fundphotopath,'Goal__c' => stripslashes($_REQUEST["fundgoal"]),'Type__c' => stripslashes($_REQUEST["fundtype"]),'isClub__c' => 'No','Marketing_Campaign__c' => $marketing);
    }    
    try {
        if ($_REQUEST["fundid"]) {
            $results = $mySforceConnection->update(array($sObject));
        }
        else {
            $results = $mySforceConnection->create(array($sObject)); 
        }
        foreach ($results as $i => $result) {
            echo "Record created with id " . $result->id . "<br/>\n";
            $objectId=$result->id;
            //success so add association to club or contact
            if (!($_REQUEST["fundid"])) { //only create associations if it's a new record
                if ($_REQUEST["fundcontact"]) {
                    $aObject = new sObject();
                    $aObject->fields = array('Fundraiser__c' => ($objectId),'Contact__c' => stripslashes($_REQUEST["fundcontact"]));
                    $aObject->type = 'Contact_Fundraiser__c';
                    $results = $mySforceConnection->create(array($aObject));
                    foreach ($results as $i => $result) {
                        echo "Record created with id " . $result->id . "<br/>\n";    
                    }
                }
                if ($_REQUEST["fundGroupChoice"] && $_REQUEST["fundGroupChoice"]!='No') {
                    $aObject = new sObject();
                    $aObject->fields = array('Fundraiser__c' => ($objectId),'Group__c' => stripslashes($_REQUEST["fundGroupChoice"]));
                    $aObject->type = 'Group_Fundraiser__c';
                    $results = $mySforceConnection->create(array($aObject));
                    foreach ($results as $i => $result) {
                        echo "Record created with id " . $result->id . "<br/>\n";    
                    }                    
                }
                else if ($_REQUEST["fundclub"]) {
                    $aObject = new sObject();
                    $aObject->fields = array('Fundraiser__c' => ($objectId),'Group__c' => stripslashes($_REQUEST["fundclub"]));
                    $aObject->type = 'Group_Fundraiser__c';
                    $results = $mySforceConnection->create(array($aObject));
                    foreach ($results as $i => $result) {
                        echo "Record created with id " . $result->id . "<br/>\n";    
                    }
                }
                if (!$didPhoto && $_REQUEST["fundphoto"]) {
                    $bObject = new sObject();
                    $bObject->Id=$objectId;
                    $bObject->type = 'Fundraiser__c';
                    $extension = end(explode('.', $_REQUEST['fundphoto']));
                    $newname = 'wp-content/uploads-platform/fundraisers/'. $objectId . '.' . $extension;
                    rename('wp-content/uploads-platform/temp/'.stripslashes($_REQUEST['fundphoto']),$newname);
                    $fundphotopath = '/'.$newname;            
                    $bObject->fields = array('Photo_URL__c' => $fundphotopath);
                    $results = $mySforceConnection->update(array($bObject)); 
                    foreach ($results as $i => $result) {
                        echo $result->id . "<br/>\n";
                    }
                }
                header ('Location: fundraise/fundraiser?f='.$objectId.'&r=1');
            }
            else {
                if ($_REQUEST["fundGroupChoice"]) { //handle the delete
                    $deleteid;
                    $query = "SELECT id FROM Group_Fundraiser__c WHERE Fundraiser__c = '".$objectId."' LIMIT 1";
                    $response = $mySforceConnection->query($query);
                    foreach ($response->records as $record) {
                      $deleteid=$record->Id;
                      echo $deleteid;
                    }; 
                    $results = $mySforceConnection->delete(array($deleteid));           
                    foreach ($results as $i => $result) {
                        echo "Record deleted with id " . $result->id . "<br/>\n";    
                    }                        
                }
                if ($_REQUEST["fundGroupChoice"] && $_REQUEST["fundGroupChoice"]!='No') { //but can change the group association                                    
                    $aObject = new sObject();
                    $aObject->fields = array('Fundraiser__c' => ($objectId),'Group__c' => stripslashes($_REQUEST["fundGroupChoice"]));
                    $aObject->type = 'Group_Fundraiser__c';
                    $results = $mySforceConnection->create(array($aObject));
                    foreach ($results as $i => $result) {
                        echo "Record created with id " . $result->id . "<br/>\n";    
                    }                    
                } 
                if ($next && $next!="") {
                    header ('Location: fundraise/manage?f='.$objectId.'&n='.$next);
                }
                else {
                    header ('Location: fundraise/fundraiser?f='.$objectId.'&r=1');
                }
            }
        }
    }
    catch (exception $e) {
        throw new Exception("Form Processing Exception",0,$e);   
    } 
}

}
catch (Exception $e) {
    echo $e;
      header ('Location: /error?e='.urlencode($e));
    exit;
}

?>
