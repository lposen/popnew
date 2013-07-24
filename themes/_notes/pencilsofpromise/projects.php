<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Projects
*/
?>

<?php get_header(); ?>

<div id="projects-top">
    <img alt="" src="<?php bloginfo('template_directory'); ?>/gfx/headerOurProjects.png">
<ul id="projects-filter">
	<li id="map-view">Map View</li>
	<li class="divider">|</li>
	<li id="list-view">List View</li>
</ul>
</div>
<div class="clearfix"></div>

<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/infobubble.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.tmpl.min.js"></script>

<!-- jQuery Templates -->

<script id="guatEstTmpl" type="text/x-jquery-tmpl">
	{{if status == "established" && location == "Guatemala"}}
		<li><a href="${permalink}">${title}</a></li>
	{{/if}}
</script>
<script id="laosEstTmpl" type="text/x-jquery-tmpl">
	{{if status == "established" && location == "Laos"}}
		<li><a href="${permalink}">${title}</a></li>
	{{/if}}
</script>
<script id="nicEstTmpl" type="text/x-jquery-tmpl">
	{{if status == "established" && location == "Nicaragua"}}
		<li><a href="${permalink}">${title}</a></li>
	{{/if}}
</script>
<script id="ghaEstTmpl" type="text/x-jquery-tmpl">
	{{if status == "established" && location == "Ghana"}}
		<li><a href="${permalink}">${title}</a></li>
	{{/if}}
</script>


<script id="guatCurTmpl" type="text/x-jquery-tmpl">
	{{if status == "current" && location == "Guatemala"}}
		<li><a href="${permalink}"><a href="${permalink}">${title}</a></a></li>
	{{/if}}
</script>
<script id="laosCurTmpl" type="text/x-jquery-tmpl">
	{{if status == "current" && location == "Laos"}}
		<li><a href="${permalink}">${title}</a></li>
	{{/if}}
</script>
<script id="nicCurTmpl" type="text/x-jquery-tmpl">
	{{if status == "current" && location == "Nicaragua"}}
		<li><a href="${permalink}">${title}</a></li>
	{{/if}}
</script>
<script id="ghaCurTmpl" type="text/x-jquery-tmpl">
	{{if status == "current" && location == "Ghana"}}
		<li><a href="${permalink}">${title}</a></li>
	{{/if}}
</script>


<script id="guatUpTmpl" type="text/x-jquery-tmpl">
	{{if status == "upcoming" && location == "Guatemala"}}
		<li><a href="${permalink}">${title}</a></li>
	{{/if}}
</script>
<script id="laosUpTmpl" type="text/x-jquery-tmpl">
	{{if status == "upcoming" && location == "Laos"}}
		<li><a href="${permalink}">${title}</a></li>
	{{/if}}
</script>
<script id="nicUpTmpl" type="text/x-jquery-tmpl">
	{{if status == "upcoming" && location == "Nicaragua"}}
		<li><a href="${permalink}">${title}</a></li>
	{{/if}}
</script>
<script id="ghaUpTmpl" type="text/x-jquery-tmpl">
	{{if status == "upcoming" && location == "Ghana"}}
		<li><a href="${permalink}">${title}</a></li>
	{{/if}}
</script>
<!-- End jQuery Templates -->


<script>
/***
 * Data
 ***/

