<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
	<script type="text/javascript" src="<?php echo JURI::root()?>libraries/com_u_re/js/admin_utils.js"></script>
	<script type="text/javascript" src="<?php echo JURI::root()?>libraries/js/ajax.js"></script>


<!-- Hien thi ngon ngu de chon khi nhap du lieu -->
<?php
/*
if ( $this->status == 1 )
{
?>
	<a  style="cursor:pointer, a.active:red" onclick="getAdvantageValues('tien_ich[]', 'advantagesGetValue'), getDataLang('vi'), getCompoChangeLang('vi-VN', 1)" >
		<?php echo JText::_('TIENG_VIET') ; ?>
	</a>
	 &nbsp&nbsp | &nbsp&nbsp
	<a  onclick="getAdvantageValues('tien_ich[]', 'advantagesGetValue'), getDataLang('en'),getCompoChangeLang('en-GB', 1)"  >
		<?php echo JText::_('TIENG_ANH') ; ?>
	</a>

<?php
}
else if ( $this->status == 2 )
{
?>
		<a  style="cursor:pointer, a.active:red" onclick="getAdvantageValues('tien_ich[]', 'advantagesGetValue'), getDataLang('vi'), getCompoChangeLang('vi-VN', 2)" >
		<?php echo JText::_('TIENG_VIET') ; ?>
	</a>
	 &nbsp&nbsp | &nbsp&nbsp
	<a  onclick="getAdvantageValues('tien_ich[]', 'advantagesGetValue'), getDataLang('en'),getCompoChangeLang('en-GB', 2)"  >
		<?php echo JText::_('TIENG_ANH') ; ?>
	</a>
<?php
}
*/
?>
<!-- End  Hien thi ngon ngu de chon khi nhap du lieu -->

<?php

defined('_JEXEC') or die('Restricted access');

$editor =& JFactory::getEditor();
$user		= & JFactory::getUser();
$usertype	= $user->get('usertype');
JHTML::stylesheet('jea.css', 'media/com_jea/css/');

$document =& JFactory::getDocument();
$document->addScript('includes/js/joomla.javascript.js');


if( $this->status == 0 )
{
	if ( !is_array($this->propertyData) || empty($this->propertyData) )
	{
	    echo JText::_('THIS_PROPERTY_DO_NOT_EXISTS_ANYMORE');
	    return;
	}
}
?>

	
	
<?php
if ( $this->status == 2)
{
	echo "<div style='width: 700px'>";
?>
	<form action="index.php?option=com_jea&controller=properties&cat=needrenting&task=save" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data" />
<?php
}
else if ( $this->status == 1)
{
?>
	<form action="<?php echo JRoute::_('&task=save') ?>" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data" />
<?php
}
?>

	
	
	
	
<?php		
		
		// kiem tra phe duyet cua admin
		/*
			 $user->approved == "0" : dang tin khong can phe duyet, hien thi luon
		*/
		$op=0;
		if( isset($user->approved) && $user->approved == "0" )
		{
			$op=1;
		}
		
		//kiem tra login cua user
		/*
		neu user login se ton tai gid
		*/
		if (  !$user->usertype )
		{
			$usergid = '0';
		}
		else
		{
			$usergid =$user->gid;
		}
		
		// thong bao chua login 
		/*
		if ( $usergid == '0' && $this->status == 1)
		{
			echo  "<center><h3>".JText::_('USER_PHAI_DANG_NHAP')."</center</h3>";
		}
		*/
		
		
 if ( $this->status == 2 ) 
		{
			?>
			<div style="width:700px" >
				<center>
						<input type="button" onclick="submitForm_backend(<?php echo $op ?>,'3', '<?php echo $this->lang ?>')" name="save_review" class="button" value="<?php echo JText::_('LUU') ?>" />
					<span id ='ajCancael'>
						 <input type="button" onclick="submitbutton('cancel')" name="save_cancel" class="button" value="<?php echo JText::_('CANCEL') ?>" />
					</span>
				</center>
		    </div>
			<?php 
		echo "	<hr class='margin_hr_dangtin'>";
		}
		
?>
	
<!-- Cấu hình SEO + hiển thị ra ngoài -->	
<?php
 if ( $this->status == 2)
{
?>
		<div class="dangtinadminbds_no">
			 <span id='SEO_CONFIG'><?php echo JText::_('CAU_HINH_SEO') ; ?> </span>	
		</div>
		<div class="dangtinadminbds">
			 <span id='SEO_PAGE_TITLE'><?php echo JText::_('TIEU_DE_SEO') ; ?></span>
		</div>
		<div class="seo_bds_admin_textarea">
				<textarea id='page_title'  name='tieu_de_trang'  class="seo_bds_admin_tieude"><?php echo $this->propertyData['tieu_de_trang'] ?></textarea>				
		</div>
		<div class="dangtinadminbds">		
			<span id='SEO_PAGE_KEYWORDS'><?php 	echo JText::_('TU_KHOA_SEO') ; ?></span>
		</div>
		<div class="seo_bds_admin_textarea">
				<textarea id='page_keywords'  name='tu_khoa_trang'  class="seo_bds_admin_tieude"><?php echo $this->propertyData['tu_khoa_trang'] ?></textarea>			
		</div>	
		<div class="dangtinadminbds">			
			<span id='SEO_PAGE_DESCRIPTION'><?php 	echo JText::_('DIEN_GIAI_SEO') ; ?></span>
		</div>
		<div class="seo_bds_admin_textarea">
			<textarea id='page_description'  name='mo_ta_trang'  class="seo_bds_admin_diengiai"><?php echo $this->propertyData['mo_ta_trang'] ?></textarea>
		</div>
		
		
		
	<!-- end Cấu hình SEO + hiển thị ra ngoài -->
		<?php
		/* hien thi Published o dang tin admin */
		if ( $this->status == 2)
		{
		?>
			<div class='dangtinadminbds'>
			<span id='PUBLISHED'><?php echo JText::_('HIEN_THI_RA_NGOAI') ?> </span>
			</div>
			<div class='dangtinadminbds_ck'>
				<?php echo $this->published;?>
			</div>
			<div class='dangtinadminbds'>
			<span id='EMPHASIS'><?php echo JText::_('DANG_TIN_NOI_BAT') ; ?> </span>
		</div>
		<div class='dangtinadminbds_ck'>
			<input type='checkbox' value='1' id='emphasis' name='noi_bat' <?php echo $this->emphasisChecked ?> />
		</div>	
		<div class='dangtinadminbds'>
			<span id='NEWSEST'><?php	echo JText::_('DANG_TIN_MOI_NHAT') ; //tin moi nhat		?></span>
		</div>	
		<div class='dangtinadminbds_ck'>
			<input type='checkbox' value='1' id='newsest' name='moi_nhat' <?php echo  $this->newsestChecked ?> />
		</div>	
		<?php 
		}
		?>	
			
	
<br/>
	<?php 
			echo "<hr class='margin_hr_dangtin'>";
}
else 
{
?>
	<input type="hidden" id='SEO_CONFIG' name="SEO_CONFIG" value="" />
	<input type="hidden" id='SEO_PAGE_TITLE' name="tieu_de_trang" value="" />
	<input type="hidden" id='SEO_PAGE_KEYWORDS' name="tu_khoa_trang" value="" />
	<input type="hidden" id='SEO_PAGE_DESCRIPTION' name="mo_ta_trang" value="" />
<?php 
}
?>
	
	

