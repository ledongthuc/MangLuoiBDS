<?php
/**
* @version		$Id: full.php 2009-12-24 vinaora $
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
	<input id="avim_auto" name="AVIMMethod" onclick="AVIMObj.setMethod(0);" type="radio" />&nbsp;
		<label for="avim_auto"><?php echo JText::_( 'Auto' ); ?></label>&nbsp;<small>[F9]</small><br />
	<input id="avim_telex" name="AVIMMethod" onclick="AVIMObj.setMethod(1);" type="radio" />&nbsp;
		<label for="avim_telex"><?php echo JText::_('Telex'); ?></label>&nbsp;<a href="http://vi.wikipedia.org/wiki/Telex#Quy_.C6.B0.E1.BB.9Bc_telex" title="Telex#Quy uoc telex" style="font-size: smaller;" target="_blank">(?)</a><br />
	<input id="avim_vni" name="AVIMMethod" onclick="AVIMObj.setMethod(2);" type="radio" />&nbsp;
		<label for="avim_vni"><?php echo JText::_('VNI'); ?></label>&nbsp;<a href="http://vi.wikipedia.org/wiki/VNI#Quy_.C6.B0.E1.BB.9Bc" title="VNI#Quy uoc" style="font-size: smaller;" target="_blank">(?)</a><br />
	<input id="avim_viqr" name="AVIMMethod" onclick="AVIMObj.setMethod(3);" type="radio" />&nbsp;
		<label for="avim_viqr"><?php echo JText::_('VIQR'); ?></label>&nbsp;<a href="http://vi.wikipedia.org/wiki/VIQR" title="VIQR" style="font-size: smaller;" target="_blank">(?)</a><br />
	<input id="avim_viqr2" name="AVIMMethod" onclick="AVIMObj.setMethod(4);" type="radio" />&nbsp;
		<label for="avim_viqr2"><?php echo JText::_('VIQR*'); ?></label><br />
	<input id="avim_off" name="AVIMMethod" onclick="AVIMObj.setMethod(-1);" type="radio" />&nbsp;
		<label for="avim_off"><a href="http://vinaora.com/" target="_blank"><?php echo JText::_('Turn off'); ?></a></label>&nbsp;<small>[F12]</small>
	<hr />
	<input id="avim_daucu" name="AVIMMethod" onclick="AVIMObj.setDauCu(this);" type="checkbox" />&nbsp;
		<label for="avim_daucu"><?php echo JText::_('Old Style'); ?></label>&nbsp;<small>[F7]</small><br />
	<input id="avim_ckspell" name="AVIMMethod" onclick="AVIMObj.setSpell(this);" type="checkbox" />&nbsp;
		<label for="avim_ckspell"><?php echo JText::_('Spell Checking'); ?></label>&nbsp;<small>[F8]</small>
</div>
<script type="text/javascript" src="<?php echo $avim; ?>"></script>