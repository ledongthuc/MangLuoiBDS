<?php defined('_JEXEC') or die('Restricted access'); ?>

<form action="index.php" method="post" name="adminForm" id="adminForm">
<div class="col100">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Details' ); ?></legend>

		<table class="admintable">
		<tr>
			<td width="100" align="right" class="key">
				<label for="greeting">
					<?php echo JText::_( 'Value' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="vi_hidden_ten" id="value" size="32" maxlength="250" value="<?php echo $this->ten;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="greeting">
					<?php echo JText::_( 'Rate' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="rate" id="rate" size="32" maxlength="250" value="<?php echo $this->ti_gia;?>" />
			</td>
		</tr>
	</table>
	</fieldset>
</div>
<div class="clr"></div>


<input type="hidden" name="option" value="com_jea" />
<input type="hidden" name="controller" value="features" />
<input type="hidden" name="id" value="<?php echo $this->id; ?>" />
<input type="hidden" name="table" value="<?php echo $this->tenBang ?>" />
<input type="hidden" name="task" value="" />
<?php echo JHTML::_( 'form.token' ) ?>
</form>
