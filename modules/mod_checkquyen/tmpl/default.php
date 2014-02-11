<?php

/**
* @package Author
* @author danhthong
* @website 
* @email danhthong@gmail.com
* @copyright 
* @license 
**/

// no direct access
defined('_JEXEC') or die('Restricted access');
?>
<script>
function checkquyen4(){
	$.ajax({
			url:'savedata.php',
			type:'POST',
			data:{
				abc:'1'
			}, 
			success:function(data) {
				document.ckquyen.submit();  
			}			
		});
} 
</script>
<style>
	.tb td{border:1px solid #CCC}
	.tb tr{border:1px solid #CCC} 
	.tb th{border:1px solid #CCC}
</style>
<div class="moduletablenoidung" style="background-color: #DFE7EF;margin-top:-20px">
<h3>Thông tin quyền</h3>
<table class="tb" cellpadding="0" border="0px"  width="100%" > 
	<tr> 
		<th width="40%">Loại quyền</th> 
		<th width="30%">Thường</th>
		<th width="30%">Khuyến mãi</th>
 	</tr>
	<tr>
		<th>Đẩy tin</th>
		<td><center><?php echo $quyen->mua_daytin ?></center></td>
		<td><center><?php echo $quyen->km_daytin ?></center></td>
	</tr>
	<tr>
		<th>Đánh dấu</th>
		<td><center><?php echo $quyen->mua_danhdau ?></center></td>
		<td><center><?php echo $quyen->km_danhdau ?></center></td>
	</tr>
	<tr>
		<th>Nổi bật</th>
		<td><center><?php echo $quyen->mua_noibat ?></center></td>
		<td><center><?php echo $quyen->km_noibat ?></center></td>
	</tr>
	<tr>
		<td colspan="3" border="0px" align="center">     
		<form action="index.php?option=com_history&Itemid=243" method="post" name="ckquyen">
			<input type="button" onclick="checkquyen4();" class="sb_ck2"  value="Nạp quyền"></td>
			<input type="hidden" name="option" value="com_history" />
			<input type="hidden" name="Itemid" value="243" />
			<input type="hidden" name="napquyen" value="1" /> 
		</form>
	</tr>

</table>

</div> 
