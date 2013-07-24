<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 Template Name: SOAP Test
*/
?> <?php

define("SOAP_CLIENT_BASEDIR", "soapclient");
$USERNAME='database@pencilsofpromise.org.develop2';
$PASSWORD='pop12345025rUqepBGEmXObS6oWayBztE';
require_once (SOAP_CLIENT_BASEDIR.'/SforcePartnerClient.php');
require_once (SOAP_CLIENT_BASEDIR.'/SforceHeaderOptions.php');

$query = "SELECT Id, FirstName, LastName from Contact";


try {
	$mySforceConnection = new SforcePartnerClient();
	$mySoapClient = $mySforceConnection->createConnection(SOAP_CLIENT_BASEDIR.'/partnerwsdl.xml');
	$mylogin = $mySforceConnection->login($USERNAME, $PASSWORD);
	//print_r($mySforceConnection->getUserInfo());
	//print_r($mylogin->userInfo);
  //echo "***** Get Server Timestamp *****\n";
  $response = $mySforceConnection->getServerTimestamp();
	//print_r($response);
 	//print_r($mySforceConnection->describeSObject('User'));  
  	$result = $mySforceConnection->query($query);
  	//print_r($result);
} catch (Exception $e) {
	print_r($e);
}
$queryResult = $mySforceConnection->query($query);
$records = $queryResult->records;
foreach ($records as $record) {
  $sObject = new SObject($record);
  echo "Id = ".$sObject->Id;
  echo "First Name = ".$sObject->fields->FirstName;
  echo "Last Name = ".$sObject->fields->LastName;
}
?><?php

get_header(); ?>