<div class="properties"><!--div big-->
	<div class="info-detail"><!-- div chua title-->
        <div class="info-structure">
	        <?php
	        if ( $this->status == 0)
	        {
	        ?>
	        <h2 class='title_details'>
	        	<a>
	        		<?php echo $this->propertyData['tieu_de'] ?>
	        	</a>
	        </h2>
	        <?php 	
	        }
	        else
	        {
?>
				<table>
					<tr>
						<td style="width:70px">
						<span id='REF_SAVE'><?php echo JText::_('TIEU_DE').": "; ?></span>
						</td>
						<td>
							<input type='text'  size='70px' id='ref' name='tieu_de' value='<?php echo $this->propertyData['tieu_de'] ?>' class='inputbox_seo' />
						</td>
					</tr>
				</table>
<?php
	        }
?>
        </div>
	</div>
	
	 <div id="properties-detail_w"><!--div chua phan google map-->
			<div class="properties-detail-img-l">
					<span onMouseDown="changeStatusTabMap('tab_image', 'tab_map', 'tab_active', 'tab_inactive')"
									id="tab_image" class="tab_active" title="first">
						<div id="title_real">
								<center><span id='PICTURE'><?php  echo JText::_('HINH_ANH'); ?></span></center>
						</div>
					</span>
					<?php
					if( $this->googlemapDisplay == '1')
					{
						if( $this->googlemapEnable == '1')
						{
					?>
					<span onMouseDown="changeStatusTabMap('tab_map', 'tab_image', 'tab_active', 'tab_inactive')"
									id='tab_map' class='tab_inactive'>
						<?php
						}
						else
						{
						?>
							<span id="tab_map3" class="tab_inactive1" style="margin-left:1px;">
						<?php
						}
						?>
						<div id="title_real">
							<center><span id='MAP'><?php  echo JText::_('BAN_DO'); ?></span></center>
						</div>
						</span>
		
<?php
					}
?>
				<div class="boxholder">
					<div id='box_id' class="box"><!-- THONG_TIN_TONG_QUAN -->
							<!--div chua hinh anh-->
							<div><!-- hình ảnh lớn--->
							<?php 
							//if ( $this->status == 0 )
							//{
							?> 		
						  		
						  		 <?php
								// print_r($this->mainImage);
								 if ( !empty( $this->mainImage['isfile'] ) && is_file($this->mainImage['isfile']))
								 {
								 ?>
									 <img class='img_preview' id="img_preview" src="<?php echo $this->mainImage['preview_url'] ?>" 
								 alt="<?php echo $this->mainImage['title'] ?>" title="<?php echo JText::_('Enlarge')?>" />
								 <?php 
								 }
								 else 
								 {
								 ?>
								 	<img  class='img_preview' id="img_preview" src="<?php echo JURI::root()?>images/noimage.jpg"  alt="preview.jpg"  /> 
								 <?php 
								 }
								?>
								
							
						
															
						  </div><!-- hình ảnh lớn--->
						  						  
					   <div class="snd_imgs" ><!--hình ảnh thumbsnail-->
					             	<li>
					             	<?php
					             	// thumbsnaul cua anh chinh
									 if ( !empty( $this->mainImage['isfile'] ) && is_file($this->mainImage['isfile']) 
											&& !empty( $this->secondariesImages ) && is_array( $this->secondariesImages ) )
									 {
									 ?>
									 	<img src="<?php echo $this->mainImage['min_url'] ?>" 
									 	alt="<?php echo $this->mainImage['title'] ?>" title="<?php echo JText::_('Enlarge')?>" 
									 	onclick="swapImage('img_preview','<?php echo $this->mainImage['preview_url'] ?>')" />
									 	
									 		<?php // xoa hinh anh chinh
										 	if ( $this->status == 1 )
										 	{
										 	?>
										 	 <a href="<?php echo JURI::root() . 'index.php?option=com_u_re'
			            						.'&amp;controller=properties&amp;task=deleteimg&amp;id='. $this->propertyData['id']?>" ><?php echo JText::_('DELETE') ?></a>	
										 		
										 	<?php	
										 	}
										 	else if ( $this->status == 2 )
										 	{
										 	?>
										 	 <a href="<?php echo JURI::root() . 'administrator/index.php?option=com_jea'
			            						.'&amp;controller=properties&amp;task=deleteimg&amp;id='. $this->propertyData['id']
												.'&amp;Itemid=10' ?>" ><?php echo JText::_('DELETE') ?></a>
											 <?php 
										 	}
									}	
											 ?>
					             	</li>
					                <?php 
									if ( !empty( $this->secondariesImages ) && is_array( $this->secondariesImages ) )
									{
										foreach($this->secondariesImages as $image) : ?>
					                <li>
									  <img src="<?php echo $image['min_url'] ?>"  alt="<?php echo $image['name'] ?>"
									    title="<?php echo JText::_('title')?>" onclick="swapImage('img_preview','<?php echo $image['preview_url'] ?>')" />
									   
									  <?php // xoa hinh anh phu
										 	if ( $this->status == 1 )
										 	{
										 	?>									
									    <a href="<?php echo JURI::base() . 'index.php?option=com_u_re'
	          							 .'&amp;controller=properties&amp;task=deleteimg&amp;id='.$this->propertyData['id'].'&amp;image='.$image['name']?>" ><?php echo JText::_('DELETE') ?></a>	   
									    <?php 
										 	}
									    ?>
									    
									    <?php 
									    	if ( $this->status == 2 )
										 	{
										 	?>									
									    <a href="<?php echo JURI::base() . 'index.php?option=com_jea'
	          							 .'&amp;controller=properties&amp;task=deleteimg&amp;id='.$this->propertyData['id'].'&amp;image='.$image['name']?>" ><?php echo JText::_('DELETE') ?></a>	   
									    <?php 
										 	}
									    ?>
									    
					             	</li>
					                <?php endforeach; }?>
					         </div>       
					                
					          <div class="clear" > 	      
					                <?php // the input de dua hinh anh phu len
									if ( $this->status != 0 )
									{
									?>
									
								<div> <!--  ANH_CHINH -->
									<span id='aj_MAIN_PROPERTY_PICTURE'>
										<?php echo JText::_('ANH_CHINH') ?>
									</span>
							  			<input id='main_image'  class='dangtin_anhchinh'  type="file" name="main_image" value=""  size="25"/>
								</div><!--  ANH_CHINH -->
								
							</div> <!-- end hinh anh phu -->
																				
									 <input type="hidden" id="CountImage" name="CountImage" value='0' />
									<table id="tblUpload"">
									    <tbody>
									        <tr id="0">
									            <td valign="top" colspan="2">
													<span id='aj_SECONDARIES' class='dangtin_anhphu_label' >
														<?php echo JText::_('ANH_PHU') ?>
													</span>
													<!--  <span class="input_hinhanhphu_dangtin" > -->
									              	  <input class='dangtin_anhphu' name="secondaries_images0" type="file" id="secondaries_images0" size="25" onchange="javascript:UploadImg(this)" />
									             	<!--    </span> -->
												</td>
											</tr>
										</tbody>
									</table>
								<span id='aj_images_reset'>
						  			<input type="button" value="<?php echo JText::_('DANG_HINH_LAI_TU_DAU')?>" onclick='resetImage(20)'>
						  		</span>
									
									<?php 
									}
									?>
			             </div>
					           <div class="clear">
					           </div> 
					</div>
				
				<!-- box hien thi Map -->
		<div class="box" >
			 <?php if ( $this->googlemapDisplay )
			{
				if ( $this->status != 0)
				{
				?>
					<span id='ajUPDATE_MAP'>
					<input type="button" onclick="onChangeAddress()" value="<?php echo JText::_('CAP_NHAT_BAN_DO');?>" />
					</span>
				<?php
				}
				?>
				<div id="map_canvas">
					<div id="map"></div>
				</div>
		
			<?php
			}
			?>
		</div>
                <!-- </div> -->
			</div><!--boxholder-->
			</div><!-- div content-->
			</div>
			<div class='properties-detail-img-r'>
			<div> <!--  noi dung -->
			<?php
	if( $this->status != 0 )
	{
	?>
		<!--  loại tin rao -->
		<div class='layout-admin'>
		<li class='msts admin'>
			<span id='aj_LOAI_HINH_GIAO_DICH'>
				<?php  echo JText::_('LOAI_HINH_GIAO_DICH'); ?>
			</span>
		</li>
		<li id ='aj_kinds'><?php echo $this->kinds; ?> </li>
		</div>
	<!--  // loai bds -->
	<div class='layout-admin'>
		<li class='msts admin'>
			<span id='aj_LOAI_BDS'>
				<?php  echo JText::_('LOAI_BDS'); ?>
			</span>
		</li>
		
		<li id ='aj_types'><?php echo $this->types; ?> </li>
	</div>
	
		<!--  // loai DU_AN -->
	<div class='layout-admin'>
		<li class='msts admin'>
			<span id='aj_DU_AN'>
				<?php  echo JText::_('TEN_DU_AN'); ?>
			</span>
		</li>
		
		<li id ='aj_DU_AN'><?php echo $this->du_an; ?> </li>
	</div>
	<?php
	}
