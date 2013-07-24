<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Gala_2012
*/
?>

<html>
	<head>
		<title>Pencils of Promise Gala</title>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
                <script src="<?php bloginfo('stylesheet_directory'); ?>/js/galleria-1.2.8.min.js"></script>

        <!-- load flickr plugin -->
        <script src="<?php bloginfo('stylesheet_directory'); ?>/js/galleria.flickr.min.js"></script>
        <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/modernizr.custom.53451.js"></script>
        
                <script type="text/javascript">

            //Edit data below to your personal preferences ----------------------------------

            //Give the date ---------------------------------
            year = 2012; month = 11; day = 25;
            //Give the point of time ------------------------
            hour= 19; min= 0; sec= 0;
            //-----------------------------------------------

            //Standard text ---------------------------------
            main_titel= '';
            sub_titel= '';
            social_network_titel= '';
            //-----------------------------------------------

            //URL's --- (use 'hide' to hide) ----------------
            facebook= 'hide';
            twitter= 'hide';
            rss= 'hide';
            deviantart= 'hide';
            myspace= 'hide';
            lastfm= 'hide';
            flikr= 'hide';
            //-----------------------------------------------

            //End editing -------------------------------------------------------------------
            </script>
            <script type="text/javascript">
             $(document).ready(function() {
   $('.slogan_main').slogan_main();
    $('.slogan_social').slogan_social();
    $('#social_media').social_media();
	
	$("img.in").hover(
		function() {
			$(this).stop().animate({"opacity": "0"}, "slow");
	},
		function() {
			$(this).stop().animate({"opacity": "1"}, "slow");
	});
});
		
$.fn.extend({
    social_media: function() {
            return this.each(function() {
                
				var counter=7;
				
                var $this = $(this);
                var html = '';
				if (facebook == 'hide'){var counter = counter-1}
				else{
				html    += '<div class="social_box">';
                html 	+= '<a href="'+facebook+'"><img src="countdown_files/img/social_media/facebook_in.png" alt="" class="in"></a>';
				html    += '<img src="countdown_files/img/social_media/facebook_out.png" alt="" class="out">';
				html    += '</div>';
				}

				if (twitter == 'hide'){var counter = counter-1}
				else{	
				html    += '<div class="social_box">';				
				html    += '<a href="'+twitter+'"><img src="countdown_files/img/social_media/twitter_in.png" alt="" class="in"></a>';
				html    += '<img src="countdown_files/img/social_media/twitter_out.png" alt="" class="out">';
				html    += '</div>';
				}
	
				if (rss == 'hide'){var counter = counter-1}
				else{	
				html    += '<div class="social_box">';
				html    += '<a href="'+rss+'"><img src="countdown_files/img/social_media/rss_in.png" alt="" class="in"></a>';
				html    += '<img src="countdown_files/img/social_media/rss_out.png" alt="" class="out">';
				html    += '</div>';
				}

				if (deviantart == 'hide'){var counter = counter-1}
				else{
				html    += '<div class="social_box">';
				html    += '<a href="'+deviantart+'"><img src="countdown_files/img/social_media/deviantart_in.png" alt="" class="in"></a>';
				html    += '<img src="countdown_files/img/social_media/deviantart_out.png" alt="" class="out">';
				html    += '</div>';
				}
				
				if (myspace == 'hide'){var counter = counter-1}
				else{	
				html    += '<div class="social_box">';
				html    += '<a href="'+myspace+'"><img src="countdown_files/img/social_media/myspace_in.png" alt="" class="in"></a>';
				html    += '<img src="countdown_files/img/social_media/myspace_out.png" alt="" class="out">';
				html    += '</div>';
				}

				
				if (lastfm == 'hide'){var counter = counter-1}
				else{	
				html    += '<div class="social_box">';
				html    += '<a href="'+lastfm+'"><img src="countdown_files/img/social_media/lastfm_in.png" alt="" class="in"></a>';
				html    += '<img src="countdown_files/img/social_media/lastfm_out.png" alt="" class="out">';
				html    += '</div>';
				}

				
				if (flikr == 'hide'){var counter = counter-1}
				else{	
				html    += '<div class="social_box">';
				html    += '<a href="'+rss+'"><img src="countdown_files/img/social_media/flikr_in.png" alt="" class="in"></a>';
				html    += '<img src="countdown_files/img/social_media/flikr_out.png" alt="" class="out">';
				html    += '</div>';
				}

				$this.html(html);  
				if(counter==1){$("#social_media").css('width', "40px"); }
				else if(counter==2){$("#social_media").css('width', "80px"); }
				else if(counter==3){$("#social_media").css('width', "120px"); }
				else if(counter==4){$("#social_media").css('width', "160px"); }
				else if(counter==5){$("#social_media").css('width', "200px"); }
				else if(counter==6){$("#social_media").css('width', "240px"); }
				else if(counter==7){$("#social_media").css('width', "280px"); }
				
            });
        }
});

$.fn.extend({
  slogan_main: function() {
            return this.each(function() {
                
                var $this = $(this);
                var html = '<div id="main_titel">' + main_titel + '<span>' + sub_titel + '</span></div>';
				 
                $this.html(html);  
            });
        }
});

$.fn.extend({
		
	slogan_social: function() {
            return this.each(function() {
                
                var $this = $(this);
                var html = '<div id="main_titel"><span>' + social_network_titel + '</span></div>';
                $this.html(html);  
            });
        }
});


month= --month;
dateFuture = new Date(year,month,day,hour,min,sec);

function GetCount(){

        dateNow = new Date();                                                            
        amount = dateFuture.getTime() - dateNow.getTime()+5;               
        delete dateNow;

        /* time is already past */
        if(amount < 0){
                out=
				"<div id='days'><span></span>0<div id='days_text'></div></div>" + 
				"<div id='hours'><span></span>0<div id='hours_text'></div></div>" + 
				"<div id='mins'><span></span>0<div id='mins_text'></div></div>" + 
				"<div id='secs'><span></span>0<div id='secs_text'></div></div>" ;
                document.getElementById('countbox').innerHTML=out;       
        }
        /* date is still good */
        else{
                days=0;hours=0;mins=0;secs=0;out="";

                amount = Math.floor(amount/1000); /* kill the milliseconds */

                days=Math.floor(amount/86400); /* days */
                amount=amount%86400;

                hours=Math.floor(amount/3600); /* hours */
                amount=amount%3600;

                mins=Math.floor(amount/60); /* minutes */
                amount=amount%60;

                
                secs=Math.floor(amount); /* seconds */


                out=
				"<div id='days'><span></span>" + days +"<div id='days_text'></div></div>" + 
				"<div id='hours'><span></span>" + hours +"<div id='hours_text'></div></div>" + 
				"<div id='mins'><span></span>" + mins +"<div id='mins_text'></div></div>" + 
				"<div id='secs'><span></span>" + secs +"<div id='secs_text'></div></div>" ;
                document.getElementById('countbox').innerHTML=out;
			

                setTimeout("GetCount()", 1000);
        }
}

window.onload=function(){GetCount();}

