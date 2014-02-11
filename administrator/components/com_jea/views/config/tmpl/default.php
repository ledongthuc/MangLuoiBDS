<?php
/**
 * This file is part of Joomla Estate Agency - Joomla! extension for real estate agency
 * 
 * @version     0.9 2009-10-14
 * @package		Jea.admin
 * @copyright	Copyright (C) 2008 PHILIP Sylvain. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla Estate Agency is free software. This version may have been modified pursuant to the
 * GNU General Public License, and as distributed it includes or is derivative
 * of works licensed under the GNU General Public License or other free or open
 * source software licenses.
 * 
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
JHTML::stylesheet('jea.admin.css', 'media/com_jea/css/');
?>
<script language="javascript" type="text/javascript">

function submitbutton( pressbutton, section ) {

	var form = document.adminForm;

	if ( pressbutton == 'default' ) {
	
		if ( ! confirm ("<?php echo JText::_('CONFIRM_RESTORE_DEFAULT_CONFIGURATION' )?>" ) ) {
			return;
		}
	}
	submitform(pressbutton);
	return;
}

</script>

<form action="index.php?option=com_jea&controller=config" method="post"
	name="adminForm" id="adminForm">

<table cellspacing="0" cellpadding="0" border="0" width="100%" >
	<tr>
		<td valign="top" width="50%" style="padding-right:10px;">
			<fieldset><legend><?php echo JText::_('Units of measurement') ?></legend> 
			    <?php echo $this->form->render('units', 'units') ?>
			</fieldset>
	
			<fieldset><legend><?php echo JText::_('Currency format') ?></legend> 
			    <?php echo $this->form->render('currency', 'currency') ?>
			</fieldset>
	
			<fieldset><legend><?php echo JText::_('Property detail') ?></legend> 
			    <?php echo $this->form->render('property', 'property') ?>
			</fieldset>
		</td>
		
		<td valign="top" width="50%">
			<fieldset><legend><?php echo JText::_('Lists') ?></legend> 
			    <?php echo $this->form->render('lists', 'lists') ?>
			</fieldset>
	
			<fieldset><legend><?php echo JText::_('Pictures') ?></legend> 
			    <?php echo $this->form->render('pictures', 'pictures') ?>
			</fieldset>
            <fieldset>
            <legend>Số tiền hàng tháng</legend>
            <?php echo $this->form->render('giatien','giatien') ?>
            </fieldset>
            <fieldset>
            <legend>Id Bài viết Thông tin liên hệ</legend>
            <?php echo $this->form->render('idLienHe','idLienHe') ?>
            </fieldset>
            <fieldset>
            <legend>Bất động sản liên quan</legend>
            <?php echo $this->form->render('bdslienquan','bdslienquan') ?>
            </fieldset>
		</td>
	</tr>

</table>

<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="1" />

</form>
