<?php
/*
Template Name: Yearbook
*/
?>
<meta name="viewport" content="width=device-width, maximum-scale=1.0" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/normalize.css" type="text/css" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/yearbook.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/yearbook-tablet.css" media="(min-device-width:770px) and (max-device-width:1024px)" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/yearbook-handheld.css" media="(max-width:320px)" />

<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/bookblock.css"/>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/jquery.jscrollpane.css"/>

<script src="<?php bloginfo('template_directory'); ?>/js/modernizr.custom.20855.js"></script> 

<div id="modal"></div>
<div id="greyoverlay">
    <span class="close">x</span>
</div>
<div id="yearbook"> 
<div id="yearbook-nav" class="tablet handheld">
    <div class="share">
          <!--<img src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/NAVIGATION-LOGO-2.png" >-->
          <div class="download"><img src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/download.png"></div>
          <div class="facebook">
                  <img src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/facebook.png">
          </div>
          <div class="twitter">
              <a href="https://twitter.com/share?url=https%3A%2F%2Fdev.twitter.com%2Fpages%2Ftweet-button" target="_blank">
                  <img src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/twitter.png">
              </a>
          </div>
    </div>
    
    <a class="logo" href="http://www.pencilsofpromise.org/">
        <img class="poplogo" src="http://www.pencilsofpromise.org/wp-content/themes/pencilsofpromise/gfx/logo55.png" >
        <img class="yblogo" src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/yblogo.png">
    </a> 
      
  <div id="yearbook-nav-inner"> 
      
        <ul>
          <li ><a id="showTimeline2" class="showTimeline2 active">Timeline</a></li>
          <li> <a class="aboutus" href="#aboutus">Who We Are</a> </li>
          <li> <a class="ourimpact" href="#ourimpact">Our Impact </a></li>
          <li> <a class="outandabout" href="#outandabout"> Out and About </a></li>
          <li> <a class="financials" href="#financials"> Financials </a></li>
          <div class="bar"></div>
        </ul>
        
  </div>
</div>
<div id="timeline" class="tablet handheld">
    <div id="timelineNuth" class="nuth"></div>
  <div id="reverseNuth" class="nuth"></div>
  <div id="clouds"> </div>
  <!--<div id="clouds1" class="clouda"> </div>-->
  <div id="clouds2" class="cloudb"> </div>
  <div id="clouds3" class="clouda"> </div>
  <div id="clouds4" class="cloudb"> </div>
  <div id="clouds5" class="cloudb"> </div>
  <div id="rain">
      <div id="clouds4b" class="clouda"> </div>
      <div class="rain c"><img src="http://cdn.css-tricks.com/wp-content/uploads/2012/10/animated-rain.gif"></div>
      <div id="clouds5b" class="clouda"> </div>
      <div class="rain b"><img src="http://cdn.css-tricks.com/wp-content/uploads/2012/10/animated-rain.gif"></div>
      <div id="clouds6" class="clouda"></div>
      <div class="rain"><img src="http://cdn.css-tricks.com/wp-content/uploads/2012/10/animated-rain.gif"></div>  
  </div>
  <div id="clouds7" class="cloudb"> </div>
  <div id="clouds8" class="clouda"> </div>
  <div id="clouds9" class="cloudb"> </div>
  <div id="clouds10" class="clouda"> </div>
  <div id="clouds11" class="clouda"> </div>
  <div id="clouds12" class="cloudb"> </div>
  <div id="clouds13" class="clouda"> </div>
  <div id="mtn1" class="mtn"></div>
  <div id="mtn2" class="mtn" data-speed=".5"></div>
  <div id="mtn3" class="mtn" data-speed="2"></div>
  <div id="timeline-inner">
    <div id="ground">
      <div id="grass"></div>
      <div id="dirt"></div>
      <div id="under"></div>
    </div>
    <div id="welcome">
      <div id="welcoming">
        <h4>Pencils of Promise 2012 Yearbook</h4>
        <p class="meetnuth">Meet Nuth, PoP's first student.</p>
        <p class="tour">She would like to take you on a tour through 2012 at PoP.</p>
        <div class="guide"><span>Use</span>
            <img class="" src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/keys.gif">
            <span>and</span> 
            <img class="mouse" src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/mouse.png">
            <span>to guide her</span>
         </div>
        <p class="adam">But first, a few words from our founder.</p>
        <img class="arrow" src="http://www.iphoneicon.net/icon/png/mono-icons-by-jason-cho/32/arrowright.png">
      </div>
      <div id="sun"></div>
      <div id="video"> 
        <iframe width="560" height="315" src="http://www.youtube.com/embed/AZJF7jQs624" frameborder="0" allowfullscreen></iframe>
        <div id="navbubble"> 
        </div>
      </div>
    </div>
    <div id="jan" class="month"> 
      <div class="info laos">
        <div class="infoicon" id="infolaos">i</div>
        <div id="infoboxlaos" class="info_box arrow_box_left arrow_box">
          <p>Nuth is going to take you through her hometown of Laos - where PoP built it's first school.  Enjoy!</p>
        </div>
      </div>
      <div id="nuthhut"></div>
      <div class="info hut">
        <div class="infoicon" id="infoicon1">i</div>
        <div id="infobox1" class="info_box arrow_box_left arrow_box">
          <p>Rural houses in Laos are built with local materials like wood, bamboo, or thatching grass.</p>
        </div>
      </div>
      
      <div id="billboard"></div>
      <h6 id="janheader" class="monthheader">JANUARY 2012<br>
        <span>PoP has 50 schools.</span>
      </h6>
      <div id="waterfallMtn"></div>
      <div id="waterfallTop"></div>
      <div id="tree-a"></div>
      <div id="valley"></div>
      <div id="valley-bottom">
          <div class="rock"></div>
          <div class="river"></div>
          <div class="rock right"></div>
      </div>
      <div class="info waterfall">
        <div class="infoicon" id="infoiconwf">i</div>
        <div id="infoboxwf" class="info_box arrow_box_left arrow_box">
          <p>Laos is known for its beautiful rivers and waterfalls.  Just check out this one:
          </p>
          <img src="http://www.globaltravelmate.com/uploads/images/laos/luang_prabang/luangprabang_sights_kuang_si_waterfall.jpg">
        </div>
      </div>
      <div id="ropeBridge1"></div>
      <div id="ropeBridge2"></div>
      <div id="tree-b"></div>
      <div id="ox"></div>
    </div>
    <div id="feb" class="month">
      <h6 id="newoffice" class="monthheader">FEBRUARY 2012<br>
       <span> PoP NYC moves into a grown-up office space.</span>
       <span class="schoolcount">61 Schools</span>
      </h6>
      <div class="info">
        <div class="infoicon" id="infofeb">i</div>
        <div id="infoboxtv" class="info_box arrow_box_bottom arrow_box">
          <img class="officeimg" src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/newoffice_small.jpg">
        </div>
      </div>
      
    <div id="tv"></div>
    
    <div id="nuthminihut"></div>
    <div id="tree-c"></div>
    <div id="tree-a1"></div>
    
    <div class="info">
        <div class="infoicon" id="infoiconeleph">i</div>
        <div id="infobox2" class="info_box arrow_box_bottom arrow_box">
          <p>Elephant riding is a popular tourist activity in Laos.</p>
        </div>
      </div>
      <div id="elephant"></div>
  </div>
  <div id="jun" class="month">
      <div class="info rain">
        <div class="infoicon" id="infoiconrain">i</div>
        <div id="infoboxrain" class="info_box arrow_box_right arrow_box">
          <p>Monsoon season in Laos is between May and October.  This can seriously interfere with construction!
          </p>
        </div>
      </div>
    <div id="tree-e"></div>
    <div id="tree-d"></div>
    <div id="left-sand"></div>
    <div id="lake"></div>
    <div id="right-sand"></div>
    <div id="boat"></div>
    <div id="boatshadow"></div>
    <div id="turtle"></div>
    <div id="wavea-1"></div>
    <div id="bridge-back"></div>
    <div id="bridge-front"></div>
    <div id="underground-lake"></div>
    <h6 id="kennedy" class="monthheader">JUNE 2012<br>
        <span>17 year-old Kennedy starts her bike ride cross-country for PoP</span>
    </h6>
    <div class="info kennedy">
        <div class="infoicon" id="infoiconkennedy">i</div>
        <div id="infoboxkennedy" class="info_box arrow_box_left arrow_box">
          <p>Kennedy raised enough money to build two classrooms through this trip!  Check out her and other Impossible Ones <a class="outandabout" href="#outandabout">here</a>
          </p>
        </div>
      </div>
    <div id="bike"></div>
  </div>
  <div id="jul" class="month">
    <div id="plane"></div>
    <h6 id="julyheader" class="monthheader">JULY 2012<br>
        <span>Sophia Bush donates her 30th birthday to PoP.</span>
        <span class="schoolcount">75 Schools</span>
      </h6>
      <div class="info sophia">
        <div class="infoicon" id="infoiconsophia">i</div>
        <div id="infoboxsophia" class="info_box arrow_box_left arrow_box">
          <p>Sophia built 2 schools in Guatemala for 30 for 30. Check out her and other Impossible Ones <a class="outandabout" href="#outandabout">here</a>
          </p>
        </div>
      </div>
    <div id="tree-f"></div>
    <div id="castle"></div>
    <div class="info temple">
        <div class="infoicon" id="infoicontemple">i</div>
        <div id="infoboxtemple" class="info_box arrow_box_top arrow_box">
          <p>The main religion in Laos is Buddhism.  There are many beautiful Buddhist temples throughout the country.
          </p>
        </div>
      </div>
    <div id="path"></div>
  </div>
  <div id="aug" class="month">
    
    <h6 id="augheader" class="monthheader">AUGUST 2012<br>
        <span>PoP opens offices in Ghana.</span>
      </h6>
    <div id="freeman"></div>
    <div class="info freeman">
        <div class="infoicon" id="infoiconfreeman">i</div>
        <div id="infoboxfreeman" class="info_box arrow_box_left arrow_box">
          <p>Meet Freeman, the Ghana Country Director.  Fun fact: he is fluent in Chinese!
          </p>
          <img src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/freeman.jpg">
        </div>
      </div>
    <div id="tree-g"></div>
    <div id="bush-b1"></div>
  </div>
  <div id="sep" class="month">
    <h6 id="septheader" class="monthheader">SEPTEMBER 2012<br>
        <span>PoP breaks ground in Ghana.</span><br>
        <span class="tt">Teacher training and student scholarships launch in Laos.</span>
        <span class="schoolcount">86 Schools</span>
      </h6>
    <div id="brokeground"></div>
    <div id="chalkboard"></div>
    <div class="info programming">
        <div class="infoicon" id="infoiconprogramming">i</div>
        <div id="infoboxprogramming" class="info_box arrow_box_top arrow_box">
          <p>Read more about our programming initiatives <a href="<?php bloginfo('template_directory'); ?>/yearbook/#ourimpact">here</a>
          </p>
        </div>
      </div>
    <div id="tree-h"></div>
    <h6 id="octheader" class="monthheader">OCTOBER 2012<br>
        <span>Pencils of Promise holds its second annual Gala.</span>
      </h6>
      <div class="info gala">
        <div class="infoicon" id="infoicongala">i</div>
        <div id="infoboxgala" class="info_box arrow_box_bottom arrow_box">
          <p>Moment of the night: Usher wins a puppy!
          </p>
		  <img src="http://cdn.eurweb.com/wp-content/uploads/2012/10/usher-300.jpg">
        </div>
      </div>
    <div id="balloons">
      <div id="balloon1"></div>
      <div id="balloon2"></div>
      <div id="balloon3"></div>
      <div id="balloon4"></div>
      <div id="bowtie"></div>
    </div>
    <div id="tree-g1"></div>
  </div>
  <div id="nov" class="month">
  <div id="artifacts"></div>
    <div class="info" style="display:block;">
      <div class="infoicon" id="infoicon3">i</div>
      <div id="infobox3" class="info_box arrow_box_left arrow_box">
        <img class="buddhastatue" src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/buddha_statues.png">
        <p>In November 2012, Team Laos uncovered a few 300-year-old buddha statues while breaking ground on one of our schools!</p>
      </div>
    </div>
    <div id="statue"></div>
    <div id="buddha"></div>
    <div class="info" style="display:block;">
      <div class="infoicon" id="infoicon4">i</div>
      <div id="infobox4" class="info_box arrow_box_bottom arrow_box">
        <p>The Sleeping Buddha statue is in Buddha Park, a sculpture park located 25 km southeast from Vientiane, Laos.</p>
      </div>
    </div>
    <div id="buddha-men"></div>
    <div id="tree-i"></div>
    <div id="hotair"></div>
    <h6 id="novheader" class="monthheader">NOVEMBER 2012<br>
        <span>Schools4All Launches.</span>
      </h6>
    <div id="statue1"></div>
    <div id="tree-e1"></div>
    <div id="rocket"></div>
    <div id="rocket-fire"></div>
    <div id="tree-i1"></div>
    <div id="tree-e2"></div>
   <div id="threed" class="arrow_box_bottom arrow_box">
  
    </div>
    <div class="info" style="display:block;">
     
    </div>
    <div id="school"></div>
    <div id="bush-d"></div>
  </div>
  <div id="thankyou">
      <h6 id="endheader" class="monthheader">JANUARY 2013<br>
        <span>We have one hundred schools!</span>
      </h6>
      <div class="fireworks first"></div>
      <div id="banner">
        <div class="outside">
            <div class="inside">
                <!--<span>100</span><br> Schools!-->
                <p class="hundred" >100<br>
        <span >schools!</span> </p>
            </div>
        </div>
        <div class="bannerpole first"></div>
        <div id="thankyou-under">
        </div>
        <div class="bannerpole"></div>
    </div>
    <div class="fireworks last"></div>
    <div id="educate">
        <h4>Take the next big step</h4>
        <p>Help educate a child like Nuth</p> 
        <a href="https://www.pencilsofpromise.org/join-the-movement/donate" class="donate">Donate</a>
    </div>
    <div id="video"> 
      <iframe width="380" height="185" src="http://www.youtube.com/embed/5x2yq7TZjZU" frameborder="0" allowfullscreen></iframe>
    </div>
    
  </div>
