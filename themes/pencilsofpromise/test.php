<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Test Template
*/
?>

<?php get_header(); ?>

<div id="generic">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<div class="generic-content">
            
			<?php
if (isset($_REQUEST['email']))
//if "email" is filled out, send email
  {
  //send email
  $email = $_REQUEST['email'] ;
  $subject = $_REQUEST['subject'] ;
  $message = $_REQUEST['message'] ;
  mail("someone@example.com", "$subject",
  $message, "From:" . $email);
  echo "Thank you for using our mail form";
  }
else
//if "email" is not filled out, display the form
  {
  echo "<form method='post' action='testing-php-mail'>
  Email: <input name='email' type='text' /><br />
  Subject: <input name='subject' type='text' /><br />
  Message:<br />
  <textarea name='message' rows='15' cols='40'>
  </textarea><br />
  <input type='submit' />
  </form>";
  }
?>

	<?php endwhile; endif; ?>
    
    <div class="clearfix"></div>
</div>

<?php get_footer(); ?>