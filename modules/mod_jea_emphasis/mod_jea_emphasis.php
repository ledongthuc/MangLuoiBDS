<?php
/**
 * This file is part of Joomla Estate Agency - Joomla! extension for real estate agency
 *
 * @version		1.2 2008-07
 * @package		Jea.module.emphasis
 * @copyright	Copyright (C) 2008 PHILIP Sylvain. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla Estate Agency is free software. This version may have been modified pursuant to the
 * GNU General Public License, and as distributed it includes or is derivative
 * of works licensed under the GNU General Public License or other free or open
 * source software licenses.
 *
 */

defined('_JEXEC') or die('Restricted access');
require_once (dirname(__FILE__).DS.'helper.php');
JHTML::stylesheet('css_short_show.css', 'components/com_jea/views/');
include_once "libraries/unisonlib/com_jea_lib.php";
include_once "libraries/unison/unison_jea_lib.php";
$params->set('surface_measure', modJeaEmphasisHelper::getComponentParam('surface_measure') );

$paging=$params->get('paging');
$positionfooter=$params->get('positionfooter');
$positiontitle=$params->get('positiontitle');
$style=$params->get('style','emphasis');

if($paging==1)
{
	
	$number_per_page=$params->get('number_per_page');
	$ItemidParam = modJeaEmphasisHelper::getparamItemId($params);
	if($style=="sameItems")
	{
		$RowSam = modJeaEmphasisHelper::getSamRealItems();	
		$rows = $RowSam['rows'];	
		$tPage = $RowSam['TotalPage'];
	}
	else
	{
		$rowsF = modJeaEmphasisHelper::getList($params);
		$rows=array_slice($rowsF,0,$number_per_page);	
		$tPage=ceil(count($rowsF)/$number_per_page);
	
	}
}
else
{
	$rows = modJeaEmphasisHelper::getList($params);
}
$idPaging=$params->get('idPaging');
$measure=$params->get('surface_measure');
$style=$params->get('style','emphasis');
$order_by=$params->get('order_by','ordering');
$idKind=$params->get('idKind');
Global $pagingBDS_title;
// goi ham phan trang
if($paging==1)
{
	if($style=="sameItems")
	{
	
		$pagingBDS_title = @modJeaEmphasisHelper::phantrang_SamItems( $tPage );

	}
	else
	{
	$pagingBDS_title = @modJeaEmphasisHelper::phantrang($paging,$tPage,$number_per_page,$idPaging,$style,$order_by,$measure,$idKind,$ItemidParam);
	}
}

require(JModuleHelper::getLayoutPath('mod_jea_emphasis'));
