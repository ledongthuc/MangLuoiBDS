
<?php defined('_JEXEC') or die('Restricted access');
$path_image = modProjectGroupHelper::getImageProject($project->project_id);
?>
 <div><a href="<?php echo $link_project ?>"><?php echo $project->project_name; ?> </a> </div>
<div class='mod_projectnew_project'>
<a href="<?php echo $link_project ?>"><img src="<?php echo $path_image; ?>"/></a>
<p><?php echo $project->short_desc; ?></p>
</div>

