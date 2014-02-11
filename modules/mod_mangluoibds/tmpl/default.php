<?php
/**
* @package Author
* @author thongdd
* @website http://thietkewebbatdongsan.com
* @email thongdd@i-land.vn
* @copyright 2013
* @license 
**/

// no direct access
defined('_JEXEC') or die('Restricted access');



?>
<link rel="stylesheet" href="modules/mod_mangluoibds/tmpl/reveal.css">	
<script type="text/javascript" src="modules/mod_mangluoibds/tmpl/jquery.reveal.js"></script>


			
		
			
<div id="myModal" class="reveal-modal">
	<div id="showbox" class="facebook">
<div class="pp_top fb_top">
			<div class="pp_left fb_left"></div>
			<div class="pp_middle fb_middle"></div>
			<div class="pp_right fb_right"></div>
</div>
<div class="pp_content_container fb_content_container">
		<div class="pp_left fb_left ">
			<div class="pp_right fb_right">
	
	<div class='dangnhapdangtin'>		
	<form action="index.php" method="post" name="login1">
			<div class='clear register-mes-ct'>
						<div style="text-align: center"><i id="error-login"></i></div>
						<div class='nl-s'>
						
						<div>
							<h3>Bạn chưa có tài khoản?</h3>
							<div id="popup_dangky">
								<a class='btn-search' href="<?php echo JRoute::_( 'index.php?option=com_user&task=register&Itemid=19' ); ?>">
								<?php echo JText::_('Đăng ký'); ?></a>
							</div>
							</div>
							<div class="popup_dangtin_nonuser">
								<a class='btn-search1' href="index.php?option=com_u_re&view=manage&layout=form&&task2=noregister&Itemid=226&lang=vi"><?php echo JText::_('Đăng tin không cần tài khoản'); ?></a>
							</div>
						</div>
						<div class='nl-r'>
						<h3>Bạn đã có tài khoản</h3>
				<table>
					<tr>
							<td height="30" align="right">
								<label id="usernamemsg" for="username">
								Email đăng nhập:
								</label>
							</td>
							<td>
								<input type="text" id="username" name="username" size="30" value="" maxlength="25"><div id="msgErrUsername"><input type="hidden" id="userFail" value="0"></div>
							</td>  
					</tr>
					<tr>
							<td height="30" align="right">
								<label id="pwmsg" for="password">
								Mật khẩu:
								</label>
							</td>
							<td>
							<input type="password" id="password" name="passwd" size="30" value="" >
							</td>
					</tr>
					<tr>
						<td>
						</td>
						<td style="padding-left: 29px">
						<input type="button" name="Submit" class="btn-search" value="Đăng nhập" onclick="checkLogin('login1')" />
							<span class='clear'>
							<a href='<?php echo JRoute::_( 'index.php?option=com_user&view=reset&Itemid=19' )?>'>Quên mật khẩu?</a>
							</span>
						</td>
					</tr>
					
				</table>
				</div>
				<div class='clear'>
				</div>
			</div>
			<input type="hidden" name="option" value="com_user" />
			<input type="hidden" name="task" value="login" />
			<input type="hidden" name="goto" value="dangtin" />
			<?php echo JHTML::_( 'form.token' ); ?>
			<input type="hidden" name="return" value="<?php echo $return; ?>" />
			</form>
		</div>
	<a class="close-reveal-modal">&nbsp;</a>
</div>
		</div>
</div>
<div class="pp_bottom fb_bottom">
			<div class="pp_left1 fb_left"></div>
			<div class="pp_middle fb_middle"></div>
			<div class="pp_right fb_right"></div>
		</div>
</div>
	
	</div>
			
<div id="taoyeucau" class="reveal-modal">
<div id="showbox" class="facebook">
<div class="pp_top fb_top">
			<div class="pp_left fb_left"></div>
			<div class="pp_middle fb_middle"></div>
			<div class="pp_right fb_right"></div>
