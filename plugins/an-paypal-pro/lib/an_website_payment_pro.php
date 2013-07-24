<?php

class WebsitePaymentPro
{
    var $Username;
    var $Password;
    var $Signature;
    var $PayPalUrl;
    var $ApiEndpoint;
    var $Version;
    
    function __construct($username, $password, $signature, $payPalUrl, $apiEndpoint){
        $this->Username = $username;
        $this->Password = $password;
        $this->Signature = $signature;
        $this->PayPalUrl = $payPalUrl;
        $this->ApiEndpoint = $apiEndpoint;
        $this->Version = "58";
    }


    /* An express checkout transaction starts with a token, that
      identifies to PayPal your transaction
      In this example, when the script sees a token, the script
      knows that the buyer has already authorized payment through
      paypal.  If no token was found, the action is to send the buyer
      to PayPal to first authorize payment
     */
    /*
      '-------------------------------------------------------------------------------------------------------------------------------------------
      ' Purpose: 	Prepares the parameters for the SetExpressCheckout API Call.
      ' Inputs:
      '		paymentAmount:  	Total value of the shopping cart
      '		currencyCodeType: 	Currency code value the PayPal API
      '		paymentType: 		paymentType has to be one of the following values: Sale or Order or Authorization
      '		returnURL:			the page where buyers return to after they are done with the payment review on PayPal
      '		cancelURL:			the page where buyers return to when they cancel the payment review on PayPal
      '--------------------------------------------------------------------------------------------------------------------------------------------
     */
    function CallShortcutExpressCheckout ($paymentAmount, $currencyCodeType, 
    $returnURL, $cancelURL, $do_as_recurring_payments, $custom)
    {
        //------------------------------------------------------------------------------------------------------------------------------------
        // Construct the parameter string that describes the SetExpressCheckout API call in the shortcut implementation
        $nvpstr = "";
        $nvpstr .= "&RETURNURL=" . $returnURL;
        $nvpstr .= "&CANCELURL=" . $cancelURL;
        $nvpstr .= "&AMT=" . $paymentAmount;
        $nvpstr .= "&CUSTOM=" . $custom;
        if ($do_as_recurring_payments != "") {
            $nvpstr .= "&BILLINGTYPE=" . urlencode("RecurringPayments");
            $nvpstr .= "&BILLINGAGREEMENTDESCRIPTION=" .
             urlencode("Pencils of Promise Recurring Donations");
        } else {
            $nvpstr .= "&CURRENCYCODE=" . $currencyCodeType;
            $nvpstr .= "&PAYMENTACTION=Authorization";
        }
        $_SESSION["currencyCodeType"] = $currencyCodeType;
        
        //'---------------------------------------------------------------------------------------------------------------
        //' Make the API call to PayPal
        //' If the API call succeded, then redirect the buyer to PayPal to begin to authorize payment.
        //' If an error occured, show the resulting errors
        //'---------------------------------------------------------------------------------------------------------------
        $resArray = $this->FetchData("SetExpressCheckout", $nvpstr);
        $ack = strtoupper($resArray["ACK"]);
        if ($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING") {
            $token = urldecode($resArray["TOKEN"]);
            $_SESSION['TOKEN'] = $token;
        }
        return $resArray;
    }

