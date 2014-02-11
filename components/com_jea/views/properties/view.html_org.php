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
require_once "components/com_jea/models/realtors.php";

class JeaViewProperties extends JeaView 
{

	function display( $tpl = null )
	{
		// Request category
		$this->cat	= JRequest::getVar('cat', $this->params->get('cat', 'all'));

		$id	= JRequest::getInt('id', 0);
		if(JRequest::getVar('task')=='compare')
		{
			$this->getCompare();
		}
		else
		{
			if( $id ){
				if ($this->getLayout() == 'default'){
					$tpl = 'item';
				}
				$this->getItemDetail( $id );
	
			} else {
	
				$this->getItemsList();
			}
		}
		JHTML::script('jea.js', 'media/com_jea/js/', false);

		parent::display($tpl);
	}


	function getItemsList()
	{
		$res = $this->get('properties');
		jimport('joomla.html.pagination');
		
		$this->pagination = new JPagination($res['total'], $res['limitstart'], $res['limit']);
		$this->assign($res);
	}

	function getItemDetail( $id )
	{
		$row =& $this->get('property');
	    if(!$row->id){
            return;
        }

        // Chau add: get realtor info
		$realtor = $this->getRealtorById($row->realtor_id);
		
		$this->assignRef('realtor', $realtor);
		if (empty($row->name_vl) && empty($row->phone_vl) && empty($row->address_vl))
		{

			$row->name_vl = $realtor->name;
			$row->phone_vl = $realtor->phone;
			$row->address_vl = $realtor->address;
			
			$row->realtor_link = array('profile' => $realtor->link['profile'], 
									   'listing' => $realtor->link['listing'] );
			$row->realtor_avatar = @$realtor->image['image']['name'];		
		}
//		else
//		{
//			
//		}
		
		$this->assignRef('row', $row);
		
		$res = ComJea::getImagesById($row->id);
		$this->assignRef('main_image', $res['main_image']);
		$this->assignRef('secondaries_images', $res['secondaries_images']);
		
	  
		$page_title = ucfirst( JText::sprintf('PROPERTY TYPE IN TOWN',
					$this->escape($row->type), $this->escape($row->town)));

		$this->assign( 'page_title', $page_title );
		
		
		$mainframe =& JFactory::getApplication();
		$pathway =& $mainframe->getPathway();
		$pathway->addItem( $page_title );
		
		$document=& JFactory::getDocument();
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

	function getViewUrl ($itemid,$id=0, $params='')
	{
		if ( $id ) {
			$params .= $itemid.'&id=' . intval( $id ) ;
		}
	  
		return JRoute::_( $params );
	}

	function getAdvantageslist()
    {
    	
	   	$db =& JFactory::getDBO();
        $query  = "SELECT advantages FROM #__jea_properties ORDER BY ordering";
       $db->setQuery($query);
		$result = $db->loadObjectList();
		
		foreach ($result as $row)
		{
			$advantages= $row->advantages;
		}

        $html = '';
        $advantages = array();
        
        if ( !empty( $this->row->advantages ) ) {
            $advantages = explode( '-' , $this->row->advantages );
        }
		$query1  = "SELECT * FROM #__jea_advantages";
         $db->setQuery($query1);
		$result1 = $db->loadObjectList();
		
		$have_advantages = false;
		foreach ( $advantages as $id )
		{
			if ( !empty ($id) )
			{
				$have_advantages = true;	
				break;
			}
		}

		if ( $have_advantages == false )
		{
			return '';
		}
		
    	foreach ($result1 as $row)
		{
		
	             $img="&nbsp;";
	            if ( in_array($row->id, $advantages) ) {
	                 $img="<img width=\"12\" height=\"12\" src=\"./images/com_jea/check.gif\" />";
	             }
	        	
					$html .= '<div><label class="advantage">' . PHP_EOL . $row->value . PHP_EOL . '</label>' .PHP_EOL ;
					$html .= '<label class="advantageimg">' .  $img . '</label></div>';
		}
	
		 return $html;
										
    /* hoan 2010-10-6 */
    }
    
	
    function getTrafficMovementList()
    {
   		$db =& JFactory::getDBO();
        $query  = "SELECT trafficmovement FROM #__jea_properties ORDER BY ordering";
        $db->setQuery($query);
		$result = $db->loadObjectList();
		
		foreach ($result as $row)
		{
			$advantages= $row->trafficmovement;
		}
			
        $html = '';

        $advantages = array();
        
        if ( !empty( $this->row->advantages ) ) {
            $advantages = explode( '-' , $this->row->advantages );
        }
		$query1  = "SELECT * FROM #__jea_trafficmovement";// where id IN (1,5,9,10,11,16)";
        $db->setQuery($query1);
		$result1 = $db->loadObjectList();
    	foreach ($result1 as $row)
		{
      	  $img="&nbsp;";
            
            if ( in_array($row->id, $advantages) ) {
                $checked = 'checked="checked"' ;
              $img="<img width=\"12\" height=\"12\" src=\"./images/com_jea/check.gif\" />";
             }           
            $html .= '<label class="advantage">'
				  . $row->value 
				  . '</label>' .PHP_EOL ;
			$html .= '<label class="advantageimg">' .  $img . '</label>';          
        		}
		return $html;
										
    /* hoan 2010-10-6 */
    }
 
  function getlegal_statusList($id)
    {
   		$db =& JFactory::getDBO();
        $query  = "SELECT legal_status FROM #__jea_properties WHERE id = $id ORDER BY ordering";
        $db->setQuery($query);
		$result = $db->loadObjectList();	
	
		foreach ($result as $row)
		{
			$advantages= $row->legal_status;
		
		}
        $html = '';

        if ( !empty( $this->row->advantages ) ) {
            $advantages = explode( '-' ,$advantages );
        }
        else
        {
        	$advantages=array();
        }
		$query1  = "SELECT * FROM #__jea_legal_status";// where id IN (1,5,9,10,11,16)";
        $db->setQuery($query1);
		$result1 = $db->loadObjectList();
    	foreach ($result1 as $row)
		{			
            if ( in_array($row->id, $advantages) ) 
            {             
                     $html .= $row->value;
                     $html .= ". ";
				  
				
            }
            
		}
		  
		return $html;
										
    /* hoan 2010-10-6 */
    }
   
	function getAdvantages( $advantages="" , $format="" )
	{
	  
		if ( !empty($advantages) ) {
			$advantages = explode( '-' , $advantages );
		} else {
			$advantages=array();
		}
	  
		$html = '';

		$model =& $this->getModel();
		$options = $model->getFeatureList('advantages');
		array_shift($options);
	  
		if ( empty($advantages) && $format == 'checkbox' ) {

			foreach ( $options as $k=> $row ) {
				$html .= '<label class="advantage">'
				.'<input type="checkbox" name="advantages[' . $k . ']" value="'. $row->value .'" />'
				. $row->text  . '</label><br />' . PHP_EOL ;
			}
			
		}  else {

			foreach ( $options as $k=> $row ) {
	    
				if ( in_array($row->value, $advantages) ) {
	     
					if ( $format == 'ul' ) {

						$html .=  "\t<li>{$row->text}</li>\n";

					}  else  {

						if ( !isset($count) ){
							$html .= $row->text;
							$count = 1;
						} else {
							$html .= ', ' . $row->text;
						}
					}
				}
			}
			 
			if ( $format == 'ul' ) {
				$html = "<ul>\n{$html}</ul>\n" ;
			}
		}

		// $html .= '<div style="clear:both">&nbsp</div>';
		return $html;
	}

	function getSearchparameters()
	{
		
		$html='';
		$model =& $this->getModel();
		$cat	= JRequest::getCmd('cat', 'all');
		if(JRequest::getVar('catDirect'))
		$cat=JRequest::getVar('catDirect');
		if(JRequest::getVar('searchDirect'))
		$cat='selling';
		$html .= '<strong>Loại Tin: ' . Jtext::_($cat) . '</strong><br />' . PHP_EOL ;

		if( $type_id = JRequest::getInt('type_id', 0) ) {
			$type =& $model->getFeature('types');
			$type->load($type_id);
			$html .= '<strong>' . Jtext::_('Property type') . ' : </strong>'
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
			
			$html .= '<strong>Loại địa ốc: </strong>' . PHP_EOL
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
	//lấy địa chỉ
	function getAdress()
		{
			 $id=$this->row->area_id;						
			$html = '';
			$db =& JFactory::getDBO();
	        $query  = "SELECT * FROM #__jea_areas WHERE id =  $id ";
	        $db->setQuery($query);
			$result = $db->loadObjectList();	
			foreach ($result as $row)
			{
				$html .= $row->value;
			}
			return $html;
		}
	function google()
	{
		
		$key="ABQIAAAALNYzlYJGVjIDOmQ1AbNh7xSalDDeQhNpZXxFfaBEwbtzaPU5uRRu5ea2kr7";
 echo "<iframe width=\"425\" height=\"350\" frameborder=\"0\" scrolling=\"no\" marginheight=\"0\" marginwidth=\"0\" src=\"http://maps.google.com/maps?f=q&amp;hl=en&amp;geocode=&amp;q=sivaganga&amp;ie=UTF8&amp;ll=10.020244,78.5495&amp;spn=0.657464,0.884399&amp;z=10&amp;iwloc=addr&amp;output=embed&amp;s=ABQIAAAALNYzlYJGVjIDOmQ1AbNh7xSalDDeQhNpZXxFfaBEwbtzaPU5uRRu5ea2kr7\">
                            													
.</iframe><br />";
	}
	function activateGoogleMap(&$row, $domId )
	{
	     ($row->phuongxa)? $dauX=' , ' : $dauX ='';
		($this->getAdress())? $dauP=' , ' : $dauP ='';		
		$GetAdress =$row->phuongxa.$dauX.$this->getAdress().$dauP.$row->town;
		
	    #mootools bugfix
	    JHTML::_('behavior.mootools');
		
		$key = $this->params->get('googlemap_apikey', '');
//		$key = "ABQIAAAALNYzlYJGVjIDOmQ1AbNh7xSalDDeQhNpZXxFfaBEwbtzaPU5uRRu5ea2kr7_qLFMB13p-xohu1CzJA";
	    if((!$key) || (!$row->town)) return false;	
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
    showAddress("$GetAdress")   
});

window.addEvent("unload", function(){
    GUnload();   
});
EOD;
        $document->addScriptDeclaration($script);
       
	    return true ;
	}
	
    // Ham minh viet cho chuc nang Compare
function getCompare()
{
	$idCompare=JRequest::getVar( 'sosanh', array(), '', 'array' );
	$model =& $this->getModel();
	$i=0;
	$rows=array();
	/*foreach($idCompare as $id)
	{
	$rows[$i] = $model->getPropertyCompare($id);
	$res = ComJea::getImagesById($id);
	$this->assignRef("main_image_$i", $res['main_image']);
	$this->assignRef("secondaries_images_$i", $res['secondaries_images']);

	$i++;
	}*/
	// lay 2 bien session de so sanh
	$session = &JFactory::getSession();
	//echo "Session: ".$session->get('valueCompare_1');
	
	$rows[0] = $model->getPropertyCompare($session->get('valueCompare_1'));
	$res = ComJea::getImagesById($session->get('valueCompare_1'));
	$this->assignRef("main_image_0", $res['main_image']);
	$this->assignRef("secondaries_images_0", $res['secondaries_images']);
	
	$rows[1] = $model->getPropertyCompare($session->get('valueCompare_2'));
	$res = ComJea::getImagesById($session->get('valueCompare_2'));
	$this->assignRef("main_image_1", $res['main_image']);
	$this->assignRef("secondaries_images_1", $res['secondaries_images']);
	//
	$this->assignRef('row1', $rows[0]);
	$this->assignRef('row2', $rows[1]);
	parent::display('compare');
}
	function GetKeySerch($keyvnprice)
	{
		$slht=$this->params->get('bdslqhienthi');
		$keyarea_id=$this->row->area_id;
		$id=$this->row->id;
			if($this->params->get('bdslqtown')==1)
		{
			$keystown_id=$this->row->town_id;
		}
		else
		{
			$keystown_id=0;
		}
		
		if($this->params->get('bdslqkind')==1)
		{
			$keyskind_id=$this->row->kind_id;
		}
		else
		{
			$keyskind_id=0;
		}
		
	 		if($this->params->get('bdslqtype')==1)
		{
			$keystype_id=$this->row->type_id;	
		}
		else
		{
			$keystype_id=0;
		}
		
//		$keysprice=1;
		
		
			if($this->params->get('bdslqkhoanggia')!=NULL)
		{
			$khoanggia=$this->params->get('bdslqkhoanggia');
		}
	/* nếu giá bằng ko thì nó sẽ bị lỗi do nó hiểu 0 là ko có */	
		$db = & JFactory::getDBO();
		$model =& $this->getModel();
		$sql=$model->getsamland($keystown_id,$keyskind_id,$keystype_id,$keyvnprice,$slht,$id,$khoanggia,$keyarea_id);
		
		return $sql;
	}		
		
	
	function GetShowBDSLQ($keyvnprice)
	{
			$slht=$this->params->get('bdslqhienthi');
			$db = & JFactory::getDBO();
			$sql=$this->GetKeySerch($keyvnprice);
			$db->setQuery ( $sql,0,$slht );
	        $rows = $db->loadObjectList() ;	 
	        return $rows;
	      
	}
		function GetBDSLienQuan($keyvnprice)
		{
	        $rows = $this->GetShowBDSLQ($keyvnprice);
	        foreach($rows as $row)
			{			
				if($row->kind_id == '1')
				{
				$itemid = '&Itemid=10'; 
				}
				elseif($row->kind_id == '2')
				{
				$itemid = '&Itemid=11'; 
				}
				elseif($row->kind_id == '3')
				{
				$itemid = '&Itemid=12'; 
				}
				elseif($row->kind_id == '4')
				{
				$itemid = '&Itemid=13'; 
				}
			}
	 			require_once (JPATH_BASE.DS.'modules'.DS.'mod_jea_emphasis'.DS.'helper.php');
				require_once (JPATH_BASE.DS.'templates'.DS.'iland'.DS.'html'.DS.'mod_jea_emphasis'.DS.'default.php');
		}
	function getBDSLienHe()
	{
		
		?>
	
			<form action="#" method="post" name="frmmaillienhe">		
			
				<label class="maillienhe"  for="contact_email">
					&nbsp;<?php echo JText::_( 'Họ và tên: ' );?><font color="red">*</font>
				</label>			
				<input type="text" name="myName"size="52" /><br />
				<label class="maillienhe" for="my_phone">
					&nbsp;<?php echo JText::_( 'Điện thoại: ' );?><font color="red">*</font>
				</label>	
				<input type="text" name="myPhone" size="52" /><br />				
				<label class="maillienhe" for="contact_email">
					&nbsp;<?php echo JText::_( 'Email: ' );?><font color="red">*</font>&nbsp;&nbsp;&nbsp;&nbsp;
				</label>		
				 	<input type="text" name="myEmail"  size="52" />
				<input type="hidden" name="RedirectLink"  value="<?php echo $_SERVER['REQUEST_URI']; ?>"  /><br />
				
				<label class="maillienhe"  for="maillienhe">
					<?php echo JText::_( 'Lời nhắn: ' );?>
				</label>

					<textarea name="ghichu" cols="48" rows="3"></textarea>

				<br />
				<label class="maillienhe"  for="maillienhe">					
				</label>
					Mua nhà: <input type="checkbox" value="Mua nhà" name="muanha" />
					Xem nhà mẫu: <input type="checkbox" value="Xem nhà mẫu" name="xemnhamau" />
					Đăng ký tư vấn: <input type="checkbox" value="Đăng ký tư vấn" name="dangkytuvan"  />
					
					<div align="left">
					<input type="submit" align="left" name="task_button" class="button" value="<?php echo JText::_('SEND'); ?>" onclick="return maillienhefrmValidate()" />
					&nbsp;&nbsp;&nbsp;&nbsp;<font color="red"> (*) </font><?php echo "là bắt buộc phải có."?>
					</div>
	</form>
			
	
		<?php 
		if(isset($_POST['task_button']))
		{

		$mainframe =& JFactory::getApplication();
		$email=$mainframe->getCfg('mailfrom');					
		$sender=JRequest::getvar('myName', 0);
		$from=JRequest::getvar('myEmail', 0);
		$phone=JRequest::getvar('myPhone', 0);
		$RedirectLink=JRequest::getvar('RedirectLink', 0);		
		$muanha=JRequest::getvar('muanha', 0);
		$xemnhamau=JRequest::getvar('xemnhamau', 0);
		$dangkytuvan=JRequest::getvar('dangkytuvan', 0);
		$tieude= $this->row->ref;
		include_once 'mail.tml.php';
		$sendmail=JUtility::sendMail($from, $sender, $email, $subject, $body);
		if($sendmail)
			{
			echo "<script>alert('Mail của bạn đã được gửi đi...')</script>";
			
			}
		else
			{
			echo "<script>alert('Mail của bạn chưa được gửi đi...')</script>";
			
			}

		}	
		}
	
	/*
	 * Chau:
	 * get realtor of property
	 */ 
	function getRealtorById( $id )
	{
		$realtorModel = new JeaModelRealtors();
		
		$realtorData = $realtorModel->getRowById( $id );
		$realtorData->link = $this->getRealtorLink( $id );
		
		return $realtorData;
	}
	
	function getRealtorLink( $id )
	{
		$link = array();
		$link['profile'] = 'index.php?option=com_jea&controller=realtors&Itemid=118&id=' . $id;
		$link['listing'] = 'index.php?option=com_jea&controller=properties&task=search&Itemid=118&realtor_id=' . $id;
		return $link; 
	}	
	
	/* Hoan phân trang bất động sản liên quan */
	function paging_bds($keyvnprice)
	{
	
		$slht=$this->params->get('bdslqhienthi');
		$keyarea_id=$this->row->area_id;
		$id=$this->row->id;
			if($this->params->get('bdslqtown')==1)
		{
			$keystown_id=$this->row->town_id;
		}
		else
		{
		$keystown_id=0;
		}
		
			if($this->params->get('bdslqkind')==1)
		{
			$keyskind_id=$this->row->kind_id;
		}
		else
		{
		$keyskind_id=0;
		}
		
	 		if($this->params->get('bdslqtype')==1)
		{
			$keystype_id=$this->row->type_id;	
		}
		else
		{
		$keystype_id=0;
		}
		
			if($this->params->get('bdslqkhoanggia')!=NULL)
		{
			$khoanggia=$this->params->get('bdslqkhoanggia');
		
		}
		else
		{
			$khoanggia=0;
		}
		
		
		$db = & JFactory::getDBO();
		$model =& $this->getModel();
		$sql=$model->getsamland($keystown_id,$keyskind_id,$keystype_id,$keyvnprice,$slht,$id,$khoanggia,$keyarea_id);
		$db->setQuery ( $sql );
        $res = $db->loadObjectList() ;	         
		$TotalPage=ceil(count($res)/$slht);
			echo "<input id='currentnext' type=\"hidden\" name=\"currentnext\" value=\"1\"/>";	
			echo "<img src=\"./images/button_pre.gif\" alt=\"\" onclick=\"return bdsphantrang($keystown_id ,$keyskind_id,$keystype_id,$keyvnprice,$slht,$id,$khoanggia,$keyarea_id,$TotalPage,0)\" />";
			echo "<span style=\"color:#FFFFFF ;font-weight: bold;font:13px Arial;padding-left:0px; vertical-align:top \" id=\"hienthitrang\"> 1/$TotalPage </span>";
			echo "<img src=\"./images/button_next.gif\" alt=\"\" onclick=\"return bdsphantrang($keystown_id ,$keyskind_id,$keystype_id,$keyvnprice,$slht,$id,$khoanggia,$keyarea_id,$TotalPage,1)\" />";
	}
	/*lay dia chi  day du */
	function getFullAdress($duongpho,$phuongxa,$quanhuyen,$town)
	{
		 ($duongpho != "")? $dau1 = ", " : $dau1 = "";
	     ($phuongxa != "")? $dau2 = ", " : $dau2 = "";
	     ($quanhuyen != "")? $dau3 = ", " : $dau3 = "";
	     $FullAdress=$duongpho.$dau1.$phuongxa.$dau2.$quanhuyen.$dau3.$town;
	     return $FullAdress;
	}
	
	/* hiện thị tiền tệ dạng botton ajax */
	function getShowAjax()
	{
		$id =  $this->row->id;
 		$price = $this->row->price;
        $unit = $this->row->price_unit;
        $dvdat = $this->row->price_area_unit;
        $ps = $this->row->id;
         $liac1 ='';
          $liac2 ='';
          $liac3 ='';
       	switch($unit)
			{
				case "USD" : $donvitien=" USD";
				$liac2="ac";
				break;
				case "VND" : $donvitien="";
				$liac1="ac";
				break;
				case "SJC" : $donvitien=" lượng";
				$liac3="ac";
				break;
				default: $donvitien="";
				break;					
			}

		switch($dvdat)
			{
				case "m2" : $donvidat="m<sup class='money_sup'>2</sup>";
				break;
				case "Nguyên căn" : $donvidat="";
				break;
				case "Tháng" : $donvidat="tháng";
				break;
				default: $donvidat="";
				break;					
			}			
			
		$gia=reFormatPrice($this->row->price, $this->row->price_unit); 

		if( $gia > 0)
		{
			if($donvidat !="")
				$dx="/";	
			else
				$dx="";
			
			
			$hientien = trim($gia.$donvitien).$dx.$donvidat;		
		}
		else
		{
			$hientien= "Thương lượng";
		}

 	 	echo "<div id='$ps' class=\"mon3\">";
		echo $hientien;
		echo "</div>";			
		if( $gia > 0)
		{
			
        $db =& JFactory::getDBO();
        $query  = "SELECT * FROM #__jea_price_units ORDER BY ordering";
        $db->setQuery($query);
		$result = $db->loadObjectList();									
		$i=0;
			foreach ($result as $row)
			{
				if($row->value==$unit)
				{
					$tigia= $row->rate;
				}
				$rate[$i]= $row->rate;											
					$i++;
			}

        $tgvnd=$rate[0];
        $tgusd=$rate[1];
        $tgsjc=$rate[2];
        Global $keyvnprice;
        $keyvnprice= changePrice($price,$tigia,$tgvnd);
        $vnprice= trim(reFormatPrice(changePrice($price,$tigia,$tgvnd)));                                 
        $usdprice= reFormatPrice(changePrice($price,$tigia,$tgusd));                                 
        $sjcprice= reFormatPrice(changePrice($price,$tigia,$tgsjc));
        //$dvdatenti = htmlentities($donvidat, ENT_QUOTES);
//        echo '<input type="hidden" id="dvdat" value="' . $donvidat.' " />';

        if($dvdat == 'm2')
          {
           $donvidat="m<sup>2</sup>";
          }

		echo " <div class=\"tiente\"><a id=\"vnd_$id\" class='$liac1' href=\"javascript:GetChangePrice('1','$vnprice','$usdprice','$sjcprice','$donvidat','$id' ) \">VND</a></div>";
		echo " <div class=\"tiente\"><a id=\"usd_$id\" class='$liac2' href=\"javascript:GetChangePrice('2','$vnprice','$usdprice','$sjcprice','$donvidat','$id') \">USD</a></div>";
		echo " <div class=\"tiente\"><a id=\"sjc_$id\"  class='$liac3' href=\"javascript:GetChangePrice('3','$vnprice','$usdprice','$sjcprice','$donvidat','$id') \">SJC</a></div>";
		}
	}
	
}
?>


