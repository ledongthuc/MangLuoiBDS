<?php
// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// Require the base controller
require_once( JPATH_COMPONENT.DS.'controller.php' );

$controller = new UsergroupsController();

$controller->execute( JRequest::getWord( 'task' ) );

$controller->redirect();