</div>
</div>
</div>
<div id="aboutus" class="sections">
  <div class="sidebar pageshadow">
    <ul>
      <li> <a href="#ourmission" class="scroll sectionblock">
        <h7 class="ourstory">Our Mission</h7><span></span>
        </a> </li>
      <li> <a href="#ourstory" class="scroll">
        <h7 class="ourstory">Our Story</h7><span></span>
        </a> </li>
      <li> <a href="#partnerships" class="scroll">
        <h7 class="partnerships">Partnerships</h7><span></span>
        </a> </li>
      <li> <a href="#newhr" class="scroll twolines">
        <h7 class="newhr">Our New <br>Homeroom</h7><span></span>
        </a> </li>
      <li> <a href="#schoolculture" class="scroll">
        <h7 class="schoolculture">School Culture</h7><span></span>
        </a> </li>
      <li> <a href="#faculty" class="scroll">
        <h7 class="faculty">The Faculty</h7><span></span>
        </a> </li>
      <li> <a href="#staff" class="scroll">
        <h7 class="staff">The Staff</h7><span></span>
        </a> </li>
      <li> <a href="#jrstaff" class="scroll">
        <h7 class="jrstaff">Junior Staff</h7><span></span>
        </a> </li>
    </ul>
    <a href="https://www.pencilsofpromise.org/join-the-movement/donate" class="donate">Donate</a>
    <div class="clearfix"></div>
  </div>
  
  
  <div class="content">
      <div id="ourmission" class="container pageshadow"> 
         <h2>Our Mission</h2>
         <div class="">
             <h4>Pencils of Promise believes every child should have access to quality education.</h4>
             <p>We create schools, programs, and global communities around the common goal of education for all.</p>
         </div>
         <img class="schoolimg" src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/mission_student.png">
     </div>
    <div id="ourstory" class="container pageshadow"> 
     <h2>Our Story</h2>
      <div class="bb-custom-wrapper">
					<div id="bb-bookblock" class="bb-bookblock">
						<div class="bb-item">
                            <div class="bb-custom-page">
                                <h3>It started with a pencil</h3>
                                  <p>In 2008, Adam Braun was a young Brown grad and consultant at Bain & Company by trade, 
                                backpacker by passion. He developed a travel habit. Adam asked one child in each country what 
                                they would want if they could have anything in the world. One boy in India said that his biggest wish 
                                was to have a pencil.</p>
                                    <p>The greatest minds all started with a pencil and paper. It’s how we learn to express ourselves and our 
                                    dreams. A pencil is the first tool to pursue a better future</p>
                            </div>
                            <div class="bb-custom-page">
                                		<img src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/PencilIcon.jpg">
                            </div>
                        </div>
						<div class="bb-item">
                            <div class="bb-custom-page">
                                <h3>Then 1 school</h3>
                                      <p>Adam put $25 into a bank account and threw himself a 25th birthday party with the goal of building 
                                one school. Together, Adam’s friends raised $25,000 which built Pha Theung, a two classroom preschool in Laos. He used Facebook to share photos of the build process and, finally, of the pre-school 
                                students on their very first day in their new classrooms. His friends saw their dollars changing lives.</p>
                              </div>  		
                              <div class="bb-custom-page">
                                        <img src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/School%20(1).png">
                            </div>
                        </div>
						<div class="bb-item hundred">
                               <div class="bb-custom-page">
                                <h3>Then 100 schools</h3>
                                      <p>They wanted to build schools of their own. So did their families. So did the companies they worked 
                                for. Adam quit his job at Bain and started Pencils of Promise, uniting his business background 
                                with his passion for social change.</p>
                                <p>Today, PoP works in Laos, Guatemala, Nicaragua and Ghana and has broken ground on over 
                                128 pre and primary schools in remote and underserved regions of these countries. Each school 
                                was made possible by a person, a family or a company as idealistic and inspired as Adam as a 
                                young backpacker.</p>
                                </div>
                               <div class="bb-custom-page">
                               </div>
					</div>
					<nav>
						<a id="bb-nav-prev" href="#" class="bb-custom-icon bb-custom-icon-arrow-left">
                            <img src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/arrow_left.png">
                        </a>
						<a id="bb-nav-next" href="#" class="bb-custom-icon bb-custom-icon-arrow-right">
                            <img src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/arrow_right.png">
                        </a>
					</nav>
				</div>
        </div>  
    </div>
    <div id="partnerships" class="container pageshadow">
        <h2>Partnerships</h2>
        <nav id="partnersnav">
            <ul>
                <li class="bandn active">
                    Barnes & Noble
                </li>
                <li class="warby">
                    Warby Parker
                </li>
                <li class="birchbox">
                    Birchbox 
                </li>
                <div class="bar"></div>
            </ul>
        </nav>
        <div class="friends">
        <div id="bandn" class="partners"> 
                   
             <p>Barnes & Noble joined the Schools4All movement 
            to inspire students to support students around the 
            world. They donated 1,000 NOOKS that were given to 
            participating schools and matched donations made to 
            the campaign during the holiday season.
            <img class="logo" src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/Barnes&nobleLogo.jpg"> 
            </p>     
            <img src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/nook.jpg">
            <div class="clearfix"></div>
        </div>
            <div id="warby" class="partners"> 
                 
                <p>Warby Parker expanded their social mission to 
                    include education by launching a limited edition 
                    line of PoP inspired sunglasses. These stylish 
                    shades were modeled by PoP ambassador, 
                    Sophia Bush, and founder Adam Braun.
                    <img class="logo" src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/warbyparker_logo.png">
                </p>
                <div class="img"> 
                    <img class="wpadam" src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/wp_adam.png" > 
                    <img class="wpsophia" src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/wp_sophia.png"> 
                </div>
            </div>
            <div id="birchbox" class="partners"> 
                
               <p>Birchbox and Pencils of Promise teamed up for 
                    “beauty school” in August. This month long promotion 
                    engaged Birchbox’s subscribers in a collective effort to 
                    build a school in Guatemala.
                    <img class="logo" src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/birchbox_logo.png">
                </p> 
                 <img class="bbschool" src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/birchbox_school.png">
                 <img class="box" src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/birchbox_yellow.png">
                
            </div>
            <div class="clearfix">
        </div>   
    </div>
    </div>  
    <div id="newhr" class="container pageshadow tablet">
        <h2>Our New Homeroom</h2>
        <div class="inner">
         <p class="yellowcorner">In February 2012, we finally graduated into our very own office space in Chelsea, NYC. Our staff has grown from 10 to 70 in just two years, so we needed a new office to accomodate our growing team.</p>
         <div class="movetimeline">
             <div class="ten block">
                 <div class="left">
                     <img src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/office_assets_11.png">
                     <img class="arrow" src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/office_assets_14.png">
                 </div>
                 <div class="text">
                     <img src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/office_assets_03.png">
                     <h4>July 2010</h4>
                     <p>We open our 1st PoP office in NYC!</p>
                     <div class="line one"></div>
                 </div>    
             </div>
             <div class="twelve block">
                 <div class="left">
                     <img src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/office_assets_08.png">
                     <img class="arrow" src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/office_assets_19.png">
                 </div>
                 <div class="text">
                     <img src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/office_assets_05.png">
                     <h4>February 2012</h4>
                     <p>We graduated to a 5,000 square foot space in the Flatiron District.</p>
                     <div class="line two"></div>
                 </div>
             </div>
             <hr class="yellow">
             <div class="circle one">2010</div>
             <div class="circle two">2011</div>
             <div class="circle three">2012</div>
             <div class="eleven block">
                 <div class="line three"></div>
                 <div class="right">
                     <img src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/office_assets_28.png">
                     <img class="arrow" src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/office_assets_31.png">
                 </div>
                 <div class="text">
                     <img src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/office_assets_25.png">
                     <h4>September 2010</h4>
                     <p>We needed more space, so we moved down to the LES.</p>
                 </div>
             </div>
         </div>
         
      <div id="OS-seatingchart" class="tablet">
          <h4>Team Seating Chart</h4>
        <div id="OS-chart">
             <div id="management" class="subtitle tablet"> MANAGEMENT</div>
          <div id="impactdev" class="subtitle tablet"> IMPACT<br>&<br>DEVELOPMENT</div>
          <div id="digital" class="subtitle tablet"> DIGITAL<br>&<br>DEVELOPMENT</div>
          <div id="interntable" class="subtitle tablet"> INTERNS</div>

          <table >
            <tr>
              <td class="seat">
                  <div class="OS-circle"></div>
                  <div class="staff">Emily Gore
                      <span>Director of International Programs</span>
                  </div>
              </td>
              <td class="seat">
                  <div class="OS-circle"></div>
                  <div class="staff">TOM CASAZZONE
                      <span> Chief Financial Officer</span>
                  </div>
              </td>
              <td class="seat">
                  <div class="OS-circle"></div>
                  <div class="staff">MELANIE STEVENSON
                      <span>Chief Operating Officer</span>
                  </div>
              </td>
              <td class="seat">
                  <div class="OS-circle"></div>
                  <div class="staff">WENDY WECKSELL
                      <span>Head of Strategic Relationships</span>
                  </div>
              </td>
            </tr>
            <tr class="management">
              <td><div class="OS-seat"></div></td>
              <td><div class="OS-seat"></div></td>
              <td><div class="OS-seat"></div></td>
              <td><div class="OS-seat"></div></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td class="seat">
                  <div class="OS-circle"></div>
                  <div class="staff">Emmanuel Novy
                      <span>Impact Evaluation Analyst</span>
                  </div>
              </td>
              <td class="seat">
                  <div class="OS-circle"></div>
                  <div class="staff">Kaitlyn Phillips
                      <span>International Programs Coordinator</span>
                  </div>
              </td>
              <td></td>
              <td class="seat">
                  <div class="OS-circle"></div>
                  <div class="staff">Rachele Aidala
                      <span>Community Outreach Coordinator</span>
                  </div>
              </td>
            </tr>
            <tr>
              <td><div class="impact OS-seat"></div></td>
              <td><div class="impact OS-seat"></div></td>
              <td></td>
              <td><div class="dev OS-seat"></div></td>
            </tr>
            <tr>
              <td><div class="impact OS-seat"></div></td>
              <td><div class="impact OS-seat"></div></td>
              <td></td>
              <td><div class="dev OS-seat"></div></td>
            </tr>
            <tr>
              <td class="seat">
                  <div class="OS-circle"></div>
                  <div class="staff">Leslie Engle Young
                      <span>Associate Director of International Programs</span>
                  </div>
              </td>
              <td class="seat">
                  <div class="OS-circle"></div>
                  <div class="staff">Jackie Roshan
                      <span>Finance Coordinator</span>
                  </div>
              </td>
              <td></td>
              <td class="seat">
                  <div class="OS-circle"></div>
                  <div class="staff">Scott Daily
                      <span>Business Development Coordinator</span>
                  </div>
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td class="seat">
              </td>
              <td class="seat">
                  <div class="OS-circle"></div>
                  <div class="staff">Loren Posen
                      <span>Developer</span>
                  </div>
              </td>
              <td></td>
              <td class="seat">
                  <div class="OS-circle"></div>
                  <div class="staff">Caroline Humphrey
                      <span>Special Projects</span>
                  </div>
              </td>
            </tr>
            <tr>
              <td><div class="dig OS-seat"></div></td>
              <td><div class="dig OS-seat"></div></td>
              <td></td>
              <td><div class="dig OS-seat"></div></td>
            </tr>
            <tr>
              <td><div class="dig OS-seat"></div></td>
              <td><div class="dig OS-seat"></div></td>
              <td></td>
              <td><div class="dig OS-seat"></div></td>
            </tr>
            <tr>
              <td class="seat">
                  <div class="OS-circle"></div>
                  <div class="staff">Ali Jones
                      <span>Development Coordinator</span>
                  </div>
              </td>
              <td class="seat">
                  <div class="OS-circle"></div>
                  <div class="staff">Carlo Dumandan
                      <span>Digital Media Manager</span>
                  </div>
              </td>
              <td></td>
              <td class="seat">
                  <div class="OS-circle"></div>
                  <div class="staff">Megan O’Connor
                      <span>Associate Director of Development</span>
                  </div>
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td class="seat">
                  <div class="OS-circle"></div>
                  <div class="staff intern">Interns</div>
              </td>
              <td class="seat">
                  <div class="OS-circle"></div>
                  <div class="staff intern">Interns</div>
              </td>
              <td class="seat">
                  <div class="OS-circle"></div>
                  <div class="staff intern">Interns</div>
              </td>
              <td class="seat">
                  <div class="OS-circle"></div>
                  <div class="staff intern">Interns</div>
              </td>
            </tr>
            <tr class="interns">
              <td><div class="OS-seat"></div></td>
              <td><div class="OS-seat"></div></td>
              <td><div class="OS-seat"></div></td>
              <td><div class="OS-seat"></div></td>
            </tr>
            <tr class="interns">
              <td><div class="OS-seat"></div></td>
              <td><div class="OS-seat"></div></td>
              <td><div class="OS-seat"></div></td>
              <td><div class="OS-seat"></div></td>
            </tr>
            <tr>
              <td class="seat">
                  <div class="OS-circle"></div>
                  <div class="staff intern">Interns</div>
              </td>
              <td class="seat">
                  <div class="OS-circle"></div>
                  <div class="staff intern">Interns</div>
              </td>
              <td class="seat">
                  <div class="OS-circle"></div>
                  <div class="staff intern">Interns</div>
              </td>
              <td class="seat">
                  <div class="OS-circle"></div>
                  <div class="staff intern">Interns</div>
              </td>
            </tr>
          </table>
        </div>
      </div>
      <div class="stats">
          <div class="thanks">
              <h4>Build-out special thanks to:</h4>
              <ul>
                <li>Petretti & Associates</li>
                <li>26 Street Design Inc</li>
              </ul>
          </div>
          <div class="thanks2">
              <h4>Also Thanks To:</h4>
              <ul class="double column large">
                <li>Lawrence Petretti</li>
                <li>Irina Makarova</li>
                <li>David Ward</li>
                <li>Patrick Burns</li>
                <li>Travis Brennan</li>
                 <li>Alex Bernabo and Diego Hodara</li>
             </ul>
             <ul class="double column large">
                <li>Wood Designs</li>
                <li>Rivco Construction, LLC.</li>
                <li>National Acoustics, Inc.</li>
                <li>ADCO Electrical Corporation</li>
                <li>The New York Century Group</li>
                <li>Empire Architectural Metal Corp.</li>
             </ul>
             <ul class="double column large">
                <li>Murray Hill Painting Co., Inc.</li>
                <li>Modern Fan Company</li>
                <li>LV Wood</li>
                <li>Sliding Door Company</li>
                <li>Fat Boy Bean Bags</li>
                <li>Maxus Group</li>
              </ul>
         </div>
         <div class="clearfix"></div>
       </div>
       <div class="clearfix"></div>
       </div>
    </div>
    <div id="schoolculture" class="container pageshadow tablet">
        <h2>School Culture</h2>
          <div id="ca-container" class="ca-container">
          <div class="ca-wrapper">
              <div class="ca-item ca-item-1">   
                  <img src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/FatBoyIcon%20copy.png">
                  <h4>faVoRITe PlaCe To loUnGe</h4>
                  <p>FatBoy Bean Bag</p>
              </div>
              <div class="ca-item ca-item-2">
                  <img src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/MusicIcon.jpg">
                  <h4>Soundtrack to our year</h4>
                  <p>Mumford & Sons</p>
              </div>
              <div class="ca-item ca-item-3">
                  <img src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/BookIcon.jpg">
                  <h4>FAVORITE BOOK</h4>
                  <p>Poor Economics by Abhijit Banerjee & Esther Duflo</p>
              </div>
              <div class="ca-item ca-item-4">
                  <img src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/BearIcon.jpg">
                  <h4>MOST UNIQUE OFFICE ITEM</h4>
                  <p>Giant Teddy Bear</p>
              </div>
              <div class="ca-item ca-item-5">
                  <img src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/TshirtIcon.jpg">
                  <h4>UNIFORM</h4>
                  <p>Jeans and T-Shirt. <br>
                  Looks good on anyone!</p>
              </div>
              <div class="ca-item ca-item-6">
                  <img src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/CandyIcon.jpg">
                  <h4>FAVORITE SNACKS</h4>
                  <p>Popchips and Skittles</p>
              </div>
           </div>
      </div>
    </div>
    <div id="faculty" class="container pageshadow">
        <h2>Faculty</h2>
        <div class="inner">
          <div class="facultymember">
              <img src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/adam.jpg">
            <h4>Adam Braun</h4>
            <p>Founder, CEO</p>
            <p >Most likely to audition for a Bob Dylan biopic</p></div>
          <div class="facultymember"><img src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/mem_20120321_212-261.jpg">
            <h4>Tom Casazzone</h4>
            <p>Chief Financial Officer</p>
            <p>Freshest Dresser</p></div>
          <div class="facultymember"><img src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/lesliebw1.jpg">
            <h4>Leslie Engle Young</h4>
            <p>Associate Director of International Programs</p>
            <p >Most likely to be on ESPN</p></div>
          <div class="facultymember"><img src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/freeman.jpg">
            <h4>FREEMAN GOBAH</h4>
            <p>Ghana Country Director</p>
            <p >Most likely to reinvent the handshake</p></div>
          <div class="facultymember">
          <img src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/mem_20120326_220-23-21.jpg">
            <h4>EMILY GORE</h4>
            <p>Director of International Programs</p>
            <p >Most likely to beat you at
              German strategic board games</p>
              </div>
          <div class="facultymember"><img src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/lanoy_pop.jpg">
            <h4>LANOY KEOSUVAN</h4>
            <p>Laos Country Director</p>
            <p >Most likely to slam dunk</p></div>
          <div class="facultymember"><img src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/ya-loaoxayda1.jpg">
            <h4>YA LAOXAYdA</h4>
            <p>Laos Deputy Country Director</p>
            <p >Most likely to become a translator</p></div>
          <div class="facultymember"><img src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/jesse_profile.png">
            <h4>JESSE SCHAUBEN</h4>
            <p>Guatemala Country Director</p>
            <p >Most likely to be on Broadway</p></div>
          <div class="facultymember"><img src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/melanie_profile.png">
            <h4>MELANIE STEVENSON</h4>
            <p>Chief Operating Officer</p>
            <p>Most likely to work at Skittles </p></div>
          <div class="facultymember"><img src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/mem_20120321_212-23-2-(1)1.jpg">
            <h4>WENdY WECKSELL</h4>
            <p>Head of Strategic Relationships</p>
            <p >Most likely to start a dance off </p></div>
          <div class="facultymember"><img src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/WHO-WE-ARE-FINAL-10.jpg">
            <h4>MeGan O'Connor</h4>
            <p>Associate Director of Development </p>
            <p >Most likely to raid your nana’s closet </p>
          </div>
          <div class="clearfix"></div>
          </div>
    </div>
    <div class="clearfix"></div>
    <div id="staff" class="container pageshadow">
        <h2>Staff</h2>
        <div class="staff">
          <ul class="double column left large">
              <h3> New York City</h3>
              <li>Adam Braun, Founder, CEO</li>
              <li>Tom Casazzone, Chief Financial Officer</li>
              <li>Melanie Stevenson, Chief Operating Officer</li>
              <li>Emily Gore, Director of International Programs</li>
              <li>Wendy Wecksell, Head of Strategic Relationships</li>
              <li>Megan O’Connor, Associate Director of Development</li>
              <li>Leslie Engle Young, Associate Director of International Programs</li>
              <li>Kaitlyn Phillips, International Programs Coordinator</li>
              <li>Emmanuel Novy, Impact Evaluation Analyst</li>
              <li>Jackie Roshan, Finance Coordinator</li>
              <li>Ali Jones, Development Coordinator</li>
              <li>Rachele Aidala, Community Outreach Coordinator</li>
              <li>Scott Daily, Business Development Coordinator</li>
              <li>Carlo Dumandan, Digital Media Manager</li>
              <li>Loren Posen, Developer</li>
            </ul>
           <ul class="double column right large">
                <h3> Guatemala</h3>
                <li>Jesse Schauben, Guatemala Country Director</li>
                <li>Sam Tabory, Projects Manager</li>
                <li>Claire Mocha, Programs Manager</li>
                <li>Victoria Reyes, Scholarship Fellow</li>
                <li>Marlon Alvarado, Boca Costa Regional Coordinator</li>
                <li>Anastasia Ajanel Xon, Monitoring and Evaluation Coordinator</li>
                <li>Diego Guzmán, Quiche Regional Coordinator</li>
                <li>Edwin Cosme De León, Construction Coordinator</li>
                <li>Moisés López, Programs Technician</li>
                <li>Esperanza Canay, Programs Coordinator</li>
                <li>Nilvia González, Administration Coordinator</li>
                <li>Sergio Perez, Driver</li>
                <li>Antonia Pastor, Boca Costa Community Engagement Technician</li>
                <li>Martin Momoda, Global Teacher and Training Specialist</li>  
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
        <div class="staff two">
            <ul class="double column left large">
                <h3>Ghana</h3>
                <li>Freeman Gobah, Ghana Country Director</li>
                <li>Anthony Quashigah, Ghana Construction Coordinator</li>
                <li>Jessica Crawford, Ghana Start-up Fellow</li>
                <li>Hilda Delali, Ghana Office Coordinator</li>
                <li>Becky Dale, Ghana Intern</li>
            </ul>
            <ul class="double column right large">
                <h3>Nicaragua </h3>
              <li>Robin Smith, Nicaragua Country Director</li>
              <li>Omar Martinez, Construction Manager</li>
            </ul>
        </div>
        <div class="clearfix"></div>
        <div class="staff three">
            <h3>Laos</h3>
          <ul class="double column left large">
            <li>Lanoy Keosuvan, Lao Country Director</li>
            <li>Guiliya (Ya) Laoxayda, Lao Deputy Country Director</li>
            <li>Bay Soulivanh, Finance and HR Manager</li>
            <li>Megan Williams, Programs Manager</li>
            <li>Jua Yang, Deputy Programs Manager</li>
            <li>Valeria Gutierrez Gonzalez, Community Engagement Coordinator 
            (Fellow)</li>
            <li>Mailee Thor, Office Assistant</li>
            <li>Khamkeuang Chitavanh, Head Contractor</li>
            <li>Phanh Keoboupha, Construction Coordinator</li>
            <li>Thanongsay Chittaphai, Information Coordinator</li>
            <li>Khamla Souksombath, Programs Coordinator</li>
            <li>Siamphai Phanthavong, Programs Coordinator</li>
            <li>Somlet Rattanasouvanhnaphon, Programs Coordinator</li>
            <li>Kheuathong Soukhaserm, Programs Coordinator</li>
          </ul>
          <ul class="double column right large">
            <li>Leevong Lao, Programs Coordinator</li>
            <li>Khamhoung Phoumsomdee, Programs Coordinator</li>
            <li>Khamphat Lattana, Programs Coordinator</li>
            <li>Thong Dee, Programs Coordinator</li>
            <li>Maina Lao, Programs Coordinator</li>
            <li>Untou Yan Sanesay, Programs Coordinator</li>
            <li>Huasay Xong, Programs Coordinator</li>
            <li>Xeng Lee, Programs Coordinator</li>
            <li>Pok Souladeth, Programs Coordinator</li>
            <li>Mai Sa, Programs Coordinator</li>
            <li>Sisavat Sionetah, Programming Coordinator</li>
            <li>Bounlam Khanty, Programming Coordinator</li>
            <li>Ai Phon Inthajak, Construction Coordinator</li>
            <li>Noy Phanthavong, Cleaning lady</li>
            <li>Ai Mai, Driver</li>
          </ul>
       </div>
       <div class="clearfix"></div>
    </div>
    <div id="jrstaff" class="container pageshadow">
        <h2>Junior Staff</h2>
        <h3>2012 Interns</h3>
      <ul class="column large">
        <li>Bryan Angelo</li>
        <li>Maria Angelov</li>
        <li>Callie Bauer</li>
        <li>Melissa Berger</li>
        <li>Sam Buchbauer</li>
        <li>Mike Carlino</li>
        <li>Julia Carvalho</li>
        <li>Gary Chan</li>
        <li>Lawrence Cherkasov</li>
        <li>Chloe Corsini</li>
        <li>Madeline Eckles</li>
        <li>Emily Eller</li>
        <li>Katrina Davies</li>
        <li>Margaret Derby</li>
        <li>Bridgette Doran</li>
        <li>Tracey Dunham</li>
      </ul>
      <ul class="column large">
         <li>Caitlin Flynn</li>
         <li>Joseph Frantz</li>
         <li>Emily Gardiner</li>
         <li>Katrina Garry</li>
         <li>Sarah Gellman</li>
         <li>Brenna Goodsit</li>
         <li>Julie Gordon</li>
         <li>Olivia Hallisey</li>
         <li>David Hamburger</li>
         <li>Lucy Hamilton</li>
         <li>Margaret Heftler</li>
         <li>Amy Ho</li>
         <li>Kristin Hodge</li>
         <li>Foster Hodge</li>
         <li>Kayla Horibe </li>
         <li>Caroline Humphrey</li>
      </ul>
      <ul class="column large">
        <li>Tanvi Jetsey</li>
        <li>Betsy Kaeberle</li>
        <li>Sophie Kaldenhoven</li>
        <li>Eunice Kang</li>
        <li>Lexi Kaplan</li>
        <li>David Karp</li>
        <li>Samantha Lee</li>
        <li>Lilly Mack</li>
        <li>Brittany Macleod</li>
        <li>Colin Malefakis</li>
        <li>Kerstin Marzullo</li>
        <li>Suzanne Maietta</li>
        <li>Taylah McIlwaine</li>
        <li>Alexis Medina</li>
        <li>Talya Minsberg</li>
        <li>Andi Morris</li>
      </ul>
      <ul class="column large">
            <li>Kaitlin Nicolini</li>
            <li>Lily Osman</li>
            <li>Alyssa Pack</li>
            <li>Crystal Pang</li>
            <li>Nupur Patel</li>
            <li>Victoria Reyes</li>
            <li>Jessenia Rios</li>
            <li>Tyler Russo</li>
            <li>Ena Selmanovic</li>
            <li>Alexa Singer</li>
            <li>Anjana Singhwi</li>
            <li>Alexa Spieler</li>
            <li>Michael Stewart</li>
            <li>Julia Taitz</li>
            <li>Anna Tarassishina</li>
            <li>Katia Teran</li>
      </ul>
      <ul class="column large">
            
            <li>Arlene Thompson</li>
            <li>Ben Vallimarescu</li>
            <li>Merlixse Ventura</li>
            <li>Mike Vignapiano</li>
            <li>Julia Ward</li>
            <li>Shannon Whittaker</li>
            <li>Deborah Youngdahl</li>
      </ul>
      <div class="clearfix"></div>
    </div>
  </div>
