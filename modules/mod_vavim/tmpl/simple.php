<?php
/**
* @version		$Id: simple.php 2009-12-24 vinaora $
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
	<input id="avim_off" name="AVIMMethod" onclick="AVIMObj.setMethod(-1);" type="radio" />
		<label for="avim_off"><a href="http://vinaora.com/" target="_blank"><?php echo JText::_( 'Off' ); ?></a></label>
	<input id="avim_telex" name="AVIMMethod" onclick="AVIMObj.setMethod(1);" type="radio" />
		<label for="avim_telex"><?php echo JText::_( 'Telex' ); ?></label>
	<input id="avim_vni" name="AVIMMethod" onclick="AVIMObj.setMethod(2);" type="radio" />
		<label for="avim_vni"><?php echo JText::_( 'VNI' ); ?></label>
</div>
<script type="text/javascript" src="<?php echo $avim; ?>"></script>