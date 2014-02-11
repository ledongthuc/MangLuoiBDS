<?php
/**
* @package Author
* @author thongdd
* @website thietkewebbatdongsan.com
* @email thongdd@i-land.vn
* @copyright 2012
* @license 
**/

// no direct access
defined('_JEXEC') or die('Restricted access');

if ( isset( $_SESSION['tmp'] ) && ($_SESSION['tmp']['sess_tmp'] != 1) ) 
{
	unset ( $_SESSION['tmp'] );
}

require_once(dirname(__FILE__).DS.'helper.php');


require(JModuleHelper::getLayoutPath('mod_taoyeucau'));


?>