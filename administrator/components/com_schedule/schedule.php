<?php  
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view'); 
require_once  JPATH_ROOT.'/administrator/components/com_report/excel_xml.php'; 
JToolBarHelper::title( JText::_( 'Lịch sử hẹn giờ'),'generic.png'); 
	
global $mainframe,$option;
$db =& JFactory::getDBO(); 
$lim    = $mainframe->getUserStateFromRequest("$option.limit", 'limit', 14, 'int'); //I guess getUserStateFromRequest is for session or different reasons
$lim0   = JRequest::getVar('limitstart', 0, '', 'int');

$query = "SELECT * FROM `jos_push` ORDER BY id DESC";
$db->setQuery($query); 
$rowx = $db->loadObjectList();
$daytin=0; $danhdau=0;$noibat=0;
$hoantat=0; $dangcho=0;$hoatdong=0;
$time=time();
foreach ($rowx as $inf) {
	if ($inf->type==1) ++$danhdau;
	if ($inf->type==2) ++$daytin;
	if ($inf->type==3) ++$noibat; 
	if ($inf->end<$time) ++$hoantat; else if ($inf->start>$time) ++$dangcho; else ++$hoatdong; 	
}

$where.='WHERE '; 
$orderdf=' ORDER BY id DESC';

if (isset($_POST['status'])&&($_POST['status']!=0)) {
	$time=time(); 
	$k=$_POST['status']; 
	if ($k==1) $where.=' end<'.$time.' '; else
    if ($k==3) $where.=' start>'.$time.' '; else 
	if ($k==2) $where.=' start<'.$time.' AND end>'.$time.' '; 
}

if (isset($_POST['type'])&&($_POST['type']!=-1)) {
	if (strlen($where)>7) $where.=' AND ';
	$where.=' type='.$_POST['type'];
} 

if ((isset($_POST['from']))&&($_POST['from']!='')&&(isset($_POST['to']))&&($_POST['to']!='')) {
	if (strlen($where)>7) $where.='AND ';
	$where.=' start>'.strtotime($_POST['from']).' AND end<'.strtotime($_POST['to']);   
} 

if (strlen($where)==6) $where=''; 
$query = "SELECT * FROM  `jos_push` ".$where.$orderdf;

$db->setQuery($query,$lim0,$lim); 
$row = &$db->loadObjectList(); 
$db->setQuery($query); 
$total=count($db->loadObjectList());  

$dem=0; 
$time=time();  
foreach($row as $info) {
	$db->setQuery('SELECT * FROM `iland4_bat_dong_san_vi` WHERE id='.$info->bds);
	$info2=$db->loadAssoc();
	$db->setQuery('SELECT * FROM	`jos_users` WHERE id='.$info->user);
	$info3=$db->loadAssoc();	
	$dem++;
	$data[$dem]['id']=$info->id;
	$data[$dem]['matin']=$info2['id'];
	$data[$dem]['username']=$info3['username'];
	$data[$dem]['tieude']=$info2['tieu_de'];
	if ($info->type==1) $data[$dem]['loaitin']='Đẩy tin'; else
		if ($info->type==2) $data[$dem]['loaitin']='Đánh dấu';
			else $data[$dem]['loaitin']='Nổi bật';  
	$data[$dem]['start']=date("H:i d-m-Y",$info->start);
	$data[$dem]['end']=date("H:i d-m-Y",$info->end); 
	$data[$dem]['date']=date("H:i d-m-Y",$info->date); 
	if ($info->end<$time) $data[$dem]['status']='Đã hoàn tất'; 
		else if ($info->start>$time) $data[$dem]['status']='Đang chờ'; 
			else $data[$dem]['status']='Hoạt động';
}		
if ((isset($_POST['exportsql']))&&($dem>=1)){  
			$excel = new excel_xml; 
			$header_style = array(
			    'bold'       => 0,
			    'size'       => '12', 
				'font'		 => 'Arial',
			    'color'      => '#FFFFFF',
			    'bgcolor'    => '#4F81BD'
			);
			$excel->add_style('header', $header_style);
			$excel->add_row(array(
					'ID',
					'Mã tin',
					'Người đăng',
					'Tiêu đề tin đăng',
					'Loại tin',
					'Ngày bắt đầu',
					'Ngày kết thúc',
					'Ngày hẹn giờ',
					'Trạng thái'					
				),  'header');
			foreach ($data as $k => $v){
                $excel->add_row ($v); 
			} 
			$excel->create_worksheet('Lich_su_hen_gio');
			$xml = $excel->generate();
			$excel->download('lich_su_hen_gio.xls');
}
?>   
Tổng số lượt hẹn giờ: <?php echo count($rowx);?> | Đẩy tin: <?php echo $daytin; ?>  | Đánh dấu: <?php echo $danhdau; ?> | Nổi bật: <?php echo $noibat; ?> <br/>
Đã hoàn tất: <?php echo $hoantat; ?> | Đang hoạt động: <?php echo $hoatdong; ?> | Đang chờ: <?php echo $dangcho; ?> <br/>
<script type="text/javascript" src="<?php echo JURI::root();?>templates/mlbds/js/calendar/jsDatePick.min.1.3.js"></script>	
<link rel="stylesheet" href="<?php echo JURI::root();?>templates/mlbds/js/calendar/jsDatePick_ltr.css"/>
<script>
	function calendar(div){
		var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth()+1;
		var yyyy = today.getFullYear();
	    new JsDatePick({
			useMode:2,
			target:div,
			dateFormat:"%d-%m-%Y",
			selectedDate:{			
				day:dd,
				month:mm,
				year:yyyy
			},
			limitToToday:false
		});
    }
