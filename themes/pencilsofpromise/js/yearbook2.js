$(document).ready(function() { 
$('#modal').show();
$('#yearbook').hide();
function onload() {
    $('#modal').fadeOut();
    $('#yearbook').fadeIn();
    openingAnim();
    //keylight();
    setnav();
};

/*function keylight(){
    $('.keyboard .l').addClass("yellowkey");
    $('.keyboard .r').removeClass("yellowkey");
}

function keylightToggle(){
    $('.keyboard .r').addClass("yellowkey");
    $('.keyboard .l').removeClass("yellowkey");
}

var refreshkey = setInterval(function() {
    keylight();
}, 400);

refreshkey();*/

//program 
//MAKE DEFAULT FOR ANYTHIGN THAT YOU CLICK
$('.navprogram li').click(function(){
   $pos = $(this).position();
   $width = $(this).width();
   $id=$(this).attr("id");
   $('.program').hide();
   $("."+$id).fadeIn();
   $('.navprogram li').removeClass("active");
   $(this).addClass("active");
   $('.navprogram div').animate({left:$pos.left+20+"px", width:$width+"px"}, 500);
});

//content spinner for 
$('#ca-container').contentcarousel();

//digipresence hover
//MAKE DEFAULT FOR ANYTHING YOU HOVER OVER
$('#digipresence nav li').hover(function(){
   $class=$(this).attr("class");
   $('.digstats div').hide();
   $('#'+$class).show();
});

$('.OIourapproach').hover(function(){
    $('.OIourapproach').removeClass("active");
    $(this).addClass("active");
});

$('.content').width($(window).width()-210);
$(window).resize(function() {
     $('.content').width($(window).width()-210);
});
$('.sidebar').wrap('<div class="backshadow sb" />');
$('.backshadow.sb, .sidebar').height($(window).height());
$('.yellowcorner').append("<div class='box1'></div><div class='box2'></div><div class='box3'></div><div class='box4'></div>");

//MAKE LOCAL
var $sharepos = $(window).width();

$('.facebook, .twitter, .download').css("right","10px");
$('.hover').mouseover(function(){
    $('.download').animate({right:"45px", top:"5px"}, 500),
    $('.facebook').animate({top:"35px", right:"35px"}, 500),
    $('.twitter').animate({top:"50px", right:"2px"}, 500);
});
$('.share').mouseout(function(){
    $('.download').animate({right:"10px"}, 800),
    $('.facebook').animate({top:"10px", right:"10px"}, 800),
    $('.twitter').animate({top:"10px"}, 800);
});


//LOADING

//INTITIAL LAYOUT

//if there is a hash in the url, show that page
var isShowing = false;
var $hash = window.location.hash;
if($hash){
    $("#timeline, .nuth").hide().css("top", "1400px");
	$("#showTimeline2").removeClass("active");
    $($hash).show();
    $class=$hash.replace("#",".");
	$($class).addClass("active");
    isShowing = true; 
}



/* Adds the active class to the clicked section name in yearbook navigation bar */
//ADD TO CLICK FUNCTION
$("#yearbook-nav-inner ul li a").click(function() {
    $pos = $(this).position();
	$("#yearbook-nav-inner ul li a").removeClass("active");
    $(this).addClass("active");
    if(!isShowing){
        timelineout();
        $('.sections').hide();
       isShowing = true;
       $this = $(this);
        $id = $this.attr('href');
        $($id).fadeToggle("fast");
    }
    else if(isShowing && $(this).hasClass("showTimeline2")){
        timelinein();
    }
    else if(isShowing){
       $('.sections').hide();
       isShowing = true;
       $this = $(this);
        $id = $this.attr('href');
        $($id).fadeToggle("fast");
    }
    $('.bar').animate({left:$pos.left+"px", width:$(this).width()+"px"}, 500);	
});

function timelineout(){
    $("#timeline, .nuth").animate({top:"1400px"}, 1000, function(){
        $("#timeline, .nuth").hide();
    });
    isShowing = true;
}

function timelinein(){
    window.location.hash = "";
    $("#timelineNuth").show().animate({top:"375px"}, 1000);
    $("#timeline").show().animate({top:"10px"}, 1000, function(){
        $('.sections').hide();
    });
    isShowing = false;
}

//TIMELINE

function openingAnim(){
  //  welcome();
    nuthwalk();
    meetnuth();
}

//CLEAN THIS UP
function setnav(){
    //show anything with the class "active"
    $('#ourapproach .active .descrip p, #programming .tt').show();
    //main nav
    $ybleft = $('#yearbook-nav-inner .active').position();
    $ybwidth = $('#yearbook-nav-inner .active').width();
    $('#yearbook-nav-inner .bar').css({"left":$ybleft.left + "px", "width":$ybwidth+"px"}); 
    //partnerships nav
    $partleft = $('#partnersnav .active').position();
    $partwidth = $('#partnersnav .active').width();
    $('#partnersnav .bar').css({"left":$partleft.left+20 + "px", "width":$partwidth+"px"});
    //programming nav
    //show line under schools on load
    $progleft = $('#programming .navprogram .active').position();
    $progwidth = $('#programming .navprogram .active').width();
    $('#programming .navprogram div').css({"left":$progleft.left +20+ "px", "width":$progwidth+"px"});
    
}

/*function hundred(){
    if(!hundred && $('.bb-item.hundred').attr("display","block")){
        
    }
}*/

/*
function welcome(){
    $("#welcome").delay(1000).fadeIn(1000);
}*/

function nuthwalk(){
    $("#timelineNuth").delay(500).sprite({fps: 15, no_of_frames: 10}).animate({left:"100px"},3000, function(){
        $("#timelineNuth").destroy();
    }); 
}

function meetnuth(){
    $('#welcoming p').hide();
    var position = $("#timelineNuth").position();
    $('.meetnuth').delay(500).fadeIn("fast").delay(2700).fadeOut("fast");
    $('.tour').delay(3500).fadeIn("fast").delay(2700).fadeOut("fast");
    $('.guide').delay(6500).fadeIn("fast").delay(2700).fadeOut("fast");
    $('.adam').delay(9500).fadeIn("fast", function(){
        if(position.left<200){
           nuthwalk2(); 
        } 
    });
    if (position.left<200){
        $('#welcoming img').delay(11500).fadeIn("fast").delay(200).fadeOut("fast").delay(200).fadeIn("fast").delay(200).fadeOut("fast").delay(200).fadeIn("fast", function(){
            
        });
    }
    
}

var refreshmeet = setInterval(function() {
    meetnuth();
	}, 20000);
});

