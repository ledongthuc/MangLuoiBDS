<?php
/**
 * Zaragoza Drop Down Menu
 * @copyright Copyright (C) 2010 Ciro Artigot. All rights reserved.
 * @license	GNU/GPL http://www.gnu.org/copyleft/gpl.html
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

// Include the syndicate functions only once
require_once (dirname(__FILE__).DS.'helper.php');


$incluircss = $params->get('css','css1');
$clickToOpen = $params->get('clickToOpen','0'); 
$duration = $params->get('duration','500'); 
$openDelay = $params->get('openDelay','500'); 
$closeDelay = $params->get('closeDelay','500'); 

$mode = $params->get('mode',0); 
$duration = $params->get('duration','500'); 
$transition = $params->get('transition','Fx.Transitions.Quart.easeOut'); 

require(JModuleHelper::getLayoutPath('mod_zaragozaddmenu'));