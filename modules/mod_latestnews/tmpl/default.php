<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<ul class="latestnews<?php echo $params->get('moduleclass_sfx'); ?>">
<?php foreach ($list as $item) :  ?>
	<li class="latestnews<?php echo $params->get('moduleclass_sfx'); ?>">
		<a href="<?php echo $item->link; ?>" class="latestnews2<?php echo $params->get('moduleclass_sfx'); ?>"><span style="margin-left:12px;">
			<?php echo $item->text; ?></span></a>
	</li>
<?php endforeach; ?>
</ul>