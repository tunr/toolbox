<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>YMP</title>
  
<link rel="stylesheet" href="<?php echo base_url(); ?>css/ymp.css" type="text/css">

</head>

<body>

<div id="player_box">
</div>

<!--<span style="display: none;"><a href="http://dev/toolbox/audio/01-silversun_pickups-theres_no_secrets_this_year.mp3">Silver Sun</a></span>-->

<br><br><br>
<div><a href="http://dev/toolbox/audio/gang_starr_-_here_it_comes.mp3">Gang Starr - Here it comes</a></div>
<div><a href="http://dev/toolbox/audio/01-silversun_pickups-theres_no_secrets_this_year.mp3">silversun pickups - theres no secrets this year</a></div>
<div><a href="http://dev/toolbox/audio/02-silversun_pickups-the_royal_we.mp3">silversun pickups - the royal we</a></div>

<div id="output"></div>

<script language="JavaScript" type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.3.2.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>js/jquery.livequery-1.0.3.min.js"></script>
<script type="text/javascript" src="http://mediaplayer.yahoo.com/js"></script>
<!--<script type="text/javascript" src="http://mediaplayer.yahoo.com/latest"></script>-->

<script type="text/javascript">

var YMPParams = {
  //defaultalbumart:'http://somedomain.com/path/someimage.gif'
  autoplay: false,
  displaystate: 1,
  volume: 0.1
}

var apiReadyHandler = function() {
    /* Once API ready handler is invoked, YAHOO.MediaPlayer class can be accessed safely */
    /* For example: Add other event listeners **/
    YAHOO.MediaPlayer.onPlaylistUpdate.subscribe(onPlaylistUpateHandler)
}

var onPlaylistUpateHandler = function(playlistArray) {

/*
  YAHOO.mediaplayer.View.prototype.openTray = function () {
    alert('here');
    
    YAHOO.ympyui.util.Dom.removeClass('ymp-playlist-arrow', 'ymp-up-arrow');
    YAHOO.ympyui.util.Dom.addClass('ymp-playlist-arrow', 'ymp-down-arrow');
    YAHOO.ympyui.util.Dom.removeClass('ymp-btn-tray', 'ymp-btn-tray-closed');
    YAHOO.ympyui.util.Dom.addClass('ymp-btn-tray', 'ymp-btn-tray-open');
    var anim = new YAHOO.ympyui.util.Anim('ymp-tray', {
      height: {
        to: 204
      }
    },
    .35, YAHOO.ympyui.util.Easing.easeOut);
    anim.onComplete.subscribe(this.addTrayScrollBar);
    anim.animate();
    this.playlistViewState = YAHOO.mediaplayer.View.PlaylistState.MAX;
    var elm = document.getElementById('ymp-btn-tray');
    if (elm) {
      elm.setAttribute("title", YAHOO.mediaplayer.DisplayStrings.tooltips.CLOSEPLAYLIST);
      elm = null;
    }
    
  };
*/

  $(document).ready(function() {
    
    $('#ymp-player').each(function() { 
      
      $(this).appendTo('#player_box').css({ 'position' : 'absolute' });
      
      $('#ymp-tray').appendTo("#player_box").css({'position' : 'absolute'});
      //$('#ymp-error-bubble, #ymp-secret-bubble').appendTo("#player_box");
      /*
      $('#ymp-btn-tray').click(function() {
        return false;
      });
      */
      
      $('#ymp-yahoo-logo, #ymp-btn-buy, #ymp-btn-target, #ymp-btn-close, #ymp-relevance, #ymp-btn-pop, #ymp-btn-min').hide();
      //$('#ymp-yahoo-logo, #ymp-btn-buy, #ymp-btn-target, #ymp-btn-close,               #ymp-btn-pop, #ymp-btn-min').remove();
      
    });
    
    //out(YAHOO.MediaPlayer.getPlaylistCount());
    
    // OUTPUT DEBUG UTILITY
    function out(val) {
      var output = $('#output').length;
      if (output) {
        $('#output').append(val + '<br />');
      } else {
        $('body').append('<div id="output"></div>');
        $('#output').append(val + '<br />');
      }
    }
    
  });
  
    /* Handler for onPlaylistUpdate event */
    //alert(" playlist count = " + YAHOO.MediaPlayer.getPlaylistCount())
}

YAHOO.MediaPlayer.onAPIReady.subscribe(apiReadyHandler);
</script>

</body>
</html>