?>
     
<?php
		if ($this->status == 0)
		{
			// hien thi thong tin tong quan
			echo $this->propertyData['thong_tin_tong_quan'];
		}
		else
		{
				?>
				<div class='clear'><span id='ADDRESS' class='items-add1'><?php echo JText::_('DIA_CHI');?></span></div>
			<!-- TINH_THANH -->
			<div class='layout-admin'>
				<li class='msts admin'>
				<span id='ja_TINH_THANH'>	<?php echo JText::_('TINH_THANH');?></span>
				</li>
				<li>
					<span id='ja_town'>	<?php echo $this->towns;// thanh pho ?> </span>
				</li>	
			</div>	
			<!-- TINH_THANH -->		
			<!-- QUAN_HUYEN -->
			<div class='layout-admin'>	
				<li class='msts admin'>
				<span id='ja_QUAN_HUYEN'>	<?php echo JText::_('QUAN_HUYEN');?></span>
				</li>
				<li>
				<div id="innerTown" >
							<div id="quanhuyen">
						<?php echo $this->areas; ?>
							</div>
				</div>
				</li>	
			</div>
			<!-- QUAN_HUYEN -->	
			
			
			
			
			
			
			
			
			
			
			<div class='layout-admin'>
				<li class='msts admin' id='STREET'>
				<?php  echo JText::_('STREET')?>
				</li>
				<li>
				<input type="text" id="address" name="dia_chi" value="<?php  echo $this->propertyData['dia_chi'] ?>" class="inputbox_address" size="20" />
				</li>
			</div>	
			<!-- QUAN_HUYEN -->     
			<!-- GIA -->
			<div class='layout-admin'>
				<li class='msts admin' id='PRICE'>
				<?php  echo JText::_('PRICE'); ?>:
				</li>
				<li>
					<input  id="price" type="text" name="gia" value="<?php echo $this->propertyData['gia'] ?>" class="numberbox new2" size="5"  />
			 	
				<span id='aj_priceunit'> <?php echo  $this->PriceUnit; ?> </span>
				/
				<span id='aj_unit'> <?php echo $this->Unit;?></span>
				</li>
			</div>
			<!-- GIA -->       	      		
				<?php
		}
 ?>
  	    
     
		</div><!--  ket thuc noi dung -->
		<!-- MA_SO_TAI_SAN -->
			<div class='layout-admin'>
				
					<?php
					if ( $this->status == 0)
					{
						echo  "<div>";
						echo"<li class=' msts admin'>";
						echo JText::_('MA_SO_TAI_SAN').":";
						echo "</li>";
						echo "<li class='msts-n'>";
						echo $this->propertyData['ma_so'];
						echo "</li>";
						echo "</div>";
					}
					else
					{
						echo "<li id='PROPERTIES_UNIT' class='msts admin'>".JText::_('MA_SO_TAI_SAN').":"."</li>";
						echo "<input type='text' id='properties_key'  name='properties_key' value='". $this->properties_key ."' class='inputbox_id'/>";
					}
					?>
					</div>

		 <!-- MA_SO_TAI_SAN -->
