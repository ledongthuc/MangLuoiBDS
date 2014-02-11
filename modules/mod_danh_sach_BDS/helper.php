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
//require_once ('.\modules\mod_jea_emphasis\mod_jea_emphasis.php');
include_once "libraries/unisonlib/com_jea_lib.php";

class modDanhSachBDSHelper
{
	
	function getRowItem($KindId,$itempa)
	{
		$pa=explode(',',trim($itempa));
		
		switch ($KindId)
		{
			case 1:
				$itemid= $pa[0] ;
				break;
			case 2:
				$itemid=  $pa[1];
				break;
			case 3:
				$itemid= $pa[2] ;
				break;
			case 4:
				$itemid=  $pa[3];
				break;
		}
		return $itemid;
		
	}
	
	function getRowKind($KindId)
	{
		
		switch ($KindId)
		{
			case 1:
				$kindString = "Cần bán";
				break;
			case 2:
				$kindString = "Cho thuê";
				break;
			case 3:
				$kindString = "Cần mua";
				break;
			case 4:
				$kindString = "Cần thuê";
				break;
			default : $kindString = "Cần bán";
				break;
		}
		return $kindString;
		
	}
	
	function getFullAdress($duongpho,$phuongxa,$quanhuyen,$town)
	{
		 ($duongpho != "")? $dau1 = ", " : $dau1 = "";
	     ($phuongxa != "")? $dau2 = ", " : $dau2 = "";
	     ($quanhuyen != "")? $dau3 = ", " : $dau3 = "";
	     $FullAdress=$duongpho.$dau1.$phuongxa.$dau2.$quanhuyen.$dau3.$town;
	     return $FullAdress;
	}
	
	function getparamItemId($params)
	{
		$pa=$params->get('ItemId');
		return $pa;
	}	
	function getparamidPaging($params)
	{
		$idpage=$params->get('idPaging');
		return $idpage;
	}
	function getComponentParam($param, $default='')
	{
		static $instance;

		if ( !is_object($instance) ) {
			jimport('joomla.application.component.helper');

			$instance =& JComponentHelper::getParams('com_jea');

			// fix bug #10973 Warning: cannot yet handle MBCS in html_entity_decode()!
			$surface_measure = 'm' . JText::_('SYMBOL_SUP2');
			$currency_symbol = JText::_('SYMBOL_EURO');
			$thousands_separator = ' ';
			// end fix bug #10973

			$instance->def('surface_measure', $surface_measure);
			$instance->def('currency_symbol', $currency_symbol);
			$instance->def('thousands_separator', $thousands_separator);
			$instance->def('decimals_separator', ',');
			$instance->def('symbol_place', 1);
		}

		return $instance->get($param, $default) ;
	}

	function getListByRealtorId()
	{
		
	}
	
	function getSamRealItems()
	{
		/* thuc hien chuyen gia tri cho getsamland*/
		$tigia =1;
		
		$idElement = 132 ;
		$slht=$this->params->get('bdslqhienthi');
		$proid=JFactory::getURI()->getVar("proid");	
		$db =& JFactory::getDBO();
		$query  = "SELECT * FROM #__jea_properties WHERE id = $proid";
		$db->setQuery($query);
		$result = $db->loadObjectList();		
		foreach ($result as $row)
		{
			$id = $row->id;			
			$keyarea_id=$row->area_id;		
			$keyvnprice=$row->price;		
		
			if($this->params->get('bdslqtown')==1)
			{
				$keytown_id= $row->town_id;
			}
			else
			{
				$keytown_id=0;
			}
			
			if($this->params->get('bdslqkind')==1)
			{
				$keyskind_id=$row->kind_id;
			}
			else
			{
				$keyskind_id=0;
			}
			
			if($this->params->get('bdslqtype')==1)
			{
				$keystype_id=$row->type_id;	
			}
			else
			{
				$keystype_id=0;
			}
		}
			

		if($this->params->get('bdslqkhoanggia')!=NULL)
		{
			$khoanggia=$this->params->get('bdslqkhoanggia');
			
		}	
		
		
		@$RowSam = getSamLand($keytown_id, $keykind_id, $keytype_id, $tigia, $slht,
    				$id, $khoanggia, $keyarea_id, $realtor , $price );
		return $RowSam;
	}
	