</script>
<meta charset="utf-8">
<meta name="generator" content="Wufoo">
<meta name="robots" content="index, follow">
<script src="scripts/wufoo.js"></script>

            <link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('template_directory'); ?>/gfx/gala/count/favicon.ico">
            <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/counter.js"></script>
                
                <style  type="text/css">
                    body {
                        background: black;
                        color: white;
                        font-family: Helvetica;
                        text-align: justify;
                        font-weight: 100;
                    }
                    
                    .uppercase {
                        text-transform: uppercase;
                    }
                    
                    .lowercase {
                        text-transform: lowercase;
                    }
                    
                    #introduction {
                        width: 400px;
                        display: block;
                        padding-top: 80px;
                        text-align: justify;
                    }
                    
                    .right {
                        width: 48%;
                        float: right;
                    }
                    
                    .left {
                        float: left;
                        width: 48%;
                        height: 400px;
                        display: block;
                        margin-bottom: 70px;
                    }
                    
                    .inner {
                        width: 400px;
                    }
                    
                    #character_justify, #2 {
                        
                        display: inline-block;
                        text-align: justify;
                    }
                    
                    .even {
                        text-align: justify;
                    }
                    
                    .even span:not(.stretch), .even div:not(.stretch) {
                        display: inline-block;
                        vertical-align: middle;
                        margin-left: auto;
                        margin-right: auto;
                    }
                    
                    .stretch {
                        width: 100%;
                        display: inline-block;
                        font-size: 0;
                        line-height: 0
                    }
                    
                    .character_justify {
                        position: relative;
                        width: 400px;
                        margin: 0;
                        padding: 0;
                    }
                    #character_justify *, #2 * {
                        margin: 0;
                        padding: 0;
                        border: none;
                    }
                    
                    input[type="submit"] {
                        float: right;
                        margin-top: 10px;
                        width: 70px;
                        height: 30px;
                        background-color: #E2E2E2;
                        border-radius: 10px;
                        color: gray;
                    }
                    
                    input[type="text"], input[type="email"] {
                        width: 100%;
                        height: 40px;
                        border-radius: 10px;
                        background: #E2E2E2;
                        margin-top: 10px;
                    }
                    
                    label {
                        position: relative;
                        top: 15px;
                    }
                    
                    input[type="checkbox"] {
                        position: relative;
                        top: 15px;
                    }
                    
                    
                    #countbox {
                        color: white;
                        font-family: Myriad Pro,Helvetica,sans-serif;
                        font-size: 70px;
                        width: 432px;
                        height: 130px;
                        margin-left: auto;
                        margin-right: auto;
                        position: relative;
                        left: -20px;
                        margin-top: -10px;
                    }

                    #days{
                            float: left;
                            text-align: center;	
                            background-image:url('/wp-content/themes/pencilsofpromise/gfx/gala/count/flip.png');
                            background-repeat:no-repeat;
                            margin: 0 7px 0 7px;
                            height: 89px;
                            width: 94px;
                            z-index:1;
                    }

                    #days_text{
                            background-image:url('/wp-content/themes/pencilsofpromise/gfx/gala/count/days_text.jpg');
                            background-position: center;
                            background-repeat:no-repeat;
                            position: relative;
                            margin-top: 0;
                            height: 26px;
                            width: 94px;
                    }

                    #hours{	
                            float: left;
                            text-align: center;
                            background-image:url('/wp-content/themes/pencilsofpromise/gfx/gala/count/flip.png');
                            background-repeat:no-repeat;
                            margin: 0 7px 0 7px;
                            height: 89px;
                            width: 94px;
                            z-index:1;
                    }

                    #hours_text{
                            background-image:url('/wp-content/themes/pencilsofpromise/gfx/gala/count/hours_text.jpg');
                            background-position: center;
                            background-repeat:no-repeat;
                            position: relative;
                            margin-top: 0;
                            height: 26px;
                            width: 94px;
                    }

                    #mins{
                            float: left;
                            text-align: center;
                            background-image:url('/wp-content/themes/pencilsofpromise/gfx/gala/count/flip.png');
                            background-repeat:no-repeat;
                            margin: 0 7px 0 7px;
                            height: 89px;
                            width: 94px;
                        z-index:1;
                    }

                    #mins_text{
                            background-image:url('/wp-content/themes/pencilsofpromise/gfx/gala/count/mins_text.jpg');
                            background-position: center;
                            background-repeat:no-repeat;
                            position: relative;
                            margin-top: 0;
                            height: 26px;
                            width: 94px;
                    }

                    #secs{
                            float: left;
                            text-align: center;
                            background-image:url('/wp-content/themes/pencilsofpromise/gfx/gala/count/flip.png');
                            background-repeat:no-repeat;
                            margin: 0 7px 0 7px;
                            height: 89px;
                            width: 94px;
                        z-index:1;
                    }

                    #secs_text{
                            background-image:url('/wp-content/themes/pencilsofpromise/gfx/gala/count/secs_text.jpg');
                            background-position: center;
                            background-repeat:no-repeat;
                            position: relative;
                            margin-top: 0;
                            height: 26px;
                            width: 94px;
                    }

                    #days span, #hours span, #mins span , #secs span {
                            background: url(/wp-content/themes/pencilsofpromise/gfx/gala/count/flip_gradient.png);
                            background-repeat:no-repeat;
                            position: absolute;
                            display: block;
                            height: 57px;
                            width: 94px;
                    }
                    
                    ul {
                        list-style-type: none;
                        -webkit-margin-before: 0;
                        -webkit-padding-start: 0;
                    }
                    
                    input[type="submit"] {
                        float: right;
                        margin-top: 0px;
                        width: 70px;
                        height: 30px;
                        background-color: #E2E2E2;
                        border-radius: 10px;
                        color: gray;
                        position: relative;
                        top: -20px;
                    }
                    
                    fieldset {
                        border: none;
                    }
                    
                    .body span {
                        display: inline-block; 
                        border-right: 2px solid #C39D2E; 
                        padding-right: 12px;
                        text-transform: lowercase;
                    }
                    
                    #host .heading {
                        text-transform: uppercase;
                        font-size: 26px;
                        width: 72%;
                        float: left;
                    }
                    
                    #host .body .heading {
                        display: inline-block;
                        font-size: 18px;
                        margin-top: 10px;
                    }
                    
                    #host .heading.companies {
                        width: 24%;
                    }
                    
                    #host .body {
                        margin: 10px auto;
                    }
                    
                    
                    
                    .button {
                            -moz-box-shadow:inset 0px 1px 0px 0px #ffffff;
                            -webkit-box-shadow:inset 0px 1px 0px 0px #ffffff;
                            box-shadow:inset 0px 1px 0px 0px #ffffff;
                            background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #faeec8), color-stop(1, #c39e2e) );
                            background:-moz-linear-gradient( center top, #faeec8 5%, #c39e2e 100% );
                            filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#faeec8', endColorstr='#c39e2e');
                            background-color:#faeec8;
                            -moz-border-radius:6px;
                            -webkit-border-radius:6px;
                            border-radius:6px;
                            display: block;
                            color: black;
                            font-family: arial;
                            font-size: 26px;
                            font-weight: bold;
                            padding: 16px 24px;
                            text-decoration: none;
                            width: 300px;
                            text-align: center;
                            margin: 37px auto 15px auto;
                    }.button:hover {
                            background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #c39e2e), color-stop(1, #faeec8) );
                            background:-moz-linear-gradient( center top, #c39e2e 5%, #faeec8 100% );
                            filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#c39e2e', endColorstr='#faeec8');
                            background-color:#c39e2e;
                    }.button:active {
                            position:relative;
                            top:1px;
                    }
                    .column {
                        width: 24%;
                        display: block;
                        vertical-align: top;
                        margin-top: 5px;
                        float: left;
                    }
                    
                    .container-centered {
                        width: 100%;    
                        float: left;
                        clear: both;
                        overflow: hidden;
                    }
                    
                    .container-centered .centered {
                        position: relative;
                        left: 50%;
                        margin-left: -200px;
                        float: left;
                        padding: 0;
                        clear: both;
                    }
                    
                    .clear {
                        clear: both;
                    }
                    
                    #host.centered {
                        width: 950px;
                        margin-bottom: 100px;
                        text-align: left;
                        position: relative;
                        left: 50%;
                        margin-left: -475px;
                        float: left;
                    }
                    
                    .lowercase.even {
                        float: left;
                        position: relative;
                    }
                    
                    #gala_content.centered {
                        width: 1050px;
                        margin-bottom: 100px;
                        text-align: left;
                        position: relative;
                        left: 50%;
                        margin-left: -525px;
                        float: left;
                        margin-top: 100px;
                    }
                    
                    .galleria-container {
                        position: relative;
                        overflow: hidden;
                        background: black;
                    }
                    
                    #logos {
                        width: 1050px;
                        margin: 50px auto;
                        margin-bottom: 100px;
                        text-align: left;
                        position: relative;
                        left: 50%;
                        margin-left: -525px;
                        float: left;
                        background: white;
                    }
                    
                    .logos img {
                        height: 90px;
                        float: left;
                        background: white;
                    }
                    
                    a.logos {
                        height: 90px;
                        float: left;
                        background: white;
                    }
                    
                    #logos div div {
                        display: inline-block;
                        width: 50px;
                    }

                    #logos div {
                        text-align: justify;
                        margin: 16px auto;
                        position: relative;
                        top: -75px;
                    }

                    #logos div div div{
                        display: block;
                        margin: 40px 0px;
                        position: relative;
                        vertical-align: bottom;
                    }
                    
                    .tt-wrapper{
                            padding: 0;
                            height: 50px;
                            margin: 0px;
                            text-align: center;
                    }
                    .tt-wrapper li{
                            float: left;
                            position: relative;
                    }
                    .tt-wrapper li a{
                    }
                    .tt-wrapper li .tt-birch {
                        background: transparent url('gfx/platform_images/yellow_dot.png') no-repeat center center;
                    }
                    .tt-wrapper li .tt-twitter{
                        background: transparent url('gfx/platform_images/yellow_dot.png') no-repeat center center;
                    }
                    .tt-wrapper li .tt-dribbble{
                        background: transparent url('gfx/platform_images/yellow_dot.png') no-repeat center center;
                    }
                    .tt-wrapper li .tt-facebook{
                        background: transparent url('gfx/platform_images/yellow_dot.png') no-repeat center center;
                    }

                    .tt-wrapper li a span{
                            width: 100px;
                            height: auto;
                            line-height: 20px;
                            padding: 10px;
                            left: -14px;
                            font-weight: 400;	
                            font-style: italic;
                            font-size: 14px;
                            text-align: center;
                            border: 4px solid #fff;
                            background: whitesmoke;
                            text-indent: 0px;
                            border-radius: 5px;
                            position: absolute;
                            pointer-events: none;
                            bottom: 70px;
                            opacity: 0;
                            box-shadow: 1px 1px 2px rgba(0,0,0,0.1);
                            -webkit-transition: all 0.3s ease-in-out;
                            -moz-transition: all 0.3s ease-in-out;
                            -o-transition: all 0.3s ease-in-out;
                            -ms-transition: all 0.3s ease-in-out;
                            transition: all 0.3s ease-in-out;
                            transition-property: all;
                            transition-duration: 0.3s;
                            transition-timing-function: ease;
                            color: black;
                            text-shadow: 1px 1px #DDD;
                    }
                    .tt-wrapper li a span:before,
                    .tt-wrapper li a span:after{
                            content: '';
                            position: absolute;
                            bottom: -15px;
                            left: 50%;
                            margin-left: -9px;
                            width: 0;
                            height: 0;
                            border-left: 10px solid transparent;
                            border-right: 10px solid transparent;
                            border-top: 10px solid rgba(0,0,0,0.1);
                    }
                    .tt-wrapper li a span:after{
                            bottom: -14px;
                            margin-left: -10px;
                            border-top: 10px solid #fff;
                    }
                    .tt-wrapper li a:hover span{
                            opacity: 0.9;
                            bottom: 110px;
                    }
                    
                    .tt-wrapper li .tt-c span, .tt-wrapper li .tt-c:hover span, .tt-wrapper li .tt-c span:before,  .tt-wrapper li .tt-c span:after {
                        margin-left: -20px;
                    }
                    
                    .tt-wrapper li .tt-ea span, .tt-wrapper li .tt-ea:hover span, .tt-wrapper li .tt-ea span:before,  .tt-wrapper li .tt-ea span:after {
                        margin-left: -20px;
                    }
                    
                    .tt-wrapper li .tt-inspir span, .tt-wrapper li .tt-inspir:hover span, .tt-wrapper li .tt-inspir span:before,  .tt-wrapper li .tt-inspir span:after {
                        margin-left: -15px;
                    }
                    
                    .tt-wrapper li .tt-opi span, .tt-wrapper li .tt-opi:hover span, .tt-wrapper li .tt-opi span:before,  .tt-wrapper li .tt-opi span:after {
                        margin-left: -18px;
                    }
                    
                    .tt-wrapper li .tt-pop span, .tt-wrapper li .tt-pop:hover span, .tt-wrapper li .tt-pop span:before,  .tt-wrapper li .tt-pop span:after {
                        margin-left: -15px;
                    }
                    
                    .tt-wrapper li .tt-poppin span, .tt-wrapper li .tt-poppin:hover span, .tt-wrapper li .tt-poppin span:before,  .tt-wrapper li .tt-poppin span:after {
                        margin-left: -10px;
                    }
                    
                    .tt-wrapper li .tt-rest span, .tt-wrapper li .tt-rest:hover span, .tt-wrapper li .tt-rest span:before,  .tt-wrapper li .tt-rest span:after {
                        margin-left: -10px;
                    }
                    
                    .tt-wrapper li .tt-unreal span, .tt-wrapper li .tt-unreal:hover span, .tt-wrapper li .tt-unreal span:before,  .tt-wrapper li .tt-unreal span:after {
                        margin-left: -22px;
                    }
                    
                    .tt-wrapper li .tt-vita span, .tt-wrapper li .tt-vita:hover span, .tt-wrapper li .tt-vita span:before,  .tt-wrapper li .tt-vita span:after {
                        margin-left: -15px;
                    }



                    </style>
                   <script type="text/javascript">