<?php
if ( $this->status == 0 )
{
?>
		<div class='layout-admin'> <!-- LOAI_HINH_GIAO_DICH -->

					<li class="msts admin ">
			        <?php  echo JText::_('LOAI_HINH_GIAO_DICH')?>
			        </li>
			        <li class='bold'>
			        	<?php echo $this->propertyData['loai_giao_dich']?>
			        </li>
		</div> <!-- LOAI_HINH_GIAO_DICH -->
		<div class='layout-admin'> <!-- LOAI_HINH_GIAO_DICH -->

					<li class="msts admin ">
			        <?php  echo JText::_('LOAI_DU_AN')?>
			        </li>
			        <li class='bold'>
			        	<?php echo $this->propertyData['du_an']?>
			        </li>
		</div> <!-- LOAI_HINH_GIAO_DICH -->

<?php
}
?>
		<!-- PHAP_LY-->
		<div class='layout-admin' id="usearea" > 
					<li id='ajt_legal' class="msts admin"><?php echo JText::_('PHAP_LY');?>
					</li>
					<li class='bold'>
					<span >
								    <?php
									if( $this->status == 0 )
									{
								    		echo $this->propertyData['phap_ly'];
									}
									else
									{
									?>
									<span id='aj_legal'><?php echo $this->legalStatusList; ?></span>
									<?php
									}
								    ?>
					</li>
		</div>
		<!-- PHAP_LY-->
		<div id='usearea' class='layout-admin'> <!-- DIEN_TICH_KHUON_VIEN -->
						<li id='aj_SITE_AREA' class='msts admin'>                             			
						<?php  echo JText::_('D_T_K_V');?>
                       </li>
                       <li class='bold'>
                                   <?php
                                   if ( $this->status == 0 )
                                   {
                                   echo $this->areaInfoString;
                                   }
                                   else
                                   {
                                   ?>
                       </li>
					   
                      				 <span id='aj_C_D'>
									  		 <?php echo JText::_('CHIEU_RONG_R');?>
									   </span>
									   
									   <input id="kv_width" type="text" name="dien_tich_khuon_vien_rong" 
								   			 value="<?php echo $this->propertyData['dien_tich_khuon_vien_rong'] ?>" 
								   			 class="numberbox area" size="2" 
								   			 onChange="getonchangevalue(this.value,'divkv_width','m',1)" />m
									   X                       
										  <span id='aj_C_R'>
											<?php echo JText::_('CHIEU_DAI_D');?>
										</span>
										<input id="kv_length" type="text" name="dien_tich_khuon_vien_dai" 
											   value="<?php echo $this->propertyData['dien_tich_khuon_vien_dai'] ?>" 
											   class="numberbox area" size="2" 
											   onChange="getonchangevalue(this.value,'divkv_length','m',1)"/>m
									
									
							
							
							
                                   	<?php
                                   }
                                    ?>
                                    
                               
                        
                        
              </div>
              <!-- DIEN_TICH_KHUON_VIEN --> 
			  <!-- DIEN_TICH_SU_DUNG -->			
					<div id='usearea' class='layout-admin'> 
						<li id='USE_AREA' class='msts admin' ><?php echo JText::_('DIEN_TICH_SU_DUNG').':';?></li>
						<li class='bold'>
								  <?php
								  if( $this->status == 0 )
								  {
//							      		echo $this->usedAreaInfoString;
										if ( !empty($this->propertyData['dien_tich_su_dung']) )
										{
							      			echo $this->propertyData['dien_tich_su_dung'] . 'm<sup>2</sup>';
											
										}
										else
										{
											echo '_';	
										}
								  }
								  else
								  {
								  
								  	?>

								  	<input id="living_space" type="text" name="dien_tich_su_dung" value="<?php echo $this->propertyData['dien_tich_su_dung'] ?>" class="numberbox livinguse" size="7" onChange="getonchangevalue(this.value,'divliving_space','m<sup>2',1)"/>m<sup>2</sup>

								  	<?php
								  }
								 ?>

						</li>
					</div>
					<!-- DIEN_TICH_SU_DUNG --> 
					<div class='layout-admin'> <!-- GIA -->
						<?php
                                   		if($this->status == 0)
                                   		{
											echo $this->tienHTML;
                                   		}
                                   		
                                   		?>
					</div><!--  GIA -->
					<div class='layout-admin room'> <!--  PHONG -->
						<li class="phong admin">
		                                <?php
		                                if( $this->status == 0 )
                                        {
		                                	echo JText::_('PHONG');
                                        }
		                                ?>
	                     </li>
						<?php
						if( $this->status == 0 )
						{
						?>
						 <div class='layout-admin room'>      <!--  THONG_TIN_CAC_PHONG-->
                                 <li title="Phòng Khách" class="msts font_end">
                                        <?php
										
                                       		echo JText::_('KHACH') ;
                                          
                                        ?>
                                 </li>
                               
                                  <li class="bold admin1">&nbsp;
                                        <?php
                                           echo $this->propertyData['phong_khach'] ;
                                        ?>
                                 </li>
                                       
                                        <?php
                                         if( $this->status == 0 )
                                        {
                                        ?>
                                 <li title="Phòng Ngủ" class="msts font_end">
	                                     <?php 
	                                     // bedroom
                                        	echo JText::_('NGU');
	                                     ?>
	                             </li>
	                            
	                             <li class="bold admin1"> &nbsp;
	                                     <?php
	                                    echo  $this->propertyData['phong_ngu'] ;
	                                     ?>   
	                             </li>
	                                    <?php
                                        }
                                        ?>
                                        
                                        
                                        <?php
                                        if( $this->status == 0 )
                                        {
                                        echo "<li title='Phòng Tắm / WC' class='msts font_end'>";
                                        	// bathroom
	                                        echo JText::_('TAM');
	                                    echo "</li>";
	                                    echo "<li class='bold admin1'>";
										echo "&nbsp;";
	                                    echo $this->propertyData['phong_tam']  ;
	                                    echo"</li>";
                                        }
                                        ?>
                                    
                                        <?php
                                        if( $this->status == 0 )
                                        {
                                        	echo "<li title='Phòng Khác' class='msts font_end'>";
                                        	// cac phong khac
                                        	echo JText::_('KHAC') ;
                                        	echo "</li>";
                                        	echo "<li class='bold admin1'>";
											echo "&nbsp;";
                                        	 echo  $this->propertyData['phong_khac'] ;
                                       		echo "</li>";
                                        }
                                        ?>
			       				 </div><!-- thong tin-->

<?php
						}
                                        else
                                        {
		                                     
                                        	 echo "<div id='showRooms'></div>";
                                        	 
                                        	 ?>
                                        	 <!--  doan code phong tam thoi  -->
 <div class='layout-admin' nowrap=\"nowrap\" class=\"label\">
 <label for=\"mainrooms\"><li class='admin1' id='ajCLIEN_ROOM'><?php echo JText::_('PHONG_KHACH') ?></li></label>
   <li class='admin1'><select class='newroom' name ='phong_khach' onchange=getonchangevalue(this.value,'divmainrooms','',1)>
   <?php   
   for($i=0;$i<=9;$i++)   	
   {   $selected="" ; 
	   if($this->propertyData['phong_khach'] == $i)
	   {
	   	$selected="selected"; 
	   }  
	   echo "<option  $selected value=$i>$i</option>";
   }?>	
   </select>
   </li>
   <label for=\"rooms\"><li class='admin1' id='ajBEDROOM'><?php echo JText::_('PHONG_NGU') ?></li></label>
    <li class='admin1'><select class='newroom' name ='phong_ngu' onchange=getonchangevalue(this.value,'divroom','',1) >
    <?php  
    for($i=0;$i<=9;$i++)   
    	{ 
    		$selected="" ; 
    		if($this->propertyData['phong_ngu'] == $i)
    		{	
    			$selected="selected"; 
    		}   
    		echo "<option $selected value=$i>$i</option>"; 
    	 } 	
    	?>	
    	</select>
    </li>
	  <label for=\"rooms\"><li class='admin1' id='ajBATHROOM'><?php echo JText::_('PHONG_TAM') ?></li></label>
	<li class='admin1'><select class='newroom' name ='phong_tam' onchange=getonchangevalue(this.value,'divtoilets','',1) >
	<?php 
	for($i=0;$i<=9;$i++) 
		{ 
			$selected="" ;
			 if($this->propertyData['phong_tam'] == $i)
			 {	
			 	$selected="selected";
			  } 
			    echo "<option $selected value=$i>$i</option>"; 
		 } 
		 	?>
		 	</select>
		 </li>
  <label for=\"toilets\"><li class='admin1' id='ajORTHER_ROOM'><?php echo JText::_('PHONG_KHAC') ?></li></label>
  <li class='admin1'> <select class='newroom' name ='phong_khac' onchange=getonchangevalue(this.value,'divhighrooms','',1) >
   <?php  
   for($i=0;$i<=9;$i++)  
   	{  $selected="" ;
   	 if($this->propertyData['phong_khac'] == $i)
   	 {	$selected="selected"; 
   	 } 
   	   echo "<option $selected value=$i>$i</option>"; 
   	 } 	?>	
   	 </select>  
   	 </li>
   	 	</div>
   	 	<!--  THONG_TIN_CAC_PHONG -->
                                        	 <?php 
                                        } // end else
