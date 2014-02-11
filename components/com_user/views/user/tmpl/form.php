<?php // no direct access
defined('_JEXEC') or die('Restricted access');
?>

<script type="text/javascript">
<!--
	Window.onDomReady(function(){
		document.formvalidator.setHandler('passverify', function (value) { return ($('password').value == value); }	);
	});
// -->
</script>
<!--<form action="<?php echo JRoute::_( 'index.php' ); ?>" method="post" name="userform" autocomplete="off" class="form-validate">-->
<form action="index.php?option=com_user&task=edit&Itemid=81&lang=vi" method="post" name="userform" autocomplete="off" class="form-validate">
<?php if ( $this->params->def( 'show_page_title', 1 ) ) : ?>
	<div class="componentheading<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
		<?php echo $this->escape($this->params->get('page_title')); ?>
	</div>
<?php endif; ?>

<table cellpadding="5" cellspacing="0" border="0" width="100%" class='contentpane'>
<tr>
	<td height="30" align="right">
		<label for="email">
			<?php echo JText::_( 'Email' ); ?>:
		</label>
	</td>
	<td>
	<div style="margin-left: 19px;">
		<?php echo $this->user->get('email');?>
		<input type="hidden" name="email" id="email" value="<?php echo $this->user->get('email');?>"/>
	</div>
	</td>
</tr>
<tr>
	<td height="30" align="right">
		<label for="name">
			<?php echo JText::_( 'Your Name' ); ?>:
		</label>
	</td>
	<td>
		<input class="inputbox required" type="text" id="name" name="name" value="<?php echo $this->user->get('name');?>" size="40" />
	</td>
</tr>
<tr>
	<td height="30" align="right">
		<label for="address">
			<?php echo JText::_( 'Address' ); ?>:
		</label>
	</td>
	<td>
		<input class="inputbox required" type="text" id="address" name="address" value="<?php echo $this->user->get('address');?>" size="40" maxlength="255" />
	</td>
</tr>
<tr>
	<td height="30" align="right"> 
		<label for="phone">
			<?php echo JText::_( 'phone' ); ?>:
		</label>
	</td>
	<td>
		<input class="inputbox required" type="text" id="phone" name="phone" value="<?php echo $this->user->get('phone');?>" size="40" />
	</td>
</tr>
<?php if($this->user->get('password')) : ?>
<tr>
	<td height="30" align="right">
		<label for="password">
			<?php echo JText::_( 'Password' ); ?>:
		</label>
	</td>
	<td>
		<input class="inputbox validate-password" type="password" id="password" name="password" value="" size="40" />
	</td>
</tr>
<tr>
	<td height="30" align="right">
		<label for="password2">
			<?php echo JText::_( 'Verify Password' ); ?>:
		</label>
	</td>
	<td>
		<input class="inputbox validate-passverify" type="password" id="password2" name="password2" size="40" />
	</td>
</tr>
<tr>
	<td height="30" align='right'>
	
	</td>
	<td style="padding-left: 30px;">
		<span class="clear check" style='margin-bottom:5px;'>
						<input type="checkbox" id="speak_english" name="speak_english" <?php if($this->user->get('speak_english')==1){echo "checked='checked'";}?> disabled="disabled"> 
							Can you speak English?
		</span>
		<span class="clear check" style="margin-bottom:5px;">
					<input type="checkbox" id="chinh_chu" name="chinh_chu" <?php if($this->user->get('chinh_chu')==0){echo "checked='checked'";}?> disabled="disabled"> 
					Bạn là môi giới?
		</span>
		<span class="clear check">
					<input type="checkbox" id="nhan_mail" name="nhan_mail" <?php if($this->user->get('nhan_mail')==1){echo "checked='checked'";}?> > 
					Đăng ký nhận báo cáo hàng tháng
		</span>
	</td>
</tr>
<?php endif; ?>
</table>
<div style='text-align:center'>
<?php //if(isset($this->params)) :  echo $this->params->render( 'params' ); endif; ?>
	<button class="btn-search validate" type="submit" onclick="submitbutton( this.form );return false;"><?php echo JText::_('Save'); ?></button>
</div>
	<input type="hidden" name="username" value="<?php echo $this->user->get('username');?>" />
	<input type="hidden" name="id" value="<?php echo $this->user->get('id');?>" />
	<input type="hidden" name="gid" value="<?php echo $this->user->get('gid');?>" />
	<input type="hidden" name="option" value="com_user" />
	<input type="hidden" name="task" value="save" />
	
	<?php echo JHTML::_( 'form.token' ); ?>
</form>
