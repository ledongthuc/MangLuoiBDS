<?php
/**
* @version		$Id: mod_giavang.php 10381 2008-06-01 03:35:53Z pasamio $
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

// Include the whosonline functions only once
require_once (dirname(__FILE__).DS.'helper.php');

$link 	= $params->get( 'link', 'http://www.vnexpress.net/Service/Gold_Content.js' );
$css = '<STYLE TYPE="text/css" MEDIA=screen>
<!--
  .gia_vang_table { border:0; }
  .gia_vang_name  { text-align:center; width:30px; }
  .gia_vang_value  { text-align:right; margin-right:2px; width:60px;}
  .gia_vang_source  { text-align:justify; font-style:italic;}
-->
</STYLE>';

$css = $params->get( 'css', $css );
$source = $params->get( 'source', 'Nguồn: Ngân hàng Ngoại thương VN' );

$data = modGiavangHelper::getData($link);

$vGoldSbjBuy = modGiavangHelper::getVGoldSbjBuy($data);
$vGoldSbjSell = modGiavangHelper::getVGoldSbjSell($data);
$vGoldSjcBuy  = modGiavangHelper::getVGoldSjcBuy($data);
$vGoldSjcSell = modGiavangHelper::getVGoldSjcSell($data);

require(JModuleHelper::getLayoutPath('mod_giavang'));
