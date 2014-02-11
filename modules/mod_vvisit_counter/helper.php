<?php
/**
* @version		$Id: helper.php 2009-08-03 vinaora $
* @package		VINAORA VISITORS COUNTER
* @copyright	Copyright (C) 2007 - 2009 VINAORA.COM. All rights reserved.
* @license		GNU/GPL
* @website		http://vinaora.com
* @email		admin@vinaora.com
* 
* @warning		DON'T EDIT OR DELETE LINK HTTP://VINAORA.COM ON THE FOOTER OF MODULE. PLEASE CONTACT ME IF YOU WANT.
*
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<?php
class modVisitCounterHelper
{
	function render(&$params)
	{
	}
	
	/*
	** Create Table #__vvisitcounter
	*/
	/* ------------------------------------------------------------------------------------------------ */
	function createTable (){
		
		// Check if table exists. When not, create it
		$query	=	" CREATE TABLE IF NOT EXISTS #__vvisitcounter (
						id int(11) unsigned NOT NULL AUTO_INCREMENT,
						tm int NOT NULL,
						ip varchar(16) NOT NULL DEFAULT '0.0.0.0',
						PRIMARY KEY (`id`)
					) ENGINE=MyISAM AUTO_INCREMENT=1; ";
					
		$db	=& JFactory::getDBO();
		$db->setQuery($query);
		$db->query();
		
		if ($db->getErrorNum()) {
			JError::raiseWarning( 500, $db->stderr() );
		}
	}
	/* ------------------------------------------------------------------------------------------------ */
	
	
	
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
	/* ------------------------------------------------------------------------------------------------ */
	
	
	
	/*
	** Get Max/Last ID Visitor
	*/
	/* ------------------------------------------------------------------------------------------------ */
	function getMaxID( ){
		
		$visitors	=	0;
		$db			=	& JFactory::getDBO();
		
		// Query total visitors
		$query = ' SELECT MAX(id) FROM #__vvisitcounter ';
		$db->setQuery($query);
		
		// Total visitors
		$visitors	=	$db->loadResult();
		
		if ($db->getErrorNum()) {
			JError::raiseWarning( 500, $db->stderr() );
		}
		
		return $visitors;
	}
	/* ------------------------------------------------------------------------------------------------ */
	
	
	
	/*
	** Get Number of Visitors from $timestart to $timestop
	*/
	/* ------------------------------------------------------------------------------------------------ */
	function getVisitors( $timestart = 0, $timestop = 0 ){
		
		$visitors	=	0;
		$timestart	=	(int) $timestart;
		$timestop	=	(int) $timestop;

		if ( $timestart < BIRTH_DAY_JOOMLA ) $timestart = 0;
		if ( $timestop < BIRTH_DAY_JOOMLA ) $timestop = 0;
		
		$db				=	& JFactory::getDBO();
		$query			=	' SELECT COUNT(*) FROM #__vvisitcounter ';
		
		if ( !$timestart ){
			if ( $timestop ) {
				$query		.= ' WHERE tm < ' . $db->quote( $timestop );
			}
		}
		else{
			if ( !$timestop ){
				$query		.= ' WHERE tm >= ' . $db->quote( $timestart );
			}
			else{
			
				if ( $timestop == $timestart ){
					$query		.= ' WHERE tm = ' . $db->quote( $timestart );
				}
				
				if ( $timestop > $timestart ){
					$query		.= ' WHERE tm >= ' . $db->quote( $timestart );
					$query		.= ' AND tm < ' . $db->quote( $timestop );					
				}
				
				if ( $timestop < $timestart ){
					$query		.= ' WHERE tm >= ' . $db->quote( $timestop );
					$query		.= ' AND tm < ' . $db->quote( $timestart );					
				}
			}
		}
		
		$db->setQuery($query);
		$visitors	=	$db->loadResult();
		
		if ($db->getErrorNum()) {
			JError::raiseWarning( 500, $db->stderr() );
		}
		
		return $visitors;
	}
	/* ------------------------------------------------------------------------------------------------ */
	
	
	
	/*
	** Remove Visitors from $timestart to $timestop
	*/
	/* ------------------------------------------------------------------------------------------------ */
	function delVisitors( $timestart = 0, $timestop = 0 ){
	
		$timestart	=	(int) $timestart;
		$timestop	=	(int) $timestop;
		
		if ( $timestart < BIRTH_DAY_JOOMLA ) $timestart = 0;
		if ( $timestop < BIRTH_DAY_JOOMLA ) $timestop = 0;
		
		$db				=	& JFactory::getDBO();
		$query			=	' DELETE FROM #__vvisitcounter ';
		
		if ( !$timestart ){
			if ( $timestop ) {
				$query		.= ' WHERE tm < ' . $db->quote( $timestop );
			}
		}
		else{
			if ( !$timestop ){
				$query		.= ' WHERE tm >= ' . $db->quote( $timestart );
			}
			else{
			
				if ( $timestop == $timestart ){
					$query		.= ' WHERE tm = ' . $db->quote( $timestart );
				}
				
				if ( $timestop > $timestart ){
					$query		.= ' WHERE tm >= ' . $db->quote( $timestart );
					$query		.= ' AND tm < ' . $db->quote( $timestop );					
				}
				
				if ( $timestop < $timestart ){
					$query		.= ' WHERE tm >= ' . $db->quote( $timestop );
					$query		.= ' AND tm < ' . $db->quote( $timestart );					
				}
			}
		}
		
		$db->setQuery($query);
		$db->query();
		
		if ($db->getErrorNum()) {
			JError::raiseWarning( 500, $db->stderr() );
		}
		
	}
	/* ------------------------------------------------------------------------------------------------ */	
	
	
	/*
	** Check Parameter
	** Return False if Parameter equal to "0" (zero) or "No" or Empty
	*/
	/* ------------------------------------------------------------------------------------------------ */
	function isEnabled( $param = "" ){
		
		// $param is Undefined variable
		if ( empty( $param ) ) return false;
		
		// $param is Defined variable
		$param = strtolower( trim($param) );
		
		if ( $param == "" ) return false;
		if ( $param == "0" ) return false;
		if ( $param == "no" ) return false;
		
		return true;
	}
	/* ------------------------------------------------------------------------------------------------ */
	
	
	
	/*
	** Get Digits of Digital Counter
	** Return Array of Digits with Leading Zeros
	** Input: $number = 123, $length = 6
	** Output: Array a[]: a[0]=>0, a[1]=>0, a[2]=>0, a[3]=>1, a[4]=>2, a[5]=>3
	*/
	/* ------------------------------------------------------------------------------------------------ */
	function &getDigits( $number, $length=0 )
	{
		$strlen = strlen($number);
		
		$arr	=	array();
		$diff	=	$length -  $strlen;
		
		// Push Leading Zeros
		while ( $diff>0 ){
			array_push( $arr,0 );
			$diff--;
		}
		
		// For PHP 4.x
		$arrNumber	=	array();
		for ($i = 0; $i < $strlen; $i++) {
			$arrNumber[] = substr($number,$i,1);
		}
		
		// For PHP 5.x: $arrNumber	=	str_split( $number );
		
		$arr		=	array_merge( $arr,$arrNumber );
		
		return $arr;
	}
	/* ------------------------------------------------------------------------------------------------ */
	

	
	/*
	** Show Digit Counter Image
	*/
	/* ------------------------------------------------------------------------------------------------ */
	function showDigitImage( $digit_type="default", $digit )
	{	
		$ret	=	'<img src="'.JURI::base().DIGIT_COUNTER_PATH.'/'.$digit_type.'/'.$digit.'.png"';
		$ret	.=	' style="margin:0; padding:0; border:0px none; "';
		$ret	.=	' alt="mod_vvisit_counter"';
		$ret	.=	' title="Vinaora Visitors Counter '.VERSION_MODULE.'"';
		$ret	.=	' />';
		
		return $ret;
	}
	/* ------------------------------------------------------------------------------------------------ */	

	
	
	/*
	** Show Statistics Table's Rows
	*/
	/* ------------------------------------------------------------------------------------------------ */
	function showStatisticsRows( $stats_type="default", $image, $timeline = "", $time = "", $visitors = "")
	{
		$ret	=	'<tr align="left"><td>';
		$ret	.=	'<img src="'.JURI::base().STATISTIC_ICON_PATH.'/'.$stats_type.'/'.$image.'.png"';
		$ret	.=	' alt="mod_vvisit_counter"';
		$ret	.=	' title="'.$timeline.'" /></td>';
		$ret	.=	'<td>'.$time.'</td>';
		$ret	.=	'<td align="right">'.$visitors.'</td></tr>';
		
		return $ret;
	}
	/* ------------------------------------------------------------------------------------------------ */

	
	
	/*
	** Show Timeline.
	** Output: %Y-%m-%d -> %Y-%m-%d
	*/
	/* ------------------------------------------------------------------------------------------------ */
	function showTimeLine( $timeBegin = 0, $timeEnd = 0, $offset = 0, $formattime = "%Y-%m-%d", $spacer = " -&gt; " )
	{
		$timeBegin	=	(int) $timeBegin;
		$timeEnd	=	(int) $timeEnd;
		$offset		=	(float) $offset;
		
		$str		=	"";
		
		if ( $timeBegin ){
			$time	=	& JFactory::getDate( $timeBegin );
			$time->setOffset( $offset );
			
			$str 	.=	$time->toFormat( $formattime ) ;
			
			if ( $timeEnd ){
				$time	=	& JFactory::getDate( $timeEnd );
				$time->setOffset( $offset );

				$str	.=	$spacer;
				$str	.=	$time->toFormat( $formattime ) ;
			}
		}
		return $str;
	}
	/* ------------------------------------------------------------------------------------------------ */

}
?>