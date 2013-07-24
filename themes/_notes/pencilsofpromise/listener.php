<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 Template Name: Listener
*/
?> <?php

define("SOAP_CLIENT_BASEDIR", "soapclient");
$USERNAME='database@pencilsofpromise.org.develop2';
$PASSWORD='pop12345025rUqepBGEmXObS6oWayBztE';
require_once (SOAP_CLIENT_BASEDIR.'/SforcePartnerClient.php');
require_once (SOAP_CLIENT_BASEDIR.'/SforceHeaderOptions.php');

$query = "SELECT Id, FirstName, LastName from Contact";


try {
	$mySforceConnection = new SforcePartnerClient();
	$mySoapClient = $mySforceConnection->createConnection(SOAP_CLIENT_BASEDIR.'/wfoutbound.jsp.xml');
	$mylogin = $mySforceConnection->login($USERNAME, $PASSWORD);
	//print_r($mySforceConnection->getUserInfo());
	//print_r($mylogin->userInfo);
	//echo "***** Get Server Timestamp *****\n";
 	 $response = $mySforceConnection->getServerTimestamp();
	//print_r($response);
 	//print_r($mySforceConnection->describeSObject('User'));  
  	$result = $mySforceConnection->query($query);
  	//print_r($result);
} catch (Exception $e) {
	print_r($e);
}

//set this so your wsdl is not cached
ini_set("soap.wsdl_cache_enabled", "0");

//set this to receive the message from Salesforce
$data = fopen('php://input', 'rb');

//this gets the data and puts it into XML
$content = stream_get_contents($data);

//mail yourself the message to see what it looks like
mail('lposen@pencilsofpromise.org', 'Salesforce outbound data', $content);

//checks to see if you have received a good message from Salesforce
//and then sends a true or false back to Salesforce to clear out the 
//outbound message from the que
if ($content)
{
    respond('true');
}
else
{
    respond('false');
}


//function to respond to salesforce using the soap formatted message below
function respond($tf)
{

    print '<?xml version = "1.0" encoding = "utf-8"?>
   <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
       <soapenv:Body>
           <notifications xmlns="http://soap.sforce.com/2005/09/outbound">
               <Ack>' . $tf . '</Ack>
              </notifications>
          </soapenv:Body>
      </soapenv:Envelope>';
}

?>