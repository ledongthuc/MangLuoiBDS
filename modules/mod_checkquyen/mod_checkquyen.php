<?php
/**
* @package Author
* @author danhthong
* @website 
* @email danhthong@gmail.com
* @copyright 
* @license 
**/

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once(dirname(__FILE__).DS.'helper.php');
$quyen = mod_checkquyenHelper::getQuyen();
require(JModuleHelper::getLayoutPath('mod_checkquyen'));
?>