<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Salesforce Testing Process
*/
?>

<?php

define("USERNAME", "database@pencilsofpromise.org.developbox");
define("PASSWORD", "12345PoP");
define("SECURITY_TOKEN", "OrNHntKSnvpodypgMY1N9425");
require_once ('soapclient/SforcePartnerClient.php');
$mySforceConnection = new SforcePartnerClient();
$mySforceConnection->createConnection("soapclient/partner.wsdl.xml");
$mySforceConnection->login(USERNAME, PASSWORD.SECURITY_TOKEN);

//------CLUB SECTION-----------------------------------------------------//
if ($_GET["clubname"]) { //we are making a club
    $objectId;
    $sObject = new sObject();
    $sObject->fields = array('Name' => stripslashes($_GET["clubname"]),'Description__c' => stripslashes($_GET["clubdescription"]),'Location__c' => stripslashes($_GET["clublocation"]),'School_Company_Affiliation__c' => stripslashes($_GET["clubaffiliation"]),'Photo_URL__c' => stripslashes($_GET["clubphoto"]),'Video_URL__c' => stripslashes($_GET["clubvideo"]));    
    $sObject->type = 'PoP_Club__c';
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
            if (!($_GET["clubid"])) { //it a new record so we need to create the admin association
                $aObject = new sObject();
                $aObject->fields = array('PoP_Club__c' => ($result->id),'Contact__c' => stripslashes($_GET["clubadmin"]));
                $aObject->type = 'Club_Admin__c';
                $results = $mySforceConnection->create(array($aObject));
                foreach ($results as $i => $result) {
                    echo "Record created/updated with id " . $result->id . "<br/>\n";
                    $objectId=$result->id;
                }
            }
        }
        header ('Location: club-manage?cid='.$objectId);
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
            $sObject->fields = array('Email' => $value, LastName => "Anonymous");
            $sObject->type = 'Contact';
            try {            
                $results = $mySforceConnection->create(array($sObject));
                foreach ($results as $i => $result) {
                    echo "Record created/updated with id " . $result->id . "<br/>\n";
                    $aObject = new sObject();
                    $aObject->fields = array('PoP_Club__c' => $_GET["clubid"],'Contact__c' => $result->id);
                    $aObject->type = 'Club_Member__c';
                    $results = $mySforceConnection->create(array($aObject));
                    foreach ($results as $i => $result) {
                        echo "Record created/updated with id " . $result->id . "<br/>\n";                  
                    }
                    //ADD send the notification email
                    //mail($value,"Test Subject","You've been invited to join a club.","From: info@pencilsofpromise.org"); //a very simple send
                    header ('Location: club-manage?cid='.$_GET["clubid"]);
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
    $query = "SELECT id FROM ".$_GET["clubremovetype"]." WHERE PoP_Club__c = '".$_GET["clubid"]."' AND Contact__c = '".$_GET["clubcontact"]."' LIMIT 1";
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
        header ('Location: club-manage?cid='.$_GET["clubid"]);        
    }
    catch (exception $e) {
        echo 'fail:' . $e ;
    }    
}
else if ($_GET["clubpromote"] || $_GET["clubdemote"]) { //we are promoting or demoting a club member
    $deleteid;
    if ($_GET["clubpromote"]) {
        $query = "SELECT id FROM Club_Member__c WHERE PoP_Club__c = '".$_GET["clubid"]."' AND Contact__c = '".$_GET["clubcontact"]."' LIMIT 1";
    }
    else {
        $query = "SELECT id FROM Club_Admin__c WHERE PoP_Club__c = '".$_GET["clubid"]."' AND Contact__c = '".$_GET["clubcontact"]."' LIMIT 1";
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
        $aObject->fields = array('PoP_Club__c' => $_GET["clubid"],'Contact__c' => $_GET["clubcontact"]);
        if ($_GET["clubpromote"]) {
            $aObject->type = 'Club_Admin__c';
        }
        else {
            $aObject->type = 'Club_Member__c';
        }
        $results = $mySforceConnection->create(array($aObject));
        foreach ($results as $i => $result) {
            echo "Record created/updated with id " . $result->id . "<br/>\n";
            header ('Location: club-manage?cid='.$_GET["clubid"]);
        }
    }
    catch (exception $e) {
        echo 'fail:' . $e ;
    }
}
//------FUNDRAISER SECTION-----------------------------------------------------//
else if ($_GET["fundname"]) { //we are making a fundraiser
    $sObject = new sObject();
    $sObject->fields = array('Name' => stripslashes($_GET["fundname"]),'Description__c' => stripslashes($_GET["funddescription"]));    
    $sObject->type = 'Fundraiser__c';
    try {
        $results = $mySforceConnection->create(array($sObject)); 
        foreach ($results as $i => $result) {
            echo "Record created with id " . $result->id . "<br/>\n";
            //success so add association to club or contact
            if ($_GET["fundcontact"]) {
                $aObject = new sObject();
                $aObject->fields = array('Fundraiser__c' => ($result->id),'Contact__c' => stripslashes($_GET["fundcontact"]));
                $aObject->type = 'Contact_Fundraiser__c';
                $results = $mySforceConnection->create(array($aObject));
                foreach ($results as $i => $result) {
                    echo "Record created with id " . $result->id . "<br/>\n";    
                }
            }
            else if ($_GET["fundclub"]) {
                $aObject = new sObject();
                $aObject->fields = array('Fundraiser__c' => ($result->id),'PoP_Club__c' => stripslashes($_GET["fundclub"]));
                $aObject->type = 'Club_Fundraiser__c';
                $results = $mySforceConnection->create(array($aObject));
                foreach ($results as $i => $result) {
                    echo "Record created with id " . $result->id . "<br/>\n";    
                }             
            }
        }
        header ("location: club-test");  
    }
    catch (exception $e) {
        echo 'fail:' . $e ;  
    } 
}
?>
