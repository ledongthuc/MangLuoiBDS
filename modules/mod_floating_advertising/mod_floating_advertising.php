<?php
// Don't allow direct access to the file
defined( '_JEXEC' ) or die( 'Restricted access' );
require_once(dirname(__FILE__).DS.'helper.php');

  $width = $params->get( 'width', 150 );
  $height = $params->get( 'height', 50 );
  $padding = $params->get( 'padding', 5);
  $distance_right_left = $params->get('distance_right_left', 0);
  $target_top_bottom = $params->get('target_top_bottom');
  $distance_top_bottom = $params->get('distance_right_left', 0);
  $image_right_banner = $params->get('image_right_banner', 0);
  $link_right_banner = $params->get('link_right_banner', 0);
  $image_left_banner = $params->get('image_left_banner', 0);
  $link_left_banner = $params->get('link_left_banner', 0);
  
  $htmlText = ModFloatingAdvertising::getHTMLText($width, $height, $padding, $distance_right_left, $target_top_bottom, $distance_top_bottom, $image_right_banner, $image_left_banner, $link_left_banner, $link_right_banner);
  require(JModuleHelper::getLayoutPath('mod_floating_advertising'));
?>