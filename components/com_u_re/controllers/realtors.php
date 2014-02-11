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

class JeaControllerRealtors extends JController
{
    
    /**
	 * Custom Constructor
	 */
	function __construct( $default = array() )
	{
		// Set a default view if none exists
		if ( ! JRequest::getCmd( 'view' ) ) {
			
			JRequest::setVar('view', 'realtors' );
		}		
		//clear search session if there is not a search
		if( ( JRequest::getVar( 'task' ) != 'search' ) &&  ( isset( $_SESSION['jea_search'] ) ) ) {
			unset( $_SESSION['jea_search'] );
		}		
		//$this->addModelPath( JPATH_COMPONENT_ADMINISTRATOR.DS.'models' );				
		$id = JRequest::getInt('id', 0);
		parent::__construct( $default );
	}
	
	function search()
	{	
		$session =& JFactory::getSession();
		
		if ( JRequest::checkToken() ) 
		{
			$params = array(
				'key_search'           => JRequest::getVar('key_search', ''),		
				'Itemid'           => JRequest::getInt('Itemid', 0),
				'town_id'          => JRequest::getInt('town_id', 0),
				'area_id'          => JRequest::getInt('area_id', 0),
			);
			$session->set('params', $params, 'jea_search');
		} 
		else 
		{
		    $app = &JFactory::getApplication();
            $router = &$app->getRouter();
            // force the default to layout on search result
            $router->setVar( 'layout', 'default');
		}
		
		$params = $session->get('params', array() , 'jea_search');
		
		// Bug correction on search pagination
		if ($limit =JRequest::getInt('limit', 0))
		{
		    $params['limit'] = $limit;
		    $session->set('params', $params, 'jea_search');
		}
		
		JRequest::set( $params , 'POST');
		$this->display();

	}
	
	function sendmail()
	{
		// TODO: get submit value and send mail to realtor email 
		// post params: contact_name, contact_email, contact_phone, contact_content, realtor_email
	
		
		
		jimport('joomla.mail.helper');
		jimport('joomla.utilities.utility');	
		/*
		$config =& JFactory::getConfig();
		$params =& ComJea::getParams();
		$db =& JFactory::getDBO();
		*/	

		
		
		//realtor_email		
		$email= JRequest::getVar('realtor_email', '');	
		//contact_name		
		$sender = JRequest::getVar('contact_name', '');	
		//contact_email	
		$from = JRequest::getVar('contact_email', '');
		//contact_phone		
		$phone = JRequest::getVar('contact_phone', '');
		//contact_content
		//$contact_content = "test gui mail";
		$note = JRequest::getVar('contact_content', '');
		//subject				
		
		$subject = "Bạn có mail từ ". $sender;			
		$body  =  "Họ tên người gửi: ".$sender. "\r\n";
		$body .= "Số điện thoại: ".$phone. "\r\n";
		$body .= "Nội dung: \r\n";
		$body .= $note;		
		
		$realtor_id = JRequest::getVar('realtor_id', '');
		$proid= JRequest::getVar('proid', '');			
		$link = 'index.php?option=com_jea&controller=realtors&Itemid=118&id='.$realtor_id.'&proid='.$proid;
				
		/*verification */
		if ( empty($sender) ) 
		{
			echo "<script>alert('Bạn phải nhập tên');window.location.href='$link'</script>";					
			//JError::raiseWarning( 500, JText::_( 'You must to specify your name'));
			
		} 
		elseif ( !JMailHelper::isEmailAddress($email) ) 
			{
				echo "<script>alert('Mail không hợp lệ');window.location.href='$link'</script>";					
				//JError::raiseWarning( 500, JText::sprintf( 'Invalid email', $email ));
				
			}
			else 
			{
							
				$sendOk = JUtility::sendMail($from, $sender, $email, $subject, $body);

				if( $sendOk )
				{
					echo "<script>alert('Mail của bạn đã được gửi');window.location.href='$link'</script>";					
					//$mainframe =& JFactory::getApplication();				
					//$mainframe->enqueueMessage(JText::_('Message successfully sent'));			
				}
				else
				{
					echo "<script>alert('Mail của bạn chưa được gửi');window.location.href='$link'</script>";					
					// JError::raiseWarning( 500, JText::_( 'SENDMAIL_ERROR_MSG'));
				}
			}		
		// $this->display();
	
	}
	
}
