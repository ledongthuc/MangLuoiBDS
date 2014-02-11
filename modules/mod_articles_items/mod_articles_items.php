<?php
/**
* 
* 
* @copyright	Inspiration Web Design
* License GNU/GPL
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

// Include the syndicate functions only once
require_once (dirname(__FILE__).DS.'helper.php');

$list = mod_articles_items::getList($params);
if($params->get('special_articleid'))
$list_spec = mod_articles_items::getList_spec($params);
require(JModuleHelper::getLayoutPath('mod_articles_items'));