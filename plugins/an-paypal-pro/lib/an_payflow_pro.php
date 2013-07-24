<?php
// this class is not completed

class PayflowPro
{
    var $User;
    var $Vendor;
    var $Partner;
    var $Password;
    var $PayPalUrl;
    var $ApiEndpoint;
    var $FraudProtection;
    
    function __construct($user, $password, $vendor, $partner, $payPalUrl, $apiEndpoint, $FraudProtection){
        $this->User = $user;
        $this->Password = $password;
        $this->Vendor = $vendor;
        $this->Partner = $partner;
        $this->PayPalUrl = $payPalUrl;
        $this->ApiEndpoint = $apiEndpoint;
        $this->FraudProtection = 'YES';
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
  '		returnURL:			the page where buyers return to after they are done with the payment review on PayPal
  '		cancelURL:			the page where buyers return to when they cancel the payment review on PayPal
  '		doAsRecurringPayments: prepare for recurring payments	
  '--------------------------------------------------------------------------------------------------------------------------------------------
 */
    public function CallShortcutExpressCheckout ($paymentAmount, $currencyCodeType, 
    $returnURL, $cancelURL, $doAsRecurringPayments = 0)
    {
        $recurringPaymentInfoArray = array();        
        if ($doAsRecurringPayments == 1) {
            $trxtyp = "A";
            $action = "A";
            $recurringPaymentInfoArray['BA_DESC'] = 'Pencils of Promise Recurring Donations';
            $recurringPaymentInfoArray['BILLINGTYPE'] = 'MerchantInitiatedBilling';
        } else {
            $trxtyp = "A";
            $action = "A";
        }
        
        $paypalQueryArray = array(
            'USER'       => $this->User,
            'VENDOR'     => $this->Vendor,
            'PARTNER'    => $this->Partner,
            'PWD'        => $this->Password,
            'TENDER'     => 'P',  // P - Express Checkout using PayPal account
            'TRXTYPE'    => $trxtyp,
            'ACTION'     => $action,
            'AMT'        => $paymentAmount,
            'CURRENCY'   => $currencyCodeType,
            'CANCELURL'  => $cancelURL,
            'RETURNURL'  => $returnURL
            );
            
        $recurringPaymentInfoArray = array_merge($paypalQueryArray, $recurringPaymentInfoArray);
        
        foreach ($paypalQueryArray as $key => $value) {
				$paypal_query[]= $key.'['.strlen($value).']='.$value;
		}
		$paypal_query=implode('&', $paypal_query);
        
        // The $order_num field is storing our unique id that we'll use in the request id header.  By storing the id
        // in this manner, we are able to allowing reposting of the form without creating a duplicate transaction.
        $unique_id = $this->GenerateGUID();
    
        // call function to return name-value pair
        $nvpArray = $this->FetchData($unique_id, $paypal_query);
    
        $resultCode = strtoupper($nvpArray["RESULT"]);
        if ($resultCode == 0) {
            $_SESSION['TOKEN'] = urldecode($nvpArray["TOKEN"]);
            $_SESSION['UNIQUE'] = $unique_id;
        }
        return $nvpArray;
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
    public function GetShippingDetails ($token)
    {        
        // After the customer has selected shipping and billing information on the PayPal website and clicks Pay, which is the customer’s approval
        // of the use of PayPal. PayPal then redirects the customer’s browser to your website using the ReturnURL specified by you in
        // the SetExpressCheckoutRequest. If the customer clicks the Cancel button, PayPal returns him to the CancelURL specified in the
        // SetExpressCheckoutRequest.

        $paypalQueryArray = array(
            'USER'       => $this->User,
            'VENDOR'     => $this->Vendor,
            'PARTNER'    => $this->Partner,
            'PWD'        => $this->Password,
            'TENDER'     => 'P',  // P - Express Checkout using PayPal account
            'TRXTYPE'    => 'A',
            'ACTION'     => 'G',
            'TOKEN'      => $token
            );

        foreach ($paypalQueryArray as $key => $value) {
				$paypal_query[]= $key.'['.strlen($value).']='.$value;
		}
		$paypal_query=implode('&', $paypal_query);
        
        // prepare unique id for Action=G.  Each part of Express Checkout must
        // have a unique request ID.
        $unique_id = $this->GenerateGUID();
        // call function to return name-value pair
        $nvpArray = $this->FetchData($unique_id, $paypal_query);
        $ack = strtoupper($nvpArray["ACK"]);        
        if($ack=='APPROVED') {
            $_SESSION['PAYERID'] = $nvpArray['PAYERID'];
        }
        return $nvpArray;
    }
    
    public function ConfirmPayment ($finalPaymentAmt)
    {
        // After you receive a successful GetExpressCheckoutDetailsResponse, you would display a order review page (ie shipping information) or a
        // page on which the customer can select a shipping method, enter shipping instructions, or specify any other information necessary to
        // complete the purchase.
        //
        // When the customer clicks the “Place Order” button, send DoExpressCheckoutPaymentRequest to initiate the payment. After a successful
        // response is sent from PayPal, direct the customer to your order completion page to inform him that you received his order.
        $token = urlencode($_SESSION['TOKEN']);
        $payer_id = urlencode($_SESSION['PAYERID']);
        $serverName = urlencode($_SERVER['SERVER_NAME']);
        $currencyCodeType = urlencode($_SESSION['currencyCodeType']);
        
    
        $paypal_query_array = array(
            'USER'       => $this->User,
            'VENDOR'     => $this->Vendor,
            'PARTNER'    => $this->Partner,
            'PWD'        => $this->Password,
            'TENDER'     => 'P',  // P - Express Checkout using PayPal account
            'TRXTYPE'    => 'A',  // S - Sale
            'ACTION'     => 'D',  //
            'TOKEN'      => $token,
            'PAYERID'    => $payer_id,
            'AMT'        => $finalPaymentAmt,
            'CURRENCY'   => $currencyCodeType,
            'IPADDRESS'  => $serverName
            );
    
    
        foreach ($paypal_query_array as $key => $value) {
        	$paypal_query[]= $key.'['.strlen($value).']='.$value;
    	}
    	$paypal_query=implode('&', $paypal_query);
    
        $unique_id = $_SESSION['UNIQUE'];       
    
        // call function to return name-value pair
        $nvpArray = $this->FetchData($unique_id, $paypal_query);
        return $nvpArray;
    }
    
    /*
  '-------------------------------------------------------------------------------------------------------------------------------------------
  ' Purpose: 	This public function makes a DoDirectPayment API call
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
    public function DirectPayment ($paymentType, $paymentAmount, $creditCardType, 
    $creditCardNumber, $expDate, $cvv2, $firstName, $lastName, $street, $city, 
    $state, $zip, $countryCode, $currencyCode)
    {
        
            $paypal_query_array = array(
            'USER'       => $this->User,
            'VENDOR'     => $this->Vendor,
            'PARTNER'    => $this->Partner,
            'PWD'        => $this->Password,
            'TENDER'     => 'C',  // C - Credit Card
            'TRXTYPE'    => 'A',  // S - Sale
            'ACCT'       => $creditCardNumber,
            'CVV2'       => $cvv2,
            'EXPDATE'    => $expDate,
            'AMT'        => $paymentAmount,
            'FIRSTNAME'  => substr($firstName, 0, 30),
            'LASTNAME'   => substr($lastName, 0, 30),
            'STREET'     => substr($street, 0, 30),
            'ZIP'	     => substr($zip, 0, 10)
            );
        
        foreach ($paypal_query_array as $key => $value) {
        	$paypal_query[]= $key.'['.strlen($value).']='.$value;
    	}
    	$paypal_query=implode('&', $paypal_query);
    
        $unique_id = $this->GenerateGUID();       
    
        // call function to return name-value pair
        $nvpArray = $this->FetchData($unique_id, $paypal_query);
        return $nvpArray;
    }

    /*
  '-------------------------------------------------------------------------------------------------------------------------------------------
  ' Purpose: 	This public function makes a DoDirectPayment API call
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
    function RecurringPaymentWithDirectPayment ($paymentAmount,  
    $creditCardNumber, $expDate, $email, $street, $city, 
    $zip, $do_as_recurring_payments)
    {
        if ($do_as_recurring_payments == "Year") {
            $billingperiod = "YEAR";
        } else {
            $billingperiod = "MONT";
        }
        // The profile may take up to 24 hours for activation. So we start billing the next day
        $tomorrow = mktime(date("H"), date("i"), date("s"), date("n"), 
        date("d") + 1, date("Y"));
        //Format for paypal which is like "12232010"
        $profileStartDate = date('mdY', $tomorrow);

        $paypal_query_array = array(
            'USER'       => $this->User,
            'VENDOR'     => $this->Vendor,
            'PARTNER'    => $this->Partner,
            'PWD'        => $this->Password,
            'ACTION'     => 'A',  // A - Add
            'PROFILENAME'=> 'RegularSubscription',  
        	'TENDER'     => 'C',  // C - Credit Card
            'TRXTYPE'    => 'R',  // R - Recurring
            'ACCT'       => $creditCardNumber,
            'EXPDATE'    => $expDate,
            'START'	     => $profileStartDate,
            'TERM'	     => '0',     // until deactivated
        	'PAYPERIOD'  => $billingperiod,
        	'AMT'        => $paymentAmount,
        	'EMAIL'      => substr($street, 0, 120),
            'STREET'     => substr($street, 0, 150),
            'ZIP'	     => substr($zip, 0, 10)
            );
        
        foreach ($paypal_query_array as $key => $value) {
        	$paypal_query[]= $key.'['.strlen($value).']='.$value;
    	}
    	$paypal_query=implode('&', $paypal_query);
    
        $unique_id = $this->GenerateGUID();       
    
        // call function to return name-value pair
        $nvpArray = $this->FetchData($unique_id, $paypal_query);
        return $nvpArray;
    }    
    public function RecurringPayment ($paymentAmount)
    {
        // @todo 
        //declaring of global variables
        global $API_Endpoint, $version, $API_UserName, $API_Password, $API_Signature;
        //Format the other parameters that were stored in the session from the previous calls
        $token = urlencode($_SESSION['TOKEN']);
        $paymentType = urlencode($_SESSION['PaymentType']);
        $currencyCodeType = urlencode($_SESSION['currencyCodeType']);
        $billingCycles = $_SESSION['billing_cycles'];
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
        $nvpstr .= "&BILLINGPERIOD=" . urlencode("Month");
        $nvpstr .= "&BILLINGFREQUENCY=1";
        $nvpstr .= "&TOTALBILLINGCYCLES=" . $billingCycles;
        $nvpstr .= "&BILLINGTYPE=" . urlencode("RecurringPayments");
        $nvpstr .= "&DESC=" . urlencode("Pencils of Promise Recurring Donations");
        $resArray = PPfetchData("CreateRecurringPaymentsProfile", $nvpstr);
        return $resArray;
    }

    /* '----------------------------------------------------------------------------------
  Purpose: Redirects to PayPal.com site.
  Inputs:  NVP string.
  Returns:
  ----------------------------------------------------------------------------------
 */
    public function RedirectToPayPal ($token)
    {
        global $PAYPAL_URL;
        // Redirect to paypal.com here
        $payPalURL = $PAYPAL_URL . $token;
        header("Location: " . $payPalURL);
    }
    /* '----------------------------------------------------------------------------------
 * This public function will take NVPString and convert it to an Associative Array and it will decode the response.
 * It is usefull to search for a particular key and displaying arrays.
 * @nvpstr is NVPString.
 * @nvpArray is Associative Array.
  ----------------------------------------------------------------------------------
 */
    public function DeformatNVP ($nvpstr)
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
    // API public functions and error handling
    public function FetchData ($unique_id, $data)
    {
        // get data ready for API
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        // Here's your custom headers; adjust appropriately for your setup:
        $headers[] = "Content-Type: text/namevalue"; //or text/xml if using XMLPay.
        $headers[] = "Content-Length : " . strlen($data); // Length of data to be passed 
        // Here I set the server timeout value to 45, but notice below in the cURL section, I set the timeout
        // for cURL to 90 seconds.  You want to make sure the server timeout is less, then the connection.
        $headers[] = "X-VPS-Timeout: 45";
        $headers[] = "X-VPS-Request-ID:" . $unique_id;
        // Optional Headers.  If used adjust as necessary.
        //$headers[] = "X-VPS-VIT-OS-Name: Linux";                  // Name of your OS
        //$headers[] = "X-VPS-VIT-OS-Version: RHEL 4";          // OS Version
        //$headers[] = "X-VPS-VIT-Client-Type: PHP/cURL";          // What you are using
        //$headers[] = "X-VPS-VIT-Client-Version: 0.01";          // For your info
        //$headers[] = "X-VPS-VIT-Client-Architecture: x86";          // For your info
        //$headers[] = "X-VPS-VIT-Integration-Product: PHPv4::cURL";  // For your info, would populate with application name
        //$headers[] = "X-VPS-VIT-Integration-Version: 0.01";         // Application version
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->ApiEndpoint);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
        curl_setopt($ch, CURLOPT_HEADER, 1); // tells curl to include headers in response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // return into a variable
        curl_setopt($ch, CURLOPT_TIMEOUT, 90); // times out after 90 secs
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // this line makes it work under https
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data); //adding POST data
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); //verifies ssl certificate
        curl_setopt($ch, CURLOPT_FORBID_REUSE, TRUE); //forces closure of connection when done
        curl_setopt($ch, CURLOPT_POST, 1); //data sent as POST
        // Try to submit the transaction up to 3 times with 5 second delay.  This can be used
        // in case of network issues.  The idea here is since you are posting via HTTPS there
        // could be general network issues, so try a few times before you tell customer there
        // is an issue.
        $i = 1;
        while ($i ++ <= 3) {
            $result = curl_exec($ch);
            $headers = curl_getinfo($ch);
            //print_r($headers);
            //echo '<br>';
            //print_r($result);
            //echo '<br>';
            if ($headers['http_code'] !=
             200) {
                sleep(5); // Let's wait 5 seconds to see if its a temporary network issue.
            } else 
                if ($headers['http_code'] == 200) {
                    // we got a good response, drop out of loop.
                    break;
                }
        }
        // In this example I am looking for a 200 response from the server prior to continuing with
        // processing the order.  You can use this or other methods to validate a response from the
        // server and/or timeout issues due to network.
        if ($headers['http_code'] != 200) {
            echo '<h2>General Error!</h2>';
            echo '<h3>Unable to receive response from PayPal server.</h3><p>';
            echo '<h4>Verify host URL of ' . $submiturl .
             ' and check for firewall/proxy issues.</h4>';
            curl_close($ch);
            exit();
        }
        curl_close($ch);
        $result = strstr($result, "RESULT");
        echo $result;
        // prepare responses into array
        $proArray = array();
        while (strlen($result)) {
            // name
            $keypos = strpos($result, '=');
            $keyval = substr($result, 0, $keypos);
            // value
            $valuepos = strpos($result, '&') ? strpos($result, '&') : strlen(
            $result);
            $valval = substr($result, $keypos + 1, $valuepos - $keypos - 1);
            // decoding the respose
            $proArray[$keyval] = $valval;
            $result = substr($result, $valuepos + 1, strlen($result));
        }
        return $proArray;
    }
    public function HandleResponse ($nvpArray)
    {
        $result_code = $nvpArray['RESULT']; // get the result code to validate.
        $RespMsg = 'General Error.  Please contact Customer Support.'; // Generic error for all results not captured below.
        // Part of accepting credit cards or PayPal is to determine what your business rules are.  Basically, what risk are you
        // willing to take, especially with credit cards.  The code below gives you an idea of how to check the results returned
        // so you can determine how to handle the transaction.
        //
        // This is not an exhaustive list of failures or issues that could arise.  Review the list of Result Code's in the
        // Developer Guides and add logic as you deem necessary.
        // These responses are just an example of what you can do and how you handle the response received
        // from the bank/PayPal is dependent on your own business rules and needs.
        //
        // Evaluate Result Code returned from PayPal.
        // Since you are posting via HTTPS you would not see any negative result codes as documented in the developer's guide.
        // This is due to the fact that negative result codes are generated from the SDK, not the server.
        if ($result_code ==
         1 || $result_code == 26) {
            // This is just checking for invalid login credentials.  You normally would not display this type of message.
            // Result code 26 will be issued if you do not provide both the <vendor> and <user> fields.
            // Remember: <vendor> = your merchant (login id), <user> = <vendor> unless you created a seperate <user> for Payflow Pro.
            //
            // The other most common error with authentication is result code 1, user authentication failed.  This is usually
            // due to invalid account information or ip restriction on the account.  You can verify ip restriction by logging
            // into Manager.  See Service Settings >> Allowed IP Addresses.  Lastly it could be you forgot the path "/transaction"
            // on the URL.
            $RespMsg = "Account configuration issue.  Please verify your login credentials.<br>See comments contained in this sample
        			and read this <a href='http://www.paypaldeveloper.com/pdn/board/message?board.id=payflow&message.id=1388' 
        			target='_blank'>post</a> for more information.";
        } else 
            if ($result_code == 0) {
                // Example of a message you might want to display with an approved transaction.
                $RespMsg = "Your transaction was approved. We will ship in 24 hours.";
                // Even though the transaction was approved, you still might want to check for AVS or CVV2(CSC) prior to
                // accepting the order.  Do realize that credit cards are approved (charged) regardless of the AVS/CVV2 results.
                // Should you decline (void) the transaction, the card will still have a temporary charge (approval) on it.
                //
                // Check AVS - Street/Zip
                // In the message below it shows what failed, ie street, zip or cvv2.  To prevent fraud, it is suggested
                // you only give a generic billing error message and not tell the card-holder what is actually wrong.  However,
                // that decision is yours.
                //
                // Also, it is totally up to you on if you accept only "Y" or allow "N" or "X".  You need to decide what
                // business logic and liability you want to accept with cards that either don't pass the check or where
                // the bank does not participate or return a result.  Remember, AVS is mostly used in the US but some foreign
                // banks do participate.
                // Remember, this just an example of what you might want to do.
                if (isset(
                $nvpArray['AVSADDR'])) {
                    if ($nvpArray['AVSADDR'] != "Y") {
                        // Display message that transaction was not accepted.  At this time, you
                        // could display message that information is incorrect and redirect user
                        // to re-enter STREET and ZIP information.  However, there should be some sort of
                        // 3 strikes your out check.
                        $RespMsg = "Your billing (street) information does not match. Please re-enter.";
                         // Here you might want to put in code to flag or void the transaction depending on your needs.
                    }
                }
                if (isset($nvpArray['AVSZIP'])) {
                    if ($nvpArray['AVSZIP'] != "Y") {
                        // Display message that transaction was not accepted.  At this time, you
                        // could display message that information is incorrect and redirect user
                        // to re-enter STREET and ZIP information.  However, there should be some sort of
                        // 3 strikes your out check.
                        $RespMsg = "Your billing (zip) information does not match. Please re-enter.";
                         // Here you might want to put in code to flag or void the transaction depending on your needs.
                    }
                }
                if (isset($nvpArray['CVV2MATCH'])) {
                    if ($nvpArray['CVV2MATCH'] != "Y") {
                        // Display message that transaction was not accepted.  At this time, you
                        // could display message that information is incorrect.  Normally, to prevent
                        // fraud you would not want to tell a customer that the 3/4 digit number on
                        // the credit card was invalid.
                        $RespMsg = "Your billing (cvv2) information does not match. Please re-enter.";
                         // Here you might want to put in code to flag or void the transaction depending on your needs.
                    }
                }
            } else 
                if ($result_code == 12) {
                    // Hard decline from bank.
                    $RespMsg = "Your transaction was declined.";
                } else 
                    if ($result_code == 13) {
                        // Voice authorization required.
                        $RespMsg = "Your Transaction is pending. Contact Customer Service to complete your order.";
                    } else 
                        if ($result_code == 23 || $result_code == 24) {
                            // Issue with credit card number or expiration date.
                            $RespMsg = "Invalid credit card information. Please re-enter.";
                        }
        // Using the Fraud Protection Service.
        // This portion of code would be is you are using the Fraud Protection Service, this is for US merchants only.
        if ($this->FraudProtectionraud == 'YES') {
            // 125, 126 and 127 are Fraud Responses.
            // Refer to the Payflow Pro Fraud Protection Services User's Guide or
            // Website Payments Pro Payflow Edition - Fraud Protection Services User's Guide.
            if ($result_code == 125) {
                // 125 = Fraud Filters set to Decline.
                $RespMsg = "Your Transaction has been declined. Contact Customer Service to place your order.";
            } else 
                if ($result_code == 126) {
                    // 126 = One of more filters were triggered.  Here you would check the fraud message returned if you
                    // want to validate data.  For example, you might have 3 filters set, but you'll allow 2 out of the
                    // 3 to consider this a valid transaction.  You would then send the request to the server to modify the
                    // status of the transaction.  This outside the scope of this sample.  Refer to the Fraud Developer's Guide.
                    $RespMsg = "Your Transaction is Under Review. We will notify you via e-mail if accepted.";
                } else 
                    if ($result_code == 127) {
                        // 127 = Issue with fraud service.  Manually, approve?
                        $RespMsg = "Your Transaction is Under Review. We will notify you via e-mail if accepted.";
                    }
        }
        // This would simulate displaying the message to your customer.  Also, the results returned from
        // the server are displayed too.
        DisplayResponse($RespMsg, $nvpArray);
    }
    public function DisplayResponse ($RespMsg, $nvpArray)
    {
        echo '<p>Results returned from server: <br><br>';
        while (list ($key, $val) = each($nvpArray)) {
            echo "\n" . $key . ": " . $val . "\n<br>";
        }
        echo '</p>';
        // Was this a duplicate transaction, ie the request ID was NOT changed.
        // Remember, a duplicate response will return the results of the orignal transaction which
        // could be misleading if you are debugging your software.
        // For Example, let's say you got a result code 4, Invalid Amount from the orignal request because
        // you were sending an amount like: 1,050.98.  Since the comma is invalid, you'd receive result code 4.
        // RESULT=4&PNREF=V18A0C24920E&RESPMSG=Invalid amount&PREFPSMSG=No Rules Triggered
        // Now, let's say you modified your code to fix this issue and ran another transaction but did not change
        // the request ID.  Notice the PNREF below is the same as above, but DUPLICATE=1 is now appended.
        // RESULT=4&PNREF=V18A0C24920E&RESPMSG=Invalid amount&DUPLICATE=1
        // This would tell you that you are receving the results from a previous transaction.  This goes for
        // all transactions even a Sale transaction.  In this example, let's say a customer ordered something and got
        // a valid response and now a different customer with different credit card information orders something, but again
        // the request ID is NOT changed, notice the results of these two sales.  In this case, you would have not received
        // funds for the second order.
        // First order: RESULT=0&PNREF=V79A0BC5E9CC&RESPMSG=Approved&AUTHCODE=166PNI&AVSADDR=X&AVSZIP=X&CVV2MATCH=Y&IAVS=X
        // Second order: RESULT=0&PNREF=V79A0BC5E9CC&RESPMSG=Approved&AUTHCODE=166PNI&AVSADDR=X&AVSZIP=X&CVV2MATCH=Y&IAVS=X&DUPLICATE=1
        // Again, notice the PNREF is from the first transaction, this goes for all the other fields as well.
        // It is suggested that your use this to your benefit to prevent duplicate transaction from the same customer, but you want
        // to check for DUPLICATE=1 to ensure it is not the same results as a previous one.
        if (isset(
        $nvpArray['DUPLICATE'])) {
            echo '<h2>Error!</h2><p>This is a duplicate of your previous order.</p>';
            echo '<p>Notice that DUPLICATE=1 is returned and the PNREF is the same ';
            echo 'as the previous one.  You can see this in Manager as the Transaction ';
            echo 'Type will be "N".';
        }
        if (isset($nvpArray['PPREF'])) {
            // Check if PayPal Express Checkout and if order is Pending.
            if (isset($nvpArray['PENDINGREASON'])) {
                if ($nvpArray['PENDINGREASON'] == 'completed') {
                    echo '<h2>Transaction Completed!</h2>';
                    echo '<h3>' . $RespMsg . '</h3><p>';
                    echo '<h4>Note: To simulate a duplicate transaction, refresh this page in your browser.  ';
                    echo 'Notice that you will see DUPLICATE=1 returned.</h4>';
                } elseif ($nvpArray['PENDINGREASON'] == 'echeck') {
                    // PayPal transaction
                    echo '<h2>Transaction Completed!</h2>';
                    echo '<h3>The payment is pending because it was made by an eCheck that has not yet cleared.</h3';
                } else {
                    // PENDINGREASON not 'completed' or 'echeck'.  See Integration guide for more responses.
                    echo '<h2>Transaction Completed!</h2>';
                    echo '<h3>The payment is pending due to: ' .
                     $nvpArray['PENDINGREASON'];
                    echo '<h4>Please login to your PayPal account for more details.</h4>';
                }
            }
        } else {
            if ($nvpArray['RESULT'] == "0") {
                echo '<h2>Transaction Completed!</h2>';
            } else {
                echo '<h2>Transaction Failure!</h2>';
            }
            echo '<h3>' . $RespMsg . '</h3><p>';
            if ($nvpArray['RESULT'] != "26" && $nvpArray['RESULT'] != "1") {
                echo '<h4>Note: To simulate a duplicate transaction, refresh this page in your browser.&nbsp';
                echo 'Notice that you will see DUPLICATE=1 returned.</h4>';
            }
        }
    }
    public function GenerateCharacter ()
    {
        $possible = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $char = substr($possible, mt_rand(0, strlen($possible) - 1), 1);
        return $char;
    }
    public function GenerateGUID ()
    {
        $GUID = $this->GenerateCharacter() . $this->GenerateCharacter() . $this->GenerateCharacter() .
         $this->GenerateCharacter() . $this->GenerateCharacter() . $this->GenerateCharacter() .
         $this->GenerateCharacter() . $this->GenerateCharacter() . $this->GenerateCharacter() . "-";
        $GUID = $GUID . $this->GenerateCharacter() . $this->GenerateCharacter() .
         $this->GenerateCharacter() . $this->GenerateCharacter() . "-";
        $GUID = $GUID . $this->GenerateCharacter() . $this->GenerateCharacter() .
         $this->GenerateCharacter() . $this->GenerateCharacter() . "-";
        $GUID = $GUID . $this->GenerateCharacter() . $this->GenerateCharacter() .
         $this->GenerateCharacter() . $this->GenerateCharacter() . "-";
        $GUID = $GUID . $this->GenerateCharacter() . $this->GenerateCharacter() .
         $this->GenerateCharacter() . $this->GenerateCharacter() . $this->GenerateCharacter() .
         $this->GenerateCharacter() . $this->GenerateCharacter() . $this->GenerateCharacter() .
         $this->GenerateCharacter() . $this->GenerateCharacter() . $this->GenerateCharacter() .
         $this->GenerateCharacter();
        return $GUID;
    }
    public function HandleError ($nvpArray)
    {
        echo '<h2>Error!</h2><p>We were unable to process your order.</p>';
        echo '<p>Error ' . $nvpArray['RESULT'] . ': ' . $nvpArray['RESPMSG'] .
         '.</p>';
        while (list ($key, $val) = each($nvpArray)) {
            echo "\n" . $key . ": " . $val . "\n<br>";
        }
    }
}
?>