    /*
      '-------------------------------------------------------------------------------------------
      ' Purpose: 	Prepares the parameters for the GetExpressCheckoutDetails API Call.
      '
      ' Inputs:
      '		None
      ' Returns:
      '		The NVP Collection object of the GetExpressCheckoutDetails Call Response.
      '-------------------------------------------------------------------------------------------
     */
    function GetShippingDetails ($token)
    {
        //'--------------------------------------------------------------
        //' At this point, the buyer has completed authorizing the payment
        //' at PayPal.  The function will call PayPal to obtain the details
        //' of the authorization, incuding any shipping information of the
        //' buyer.  Remember, the authorization is not a completed transaction
        //' at this state - the buyer still needs an additional step to finalize
        //' the transaction
        //'--------------------------------------------------------------
        //'---------------------------------------------------------------------------
        //' Build a second API request to PayPal, using the token as the
        //'  ID to get the details on the payment authorization
        //'---------------------------------------------------------------------------
        $nvpstr = "&TOKEN=" . $token;
        //'---------------------------------------------------------------------------
        //' Make the API call and store the results in an array.
        //'	If the call was a success, show the authorization details, and provide
        //' 	an action to complete the payment.
        //'	If failed, show the error
        //'---------------------------------------------------------------------------
        $resArray = $this->FetchData("GetExpressCheckoutDetails", $nvpstr);
        $ack = strtoupper($resArray["ACK"]);
        if ($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING") {
            $_SESSION['PAYERID'] = $resArray['PAYERID'];
        }
        return $resArray;
    }
    function ConfirmPayment ($FinalPaymentAmt)
    {
        /* Gather the information to make the final call to
          finalize the PayPal payment.  The variable nvpstr
          holds the name value pairs
         */
        //Format the other parameters that were stored in the session from the previous calls
        $token = urlencode($_SESSION['TOKEN']);
        $currencyCodeType = urlencode($_SESSION['currencyCodeType']);
        $payerID = urlencode($_SESSION['PAYERID']);
        $serverName = urlencode($_SERVER['SERVER_NAME']);
        $nvpstr = '&TOKEN=' . $token;
        $nvpstr .= '&PAYERID=' . $payerID;
        $nvpstr .= '&PAYMENTACTION=Authorization';
        $nvpstr .= '&AMT=' . $FinalPaymentAmt;
        $nvpstr .= '&CURRENCYCODE=' . $currencyCodeType;
        $nvpstr .= '&IPADDRESS=' . $serverName;
        /* Make the call to PayPal to finalize payment
          If an error occured, show the resulting errors
         */
        $resArray = $this->FetchData("DoExpressCheckoutPayment", $nvpstr);
        return $resArray;
    }
    /*
      '-------------------------------------------------------------------------------------------------------------------------------------------
      ' Purpose: 	This function makes a DoDirectPayment API call
      '
      ' Inputs:
      '		paymentType:		paymentType has to be one of the following values: Sale or Order or Authorization
      '		paymentAmount:  	total value of the shopping cart
      '		currencyCode:	 	currency code value the PayPal API
      '		firstName:			first name as it appears on credit card
      '		lastName:			last name as it appears on credit card
      '		street:				buyer's street address line as it appears on credit card
      '		city:				buyer's city
      '		state:				buyer's state
      '		countryCode:		buyer's country code
      '		zip:				buyer's zip
      '		creditCardType:		buyer's credit card type (i.e. Visa, MasterCard ... )
      '		creditCardNumber:	buyers credit card number without any spaces, dashes or any other characters
      '		expDate:			credit card expiration date
      '		cvv2:				Card Verification Value
      '
      '-------------------------------------------------------------------------------------------
      '
      ' Returns:
      '		The NVP Collection object of the DoDirectPayment Call Response.
      '--------------------------------------------------------------------------------------------------------------------------------------------
     */
    function DirectPayment ($paymentAmount, $creditCardType, 
    $creditCardNumber, $expDate, $cvv2, $email, $firstName, $lastName, $street, $city, 
    $state, $zip, $countryCode, $currencyCode, $description, $custom)
    {
        //Construct the parameter string that describes DoDirectPayment
        $nvpstr = "&AMT=" . $paymentAmount;
        $nvpstr .= "&CURRENCYCODE=" . $currencyCode;
        $nvpstr .= "&PAYMENTACTION=Authorization";
        $nvpstr .= "&CREDITCARDTYPE=" . $creditCardType;
        $nvpstr .= "&ACCT=" . $creditCardNumber;
        $nvpstr .= "&EXPDATE=" . $expDate;
        $nvpstr .= "&CVV2=" . $cvv2;
        $nvpstr .= "&EMAIL=" . $email;
        $nvpstr .= "&FIRSTNAME=" . $firstName;
        $nvpstr .= "&LASTNAME=" . $lastName;
        $nvpstr .= "&STREET=" . $street;
        $nvpstr .= "&CITY=" . $city;
        $nvpstr .= "&ZIP=" . $zip;
        $nvpstr .= "&STATE=" . $state;
        $nvpstr .= "&COUNTRYCODE=" . $countryCode;
        $nvpstr .= "&DESC=" . $description;        
        $nvpstr .= "&CUSTOM=" . $custom;        
        $nvpstr .= "&IPADDRESS=" . $_SERVER['REMOTE_ADDR'];
        $resArray = $this->FetchData("DoDirectPayment", $nvpstr);
        return $resArray;
    }
    
