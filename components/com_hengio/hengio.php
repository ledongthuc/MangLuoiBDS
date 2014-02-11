<?php
defined('_JEXEC') or die( 'Restricted access'); 
global $mainframe,$option;
jimport('joomla.html.pagination');
$db =& JFactory::getDBO(); 
$lim    = $mainframe->getUserStateFromRequest("$option.limit", 'limit', 14, 'int'); //I guess getUserStateFromRequest is for session or different reasons
$lim0   = JRequest::getVar('limitstart', 0, '', 'int');
$user =& JFactory::getUser();
if ($user->id==0) header('location:'.JURI::base());  
// RELOAD PERMISION 
$db->setQuery('SELECT * FROM `jos_push` WHERE user='.$user->id); 
$db->query();  
$info=$db->loadObjectList();
$time=time();
foreach ($info as $row) {
	if ($row->mua==0&&$row->km==0) continue;
	if ($row->end<$time) continue;
    if ($row->start>$time) continue;  
	$remain=($row->km+$row->mua)-floor(($row->end-$time)/86400); 
	// UPDATE DB DESC            
	$km=$row->km-$remain;   
	if ($km>=0) $db->setQuery('UPDATE `jos_push` SET km='.$km.' WHERE id='.$row->id); else 
	if ($row->mua>=$km) $db->setQuery('UPDATE `jos_push` SET km=0,mua='.($row->mua+$km).' WHERE id='.$row->id);	
	$db->query();      
} 
	
