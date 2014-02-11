<?php
	
	
	function getSelectBox($language, $table, $name,$title,$checked,$onchange=NULL,$Town_id =NULL)
	{	
		switch ( $table )
		{
			case 'jea_kind' : $rows = getKindList($language);	
			break;
			case 'jea_legal' : $rows = getLegalList($language);	
			break;
			case 'jea_position' : $rows = getPositionList($language);	
			break;
			case 'jea_direction' : $rows = getDirectionList($language);	
			break;			
			case 'jea_area_unit' : $rows = getAreaUnitList($language);	
			break;
			case 'jea_type' : $rows = getTypeList($language);	
			break;
			case 'jea_town' : $rows = getTownList($language);	
			break;		
			case 'jea_area' : $rows = getAreaList($Town_id, $language);		
			break;		
			
		}
		
		
		$html ='';		
		$html .= "<select name='$name' id='$name'  $onchange >";
	
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
		$rows = getAdvantageList($language);		
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
                  .'<input type="checkbox" name="advantages[' . $k . ']" value="'
                  . $row[0] . '" ' . $checked . ' />' . PHP_EOL
                  . $row[1] . PHP_EOL
                  . '</label>' . PHP_EOL ;
			
        }		
        return $html;		
								  
	}
	
	
?>