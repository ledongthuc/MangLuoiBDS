<?php
jimport( 'joomla.application.component.view' ); 
JToolBarHelper::title( JText::_( 'Quản lí Bảng báo giá' ),'generic.png'); 
$parent=31;
$group = JFactory::getUser()->gid;
if ($group!=25) die('Restrict Access !');?>
<?php 
	if (isset($_GET['del'])){
		$cmd="DELETE FROM `jos_price` WHERE id=".$_GET['del'];
		mysql_query($cmd);
	}
	if (isset($_POST['add'])){ 
		$type=$_POST['type'];
		$group=$_POST['group'];
		$price=$_POST['price'];  
		$min=$_POST['min'];
		$max=$_POST['max']; 
		$discount=$_POST['discount'];     
		$cmd="INSERT INTO `jos_price` (id,types,groups,price,discount,min,max) VALUES ('',".$type.",'".$group."',".$price.",".$discount.",".$min.",".$max.")";
		mysql_query($cmd);
	} else
	if (isset($_POST['saveck'])){
		$cmd="SELECT * FROM `jos_price` LIMIT 0,1";
		$info=mysql_fetch_assoc(mysql_query($cmd));
		$cmd='UPDATE `jos_price` SET km='.$_POST['chietkhau'].' WHERE id='.$info['id']; 
		mysql_query($cmd); 
		header('location:index.php?option=com_price');
	} else 
	if (isset($_POST['save'])){
		$type=$_POST['type'];
		$group=$_POST['group']; 
		$price=$_POST['price'];
		$min=$_POST['min'];
		$discount=$_POST['discount'];   
		$max=$_POST['max'];      
		$cmd="UPDATE `jos_price` SET types=$type,groups='$group',price=$price,discount=$discount,min=$min,max=$max WHERE id=".$_GET['edit'];
		mysql_query($cmd);
		
		// SAVE CHIEC KHAU CHUNG
		header('location:index.php?option=com_price');
	};
?>
<style> 
	.title{font-size:15pt;}
	.pricetb{width:600px;}
</style>
<table>
<td width="650px" style="vertical-align:top">
<div class="title">Bảng giá</div>
<table border="1" class="pricetb">
	<th>Loại</th>
	<th>Nhóm người dùng</th>
	<th>Giá gốc</th>
	<th>Giá giảm</th> 
	<th>Số lượng từ</th> 
	<th>Đến</th>
    <th>Sửa</th>
	<th>Xoá</th>
    <?php 
		$cmd="SELECT * FROM `jos_price` ORDER BY types ASC";
		$excute=mysql_query($cmd);
		while ($info=mysql_fetch_array($excute,MYSQL_ASSOC)){
			echo '<tr>';
			echo '<td>';
				if ($info['types']==1) echo ' Đẩy tin'; else if ($info['types']==2) echo ' Đánh dấu'; else echo ' Nổi bật';
			echo '</td>'; 
			echo '<td>';
			if ($info['groups']==0) echo 'Non-User'; else echo 'User';
			echo '</td>';			
			echo '<td>'.$info['price'].'</td>';
			echo '<td>'.$info['discount'].'</td>';
			echo '<td>'.$info['min'].'</td>';
			echo '<td>'.$info['max'].'</td>';
			echo '<td><a href="index.php?option=com_price&edit='.$info['id'].'">Sửa</a></td>';
			echo '<td><a href="index.php?option=com_price&del='.$info['id'].'">Xoá</a></td>';
			echo '</tr>';
		}
	?> 
</table>
</td>
<td  style="vertical-align:top">
<?php
 if (isset($_GET['edit'])){ 
$cmd="SELECT * FROM `jos_price` WHERE id=".$_GET['edit'];
$inf=mysql_fetch_assoc(mysql_query($cmd));		
$cmd="SELECT * FROM `jos_price` LIMIT 0,1";
$inf2=mysql_fetch_assoc(mysql_query($cmd));
 ?>
<div class="title">Sửa giá</div>  
<form method="POST">
<table>
<tr><td>
	Loại</td><td><select name="type">
		<option value="1" <?php if ($inf['types']==1) echo 'selected'; ?>>Đẩy tin</option>
		<option value="2" <?php if ($inf['types']==2) echo 'selected'; ?>>Đánh dấu</option>
		<option value="3" <?php if ($inf['types']==3) echo 'selected'; ?>>Nổi bật</option>
	</select></td></tr>
	<tr><td>Nhóm</td><td> 
		<select size="10" name="group">
			<option value="0" <?php if ($inf['groups']==0) echo 'selected';?>>Non-User</option> 
			<option value="1" <?php if ($inf['groups']==1) echo 'selected'; ?> >User</option>				
		</select> 
	</td></tr> 
	<tr><td>Giá gốc</td><td><input type="text" name="price" value="<?php echo $inf['price'];?>" size="20"/></td></tr>
	<tr><td>Giá giảm</td><td><input type="text" name="discount" value="<?php echo $inf['discount'];?>" size="20"/></td></tr>
	<tr><td>Từ</td><td><input type="text" name="min" size="20" value="<?php echo $inf['min'];?>"/></td></tr>
	<tr><td>Đến</td><td><input name="max" type="text" size="20" value="<?php echo $inf['max'];?>"/></td></tr>
	<tr><td><input type="submit" name="save" value="Lưu lại"/></td></tr>

</table> 
<input name="option" value="com_price" type="hidden">
</form>      
 <?php } else {
 ?>
  
<div class="title">Thêm giá</div>
<form method="POST">
<table>
<tr><td>Loại</td><td><select name="type">
		<option value="1">Đẩy tin</option>
		<option value="2">Đánh dấu</option>
		<option value="3">Nổi bật</option>
	</select></td></tr>
	<tr><td>Nhóm</td><td>
		<select size="10" name="group[]" multiple>
			<?php
				$cmd="SELECT * FROM `jos_core_acl_aro_groups` WHERE parent_id=".$parent;
				$excute=mysql_query($cmd);
				while ($info=mysql_fetch_array($excute,MYSQL_ASSOC)){	
					echo '<option value='.$info['id'].'>'.$info['name'].'</option>'; 
				}
			?>			
		</select>	
	</td></tr>
	<tr><td>
	Giá gốc</td><td><input type="text" name="price" size="20"/></td></tr>
	<tr><td>
	Giá giảm</td><td><input type="text" name="discount" size="20"/></td></tr>
	<tr><td>
	Từ</td><td><input type="text" name="min" size="20"/></td></tr>
	<tr><td>Đến</td><td><input name="max" type="text" size="20"/></td></tr>
	<tr><td><input type="submit" name="add" value="Thêm"/></td></tr>
</table>
<input name="option" value="com_price" type="hidden">
</form>
<?php } ?>
</td>
<td  style="vertical-align:top">
<div class="title">Chiết khấu chung hệ thống</div>
<form method="POST">
<?php 
$cmd="SELECT * FROM `jos_price` LIMIT 0,1"; 
$inf2=mysql_fetch_assoc(mysql_query($cmd));?>
Chiết khấu chung &nbsp <input type="text" size="10" value="<?php echo  $inf2['km'];?>"name="chietkhau"/>%
<br/>
<input type="submit" name="saveck" value="Lưu lại"/>
<input name="option" value="com_price" type="hidden">
</form>
</td>
</table>
	     