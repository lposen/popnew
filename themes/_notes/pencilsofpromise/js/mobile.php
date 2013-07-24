<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Mobile
*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html style="margin-top: 0px !important"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Pencils of Promise</title>
		
		
		<meta name="viewport" content="width=device-width, height=420, user-scalable=yes">
		<meta name="apple-touch-fullscreen" content="YES">
		<meta name="mobileoptimized" content="320">
		
		<link rel="stylesheet" type="text/css" media="screen,handheld" href="mobile.css">
	<link rel="stylesheet" type="text/css" media="screen,handheld"  href="<?php bloginfo('template_directory'); ?>/css/mobile.css" type="text/css" />
	
	 <!-- The JavaScript -->
	    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>		
	    <script type="text/javascript" src="jquery.easing.1.3.js"></script>
	    <script type="text/javascript">
	        $(function() {
	            $('ul.nav a').bind('click',function(event){
	                var $anchor = $(this);
	                /*
	                if you want to use one of the easing effects:
	                $('html, body').stop().animate({
	                    scrollLeft: $($anchor.attr('href')).offset().left
	                }, 1500,'easeInOutExpo');
	                 */
	                $('html, body').stop().animate({
	                    scrollLeft: $($anchor.attr('href')).offset().left
	                }, 10000);
	                event.preventDefault();
	            });
	        });
	    </script>
		
		<script type="text/javascript" src="window.js"></script>
				
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
		<script type="text/javascript" src="iphone.js"></script>


		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script src="jquery.mousewheel.js"></script>
		<script>
		$(function(){
			$("#page-wrap").wrapInner("<table cellspacing='30'><tr>");
			$(".post").wrap("<td></td>");
			$("body").mousewheel(function(event, delta) {
				this.scrollLeft -= (delta * 30);
				event.preventDefault();
			});   
		});

		</script>
		

			</head>
	
	<body class="home iphone">
		<div id="page-wrap">
			
				<img id="logo" src="images/formLogo.png">

		
		<div id="navigation">

			<div id="titlecard"><!-- titlecard -->
					<div id="titlecard-bg"><div id="menu">
						<ul class="nav">
			            <li><a href="#takeactioncard">Take Action</a></li>
						<li><a href="#">Our Story</a></li>
						<li><a href="#">Our Approach</a></li>
						<li><a href="#">Project Schools</a></li>
					</ul>
					</div><!-- menu -end -->
				</div><!-- titlecard-bg -end -->
					
			</div><!-- titlecard -end -->
			
							<div id="block"></div>

							<div id="floatcard"><!-- floatcard-->
									<div id="floatcard-bg">		
										<div id="one">
					<h2>I reached</h2>
										</div>

										<div id="two">
					<h2>into</h2>
										</div>

										<div id="three">
					<h2>my backpack,</h2>
										</div>

										<div id="four">
					<h2>handed him</h2>
										</div>

										<div id="five">
					<h2>my PENCIL,</h2>
										</div>

										<div id="six">
					<h2>and watched</h2>
										</div>	
															<div id="seven">
										<h2>as a</h2>
															</div>

															<div id="eight">
										<h2>wave of</h2>
															</div>

															<div id="nine">
										<h2>POSSIBILITY</h2>
															</div>		

															<div id="ten">
										<h2>washed</h2>
															</div>

															<div id="eleven">
										<h2>over him.</h2>
															</div></div>

						    </div><!-- floatcard - end -->
					
					
					<div id="block"></div>
					
					<div id="takeactioncard"><!-- takeactioncard-->
							<div id="takeactioncard-bg">		

								<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

								<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

								<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>?1047" type="text/css" media="screen" />
								<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ipad.css" type="text/css" media="only screen and (min-device-width : 768px) and (max-device-width : 1024px)">
								<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/vader/jquery-ui-1.8.5.custom.css" type="text/css" />
								<link href="https://plus.google.com/113501606134993950609/posts/" rel="publisher" />

								<?php wp_head(); ?>
								<script src="<?php bloginfo('template_directory'); ?>/js/jqueryui.js" type="text/javascript" charset="utf-8"> </script>
								<script src="<?php bloginfo('template_directory'); ?>/js/cufon-yui.js" type="text/javascript"> </script>
								<script src="<?php bloginfo('template_directory'); ?>/js/Sketch_Block_400.font.js" type="text/javascript"> </script>
								<script src="<?php bloginfo('template_directory'); ?>/js/Sketch_Rockwell_700.font.js" type="text/javascript"> </script>
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
								<script src="<?php bloginfo('template_directory'); ?>/js/site2.js?1023" type="text/javascript"> </script>
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
								});
								</script>
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

							
								  <form action=" " method="post"> 
								  <div class="step donation-slider"> 
								  <div class="step-number">1.</div> 
								  <div class="explanation"> 
								  Use the Slider To Select Your Desired Donation Amount. 
								  </div> 
								  <div class="form-container-nobg">

								  	<div id="slider-cont">
								  		<div id="slider" style="width: 300px"></div>
								  	</div>

								  </div> 
								  </div> 
								  <div class="step"> 
								  <div class="step-number">2.</div> 
								  <div class="explanation"> 
								  Which will show you the impact your donation can make. 
								  </div> 
								  <div class="form-container"> 
								  <div class="step-padding"> 
								  <div id="change-amount"></div>
								  <div id="change-impact"></div>
								  <input type="text" name="amount" id="input-amt" /> 
								  <span class="amount-copy-provides">enables</span> 
								  <input type="text" name="amount" id="input-days" /> 
								  <span class="amount-copy-days">Days</span> 
								  <span class="amount-copy-extra">of a child's Education</span> 
								  <div class="clearfix"></div> 
								  </div> 
								  </div> 
								  </div> 
								  	<div class="step">
										<div class="step-number black">
											3.
										</div>
										<div class="explanation black">
											Which projects would you like to receive updates from:
										</div>
										<div class="form-container-nobg">
											<div id="recurring">
												<select name="proj-name" id="input-proj" multiple onchange="" size="1">
													<?php
														global $wp_query, $post;
														$pages_query = new WP_Query();
													    $all_pages = $pages_query->query(array('post_type' => 'page', 'posts_per_page' => -1));
														//$page_id = $post->ID;
														$page_id = 1242;
														$projects = get_page_children($page_id, $all_pages);
														$i = 1;
														foreach($projects as $project) :
														?>
															<option value="<?php echo $project->post_title?>"><?php echo $project->post_title?></option>
														<?php $i++; endforeach; ?>
												</select>
											</div>
										</div>
									</div>
									<div class="step">
										<div class="step-number">
											4.
										</div>
										<div class="explanation">
											Increase your impact by making your donation recurring.
										</div>
										<div class="form-container-nobg">
											<div id="recurring">
												I believe in PoP’s sustainability programs and support for students 
												beyond the initial school build are important to me. Please make 
												my ongoing commitment recur<br />

												<input type="checkbox" name="recur_type" class="recur_type" value="monthly"> monthly /
												<input type="checkbox" name="recur_type" value="yearly" class="recur_type"> annually

											</div>
										</div>
									</div>
								  <div class="step"> 
								  <div class="step-number">4.</div> 
								  <div class="explanation"> 
								  Select your payment type to submit your donation. 
								  </div> 
								  <div class="form-container-nobg"> 
								  <div class="payment-type"> 
								  <input type="image" src="<?php bloginfo('template_directory'); ?>/gfx/iconPaypal.png" /> 
								  </div> 
								  <div id="icon-or"></div> 
								  <div class="payment-type"> 
								  <input type="image" src="<?php bloginfo('template_directory'); ?>/gfx/iconCreditCards.png" /> 
								  </div> 
								  </div> 
								  </div> 
								  </form> 

							</div>

				    </div><!-- takeactioncard - end -->

						<div id="block"></div>
						
		</div><!-- navigation -end -->
			
	
	
	</div><!-- page-wrap -end -->
</body></html>