	function getList($params)
	{
		$style=$params->get('style','emphasis');
		
		$idKind=explode(',',trim($params->get('idKind')));
		$order_by=$params->get('order_by','ordering');
		$paging=$params->get('paging','0');
		$number_per_page=$params->get('number_per_page','5');
		$number_to_display=$params->get('number_to_display','10');
		$idKindStr="";
		$idPaging=$params->get('idPaging');
		$select = modJeaEmphasisHelper::getBaseSelectSQL();
		
		$where=" WHERE tp.published=1  ";		
		if($style=="emphasis")
		{
			$where.=" AND tp.emphasis=1 AND tp.success = 0 ";
		}
		else if($style=="newsest")
		{
			$where.=" AND tp.newsest=1 AND tp.success = 0 ";
		}
		else if($style=="byKind")
		{
			$where .= ' AND (tp.kind_id='. implode( ' OR tp.kind_id=',$idKind ).') AND tp.success = 0 ';
		}
		else if ($style == "byRealtor")
		{
			$realtorId = $params->get( 'realtor_id', 0 );
			$where .= " AND (tp.realtor_id='" . $realtorId . "') AND tp.success = 0";
		}
		else if ($style == "sameItems")
		{
			$RowSam = modJeaEmphasisHelper::getSamRealItems();	
			$rows = $RowSam['rows'];
			$RowSam['TotalPage'];			
			require(JModuleHelper::getLayoutPath('mod_jea_emphasis'));			
			return ;
		}
		else if ($style == "successfulItems")
		{
			$where .= " AND (tp.success=1) ";
		}
		else if($style=="byType")
		{	
			$where .= ' AND (tp.type_id='. implode( ' OR tp.type_id=',$idKind ).') AND tp.success = 0 ';
		}
		
		$where.=" ORDER BY $order_by DESC " ;
		$sql = $select. $where;	
		$db =& JFactory::getDBO();
		$db->setQuery($sql, 0, $params->get('number_to_display') );
		$rows = $db->loadObjectList();
		if ( $db->getErrorNum() ) {
			JError::raiseWarning( 200, $db->getErrorMsg() );
		}
		return $rows;
	}
	
	/*
	 * Chau add: build base select sql
	 */
	function getBaseSelectSQL()
	{
		$fields = 'tp.id, tp.ref, tp.is_renting ,tp.price AS price, tp.living_space, tp.land_space, tp.advantages,tp.price_unit,tp.price_area_unit, '
		.  'tp.phuongxa AS phuongxa, tp.duongpho AS duongpho, tp.ordering AS ordering,tp.description AS `description`, td.value AS `department`,
		tp.address as address, ts.value AS `slogan`, tt.value AS `type`, '
		.  'tto.value AS `town`,area.value AS `area`, tp.date_insert AS date_insert,tp.kind_id, tp.emphasis AS emphasis' ;
		//Joomfish compatibility:
		$fields .= ', td.id AS `id2`, ts.id AS `id3`, tt.id AS `id4`, tto.id AS `id5` ' ;

		$select = 'SELECT ' . $fields .' FROM #__jea_properties AS tp'. PHP_EOL
		. 'LEFT JOIN #__jea_departments AS td ON td.id = tp.department_id'. PHP_EOL
		. 'LEFT JOIN #__jea_slogans AS ts ON ts.id = tp.slogan_id'. PHP_EOL
		. 'LEFT JOIN #__jea_types AS tt ON tt.id = tp.type_id'. PHP_EOL
		. 'LEFT JOIN #__jea_towns AS tto ON tto.id = tp.town_id'. PHP_EOL
		. 'LEFT JOIN #__jea_areas AS area ON area.id = tp.area_id'. PHP_EOL;

		return $select;
	}
	
	function getComponentUrl ( $id=0,$itemid )
	{
		
//		$url = 'index.php?option=com_jea&view=properties&Itemid=' . JRequest::getInt('Itemid', 0 ) ;
		$url = 'index.php?option=com_jea&view=properties' ;
			
		if ( $id ) {
			$url .= '&Itemid='. intval( $itemid ). '&id=' . intval( $id ) ;
		}


			
		return JRoute::_( $url );
	}

	function getItemImg( $id=0 )
	{
		if ( is_file( JPATH_ROOT.DS.'images'.DS.'com_jea'.DS.'images'.DS.$id.DS.'min.jpg' ) ){

			return JURI::root().'images/com_jea/images/'.$id.'/min.jpg' ;
		}

		return false;
	}

