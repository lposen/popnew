
$(document).ready(function() { 	

	var isShowing = false;
	/* When item in navigation bar is clicked, hide all Timeline elements */
	$("#yearbook-nav-inner li a").click(function () {
		if(!isShowing)
     	{ 
     		$("#timeline").hide("slide", { direction: "down" }, 1000);
     		if($("#timelineNuth").css('display') == 'none') {
	     		$("#reverseNuth").hide("slide", { direction: "down" }, 1000);
	     	}
	     	if($("#reverseNuth").css('display') == 'none') {
	    		$("#timelineNuth").hide("slide", { direction: "down" }, 1000);
			}
     		isShowing = true; 
     	}
	});
	  
	/* When corner!Nuth is clicked, shows Timeline elements */
	$("#showTimeline").click(function () {
		$('.sections').hide();
		if(isShowing)
		{
			$("#timeline").show("slide", { direction: "down" }, 1000);
     		$("#timelineNavWrapper").show("slide", { direction: "down" }, 1000);
			$("#yearbook-nav-inner ul li a").removeClass("active");
			$("#timelineNuth").show("slide", { direction: "down" }, 1000);
			isShowing = false;
		}
	});	
	
	
	/* Animates Nuth walking Left/Right when the Left/Right Arrow Keys are pressed */
	
	$(window).keydown(function(e) {
	//Only animate Nuth when the timeline is showing
		if(!isShowing) {
			//Left Arrow Key
			if(e.which == 37)
			{
				$("#timeline").animate({scrollLeft: '-=100'}, 15);
				
				if($("#reverseNuth").is(":visible")){
				$("#timelineNuth").hide();
				$("#reverseNuth").show();
				$('#reverseNuth').sprite({fps: 15, no_of_frames: 10});

				}
			}
			//Right Arrow Key
			if(e.which == 39)
			{
				$("#timeline").animate({scrollLeft: '+=100'}, 15);
				if($("#timelineNuth").is(":visible")){
				$("#reverseNuth").hide();
				$("#timelineNuth").show();
				$('#timelineNuth').sprite({fps: 15, no_of_frames: 10});

				}
			}

		}
	});
	
	$("#timelineLeft").click(function() {
		$("#timeline").animate({scrollLeft: '-=100'}, 15);
	});
	$("#timelineRight").click(function() {
		$("#timeline").animate({scrollLeft: '+=100'}, 15);
	});
	
	
	/* Adds the active class to the clicked section name in yearbook navigation bar */
	
	$("#yearbook-nav-inner ul li a").click(function() {
		$("#yearbook-nav-inner ul li a").removeClass("active");
		$(this).addClass("active");

		$this = $(this);
		$id = $this.attr('href');
		$('.sections').hide();
		$($id).toggle();

	});

// Dummy code for nav	
// 	$("#yearbook-nav-inner ul li a").click(function() {
// 		$this = $(this);
// 		$id = $this.attr('id');
// 		$class = $('.'+$id);
// 		$('.xyz').hide();
// 		$class.show();
// 	}
		
		
	/* Adds the active class to the clicked section name in timeline navigation bar */
	$("#timelineNav ul li a").click(function() {
		$("#timelineNav ul li a").removeClass("active");
		$(this).addClass("active");
	});
	
	/* Animation of Nuth in the corner */
	
	$('#showTimeline').sprite({
		fps: 8,
		no_of_frames: 4,
		on_last_frame: function (obj) {
		obj.spStop();
		}
	});
	setInterval("$('#showTimeline').spStart()", 1500);
	
	/* Switches between Nuth and reverse Nuth depending on scroll position */
	
	var pleftPos = 0;
	$("#timeline").scroll(function(e) {
		var leftPos = $("#timeline").scrollLeft();
		if(pleftPos > leftPos)
		{
			$("#timelineNuth").hide();
			$("#reverseNuth").show();
		}
		else {
			$("#timelineNuth").show();
			$("#reverseNuth").hide();
		}
		pleftPos = leftPos;
		});
	
	$("#timeline").scroll(function(e) {
		var timelineLeft = $("#timeline").scrollLeft();
		if(timelineLeft > 4340 && timelineLeft < 4680)
		{
			$("#timelineNuth").hide();
			$("#reverseNuth").hide();
			$("#miniNuth").show();
		}
		else {
			$("#miniNuth").hide();
		}
		});
	
	/* Animates Nuth walking while user is scrolling (trackpad) */
		
	
	//If scrolling, animates Nuth
	$("#timeline").scroll(
	
		$.debounce(50, true, function () {
			if($("#timelineNuth").css('display') == 'none') {
				$('#reverseNuth').sprite({fps: 15, no_of_frames: 10});
				}
			if($("#reverseNuth").css('display') == 'none') {
				$('#timelineNuth').sprite({fps: 15, no_of_frames: 10});
				}
// 				$('#mtn2').pan({fps:10, speed:5, dir:'left'});
// 				$('#mtn3').pan({fps:10, speed:7, dir:'left'});
		})
	);
	
	//If stopped scrolling, stop animating Nuth
	$("#timeline").scroll(
		$.debounce(50, function () {
			if($("#timelineNuth").css('display') == 'none') {
				$('#reverseNuth').destroy();
				}
			if($("#reverseNuth").css('display') == 'none') {
				$('#timelineNuth').destroy();
				}
			// $('#mtn2').pan({pause:90000, fps:0});
//  				$('#mtn3').pan({pause:90000, fps:0, speed:0});
		})
	);
	
	//$('#mtn2').pan({fps:13, speed:3, dir:'left'});
	//$('#mtn3').pan({fps:30, speed:10, dir:'left'});

	
	var prevleftPos = 0;
	$("#timeline").scroll(function(e) {
		var timelineLeft = $("#timeline").scrollLeft();
		
		if(timelineLeft < 650 && (prevleftPos > 650))
		{
			 timeline_animate2();
		}

		if(timelineLeft < 1500)
		{
			if(timelineLeft > 650)
			{
				if(prevleftPos < 650)
					{
					timeline_animate();
					}
			}
			if(prevleftPos > 1500) 
					{
					timeline_animate2();
					}
		}
		
		if(timelineLeft > 1500 && timelineLeft < 2000)
		{
		
			if(prevleftPos < 1500)
				timeline_animate();
			else {
				if(prevleftPos > 2000) 
					timeline_animate2();
				}
		}
		
		if(timelineLeft > 2000 && timelineLeft < 2550)
		{
		
			if(prevleftPos < 2000)
				timeline_animate();
			else {
				if(prevleftPos > 2550) 
					timeline_animate2();
				}
		}
		
		if(timelineLeft > 2550 && timelineLeft < 2800)
		{
		
			if(prevleftPos < 2550)
				timeline_animate();
			else {
				if(prevleftPos > 2800) 
					timeline_animate2();
				}
		}
		
		if(timelineLeft > 2800 && timelineLeft < 3200)
		{
		
			if(prevleftPos < 2800)
				timeline_animate();
// 			else {
// 				if(prevleftPos > 3200) 
// 					timeline_animate2();
// 				}
		}
		
		if(timelineLeft > 4050 && timelineLeft < 4650&& (prevleftPos < 4050))
		{
		
			 $("#timelineNav ul li a").removeClass("active");
			$("#timelineNav ul li:nth-child(8) a").addClass("active");
		}
		
		if(timelineLeft > 4650 && timelineLeft < 5250 && (prevleftPos < 4650 || prevleftPos >5250))
		{
		
			 $("#timelineNav ul li a").removeClass("active");
			$("#timelineNav ul li:nth-child(9) a").addClass("active");
		}
		
		if(timelineLeft > 5250 && timelineLeft < 5850&& (prevleftPos < 5250 || prevleftPos >5850))
		{
		
			 $("#timelineNav ul li a").removeClass("active");
			$("#timelineNav ul li:nth-child(10) a").addClass("active");
		}
		
		if(timelineLeft > 5850 && timelineLeft < 6450 && (prevleftPos < 5850 || prevleftPos >6450))
		{
		
			 $("#timelineNav ul li a").removeClass("active");
			$("#timelineNav ul li:nth-child(11) a").addClass("active");
		}
		
		if(timelineLeft > 6450 && timelineLeft < 7050 && (prevleftPos < 6450 || prevleftPos >7050))
		{
		
			 $("#timelineNav ul li a").removeClass("active");
			$("#timelineNav ul li:nth-child(12) a").addClass("active");
		}
		
		prevleftPos = timelineLeft;

	});
	
	
	$(window).scroll(function(e) {
	
	if(window.location.hash == "#aboutus") {
		var scrollonTop = $(window).scrollTop();
		var aHeight = $("#aboutus .header").height();
		var bHeight = aHeight + $("#ourstory").height();
		var cHeight = bHeight + $("#partnerships").height();
		var dHeight = cHeight + $("#newhr").height();
		var eHeight = dHeight + $("#schoolculture").height();
		var fHeight = eHeight + $("#faculty").height();
		var gHeight = fHeight + $("#staff").height();
		var hHeight = gHeight + $("#jrstaff").height();	
	
		if(scrollonTop < aHeight) {
					if(!($("#sidebar h7").is(":visible")))
 {
				$("#sidebar h7").hide();
				$("#sidebar h7.ourstory").show(200);

				}
		}
	
		if(scrollonTop > aHeight && scrollonTop < bHeight)
			{
						if(!($("#sidebar h7.ourstory").is(":visible")))
{
			$("#sidebar h7").hide(400);
			$("#sidebar h7.ourstory").show(400);
			}
		}
			
		if(scrollonTop > bHeight && scrollonTop < cHeight)
			{
						if(!($("#sidebar h7.partnerships").is(":visible")))
{
			$("#sidebar h7").hide(400);
			$("#sidebar h7.partnerships").show(400);
			}
			}
			
		if(scrollonTop > cHeight && scrollonTop < dHeight)
			{
						if(!($("#sidebar h7.newhr").is(":visible")))
{
			$("#sidebar h7").hide(400);
			$("#sidebar h7.newhr").show(400);
			}
			}
			
		if(scrollonTop > dHeight && scrollonTop < eHeight)
			{
						if(!($("#sidebar h7.schoolculture").is(":visible")))
{
			$("#sidebar h7").hide(400);
			$("#sidebar h7.schoolculture").show(400);
			}
			}
			
		if(scrollonTop > eHeight && scrollonTop < fHeight)
			{
						if(!($("#sidebar h7.faculty").is(":visible")))
{
			$("#sidebar h7").hide(400);
			$("#sidebar h7.faculty").show(400);
			}
			}
			
		if(scrollonTop > fHeight && scrollonTop < gHeight)
			{
						if(!($("#sidebar h7.staff").is(":visible")))
{
			$("#sidebar h7").hide(400);
			$("#sidebar h7.staff").show(400);
			}
			}

		if(scrollonTop > gHeight)
			{
						if(!($("#sidebar h7.jrstaff").is(":visible")))
{
			$("#sidebar h7").hide(400);
			$("#sidebar h7.jrstaff").show(400);
			}
			}
	}
	
	
	
	if(window.location.hash == "#ourimpact") {
		var scrollonTop = $(window).scrollTop();
		var cHeight = $("#ourimpact .header").height();
		var aHeight = cHeight + $("#ourapproach").height();
		var bHeight = $("#ghana").height() + aHeight;
	
		if(scrollonTop <cHeight) {
			if(!($("#sidebar h7").is(":visible")))
 {
			$("#sidebar h7").hide();			
			$("#sidebar h7.ourapproach").show(200);
			}
		}
	
		if(scrollonTop > cHeight && scrollonTop < aHeight)
			{
			//alert(aHeight+", "+scrollonTop);
			if(!($("#sidebar h7.ourapproach").is(":visible")))
			{
			$("#sidebar h7").hide(400);
			$("#sidebar h7.ourapproach").show(400);
			}
			}
		if(scrollonTop > aHeight && scrollonTop < bHeight)
			{
			//alert(aHeight+", "+scrollonTop);
			if(!($("#sidebar h7.ghana").is(":visible")))
			{
			$("#sidebar h7").hide(400);
			$("#sidebar h7.ghana").show(400);
			}
			}
		if(scrollonTop > bHeight)
			{
			//alert(curHeight+", "+scrollonTop);
			if(!($("#sidebar h7.beyondbuild").is(":visible")))
			{
			$("#sidebar h7").hide(400);
			$("#sidebar h7.beyondbuild").show(400);
			}
			}
	}
	
	if(window.location.hash == "#outandabout") {
		var scrollonTop = $(window).scrollTop();
		var aHeight = $("#outandabout .header").height();
		var bHeight = aHeight + $("#campaigns").height();
		var cHeight = bHeight + $("#popProm").height();
		var dHeight = $("#events").height() + cHeight;
		var eHeight = $("#press").height() + dHeight;

	
		if(scrollonTop < aHeight) {
		if(!($("#sidebar h7").is(":visible")))
			{
				$("#sidebar h7").hide();			
				$("#sidebar h7.campaigns").show(200);
			}
		}
	
		if(scrollonTop > aHeight && scrollonTop < bHeight)
			{
			if(!($("#sidebar h7.campaigns").is(":visible")))
			{
			$("#sidebar h7").hide(400);
			$("#sidebar h7.campaigns").show(400);
			}
			}		
		if(scrollonTop > bHeight && scrollonTop < cHeight)
			{
			if(!($("#sidebar h7.popProm").is(":visible")))
			{
			$("#sidebar h7").hide(400);
			$("#sidebar h7.popProm").show(400);
			}	
			}		
		if(scrollonTop > cHeight && scrollonTop < dHeight)
			{
			if(!($("#sidebar h7.events").is(":visible")))
			{
			$("#sidebar h7").hide(400);
			$("#sidebar h7.events").show(400);
			}
			}
		if(scrollonTop > dHeight && scrollonTop < eHeight)
			{
			//alert(curHeight+", "+scrollonTop);
			if(!($("#sidebar h7.press").is(":visible")))
			{
			$("#sidebar h7").hide(400);
			$("#sidebar h7.press").show(400);
			}
			}
		if(scrollonTop > eHeight)
			{
			//alert(curHeight+", "+scrollonTop);
			if(!($("#sidebar h7.digipresence").is(":visible")))
			{
			$("#sidebar h7").hide(400);
			$("#sidebar h7.digipresence").show(400);
			}
			}
	}
	
	if(window.location.hash == "#financials") {
		var scrollonTop = $(window).scrollTop();
		var aHeight = $("#financials .header").height();
		var bHeight = aHeight + $("#financialssect").height();
	
		if(scrollonTop < aHeight) {
			if(!($("#sidebar h7").is(":visible")))
 {
			$("#sidebar h7").hide();			
			$("#sidebar h7.financialssect").show(200);
			}
		}
	
		if(scrollonTop > aHeight && scrollonTop < bHeight)
			{
			//alert(aHeight+", "+scrollonTop);
			if(!($("#sidebar h7.financialssect").is(":visible")))
			{
			$("#sidebar h7").hide(400);
			$("#sidebar h7.financialssect").show(400);
			}
			}
		if(scrollonTop > bHeight)
			{
			//alert(curHeight+", "+scrollonTop);
			if(!($("#sidebar h7.classof2012").is(":visible")))
			{
			$("#sidebar h7").hide(400);
			$("#sidebar h7.classof2012").show(400);
			}
			}
	}
	
	}); 
	
	
	$("#timeline").scroll(function(event) {
		var what = $(document).scrollTop();
		$("#timelineNuth").css("margin-top", 343-what);
		$("#reverseNuth").css("margin-top",343-what);
	});
	
	
	
	// initialize the maps!
	google.maps.event.addDomListener(window,'load', initialize);
	
	
 	var schools = [
// 				<?php
// 				global $wp_query, $post;
// 				$pages_query = new WP_Query();
// 				$all_pages = $pages_query->query(array('post_type' => 'page', 'posts_per_page' => -1));
// 				$page_id = get_page_by_title('Completed Schools');
// 				$projects = get_page_children($page_id->ID, $all_pages);
// 				$i = 1;
// 				foreach($projects as $project) :
// 				$cat = simple_fields_get_post_value($project->ID, array(1, 6), true);
// 				?>
// 				{
// 				"title": "<?php echo $project->post_title; ?>", 
// 				"location": "<?php echo simple_fields_get_post_value($project->ID, 'Location', true); ?>", 
// 				"contents": "<div class=\"locOverlay\"><div class=\"map-image\"><div class=\"school-preview\"><a href=\"<?php echo get_permalink($project->ID); ?>\"><?php echo str_replace('\'', "'", get_the_post_thumbnail($project->ID, "project-small-thumbnail")); ?></a></div><a href=\"<?php echo get_permalink($project->ID); ?>\" class=\"visit-school\">Visit School Page</a></div> <div class=\"map-info\"><h4><?php echo $project->post_title?></h4><h5>(<?php echo simple_fields_get_post_value($project->ID, "Location", true); ?>)</h5><p><?php echo str_replace("\r\n","",truncate($project->post_content, 50)); ?></p><a href=\"<?php bloginfo("url"); ?>/join-the-movement/donate?for=<?php echo $project->post_title?>\" class=\"donate-btn\">Donate</a></div></div>",
// 				"status": "established",
// 				"permalink": "<?php echo get_permalink($project->ID); ?>",
// 				"latLn": "[<?php echo simple_fields_get_post_value($project->ID, 'Google Maps Link', true); ?>]"
// 				}
				// ,
// 				<?php $i++; endforeach; ?>
// 				<?php
// 				$pages_query = new WP_Query();
// 				$all_pages = $pages_query->query(array('post_type' => 'page', 'posts_per_page' => -1));
// 				$page_id = get_page_by_title('Ongoing Builds');
// 				$projects = get_page_children($page_id->ID, $all_pages);
// 				$i = 1;
// 				foreach($projects as $project) :
// 				$cat = simple_fields_get_post_value($project->ID, array(1, 6), true);
// 				?>
// 				{
// 				"title": "<?php echo $project->post_title; ?>", 
// 				"location": "<?php echo simple_fields_get_post_value($project->ID, 'Location', true); ?>", 
// 				"contents": "<div class=\"locOverlay\"><div class=\"map-image\"><div class=\"school-preview\"><a href=\"<?php echo get_permalink($project->ID); ?>\"><?php echo str_replace('\'', "'", get_the_post_thumbnail($project->ID, "project-small-thumbnail")); ?></a></div><a href=\"<?php echo get_permalink($project->ID); ?>\" class=\"visit-school\">Visit School Page</a></div> <div class=\"map-info\"><h4><?php echo $project->post_title?></h4><h5>(<?php echo simple_fields_get_post_value($project->ID, "Location", true); ?>)</h5><p><?php echo str_replace("\r\n","",truncate($project->post_content, 50)); ?></p><a href=\"<?php bloginfo("url"); ?>/join-the-movement/donate?for=<?php echo $project->post_title?>\" class=\"donate-btn\">Donate</a></div></div>",
// 				"status": "current",
// 				"permalink": "<?php echo get_permalink($project->ID); ?>",
// 				"latLn": [<?php echo simple_fields_get_post_value($project->ID, "Google Maps Link", true); ?>]
// 				},
// 				<?php $i++; endforeach; ?>
// 				<?php
// 				$pages_query = new WP_Query();
// 				$all_pages = $pages_query->query(array('post_type' => 'page', 'posts_per_page' => -1));
// 				$page_id = get_page_by_title('Upcoming Builds');
// 				$projects = get_page_children($page_id->ID, $all_pages);
// 				$i = 1;
// 				foreach($projects as $project) :
// 				$cat = simple_fields_get_post_value($project->ID, array(1, 6), true);
// 				?>
// 				{
// 				"title": "<?php echo $project->post_title; ?>", 
// 				"location": "<?php echo simple_fields_get_post_value($project->ID, 'Location', true); ?>", 
// 				"contents": "<div class=\"locOverlay\"><div class=\"map-image\"><div class=\"school-preview\"><a href=\"<?php echo get_permalink($project->ID); ?>\"><?php echo str_replace('\'', "'", get_the_post_thumbnail($project->ID, "project-small-thumbnail")); ?></a></div><a href=\"<?php echo get_permalink($project->ID); ?>\" class=\"visit-school\">Visit School Page</a></div> <div class=\"map-info\"><h4><?php echo $project->post_title?></h4><h5>(<?php echo simple_fields_get_post_value($project->ID, "Location", true); ?>)</h5><p><?php echo str_replace("\r\n","",truncate($project->post_content, 50)); ?></p><a href=\"<?php bloginfo("url"); ?>/join-the-movement/donate?for=<?php echo $project->post_title?>\" class=\"donate-btn\">Donate</a></div></div>",
// 				"status": "upcoming",
// 				"permalink": "<?php echo get_permalink($project->ID); ?>",
// 				"latLn": [<?php echo simple_fields_get_post_value($project->ID, "Google Maps Link", true); ?>]
// 				}
// 				<?php if($i != count($projects)) echo','; ?>
// 				<?php $i++; endforeach; ?>
 				];
	
	circle_inflate();
	
	cloud_animate();
	
	$('.mtn').each(function() {

		var $mtn = $(this);
		$("#timeline").scroll(function() {
			var xPos = -($("#timeline").scrollLeft() * $mtn.data('speed'));
			var coords = xPos + 'px 50%';
			$mtn.css({backgroundPosition: coords});
			});
	});


});

