<div id='vhl_login'>
<table width="100%" border="0">
<tbody>
<tr>

<?php 
//jimport( 'joomla.application.application' );
global $mainframe;
$user =& JFactory::getUser();
if($user->get('name'))
{
	echo "<td><a href=\"index.php?option=com_user&task=logout+&Itemid=1&lang=vi\">Đăng xuất </a></td>";
}
else
{	
	echo "<td><a href=\"index.php?option=com_user&amp;view=login&amp;Itemid=12&amp;lang=vi\">Đăng nhập &nbsp|</a></td>";
	echo "<td><a href=\"index.php?option=com_user&amp;view=register&amp;Itemid=12&amp;lang=vi\">Đăng ký</a></td>";
}

if(JFactory::getURI()->getVar("task") == 'logout')
{
	$mainframe->redirect('index.php');
}
?>
<td><a href="ymsgr:sendim?<?php echo $arrayYahooId[0]?>"><img style="float: left;" alt="iconyahoo" src="images/stories/iconyahoo.png" width="24" height="22" /><?php echo  $arrayText[0]?></a></td>
<td><a href="skype:<?php echo $arrayYahooId[1] ?>?call"><img style="float: left;" alt="iconyahoo" src="images/stories/tigia.png" width="24" height="22" /><?php echo  $arrayText[1]?></a></td>
<td>
<a  style="cursor:pointer" onclick="reNameUrlLanguage('vi')"><img src="images/stories/vi.jpeg" /> </a>
</td>
<td>
 <a  style="cursor:pointer" onclick="reNameUrlLanguage('en')"><img src="images/stories/us.gif" /></a>
</td>

</tr>
</tbody>
</table>
<div></div>
</div>