function nuthwalk2(){
    $("#timelineNuth").sprite({fps: 15, no_of_frames: 10}).animate({left:"250px"},3000, function(){
        $("#timelineNuth").spStop(true).destroy();
    }); 
}



//nuth animation
$("#timeline").on("scroll", function(){
    $('.nuth').sprite({fps: 15, no_of_frames: 10, play_frames: 1});
});

$("#timeline").off("scroll", function(){
    $('.nuth').destroy();
});

/* Switches between Nuth and reverse Nuth depending on scroll position */
var pleftPos = 0;
$("#timeline").scroll(function(e) {
	var leftPos = $("#timeline").scrollLeft();
	if(pleftPos > leftPos) {
		//CHANGE TO TOGGLE
		$("#timelineNuth").hide();
		$("#reverseNuth").show();
	} else {
		$("#timelineNuth").show();
		$("#reverseNuth").hide();
	}
	pleftPos = leftPos;
});
	
//Nuth can still walk backwards after going to other sections	
$("#timeline").bind('scroll',function() {
    var what = $("#timeline").scrollTop();
    $(".nuth").css("top", 375-what + 'px');
});

//info hovers
$(".info, .infoicon").hover(function() {
    $(this).find('.arrow_box').toggle();
});

//NUTH TRIGGERS ANIMATIONS
//PUT THIS IN CSS
$(".animation").hide();
$("#timeline").scroll(function(e) {
    var array = [650, 1150, 1850, 2500, 3000, 3450, 3900, 4100, 4600, 5290, 5610];
    var array2 =[1150, 1850, 2500, 3000, 3450, 3900, 4100, 4600, 5290, 5610, 7000];
    var animarray = ["billboard", "tv", "bike", "plane", "freeman", "chalkboard", "balloons", "hotair", "rocket", "school", "fireworks"];
    var timelineLeft = $("#timeline").scrollLeft();
    for(var i = 0, ii = array.length; i < ii; i++){
        if(timelineLeft > array[i] && timelineLeft < array2[i]){
            animate(animarray[i]);
        }
    }
});

function animate(animateid) {
    
	switch(animateid){
        case "billboard":
            billboard_animate();
            break;
        case "tv":
            tv_animate();
            break;
        case "bike":
            bike_animate();
            break;
        case "plane":
            plane_animate();
            break;
        case "balloons":
            balloon_animate();
            break;
        case "hotair":
            hotair_animate();
            break;
        case "rocket":
            rocket_animate();
            break;
        case "freeman":
            freeman_animate();
            break;
        case "chalkboard":
            chalkboard_animate();
            break;
		case "school":
			school();
			break;
        case "fireworks":
			fireworks();
			break;
	}
}

