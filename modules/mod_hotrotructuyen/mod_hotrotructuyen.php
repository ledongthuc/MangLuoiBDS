<?php
			 $pageURL = 'http';
			 if (@$_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
			 $pageURL .= "://";
			 if ($_SERVER["SERVER_PORT"] != "80") {
			  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
			 } else {
			  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
			 }
	if($_GET['lang']=='en'){
		$titlefb="Share This on Facebook";
		$titletw="Share this post on Twitter";
		$titlein="Share this post on LinkedIn";
		$titlegg="Share on Google+";
	}else{
		$titlefb="Chia sẻ trên Facebook";
		$titletw="Chia sẻ trên Twitter";
		$titlein="Chia sẻ trên LinkedIn";
		$titlegg="Chia sẻ trên Google+";
	}
?>
<div class="dangnhap-dangki">
<script type="text/javascript">
function fbs_click() {
	var u=location.href;
	if(u=='http://diaoctanminhchau.com/')
	u='http://diaoctanminhchau.com/vi/';
	var t=document.title;
	window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');
	return false;
}
</script>
<?php 
global $mainframe;
$user =& JFactory::getUser();
if($user->get('name'))
{
	echo JText::_('Chào bạn'). "&nbsp&nbsp<strong>". $user->get('name') ."</strong>";
	echo "<a href=\"index.php?option=com_user&task=logout+&Itemid=1&lang=vi\">&nbsp&nbsp|&nbsp&nbspĐăng xuất </a>";
	echo " | <a  class= \"hotro\" href=\"index.php?option=com_u_re&view=manage&Itemid=16&lang=vi&layout=form\"> Đăng tin</a>";
	
	echo " | <a  class= \"hotro\" href=\"index.php?option=com_u_re&view=manage&Itemid=16&lang=vi\">Quản lý tin</a>";
	echo " | <a  class= \"hotro\" href=\"index.php?option=com_user&task=edit&Itemid=16&lang=vi\">Thay đổi thông tin </a>";
	?>
	<a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode($pageURL);?>&title=<?php echo $titlein; ?>&summary=&source=Địa ốc Tân Minh Châu" target="_new">
	<img src="images/stories/linkedin.png" style="float: right; padding-top: 6px; padding-right: 6px;" width="15px"  height="15px" alt="" title="<?php echo $titlein; ?>"/>
	</a>
	<a href="https://twitter.com/share?url=<?php echo urlencode($pageURL);?>" title="<?php echo $titletw;?>" target="_blank"><img src="images/stories/twitter-icon.png" width="22px" height="22px" ></a>
	<a href="https://plus.google.com/share?url=<?php echo urlencode($pageURL);?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
	<a href="javascript:;" onClick="return fbs_click()" target="_blank" title="<?php echo $titlefb;?>"><img style="float: right; padding-top: 6px; padding-right: 6px;" src="images/stories/facebook_icon.png" alt="facebook" width="15" height="15" border="0" /></a>
	

	<?php 
}
else
?>
<div style='float:right' class='fd'>
	<a href="javascript:;" onClick="return fbs_click()" target="_blank" title="<?php echo $titlefb;?>"><img style="" src="images/stories/facebook_icon.png" alt="facebook" width="15" height="15" border="0" /></a>
	<a href="https://plus.google.com/share?url=<?php echo urlencode($pageURL);?>" title="<? echo $titlegg; ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img style="" src="images/stories/new-g-plus-icon-64.png" alt="Google+" width="15" height="15" border="0" /></a>
	<a href="https://twitter.com/share?url=<?php echo urlencode($pageURL);?>" title="<?php echo $titletw;?>" target="_blank"><img <img style="" src="images/stories/twitter-icon.png" width="18px" height="15px" /></a>
	<a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode($pageURL);?>&title=<?php echo $titlein; ?>&summary=&source=Địa ốc Tân Minh Châu" target="_new">
	<img src="images/stories/linkedin.png" style="" width="15px" title="<?php echo $titlein; ?>"  height="15px"/>
	</a>
	
	</div>
<?php
{	echo"<div style='float:right;'>";
	echo "<a href=\"index.php?option=com_user&amp;view=register&amp;Itemid=19&amp;lang=vi\">Đăng ký</a>";
	echo " &nbsp&nbsp|&nbsp&nbsp ";
	echo "<a href=\"index.php?option=com_user&amp;view=login&amp;Itemid=19&amp;lang=vi\">Đăng nhập </a>";
	echo " &nbsp&nbsp|&nbsp&nbsp ";
	echo"</div>";
	?>
	
	
	<?php 
}

if(JFactory::getURI()->getVar("task") == 'logout')
{
	$mainframe->redirect('index.php');
}
?>
</div>
