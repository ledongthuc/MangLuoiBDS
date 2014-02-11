<?php
/**
 * Google  Map default controller
 * 
 * @package    Joomla.component
 * @subpackage Components
 * @link http://inetlanka.com
 * @license		GNU/GPL
 * @auth inetlanka web team - [ info@inetlanka.com / inetlankapvt@gmail.com ]
 */
jimport('joomla.application.component.controller');

/**
 * com_google Component Controller
 *
 * @package		com_google
 */
class GoogleController extends JController
{
	/**
	 * Method to display the view
	 *
	 * @access	public
	 */
	function display()
	{
		parent::display();
	}
	function sendMail()
	{
		
		$senderName	= JRequest::getVar( 'myName', 0, '', 'text' );
		
		//Chau: Get phone and join to name
		$senderPhone	= JRequest::getVar( 'myPhone', 0, '', 'text' );
		$senderName	.= "-".$senderPhone;
		
		$friendEmail	= JRequest::getVar( 'myEmail', 0, '', 'text' );
		$mailHeading	= JRequest::getVar( 'messHeading', 0, '', 'text' );
		$messText	= JRequest::getVar( 'messateTxt', 0, '', 'text' );
		$copyOfmail	= JRequest::getVar( 'copyOfmail', 0, '', 'text' );
		$ourEmail	= JRequest::getVar( 'ourEmail', 0, '', 'text' );
		$googleId	= JRequest::getInt( 'id',			0,			'post' );
		$googleItemId	= JRequest::getInt( 'Itemid',			0,			'post' );
		$googleRedItemId	= JRequest::getInt( 'RedirectLinkComGoogle',			0,			'post' );
		
		require("class.phpmailer.php");
		global $u_reGlobalConfig;
		$mailphp = new PHPMailer();
		
		$url  = JURI::base();
		$mess = file_get_contents($url.'components/com_google/template.html');
		$mess = str_replace('%noidung%', $messText, $mess);
		$mess = str_replace('%tieude%', $mailHeading, $mess);
		$mess = str_replace('%name%', $senderName, $mess);
		$mess = str_replace('%phone%', $senderPhone, $mess);
		$mess = str_replace('%email%', $friendEmail, $mess);
		
		$mailphp->From = "info@mangluoibds.vn";
		$mailphp->FromName = "Mạng lưới Bất động sản";		
		$mailphp->AddAddress($ourEmail);
		$mailphp->Subject= $mailHeading;
		$mailphp->MsgHTML($mess);
		$mailphp->CharSet='UTF-8';
		$se = $mailphp->Send();			
		$msg = JText::_('GOOGLE_THANKS');
		if($friendEmail != "")
		{
			$mailphp1 = new PHPMailer();		
			$url  = JURI::base();
			$mess = file_get_contents($url.'components/com_google/template1.html');
			$mess = str_replace('%noidung%', $messText, $mess);
			$mess = str_replace('%email%', $friendEmail, $mess);
			
			$mailphp1->From = "info@mangluoibds.vn";
			$mailphp1->FromName = "Mạng lưới Bất động sản";		
			$mailphp1->AddAddress($friendEmail);
			$mailphp1->Subject= $mailHeading;
			$mailphp1->MsgHTML($mess);
			$mailphp1->CharSet='UTF-8';
			$se = $mailphp1->Send();		
			
			$msg = 'Thông tin đã được gửi thành công';
		}
		else
		{
			$msg = 'Thông tin đã được gửi thành công';
		}
		
		$link = JRoute::_('index.php?option=com_google&view=google&id='.$googleId.'&Itemid='.$googleItemId, false);
		
		$this->setRedirect($link, $msg);}

}
?>
