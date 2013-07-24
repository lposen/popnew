$(document).ready(function() { 	

//LOADING
$('#yearbook').hide();
$('#loader').show();
onload = function() {
    $('#yearbook').fadeIn();
    $('#loader').hide();
    setLayout();
    openingAnim();
};

var isIE = /*@cc_on!@*/false;
var ieVersion = /*@cc_on (function() {switch(@_jscript_version) {case 1.0: return 3; case 3.0: return 4; case 5.0: return 5; case 5.1: return 5; case 5.5: return 5.5; case 5.6: return 6; case 5.7: return 7; case 5.8: return 8; case 9: return 9; case 10: return 10;}})() || @*/ 0;

if (isIE && (ieVersion !== 9) && (ieVersion !== 10)){
    $('#browserwarning, #browserwarning .ie').show();
    $('.ieversion').html(ieVersion);
    $('iframe, #browserwarning .close, #browserwarning .mobile').hide();
    $('#timeline').show();
}
/*else if ($(window).width()<500) {
    $('#browserwarning, #browserwarning .mobile').show();
    $('iframe, #browserwarning .close, #browserwarning .ie').hide();
    $('#timeline').show();
}*/
else {
    $('#browserwarning').hide();
   // $('#timeline').show();
}
 
$hash = window.location.hash;
story.init();

//LAYOUT

//program
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

$('.facultymember').hover(function(){
   $(this).find('p:last-of-type').fadeIn(); 
}, function(){
   $(this).find('p:last-of-type').fadeOut();  
});

$('#s4avid').click(function(){
   $('#greyoverlay').fadeIn("fast");
   $('.close, iframe.s4amodal').fadeIn("fast");
   $('iframe.s4amodal').height($('iframe.s4amodal').width()*.5);
   $('.close, #greyoverlay').click(function(){
       $('#greyoverlay').fadeOut("fast");
       $('.close, iframe.s4amodal').fadeOut();
   });
});



$('#partnersnav li').click(function(){
    $pos = $(this).position();
    $class=$(this).attr("class");
    $('#partnersnav li').removeClass("active");
    $(this).addClass("active");
    $('.partners').hide();
    $("#"+$class).fadeIn();
    $('#partnersnav .bar').animate({left:$pos.left+20+"px", width:$(this).width()+"px"}, 500);
});

// school culture carousel
$('#ca-container').contentcarousel();

//digipresence hover
$('#digipresence nav li').hover(function(){
   $class=$(this).attr("class");
   $('.DPstats').hide();
   $('#'+$class).show();
});

//our approach rectangle hover
$('.OIourapproach').hover(function(){
    $('.OIourapproach').removeClass("active");
    $(this).addClass("active");
});
    function menuslideout(){
        $('#yearbooktoggle').toggleClass('closed').addClass('open');
        $('#yearbook-nav').animate({left:"0"},500);
        $('body').animate({left:"200px"},500);
    }
//size content section correctly
if($(window).width() < 500){
    $('.content').width($(window).width());
    $('.stats').width($(window).width()-300);
    $(window).resize(function() {
         $('.stats').width($(window).width()-300);
    });  
    $('#yearbooktoggle.closed').click(function(){
       menuslideout();
    });
    $('#yearbooktoggle.open, .content, #timeline').click(function(){
        menuslidein();
    });
   
}
else {
    $('.content').width($(window).width()-210);
    $(window).resize(function() {
         $('.content').width($(window).width()-210);
    }); 
    $('.stats').width($(window).width()-600);
    $(window).resize(function() {
         $('.stats').width($(window).width()-600);
    });
}

//mobile button toggle
 //toggle menu


    function menuslidein(){
        $('#yearbooktoggle').removeClass('open').addClass('closed');
        $('#yearbook-nav').animate({"left":"-200px"},500);
        $('body').animate({left:"0"},500);
    }

//wrap sidebar in div for shadow
$('.sidebar').wrap('<div class="backshadow sb" />');
//size sidebar correctly
$('.backshadow.sb, .sidebar').height($(window).height());

//create yellowcorner divs
$('.yellowcorner').append("<div class='box1'></div><div class='box2'></div><div class='box3'></div><div class='box4'></div>");

$windowht = $(window).height()
$('#timeline').height($windowht-20).css("max-height",$windowht-20);

//NAVIGATION

$('.scroll').click(function() {
    $('html,body').animate({ scrollTop: $(this.hash).offset().top}, 200);
    return false;
    e.preventDefault();
});

/* Adds the active class to the clicked section name in yearbook navigation bar */
$("#yearbook-nav-inner ul li a").click(function() {
    $pos = $(this).position();
    $id = $(this).attr('href');
    if ($(window).width()<500){
      menuslidein();  
    } 
    $('.sections').hide();
    
    $($id).fadeIn("fast");
    $("#readmore").hide();
    $('.bar').animate({left:$pos.left+"px", width:$(this).width()+"px"}, 500);
	$("#yearbook-nav-inner ul li a").removeClass("active");
    $(this).addClass("active");
    
});

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
    $(".nuth").css("top", 355-what + 'px');
});

