<?php
defined('_JEXEC') or die('Restricted access');
require(dirname(__FILE__).DS.'helper.php');

$loai_slide_show =  U_ReConfig::getValueByKey( 'SLIDESHOWIMAGE', 'loai_slide_show' );

if ( $loai_slide_show == "project")
{
	// slideshow cho du an
	$getprovalueTitle= mod_project_slideshowHelper::getProjectValueTitle( $params);
}
else
{
	// slideshow cho bai viet
	$getprovalueTitle= mod_project_slideshowHelper::getSessionvalue();
}

/* lay thong tin moi */
 $getnew= mod_project_slideshowHelper::getnew();  

$speed =  U_ReConfig::getValueByKey( 'SLIDESHOWIMAGE', 'speed' );

require('libraries/com_u_re/php/slideshow.php');
require(JModuleHelper::getLayoutPath('mod_project_slideshow', 'default'));
?>
