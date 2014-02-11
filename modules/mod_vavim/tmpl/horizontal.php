<?php
/**
* @version		$Id: horizontal.php 2009-12-24 vinaora $
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
	<input id="avim_auto" onclick="AVIMObj.setMethod(0);" name="AVIMMethod" type="radio" />
		<label for="avim_auto"><?php echo JText::_( 'Auto' );?></label>
	<input id="avim_telex" onclick="AVIMObj.setMethod(1);" name="AVIMMethod" type="radio" />
		<label for="avim_telex"><?php echo JText::_( 'Telex' );?></label>
	<input id="avim_vni" onclick="AVIMObj.setMethod(2);" name="AVIMMethod" type="radio" />
		<label for="avim_vni"><?php echo JText::_( 'VNI' );?></label>
	<input id="avim_viqr" onclick="AVIMObj.setMethod(3);" name="AVIMMethod" type="radio" />
		<label for="avim_viqr"><?php echo JText::_( 'VIQR' );?></label>
	<input id="avim_viqr2" onclick="AVIMObj.setMethod(4);" name="AVIMMethod" type="radio" />
		<label for="avim_viqr2"><?php echo JText::_( 'VIQR*' );?></label>
	<input id="avim_off" onclick="AVIMObj.setMethod(-1);" name="AVIMMethod" type="radio" />
		<label for="avim_off"><?php echo JText::_( 'Off' );?></label>
	<input id="avim_ckspell" onclick="AVIMObj.setSpell(this);" name="AVIMMethod" type="checkbox" />
		<label for="avim_ckspell"><?php echo JText::_( 'Check Spell' );?></label>
	<input id="avim_daucu" onclick="AVIMObj.setDauCu(this);" name="AVIMMethod" type="checkbox" />
		<label for="avim_daucu"><?php echo JText::_( 'Old Accent' );?></label>
</div>
<script type="text/javascript" src="<?php echo $avim; ?>"></script>