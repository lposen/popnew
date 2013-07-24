<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Facebook Tab
*/
?>

<?php
$customField1 = get_post_custom_values("fb_app_id");
$customField2 = get_post_custom_values("fb_app_secret");

require 'facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => $customField1[0],
  'secret' => $customField2[0],
  'cookie' => true,
));

$signed_request = $facebook->getSignedRequest();
$like_status = $signed_request["page"]["liked"];

?>

    <div id="fb-root"></div>
    <script>
      window.fbAsyncInit = function() {
        FB.init({appId: ' <?php echo $customField1[0]; ?>', status: true, cookie: true,
                 xfbml: true});
        FB.XFBML.parse();
      };
      (function() {
        var e = document.createElement('script');
        e.async = true;
        e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
        document.getElementById('fb-root').appendChild(e);
      }());
    </script>

<?php

if ($like_status == 1) {
?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<?php the_content(''); ?> ... likes the page
	<?php endwhile; endif; ?>
<?php
}
else {
?>
does not like the page
<?php
}
?>