<?php
	set_include_path('/home/107544/users/.home/pear/php');
	include('XML/RPC2/Client.php');

	$email = $_POST['email'];
	$errors = array();
	$success = 0;

	if(!empty($email)) {
		$client = XML_RPC2_Client::create('http://api.benchmarkemail.com/1.0');
		$token = $client->login('pencilsofpromise', 'pop123');

		$contactList = $client->listGet($token, "", 1, 1, "", "");
		$listID = $contactList[0]['id'];

		$details = array('email' => $email, 'firstname' => 'Test', 'lastname' => 'User');
		$person = array($details);

		$added = $client->listAddContacts($token, $listID, $person);

		if($added > 0) {
			$success = 1;
		} else {
			$errors[] = 'Unable to signup.';
		}
	} else {
		$errors[] = 'Please enter in an email.';
	}

	echo json_encode(array('success' => $success, 'errors' => $errors));
?>