function SplitText(node)
{
    var text = node.nodeValue.replace(/^\s*|\s(?=\s)|\s*$/g, "");

    for(var i = 0; i < text.length; i++)
    {
        var letter = document.createElement("span");
        letter.style.display = "inline-block";
        letter.style.position = "absolute";
        letter.appendChild(document.createTextNode(text.charAt(i)));
        node.parentNode.insertBefore(letter, node);

        var positionRatio = i / (text.length - 1);
        var textWidth = letter.clientWidth;

        var indent = 100 * positionRatio;
        var offset = -textWidth * positionRatio;
        letter.style.left = indent + "%";
        letter.style.marginLeft = offset + "px";

        //console.log("Letter ", text[i], ", Index ", i, ", Width ", textWidth, ", Indent ", indent, ", Offset ", offset);
    }

    node.parentNode.removeChild(node);
}

function Justify()
{
    var element = ["character_justify","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16"];
                        
                        for (i=0; i<16; i++) {
                            var elem = document.getElementById(element[i]);
                            var TEXT_NODE = 3;
                       
                            elem = elem.firstChild;
                            
                            while(elem)
                            {
                                var nextElem = elem.nextSibling;

                                if(elem.nodeType == TEXT_NODE)
                                    SplitText(elem);

                                elem = nextElem;
                            }
                        
                        }
}

                    /*function SplitText(node)
                            {
                                var text = node.nodeValue.replace(/^\s*|\s(?=\s)|\s*$/g, "");

                                for(var i = 0; i < text.length; i++)
                                {
                                    var letter = document.createElement("span");
                                    letter.style.display = "inline-block";
                                    letter.style.position = "absolute";
                                    letter.appendChild(document.createTextNode(text.charAt(i)));
                                    node.parentNode.insertBefore(letter, node);

                                    var positionRatio = i / (text.length - 1);
                                    var textWidth = letter.clientWidth;

                                    var indent = 100 * positionRatio;
                                    var offset = -textWidth * positionRatio;
                                    letter.style.left = indent + "%";
                                    letter.style.marginLeft = offset + "px";

                                    //console.log("Letter ", text[i], ", Index ", i, ", Width ", textWidth, ", Indent ", indent, ", Offset ", offset);
                                }

                                node.parentNode.removeChild(node);
                            }

                    function Justify()
                    {
                       
                       var element = ["character_justify","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16"];
                        
                        for (i=0; i<18; i++) {
                            var elem = document.getElementById(element[i]);
                            var TEXT_NODE = 3;
                       
                            elem = elem.firstChild;
                            
                            while(elem)
                            {
                                var nextElem = elem.nextSibling;

                                if(elem.nodeType == TEXT_NODE)
                                    SplitText(elem);

                                elem = nextElem;
                            }
                        
                        }
                        
                    */

            </script>
            
        </head>
        <body>  <!--onload="Justify()"-->
        