var schools = [
<?php
	global $wp_query, $post;
	$pages_query = new WP_Query();
        $all_pages = $pages_query->query(array('post_type' => 'page', 'posts_per_page' => -1));
	$page_id = get_page_by_title('Completed Schools');
	$projects = get_page_children($page_id->ID, $all_pages);
	$i = 1;
	foreach($projects as $project) :
		$cat = simple_fields_get_post_value($project->ID, array(1, 6), true);
	?>
	{
		"title": "<?php echo $project->post_title; ?>", 
		"location": "<?php echo simple_fields_get_post_value($project->ID, "Location", true); ?>", 
		"contents": "<div class=\"locOverlay\"><div class=\"map-image\"><div class=\"school-preview\"><a href=\"<?php echo get_permalink($project->ID); ?>\"><?php echo str_replace("\"", "'", get_the_post_thumbnail($project->ID, 'project-small-thumbnail')); ?></a></div><a href=\"<?php echo get_permalink($project->ID); ?>\" class=\"visit-school\">Visit School Page</a></div> <div class=\"map-info\"><h4><?php echo $project->post_title?></h4><h5>(<?php echo simple_fields_get_post_value($project->ID, "Location", true); ?>)</h5><p><?php echo str_replace("\r\n","",truncate($project->post_content, 50)); ?></p><a href=\"<?php bloginfo('url'); ?>/join-the-movement/donate?for=<?php echo $project->post_title?>\" class=\"donate-btn\">Donate</a></div></div>",
		"status": "established",
		"permalink": "<?php echo get_permalink($project->ID); ?>",
		"latLn": [<?php echo simple_fields_get_post_value($project->ID, "Google Maps Link", true); ?>]
	},
<?php $i++; endforeach; ?>
<?php
	$pages_query = new WP_Query();
        $all_pages = $pages_query->query(array('post_type' => 'page', 'posts_per_page' => -1));
	$page_id = get_page_by_title('Ongoing Builds');
	$projects = get_page_children($page_id->ID, $all_pages);
	$i = 1;
	foreach($projects as $project) :
		$cat = simple_fields_get_post_value($project->ID, array(1, 6), true);
	?>
	{
		"title": "<?php echo $project->post_title; ?>", 
		"location": "<?php echo simple_fields_get_post_value($project->ID, "Location", true); ?>", 
		"contents": "<div class=\"locOverlay\"><div class=\"map-image\"><div class=\"school-preview\"><a href=\"<?php echo get_permalink($project->ID); ?>\"><?php echo str_replace("\"", "'", get_the_post_thumbnail($project->ID, 'project-small-thumbnail')); ?></a></div><a href=\"<?php echo get_permalink($project->ID); ?>\" class=\"visit-school\">Visit School Page</a></div> <div class=\"map-info\"><h4><?php echo $project->post_title?></h4><h5>(<?php echo simple_fields_get_post_value($project->ID, "Location", true); ?>)</h5><p><?php echo str_replace("\r\n","",truncate($project->post_content, 50)); ?></p><a href=\"<?php bloginfo('url'); ?>/join-the-movement/donate?for=<?php echo $project->post_title?>\" class=\"donate-btn\">Donate</a></div></div>",
		"status": "current",
		"permalink": "<?php echo get_permalink($project->ID); ?>",
		"latLn": [<?php echo simple_fields_get_post_value($project->ID, "Google Maps Link", true); ?>]
	},
<?php $i++; endforeach; ?>
<?php
	$pages_query = new WP_Query();
        $all_pages = $pages_query->query(array('post_type' => 'page', 'posts_per_page' => -1));
	$page_id = get_page_by_title('Upcoming Builds');
	$projects = get_page_children($page_id->ID, $all_pages);
	$i = 1;
	foreach($projects as $project) :
		$cat = simple_fields_get_post_value($project->ID, array(1, 6), true);
	?>
	{
		"title": "<?php echo $project->post_title; ?>", 
		"location": "<?php echo simple_fields_get_post_value($project->ID, "Location", true); ?>", 
		"contents": "<div class=\"locOverlay\"><div class=\"map-image\"><div class=\"school-preview\"><a href=\"<?php echo get_permalink($project->ID); ?>\"><?php echo str_replace("\"", "'", get_the_post_thumbnail($project->ID, 'project-small-thumbnail')); ?></a></div><a href=\"<?php echo get_permalink($project->ID); ?>\" class=\"visit-school\">Visit School Page</a></div> <div class=\"map-info\"><h4><?php echo $project->post_title?></h4><h5>(<?php echo simple_fields_get_post_value($project->ID, "Location", true); ?>)</h5><p><?php echo str_replace("\r\n","",truncate($project->post_content, 50)); ?></p><a href=\"<?php bloginfo('url'); ?>/join-the-movement/donate?for=<?php echo $project->post_title?>\" class=\"donate-btn\">Donate</a></div></div>",
		"status": "upcoming",
		"permalink": "<?php echo get_permalink($project->ID); ?>",
		"latLn": [<?php echo simple_fields_get_post_value($project->ID, "Google Maps Link", true); ?>]
	}<?php if($i != count($projects)) echo','; ?>