//NUTH TRIGGERS ANIMATIONS
$(".animation").hide();
$("#timeline").scroll(function(e) {
    var array = [650, 1150, 1850, 2500, /*freeman*/3500, /*chalkboard*/4050, /*balloons*/5200, /*hotair*/5300, /*rocket*/5680, /*school*/7010, /*fireworks*/7380];
    var array2 =[1150, 1850, 2500, /*freeman*/3500, /*chalkboard*/4050, /*balloons*/5200, /*hotair*/5300, /*rocket*/5680, 7010, 7380, 9080];
    var animarray = ["billboard", "tv", "bike", "plane", "freeman", "chalkboard", "balloons", "hotair", "rocket", "school", "fireworks"];
    var timelineLeft = $("#timeline").scrollLeft();
    for(var i=0; i<array.length;i++){
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
	$("#billboard").animate({top: '200px'}, 1000, function() {
	});
    $("#janheader").delay(500).fadeIn("slow");
}

function tv_animate() {
	$("#tv").animate({top: '387px'}, 1000, function() {
	});
    $("#newoffice").delay(500).fadeIn("slow");
    $("#infofeb").delay(550).fadeIn();
}

function bike_animate() {
	$("#bike").animate({top: '248px'}, 1000, function() {
	});
    $("#kennedy").delay(500).fadeIn("slow");
}

//plane animation
function plane_animate() {
    $("#julyheader").fadeIn("slow");
    $("#plane").delay(500).animate({top: '100px', left:'200px'}, 1500)
		.animate({left: '+=5px', top: '+=10px'}, 1000); 
    
}

function freeman_animate() {
	$("#freeman").animate({top: '250px'}, 1000, function() {
	});
    $("#augheader").delay(500).fadeIn("slow");
}

function chalkboard_animate() {
    $("#brokeground").animate({top: '100px', left:'500px'}, 1200);
    $("#septheader").delay(1000).fadeIn("slow");
	$("#chalkboard").delay(2000).animate({top: '307px'}, 1000, function() {
	});
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
    $("#hotair").animate({top: '90px'}, 5000, function() {
	});
}
 
function rocket_animate() {
     $("#novheader").fadeIn("slow");
	$("#rocket").delay(2000).animate({top:'-600px'}, 2200); 
	$("#rocket-fire").delay(2000).animate({top:'-600px'}, 2200);
    $("#threed").fadeOut();
}

function school(){
	$("#timelineNuth, #reverseNuth").hide();
    $("#threed").fadeIn();
}

function fireworks(){
	$(".fireworks").show();
    $("#threed").fadeOut();
    $("#educate, #edbg").delay(500).fadeIn(500);
    $("#readmore").delay(1500).fadeIn();
}
});