<link rel="stylesheet" media="all" type="text/css" href="http://twitter.github.com/bootstrap/assets/css/bootstrap.css" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/isotope.css" />

	<div id="primary">
		<div id="villages" class="isotope">
            <div class="banner">
                <div id="map_canvas" style="width:100%; height:700px"></div>
				<div class="country_info">
                	<h3>laos</h3>
                    <div style="float:right">
                    	<div id="chart_div"></div>
                    </div>
                	
                    <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Curabitur blandit tempus porttitor. Nullam id dolor id nibh ultricies vehicula ut id elit. Donec sed odio dui. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                    <p>Vestibulum id ligula porta felis euismod semper. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Sed posuere consectetur est at lobortis. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Cras justo odio, dapibus ac facilisis in, egestas eget quam.</p>
                    <span class="clearfix"></span>
                </div>
                
            </div>
            <section id="options">
                <ul id="filters" class="option-set" data-option-key="filter">
                    <li><a href="#" data-option-value=".laos" data-filter=".laos">Laos</a></li>
                    <li><a href="#" data-option-value=".nicaragua" data-filter=".nicaragua">Nicaragua</a></li>
                    <li><a href="#" data-option-value=".guatemala" data-filter=".guatemala">Guatamala</a></li>
                    <li><a href="#" data-option-value=".ghana" data-filter=".ghana">Ghana</a></li>
                </ul>
                <ul id="filters" class="option-set" data-option-key="filter">
                    <li><a href="#" data-option-value=".upcoming" data-filter=".upcoming">Upcoming</a></li>
                    <li><a href="#" data-option-value=".ongoing" data-filter=".ongoing">Ongoing</a></li>
                    <li><a href="#" data-option-value=".completed" data-filter=".completed">Completed</a></li>
                </ul>
                <form class="projectfilter">
                    <input type="text" id="filterinput" placeholder="find a project">
                </form>
            </section>
           
            <span class="clearfix"></span>
            <ul id="content" class="villages clearfix" role="main">
            </ul>
            <div id="villagesinfo" class="modal hide fade wide">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <div class="title">
            	<h2 id="myModalLabel">Boum Lao (Boom Laow) Prrimary School, <a>Ghana</a></h2>
                <span>Made possible by <a>Alpha Beta</a></span>
            </div>
            
            <div class="pic"></div>
            <button class="gold_button">Support a project like this</button>
          </div>
          <div class="modal-body">
          	<div class="row">
            	<div class="col span3">
                    <div class="stats">
                        <p>alpha : alpha</p>
                        <p>alpha : alpha</p>
                        <p>alpha : alpha</p>
                        <p>alpha : alpha</p>
                        <p>alpha : alpha</p>
                    </div>     		<div id="Chart_1029100" style="padding-left: 0px; padding-right: 0px; width: 200px; height: 432px;" class="inner"></div></div>
            <div class="col span9">
            	<div class="village profile">
            		<h3>Village Profile</h3>
            		<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Curabitur blandit tempus porttitor. Donec ullamcorper nulla non metus auctor fringilla. Cras mattis consectetur purus sit amet fermentum. Maecenas faucibus mollis interdum.</p>
            	</div>
            	<div class="project profile">
            		<h3>Project Profile</h3>
            		<p>Sed posuere consectetur est at lobortis. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            	</div>
            	<div class="row promise">
                	<h3>Promise Committee</h3>
            			<div class="col span3">Edivt Commodo</div>
            			<div class="col span3">Malesuada Lorem</div>
            			<div class="col span3">Lorem Tristique</div>
            			<div class="col span3">Nibh Fusce</div>
            			<div class="col span3">Lorem Malesuada</div>
            			<div class="col span3">Vulputate Moldivs</div>
            			<div class="col span3">Commodo Quam</div>
            			<div class="col span3">Parturient Ornare</div>
            			<div class="col span3">Vehicula Nullam</div>
            			<div class="col span3">Sem Ipsum</div>
            	</div>
            	<div class="programs">
            		<h3>Programs</h3>
                    <h4>Shine</h4>
            		<p>Donec ullamcorper nulla non metus auctor fringilla. Cras mattis consectetur purus sit amet fermentum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
            	</div>
            </div>
            <!--TIMELINE-->
            <h1>TIMELINE</h1>
            <div class="media">
            		<button>Before</button>
                    <button>During</button>
                    <button>After</button>
                    <div class="pic">
                        <div class="arrowleft left"><</div>
                        <div class="arrowright right">></div>
                    </div>
                    <div class="row thumbs">
                        <div class="col span1 thumb"></div>
                        <div class="col span1 thumb"></div>
                        <div class="col span1 thumb"></div>
                        <div class="col span1 thumb"></div>
                        <div class="col span1 thumb"></div>
                        <div class="col span1 thumb"></div>
                        <div class="col span1 thumb"></div>
                        <div class="col span1 thumb"></div>
                        <div class="col span1 thumb"></div>
                        <div class="col span1 thumb"></div>
                        <div class="col span1 thumb"></div>
                        <div class="col span1 thumb"></div>
                    </div>
                    </div>
            	</div>
            <hr>
            <div class="row stories">
            	<h3>Stories</h3>
            	<div class="col span5">
                	<h3>Meet Lorem</h3>
            		<div class="img"></div>
            		<p>Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Maecenas faucibus mollis interdum. Maecenas faucibus mollis interdum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Nullam id dolor id nibh ultricies vehicula ut id elit. Sed posuere consectetur est at lobortis. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    <p>Nullam id dolor id nibh ultricies vehicula ut id elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum id ligula porta felis euismod semper. Donec id elit non mi porta gravida at eget metus. Cras mattis consectetur purus sit amet fermentum.</p>
            	</div>
            	<div class="col span5">
                	<h3>Meet Ipsum</h3>
            		<div class="img"></div>
            		<p>Etiam porta sem malesuada magna mollis euismod. Vestibulum id ligula porta felis euismod semper. Curabitur blandit tempus porttitor. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Curabitur blandit tempus porttitor.</p>
                    <p>Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Maecenas faucibus mollis interdum. Aenean lacinia bibendum nulla sed consectetur. Donec ullamcorper nulla non metus auctor fringilla. Donec ullamcorper nulla non metus auctor fringilla.</p>
            	</div>
            </div>
            <hr>
            <div class="row similar">
            	<h3>Similar villages</h3>
            	<div class="col span3">
            		<div class="img"></div>
            		<div class="name">Magna Parturient</div>
            	</div>
            	<div class="col span3">
            		<div class="img"></div>
            		<div class="name">Dolor Tellus</div>
            	</div>
            	<div class="col span3">
            		<div class="img"></div>
            		<div class="name">Purus Tortor</div>
            	</div>
            	<div class="col span3">
            		<div class="img"></div>
            		<div class="name">Dolor Fermentum</div>
            	</div>
            </div>
            </div>
        <div class="modal-footer">
            <a href="#" class="btn">View More Projects in Ghana</a>
            <a href="#" class="btn btn-primary">Donate</a>
          </div>
        </div> 
            
		</div><!-- #content -->
	</div><!-- #primary -->
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.1.1.min.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() . '/js/jquery.isotope.js'?>"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() . '/js/fake-element.js'?>"></script>
<script src="https://raw.github.com/riklomas/quicksearch/master/jquery.quicksearch.js" type="text/javascript"></script>
<script>
$(function() {
   var $content = $('#content');
	$content.isotope({
	  // options
	  itemSelector : '.element',
	  layoutMode : 'fitRows'
	});
    
	var $optionSets = $('#options .option-set'),
          $optionLinks = $optionSets.find('a');

      $optionLinks.click(function(){
        var $this = $(this);
        // don't proceed if already selected
        if ( $this.hasClass('selected') ) {
          return false;
        }
		
        var $optionSet = $this.parents('.option-set');
        $optionSet.find('.selected').removeClass('selected');
        $this.addClass('selected');
		
	var options = {},
          key = $optionSet.attr('data-option-key'),
            value = $this.attr('data-option-value');
        // parse 'false' as false boolean
        value = value === 'false' ? false : value;
        options[ key ] = value;
       	$content.isotope( options );
        return false;
      });
    
    $('input#filterinput').quicksearch('#content .element', {
        'show': function() {
            $(this).addClass('quicksearch-match');
        },
        'hide': function() {
            $(this).removeClass('quicksearch-match');
        }
    }).keyup(function(){
        setTimeout( function() {
            $content.isotope({ filter: '.quicksearch-match' }).isotope(); 
        }, 100 );
    });
	});