//billboard animation
function billboard_animate() {
	$("#billboard").animate({top: '200px'}, 1000);
    $("#janheader").delay(500).fadeIn("slow");
}

function tv_animate() {
    
	$("#tv").animate({top: '387px'}, 1000);
    $("#newoffice").delay(500).fadeIn("slow");
    $("#infofeb").delay(550).fadeIn();
}

function bike_animate() {
	$("#bike").animate({top: '248px'}, 1000);
    $("#kennedy").delay(500).fadeIn("slow");
}

//plane animation
function plane_animate() {
    $("#julyheader").fadeIn("slow");
    $("#plane").delay(500).animate({top: '70px', left:'160px'}, 1500)
		.animate({left: '+=5px', top: '+=10px'}, 1000); 
}


function freeman_animate() {
	$("#freeman").animate({top: '250px'}, 1000);
    $("#augheader").delay(500).fadeIn("slow");
}

function chalkboard_animate() {
    $("#brokeground").animate({top: '100px', left:'200px'}, 1200);
    $("#septheader").delay(1000).fadeIn("slow");
	$("#chalkboard").delay(2000).animate({top: '357px'}, 1000);
}

//balloon animation
function balloon_animate() {
    $("#octheader").fadeIn("slow");
	$("#balloon1").delay(500).
		animate({top:'-600px', left:'-200px'}, 6250);
	$("#balloon2").delay(500).
		animate({top:'-600px', left:'-82px'}, 8000);
	$("#balloon3").delay(500).
		animate({top:'-600px'}, 7000);
	$("#balloon4").delay(500).
		animate({top:'-600px', left: '50px'}, 5050);
	$('#bowtie').hide();
}

function hotair_animate() {
    $("#hotair").animate({top: '90px'}, 1000);
}
 
function rocket_animate() {
    $("#novheader").fadeIn("slow");
	$("#rocket").delay(2000).animate({top:'-600px'}, 2200); 
	$("#rocket-fire").delay(2000).animate({top:'-600px'}, 2200);
    $("#threed").fadeOut();
}

function school(){
	$(".nuth").hide();
    $("#threed").fadeIn();
}

function fireworks(){
	$(".fireworks").show();
    $("#threed").fadeOut();
}


//ANIMATE ELEMENTS

//mountains
$('.mtn').each(function() {
    var $mtn = $(this);
    $("#timeline").scroll(function() {
        var xPos = -($("#timeline").scrollLeft() * $mtn.data('speed')* .2);
        var coords = xPos + 'px 50%';
        $mtn.css({backgroundPosition: coords});
    });
});
$("#sun").animate({rotate:'+=10deg'},1000);
$(".cloudb").
      animate({left:'+=-600px', opacity:0.0},28000).
      animate({left:'+=600px'},0).
      animate({opacity:0.8},4000);
//$(".cloudb").animate({"left": '+=1px'}, 10000);



/*function cloud_animate() {
$("#clouds").
      animate({left:'+=-4000px', opacity:0.0},120000).
      animate({left:'+=4000px'},2000).
      animate({right:'+=2000px'},8000).
      animate({opacity:0.8},4000, cloud_animate);   
}*/





//other sections
//SCROLL TO ITEM

