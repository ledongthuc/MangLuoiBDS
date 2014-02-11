<?php
defined('_JEXEC') or die('Restricted access');
class modEmphasisNewsHelper
{  
  function getEmphasisNews(&$params)
  {
  	
  	$items = $params->get('items', 10);
    $db =& JFactory::getDBO();
   
    $getlanguage =& JFactory::getLanguage();
	$lang = substr($getlanguage->getTag(),0,2);
    
    $sql = "SELECT *  FROM iland4_du_an_".$lang ;  
    $sql .= " WHERE  hien_thi_ra_ngoai = '1' and noi_bat='1' ORDER BY ordering DESC,ngay_dang ";
    
	$db->setQuery($sql, 0, $items );
	$rows = $db->loadObjectList();

    return $rows;
  }
  function GetItemId(&$review)
  {
	   switch ( $review->loai_du_an_id )
	     {
		case 19 : $Pro_Item = 31;
		break;
		case 20 : $Pro_Item = 32;
		break;
		case 21 : $Pro_Item = 33;
		break;
		case 22 : $Pro_Item = 95;
		break;
		case 23 : $Pro_Item = 96;
		break;
		case 24 : $Pro_Item = 97;
		break;
		case 25 : $Pro_Item = 98;
		break;
		default : $Pro_Item = 31;
    	 }
		return $Pro_Item;
  }
  
  function renderEmphasisNews(&$review)
  {

	
	$Pro_Item = modEmphasisNewsHelper::GetItemId($review);
    $link = JRoute::_("index.php?option=com_u_re&controller=projects&task=view&Itemid=".$Pro_Item."&id=" .$review->id);
    
	if (file_exists( 'images/project/' . $review->id . '/min.jpg' )) 
	{
    	$review->image = "images/project/" . $review->id . "/min.jpg";
	}
	else
	{
		$review->image = "images/NoCamera.jpg";
	}	

    
    
    $project_spec = "<div><table><tr><td colspan=2><b>" . $review->ten . "</td></tr><tr>";
    if (file_exists($review->image))
    {
    	// $project_spec .= "<td><img src=" . $review->image . "></td>";
    	$project_spec .= "<td>".$review->image ."</td>";
    }
    $project_spec .= "<td>" . strip_tags($review->mo_ta_ngan) . "</td></tr></table></div>";
    				
    require(JModuleHelper::getLayoutPath('mod_jea_newsfp', '_review'));
  }
  function renderEmphasis(&$review)
  {
	$Pro_Item = modEmphasisNewsHelper::GetItemId($review);
    $link = JRoute::_("index.php?option=com_u_re&controller=projects&Itemid=".$Pro_Item."&task=view&id=" .$review->id);
    
    if (file_exists( 'images/project/' . $review->id . '/preview.jpg' )) 
	{
    	 $review->image = "images/project/" . $review->id . "/preview.jpg";
	}
	else
	{
		$review->image = "images/noimage.jpg";
	}	
   
    
    require(JModuleHelper::getLayoutPath('mod_jea_newsfp', '_emphasis'));
  }

}
?>