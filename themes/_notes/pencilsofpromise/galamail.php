
<?php


    

// insure form variables exist
/*$name         = isset($_POST['name'])         ? $_POST['name']         : '';
$email        = isset($_POST['email'])        ? $_POST['email']        : '';
$submit       = isset($_POST['submit'])       ? true                   : false;

$host_committee = isset($_POST['host_committee'])
         ? implode(', ', $_POST['host_committee'])     // gather selected checkboxes
         : 'interested in host committee?';   */
if(isset($_POST['submit'])) {

$to = "lposen@pencilsofpromise.org";
$subject = "GALA - Advanced Ticket Request";
$body = 
"Name: $name \n\n
Email: $email \n\n 
$host_committee";
    if (mail($to, $subject, $body)) {
    echo("<p>Message successfully sent!</p>");
    } else {
    echo("<p>Message delivery failed...Try again.</p>");
    }
}
 ?>