</div>
<div id="ourimpact" class="sections">
  <div class="sidebar pageshadow">
    <ul>
      <li>
          <a href="#ghana" class="scroll sectionblock">
              <h7 class="ghana">Ghana</h7><span></span>
          </a> 
      </li>
      <li>
          <a href="#ourapproach" class="scroll">
              <h7 class="ourapproach">Our Approach</h7><span></span>
          </a> 
      </li>
      <li>
          <a href="#programming" class="scroll">
            <h7 class="programming">Programming</h7><span></span>
          </a> 
      </li>
      <li>
          <a href="#impactmetrics" class="scroll twolines">
            <h7 class="impactmetrics">Impact<br> Metrics</h7><span></span>
          </a> 
      </li>
    </ul>
    <a href="https://www.pencilsofpromise.org/join-the-movement/donate" class="donate">Donate</a>
  </div>
  <div class="content">
  <div id="ghana" class="  container pageshadow"> 
      <h2>Hello, Ghana!</h2>
      <div id="helloghana"></div>
      <p>Our biggest news from 2012 is our <span class="dark">expansion 
into Ghana</span>. With a presence in Africa, we can 
use all of the lessons learned from Nicaragua, 
Laos and Guatemala to best provide access to 
quality education to young Ghanaian students. </p>
<p>When considering expansion into new countries, 
we carefully consider the stability of the national 
government so we can effectively partner with 
Ministries of Education. In addition to government 
stability, we take into account community 
investment in education, a clear need for access 
to quality education and the potential for local 
leadership (You’ll meet Freeman soon!). Ghana 
checked all of these boxes.</p>
<img class="ghanaimg full" src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/ghana.jpg">
      <h3>Meet Freeman</h3>
      <img class="freemanimg" src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/freeman.png">
      <!--<img src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/freeman.jpg">-->
      <p class="freeman title">FREEMAN GOBAH<br/>
       <span>Ghana Country Director</span></p>

