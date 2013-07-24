$(document).ready(function() { 	

var end = new Date(2013,08,12);
var today = Date.now();
var daydiff = Math.floor((end-today)/86400000);
$("#daydiff").text(daydiff);

$('.twitterupload').hide();

Dropzone.options.myAwesomeDropzone = {
  init: function() {
    this.on("addedfile", function(file) { 
        $('.twitterupload').show();
    });
  }
};

$checkbox = $(".custom-checkbox").length
$(".plusminus").hide();

$(".custom-checkbox input[type='checkbox']").change(function () {
  $amount = +$(".amount").val();
  var val = +$(this).val();
  if ($(this).is(":checked")){
      $number=+$(this).parent().find(".number").val();
      if($number===0){
          $(this).parent().find(".number").val($number+1);
      }
      amount();
      $(this).parent().children(".plusminus").show();     
  }
  else {
      amount();
      $(this).parent().children(".plusminus").hide();
  }
});

$(".plus").click(function(){
    var numberVal=+$(this).parent().find(".number").val();
    $(this).parent().find(".number").val(numberVal+1);
    amount();
})

$(".minus").click(function(){
    var numberVal=+$(this).parent().find(".number").val();
    $(this).parent().find(".number").val(numberVal-1);
    amount();
})

$(".number").change(function(){
    amount();
})

var total;
function amount(){
    total = 0;
    for(var i=0; i<$checkbox; i++){
        $inputVal = +$(".custom-checkbox").eq(i).find("input[type='checkbox']").val();
        if($(".custom-checkbox").eq(i).find("input[type='checkbox']").is(":checked")){
            $number = +$(".custom-checkbox").eq(i).find(".number").val();
        }
        else {
            $number=0;
        }
        if($number===0){
            $(".custom-checkbox").eq(i).find(".plusminus").hide();
            $(".custom-checkbox").eq(i).find("input[type='checkbox']").prop('checked', false);
        }
        $totalAmt = $inputVal*$number;
        total += $totalAmt;
    }
    //console.log(total);
    $(".amount").val(total);   
}

$("#checklistvalue").click(function(){
    $val = $(".amount").val();
    //console.log($val);
    window.location.href = "https://fundraise.pencilsofpromise.org/checkout/set-donation?fcid=220466&amount="+$val;
})


$("#closesttogoal, #mostraised, #biggestcontributers, #featured, #recentlycreated, #searchresponse").contentcarousel();
$('#searchbox .fundraiserlookup').show();
//otherfundraisers
$('#otherfundraisers nav li').click(function(){
   $pos = $(this).find('span').position();
   $width = $(this).find('span').width();
   $class=$(this).attr("class");
   $('.main .fundraiserlookup').hide();
   $('#'+$class).fadeIn("fast");
   $('#otherfundraisers nav .bar').animate({left:$pos.left+"px", width:$width+"px"}, 500);
});

$('.fundraiser_search').keydown(function() {
   $('#searchresponse .ca-wrapper').empty();
   $searchval = $('.fundraiser_search').val();
   $.getJSON('http://www.stayclassy.org/api1/fundraisers?token=utvVCIjXQWPvXIU80VME&cid=5417&eid=15845&q='+$searchval, function(json) {
      for(var i = 0; i < json.fundraisers.length; i++){
      $url=json.fundraisers[i].fundraiser_url;
      if (json.fundraisers[i].member_image_large){
          $image=json.fundraisers[i].member_image_large;
      } else {
         $image = "http://media-cache-ec0.pinimg.com/avatars/pencilsofpromis_1328562093_600.jpg"; 
      }
      $title=json.fundraisers[i].page_title;
      $raised=json.fundraisers[i].total_raised;
      $('#searchresponse .ca-wrapper').append("<div class='ca-item ca-item-1 fundraiser'><a href='"+$url+"' target='_blank'><img src='"+$image+"'><h4>"+$title+"</h4><p class='sub'>$"+$raised+" raised</p></a></div>");
  }
});
});

/*$('.section').bind('inview', function (event, visible) {
    if (visible == true) {
        $(this).addClass("inview");
    }else{
        $(this).removeClass("inview");
    }
})*/



var hgt = $(".section").height();

/*if ($.browser.msie && parseInt($.browser.version) < 9) {
  var inputs = $('.custom-checkbox input');
  inputs.live('change', function(){
    var ref = $(this),
        wrapper = ref.parent();
    if(ref.is(':checked')) wrapper.addClass('checked');
    else wrapper.removeClass('checked');
  });
  inputs.trigger('change');
}*/


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


//TWITTER CODE
var displaylimit = 10;
        var twittersearchtitle = "Custom twitter search";
        var showretweets = false;
        var showtweetlinks = true;
        var autorefresh = false;
        var refreshinterval = 60000; //Time to autorefresh tweets in milliseconds. 60000 milliseconds = 1 minute
        var refreshtimer;
         
        var headerHTML = '';
        var loadingHTML = '';
        headerHTML += '';
        headerHTML += '<h1>'+twittersearchtitle+'</h1>';
        loadingHTML += '';
         
        $('#twitter-feed').html(headerHTML + loadingHTML);
          
         if (autorefresh == true) {
            refreshtimer = setInterval(gettwitterjson, refreshinterval); 
         }  
          
         gettwitterjson();
          
        function gettwitterjson() { 
            $.getJSON('https://local2/popnew/wp-content/themes/pencilsofpromise/backtoschool.php', 
                function(feeds) {   
                   feeds = feeds.statuses; //search returns an array of statuses
                    //alert(feeds);   
                    var feedHTML = '';
                    var displayCounter = 1;  
                    for (var i=0; i<feeds.length; i++) {
                        var tweetscreenname = feeds[i].user.name;
                        var tweetusername = feeds[i].user.screen_name;
                        var profileimage = feeds[i].user.profile_image_url_https;
                        var status = feeds[i].text; 
                        var isaretweet = false;
                        var isdirect = false;
                        var tweetid = feeds[i].id_str;
                         
                        //If the tweet has been retweeted, get the profile pic of the tweeter
                        if(typeof feeds[i].retweeted_status != 'undefined'){
                           profileimage = feeds[i].retweeted_status.user.profile_image_url_https;
                           tweetscreenname = feeds[i].retweeted_status.user.name;
                           tweetusername = feeds[i].retweeted_status.user.screen_name;
                           tweetid = feeds[i].retweeted_status.id_str
                           isaretweet = true;
                         };
                          
                          
                         if (((showretweets == true) || ((isaretweet == false) && (showretweets == false)))) { 
                            if ((feeds[i].text.length > 1) && (displayCounter <= displaylimit)) {             
                                if (showtweetlinks == true) {
                                    status = addlinks(status);
                                }
                                  
                                if (displayCounter == 1) {
                                    feedHTML += headerHTML;
                                }
                                              
                                feedHTML += '<div class="twitter-article">';                  
                                feedHTML += '<div class="twitter-pic"><a href="https://twitter.com/'+tweetusername+'" ><img src="'+profileimage+'"images/twitter-feed-icon.png" width="42" height="42" alt="twitter icon" /></a></div>';
                                feedHTML += '<div class="twitter-text"><p><span class="tweetprofilelink"><strong><a href="https://twitter.com/'+tweetusername+'" >'+tweetscreenname+'</a></strong> <a href="https://twitter.com/'+tweetusername+'" >@'+tweetusername+'</a></span><span class="tweet-time"><a href="https://twitter.com/'+tweetusername+'/status/'+tweetid+'">'+relative_time(feeds[i].created_at)+'</a></span><br/>'+status+'</p></div>';
                                feedHTML += '</div>';
                                displayCounter++;
                            }   
                         }
                    }
                      
                    $('#twitter-feed').html(feedHTML);
            });
        }
              
        //Function modified from Stack Overflow
       /* function addlinks(data) {
            //Add link to all http:// links within tweets
            data = data.replace(/((https?|s?ftp|ssh)\:\/\/[^"\s\<\>]*[^.,;'">\:\s\<\>\)\]\!])/g, function(url) {
                return '<a href="'+url+'" >'+url+'</a>';
            });
                  
            //Add link to @usernames used within tweets
            data = data.replace(/\B@([_a-z0-9]+)/ig, function(reply) {
                return '<a href="http://twitter.com/'+reply.substring(1)+'" style="font-weight:lighter;" >'+reply.charAt(0)+reply.substring(1)+'</a>';
            });
            return data;
        }*/
          
          
        function relative_time(time_value) {
          var values = time_value.split(" ");
          time_value = values[1] + " " + values[2] + ", " + values[5] + " " + values[3];
          var parsed_date = Date.parse(time_value);
          var relative_to = (arguments.length > 1) ? arguments[1] : new Date();
          var delta = parseInt((relative_to.getTime() - parsed_date) / 1000);
          var shortdate = time_value.substr(4,2) + " " + time_value.substr(0,3);
          delta = delta + (relative_to.getTimezoneOffset() * 60);
          
          if (delta < 60) {
            return '1m';
          } else if(delta < 120) {
            return '1m';
          } else if(delta < (60*60)) {
            return (parseInt(delta / 60)).toString() + 'm';
          } else if(delta < (120*60)) {
            return '1h';
          } else if(delta < (24*60*60)) {
            return (parseInt(delta / 3600)).toString() + 'h';
          } else if(delta < (48*60*60)) {
            //return '1 day';
            return shortdate;
          } else {
            return shortdate;
          }
        }


});
