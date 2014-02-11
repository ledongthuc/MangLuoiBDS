<!--javasrcipt cho tab-->
<script type="text/javascript">
function init(){
 var stretchers = document.getElementsByClassName('box');
 var toggles = new Array();
 toggles[0] = document.getElementById('tab_image');
 toggles[1] = document.getElementById('tab_map');
 var myAccordion = new fx.Accordion(
 toggles, stretchers, {opacity: false, height: true, duration: 600}
);
 //hash functions
 var found = false;
 toggles.each(function(h3, i){
 var div = Element.find(h3, 'nextSibling');
 if (window.location.href.indexOf(h3.title) > 0) {
 myAccordion.showThisHideOpen(div);
 found = true;
 }
 });
 if (!found) myAccordion.showThisHideOpen(stretchers[0]);
}

function changeStatusTabMap(id_active, id_inactive)
{
document.getElementById(id_active).className = "tab_active";
 document.getElementById(id_inactive).className = "tab_inactive";
} 
</script>
<!--javasrcipt cho tab-->
<div class="properties">
    <div class="total"><!-- div chua title-->
                <div><h2 class="title_details">THE EVERRICH II – Tuyệt tác kiến trúc đương đại bên sông sài gòn</h2></div>
    </div><!-- div chua title-->
    <div class="properties-detail"><!-- div chua phan thong tin+ hinh anh -->
    <div class="properties-detail-l"> <!-- div chua hinh ảnh-->
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
     <div class="properties-detail-r"> <!-- Thông tin -->
        <li>
        	<span class="items-add1">Địa chỉ: Tây Thạnh, Quận Tân Phú, TP.Hồ Chí Minh </span>
        </li>
        <li>
       		 <span class="msts">Mã số tài sản: </span><span class="msts-n">3695</span>
        </li>
        <li>
        	<span>Số lượng người xem:</span><span class="item-visit">123456</span>
        </li>
        	<span class="items-price">2 tỷ</span><span> Đơn vị</span>
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
        <li class="item-contact"><!--thong tin lien hệ--->
        <span>Liên hệ:<br /></span>
        <span><img src="./images/avatar.jpg" /></span>
        <a href="#">Nguyễn Văn A</a><br />
        <a href="#">Tài sản đã đăng</a>
        <div class="clear">
        </div>
        </li>
    </div> <!-- Thông tin -->
    </div><!-- div chua phan thong tin+ hinh anh -->
    <div class="clear"id="info-detail"><!-- div chua thong tin chi tiet-->
    	<div id="info-detail-title">
	    <span> Thông tin chi tiết
    	</span>
    	</div>
    <p class="info">
    Quá rẻ để đầu tư cho nền đất này, dân cư đông đúc, ngay sát trường học, chợ, đường 25m thông dài! Có xe đưa Quý khách đi xem	 miễn phí.
Liên hệ ngay: 0914 715 816. 
    </p>
    <div class="info-structure"><!--div chua cau truc-->
    <div class="info-structure-title">
        <span>
		  Cấu trúc
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
     <div class="info-structure"><!--div chua chia se-->
    <div class="info-structure-title">
        <span>
		 Chia sẻ
	    </span>
    </div>
   <div class="addthis_toolbox">

    <div class="hover_effect">
   
        <div><a class="addthis_button_email">&nbsp; &nbsp;Email</a></div>
        <div><a class="addthis_button_print">&nbsp; &nbsp;Print</a></div>        
        <div><a class="addthis_button_facebook">&nbsp; &nbsp;Facebook</a></div>
        <div><a class="addthis_button_myspace">&nbsp; &nbsp;Myspace</a></div>     
        <div><a class="addthis_button_expanded">&nbsp; &nbsp;More...&nbsp;</a></div>
       
        <div style="clear:both; float:none;"></div> 
    </div>
</div>
  <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=YOUR-ACCOUNT-ID"></script>
    </div><!--div chua chia se-->
    </div><!-- div chua thong tin chi tiet-->
    <div  class="structure-other"><!-- bat dong san lien quan-->
    <div id="info-detail-title">
    <span>
    Bất động sản liên quan
    </span>
    </div>
    <div">
    <?php 
				echo $this->GetBDSLienQuan($keyvnprice);
				
			?>
    </div>
    </div><!-- bat dong san lien quan-->
</div>
