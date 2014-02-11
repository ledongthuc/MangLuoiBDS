<?php defined('_JEXEC') or die('Restricted access'); ?>

<div class='mod_emphasis'>
<div style="float:left">
<?php if (!empty($review->image)) {?><a href="<?php echo $link ?>"><img  width='200' height='200' src="<?php echo $review->image; ?>" /></a>
<?php }?>
</div>
<div align="left" style="margin-left:215px">
<a href="<?php echo $link ?>"><?php echo $review->ten; ?></a>
<p><?php echo strip_tags($review->mo_ta_ngan); ?></p>
<div class="showpre" >
<p align="right"><a href="index.php?option=com_u_re&controller=projects&Itemid=31"><?php echo JText::_('SHOW_ALL');?></a></p>
</div>
</div>
</div>

