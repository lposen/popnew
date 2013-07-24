$(document).ready(function() { 	

$('.backpack').val()=100;

$('.submit').click(function(){
    alert($('.backpack').val());    
})


$("#closesttogoal, #mostraised, #biggestcontributers, #featured, #recentlycreated").contentcarousel();

//otherfundraisers
$('#otherfundraisers nav li').click(function(){
   $pos = $(this).find('span').position();
   $width = $(this).find('span').width();
   $class=$(this).attr("class");
   $('.fundraiserlookup').hide();
   $('#'+$class).fadeIn("fast");
   $('#otherfundraisers nav .bar').animate({left:$pos.left+"px", width:$width+"px"}, 500);
});

/*$('.section').bind('inview', function (event, visible) {
    if (visible == true) {
        $(this).addClass("inview");
    }else{
        $(this).removeClass("inview");
    }
})*/



var hgt = $(".section").height();

if ($.browser.msie && parseInt($.browser.version) < 9) {
  var inputs = $('.custom-checkbox input');
  inputs.live('change', function(){
    var ref = $(this),
        wrapper = ref.parent();
    if(ref.is(':checked')) wrapper.addClass('checked');
    else wrapper.removeClass('checked');
  });
  inputs.trigger('change');
}

    




function calculate(){
    
}

/*$("img").click(function(){
    $(this).rotate({
            angle: 0, 
            animateTo:180,
            callback: function(){   alert(1)  }
     })
});
$introheight = $("#intro").height();
var minDistance = 100;
var startDistance = $introheight+$(".backpack").height();
var bpdown = false;
$(window).scroll(function(e) {
    var scrollTop = $(document).scrollTop();
    var bppos = $(".backpack").position().top;
    $introheight = $("#intro").height()-1000;
    $completeheight = $introheight+$(".backpack").height();
    if((scrollTop > startDistance - minDistance) && !bpdown) {
             backpackRotate();
    }
});

function backpackRotate(){
    if (!bpdown){
        $(".backpack").rotate({
            angle: 0, 
            animateTo:180,
            callback: function(){  
                    itemsfallout();
            }
        })
        bpdown=true;
    }
    
}

function itemsfallout() {
    $item = $('.checklist .item');
    var top = 800;
    $item.eq(0).animate({left:0, top:top});
    $item.eq(1).delay(250).animate({left:$(window).width()*.25, top:top});
    $item.eq(2).delay(500).animate({left:$(window).width()*.5, top:top});
    $item.eq(3).delay(750).animate({left:$(window).width()*.75, top:top}, function(){
        $('.checklist .item p').fadeIn();
    });
}*/

//get tweets by hashtag



/*$('#s4avid').click(function(){
   $('#greyoverlay').fadeIn("fast");
   $('.close, iframe.s4amodal').fadeIn("fast");
   $('iframe.s4amodal').height($('iframe.s4amodal').width()*.5);
   $('.close, #greyoverlay').click(function(){
       $('#greyoverlay').fadeOut("fast");
       $('.close, iframe.s4amodal').fadeOut();
   });
});

$('.facebook').click(function(){
    var sharer = "https://www.facebook.com/sharer/sharer.php?u=";
    window.open(sharer + "pencilsofpromise.org/yearbook", 'sharer', 'width=626,height=436');
}); */


});