?>

               
                       
                                
                                                
                          
                                
                          
		
            
                               
                  
		<div class='layout-admin'> 
					<li class="msts admin ">
						<span id='ajCONTACT'>
			    		    <?php  echo JText::_('LIEN_HE')?>
			    		</span>
			        </li>

			        <li class='bold'>
			        <?php //TODO chua lam, chua lay du lieu?>
			        <?php if( $this->status == 0 ){ ?>
			        	<div class="contact_box"><!-- thong tin lien hê-->
		                                <div>	                           					                                
			                                <div style="float: right; width: 98%; line-height: 24px;" class="contactT">
			                                
											<?php 
											if ( empty( $this->propertyData['ten_nguoi_lien_he'] ) && 
													 empty( $this->propertyData['dien_thoai_nguoi_lien_he'] ) && 
													 empty( $this->propertyData['dia_chi_nguoi_lien_he'] ) )
												{
													echo JText::_('UPDATING');
												}
											?>
			                                
				                                <div>
				                                <span id='CONTACT_ADDRESS'  class='contact_class_label' ><?php echo JText::_('DIA_CHI');?></span>
												<span class="name">
												<?php echo $this->propertyData['ten_nguoi_lien_he'] ?>                         
												</span>
												
				                                </div>
				                                <div>
												<span id='CONTACT_PHONE'  class='contact_class_label' >
												<?php echo JText::_('DIEN_THOAI');?>:
												</span>
												<span class='phone'>
												<?php echo $this->propertyData['dien_thoai_nguoi_lien_he'] ?> 
												</span>
				                                 </div>
				                                  <div>
												<span id='CONTACT_EMAIL'  class='contact_class_label' >
												<?php echo JText::_('EMAIL');?>:
												</span>
												<span class="email">
												<?php echo $this->propertyData['email_nguoi_lien_he'] ?> 			                                
												</span>
				                                	 
				                                 </div>
				                                  <div class="note">
				                                	 <?php echo $this->propertyData['ghi_chu_nguoi_lien_he'] ?> 			                                
				                                 </div>
				                            </div>
		                                </div>
                             
                                
  						  </div>   
  					<?php 
			        }
			        else 
			        {  					
  					?>
						<div class="contact_box"><!-- thong tin lien hê-->
		                                <div class="contactT">	             
		                                  
		                                </div>
		                                <div>	                           					                                
			                                <div style="float: right; width: 98%; line-height: 24px;" class="contactT">
												  <span id='CONTACT_FULLNAME' class='contact_class_label_no'><?php echo JText::_('HO_TEN');?>:</span>
													<div class="class_lienhe_dangtin">
														<input type="text" id="name_vl"  name="name_vl" class="class_lienhe_dangtin" value="<?php echo $this->propertyData['ten_nguoi_lien_he']; ?>" />                               
													</div>
													<span id='CONTACT_ADDRESS'  class='contact_class_label' ><?php echo JText::_('DIA_CHI');?></span>
													<div class='name' >	
														<input type="text" id="address_vl"  name="address_vl" class="class_lienhe_dangtin" value="<?php echo $this->propertyData['dia_chi_nguoi_lien_he'] ?>"/>
													</div>
														<span id='CONTACT_PHONE'  class='contact_class_label' ><?php echo JText::_('DIEN_THOAI');?>:</span>
												<div class='name' >		
													<input type="text" name="phone_vl" class="class_lienhe_dangtin" value="<?php echo $this->propertyData['dien_thoai_nguoi_lien_he']; ?>"/>
												</div>
													
												<span id='CONTACT_NOTE'  class='contact_class_label'><?php echo JText::_('GHI_CHU');?>:</span>
												<div class='name' >			
													<textarea  id="ghichu" name="ghichu" rows="2" cols="5" class="class_lienhe_dangtin"><?php echo $this->propertyData['ghi_chu_nguoi_lien_he'];  ?></textarea>
												</div>	

				                            </div>
		                                </div>
                                <div style="clear: both;"></div>
                                
  						  </div>   
  						
					
  					<?php 
			        }
  					?>	  
  						  
			        </li>
		</div> 
		             
          
</div> 
   </div>
          
       			<div class='clear'>
			</div>           
  
	<!--  thong tin co ban -->
	<div class='properties-detail'>
	<!--  TIEU DE -->	<!--  <div id='info-detail-title'> 
		<span> <?php  //echo JText::_('THONG_TIN_CO_BAN'); ?>
    	</span>
		</div> --><!--  KET THUC TIEU DE -->
		<!-- MO TA -->
<div class="info-structure">
				<div class='info-structure-title'>
					<h4>
						<span id='aj_MO_TA'>
							<?php echo JText::_('MO_TA'); ?> 
						</span>
					</h4>
				</div>


<div class="space">
		         <?php
		         if( $this->status == 0)
		         {
		         	//echo $this->propertyData->description;
		         	echo $this->propertyData['mo_ta_chi_tiet'];
		         }
		         else
		         {
				 //hoan dang lam
		         	 // parameters : areaname, content, width, height, cols, rows, show buttons
					echo $this->editor->display('mo_ta_chi_tiet', $this->propertyData['mo_ta_chi_tiet'] , '100%', '300', '75', '20', false ) ;				
		         }
		         ?>
		  	
</div>
</div>
<!-- MO TA -->
					<!-- CAU_TRUC -->
<div class="info-structure">
            <div class="info-structure-title">
				<h4>
					<span id='aj_CAU_TRUC'>
						<?php echo JText::_('CAU_TRUC');?>
					</span>
				</h4>
							
			</div>
			
			<div class="StructureC">
			<div class="boderleft">
  			
			    <div  class="bg1 cautruc1">
				<li id='ajsTOTAL_AREA_USED'>
				<?php
				// TONG DIEN TICH SU DUNG PHAN HIEN THI O DUOI
				echo JText::_('TONG_DIEN_TICH_SU_DUNG');?>
				</li>
				
				<?php
					if ($this->propertyData['dien_tich_su_dung'] != 0 )
					{
						echo "<li class='bold' id='divliving_space'>".$this->propertyData['dien_tich_su_dung']."m<sup>2</sup></li>";
					}
					else
					{
						echo "<li class='bold' id='divliving_space'>_</li>";
					}
				?>
				
			    </div>
    <div  class="bg1 cautruc1">
	    <li id='ajPROPERTIES_TYPE'><?php echo JText::_('LOAI_BDS');?></li>
	    <li class='bold'>
	    <?php
	    if ( $this->status == 0)
	    {
			//echo  $this->propertyData->type ;
			echo $this->propertyData['loai_bds'];
	    }
		else
	    {
	    if ($this->propertyData['loai_bds'] != NULL )
			{
				echo "<li id='divtype'>".$this->propertyData['loai_bds']."</li>";
			}
			else
			{
				echo "<li id='divtype'>_</li>";
			}
	    }
	    ?>
	    </li>
    </div>
	<!--phòng khách-->
	    <div  class="bg2 cautruc1">
    <li id='ajsBEDROOM'><?php echo JText::_('PHONG_KHACH');?></li>
    <li class='bold'>
    <?php
	if ( $this->status == 0)
	{
		echo $this->propertyData['phong_khach'];
	}
	else
	{
		if ($this->propertyData['phong_khach'] != 0 )
		{
			echo "<li id='divroom'>".$this->propertyData['phong_khach']."</li>";
		}
		else
		{
			 echo "<li id='divroom'>_</li>";
		}

	}
    
     ?></li>
     </div>
	<!--phong khách-->
	
   
    <div class="bg2 cautruc1">
		<li>
		<span id='ajDTKV'><?php echo JText::_('D_T_K_V'); ?></span>
			&nbsp;&nbsp;
		</li>
		
		<li class='bold'>
		<?php
		/*
			if ( $this->status == 0)
			{
				echo $this->propertyData['dien_tich_khuon_vien_dai']."m x ".$this->propertyData['dien_tich_khuon_vien_rong']."m";
			}
			else
			{
			*/
				if ($this->propertyData['dien_tich_khuon_vien_dai'] != 0 )
				{
					echo "<span id='divkv_width'>".$this->propertyData['dien_tich_khuon_vien_dai']."m</span>";
				}
				else
				{
					echo "<span id='divkv_width'>_</span>";
				}
				echo "<span> x </span>";
				
			if ($this->propertyData['dien_tich_khuon_vien_rong'] != 0 )
			{
				echo "<span id='divkv_length'>".$this->propertyData['dien_tich_khuon_vien_rong']."m</span>";
			}
			else
			{
				echo "<span id='divkv_length'>_</span>";
			}
		//	}
		?>
		</li>
		