</div>
<div class="pp_content_container fb_content_container">
		<div class="pp_left fb_left ">
			<div class="pp_right fb_right">



	<div class='dangnhapdangtin'>		
	<form action="index.php" method="post" name="login2">
			<div class='clear register-mes-ct'>
			<div style="text-align: center"><i id="error-login-1"></i></div>
			<div class='nl-s'>
			<div>
							<h3>Bạn chưa có tài khoản?</h3>
							<div id="popup_dangky">
								<a class='btn-search'href="<?php echo JRoute::_( 'index.php?option=com_user&task=register&Itemid=19' ); ?>"><?php echo JText::_('Đăng ký'); ?></a>
							</div>
							</div>
							<div class="popup_dangtin_nonuser">
								<a class='btn-search1' href="index.php?option=com_content&view=frontpage&Itemid=247&lang=vi"><?php echo JText::_('Tạo yêu cầu không cần tài khoản'); ?></a>
							</div>
			</div>
			<div class='nl-r'>
			<h3>Bạn đã có tài khoản?</h3>
				<table>
					<tr>
							<td height="30" align="right">
								<label id="usernamemsg" for="username">
								Email đăng nhập:
								</label>
							</td>
							<td>
								<input type="text" id="username" name="username" size="30" value="" maxlength="25"><div id="msgErrUsername"><input type="hidden" id="userFail" value="0"></div>
							</td>  
					</tr>
					<tr>
							<td height="30" align="right">
								<label id="pwmsg" for="password">
								Mật khẩu:
								</label>
							</td>
							<td>
							<input type="password" id="password" name="passwd" size="30" value="" >
							</td>
					</tr>
					<tr>
						<td>
						</td>
						<td style="padding-left: 29px;">
						<input type="button" name="Submit" class="btn-search" value="Đăng nhập"  onclick="checkLogin('login2')"  />
							<span class='clear'>
							<a href='<?php echo JRoute::_( 'index.php?option=com_user&view=reset&Itemid=19' )?>'>Quên mật khẩu?</a>
							</span>
						</td>
					</tr>
					
				</table>
			</div>
				<div class='clear'>
</div>				
			</div>
			<input type="hidden" name="option" value="com_user" />
			<input type="hidden" name="task" value="login" />
			<input type="hidden" name="goto" value="taoyeucau" />
			<?php echo JHTML::_( 'form.token' ); ?>
			<input type="hidden" name="return" value="<?php echo $return; ?>" />
			</form>
		</div>
	<a class="close-reveal-modal">&nbsp;</a>

	</div>
		</div>
</div>
<div class="pp_bottom fb_bottom">
			<div class="pp_left1 fb_left"></div>
			<div class="pp_middle fb_middle"></div>
			<div class="pp_right fb_right"></div>
		</div>
	
	
</div>	
	</div>
<script type="text/javascript" >
function checkLogin(formname){
	form = document.forms[formname];
	var check = 'true';
	var err = '';
	if(form.username.value==''){
		err += "Email không được để trống";
		form.username.style.borderColor='red';
		check = 'false';
	}else{
		if(!validate_Email_Address_n(form.username.value)){
			err +='Email không hợp lệ';
			form.username.style.borderColor='red';
			check = 'false';
		}
	}
	if(form.passwd.value==''){
		if(err!=''){
			err += ',';
		}
		err += " Mật khẩu không được để trống";
		form.passwd.style.borderColor='red';
		check = 'false';
	}
	if(check == 'false'){
		if(formname == 'login2'){
			document.getElementById('error-login-1').innerHTML = err;
			document.getElementById('error-login-1').style.color = 'red';
		}
		document.getElementById('error-login').innerHTML = err;
		document.getElementById('error-login').style.color = 'red';
		if(err=='Email không được để trống, Mật khẩu không được để trống' || err=='Email không được để trống' ||err=='Email không hợp lệ, Mật khẩu không được để trống' || err=='Email không hợp lệ'){
			form.username.focus();
		}else{
			form.passwd.focus();
		}
		return false;
	}else{
		form.submit();
	}
	
}
function validate_Email_Address_n(email){
	var emailValid = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
	if(emailValid.test(email)){
		return true;
	}
	return false;
}
</script>