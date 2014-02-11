<?php
defined('_JEXEC') or die('Restricted access');
require_once( JApplicationHelper::getPath('admin_html'));
JTable::addIncludePath(JPATH_COMPONENT.DS.'tables');
$task = JRequest::getCmd('task');

//$task = mosGetParam( $_REQUEST, 'task', '' );

	switch ( $task )
	{
		case 'save' :
			save();
			break;
		case 'cancel' :
			cancel();
			break;
		default:
			show();
			break;
	}
	
	function cancel()
	{
		global $mainframe;
		$mainframe->redirect('index.php');
	}
	function save()
	{
		HTML_project_slideshow::save();
	}

?>

<style type="text/css">

#project1
{
	
	display: block;
	
}
#session1
{
	
	display: none;
	
}
#categories1
{
	
	display: none;
	
}

</style>
<?php 
function show()
	{
		HTML_project_slideshow::show();
	}
?>