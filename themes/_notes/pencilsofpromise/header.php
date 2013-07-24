
<?php

/**
 * @package WordPress
 * @subpackage Default_Theme
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<script src="http://ie.microsoft.com/TestDrive/HTML5/CompatInspector/inspector.js"></script>
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<script type="text/javascript">var switchTo5x=false;</script>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>?1057" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ipad.css" type="text/css" media="only screen and (min-device-width : 768px) and (max-device-width : 1024px)">
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/vader/jquery-ui-1.8.5.custom.css" type="text/css" />
<link href="https://plus.google.com/113501606134993950609/posts/" rel="publisher" />
<?php wp_head(); ?>
<script src="http://ie.microsoft.com/TestDrive/HTML5/CompatInspector/inspector.js"></script>
<script type='text/javascript' src='http://code.jquery.com/jquery-1.8.3.min.js'></script>
<script type="text/javascript">stLight.options({publisher: "255ee9c2-2b65-44d1-ab57-8cc6d50bac76"}); </script>
<script src="<?php bloginfo('template_directory'); ?>/js/jqueryui.js" type="text/javascript" charset="utf-8"> </script>
<script src="<?php bloginfo('template_directory'); ?>/js/cufon-yui.js" type="text/javascript"> </script>
<script src="<?php bloginfo('template_directory'); ?>/js/Sketch_Block_400.font.js" type="text/javascript"> </script>
<script src="<?php bloginfo('template_directory'); ?>/js/Sketch_Rockwell_700.font.js" type="text/javascript"> </script>
<script src="<?php bloginfo('template_directory'); ?>/js/Bebas_Neue_400.font.js" type="text/javascript"> </script>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.flightboard.pack.js" type="text/javascript" charset="utf-8"> </script>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.cookie.js" type="text/javascript" charset="utf-8"> </script>
<?php if (is_home() || is_page("hire")) { ?>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.easing.1.2.js" type="text/javascript"> </script>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.anythingslider.js" type="text/javascript"> </script>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/slider.css" type="text/css" media="screen" />
<?php } ?>
<?php if (is_page("Photo Gallery") || is_page("Video Gallery")) { ?>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.easing.1.2.js" type="text/javascript"> </script>
<script src="<?php bloginfo('template_directory'); ?>/js/pop-anythingslider.js" type="text/javascript"> </script>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/pop-anythingslider.css" type="text/css" media="screen" />
<?php } ?>
<?php if (is_page("Season of 1,000 Promises")) { ?>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/season1000.css" type="text/css" media="screen" />
<?php } ?>
<script type="text/javascript">
	Cufon.replace('.boxcufon', { fontFamily: 'Sketch Block' });
</script>
<script src="<?php bloginfo('template_directory'); ?>/js/site.js?9" type="text/javascript"> </script>
<script src="<?php bloginfo('template_directory'); ?>/js/swfobject.js"></script>
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
<?php if (is_page("2315")) { ?>
<script src="<?php echo WP_PLUGIN_URL; ?>/gravityforms/js/jquery-ui/ui.datepicker.js"></script>
<script src="<?php echo WP_PLUGIN_URL; ?>/gravityforms/js/datepicker.js"></script>
<script src="<?php echo WP_PLUGIN_URL; ?>/gravityforms/js/conditional_logic.js"></script>
<?php } ?>

<?php if (is_page("204") || is_page('Our Partners') || is_page('Our People') || is_page('holiday-shop')) { ?>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.tools.min.js"></script> 
<?php } ?>

<?php if (is_page("Season of 1,000 Promises")) { ?>
<meta property="og:title" content="Season of 1,000 Promises" />
<meta property="og:image" content="<?php bloginfo('template_directory'); ?>/gfx/season1000/fbSeasonThumb.png" />
<?php } ?>


<?php if (is_page("Our Approach Subpage Test")) { ?>
        <script src="<?php bloginfo('template_directory'); ?>/js/galleria/galleria-1.2.5.min.js"></script>
        <script src="<?php bloginfo('template_directory'); ?>/js/galleria/flickr/galleria.flickr.js"></script>
<?php } ?>
        
<?php if (is_page("Contact Us")) { ?>        
        <script charset='utf-8' type='text/javascript'>
       
        var _hatchd_id = "71fe4d3f2e";
        var is_ssl = ("https:" == document.location.protocol);
        var _hatchd_asset_host = is_ssl ? "https://hatchd.it:80/" : "http://hatchd.it:80/";
$(document).ready(function() { 
        var e = document.createElement('script');
        e.setAttribute('type','text/javascript');
        e.setAttribute('src', _hatchd_asset_host + 'javascripts/widget.js?' + (new Date().getTime()));
        document.body.appendChild(e);
});        
        </script>
<?php } ?>

<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="icon" href="/favicon.ico" type="image/x-icon">

<?php if(is_page("Join the Movement")) { ?>
<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
<?php } ?>

<?php if(is_page("Testing iPromise") || is_page("fundraise")) { ?>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.countdown.js"></script> 
<script type="text/javascript">
$(document).ready(function() {
iPromise();
});
</script>
<?php } ?>
<?php if(is_page("Donate Money")) { ?>
<script type="text/javascript">
$(document).ready(function() {
    $('body').addClass('has-js');
    $('.label_check, .label_radio').click(function(){
        setupLabel();
    });
    setupLabel(); 
    donateRadios();
});
</script>
<script src="/wp-content/themes/pencilsofpromise/js/platform.js" type="text/javascript" charset="utf-8"></script>
<?php } ?>
<?php if(is_page("Meet and Greet")) { ?>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/jquery.lightbox.css" type="text/css" />
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.lightbox_mg.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.cycle.all.js"></script>
<script type="text/javascript">
$(document).ready(function() {
photoGallery("album");
});
</script>
<?php } ?>

<?php if(is_page("gala")) { ?>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/jquery.lightbox.css" type="text/css" />
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.lightbox.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.cycle.all.js"></script>
<script type="text/javascript">
$(document).ready(function() {
photoGallery("album");
});
</script>
<?php } ?>

<?php if(is_page("identify") || is_page("support") || is_page("build") || is_page("shine")) { ?>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/jquery.lightbox.css" type="text/css" />
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.lightbox.js"></script>
<script type="text/javascript">
$(document).ready(function() {
photoGallery("solo");
});
</script>
<?php } ?>

<?php if(is_page("holidayshop")) { ?>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/colorbox.css" type="text/css" />
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.colorbox-min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.panzoom.js"></script>
<script type="text/javascript">
$(document).ready(function() {
products();
});
</script>
<?php } ?>

<?php if(is_page("video")) { ?>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/colorbox.css" type="text/css" />
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.colorbox-min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
videos();
});
</script>
<?php } ?>

<?php if(is_front_page()) { ?>
<script type="text/javascript">
$(document).ready(function() {
    //if (location.href.indexOf("index.php")==-1) {
        //launchSplash();
    //}
    //else {
        //dontSplash();
    //}
});
</script>
<?php if(!is_page("Donate Money") && !is_page("Enter Your Payment Information") && !is_page("Confirm Your Donation") && !is_page("Thank You!")) { ?>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">
</script>
<?php } ?>

<?php } ?>

<!--[if IE 7]>
<style type="text/css">
	#header #title {
		height: 77px;
	}
	#whoweare #introduction {
		border-bottom: 18px solid #EEAB00;
	}
	#search-box #search-submit {
		margin-top: -18px;
	}
	#search-box #search-input {
		padding-top: 2px;
	}
	.hometouts .icon span {
		top: 20px;
	}
	#staffmembers {
		margin-bottom: 20px;
	}
	.sectionheader {
		padding: 10px 80px 10px 0px;
	}
	#required {
		margin-top: -30px;
	}
	#season1000 {
		margin-top: -30px;
	}
	#season1000 #sVideo {
		margin-top: 30px;
	}
	
	#season1000 #sIntro {
		margin-top: 45px;
	}
</style>
<![endif]-->
<!--[if IE 8]>
<style type="text/css">
	#search-box #search-input {
		padding-top: 4px;
	}
</style>
<![endif]-->
</head>
<body <?php body_class(); ?>>
<div id="mask"></div>
<div id="video-box">
	<div id="video-box-close">X</div>
	<div id="video-player">
		<iframe id="popupVideoFrame" src="/wp-content/themes/pencilsofpromise/blanker.html" width="720" height="540" frameborder="0" ></iframe>
        </div>
</div>
<div id="page">

<div id="header">
	<div id="title">
		<h1><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
		<div id="friends">
                    <div id="secondaryNav"><a href="">Our Blog</a> &nbsp; <a href="">Contact Us</a></div>
                    <div class="header-wrapper">
			<div class="counter">
				<img src="<?php bloginfo('template_directory'); ?>/gfx/onlineDonation.png" class="count" alt="Join the 200,000+ friends of PoP in Providing Access to Education" />
			</div>
                        <div class="socialheader">                           
                                <iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook.com%2Fpencilsofpromise&amp;layout=button_count&amp;show_faces=false&amp;width=125&amp;action=like&amp;font&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:97px; height:21px; float:left;" allowTransparency="true"></iframe>
				<iframe src="//platform.twitter.com/widgets/follow_button.html?_=1310157824798&amp;align=&amp;button=blue&amp;id=twitter_tweet_button_0&amp;lang=en&amp;link_color=&amp;screen_name=pencilsofpromis&amp;show_count=&amp;show_screen_name=false&amp;text_color=" allowtransparency="true" frameborder="0" scrolling="no" class="twitter-follow-button" style="width: 150px; height: 21px; float:left;" title=""></iframe>
                        </div>                      
			<!--<form action="#" method="post" class="newsletter">
				<input type="text" class="newsletter-input" name="email" value="a@b.com" />
				<input type="submit" value="Signup" id="newsletter-submit" />
			</form>-->
			<?php
					// logout link
					$current_user = wp_get_current_user();
					$pos = strpos($_SERVER["REQUEST_URI"], "?");
					if ($pos === false) {
					    $request_uri = $_SERVER["REQUEST_URI"];
					} else {
					    $request_uri = substr($_SERVER["REQUEST_URI"], 0, $pos);
					}
					
					if ( (isset($_REQUEST['logout'])) && ($_REQUEST['logout'] == 'true') ) {
					    wp_logout();
					    header("Location: " . $request_uri);
					}
		            $loginText = "";
	                if ( $current_user->ID > 0 ) {
	                    $loginText = "Hello " . $current_user->user_login . " , <a href='" . $request_uri . "?logout=true'>LOGOUT</a>";
	                } 
                ?> 
                    </div>
                    <div id="launchVideoContainer">
			        <div id="videoTout"><a href="/" id="launch-video" class="launch-video"></a></div>
                                <div id="updatesTout">
                                 
<form class="w2llead" action="https://www.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8" method="POST">
     <div class="salesforce-inputs">
       <input type=hidden name="retURL" value="<?php bloginfo('url'); ?>/signup-thanks">
       <input type=hidden name="oid" value="00DU0000000HOZT">
       <input type="text" onclick="selectAll('sf_email')" name="email" class="w2linput text" id="sf_email" value="EMAIL">
       <input type="text" onclick="selectAll('sf_phone')" name="phone" class="w2linput text" id="sf_phone" value="MOBILE">
     </div>
     <div class="salesforce-inputsubmit"><input type="submit" value="Subscribe" class="w2linput submit" name="w2lsubmit"></div>
</form>
                          
                                </div>
                    </div>
		</div>
	</div>
	<div id="navigation">		
                <ul id="menu-main-navigation" class="dropdown">
                    <li class="page_item page-item-191 <?php echo doHighlightNavItem(array( 191, 1207 ),$post); ?>"><a href="<?php bloginfo('url'); ?>/who-we-are" title="Who We Are">Who We Are</a>
                        <ul class="sub_menu">
                            <?php wp_list_pages('include=909,1207,6952,6943,7632,7630,3054,3068&depth=0&sort_column=ID&sort_order=ASC&title_li='); ?> <li><a href="<?php bloginfo('url'); ?>/our-approach">Our Approach</a></li><li><a href="<?php bloginfo('url'); ?>/our-blog">Our Blog</a></li>
                        </ul>
                    </li>
                    <li class="page_item page-item-1216 <?php echo doHighlightNavItem(array( 1216, 1242, 1245, 1247 ),$post); ?>"><a href="<?php bloginfo('url'); ?>/our-projects" title="Our Projects">Our Projects</a>
                        <ul class="sub_menu">
                            <li><a href="<?php bloginfo('url'); ?>/our-projects">Interactive Map</a></li><?php wp_list_pages('child_of=1216&depth=1&title_li='); ?>
                        </ul>                    
                    </li>
                    <li class="page_item page-item-1209 <?php echo doHighlightNavItem(array( 1209, 3183 ),$post); ?>"><a href="<?php bloginfo('url'); ?>/our-approach" title="Our Approach">Our Approach</a>
                        <ul class="sub_menu">
                            <?php wp_list_pages('child_of=1209&depth=1&title_li='); ?><?php wp_list_pages('child_of=3183&depth=1&title_li='); ?>
                        </ul>                        
                    </li>
                    <li class="page_item page-item-1252 <?php echo doHighlightNavItem(array( 10818 ),$post); ?>"><a href="<?php bloginfo('url'); ?>/fundraise" title="iPromise">Fundraise</a></li>
                    <li class="page_item page-item-204 <?php echo doHighlightNavItem(array( 204 ),$post); ?>"><a href="<?php bloginfo('url'); ?>/join-the-movement" title="Take Action">Take Action</a></li>
                    <li class="page_item page-item-1220 <?php echo doHighlightNavItem(array( 1220 ),$post); ?>"><a href="<?php bloginfo('url'); ?>/media-gallery" title="Media + Press">Media + Press</a>
                        <ul class="sub_menu">
                            <?php wp_list_pages('child_of=1220&depth=1&title_li='); ?><li><a href="<?php bloginfo('url'); ?>/gala">Pencils of Promise Gala</a></li>
                        </ul>
                    </li>
                    <li class="page_item page-item-5631 <?php echo doHighlightNavItem(array( 5631 ),$post); ?>"><a href="<?php bloginfo('url'); ?>/pop-shop" title="Store">Store</a>
                        <ul class="sub_menu">
                            <li><a href="<?php bloginfo('url'); ?>/pop-shop">PoP Shop</a></li>
                            <li><a href="http://www.pencilsofpromise.org/madewithpencils">Made with Pencils</a></li>
                            <li><a href="http://www.pencilsofpromise.org/madewithpencils/pencilshop">The Pencil Shop</a></li>
                        </ul>                    
                    </li>
                    <li class="page_item page-item-7611 <?php echo doHighlightNavItem(array( 7611 ),$post); ?>"><a href="<?php bloginfo('url'); ?>/join-the-movement/donate" title="Donate">Donate</a>
                        <ul class="sub_menu">
                            <li><a href="<?php bloginfo('url'); ?>/donate">100% Impact Giving</a></li><li><a href="<?php bloginfo('url'); ?>/donate/corporate">Corporate Partnerships</a></li>
                        </ul>                     
                    </li>                    
		</ul>
            
                <?php /* <ul id="menu-main-navigation">
		<?php wp_list_pages('include=191,1216,204,1220,2932,2927,2937,1209,5631,1252,7611&depth=1&title_li='); ?>
		</ul>*/ ?>
		
                   
                   <div><a href="/fundraise/"></a></div>            
                    <div id="fundraiserbutton">
                        <?php 
                        include 'platform_nav.php'; 
                        ?>
                    </div>
                 
		<!--<div id="search-button">
			<span></span>
		</div>
		<div class="clearfix"></div>-->
	</div>
