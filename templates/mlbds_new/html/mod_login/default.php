

<?php

/*------------------------------------------------------------------------
# JA Zeolite for Joomla 1.5 - Version 1.0 - Licence Owner JA108425
# ------------------------------------------------------------------------
# Copyright (C) 2004-2008 J.O.O.M Solutions Co., Ltd. All Rights Reserved.
# @license - Copyrighted Commercial Software
# Author: J.O.O.M Solutions Co., Ltd
# Websites:  http://www.joomlart.com -  http://www.joomlancers.com
# This file may not be redistributed in whole or significant part.
-------------------------------------------------------------------------*/
 // no direct access
// echo"<script>alert('Không có online ')</script>";
defined('_JEXEC') or die('Restricted access'); ?>
<?php if($type == 'logout') : ?>
<div id="login-wrap">
<form action="index.php" method="post" name="login" id="login">
<?php if ($params->get('greeting')) : ?>
<ul>
	<li class='user-name'><?php echo JText::sprintf( 'HINAME', $user->get('name') ); ?></li>
<?php endif; ?>
		<li><a href="index.php?option=com_u_re&view=manage&Itemid=8" class='qltk'>Quản lý tài khoản</a></li>
		<li><input type="submit" name="Submit" class="button" value="<?php echo JText::_( 'BUTTON_LOGOUT'); ?>" style="text-transform: none;font-weight: bold;font-size: 12px" /></li>
</ul>	
	<input type="hidden" name="option" value="com_user" />
	<input type="hidden" name="task" value="logout" />
	<input type="hidden" name="return" value="<?php echo $return; ?>" />
</form>
</div>
<?php else : ?>
<?php if(JPluginHelper::isEnabled('authentication', 'openid')) : ?>
	<?php JHTML::_('script', 'openid.js'); ?>
<?php endif; ?>
<div id="login-wrap">
<form action="index.php" method="post" name="login" id="login" class='login_mlbds' >
	<?php echo $params->get('pretext'); ?>
	<ul>
	<li>
			<label for="mod_login_username" class="ja-login-user">
				
			
				<input name="username" id="mod_login_username" type="text" class="inputbox lg-input"  onfocus="if(this.value=='<?php echo JText::_('Username') ?>') this.value='';" onblur="if(this.value=='') this.value='<?php echo JText::_('Username') ?>';" value="<?php echo JText::_('Username') ?>" alt="username"/>
               
			</label>
    </li>	
	<li>
			<label for="mod_login_password" class="ja-login-password">
				
			<input type="password" id="mod_login_password" name="passwd" class="inputbox lg-input" value="<?php echo JText::_('Password') ?>" size="10" alt="password"  onfocus="if(this.value=='<?php echo JText::_('Password') ?>') this.value='';" onblur="if(this.value=='') this.value='<?php echo JText::_('Password') ?>';" />
			</label>
			</li><li>
			<label for="mod_login_remember">
				<input type="hidden" name="remember" id="mod_login_remember" class="inputbox" value="yes" alt="Remember Me" />
			</label></li>
			<li><input type="submit" name="Submit" class="button" value="Đăng Nhập" style="text-transform: none;font-weight: bold"  />
			</li>
<?php 
				$usersConfig = &JComponentHelper::getParams( 'com_users' );
				if ($usersConfig->get('allowUserRegistration')) : ?>
				
				<li><a class='button' href="<?php echo JRoute::_( 'index.php?option=com_user&task=register&Itemid=19' ); ?>" style="text-transform: none;font-weight: bold;font-size: 12px" >
					<?php echo JText::_('REGISTER'); ?></a>
				</li>
	</ul>		
			<?php endif; ?>
			<div class="ja-login-links">
			<!--<li>
			<a href="<?php echo JRoute::_( 'index.php?option=com_user&view=reset' ); ?>">
			<?php echo JText::_('FORGOT_YOUR_PASSWORD'); ?></a></li>
			<a href="<?php echo JRoute::_( 'index.php?option=com_user&view=remind' ); ?>">
			<?php echo JText::_('FORGOT_YOUR_USERNAME'); ?></a>-->
			
			</div>
	<?php echo $params->get('posttext'); ?>

	<input type="hidden" name="option" value="com_user" />
	<input type="hidden" name="task" value="login" />
	<input type="hidden" name="return" value="<?php echo $return; ?>" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>
</div>
<?php endif; ?>