$('.scroll').click(function(e) {
    $('html,body').animate({ scrollTop: $(this.hash).offset().top}, 200);
    return false;
    e.preventDefault();
});


    
$(window).scroll(function(e) {
	//REDUCE ALL OF THESE WITH LOOPS/SWITCH STATEMENTS
	if(window.location.hash === "#aboutus") {
        $partleft = $('#partnersnav .active').position();
        $partwidth = $('#partnersnav .active').width();
        $('#partnersnav .bar').css({"left":$partleft.left+20 + "px", "width":$partwidth+"px"});
		var scrollonTop = $(window).scrollTop();
		var aHeight = $("#ourstory").height()-100;
		var bHeight = aHeight + $("#partnerships").height()-100;
		var cHeight = bHeight + $("#newhr").height()-100;
		var dHeight = cHeight + $("#schoolculture").height()-100;
		var eHeight = dHeight + $("#faculty").height()-100;
		var fHeight = eHeight + $("#staff").height()-100;
        
        //these should be changed to switch statements or else ifs
		if(scrollonTop < aHeight) {
            $('*').removeClass('sectionblock');
            $("#aboutus .sidebar").find('a').eq(0).addClass('sectionblock');
		}
        else if(scrollonTop > aHeight && scrollonTop < bHeight) {
            $('*').removeClass('sectionblock');
            $("#aboutus .sidebar").find('a').eq(1).addClass('sectionblock');
		}	
        else if(scrollonTop > bHeight && scrollonTop < cHeight){  				
            
            $('*').removeClass('sectionblock');
            $("#aboutus .sidebar").find('a').eq(2).addClass('sectionblock');
		}
        else if(scrollonTop > cHeight && scrollonTop < dHeight){
            $('*').removeClass('sectionblock');
            $("#aboutus .sidebar").find('a').eq(3).addClass('sectionblock');
        }
        else if(scrollonTop > dHeight && scrollonTop < eHeight){
            $('*').removeClass('sectionblock');
            $("#aboutus .sidebar").find('a').eq(4).addClass('sectionblock');
        }
		else if(scrollonTop > eHeight && scrollonTop < fHeight){
  			$('*').removeClass('sectionblock');
            $("#aboutus .sidebar").find('a').eq(5).addClass('sectionblock');
		}
        else if(scrollonTop > fHeight) {
            $('*').removeClass('sectionblock');
            $("#aboutus .sidebar").find('a').eq(6).addClass('sectionblock');
        }
	}
    else if(window.location.hash === "#ourimpact") {
        $('#ourapproach .active .descrip p').show();
        $progleft = $('#programming .navprogram .active').position();
        $progwidth = $('#programming .navprogram .active').width();
        $('#programming .navprogram div').css({"left":$progleft.left +20+ "px", "width":$progwidth+"px"});
        var scrollonTop = $(window).scrollTop();
        var aHeight = $("#ourapproach").height()-100;
        var bHeight = $("#ghana").height() + aHeight-100;
        if(scrollonTop < aHeight) {
            $('*').removeClass('sectionblock');
            $("#ourimpact .sidebar").find('a').eq(0).addClass('sectionblock');
        }
        else if(scrollonTop > aHeight && scrollonTop < bHeight) {
            $('*').removeClass('sectionblock');
            $("#ourimpact .sidebar").find('a').eq(1).addClass('sectionblock');
        }
        else if(scrollonTop > bHeight) {
            $('*').removeClass('sectionblock');
            $("#ourimpact .sidebar").find('a').eq(2).addClass('sectionblock');
        }
    }
	else if(window.location.hash == "#outandabout") {
		var scrollonTop = $(window).scrollTop()+100;
		var aHeight = $("#campaigns").height();
		var bHeight = aHeight + $("#popProm").height();
		var cHeight = $("#events").height() + bHeight;
		var dHeight = $("#press").height() + cHeight;
        var eHeight = $("#digipresence").height() + dHeight;

	    //these should be changed to switch statements or else ifs
		if(scrollonTop < aHeight) {
			$('*').removeClass('sectionblock');
            $("#outandabout .sidebar").find('a').eq(0).addClass('sectionblock');
		}
	    else if(scrollonTop > aHeight && scrollonTop < bHeight) {
			$('*').removeClass('sectionblock');
            $("#outandabout .sidebar").find('a').eq(1).addClass('sectionblock');
		}		
		else if(scrollonTop > bHeight && scrollonTop < cHeight){
			$('*').removeClass('sectionblock');
            $("#outandabout .sidebar").find('a').eq(2).addClass('sectionblock');
		}		
		else if(scrollonTop > cHeight && scrollonTop < dHeight){
			$('*').removeClass('sectionblock');
            $("#outandabout .sidebar").find('a').eq(3).addClass('sectionblock');
		}
		else if(scrollonTop > dHeight && scrollonTop < eHeight){
			$('*').removeClass('sectionblock');
            $("#outandabout .sidebar").find('a').eq(4).addClass('sectionblock');
		}
        else if(scrollonTop > eHeight){
			$('*').removeClass('sectionblock');
            $("#outandabout .sidebar").find('a').eq(5).addClass('sectionblock');
		}
	}
	else if(window.location.hash == "#financials") {
		var scrollonTop = $(window).scrollTop();
		var aHeight = $("#financialssect").height()-100;
		if(scrollonTop < aHeight) {
			$('*').removeClass('sectionblock');
            $("#financials .sidebar").find('a').eq(0).addClass('sectionblock');
		}
		else if(scrollonTop > aHeight){
			$('*').removeClass('sectionblock');
            $("#financials .sidebar").find('a').eq(1).addClass('sectionblock');
		}
	}
}); 

