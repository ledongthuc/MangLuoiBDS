<?php

/*
 * Chau: rewrite function formatPrice
 * Format 3 000 000 VND to 3 trieu
 */
function reFormatPrice($price)
{
	$price = str_replace(',','',number_format($price, 2, '.', ''));
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

function changePrice($price, $rate1, $rate2)
{
	$middlePrice = $price * $rate1;
	//return $rate2/$middlePrice;
//	return $middlePrice/$rate2;
	return round($middlePrice/$rate2,2);
}

 /* hoan bat dong san lien quan 2010-10-26 */
    function getSamLand($keytown_id=NULL, $keykind_id=NULL, $keytype_id=NULL, $tigia=NULL, $slht=NULL,
    				$id=NULL, $khoanggia=NULL, $keyarea_id=NULL, $realtor =NULL, $price = NULL, $CurrenPage = NULL)
    {
			
			
				
		$db =& JFactory::getDBO();
        $query  = "SELECT * FROM #__jea_price_units ORDER BY ordering DESC";
        $db->setQuery($query);
		$result = $db->loadObjectList();
		foreach ($result as $row)
			{
				if($row->id==$tigia)
				{
					$tigia= $row->rate;
				}
				$rate[0]= $row->rate;
					
			}
      /* chuyen doi ve tien viet */
       $keyprice= changePrice($price,$tigia,$rate[0]);
		//print_r($keyprice);
			
			
		if( $keyprice > 0)
		{
			$keypricea = $keyprice;
		}
			else
		{
			$keypricea = 1;
		}
			
		if( $keytown_id || $keytype_id || $keykind_id || $khoanggia > 0)
		{
			$sql ="SELECT tp.ref,tp.kind_id,tp.price,tp.type_id, tp.id,tp.price_area_unit,tp.price_unit,
						tp.address, tp.living_space,tp.phuongxa AS phuongxa, tp.duongpho AS duongpho,
						tto.value AS `town`,area.value AS `area`
					FROM #__jea_properties AS tp
					LEFT JOIN #__jea_towns AS tto ON tto.id = tp.town_id
					LEFT JOIN #__jea_areas AS area ON area.id = tp.area_id
					LEFT JOIN #__jea_price_units AS pri ON pri.id=tp.price_unit
					WHERE tp.id <> $id AND tp.success = 0 AND tp.published=1 AND ( ";

				if($keytown_id)
	    		{
	    			$sql .= "  tp.town_id LIKE '%$keytown_id%'";
	    		}
	    		if($keykind_id)
	    		{
	    			if($keytown_id)
	    			{
	    				$sql.=" OR ";
	    			}
	    			$sql .= " kind_id LIKE '%$keykind_id%'";
	    		}
	    		
	   			if($keytype_id)
	    		{
	    			if($keykind_id || $keytown_id ){$sql.=" OR ";}
	    			$sql .= " type_id LIKE '%$keytype_id%'";
	    		}
	    		
	     		if($khoanggia > 0)
	    		{
	    			
	    			if($keytype_id || $keykind_id || $keytown_id ){$sql.=" OR ";}
	       			$sql.=	" ABS( $keyprice - IF( tp.price_unit=1,tp.price,tp.price*pri.rate )) < ( $keypricea * $khoanggia / 100 ) ";
	       		
	       			
	    		}
	    		$sql.=" ) ";
	    		if($realtor)
	    		{
	    			 $sql .= ' AND realtor_id = '.$realtor;
	    		}
		    		$sql.=" GROUP BY tp.id";
		    		$sql.=" ORDER BY IF( tp.price_unit=1,tp.price,tp.price*pri.rate )";
				$result = array();
				$db->setQuery ($sql);
				
				$numrows = $db->loadObjectList() ;
				$result['TotalPage'] = ceil(count($numrows)/$slht);

				if(isset($CurrenPage))
				{
					$bd= $CurrenPage * $slht - $slht;
					$db->setQuery($sql,$bd,$slht);
				}
				else
				{
					$db->setQuery ( $sql,0,$slht );
				}
				$result['rows'] = $db->loadObjectList();
				//print_r($sql);
				return $result;
	  	 }
    }
	
	function getSelectBox($language, $table, $name,$title,$checked,$onchange=NULL,$Town_id =NULL, $style=NULL, $class = NULL)
	{
		switch ( $table )
		{
			case 'jea_kind' : $rows = getKindList(getSiteConfig(), $language);
			break;
			case 'jea_legal' : $rows = getLegalList(getSiteConfig(), $language);
			break;
			case 'jea_position' : $rows = getPositionList(getSiteConfig(), $language);
			break;
			case 'jea_direction' : $rows = getDirectionList(getSiteConfig(), $language);
			break;
			case 'jea_area_unit' : $rows = getAreaUnitList(getSiteConfig(), $language);
			break;
			case 'jea_type' : $rows = getTypeList(getSiteConfig(),$language);
			break;
			case 'jea_town' : $rows = getTownList(getSiteConfig(), $language);
			break;
			case 'jea_area' : $rows = getAreaList(getSiteConfig(), $Town_id, $language);
			break;
			case 'jea_project_type' : $rows = getProjectTypeList(getSiteConfig(), $language);
			break;
			
		}
		if( empty($class))
		{
			$class = "class='inputbox'";
		}
		
		$html ='';
		$html .= "<select name='$name' id='$name'  $onchange  $class  $style >";
	
		if( !empty ( $title ))
		{
			$html .= "<option value='0'>$title</option>";
		}
		
		foreach ( $rows as $row )
		{
			$selected = '';
			$selected = ( $row[0]==$checked ) ? 'selected = selected':'';
			$html .= "<option  value=$row[0] $selected >$row[1]</option>";
		}
		$html .= "</select>";
		return $html;
	}
	
	function getSelectAdvantage($language, $advantage)
	{
		$html = '';
		$rows = getAdvantageList(getSiteConfig(), $language);
		$advantages = array();
		if ( !empty( $advantage ) )
		{
            $advantages = explode( '-' , $advantage );
        }
	
        foreach ( $rows as $k=> $row )
		{
            $checked = '';
            if ( in_array($row[0], $advantages) )
			{
                $checked = 'checked="checked"' ;
            }
		
			$html .= '<label class="advantage">' . PHP_EOL
                  .'<input type="checkbox" id="advantages[' . $k . ']" name="advantagedValue" value="'
                  . $row[0] . '" ' . $checked . ' />' . PHP_EOL
                  . $row[1] . PHP_EOL
                  . '</label>' . PHP_EOL ;
			
        }
        return $html;
								  
	}
	
	 /* lay thong tin cua site */
	 function getSiteConfig()
	 {
		$app =& JFactory::getApplication();
		
	 	$site=array();
		$site[]= $app->getCfg('host');  //outputs database host
		$site[]= $app->getCfg('user'); //outputs database user
		$site[]= $app->getCfg('password'); //outputs site password
		$site[]= $app->getCfg('db'); //outputs database name
		return $site;
	 }
	 
	 
	 /*
	  * Lay ten thu muc template hien tai o fontend
	  */
	 /*
	 function getCurrentTemplate()
	 {
	 	 $app =& JFactory::getApplication();
		 return $app->getTemplate();
	 }
	 */
?>