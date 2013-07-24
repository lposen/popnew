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
 Template Name: Yearbook
 */
 

get_header(); ?>
<script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.8.4/TweenMax.min.js"></script>
<script src="http://code.createjs.com/createjs-2013.02.12.min.js"></script>
<script src="http://code.createjs.com/easeljs-0.6.0.min.js"></script>
<style>
.demoLogoBlack {
position: relative;
background: url(/_img/tour/demo_logo_black.jpg) no-repeat;
height: 60px;
width: 60px;
}
</style>
	<div id="primary" class="site-content">
		<div id="content" role="main">
            <div id="yearbook">
            	<div id="logo" class="demoLogoBlack" style="width:10px; height:10px; background-color: grey;"></div>
                <div style="width:100%; display:block; clear:both;"></div>
            	<div class="stage">
                  <div class="ken stance"></div>
                </div>
                <div class="page">
                <h2 style="padding: 20px 0 10px 0;">Sign our yearbook!</h2>
                	<div class="sign">
                    
                    </div>
                </div>
                <div class="page">
                	<div class="sign"></div>
                </div>
                <div class="page">
                	<div class="sign"></div>
                </div>
                <div class="page">
                	<div class="sign"></div>
                </div>
                <div class="page">
                	<div class="sign"></div>
                </div>
                <div class="page hard">
                	<div class="sign"></div>
                </div>
                <div class="page hard">
                	<div class="sign"></div>
                </div>
            </div>


		</div><!-- #content -->
	</div><!-- #primary -->
    <script>
window.onload = function(){
    var logo = document.getElementById("logo");
	var tl = new TimelineLite({paused:true});
tl.from(logo, 0.5, {left:"-=60px", ease:Back.easeOut})
  .from(timelineLite, 0.5, {width:"0px", alpha:0}, "-=0.2")
  .staggerFrom(tagline, 0.5, {top:"-=30px", rotation:"-40deg", alpha:0, scale:1.8, ease:Back.easeOut}, 0.2);
  tl.add("skew") // adds a new label
  .add(getSkewAnimation()) // method returns a TimelineLite instance that gets nested at the end
  .add(getStaggerAnimation(), "stagger") //creates new label and adds animation there
  .add(getParticlesAnimation(), "particles")
}
</script>
    <script>
		var $ken = $('.ken');
		var $kenPos, $fireballPos;
		
		var punch = function(){
		  $ken.addClass('punch'); 
		  setTimeout(function() { $ken.removeClass('punch'); }, 150);
		  return false;
		};
		var kick = function(){
		  $ken.addClass('kick');
		  setTimeout(function() { $ken.removeClass('kick'); }, 500);
		  return false;
		};
		var rkick = function(){
		  $ken.addClass('reversekick');
		  setTimeout(function() { $ken.removeClass('reversekick'); }, 500); 
		  return false;
		};
		var tatsumaki = function(){
		  $ken.addClass('tatsumaki');
		  setTimeout(function() { $ken.addClass('down'); }, 1500); 
		  setTimeout(function() { $ken.removeClass('tatsumaki down'); }, 2000);
		  return false;
		};
		var hadoken = function(){
		  $ken.addClass('hadoken'); 
		  setTimeout(function() { $ken.removeClass('hadoken'); }, 500); 
		  setTimeout(function() {
			  var $fireball = $('<div/>', { class:'fireball' });
			  $fireball.appendTo($ken);
					  
			  var isFireballColision = function(){ 
				  return $fireballPos.left + 75 > $(window).width() ? true : false;
			  };
		  
			  var explodeIfColision = setInterval(function(){
						  
				  $fireballPos = $fireball.offset();
				  //console.log('fireballInterval:',$fireballPos.left);
		  
				  if (isFireballColision()) {
					  $fireball.addClass('explode').removeClass('moving').css('marginLeft','+=22px'); 
					  clearInterval(explodeIfColision);
					  setTimeout(function() { $fireball.remove(); }, 500); 
				  }
		  
			  }, 50);
		  
			  setTimeout(function() { $fireball.addClass('moving'); }, 20);
					  
			  setTimeout(function() { 
				  $fireball.remove(); 
				  clearInterval(explodeIfColision);
			  }, 3020);
		  
		  }, (250));
		  return false;
		};
		var shoryuken = function(){
		  $ken.addClass('shoryuken');
		  setTimeout(function() { $ken.addClass('down'); }, 500); 
		  setTimeout(function() { $ken.removeClass('shoryuken down'); }, 1000);
		  return false;
		};
		var jump = function(){
		  $ken.addClass('jump');
		  setTimeout(function() { $ken.addClass('down'); }, 500); 
		  setTimeout(function() { $ken.removeClass('jump down'); }, 1000); 
		  return false;
		};
		var kneel = function(){
		  $ken.addClass('kneel');
		  return false;
		};
		var walkLeft = function(){
		  $ken.addClass('walk').css({ marginLeft:'-=10px' });
		  return false;
		};
		var walkRight = function(){
		  $ken.addClass('walk').css({ marginLeft:'+=10px' });
		  return false;
		};
		
		// on click events
		$('#a').click(punch);
		$('#z').click(kick);
		$('#e').click(rkick);
		$('#q').click(tatsumaki);
		$('#s').click(hadoken);
		$('#d').click(shoryuken);
		$('#up').click(jump);
		$('#down').on('mousedown mouseup', function(e){
			if (e.type == 'mousedown') { kneel(); }
			else { $ken.removeClass('kneel'); }
		});
		$('#left').on('mousedown mouseup', function(e){
			if (e.type == 'mousedown') { walkLeft(); }
			else { $ken.removeClass('walk'); }
		});
		$('#right').on('mousedown mouseup', function(e){
			if (e.type == 'mousedown') { walkRight(); }
			else { $ken.removeClass('walk'); }
		});

