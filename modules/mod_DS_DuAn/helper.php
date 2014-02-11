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
require_once(JPATH_ROOT . '/libraries/com_u_re/php/common_utils.php');

class modDS_DuAn
{
	function LayDSDuAn($param)
	{
		$field='id,ten';
		$condition='hien_thi_ra_ngoai=1';
		$orderby='';		
		if($param->get('ma_so', '0')!='0'){
			$orderby.='id '.$param->get('ma_so', 'ASC');
		}
		
		if($param->get('thu_tu', '0')!='0'){
			if($orderby!='')
				$orderby.=',';
			$orderby.='ordering '.$param->get('thu_tu', 'ASC');
		}

		if($param->get('noi_bat', '0')!='0'){
			if($orderby!='')
				$orderby.=',';
			$orderby.='noi_bat '.$param->get('noi_bat', 'ASC');
		}
		if($param->get('moi_nhat', '0')!='0'){
			if($orderby!='')
				$orderby.=',';
			$orderby.='moi_nhat '.$param->get('moi_nhat', 'ASC');
		}
		
		$pagesize = $param->get('so_duan', '10');
		$DBConfig = ilandCommonUtils::getSiteDBConfig();
		$lang = ilandCommonUtils::getLanguage();
		$dsduan=iland4_layDanhSachDuAn($DBConfig, $field, $condition , 1, $pagesize, $orderby, $lang);
		return $dsduan;
	}
}