<p>Since the founding of Pencils of Promise, we knew that foreigners shouldn’t be 
doing the work. We knew there were people in our partner countries who were 
better equipped, locally dedicated and capable of spearheading movements of 
change in their own countries in a way that foreigners could never quite do. We 
believe local leadership is the only answer to sustainable change.</p>
<p>In 2012, our vision of local leadership started in Ghana with the hiring of <span class="dark">Freeman 
Gobah</span>, a Ghanaian with incredible experience, knowledge, and dedication to 
education in his country. In just a few short months he has been able to partner 
with the government and to build 5 schools - people like Freeman are the 
solution.</p>
      <div id="freemanquote"> “MY PASSION OvEr tHE YEArS 
        IS tO ENGAGE ANd MObILIzE 
        INdIvIduALS ANd COMMuNItIES tO 
        POSItIvELY IMPACt tHEIr LIvES.” </div>
      
      <div class="clearfix"></div>
    </div>
    <div id="ourapproach" class="container pageshadow"> 
     <h2>Our Approach to Builds</h2>
     <div class="inner">
      <div class="OIourapproach active"> 
          <div class="descrip yellowcorner">
            <p>We work with the local education ministry to identify villages for potential school builds</p>
        </div>
        <div class="roundedrect"><span>1</span>identify</div>
        <img src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/MagGlass.jpg" >      
      </div>
      <div class="OIourapproach"> 
          <div class="descrip yellowcorner">
            <p>We collaborate with village leaders and community members. Each community provides at least 10 to 20% of the project costs in materials or labor
            </p>
        </div>
        <div class="roundedrect"><span>2</span>build</div>
        <img src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/Hammer.jpg" >       
      </div>
      <div class="OIourapproach"> 
        <div class="descrip yellowcorner">
            <p>We provide supplies and programming to ensure academic success and sustainability, with the goal of each project becoming community owned.
            </p>
        </div>
        <div class="roundedrect"><span>3</span>support</div>
        <img src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/Book.jpg" >      
      </div>
      <div class="OIourapproach"> 
          <div class="descrip yellowcorner">
              <p>We invest in local talent and provide ongoing professional development.
              </p>
          </div>
          <div class="roundedrect"><span>4</span>mentor</div>
          <img src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/Support.jpg">
          
      </div>
      <div class="OIourapproach"> 
          <div class="descrip yellowcorner">
              <p>We compile data and exhaustively monitor the progress of each school.
              </p>
          </div>
          <div class="roundedrect"><span>5</span>monitor</div>
          <img src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/Monitor.jpg">
          
          
      </div>
      <div class="clearfix"></div>
      <h4>However, a school is much more than a building.</h4>
              <p>At Pencils of Promise we believe that a classroom should be a place of high-quality learning that is open to every child, regardless of socio-economic situation, gender and ethnicity.</p>
              <p>Scroll down to see the programs that PoP established in 2012 to accomplish this. </p>
              </div>
        <div class="clearfix"></div>
        <div class="whitefade"></div>
        <img class="schoolimg full" src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/schools.jpg">
      </div>
    
    <div id="programming" class=" container pageshadow"> 
      <h2>Programming</h2>
     <!--  <h4>A school is much more than a building.</h4>
     <div class="yellowcorner">
          
          <p> At Pencils of 
    Promise we believe that a classroom should be a place of 
    high-quality learning that is open to every child, regardless 
    of socio-economic situation, gender and ethnicity.</p>
        <p>In 2012, PoP established several programs to accomplish this.</p>
      </div>-->
 <nav class="navprogram">
     <ul>
         <!--<li id="schoolnav" class="active">Schools<span></span></li>-->
         <li id="tt" class="active">Teacher Training<span></span></li>
         <li id="scholarships">Scholarships<span></span></li>
         <li id="shine">Shine<span></span></li>
         <div></div>
     </ul>
     
 </nav>
 <div class="programouter">
     <!-- <div id="" class="program schoolnav">-->
        
<!--<div class="whitefade"></div>
<img class="schoolimg full" src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/mission_student.png">
        
      </div>-->
      <div class="tt program">
        <p>Our <span class="dark">teacher training</span> program aims to work directly 
with teachers to support them in being active and 
engaging in the classroom.</p>
<p> We believe that a teacher 
is key to learning and want to make sure our teachers 
have a confident handle on the curriculum to pass 
on to their students. Our teacher training program 
was successfully piloted in Laos and will expand to 
Guatemala and Ghana in 2013.</p>
<div class="whitefade"></div>
<img class="ttimg" src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/teachertraining.jpg">
        
      </div>
      <div  class="scholarships program">
        <p>PoP <span class="dark">scholarships</span> support student progression 
from primary to secondary school, as there 
tends to be a huge student drop off in enrollment 
between these two schools.</p>
<p>PoP scholarships are 
given to students who show very high attendance 
and investment in education. the scholarship 
program was launched in Laos in september 
2012 and will be piloted in Guatemala and Ghana 
in 2013.</p> 
<img class="scholarshipimg" src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/scholarships.jpg">
       
      </div>
      
      <!-- 
<div class="">
				<h2>Emergency Fund</h2>
				<div id="emerfund"></div>
				<p>An <b>emergency fund</b> is given to the Promise Committee in each village with the direction that is can be given to any family who has a primary-aged student in their household and is suffering a financial emergency such as sickness or an accident. Our vision for this fund is to have fewer students missing school due to family emergencies, as well as fostering increased trust between PoP and the Promise Committees.</p>
				</div>
 -->
      <div id="" class="shine program">
        
        <p>Supplemental lessons on Sanitation, Health, Identity, Nutrition, and Environment, also 
known as <span class="dark">S.H.I.N.E</span>, are designed to result in 
improved educational achievement by teaching 
students to lead healthier and more fulfilling 
lifestyles.</p>
       <p>A randomized study found that students served 
in these programs showed a 32% decrease in 
absences and a 31% decrease in failures.</p>
<div class="whitefade"></div>
<img src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/SHINE%20LESSON.jpg">
      </div><div class="clearfix"></div></div></div><!--programming-->
      
      <div id="impactmetrics" class="container pageshadow"> 
      <div class="impactmetrics">
        <h2>Impact Metrics</h2>
        <p><span class="dark">Monitoring and evaluation</span> is key to our process because it allows our teams to measure the 
successes and identify the opportunities for improvement in our work. When you know what 
works and what doesn’t, you know how to address the issue most effectively.</p>
        <p class="intro yellowcorner dark">Please meet Novy and Anastacia, two members of our world-wide monitoring and evaluation team.</p>
        <div id="bbmeet" class="left">
          <div class="novy"></div>
          <h5>Novy</h5>
          <p>He has identified the metrics by which we hold 
ourselves accountable.</p>
           <p>Metrics are what we measure. the metrics most 
important to pop are primary school literacy, 
numeracy and progression rates. It’s important 
to not only measure a variety of things - but the 
right things because it allows us to see the big 
picture. </p>
        </div>
        <div id="bbmeet" class="right ana">
          <div class="anastasia"></div>
          <h5>Anastasia</h5>
          <p>She collects the data we need to track our 
impact.<br><br>Anastacia is an example of our local leadership 
in Guatemala. she helps to develop longlasting partnerships with communities because 
she believes in educating Guatemala’s future 
generations.</p>
<div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="clearfix"></div>
    </div>
  </div><!--impactmetrics-->
