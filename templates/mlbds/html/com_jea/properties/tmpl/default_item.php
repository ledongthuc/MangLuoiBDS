<div class="properties">
 <div class="total"><!-- div chua title-->
                <div><h2 class="title_details"><a href="#">THE EVERRICH II – Tuyệt tác kiến trúc đương đại bên sông sài gòn</a></h2></div>
    </div><!-- div chua title-->
    <div class="properties-detail"> <!-- Thông tin -->
    	<div id="info-detail-title">
	    <span> Thông tin cơ bản
    	</span>
    	</div>
        <li>
        	<span class="items-add1">Địa chỉ: Tây Thạnh, Quận Tân Phú, TP.Hồ Chí Minh </span>
        </li>
        <li>
       		 <span class="msts">Mã số tài sản: </span><span class="msts-n">3695</span>
        </li>
        <li>
        	<span>Số lượng người xem:</span><span class="item-visit">123456</span>
        </li>
        	Giá bán: <span class="items-price">2 tỷ</span><span> Đơn vị</span>
        <li>
        Phòng :
        </li>
        <li>
            <span class="msts">Khách:</span><span class="bold"> 5</span>
            <span class="msts">Ngủ:</span><span class="bold"> 5</span>
            <span class="msts">Tắm:</span><span class="bold"> 5</span>
            <span class="msts">Khác:</span><span class="bold"> 5</span>
        </li>
        <li>
            <span class="msts">Diện tích khuôn viên:</span>
            <span class="bold"> 4m X 3m</span>
        </li>
        <li>
        	<span class="msts">Diện tích sử dụng:
            </span>
            <span class="bold">
            72m
            </span>
        </li>
        <li>
        <span class="msts">
        Pháp lý:
        </span>
        <span class="bold">
        Số đỏ
        </span>
        </li>
    </div> <!-- Thông tin -->
      <div id="info-detail"><!-- div chua thong tin chi tiet-->
    <div class="info-structure"><!--div chua cau truc-->
    <div class="info-structure-title">
        <span>
		  Cấu trúc bất động sản
	    </span>
    </div>
    <p>
    Tổng diện tích sử dụng: 72m² 	Loại địa ốc: Căn hộ cao cấp 	Phòng ngủ: 3
	DTKV:   Chiều rộng: 4m  Chiều dài: 3m 	Pháp lý: Sổ đỏ. 	Phòng tắm/WC: 2
	DTXD:   Chiều rộng: _   Chiều dài:_ 	Hướng: Hướng Đông 	Phòng khác: 1 
	</p>
    </div><!--div chua cau truc-->
     <div class="info-structure"><!--div chua tien ich-->
    <div class="info-structure-title">
        <span>
		  Tiện ích
	    </span>
    </div>
    <p>
    Tổng diện tích sử dụng: 72m² 	Loại địa ốc: Căn hộ cao cấp 	Phòng ngủ: 3
	DTKV:   Chiều rộng: 4m  Chiều dài: 3m 	Pháp lý: Sổ đỏ. 	Phòng tắm/WC: 2
	DTXD:   Chiều rộng: _   Chiều dài:_ 	Hướng: Hướng Đông 	Phòng khác: 1 
	</p>
    </div><!--div chua tien ich-->
        <div class="info-structure">
    	<div class="info-structure-title">
        <span>
        Mô tả
        </span>
        </div>
        <p class="info">
    Quá rẻ để đầu tư cho nền đất này, dân cư đông đúc, ngay sát trường học, chợ, đường 25m thông dài! Có xe đưa Quý khách đi xem	 miễn phí.
Liên hệ ngay: 0914 715 816. 
    </p>
    </div>
     <div class="info-structure2"><!--div chua chia se-->
  

     <div class="properties-detail_w"> <!-- div chua hinh ảnh-->
    		<span onMouseDown="changeStatusTabMap('tab_image', 'tab_map')" id="tab_image" class="tab_active" title="first">
            <div id="title_real"> <!-- tab hinh ảnh-->
								<center>Hình ảnh</center>
			</div><!-- tab hình ảnh-->
            </span>
            <?php 		
				if($this->params->get('googlemap_display') == '1')
					{					
						if($this->params->get('googlemap_disable') == '1')
						{							
						echo "<span onMouseDown=\"changeStatusTabMap('tab_map', 'tab_image')\" id='tab_map' class='tab_inactive' style='margin-left:1px;' title='first'>";
						}
						else
						{
						echo 	"<span id=\"tab_map3\" class=\"tab_inactive1\" style=\"margin-left:1px;\" title=\"first\">";
						}					
						
						?>		
   			 <div id="title_real"><!-- tab bản đồ-->
								<center>Bản đồ</center>
			</div><!-- tab bản đồ-->
            <?php 
			echo "</span>";
					}
				?>
				<span id="tab_video"><!--  video -->
              		<div id="title_real">
					<center>Video</center>
					</div>
				</span><!--  video -->
   			 <!-- div chưa hình ảnh + bản đồ-->
   			 <div class="boxholder"><!--boxholder-->
  			  <div class="box" style="overflow:hidden; height:1%;"><!--hình ảnh lớn-->
	   			 <div class="image-pre"><!--hình ảnh lớn-->
                 <img src="./images/preview.jpg" />
                 </div><!--hình ảnh lớn-->
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
   			 </div><!--hình ảnh lớn-->
             
              <div class="box" style="overflow:hidden; height:0">
						<div id="map_canvas">
                        <img src="./images/map.png" />
						</div>
              </div>
              <div class="box"> <!--  chen video -->
              
              </div><!-- chen video -->
    </div><!--boxholder-->
    </div> <!-- div chua hinh ảnh-->
</div>
    <div class="info-structure">
    	<div class="info-structure-title">
        <span>
        Thông tin người đăng
        </span>
        </div>
    <div class="item-contact"><!--div chua thong tin nguoi dang-->
    
      
        <span>Liên hệ:</span>
        <div>
      <img src="./images/avatar.jpg" />
        <a href="#">Nguyễn Văn A</a><br />
        <a href="#">Tài sản đã đăng</a>
        <br class="clear"/>
        </div>
        </div>    
    </div><!--div chua thong tin nguoi dang-->
    </div>
    </div><!-- div chua thong tin chi tiet-->
</div>