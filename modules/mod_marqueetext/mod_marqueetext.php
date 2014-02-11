<?php
defined("_JEXEC") or die("Restricted Access");
require_once ( dirname(__FILE__).DS.'helper.php' );

$hinhanh=$params->get("hinhanh");
$tieude=$params->get("tieude");
	
$arrayhinh = explode("\n", $hinhanh);
$arraytieude = explode("\n", $tieude);

require(JModuleHelper::getLayoutPath('mod_marqueetext','chuchay'));
?>