</div>
<div id="outandabout" class="sections">
  <div class="sidebar pageshadow">
    <ul>
      <li><a href="#campaigns" class="scroll sectionblock">
        <h7 class="campaigns">Campaigns</h7><span></span>
        </a> </li>
      <li><a href="#popProm" class="scroll">
        <h7 class="popProm">Gala</h7><span></span>
        </a> </li>
      <li><a href="#events" class="scroll">
        <h7 class="events">LC Events</h7><span></span>
        </a> </li>
      <li><a href="#press" class="scroll">
        <h7 class="press">Press</h7><span></span>
        </a> </li>
      <li><a href="#digipresence" class="scroll">
        <h7 class="digipresence">Digital Presence</h7><span></span>
        </a> 
      </li>
    </ul>
    <a href="https://www.pencilsofpromise.org/join-the-movement/donate" class="donate">Donate</a>
  </div>
  <div class="content">
    <div id="campaigns" class="container pageshadow"> 
      <h2>Campaigns</h2>
        <h3>The Impossible Ones</h3>
        <p>The campaign ran from August to October 2012 and rallied Millennial’s to redefine what’s possible. 
Supporters took on Impossible Challenges and raised funds for PoP around them. It was all in an effort 
to help PoP reach its impossible goal of breaking ground on the 100th school by the end of the year.</p>
        <p class="yellowcorner">Meet some of the people who proved we all have the potential to be an Impossible One</p>

						<div class="io">
                            <div id="OAsophia"></div>
                            <p><b>Sophia</b> donated her 30th birthday and built 2 schools in Guatemala</p>
                            <img class="cupcake" src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/cupcake.jpg">
                            
                        </div>
						<div class="io">
                            <div id="OAkennedy"></div>
                            <p><b>Kennedy</b> biked across the country and built 2 classrooms</p>
                            <img class="bike" src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/bike%20icon.jpg">
                            
                        </div>
						<div class="io">
                                <div id="OAjustin"></div>
                                <p><b>Justin</b> built a school by harnessing the power of dance music and matching all proceeds from his track “Back to New”</p>
					            <img class="booth" src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/dj%20booth.jpg">
                                
                        </div>
		<div class="clearfix"></div>			
        <h3>Schools4All</h3>
        <div id="s4a-imgcontainer"> 
            <img class="adamjustin" src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/schools4all.png">
               <p>This year we launched our second <span>Schools4All</span> campaign in November 2012 and ran through February 2013. Schools4All is a 
    movement of students for students. Students in the United States come together to raise funds to educate children around the 
    world. Money raised during the campaign went to PoP’s programs in Ghana, Guatemala, Laos and Nicaragua. 
               </p>
               <p>Justin Bieber returned as the ambassador for the campaign and with his support over 13,000 schools signed up to join the 
    Schools4All movement!
               </p>
               <div id="meetwinners">
                   <img id="s4avid" src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/s4a_winners_video.jpg">
                   <div class="winnerstext">
                       <img class="meetwinners" src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/s4a_meet_the_winners.jpg">
                       <img class="meetarrow" src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/arrow_s4a_winners.jpg">
                   </div>
               </div>
                   
                   <iframe class="s4amodal" src="http://www.youtube.com/embed/KtKFJDffAyY?t=52s" frameborder="0" allowfullscreen></iframe>
               
        
      <div class="clearfix"></div>
    </div>
    </div>
    <div id="popProm" class="container pageshadow"> 
      <h2>Gala 2012</h2>
           <p>Pencils of Promise threw its second 
annual gala in NYC on October 25th 
and raised over $1.5 million in one night. 
We honored our closest supporters, 
including Usher Raymond IV, Sarah 
Brown and The Taitz Family</p>
      <h4>Our Favorite Moments</h4>
      <div class="favmoments">
          <div>
              <img src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/usher.jpg">
              <p>Usher Raymond IV wins puppy in live auction</p>
          </div>
          <div>
              <img src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/freemangala.jpg">
              <p>Freeman Gobah speaks about PoP's future in Ghana</p>
          </div>
          <div>
              <img src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/tori.jpg">
              <p>Tori Kelly rocks the house</p>
          </div>
          
          <div class="clearfix"></div>
      </div>
      <img class="galaimg full" src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/galatop.jpg">
    </div>
    <div id="events" class="container pageshadow"> 
        <h2>Leadership Council Events</h2>
        <p>PoP Leadership Councils know how to party with a 
purpose. Every year, they help make our work possible 
by advocating and fundraising for PoP by hosting 
events in cities around the country such as Dallas, 
Austin and Chicago. </p>
          <p>We want to give a special shout out to New York, our 
very first PoP LC, for throwing a White Party in June 
that built a school in Guatemala.</p>
        <div class="yearbook-imgs"> 
          <iframe width="560" height="315" src="http://www.youtube.com/embed/zg6X78K7WoE"  frameborder="0" allowfullscreen></iframe>
        </div>
          
        
      <div class="clearfix"></div>
    </div>
    <div id="press" class="container pageshadow"> 
      <h2>Press</h2>
        <!-- 

 -->
        <h3>From the Field</h3>
        <p class="yellowcorner">PoP featured in 2 local Ghanaian newspapers to announce the ground breaking on our first
3 schools!</p>
        <div>
          <div class="highlightsfield left"> 
              <img src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/CJMVX0tCzbELBPm4Oh93rSOpwLYV3EF3_ecvUWi4KJ4xmc024b0g5c3OpiQhMlOuvw7xGPpgJw8ICH7epU4YRlB2RRdIKwOP0-NkDDcVATRjCFsR4dJuyefQjQ.jpg"> 
           </div>
          <div class="highlightsfield right"> 
              <img src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/8W_j4ArTFy3dpimuJSezGke65q2WfwZAjLFlm9VSmyAokapx4ZsfBoGvj6Tx-PTfrLpQ83fCq69SKwAdOzVay32zVwyQTJAQNeTgXBP7BkqOhc5NcCWHtnlkmQ.jpg"> 
          </div>
        </div>
        <div class="clearfix"></div>
        
        <div id="pressquote" class="quote">
				<span>For us at PoP , we know that we can create 
				a better world through education as has been 
				the vision of our founder.”</span>
		</div>
        <span class="freemanquote dark">Freeman, National Daily Graphic newspaper, 
December 2012</span>
        <div class="clearfix"></div>
        <h3>At Home</h3>
         <p class="yellowcorner">Check out some of the places PoP was featured in 2012</p>
        <a href="http://www.forbes.com/pictures/lml45mkil/adam-braun-29-founder-and-ceo-pencils-of-promise/" class="forbes">
            <img src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/ForbesLogo.jpg">
        </a>
        <a href="http://www.huffingtonpost.com/2012/10/16/watch-sophia-bush-pencils-of-promise_n_1970940.html" class="huffpo">
           <img src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/HuffingtonLogo.jpg">
        </a>
        <a href="http://www.fastcompany.com/1835510/innovation-agents-adam-braun-justin-bieber-and-pencils-promise" class="fastco">
            <img src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/FastCompanyLogo.jpg">
        </a>
          <img src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/CnnMoneyLogo.jpg"> 
        <a href="http://www.people.com/people/gallery/0,,20642349_21233114,00.html" class="people">
             <img src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/PeopleLogo.jpg"> 
        </a>
        <a href="http://observer.com/educated-observer-january-2012/" class="observer">
            <img src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/NewYorkObserver.jpg">
        </a>
      <div class="clearfix"></div>
  </div>
    <div id="digipresence" class="container pageshadow"> 
      <h2>Digital Presence</h2>
      <nav>
          <ul class="left">
              <li class="webvisits">Web Visits</li>
              <li class="pageviews">Most Pageviews</li>
              <li class="likes">Likes</li>
          </ul>
          <ul class="right">    
              <li class="tweeter">Top PoP Tweeter</li>
              <li class="community">Online Community Members</li>
              <li class="youtube">Youtube Video Views</li>
          </ul>
          <ul class="center">
              <li class="instagram">First Instagram Post</li>
              <li class="mentions">Average Daily Twitter Mentions</li>
          </ul>
      </nav>
        <div class="digstats">
            <div class="screen">
                  <div id="webvisits" class="DPstats"> 
                      <img class="webbackground" src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/pophomepage.jpg">
                      <div class="webstats">
                          <img src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/digital_webviews.png" > 
                      </div>
                  </div>
                  <div id="pageviews" class="DPstats"> 
                      <img class="webbackground" src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/pophomepage.jpg">
                      <div class="webstats">
                          <h4>MOST PAGE VIEWS IN 24 HOURS:</h4>
                          <img src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/Out-and-About(3)-31.jpg" >
                          <h5>180,428 on 12/01/12</h5>
                      </div>
                  </div>
                  <div id="likes" class="DPstats"> 
                      <img class="webbackground" src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/popfb.jpg">
                      <div class="webstats">
                          <h4>PEOPLE WHO LIKE POP ON FACEBOOK OR HAVE A FRIEND WHO DOES:</h4>
                          <img src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/Out-and-About(3)-29.jpg" >
                          <h5>86,500,000</h5>
                      </div>
                  </div>
                <div id="tweeter" class="DPstats"> 
                    <img class="webbackground" src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/poptwitter2.jpg">
                    <div class="webstats">
                      <h4 >TOP POP TWEETER:</h4>
                      <img src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/Out-and-About(3)-25.jpg" >
                      <h5>@leeveit2bieber</h5>
                    </div>
                </div>
                <div id="community" class="DPstats"> 
                    <img class="webbackground" src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/pophomepage.jpg">
                    <div class="webstats">
                        <h4>ONLINE COMMUNITY MEMBERS:</h4>
                        <img src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/Out-and-About(3)-30.jpg">
                        <h5>500,000+</h5>
                    </div>
                </div>
                <div id="youtube" class="DPstats">
                    <img class="webbackground" src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/popyoutube.jpg">
                    <div class="webstats">
                        <h4>TOTAL YOUTUBE VIDEO VIEWS:</h4>
                        <img src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/Out-and-About(3)-28.jpg">
                        <h5>800,000+</h5>
                    </div>
                </div>
              <div id="instagram" class="DPstats" >
                  <img class="webbackground" src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/instagram.jpg">
                  <div class="webstats">
                      <h4>FIRST INSTAGRAM POST:</h4> 
                      <img src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/instagram.png">
                      <h5>01/08/09</h5>
                  </div>
              </div>
              <div id="mentions" class="DPstats">
                  <img class="webbackground" src="<?php bloginfo('template_directory'); ?>/gfx/yearbook/poptwitter2.jpg">
                  <div class="webstats">
                    <h4>AVERAGE DAILY TWITTER MENTIONS</h4>
                    <img src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/Out-and-About(3)-25.jpg" >
                    <h5>250</h5>
                  </div>
              </div>
            </div>
          </div>
      </div>
      <div class="clearfix"></div>
    </div>
</div>
<div id="financials" class="sections">
  <div class="sidebar pageshadow">
    <ul>
      <li><a href="#financialssect" class="scroll sectionblock">
        <h7 class="financialssect">Financials</h7><span></span>
        </a> 
        </li>
      <!--<li>
            <a href="#classof2012" class="scroll">
            <h7 class="classof2012">Class of 2012</h7><span></span>
            </a> 
        </li>-->
    </ul>
        <a href="https://www.pencilsofpromise.org/join-the-movement/donate" class="donate">Donate</a>
  </div>
  <div  class="content">
  <div class="container pageshadow">
  <h2>Financials</h2>
    <div id="financialssect">
    <div class="yellowcorner">
        <h4>2012 was our best fundraising year yet.</h4> 
        <p>In 2013, those funds will allow us to start building another 100 schools 