	function reFormatPrice($price, $price_unit)
	{
		// only VND format or price is 0
		//	if ($price_unit != "VND" || intval($price) == 0)
		//	{
		//		return $price;
		//	}
		if (intval($price) == 0)
		{
			return $price;
		}


		// if price is 0 ==> return 0;

		// trim decimal part after "."
		$dec_sepa = strpos($price, ".", 0);
		if ($dec_sepa > 0)
		{
			$price = substr($price, 0, $dec_sepa);
		}

		$result = "";
		$length = strlen($price);
		$price_str_arr = array("", "ngàn", "triệu", "tỷ");
		$str_ind = 0;
		$i = $length;

		while ($i > 0)
		{
			$temppos = $i - 3;
			if ($temppos < 0)
			{
				$temppos = 0;
			}
			$tempstr = substr($price, $temppos, $i - $temppos);

			$tempstr = intval($tempstr);

			if ($tempstr > 0)
			{
				$result = $tempstr . " " . $price_str_arr[$str_ind] . " " . $result;
			}
			$str_ind ++;

			$i = $temppos;
		}
		return $result;
	}
	function formatPrice ( $price , $default="" )
	{
		if ( !empty($price) ) {

			//decode charset before using number_format
			$charset = 'UTF-8';

			$decimal_separator = modJeaEmphasisHelper::getComponentParam('decimals_separator' , ',');
			$thousands_separator = modJeaEmphasisHelper::getComponentParam('thousands_separator', ' ');
			$currency_symbol = modJeaEmphasisHelper::getComponentParam('currency_symbol', '&euro;');
			$symbol_place = modJeaEmphasisHelper::getComponentParam('symbol_place', 1);

			jimport('joomla.utilities.string');
			if (function_exists('iconv')) {
				$decimal_separator   = JString::transcode( $decimal_separator , $charset, 'ISO-8859-1' );
				$thousands_separator = JString::transcode( $thousands_separator , $charset, 'ISO-8859-1' );
			} else {
				$decimal_separator   = utf8_decode( $decimal_separator );
				$thousands_separator = utf8_decode( $thousands_separator );
			}

			$price = number_format( $price, 0, $decimal_separator, $thousands_separator ) ;

			//re-encode
			if (function_exists('iconv')) {
				$price = JString::transcode( $price, 'ISO-8859-1', $charset );
			} else {
				$price = utf8_encode( $price );
			}

			//is currency symbol before or after price?
			if ( $symbol_place == 1 ) {
					
				return htmlentities( $price .' '. $currency_symbol, ENT_COMPAT, $charset );

			} else {
					
				return htmlentities( $currency_symbol .' '. $price, ENT_COMPAT, $charset );
			}

		} else {

			return $default ;
		}
	}

	function getAdvantages( $advantages=""  )
	{
			
		if ( !empty($advantages) ) {
			$advantages = explode( '-' , $advantages );
		}

		$sql = "SELECT `id`,`value` FROM #__jea_advantages" ;

		$db = & JFactory::getDBO();
		$db->setQuery($sql);
		$rows = $db->loadObjectList();

		$temp = array();

		foreach ( $rows as $k=> $row ) {

			if ( in_array($row->id, $advantages) ) {
				$temp[] =  $row->value;
			}
		}

		return implode(',', $temp);
	}

	function displayList($list)
	{
		if (count($lists) > 0)
		{
			echo '<table width="100%" cellpadding="0" cellspacing="0">';

			$k=0;
			$dem = 0;

			foreach($lists as $list)
			{
				$k++;
				$dem++;
				if($k==1)
				{ 	echo "<tr>";
				if ($dem < 3)
				{
					echo "<td width='50%' valign='top' class='border_right1'>";
				}
				else
				{
					echo "<td width='50%' valign='top' style='border-top:1px solid silver;' class='border_right1'>";
				}
				}
				else
				{
					if ($dem < 3)
					{
						echo "<td width='50%' valign='top' class='border_right2'>";
					}
					else
					{
						echo "<td width='50%' valign='top' style='border-top:1px solid silver;' class='border_right2'>";
					}
				}
				//				if($list==null)
				//					continue;
				modProjectGroupHelper::renderGroupProject($list[0]);// ten nhom du an
				echo "<table border='0'>";
				$i=0;
				foreach($list as $project)
				{
					echo "<tr><td>";
					if($i==0)
					{
						modProjectGroupHelper::renderProjectNew($project);
						$i=1;
					}
					else
					modProjectGroupHelper::renderProject($project);
					echo "</tr></td>";
				}
				echo "<tr><td class='link_show_all'><a href='" . modProjectGroupHelper::getProjectGroupLink($list[0]) . "' > >>Xem tất cả </a></td></tr>";
				echo "</table>";
				echo" </td>";
				if($k==2)
				{
					echo " </tr>";
					$k=0;
				}
			}
			if($k==1)echo " </tr>";
		}
	}