function cloud_animate() {
    $("#clouds").
      animate({left:'+=-4000px', opacity:0.0},120000).
      animate({left:'+=4000px'},0).
      animate({right:'+=2000px'},0).
      animate({opacity:0.8},4000, cloud_animate);   
}

function plane_animate() {
    $("#plane").
      animate({left:'800px'}, 1500); 
      }
      
function bike_animate() {
	$("#bike").
	animate({left:'150px'}, 1500); 
}
 
function balloon_animate() {
	$("#balloon1").
		animate({top:'-600px', left:'-200px'}, 6250);
	$("#balloon2").
		animate({top:'-600px', left:'-82px'}, 8000);
	$("#balloon3").
		animate({top:'-600px'}, 7000);
	$("#balloon4").
		animate({top:'-600px', left: '50px'}, 5050);
	$('#bowtie').hide();
}
 
function rocket_animate() {
	$("#rocket").
	animate({top:'-600px'}, 1000); 
	$("#rocket-fire").
	animate({top:'-600px'}, 1000);
}
     
function tv_animate() {
	$("#timeline").scroll(function(e) {
	var timelineLeft = $("#timeline").scrollLeft();
	if(timelineLeft < 850 && timelineLeft > 700)
			{
			$("#tv-static").show(); 
			}
	else {
			$("#tv-static").hide(); 
		}
		});
}