<?php $i++; endforeach; ?>
];
</script>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?v=3&amp;sensor=false"></script>

<script type="text/javascript">

var currentArray = [];
var establishedArray = [];
var upcomingArray = [];
var establishedToggle = [];
var currentToggle = [];
var upcomingToggle = [];

function initialize_map() {

/***
 * Setup
 ***/

	var myOptions = {
		zoom: 2,
		minZoom: 2,
		center: new google.maps.LatLng(8.05923,53.273438),
		panControl: false,
		mapTypeControl: false,
		streetViewControl: false,
		mapTypeId: google.maps.MapTypeId.HYBRID
	};
	
	var map = new google.maps.Map(document.getElementById("project_maps"), myOptions);
	var pencil = '<?php bloginfo('template_directory'); ?>/gfx/pencilmarker.png';
	
	//Add overlays
	var kml = new google.maps.KmlLayer("<?php bloginfo('template_directory'); ?>/kml/poploc.kml?5", {suppressInfoWindows: true, preserveViewport: true});
	kml.setMap(map);
	
	var infowindow;
	
	for (i = 0; i < schools.length; i++) {  
		var marker, i;
		var school = schools[i];
		
		var schoolStatus = schools[i]["status"];

		if(schoolStatus == "established") {
			establishedArray.push(schools[i]);
		}

		if(schoolStatus == "current") {
			currentArray.push(schools[i]);
		}

		if(schoolStatus == "upcoming") {
			upcomingArray.push(schools[i]);
		}
	}
		
	// start of established loop
	for(j = 0; j < establishedArray.length; j++) {
		var markerEstablished;
		markerEstablished = new google.maps.Marker({
			position: new google.maps.LatLng(establishedArray[j].latLn[0], establishedArray[j].latLn[1]),
			icon: pencil,
			visible: true,
			map: map
		});
		
		infowindow = new InfoBubble({
			map: map,
			content: establishedArray[j].contents,
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
	
		google.maps.event.addListener(markerEstablished, 'click', (function(markerEstablished, j) {
			return function() {
				infowindow.setContent(establishedArray[j].contents);
				infowindow.open(map, markerEstablished);
			}
		})(markerEstablished, j));
		
		establishedToggle.push(markerEstablished);
		
	} //end of established loop
	
	// start of current loop
	for(k = 0; k < currentArray.length; k++) {
		var markerCurrent;
		markerCurrent = new google.maps.Marker({
			position: new google.maps.LatLng(currentArray[k].latLn[0], currentArray[k].latLn[1]),
			icon: pencil,
			visible: true,
			map: map
		});

		infowindow = new InfoBubble({
			map: map,
			content: currentArray[k].contents,
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

		google.maps.event.addListener(markerCurrent, 'click', (function(markerCurrent, k) {
			return function() {
				infowindow.setContent(currentArray[k].contents);
				infowindow.open(map, markerCurrent);
			}
		})(markerCurrent, k));

		currentToggle.push(markerCurrent);

	} //end of current loop
	
	// start of upcoming loop
	for(m = 0; m < upcomingArray.length; m++) {
		var markerUpcoming;
		markerUpcoming = new google.maps.Marker({
			position: new google.maps.LatLng(upcomingArray[m].latLn[0], upcomingArray[m].latLn[1]),
			icon: pencil,
			visible: true,
			map: map
		});
		
		infowindow = new InfoBubble({
			map: map,
			content: upcomingArray[m].contents,
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

		google.maps.event.addListener(markerUpcoming, 'click', (function(markerUpcoming, m) {
			return function() {
				infowindow.setContent(upcomingArray[m].contents);
				infowindow.open(map, markerUpcoming);
			}
		})(markerUpcoming, m));

		upcomingToggle.push(markerUpcoming);

	} //end of upcoming loop
		
	$("#toggle-est div").addClass("active");
        $("#toggle-cur div").addClass("active");
        $("#toggle-up div").addClass("active");

	
	// Sorting the data via status
	function toggleEst() {
		if (establishedToggle) {
			for (i in establishedToggle) {
				var visibility = (establishedToggle[i].getVisible() == true) ? false : true;
				establishedToggle[i].setVisible(visibility);
			}
		}
	};
	
	function toggleCur() {
		if (currentToggle) {
			for (i in currentToggle) {
				var visibility = (currentToggle[i].getVisible() == true) ? false : true;
				currentToggle[i].setVisible(visibility);
			}
		}
	};
	
	function toggleUp() {
		if (upcomingToggle) {
			for (i in upcomingToggle) {
				var visibility = (upcomingToggle[i].getVisible() == true) ? false : true;
				upcomingToggle[i].setVisible(visibility);
			}
		}
	};
	
	google.maps.event.addDomListener(document.getElementById('toggle-est'),'click', toggleEst);
	google.maps.event.addDomListener(document.getElementById('toggle-cur'),'click', toggleCur);
	google.maps.event.addDomListener(document.getElementById('toggle-up'),'click', toggleUp);
	
	// Zoom to the countries

	function toggleAll(){
		var All = new google.maps.LatLng(8.05923,53.273438);
		map.setCenter(All);
		map.setZoom(2);
		return false;
	}
	
	function toggleLaos(){
		var Laos = new google.maps.LatLng(19.55979,103.590088);
		map.setCenter(Laos);
		map.setZoom(8);
		return false;
	}

	function toggleNic(){
		var Nicaragua = new google.maps.LatLng(12.742158, -84.732056);
		map.setCenter(Nicaragua);
		map.setZoom(8);
		return false;
	}
	
	function toggleGuat(){
		var Guatemala = new google.maps.LatLng(15.517205,-89.829712);
		map.setCenter(Guatemala);
		map.setZoom(8);
		return false;
	}
        
        function toggleGha(){
		var Ghana = new google.maps.LatLng(7.4490,-0.9056);
		map.setCenter(Ghana);
		map.setZoom(8);
		return false;
	}

	google.maps.event.addDomListener(document.getElementById('toggle-all'),'click', toggleAll);
	google.maps.event.addDomListener(document.getElementById('toggle-laos'),'click', toggleLaos);
	google.maps.event.addDomListener(document.getElementById('toggle-nic'),'click', toggleNic);
	google.maps.event.addDomListener(document.getElementById('toggle-guat'),'click', toggleGuat);
        google.maps.event.addDomListener(document.getElementById('toggle-gha'),'click', toggleGha);

} // end initialize_map()

// initialize the maps!
google.maps.event.addDomListener(window,'load', initialize_map);

</script>

<div id="maps">
	<div id="project_maps"></div>
	<div id="project-filter">
		<ul class="project-status">
			<li id="toggle-up"><div><span><?php echo countProjects('Upcoming Builds', false); ?></span> Upcoming Builds</div></li>
			<li id="toggle-cur"><div><span><?php echo countProjects('Ongoing Builds', false); ?></span> Ongoing Builds</div></li>
                        <li id="toggle-est"><div><span><?php echo countProjects('Completed Schools', false); ?></span> Completed Schools</div></li>
			
		</ul>
		
		<ul class="project-countries">
			<li><div id="toggle-all">View All</div></li>
			<li><div id="toggle-laos">View Laos</div></li>
			<li><div id="toggle-nic">View Nicaragua</div></li>
			<li><div id="toggle-guat">View Guatemala</div></li>
                        <li><div id="toggle-gha">View Ghana</div></li>
		</ul>
	</div>
</div>

<div id="list">
	
	<div id="paper-content-projects">
			<div class="tile">
					<h3><?php echo countProjects('Upcoming Builds', false); ?></h3>
					<img src="<?php bloginfo('template_directory'); ?>/gfx/projectsUpcoming.png" alt="Upcoming Builds" />
			</div>            
			<div class="tile middle">
					<h3><?php echo countProjects('Ongoing Builds', false); ?></h3>
					<img src="<?php bloginfo('template_directory'); ?>/gfx/projectsCurrent.png" alt="Ongoing Builds" />
			</div>
			<div class="tile">
					<h3><?php echo countProjects('Completed Schools', false); ?></h3>
					<img src="<?php bloginfo('template_directory'); ?>/gfx/projectsEstablished.png" alt="Completed Schools" />
			</div>            
		</div>

 	<div class="project-column">
		<h3>Guatemala</h3>
		<ul id="guatUp"></ul>
		
		<h3>Laos</h3>
		<ul id="laosUp"></ul>
		
		<h3>Nicaragua</h3>
		<ul id="nicUp"></ul>
                
                <h3>Ghana</h3>
		<ul id="ghaUp"></ul>
	</div>   
    
	<div class="project-column">
		<h3>Guatemala</h3>
		<ul id="guatCur"></ul>
		
		<h3>Laos</h3>
		<ul id="laosCur"></ul>
		
		<h3>Nicaragua</h3>
		<ul id="nicCur"></ul>
                
                <h3>Ghana</h3>
		<ul id="ghaCur"></ul>
	</div>
    
	<div class="project-column last">
		<h3>Guatemala</h3>
		<ul id="guatEst"></ul>
		
		<h3>Laos</h3>
		<ul id="laosEst"></ul>
		
		<h3>Nicaragua</h3>
		<ul id="nicEst"></ul>
                
                <h3>Ghana</h3>
		<ul id="ghaEst"></ul>
		
	</div>	
	
	<script type="text/javascript">
	/****
	* Templates
	*****/

	$("#guatEstTmpl").tmpl(schools).appendTo("#guatEst");
	$("#laosEstTmpl").tmpl(schools).appendTo("#laosEst");
	$("#nicEstTmpl").tmpl(schools).appendTo("#nicEst");
        $("#ghaEstTmpl").tmpl(schools).appendTo("#ghaEst");

	$("#guatCurTmpl").tmpl(schools).appendTo("#guatCur");
	$("#laosCurTmpl").tmpl(schools).appendTo("#laosCur");
	$("#nicCurTmpl").tmpl(schools).appendTo("#nicCur");
        $("#ghaCurTmpl").tmpl(schools).appendTo("#ghaCur");
	
	$("#guatUpTmpl").tmpl(schools).appendTo("#guatUp");
	$("#laosUpTmpl").tmpl(schools).appendTo("#laosUp");
	$("#nicUpTmpl").tmpl(schools).appendTo("#nicUp");
        $("#ghaUpTmpl").tmpl(schools).appendTo("#ghaUp");
	
	//Now remove empties
	$(".project-column ul:empty").each(function(index){ $(this).prev().remove() });

	</script>
	
</div>

<div id="projects">
	<div id="featured">
		<h2 class="project-title">Support An Upcoming Project</h2>
		<?php
			$theprojects = get_pages('sort_column=post_date&sort_order=desc');
			
			foreach($theprojects as $project) {
				
			$featured = simple_fields_get_post_value($project->ID, "Featured Project?", true);
			
			if($featured == "Yes") {
			$count++;
				    if ( $count < 4 ) {
			?>
			<div class="pentry">
				<h3><?php echo $project->post_title?> <br><span>(<?php echo simple_fields_get_post_value($project->ID, "Location", true); ?>)</span></h3>
				<div class="the-image">
					<div class="viewport">
						<a href="<?php echo get_permalink($project->ID); ?>"><?php echo get_the_post_thumbnail($project->ID,'project-small-thumbnail'); ?></a>
						<?php if(simple_fields_get_post_value($project->ID, "Goal Amount", true)!=''){ //hide amount div if blank ?>
						<div class="amount"><span>$<?php echo simple_fields_get_post_value($project->ID, "Goal Amount", true); ?></span></div>
						<?php } ?>
					</div>
				</div>
				<a href="<?php bloginfo('url'); ?>/join-the-movement/donate?for=<?php echo $project->post_title?>" class="donate-btn">Donate</a>
			</div>
			<?php
				} //end count
			} // end featured
		} //end foreach
		?>
	</div>
</div>

<?php get_footer(); ?>
