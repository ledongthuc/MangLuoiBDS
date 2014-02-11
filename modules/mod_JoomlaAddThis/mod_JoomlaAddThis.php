<?php
/**
* @version		$Id: mod_latestnews.php 9764 2007-12-30 07:48:11Z ircmaxell $
* @package		Joomla
* @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

$moduleclass_sfx = $params->get('moduleclass_sfx');
$joomlaAddThisPub = $params->get('joomlaAddThisPub');
$joomlaAddThisLogo = $params->get('joomlaAddThisLogo');
$joomlaAddThisLogoBackground = $params->get('joomlaAddThisLogoBackground');
$joomlaAddThisLogoColor = $params->get('joomlaAddThisLogoColor');
$joomlaAddThisOptions = $params->get('joomlaAddThisOptions');

$joomlaAddThisBrand = '<a href="http://www.joomlaserviceprovider.com" title="Joomla Service Provider">JoomlaServiceProvider.com</a>';
$joomlaAddThisBrandName = $params->get('joomlaAddThisBrandName');
$joomlaAddThisBrandURL = $params->get('joomlaAddThisBrandURL');

$joomlaAddThisImageURL = $params->get('joomlaAddThisImageURL');

if ((! empty($joomlaAddThisBrandName)) && (! empty($joomlaAddThisBrandURL))) {
	$joomlaAddThisBrand = "<a href=\"$joomlaAddThisBrandURL\" title=\"$joomlaAddThisBrandName\">$joomlaAddThisBrandName</a>";
} else {
	$joomlaAddThisBrand = $joomlaAddThisBrandName;
}

?>

<div class="joomla_add_this<?php echo $moduleclass_sfx?>">
<!-- ADDTHIS BUTTON BEGIN -->
<script type="text/javascript" language="javascript">
addthis_pub             = '<?php echo $joomlaAddThisPub?>'; 
addthis_logo            = '<?php echo $joomlaAddThisLogo?>';
addthis_logo_background = '<?php echo $joomlaAddThisLogoBackground?>';
addthis_logo_color      = '<?php echo $joomlaAddThisLogoColor?>';
addthis_brand           = '<?php echo $joomlaAddThisBrand?>';
addthis_options         = '<?php echo $joomlaAddThisOptions?>';
</script>

<a href="http://www.addthis.com/bookmark.php" onmouseover="return addthis_open(this, '', '[URL]', '[TITLE]')" onmouseout="addthis_close()" onclick="return addthis_sendto()"><img src="<?php echo $joomlaAddThisImageURL?>" width="125" height="16" border="0" alt="" /></a>
<script type="text/javascript" src="http://s7.addthis.com/js/200/addthis_widget.js"></script>
<!-- ADDTHIS BUTTON END -->

</div>