</script>  
<form action="index.php?option=com_schedule" method="post" name="adminForm" id="adminForm"> 
<table width="100%">
			<tr>	
				<td style="float:left;">
					<select name="type" onchange="document.adminForm.submit()">
						<option value="-1"<?php echo ($_POST['type'])?'selected="selected"':''?>>- Chọn loại tin -</option>
						<option value="1" <?php echo ($_POST['type']==1)?'selected="selected"':''?>>Đẩy tin</option>
						<option value="2" <?php echo ($_POST['type']==2)?'selected="selected"':''?>>Đánh dấu</option>
						<option value="3" <?php echo ($_POST['type']==3)?'selected="selected"':''?>>Nổi bật</option>
					</select> 
					<select name="status" onchange="document.adminForm.submit()">
						<option value="0">-Trạng thái-</option>
						<option value="1" <?php echo $_POST['status']==1?'selected':'';?>>Đã hoàn tất</option>
						<option value="2" <?php echo $_POST['status']==2?'selected':'';?>>Đang hoạt động</option> 
						<option value="3" <?php echo $_POST['status']==3?'selected':'';?>>Đang chờ</option>			
					</select>				 
					&nbsp&nbsp&nbsp&nbsp
					<b>Ngày bắt đầu:</b> 
					Từ &nbsp
					<input type="text" size="15" value="<?php echo $_POST['from'];?>" name="from" id="from" onclick="calendar('from')" />
					&nbsp&nbsp Ngày kết thúc: &nbsp
					<input type="text" size="15" id="to" value="<?php echo $_POST['to'];?>" name="to" onclick="calendar('to');" />
					<input type="button" value="Press" onclick="document.adminForm.submit()"/> 
				</td>
				<td style="float:right;">
					<input type="submit" name="exportsql" value="Xuất báo cáo" name="report" />
				</td>
			</tr>
		</table>		
<table>
		<tr>
			<td width="100%">
			</td>
			<td nowrap="nowrap">
			</td>
		</tr>
	</table>
	<table class="adminlist" cellpadding="1">
		<thead>
			<tr>
				<th width="50px">ID</th>
				<th width="70px">Mã tin</th>
				<th width="100px">Người đăng</th>
				<th>Tiêu đề tin đăng</th>
				<th width="120px">Loại tin</th>
				<th width="120px">Ngày bắt đầu</th>
				<th width="120px">Ngày kết thúc</th>
				<th width="120px">Ngày hẹn giờ</th>
				<th width="120px">Trạng thái</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="5">
				</td>
			</tr>
		</tfoot>
		<tbody>
		<?php   
			jimport('joomla.html.pagination'); 
			$pageNav = new JPagination($total,$lim0,$lim); 
		if ($dem>=1) foreach ($data as $info) { ?> 
	    <tr>
		    <td><?php echo $info['id']; ?> </td>
			<td><?php echo  $info['matin']; ?></td>
			<td><?php echo  $info['username']; ?> </td> 
			<td><?php echo $info['tieude']; ?></td>
			<td><?php echo $info['loaitin']; ?> </td>
			<td><?php echo $info['start'];  ?></td> 
			<td><?php echo $info['end']; ?></td>
			<td><?php echo $info['date']; ?></td> 
			<td><?php echo $info['status']; ?></td> 
		</tr>
		<?php } ?>
		</tbody>  
	</table> 
<div align="center"><?php echo $pageNav->getListFooter(); ?> </div>
	</form>