    function RecurringPaymentWithDirectPayment ($paymentAmount, $creditCardType, 
    $creditCardNumber, $expDate, $cvv2, $email, $firstName, $lastName, $street, $city, 
    $state, $zip, $countryCode, $currencyCode, $do_as_recurring_payments, $description, $custom)
    {
        $billingperiod = $do_as_recurring_payments;
        // The profile may take up to 24 hours for activation. So we start billing the next day
        $tomorrow = mktime(date("H"), date("i"), date("s"), date("n"), 
        date("d") + 1, date("Y"));
        //Format for paypal which is like "2009-9-6T0:0:0"
        $profileStartDate = date('Y-n-j', $tomorrow) . "T" .
         date('H:i:s', $tomorrow);
        //Construct the parameter string that describes DoDirectPayment
        $nvpstr .= "&AMT=" . $paymentAmount;
        $nvpstr .= "&CURRENCYCODE=" . $currencyCode;
        $nvpstr .= "&PROFILESTARTDATE=" . $profileStartDate;
        $nvpstr .= "&BILLINGPERIOD=" . urlencode($billingperiod);
        $nvpstr .= "&BILLINGFREQUENCY=1";
        $nvpstr .= "&TOTALBILLINGCYCLES=0";
        $nvpstr .= "&BILLINGTYPE=" . urlencode("RecurringPayments");
        $nvpstr .= "&DESC=" . urlencode("Pencils of Promise Recurring Donations");
        $nvpstr .= "&CREDITCARDTYPE=" . $creditCardType;
        $nvpstr .= "&ACCT=" . $creditCardNumber;
        $nvpstr .= "&EXPDATE=" . $expDate;
        $nvpstr .= "&CVV2=" . $cvv2;
        $nvpstr .= "&EMAIL=" . $email;
        $nvpstr .= "&FIRSTNAME=" . $firstName;
        $nvpstr .= "&LASTNAME=" . $lastName;
        $nvpstr .= "&STREET=" . $street;
        $nvpstr .= "&CITY=" . $city;
        $nvpstr .= "&ZIP=" . $zip;
        $nvpstr .= "&STATE=" . $state;
        $nvpstr .= "&COUNTRYCODE=" . $countryCode;
        $nvpstr .= "&DESC=" . $description;        
        $nvpstr .= "&PROFILEREFERENCE=" . $custom;        
        $resArray = $this->FetchData("CreateRecurringPaymentsProfile", $nvpstr);
        $resArray['PROFILESTARTDATE'] = date("Y-m-d H:i:s", $tomorrow);
        return $resArray;
    }
    
    
    function RecurringPayment ($paymentAmount)
    {
        //Format the other parameters that were stored in the session from the previous calls
        $token = urlencode($_SESSION['TOKEN']);
        $currencyCodeType = urlencode($_SESSION['currencyCodeType']);
        $billingperiod = $_SESSION['do_as_recurring_payments'];
        // The profile may take up to 24 hours for activation. So we start billing the next day
        $tomorrow = mktime(date("H"), date("i"), date("s"), date("n"), 
        date("d") + 1, date("Y"));
        //Format for paypal which is like "2009-9-6T0:0:0"
        $profileStartDate = date('Y-n-j', $tomorrow) . "T" .
         date('H:i:s', $tomorrow);
        //Construct the parameter string that describes DoDirectPayment
        $nvpstr = "&TOKEN=" . $token;
        $nvpstr .= "&AMT=" . $paymentAmount;
        $nvpstr .= "&CURRENCYCODE=" . $currencyCodeType;
        $nvpstr .= "&PROFILESTARTDATE=" . $profileStartDate;
        $nvpstr .= "&BILLINGPERIOD=" . urlencode($billingperiod);
        $nvpstr .= "&BILLINGFREQUENCY=1";
        $nvpstr .= "&TOTALBILLINGCYCLES=0";
        $nvpstr .= "&BILLINGTYPE=" . urlencode("RecurringPayments");
        $nvpstr .= "&DESC=" . urlencode("Pencils of Promise Recurring Donations");
        $resArray = $this->FetchData("CreateRecurringPaymentsProfile", $nvpstr);
        return $resArray;
    }
    
    function ModifyRecurringPaymentAmount ($profileId, $paymentAmount, $currencyCode)
    {
        $nvpstr = "&PROFILEID=" . urlencode($profileId);
        $nvpstr .= "&AMT=" . $paymentAmount;
        $nvpstr .= "&CURRENCYCODE=" . $currencyCode;
        $resArray = $this->FetchData("UpdateRecurringPaymentsProfile", $nvpstr);
        return $resArray;
    }
    
