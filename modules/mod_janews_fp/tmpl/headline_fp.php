<?php
$headlinelang 			= 	trim( $params->get( 'headlinelang' ));
$headlineheight 		= 	intval ($params->get( 'headlineheight' ));
$numberofheadlinenews 	= 	intval (trim( $params->get( 'numberofheadlinenews', 10 ) ));
$delaytime 				= 	intval (trim( $params->get( 'delaytime', 5 ) ));
$autoroll 			= 	intval (trim( $params->get( 'autoroll', 0) ));
$showhlreadmore 				= 	intval (trim( $params->get( 'showhlreadmore', 1 ) ));
$showhltitle 				= 	intval (trim( $params->get( 'showhltitle', 1 ) ));
$showhltools 				= 	intval (trim( $params->get( 'showhltools', 1 ) ));
$hiddenClasses 				= 	trim( $params->get( 'hiddenClasses', '' ) );

$imgalign = 'left';

$numberofheadlinenews = ($numberofheadlinenews < count($rows)) ? $numberofheadlinenews : count($rows);

if ($numberofheadlinenews >= 1) {
	if (isset($_COOKIE['JAHL-AUTOROLL'])) $autoroll = ($_COOKIE['JAHL-AUTOROLL']) ? 1 : 0;
	setcookie("JAHL-AUTOROLL", $autoroll, 0, "/");
?>
	<script type="text/javascript" src="modules/mod_janews_fp/ja.news/ja.news.js"></script>
	<script type="text/javascript">
		var jaNewsHL = new JA_NewsHeadline({
				autoroll: <?php echo intval($autoroll || !$showhltools);?>,
				total: <?php echo $numberofheadlinenews;?>,
				delaytime: <?php echo $delaytime;?>
		});
		window.addEvent('domready', function() {
			jaNewsHL.start();
		});
	</script>

<?php
}
$pauseplay = $autoroll?'Pause':'Play';
?>

<div id="ja-newshlcache" style="display: none">
<?php
foreach ($rows as $news) {
	$link   = JRoute::_(ContentHelperRoute::getArticleRoute($news->slug, $news->catslug, $news->sectionid));
	$image = modJANewsHelper::replaceImage ($news, $imgalign, 1, $bigmaxchar, 1, $bigimg_w, $bigimg_h, $hiddenClasses);
?>
	<div>
	<div class="ja-newscontent">
	
	<?php echo $image; ?>
	<?php if ($showhltitle) { ?>
	<h4 class="jazin-title"><a href="<?php echo $link;?>" class="ja-newstitle" title="<?php echo strip_tags($news->title); ?>"><?php echo $news->title;?></a></h4>
	<?php } ?>
	<?php 
	if($bigmaxchar > strlen($news->introtext)) {
		echo $news->introtext;
	} else {
		echo $news->introtext1;
	}
	?>
	<?php if ($showhlreadmore) {?>
	<a href="<?php echo $link;?>" class="readon"><?php echo JText::_('Read more...');?></a>
	<?php } ?>
	</div>
	</div>
<?php
}
?>
</div>
<div id="jazin-hlwrap">
<div class="jazin-contentwrap clearfix" style="width: 100%;<?php echo ($headlineheight ? " height: {$headlineheight}px; overflow: hidden;" : ""); ?>">

<div class="ja-newsitem" style="width: 100%;">
<div class="ja-newsitem-inner" style="width: 100%;">
<?php
if($showhltools || $headlinelang) {
?>
<div class="ja-newscat">
	<span id="jahl-headlineanchor"><?php echo $headlinelang;?></span>
<?php
	if($showhltools) {
?>
	<div class="jahl-newscontrol">
	<ul>
	<li><img title="<?php echo $pauseplay;?>" style="cursor: pointer;" id="jahl-switcher" onclick="jaNewsHL.toogle(); return false;" src="<?php echo modJaNewsHelper::getFile(strtolower($pauseplay).'.png','modules/mod_janews_fp/ja.news/','templates/'.$mainframe->getTemplate().'/images/'); ?>" alt="<?php echo $pauseplay;?>" border="0" /></li>
	<li><img title="" style="cursor: pointer;" onclick="jaNewsHL.prev(); return false;" id="jahl-prev" src="<?php echo modJaNewsHelper::getFile('prev.png','modules/mod_janews_fp/ja.news/','templates/'.$mainframe->getTemplate().'/images/'); ?>" alt="Previous" border="0" /></li>
	<li><img title="" style="cursor: pointer;" onclick="jaNewsHL.next(); return false;" id="jahl-next" src="<?php echo modJaNewsHelper::getFile('next.png','modules/mod_janews_fp/ja.news/','templates/'.$mainframe->getTemplate().'/images/'); ?>" alt="Next" border="0" /></li>
	</ul>
	<span id="jahl-indicator">1/<?php echo $numberofheadlinenews;?></span>
	</div>
<?php } ?>
</div>
<?php } ?>
<div id="jahl-newsitem">
</div>
</div></div></div></div>
<!-- <span class="article_seperator">&nbsp;</span> -->
