<?php
defined('_JEXEC') or die('Restricted access');
require_once('libraries/com_u_re/php/config.php');
require_once('libraries/com_u_re/php/common_utils.php');
class mod_project_slideshowHelper
{  
  function getProject(&$params)
  {
	$returnField = U_ReConfig::getValueByKey( 'SLIDESHOWIMAGE', 'slide_show_list_return_field' );
	$limit = U_ReConfig::getValueByKey('SLIDESHOWIMAGE', 'list_limit');
	$orderby = U_ReConfig::getValueByKey('SLIDESHOWIMAGE','orderby');
	$limitstart =& JRequest::getVar('limitstart', 0);
	$page = ( $limitstart + $limit )/$limit ;
	
	$language = ilandCommonUtils::getLanguage();
	$DBConfig = ilandCommonUtils::getSiteDBConfig();
	$conditionParams =  ' hien_thi_ra_ngoai=1 AND noi_bat=1 ';											   
	$rows = iland4_layDanhSachDuAn($DBConfig, $returnField, $conditionParams , $page, $limit, $orderby, $language);
													   
	return $rows[3];
  }

  //tieu de project
	function getProjectValueTitle( $params)
	  {
	  	$rows = mod_project_slideshowHelper::getProject($params);
	  	$textlengt = U_ReConfig::getValueByKey('SLIDESHOWIMAGE', 'textlengt');
	  	
	  	$newlines = array("\r\n", "\n", "\r");
	  	$htmlist  = array();
	 	$htm ='';
	 	$tieude ='';
	 	$imglink ='';
	 	$i=0;
	 	$showimage= '';	 
	 	$title='';	
	 	$id ='';
		foreach($rows as $a)
		{
			$slide_image_path = U_ReConfig::getValueByKey( 'IMAGE', 'project_image_path' );
			$slide_base_path = 'index.php?option=com_u_re&controller=projects&task=view';
			$Pro_Item = mod_project_slideshowHelper::GetItemId( $a['loai_du_an_id'] );
   			$link = JRoute::_($slide_base_path."&Itemid=".$Pro_Item."&id=" .$a['id']);
   			$link_id = "&Itemid=".$Pro_Item."&id=" .$a['id'];
   			$imglink .= '##';
   			$imglink .= $link_id;
   			$htm .= '##';
   			$tieude .= '##';
			$tieude .= strip_tags($a['ten']);
			$tieude .= "@#$%^&";
			$tieude .= $a['id'];
			
			$tieude .= "@#$%^&";
			$tieude .=	JRoute::_($slide_base_path."&Itemid=".$Pro_Item."&id=" .$a['id']);
			
			$title .= '##';
		//	$title .= strip_tags($a['ten']);
				$title .= "<a href='$link'>".strip_tags($a['ten'])."</a>";
			
			$id .= '##';
			$id .= $a['id'];
			if(strlen (strip_tags($a['mo_ta_ngan'])) >= $textlengt )
				{
					$text =	str_replace($newlines,' ',strip_tags( stripslashes($a['mo_ta_ngan'])));
					$htm .= ilandCommonUtils::getcutstr($text,$textlengt,$tail="...");
					
				}
			else
				{
					$htm .= str_replace($newlines,' ',strip_tags( stripslashes($a['mo_ta_ngan'])) );
				}
			$htm .= "<br/>";
			
			// lay hinh
			$showImageLink = JPATH_ROOT.DS.$slide_image_path.DS.$a['id'].DS.'preview.jpg';
			$showimage .= '##';
			if( is_file( $showImageLink ))
		  	{
		  		$showimage .= $slide_image_path.DS.$a['id'].DS.'preview.jpg' ;  
		  	}
		  	else
		  	{
		  		$showimage .= 'images/noimage.jpg';
		  	}
		  			  
			$i++;			
		}		
		
		$htmlist['title'] = $title;
		$htmlist['image'] = $showimage;
		$htmlist['link'] = $imglink;
		$htmlist['value'] = $htm;
		$htmlist['tieude'] = $tieude;
		$htmlist['id'] = $id;
		
	    return $htmlist;
	  }

	
	  function GetItemId(&$loai_du_an_id)
	  {
		   switch ( $loai_du_an_id )
		     {
				case 1 : $Pro_Item = 31;
				break;
				case 2 : $Pro_Item = 32;
				break;
				case 3 : $Pro_Item = 33;
				break;
				case 4 : $Pro_Item = 95;
				break;
				case 5 : $Pro_Item = 96;
				break;
				case 6 : $Pro_Item = 97;
				break;
				case 7 : $Pro_Item = 98;
				break;
				default : $Pro_Item = 31;
	    	 }
			return $Pro_Item;
	  }
	  