</div>
<div class="bg2 cautruc1"><li id='ajt2_legal'><?php echo JText::_('PHAP_LY');?></li> 
    <li class='bold'>

 				<?php
 				if( $this->status == 0)
 				{
 					if ( $this->propertyData['phap_ly'] != '' )
				    {
				    	echo $this->propertyData['phap_ly'];
 					}
 					else 
 					{
 						echo '_';
 					}
 				}
 				else
 				{
	 				if ($this->propertyData['phap_ly'] != NULL )
					{
						echo "<li id='divlegalstatus'>".$this->propertyData['phap_ly']."</li>";
					}
					else
					{
						echo "<li id='divlegalstatus'>_</li>";
					}
 				}
 					
			    ?>
    </li></div>
 <div  class="bg1 cautruc1">
    <li id='ajsBEDROOM'><?php echo JText::_('PHONG_NGU');?></li>
    <li class='bold'>
    <?php
	if ( $this->status == 0)
	{
		echo $this->propertyData['phong_ngu'];
	}
	else
	{
		if ($this->propertyData['phong_ngu'] != 0 )
		{
			echo "<li id='divroom'>".$this->propertyData['phong_ngu']."</li>";
		}
		else
		{
			 echo "<li id='divroom'>_</li>";
		}

	}
    
     ?></li>
     </div>
    











    <div class="bg1 cautruc1">
   				 <li id='ajDTXD'><?php    echo JText::_('DTXD');?>&nbsp;&nbsp;</li>
    					
    
    <?php
	if ( $this->status == 0 )
	{
		echo "<li class='bold'>";
	 	if ($this->propertyData['dien_tich_xay_dung_dai'] != 0 )
			{
				echo $this->propertyData['dien_tich_xay_dung_dai']."m";
			}
			else
			{
				echo "_";
			}
			
		echo " x ";
		
		if ($this->propertyData['dien_tich_xay_dung_rong'] != 0 )
			{
				echo $this->propertyData['dien_tich_xay_dung_rong']."m";
			}
			else
			{
				echo "_";
			}
			
		echo "</li>";
			
	}
	else
	{
		 echo JText::_('CHIEU_DAI_D') ;
		$livinglength = $this->propertyData['dien_tich_xay_dung_dai'];
		echo "<input  id=\"living_length\" type=\"text\" name=\"dien_tich_xay_dung_dai\" value=\"$livinglength\" class=\"numberbox area\" size=\"2\" />";

		echo  JText::_('CHIEU_RONG_R');
		$livingwidth = $this->propertyData['dien_tich_xay_dung_rong'];
		echo "<input  id=\"livingwidth\" type=\"text\" name=\"dien_tich_xay_dung_rong\" value=\"$livingwidth\" class=\"numberbox area\" size=\"2\" />";
	

	
	}
    ?>
    </li>


    
      </div>
      
      

<div class="bg1 cautruc1">
    <li id='ajtDIRECTION'><?php echo JText::_('HUONG');?>
    </li> 
    <li class='bold'>
    <?php
    if ( $this->status == 0)
    {
    	// huong
	    echo $this->propertyData['huong'];
    }
    else
    {
	?>
	<?php // echo $this->directions; ?>
    	<li id='aj_directions'> <?php echo $this->directions; ?> </li>
    <?php
	}
    ?>
    </li></div>
   


      
      
      
      
    
	 <div class="bg2 cautruc1"><li id='ajsBATHROOM'><?php echo JText::_('PHONG_TAM');?></li> 
     <li class='bold'>
    <?php
	if ( $this->status == 0)
	{
		
		// bathroom
		echo $this->propertyData['phong_tam'];
			
	}
	else
	{
		if ($this->propertyData['phong_tam'] != 0 )
		{
			echo "<li id='divtoilets'>".$this->propertyData['phong_tam']."</li>";
		}
		else
		{
			echo "<li id='divtoilets'>_</li>";
		}
	}
    ?> </li>
    </div>
	<div class="bg1 cautruc1 clear">
	&nbsp;&nbsp;
	</div>
	
	<div class="bg1 cautruc1">
	&nbsp;&nbsp;
	</div>
    <div  class="bg1 cautruc1">
    <li id='ajsORTHER_ROOM'><?php echo JText::_('PHONG_KHAC');?></li>
    <li class='bold'><?php
	if ( $this->status == 0 )
	{
		// cac phong khac
		echo $this->propertyData['phong_khac'];
	}
	else
	{
		if ($this->propertyData['phong_khac'] != 0 )
		{
			echo "<li id='divhighrooms'>".$this->propertyData['phong_khac']."</li>";
		}
		else
		{
			echo "<li id='divhighrooms'>_</li>";
		}
	}
    ?>
    </li>
    </div>
	</div>
	</div>
	
	<div class='clear'></div>
      </div>    
					<!-- CAU_TRUC -->
					<!-- TIEN_ICH -->
					<?php
            if ( $this->status == 0 )
            {
	            if( !empty( $this->tienIchHTML ) )
	            {
		            ?>
				        <div class="info-structure">
				            <div class="info-structure-title">
									
											<h4>
											<?php echo JText::_('TIEN_ICH');?>
											</h4>
							</div>
							
							
						 <div class="StructureC222">
<!--			             <div  border="0" class="boderleft">-->
							  <?php
							  echo $this->tienIchHTML;
							  ?>
			
					<!-- </div>-->
						</div>
						<div class='clear:both'>
						</div>
						
					
					<?php
           		}
            }
            else
            {
			?>
            <div class="info-structure">
				<div class='info-structure-title'>
					
							<h4><span id="aj_ADVANTAGES"><?php echo JText::_('TIEN_ICH'); ?> </span></h4>				
				</div>
				
			<div>
			<span id="ajbackend_ADVANTAGES"> <?php echo $this->tienIchHTML; ?></span>
			</div>
			</div>
			<?php
            }
            
?>
    </div>
					<!-- TIEN ICH -->
		

			
	</div>
	
       </div><!--div chua info-->
       
       <!--  CHIA_SE-->
       <?php if ( $this->status == 0 )
       {
       ?>       
       <div class="info-structure">   <!-- CHIA_SE -->			 
			            <div class="info-structure-title">
							<h4><?php echo JText::_('CHIA_SE');?></h4>
						</div>		          
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
	</div> <!-- CHIA_SE -->           
        <?php } // end if chia se?>   
<!--           CHIA_SE -->
       <?php
if( $this->status == 0) // if bat dong san lien quan
{
	if( !empty( $this->samePropertiesHTML ) && trim( $this->samePropertiesHTML ) != '' )
	// if( !empty( $this->samePropertiesHTML ) && trim( $this->samePropertiesHTML ) != '' )
	{
	?>
	  <div class="info-structure1"><!--BAT_DONG_SAN_LIEN_QUAN -->
            <div class="info-structure-title">
   					  	<h4><?php  echo JText::_('BAT_DONG_SAN_LIEN_QUAN');?></h4>
					
			 </div>
		      <div id="loading" style="display:none;position:absolute;  padding-left:320px;">
		      <img src="images/loading.gif">
		      </div>
		    <div class="tranga">
		    		<?php
						echo $this->samePropertiesAjaxPagingHTML;
					?>
				<?php
					echo $this->samePropertiesHTML;
				?>
				</div>
		</div> <!-- BATT_DONG_SAN_LIEN_QUAN -->
	<?php
	}
	?>
	
	
	<div class='clear'>
	</div>
   <?php
	} // end if bat dong san lien quan
	
   ?>
      
