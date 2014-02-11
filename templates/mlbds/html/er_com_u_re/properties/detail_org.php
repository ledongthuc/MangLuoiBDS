<?php // no direct access
defined('_JEXEC') or die('Restricted access');
JHTML::stylesheet('jea.css', 'media/com_jea/css/');
include_once "libraries/unisonlib/com_jea_lib.php";

$this->row = $this->propertyData;
$this->row->id = 1;

if(!$this->row->id){
    echo JText::_('This property doesn\'t exists anymore');
    return;
}
?>
<!--<img src="./images/images.jpg" />-->
<script language="javascript" type="text/javascript" src="libraries/js/mailBDS.js"></script>
<script language="javascript" type="text/javascript" src="libraries/js/ham-tien-ich.js"></script>

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

<?php if ( $this->params->get('show_googlemap') ) {?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<style type="text/css">
    #map_canvas{width:447px;margin-top:2px;margin-left:2px;border:1px solid dashed;
                 height:330px;}
</style>
<script>
window.onload = function()
{
    var options = {
        zoom: 16,
        disableDefaultUI:true,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    var map = new google.maps.Map(document.getElementById('map_canvas'), options);
    var map_lat = <?php echo $this->row->map_lat;?>;
	var map_lng = <?php echo $this->row->map_lng;?>;
	var realPosition = new google.maps.LatLng(map_lat, map_lng);
	var info = "<?php echo $this->row->address;?>";

	map.setCenter(realPosition);
    var marker = new google.maps.Marker({                	
        map: map,
        position: realPosition,	                   
        clickable: true,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow({
        content: info
    });//end InfoWindow

    google.maps.event.addListener(marker, 'click', function() {
        infowindow.open(map, marker);
    });//end infoWindow
}
<?php }?>
</script>


<!-- hien thi hinh anh --> 
<!-- hien thi chi  tiet bat dong san -->
<div class="bds1"><!--div big-->
        <div class="total"><!-- div chua title-->
                <div class="title_details"><h1><?php echo $this->escape($this->row->ref)//$this->page_title ?> </h1></div>
                </div><!-- div chua title-->
        <div class="details"> <!-- phan chua noi dung-->
        <div id="wrapper"><!--div chua phan hinh anh-->
				<div id="content">
					<span onMouseDown="changeStatusTabMap('tab_image', 'tab_map')" id="tab_image" class="tab_active" title="first">
						<div id="title_real">
								<center>Hình ảnh</center>
						</div>
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
						<div id="title_real">
							<center>Bản đồ</center>		
						</div>
						</span>
		
				<?php 
					}
				?>
		
		
						<div class="boxholder"><!--boxholder-->
                            <div class="box">
					               
						 <?php 
						 /* hoan 2010_10_25 hiện hình thay thế khi không có hình */
                        if(file_exists(JPATH_ROOT.DS.'images'.DS.'com_jea'.DS.'images'.DS.$this->row->id.DS.'min.jpg'))
                        {
							if($img = is_file(JPATH_ROOT.DS.'images'.DS.'com_jea'.DS.'images'.DS.$this->row->id.DS.'min.jpg')) : ?>
	 						 <div> <img id="img_preview" src="<?php echo $this->main_image['preview_url'] ?>" alt="preview.jpg"  /> </div>
							<?php endif ?>
							<?php 
						}
						else
						{
							?>
							 <div> <img id="img_preview" src="./images/noimage.jpg"  /> </div>
							 <?php
						
						}							
							 ?>  
                                <?php if( !empty($this->secondaries_images)): ?>
<div class="snd_imgs" >
	  <img src="<?php echo $this->main_image['min_url'] ?>" alt="<?php echo $this->main_image['name'] ?>" 
	  title="<?php echo JText::_('Enlarge')?>" onclick="swapImage('<?php echo $this->main_image['preview_url'] ?>')" /> 
	<?php foreach($this->secondaries_images as $image) : ?>
      <img src="<?php echo $image['min_url'] ?>"  alt="<?php echo $image['name'] ?>" 
	  title="<?php echo JText::_('Enlarge')?>" onclick="swapImage('<?php echo $image['preview_url'] ?>')" />
    <?php endforeach ?>
</div>
<?php endif ?>
                   </div>
                   <?php if ( $this->params->get('show_googlemap') ) {?>
                    <div class="box">
						<div id="map_canvas">
						</div>
                   </div>
					<?php }?>		
		
						</div><!--boxholder-->
			</div><!-- div content-->
</div><!--div chua phan hinh anh-->
 		<div class="info"><!--div chua info-->		
					<div class="msts">
					<!--
                    <div style="HEIGHT: 60px" class="mstst">
					<img src="images/ico_chothue.gif" width="31" height="23"/>                  
                    </div>
					-->
                    <div class="mstsf"><?php echo JText::_('MATS');?>: <span><?php echo $this->row->id;?></span></div>
					</div>				
		                <h2>
						<?php 
						if($this->row->address != NULL)
						{
							echo JText::_('address');
							echo ": ";
						}
						?>
                     	<?php  echo $this->row->address;?>
                        </h2>
                    <div class="bds2"><!--bds2-->
                            <div id="money">
<!--                                <div id="mon1">-->
                                   		<?php echo $this->getShowAjax();?>
<!--                                </div>-->
                                <div style="clear:both">
                                </div>
                                <div class="dt"><!--price--><span class="phong"><?php echo JText::_('Phòng');?>:</span>
                                <div class="dtA"><!-- thong tin-->
                              
                                        <span title="Phòng Khách" class="phongkhach"><?php echo JText::_('Khách');?>: 
                                        <?php
                                        if($this->row->mainrooms==0)
                                        {
                                        	echo "_";
                                        }
                                        else
                                        {
                                        	echo $this->row->mainrooms;
                                        }
                                          
                                         ?></span>
                                        <span title="Phòng Ngủ" class="phongngu"><?php echo JText::_('Ngủ');?>: 
                                        <?php 
                                        if($this->row->rooms==0)
                                        {
                                        	echo "_";
                                        }
                                        else
                                        {
                                        	echo $this->row->rooms;
                                        }
                                        ?></span>
                                        <span title="Phòng Tắm / WC" class="phongtam"><?php echo JText::_('Tắm');?>: 
                                        <?php 
                                         if($this->row->toilets==0)
                                        {
                                        	echo "_";
                                        }
                                        else
                                        {
                                        	echo $this->row->toilets;
                                        }                                       
                                        ?></span>
                                        <span title="Phòng Khác" class="phongkhac"><?php echo JText::_('Khác');?>: 
                                        <?php 
                                         if($this->row->highrooms==0)
                                        {
                                        	echo "_";
                                        }
                                        else
                                        {
                                        	echo $this->row->highrooms;
                                        }                                              
                                        ?></span>
			       				 </div><!-- thong tin-->
                                <span>
                                   <?php echo JText::_('Diện tích khuôn viên');?>: <strong>
                                   <?php	
                                   if($this->row->kv_width==0 || $this->row->kv_length==0 )
                                   {
                                   	echo "_";
                                   }
                                   else 
                                   {
                                   	echo $this->row->kv_length."m"." X ".$this->row->kv_width."m";
                                   }
                                    ?>                                   
                                    </strong>
                                   <?php	//echo $this->row->living_width.' x '.$this->row->living_length ?></strong><br>
                                  <?php echo JText::_('Diện tích sử dụng');?>:  <strong>
								  <?php									
								   if($this->row->living_width==0 || $this->row->living_length==0 )
                                   {
                                   	echo "_";
                                   }
                                   else 
                                   {
                                   	echo $this->row->living_length."m"." X ".$this->row->living_width."m";
                                   }
								 ?>
								  </strong>
                               
                               <br/>
								    <?php echo JText::_('Pháp lý');?>: <strong>
								    <?php 	
											
								    $id=$this->row->id;											
								    if($this->getlegal_statusList($id)=="")
								    {
								    	echo "_";
								    }
								    else
								    {
								    	echo $this->getlegal_statusList($id);
								    }				
								    		
								    ?>
								    </strong>
                                </span>
                                </div>
                                <div class="contact"><!-- thong tin lien hê-->
	                                <div class="contactT">	             
	                                 <?php echo JText::_(' Liên hệ');?>:    
	                                </div>
	                                <div>
	                           			<?php if (!empty($this->row->realtor_link['profile'])) {?>	
		                                <div class="contactT" style="float:left;width:30%">
		                                	<a href="<?php echo $this->row->realtor_link['profile'];?>">
			                                	<img src="<?php echo $this->row->realtor_avatar;?>" width="75" height="75"></img>
			                                </a>
		                                </div>
		                                <?php $width_percent = "68%";} else {$width_percent = "98%";}?>
		                                
		                                <div class="contactT" style="float:right;width:<?php echo $width_percent;?>;line-height:24px;">
			                                <?php 
			                               if( empty ( $this->row->name_vl ) 
			                                  && empty( $this->row->phone_vl ) 
			                                  && empty( $this->row->address_vl ) )
			                               {
			                                echo JText::_('Đang cập nhật');
			                              
			                               }
			                                else {
			                               ?>
			                                <div class="name">
			                                	<?php if ($this->row->has_realtor) {?>
			                                	<a href="<?php echo $this->row->realtor_link['profile'];?>">
			                               			<?php echo $this->escape( $this->row->name_vl ); ?>
			                               		</a>
			                               		<?php } else {
			                               			echo $this->escape( $this->row->name_vl );
			                               		}
			                               		?>
			                                </div>
			                                <div class="phone">
			                                 <?php echo $this->escape( $this->row->phone_vl ) ?>
			                                </div>
			                                <?php 
			                                if ( !empty($this->row->realtor_link) && is_array( $this->row->realtor_link ) ) { ?>
			                                <div class="profile">
			                                	<!--  <a href="<?php echo $this->row->realtor_link['profile'];?>">
			                                		<?php echo JText::_('View Profile');?>
			                                	</a>

			                                	&nbsp;|&nbsp;-->

			                                </div>
			                                <div class="listing">
                          	<a href="<?php echo $this->row->realtor_link['listing'];?>">

			                                		<?php echo JText::_('View Listing');?>
			                                	</a>
			                                </div>
		                                <?php } // if realtor link?>
		                                <?php } // end else?>
		                                </div>
	                                </div>
                                <div style="clear:both"></div>
                                
                                </div><!-- thong tin lien he-->
                            </div>
                    </div><!--bds2-->
       </div><!--div chua info-->
     </div>  <!-- phan chua noi dung-->
     
    <div class="infodetail">
     <div id="box8content_title">
										<div>
												<h3>
													<div id="a"><?php echo JText::_('Thông tin chi tiết');?>
													</div>
												</h3>
										</div>
		</div>
		<p class="space">
		         <?php echo $this->row->description ?>
		    </p>
		    
            <div class="Structure">
            <div id="box8content_title">
										<div>
												<h3>
													<div id="a"><?php echo JText::_('Cấu trúc');?>
													</div>
												</h3>
										</div>
		</div>
		
			    <div class="StructureC">
                <table width="100%" border="0" class="boderleft">
              
  <tr>
    <td  class="bg1">
	<?php 
	echo JText::_('Tổng diện tích sử dụng');?>: <strong> 
	<?php
// hoan dang lam	
	 if($this->row->living_width==0 || $this->row->living_length==0 )
	   {
		echo "_";
	   }
	   else 
	   {
		echo $this->row->living_length*$this->row->living_width."m<sup>2";
	   }
	?>
	
	</strong></strong>
    
    </td>
    <td  class="bg1"><?php echo JText::_('Loại địa ốc');?>: <strong><?php echo $this->escape( $this->row->type ) ?></strong></td>
    <td  class="bg1"><?php echo JText::_('Phòng ngủ');?>: <strong>
    <?php
     if($this->row->rooms==0)
    {
    	echo "_";
    }
    else
    {
    	 echo $this->row->rooms;  
    }
    
     ?></strong></td>
  </tr>
  <tr>
    <td class="bg2"><strong><?php echo JText::_('DTKV');?>:&nbsp;&nbsp; </strong> <?php echo JText::_('Chiều rộng');?>: <strong><?php	if($this->row->kv_length==0){echo "_&nbsp;";}else {echo $this->row->kv_length."m";}?></strong> &nbsp;<?php echo JText::_('Chiều dài');?>: <strong><?php if($this->row->kv_width==0){echo "_";}else {echo $this->row->kv_width."m";}?></strong></td>
    <td class="bg2"><?php echo JText::_('Pháp lý');?>: <strong>

 				<?php 					
			    $id=$this->row->id;		 
			    if($this->getlegal_statusList($id)=="")
			    {
			    	echo "_";
			    }
			    else
			    {
			    	echo $this->getlegal_statusList($id);
			    }				
			    		
			    ?>
    </strong></td>
    <td class="bg2"> <?php echo JText::_('Phòng tắm/WC');?>:  <strong> 
    <?php 
     if($this->row->toilets==0)
    {
    	echo "_";
    }
    else
    {
    	 echo $this->row->toilets ;
    }
    
    ?> </strong></td>
  </tr>
  <tr>
    <td  class="bg1"><strong><?php echo JText::_('DTXD');?>:&nbsp;&nbsp; </strong><?php echo JText::_('Chiều rộng');?>: <strong><?php	if($this->row->xd_length==0){echo "_ &nbsp";}else {echo $this->row->xd_length."m";}?></strong>&nbsp;<?php echo JText::_('Chiều dài');?>:<strong><?php	if($this->row->xd_width==0){echo "_";}else {echo $this->row->xd_width."m";} ?></strong></td>
    <td  class="bg1">Hướng: <strong><a href="#"><strong></strong></a><strong>
    <?php 
    if($this->row->direction =="")
    {
    	echo "_";
    }
    else 
    {
    	echo $this->row->direction;
    }
    ?>
    </strong></strong></td>
    <td  class="bg1"><?php echo JText::_('Phòng khác');?>: <strong><?php 
     if($this->row->highrooms==0)
    {
    	echo "_";
    }
    else
    {
    	  echo $this->row->highrooms  ;
    }

    ?>
    </strong></td>
  </tr>
</table>
                     
                </div>
            </div>
            
            
            <?php
            if($this->getAdvantageslist()!="")
            {
            ?>
             <div class="Structure">
            <div id="box8content_title">
										<div>
												<h3>
													<div id="a"><?php echo JText::_('Tiện ích');?>
													</div>
												</h3>
										</div>
		</div>
		
			 <div class="StructureC">
             <table width="100%" border="0" class="boderleft">
  <?php 
  echo $this->getAdvantageslist();
  ?>

			</table>
			</div>
			</div>

<?php 
            }
            
?>
       <div class="AddThis">
		       
       </div>
    </div>
       
</form>
<?php 

if($this->params->get('bdslqmo')==1)
		{
			
			Global $keyvnprice;
			if($this->GetShowBDSLQ($keyvnprice) != NULL)
			{
?>
  <div class="Structure">
            <div id="box8content_title">
            <div>
          
          			<div>
   								 <h3 > 
   								 <div  id="a" style="float:left; background: none;" >
   								  	<?php  echo JText::_('Bất động sản liên quan');?>										
								</div>
								<div class="right1" style="padding-top:6px;" >
								<?php $this->paging_bds($keyvnprice);	
								?>
								</div>
								</h3>
					</div>
			</div>
								</div>						
   						</div>
   						
	      <div id="loading" style="display:none;position:absolute;  padding-left:320px;"><img src="images/loading.gif"></div>
	    	<div id="tranga">
			<?php 
				echo $this->GetBDSLienQuan($keyvnprice);
				
			?>
			</div>
<?php 
			}
		}		
	
?>

 <div class="AddThis">
 
            <div id="box8content_title">
										<div>
												<h3>
													<div id="a"><?php echo JText::_('Chia sẻ');?>
													</div>
												</h3>
										</div>
			</div>
			
       
            <div class="AddThisL"></div>
            <div class="AddThisC">
                <div class="addC2">
                    <ul>
        

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
                    </ul>
                </div>
                
            </div>
         </div>
         </div>
      
<script type="text/javascript">
	Element.cleanWhitespace('content');
	init();
</script>
