<?php
function removetag($string){
$str=strip_tags($string);
//strip \r\n
$order = array("\r\n","\n","\r");
//$replace = '<br />';
$replace = ' ';
$str=str_replace($order,$replace,$str);
//remove tag
$pattern = "|{[^}]+}(.*){/[^}]+}|U";
$replacement = '';
return $str= preg_replace($pattern, $replacement, $str);
//return htmlspecialchars($str);
}
?>