<div class="container-centered" >
    <img src="<?php bloginfo('template_directory'); ?>/gfx/gala/triangles.png" style="position: absolute; width: 200px; top: -16px; right: -23px;">
	
    <div id="introduction" class="centered">    
        <div id="character_justify" class="character_justify uppercase" style="font-size: 40px; height: 45px;">
            <span style="display: inline-block; position: absolute; left: 0%; margin-left: 0px; ">S</span>
            <span style="display: inline-block; position: absolute; left: 8.333333333333332%; margin-left: -0.8333333333333333px; ">e</span>
            <span style="display: inline-block; position: absolute; left: 16.666666666666664%; margin-left: -2px; ">c</span>
            <span style="display: inline-block; position: absolute; left: 25%; margin-left: -3px; ">o</span>
            <span style="display: inline-block; position: absolute; left: 33.33333333333333%; margin-left: -4px; ">n</span>
            <span style="display: inline-block; position: absolute; left: 41.66666666666667%; margin-left: -4px; ">d</span>
            <span style="display: inline-block; position: absolute; left: 50%; margin-left: 0px; "> </span>
            <span style="display: inline-block; position: absolute; left: 58.333333333333336%; margin-left: -17.416666666666667px; ">a</span>
            <span style="display: inline-block; position: absolute; left: 66.66666666666666%; margin-left: -18px; ">n</span>
            <span style="display: inline-block; position: absolute; left: 75%; margin-left: -15px; ">n</span>
            <span style="display: inline-block; position: absolute; left: 83.33333333333334%; margin-left: -12px; ">u</span>
            <span style="display: inline-block; position: absolute; left: 91.66666666666666%; margin-left: -10.083333333333332px; ">a</span>
            <span style="display: inline-block; position: absolute; left: 100%; margin-left: -9px; ">l</span>
            <span class="stretch"></span>
        </div>
        <div id="4" class="uppercase character_justify" style="font-size: 30px; height: 30px; margin-bottom: 20px;">
            <span style="display: inline-block; position: absolute; left: 0%; margin-left: 0px; ">P</span>
            <span style="display: inline-block; position: absolute; left: 5.88235294117647%; margin-left: -0.5882352941176471px; ">e</span>
            <span style="display: inline-block; position: absolute; left: 11.76470588235294%; margin-left: -1.4117647058823528px; ">n</span>
            <span style="display: inline-block; position: absolute; left: 17.647058823529413%; margin-left: 2.1176470588235294px; ">c</span>
            <span style="display: inline-block; position: absolute; left: 23.52941176470588%; margin-left: 5.9411764705882353px; ">i</span>
            <span style="display: inline-block; position: absolute; left: 29.411764705882355%; margin-left: -2.6470588235294117px; ">l</span>
            <span style="display: inline-block; position: absolute; left: 35.294117647058826%; margin-left: -3.5294117647058827px; ">s</span>
            <span style="display: inline-block; position: absolute; left: 41.17647058823529%; margin-left: 0px; "> </span>
            <span style="display: inline-block; position: absolute; left: 47.05882352941176%; margin-left: -5.647058823529411px; ">o</span>
            <span style="display: inline-block; position: absolute; left: 52.94117647058824%; margin-left: -4.764705882352941px; ">f</span>
            <span style="display: inline-block; position: absolute; left: 58.82352941176471%; margin-left: 0px; "> </span>
            <span style="display: inline-block; position: absolute; left: 64.70588235294117%; margin-left: -6.470588235294118px; ">P</span>
            <span style="display: inline-block; position: absolute; left: 70.58823529411765%; margin-left: -7.764705882352942px; ">r</span>
            <span style="display: inline-block; position: absolute; left: 76.47058823529412%; margin-left: -7.176470588235293px; ">o</span>
            <span style="display: inline-block; position: absolute; left: 82.35294117647058%; margin-left: -4.705882352941176px; ">m</span>
            <span style="display: inline-block; position: absolute; left: 88.23529411764706%; margin-left: 2.5294117647058822px; ">i</span>
            <span style="display: inline-block; position: absolute; left: 94.11764705882352%; margin-left: -9.411764705882353px; ">s</span>
            <span style="display: inline-block; position: absolute; left: 100%; margin-left: -10px; ">e</span>
        </div>
        <img src="<?php bloginfo('template_directory'); ?>/gfx/gala/gala.png" style="width: 400px;">
        <div id="2" class="uppercase character_justify" style="font-size: 27px; height: 25px; margin-top: 50px; font-weight: 400;">
            <span style="display: inline-block; position: absolute; left: 0%; margin-left: 0px; ">A</span>
            <span style="display: inline-block; position: absolute; left: 5.555555555555555%; margin-left: -1px; ">n</span>
            <span style="display: inline-block; position: absolute; left: 11.11111111111111%; margin-left: 0px; "> </span>
            <span style="display: inline-block; position: absolute; left: 16.666666666666664%; margin-left: -2.5px; ">e</span>
            <span style="display: inline-block; position: absolute; left: 22.22222222222222%; margin-left: -3.333333333333333px; ">v</span>
            <span style="display: inline-block; position: absolute; left: 27.77777777777778%; margin-left: -4.166666666666667px; ">e</span>
            <span style="display: inline-block; position: absolute; left: 33.33333333333333%; margin-left: -6px; ">n</span>
            <span style="display: inline-block; position: absolute; left: 38.88888888888889%; margin-left: -2.7222222222222223px; ">i</span>
            <span style="display: inline-block; position: absolute; left: 44.44444444444444%; margin-left: -8px; ">n</span>
            <span style="display: inline-block; position: absolute; left: 50%; margin-left: -9.5px; ">g</span>
            <span style="display: inline-block; position: absolute; left: 55.55555555555556%; margin-left: 0px; "> </span>
            <span style="display: inline-block; position: absolute; left: 61.111111111111114%; margin-left: -8.555555555555557px; ">t</span>
            <span style="display: inline-block; position: absolute; left: 66.66666666666666%; margin-left: -12.666666666666666px; ">o</span>
            <span style="display: inline-block; position: absolute; left: 72.22222222222221%; margin-left: 0px; "> </span>
            <span style="display: inline-block; position: absolute; left: 77.77777777777779%; margin-left: -14px; ">h</span>
            <span style="display: inline-block; position: absolute; left: 83.33333333333334%; margin-left: -15.833333333333334px; ">o</span>
            <span style="display: inline-block; position: absolute; left: 88.88888888888889%; margin-left: -16px; ">n</span>
            <span style="display: inline-block; position: absolute; left: 94.44444444444444%; margin-left: -17.944444444444443px; ">o</span>
            <span style="display: inline-block; position: absolute; left: 100%; margin-left: -17px; ">r</span>
        </div>
        <img src="<?php bloginfo('template_directory'); ?>/gfx/gala/usher.png" style="width: 410px;  position: relative; left: -6px; margin-top: 8px;">
        <img src="<?php bloginfo('template_directory'); ?>/gfx/gala/sarahbrown.png" style="width: 420px;  position: relative; left: -10px;margin: 5px 0 0 0; height: 30px;">
        <img src="<?php bloginfo('template_directory'); ?>/gfx/gala/thetaitzfamily.png" style="width: 420px;  position: relative; left: -10px;margin: 3px 0 0 0; height: 30px;">
    </div>
    
    <span class="clear"></span>
    
    <div id="gala_content" class="centered">
        <div class="right">
            <div class="inner centered">
                <div id="6" class="uppercase character_justify" style="font-size: 45px; height: 40px; padding-bottom: 25px;">
                    <span style="display: inline-block; position: absolute; left: 0%; margin-left: 0px; ">T</span>
                    <span style="display: inline-block; position: absolute; left: 11.142857142857142%; margin-left: -0.7857142857142857px; ">h</span>
                    <span style="display: inline-block; position: absolute; left: 26.285714285714285%; margin-left: -10.142857142857142px; ">e</span>
                    <span style="display: inline-block; position: absolute; left: 41.428571428571427%; margin-left: -5.785714285714286px; "> </span>
                    <span style="display: inline-block; position: absolute; left: 48.57142857142857%; margin-left: -6.857142857142857px; ">e</span>
                    <span style="display: inline-block; position: absolute; left: 60.014285714285715%; margin-left: -7.857142857142858px; ">v</span>
                    <span style="display: inline-block; position: absolute; left: 71.857142857142854%; margin-left: -10.285714285714285px; ">e</span>
                    <span style="display: inline-block; position: absolute; left: 85.54285714285714%; margin-left: -17.71428571428571px; ">n</span>
                    <span style="display: inline-block; position: absolute; left: 100%; margin-left: -24px; ">t</span>
                </div>
                <div id="7" class="lowercase character_justify" style="font-size: 25px; height: 40px;">
                    <span style="display: inline-block; position: absolute; left: 0%; margin-left: 0px; ">T</span>
                    <span style="display: inline-block; position: absolute; left: 4%; margin-left: -5.56px; ">h</span>
                    <span style="display: inline-block; position: absolute; left: 8%; margin-left: -4.12px; ">u</span>
                    <span style="display: inline-block; position: absolute; left: 12%; margin-left: -3.56px; ">r</span>
                    <span style="display: inline-block; position: absolute; left: 15.1%; margin-left: -4.4px; ">s</span>
                    <span style="display: inline-block; position: absolute; left: 19%; margin-left: -3.8000000000000003px; ">d</span>
                    <span style="display: inline-block; position: absolute; left: 23.5%; margin-left: -3.12px; ">a</span>
                    <span style="display: inline-block; position: absolute; left: 28.000000000000004%; margin-left: -1.9600000000000002px; ">y</span>
                    <span style="display: inline-block; position: absolute; left: 31%; margin-left: 0px; ">, </span>
                    <span style="display: inline-block; position: absolute; left: 37.4%; margin-left: -4.68px; ">o</span>
                    <span style="display: inline-block; position: absolute; left: 42%; margin-left: -5.6000000000000005px; ">c</span>
                    <span style="display: inline-block; position: absolute; left: 47%; margin-left: -6.6px; ">t</span>
                    <span style="display: inline-block; position: absolute; left: 49.2%; margin-left: -4.36px; ">o</span>
                    <span style="display: inline-block; position: absolute; left: 55.5%; margin-left: -11.28px; ">b</span>
                    <span style="display: inline-block; position: absolute; left: 61.00000000000001%; margin-left: -14.760000000000002px; ">e</span>
                    <span style="display: inline-block; position: absolute; left: 64%; margin-left: -9px; ">r</span>
                    <span style="display: inline-block; position: absolute; left: 64%; margin-left: -8.96px; "> </span>
                    <span style="display: inline-block; position: absolute; left: 71%; margin-left: -7.44px; ">2</span>
                    <span style="display: inline-block; position: absolute; left: 74%; margin-left: 0px; ">5</span>
                    <span style="display: inline-block; position: absolute; left: 80%; margin-left: -5.6000000000000005px; ">,</span>
                    <span style="display: inline-block; position: absolute; left: 84%; margin-left: 0px; "> </span>
                    <span style="display: inline-block; position: absolute; left: 88%; margin-left: -12.32px; ">2</span>
                    <span style="display: inline-block; position: absolute; left: 92%; margin-left: -12.88px; ">0</span>
                    <span style="display: inline-block; position: absolute; left: 96%; margin-left: -13.44px; ">1</span>
                    <span style="display: inline-block; position: absolute; left: 100%; margin-left: -14px; ">2</span>
                </div>
                <div id="countbox"></div>
                <div id="button">
                    <a class="button" href="https://pencilsofpromise.secure.force.com/pmtx/evt__QuickEvent?id=a1PU0000000UMjl">Purchase Tickets</a>
                </div>
                <a style="border: none;" href="www.facebook.com/pencilsofpromise">
                    <img style="float:right;padding-left: 10px; margin-right: 25px; border: none;" src="<?php bloginfo('template_directory'); ?>/gfx/whiteparty/white_facebook.png">
                </a>
                <a style="border: none;" href="https://twitter.com/pencilsofpromis">
                    <img style="float:right; border: none;" src="<?php bloginfo('template_directory'); ?>/gfx/whiteparty/white_twitter_bird.png">
                </a>
            </div>
        </div>
        <img style="display: block; float: right; margin-right: 3%; height: 380px; width: 5px; margin-top: -10px;" src="<?php bloginfo('template_directory'); ?>/gfx/gala/gala_goldline.png">
        <div class="left">
            <div class="inner centered">
            <div id="10" class="uppercase character_justify" style="font-size: 45px; height: 45px; margin-bottom: 20px;"><span style="display: inline-block; position: absolute; left: 0%; margin-left: 0px; ">E</span><span style="display: inline-block; position: absolute; left: 8.333333333333332%; margin-left: -2px; ">v</span><span style="display: inline-block; position: absolute; left: 16.666666666666664%; margin-left: -4px; ">e</span><span style="display: inline-block; position: absolute; left: 25%; margin-left: -7.25px; ">n</span><span style="display: inline-block; position: absolute; left: 33.33333333333333%; margin-left: -7.333333333333333px; ">t</span><span style="display: inline-block; position: absolute; left: 41.66666666666667%; margin-left: 0px; "> </span><span style="display: inline-block; position: absolute; left: 50%; margin-left: -14.5px; ">D</span><span style="display: inline-block; position: absolute; left: 58.333333333333336%; margin-left: -14px; ">e</span><span style="display: inline-block; position: absolute; left: 66.66666666666666%; margin-left: -14.666666666666666px; ">t</span><span style="display: inline-block; position: absolute; left: 75%; margin-left: -18.25px; ">a</span><span style="display: inline-block; position: absolute; left: 83.33333333333334%; margin-left: -13.166666666666668px; ">i</span><span style="display: inline-block; position: absolute; left: 91.66666666666666%; margin-left: -26.166666666666664px; ">l</span><span style="display: inline-block; position: absolute; left: 100%; margin-left: -32px; ">s</span></div>
            <div id="11" class="lowercase character_justify" style="font-size: 25px; height: 35px; font-weight: lighter;"><span style="display: inline-block; position: absolute; left: 0%; margin-left: 0px; ">7</span><span style="display: inline-block; position: absolute; left: 4.3478260869565215%; margin-left: 0px; "> </span><span style="display: inline-block; position: absolute; left: 8.695652173913043%; margin-left: -1.2173913043478262px; ">o</span><span style="display: inline-block; position: absolute; left: 13.043478260869565%; margin-left: -0.7826086956521738px; ">’</span><span style="display: inline-block; position: absolute; left: 17.391304347826086%; margin-left: -2.4347826086956523px; ">c</span><span style="display: inline-block; position: absolute; left: 21.73913043478261%; margin-left: 2.3043478260869565px; ">l</span><span style="display: inline-block; position: absolute; left: 26.08695652173913%; margin-left: -6.652173913043478px; ">o</span><span style="display: inline-block; position: absolute; left: 30.434782608695656%; margin-left: -5.260869565217392px; ">c</span><span style="display: inline-block; position: absolute; left: 34.78260869565217%; margin-left: -4.521739130434782px; ">k</span><span style="display: inline-block; position: absolute; left: 39.130434782608695%; margin-left: 0px; "> </span><span style="display: inline-block; position: absolute; left: 43.47826086956522%; margin-left: -2.608695652173913px; ">i</span><span style="display: inline-block; position: absolute; left: 47.82608695652174%; margin-left: -6.695652173913044px; ">n</span><span style="display: inline-block; position: absolute; left: 52.17391304347826%; margin-left: 0px; "> </span><span style="display: inline-block; position: absolute; left: 56.52173913043478%; margin-left: -3.9565217391304346px; ">t</span><span style="display: inline-block; position: absolute; left: 60.86956521739131%; margin-left: -8.521739130434783px; ">h</span><span style="display: inline-block; position: absolute; left: 65.21739130434783%; margin-left: -9.130434782608695px; ">e</span><span style="display: inline-block; position: absolute; left: 69.56521739130434%; margin-left: 0px; "> </span><span style="display: inline-block; position: absolute; left: 73.91304347826086%; margin-left: -10.347826086956522px; ">e</span><span style="display: inline-block; position: absolute; left: 78.26086956521739%; margin-left: -10.173913043478262px; ">v</span><span style="display: inline-block; position: absolute; left: 82.6086956521739%; margin-left: -11.565217391304348px; ">e</span><span style="display: inline-block; position: absolute; left: 86.95652173913044%; margin-left: -8.17391304347826px; ">n</span><span style="display: inline-block; position: absolute; left: 91.30434782608695%; margin-left: -7.478260869565217px; ">i</span><span style="display: inline-block; position: absolute; left: 95.65217391304348%; margin-left: -13.391304347826088px; ">n</span><span style="display: inline-block; position: absolute; left: 100%; margin-left: -15px; ">g</span></div>
            <div id="12" class="lowercase character_justify" style="font-size: 28px; height: 35px; font-weight: lighter; margin-bottom: 6px;"><span style="display: inline-block; position: absolute; left: 0%; margin-left: 0px; ">t</span><span style="display: inline-block; position: absolute; left: 4%; margin-left: -3.88px; ">h</span><span style="display: inline-block; position: absolute; left: 8%; margin-left: -1.76px; ">u</span><span style="display: inline-block; position: absolute; left: 12%; margin-left: -0.26px; ">r</span><span style="display: inline-block; position: absolute; left: 16%; margin-left: -4.2px; ">s</span><span style="display: inline-block; position: absolute; left: 20%; margin-left: -5.800000000000001px; ">d</span><span style="display: inline-block; position: absolute; left: 24%; margin-left: -5.279999999999999px; ">a</span><span style="display: inline-block; position: absolute; left: 28.000000000000004%; margin-left: -5.6000000000000005px; ">y</span><span style="display: inline-block; position: absolute; left: 32%; margin-left: -3.52px; ">,</span><span style="display: inline-block; position: absolute; left: 36%; margin-left: 0px; "> </span><span style="display: inline-block; position: absolute; left: 40%; margin-left: -8.8px; ">o</span><span style="display: inline-block; position: absolute; left: 44%; margin-left: -7.68px; ">c</span><span style="display: inline-block; position: absolute; left: 48%; margin-left: -5.279999999999999px; ">t</span><span style="display: inline-block; position: absolute; left: 52%; margin-left: -11.440000000000001px; ">o</span><span style="display: inline-block; position: absolute; left: 56.00000000000001%; margin-left: -13.440000000000001px; ">b</span><span style="display: inline-block; position: absolute; left: 60%; margin-left: -13.2px; ">e</span><span style="display: inline-block; position: absolute; left: 64%; margin-left: -13.32px; ">r</span><span style="display: inline-block; position: absolute; left: 68%; margin-left: 0px; "> </span><span style="display: inline-block; position: absolute; left: 72%; margin-left: -15.84px; ">2</span><span style="display: inline-block; position: absolute; left: 76%; margin-left: -12.72px; ">5</span><span style="display: inline-block; position: absolute; left: 80%; margin-left: -8.8px; ">,</span><span style="display: inline-block; position: absolute; left: 84%; margin-left: 0px; "> </span><span style="display: inline-block; position: absolute; left: 88%; margin-left: -19.36px; ">2</span><span style="display: inline-block; position: absolute; left: 92%; margin-left: -17.240000000000002px; ">0</span><span style="display: inline-block; position: absolute; left: 96%; margin-left: -17.119999999999997px; ">1</span><span style="display: inline-block; position: absolute; left: 100%; margin-left: -16px; ">2</span></div>
            <table class="lowercase" style="width: 100%; padding: 0; margin: 0; margin-bottom: 6px; border-collapse: collapse; font-size: 25px; letter-spacing: 3px; ">
                <tr>
                    <td style="text-align: left; width: 40%; border-right: 2px solid #C39D2E;;">
                        guastavino's
                    </td>
                    <td style="text-align: right; width: 49%;">
                        409 e 59th st.
                    </td>
                </tr>
            </table>
            <div id="14" class="lowercase character_justify" style="font-size: 25px; height: 35px; margin-bottom: 45px;"><span style="display: inline-block; position: absolute; left: 0%; margin-left: 0px; ">N</span><span style="display: inline-block; position: absolute; left: 4.545454545454546%; margin-left: -0.6363636363636364px; ">e</span><span style="display: inline-block; position: absolute; left: 9.090909090909092%; margin-left: -1.6363636363636365px; ">w</span><span style="display: inline-block; position: absolute; left: 13.636363636363635%; margin-left: 0px; "> </span><span style="display: inline-block; position: absolute; left: 18.181818181818183%; margin-left: -2.3636363636363638px; ">Y</span><span style="display: inline-block; position: absolute; left: 22.727272727272727%; margin-left: -3.1818181818181817px; ">o</span><span style="display: inline-block; position: absolute; left: 27.27272727272727%; margin-left: -2.1818181818181817px; ">r</span><span style="display: inline-block; position: absolute; left: 31.818181818181817%; margin-left: -4.136363636363637px; ">k</span><span style="display: inline-block; position: absolute; left: 36.36363636363637%; margin-left: 0px; "> </span><span style="display: inline-block; position: absolute; left: 40.909090909090914%; margin-left: -5.7272727272727275px; ">C</span><span style="display: inline-block; position: absolute; left: 45.45454545454545%; margin-left: -2.727272727272727px; ">i</span><span style="display: inline-block; position: absolute; left: 50%; margin-left: -6.5px; ">t</span><span style="display: inline-block; position: absolute; left: 54.54545454545454%; margin-left: -7.09090909090909px; ">y</span><span style="display: inline-block; position: absolute; left: 59.09090909090909%; margin-left: -4.136363636363637px; ">,</span><span style="display: inline-block; position: absolute; left: 63.63636363636363%; margin-left: 0px; "> </span><span style="display: inline-block; position: absolute; left: 68.18181818181817%; margin-left: -9.545454545454545px; ">N</span><span style="display: inline-block; position: absolute; left: 72.72727272727273%; margin-left: -9.454545454545455px; ">Y</span><span style="display: inline-block; position: absolute; left: 77.27272727272727%; margin-left: 0px; "> </span><span style="display: inline-block; position: absolute; left: 81.81818181818183%; margin-left: -11.454545454545455px; ">1</span><span style="display: inline-block; position: absolute; left: 86.36363636363636%; margin-left: -12.090909090909092px; ">0</span><span style="display: inline-block; position: absolute; left: 90.9090909090909%; margin-left: -12.727272727272727px; ">0</span><span style="display: inline-block; position: absolute; left: 95.45454545454545%; margin-left: -13.363636363636363px; ">2</span><span style="display: inline-block; position: absolute; left: 100%; margin-left: -14px; ">2</span></div>
            <div style="font-size: 25px;">
                <span class="lowercase" style="padding-right: 10px; display: block; float: left; margin-left: 1px; border-right: 2px solid #C39D2E;">seated dinner</span>
                <span class="lowercase" style="float: right; margin-right: 1px;">silent &amp; live auction</span>
            </div>
            <table style="width: 100%; font-size: 27px; letter-spacing: 1px;">
                <tr>
                    <td style="border-right: 2px solid #C39D2E; width: 22%">music</td>
                    <td style="border-right: 2px solid #C39D2E; width: 32%; text-align: center;">dancing</td>
                    <td style="width: 42%; text-align: right;">official party</td>
                </tr>
            </table>
