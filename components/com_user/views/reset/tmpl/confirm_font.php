<?php defined('_JEXEC') or die; ?>

<div class="componentheading">
	<?php echo JText::_('Confirm your Account'); ?>
</div>

<form action="<?php echo JRoute::_( 'index.php?option=com_user&amp;task=confirmreset&Itemid=19' ); ?>" method="post" class="josForm form-validate">
	<table cellpadding="0" cellspacing="0" border="0" width="100%" class="contentpane">
		<tr>
			<td colspan="2" height="40">
				<p style="font-family: calibri;"><?php echo JText::_('RESET_PASSWORD_CONFIRM_DESCRIPTION'); ?></p>
			</td>
		</tr>
		<tr>
			<td height="40">
				<label style="font-family: calibri;" for="token" class="hasTip" title="<?php echo JText::_('RESET_PASSWORD_TOKEN_TIP_TITLE'); ?>::<?php echo JText::_('RESET_PASSWORD_TOKEN_TIP_TEXT'); ?>"><?php echo JText::_('Token'); ?>:</label>
			</td>
			<td>
				<input id="token" name="token" type="text" class="required" size="36" />
			</td>
		</tr>
	</table>

	<button type="submit" class="validate btn-search"><?php echo JText::_('Submit'); ?></button>
	<?php echo JHTML::_( 'form.token' ); ?>
</form>