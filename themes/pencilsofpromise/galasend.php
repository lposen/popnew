<?php
/*
Template Name: Gala Thank You
*/
if (isset($_REQUEST['email']))
//if "email" is filled out, send email
  {
  //send email
  $email = $_REQUEST['emailorphone'] ;
  $name = $_REQUEST['name'];
  $subject = "gala email from " . $name;
  $message = $_REQUEST['inquiry'] ;
  mail("lposen@pencilsofpromise.org", $subject,
  $message, "From:" . $email);
  echo "Thank you for using our mail form";
  }
else
//if "email" is not filled out, display the form
  {
  echo "<form action='../gala-2013' method='post'>
                <h2>Contact</h2>
                <p>Any questions, comments or enquiries, please contact us by using the form below. We will get back to you as soon as possible.</p>
                <input type='text' name='name' placeholder='Name'>
                <input type='text' name='emailorphone' placeholder='Email or Phone'>
                <input type='textarea' name='inquiry' placeholder='Inquiry'>
                <input type='submit'>
            </form>";
  }
       
?>
