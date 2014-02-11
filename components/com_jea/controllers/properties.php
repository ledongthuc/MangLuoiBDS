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

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class JeaControllerProperties extends JController
{
    
    /**
	 * Custom Constructor
	 */
	function __construct( $default = array() )
	{
		// Set a default view i none exists
		if ( ! JRequest::getCmd( 'view' ) )
		{
			
			JRequest::setVar('view', 'properties' );
		}
		
		//clear search session if there is not a search
		if( ( JRequest::getVar( 'task' ) != 'search' ) &&  ( isset( $_SESSION['jea_search'] ) ) )
		{
			unset( $_SESSION['jea_search'] );
		}
		
		//$this->addModelPath( JPATH_COMPONENT_ADMINISTRATOR.DS.'models' );
		
		
		$id = JRequest::getInt('id', 0);
		
		// Add Filter Order to router (if defined in request parameters)
		// only when we list properties
		if(!$id ) {
			$filter_order = JRequest::getCmd('filter_order');
			if ( $filter_order ) {
				$app	= &JFactory::getApplication();
				$router = &$app->getRouter();
				$router->setVar( 'filter_order', $filter_order);
			}
		}

		parent::__construct( $default );
	}
	
	function search()
	{	
		$session =& JFactory::getSession();
		
		/* kiem tra neu ko phai o trang chu thi se ko chay vao day lan nua
		 * Session van se con...
		 */
		// start debug
//		echo "<pre>";
//		print_r($_GET['limitstart']);
//		echo "</pre>";
//		// end debug
//			if( isset($_POST['Itemid']) && $_POST['Itemid'] == 1)
			
//		{
				$params = array(
				'key_search'       => JRequest::getVar('key_search', ''),
				'project_group_id' => JRequest::getInt('project_group_id', 0),		
				'Itemid'           => JRequest::getInt('Itemid', 0),
				'cat'              => JRequest::getVar('cat', ''),
				'type_id'          => JRequest::getInt('type_id', 0),
				'department_id'    => JRequest::getInt('department_id', 0),
				'town_id'          => JRequest::getInt('town_id', 0),
				'budget_min'       => JRequest::getFloat('gia_tu', 0.0),
				'budget_max'       => JRequest::getFloat('gia_den', 0.0),
				'living_space_min' => JRequest::getInt('dientich_tu', 0),
				'living_space_max' => JRequest::getInt('dientich_den', 0),
				'rooms_min'        => JRequest::getInt('rooms_min', 0),
				'advantages'       => JRequest::getVar('loaidiaoc', array(), '', 'array'),
				'directions'          => JRequest::getInt('directions', 0),
			);

			$session->set('params', $params, 'jea_search');
//		}

			
			if ( JRequest::getVar('catDirect', '') != '')
			{
				$params = array();
				$session->set('params', $params, 'jea_search');
			}
			else 
			{
				$params = $session->get('params', array() , 'jea_search');
			}
			
			
		
		// Bug correction on search pagination
		if ($limit =JRequest::getInt('limit', 0)){
		    
		    $params['limit'] = $limit;
		    
		    $session->set('params', $params, 'jea_search');
		}
		
		if ( !empty($params) )
		{
			JRequest::set( $params , 'POST');
		}
		else
		{
			$params = array('key_search'       => JRequest::getVar('key_search', ''));
			JRequest::set( $params , 'POST');
		}
				
		$this->display();

	}
	
	function ajaxfilter()
	{
		require JPATH_COMPONENT_ADMINISTRATOR . DS. 'library' . DS .'JSON.php' ;
		
		$json = JRequest::getVar('json', '');
		
		$document = & JFactory::getDocument();
		$document->setMimeEncoding('application/json') ;
		
		$jsonService = new Services_JSON(); 
		$post = $jsonService->decode($json);
		
		JRequest::set((array) $post, 'POST');
		
		$model =& $this->getModel('Properties');
		$res = $model->getProperties(true);
	
		$result = array();
		$result['types'][] = array( 'value' => 0, 'text' => '- '. Jtext::_('Property type') .' -' );
		$result['towns'][]   = array( 'value' => 0, 'text' => '- '. Jtext::_('town') .' -' );
		$result['departments'][]   = array( 'value' => 0, 'text' => '- '. Jtext::_('Department') .' -' );
	
		$temp = array();
		$temp['types'] = array();
		$temp['towns'] = array();
		$temp['departments'] = array();
	
		foreach ($res['rows'] as $row){

		    if( $row->type_id && !isset($temp['types'][$row->type_id]) ) {
		            
		            $result['types'][] = array( 'value' => $row->type_id , 'text' =>  $row->type );
		            $temp['types'][$row->type_id] = true;
		    }
		    
		    if($row->town_id && !isset($temp['towns'][$row->town_id]) ) {
		        
		            $result['towns'][] = array( 'value' => $row->town_id , 'text' =>  $row->town );
		            $temp['towns'][$row->town_id] = true;
		    }
		    
		    if($row->department_id && !isset($temp['departments'][$row->department_id]) ) {

		            $result['departments'][] = array( 'value' => $row->department_id , 'text' =>  $row->department );
		            $temp['departments'][$row->department_id] = true ;
		    }
		}

		echo $jsonService->encode($result);
	}
	
	function sendmail()
	{
		jimport('joomla.mail.helper');
		jimport('joomla.utilities.utility');
		$config =& JFactory::getConfig();
		$params =& ComJea::getParams();
		$db =& JFactory::getDBO();
		
		$email = JMailHelper::cleanAddress( JRequest::getVar('email', '') );
		$name = JRequest::getVar('name', '');
		$subject = JRequest::getVar('subject', '') . ' [' .$config->getValue('fromname', '') . ']';
		$message = JRequest::getVar('e_message', '');			
		
		/*verification */
		if ( empty($name) ) {
			JError::raiseWarning( 500, JText::_( 'You must to specify your name'));
			
		} elseif ( !JMailHelper::isEmailAddress($email) ) {
			JError::raiseWarning( 500, JText::sprintf( 'Invalid email', $email ));
			
		} else {
			$reciptient = $params->get('default_mail');
		    
		    if($params->get('send_form_to_agent') == 1){
		        
		        $created_by = JRequest::getInt('created_by', 0);
		        $sql = 'SELECT `email` FROM `#__users` WHERE `id`=' . intval($created_by);
		        $db->setQuery($sql);
		        $reciptient = $db->loadResult();
		    }
		    
		    if (empty($reciptient)) {
		        // webmaster email
		        $reciptient = $config->getValue('mailfrom', '');
		    }
			
			$sendOk = JUtility::sendMail($email, $name, $reciptient ,$subject , $message, false);
		   
			if( $sendOk ) {
				
				$mainframe =& JFactory::getApplication();
				$mainframe->enqueueMessage(JText::_('Message successfully sent'));
				
				JRequest::setVar('name' , '');
				JRequest::setVar('subject', '');
				JRequest::setVar('email', '');
				JRequest::setVar('e_message', '');
			} else {
				JError::raiseWarning( 500, JText::_( 'SENDMAIL_ERROR_MSG'));
				
			}
		}		
		$this->display();
	}
	
	function save()
	{
//		print_r('cos vao ham save ngoai');
//		exit;
//	
   // Check for request forgeries
// JRequest::checkToken() or die( 'Invalid Token' );
	    
	    $access =& ComJea::getAccess();
        
      //  if ($access->canEdit || $access->canEditOwn) {
            
            require_once JPATH_COMPONENT_ADMINISTRATOR .DS.'models'.DS.'properties.php';
            $model = new JeaModelProperties();
	        
    	    $id = JRequest::getInt('id', 0);
            $Itemid = JRequest::getInt('Itemid', 0);
            //Nam Hai chinh sua doan nay
            //$is_renting = JRequest::getInt('is_renting', 0);
            //$cat = $is_renting ? 'renting' : 'selling';
            //Them moi doan code sau day
            $kind_id = JRequest::getInt('kind_id', 1);
			//echo 'kindid: '.$is_renting;
            if($kind_id==1) $cat ='selling';
            if($kind_id==2) $cat ='renting';
            if($kind_id==3) $cat ='needbuying';
            if($kind_id==4) $cat ='needrenting';
            //Ket thuc chinh sua doannay
    	    $model->setCategory($cat);
    	    
    	    if ( false ===  $model->save() ) {
    	         $this->setRedirect( 'index.php?option=com_jea&view=manage&'
    	                             . 'layout=form&id=' . $id . '&Itemid=' .$Itemid );
                
            } else {
                
                $row =& $model->getRow();
                
       
                $msg = JText::sprintf( 'Successfully saved property', $row->ref ) ;
                
               $user =& JFactory::getUser();               
			  if($user->id==0)
			  {
				$this->setRedirect( 'index.php?option=com_jea&task=reg_ad_succ','Mẫu quảng cáo của Quý Khách Hàng đã được lưu tại website, sau khi được duyệt, tin quảng cáo của quý khách sẽ được kích hoạt');  
			  }
			  else
			  {
                $this->setRedirect( 'index.php?option=com_jea&view=manage&'
                                     . '&Itemid=' .$Itemid, $msg );
			  }
            }
	  //  }
	    
	}
	
    function delete()
    {
        $access =& ComJea::getAccess();
        
        if ($access->canEdit || $access->canEditOwn) {
            
            require_once JPATH_COMPONENT_ADMINISTRATOR .DS.'models'.DS.'properties.php';
            $model = new JeaModelProperties();
            
            $Itemid = JRequest::getInt('Itemid', 0);
            $id = JRequest::getInt('id', 0);
            JRequest::setVar('cid', array($id));
            
            if ($model->remove()){
                
                $this->setRedirect( 'index.php?option=com_jea&view=manage'
                                     . '&Itemid=' .$Itemid, 
                                     JText::_('SUCCESSFULLY REMOVED ITEMS') );
            }
        }
    }
	
    function deleteimg()
    {
        $access =& ComJea::getAccess();
        
        if ($access->canEdit || $access->canEditOwn) {
            
            require_once JPATH_COMPONENT_ADMINISTRATOR .DS.'models'.DS.'properties.php';
            $model = new JeaModelProperties();
            
            $id = JRequest::getInt('id',0);
            $Itemid = JRequest::getInt('Itemid', 0);
            $model->delete_img();
            $this->setRedirect( 'index.php?option=com_jea&view=manage&'
                                     . 'layout=form&id=' . $id . '&Itemid=' .$Itemid );
        }
    }

    function unpublish()
    {
    	echo "unpublish";
    	exit;
    }
    
    function publish()
    {
    	echo "publish";
    	exit;
    }
    
	function reg_ad_succ()
	{
		echo "<a href='" . $_SERVER["PHP_SELF"] . "'>" . JText::_("RETURN_TO_HOMEPAGE") . "</a>";
	}
	
}
