<?php
/**
 * This file is part of Joomla Estate Agency - Joomla! extension for real estate agency
 *
 * @version     0.9 2009-10-14
 * @package     Jea.site
 * @copyright	Copyright (C) 2008 PHILIP Sylvain. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla Estate Agency is free software. This version may have been modified pursuant to the
 * GNU General Public License, and as distributed it includes or is derivative
 * of works licensed under the GNU General Public License or other free or open
 * source software licenses.
 *
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

require_once JPATH_COMPONENT.DS.'view.php';

class JeaViewProjects extends JeaView 
{

	function display( $tpl = null )
	{
		$id	= JRequest::getInt('id', 0);
		if( $id ){
				if ($this->getLayout() == 'default'){
					$tpl = 'item';
				}
				$this->getItemDetail( $id );
	
			} else {
	
				$this->getItemsList();
			}
		JHTML::script('jea.js', 'media/com_jea/js/', false);
		// do?n code du?i dây d? load plugin content thay cho parent::display();
		$o = new stdClass();
		$o->text = $this->loadTemplate($tpl);
		JPluginHelper::importPlugin('content');
		$dispatcher = & JDispatcher::getInstance();
		$results = $dispatcher->trigger('onPrepareContent', array (&$o, array(), 0));
		echo $o->text;
	}

	/*
	 * Chau: function get project group name from project group id
	 */
	function getProjectGroupName($project_group_id)
	{
		$sql = "SELECT `value` FROM #__jea_projects WHERE id = '" . $project_group_id . "'";
		$db=JFactory::getDBO();
		$db->setQuery($sql); 
		$rows=$db->loadResult();
		return $rows["value"];
	}
	

	function getItemsList()
	{
		$res = $this->get('projects');
		jimport('joomla.html.pagination');
		
		$this->pagination = new JPagination($res['total'], $res['limitstart'], $res['limit']);
		
		
		// Get project group name
		$project_group_id = JRequest::getInt('projectGroup', 0);
		//$res["project_group_name"] = getProjectGroupName($project_group_id);
		
		if ($project_group_id != 0) {
			$sql = "SELECT `value` FROM #__jea_project_group WHERE id = '" . $project_group_id . "'";
			
			$db=JFactory::getDBO();
			$db->setQuery($sql); 
			$rows=$db->loadResultArray();
			
			$res["project_group_name"] = $rows[0];	
		}
		
		
		$this->assign($res);
	}

	function getItemDetail( $id )
	{
		//$sql =& $this->get('project');
		//echo "id:$id<br>";
		//echo "sql:$sql<br>";
		
		$row =& $this->get('project');
	    if(!$row->id){
            return;
        }
		
		$this->assignRef('row', $row);
		
		$res = ComJea::getImagesById($row->id,true);
		$this->assignRef('main_image', $res['main_image']);
		$this->assignRef('secondaries_images', $res['secondaries_images']);
		
	    // Add list of other projects and the same investor projects
		$listOtherProjects = $this->getListOtherProjects($row->project_group_ids, $row->id);
		$listSameInvestorProject = $this->getListSameInvestorProjects($row->investor, $id);
		$loaihinh = $this->getProject_Group();		  		    
		
		$this->assignRef('listOther', $listOtherProjects);
		$this->assignRef('listSameInvestor', $listSameInvestorProject);
		$this->assignRef('loaihinh', $loaihinh);
		
		
		$document=& JFactory::getDocument();
		if($this->escape($row->page_title) == NULL)
		{
			$page_title = ucfirst( JText::sprintf(
			$this->escape($row->value).', '.$this->escape($row->town)));
		}
		else
		{
			$page_title = ucfirst($this->escape($row->page_title));
		}
		
		if($this->escape($row->page_keywords) != NULL)
		{
			$page_keywords = ucfirst($this->escape($row->page_keywords));
			$document->setMetaData('keywords', $page_keywords );
		}
		
		if($this->escape($row->page_description) != NULL)
		{
			$page_description = ucfirst($this->escape($row->page_description));
			$document->setMetaData('description', $page_description);
		}
						
		$this->assign( 'page_title', $page_title );
	  
		$mainframe =& JFactory::getApplication();
		$pathway =& $mainframe->getPathway();
		$pathway->addItem( $page_title );
		
		$document->setTitle( $page_title ); 
	}


	function getPrevNextItems()
	{
		$model =& $this->getModel();
		$res = $this->get('previousAndNext');
	  
		$html = '';
	  
		$previous =  '&lt;&lt; ' . JText::_('Previous') ;
		$next     =   JText::_('Next') . ' &gt;&gt;' ;
	  
		if ( $res['prev_item'] ) {

			$html .= '<a href="' . $this->getViewUrl($res['prev_item']->id) . '">' . $previous . '</a>' ;
		} else {
			$html .=  $previous ;
		}
		 
		$html .= '&nbsp;&nbsp;&nbsp;&nbsp;' ;

		if ($res['next_item']) {

			$html .= '<a href="' . $this->getViewUrl($res['next_item']->id) . '">' . $next . '</a>' ;
		}  else {
				
		 $html .= $next ;
		}

		return $html;

	}

	function getViewUrl ( $id=0, $params='' )
	{
		if ( $id ) {
			$params .= '&id=' . intval( $id ) ;
		}
	  
		return JRoute::_( $params );
	}
	/* hoan - lấy tên nhóm dự án */
	 function getProject_Group()
	    {
	    	$html = '';
	   		$db =& JFactory::getDBO();
	        $query  = "SELECT id,value FROM #__jea_project_group ORDER BY ordering";
	        $db->setQuery($query);
			$result = $db->loadObjectList();					
			$advantages = explode( ',' ,$this->row->project_group_ids );
			foreach ($result as $row)
			{
				 if ( in_array($row->id, $advantages) ) 
	            {             
	                     $html .= $row->value; 
	                      $html .=', ';                 
					 
	            }
			}
			return $html;			
	   
	    }
	
	function renderProjectLink(&$review)
	{
	    $review->link = JRoute::_("index.php?option=com_jea&controller=projects&Itemid=31&task=view&id=" .$review->id);
	    $review->image = "images/com_jea/images/Plan_" . $review->id . "/min.jpg";
	    $project_spec = "<div><table><tr>";
	    if (file_exists($review->image))
	    {
	    	$project_spec .= "<td><img src=" . $review->image . "></td>";
	    }
	    $project_spec .= "<td>" . strip_tags($review->short_desc) . "</td></tr></table></div>";
	    $review->project_spec = $project_spec;
	}
	
	/*
	 * Get list of projects that belongs to the project group.
	 * Return list of data rows. 
	 */
	function getListOtherProjects($project_group_ids, $id)
	{
		$result = array();
		$project_group_id_arr = explode(",", $project_group_ids);
		$count_project_group_ids = count($project_group_id_arr) - 1;

		$db=JFactory::getDBO();
		$sql = "SELECT id, `value`, short_desc FROM #__jea_projects WHERE id != '" . $id . "' AND (" ;
		for ($i = 1; $i < $count_project_group_ids; $i++)
		{
			if ($i > 1)
			{
				$sql .= " OR ";
			}
			$sql .= " project_group_ids LIKE '%," 
				. $project_group_id_arr[$i] . ",%'";
		}
		$sql .= ")";	
		$db->setQuery($sql);
		$rows=$db->loadObjectList();
		
		// render data
		foreach ($rows as $row)
		{
//			$row->link = JRoute::_("index.php?option=com_jea&controller=projects&task=view&id=" .$row->id);
//			$image = "images/com_jea/images/Plan_" . $row->id . "/min.jpg";
//			$project_spec = "<div><table><tr>";
//		    if (file_exists($image))
//		    {
//		    	$project_spec .= "<td><img src=" . $image . "></td>";
//		    }
//		    $project_spec .= "<td>" . strip_tags($row->short_desc) . "</td></tr></table></div>";
//		    $row->project_spec = $project_spec;
			$this->renderProjectLink($row);
		}		
	
		return $rows;		
		
	}
	
	/*
	 * Get list of projects that have the same investor.
	 * Return list of data rows
	 */
	function getListSameInvestorProjects($project_investor, $id)
	{
		$sql = "SELECT id, `value`, short_desc FROM #__jea_projects WHERE id != '" . $id 
		. "' AND investor = '" . $project_investor . "'"; 
		
		$db=JFactory::getDBO();
		$db->setQuery($sql); 
		$rows=$db->loadObjectList();
		
		// render data
		foreach ($rows as $row)
		{
			$this->renderProjectLink($row);
		}		
		// end render
		
		return $rows;
	}
	
	function getListProjectGroupName($projectGroupIds)
	{
		//echo substr($projectGroupIds,1,strlen($projectGroupIds)-2);
		$sql ="SELECT value FROM #__jea_project_group WHERE id IN (".substr($projectGroupIds,1,strlen($projectGroupIds)-2).")";
		$db=JFactory::getDBO();
		$db->setQuery($sql); 
		$rows=$db->loadObjectList();
		$value="";
		foreach($rows as $row)
			$value.=$row->value.", ";
		return substr($value,0,strlen($value)-2);
	}

	function getSearchparameters()
	{
		
		$html='';
		$model =& $this->getModel();
		$cat	= JRequest::getCmd('cat', '');
		if(JRequest::getVar('catDirect'))
		$cat=JRequest::getVar('catDirect');
		if(JRequest::getVar('searchDirect'))
		$cat='selling';
		$html ="";
//		$html .= '<strong>Loại Dự Án ' . Jtext::_($cat) . '</strong><br />' . PHP_EOL ;

		if( $type_id = JRequest::getInt('projectGroup', 0) ) {
			$type =& $model->getFeature('project_group');
			$type->load($type_id);
			$html .= '<strong>Loại dự án: </strong>'
			. $type->value . '<br />' . PHP_EOL;
		}
	  
		if( $department_id = JRequest::getInt('department_id', 0) ) {
			$department =& $model->getFeature('departments');
			$department->load($department_id);
			$html .= '<strong>' . Jtext::_('Department') . ' : </strong>'
			. $department->value . '<br />' . PHP_EOL;
		}

		if( $town_id = JRequest::getInt('town_id', 0) ) {
			$town =& $model->getFeature('towns');
			$town->load($town_id);
			$html .= '<strong>' . Jtext::_('Town') . ' : </strong>'
			. $town->value . '<br />' . PHP_EOL;
		}
		// In ra tham so Area o trang ket qua tim kiem
		 if( $area_id = JRequest::getInt('area_id', 0) ) {
			$area =& $model->getFeature('areas');
			$area->load($area_id);
			$html .= '<strong>' . Jtext::_('Area') . ' : </strong>'
			. $area->value . '<br />' . PHP_EOL;
		}
		if( $budget_min = JRequest::getFloat('budget_min', 0.0) ) {
			$html .= '<strong>' . Jtext::_('Budget min') . ' : </strong>'
			. $this->formatPrice($budget_min) . '<br />' . PHP_EOL;
		}

		if( $budget_max = JRequest::getFloat('budget_max', 0.0) ) {
			$html .= '<strong>' . Jtext::_('Budget max') . ' : </strong>'
			. $this->formatPrice($budget_max) . '<br />' . PHP_EOL;
		}

		if( $living_space_min = JRequest::getInt('living_space_min', 0, 'jea_search' ) ) {
			$html .= '<strong>' . Jtext::_('Living space min') . ' : </strong>'
			. $living_space_min .' '. $this->params->get( 'surface_measure' ) . '<br />' . PHP_EOL;
		}

		if( $living_space_max = JRequest::getInt('living_space_max', 0, 'jea_search') ) {
			$html .= '<strong>' . Jtext::_('Living space max') . ' : </strong>'
			. $living_space_max .' '. $this->params->get( 'surface_measure' ) . '<br />' . PHP_EOL;
		}

		if( $rooms_min = JRequest::getInt('rooms_min', 0, 'jea_search') ) {
			$html .= '<strong>' . Jtext::_('Minimum number of rooms') . ' : </strong>'
			. $rooms_min . '<br />' . PHP_EOL;
		}

		if(JRequest::getVar('catDirect')==false)
		{
			$arrLoai=array();	
			if(JRequest::getVar('searchDirect'))
			{
				
				$searchDirect=JRequest::getVar('searchDirect');
				if($searchDirect=='datban')
				{
					$arrLoai[0]=7;
					$arrLoai[1]=8;
					$arrLoai[2]=9;
					$arrLoai[3]=10;
					$arrLoai[4]=11;
					
				}
				else
				{
					$arrLoai[0]=1;
					$arrLoai[1]=2;
				}
				$advantages=$arrLoai;
				$options = $model->getFeatureList('types');
			array_shift($options);
			
			$temp = array();
			
			foreach ($options as  $advantage) {
				$temp[$advantage->value] = $advantage->text ;
			}
			
			$html .= '<strong>Lo?i d?a ?c: </strong>' . PHP_EOL
			. '<ul>'. PHP_EOL ;
			
			foreach($advantages as $id){
				if (isset($temp[$id]))
					$html .= '<li>' . $temp[$id] .'</li>' . PHP_EOL ;
			}
			
			$html .= '</ul>' . PHP_EOL ;
			}	
			else
			{
				if ( $advantages = JRequest::getVar( 'advantages', array(), '', 'array' ) )
				{
						$options = $model->getFeatureList('types');
			array_shift($options);
			
			$temp = array();
			
			foreach ($options as  $advantage) {
				$temp[$advantage->value] = $advantage->text ;
			}
			
			$html .= '<strong>Loại địa ốc: </strong>' . PHP_EOL
			. '<ul>'. PHP_EOL ;
			
			foreach($advantages as $id){
				if (isset($temp[$id]))
					$html .= '<li>' . $temp[$id] .'</li>' . PHP_EOL ;
			}
			
			$html .= '</ul>' . PHP_EOL ;
				}
			}
			
		}
		return $html;
	 
	}


	function getHtmlList($table, $title, $id,$selected )
	{
		$model =& $this->getModel();
		$options = $model->getFeatureList($table, $title);
		return JHTML::_('select.genericlist', $options , $id, 'class="inputbox" size="1" ' , 'value', 'text', 2);
	}
	
	function activateGoogleMap(&$row, $domId )
	{
	    #mootools bugfix
	    JHTML::_('behavior.mootools');
		
		$key = $this->params->get('googlemap_apikey', '');
	  
	    if((!$key) || (!$row->address) || (!$row->town)) return false;
	    
	    $document = &JFactory::getDocument();
	    $a_lang = explode('-', $document->getLanguage());
     	 $document->addScript( 'http://maps.google.com/maps?file=api&amp;v=2.x&amp;key=' 
                              . $key . '&amp;hl=' . $a_lang[0] );
       
        $script = <<<EOD
var map = null;
var geocoder = null;
    
function initializeMap() {
    if (GBrowserIsCompatible()) {
        map = new GMap2(document.getElementById("$domId"));
        map.enableScrollWheelZoom();
        map.setCenter(new GLatLng(50, 0), 2);
        map.addControl(new GLargeMapControl());
        map.addControl(new GMenuMapTypeControl());
        geocoder = new GClientGeocoder();
    }
}

function showAddress(address) {
  if (geocoder) {
    geocoder.getLatLng(
      address,
      function(point) {
        if (!point) {
          alert(address + " not found");
        } else {
          map.setCenter(point, 15);
          var marker = new GMarker(point);
          map.addOverlay(marker);
          marker.openInfoWindowHtml(address);
        }
      }
    );
  }
}

window.addEvent("domready", function(){
    initializeMap();
    showAddress("$row->address, $row->town")   
});

window.addEvent("unload", function(){
    GUnload();   
});
EOD;
        $document->addScriptDeclaration($script);
        
	    return true ;
	}
}