	function renderProjectNew(&$project)
	{
		$link_project= JRoute::_("index.php?option=com_jea&controller=projects&task=view&id=" .$project->project_id);
		require(JModuleHelper::getLayoutPath('mod_jea_projectnews', '_projectNew'));
	}
	function renderGroupProject(&$project_group)
	{
		//$link_project_group= JRoute::_("index.php?option=com_jea&controller=projects&projectGroup=" .$project_group->project_group_id);
		$link_project_group = modProjectGroupHelper::getProjectGroupLink($project_group);
		require(JModuleHelper::getLayoutPath('mod_jea_projectnews', '_projectGroup'));
	}
	function renderProject(&$project)
	{
		$link_project= JRoute::_("index.php?option=com_jea&controller=projects&task=view&id=" .$project->project_id);
		require(JModuleHelper::getLayoutPath('mod_jea_projectnews', '_project'));
	}

	function getProjectGroupLink($project_group)
	{
		// get item id for the menu of project group
		$sql = "SELECT id from jos_menu where name = '" . $project_group->project_group_name . "'";
		$db =& JFactory::getDBO();
		$db->setQuery($sql);
		$itemId = $db->loadResult();
		// end get
			
		return JRoute::_("index.php?option=com_jea&controller=projects&projectGroup="
		. $project_group->project_group_id
		. "&Itemid=" . $itemId);
	}

	function phantrang($paging,$tPage,$number_per_page,$idPaging,$style,$order_by,$measure,$idKind,$ItemidParam)
	{		
		echo "<div  class= \"loading2 \" id=\"loading_$idPaging\"><img src=\"images/loading.gif\"></div>";
		$hienthitrang='';
		echo "<input id='currentnext_$idPaging' type=\"hidden\" name=\"currentnext_$idPaging\" value=\"1\"/>";
		$hienthitrang .=  "<img src=\"./images/button_pre.gif\" alt=\"\" onClick=\"apaging_modJeaEmphasis('$ItemidParam',0,'$idPaging','$number_per_page','$style','$order_by','$tPage','$measure',$idKind )\" style=\"cursor:pointer;color:#0066CC;\">";
		$hienthitrang .= "<span  class=\"text_phantrang\" style=\"color:#FFFFFF ;font-weight: bold; font:12px Arial; vertical-align:top \"id=\"hienthitrang_$idPaging\">&nbsp;1/$tPage </span>";
		$hienthitrang .= "<img style=\"margin-right:10px\" src=\"./images/button_next.gif\" alt=\"\" onClick=\"apaging_modJeaEmphasis('$ItemidParam',1,'$idPaging','$number_per_page','$style','$order_by','$tPage','$measure', $idKind  )\" style=\"cursor:pointer;color:#0066CC; \">";
		return $hienthitrang;
	}
	
	
	/* Get Function paging SamItems */
	function phantrang_SamItems( $TotalPage)
	{	
		$idElement = 132 ;
		$slht=$this->params->get('bdslqhienthi');
		$proid=JFactory::getURI()->getVar("proid");	
		$db =& JFactory::getDBO();
		$query  = "SELECT * FROM #__jea_properties WHERE id = $proid";
		$db->setQuery($query);
		$result = $db->loadObjectList();		
		foreach ($result as $row)
		{
			$id = $row->id;			
			$keyarea_id=$row->area_id;		
			$keyvnprice=$row->price;		
		
			if($this->params->get('bdslqtown')==1)
			{
				$keystown_id=$row->town_id;
			}
			else
			{
				$keystown_id=0;
			}
			
			if($this->params->get('bdslqkind')==1)
			{
				$keyskind_id=$row->kind_id;
			}
			else
			{
				$keyskind_id=0;
			}
			
			if($this->params->get('bdslqtype')==1)
			{
				$keystype_id=$row->type_id;	
			}
			else
			{
				$keystype_id=0;
			}
		}
			

		if($this->params->get('bdslqkhoanggia')!=NULL)
		{
			$khoanggia=$this->params->get('bdslqkhoanggia');
			
		}	
	
		echo "<div  class= \"loading2 \" id=\"loading\"><img src=\"images/loading.gif\"></div>";	
		$hienthitrang='';
		echo "<input id='currentnext_$id' type=\"hidden\" name=\"currentnext_$id\" value=\"1\"/>";
		$hienthitrang .=  "<img src=\"./images/button_pre.gif\" alt=\"\" onclick=\"return bdsphantrang($keystown_id ,$keyskind_id,$keystype_id,$keyvnprice,$slht,$id,$khoanggia,$keyarea_id,$TotalPage,0,$idElement)\" />";
		$hienthitrang .= "<span  class=\"text_phantrang\" style=\"color:#FFFFFF ;font-weight: bold; font:12px Arial; vertical-align:top \"id=\"hienthitrang_$id\">&nbsp;1/$TotalPage </span>";
		$hienthitrang .= "<img style=\"margin-right:10px\" src=\"./images/button_next.gif\" alt=\"\" onclick=\"return bdsphantrang($keystown_id ,$keyskind_id,$keystype_id,$keyvnprice,$slht,$id,$khoanggia,$keyarea_id,$TotalPage,1,$idElement)\" />";
		return $hienthitrang;	
	}
	