</script>
<script type="text/javascript" src="http://twitter.github.com/bootstrap/assets/js/bootstrap-transition.js"></script>
<script type="text/javascript" src="http://twitter.github.com/bootstrap/assets/js/bootstrap-modal.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.ui.core.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.ui.widget.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.ui.progressbar.js"></script>
<script>
	$(document).ready(function(e) { 
		$("#villages .upcoming .progress").progressbar({ value: 2 });
		$("#villages .ongoing .progress").progressbar({ value: 30 });
		$("#villages .completed .progress").progressbar({ value: 100 });
			
    });
</script>
<script type="text/javascript" src="http://infogr.am/js/raphael.min.js"></script>
<script type="text/javascript" src="http://infogr.am/js/infocharts.min.js"></script>
<script type="text/javascript" src="http://infogr.am/js/infogram.min.js"></script>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Alph', 3],
          ['Beta', 1],
          ['Gamma', 1],
          ['Delta', 1],
          ['Epsilon', 2]
        ]);

        // Set chart options
        var options = {'title':'Laos Stats',
                       'width':400,
                       'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbDuyuX9pqZn7reEQNaSlHzdlo79XGiRg&sensor=false&callback=initialize"></script>

<script type="text/javascript">
function initialize() {
  
  var mapOptions = {
    zoom: 2,
    center: new google.maps.LatLng(0, 0),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  
  var map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
  setMarkers(map, countries);
  
  /*
  google.maps.event.addListener(marker, 'click', function() {
    map.setZoom(18);
    map.setCenter(marker.getPosition());
  });*/
}

var countries = [
  ['Guatamala', 15.783471,-90.230759, 4],
  ['Nicaragua', 15.781682,-90.230713, 1],
  ['Ghana', 7.580328,-1.230469, 3],
  ['Laos', 19.85627,102.495496, 2]
];

/*  var marker = new google.maps.Marker({
    position: map.getCenter(),
    map: map,
	animation: google.maps.Animation.DROP,
    title: 'Click to zoom'
  });

function toggleBounce() {

  if (marker.getAnimation() != null) {
    marker.setAnimation(null);
  } else {
    marker.setAnimation(google.maps.Animation.BOUNCE);
  }
}
*/
function setMarkers(map, locations) {
  // Add markers to the map
  var contentString = '<div id="content">'+
    '<div id="siteNotice">'+
    '</div>'+
    '<h3 id="firstHeading" class="firstHeading" style="margin-bottom: 10px;">Laos</h3>'+
    '<div id="bodyContent">'+
	'<img style="float:left" src="http://www.pencilsofpromise.org/wp-content/uploads/2012/03/Office-Warming-3-150x150.jpg">'+
    '<div style="float:right; width: 150px; margin: 5px 5px 5px 15px;"><p>Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.</p>'+
	'<a style="height: 20px; font-size: 12px; padding: 10px; display:inline-block;" class="gold_button">More info</a></div>'+
    '</div>'+
    '</div>';
	var infowindow = new google.maps.InfoWindow({
		content: contentString,
		maxWidth: 350
	});
  // Marker sizes are expressed as a Size of X,Y
  // where the origin of the image (0,0) is located
  // in the top left of the image.

  // Origins, anchor positions and coordinates of the marker
  // increase in the X direction to the right and in
  // the Y direction down.
  var image = {
    url: 'http://www.pencilsofpromise.org/wp-content/themes/pencilsofpromise/gfx/pencilmarker.png',
    // This marker is 20 pixels wide by 32 pixels tall.
    size: new google.maps.Size(30, 32),
    // The origin for this image is 0,0.
    origin: new google.maps.Point(0,0),
    // The anchor for this image is the base of the flagpole at 0,32.
    anchor: new google.maps.Point(0, 32)
  };
  // Shapes define the clickable region of the icon.
  // The type defines an HTML <area> element 'poly' which
  // traces out a polygon as a series of X,Y points. The final
  // coordinate closes the poly by connecting to the first
  // coordinate.
  var shape = {
      coord: [1, 1, 1, 20, 18, 20, 18 , 1],
      type: 'poly'
  };
  for (var i = 0; i < locations.length; i++) {
    var country = locations[i];
    var myLatLng = new google.maps.LatLng(country[1], country[2]);
    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        icon: image,
        shape: shape,
        title: country[0],
        zIndex: country[3]
    });
	  infowindow.open(map,marker);
  }}
</script>
    
					
				
	</div>
<?php get_footer(); ?>