and invest heavily in our new teacher training and student scholarships programs.</p>
    </div>
    <div class="FFsect">
      <table class="testing">
        <tbody>
          <tr>
            <th class="text" scope="row">CAMPAIGNS: 
            3%</th>
            <td>3%</td>
          </tr>
          <tr>
            <th class="text" scope="row">OTHER REVENUE:
            <1%</th>
            <td>1%</td>
          </tr>
          <tr>
            <th class="text" scope="row">SPECIAL EVENTS: 
            25%</th>
            <td>25%</td>
          </tr>
          <tr>
            <th class="text" scope="row">INDIVIDUALS: 
            34%</th>
            <td>34%</td>
          </tr>
          <tr>
            <th class="text" scope="row">CORPORATE: 
            25%</th>
            <td>25%</td>
          </tr>
          <tr>
            <th class="text" scope="row">FOUNDATIONS: 
            12%</th>
            <td>12%</td>
          </tr>
        </tbody>
      </table>
      <div>
      <h4>TOTAL SUPPORT INCOME&nbsp; &nbsp; $5,389,753</h4></div>
      <table class="tablestuff">
        <tr>
          <td><div id="clabel4" class="circlelabel"></div></td>
          <td>INDIVIDUALS</td>
          <td>$1,850,082</td>
          <td>34%</td>
        </tr>
        <tr>
          <td><div id="clabel3" class="circlelabel"></div></td>
          <td>SPECIAL EVENTS</td>
          <td>$1,338,548</td>
          <td>25%</td>
        </tr>
        <tr>
          <td><div id="clabel5" class="circlelabel"></div></td>
          <td>Corporate</td>
          <td>$1,338,048</td>
          <td>25%</td>
        </tr>
        <tr>
          <td><div id="clabel6" class="circlelabel"></div></td>
          <td>FOUNDATIONS</td>
          <td>$634,655</td>
          <td>12%</td>
        </tr>
        <tr>
          <td><div id="clabel1" class="circlelabel"></div></td>
          <td>CAMPAIGNS</td>
          <td>$194,032</td>
          <td>3%</td>
        </tr>
        <tr>
          <td><div id="clabel2" class="circlelabel"></div></td>
          <td>OTHER REVENUE</td>
          <td>$34,388</td>
          <td><1%</td>
        </tr>
      </table>
      <div id="holder">
        <div class="charttext"> TOTAL 
          SUPPORT
          INCOME <span>$5,389,753</span> </div>
      </div>
    </div>
    <div class="FFsect">
      <h4>TOTAL EXPENSES &nbsp; &nbsp; $3,208,562</h4>
      <div id="holder2">
        <div class="charttext"> TOTAL EXPENSES <span>$3,208,562 </span> </div>
        <div class="clearfix"></div>
      </div>
      
      <table class="tablestuff">
        <tr>
          <td>&nbsp;</td>
          <td><strong>Program Services</strong></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><div id="clabel6" class="circlelabel"></div></td>
          <td>School Builds</td>
          <td>$1,565,732</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><div id="clabel5" class="circlelabel"></div></td>
          <td>Teacher Training, SHINE, Scholarships and Other Initiatives</td>
          <td>$305,751</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><div id="clabel4" class="circlelabel"></div></td>
          <td>Program Salaries, Travel & Overhead</td>
          <td>$839,106</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><strong>Subtotal - Program Services</strong></td>
          <td><strong>2,710,589</strong></td>
          <td><strong>84%</strong></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><strong>FUNDRAISING</strong></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><div id="clabel2" class="circlelabel"></div></td>
          <td>Fundraising & Marketing Initiaves</td>
          <td>$127,712</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><div id="clabel1" class="circlelabel"></div></td>
          <td>Fundraising Salaries & Overhead</td>
          <td>$209,139</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><strong>Subtotal - Fundraising Expenses</strong></td>
          <td><strong>$336,851</strong></td>
          <td><strong>11%</strong></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><div id="clabel3" class="circlelabel"></div></td>
          <td><strong>Administrative Salaries & Overhead</strong></td>
          <td><strong>$161,122</strong></td>
          <td><strong>5%</strong></td>
        </tr>
      </table>
      <table class="testing2">
        <tbody>
          <tr>
            <th scope="row">FUNDRAISING
              SALARIES, ETC: 
              7%</th>
            <td>7%</td>
          </tr>
          <tr>
            <th scope="row">FUNDRAISING <br>
              & MARKETING <br>
              INITIATIVES: 
              4%</th>
            <td>4%</td>
          </tr>
          <tr>
            <th scope="row">ADMINISTRATIVE <br>
              SALARIES, ETC: 
              5%</th>
            <td>5%</td>
          </tr>
          <tr>
            <th scope="row">PROGRAM SALARIES, ETC: 
            26%</th>
            <td>26%</td>
          </tr>
          <tr>
            <th scope="row">TEACHER TRAINING, ETC: 
            9%</th>
            <td>9%</td>
          </tr>
          <tr>
            <th scope="row">SCHOOL BUILDS: 
            49%</th>
            <td>49%</td>
          </tr>
        </tbody>
      </table>
      
      
      <!--
						<div class="container pageshadow pageshadow">
						Pencils of Promise FY 2011 Internal Statement Of Activities 
							<table class="tablefinance">
									<tr class="tablebgheader">
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>2011 UNAUDITED</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>2010 AUDITED</td>
									</tr>
									<tr class="tablebgheader">
										<td>Revenue</td>
										<td>Unrestricted</td>
										<td>Temp. Rest.</td>
										<td>Perm. Rest.</td>
										<td>Total</td>
										<td class="tableborder">Total</td>
									</tr>
									<tr>
										<td>Public Support</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td class="tableborder">&nbsp;</td>
										
									</tr>
									<tr>
										<td class="tableindent">Contributions</td>
										<td>$1,234,586</td>
										<td>$238,588</td>
										<td>$50,000</td>
										<td>$1,523,174</td>
										<td class="tableborder">$1,133,364</td>
									</tr>
									<tr>
										<td class="tableindent">Satisfaction of Prior Year's Restrictions</td>
										<td>$450,261</td>
										<td>(450,261)</td>
										<td>-</td>
										<td>-</td>
										<td class="tableborder">-</td>
									</tr>
									<tr>
										<td class="tableindent">In-Kind Contributions</td>
										<td>125,843</td>
										<td>-</td>
										<td>-</td>
										<td>$125,843</td>
										<td class="tableborder">333,627</td>
									</tr>
									<tr>
										<td class="tableindent">Special Events</td>
										<td>$523,074</td>
										<td>-</td>
										<td>-</td>
										<td>$523,074</td>
										<td class="tableborder">$45,584</td>
									</tr>
									<tr>
										<td class="tableindent">Merchandise Sales</td>
										<td>$4,985</td>
										<td>-</td>
										<td>-</td>
										<td>$4,985</td>
										<td class="tableborder">1,620</td>
									</tr>
									<tr >
										<td class="tableindent">Other Income</td>
										<td>634</td>
										<td>-</td>
										<td>-</td>
										<td>633</td>
										<td class="tableborder">12</td>
									</tr>
									<tr >
										<td >Total Revenue</td>
										<td>2,339,383</td>
										<td>(211,673)</td>
										<td>50,000</td>
										<td>2,177,710</td>
										<td class="tableborder">1,514,207</td>
									</tr>
									<tr>
									</tr>
								<tr> <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td class="tableborder">&nbsp;</td></tr>

									<tr class="tablebgheader">
										<td >Expenses</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td class="tableborder">&nbsp;</td>
									</tr>
									<tr >
										<td class="tableindent">Program Services</td>
										<td>1,216,227</td>
										<td>-</td>
										<td>-</td>
										<td>1,216,227</td>
										<td class="tableborder">452,099</td>
									</tr>
									<tr >
										<td class="tableindent">Management & General</td>
										<td>98,417</td>
										<td>-</td>
										<td>-</td>
										<td>98,417</td>
										<td class="tableborder">25,749</td>
									</tr>
									<tr >
										<td class="tableindent">Fundraising</td>
										<td>134,634</td>
										<td>-</td>
										<td>-</td>
										<td>134,634</td>
										<td class="tableborder">47,023</td>
									</tr>
									<tr >
										<td >Total Expenses</td>
										<td>1,449,278</td>
										<td>-</td>
										<td>-</td>
										<td>1,449,278</td>
										<td class="tableborder">524,871</td>
									</tr>
									<tr> <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td class="tableborder">&nbsp;</td></tr>

									<tr >
										<td >Change in Net Assets</td>
										<td>890,105</td>
										<td>(211,673)</td>
										<td>50,000</td>
										<td>728,432</td>
										<td class="tableborder">989,336</td>
									</tr>
									
<tr> <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td class="tableborder">&nbsp;</td></tr>

								<tr class="tablebgheader">
										<td >Net Assets</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td class="tableborder">&nbsp;</td>
									</tr>
									<tr >
										<td >Beginning of Year</td>
										<td>618,011</td>
										<td>450,261</td>
										<td>-</td>
										<td>1,068,272</td>
										<td class="tableborder">78,936</td>
									</tr>
<tr> <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td class="tableborder">&nbsp;</td></tr>

							<tr class="tablebgheader">
										<td >End of year</td>
										<td>$1,508,116</td>
										<td>$238,588</td>
										<td>$50,000</td>
										<td>$1,796,704</td>
										<td class="tableborder">$1,068,272</td>
									</tr>
							</table>
						
						</div>
						
						<div class="container pageshadow pageshadow">
							Pencils of Promise FY 2011 Internal Statement of Financial Position
							<table class="tablefinance">
							<tr class="tablebgheader">
										<td >Cash flows from operating expenses</td>
										<td>2011 Unaudited</td>
										<td>2010 Unaudited</td>
									</tr>
									<tr >
										<td class="tableindent">Cash and Cash Equivalents</td>
										<td>$1,429,205</td>
										<td>$344,893</td>
									</tr>
									<tr >
										<td class="tableindent">Accounts Receivable</td>
										<td>18,560</td>
										<td>457,313</td>
									</tr>
									<tr >
										<td class="tableindent">Prepaid Expenses</td>
										<td>28,385</td>
										<td>19,347</td>
									</tr>
									<tr >
										<td class="tableindent">Security Deposit</td>
										<td>35,810</td>
										<td>3,000</td>
									</tr>
									<tr >
										<td class="tableindent">Property and Equipment, Net</td>
										<td>300,372</td>
										<td>256,893</td>
									</tr>
									<tr >
										<td > </td>
										<td>$1,812,332</td>
										<td>$1,081,446</td>
									</tr>
<tr> <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
							<tr class="tablebgheader">
										<td >Liabilities and Net Assets</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr >
										<td >Total Liabilities</td>
										<td>$15,628</td>
										<td>$13,174</td>
									</tr>
									<tr >
										<td class="tableindent">Accounts payable and accrued expenses</td>
									</tr>
<tr> <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>

							<tr class="tablebgheader">
										<td >Net Assets</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr >
										<td class="tableindent">Unrestricted</td>
										<td>$1,508,116</td>
										<td>618,011</td>
									</tr>
									<tr >
										<td class="tableindent">Temporarily Restricted</td>
										<td>238,588</td>
										<td>450,261</td>
									</tr>
									<tr >
										<td class="tableindent">Permanently Restricted</td>
										<td>50,000</td>
									</tr>
				<tr> <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>

							<tr class="tablebgheader">
										<td >Total Net Assets</td>
										<td>1,796,704</td>
										<td>1,068,272</td>
									</tr>
									<tr >
										<td > </td>
										<td>$1,812,332</td>
										<td>$1,081,446</td>
									</tr>
							</table>
						<div>
							<div class="FFsectbot">
							<h5>75%</h5>
							<p>of donations received were under $100</p>
							</div>
							<div class="FFsectbot" >
							<h5>3X</h5>
							<p  >INCREASE IN SPENDING ON INTERNATIONAL 
PROJECTS AND PROGRAMMING INITIATIVES FROM 2010 TO 2011</p>
							</div>
							<div class="FFsectbot">
							<h5>4,000</h5>
							<p >UNIQUE DONORS 