// on keydown events
$(document).on('keydown keyup', function(e) {
    if (e.type == 'keydown') { 
        
        // s - hadoken
        if (e.keyCode == 83 
            && !$ken.hasClass('tatsumaki') 
            && !$ken.hasClass('shoryuken') 
            && !$ken.hasClass('hadoken') 
            && !$ken.hasClass('punch') 
            && !$ken.hasClass('kick') 
            && !$ken.hasClass('reversekick')
        ) { 
            hadoken();
        }

        // d - shoryuken
        if (e.keyCode == 68 
            && !$ken.hasClass('tatsumaki')
            && !$ken.hasClass('shoryuken') 
            && !$ken.hasClass('hadoken') 
            && !$ken.hasClass('punch') 
            && !$ken.hasClass('kick') 
            && !$ken.hasClass('reversekick')
            && !$ken.hasClass('jump')
        ) { 
            shoryuken();
        }

        // q - tatsumaki senpuu kyaku
        if (e.keyCode == 81 
            && !$ken.hasClass('tatsumaki') 
            && !$ken.hasClass('shoryuken') 
            && !$ken.hasClass('hadoken') 
            && !$ken.hasClass('punch') 
            && !$ken.hasClass('kick') 
            && !$ken.hasClass('reversekick')
            && !$ken.hasClass('jump')
        ) { 
            tatsumaki();
        }

        // a - punch
        if (e.keyCode == 65 
            && !$ken.hasClass('punch') 
            && !$ken.hasClass('hadoken') 
            && !$ken.hasClass('shoryuken') 
            && !$ken.hasClass('tatsumaki') 
        ) { 
            punch(); 
        }

        // e - kick
        if (e.keyCode == 90 
            && !$ken.hasClass('kick') 
            && !$ken.hasClass('hadoken') 
            && !$ken.hasClass('shoryuken') 
            && !$ken.hasClass('tatsumaki')
        ) { 
            kick(); 
        }

        // r - reverse kick
        if (e.keyCode == 69 
            && !$ken.hasClass('reversekick') 
            && !$ken.hasClass('kick') 
            && !$ken.hasClass('hadoken') 
            && !$ken.hasClass('shoryuken') 
            && !$ken.hasClass('tatsumaki')
        ) { 
            rkick();
        }

        // up - jump
        if (e.keyCode == 38 
            && !$ken.hasClass('jump') 
            && !$ken.hasClass('reversekick') 
            && !$ken.hasClass('kick') 
            && !$ken.hasClass('hadoken') 
            && !$ken.hasClass('shoryuken') 
            && !$ken.hasClass('tatsumaki')
        ) { 
            jump();
        }

        // down - kneel
        if (e.keyCode == 40 
            && !$ken.hasClass('kneel') 
            && !$ken.hasClass('jump') 
            && !$ken.hasClass('reversekick') 
            && !$ken.hasClass('kick') 
            && !$ken.hasClass('hadoken') 
            && !$ken.hasClass('shoryuken') 
            && !$ken.hasClass('tatsumaki')
        ) { 
            kneel();
        }
    
    
        // ← flip 
        //if (e.keyCode == 37) $ken.addClass('flip');
        // → unflip 
        //if (e.keyCode == 39) $ken.removeClass('flip');
        // ←← →→ walking
        if (e.keyCode == 37) { walkLeft(); }
        if (e.keyCode == 39) { walkRight(); }
    }
    else { // keyup
        $ken.removeClass('walk kneel');
    }

    //console.log(e.keyCode);
});

    </script>
<?php get_footer(); ?>