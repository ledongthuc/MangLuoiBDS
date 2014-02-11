<?php
defined('_JEXEC') or die('Restricted access');
// Added style sheet
//$doc = & JFactory::getDocument();
//$css    = JURI::base().'modules/mod_emphasisnews/css/styles.css';
//$doc->addStyleSheet($css);

require(dirname(__FILE__).DS.'helper.php');
//

$list = modEmphasisNewsHelper::getEmphasisNews($params);


require(JModuleHelper::getLayoutPath('mod_jea_newsfp', 'default'));
?>