//PUT IN A GENERIC HOVER FUNCTION
$('#OS-chart .seat').hover(function(){
   $(this).find(".staff").fadeIn("fast"); 
}, function(){
   $(this).find(".staff").fadeOut("fast");  
});

/*var rotate = setInterval(function() {
    AnimateRotate(360);
}, 5000);*/


/*
$(".OIourapproach img").mouseenter(function(){
    AnimateRotate(360,$(this));
})

function AnimateRotate(d, elem){
    $({deg: 0}).animate({deg: d}, {
        duration: 500,
        step: function(now){
            elem.css({
                 transform: "rotate(" + now + "deg)"
            });
        }
    });
    
}*/

//PUT IN A GENERIC CLICK FUNCTION
$('#partnersnav li').click(function(){
    $pos = $(this).position();
    $class=$(this).attr("class");
    $('#partnersnav li').removeClass("active");
    $(this).addClass("active");
    $('.partners').hide();
    $("#"+$class).fadeIn();
    $('#partnersnav .bar').animate({left:$pos.left+20+"px", width:$(this).width()+"px"}, 500);
});





/*if($(window).width() < 321){
	$("#yearbook-nav-inner ul li a:nth-child(2)").addClass("active");
    f_c1_mobile();
    f_c2_mobile();
}

else {
	f_c1();
	f_c2();
}*/

f_c1();
f_c2();

//PUT IN GENERIC HOVER FUNCTION
$('.facultymember').hover(function(){
   $(this).find('p:last-of-type').fadeIn(); 
}, function(){
   $(this).find('p:last-of-type').fadeOut();  
});

//PUT IN GENERIC CLICK FUNCTION
$('#s4avid').click(function(){
   $('#greyoverlay').fadeIn("fast");
   $('.s4amodal.close, iframe.s4amodal').fadeIn("fast");
   $('iframe.s4amodal').height($('iframe.s4amodal').width()*.5);
   $('.s4amodal.close, #greyoverlay').click(function(){
       $('#greyoverlay').fadeOut("fast");
       $('.s4amodal.close, iframe.s4amodal').fadeOut();
   });
});

var story = (function() {
				var config = {
						$bookBlock : $( '#bb-bookblock' ),
						$navNext : $( '#bb-nav-next' ),
						$navPrev : $( '#bb-nav-prev' ),
						$navFirst : $( '#bb-nav-first' ),
						$navLast : $( '#bb-nav-last' )
					},
					init = function() {
						config.$bookBlock.bookblock( {
							speed : 800,
							shadowSides : 0.8,
							shadowFlip : 0.7
						} );
						initEvents();
					},
					initEvents = function() {
						
						var $slides = config.$bookBlock.children();

						// add navigation events
						config.$navNext.on( 'click touchstart', function() {
							config.$bookBlock.bookblock( 'next' );
							return false;
						} );

						config.$navPrev.on( 'click touchstart', function() {
							config.$bookBlock.bookblock( 'prev' );
							return false;
						} );

						config.$navFirst.on( 'click touchstart', function() {
							config.$bookBlock.bookblock( 'first' );
							return false;
						} );

						config.$navLast.on( 'click touchstart', function() {
							config.$bookBlock.bookblock( 'last' );
							return false;
						} );
						
						// add swipe events
						$slides.on( {
							'swipeleft' : function( event ) {
								config.$bookBlock.bookblock( 'next' );
								return false;
							},
							'swiperight' : function( event ) {
								config.$bookBlock.bookblock( 'prev' );
								return false;
							}
						} );

						// add keyboard events
						$( document ).keydown( function(e) {
							var keyCode = e.keyCode || e.which,
								arrow = {
									left : 37,
									up : 38,
									right : 39,
									down : 40
								};

							switch (keyCode) {
								case arrow.left:
									config.$bookBlock.bookblock( 'prev' );
									break;
								case arrow.right:
									config.$bookBlock.bookblock( 'next' );
									break;
							}
						} );
					};

					return { init : init };

			})();
            
            story.init();