if (isset($_POST['save'])) { 
// DELETE  
$db->setQuery('SELECT * FROM `jos_push` WHERE id='.$_POST['save'].' AND user='.$user->id); 
$db->query();  
$inf=$db->loadAssoc();
$type2=$inf['type'];  
$db->setQuery('SELECT * FROM `jos_push` WHERE id<>'.$_POST['save'].' AND type='.$type2.' AND user='.$user->id.' ORDER BY start ASC'); 
$db->query();  
$info=$db->loadObjectList();
$time=time();
$plusmua=$inf['mua'];
$bds=$inf['bds'];       

if ($inf['type']==1) $type='daytin'; else
if ($inf['type']==2) $type='danhdau'; else
if ($inf['type']==3) $type='noibat';  

$pluskm=0;
 
$khuyenmai=$inf['km'];
foreach ($info as $row) {
	if ($row->mua==0) continue;
	if ($khuyenmai==0) break;
	$sum2=$row->km+$row->mua; 
	if ($khuyenmai>=$row->mua) { 
		$db->setQuery('UPDATE `jos_push` SET mua=0,km='.$sum2.' WHERE id='.$row->id); 
		$db->query(); 
		$khuyenmai-=$row->mua;
	} else { 
		$db->setQuery('UPDATE `jos_push` SET mua='.($row->mua-$khuyenmai).',km='.($row->km+$khuyenmai).' WHERE id='.$row->id);
		$db->query(); 
		$khuyenmai=0;
	}  
} 
$pluskm = $khuyenmai;
$plusmua += ( $inf['km'] -  $khuyenmai); 

$db->setQuery('SELECT * FROM `jos_users` WHERE id='.$user->id);
$db->query(); 
$inf=$db->loadAssoc();  

$sql='UPDATE `jos_users` SET km_'.$type.'='.($inf['km_'.$type]+$pluskm).',mua_'.$type.'='.($inf['mua_'.$type]+$plusmua).' WHERE id='.$user->id;
$db->setQuery($sql); 
$db->query();

$sql="SELECT * FROM `jos_push` WHERE id=".$_POST['save'];
$db->setQuery($sql); 
$db->query();
$iof=$db->loadAssoc();

$start=strtotime($_POST['editd'].' '.$_POST['edith'].':'.$_POST['editm']);
$end=strtotime($_POST['editd2'].' '.$_POST['edith2'].':'.$_POST['editm2']); 

$flagInsert = false;
$ok=false;
if ((($iof['end']!=$end)||($iof['start']!=$start))&&($time>$iof['start'])&&($time<$iof['end'])) { 
	// co chinh sua 
	//if ($iof['end']!=$end)
	$sql="UPDATE `jos_push` SET end=".$time.",status=1 WHERE id=".$_POST['save']; 
	$ok=true;
	//else
	//$sql='DELETE FROM `jos_push` WHERE id='.$_POST['save'].' AND user='.$user->id; 
	$db->setQuery($sql);
	$db->query();
} else {
	// khong chinh sua
	$db->setQuery('DELETE FROM `jos_push` WHERE id='.$_POST['save'].' AND user='.$user->id);
	$db->query();   
	$flagInsert = true; 
}
//---------------------------------------------------------
	$sql='SELECT * FROM `jos_users` WHERE id='.$user->id;
	
	$db->setQuery($sql); 
	$info=$db->loadAssoc();
	
	$quyenkm=$info['km_'.$type];
	$quyenmua=$info['mua_'.$type]; 
	
	$start=strtotime($_POST['editd'].' '.$_POST['edith'].':'.$_POST['editm']);
	$end=strtotime($_POST['editd2'].' '.$_POST['edith2'].':'.$_POST['editm2']); 
    if  ($_POST['loaitin']==1) $end=$start+86400;  
	
	// so quyen da su dung
	if (($time>$start)&&($time<$end)) {
		$soQuyenDaSuDung = ceil((time()-$start)/86400); 
		$soluong=($end-$start)/86400-$soQuyenDaSuDung;
	} else $soluong=($end-$start)/86400; 
	
	/*echo $quyenmua.'</br>';
	echo $quyenkm.'</br>'; 
	echo $soluong.'</br>'; */
	 //-------------------------------------------------
	if ($quyenkm>=$soluong) { 
			$quyenkm-=$soluong; 
			$tmp2_km=$soluong;
			$tmp_mua=0; 
			$tmp_km=$soluong;
	} else {
			$tmp_km=$quyenkm;
			$soluong-=$quyenkm;
			$quyenkm=0; 			
			$tmp_mua=$soluong;      
			$quyenmua-=$soluong; 
	} 		
	/*echo $tmp_mua.'</br>'; 
	echo $tmp_km;*/
	//die();   
	
	if (($quyenmua<0)||($quyenkm<0)) return;
	$status=0;
	$time=time();
	$avg=$end-$start;
	
	if ($start<$time) {
			$start=$time;
			$status=1;
			$end=$start+$avg;   
	}
	
	if (($start==$time)&&($inf['type']==1)) {
		$cmd="UPDATE `iland4_bat_dong_san_vi` SET ngay_chinh_sua=".$time." WHERE id=".$bds;
		mysql_query($cmd);  
	}
    
	//if (($time>$start)&&($time<$end)) { 
	if (($flagInsert)||(($time>$iof['start'])&&($time<$iof['end']))) {
	$sql='INSERT INTO `jos_push` VALUES (0,'.$bds.','.$user->id.','.$start.','.$end.','.$type2.','.$status.','.time().','.$tmp_mua.','.$tmp_km.')'; 
	$db->setQuery($sql);   
	$db->query();   
	}
	//} 
	
	$sql='UPDATE `jos_users` SET km_'.$type.'='.$quyenkm.',mua_'.$type.'='.$quyenmua.' WHERE id='.$user->id; 
	$db->setQuery($sql); 
	$db->query();      
	if ($ok) {
		$sql='DELETE FROM `jos_push` WHERE id='.$_POST['save'].' AND user='.$user->id; 
		$db->setQuery($sql); 
		$db->query();      
	}
// debug
/*
echo '<pre>';
print_r($soluong);
echo '<br>';
print_r($tmp_mua);
echo '<br>';
print_r($tmp_km);
echo '<br>';
print_r($quyenmua);
echo '<br>';
print_r($quyenkm);
echo '<br>';
echo '</pre>';
die();
*/
	//header('location:index.php?option=com_hengio&Itemid=249');  
} 
if ($_POST['method']==2) { 
// Restore Permision  
$db->setQuery('SELECT * FROM `jos_push` WHERE id='.$_POST['item'].' AND user='.$user->id); 
$db->query();  
$inf=$db->loadAssoc();
$time=time();

$ok=false;
// Kiem tra neu thong tin hen gio dang hoat dong thi insert vao 1 record da su dung roi
if (($time>$inf['start'])&&($time<$inf['end'])) {
	$sql='INSERT INTO `jos_push` VALUES(0,'.$inf['bds'].','.$inf['user'].','.$inf['start'].','.$time.','.$inf['type'].','.$inf['status'].','.$time.',0,0)';
	$db->setQuery($sql); 	
	$db->query();   
} 

// lay len danh sach cac thong tin hen gio de cap nhat lai viec phan bo quyen mua va khuyen mai
$db->setQuery('SELECT * FROM `jos_push` WHERE id<>'.$_POST['item']. ' AND type='.$inf['type']. ' AND user='.$user->id.' ORDER BY start ASC'); 
$db->query();  
$info=$db->loadObjectList();

$plusmua=$inf['mua'];
if ($inf['type']==1) $type='daytin'; else
if ($inf['type']==2) $type='danhdau'; else
if ($inf['type']==3) $type='noibat';  

// vong for phan bo lai cac quyen mua va khuyen mai cho cac thong tin dang duoc hen gio
$pluskm=0;
$khuyenmai=$inf['km'];
foreach ($info as $row) {
	if ($row->mua==0) continue;
	if ($khuyenmai==0) break;
	$sum2=$row->km+$row->mua; 
	if ($khuyenmai>=$row->mua) { 
		$db->setQuery('UPDATE `jos_push` SET mua=0,km='.$sum2.' WHERE id='.$row->id); 
		$db->query(); 
		$khuyenmai-=$row->mua;
	} else { 
		$db->setQuery('UPDATE `jos_push` SET mua='.($row->mua-$khuyenmai).',km='.($row->km+$khuyenmai).' WHERE id='.$row->id);
		$db->query(); 
		$khuyenmai=0;
	} 
}
$pluskm = $khuyenmai;
$plusmua +=($inf['km']-$khuyenmai); 


$db->setQuery('SELECT * FROM `jos_users` WHERE id='.$user->id);
$db->query(); 
$inf=$db->loadAssoc();

// cap nhat lai quyen mua va khuyen mai con lai cua user sau khi phan bo
$sql='UPDATE `jos_users` SET km_'.$type.'='.($inf['km_'.$type]+$pluskm).',mua_'.$type.'='.($inf['mua_'.$type]+$plusmua).' WHERE id='.$user->id;
$db->setQuery($sql); 
$db->query();     

// xoa thong tin hen gio
$db->setQuery('DELETE FROM `jos_push` WHERE id='.$_POST['item'].' AND user='.$user->id); 
$db->query();   


//header('location:index.php?option=com_hengio&Itemid=249');   
}
?>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo JURI::base(); ?>templates/mlbds/js/calendar/jsDatePick_ltr.min.css" />
<script type="text/javascript" src="<?php echo JURI::base(); ?>templates/mlbds/js/calendar/jsDatePick.min.1.3.js"></script>
<script>
function calendar(div){		  
	    new JsDatePick({
			useMode:2,
			target:"Date_"+div,
			dateFormat:"%d-%m-%Y", 
			selectedDate:{			
				day:5,				
				month:9,
				year:2012
			},
			limitToToday:false
		});
    } 