SUPPORTING POP
IN 2011</p>
							</div>
						</div>
						<div>
						
					</div>
						</div>
						--> 
    </div></div>
    <div class="clearfix"></div>
  </div>
 <!-- <div id="classof2012" class="container pageshadow pageshadow"> 
    <h2>Class of 2012</h2>
    <div class="thanks">
        <div class="yellowcorner">
            <h4 >With Gratitude.</h4>
            <p>Our warmest thanks to the donors who have shown extraordinary support to Pencils of Promise in 2012.</p>
            <img src="http://dbc468c6af3659a35fbc-f0981fd138ea8adbe310045bdc6ef280.r92.cf1.rackcdn.com/Nuth_Financials.png">
        </div>
    </div>
    <ul class="column">
      <h4 style="padding-top:0">$250,000+</h4>
        <li>AEG LIVE</li>
        <li>ELIZABETH ARDEN</li>
        <li>GIVE BACK BRANDS FOUNDATION</li>
      <h4> $100,000+</h4>
          <li>THE CAHILL FAMILY</li>
          <li>COATUE FOUNDATION</li>
          <li>EUREKA CHARITABLE TRUST</li>
          <li>MARC & CAROLYN ROWAN</li>
          <li>ALEX SOROS</li>
      <h4>$50,000+</h4>
        <li>ANONYMOUS</li>
        <li>BARNES & NOBLE</li>
        <li>THE FINOCCHIARO FAMILY</li>
        <li>CHLOE GEORGE</li>
        <li>PAUL TUDOR & SONIA JONES</li>
        <li>JOSEPH PATANELLA</li>
        <li>POST FOODS, LLC (CANADA)</li>
        <li>UNIVERSAL MUSIC GROUP</li>
        <li>THE WRIGHT FOUNDATION, INC.</li>
      <h4> $25,000+</h4>
        <li>BIRCHBOX</li>
        <li>COREY CAPASSO</li>
        <li>CHRIS & KIMBERLY CLARKE</li>
        <li>MICHAEL CONNAGHAN</li>
        <li>CARYN & CRAIG EFFRON</li>
        <li>FEDERICI CHARITABLE LEAD ANNUITY TRUST</li>
        <li>ROBERT GRANIERI</li>
        <li>LEWIS HOWES</li>
        <li>SHAKIL KHAN</li>
        <li>ERIC KNIGHT</li>
        <li>ALEXANDER & RACHEL MCAREE</li>
        <li>MAXWELL MENARD</li>
        <li>NEW YORK LEADERSHIP COUNCIL</li>
        <li>JIM PARSONS</li>
        <li>PEARSON CHARITABLE FOUNDATION</li>
        <li>POPPIN</li>
        <li>ALLISON ROSEN</li>
        <li>PATRICK SARKISSIAN</li>
        <li>IMRAN SIDDIQUI</li>
        <li>DIANE & MARC SPILKER</li>
        <li>SUNFLOWER CHILDREN</li>
        <li>HOPE & GLENN TAITZ</li>
        <li>TEN TALENTS FOUNDATION, INC.</li>
        <li>THE MCJ AMELIOR FOUNDATION</li>
        <li>VAYNERMEDIA</li>
        <li>JEFFREY WALKER</li>
        <li>THE WIGGINS FOUNDATION</li>
      <h4> $10,000+</h4>
        <li>1 800 FLOWERS</li>
        <li>AHA LIFE</li>
        <li>ANONYMOUS</li>
        <li>ARB GROUP, LLC</li>
        <li>ANNE BASS</li>
        <li>JUSTIN BLAU</li>
        <li>BLOOMBERG PHILANTHROPIES</li>
        <li>OWEN BRAINARD</li>
        <li>ERVIN & SUSAN BRAUN</li>
        <li>SCOTT “SCOOTER” BRAUN</li>
        <li>JAIME BROWN</li>
        <li>TROY CARTER</li>
        <li>RALPH & NANCY CASAZZONE</li>
        <li>CELEBRITY ACCESSORIES, LLC</li>
        <li>CELLAIRIS</li>
        <li>KATRINA DAVIES & FAMILY</li>
        <li>DELL MATCHING GIFTS</li>
        <li>DR. SUSAN DROSSMAN & ADAM SOKOLOFF</li>
        <li>J. RYAN DUNN</li>
        <li>MARK FOSTER</li>
        <li>JACOB FREED</li>
        <li>JAMIE GALLAGHER</li>
        <li>GENERAL ASSEMBLY</li>
        <li>CONNIE GOTTWALD</li>
        <li>HALPER RAWISZER FINANCIAL GROUP</li>
        <li>HILLSONG NYC</li>
        <li>ROBERT HOLLANDER</li>
        <li>HUGH J. ANDERSEN FOUNDATION</li>
        <li>HUNTSMAN GAY FOUNDATION</li>
        <li>VICKI & SAM KATZ</li>
        <li>TIMOTHY KOMADA</li>
        <li>KWIK LEARNING</li>
        <li>LEFKOFSKY FAMILY FOUNDATION</li>
        <li>DYLAN LEWIS</li>
        <li>TIA MAHAFFY</li>
        <li>MISSION FISH</li>
        <li>NETHERCUTT FAMILY CHARITABLE TRUST</li>
        <li>LIA OJJEH</li>
        <li>PAUL, WEISS, RIFKIND, WHARTON & GARRISON LLP</li>
        <li>SHERVIN PISHEVAR</li>
        <li>PRICEWATERHOUSE COOPERS LLP</li>
        <li>PROMETHEUS GLOBAL MEDIA</li>
        <li>USHER RAYMOND IV</li>
        <li>ROBERT E. DICKEY CHILDREN’S TRUST</li>
        <li>ROCKEFELLER FAMILY FUND</li>
        <li>KAREN ROSS</li>
        <li>MARTY & KIM SANDS</li>
        <li>SEVENLY</li>
   </ul>
   <ul class="column">
      <li>  RANDI & BOAZ SIDIKARO</li>
       <li> BRIAN SMITH</li>
       <li> MARKO & SUSAN SONNENBERG</li>
       <li> VIACOM</li>
       <li> WARBY PARKER</li>
       <li> MICHAEL WEISS</li>
        <li>SUZANNE WEISS</li>
        <li>JENNIFER & EDWARD YORKE</li>
        <li>LOIS ZARO</li>
      <h4> $5,000+</h4>
        <li>ANONYMOUS</li>
        <li>BENNY BLANCO</li>
        <li>BNY MELLON WEALTH MANAGEMENT</li>
        <li>SOPHIA BUSH</li>
        <li>CARYN COHEN</li>
        <li>DALIO FAMILY FOUNDATION, INC.</li>
        <li>DAVID YURMAN</li>
        <li>PETER DRITTEL</li>
        <li>CHARLIE EBERSOL</li>
        <li>FABER CASTELL</li>
        <li>TONY GIAMMALVA</li>
        <li>GOOGLE MATCHING GIFTS</li>
        <li>ADAM GROWALD</li>
        <li>KAREN & IAN HARRIS</li>
        <li>BRAD & AMANDA HAUGEN</li>
        <li>KATE & ANDREW KAPLAN</li>
        <li>JOSHUA KUSHNER</li>
        <li>DEVON LEON</li>
        <li>THE MAGGIE L. WALKER</li> 
        <li>GOVERNOR’S SCHOOL FOR GOVERNMENT AND INTERNATIONAL STUDIES</li>
        <li>MARBLEHEAD VETERANS MIDDLE SCHOOL</li>
        <li>MOLEX INCORPORATED</li>
        <li>MR. YOUTH</li>
        <li>ONE PIECE JUMPSUIT</li>
        <li>HOOMAN RADFAR</li>
        <li>RUSSO FAMILY FOUNDATION</li>
        <li>CLAIRE RYAN</li>
        <li>ROB SAND</li>
        <li>LORRAINE SCHWARTZ</li>
        <li>SWEETGUM FOUNDATION</li>
        <li>DEBRA WATTENBERG & BRETT ROSEN</li>
        <li>JAY WILLIAMS</li>
        <li>JAY WOLFF</li>
      <h4> $2,500+</h4>
        <li>ALVIN & LOUISE MYERBERG FAMILY FOUNDATION, INC.</li>
        <li>AUSTIN LEADERSHIP COUNCIL</li>
        <li>MADISON BEER</li>
        <li>LESLIE BLUHM</li>
        <li>BRANCH FAMILY FOUNDATION</li>
        <li>MICHAEL BRENNAN</li>
        <li>THE BRIDGE DIRECT, INC.</li>
        <li>SHAUNA BROOK</li>
        <li>JOSEPH CARNEY</li>
        <li>RALPH COMPAGNONE</li>
        <li>DL1961 PREMIUM DENIM, INC.</li>
        <li>FRAGRANCE X</li>
        <li>DEBBIE FRAZIER</li>
        <li>ALEX GARDNER</li>
        <li>MICHAEL JENKINS</li>
        <li>ADAM JUDA</li>
        <li>MARC KUSHNER & LAURIE SALITAN</li>
        <li>RANDYE & BRIAN KWAIT</li>
        <li>SEAN LEE</li>
        <li>ANNE LOMBARDI</li>
        <li>PAT MARSHALL</li>
        <li>ELAINE MORALES</li>
        <li>DAWN MOSES</li>
        <li>NURU PROJECT INC</li>
        <li>THE ROBBINS FAMILY FOUNDATION</li>
        <li>LAUREN ROSENKRANZ</li>
        <li>SCHAFFER, SCHONHOLZ & DROSSMAN</li>
        <li>PAUL & MADELINE SCHNELL</li>
        <li>ALLISON SEN</li>
        <li>DIRK SMITH</li>
        <li>SOJO STUDIOS</li>
        <li>CLIFF & KIRSTEN SU</li>
        <li>THIS SHIRT HELPS</li>
        <li>KENN WATERS</li>
        <li>WILLIAM D. RHODES FOUNDATION</li>
        <li>RON YAKUEL</li>
      <h4> $1,000+ </h4>
        <li>ERIC ABOAF</li>
        <li>ALLEN & MADELYN ADAMSON</li>
        <li>ELIZABETH ALTON</li>
        <li>NICK ARISON</li>
        <li>ABBE & ADAM ARON</li>
        <li>RUTH ARONOWITZ</li>
        <li>ASPIRE MIDDLE SCHOOL FOR THE PERFORMING ARTS</li>
        <li>JENS AUDENAERT</li>
        <li>LYNN BAGLIEBTER</li>
        <li>BAIN CAPITAL, LLC</li>
        <li>CAL BARNETT MAYOTTE</li>
        <li>TRACIE BEER</li>
        <li>ASHLEY BEKTON</li>
        <li>MATTHEW BERGER</li>
        <li>JAKE BERKOFF</li>
        <li>BRUCE BERMAN</li>
        <li>CHRIS BIERLY</li>
        <li>BILL AND MELINDA GATES FOUNDATION   </li>   
    </ul>
    <ul class="column">
        <li>CONSTANTIN BISANZ</li>
        <li>BISHOP GRECO COLUMBIETTES</li>
        <li>JOSH BLACK</li>
        <li>LEORA BLAU</li>
        <li>ISAAC BLECH</li>
        <li>JARIE BOLANDER</li>
        <li>RICHARD BROWN</li>
        <li>MADELYN BUCKSBAUM</li>
        <li>CHRIS CAPALBO</li>
        <li>ROBERT CARDINI</li>
        <li>LEIGH CARPENTER</li>
        <li>CASECROWN</li>
        <li>CENTER FOR CREATIVE LEADERSHIP</li>
        <li>JULIA CHESNEY</li>
        <li>JENNIFER CLEVER</li>
        <li>RYAN COISSON</li>
        <li>MICHAEL CONSTANTINER</li>
        <li>DAVID & IDE DANGOOR</li>
        <li>MIKE DEL PONTE</li>
        <li>JOEL DEMPSEY</li>
        <li>MEGHA DESAI</li>
        <li>CASSANDRA DULYX</li>
        <li>ALEXANDER EILHAUER</li>
        <li>MIRANDA EVERY</li>
        <li>DONI FORDYCE</li>
        <li>GEORGE FOX</li>
        <li>BETHENNY FRANKEL</li>
        <li>HARRY D. FRICK III</li>
        <li>ALEXANDRA GARDNER</li>
        <li>SHERI GELLMAN</li>
        <li>ROBERT GILMAN</li>
        <li>CHRISTINE GINTER</li>
        <li>BILL GLASER</li>
        <li>ALEJANDRO GONZALEZ</li>
        <li>ANDREW GRABATO</li>
        <li>MICHAEL GRISWOLD</li>
        <li>JENNIFER HANKIN</li>
        <li>SCOTT & VIKTORIA HARRISON</li>
        <li>HARTINGTON TRUST</li>
        <li>PETER HAWLEY</li>
        <li>LISA HENDRIKSON</li>
        <li>JASON HERRON</li>
        <li>GREGORY HEYMAN</li>
        <li>TROY HIGH SCHOOL</li>
        <li>MATTHEW HILTZIK</li>
        <li>DAVID HIRSCH</li>
        <li>BRIDGET HOLTZ</li>
        <li>WILLIAM HOLZAPFEL</li>
        <li>HOUSTON LEADERSHIP COUNCIL</li>
        <li>HUGH M. HUNTER</li>
        <li>JENNIFER HUTCHINSON</li>
        <li>NEAL JAGODA</li>
        <li>STEVE JANG</li>
        <li>KEREN KALIMIAN</li>
        <li>MICHAEL KARMATZ</li>
        <li>JOCELYN & BRIAN KMET</li>
        <li>GARY KNUDSON</li>
        <li>BENEDICT KOENIG IV</li>
        <li>LOIS KRASILOVSKY</li>
        <li>STEVEN KREPS & HARLENE KATZMAN</li>
        <li>DAVID KRUMHOLTZ</li>
        <li>VIVEK KUNCHAM</li>
        <li>FRED LANE</li>
        <li>CAREY LATHROP</li>
        <li>ELLEN LIEB</li>
        <li>PATRICIA LIFTER</li>
        <li>HUNTER LIPTON</li>
        <li>DUSTIN LONG</li>
        <li>RICH LOPRESTI</li>
        <li>ANDREA LUSTIG</li>
        <li>JERYL MALLOY</li>
        <li>WILL MCDONOUGH</li>
        <li>SAHAR MEGHANI</li>
        <li>JAMISON MONROE</li>
        <li>MONSIGNOR MCCLANCY MEMORIAL</li>
        <li>MCKENNA MOREAU</li>
        <li>JOHN MORRIS</li>
        <li>KEVIN NATIONS</li>
        <li>WILLIAM NEUENFELDT</li>
        <li>CHRISTINE NGUYEN</li>
        <li>MATT & SIMONE NICHOLLS</li>
        <li>PATRICK & AMANDA NICHOLS</li>
        <li>ROBERT NICHOLSON</li>
        <li>THE NY COMMUNITY TRUST</li>
        <li>WILLIAM NYGARD</li>
        <li>JULIE O’HARA</li>
        <li>ROSALYN O’NEALE</li>
        <li>SARA OJJEH</li>
        <li>ONEHOPE WINE</li>
        <li>SUSAN ORSER</li>
        <li>JAMES OVERLOCK</li>
        <li>PACIFICA FOUNDATION</li>
        <li>PAVAN PARDASANI</li>
        <li>CHUL JOON PARK</li>
        <li>LAWRENCE PERYER</li>
        <li>LAWRENCE PETRETTI</li>
        <li>TIEN PHAN</li>
        <li>PLAN TEA BEVERAGES, LLC</li>
        <li>RAPTURE & GRACE CORP</li>
        <li>ROSALIND MAE REIS</li>
        <li>ELLIS RINALDI</li>
        <li>SUZAN ROSE</li>
        <li>JOEL RUNYON</li>
        <li>CHRISTOPHER SACCA</li>
        <li>SAINT ANDREW’S SCHOOL</li>
    </ul>
    <ul class="column">
        <li>JODI SARSFIELD</li>
        <li>NIHAL MEHTA & RESHMA SAUJANI</li>
        <li>SUZY & HAROLD SCHAAFF</li>
        <li>DAVID & LIBBY SELIKTAR</li>
        <li>ROBERT SILLS & CAROL SCHWARTZ</li>
        <li>MARK SIMMERMANN</li>
        <li>SKILLSHARE</li>
        <li>SOLOW & CO., INC.</li>
        <li>DAWN & ROBERT SPIERA</li>
        <li>ANTHONY SQUILLANTE</li>
        <li>SEAN STEPHENSON</li>
        <li>PETRA TAKEVA</li>
        <li>MARGARET TALLMAN</li>
        <li>MANOHAR LAL TANWANI</li>
        <li>HOOLIE & NATALIE TEJWANI</li>
        <li>GEOFFREY THAW</li>
        <li>JENNIFER THOMPSON</li>
        <li>ANTHONY TIEFENBACH</li>
        <li>PATRICIA TONG</li>
        <li>ROBERT TORRES</li>
        <li>ROGER TRINCHERO</li>
        <li>UNITED JEWISH ENDOWMENT FUND</li>
        <li>UNIVERSITY OF WISCONSIN MADISON</li>
        <li>VALERIE-CHARLES DIKER FUND, INC.</li>
        <li>JOSEPH VALVANO</li>
        <li>ALAN VAYNERCHUK</li>
        <li>MARILYN WECKSELL</li>
        <li>BARRY WEISS</li>
        <li>WILL & JADA SMITH FAMILY FOUNDATION</li>
        <li>ADAM WINKEL</li>
      <h4> $500+ </h4>
        <li>AMERICAN EXPRESS CHARITABLE FUND</li>
        <li>RAYMOND AMES</li>
        <li>NICOLE ANNUNZIATA</li>
        <li>BRIAN ARCHER</li>
        <li>BROOKE ASHFORTH</li>
        <li>MICHAEL BAGLIEBTER</li>
        <li>JOSEPH BAKER</li>
        <li>PRADEEP BALIGA</li>
        <li>NEAL BATRA</li>
        <li>ALBERT BITTON</li>
        <li>MARTIN BOORSTEIN</li>
        <li>ROBERT BOYCE</li>
        <li>BRACED-LETS</li>
        <li>TYLER BRETON</li>
        <li>MATT BRITTON</li>
        <li>STEVE BUFFONE</li>
        <li>CAROL A. BURMAN</li>
        <li>ALEXANDRA BURNS</li>
        <li>TREVOR BURTON</li>
        <li>ANTONIA CANERO</li>
        <li>CAUSETEE, INC</li>
        <li>CHICAGO LEADERSHIP COUNCIL</li>
        <li>CRAIG CLEMEN</li>
        <li>SANDRA CLIFFORD</li>
        <li>THOMAS COBURN</li>
        <li>BEN COLOMBO</li>
        <li>GRETA COWAN</li>
        <li>CATHERINE CRAIG</li>
        <li>JESSICA WATSON D’ONOFRIO</li>
        <li>SHIREEN DADMEHR</li>
        <li>DALLAS LEADERSHIP COUNCIL</li>
        <li>MAANIT DESAI</li>
        <li>JULIA DEVECCHI</li>
        <li>JAMES DIEFENTHAL</li>
        <li>MICHAEL DOHERTY</li>
        <li>CARLA DRYE</li>
        <li>EAST NOBLE HIGH SCHOOL</li>
        <li>ALEXA EFFRON</li>
        <li>JONATHAN EGAN</li>
        <li>EMWIGA FOUNDATION</li>
        <li>DENNIS ENGLE</li>
        <li>EYE PRODUCTIONS, INC.</li>
        <li>JO ELLEN FINKEL</li>
        <li>FIRSTGIVING.COM</li>
        <li>RICHARD D. FORMAN</li>
        <li>MARKO FULK</li>
        <li>DAVID GAMBRILL</li>
        <li>NANCY LM GERNERT</li>
        <li>BRUCE GOLDBERG</li>
        <li>GENE GURKOFF</li>
        <li>CHARLES HAAG</li>
        <li>ROBERT HAMBURGER, JR. & ILENE SUNSHINE</li>
        <li>HAPPY BLANKIE, LLC</li>
        <li>JEAN HARBECK</li>
        <li>BRETT HARRISON</li>
        <li>STEPHEN HARSANY</li>
        <li>CRAIG HATKOFF & JANE ROSENTHAL</li>
        <li>MARSHA A. HAUGEN</li>
        <li>HEALTH VENTURE GROUP</li>
        <li>DONNA HELLER</li>
        <li>ALICE HIBBARD</li>
        <li>DIANA L. HO</li>
        <li>HOGAN INDUSTRIES INC.</li>
        <li>ASHLEY HOPE</li>
        <li>SOCIAL IMPRINTS</li>
        <li>INSPIRE IN-HOME TUTORING</li>
        <li>IRENE JACOBS</li>
        <li>ANNEKE JONG</li>
        <li>RAHUL KAMATH</li>
        <li>KERRY KELLOGG</li>
        <li>JOHN KLUGE JR.</li>
        <li>RON & FAB KNIGHT</li>
    </ul>
    <ul class="column">
        <li>KOROWA GIRLS SCHOOL</li>
        <li>MARCY KRAMER-IDE</li>
        <li>MARISSA KUGLER</li>
        <li>DENNIS KWAN</li>
        <li>RON LARSON</li>
        <li>DREW LEARNER</li>
        <li>ANGELA LEE</li>
        <li>RICHARD LENT</li>
        <li>KRISTEE LEONARD</li>
        <li>WILLIAM LEVAN</li>
        <li>MATT LEVINE</li>
        <li>VALSA MADHAVA</li>
        <li>JARETT MALOUF</li>
        <li>JOSEPH & CHRISTIE MARCHESE</li>
        <li>CRAIG MARCUS</li>
        <li>MARCIE MATTHEWS</li>
        <li>HILARY MESEROLE</li>
        <li>MATTHEW MICHELINI</li>
        <li>JAY MILLER</li>
        <li>MONROE TOWNSHIP MIDDLE SCHOOL</li>
        <li>KATHLEEN MORALES</li>
        <li>ANGEL MORGAN</li>
        <li>ANTHONY MOY</li>
        <li>NEW YORK UNIVERSITY</li>
        <li>MICHAEL NEY</li>
        <li>MIMI NGUYEN</li>
        <li>NORTHERN VALLEY REGIONAL HIGH SCHOOL</li>
        <li>BENJAMIN O’BRIEN</li>
        <li>OKLAHOMA STATE UNIVERSITY</li>
        <li>P.W. KAESER HIGH SCHOOL</li>
        <li>GLORIA PAK</li>
        <li>PAXSON PRODUCTIONS LLC</li>
        <li>JOANA PICQ</li>
        <li>DAVID PIERMATTEO</li>
        <li>LINDA PLATTUS</li>
        <li>ROBET PODOLSKY</li>
        <li>RICHARD POPPER</li>
        <li>SIMON PREKETES</li>
        <li>RACES ONLINE</li>
        <li>DEOKIE RAMPERSAUD</li>
        <li>MICHAEL RATHSAM</li>
        <li>JON REINSTEIN</li>
        <li>RESOURCE ENERGY SYSTEMS LLC</li>
        <li>TIM REYNOLDS</li>
        <li>ROBERT E. LEE HIGH SCHOOL</li>
        <li>G H ROBINS</li>
        <li>ROOZT, INC.</li>
        <li>DEREK RUNDEL</li>
        <li>JASON RUNYON</li>
        <li>CAROLE SADLER</li>
        <li>JENNIFER SALZER</li>
        <li>GABE SAPORTA</li>
        <li>DANIELLE SCHERR</li>
        <li>SCHWAB CHARITABLE FUND</li>
        <li>ROBERTA SEGAL</li>
        <li>VANESSA SEIDEN</li>
        <li>DANIEL SETZMAN</li>
        <li>JOHN SHAHIDI</li>
        <li>NIKKI & BRAD SILVER</li>
        <li>AMANDA SLAVIN</li>
        <li>BRIAN SMITH</li>
        <li>NINA SORENSON</li>
        <li>SPRINGHURST ELEMENTARY SCHOOL</li>
        <li>ST. JOSEPH SCHOOL</li>
        <li>JOHN STARTIN</li>
        <li>MARK STEIN</li>
        <li>MEIGHAN STONE</li>
        <li>STUART SUBOTNICK</li>
        <li>YOU NING SUN</li>
        <li>KURT SWANN</li>
        <li>BARB J. SWEENEY</li>
        <li>RAMIN TAHBAZ</li>
        <li>STEVEN TAITZ</li>
        <li>THE GREENWICH TEEN CENTER, INC.</li>
        <li>DIANE TIERNEY</li>
        <li>TRIANGLE COMMUNITY FOUNDATION, INC.</li>
        <li>LOUIS TRINCHERO</li>
        <li>UNCOMMON CHARTER HIGH SCHOOL</li>
        <li>LORI VISE</li>
        <li>DEBORAH VITALE</li>
        <li>LAUREN VOGAN</li>
        <li>CHRIS WALKER </li>
        <li>WANTFUL</li>
        <li>WASHINGTON HEBREW CONGREGATION</li>
        <li>ANDREW WESTERDALE</li>
        <li>MATT YEAGER</li>
        <li>CRYSTAL YIN</li>
        <li>JOHN DAVID TUELLER ZUFELT</li>
      <h4> In Kind</h4>
        <li>FULL PICTURE</li>
        <li>MOLINA & ASOCIADOS</li> 
        <li>SIMPSON THACHER & BARTLETT LLP</li>
        <li>TEN</li>
        <li>CASSIDY TURLEY</li>
        <li>PARTIZAN</li>
        <li>AKQA</li>
        <li>VH1</li>
        <li>ALLOY DIGITAL</li>
        <li>AOL</li>
        <li>SAINTS</li>
    </ul>
    <div class="clearfix"></div>
  </div>-->
