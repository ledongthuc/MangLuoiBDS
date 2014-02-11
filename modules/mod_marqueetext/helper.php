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
class modmarqueetextHelper
{
	
	function marqueehinhanh($hinhanh, $tieude )
	{		
		$kq ='';
		$arrayhinh = explode("\n", $hinhanh);
	//	 print_r($arrayhinh);
		  $kq .= $hinhanh;
		  echo  "<img src='$hinhanh' > ";
		foreach ( $arrayhinh as $linkhinh )
		{
			
			// echo  "<img src='$hinhanh' > ";
		}
		// $hinhanh=$params->get("hinhanh");
		
		return $kq;
	}
}
?>
