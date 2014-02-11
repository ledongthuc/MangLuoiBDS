<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view' );
require_once  JPATH_ROOT.'/administrator/components/com_report/excel_xml.php'; 			

JToolBarHelper::title( JText::_( 'Lịch sử mua quyền' ),'generic.png' ); 
$db = JFactory::getDBO();

global $mainframe,$option;
$db =& JFactory::getDBO(); 
$lim		= $mainframe->getUserStateFromRequest( 'global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );
$lim0 = $mainframe->getUserStateFromRequest( $option.'.limitstart', 'limitstart', 0, 'int' );

$query='SELECT * FROM `jos_history` LEFT JOIN `jos_users` ON jos_history.userid=jos_users.id';
$excute=mysql_query($query);
$tonggd=mysql_num_rows($excute);
$tong_tien=0; $nganluong=0; $baokim=0; $sms=0;$mogioi=0;$ $chinhchu=0;
$daytinx=0; $danhdaux=0;$noibatx=0; $nonuser=0;
while ($inf=mysql_fetch_array($excute,MYSQL_ASSOC)){
	$tong_tien+=$inf['tongcong'];
	if ($inf['method']=='Ngân Lượng')++$nganluong; else if ($inf['method']=='Bảo Kim')++$baokim; else ++$sms;
	$tmp=explode('|',$inf['daytin']); $daytinx+=$tmp[0];
	$tmp=explode('|',$inf['danhdau']); $danhdaux+=$tmp[0];
	$tmp=explode('|',$inf['noibat']); $noibatx+=$tmp[0];	
	if ($inf['gid']==34) ++$chinhchu; else if ($inf['gid']==35) ++$mogioi;
	if ($inf['id']=='') ++$nonuser; 
}
//------------------------------- 
$where.='WHERE '; 
$orderdf=' ORDER BY jos_history.id DESC';

if ($_POST['group']!=0){
	if ($_POST['group']==1) $where.='jos_users.gid=35 '; 
	if ($_POST['group']==2) $where.='jos_users.gid=34 ';
	if ($_POST['group']==3) $where.='jos_history.userid=0';   
}

if (isset($_POST['method'])&&($_POST['method']!=0)){
	$where.='method=';
	if ($_POST['method']==1){
		$where.='"Ngân lượng"';
	} else if ($_POST['method']==2) $where.='"Bảo Kim"'; else $where.='"Tin nhắn SMS"';
}

if (isset($_POST['type'])&&($_POST['type']!=-1)){
	if ($_POST['type']==1) $type='daytin'; else if ($_POST['type']==2) $type='danhdau'; else $type='noibat';
	if (strlen($where)>7) $where.=' AND '.$type.' LIKE "%|%"'; else $where='WHERE '.$type.' LIKE "%|%"';
} 

if (($_POST['from']!='')&&($_POST['to']!='')){
	if (strlen($where)>7)$where.=' AND ';
	$where.=' time>'.strtotime($_POST['from']).' AND time<'.strtotime($_POST['to']);	
}

if (isset($_POST['price'])&& ($_POST['price']!=0)){ 
	if ($_POST['price']==1) $orderdf=' ORDER BY jos_history.tongcong ASC'; else 
	if ($_POST['price']==2) $orderdf=' ORDER BY jos_history.tongcong DESC';  
}
if (isset($_POST['time']) && ($_POST['time']!=0)){
	if ($_POST['time']==1) $orderdf=' ORDER BY jos_history.time ASC'; else
	if ($_POST['time']==2) $orderdf=' ORDER BY jos_history.time DESC';  
}
if (strlen($where)==6) $where=''; 

$query = "SELECT * FROM `jos_history` LEFT JOIN `jos_users` ON jos_history.userid=jos_users.id ".$where.$orderdf;
$db->setQuery($query,$lim0, $lim); 
$row = &$db->loadObjectList();
$total=&$db->loadResult();  
$dem=0;
$time=time();  
foreach($row as $info) {
	$db->setQuery('SELECT * FROM `jos_users` WHERE id='.$info->userid);
	$info2=$db->loadAssoc(); 
	$db->setQuery('SELECT * FROM `jos_core_acl_aro_groups`  WHERE id='.$info2['gid']);
	$info3=$db->loadAssoc(); 	 
	$dem++;
	$data[$dem]['id']=$info->id;
	$data[$dem]['user']=$info2['username'];
	$data[$dem]['email']=$info2['email']; 
	$data[$dem]['group']=($info2['username']=='')?"Non - User":$info3['name']; 
	$data[$dem]['method']=$info->method; 
	$data[$dem]['time']=date('d.m.Y H:i:s',$info->time); 
	$daytin=explode('|',$info->daytin);
	$danhdau=explode('|',$info->danhdau);
	$noibat=explode('|',$info->noibat);
	$data[$dem]['daytin']=$daytin[0].'x'.$daytin[1];
	$data[$dem]['danhdau']=$danhdau[0].'x'.$danhdau[1];
	$data[$dem]['noibat']=$noibat[0].'x'.$noibat[1];
	$data[$dem]['tongcong']=$info->tongcong;
}		
if ((isset($_POST['exportsql']))&&($dem>=1)){  
			$excel = new excel_xml; 
			$header_style = array(
			    'bold'       => 0,
			    'size'       => '12', 
				'font'		 => 'Calibri',
			    'color'      => '#FFFFFF',
			    'bgcolor'    => '#4F81BD'
			);
			$excel->add_style('header', $header_style);
			$excel->add_row(array(
					'ID',
					'User',
					'Email',
					'Nhóm', 
					'Thời gian', 
					'Phương thức thanh toán',
					'Đẩy tin',
					'Đánh dấu',
					'Nổi bật',
					'Chi phí thanh toán'					
				),  'header');
			foreach ($data as $k => $v){
                $excel->add_row ($v); 
			} 
			$excel->create_worksheet('Lich_su_mua_quyen');
			$xml = $excel->generate();
			$excel->download('lich_su_mua_quyen.xls');
}

?>
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
<b>Tổng số giao dịch: <?php echo $tonggd; ?> </b>   | 
<b>Số lượt đẩy tin: <?php echo $daytinx; ?> </b>   | 
<b>Số lượt đánh dấu: <?php echo $danhdaux; ?> </b>   | 
<b>Số lượt nổi bật: <?php echo $noibatx; ?> </b>   |
<br/>       
Mô giới: <?php echo $mogioi;?> |
Chính chủ: <?php echo $chinhchu; ?> | 
Non - User: <?php echo $nonuser; ?>
<br/>
Thanh toán qua Ngân lượng: <?php echo  $nganluong;?> | 
Thanh toán qua Bảo Kim: <?php echo $baokim;?> |
Tin nhắn SMS: <?php echo $sms;?> |
<b>Tổng tiền thanh toán: <?php echo  $tong_tien; ?> VND</b><br/>
<form action="index.php?option=com_history" method="post" name="adminForm" id="adminForm">
<input type="hidden" name="option" value="com_history"/>
		<table width="100%">
			<tr>	
				<td style="float:left;">
					<select name="type" onchange="document.adminForm.submit()">
						<option value="-1"<?php echo ($_POST['type'])?'selected="selected"':''?>>- Chọn loại tin -</option>
						<option value="1" <?php echo ($_POST['type']==1)?'selected="selected"':''?>>Đẩy tin</option>
						<option value="2" <?php echo ($_POST['type']==2)?'selected="selected"':''?>>Đánh dấu</option>
						<option value="3" <?php echo ($_POST['type']==3)?'selected="selected"':''?>>Nổi bật</option>
					</select> 
					<select name="method" onchange="document.adminForm.submit()">
						<option value="0">-Phương thức thanh toán-</option>
						<option value="1" <?php echo $_POST['method']==1?'selected':'';?>>Ngân Lượng</option>
						<option value="2" <?php echo $_POST['method']==2?'selected':'';?>>Bảo Kim</option> 
						<option value="3" <?php echo $_POST['method']==3?'selected':'';?>>Tin nhắn SMS</option>			
					</select>				
					<select name="group" onchange="document.adminForm.submit()"> 
						<option value="0">-Nhóm người dùng-</option>
						<option value="1" <?php echo $_POST['group']==1?'selected':'';?> >Chính chủ</option>
						<option value="2" <?php echo $_POST['group']==2?'selected':'';?> >Môi giới</option>
					    <option value="3" <?php echo $_POST['group']==3?'selected':'';?> >Non-User</option>
					</select>
					&nbsp&nbsp&nbsp&nbsp
					<b>Ngày giao dịch:</b> 
					Từ &nbsp
					<input type="text" size="15" value="<?php echo $_POST['from'];?>" name="from" id="from" onclick="calendar('from')" />
					&nbsp&nbspĐến&nbsp&nbsp
					<input type="text" size="15" id="to" value="<?php echo $_POST['to'];?>" name="to" onclick="calendar('to');" />
					<input type="button" value="Press" onclick="document.adminForm.submit()"/> 
				</td>
				<td style="float:right;">
					<select name="price" onchange="document.adminForm.submit()">
						<option value="0">-Chi phí thanh toán-</option>
						<option value="1" <?php echo $_POST['price']==1?'selected':'';?> >Tăng dần</option>
						<option value="2" <?php echo $_POST['price']==2?'selected':'';?> >Giảm dần</option>
					</select>
					<select name="time" onchange="document.adminForm.submit()"> 
						<option value="0">-Thời gian thanh toán-</option>
						<option value="1" <?php echo $_POST['time']==1?'selected':'';?> >Tăng dần</option>
						<option value="2" <?php echo $_POST['time']==2?'selected':'';?> >Giảm dần</option>
					</select>				
					<input type="submit" value="Xuất báo cáo" name="exportsql" />
				</td>
			</tr>
		</table>
		
	<div style="height:5px;"></div>
	<table class="adminlist" cellpadding="1">
		<thead> 
			<tr>
				<th width="40px">ID</th>
				<th>User</th>
				<th width="150px">Email</th>
				<th width="80px">Nhóm</th>
				<th width="120px">Thời gian</th>
				<th width="150px">Phương thức thanh toán</th>
				<th width="100px">Đẩy tin</th>
				<th width="100px">Đánh dấu</th>
				<th width="100px">Nổi bật</th> 
				<th width="120px">Chi phí thanh toán</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="8"></td>
			</tr>
		</tfoot>
		<tbody>
		<?php
		 jimport('joomla.html.pagination');
		$pageNav = new JPagination($total,$lim0,$lim);  
		//echo $lim0.'-----------'.$lim;
		//die();  
		if (isset($data)){ 
		foreach ($data as $info) {?>
		    <tr> 
			    <td><?php echo $info['id'];  ?> </td>
				<td><?php echo $info['user']; ?></td>
				<td><?php echo $info['email']?></td>
				<td><?php echo $info['group'];?></td>
				<td><?php echo $info['time']; ?> </td>
				<td><?php echo $info['method'];?> </td> 
				<td><?php echo $info['daytin']?></td>
				<td><?php echo $info['danhdau'];?></td>
				<td><?php echo $info['noibat']; ?> </td>
				<td><?php echo $info['tongcong'];?> </td>
			</tr>
			<?php } } 
			?>
		</tbody>	
</table>
<div align="center"><?php echo $pageNav->getListFooter(); ?> </div>
</form>