<img src="../images/vi.gif"  style="cursor:pointer" onclick="getDataLang_short('vi')" />
<img src="../images/us.gif"  style="cursor:pointer"  onclick="getDataLang_short('en')" />
<script type="text/javascript" src="../libraries/com_u_re/js/admin_utils.js"></script>

<?php
defined('_JEXEC') or die('Restricted access');
?>
<form action="index.php" method="post" name="adminForm" id="adminForm">
<div class="col100">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Details' ); ?></legend>

		<table class="admintable">
		<tr>
			<td width="100" align="right" class="key">
			<span id='changlabel'>	<label for="greeting">
					<?php echo JText::_( 'value' ); ?>:
				</label>
			</span>
			</td>
			<td>
				<input class="text_area" type="text" name="ten" id="ten" size="32" maxlength="250" value="<?php echo $this->ten?>" />
			</td>
		</tr>
	</table>
	</fieldset>
</div>
<div class="clr"></div>
<input type="hidden" name="vi_hidden_ten" id="vi_hidden_ten" value=" " />
<input type="hidden" name="en_hidden_ten" id="en_hidden_ten" value="<?php echo $this->ten_en; ?>" />
<input type="hidden" name="tmp" id="tmp"  value="<?php echo $this->lang ?>" />
<input type="hidden" name="option" value="com_jea" />
<input type="hidden" name="controller" value="project_group" />
<input type="hidden" name="id" value="<?php echo $this->id; ?>" />
<input type="hidden" name="task" value="" />
<?php echo JHTML::_( 'form.token' ) ?>
</form>