/*var imposs = (function() {
				var config = {
						$bookBlock : $( '.bb-bookblock' ),
						$navNext : $( '.bb-nav-next' ),
						$navPrev : $( '.bb-nav-prev' ),
						$navFirst : $( '.bb-nav-first' ),
						$navLast : $( '.bb-nav-last' )
					},
					init = function() {
						config.$bookBlock.bookblock( {
							speed : 800,
							shadowSides : 0.8,
							shadowFlip : 0.7
						} );
						initEvents();
					},
					initEvents = function() {
						
						var $slides = config.$bookBlock.children();

						// add navigation events
						config.$navNext.on( 'click touchstart', function() {
							config.$bookBlock.bookblock( 'next' );
							return false;
						} );

						config.$navPrev.on( 'click touchstart', function() {
							config.$bookBlock.bookblock( 'prev' );
							return false;
						} );

						config.$navFirst.on( 'click touchstart', function() {
							config.$bookBlock.bookblock( 'first' );
							return false;
						} );

						config.$navLast.on( 'click touchstart', function() {
							config.$bookBlock.bookblock( 'last' );
							return false;
						} );
						
						// add swipe events
						$slides.on( {
							'swipeleft' : function( event ) {
								config.$bookBlock.bookblock( 'next' );
								return false;
							},
							'swiperight' : function( event ) {
								config.$bookBlock.bookblock( 'prev' );
								return false;
							}
						} );

						// add keyboard events
						$( document ).keydown( function(e) {
							var keyCode = e.keyCode || e.which,
								arrow = {
									left : 37,
									up : 38,
									right : 39,
									down : 40
								};

							switch (keyCode) {
								case arrow.left:
									config.$bookBlock.bookblock( 'prev' );
									break;
								case arrow.right:
									config.$bookBlock.bookblock( 'next' );
									break;
							}
						} );
					};

					return { init : init };

			})();
            
            imposs.init();*/

/*
function f_c1_mobile() {
    Raphael.fn.donutChart = function (cx, cy, r, rin, values, labels, stroke) {
    var paper = this,
        rad = Math.PI / 180,
        chart = this.set();
    function sector(cx, cy, r, startAngle, endAngle, params) {
        //console.log(params.fill);
        var x1 = cx + r * Math.cos(-startAngle * rad),
            x2 = cx + r * Math.cos(-endAngle * rad),
            y1 = cy + r * Math.sin(-startAngle * rad),
            y2 = cy + r * Math.sin(-endAngle * rad),
            xx1 = cx + rin * Math.cos(-startAngle * rad),
            xx2 = cx + rin * Math.cos(-endAngle * rad),
            yy1 = cy + rin * Math.sin(-startAngle * rad),
            yy2 = cy + rin * Math.sin(-endAngle * rad);
        
        return paper.path(["M", xx1, yy1,
                           "L", x1, y1, 
                           "A", r, r, 0, +(endAngle - startAngle > 180), 0, x2, y2, 
                           "L", xx2, yy2, 
                           "A", rin, rin, 0, +(endAngle - startAngle > 180), 1, xx1, yy1, "z"]
                         ).attr(params);
        
    }
    var angle = 0,
        total = 0,
        start = 49,
        count = 0,
        array = ["#ffeb91","#ffd633","#5f4600","#bb8d09","#8d6a00","#febd17"],

        process = function (j) {
            var value = values[j],
                angleplus = 360 * value / total,
                popangle = angle + (angleplus / 2),
                color = Raphael.hsb(start, .43, 1),
                ms = 500,
                delta = 30,
                bcolor = Raphael.hsb(start, .43, 1),
                p = sector(cx, cy, r, angle, angle + angleplus, {fill: array[count], stroke: "none", "stroke-width": 0}),
				txt = paper.text(cx + 5 + (r + delta+47) * Math.cos(-popangle * rad), (cy/2) + (r+5) * Math.sin(-popangle * rad), labels[j]).attr({fill: "#87868c", stroke: "none", opacity: 0, "font-size": 7}); 
			txt.animate({opacity: 1}, ms, "elastic");
            angle += angleplus;
            chart.push(p);
            chart.push(txt);
            start += .1;
                        count += 1;

        };
    for (var i = 0, ii = values.length; i < ii; i++) {
        total += values[i];
        process(i);
    }
    return chart;
};

    var values = [],
        labels = [];
    $(".testing tr").each(function () {
        values.push(parseInt($("td", this).text(), 10));
        labels.push($("th", this).text());
    });
    $(".testing").hide();
       Raphael("holder", 300, 200).donutChart(140, 110, 40, 80, values, labels, "none");
}
*/