function circle_inflate() {
	$("#circle").animate( {
		height: 90,
		width: 90,
		left: 126,
		top:125
		}, 2000, function(){circle_deflate();});
	}
	
function circle_deflate() {
	$("#circle").animate( {
		height: 80,
		width: 80,
		left: 132,
		top: 130,
		}, 2000, function() {circle_inflate();});
		}

function timeline_animate() {
    $("#timelineNav-arrow").
      animate({left:'+=89px'}, 100); 
}

function timeline_animate2() {
    $("#timelineNav-arrow").
      animate({left:'-=89px'}, 100); 
}

var toggle = [];

function initialize() {

	/***
	* Setup
	***/
	
	var laosMap = {
	zoom: 7,
	minZoom: 2,
	center: new google.maps.LatLng(19.55979,103.590088),
	panControl: false,
	mapTypeControl: false,
	mapTypeId: google.maps.MapTypeId.HYBRID
	};
	
	var nicMap = {
	zoom: 7,
	minZoom: 2,
	center: new google.maps.LatLng(12.742158, -84.732056),
	panControl: false,
	mapTypeControl: false,
	mapTypeId: google.maps.MapTypeId.HYBRID
	};
	
	var guatMap = {
	zoom: 7,
	minZoom: 2,
	center: new google.maps.LatLng(15.517205,-89.829712),
	panControl: false,
	mapTypeControl: false,
	mapTypeId: google.maps.MapTypeId.HYBRID
	};
	
	var ghaMap = {
	zoom: 7,
	minZoom: 2,
	center: new google.maps.LatLng(7.4490,-0.9056),
	panControl: false,
	mapTypeControl: false,
	mapTypeId: google.maps.MapTypeId.HYBRID
	};
	
	var Lmap = new google.maps.Map(document.getElementById("laos_map"), laosMap);
	var Nmap = new google.maps.Map(document.getElementById("nic_map"), nicMap);
	var Guatmap = new google.maps.Map(document.getElementById("guat_map"), guatMap);
	var Ghamap = new google.maps.Map(document.getElementById("gha_map"), ghaMap);
	
	var pencil = "<?php bloginfo('template_directory'); ?>/gfx/pencilmarker.png";

	//Add overlays
 	var kml = new google.maps.KmlLayer("<?php bloginfo('template_directory'); ?>/kml/poploc.kml?5", {suppressInfoWindows: true, preserveViewport: true});
	kml.setMap(Lmap);
	kml.setMap(Nmap);
	kml.setMap(Guatmap);
	kml.setMap(Ghamap);
	
	var infowindow;
	
	for(j = 0; j < schools.length; j++) {
	var marker;
	marker = new google.maps.Marker({
	position: new google.maps.LatLng(schools[j].latLn[0], schools[j].latLn[1]),
	icon: pencil,
	visible: true,
	map: Lmap
	});
	
	infowindow = new InfoBubble({
	map: Lmap,
	content: schools[j].contents,
	shadowStyle: 0,
	padding: 10,
	borderRadius: 5,
	borderWidth: 0,
	arrowSize: 10,
	arrowPosition: 90,
	arrowStyle: 0,
	minWidth: 500,
	maxWidth: 500,
	minHeight: 280,
	maxHeight: 280
	});
	
	google.maps.event.addListener(marker, 'click', (function(marker, j) {
	return function() {
		infowindow.setContent(schools[j].contents);
		infowindow.open(Lmap, marker);
	
	}
	})(marker, j));
	
	toggle.push(marker);
	
	}
 	
	for(j = 0; j < schools.length; j++) {
	var marker;
	marker = new google.maps.Marker({
	position: new google.maps.LatLng(schools[j].latLn[0], schools[j].latLn[1]),
	icon: pencil,
	visible: true,
	map: Nmap
	});
	
	infowindow = new InfoBubble({
	map: Nmap,
	content: schools[j].contents,
	shadowStyle: 0,
	padding: 10,
	borderRadius: 5,
	borderWidth: 0,
	arrowSize: 10,
	arrowPosition: 90,
	arrowStyle: 0,
	minWidth: 500,
	maxWidth: 500,
	minHeight: 280,
	maxHeight: 280
	});
	
	google.maps.event.addListener(marker, 'click', (function(marker, j) {
	return function() {
		infowindow.setContent(schools[j].contents);
		infowindow.open(Nmap, marker);
	
	}
	})(marker, j));
	
	toggle.push(marker);
	
	}
	
	
	for(j = 0; j < schools.length; j++) {
	var marker;
	marker = new google.maps.Marker({
	position: new google.maps.LatLng(schools[j].latLn[0], schools[j].latLn[1]),
	icon: pencil,
	visible: true,
	map: Guatmap
	});
	
	infowindow = new InfoBubble({
	map: Guatmap,
	content: schools[j].contents,
	shadowStyle: 0,
	padding: 10,
	borderRadius: 5,
	borderWidth: 0,
	arrowSize: 10,
	arrowPosition: 90,
	arrowStyle: 0,
	minWidth: 500,
	maxWidth: 500,
	minHeight: 280,
	maxHeight: 280
	});
	
	google.maps.event.addListener(marker, 'click', (function(marker, j) {
	return function() {
		infowindow.setContent(schools[j].contents);
		infowindow.open(Guatmap, marker);
	
	}
	})(marker, j));
	
	toggle.push(marker);
	
	}
	
	
	for(j = 0; j < schools.length; j++) {
	var marker;
	marker = new google.maps.Marker({
	position: new google.maps.LatLng(schools[j].latLn[0], schools[j].latLn[1]),
	icon: pencil,
	visible: true,
	map: Ghamap
	});
	
	infowindow = new InfoBubble({
	map: Ghamap,
	content: schools[j].contents,
	shadowStyle: 0,
	padding: 10,
	borderRadius: 5,
	borderWidth: 0,
	arrowSize: 10,
	arrowPosition: 90,
	arrowStyle: 0,
	minWidth: 500,
	maxWidth: 500,
	minHeight: 280,
	maxHeight: 280
	});
	
	google.maps.event.addListener(marker, 'click', (function(marker, j) {
	return function() {
		infowindow.setContent(schools[j].contents);
		infowindow.open(Ghamap, marker);
	
	}
	})(marker, j));
	
	toggle.push(marker);
	
	}
	
	
} // end initialize_map()