<?php /*	<?php if(is_single() || is_author() || is_archive() || $post->post_parent == '191' || $post->post_parent == '1207' || $post->post_parent == '1207') { ?>
		<ul id="subnav"><li><a href="/who-we-are" class="subnav-goback">Back To Who We Are</a></li><?php wp_list_pages('child_of=191&depth=1&title_li='); ?><li><a href="/our-blog">Our Blog</a></li></ul>
	<?php } else if ($post->post_parent == '1216' || $post->post_parent == '1242' || $post->post_parent == '1245' || $post->post_parent == '1247') { ?>
		<ul id="subnav">
			<?php wp_list_pages('child_of=1216&depth=1&title_li='); ?>
			<li id="jumpToProject">
				<form action="<?php bloginfo('url'); ?>" method="get" id="jumpToForm">
					<strong>Jump to Project:</strong> <?php wp_dropdown_pages("depth=2&child_of=1216&sort_column=menu_order"); ?>
				</form>
			</li>
		</ul>
       <?php } else if (is_page('234') || is_page('6912') || is_page('7618')) { ?>
                    <ul id="subnav"><li><a href="/donate" class="subnav-goback">Back To Ways to Donate</a></li></ul>              
	<?php } else if (is_page('4226') || is_page('1250') || is_page('1255') || is_page('7626') || is_page('7623')) { ?>
		<ul id="subnav" class="sub-menu">
			<li><a href="<?php bloginfo('url'); ?>/join-the-movement" class="subnav-goback">Back to Take Action</a></li><?php wp_list_pages('include=4226,1250,1255,7626,7623&title_li='); ?>
		</ul>
	<?php } else if (is_page('1290') || is_page('726')) { ?>
		<ul id="subnav" class="sub-menu">
			<li><a href="<?php bloginfo('url'); ?>/join-the-movement" class="subnav-goback">Back to Take Action</a></li><?php wp_list_pages('include=1290,726&title_li='); ?>
		</ul>                    
	<?php } else if ($post->post_parent == '204' || $post->post_parent == '726' || $post->post_parent == '234' || $post->post_parent == '1255' || $post->post_parent == '2315' ) { ?>
		<ul id="subnav" class="sub-menu">
			<li><a href="<?php bloginfo('url'); ?>/join-the-movement" class="subnav-goback">Back to Take Action</a></li><li id="welcome"><?php echo $loginText; ?></li>
		</ul>                    
 	<?php } else if ($post->post_parent == '1220') { ?>
                    <ul id="subnav"><li><a href="<?php bloginfo('url'); ?>/media-gallery" class="subnav-goback">Back to Media & Press</a></li><?php wp_list_pages('child_of=1220&depth=1&title_li='); ?><li><a href="/our-blog">Blog</a></li></ul>
 	<?php } else if ($post->post_parent == '1209' || $post->post_parent == '3183') { ?>
                    <ul id="subnav"><li><a href="<?php bloginfo('url'); ?>/our-approach" class="subnav-goback">Back to Our Approach</a></li><?php wp_list_pages('child_of=1209&depth=1&title_li='); ?><?php wp_list_pages('child_of=3183&depth=1&title_li='); ?></ul>
	<?php } ?> */?>
</div>
<div id="content">
<?php    
ob_end_flush();
?>
