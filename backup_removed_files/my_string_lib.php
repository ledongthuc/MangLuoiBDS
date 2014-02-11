<?php
// return string that cut from original string with length
function fixContentLenght($str, $length)
{
	$string = strip_tags(str_replace('[...]', '...', $str));
	$tempStr = substr($string, 0, $length);		
	return substr($tempStr, 0, strrpos($tempStr, " ", -1)) . " ...";
}
?>