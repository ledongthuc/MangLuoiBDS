<style type="text/css">
#login-wrap form #mod_login_username,
#login-wrap form #mod_login_password {
	width: 95%;
	margin: 2px 0 5px;
	font-size: 12px !important;
	padding: 2px;
	background: #FFFFFF;
	border: 1px solid #DDDDDD;
}
</style>
<?php // no direct access

defined('_JEXEC') or die('Restricted access'); ?>
<?php if($type == 'logout') : ?>
<form action="index.php" method="post" name="login" id="form-login">
<?php if ($params->get('greeting')) : ?>
	<div>
	<?php if ($params->get('name')) : {
		echo JText::sprintf( 'HINAME', $user->get('name') );
	} else : {
		echo JText::sprintf( 'HINAME', $user->get('username') );
	} endif; ?>
	</div>
<?php endif; ?>
	<div align="center">
		<input type="submit" name="Submit" class="button" value="<?php echo JText::_( 'BUTTON_LOGOUT'); ?>" />
	</div>

	<input type="hidden" name="option" value="com_user" />
	<input type="hidden" name="task" value="logout" />
	<input type="hidden" name="return" value="<?php echo $return; ?>" />
</form>
<?php else : ?>
<?php if(JPluginHelper::isEnabled('authentication', 'openid')) :
		$lang->load( 'plg_authentication_openid', JPATH_ADMINISTRATOR );
		$langScript = 	'var JLanguage = {};'.
						' JLanguage.WHAT_IS_OPENID = \''.JText::_( 'WHAT_IS_OPENID' ).'\';'.
						' JLanguage.LOGIN_WITH_OPENID = \''.JText::_( 'LOGIN_WITH_OPENID' ).'\';'.
						' JLanguage.NORMAL_LOGIN = \''.JText::_( 'NORMAL_LOGIN' ).'\';'.
						' var modlogin = 1;';
		$document = &JFactory::getDocument();
		$document->addScriptDeclaration( $langScript );
		JHTML::_('script', 'openid.js');
endif; ?>
<div id="login-wrap" style="margin-bottom:3px; margin-left:10px;" >
<div>
<form action="<?php echo JRoute::_( 'index.php', true, $params->get('usesecure')); ?>" method="post" name="login" id="login" >
	<?php echo $params->get('pretext'); ?>

			<label for="mod_login_username" class="ja-login-user">
				<span><?php echo JText::_('Username') ?></span>
				<input name="username" id="mod_login_username" type="text" class="inputbox" alt="username" size="10" /><br />
			</label>

			<label for="mod_login_password" class="ja-login-password">
				<span><?php echo JText::_('Password') ?></span><br />
				<input type="password" id="mod_login_password" name="passwd" class="inputbox" size="10" alt="password" />
			</label>

			<label for="mod_login_remember">
				<input type="hidden" name="remember" id="mod_login_remember" class="inputbox" value="yes" alt="Remember Me" />
			</label>
			
			<div class="ja-login-links">
			<a href="<?php echo JRoute::_( 'index.php?option=com_user&view=reset&Itemid=19' ); ?>">
			<?php echo JText::_('FORGOT_YOUR_PASSWORD'); ?></a>
			<a href="<?php echo JRoute::_( 'index.php?option=com_user&view=remind&Itemid=19' ); ?>">
			<?php echo JText::_('FORGOT_YOUR_USERNAME'); ?></a>
			
			<?php 
				$usersConfig = &JComponentHelper::getParams( 'com_users' );
				if ($usersConfig->get('allowUserRegistration')) : ?>
				<a href="<?php echo JRoute::_( 'index.php?option=com_user&task=register&Itemid=19' ); ?>">
					<?php echo JText::_('REGISTER'); ?></a>
			<?php endif; ?>
			</div>
			<div width="100%" style="text-align:center">
			<input type="submit" name="Submit" class="button" value="<?php echo JText::_('BUTTON_LOGIN'); ?>" />
			</div>

			
	<?php echo $params->get('posttext'); ?>

	<input type="hidden" name="option" value="com_user" />
	<input type="hidden" name="task" value="login" />
	<input type="hidden" name="return" value="<?php echo $return; ?>" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>
</div>
</div>
<?php endif; ?>