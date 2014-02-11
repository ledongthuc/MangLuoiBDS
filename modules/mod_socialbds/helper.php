<?php
defined('_JEXEC') or die('Restricted access');
class modModuleSocialbds{
	public function flike(){		
		echo '<iframe src="http://www.facebook.com/plugins/like.php?href='.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'].'"
        scrolling="no" frameborder="0" style="border:none; width:180px; height:60px"></iframe>';
		echo '<br/>';
	}  
	public function fshare(){
		echo "<script>function fbs_click() {u=location.href;t=document.title;window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');return false;}</script><style> html .fb_share_button { display: -moz-inline-block; display:inline-block; padding:1px 20px 0 5px; height:15px; border:1px solid #d8dfea; background:url(http://static.ak.facebook.com/images/share/facebook_share_icon.gif?6:26981) no-repeat top right; } html .fb_share_button:hover { color:#fff; border-color:#295582; background:#3b5998 url(http://static.ak.facebook.com/images/share/facebook_share_icon.gif?6:26981) no-repeat top right; text-decoration:none; } </style> <a rel=nofollow' href='http://www.facebook.com/share.php?u=<;url>' class='fb_share_button' onclick='return fbs_click()' target='_blank' style='text-decoration:none;'>Share</a>";
		echo '<br/><br/><br/>';
	}
	
	public function google(){		
		echo "<script>(function(d, t){var g = d.createElement(t),s = d.getElementsByTagName(t)[0];g.async = true;g.src = 'https://apis.google.com/js/plusone.js';s.parentNode.insertBefore(g, s);})(document, 'script');</script><g:plusone></g:plusone>";
		echo '<br/><br/>';
	}
	public function twitter(){
		echo '<a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';
	 echo '<br/><br/>';
	}
	public function zingme(){
		echo ' <a class="" name="zm_share" type="icnbig" title="Chia sẻ lên Zing Me"></a>
<script src="http://stc.ugc.zdn.vn/link/js/lwb.0.7.js" type="text/javascript"></script>';
      echo '<br/><br/><br/><br/><br/>'; 
	}
}