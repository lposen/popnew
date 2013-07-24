<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<?php
/*
Template Name: Gala 2013
*/
?>
<meta name="viewport" content="width=device-width, maximum-scale=1.0" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/normalize.css" type="text/css" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/gala2013.css" type="text/css" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/jquery-ui-1.10.3.custom.min.css" type="text/css" />
<script src="<?php bloginfo('template_directory'); ?>/js/modernizr.custom.20855.js"></script> 
<div id="gala">
    <div id="intro" class="section">
        <div class="inner">
            <img src="<?php bloginfo('template_directory'); ?>/gfx/gala2013/logo_03.jpg">
            <!--<div id="header">
                <div class="third">Third Annual</div>
                <div class="main">Pencils of Promise</div>
                <div class="gala">Gala</div>
            </div>-->
            <div id="dateplace">
                <div class="date">
                    <span>Thursday, October 24th</span>
                    <span>7pm</span>
                </div>
                <div class="place">
                    <span>Guastavino's</span>
                    <span>409 E 59th St, NYC</span>
                </div>
            </div>
            <div id="featuring">
                <div class="honor">
                    <h4>An Evening to Honor</h4>
                    <div class="person">
                        <img src="<?php bloginfo('template_directory'); ?>/gfx/gala2013/honoree_01.jpg" alt="">
                        <p class="name">Malala Yousafzai</p>
                    </div>
                    <div class="person">
                        <img src="<?php bloginfo('template_directory'); ?>/gfx/gala2013/honoree_02.jpg" alt="">
                        <p class="name">Mayor Cory Booker</p>
                    </div>
                    <div class="person">
                        <img src="<?php bloginfo('template_directory'); ?>/gfx/gala2013/honoree_03.jpg" alt="">
                        <p class="name">The Cahill Family</p>
                    </div>
                </div>
                <div class="hosted">
                    <h4>Hosted By</h4>
                    <div class="person">
                        <img src="<?php bloginfo('template_directory'); ?>/gfx/gala2013/host.jpg" alt="">
                        <p class="name">Sophia Bush</p>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div id="contact" class="section">
    
    
        <div class="inner">
            <div id="form">
     
<?php 
    /*gravity_form(8, true, true); */
    gravity_form(13, true, true); 
?>
</div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
    <?php 

    ?>
    <div class="clearfix"></div>
    
</div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> 
<script>
$(document).ready(function(){
    $('.name input').attr('placeholder', 'Name');
    $('.emailorphone input').attr('placeholder', 'Email');
    $('textarea').attr('placeholder', 'Inquiry');
})
</script>