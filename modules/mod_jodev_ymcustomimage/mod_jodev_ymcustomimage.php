<?php

/**
* @version $Id: mod_jodev_ym_custom_image.php 1.1
* Jodev Yahoo Messenger Custom Image
* Created by Jerry Wijaya - http://www.jerrywijaya.com
* Email: me@jerrywijaya.com
* URL: - http://www.jerrywijaya.com
* 		 - http://www.joodev.com
* Created date: August, 2008
* @package Joomla 1.5.4
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Joomla is Free Software
*/

/** ensure this file is being included by a parent file **/
defined('_JEXEC') or die( 'Restricted access' );

$uri =& JURI::getInstance();

$moduleclass_sfx 	= $params->get( 'moduleclass_sfx', '' );
//$yahooid 					= $params->get( 'yahooid', 'jerry.lavista' );
$style 						= $params->get( 'style', "0" );
$yahooimage 			= $params->get( 'yahooimage', "0" );
$customimage 			= $params->get( 'customimage', "0" );
$align 						= $params->get( 'align', "center" );

$strYahooId=$params->get('arrayYahooId');
$strTest=$params->get('arrayTest');

$arrayYahooId = explode("\n", $strYahooId);
$arrayText = explode("\n", $strTest);


$image_online 		= $params->get( 'yahooimage', $uri->base() . "/modules/mod_jodev_ymcustomimage/jodev_ymcustomimage/customonline0.gif" );
$image_offline 		= $params->get( 'image_offline', $uri->base() . "/modules/mod_jodev_ymcustomimage/jodev_ymcustomimage/customonffine0.gif" );

/* ham kiem tra xem co online ko */
function testonline($nickname)
{
		$pageurl = "http://mail.opi.yahoo.com/online?u=".$nickname."&m=a&t=1";
		$file = fopen($pageurl, "r");
		$read = fread($file, 200);
		$read = ereg_replace($nickname, "", $read);
		if ($y = strstr ($read, "01"))
		{
			$image_online ='images/stories/kp/yahoo.png';
		}
		elseif($y = strstr ($read, "00"))
		{
			$image_online = 'images/stories/kp/yahoo_offline.png';
		}
		fclose($file);
		$result = "<div align=\"center\"><a href=\"ymsgr:sendIM?$nickname\"><img  alt=\"iconyahoo\" src=\"$image_online\" width=\"60\" height=\"57\" /></a></div>";
		
		return $result;
	
}
		
function testonline_footer($nickname)
{
		$pageurl = "http://mail.opi.yahoo.com/online?u=".$nickname."&m=a&t=1";
		$file = fopen($pageurl, "r");
		$read = fread($file, 200);
		$read = ereg_replace($nickname, "", $read);
		if ($y = strstr ($read, "01"))
		{
			$image_online ='images/stories/kp/yahoo_footer.png';
		}
		elseif($y = strstr ($read, "00"))
		{
			$image_online = 'images/stories/kp/yahoo_offline_footer.png';
		}
		fclose($file);
		$result = "<a href=\"ymsgr:sendIM?$nickname\"><img  alt=\"iconyahoo\" src=\"$image_online\" width=\"15px\" height=\"15px\" /></a>";
		
		return $result;
	
}			
	

//	require(JModuleHelper::getLayoutPath('mod_jodev_ymcustomimage', 'default'));
	//require(JModuleHelper::getLayoutPath('mod_jodev_ymcustomimage', 'kp'));
//	require(JModuleHelper::getLayoutPath('mod_jodev_ymcustomimage', 'footer_kp'));
	require(JModuleHelper::getLayoutPath('mod_jodev_ymcustomimage','default'));
?>
