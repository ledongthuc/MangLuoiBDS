<?php
/**
* @package		WDTech
* @copyright	Copyright (C) 2009 WDTech.Net. All rights reserved.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');


$imageurl=$params->get('banner_image_url_1');
$imageLink = $params->get('banner_link_1');

$width = $params->get('width');
$height = $params->get('height');
$target = $params->get('target');

?>
<div id="wdBanners<?php echo str_replace("/","",$imageurl)?>" style="width: <?php echo $width?>px; height: <?php echo $height?>px; overflow: hidden; margin-bottom: 10px;">
	<?php if($target == 0): ?>
	<a href="<?php echo $imageLink ?>" class="wdBannerLink"><img src="<?php echo JURI::base().$imageurl ?>" class="wdBannerImg" alt="mang luoi bat dong san" /></a>
	<?php else: ?>
	<a href="<?php echo $imageLink ?>" target="_blank" class="wdBannerLink"><img src="<?php echo JURI::base().$imageurl ?>" class="wdBannerImg" alt="mang luoi bat dong san" /></a>
	<?php endif; ?>
</div>