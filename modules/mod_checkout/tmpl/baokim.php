<script type="text/javascript">
	function baokim(){
		var email='';	 	
		if (total<10000) {alert('Phí thanh toán từ 10.000 VNĐ mới có thể dùng Bảo Kim !'); return;} 
		$.ajax({
			url:'<?php echo JURI::base(); ?>modules/mod_checkout/checkout.php',
			type:'POST',
			data:{
				payment:'baokim', 
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
			<?php if ($user->id!=0){?>
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
			success:function(data){ 
				window.location=data; 			
			}			
		});
	}
</script>