</div>

</div>
</div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> 
<script src="http://code.jquery.com/jquery-latest.js"></script> 
<script src="http://jquery-ui.googlecode.com/svn/tags/latest/ui/jquery.effects.core.js"></script> 
<script src="http://jquery-ui.googlecode.com/svn/tags/latest/ui/jquery.effects.slide.js"></script> 
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.spritely.js"></script> 
<script src="<?php bloginfo('template_directory'); ?>/js/raphael-min.js"></script> 
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.ba-throttle-debounce.js"></script> 
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/infobubble.js"></script> 
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.tmpl.min.js"></script> 
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquerypp.custom.js"></script> 
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/bookblock.js"></script> 

<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.bookblock.min.js"></script> 

<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery-animate-css-rotate-scale.js"></script> 
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery-css-transform.js"></script> 
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.easing.1.3.js"></script> 
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.mousewheel.js"></script> 
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.contentcarousel.js"></script> 


<!-- 
<script src="http://imakewebthings.com/jquery-waypoints/waypoints.js"></script>
 --> 
<script src="<?php bloginfo('template_directory'); ?>/js/yearbook.js"></script> 
<!-- 
<script type="text/javascript" src="http://jmpressjs.github.com/jmpress.js/dist/jmpress.js"></script>
 --> 