<?php 
	if( $this->status == 1 )
	{
	//	print_r($user);
	     //echo "<hr>";
		//global $mainframe;
		//set the argument below to true if you need to show vertically( 3 cells one below the other)
		//$mainframe->triggerEvent('onShowOSOLCaptcha', array(false));
		
		
		
		?>
			<div style="width:700px" >
		     <center>
			<span id ='ajSAVE_REVIEW'>
		 	 <input type="button" onclick="submitForm('<?php echo $usertype ?>','<?php echo $op ?>',<?php echo $op ?>,'1','<?php echo $this->lang ?>')" name="save_review" class="button" value="<?php echo JText::_('LUU_VA_XEM_LAI') ?>" />
			</span>
			<span id ='ajSAVE_PUBLISHED'>
		     <input type="button" onclick="submitForm('<?php echo $usertype ?>','<?php echo $op ?>',<?php echo $op ?>,'2', '<?php echo $this->lang ?>')" name="save_published" class="button" value="<?php echo JText::_('LUU_TIN') ?>" />
			</span>
			<span id ='ajSAVE_DRAFT'>
		     <input type="button" onclick="submitForm('<?php echo  $usertype ?>','<?php echo $op ?>','0','2', '<?php echo $this->lang ?>')" name="save_draft" class="button" value="<?php echo JText::_('LUU_NHAP') ?>" />
			</span>
		     <input type="hidden" id="frmre_link" name="re_link"/>
		     <input type="hidden" id="frmpublished" name="hien_thi_ra_ngoai"/>
		     <input type="hidden" id="getKnowId" name="getKnowId"/>
		      </center>
		      </div>

		
	<?php	
	}
	else 
	 if ( $this->status == 2 ) 
		{
			?>
			<div style="width:700px" >
		     <center>

 <input type="button" onclick="submitForm_backend(<?php echo $op ?>,'3','<?php echo $this->lang ?>')" name="save_review" class="button" value="<?php echo JText::_('LUU') ?>" />
				<span id ='ajCancael'>
			     <input type="button" onclick="submitbutton('cancel')" name="save_cancel" class="button" value="<?php echo JText::_('CANCEL') ?>" />
				</span>
				<input type="hidden" id="frmre_link" name="re_link"/>
		     <input type="hidden" id="frmpublished" name="published"/>
		     <input type="hidden" id="getKnowId" name="getKnowId"/>
			      </center>
		      </div>
			<?php 
		}
?>

<!--  begin google map -->

<!-- map position -->
  <input id="map_lat" type="hidden" name="map_lat" value="<?php echo $this->propertyData['kinh_do'];?>" />
  <input id="map_lng" type="hidden" name="map_lng" value="<?php echo $this->propertyData['vi_do'];?>" />
 <input id="pro_total_info" type="hidden" name="pro_total_info" value="3" />

  
  <style type="text/css">
            #map{width:447px;margin-top:5px;margin-left:5px;border:1px solid dashed;
                 height:330px;}
</style>




<script language="javascript" type="text/javascript" src="libraries/js/mailBDS.js"></script>
<?php
if ( $this->googlemapDisplay )
{
	?>
	<style type="text/css">
		#map_canvas
		{
		width:447px;
		margin-top:2px;
		margin-left:2px;
		border:1px solid dashed;
		height:330px;
		}
	</style>
		
<?php
}
?>
  
<script type="text/javascript">
	//Element.cleanWhitespace('content');
</script>

<script type="text/javascript">
/* lay phong khach,phong ngu, phong tam... */
// TODO: them filter de hien thi gia tri phong cho loai bat dong san can ho, nha pho.
/*function jea_types_filter(idType)
{
	var innerHtml="<table><tr>";
	var i=0;
    innerHtml+="<td nowrap=\"nowrap\" class=\"label\"><label for=\"mainrooms\"><span id='ajCLIEN_ROOM'><?php echo JText::_('PHONG_KHACH') ?></span>:</label>";
    innerHtml+="<select class='newroom' name ='mainrooms' onchange=getonchangvalue(this.value,'divmainrooms',\'\',1)> <?php   for($i=0;$i<=9;$i++)   	{   $selected="" ; if($this->propertyData->mainrooms == $i){	$selected="selected"; }  echo "<option  $selected value=$i>$i</option>";  } 	?>	</select> ";
    innerHtml+="<label for=\"rooms\"><span id='ajBEDROOM'><?php echo JText::_('PHONG_NGU') ?><span>:</label>";
    innerHtml+="<select class='newroom' name ='rooms' onchange=getonchangvalue(this.value,'divroom',\'\',1) ><?php   for($i=0;$i<=9;$i++)   	{  $selected="" ; if($this->propertyData->rooms == $i){	$selected="selected"; }   echo "<option $selected value=$i>$i</option>";  } 	?>	</select> ";
	  innerHtml+="<label for=\"rooms\"><span id='ajBATHROOM'><?php echo JText::_('PHONG_TAM') ?></span>:</label>";
	innerHtml+="<select class='newroom' name ='toilets' onchange=getonchangvalue(this.value,'divtoilets',\'\',1) ><?php   for($i=0;$i<=9;$i++)   	{  $selected="" ; if($this->propertyData->toilets == $i){	$selected="selected"; }   echo "<option $selected value=$i>$i</option>";  } 	?>	</select> ";
    innerHtml+="<label for=\"toilets\"><span id='ajORTHER_ROOM'><?php echo JText::_('PHONG_KHAC') ?></span>:</label> <select class='newroom' name ='highrooms' onchange=getonchangvalue(this.value,'divhighrooms',\'\',1) ><?php   for($i=0;$i<=9;$i++)   	{  $selected="" ; if($this->propertyData->highrooms == $i){	$selected="selected"; }   echo "<option $selected value=$i>$i</option>";  } 	?>	</select>    	</td></tr></table>";
if(idType==1 || idType==2 || idType==3 || idType==4 || idType==5 || idType==15)
document.getElementById("showRooms").innerHTML=innerHtml;
else
document.getElementById("showRooms").innerHTML='';

document.getElementById("divroom").innerHTML= '_';
document.getElementById("divhighrooms").innerHTML= '_';
document.getElementById("divtoilets").innerHTML= '_';
}*/

<?php
if ( $this->status != 0 )
{
?>
	/*
		Ham kiem tra du lieu cua form dang tin
	*/
	

	/* kiem tra 3 nut dang tin*/
	/*
	function submitForm(published,re_link)
	{
	// o fontend
		var form = document.jeaForm;
		if ( validateForm( form ) )
		{
			form.submit();
		}
	}
	*/

<?php
}
?>
	</script>
	


<?php
if ( $this->status != 0 )
{
	if($this->propertyData['loai_bds_id'])
	{
	?>
		<script type="text/javascript" defer="defer" >
			// TODO: add filter
			//jea_types_filter(<?=$this->propertyData['loai_bds_id']?>);
		</script>
	<?php
	}
}
?>


<?php
if ($this->status == 2 )
{
?>


	<input type="hidden" name="task" value="" />
	<input type="hidden" name="zip_code" value="084" />
	<input type="hidden" name="id" value="<?php echo $this->propertyData['id'] ?>" />
  <?php echo JHTML::_( 'form.token' ) ?>
	</div> <!-- div dong tab mo tren cung -->
<?php
}
?>