function f_c1() {
    Raphael.fn.donutChart = function (cx, cy, r, rin, values, labels, stroke) {
    var paper = this,
        rad = Math.PI / 180,
        chart = this.set();
    function sector(cx, cy, r, startAngle, endAngle, params) {
        //console.log(params.fill);
        var x1 = cx + r * Math.cos(-startAngle * rad),
            x2 = cx + r * Math.cos(-endAngle * rad),
            y1 = cy + r * Math.sin(-startAngle * rad),
            y2 = cy + r * Math.sin(-endAngle * rad),
            xx1 = cx + rin * Math.cos(-startAngle * rad),
            xx2 = cx + rin * Math.cos(-endAngle * rad),
            yy1 = cy + rin * Math.sin(-startAngle * rad),
            yy2 = cy + rin * Math.sin(-endAngle * rad);
        
        return paper.path(["M", xx1, yy1,
                           "L", x1, y1, 
                           "A", r, r, 0, +(endAngle - startAngle > 180), 0, x2, y2, 
                           "L", xx2, yy2, 
                           "A", rin, rin, 0, +(endAngle - startAngle > 180), 1, xx1, yy1, "z"]
                         ).attr(params);
        
    }
    var angle = 0,
        total = 0,
        start = 49,
        count = 0,
        array = ["#ffeb91","#ffd633","#5f4600","#bb8d09","#8d6a00","#febd17"],

        process = function (j) {
            var value = values[j],
                angleplus = 360 * value / total,
                popangle = angle + (angleplus / 2),
                color = Raphael.hsb(start, .43, 1),
                ms = 200,
                delta = 30,
                dy = 20,
                bcolor = Raphael.hsb(start, .43, 1),
                p = sector(cx, cy, r, angle, angle + angleplus, {fill: array[count], stroke: array[count], "stroke-width": 0}),
				txt = paper.text(200, 140, labels[j]).attr({fill: "#87868c", opacity: 1, "font-size": 9}); 
                paper.canvas.setAttributeNS("http://www.w3.org/XML/1998/namespace", "xml:space","preserve");
                $(txt.node).find( 'tspan' ).attr( 'dy', 10 );
			 p.mouseover(function () {
                 $('.charttext').hide();
                 this.animate({ 'stroke-width': 5, 'opacity':.9}, 500, 'elastic');
                txt.stop().animate({opacity: 1}, 100);
             }).mouseout(function () {
                 this.animate({ 'stroke-width': 0, 'opacity':1}, 500, 'elastic');
                 txt.stop().animate({opacity: 0}, ms);
                 $('.charttext').delay(500).show();
            });
			txt.animate({opacity: 0}, ms, "elastic");
            angle += angleplus;
            chart.push(p);
            chart.push(txt);
            start += .1;
                        count += 1;

        };
    for (var i = 0, ii = values.length; i < ii; i++) {
        total += values[i];
    }
    for (i = 0; i < ii; i++) {
        process(i);
    }
    return chart;
};

    var values = [],
        labels = [];
    $(".testing tr").each(function () {
        values.push(parseInt($("td", this).text(), 10));
        labels.push($("th", this).text());
    });
    $(".testing").hide();
       Raphael("holder", 400, 300).donutChart(200, 150, 80, 110, values, labels);
}