<!--<div id="13" class="uppercase character_justify" style="font-size: 25px; height: 40px; margin-top: 50px; margin-bottom: 20px;"><span style="display: inline-block; position: absolute; left: 0%; margin-left: 0px; ">H</span><span style="display: inline-block; position: absolute; left: 5%; margin-left: -2.55px; ">o</span><span style="display: inline-block; position: absolute; left: 10%; margin-left: -0.4000000000000004px; ">s</span><span style="display: inline-block; position: absolute; left: 15%; margin-left: -3.3px; ">t</span><span style="display: inline-block; position: absolute; left: 20%; margin-left: -6.800000000000001px; ">e</span><span style="display: inline-block; position: absolute; left: 25%; margin-left: -7.25px; ">d</span><span style="display: inline-block; position: absolute; left: 30%; margin-left: 0px; "> </span><span style="display: inline-block; position: absolute; left: 35%; margin-left: -9.45px; ">b</span><span style="display: inline-block; position: absolute; left: 40%; margin-left: -9.600000000000001px; ">y</span><span style="display: inline-block; position: absolute; left: 45%; margin-left: 0px; "> </span><span style="display: inline-block; position: absolute; left: 50%; margin-left: -12px; ">S</span><span style="display: inline-block; position: absolute; left: 55.00000000000001%; margin-left: -15.05px; ">o</span><span style="display: inline-block; position: absolute; left: 60%; margin-left: -14.399999999999999px; ">p</span><span style="display: inline-block; position: absolute; left: 65%; margin-left: -16.85px; ">h</span><span style="display: inline-block; position: absolute; left: 70%; margin-left: -13.699999999999999px; ">i</span><span style="display: inline-block; position: absolute; left: 75%; margin-left: -24.25px; ">a</span><span style="display: inline-block; position: absolute; left: 80%; margin-left: 0px; "> </span><span style="display: inline-block; position: absolute; left: 85%; margin-left: -22.95px; ">B</span><span style="display: inline-block; position: absolute; left: 90%; margin-left: -20.1px; ">u</span><span style="display: inline-block; position: absolute; left: 95%; margin-left: -18.799999999999997px; ">s</span><span style="display: inline-block;  left: 100%; margin-left: -29px; float: right;">h</span></div>
            </div>-->
        </div>
    </div>
    <span class="clear"></span>
    <div id="host" class="centered">
        <div class="heading">Host Committee: </div>
        <div class="body individuals">
            <div class="heading">Individuals: </div>
            <div class="heading companies">Companies: </div>
            <div class="column">
                <ul>
                    <li>Owen Brainard</li>
                    <li>Ervin & Susan Braun</li>
                    <li>Scott "Scooter" Braun</li>
                    <li>Shauna Brook</li>
                    <li>The Cahill Family</li>
                    <li>Troy Carter</li>
                    <li>Ralph & Nancy Casazzone</li>
                    <li>Chris & Kimberly Clarke</li>
                    <li>Rodney Cohen</li>
                    <li>Katrina Davies</li>
                    <li>Dr. Susan Drossman & Mr. Adam Sokoloff</li>
                    <li>Craig & Caryn Effron</li>
                    <li>The Finocchiaro Family</li>
                    <li>Jacob Freed</li>
                </ul>
            </div>
            <div class="column">
                <ul>
                    <li>Karen & Ian Harris</li>
                    <li>David Hirsch</li>
                    <li>Robert Hollander</li>
                    <li>Lewis Howes & Sean Malarkey</li>
                    <li>Robbie & Brad Karp</li>
                    <li>Sam & Vicki Katz</li>
                    <li>Shakil Khan</li>
                    <li>Nicolas Koechlin</li>
                    <li>Timothy Komada</li>
                    <li>Randye & Brian Kwait</li>
                    <li>Dylan Lewis</li>
                    <li>Shauna Mei & Tara Dhingra</li>
                    <li>Sara Ojjeh</li>
                    <li>Jim Parsons</li>
                </ul>
            </div>
            <div class="column">
                <ul>
                    <li>Shervin Pishevar</li>
                    <li>Debbie & Cliff Robbins</li>
                    <li>Allison Rosen</li>
                    <li>Carolyn & Marc Rowan </li>
                    <li>Marty & Kim Sands</li>
                    <li>Steven & Ilene Sands</li>
                    <li>Boaz & Randi Sidikaro</li>
                    <li>Alex Soros</li>
                    <li>Marc & Diane Spilker</li>
                    <li>Hope & Glenn Taitz</li>
                    <li>Gary Vaynerchuk</li>
                    <li>The Weiss Family</li>
                    <li>The Wiggins Family</li>
                    <li>Jennifer & Ed Yorke</li>
                </ul>
            </div>
            <div class="column">
                <ul>
                    <li>1-800-FLOWERS</li>
                    <li>Cellairis</li>
                    <li>Elizabeth Arden</li>
                    <li>Give Back Brands Foundation</li>
                    <li>Halper-Rawiszer Financial Group & BNY Mellon</li>
                    <li style="border:none;">Schaffer, Schonholz & Drossman</li>
                    <li style="border:none;">Paul, Weiss, Rifkind, Wharton & Garrison LLP</li>
                    <li>Schaffer, Schonholz and Drossman</li>
                    <li>Stella May</li>
                </ul>
            </div>
            
            
            
        </div>
    </div>  </div>
    <span class="clear"></span>
    <div id="galleria" style="width: 100%; clear: both; height: 600px;"></div>
    <span class="clear"></span>
    <div id="logos">
        <ul class="tt-wrapper">
            <li><a href="http://www.birchbox.com/" target="_blank" class="logos tt-birch">
                <img style="height: 60px; padding: 15px;" src="<?php bloginfo('stylesheet_directory'); ?>/gfx/gala/logos/birchbox.png">
                
                </a></li>
            <li><a href="http://www.chaise23.com/" target="_blank" class="logos tt-chaise">
                <img style="height: 60px; padding: 20px;" src="<?php bloginfo('stylesheet_directory'); ?>/gfx/gala/logos/chaise23.png">
                
                </a></li>
            <li><a href="http://www.cosmopolitan.com/" target="_blank" class="logos tt-cosmo">
                <img style="height: 25px; padding-top: 30px;" src="<?php bloginfo('stylesheet_directory'); ?>/gfx/gala/logos/cosmopolitan.jpeg">
                
                </a></li>
            <li><a href="http://www.cwonder.com/" target="_blank" class="logos tt-c">
                <img src="<?php bloginfo('stylesheet_directory'); ?>/gfx/gala/logos/cwonder.jpeg">
                
                </a></li>
            <li><a href="http://www.drnates.com/" target="_blank" class="logos tt-dr">
                <img style="height: 70px; padding-top: 10px;" src="<?php bloginfo('stylesheet_directory'); ?>/gfx/gala/logos/drnates.jpg">
                
                </a></li>
            <li><a href="http://www.elizabetharden.com/" target="_blank" class="logos tt-ea">
                <img style="padding-left: 10px;" src="<?php bloginfo('stylesheet_directory'); ?>/gfx/gala/logos/elizabetharden.jpg">
                
                </a></li>
            <li><a href="http://www.inspirato.com/" target="_blank" class="logos tt-inspir">
                <img style="padding-left: 20px;" src="<?php bloginfo('stylesheet_directory'); ?>/gfx/gala/logos/inspirato.jpeg">
                
                </a></li>
            <li><a href="http://www.opi.com/" target="_blank" class="logos tt-opi">
                <img style="padding: 0 10px 0 30px;" src="<?php bloginfo('stylesheet_directory'); ?>/gfx/gala/logos/opi.png">
                
                </a></li>
            <li><a href="http://www.popchips.com/" target="_blank" class="logos tt-pop">
                <img style="padding: 0 20px;" src="<?php bloginfo('stylesheet_directory'); ?>/gfx/gala/logos/popchips.jpeg">
                
                </a></li>
            <li><a href="http://www.poppin.com/" target="_blank" class="logos tt-poppin">
                <img style="height: 30px; padding: 30px 10px;" src="<?php bloginfo('stylesheet_directory'); ?>/gfx/gala/logos/poppin.png">
                
                </a></li>
            <li><a href="http://www.restorsea.com/" target="_blank" class="logos tt-rest">
                <img style="height: 40px; padding: 15px 35px;" src="<?php bloginfo('stylesheet_directory'); ?>/gfx/gala/logos/restorsea.jpg">
                
                </a></li>
            <li><a href="http://getunreal.com/" target="_blank" class="logos tt-unreal">
                <img style="margin-top: -10px; padding: 0 20px;" src="<?php bloginfo('stylesheet_directory'); ?>/gfx/gala/logos/unrealcandy.jpeg">
               
                </a></li>
            <li><a href="http://vitacoco.com/" target="_blank" class="logos tt-vita">
                <img style="margin-top: -15px; padding: 0 25px;" src="<?php bloginfo('stylesheet_directory'); ?>/gfx/gala/logos/vitacoco.jpg">
               
                </a></li>
        </ul>
        
    </div>

</div>
    <script>

                            // Load the classic theme
                            Galleria.loadTheme('<?php bloginfo('stylesheet_directory'); ?>/js/galleria.classic.min.js');

                            // Initialize Galleria
                            Galleria.run('#galleria', {
                                transition: 'fade',
                                imageCrop: false,
                                thumbnails: false,
                                autoplay: 4000,
                                transitionSpeed: 500,
                                trueFullscreen: true,
                                showImagenav: true,
                                responsive: true,
                                showCounter: true,
                                imagePan: true,
                                transition: 'slide',
                                fullscreen: true,
                                lightbox: true,
                                showImagenav: true,
                                easing: 'swing',
                                flickr: 'set:72157630655186434',
                                flickrOptions: {
                                    sort: 'interestingness-desc',
                                    user: 'pencilsofpromise'
                                    
                                }
                            });
                            </script>
</body>
</html>
