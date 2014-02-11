<?php
function test($string)
{
	return 'heheheh<br>'.$string;	
}
function removetag($string)
{
	$str=strip_tags($string);
	//strip \r\n
	$order = array("\r\n","\n","\r");
	//$replace = '<br />';
	$replace = '<br />';
	$str=str_replace($order,$replace,$str);
	//remove tag
	$pattern = "|{[^}]+}(.*){/[^}]+}|U";
	$replacement = '';
	$str= preg_replace($pattern, $replacement, $str);
	return htmlspecialchars($str);
	//return $str;
}
function getItemImg( $id=0 )
	{
		if ( is_file( JPATH_ROOT.DS.'images'.DS.'com_jea'.DS.'images'.DS.$id.DS.'min.jpg' ) ){
			
			return JURI::root().'images/com_jea/images/'.$id.'/min.jpg' ;
		}
		
		return false;
	}
?>