	/* chuyển đổi tiền tệ bằng ajax */
	function getprice($donvi,$donvidat,$money)
	{
		$db =& JFactory::getDBO();
//		(int)$donvi=$row->price_unit;
		$query  = "SELECT id FROM #__jea_price_units where id='$donvi'";
		$db->setQuery($query);
		$result = $db->loadObjectList();
		Global $PriceUnit;
		foreach ($result as $rowa)
		{
			$PriceUnit= $rowa->id;
		}

//		(int)$donvidat=$row->price_area_unit;
		$query  = "SELECT id FROM #__jea_price_area_units where id='$donvidat'";
		$db->setQuery($query);
		$resulta = $db->loadObjectList();
		//	print_r($result);
		foreach ($resulta as $rowb)
		{
			$PriceAreaUnit=$rowb->id;
		}
		switch($PriceUnit)
		{
			case 2 : $donvitien=" USD";
			break;
			case 1 : $donvitien="";
			break;
			case 3 : $donvitien=" lượng";
			break;
			default: $donvitien="";
			break;
		}
		switch(@$PriceAreaUnit)
		{
			case 1 : $donvidat="m<sup>2</sup>";
			break;
			case 2 : $donvidat="";
			break;
			case 3 : $donvidat="tháng";
			break;
			default: $donvidat="";
			break;
		}

		
			$ddgia=modJeaEmphasisHelper::reFormatPrice($money,$PriceUnit);
			
			if($money > 0)
			{
				if($donvidat !="")
					$dx="/";	
				else
					$dx="";
				$hientien ="<strong>".trim($ddgia.$donvitien).$dx.$donvidat."</strong>";
			
				
			}
			else
			{
				$hientien =  "<strong>Thương lượng</strong>";
			}
			return $hientien;
	}
	function getAjaxButton($price_unit,$area_unit,$money,$div_id)
	{
						$db =& JFactory::getDBO();
				$query  = "SELECT * FROM #__jea_price_units ORDER BY ordering";
				$db->setQuery($query);
				$result = $db->loadObjectList();
				$i=0;
				Global $PriceUnit;
				foreach ($result as $row)
				{
					if($row->id==$PriceUnit)
					{
						$tigia= $row->rate;
					}
					$rate[$i]= $row->rate;
					$i++;
				}
				
	
				$tgvnd=$rate[0];
				$tgusd=$rate[1];
				$tgsjc=$rate[2];

		
				$vnprice= trim(reFormatPrice(changePrice($money,$tigia,$tgvnd),$PriceUnit));
				$usdprice= reFormatPrice(changePrice($money,$tigia,$tgusd),$PriceUnit);
				$sjcprice= reFormatPrice(changePrice($money,$tigia,$tgsjc),$PriceUnit);
		
				switch($area_unit)
					{
						case 1 : $donvidat="m<sup>2</sup>";
						break;
						case 2 : $donvidat="";
						break;
						case 3 : $donvidat="tháng";
						break;
						default: $donvidat="";
						break;
					}
					
					
				switch($price_unit)
					{
						case 1 : $liac1="ac";
						break;
						case 2 : $liac2="ac";
						break;
						case 3 : $liac3="ac";
						break;
					}
				echo " <div class=\"tiente\"><a id=\"vnd_$div_id\" class='$liac1' href=\"javascript:GetChangePrice('1','$vnprice','$usdprice','$sjcprice','$donvidat','$div_id' ) \">VND</a></div>";
				echo " <div class=\"tiente\"><a id=\"usd_$div_id\" class='$liac2' href=\"javascript:GetChangePrice('2','$vnprice','$usdprice','$sjcprice','$donvidat','$div_id') \">USD</a></div>";
				echo " <div class=\"tiente\"><a id=\"sjc_$div_id\"  class='$liac3' href=\"javascript:GetChangePrice('3','$vnprice','$usdprice','$sjcprice','$donvidat','$div_id') \">SJC</a></div>";
	}
	
	
	


}
