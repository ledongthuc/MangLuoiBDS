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
class modTigiavangHelper
{
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
	
	/*
	** Show Digit Counter Image
	*/
	/* ------------------------------------------------------------------------------------------------ */
	function showDigitImage($digit )
	{	
		$ret	=	'<img src="'.JURI::base().'modules/mod_tigiavang/images/'.$digit.'.png"';
		$ret	.=	' style="margin:0; padding:0; border:0px none; "  height="15px" width="13px" ';
		$ret	.=	' />';
		
		return $ret;
	}
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
}
?>
