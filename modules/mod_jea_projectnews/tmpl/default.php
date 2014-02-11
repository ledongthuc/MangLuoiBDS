

<?php
defined('_JEXEC') or die('Restricted access');
if (count($lists) > 0) {
?>
	<table width='100%' cellpadding="0" cellspacing="0">
	<!--  <tr><td colspan='2' class='project_group'>Nhóm các dự án</td></tr>-->
	
			<?php 
			$k=0;
			$dem = 0;

			foreach($lists as $list)
			{
				$k++;
				$dem++;				
//				if($k==1)
				if(1)
				{ 	echo "<tr>";
					if ($dem < 3)
					{
						echo "<td width='50%' valign='top' style='border-top:1px solid silver;'>";
					} 
					else
					{
						echo "<td width='50%' valign='top' style='border-top:1px solid silver;' >";
					}
				}
//				else 
//				{
//					if ($dem < 3)
//					{
//						echo "<td width='50%' valign='top' class='border_right2'>";
//					}
//					else 
//					{
//						echo "<td width='50%' valign='top' style='border-top:1px solid silver;' class='border_right2'>";
//					}
//				}
//				if($list==null)
//					continue;
				modProjectGroupHelper::renderGroupProject($list[0]);// ten nhom du an
				echo "<table border='0'>";
				$i=0;
				foreach($list as $project)
				{
					echo "<tr><td>";
					if($i==0)
					{
			  			modProjectGroupHelper::renderProjectNew($project);
			  			$i=1;
					}
					else
						modProjectGroupHelper::renderProject($project);
			  		echo "</tr></td>";
				}
				echo "<tr><td class='link_show_all'><a href='" . modProjectGroupHelper::getProjectGroupLink($list[0]) . "' > >>Xem tất cả </a></td></tr>";
				echo "</table>";
			  	echo" </td>";
			  	echo "</tr>";
//			  	if($k==2)
//			  	{
//			  		echo " </tr>";
//			  		$k=0;
//			  	}
			}
//			if($k==1)echo " </tr>";
?>
<?php }?>
</table>