function f_c2() {
        Raphael.fn.donutChart = function (cx, cy, r, rin, values, labels, stroke) {
    var paper = this,
        rad = Math.PI / 180,
        chart = this.set();
    function sector(cx, cy, r, startAngle, endAngle, params) {
        //console.log(params.fill);
        var x1 = cx + r * Math.cos(-startAngle * rad),
            x2 = cx + r * Math.cos(-endAngle * rad),
            y1 = cy + r * Math.sin(-startAngle * rad),
            y2 = cy + r * Math.sin(-endAngle * rad),
            xx1 = cx + rin * Math.cos(-startAngle * rad),
            xx2 = cx + rin * Math.cos(-endAngle * rad),
            yy1 = cy + rin * Math.sin(-startAngle * rad),
            yy2 = cy + rin * Math.sin(-endAngle * rad);
        
        return paper.path(["M", xx1, yy1,
                           "L", x1, y1, 
                           "A", r, r, 0, +(endAngle - startAngle > 180), 0, x2, y2, 
                           "L", xx2, yy2, 
                           "A", rin, rin, 0, +(endAngle - startAngle > 180), 1, xx1, yy1, "z"]
                         ).attr(params);
        
    }
    var angle = 0,
        total = 0,
        start = 49,
        count = 0,
        array = ["#ffeb91","#ffd633","#5f4600","#bb8d09","#8d6a00","#febd17"],

        process = function (j) {
            var value = values[j],
                angleplus = 360 * value / total,
                popangle = angle + (angleplus / 2),
                color = Raphael.hsb(start, .43, 1),
                ms = 500,
                delta = 30,
                dy = 20,
                bcolor = Raphael.hsb(start, .43, 1),
                p = sector(cx, cy, r, angle, angle + angleplus, {fill: array[count], stroke: array[count], "stroke-width": 0}),
				txt = paper.text(200, 140, labels[j]).attr({fill: "#87868c", stroke: "none", opacity: 0, "font-size": 9}); 
                paper.canvas.setAttributeNS("http://www.w3.org/XML/1998/namespace", "xml:space","preserve");
                $(txt.node).find( 'tspan' ).attr( 'dy', 10 );
			 p.mouseover(function () {
                 $('.charttext').hide();
                 this.animate({ 'stroke-width': 5, 'opacity':.9}, 500, 'elastic');
                txt.stop().animate({opacity: 1}, 100);
             }).mouseout(function () {
                 this.animate({ 'stroke-width': 0, 'opacity':1}, 500, 'elastic');
                 txt.stop().animate({opacity: 0}, 500);
                 $('.charttext').delay(500).show();
            });
			txt.animate({opacity: 0}, ms, "elastic");
            angle += angleplus;
            chart.push(p);
            chart.push(txt);
            start += .1;
                        count += 1;

        };
    for (var i = 0, ii = values.length; i < ii; i++) {
        total += values[i];
    }
    for (i = 0; i < ii; i++) {
        process(i);
    }
    return chart;
};

    var values = [],
        labels = [];
    $(".testing2 tr").each(function () {
        values.push(parseInt($("td", this).text(), 10));
        labels.push($("th", this).text());
    });
    $(".testing2").hide();
       Raphael("holder2", 500, 300).donutChart(200, 150, 80, 110, values, labels);
       
}

/*
function f_c2_mobile() {
        Raphael.fn.donutChart = function (cx, cy, r, rin, values, labels, stroke) {
    var paper = this,
        rad = Math.PI / 180,
        chart = this.set();
    function sector(cx, cy, r, startAngle, endAngle, params) {
        //console.log(params.fill);
        var x1 = cx + r * Math.cos(-startAngle * rad),
            x2 = cx + r * Math.cos(-endAngle * rad),
            y1 = cy + r * Math.sin(-startAngle * rad),
            y2 = cy + r * Math.sin(-endAngle * rad),
            xx1 = cx + rin * Math.cos(-startAngle * rad),
            xx2 = cx + rin * Math.cos(-endAngle * rad),
            yy1 = cy + rin * Math.sin(-startAngle * rad),
            yy2 = cy + rin * Math.sin(-endAngle * rad);
        
        return paper.path(["M", xx1, yy1,
                           "L", x1, y1, 
                           "A", r, r, 0, +(endAngle - startAngle > 180), 0, x2, y2, 
                           "L", xx2, yy2, 
                           "A", rin, rin, 0, +(endAngle - startAngle > 180), 1, xx1, yy1, "z"]
                         ).attr(params);
        
    }
    var angle = 0,
        total = 0,
        start = 49,
        count = 0,
        array = ["#ffeb91","#ffd633","#5f4600","#bb8d09","#8d6a00","#febd17"],

        process = function (j) {
            var value = values[j],
                angleplus = 360 * value / total,
                popangle = angle + (angleplus / 2),
                color = Raphael.hsb(start, .43, 1),
                ms = 500,
                delta = 30,
                bcolor = Raphael.hsb(start, .43, 1),
                p = sector(cx, cy, r, angle, angle + angleplus, {fill: array[count], stroke: "none", "stroke-width": 0}),
				txt = paper.text(cx + 10 + (r + delta + 48) * Math.cos(-popangle * rad), (cy/2) + (r+4) * Math.sin(-popangle * rad), labels[j]).attr({fill: "#fff", stroke: "none", opacity: 0, "font-size": 7}); 
			txt.animate({opacity: 1}, ms, "elastic");
            angle += angleplus;
            chart.push(p);
            chart.push(txt);
            start += .1;
                        count += 1;

        };
    for (var i = 0, ii = values.length; i < ii; i++) {
        total += values[i];
    }
    for (i = 0; i < ii; i++) {
        process(i);
    }
    return chart;
};

    var values = [],
        labels = [];
    $(".testing2 tr").each(function () {
        values.push(parseInt($("td", this).text(), 10));
        labels.push($("th", this).text());
    });
    $(".testing2").hide();
       Raphael("holder2", 300, 200).donutChart(140, 110, 40, 80, values, labels, "none");
}*/