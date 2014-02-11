<?php
/**
* @version		$Id: dropdownlist.php 2009-12-24 vinaora $
* @package		Vinaora AVIM Keyboard
* @copyright	Copyright (C) 2007 - 2010 VINAORA. All rights reserved.
* @license		GNU/GPL
* @website		http://vinaora.com
* @email		admin@vinaora.com
*
* @note			AVIM Javascript (avim.js) - Copyright (C) 2004-2008 Hieu Tran Dang <lt2hieu2004 (at) users (dot) sf (dot) net
*
*/

// no direct access
defined('_JEXEC') or die('Restricted access');
?>
<div>
	<form name="input" method="post">
		<select id="AVIMMethod" onchange="AVIMObj.setMethod(m);">
			<option id="avim_auto"><?php echo JText::_( 'Auto' ); ?></option>
			<option id="avim_telex"><?php echo JText::_( 'Telex' ); ?></option>
			<option id="avim_vni"><?php echo JText::_( 'VNI' ); ?></option>
			<option id="avim_off"><?php echo JText::_( 'Off' ); ?></option>
		</select>
	</form>
</div>
<script type="text/javascript">
	selObj = document.getElementById("AVIMMethod");
	m = AVIMGlobalConfig.method;
	selObj.selectedIndex=(m=="-1"?"3":m);
	
	selObj.onchange = function(){
		AVIMGlobalConfig.method = (selObj.selectedIndex=="3")?"-1":selObj.selectedIndex;
	}
</script>
<script type="text/javascript" src="<?php echo $avim; ?>"></script>