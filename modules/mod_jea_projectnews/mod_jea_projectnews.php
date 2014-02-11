<?php
defined('_JEXEC') or die('Restricted access');
// Added style sheet
$doc = & JFactory::getDocument();
$css = JURI::base().'modules/mod_jea_projectnews/css/styles.css';
$doc->addStyleSheet($css);//include css.

require(dirname(__FILE__).DS.'helper.php');
//

$lists = modProjectGroupHelper::getProjectGroup($params);
require(JModuleHelper::getLayoutPath('mod_jea_projectnews', 'default'));

?>
