<?php

/**
 * Zaragoza Drop Down Menu
 * @copyright Copyright (C) 2010 Ciro Artigot. All rights reserved.
 * @license	GNU/GPL http://www.gnu.org/copyleft/gpl.html
*/

defined('_JEXEC') or die('Restricted access');


if ( ! defined('modZaragozaDDMenuXMLCallbackDefined') )
{
function modZaragozaDDMenuXMLCallback(&$node, $args)
{
	$user	= &JFactory::getUser();
	$menu	= &JSite::getMenu();
	$active	= $menu->getActive();
	$path	= isset($active) ? array_reverse($active->tree) : null;

	if (($args['end']) && ($node->attributes('level') >= $args['end']))
	{
		$children = $node->children();
		foreach ($node->children() as $child)
		{
			if ($child->name() == 'ul') {
				$node->removeChild($child);
			}
		}
	}

	if ($node->name() == 'ul') {
		foreach ($node->children() as $child)
		{
			if ($child->attributes('access') > $user->get('aid', 0)) {
				$node->removeChild($child);
			}
		}
	}

	if (($node->name() == 'li') && isset($node->ul)) {
		$node->addAttribute('class', 'parent');
	}

	if (isset($path) && (in_array($node->attributes('id'), $path) || in_array($node->attributes('rel'), $path)))
	{
		if ($node->attributes('class')) {
			$node->addAttribute('class', $node->attributes('class').' active');
		} else {
			$node->addAttribute('class', 'active');
		}
	}
	else
	{
		if (isset($args['children']) && !$args['children'])
		{
			$children = $node->children();
			foreach ($node->children() as $child)
			{
				if ($child->name() == 'ul') {
					$node->removeChild($child);
				}
			}
		}
	}

	if (($node->name() == 'li') && ($id = $node->attributes('id'))) {
		if ($node->attributes('class')) {
			$node->addAttribute('class', $node->attributes('class').' item'.$id);
		} else {
			$node->addAttribute('class', 'item'.$id);
		}
	}

	if (isset($path) && $node->attributes('id') == $path[0]) {
		$node->addAttribute('id', 'current');
	} else {
		$node->removeAttribute('id');
	}
	$node->removeAttribute('rel');
	$node->removeAttribute('level');
	$node->removeAttribute('access');
}
	define('modZaragozaDDMenuXMLCallbackDefined', true);
}


global $mainframe;
$document =& JFactory::getDocument();

if($incluircss)	$document->addCustomTag( '<link rel="stylesheet" href="'.JURI::base().'modules/mod_zaragozaddmenu/css/'.$incluircss.'.css" type="text/css" />' );
$document->addScript( JURI::base() .'modules/mod_zaragozaddmenu/js/UvumiDropdown-compressed.js' );

$document->addCustomTag('
<script type="text/javascript">

<!--
	var myMenu = new UvumiDropdown("dropdown-zaragoza",{
	duration:'.$duration.', 
	transition:'.$transition.', 
	openDelay :'.$openDelay.', 
	closeDelay:'.$closeDelay.',
	clickToOpen:'.$clickToOpen.'
	}); 
	-->

</script>
');

echo '
<div class="zddmenu">
	<div>';
modZaragozaDDMenuHelper::render($params, 'modZaragozaDDMenuXMLCallback');
echo '
	</div>
	<div style="clear:both"></div>
</div>';
?>