	  /* lay thong tin tu bai viet */
	  function getsession()
	  {
	  	$sessionvalue = U_ReConfig::getValueByKey('SLIDESHOWIMAGE', 'showstatus');
	  	$sectionid = U_ReConfig::getValueByKey('SLIDESHOWIMAGE', 'session');
	  	$catid = U_ReConfig::getValueByKey('SLIDESHOWIMAGE', 'categories'); 
        $list_limit = U_ReConfig::getValueByKey('SLIDESHOWIMAGE', 'list_limit');
        $textlengt = U_ReConfig::getValueByKey('SLIDESHOWIMAGE', 'textlengt');
         
        $limit = U_ReConfig::getValueByKey('SLIDESHOWIMAGE', 'list_limit');
        
	  	$lists  = array();
	  	$i   = 0;
		$db =& JFactory::getDBO();
		$query  = "SELECT * FROM #__content WHERE state = '1'  ";
		if($sessionvalue == 2)
		{
			$query  .= " AND sectionid = $sectionid ";		
		}
		else if($sessionvalue == 3)
		{
			$query  .= " AND catid = $catid ";
		}
		$query  .= " ORDER BY created DESC, modified ";
        $db->setQuery($query, 0, $list_limit);
		$rows = $db->loadObjectList();	
                foreach ( $rows as $row )
                {
	                    $img_url="";
	                    $introtext=$rows[$i]->introtext;
	                    $find_img=strpos($introtext,"img");
	                    if ($find_img)
	                    {
	                      $end_img=strpos($introtext,"src=",$find_img);
		                      if ($end_img)
		                      {
		                        $j=$end_img;
			                        while (($introtext[$j]!='"')||($j<count($introtext)))
			                        {
				                          $img_url.=$introtext[$j];
				                          $j++;
				                          if ($img_url=="src=")
				                          {
				                            $img_url="";
				                            $j++;
				                          } 
			                        }
		                      } 
	                     }
	                     if(empty($img_url))
	                     {
	                     	$img_url='images/noimage.jpg';
	                     }
	                     
	                     
                      $lists[$i]->image = $img_url;
                      $lists[$i]->id=$row->id;
                      $lists[$i]->title=strip_tags($row->title);
                      $lists[$i]->introtext = strip_tags(trim($row->introtext));
                      $i++;
                }
                 return $lists;
	 	 }

	function getSessionvalue()
	{
		$lists= mod_project_slideshowHelper::getsession();
		$limit = U_ReConfig::getValueByKey('SLIDESHOWIMAGE', 'list_limit');
		$textlengt = U_ReConfig::getValueByKey('SLIDESHOWIMAGE', 'textlengt');
		 
		$getimg ='';
		$htmlist  = array();
	 	$imglink ='';
	 	$layhinh = '';
		for($i=0; $i < $limit ;$i++)
		{
			$newlines = array("\r\n", "\n", "\r");
			$id = $lists[$i]->id;
			$link = JRoute::_('index.php?option=com_content&view=article&Itemid=20&id='.$id);
			$imglink .= '##';
			$imglink .= $id;
			$layhinh .= '##';
			$layhinh .= $lists[$i]->image;
			$getimg .='##';
			$getimg .= "<font size=\"3\"><strong><a href=\"$link\">".$lists[$i]->title."</a></strong></font><br/>";
			if(strlen ($lists[$i]->introtext) >= $textlengt )
				{
					$text =	str_replace($newlines,' ',strip_tags( stripslashes($lists[$i]->introtext)));
					$getimg .= ilandCommonUtils::getcutstr($text,$textlengt,$tail="...");
					
				}
			else
				{
					$getimg .= str_replace($newlines,' ',strip_tags( stripslashes($lists[$i]->introtext)) );
				}
				$getimg .= "<br/>";
		}
		$htmlist['image'] = $layhinh;
		$htmlist['value'] = $getimg;
		$htmlist['link'] = $imglink;
		
		return $htmlist;
	}

	/* phan lay tin tức mới */
	function getacticle()
	  {
	  	$lists= mod_project_slideshowHelper::getsession();
	  	$limit = U_ReConfig::getValueByKey('SLIDESHOWIMAGE', 'list_limit');
	    $db =& JFactory::getDBO();
	  	$query  = "SELECT id, title, introtext FROM #__content WHERE state = '1'  ";
	  	$query .= " AND sectionid=1";
	  	$query  .= " ORDER BY created DESC, modified ";
	    $db->setQuery( $query, 0, $limit );
	    $rows = $db->loadObjectList();
	    return $rows;
	  }
	function getnew()
	{
		$rows= mod_project_slideshowHelper::getacticle();
		$htm ='';
		$act = array();
		foreach ($rows as $row)
		{
			$title =	ilandCommonUtils::getcutstr($row->title,80,$tail="...");
			$htm .= "<a href='index.php?option=com_content&view=article&id=$row->id&Itemid=20'>".$title."</a>";
			$htm .="##";
		}
		$act['title'] = $htm ;
		$act['num'] = count($rows);		
		return $act;
	}
	
}

?>