//info hovers
$(".info, .infoicon").hover(function() {
    $(this).find('.arrow_box').toggle();
});

//kennedy/sophia links clicked
$('#timeline .outandabout').click(function(){
    $("#yearbook-nav-inner ul li a").removeClass("active");
    $('#yearbook-nav-inner ul li .outandabout').addClass("active");
    $('#timeline').fadeOut();
    $pos = $('#yearbook-nav-inner ul li .outandabout').position();
    $width = $('#yearbook-nav-inner ul li .outandabout').width();
    $("#outandabout").fadeIn("fast");
    $('.bar').animate({left:$pos.left+"px", width:$width+"px"}, 500);
    setHash('outandabout');
});

//MAKE INTO FUNCTIONS
$("#sun").animate({rotate:'+=10deg'},1000);
$(".cloudb").
      animate({left:'+=-600px', opacity:0.0},28000).
      animate({left:'+=600px'},0).
      animate({opacity:0.8},4000);

$(window).scroll(function(e) {
	if(window.location.hash == "#aboutus") {
        $partleft = $('#partnersnav .active').position();
        $partwidth = $('#partnersnav .active').width();
        $('#partnersnav .bar').css({"left":$partleft.left+20 + "px", "width":$partwidth+"px"});
		var scrollonTop = $(window).scrollTop();
        var aHeight = $("#ourmission").height()-100;
		var bHeight = aHeight + $("#ourstory").height()-100;
		var cHeight = bHeight + $("#partnerships").height()-100;
		var dHeight = cHeight + $("#newhr").height()-100;
		var eHeight = dHeight + $("#schoolculture").height()-100;
		var fHeight = eHeight + $("#faculty").height()-100;
		var gHeight = fHeight + $("#staff").height()-100;
        
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
        else if(scrollonTop > fHeight && scrollonTop < gHeight) {
			$('*').removeClass('sectionblock');
            $("#aboutus .sidebar").find('a').eq(6).addClass('sectionblock');
        }
        else if(scrollonTop > gHeight) {
			$('*').removeClass('sectionblock');
            $("#aboutus .sidebar").find('a').eq(7).addClass('sectionblock');
        }
	}
    else if(window.location.hash == "#ourimpact") {
        $('#ourapproach .active .descrip p').show();
        $progleft = $('#programming .navprogram .active').position();
        $progwidth = $('#programming .navprogram .active').width();
        $('#programming .navprogram div').css({"left":$progleft.left +20+ "px", "width":$progwidth+"px"});
        var scrollonTop = $(window).scrollTop();
        var aHeight = $("#ghana").height()-100;
        var bHeight = $("#ourapproach").height() + aHeight-100;
        var cHeight = $("#programming").height() + bHeight-100;
        var dHeight = $("#impactmetrics").height() + cHeight-100;
        if(scrollonTop < aHeight) {
            $('*').removeClass('sectionblock');
            $("#ourimpact .sidebar").find('a').eq(0).addClass('sectionblock');
        }
        else if(scrollonTop > aHeight && scrollonTop < bHeight) {
            $('*').removeClass('sectionblock');
            $("#ourimpact .sidebar").find('a').eq(1).addClass('sectionblock');
        }
        else if(scrollonTop > bHeight && scrollonTop < cHeight) {
            $('*').removeClass('sectionblock');
            $("#ourimpact .sidebar").find('a').eq(2).addClass('sectionblock');
        }
        else if(scrollonTop > cHeight) {
            $('*').removeClass('sectionblock');
            $("#ourimpact .sidebar").find('a').eq(3).addClass('sectionblock');
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

$('#OS-chart .seat').hover(function(){
   $(this).find(".staff").fadeIn("fast"); 
}, function(){
   $(this).find(".staff").fadeOut("fast");  
});


//FUNCTIONS

//layout

function setLayout(){
    setHash();
    setNav();
}

function setHash(){
    $('.sections').hide();
    if($hash){
        $($hash).show();
        $class=$hash.replace("#",".");
        $($class).addClass("active");
    }
    else {
        $("#timeline, #timelineNuth").show();
    }
}

function setNav(){
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


function openingAnim(){
    welcome();
    nuthwalk();
    meetnuth();
}

function welcome(){
    $("#welcome").delay(1000).fadeIn(1000);
}

function nuthwalk(){
    $("#timelineNuth").delay(200).sprite({fps: 15, no_of_frames: 10}).animate({left:"120px"},3000, function(){
        $("#timelineNuth").destroy();
    }); 
}

function meetnuth(){
    $('#welcoming p, #welcoming .info_box.arrow_box').hide();
    var position = $("#timelineNuth").position();
    $('#welcoming .info_box.arrow_box, #welcoming .meetnuth').delay(2100).fadeIn(500);
    $('#welcoming .meetnuth').delay(2100).fadeOut(0);
    $('#welcoming .tour').delay(4700).fadeIn(200).delay(2100).fadeOut(0);
    $('#welcoming .adam').delay(7200).fadeIn(200);
    $('#welcoming .info_box.arrow_box').delay(8000).fadeOut(200, function(){
        nuthwalk2();
    })
//    $('#welcoming .guide').delay(6500).fadeIn("fast").delay(2700).fadeOut("fast");
   /*  $('#welcoming .adam').delay(7200).fadeIn(200, function(){
        if(position.left<200){
           nuthwalk2(); 
        } 
    });
   if (position.left<200){
        $('#welcoming img').delay(7500).fadeIn("fast").delay(200).fadeOut("fast").delay(200).fadeIn("fast")
		.delay(200).fadeOut("fast").delay(200).fadeIn("fast", function(){
        });
    }*/
    
}

/*var refreshmeet = setInterval(function() {
    meetnuth();
}, 20000);*/ ///SET TIMEOUT HERE TO SAVE MEMORY

function nuthwalk2(){
    $("#timelineNuth").sprite({fps: 15, no_of_frames: 10}).animate({left:"250px"},3000, function(){
        $("#timelineNuth").spStop(true).destroy();
    }); 
}


//mountains
$('.mtn').each(function() {
    var $mtn = $(this);
    $("#timeline").scroll(function() {
        var xPos = -($("#timeline").scrollLeft() * $mtn.data('speed')* .2);
        var coords = xPos + 'px 50%';
        $mtn.css({backgroundPosition: coords});
    });
});




var story = (function() {
	var config = {
			$bookBlock : $( '#bb-bookblock' ),
			$navNext : $( '#bb-nav-next' ),
			$navPrev : $( '#bb-nav-prev' )
		},
		init = function() {
			config.$bookBlock.bookblock( {
				speed : 1000,
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
						right : 39
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
            


/*if($(window).width() < 321)
{
	$("#yearbook-nav-inner ul li a:nth-child(2)").addClass("active");
    f_c1_mobile();
    f_c2_mobile();
}
else {*/
	f_c1();
	f_c2();
//}

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
       Raphael("holder", 300, 200).donutChart(140, 110, 40, 80, values, labels, "none");
}


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
                 $('.charttext1').hide();
                 this.animate({ 'stroke-width': 5, 'opacity':.9}, 500, 'elastic');
                txt.stop().animate({opacity: 1}, 100);
             }).mouseout(function () {
                 this.animate({ 'stroke-width': 0, 'opacity':1}, 500, 'elastic');
                 txt.stop().animate({opacity: 0}, ms);
                 $('.charttext1').delay(500).show();
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
                 $('.charttext2').hide();
                 this.animate({ 'stroke-width': 5, 'opacity':.9}, 500, 'elastic');
                txt.stop().animate({opacity: 1}, 100);
             }).mouseout(function () {
                 this.animate({ 'stroke-width': 0, 'opacity':1}, 500, 'elastic');
                 txt.stop().animate({opacity: 0}, 500);
                 $('.charttext2').delay(500).show();
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
}
