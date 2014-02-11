<?php
/**
 * @version		$Id: docman.searchbot.php 983 2009-11-27 10:35:10Z mathias $
 * @category	DOCman
 * @package		DOCman15
 * @copyright	Copyright (C) 2003 - 2009 Johan Janssens and Mathias Verraes. All rights reserved.
 * @license		GNU GPLv2 <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html>
 * @link     	http://www.joomladocman.org
 */
defined('_JEXEC') or die('Restricted access');

include_once( JPATH_ADMINISTRATOR ."/components/com_docman/docman.class.php");

//DOCman core interaction API
global $_DOCMAN, $_DMUSER;
if(!is_object($_DOCMAN)) {
    $_DOCMAN = new dmMainFrame();
    $_DMUSER = $_DOCMAN->getUser();
}

include_once($_DOCMAN->getPath('classes' , 'utils'));

/** Register our search function with Joomla */


$mainframe = JFactory::getApplication();
$mainframe->registerEvent( 'onSearch', 'botSearchDocman' );
$mainframe->registerEvent( 'onSearchAreas', 'plgSearchDocmanAreas' );


/**
 * @return array An array of search areas
 */
function &plgSearchDocmanAreas()
{
	static $areas = array(
		'docman' => 'DOCman'
	);
	return $areas;
}

/**
* Search method
* @param 'text'     element is the search term(s)
* @param 'phrase'   element is whether this is a term/phrase/word to search for
* @param 'ordering' element is how to sort the results
*
* Returns an array that contains:
* 	title		Title of the article (ie subject)
*	section		Section name. We use 'Forum:category/section'
*	text		Text from matching articles
*	created		Date created (standard format 2004-....)
*	browsernav	'2' to open in this window
*	href		the link to get back to here.
*
*/
function botSearchDocman( $phrase, $mode='', $ordering='', $areas=null )
{
	global $_DOCMAN, $Itemid;
	$database = JFactory::getDBO();
	
	if (is_array( $areas )) 
	{
		if (!array_intersect( $areas, array_keys( plgSearchDocmanAreas() ) )) {
			return array();
		}
	}
	
	$phrase = trim( $phrase );
	if( $phrase == '' ){
		return array();
	}

	$plugin =& JPluginHelper::getPlugin('search', 'docman.searchbot');
	$params = new JParameter( $plugin->params );
	

	$section_prefix = $params->get( 'prefix','Downloads: ');
	$section_suffix = $params->get( 'suffix','');


	$search_name    = $params->get( 'search_name'        ,0   );
	$search_desc    = $params->get( 'search_description' ,0   );
	$search_cat     = $params->get( 'search_cat'         ,0   );
	$option_link    = $params->get( 'href',        'download' );

	if( ! ( $search_name || $search_desc || $search_cat ) ){
		return array();
	}

	// INTERFACE to standard class
	$search_for = array(
		array(
			'search_phrase'		 => $phrase ,
			'search_mode'		 => $mode
		)
	);

    // ...href...
    $DMItemid = DOCMAN_Utils::getItemid();
    switch($option_link) {
        case 'download':
            $href = "CONCAT('index.php?option=com_docman&task=doc_download&Itemid=$DMItemid&gid=',DM.id )";
            break;
        case 'details':
            $href = "CONCAT('index.php?option=com_docman&task=doc_details&Itemid=$DMItemid&gid=',DM.id )";
            break;
        case 'display':
        default:
            $href = "CONCAT('index.php?option=com_docman&task=cat_view&Itemid=$DMItemid&gid=',DM.catid )";
            break;
    }

	$columns = array(
      "DM.dmname" 			=>	"title"
    , "DM.dmdescription"	=>	"text"
    , "DM.dmlastupdateon"	=>	"created"
    , "'2'"					=>	"browsernav"
    , "$href"				=>	"href"
    , "DM.catid"			=>  "catid"
	);

	$options = array();
	if( $search_name ){ $options[] = 'search_name' ; }
	if( $search_desc ){ $options[] = 'search_desc' ; }
	if( $search_cat  ){ $options[] = 'search_cat'  ; }

	$options['section_prefix'] = $section_prefix ;
	$options['section_suffix'] = $section_suffix ;

	return DOCMAN_Docs::search(  $search_for , $ordering, 0 , $columns , $options);
}