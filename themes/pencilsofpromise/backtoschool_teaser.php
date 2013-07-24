<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<?php
/*
Template Name: Back to school Teaser
*/
?>
<meta name="viewport" content="width=device-width, maximum-scale=1.0" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/normalize.css" type="text/css" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/backtoschool_teaser.css" type="text/css" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/jquery-ui-1.10.3.custom.min.css" type="text/css" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/dropzone.css" type="text/css" />
<script src="<?php bloginfo('template_directory'); ?>/js/modernizr.custom.20855.js"></script> 
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=615805491764194";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="bts_teaser">
    <div id="header">
        <h2>Back to School</h2>
        <h3>Unlocking the Promise of 5,000 Students</h3>
    </div>
    <div id="info">
        <p>The campaign begins in <span id="daydiff"></span> days.  Give us your email so that we can send you a reminder!
    </div>
   <?php 
    gravity_form(9, true, true); 
    //gravity_form(14, true, true); 
?> 
<div id="social">
    <div class="fb-like" data-href="http://development.pencilsofpromise.org/back-to-school" data-send="true" data-layout="button_count" data-width="450" data-show-faces="false"></div>
    <a href="https://twitter.com/share" class="twitter-share-button" data-lang="en" data-text="Send a child back to school with PoP!" data-url="http://development.pencilsofpromise.org/back-to-school">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</div>
    
    
</div>

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script> 
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.tubular.1.0.js"></script> 
<script src="<?php bloginfo('template_directory'); ?>/js/backtoschool_teaser.js"></script> 
