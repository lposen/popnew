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
//Get the Platform Options
$platform_options = get_option( 'pop_platform_options' );
?>

<?php
//Initiate the Platform Connection
define("USERNAME", $platform_options['platform_sf_un']);
define("PASSWORD", $platform_options['platform_sf_pw']);
define("SECURITY_TOKEN", $platform_options['platform_sf_api']);
require_once ('soapclient/SforcePartnerClient.php');
$mySforceConnection = new SforcePartnerClient();
$mySforceConnection->createConnection("soapclient/partner.wsdl.xml");
$mySforceConnection->login(USERNAME, PASSWORD.SECURITY_TOKEN);
?>

<?php
//------CLUB SECTION-----------------------------------------------------//
if ($_GET["clubname"]) { //we are making a club
    $objectId;
    $sObject = new sObject();
    $sObject->fields = array('Name' => stripslashes($_GET["clubname"]),'Description__c' => stripslashes($_GET["clubdescription"]),'Location__c' => stripslashes($_GET["clublocation"]),'School_Company_Affiliation__c' => stripslashes($_GET["clubaffiliation"]),'Photo_URL__c' => stripslashes($_GET["clubphoto"]),'Video_URL__c' => stripslashes($_GET["clubvideo"]));    
    $sObject->type = 'Group__c';
    if ($_GET["clubid"]) { //we are updating not creating so set the id
        $sObject->Id=($_GET["clubid"]);
        $objectId=$_GET["clubid"];
    }
    try {
        if ($_GET["clubid"]) {
            $results = $mySforceConnection->update(array($sObject));
        }
        else {
            $results = $mySforceConnection->create(array($sObject)); 
        }
        foreach ($results as $i => $result) {
            echo "Record created/updated with id " . $result->id . "<br/>\n";
            $objectId=$result->id;
            if (!($_GET["clubid"])) { //it a new record so we need to create the admin association
                $aObject = new sObject();
                $aObject->fields = array('Group__c' => ($result->id),'Contact__c' => stripslashes($_GET["clubadmin"]));
                $aObject->type = 'Group_Admin__c';
                $results = $mySforceConnection->create(array($aObject));
                foreach ($results as $i => $result) {
                    echo "Record created/updated with id " . $result->id . "<br/>\n";
                }
            }
        }
        header ('Location: clubs/manage?cid='.$objectId);
    }
    catch (exception $e) {
        echo 'fail:' . $e ;  
    }
}
else if ($_GET["clubinvitees"]) { //we are adding club members
    $temp = str_replace(" ", ":", stripslashes($_GET["clubinvitees"]));
    $temp = str_replace(",", ":", $temp);
    $temparray = explode(":", $temp);
    foreach ($temparray as &$value) {
        if ($value && strpos($value,'@') && strpos($value,'.')) {
            echo $value.'<br/>';
            //make a basic contact record and associate it with the club
            //ADD check for existing user with that email
            $sObject = new sObject();
            $sObject->fields = array('Email' => $value, LastName => "Platform Anonymous");
            $sObject->type = 'Contact';
            try {            
                $results = $mySforceConnection->create(array($sObject));
                foreach ($results as $i => $result) {
                    echo "Record created/updated with id " . $result->id . "<br/>\n";
                    $aObject = new sObject();
                    $aObject->fields = array('Group__c' => $_GET["clubid"],'Contact__c' => $result->id);
                    $aObject->type = 'Group_Member__c';
                    $results = $mySforceConnection->create(array($aObject));
                    foreach ($results as $i => $result) {
                        echo "Record created/updated with id " . $result->id . "<br/>\n";                  
                    }
                    //ADD send the notification email
                    //mail($value,"Test Subject","You've been invited to join a club.","From: info@pencilsofpromise.org"); //a very simple send
                    header ('Location: clubs/manage?cid='.$_GET["clubid"]);
                }
            }
            catch (exception $e) {
                echo 'fail:' . $e ;  
            }
        }
    }
}
else if ($_GET["clubremove"]) { //we are removing a club member or admin
    $deleteid;
    $query = "SELECT id FROM ".$_GET["clubremovetype"]." WHERE Group__c = '".$_GET["clubid"]."' AND Contact__c = '".$_GET["clubcontact"]."' LIMIT 1";
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
        header ('Location: clubs/manage?cid='.$_GET["clubid"]);        
    }
    catch (exception $e) {
        echo 'fail:' . $e ;
    }    
}
else if ($_GET["clubpromote"] || $_GET["clubdemote"]) { //we are promoting or demoting a club member
    $deleteid;
    if ($_GET["clubpromote"]) {
        $query = "SELECT id FROM Group_Member__c WHERE Group__c = '".$_GET["clubid"]."' AND Contact__c = '".$_GET["clubcontact"]."' LIMIT 1";
    }
    else {
        $query = "SELECT id FROM Group_Admin__c WHERE Group__c = '".$_GET["clubid"]."' AND Contact__c = '".$_GET["clubcontact"]."' LIMIT 1";
    }
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
        $aObject = new sObject();
        $aObject->fields = array('Group__c' => $_GET["clubid"],'Contact__c' => $_GET["clubcontact"]);
        if ($_GET["clubpromote"]) {
            $aObject->type = 'Group_Admin__c';
        }
        else {
            $aObject->type = 'Group_Member__c';
        }
        $results = $mySforceConnection->create(array($aObject));
        foreach ($results as $i => $result) {
            echo "Record created/updated with id " . $result->id . "<br/>\n";
            header ('Location: clubs/manage?cid='.$_GET["clubid"]);
        }
    }
    catch (exception $e) {
        echo 'fail:' . $e ;
    }
}
//------FUNDRAISER SECTION-----------------------------------------------------//
else if ($_GET["fundname"]) { //we are making a fundraiser
    $objectId;
    $sObject = new sObject();
    if ($_GET["fundclub"]) {
        $sObject->fields = array('Name' => stripslashes($_GET["fundname"]),'Description__c' => stripslashes($_GET["funddescription"]),'Video_URL__c' => stripslashes($_GET["fundvideo"]),'Photo_URL__c' => stripslashes($_GET["fundphoto"]),'Goal__c' => stripslashes($_GET["fundgoal"]),'Type__c' => stripslashes($_GET["fundtype"]),'Impact__c' => stripslashes($_GET["fundimpact"]),'isClub__c' => 'true');
    }
    else {
        $sObject->fields = array('Name' => stripslashes($_GET["fundname"]),'Description__c' => stripslashes($_GET["funddescription"]),'Video_URL__c' => stripslashes($_GET["fundvideo"]),'Photo_URL__c' => stripslashes($_GET["fundphoto"]),'Goal__c' => stripslashes($_GET["fundgoal"]),'Type__c' => stripslashes($_GET["fundtype"]),'Impact__c' => stripslashes($_GET["fundimpact"]));   
    }
    $sObject->type = 'Fundraiser__c';
    if ($_GET["fundid"]) { //we are updating not creating so set the id
        $sObject->Id=($_GET["fundid"]);
        $objectId=$_GET["fundid"];
    }    
    try {
        if ($_GET["fundid"]) {
            $results = $mySforceConnection->update(array($sObject));
        }
        else {
            $results = $mySforceConnection->create(array($sObject)); 
        }
        foreach ($results as $i => $result) {
            echo "Record created with id " . $result->id . "<br/>\n";
            $objectId=$result->id;
            //success so add association to club or contact
            if (!($_GET["fundid"])) { //only create associations if it's a new record
                if ($_GET["fundcontact"]) {
                    $aObject = new sObject();
                    $aObject->fields = array('Fundraiser__c' => ($result->id),'Contact__c' => stripslashes($_GET["fundcontact"]));
                    $aObject->type = 'Contact_Fundraiser__c';
                    $results = $mySforceConnection->create(array($aObject));
                    foreach ($results as $i => $result) {
                        echo "Record created with id " . $result->id . "<br/>\n";    
                    }
                    header ('Location: fundraise/fundraiser?fid='.$objectId);
                }
                else if ($_GET["fundclub"]) {
                    $aObject = new sObject();
                    $aObject->fields = array('Fundraiser__c' => ($result->id),'Group__c' => stripslashes($_GET["fundclub"]));
                    $aObject->type = 'Group_Fundraiser__c';
                    $results = $mySforceConnection->create(array($aObject));
                    foreach ($results as $i => $result) {
                        echo "Record created with id " . $result->id . "<br/>\n";    
                    }
                    header ('Location: fundraise/fundraiser?fid='.$objectId);
                }
            }
            else {
                header ('Location: fundraise/fundraiser?fid='.$objectId);
            }
        }
    }
    catch (exception $e) {
        echo 'fail:' . $e ;  
    } 
}
?>
