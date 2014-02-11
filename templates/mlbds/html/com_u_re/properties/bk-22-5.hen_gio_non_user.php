<!--- MÀN HÌNH HẸN GIỜ CỦA NON-USER --------------------------------------------------->
<style>
.smoothness li a{font-size:10pt;}
#smsarea{height:400px; }
	.smsbox{-moz-box-shadow: 0 0 5px #CCC;-webkit-box-shadow: 0 0 5px #CCC;box-shadow: 0 0 5px #CCC;width:580px;margin:5px auto;padding-top:13px; padding-bottom:13px;border-radius:5px;background:#EEE;text-align:center;margin-top:15px;}
	.smsbox:hover{-moz-box-shadow:inset 0 0 20px #666666;-webkit-box-shadow:inset 0 0 20px #666666;box-shadow:inset 0 0 20px #666666;}
	.p1{font-size:12pt;margin-bottom:10px;}.p2{font-size:15pt;margin-bottom:5px;}.p3{font-size:10pt; font-style: italic;}
</style>
<div id="hen_gio_non_user" class="facebook" style="width:650px; height:430px; display: none;"><span class="bClose"></span>
<div class="pp_top fb_top"> 
			<div class="pp_left fb_left"></div>
			<div class="pp_middle fb_middle"></div> 
			<div class="pp_right fb_right"></div>
		</div>
<div class='pp_content_container fb_content_container'>
		<div class="pp_left fb_left "> 
			<div class="pp_right fb_right"> 
					<div class="contact_title">		
				<div class="smoothness"> 
					<ul id="tabpoppu" class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
						<li id='sms' rel="subtab_1" class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active"> <!--chua tab tong quan-->
							<span class="tab_active">  
								<a>NẠP QUYỀN QUA THẺ</a>
							</span>
						</li>     
						<!--
						<li id='sms' rel="subtab_2" class="ui-state-default ui-corner-top">
													<span class="tab_inactive">
														<a>NẠP QUYỀN QUA SMS</a>
													</span>		
												</li>-->
						
					</ul>
				</div> 
				<div class="boxholder">
					<div id="subtab_1"> 					
						<div id="checkout">
	<div class="area" id="tb1"></div> 
	<div class="area" id="tb2"></div>
	<div class="area" id="tb3"></div>
	<div class="sumary"> 
		<div class="title">Chiết khấu khuyến mãi:</div>
	    <div id="khuyenmai" style="float:right;padding-right:10px;font-weight:bold;"></div>
	</div> 
	<div class="sumaryx">
		<div class="title">Tổng cộng tiền cần thanh toán:</div>
	    <div id="total">0 VND</div>
	</div>
	<div class='thongtin'>
	<select id="method">
		<option value="nganluong">Thanh toán qua hệ thống Ngân Lượng</option>
		<option value="baokim" selected>Thanh toán qua hệ thống Bảo Kim</option>
	</select>
	</div> 
	<div class='thanhtoan'> 
	<input type="submit" class="sb_ck2"  value="Thanh toán" onclick="checkout();" name="thanhtoanbt" id="thanhtoanbt"/>	
    </div>  				
	<br/><br/>
	<div style="font-size:11pt; margin-top:5px;padding:2px;">Chấp nhận các loại thẻ </div>
			<div class="credit" style="margin-top:10px; ">	
				<?php include( dirname(__FILE__).'/credit.php'); ?>
	</div>	
</div>					</div>



<div id="subtab_2" class="box" class="box" style="display:none"> 					
						<div id="smsarea">
							<div class="smsbox">
								<p class="p1">Để đẩy tin này lên, soạn tin theo cú pháp</p>
								<p class="p2">BDS NUP <?php echo $_GET['id'];?> gửi 8549</p>
								<p class="p3">(Bạn có thể nhắn nhiều lần để được đẩy tin theo số ngày tương ứng.<br/>Một tin nhắn có giá trị 5,000 VND)</p>
							</div>
							<div class="smsbox">  
								<p class="p1">Để đánh dấu tin này trong một (1) ngày, soạn tin theo cú pháp </p>
								<p class="p2">BDS NDD <?php echo $_GET['id'];?> gửi 8649</p>
								<p class="p3">(Bạn có thể nhắn nhiều lần để được đánh dấu tin theo số ngày tương ứng.<br/>Một tin nhắn có giá trị 10,000VNĐ.)</p>
							</div>
							<div class="smsbox">
								<p class="p1">Để làm nổi bật tin này trong một (1) ngày, soạn tin theo cú pháp</p>
								<p class="p2">BDS NNB <?php echo $_GET['id'];?> gửi 8749</p>
								<p class="p3">(Bạn có thể nhắn nhiều lần để làm nổi bật tin theo số ngày tương ứng.<br/>Một tin nhắn có giá trị 15,000VNĐ)</p>
							</div> 
						</div>
					</div>
					  
				
				</div>		
<style>.date2 {width: 80px;border: 1px solid #96A6C5;padding: 3px;padding-left: 3px;margin-top:5px;}</style>
<?php if ( empty( $_GET['debug'] ) ) { ?>
<script language="javascript" src="<?php echo JURI::base();?>nganluong/include/nganluong.apps.mcflow.js"></script>
<?php }?>
<script> 
<?php 
	$db =& JFactory::getDBO();
	$db->setQuery('SELECT * FROM `jos_price` LIMIT 0,1');
	$inf=$db->loadAssoc();  
	echo 'var km='.$inf['km'].';';  
	$time=time();
	echo 'var hour_now='.date("H",$time).';';
	echo 'var min_now='.date("i",$time).';';
	echo 'var time_now='.$time.';'; 
?>
	document.getElementById('khuyenmai').innerHTML=km+'%';
	var a=new Array(20),b=new Array(20),c=new Array(20),dema=0,demb=0,demc=0,postbds,ck1=0,ck2=0,ck3=0,srow1=0,srow2=0,srow3=0,gia1=0,gia2=0,gia3=0; 
	for (var i=1;i<=15;i++){a[i]=new Array(100);b[i]=new Array(100);c[i]=new Array(100);}
	fillinf=function(d,m,div){
		d[1][m]=document.getElementById('Date_'+div).value;
		d[2][m]=document.getElementById('Hour_'+div).value;
		d[3][m]=document.getElementById('Min_'+div).value;		
		d[5][m]=(div=='tb1')?gia1:(div=='tb2')?gia2:gia3; 
		d[7][m]=0; 
		var tmp=d[1][m].split('-');		
		var time1 = new Date(Date.UTC(tmp[2],tmp[1]-1,tmp[0]));
		if (document.getElementById('Date2_'+div+'x')){
     		d[8][m]=document.getElementById('Date2_'+div+'x').value;
			tmp=d[8][m].split('-');		
			var time2 = new Date(Date.UTC(tmp[2],tmp[1]-1,tmp[0]));
			d[4][m]=(time2.getTime()/1000-time1.getTime()/1000)/(60*60*24);
		} else {
			d[4][m]=1; 				
			var dd = time1.getDate();
			var mm = time1.getMonth(); 
			var yyyy = time1.getFullYear();
			var nday=new Date(yyyy,mm,dd+1);
			dd = nday.getDate();
			mm = nday.getMonth()+1; 
			yyyy = nday.getFullYear(); 	
			d[8][m]=dd+'-'+mm+'-'+yyyy;
		}
		return d;
	}
	resum=function(){
		total=0;
		total=srow1+srow2+srow3;  		
		total-=(total*km/100);
		document.getElementById('total').innerHTML=fmoney(total)+' VND';
	}
	detect=function(div,title,id){
	var d=(div=='tb1')?a:(div=='tb2')?b:c;
	var demd=(div=='tb1')?dema:(div=='tb2')?demb:demc;
	var idt=(div=='tb1')?1:(div=='tb2')?2:3;
		switch (id){ 
			case 'add':tableadd(idt,title,d,demd,true);break;
			case 'save':{
			if (document.getElementById('Date2_'+div+'x')){
			m1=document.getElementById('Date_'+div).value;
			m2=document.getElementById('Date2_'+div+'x').value;
			var tmp=m1.split('-');		
			var time1 = new Date(Date.UTC(tmp[2],tmp[1]-1,tmp[0]));
			tmp=m2.split('-');		 
			var time2 = new Date(Date.UTC(tmp[2],tmp[1]-1,tmp[0]));
			day=(time2.getTime()/1000-time1.getTime()/1000)/(60*60*24);
			} else day=1;
			var hr=document.getElementById('Hour_'+div).value; 
			var min=document.getElementById('Min_'+div).value;
		    if (!validateTimeFormat24(hr,min)) {alert('Giờ phút không hợp lệ');break;} 
			if (day<=0) { alert('Ngày bạn vừa chọn không hợp lệ'); break;}
			//-------------------			
	 			demd=(div=='tb1')?++dema:(div=='tb2')?++demb:++demc;
				fillinf(d,demd,div);
				(div=='tb1')?a=d:(div=='tb2')?b=d:c=d;
				resum();
				tableadd(idt,title,d,demd,false);				 
			};break;  
			case 'cancel':tableadd(idt,title,d,demd,false);break;
			case 'del':{
				var mok=true;
				for (var i=1;i<=demd;i++) if (d[7][i]==0) { if (document.getElementById(div+'_'+i).checked) d[7][i]=1; mok=false; }
				(div=='tb1')?a=d:(div=='tb2')?b=d:c=d;
				resum();
				if (mok) alert('Vui lòng chọn ít nhất 1 mục để xoá');  
				tableadd(idt,title,d,demd,false);
			}
			break;
			default:  
		}		  
	} 
	function hen_gio_non_user(postid){				
		postbds=postid;
		jQuery('#hen_gio_non_user').bPopup(); 
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
	var tomorrow=new Date();
	var dd = tomorrow.getDate();
	var mm = tomorrow.getMonth()+1;
	var yyyy = tomorrow.getFullYear();
	 
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
	function cknon(typex){		
		$.ajax({
			url:'<?php echo JURI::base();?>price.php',
			type:'POST', 
			data:{type:typex,group:40,from:1,to:0},
			success:function(data){ 
			var tmp=data.split("|");  
				if (typex==1){ck1=tmp[0];gia1=tmp[1];} else 
				if (typex==2){ck2=tmp[0];gia2=tmp[1];} else {ck3=tmp[0];gia3=tmp[1];}
			}			 
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
				alert('Ngày tháng bạn chọn không hợp lệ !');
				document.getElementById(div).value=dd+'-'+mm+'-'+yyyy;
			};
			document.getElementById('soluongtin_1').value=1;
		} else
		if (div[div.length-1]=='x'){
			var vl=0;
			if (document.getElementById(div)){
				var df=document.getElementById('Date_'+div.substring(6,9)).value;
				tmp=df.split('-');		
				var time1 = new Date(Date.UTC(tmp[2],tmp[1]-1,tmp[0]));
				df=document.getElementById(div).value;
				tmp=df.split('-');		
				var time2 = new Date(Date.UTC(tmp[2],tmp[1]-1,tmp[0]));
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
				alert('Ngày tháng bạn chọn không hợp lệ !');
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
				alert('Ngày tháng bạn chọn không hợp lệ !');
				document.getElementById(div).value=dd+'-'+mm+'-'+yyyy;
				document.getElementById('soluongtin_'+div[div.length-2]).value=1;
			};
		 } 
	} 
	tableadd=function (idt,title,d,n,mark){
		var div='tb'+idt;  
		var code1='<table><th width="5px">#ID</th><th width="35">Mã tin</th><th>Hẹn giờ '+title+'</th><th width="54px">Số lượng</th><th width="90px">Đơn giá (VND)</th><th width="95px">Thành tiền (VND)</th>';
		var code2='',sum=0,sumrow=0,dem=0,code5='',soluong=0;  
		for (var i=1; i<=n;i++) if (d[7][i]==0) ++dem;
		if ((dem==0)&&!mark) code2='<tr><td colspan="6" align="center"><i>Chưa có hẹn giờ</i></tr>'; 
		else { 
		for (var i=1;i<=n;i++) 
			if (d[7][i]!=1) {  
			    sum=d[4][i]*d[5][i];
				soluong+=d[4][i]; 
				sumrow+=sum; 
			   if (idt!=1) code2+='<tr><td><input type="checkbox" id="'+div+'_'+i+'"/></td><td>'+postbds+'</td><td style="line-height:25px;">Từ ngày '+d[1][i]+' lúc '+d[2][i]+' giờ '+d[3][i]+' phút<br/>Đến ngày '+d[8][i]+' lúc '+d[2][i]+' giờ '+d[3][i]+' phút</td><td>'+d[4][i]+'</td><td>'+fmoney(d[5][i])+'</td><td>'+fmoney(sum)+'</td></tr>'; else
				code2+='<tr><td><input type="checkbox" id="'+div+'_'+i+'"/></td><td>'+postbds+'</td><td style="line-height:25px;">'+d[1][i]+' lúc '+d[2][i]+' giờ '+d[3][i]+' phút</td><td>1</td><td>'+fmoney(d[5][i])+'</td><td>'+fmoney(sum)+'</td></tr>';
			}
		}  
		  
		var code3=''; 
		if (mark){
			var today = new Date();
			var dd = today.getDate(); 
			var mm = today.getMonth()+1;
			var yyyy = today.getFullYear(); 
			var nday=new Date(yyyy,mm-1,dd+1);
			dd2 = nday.getDate();
			mm2 = nday.getMonth()+1; 
			yyyy2 = nday.getFullYear();  
			
			var ddS=dd.toString();
			var dd2S=dd2.toString(); 
			var mmS=mm.toString();
			var mm2S=mm2.toString();
			if (ddS.length==1) ddS='0'+ddS; 
			if (mmS.length==1) mmS='0'+mmS; 
			if (dd2S.length==1) dd2S='0'+dd2S; 
			if (mm2S.length==1) mm2S='0'+mm2S;
			
			if (idt!=1)	code3='<tr><td><input type="checkbox"/></td><td>'+postbds+'</td><td>Từ &nbsp&nbsp&nbsp&nbsp<input readonly class="date" id="Date_'+div+'" value="'+ddS+'-'+mmS+'-'+yyyy+'" type="text" size="5" onclick="calendar(\''+div+'\')"/><input  oncopy="return false;" onpaste="return false;" oncut="return false;" onkeypress="return limit(event)" id="Hour_'+div+'" type="text" class="hour" value="'+hour_now+'" onkeyup="copythis(\'Hour2_'+div+'\',this.value,23,\'Hour_'+div+'\');" />giờ <input  oncopy="return false;" onpaste="return false;" oncut="return false;" onkeypress="return limit(event)" onkeyup="copythis(\'Min2_'+div+'\',this.value,59,\'Min_'+div+'\');" type="text" value="'+min_now+'" class="min" id="Min_'+div+'" />phút<br/> Đến &nbsp<input readonly class="date2" id="Date2_'+div+'x" value="'+dd2S+'-'+mm2S+'-'+yyyy2+'" type="text" size="5" onclick="calendar2(\''+div+'x\')"/><input readonly disabled id="Hour2_'+div+'" type="text" class="hour" value="'+hour_now+'"/>giờ <input readonly disabled type="text" value="'+min_now+'" class="min" id="Min2_'+div+'" />phút</td><td><input type="button" readonly disable value="1" style="background:#DFE7EF" id="soluongtin_'+idt+'"/></td><td>'+((div=='tb1')?gia1:(div=='tb2')?gia2:gia3)+'</td><td></td></tr>'; else  
				code3='<tr><td><input type="checkbox"/></td><td>'+postbds+'</td><td><input class="date" id="Date_'+div+'" value="'+ddS+'-'+mmS+'-'+yyyy+'" type="text" size="5" onclick="calendar(\''+div+'\')"/><input value="'+hour_now+'" onkeypress="return limit(event)" id="Hour_'+div+'" type="text" class="hour" onkeyup="copythis(\'Hour2_'+div+'\',this.value,23,\'Hour_'+div+'\');" oncopy="return false;" onpaste="return false;" oncut="return false;" />giờ <input onkeypress="return limit(event)" onkeyup="copythis(\'Min2_'+div+'\',this.value,59,\'Min_'+div+'\');" type="text" oncopy="return false;" onpaste="return false;" oncut="return false;" value="'+min_now+'" class="min" id="Min_'+div+'" />phút<br/></td><td><input type="button" value="1" disabled style="background:#DFE7EF" readonly id="soluongtin_'+idt+'"/></td><td>'+((div=='tb1')?gia1:(div=='tb2')?gia2:gia3)+'</td><td></td></tr>';			
		}   
		var code4="</table>";  
		var ck='<div id="chietkhau_'+idt+'" style="padding:5px; margin-top:7px;float:right;border-radius:3px;"></div>'; 
		var chietkhau=(idt==1)?ck1:(idt==2)?ck2:ck3;
		var dongia=(idt==1)?gia1:(idt==2)?gia2:gia3;
		sumrow-=sumrow*chietkhau/100;
		// SECURE
		(idt==1)?srow1=sumrow:(idt==2)?srow2=sumrow:srow3=sumrow;
		
		var sumpart='<table style="margin-top:-5px; margin-bottom:5px;"><tr><td style="text-align:right; padding-right:20px;">Tổng cộng</td><td width="50px">'+soluong+' </td><td width="75px">'+fmoney(dongia)+'</td><td width="90px"><div id="sumrow_'+idt+'">'+fmoney(sumrow)+'</div></td></tr></table>';  
		document.getElementById(div).innerHTML =code1+code2+code3+code4+toolbar(div,title,mark)+ck+sumpart;
		cknon(idt); resum();
	}
	function checkout() {		
		document.getElementById('method').value=='nganluong'?nganluong():baokim();
	}
	
	tableadd(1,'đẩy tin',a,dema,false); 
	tableadd(2,'đánh dấu tin',b,demb,false);
	tableadd(3,'nổi bật tin',c,demc,false);
</script> 
			</div></div></div>	
</div>

		<div class="pp_bottom fb_bottom"> 
			<div class="pp_left1 fb_left"></div>
			<div class="pp_middle fb_middle"></div>
			<div class="pp_right fb_right"></div>
		</div>
</div>