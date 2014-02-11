<?php
defined('_JEXEC') or die('Restricted access');

// Include the syndicate functions only once
require_once (dirname(__FILE__).DS.'helper.php');

$rows = modCommentbox::getList($params);
$total= modCommentbox::getTotalRows($params);
$limit   = $params->get('sotin');
$componentName = $params->get('component_name');
$topicId = $params->get('id');
$topicName = $params->get('topic_name');
require(JModuleHelper::getLayoutPath('mod_commentbox'));