<!-- cac the hidden chua tam toan bo data khi dang tin -->
<?php
if ($this->status != 0 )
{
?>
	<!-- phan hidden thay doi theo ngon ngu -->
	<input type="hidden" name="currentLang" id="currentLang"  value="<?php echo $this->lang ?>" />
		<!-- tieng viet -->
	<input type="hidden" name="vi_hidden_ref" id="vi_hidden_ref" value=" " />
	<input type="hidden" name="vi_hidden_address" id="vi_hidden_address"  value=" " />
	<input type="hidden" name="vi_hidden_description" id="vi_hidden_description"  value=" " />
	<input type="hidden" name="vi_hidden_name_vl" id="vi_hidden_name_vl"  value=" " />
	<input type="hidden" name="vi_hidden_address_vl"  id="vi_hidden_address_vl" value=" " />
	<input type="hidden" name="vi_hidden_ghichu" id="vi_hidden_ghichu" value=" " />
	<input type="hidden" name="vi_hidden_page_title" id="vi_hidden_page_title" value=" " />
	<input type="hidden" name="vi_hidden_page_keywords"  id="vi_hidden_page_keywords" value=" " />
	<input type="hidden" name="vi_hidden_page_description"  id="vi_hidden_page_description"  value=" " />
	<input type="hidden" name="vi_hidden_properties_key" id="vi_hidden_properties_key"  value=" " />
	
		<!-- tieng anh -->
	<input type="hidden" name="en_hidden_ref" id="en_hidden_ref" value="<?php echo $this->propertyDataen['tieu_de'] ?>" />
	<input type="hidden" name="en_hidden_address" id="en_hidden_address"  value="<?php echo $this->propertyDataen['dia_chi'] ?>" />
	<input type="hidden" name="en_hidden_description" id="en_hidden_description"  value="<?php echo $this->propertyDataen['mo_ta_chi_tiet'] ?>" />
	<input type="hidden" name="en_hidden_name_vl" id="en_hidden_name_vl"  value="<?php echo $this->propertyDataen['ten_nguoi_lien_he'] ?>" />
	<input type="hidden" name="en_hidden_address_vl"  id="en_hidden_address_vl" value="<?php echo $this->propertyDataen['dia_chi_nguoi_lien_he'] ?>" />
	<input type="hidden" name="en_hidden_ghichu" id="en_hidden_ghichu" value="<?php echo $this->propertyDataen['ghi_chu_nguoi_lien_he'] ?>" />
	<input type="hidden" name="en_hidden_page_title" id="en_hidden_page_title" value="<?php echo $this->propertyDataen['tieu_de_trang'] ?>" />
	<input type="hidden" name="en_hidden_page_keywords"  id="en_hidden_page_keywords" value="<?php echo $this->propertyDataen['tu_khoa_trang'] ?>" />
	<input type="hidden" name="en_hidden_page_description"  id="en_hidden_page_description"  value="<?php echo $this->propertyDataen['mo_ta_trang'] ?>" />
	<input type="hidden" name="en_hidden_properties_key" id="en_hidden_properties_key"  value=" " />
	<input type="hidden" name="advantagesGetValue" id="advantagesGetValue"  value=" " />
	

	<!--  tieng viet -->
	<input type="hidden" name="vi_loai_bds" id="vi_loai_bds"  value=" " />
	<input type="hidden" name="vi_loai_giao_dich" id="vi_loai_giao_dich"  value=" " />
	<input type="hidden" name="vi_phap_ly" id="vi_phap_ly"  value=" " />
	<input type="hidden" name="vi_don_vi_dien_tich" id="vi_don_vi_dien_tich"  value=" " />
	<input type="hidden" name="vi_don_vi_tien" id="vi_don_vi_tien"  value=" " />
	<input type="hidden" name="vi_nha_moi_gioi_ten" id="vi_nha_moi_gioi_ten"  value=" " />
	<input type="hidden" name="vi_tinh_thanh" id="vi_tinh_thanh"  value=" " />
	<input type="hidden" name="vi_quan_huyen" id="vi_quan_huyen"  value=" " />
	<input type="hidden" name="vi_tien_ich" id="vi_tien_ich"  value=" " />
	<input type="hidden" name="vi_huong" id="vi_huong"  value=" " />
	<input type="hidden" name="vi_vi_tri" id="vi_vi_tri"  value=" " />
	<input type="hidden" name="vi_nha_moi_gioi" id="vi_nha_moi_gioi"  value=" " />
	<input type="hidden" name="vi_du_an" id="vi_du_an"  value=" " />

	<!--  tieng anh -->
	<input type="hidden" name="en_loai_bds" id="en_loai_bds"  value="<?php echo $this->propertyDataen['loai_bds'] ?>" />
	<input type="hidden" name="en_loai_giao_dich" id="en_loai_giao_dich"  value="<?php echo $this->propertyDataen['loai_giao_dich'] ?>" />
	<input type="hidden" name="en_phap_ly" id="en_phap_ly"  value="<?php echo $this->propertyDataen['phap_ly'] ?>" />
	<input type="hidden" name="en_don_vi_dien_tich" id="en_don_vi_dien_tich"  value="<?php echo $this->propertyDataen['don_vi_dien_tich'] ?>" />
	<input type="hidden" name="en_don_vi_tien" id="en_don_vi_tien"  value="<?php echo $this->propertyDataen['don_vi_tien'] ?>" />
	<!-- <input type="hidden" name="en_nha_moi_gioi_ten" id="en_nha_moi_gioi_ten"  value="<?php echo $this->propertyDataen['nha_moi_gioi_ten'] ?>" /> -->
	<input type="hidden" name="en_tinh_thanh" id="en_tinh_thanh"  value="<?php echo $this->propertyDataen['tinh_thanh'] ?>" />
	<input type="hidden" name="en_quan_huyen" id="en_quan_huyen"  value="<?php echo $this->propertyDataen['quan_huyen'] ?>" />
	<input type="hidden" name="en_tien_ich" id="en_tien_ich"  value="<?php echo $this->propertyDataen['tien_ich'] ?>" />
	<input type="hidden" name="en_huong" id="en_huong"  value="<?php echo $this->propertyDataen['huong'] ?>" />
	<input type="hidden" name="en_vi_tri" id="en_vi_tri"  value=" " />
	<input type="hidden" name="en_nha_moi_gioi" id="en_nha_moi_gioi"  value=" " />
	
	
	
		<input type="hidden" name="id" id="idobj" value="<?php echo $this->propertyData['id'] ?>" />
		<input type='hidden'  id='path' value='<?php echo JURI::root() ?>'/>
<?php
}
?>


</form>
	  <link rel="stylesheet" href="<?php echo JURI::root()?>templates/webenrichland_new/css/templates.css" type="text/css" />  
	<!-- <link rel="stylesheet" href="<?php echo JURI::root()?>templates/WebVHL/css/templates.css" type="text/css" /> -->
	<script type="text/javascript" src="<?php echo JURI::root()?>libraries/js/prototype.lite.js"></script>
	<script type="text/javascript" src="<?php echo JURI::root()?>libraries/js/moo.fx.js"></script>
	<script type="text/javascript" src="<?php echo JURI::root()?>libraries/js/moo.fx.pack.js"></script>
	<script type="text/javascript" src="<?php echo JURI::root()?>libraries/js/ham-tien-ich.js"></script>
	<script type="text/javascript" src="<?php echo JURI::root()?>libraries/com_u_re/js/utils.js"></script>

<!-- add javascript & init script -->
<?php if ( $this->status == 0 ) {?>

<script language="javascript">
// init map
showMap( 'map_canvas', <?php echo $this->propertyData['kinh_do'] . "," .
		 $this->propertyData['vi_do'] . ",'" . $this->propertyData['id'] . "',16" ?>);
</script>
<?php }
else
{
?>
<!--  load script admin -->
<script type="text/javascript" src="<?php echo JURI::root()?>libraries/com_u_re/js/admin_utils.js"></script>

<?php }?>
<script language="javascript">
initTab('box', 'tab_image', 'tab_map');
</script>
<?php 
if ( $this->status == 2 )
{
	echo "</div>";
}
?>
