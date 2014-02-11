<?php
/**
 * Pretty Box System Plugin
 *  
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );

class  plgSystemCounter extends JPlugin
{

	function plgSystemCounter(& $subject, $config)
	{
		parent::__construct($subject, $config);
	}

	/**
	* Converting the site URL to fit to the HTTP request
	*
	*/
	function onAfterDispatch()
	{
		
		// get parameter
		$iplifetime = (int) $this->params->get( 'iplifetime', 10 );
		$iplifetime	=	$iplifetime * 60;
		$ip = "0.0.0.0";
		if( !empty($_SERVER['REMOTE_ADDR']) ) $ip = $_SERVER['REMOTE_ADDR'];
		$now	=	mktime();
		$this->insertVisitor( $iplifetime, $ip, $now );
	}
	
	/*
	** Insert New IP Visitor
	*/
	/* ------------------------------------------------------------------------------------------------ */
	function insertVisitor( $sessiontime, $ip, $time ){
		$sessiontime	=	(int) $sessiontime;
		$time			=	(int) $time;
		
		// Check session time, insert new record if timeout
		$db				=	& JFactory::getDBO();
		$query			=	' SELECT COUNT(*) FROM #__vvisitcounter ';
		$query			.=	' WHERE ip=' . $db->quote( $ip );
		$query			.=	' AND (tm + ' . $db->quote( $sessiontime ) . ') > ' . $db->quote( $time );
		
		$db->setQuery($query);
		$items			=	$db->loadResult();
		
		if ( $db->getErrorNum() ) {
			modVisitCounterHelper::createTable();
		}
		
		if ( empty($items) )
		{
			$query 		= 	" INSERT INTO #__vvisitcounter (id, tm, ip) ";
			$query		.=	" VALUES ('', " . $db->quote ( $time ) . ", " . $db->quote ( $ip ) . ")";
			$db->setQuery($query);
			$db->query();
		}
		
		if ($db->getErrorNum()) {
			JError::raiseWarning( 500, $db->stderr() );
		}
	}
}