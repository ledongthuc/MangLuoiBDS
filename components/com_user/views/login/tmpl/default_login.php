<?php defined('_JEXEC') or die('Restricted access');
?>
<?php if(JPluginHelper::isEnabled('authentication', 'openid')) :
		$lang = &JFactory::getLanguage();
		$lang->load( 'plg_authentication_openid', JPATH_ADMINISTRATOR );
		$langScript = 	'var JLanguage = {};'.
						' JLanguage.WHAT_IS_OPENID = \''.JText::_( 'WHAT_IS_OPENID' ).'\';'.
						' JLanguage.LOGIN_WITH_OPENID = \''.JText::_( 'LOGIN_WITH_OPENID' ).'\';'.
						' JLanguage.NORMAL_LOGIN = \''.JText::_( 'NORMAL_LOGIN' ).'\';'.
						' var comlogin = 1;';
		$document = &JFactory::getDocument();
		$document->addScriptDeclaration( $langScript );
		JHTML::_('script', 'openid.js');
endif;
 ?>
 <form action="<?php echo JRoute::_( 'index.php', true, $this->params->get('usesecure')); ?>" method="post" name="com-login" id="com-form-login"> 
<!--  <form action="<?php echo JRoute::_( 'index.php', true, $this->params->get('usesecure')); ?>" method="post" name="com-login" id="com-form-login"> -->
<!--<table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="contentpane<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
<tr>
	<td colspan="2">
		<?php if ( $this->params->get( 'show_login_title' ) ) : ?>
		<div class="componentheading<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
			<?php echo $this->params->get( 'header_login' ); ?>
		</div>
		<?php endif; ?>
		<div>
			<?php echo $this->image; ?>
			<?php if ( $this->params->get( 'description_login' ) ) : ?>
				<?php echo $this->params->get( 'description_login_text' ); ?>
				<br /><br />
			<?php endif; ?>
		</div>
	</td>
</tr>

</table>
-->
<?php 
if(isset($_GET['mess']) && $_GET['mess'] =='Success'){?>
	<div id="thongbao">Cảm ơn bạn đã đăng ký tài khoản ở www.mangluoibds.vn. Bạn đã có thể sử dụng toàn bộ các dịch vụ và hưởng các ưu đãi dành riêng cho thành viên website
.</div>
<?php 
}
?>
<?php 
if(isset($_GET['m'])=='fail'){?>
	<div id="thongbao">Thông tin tài khoản không chính xác, bạn vui lòng kiểm tra lại.</div>
<?php 
}
?>
<?php 
if(isset($_GET['mess']) && $_GET['mess'] =='rsps'){?>
	<div id="thongbao">Mật khẩu mới đã được tạo thành công.</div>
<?php 
}
?>
<div class='login'>
<div class="componentheading">Đăng nhập</div>
<table class="contentpane loginform">
	<tr>
		<td height="30" align="right" valign="top" style="line-height: 30px">
			<label for="username"><?php echo JText::_('Email') ?> đăng nhập:</label>
		</td>
		<td>
			<input name="username" id="username" type="text" class="inputbox" alt="username" size="18" />
		</td>
	</tr>
	<tr>
		<td height="30" align="right" valign="top" style="line-height: 30px">
			<label for="passwd"><?php echo JText::_('Password') ?>:</label>
		</td>
		<td>
			<input type="password" id="password" name="passwd" class="inputbox" size="18" alt="password" />
		</td>
	</tr>
	<tr>
		<td>
		</td>
		<td>
			<?php 
				if(JPluginHelper::isEnabled('system', 'remember')) : ?>
	
					<p id="com-form-login-remember">
					<label for="remember"><?php echo JText::_('Remember me') ?></label>
					<input type="checkbox" id="remember" name="remember" class="inputbox" value="yes" alt="Remember Me" />
					</p>
			<?php endif; ?>
			<span style="padding-left: 18px;text-decoration: underline;" class='clear'>
						<ul >
			<li class='login_marr'>
				<a href="<?php echo JRoute::_( 'index.php?option=com_user&view=reset&Itemid=19' ); ?>">
				<?php echo JText::_('FORGOT_YOUR_PASSWORD'); ?></a>
			</li>
			<?php
			$usersConfig = &JComponentHelper::getParams( 'com_users' );
			if ($usersConfig->get('allowUserRegistration')) : ?>
			<li class='login_marr'>
				<a href="<?php echo JRoute::_( 'index.php?option=com_user&task=register&Itemid=19' ); ?>">
					<?php echo JText::_('REGISTER'); ?></a>
			</li>
			<?php endif; ?>
		</ul>
						</span>
		</td>
	</tr>
	<tr>
		<td>
		</td>
		<td  style="padding-left: 29px;">
			<input type="submit" name="Submit" class="btn-search" value="<?php echo JText::_('LOGIN') ?>"/>
		</td>
	</tr>
</table>
</div>
	
	<input type="hidden" name="option" value="com_user" />
	<input type="hidden" name="task" value="login" />
	<input type="hidden" name="return" value="<?php echo $this->return; ?>" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>