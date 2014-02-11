<?php
defined( '_JEXEC' ) or die( 'Restricted access');
$db =& JFactory::getDBO(); 
global $mainframe,$option;
jimport('joomla.html.pagination');
$db =& JFactory::getDBO(); 
$lim    = $mainframe->getUserStateFromRequest("$option.limit", 'limit', 14, 'int'); //I guess getUserStateFromRequest is for session or different reasons
$lim0   = JRequest::getVar('limitstart', 0, '', 'int');
$user =& JFactory::getUser();
$query='SELECT * FROM `jos_history`  WHERE userid='.$user->id.' ORDER BY time DESC';
$db->setQuery($query,$lim0,$lim); 
$row = &$db->loadObjectList(); 
$db->setQuery($query); 
$total=count($db->loadObjectList());  
?>
<style>
	.history{width:100%;margin-top:10px;}
	.history th{background:#E0EFF6;color:#039;font-weight:100;font-size:11pt;height:66px;text-align:center}
	.history td{background-color:#DFE7EF;border-bottom:1px solid #FFF;font-size:12px;height:30px;line-height:13px;padding:5px}
</style>	
<script>
function limit(evt,vl,num) {    
        var charCode = (evt.which)?evt.which:event.keyCode; 
        if (charCode > 31 && (charCode < 48 || charCode > 57)) return false; 		
}	 
function copythis(a,b,max,div) { 
	if (b>max) document.getElementById(div).value=Math.ceil(b/10)-1; 
	else document.getElementById(a).value=b;
}  
</script> 
<div class="componentheading">LỊCH SỬ NẠP QUYỀN</div>
<input type="button" style="float:left; margin-left:-2px;" class="sb_ck2" onclick="jQuery('#muaquyen').bPopup();" value="Nạp quyền" />
<div class="quanlitin">
	<table class="history">
		<thead> 
			<tr>
				<th width="40px">ID</th>
			    <th width="135px">Thời gian</th>
				<th>Phương thức thanh toán</th>
				<th width="80px">Đẩy tin</th>
				<th width="80px">Đánh dấu</th>
				<th width="80px">Nổi bật</th> 
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
		if (isset($row)) {
		foreach ($row as $info) {
		?>
		    <tr>
			    <td><?php echo $info->id;?> </td>
				<td><?php echo date('d.m.Y H:i:s',$info->time);?> </td>
				<td><?php echo $info->method;?> </td>
				<?php 
					$daytin=explode('|',$info->daytin);
					$danhdau=explode('|',$info->danhdau);
					$noibat=explode('|',$info->noibat);
				?>
				<td><?php echo $daytin[0].(($daytin[0])?'x':'').$daytin[1]; ?> </td>
				<td><?php echo $danhdau[0].(($danhdau[0])?'x':'').$danhdau[1];?> </td>
				<td><?php echo $noibat[0].(($noibat[0])?'x':'').$noibat[1];?> </td> 
				<td><?php echo number_format($info->tongcong); ?> VNĐ</td>
			
			</tr>
			<?php }}?>
		</tbody>
</table>  
</div>
<form action="index.php?option=com_history&Itemid=243" method="post">
	<div align="center"><?php echo $pageNav->getListFooter(); ?> </div>
    <input type="hidden" name="option" value="com_history"/>
	<input type="hidden" name="Itemid" value="243"/>   	
</form> 


<!--- MÀN HÌNH HẸN GIỜ CỦA USER --------------------------------------------------->
<style>
	.smoothness li a{font-size:10pt;}
	#smsarea{height:330px; }
	#smsarea{height:400px; }
	.smsbox{-moz-box-shadow: 0 0 5px #CCC;-webkit-box-shadow: 0 0 5px #CCC;box-shadow: 0 0 5px #CCC;width:580px;margin:5px auto;padding-top:13px; padding-bottom:13px;border-radius:5px;background:#EEE;text-align:center;margin-top:15px;}
	.smsbox:hover{-moz-box-shadow:inset 0 0 20px #666666;-webkit-box-shadow:inset 0 0 20px #666666;box-shadow:inset 0 0 20px #666666;}
	.p1{font-size:12pt;margin-bottom:10px;}.p2{font-size:15pt;margin-bottom:5px;}.p3{font-size:10pt; font-style: italic;}
</style>
<!---MÀN HÌNH MUA QUYỀN CỦA USER ------------------------------------------------------> 
<div id="muaquyen" class="facebook" style="width:650px; height:430px; display: none;"><span class="bClose"></span>
<div class="pp_top fb_top">
			<div class="pp_left fb_left"></div>
			<div class="pp_middle fb_middle"></div>
			<div class="pp_right fb_right"></div>
		</div>
<div class="pp_content_container fb_content_container">
		<div class="pp_left fb_left ">  
			<div class="pp_right fb_right">
					<div class="contact_title">
					
					<div class="smoothness"> 
					<ul id="tabpoppu2" class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
						<li id='sms' rel="subtab2_1" class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active"> <!--chua tab tong quan-->
							<span class="tab_active ">
								<a>NẠP QUYỀN QUA THẺ</a>
							</span>
						</li> 
						<!--
						<li id='sms' rel="subtab2_2" class="ui-state-default ui-corner-top">
													<span class="tab_inactive">
														<a>NẠP QUYỀN QUA SMS</a> 
													</span>		
												</li>-->
						
					</ul>
					</div> 
				<div class="boxholder"> 
					<div id="subtab2_2" class="box" style="display:none"> 					 
						<div id="smsarea2">
						</div>
						<div style='text-align:right; height:20px;'>
						
						</div> 
					</div>
					<div id="subtab2_1" class="box" > 					
<div id="checkout2"> 
	<div class="area" id="usertb" >
		<table>
			<th>Loại quyền</th>
			<th>Số lượng</th> 
			<th>Đơn giá (VND) </th>
			<th>Thành tiền (VND)</th>
			<tr>	
				<td>Quyền đẩy tin</td> 
				<td><input onkeypress="return limit(event)" value="0" onpaste="return false;" oncut="return false;" oncopy="return false;" ondrag="false" ondrop="false"  type="text" id="quyen_daytin"  onkeyup="recount(1,this.value);"/></td>
				<td><div id="gia_1"></div></td>
				<td><div id="sum_1"></div></td>
			</tr>
			<tr>
				<td>Quyền đánh dấu</td>
				<td><input onkeypress="return limit(event)" value="0" onpaste="return false;" oncut="return false;" oncopy="return false;" ondrag="false" ondrop="false" type="text" id="quyen_danhdau" onkeyup="recount(2,this.value);"/></td>
				<td><div id="gia_2"></div></td>  
				<td><div id="sum_2"></div></td>    
			</tr>
			<tr>
				<td>Quyền nổi bật</td>
				<td><input onkeypress="return limit(event)" value="0" onpaste="return false;" oncut="return false;" oncopy="return false;" ondrag="false" ondrop="false"  type="text" id="quyen_noibat" onkeyup="recount(3,this.value);"/></td>
				<td><div id="gia_3"></div></td> 
				<td><div id="sum_3"></div></td>   
			</tr>
		</table>
	</div> 	
	<?php 
		$user=& JFactory::getUser();
		$db =& JFactory::getDBO();
		$db->setQuery('SELECT * FROM `jos_core_acl_aro_groups` WHERE id='.$user->gid);
		$inf=$db->loadAssoc(); 	
	?>
	<div class="sumary">
		<div class="title">Chiết khấu cho 
				<?php 
						if ($user->gid==34) echo 'thành viên <b>'.$user->username.'</b>'; else
						echo 'nhóm chính chủ'; ?></div>
	   <div id="ckgid" style="float:right;padding-right:5px;"><?php echo $inf['chietKhau']; ?>%</div> 
	</div> 
	<div class="sumary">
		<div class="title">Chiết khấu khuyến mãi:</div>
	    <div id="khuyenmai" style="float:right;padding-right:5px;">0 VND</div>
	</div>
	<div class="sumaryx">
		<div class="title">Tổng cộng tiền cần thanh toán:</div>
	    <div id="total">0 VND</div>
	</div>
	<select id="method">
		<option value="nganluong">Thanh toán qua hệ thống Ngân Lượng</option>
		<option value="baokim" selected>Thanh toán qua hệ thống Bảo Kim</option>
	</select>
	<div class='thanhtoan'>   
		<input type="submit" class="sb_ck2" onclick="checkout()" id="thanhtoanbt" value="Thanh toán">
	
    </div>	
	<br/>
	<div style="font-size:11pt; margin-top:5px;padding:2px;">Chấp nhận các loại thẻ </div>
	<div class="credit" style="margin-top:10px; ">	

	 		<?php 	include(JPATH_ROOT.'/templates/mlbds/html/com_u_re/properties/credit.php');   ?>
	</div>	
</div>
</div>
</div>
</div>	
</div>
	   
</div>
</div>
 <div class="pp_bottom fb_bottom">
			<div class="pp_left1 fb_left"></div>
			<div class="pp_middle fb_middle"></div>
			<div class="pp_right fb_right"></div>
		</div>
</div>
<!--MÃ RENDER -------------------------------------------------->
<style>
	#quyen_tb1{float:right;}
	.date2 {width: 100px;border: 1px solid #96A6C5;padding: 3px;padding-left: 3px;margin-top:5px;}
</style>
<script type="text/javascript" src="<?php echo JURI::root()?>libraries/com_u_re/js/jstab.js"></script>
<script>
	function fmoney(num) { 
		num = num.toString().replace(/\$|\,/g,'');
		if(isNaN(num))
		num = "0";
		sign = (num == (num = Math.abs(num)));
		num = Math.floor(num*100+0.50000000001);
		cents = num%100;
		num = Math.floor(num/100).toString();
		if(cents<10)
		cents = "0" + cents;
		for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
		num = num.substring(0,num.length-(4*i+3))+','+
		num.substring(num.length-(4*i+3));
		return (((sign)?'':'-') +num);
	}
	
<?php 
   $db =& JFactory::getDBO();
	$group = JFactory::getUser()->gid;
	$db->setQuery('SELECT * FROM `jos_price` LIMIT 0,1'); 
	$db->query();
	$inf=$db->loadAssoc();  
	
	$db->setQuery('SELECT * FROM `jos_core_acl_aro_groups` WHERE id='.$group); 
	$db->query();
	$inf2=$db->loadAssoc();  
	
	echo 'var km='.$inf['km'].';'; 
	echo 'var ckgroup='.$inf2['chietKhau'].';';   
?>  
    var a=new Array(15),b=new Array(15),c=new Array(15),dema=0,demb=0,demc=0,count,quyen1=0,quyen2=0,quyen3=0,post,ck1=0,ck2=0,ck3=0,sumrow1=0,sumrow2=0,sumrow3=0,gia1=0,gia2=0,gia3=0,day=1;
		for (var i=1;i<=10;i++){a[i]=new Array(100);b[i]=new Array(100);c[i]=new Array(100);}
	<?php 
	$group = JFactory::getUser()->gid;
	if ($_SESSION['hengio']==1){ 
		echo 'a='.str_replace('undefined',0,json_encode($_SESSION['a'])).';';
		echo 'b='.str_replace('undefined',0,json_encode($_SESSION['b'])).';';
		echo 'c='.str_replace('undefined',0,json_encode($_SESSION['c'])).';';
		
		echo 'dema='.$_SESSION['dema'].';';
		echo 'demb='.$_SESSION['demb'].';';
		echo 'demc='.$_SESSION['demc'].';';   
	}
	?>
	document.getElementById('khuyenmai').innerHTML=km+'%';
	fillinf=function(d,m,div){
		d[1][m]=document.getElementById('Date_'+div).value;
		d[2][m]=document.getElementById('Hour_'+div).value;
		d[3][m]=document.getElementById('Min_'+div).value;		
		d[5][m]=(div=='tb1')?gia1:(div=='tb2')?gia2:gia3; 
		d[7][m]=0; 
		var tmp=d[1][m].split('-');		
		var time1 = new Date(Date.UTC(tmp[2],tmp[1],tmp[0]));
		if (document.getElementById('Date2_'+div+'x')){
     		d[8][m]=document.getElementById('Date2_'+div+'x').value;
			tmp=d[8][m].split('-');		
			var time2 = new Date(Date.UTC(tmp[2],tmp[1],tmp[0]));
			d[4][m]=(time2.getTime()/1000-time1.getTime()/1000)/(60*60*24);
		} else {
			d[8][m]='-1';
			d[4][m]=1; 
		}
		return d;
	}
	detect=function(div,title,id){
	var d=(div=='tb1')?a:(div=='tb2')?b:c;
	var idt=(div=='tb1')?1:(div=='tb2')?2:(div=='tb3')?3:0;
	var demd=(div=='tb1')?dema:(div=='tb2')?demb:demc;
	if (idt==1)quyen=quyen1; else if (idt==2) quyen=quyen2; else quyen=quyen3;
	//---------------------
		switch (id){ 
			case 'add':{
				if (quyen+1<=count[idt-1]){ 
					tableadd(idt,title,d,demd,true);  
				} else alert('Xin lỗi! Số quyền hiện tại không đủ để thực hiện thao tác, vui lòng nạp thêm !'); 
			}; break;  
			case 'save':{ 
			if (document.getElementById('Date2_'+div+'x')){
			m1=document.getElementById('Date_'+div).value;
			m2=document.getElementById('Date2_'+div+'x').value;
			var tmp=m1.split('-');		
			var time1 = new Date(Date.UTC(tmp[2],tmp[1],tmp[0]));
			tmp=m2.split('-');		
			var time2 = new Date(Date.UTC(tmp[2],tmp[1],tmp[0]));
			day=(time2.getTime()/1000-time1.getTime()/1000)/(60*60*24);
			} else day=1;
			if (day<=0) { alert('Xin lỗi! Ngày bạn vừa chọn không hợp lệ'); break;}
			//-------------------
				if (quyen+day<=count[idt-1]){
					demd=(div=='tb1')?++dema:(div=='tb2')?++demb:++demc;				
					fillinf(d,demd,div); 
					(div=='tb1')?a=d:(div=='tb2')?b=d:c=d; 
					tableadd(idt,title,d,demd,false);				
				} else alert('Xin lỗi! Số quyền hiện tại không đủ để thực hiện thao tác, vui lòng nạp thêm !');
			}; break; 
			case 'cancel':tableadd(idt,title,d,demd,false);break; 
			case 'del':{
				for (var i=1;i<=demd;i++) if (d[7][i]==0) if (document.getElementById(div+'_'+i).checked) d[7][i]=1;
				(div=='tb1')?a=d:(div=='tb2')?b=d:c=d;
				tableadd(idt,title,d,demd,false);
			}
			break; 
			default: 
		}		  
	} 
	function calendar(div){
		var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth()+1;
		var yyyy = today.getFullYear();
		new JsDatePick({
			useMode:2,
			target:"Date_"+div,
			dateFormat:"%d-%m-%Y",
			selectedDate:{			
				day:dd,
				month:mm,
				year:yyyy
			},
			limitToToday:false
		});
	}
	function calendar2(div){
	var today=new Date(); 
	var dd = today.getDate(); 
	var mm = today.getMonth();
	var yyyy = today.getFullYear();
	var nday=new Date(yyyy,mm,dd+1);
		dd = nday.getDate();
		mm = nday.getMonth()+1;
		yyyy = nday.getFullYear();
	 
	new JsDatePick({
			useMode:2,
			target:"Date2_"+div,
			dateFormat:"%d-%m-%Y",
			selectedDate:{			
				day:dd,
				month:mm,
				year:yyyy
			},
			limitToToday:false
		});
    }
	function changebox(value){
		document.getElementById("nganluong").checked=false;
		document.getElementById("baokim").checked=false;
		document.getElementById(value).checked=true;		
	}  
	function checkout(){		
		document.getElementById('method').value=='nganluong'?nganluong():baokim();
	}
	function ck(typex,soluong){		
		if(soluong==0){
			document.getElementById('gia_'+typex).innerHTML = "0 VND";
			document.getElementById('sum_'+typex).innerHTML = "0 VND"
		}
		$.ajax({
			url:'<?php echo JURI::base();?>price.php',
			type:'POST', 
			data:{type:typex,group:<?php echo $group; ?>,max:soluong},
			success:function(data) {	  
			var tmp=data.split("|"); 
				if (typex==1){
					ck1=tmp[0];gia1=tmp[1];
				}else if(typex==2){
					ck2=tmp[0];gia2=tmp[1];
				}else {
					ck3=tmp[0];gia3=tmp[1];
				}
				document.getElementById('gia_'+typex).innerHTML=fmoney(tmp[1]-(tmp[1]*tmp[0]/100))+' VND';
				if(typex==1&&soluong==0){
					document.getElementById('gia_'+typex).innerHTML='0 VND';
				}
				var dongia=tmp[1];
				var sumrow=soluong==0?0:soluong*dongia;
				sumrow-=(sumrow*tmp[0]/100);
				(typex==1)?sumrow1=sumrow:(typex==2)?sumrow2=sumrow:sumrow3=sumrow;
				document.getElementById('sum_'+typex).innerHTML=fmoney(sumrow)+' VND';
				total=sumrow1+sumrow2+sumrow3;
				total-=(total*(km+ckgroup)/100);
				console.log(total);     
				document.getElementById('total').innerHTML=fmoney(total)+' VND';
			}			
		});
	}
	function setup(){ 			
		$.ajax({
			url:'<?php echo JURI::base(); ?>savedata.php', 
			type:'POST',    
			data:{manga:a,mangb:b,mangc:c,dema:dema,demb:demb,demc:demc,user:<?php echo $user->id; ?>,post:postbds},
			success:function(data){
				$('.bClose').click();
				dema=0;demb=0;demc=0;
			}			
		});
	}
	var sum_daytin=0,sum_noibat=0,sum_danhdau=0;
	function recount(idt,soluong){
		if (Number(soluong)>=0)
		ck(idt,soluong); 
	}
	function showsms2 ()	{
		var code1='<div class="smsbox"><p class="p1">Để nạp hai (2) quyền đẩy tin, soạn tin theo cú pháp</p>'+
						'<p class="p2">BDS MUP <?php echo $user->id; ?> gửi 8549</p>'+
						'<p class="p3">( Bạn có thể nhắn nhiều lần để được nạp số lần đẩy tương ứng. <br/> Một tin nhắn có giá trị 5,000VNĐ.)</p></div>';
		var code2='<div class="smsbox"><p class="p1">Để nạp một (1) ngày đánh dấu tin, soạn tin theo cú pháp</p>'+
						'<p class="p2">BDS MDD <?php echo $user->id; ?> gửi 8649</p>'+
		'<p class="p3">(Bạn có thể nhắn nhiều lần để được nạp số ngày tương ứng.<br/>Một tin nhắn có giá trị 10,000VNĐ.)</p></div>';
		var code3='<div class="smsbox"><p class="p1">Để nạp một (1) ngày nổi bật tin, soạn tin theo cú pháp</p>'+
						'<p class="p2">BDS MNB <?php echo $user->id; ?> gửi 8749</p>'+
		'<p class="p3">(Bạn có thể nhắn nhiều lần để được nạp số ngày tương ứng.<br/>Một tin nhắn có giá trị 15,000VNĐ.	)</p></div>';
						 
		document.getElementById('smsarea2').innerHTML=code1+code2+code3;
	}
	showsms2();
	postbds=<?php echo $user->id; ?>;
	initalizetab("tabpoppu2");
	<?php  
	if (isset($_POST['napquyen'])){
		if  ($_SESSION['napquyen']==1) {	  
			echo "jQuery('#muaquyen').bPopup()";
			$_SESSION['napquyen']=0;
		} 
	} ?>
</script> 