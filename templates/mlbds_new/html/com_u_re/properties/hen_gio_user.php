<?php 
/*var_dump($_SESSION);
echo 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
die();*/
?>
<!--- MÀN HÌNH HẸN GIỜ CỦA USER --------------------------------------------------->
<style>
	.smoothness li a{font-size:10pt;}
	#smsarea{height:400px; }
	.smsbox{-moz-box-shadow: 0 0 5px #CCC;-webkit-box-shadow: 0 0 5px #CCC;box-shadow: 0 0 5px #CCC;width:580px;margin:5px auto;padding-top:13px; padding-bottom:13px;border-radius:5px;background:#EEE;text-align:center;margin-top:15px;}
	.smsbox:hover{-moz-box-shadow:inset 0 0 20px #666666;-webkit-box-shadow:inset 0 0 20px #666666;box-shadow:inset 0 0 20px #666666;}
	.p1{font-size:12pt;margin-bottom:10px;}.p2{font-size:15pt;margin-bottom:5px;}.p3{font-size:10pt; font-style: italic;}
</style>
<div id="hen_gio_non_user" class="facebook" style="width:650px; height:430px; display: none;">
<span class="bClose"></span>
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
					<ul id="tabpoppu" class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
						<li id='sms' rel="subtab_1" class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active"> <!--chua tab tong quan-->
							<span  class="tab_active">
								<a>HẸN GIỜ</a>
							</span>
						</li>  
						<!--<li id='sms' rel="subtab_2" class="ui-state-default ui-corner-top">
							<span class="tab_inactive" > 
								<a>NẠP QUYỀN QUA SMS</a>
							</span>		
						</li>-->
					</ul>
				</div> 
				<div class="boxholder">
					<div id="subtab_1" class="box" > 					
<div id="checkout"> 
	<div class="area" id="tb1"></div>  
	<div class="area" id="tb2"></div>
	<div class="area" id="tb3"></div>
	<div class="thanhtoan" style="width:500px;">   
		<form method="post" name="thanhtoan">
		        <input name="kohengio" type="button" class="sb_ck" onclick="setup();" value="Hẹn giờ">  
		<input type="button" class="sb_ck" onclick="refresh(); alert('Đã cập nhật lại quyền !');" value="Cập nhật quyền">
		<input type="button" class="sb_ck2" onclick="napquyen()" value="Nạp thêm quyền">
		</form>
	</div>	
</div>
</div>
<div id="subtab_2" class="box" style="display:none"> 					
						<div id="smsarea">
						</div>
					</div>
</div></div>	
</div>
	    
</div>
</div>
<div class="pp_bottom fb_bottom">
			<div class="pp_left1 fb_left"></div>
			<div class="pp_middle fb_middle"></div>
			<div class="pp_right fb_right"></div>
		</div>
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
						<!--
						<li id='sms' rel="subtab2_1" class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active">
													<span class="tab_inactive">
														<a>NẠP QUYỀN QUA SMS</a>
													</span>
												</li> -->
						
						<li id='sms' rel="subtab2_2" class="ui-state-default ui-corner-top">
							<span class="tab_active">
								<a>NẠP QUYỀN QUA THẺ</a>
							</span>		
						</li>
					</ul>
					</div> 
				<div class="boxholder">
					<div id="subtab2_1" class="box"  style="display:none"> 					
						<div id="smsarea2">
						</div>
						<div style='text-align:right;'>
						<input type="submit" class="sb_ck" onclick="goback();" value="Quay lại hẹn giờ">
						</div>
					</div>
					<div id="subtab2_2" class="box"> 					

<div id="checkout2"> 
	<div class="area" id="usertb" >
		<table>
			<th>Loại quyền</th>
			<th>Số lượng</th> 
			<th>Đơn giá (VND) </th>
			<th>Thành tiền (VND)</th>
			<tr>	
				<td>Quyền đẩy tin</td>
				<td><input value="0" type="text" id="quyen_daytin" onkeyup="recount(1,this.value);"/></td>
				<td><div id="gia_1"></div></td>
				<td><div id="sum_1"></div></td>
			</tr>
			<tr>
				<td>Quyền đánh dấu</td>
				<td><input value="0" type="text" id="quyen_danhdau" onkeyup="recount(2,this.value);"/></td>
				<td><div id="gia_2"></div></td>  
				<td><div id="sum_2"></div></td>    
			</tr>
			<tr>
				<td>Quyền nổi bật</td>
				<td><input value="0" type="text" id="quyen_noibat" onkeyup="recount(3,this.value);"/></td>
				<td><div id="gia_3"></div></td> 
				<td><div id="sum_3"></div></td>
			</tr>
		</table>
	</div> 	
	<br/> 
	<?php 
		$user=& JFactory::getUser();
	?>
	<div class="sumary">
		<div class="title">Chiết khấu cho 
				<?php 
						if ($user->gid==34) echo 'thành viên <b>'.$user->username.'</b>'; else
						echo 'nhóm chính chủ'; ?></div>
	    <!--<div id="ckgid" style="float:right;padding-right:5px;">0 VND</div>-->
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
		<input type="submit" class="sb_ck" onclick="goback();" value="Quay lại hẹn giờ">
		<input type="submit" class="sb_ck2" onclick="checkout()" id="thanhtoanbt" value="Thanh toán">
	
    </div>	
	<br/>
	<div style="font-size:11pt; margin-top:5px;padding:2px;">Chấp nhận các loại thẻ </div>
	<div class="credit" style="margin-top:10px; ">	
		<?php include( dirname(__FILE__).'/credit.php'); ?>
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
</div></div>
<!--MÃ RENDER -------------------------------------------------->
<style>
	#quyen_tb1{float:right;}
	.date2 {width: 80px;border: 1px solid #96A6C5;padding: 3px;padding-left: 3px;margin-top:5px;}
</style>
<script language="javascript" src="<?php echo JURI::base();?>nganluong/include/nganluong.apps.mcflow.js"></script>
<script>
<?php 
	$db =& JFactory::getDBO();
	$db->setQuery('SELECT * FROM `jos_price` LIMIT 0,1'); 
	$inf=$db->loadAssoc();  
	echo 'var km='.$inf['km'].';'; 
?>  
    var a=new Array(15),b=new Array(15),c=new Array(15),dema=0,demb=0,demc=0,count,quyen1=0,quyen2=0,quyen3=0,post,ck1=0,ck2=0,ck3=0,sumrow1=0,sumrow2=0,sumrow3=0,gia1=0,gia2=0,gia3=0,day=1;
		for (var i=1;i<=10;i++) {a[i]=new Array(100);b[i]=new Array(100);c[i]=new Array(100);}
	<?php 
	$group = JFactory::getUser()->gid;
	if (isset($_POST['kohengio'])) {
		unset($_SESSION['payment']);
		unset($_SESSION['hengio']);
		unset($_SESSION['manga']);
		unset($_SESSION['mangb']);
		unset($_SESSION['mangc']);
		unset($_SESSION['dema']);
		unset($_SESSION['demb']);
		unset($_SESSION['demc']);
		unset($_SESSION['www']);
	} 
	if (($_SESSION['hengio']==1)||($_SESSION['hengio']==2)) {  
		$a=$_SESSION['a'];  $b=$_SESSION['b'];  $c=$_SESSION['c']; 
	 $dema=$_SESSION['dema']; $demb=$_SESSION['demb']; $demc=$_SESSION['demc']; 
	 $demlaia=0; $demlaib=0; $demlaic=0;
	 for ($i=1;$i<=$dema;$i++)
		if ($a[7][$i]!=1) {
			$demlaia++;
			for ($j=1;$j<=8;$j++)  echo 'a['.$j.']['.$i.']="'.$a[$j][$i].'";';  
		}
			
		for ($i=1;$i<=$demb;$i++)
		if ($b[7][$i]!=1) {
			$demlaib++;
			for ($j=1;$j<=8;$j++) echo 'b['.$j.']['.$i.']="'.$b[$j][$i].'";';  
		}
		
		for ($i=1;$i<=$demc;$i++)  
		if ($c[7][$i]!=1){
			$demlaic++;
			for ($j=1;$j<=8;$j++) 
		         echo 'c['.$j.']['.$i.']="'.$c[$j][$i].'";';     
		}
			
		echo 'dema='.$demlaia.';';
		echo 'demb='.$demlaib.';';  
		echo 'demc='.$demlaic.';';    
	}		
	?>	
		
	document.getElementById('khuyenmai').innerHTML=km+'%';
	fillinf=function(d,m,div){
		d[1][m]=document.getElementById('Date_'+div).value;
		d[2][m]=document.getElementById('Hour_'+div).value;
		d[3][m]=document.getElementById('Min_'+div).value;		
		if (div=='tb1') d[5][m]=gia1; else if (div=='tb2') d[5][m]=gia2; else d[5][m]=gia3;  
		d[7][m]=0; 
		var tmp=d[1][m].split('-');		
		var time1 = new Date(Date.UTC(tmp[2],tmp[1],tmp[0]));
		if (document.getElementById('Date2_'+div+'x')) {
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
			if (document.getElementById('Date2_'+div+'x')) {
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
				if (quyen+day<=count[idt-1]) {
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
	clickbt=function(div,title,id,value){return '<input type="submit" class="sb_ck" id="'+id+'" value="'+value+'" onclick="detect(\''+div+'\',\''+title+'\',\''+id+'\');" \/>';} 
	toolbar=function(div,title,mark){if (mark) return clickbt(div,title,'save','Lưu lại')+clickbt(div,title,'cancel','Huỷ bỏ'); else return clickbt(div,title,'add','Thêm '+title)+clickbt(div,title,'del','Xoá mục đã chọn ');}
	past=function(date){ // CHECK DAY IN THE PAST
		var tmp=date.split('-');
		var other=new Date(tmp[2],tmp[1],tmp[0]);
		var today=new Date();
		var dd = today.getDate();
		var mm = today.getMonth();
		var yyyy = today.getFullYear();
		var nday=new Date(yyyy,mm+1,dd);			
		//if (nday.getTime()>=other.getTime()) return true; else return false;
		var theday=nday.getTime()-other.getTime();  
		if (theday>0) return true; else return false;
	}
	process=function(div){				 
		if (div=='Date_tb1'){ 
			if (past(document.getElementById(div).value)){ 
				var today=new Date(); 
				var dd = today.getDate();
				var mm = today.getMonth();
				var yyyy = today.getFullYear(); 
				var nday=new Date(yyyy,mm,dd);
					dd = nday.getDate();
					mm = nday.getMonth()+1;
					yyyy = nday.getFullYear(); 	
				alert('Xin lỗi! Ngày tháng bạn chọn không hợp lệ !');
				document.getElementById(div).value=dd+'-'+mm+'-'+yyyy;
			};
			document.getElementById('soluongtin_1').value=1;
		} else
		if (div[div.length-1]=='x'){
			var vl=0;
			if (document.getElementById(div)){
				var df=document.getElementById('Date_'+div.substring(6,9)).value;
				tmp=df.split('-');		
				var time1 = new Date(Date.UTC(tmp[2],tmp[1],tmp[0]));
				df=document.getElementById(div).value;
				tmp=df.split('-');		
				var time2 = new Date(Date.UTC(tmp[2],tmp[1],tmp[0]));
				vl=(time2.getTime()/1000-time1.getTime()/1000)/(60*60*24);
			}	
			var today=new Date(); 
			var dd = today.getDate();
			var mm = today.getMonth();
			var yyyy = today.getFullYear();
			var nday=new Date(yyyy,mm,dd+1);
			dd = nday.getDate();
			mm = nday.getMonth()+1;
			yyyy = nday.getFullYear(); 				
			if (vl<=0) {
				alert('Xin lỗi! Ngày tháng bạn chọn không hợp lệ !');
				document.getElementById(div).value=dd+'-'+mm+'-'+yyyy;
				document.getElementById('soluongtin_'+div[div.length-2]).value=1;
			} else document.getElementById('soluongtin_'+div[div.length-2]).value=vl;
		} else {
			if (past(document.getElementById(div).value)){ 
				var today=new Date(); 
				var dd = today.getDate();
				var mm = today.getMonth();
				var yyyy = today.getFullYear();
				var nday=new Date(yyyy,mm,dd);
					dd = nday.getDate();
					mm = nday.getMonth()+1;
					yyyy = nday.getFullYear(); 	
				alert('Xin lỗi! Ngày tháng bạn chọn không hợp lệ !');
				document.getElementById(div).value=dd+'-'+mm+'-'+yyyy;
				document.getElementById('soluongtin_'+div[div.length-2]).value=1;
			};
		}
	} 
	tableadd=function(idt,title,d,n,mark){ 
		var div='tb'+idt; 
		var quyen=0;
		var code1='<table><th width="5px">#</th><th width="45px" align="center">Mã tin</th></th><th>Hẹn giờ '+title+'</th><th width="100px">Số lượng</th>';
		var code2='',sum=0,dem=0,code5=''; 
		for (var i=1; i<=n;i++) if (d[7][i]==0) ++dem;
		if ((dem==0)&&!mark) code2='<tr><td colspan="6" align="center"><i>Chưa có hẹn giờ</i></tr>';
		else {		 
		for (var i=1;i<=n;i++) 
			if (d[7][i]!=1){  
				soluong=d[4][i];  
				quyen+=Number(d[4][i]);
				if (idt!=1) code2+='<tr><td><input type="checkbox" id="'+div+'_'+i+'"/></td><td>'+postbds+'</td><td style="line-height:25px;">Từ ngày '+d[1][i]+' lúc '+d[2][i]+' giờ '+d[3][i]+' phút<br/>Đến ngày '+d[8][i]+' lúc '+d[2][i]+' giờ '+d[3][i]+' phút</td><td>'+d[4][i]+' ngày</td></tr>'; else
				code2+='<tr><td><input type="checkbox" id="'+div+'_'+i+'"/></td><td>'+postbds+'</td><td style="line-height:25px;">'+d[1][i]+' lúc '+d[2][i]+' giờ '+d[3][i]+' phút</td><td>1</td></tr>';
			}			
		}
		var code3='';
		if (mark) {
			var today = new Date();
			var dd = today.getDate();
			var mm = today.getMonth()+1;
			var yyyy = today.getFullYear();
			var nday=new Date(yyyy,mm-1,dd+1);
			dd2 = nday.getDate();
			mm2 = nday.getMonth()+1;
			yyyy2 = nday.getFullYear();
			if (idt!=1)	code3='<tr><td><input type="checkbox"/></td><td>'+postbds+'</td><td>Từ &nbsp&nbsp&nbsp&nbsp<input readonly class="date" id="Date_'+div+'" value="'+dd+'-'+mm+'-'+yyyy+'" type="text" size="5" onclick="calendar(\''+div+'\')"/><input id="Hour_'+div+'" type="text" class="hour" value="00" onkeyup="document.getElementById(\'Hour2_'+div+'\').value=this.value"/>giờ <input onkeyup="document.getElementById(\'Min2_'+div+'\').value=this.value" type="text" value="00" class="min" id="Min_'+div+'" />phút<br/> Đến &nbsp<input readonly class="date2" id="Date2_'+div+'x" value="'+dd2+'-'+mm2+'-'+yyyy2+'" type="text" size="5" onclick="calendar2(\''+div+'x\')"/><input readonly id="Hour2_'+div+'" type="text" class="hour" value="00"/>giờ <input readonly type="text" value="00" class="min" id="Min2_'+div+'" />phút</td><td><input type="button" readonly value="1" style="background:#DFE7EF" id="soluongtin_'+idt+'"/></td></tr>'; else 
				code3='<tr><td><input type="checkbox"/></td><td>'+postbds+'</td><td><input readonly class="date" id="Date_'+div+'" value="'+dd+'-'+mm+'-'+yyyy+'" type="text" size="5" onclick="calendar(\''+div+'\')"/><input id="Hour_'+div+'" type="text" class="hour" value="00" onkeyup="document.getElementById(\'Hour2_'+div+'\').value=this.value"/>giờ <input onkeyup="document.getElementById(\'Min2_'+div+'\').value=this.value" type="text" value="00" class="min" id="Min_'+div+'" />phút<br/></td><td><input type="button" value="1" style="background:#DFE7EF" readonly id="soluongtin_'+idt+'"/></td></tr>';		
		}    
		var ale=quyen>=count[idt-1]?'style="color:red;"':'';
		if (idt==1) quyen1=quyen; else if (idt==2) quyen2=quyen; else quyen3=quyen;
		var code4='</table><table><tr><td>Số quyền hiện có là <b>'+count[idt-1]+'</b></td><td><p '+ale+'> Đã sử dụng <b>'+quyen+'</b> quyền</p></td></tr></table>';  
		document.getElementById(div).innerHTML =code1+code2+code3+code4+toolbar(div,title,mark); 	
	}
	function changebox(value) {
		document.getElementById("nganluong").checked=false;
		document.getElementById("baokim").checked=false;
		document.getElementById(value).checked=true;		
	}  
	function checkout(){		
		document.getElementById('method').value=='nganluong'?nganluong():baokim();
	}
	function napquyen(){
		$('.bClose').click();
		jQuery('#muaquyen').bPopup(); 
	}
	function goback(){ 
		$('.bClose').click();
		
		jQuery('#hen_gio_non_user').bPopup(); 
	}
	function ck(typex,soluong){		
		$.ajax({
			url:'<?php echo JURI::base();?>price.php',
			type:'POST', 
			data:{type:typex,group:<?php echo $group; ?>,max:soluong},
			success:function(data){	
			var tmp=data.split("|"); 
				if (typex==1){ck1=tmp[0];gia1=tmp[1];} else 
				if (typex==2){ck2=tmp[0];gia2=tmp[1];} else {ck3=tmp[0];gia3=tmp[1];}
				document.getElementById('gia_'+typex).innerHTML=fmoney(tmp[1]-(tmp[1]*tmp[0]/100));
				var dongia=tmp[1];
				var sumrow=soluong==0?0:soluong*dongia;
				sumrow-=(sumrow*tmp[0]/100);
				(typex==1)?sumrow1=sumrow:(typex==2)?sumrow2=sumrow:sumrow3=sumrow;
				document.getElementById('sum_'+typex).innerHTML=fmoney(sumrow)+' VND';
				total=sumrow1+sumrow2+sumrow3;
				total-=(total*km/100);
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
				refresh(); 
				document.thanhtoan.submit();
			}			    
		});
	}
	var sum_daytin=0,sum_noibat=0,sum_danhdau=0;
	function recount(idt,soluong){
		if (Number(soluong)>=0) ck(idt,soluong); 
	}
	function hen_gio_non_user(postid){
        postbds=postid;	 
		refresh(); 
		showsms();
		showsms2(); 
		jQuery('#hen_gio_non_user').bPopup(); 
	}
	function showsms ()	{
		var code1='<div class="smsbox"><p class="p1">Để đẩy tin này lên, soạn tin theo cú pháp</p>'+
						'<p class="p2">SMS NUP '+postbds+' gửi 8085</p>'+  
						'<p class="p3">(Một tin nhắn trị giá 5,000 VND)</p></div>';
		var code2='<div class="smsbox"><p class="p1">Để đánh dấu tin này trong một (1) ngày, soạn tin theo cú pháp</p>'+
						'<p class="p2">SMS NDD '+postbds+' gửi 8085</p>'+
		'<p class="p3">( Bạn có thể nhắn nhiều lần để được đánh dấu tin theo số ngày tương ứng. <br/>Một tin nhắn có giá trị 10,000VNĐ. )</p></div>';
		var code3='<div class="smsbox"><p class="p1">Để làm nổi bật tin này trong một (1) ngày, soạn tin theo cú pháp</p>'+
						'<p class="p2">SMS NNB '+postbds+' gửi 8085</p>'+
		'<p class="p3">(Bạn có thể nhắn nhiều lần để làm nổi bật tin theo số ngày tương ứng.<br/>Một tin nhắn có giá trị 15,000VNĐ.)</p></div>';
						
		document.getElementById('smsarea').innerHTML=code1+code2+code3;
	}
	function showsms2 ()	{
		var code1='<div class="smsbox"><p class="p1">Để nạp hai (2) quyền đẩy tin, soạn tin theo cú pháp</p>'+
						'<p class="p2">SMS MUP <?php echo $user->id; ?> gửi 8085</p>'+
						'<p class="p3">(Một tin nhắn có giá trị 5,000VNĐ.)</p></div>';
		var code2='<div class="smsbox"><p class="p1">Để nạp một (1) ngày đánh dấu tin, soạn tin theo cú pháp</p>'+
						'<p class="p2">SMS MDD <?php echo $user->id; ?> gửi 8085</p>'+
		'<p class="p3">(Bạn có thể nhắn nhiều lần để được nạp số ngày tương ứng.<br/>Một tin nhắn có giá trị 10,000VNĐ.)</p></div>';
		var code3='<div class="smsbox"><p class="p1">Để nạp quyền làm nổi bật , soạn tin theo cú pháp</p>'+
						'<p class="p2">SMS MNB <?php echo $user->id; ?> gửi 8085</p>'+
		'<p class="p3">(Bạn có thể nhắn nhiều lần để được nạp số ngày tương ứng.<br/>Một tin nhắn có giá trị 15,000VNĐ.	)</p></div>';
						
		document.getElementById('smsarea2').innerHTML=code1+code2+code3;
	}
	function refresh(){
		$.ajax({ 
			url:'<?php echo JURI::base(); ?>napquyen.php', 
			type:'POST',
			data:{request:'ok',user:<?php echo $user->id; ?>},
			success:function(data){
				count=data.split('|');		
				tableadd(1,'đẩy tin',a,dema,false); 
				tableadd(2,'đánh dấu tin',b,demb,false);
				tableadd(3,'nổi bật tin',c,demc,false);
				calendar('tb1');calendar('tb2');calendar('tb3');   
			}			
		});
	}
	refresh();	
		
	<?php 
	if (isset($_GET['id'])) {
		echo 'postbds='.$_GET['id'].'; showsms();showsms2();';  
	} 
	if (($_SESSION['hengio']==1) && (strtolower($_SESSION['www'])=='http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'])) {
	echo "   
		$(document).ready(function() { 
			jQuery('#hen_gio_non_user').bPopup();
		});";     
		$_SESSION['hengio']=2;  
	}
	?> 
</script> 