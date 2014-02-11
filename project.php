<?php
function getSelectBox($language, $table, $name,$title,$checked,$onchange=NULL,$Town_id =NULL, $style=NULL, $class = NULL)
	{	
		switch ( $table )
		{
			/*
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
			*/
			case 'jea_project_type' : $rows = getProjectTypeList($language);		
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

?>

