<?php
defined('_JEXEC') or die('Restricted access');
class modProjectGroupHelper
{  
	function getImageProject($project_id)
	{
		$baseurl = JURI::base();
		$path_image = $baseurl."images/com_jea/images/Plan_" . $project_id . "/preview.jpg";
		return $path_image;
	}
	function  _buildQuery(&$project_group_id,&$num_project)
	{
		$query = "SELECT pg.id AS project_group_id, pg.value AS project_group_name, p.id AS project_id, p.value AS project_name, p.short_desc 
					FROM jos_jea_project_group pg, jos_jea_projects p 
					WHERE p.published = 1 AND pg.published = 1 AND p.project_group_ids LIKE '%," . $project_group_id . ",%'
					AND pg.id=" . $project_group_id . " ORDER BY start_date DESC LIMIT 0," . $num_project;
		return $query;
	
	}
	function _checkProjectGroupID(&$project_group_id)
	{
	
		$filter = explode(',',$project_group_id);
		$filter2 = array();
		$i=0;
		foreach($filter as $item)
		{
			if(is_numeric($item))
				$filter2[$i++]=$item;
		}
		$str_project_group_ID = implode(',',$filter2);
		if(empty($str_project_group_ID))
			return null;
	
		$query ="SELECT id FROM jos_jea_project_group where id in(".$str_project_group_ID.")";
		$db =& JFactory::getDBO();
		$db->setQuery($query);
		$listID=$db->loadObjectList();
		$pro_gr_id=array();
		$i=0;
		foreach ($listID as $list)
		{
			$pro_gr_id[$i++] = $list->id;
			
		}
    	return $pro_gr_id;
		
	}
	
  function _getProjectGroupID()
  {
  	 $query = "SELECT id FROM jos_jea_project_group";
 	 $db =& JFactory::getDBO();
	 $db->setQuery($query);
	 $listID=$db->loadResultArray(); 
	 return $listID;	 
  }
  
  function _getDataProjectGroup(&$p_g_id,&$num_project)
  {
  	 $db =& JFactory::getDBO();
	 $n=count($p_g_id);
	 $rows = array();
	   //	$rows = array();
	  	for($i=0;$i<$n;$i++)
	  	{
	  		 $query= modProjectGroupHelper::_buildQuery($p_g_id[$i],$num_project);
	  		 $db->setQuery($query);//$items
	  		 $row =$db->loadObjectList();
	  		 if(count($row))
	  		 	$rows[$i] = $row;
	  	}
	  	 return $rows;
  }
  
  function getProjectGroup(&$params)
  {
  	$project_group_id = trim($params->get('P_G_ID'));
  	$num_project =  trim($params->get('num_project',1));
  	if(!is_numeric($num_project) || $num_project=='0' || $num_project<=0)
  		$num_project = 1;
  		
  	$p_g_id=modProjectGroupHelper::_checkProjectGroupID($project_group_id);

  	if(count($p_g_id))
  	{
	   $rows = modProjectGroupHelper::_getDataProjectGroup($p_g_id,$num_project);
	   return $rows;
  	}
  	else 
  	{
  		$project_group_id=modProjectGroupHelper::_getProjectGroupID();
 		$rows = modProjectGroupHelper::_getDataProjectGroup($project_group_id,$num_project);
 		return $rows;
  	}


//  	foreach($rows as $row)
//  	{
//    	 echo "<pre>"; print_r($row); echo "</pre";
//    	 break;
//    	 //$list[$i++]=$row;
//  	}

   
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

}
?>