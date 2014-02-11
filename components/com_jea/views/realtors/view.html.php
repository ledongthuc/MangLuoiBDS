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
//jimport(joomla.utilities.string);

class JeaViewRealtors extends JeaView 
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
		// doan code duoi day de load plugin content thay cho parent::display();
		$o = new stdClass();
		$o->text = $this->loadTemplate($tpl);
		JPluginHelper::importPlugin('content');
		$dispatcher = & JDispatcher::getInstance();
		$results = $dispatcher->trigger('onPrepareContent', array (&$o, array(), 0));
		echo $o->text;
	}

	function getItemDetail( $id )
	{
		$realtorModel = $this->getModel('realtors');
		$row =& $realtorModel->getRowById( $id );
	    if(!$row->id){
            return;
        }
		
        // combine name and short instruction (slogan)
//        if ( !empty( $row->slogan ) )
//        {
//        	$row->name .= " - " . $row->slogan;
//        }
        
        // set image default if no avatar
        $avatar = JPATH_ROOT . DS . 'images' . DS . 'com_jea' . DS . 'images' . DS .
        				'realtors' . DS . $row->id . DS . 'avatar.jpg';
        if( file_exists( $avatar ) )
        {
        	$row->avatar = JURI::root() . "images/com_jea/images/realtors/$row->id/avatar.jpg";
        }
        else
        {
        	$row->avatar = JURI::root() . 'images/noimage.jpg';
        }

        // get mod search
        $mod_search = JModuleHelper::getModule('jea_search', 'realtors_mod_search');      
       	
        $attribs['style'] = 'search';
        $mod_search->title = JText::_("REALTOR_MOD_SEARCH");
        
		$row->mod_search =  JModuleHelper::renderModule( $mod_search, $attribs );

        // get realtor's properties & assign to template
//        $realtorListing = $realtorModel->getListingByRealtorId( $row->id );        
//        
//        $templatePath = "templates/webkp/html/mod_jea_emphasis";
//        $helperPath = "modules/mod_jea_emphasis";
//        
//        $listingTemplate = new JView();
//        $listingTemplate->addTemplatePath($templatePath);
//        $listingTemplate->addHelperPath($helperPath);
//        $listingTemplate->loadHelper('helper');
//        
//        //$listingTemplate->assignRef('rows', $realtorListing);
//        $listingTemplate->rows = &$realtorListing;
//        
//        $row->mod_realtors_properties = $listingTemplate->loadTemplate();
        
//        $row->mod_realtors_properties = "chau test here";

        $mod_properties = JModuleHelper::getModule('jea_emphasis', 'Realtor Properties');      
       	
        $attribs['style'] = 'box8content';
        $mod_properties->params .= "\n realtor_id=$row->id";		
        $mod_properties->title = "DO " . JString::strtoupper( $row->name );
        
		$row->mod_realtors_properties =  JModuleHelper::renderModule( $mod_properties, $attribs );
		
        // get concerned properties
        $mod_same_properties = JModuleHelper::getModule('jea_emphasis', 'Realtor Same Properties');
        
        $attribs['style'] = 'box8content';
        $mod_same_properties->params .= "\n realtor_id=$row->id";
        $mod_same_properties->title = JText::_("REALTOR SAME PROPERTIES");      
		$row->mod_same_properties =  JModuleHelper::renderModule( $mod_same_properties, $attribs );
        
        // get successful properties
        $mod_successful_properties = JModuleHelper::getModule('jea_emphasis', 
        												'Realtor Successful Properties');
        
        $attribs['style'] = 'box8content';
        $mod_successful_properties->params .= "\n realtor_id=$row->id";
        $mod_successful_properties->title = JText::_("REALTOR SUCCESSFUL PROPERTIES");
        
		$row->mod_successful_properties =  JModuleHelper::renderModule( $mod_successful_properties, 
																					$attribs );
        
        $this->assignRef('row', $row);
	}

	function getViewUrl ( $id=0, $params='' )
	{
		if ( $id ) {
			$params .= '&id=' . intval( $id ) ;
		}
	  
		return JRoute::_( $params );
	}
}
?>