    function UpdateRecurringPaymentsProfile ($profileId, $creditCardType, 
    $creditCardNumber, $expDate, $cvv2, $email, $firstName, $lastName, $street, $city, 
    $state, $zip, $countryCode, $ccDataChanged) {
            
        $nvpstr .= "&PROFILEID=" . $profileId;
        if ($ccDataChanged) {
            $nvpstr .= "&CREDITCARDTYPE=" . $creditCardType;
            $nvpstr .= "&ACCT=" . $creditCardNumber;
            $nvpstr .= "&EXPDATE=" . $expDate;
            $nvpstr .= "&CVV2=" . $cvv2;
        }
        $nvpstr .= "&EMAIL=" . $email;
        $nvpstr .= "&FIRSTNAME=" . $firstName;
        $nvpstr .= "&LASTNAME=" . $lastName;
        $nvpstr .= "&STREET=" . $street;
        $nvpstr .= "&CITY=" . $city;
        $nvpstr .= "&ZIP=" . $zip;
        $nvpstr .= "&STATE=" . $state;
        $nvpstr .= "&COUNTRYCODE=" . $countryCode;
        $resArray = $this->FetchData("UpdateRecurringPaymentsProfile", $nvpstr);
        return $resArray;
    }

    function CancelRecurringPayment ($profileId)
    {
        $nvpstr = "&PROFILEID=" . urlencode($profileId);
        $nvpstr .= "&ACTION=Cancel";
        $resArray = $this->FetchData("ManageRecurringPaymentsProfileStatus", $nvpstr);
        return $resArray;
    }
    
    function GetRecurringPaymentProfile ($profileId)
    {
        $nvpstr = "&PROFILEID=" . $profileId;
        $resArray = $this->FetchData("GetRecurringPaymentsProfileDetails", $nvpstr);
        return $resArray;
    }
    
    /**
      '-------------------------------------------------------------------------------------------------------------------------------------------
     * FetchData: Function to perform the API call to PayPal using API signature
     * @methodName is name of API  method.
     * @nvpStr is nvp string.
     * returns an associtive array containing the response from the server.
      '-------------------------------------------------------------------------------------------------------------------------------------------
     */
    function FetchData ($methodName, $nvpStr)
    {
        //setting the curl parameters.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->ApiEndpoint);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        //turning off the server and peer verification(TrustManager Concept).
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
    
        //NVPRequest for submitting to server
        $nvpreq = "METHOD=" . urlencode($methodName) . "&VERSION=" .
         urlencode($this->Version) . "&PWD=" . urlencode($this->Password) . "&USER=" .
         urlencode($this->Username) . "&SIGNATURE=" . urlencode($this->Signature) .
         $nvpStr;
        //setting the nvpreq as POST FIELD to curl
        curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);
        //getting response from server
        $response = curl_exec($ch);
        //convrting NVPResponse to an Associative Array
        $nvpResArray = $this->DeformatNVP($response);
        $nvpReqArray = $this->DeformatNVP($nvpreq);
        if (curl_errno($ch)) {
            // moving to display page to display curl errors
            $_SESSION['curl_error_no'] = curl_errno($ch);
            $_SESSION['curl_error_msg'] = curl_error($ch);
             //Execute the Error handling module to display errors.
        } else {
            //closing the curl
            curl_close($ch);
        }
        return $nvpResArray;
    }
    /* '----------------------------------------------------------------------------------
      Purpose: Redirects to PayPal.com site.
      Inputs:  NVP string.
      Returns:
      ----------------------------------------------------------------------------------
     */
    function RedirectToPayPal ($token)
    {
        // Redirect to paypal.com here
        $payPalURL = $this->PayPalUrl . $token;
        header("Location: " . $payPalURL);
    }
    /* '----------------------------------------------------------------------------------
     * This function will take NVPString and convert it to an Associative Array and it will decode the response.
     * It is usefull to search for a particular key and displaying arrays.
     * @nvpstr is NVPString.
     * @nvpArray is Associative Array.
      ----------------------------------------------------------------------------------
     */
    function DeformatNVP ($nvpstr)
    {
        $intial = 0;
        $nvpArray = array();
        while (strlen($nvpstr)) {
            //postion of Key
            $keypos = strpos($nvpstr, '=');
            //position of value
            $valuepos = strpos($nvpstr, '&') ? strpos($nvpstr, '&') : strlen(
            $nvpstr);
            /* getting the Key and Value values and storing in a Associative Array */
            $keyval = substr($nvpstr, $intial, $keypos);
            $valval = substr($nvpstr, $keypos + 1, $valuepos - $keypos - 1);
            //decoding the respose
            $nvpArray[urldecode($keyval)] = urldecode($valval);
            $nvpstr = substr($nvpstr, $valuepos + 1, strlen($nvpstr));
        }
        return $nvpArray;
    }
}
?>