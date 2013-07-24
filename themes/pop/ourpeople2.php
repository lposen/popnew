  <?php echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?".">"; ?>
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
   Template Name: StayClassy
   */
   ?>
  <script src="http://code.jquery.com/jquery-1.8.1.min.js"></script>
  <script type="text/javascript">
year = 2013; month = 02; day = 28;
hour= 23; min= 59; sec= 59;
$(document).ready(function() {
	$("img.in").hover(
		function() {
			$(this).stop().animate({"opacity": "0"}, "slow");
	},
		function() {
			$(this).stop().animate({"opacity": "1"}, "slow");
	});
  });
  month= --month;
  dateFuture = new Date(year,month,day,hour,min,sec);
  function GetCount(){
		dateNow = new Date();                               
		amount = dateFuture.getTime() - dateNow.getTime()+5;
		delete dateNow;
		if(amount < 0){
				out=
				"<div id='days'><span></span>0<div id='days_text'></div></div>" + 
				"<div id='hours'><span></span>0<div id='hours_text'></div></div>" + 
				"<div id='mins'><span></span>0<div id='mins_text'></div></div>" + 
				"<div id='secs'><span></span>0<div id='secs_text'></div></div>" ;
				document.getElementById('countbox').innerHTML=out;
		}
		else{
				days=0;hours=0;mins=0;secs=0;out="";
				amount = Math.floor(amount/1000); 
				days=Math.floor(amount/86400); 
				amount=amount%86400;
				hours=Math.floor(amount/3600); 
				amount=amount%3600;
				mins=Math.floor(amount/60);
				amount=amount%60;
				secs=Math.floor(amount); 
				out=
				"<div id='days'><span></span>" + days +"<div id='days_text'></div></div>" + 
				"<div id='hours'><span></span>" + hours +"<div id='hours_text'></div></div>" + 
				"<div id='mins'><span></span>" + mins +"<div id='mins_text'></div></div>" + 
				"<div id='secs'><span></span>" + secs +"<div id='secs_text'></div></div>" ;
				document.getElementById('countbox').innerHTML=out;
				setTimeout("GetCount()", 1000);
		}
  }
  $(document).ready(function(e) {
	GetCount();
  });
  </script>
  <style>
  #mytix {
	  margin: 0;
	  float: right;
  }
  
  #tickets_info, #tickets, #time_remaining {
	  font-weight: bold;
	  font-size: 35px;
	  font-family: Arial, Helvetica, sans-serif;
	  text-transform: uppercase;
	  line-height: 50px;
	  color: #333;
  }
  
  #tickets_info {
	  font-weight: bold;
	  font-size: 20px;
	  font-family: Arial, Helvetica, sans-serif;
	  text-transform: uppercase;
	  line-height: 50px;
	  color: #333;
	  position: relative;
	  top: 30px;
  }
  
  #time_remaining {
	  font-weight: bold;
	  font-size: 35px;
	  font-family: Arial, Helvetica, sans-serif;
	  text-transform: uppercase;
	  line-height: 50px;
	  color: #333;
  }
  
  #tickets {
	  font-size: 75px;
	  padding: 5px;
	  text-align: center;
	  position: relative;
	  top: 20px;
  }
  
  .tt-tickets {
	  text-decoration: none;
	  position: relative;
	  text-shadow: none !important;
	  background-color: #F1F1F1;
	  border: white;
	  display: inline-block;
	  color: black !important;
	  width: 295px;
	  padding: 10px;
  }
  
  .question {
	  background: white;
	  color: #F7D155;
	  font-size: 14px;
	  padding: 2px 6px;
	  border-radius: 15px;
	  font-weight: 800;
	  opacity: .8;
	  float: right;
	  width: 10px;
  }
  
  #impact_graphic {
	  margin-top: 30px;
	  margin-bottom: -40px;
  }
  
  .tt-wrapper li { list-style-type: none; }
  
  .tt-wrapper li a {
	  text-decoration: none;
	  border: none;
	  text-align: center;
	  height: 135px;
	  margin-top: 18px;
  }
  
  .tt-wrapper li a .hover {
	  width: 150px;
	  padding: 10px;
	  font-size: 12px;
	  text-align: center;
	  border: 5px solid #000;
	  border-radius: 5px;
	  position: absolute;
	  pointer-events: none;
	  opacity: 0;
	  -webkit-transition: all 0.3s ease-in-out;
	  -moz-transition: all 0.3s ease-in-out;
	  -o-transition: all 0.3s ease-in-out;
	  -ms-transition: all 0.3s ease-in-out;
	  transition: all 0.3s ease-in-out;
	  transition-property: all;
	  transition-duration: 0.3s;
	  transition-timing-function: ease;
	  color: white;
	  background: black;
	  font-weight: bold;
	  right: 0;
	  margin-top: -35px;
  }
  
  .tt-wrapper li a .hover:before, .tt-wrapper li a .hover:after {
	  content: '';
	  position: absolute;
	  bottom: -15px;
	  left: 93%;
	  margin-left: -9px;
	  border-left: 10px solid transparent;
	  border-right: 10px solid transparent;
	  border-top: 10px solid black;
  }
  
  .tt-wrapper li a:hover .hover {
	  opacity: 0.7;
	  top: -10px;
  }
  
  ul {
	  margin: 0;
	  padding: 0;
  }
  
  #countbox {
	  color: #333;
	  font-family: Myriad Pro, Helvetica, sans-serif;
	  font-size: 70px;
	  width: 432px;
	  height: 130px;
	  width: 432px;
	  float: left;
	  margin-top: 12px;
  }
  
  #days {
	  float: left;
	  text-align: center;
	  background-image: url('http://www.pencilsofpromise.org//schools4all/images/flip.png');
	  background-repeat: no-repeat;
	  margin: 5px 7px 0 7px;
	  height: 89px;
	  width: 94px;
	  z-index: 1;
	  background-position-y: -9px;
	  line-height: 1.1em;
  }
  
  #days_text {
	  background-image: url('http://www.pencilsofpromise.org//schools4all/images/days_text.jpg');
	  background-position: center;
	  background-repeat: no-repeat;
	  position: relative;
	  margin-top: 0;
	  height: 26px;
	  width: 94px;
  }
  
  #hours {
	  float: left;
	  text-align: center;
	  background-image: url('http://www.pencilsofpromise.org//schools4all/images/flip.png');
	  background-repeat: no-repeat;
	  margin: 5px 7px 0 7px;
	  height: 89px;
	  width: 94px;
	  z-index: 1;
	  background-position-y: -9px;
	  line-height: 1.1em;
  }
  
  #hours_text {
	  background-image: url('http://www.pencilsofpromise.org//schools4all/images/hours_text.jpg');
	  background-position: center;
	  background-repeat: no-repeat;
	  position: relative;
	  margin-top: 0;
	  height: 26px;
	  width: 94px;
  }
  
  #mins {
	  float: left;
	  text-align: center;
	  background-image: url('http://www.pencilsofpromise.org//schools4all/images/flip.png');
	  background-repeat: no-repeat;
	  margin: 5px 7px 0 7px;
	  height: 89px;
	  width: 94px;
	  z-index: 1;
	  background-position-y: -9px;
	  line-height: 1.1em;
  }
  
  #mins_text {
	  background-image: url('http://www.pencilsofpromise.org//schools4all/images/mins_text.jpg');
	  background-position: center;
	  background-repeat: no-repeat;
	  position: relative;
	  margin-top: 0;
	  height: 26px;
	  width: 94px;
  }
  
  #secs {
	  float: left;
	  text-align: center;
	  background-image: url('http://www.pencilsofpromise.org//schools4all/images/flip.png');
	  background-repeat: no-repeat;
	  margin: 5px 7px 0 7px;
	  height: 89px;
	  width: 94px;
	  z-index: 1;
	  background-position-y: -9px;
	  line-height: 1.1em;
  }
  
  #secs_text {
	  background-image: url('http://www.pencilsofpromise.org//schools4all/images/secs_text.jpg');
	  background-position: center;
	  background-repeat: no-repeat;
	  position: relative;
	  margin-top: 0;
	  height: 26px;
	  width: 94px;
  }
  
  #days span, #hours span, #mins span, #secs span {
	  background: url('http://www.pencilsofpromise.org//schools4all/images/flip_gradient.png');
	  background-repeat: no-repeat;
	  position: absolute;
	  display: block;
	  height: 57px;
	  width: 94px;
	  margin-top: -6px;
  }
  </style>
  <br>
  <div id="impact_graphic">
	<ul id="mytix" class="tt-wrapper">
	  <li> <a class="tt-tickets" href="#"> <span class="hover">$25 = one lottery ticket. </span> <span class="question">?</span> <span id="tickets"></span><br>
		<span id="tickets_info">My tickets</span> </a> </li>
	</ul>
	<div style="width: 620px; padding-top: 5px; margin: 0; font-size: 12px;">
	  <div class="countbox"> <span id="time_remaining">Time Remaining: </span>
		<div id="countbox"></div>
	  </div>
	</div>
  </div>
  <script>
	  var total_raised=500;
	  var total_tickets=total_raised/25;
	  var myTickets=document.getElementById("tickets")
	  tickets.innerHTML=Math.floor(total_tickets);
  </script>