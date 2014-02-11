<div class="project">
<div class="total"><!-- div chua title-->
                <div class="title_details">BABYLON RESIDENCE - Không gian sống đỉnh cao</div>
    </div><!-- div chua title-->
    <!--{magictabs}-->
    <div class="smoothness">
    <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
  	 <li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active"> <!--chua tab tong quan--><a href="#">Tổng quan</a>
     </li>
<li class="ui-state-default ui-corner-top"><!-- bản đồ vị trí-->
<a href="#">Bản đồ vị trí</a>
</li><!-- bản đồ vị trí-->
<li class="ui-state-default ui-corner-top"><!-- Sơ đồ mặt bằng-->
<a href="#">Sơ đồ mặt bằng</a>
</li><!-- Sơ đồ mặt bằng-->
<li class="ui-state-default ui-corner-top"> <!-- Tiến độ -->
<a href="#">Nhà mẫu</a>
</li><!-- Nhà mẫu-->
<li class="ui-state-default ui-corner-top"> <!-- đối tác-->
<a href="#">Tiện ích</a>
</li><!-- Tiện ích-->
<li class="ui-state-default ui-corner-top"> <!--thanh toán-->
<a href="#">Thanh toán</a>
</li><!-- thanh toán-->
<li class="ui-state-default ui-corner-top"> <!-- đối tác-->
<a href="#">Tin tức</a>
</li><!-- Tin tức-->
<li class="ui-state-default ui-corner-top"><!-- liên hệ-->
<a href="#">Liên hệ</a>
</li><!--Liên hệ-->
 </ul>
<div id="project_detail">
<div class="properties-detail-l">
  <div class="project-images"><!-- hình ảnh lớn--->
  <img src="./images/preview.jpg" />
  </div><!-- hình ảnh lớn--->
   <div class="snd_imgs" ><!--hình ảnh thumbsnail-->
             	<li>
    				<img src="./images/min.jpg" />         	
             	</li>
                <li>
    				<img src="./images/min.jpg" />         	
             	</li>
                <li>
    				<img src="./images/min.jpg" />         	
             	</li>
                <li>
    				<img src="./images/min.jpg" />         	
             	</li>
             </div><!--hình ảnh thumbsnail-->
</div>

<div class="properties-detail-r">

     <div>
           <span class="msts"> Địa chỉ :</span><span class="bold">28 Trịnh Đình Thảo, P. Hòa Thạnh</span>
    </div>
    <div>
            <span class="msts">Loại hình: </span><span class="bold">Khu đô thị, Khu thương mại,</span>
	</div>
    <div>
            <span class="msts">Ngày khởi công: </span><span class="bold">	01-01-1970</span>
    </div>
	<div>
            <span class="msts">Ngày hoàn thành:</span><span class="bold"> 	01-01-1970</span>
    </div>
   	<div>
            <span class="msts">Chủ đầu tư:</span> <span class="bold">CTCP Tư vấn đầu tư & phát triển Trung Đông</span>
    </div>
	<div>
	<div class="item-contact">
	    <span>Liên hệ :<br /></span>
        <a href="#">Nhà đầu tư</a><br />
        <a href="#">Địa chỉ nhà đầu tư</a>
        
	</div>
    </div>

</div>
</div>
<div class="info-structure clear"><!--div thong tin chi tiet-->
    <div class="info-structure-title">
        <span>
		  Thông tin chi tiết
	    </span>
    </div>
    <p>
    Tổng diện tích sử dụng: 72m² 	Loại địa ốc: Căn hộ cao cấp 	Phòng ngủ: 3
	DTKV:   Chiều rộng: 4m  Chiều dài: 3m 	Pháp lý: Sổ đỏ. 	Phòng tắm/WC: 2
	DTXD:   Chiều rộng: _   Chiều dài:_ 	Hướng: Hướng Đông 	Phòng khác: 1 
	</p>
</div><!--div thong tin chi tiet-->
<div >
<span>Liên hệ</span>
<div id='contact'>
	<div class='f-l'>
	<li>Họ và tên:
	</li>
	<li>
	Điện thoai:
	</li>
	<li>
	Email:
	</li>
	</div>
	<div class='f-r'>
	<li>
	<input type="text" size="40" />
	</li>
	<li>
	<input type="text" size="40" />
	</li>
	<li>
	<input type="text" size="40" />
	</li>
	<li>
	<span><input type="checkbox" value="mua nhà" /> Mua nhà</span>
	<span><input type="checkbox" value="mua nhà" /> Xem nhà mẫu</span>
	<span><input type="checkbox" value="mua nhà" /> Đăng kí tư vấn</span>
	</li>
	<input class="button" type="button" value="Gửi thông tin" />
	</div>
	<br class="clear"></br>
</div>
</div>





 <div class="info-structure clear"><!--div Dự án liên quan-->
    <div class="info-structure-title">
        <span>
		  Dự án liên quan
	    </span>
    </div>
    <div>

	<?php 
	if(count($this->listOther) > 0)
	{
	?>
					<!-- list other projects -->
		 <?php  echo JText::_('cacduanlienquan')  ?>		
				<?php
					foreach($this->listOther as $otherProj)
					{
					?>
                    <li class='item1'>
						<img  src='modules/mod_jea_search/tmpl/arrow.gif'>
					  			<span onmouseover="showttip( '<?php echo htmlentities($otherProj->project_spec, ENT_QUOTES, 'UTF-8'); ?>', 400);" onmouseout="hidettip();"/>
					  				<a href="<?php echo $otherProj->link; ?>"><?php echo $otherProj->value; ?></a>
					  			</span>
					 </li>
					<?php }
				?>
	<?php 
	}
	?>
	 		<?php 
	if(count($this->listSameInvestor) > 0)
	{
	?>
	 <!--	 same investor projects -->
	 	
		 	<!-- list same investor projects -->
		 	<?php  echo JText::_('cacduancungchudautu')  ?>		
				<?php
					foreach($this->listSameInvestor as $sameProj)
					{
					?>
						<li class='item1'><img src='modules/mod_jea_search/tmpl/arrow.gif'>
					  		<span onmouseover="showttip( '<?php echo $sameProj->project_spec ?>', 340);" onmouseout="hidettip();"/><a href="<?php echo $sameProj->link ?>"><?php echo $sameProj->value; ?></a>
					  	</span>
                        </li>
					<?php }
				?>
	 		<?php 
	}
	?>

    </div>
</div><!--div dự án liên quan-->
</div>
 
</div>