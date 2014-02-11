<?php
/**
 * Google  Map default controller
 * 
 * @package    Joomla.component
 * @subpackage Components
 * @link http://inetlanka.com
 * @license		GNU/GPL
 * @auth inetlanka web team - [ info@inetlanka.com / inetlankapvt@gmail.com ]
 */


// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );


class TableGoogle extends JTable
{
	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $id = null;

	/**
	 * @var string
	 */
	var $greeting = null;
	
	/**
	 * @var string
	 */
	var $apiKey = null;
	
	/**
	 * @var string
	 */
	var $mapAddress = null;
	/**
	 * @var string
	 */
	var $mapPhone = null;
	/**
	 * @var string
	 */
	var $mapTp = null;
	/**
	 * @var string
	 */
	var $mapFax = null;
	/**
	 * @var string
	 */
	var $mapEmail = null;
	/**
	 * @var string
	 */
	var $mapWidth = null;
	/**
	 * @var string
	 */
	var $mapHeight = null;
	/**
	 * @var string
	 */
	var $mapLatitude = null;
	/**
	 * @var string
	 */
	var $mapLongitude = null;
	
	
	/**
	 * @var string
	 */
	var $mapViewHeight = null;
	/**
	 * @var string
	 */
	var $mapView = null;
	/**
	 * @var string
	 */
	var $mapPointImg = null;
	/**
	 * @var string
	 */
	var $companyVideoProfile = null;
	var $companySpamcheck = null;
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableGoogle(& $db) {
		parent::__construct('#__googlemap', 'id', $db);
	}
}