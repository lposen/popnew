var tag=document.createElement('script');tag.src="http://www.youtube.com/player_api";var firstScriptTag=document.getElementsByTagName('script')[0];firstScriptTag.parentNode.insertBefore(tag,firstScriptTag);var player;
function onYouTubePlayerAPIReady(){player=new YT.Player
    ('player',{height:popVideoHeight,width:popVideoWidth,videoId:popVideoId,
        events:{'onReady':onPlayerReady}
     })
 }
function onPlayerReady(event){
    if (popVideoAutoplay) {
        event.target.playVideo()
    }
}