function checkaction(key,item) {  
	document.getElementById("thismethod").value=key;
	document.getElementById("thisitem").value=item;
	if (key==2){ 
	var r=confirm("Bạn muốn xoá hẹn giờ của tin này ? "); 
    if (r==true) document.tbsubmit.submit();     
	} else document.tbsubmit.submit();     
}
function validateTimeFormat24(hour, minute){
		var value = hour + ":" + minute; 
		var valid = /^([01]?[0-9]|2[0-3]):([0-9]|[0-5][0-9])$/.test(value);
		return valid;
}		
function checksave() { 
 
	<?php if (isset($_POST['item'])) { ?>   
	var total=<?php
		$db->setQuery('SELECT * FROM `jos_users` WHERE id='.$user->id);
		$db->query(); 
		$info1=$db->loadAssoc();
		
		$db->setQuery('SELECT * FROM `jos_push` WHERE id='.$_POST['item'].' AND user='.$user->id);
		$db->query(); 
		$info2=$db->loadAssoc();
		$type='';
		if ($info2['type']==1) $type='daytin'; else
		if ($info2['type']==2) $type='danhdau'; else $type='noibat'; 
	    echo $info1['mua_'.$type]+$info1['km_'.$type]; 
	} ?>

	var  avg=(ended-started)/86400; 
	tmp=document.getElementById("Date_edit").value.split("-");
	var date    = new Date();
	date.setFullYear(tmp[2],tmp[1]-1,tmp[0]);
	var a1=date.getTime();
	if (typef==1) 
	{	
		a2=a1+86400000; 
	}
	else 
	{
		tmp=document.getElementById("Date_edit2").value.split("-");
		var date    = new Date(); 
		date.setFullYear(tmp[2],tmp[1]-1,tmp[0]);
		var a2=date.getTime();  
	}
	var avg2=(a2-a1)/86400000;     
    //if () { alert('Ngày bắt đầu và kết thúc không hợp lệ !'); return;} else
	var hr= document.getElementById("edith").value;
	var min= document.getElementById("editm").value;
	
	if (!validateTimeFormat24(hr,min)) {   
		alert('Giờ và phút không hợp lệ !');
		return;
	} else
	if (avg2<=0)  
	{
		alert('Ngày bắt đầu và kết thúc không hợp lệ !'); return;
	} else 
	if (avg2>avg+total) 
	{
		alert('Vượt quá số ngày còn lại !'); 
	}
	else {
		alert('Đã cập nhật lại thành công !'); 
		document.editform.submit();  
	}  
}
function copythis(a,b,max,div) { 
	if (b>max) document.getElementById(div).value=Math.ceil(b/10)-1; 
	else document.getElementById(a).value=b;
}   
function process() { 
}
function limit(evt,vl,num) {    
        var charCode = (evt.which)?evt.which:event.keyCode; 
        if (charCode > 31 && (charCode < 48 || charCode > 57)) return false; 		
} 
</script>
<?php
if ($_POST['method']==1) { ?> 	
<form method="POST" name="editform"> 
<div class="componentheading">SỬA HẸN GIỜ</div>
		<table class="area">
		<?php 
			$db->setQuery('SELECT * FROM `jos_push` WHERE id='.$_POST['item']);
			$info=$db->loadAssoc();
			$db->setQuery('SELECT * FROM `iland4_bat_dong_san_vi` WHERE id='.$info['bds']);
			$info2=$db->loadAssoc();
			if (($info['end']>$time) &&($info['start']<$time)) 
	  echo '
		<tr> 
			<td colspan="2" align="center">Giao dịch đang hoạt động, không thể chỉnh sửa ngày bắt đầu !</td>
		</tr>';
		?>
		<tr>
		<td>Mã tin</td>
		<td><?php echo $info2['id'];?></td>
		</tr>
		<tr>
		<td>Tiêu đề tin đã đăng</td>
		<td>		
		<?php echo $info2['tieu_de']; ?> 
		</td>  
		</tr>
		</tr>
		<tr><td>Loại tin</td>
		<td>
		    <?php if ($info['type']==1) echo 'Đẩy tin'; 
			if ($info['type']==2) echo 'Đánh dấu';
		    if ($info['type']==3) echo 'Nổi bật'; ?>  
		</td>
		</tr>
		<tr><td>
		Thời điểm Bắt đầu</td>     
		<td><input readonly disabled type="text" name="editd" size="20" id="Date_edit" <?php if (($info['end']>$time) &&($info['start']<$time)) 
	          echo ''; else echo 'onclick="calendar(\'edit\')"'; ?> value="<?php echo date("d-m-Y",$info['start']);?>" width="100px"/>
		<input  readonly disabled <?php if (($info['end']>$time) &&($info['start']<$time)) 
	          echo 'readonly'; ?> onkeypress="return limit(event)" type="text" name="edith" size="5" onkeyup="copythis('hour2x',this.value,23,'edith');" id="edith" value="<?php echo date("H",$info['start']);?>" width="100px"/>h
		<input readonly disabled <?php if (($info['end']>$time) &&($info['start']<$time)) 
	          echo 'readonly'; ?> onkeypress="return limit(event)" type="text" name="editm" size="5" onkeyup="copythis('min2x',this.value,59,'editm');" id="editm" value="<?php echo date("i",$info['start']);?>" width="100px"/>
		</td>
		</tr> 
		<tr id="notype" <?php if ($info['type']==1) echo 'style="display:none;"';?>><td>  
		Thời điểm Kết thúc</td> 
		<td><input readonly style="cursor:text;" type="text" name="editd2" size="20" id="Date_edit2" onclick="calendar('edit2')" value="<?php echo date("d-m-Y",$info['end']);?>" width="100px"/>
		<input readonly disabled type="text" name="edith2" size="5" id="hour2x" value="<?php echo date("H",$info['end']);?>" width="100px"/>h
		<input readonly disabled type="text" name="editm2" size="5" id="min2x" value="<?php echo date("i",$info['end']);?>" width="100px"/>
		</td> 
		</tr> 
		</table>
		<input type="button" class="sb_ck" onclick="checksave();" value="Lưu lại"/>
		<input type="button" class="sb_ck" onclick="window.location='index.php?option=com_hengio&Itemid=249';" value="Quay lại"/> 
		<input type="hidden" name="save" value="<?php echo $_POST['item'];?>"/> 
		
		<input type="hidden" name="option" value="com_hengio"/>  
	</form> 
<script>
	var started=<?php echo $info['start']; ?>,ended=<?php echo $info['end']; ?>,typef=<?php echo $info['type']; ?>
</script>	
<?php		
} else  
{
$query = "SELECT * FROM `jos_push` WHERE user=".$user->id." ORDER BY start DESC";  
$db->setQuery($query,$lim0,$lim); 
$row = &$db->loadObjectList(); 
$db->setQuery($query); 
$total=count($db->loadObjectList());  
?>
<style>
	.history{width:100%; margin-top:10px;}
	.history th{background:#E0EFF6;color:#039;font-size:12px;font-weight:400;height:66px;text-align:center}
	.history td{background-color:#DFE7EF;border-bottom:1px solid #FFF;font-size:12px;height:30px;line-height:13px;padding:5px}
</style>	
		
<script>
	function confirmdel(id) {
		var r=confirm("Bạn muốn xoá tin BĐS có ID = "+id+' phải không ?');
		if (r==true) window.location='index.php?option=com_hengio&Itemid=249&del='+id;
	}
</script>
<div class="componentheading">QUẢN LÍ HẸN GIỜ</div>
<div class="quanlitin"> 
<form method="post" name="tbsubmit">

<table class="history">
	<th width="40px">Mã tin</th>
	<th>Tiêu đề tin đã đăng</th>
	<th width="70px">Loại tin</th> 
	<th width="100px">Ngày bắt đầu</th>
	<th width="100px">Ngày kết thúc</th>
	<th width="100px">Trạng thái</th>
	<th width="30px">Sửa</th>
	<th width="30px">Xoá</th>
	<?php  
	jimport('joomla.html.pagination'); 
	$pageNav = new JPagination($total,$lim0,$lim); 	
	foreach ($row as $info) { 
			$time=time();
			$db->setQuery('SELECT * FROM `iland4_bat_dong_san_vi` WHERE id='.$info->bds);  
			$info2=$db->loadAssoc();
	?>
			
		<tr> 
		<td><?php echo $info->bds;?></td>
		<?php 
		include_once JPATH_ROOT.'/libraries/com_u_re/php/common_utils.php';
		$link = ilandCommonUtils::getPropertyLink( $info2['alias'],$info2['id'] );
		?> 
		
		<td><?php if ($info2['hien_thi_ra_ngoai']==1)  {
			echo "<a target='_blank' href='".$link."'>".$info2['tieu_de']."</a>"; 
			}
			else {
				echo 'Tin này đã bị xoá hoặc chưa được duyệt !';
			}
			       
		?></td>
		
		<td><?php if ($info->type==1) echo'Đẩy tin'; else if ($info->type==2) echo 'Đánh dấu'; else echo 'Nổi bật';?></td>  
		<td><?php echo date("d-m-Y H:i",$info->start);?></td>
		<td><?php if ($info->type==1) echo date("d-m-Y H:i",$info->start); else echo date("d-m-Y H:i",$info->end); ?></td>
		<td>
		<?php  
			if ($info->end<$time) echo 'Đã hoàn tất'; 
				else 
					if ($info->start>$time) echo 'Đang chờ'; 
						else 
							if ($info->type==1) echo 'Đã hoàn tất'; 
								else
									echo 'Đang hoạt động'; 
		?>
		</td>  
		<td><?php if (($info->type!=1)&&($info->end>$time)) { ?><img style="cursor:pointer;" onclick="checkaction(1,<?php echo $info->id; ?>);" src="media/com_jea/images/media_edit.jpg"/><?php } 
			else if ($info->start>$time) { ?> 
			<img style="cursor:pointer;" onclick="checkaction(1,<?php echo $info->id; ?>);" src="media/com_jea/images/media_edit.jpg"/><?php } ?></td> 
			
		<td><?php if (($info->type!=1)&&($info->end>$time)) { ?><img src="media/com_jea/images/media_trash.png" style="cursor:pointer" onclick="checkaction(2,<?php echo $info->id; ?>);"/><?php }  
			else if ($info->start>$time) { ?> 
			<img src="media/com_jea/images/media_trash.png" style="cursor:pointer" onclick="checkaction(2,<?php echo $info->id; ?>);"/><?php } ?></td> 
	</tr> 
	<?php  }  ?> 
</table> 
<input type="hidden" name="item" id="thisitem" value=""/>
<input type="hidden" name="method" id="thismethod" value=""/> 
<input type="hidden" name="Itemid" value="249"/>   
<input type="hidden" name="option" value="com_hengio"/>   
</form>
<form action="index.php?option=com_hengio&Itemid=249" method="post">
	<div align="center"><?php echo $pageNav->getListFooter(); ?> </div>
    <input type="hidden" name="option" value="com_hengio"/>
	<input type="hidden" name="Itemid" value="249"/>   	
</form> 
</div> 
<?php } ?> 