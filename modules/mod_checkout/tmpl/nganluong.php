<script type="text/javascript" src="nganluong/include/nganluong.apps.mcflow.js"></script>
<script type="text/javascript">
var total=0,postbds,flag=true; 
function get(key){return document.getElementById(key).value;}
    function nganluong(){
		var email='';	 	 
		if (total<2000) {alert('Phí thanh toán từ 2.000 VNĐ trở lên mới có thể dùng Ngân lượng !'); return;} 
		$.ajax({
			url:'<?php echo JURI::base(); ?>modules/mod_checkout/checkout.php',
			type:'POST', 
			data:{
				payment:'nganluong',  
				url:'<?php echo 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];?>',
				www:window.location.href, 
				user:<?php echo $user->id;?>,
				post:postbds, 
				dema:dema,
				demb:demb, 
				demc:demc, 				
				a:a,
				b:b,
				c:c,				
			<?php if ($user->id!=0){ ?> 
				daytin:document.getElementById('quyen_daytin').value,
				danhdau:document.getElementById('quyen_danhdau').value,
				noibat:document.getElementById('quyen_noibat').value,
			    ddgia1:gia1,
				ddgia2:gia2,
				ddgia3:gia3, 
			<?php  } ?>	
				price:total,
				order:postbds,
				tax:0,
				ship:0,				 
				detail:'Mua hàng'
			}, 
			success:function(data) {
				var mc_flow = new NGANLUONG.apps.MCFlow({trigger:'thanhtoanbt',url:data});	
				if 	(flag) $('#thanhtoanbt').click();
				flag=false;
				$('.bClose').click();
			}			
		});
	}
</script>