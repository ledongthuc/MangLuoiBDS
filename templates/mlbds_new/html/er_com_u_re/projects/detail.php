<link rel="stylesheet" href="../templates/WebGH/css/templates.css" />
	<script type="text/javascript" src="<?php echo JURI::root()?>libraries/com_u_re/js/utils.js"></script>
	<script type="text/javascript" src="<?php echo JURI::root()?>libraries/com_u_re/js/admin_utils.js"></script>
	<script type="text/javascript" src="<?php echo JURI::root()?>libraries/js/prototype.lite.js"></script>
	<script type="text/javascript" src="<?php echo JURI::root()?>libraries/js/moo.fx.js"></script>
	<script type="text/javascript" src="<?php echo JURI::root()?>libraries/js/moo.fx.pack.js"></script>


<?php
if ($this->status == 2 )
{
	echo "<div style='width: 700px'>";
?>

<script type="text/javascript" src="../libraries/js/ajax.js"></script>
<!--  
<img src="../images/vi.gif"  style="cursor:pointer" onclick="getProjectLanguage('vi-VN'), getProjectDataLang('vi')" />
<img src="../images/us.gif"  style="cursor:pointer"  onclick="getProjectLanguage('en-GB'), getProjectDataLang('en')" />
 -->
<?php
$editor =& JFactory::getEditor();

//JHTML::stylesheet('jea.admin.css', 'media/com_jea/css/');
}
?>

<form action="index.php?option=com_jea&controller=projects" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data" >  
<?php
if ( $this->status == 2)
{
?>
<input type="button" onclick="submitbutton_duan()" name="save" class="button" value="<?php echo JText::_('LUU') ?>" />
<input type="button" onclick="submitbutton('cancel')" name="huy" class="button" value="<?php echo JText::_('CENCEL') ?>" />
<hr class='margin_hr_dangtin'>
     <li>
           <span id='aj_EMPHASISPROJ' class="msts admin">
				<?php echo JText::_('DU_AN_NOI_BAT') ?> :
		   </span>
           <span class="bold">
			<input type="checkbox" value="1" id="emphasis" name="noi_bat"  <?php if ( $this->row['noi_bat'] ) echo 'checked="checked"' ?> />
			</span>
     </li>
    
	<li>
           <span id='aj_NEW_PROJECT' class="msts admin">
				<?php echo JText::_('DU_AN_MOI') ?> :
		   </span>
           <span class="bold">
			  <input type="checkbox" value="1" id="newsest" name="newsest"  <?php if ( $this->row['moi_nhat'] ) echo 'checked="checked"' ?> />
			</span>
     </li>  
		  
	<li>
           <span id='aj_PUBLISHED' class="msts">
				<?php echo JText::_('HIEN_THI') ?> :
		   </span>
           <span class="bold">
			  <td><?php echo JHTML::_('select.booleanlist',  'published' , 'class="inputbox"' , $this->row['hien_thi_ra_ngoai'] ) ; ?>
			</span>
     </li>  	  

<?php
} /* Chỗ đóng móc không cho hiển thị ở fontent*/
?>  
<div class="project">
<div class="total"> <!--  div chua title-->
               

                <?php
				if( $this->status == 0 )
				{
				 echo "<h2 class='title_details'>";
				 echo $this->row['ten'];
				 echo "</h2>";
				}
				else
				{
				?>
				
				<span id='aj_PROJECT_NAME'>	<?php  echo JText::_('TEN_DU_AN'); ?></span>
				<input id="name" type="text" size="87" name="name" value="<?php echo $this->row['ten'] ?>" class="inputbox" />
				<?php
				}
				 ?>
               
 </div> <!--  div chua title-->
 <div id="content"><!-- CONTENT -->
   <div class="smoothness"> <!-- div chua tab-->
   <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
   

<li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active"> <!--chua tab tong quan-->
	<span onMouseDown="changeStatusTab('tab_OVERVIEW')" id="tab_OVERVIEW" class="tab_active" title="first">
		<span id='aj_OVERVIEW'>	<?php  echo JText::_('TONG_QUAN'); ?></span>
	</span>
</li>
<li class="ui-state-default ui-corner-top"><!-- bản đồ vị trí-->
	<span onMouseDown="changeStatusTab('tab_PLANE_AREA')" id="tab_PLANE_AREA" class="tab_inactive" title="first">
		<span id='aj_PLANE_AREA'>
			<?php  echo JText::_('BAN_DO_VI_TRI'); ?>
		</span>
	</span>		
</li><!-- bản đồ vị trí-->
<li class="ui-state-default ui-corner-top"><!-- Sơ đồ mặt bằng-->
	<span onMouseDown="changeStatusTab('tab_PLANE_DIAGRAM')" id="tab_PLANE_DIAGRAM" class="tab_inactive" title="first">
			<span id='aj_PLANE_DIAGRAM'>
				<?php  echo JText::_('SO_DO_MAT_BANG'); ?>
			</span>
	</span>
</li><!-- Sơ đồ mặt bằng-->
<li class="ui-state-default ui-corner-top"> <!-- Tiến độ -->
	<span onMouseDown="changeStatusTab('tab_PROGRESS')" id="tab_PROGRESS" class="tab_inactive" title="first">
		<span id='aj_PROGRESS'>
			<?php  echo JText::_('TIEN_DO'); ?>
		</span>
	</span>
</li><!-- Nhà mẫu-->
<li class="ui-state-default ui-corner-top"> <!-- đối tác-->
	<span onMouseDown="changeStatusTab('tab_PARTNERS')" id="tab_PARTNERS" class="tab_inactive" title="first">
		<span id='aj_PARTNERS'>
			<?php  echo JText::_('DOI_TAC'); ?>
		</span>
	</span>
</li><!-- Tiện ích-->
<li class="ui-state-default ui-corner-top"> <!--thanh toán-->
	<span onMouseDown="changeStatusTab('tab_PAYMENT')" id="tab_PAYMENT" class="tab_inactive" title="first">
		<span id='aj_PAYMENT'>
			<?php  echo JText::_('THANH_TOAN'); ?>
		</span>
	</span>
</li><!-- thanh toán-->


<li class="ui-state-default ui-corner-top"><!-- liên hệ-->
	<span onMouseDown="changeStatusTab('tab_CONTACTS')" id="tab_CONTACTS" class="tab_inactive" title="first">
		<span id='aj_CONTACTS'>
			<?php  echo JText::_('LIEN_HE'); ?>
		</span>
	</span>
</li><!--Liên hệ-->
 </ul>
   </div><!-- div chua tab-->
   
	<div class="boxholder">
		<div id="box_id" class="box"><!-- THONG_TIN_TONG_QUAN -->
				  <!--div chua hinh anh-->
				  <div class="properties-detail-w">
					   <div class="project-images">
						  <div ><!-- hình ảnh lớn--->
							<?php 
							//if ( $this->status == 0 )
							//{
							?> 		
						  		
						  		 <?php
								// print_r($this->mainImage);
								 if ( is_file($this->mainImage['isfile']))
								 {
								 ?>
									 <img  id="img_preview"   class="img_preview" src="<?php echo $this->mainImage['preview_url'] ?>" 
								 alt="<?php echo $this->mainImage['title'] ?>" title="<?php echo JText::_('Enlarge')?>" />
								 <?php 
								 }
								 else 
								 {
								 ?>
								 	<img id="img_preview"   class="img_preview"  src="<?php echo JURI::root()?>images/noimage.jpg"  alt="preview.jpg"  /> 
								 <?php 
								 }
								?>
								
							
						
								
								
						  </div><!-- hình ảnh lớn--->
						  
						  
						  
					   <div class="snd_imgs" ><!--hình ảnh thumbsnail-->
					             	<li>
					             	<?php
					             	// thumbsnaul cua anh chinh
									 if ( is_file($this->mainImage['isfile']))
									 {
									 ?>
									 	<img src="<?php echo $this->mainImage['min_url'] ?>" 
									 	alt="<?php echo $this->mainImage['title'] ?>" title="<?php echo JText::_('Enlarge')?>" 
									 	onclick="swapImage('img_preview','<?php echo $this->mainImage['preview_url'] ?>')" />
									 	
									 		<?php // xoa hinh anh chinh
										 	if ( $this->status == 2 )
										 	{
										 	?>
										 		 <a href="<?php echo JURI::root() . 'administrator/index.php?option=com_jea'
			            						.'&amp;controller=projects&amp;task=deleteimg&amp;id='. $this->row['id']?>" ><?php echo JText::_('DELETE') ?></a>	
										 	<?php	
										 	}
										 	?>
								 	
									 <?php 
									 }	
									 ?>
					             	</li>
					                <?php foreach($this->secondariesImages as $image) : ?>
					                <li>
									  <img src="<?php echo $image['min_url'] ?>"  alt="<?php echo $image['name'] ?>"
									    title="<?php echo JText::_('title')?>" onclick="swapImage('img_preview','<?php echo $image['preview_url'] ?>')" />
									   
									    <?php // xoa hinh anh phu
										 	if ( $this->status == 2 )
										 	{
										 	?>
									    <a href="<?php echo JURI::root() . 'administrator/index.php?option=com_jea'
	          							 .'&amp;controller=projects&amp;task=deleteimg&amp;id='.$this->row['id'].'&amp;image='.$image['name']?>" ><?php echo JText::_('DELETE') ?></a>	   
									    <?php 
										 	}
									    ?>
									    
					             	</li>
					                <?php endforeach ?>
					                     </div><!--hình ảnh thumbsnail-->
					                     
							
					                <?php // the input de dua hinh anh phu len
									if ( $this->status == 2 )
									{
									?>
									
									<div class="clear">		
									
									
									<div> <!--  ANH_CHINH -->
										<span id='aj_MAIN_PROPERTY_PICTURE'>
											<?php echo JText::_('ANH_CHINH') ?>
										</span>
										<span class="input_hinhanhchinh_dangtin" >
								  			<input   id='main_image' type="file" name="main_image" value=""  size="30"/><input type="button" value="<?php echo JText::_('Đăng hình lại từ đầu'); ?>" onclick='resetImage(20)'>
								  		</span>
									</div><!--  ANH_CHINH -->									
																			
									 <input type="hidden" id="CountImage" name="CountImage" value='0' />
									<table id="tblUpload"">
									    <tbody>
									        <tr id="0">
									            <td valign="top" colspan="2">
													<span id='aj_SECONDARIES'>
														<?php echo JText::_('ANH_PHU') ?>
													</span>
													<span class="input_hinhanhphu_dangtin" >
									              		 <input   name="secondaries_images0" type="file" id="secondaries_images0" class="SForm"  size="30" onchange="javascript:UploadImg(this)" />
									              	</span>
												</td>
											</tr>
										</tbody>
									</table>
									</div>
									<?php 
									}
									?>
			        
					           <div class="clear">
					           </div>
					 </div>
				 
				</div>
			
		</div> <!-- THONG_TIN_TONG_QUAN -->
		
		<div class="box"><!-- BAN_DO_VI_TRI -->
			<?php
			// ban do vi tri
			if ( $this->status == 0 )
			{
				 echo $this->row['ban_do_vi_tri'];
			}
			else
			{	
				echo JText::_('BAN_DO_VI_TRI') ;
				echo $editor->display( 'plane_area',  $this->row['ban_do_vi_tri'] , '100%', '400', '75', '20', false );
			}
			?>
		</div><!-- BAN_DO_VI_TRI -->
		
		<div class="box"><!-- SO_DO_MAT_BANG -->
			<?php
			// so do mat bang
			if ( $this->status == 0 )
			{
				echo $this->row['so_do_mat_bang'];
			}
			else
			{
				echo JText::_('SO_DO_MAT_BANG') ;
				echo $editor->display( 'plain_diagram',  $this->row['so_do_mat_bang'] , '100%', '400', '75', '20', false ) ;
			}
			?>
		</div><!-- SO_DO_MAT_BANG -->
		
		<div class="box"><!-- TIEN_DO -->
			<?php
			// tien do
			if ( $this->status == 0 )
			{
				 echo $this->row['tien_do'] ;
			}
			else
			{
				echo JText::_('TIEN_DO') ;
				echo $editor->display( 'progress',  $this->row['tien_do'] , '100%', '400', '75', '20', false ) ;
			}
			?>
		</div>
		
		<div class="box"> <!-- DOI_TAC -->
			<?php
			// doi tac
			if ( $this->status == 0 )
			{
				echo $this->row['doi_tac'] ;
			}
			else
			{
				echo JText::_('DOI_TAC') ;
				echo $editor->display( 'partners',  $this->row['doi_tac'] , '100%', '400', '75', '20', false ) ;
			}
			?>
		</div><!-- DOI_TAC -->
		
		<div class="box"><!-- THANH_TOAN -->
			<?php
			//thanh toan
			if ( $this->status == 0 )
			{
				echo $this->row['thanh_toan'];
			}
			else
			{
				echo JText::_('THANH_TOAN') ;
				echo $editor->display( 'payment',  $this->row['thanh_toan'] , '100%', '400', '75', '20', false ) ;
			}
			?>
		</div> <!-- THANH_TOAN -->
			
		<div class="box"><!-- LIEN-HE -->
			<?php
			// lien he
			if ( $this->status == 0 )
			{
				echo $this->row['lien_he'];
			}
			else
			{
				echo JText::_('LIEN_HE') ;
				echo $editor->display( 'contacts',  $this->row['lien_he'] , '100%', '400', '75', '20', false ) ;
			}
			?>
		</div><!-- LIEN-HE -->
	</div>
</div><!-- CONTENT -->
   <div class="properties-detail clear"><!-- THONG_TIN_TONG_QUAN -->
			<div id="info-detail-title"><!-- TIEU_DE -->
			    <span> 
	<?php echo JText::_('CHI_TIET_DU_AN') ?>   
    			</span>
	        </div><!-- TIEU_DE -->
     <div class='du-an'><!-- DIA_CHI -->
           <span class="msts admin" id='aj_ADRESS' ><?php echo JText::_('DIA_CHI') ?></span>
           <span class="bold">
          	 <?php
				if ( $this->status == 0 )
				{
					if (  trim($this->row['dia_chi']) == NULL )
					{					
							echo "_";
					}
					else
					{					
						echo $this->row['dia_chi'] ;
					}
				}
				else
				{
				?>
				<input id="address" type="text" name="address" value="<?php echo $this->row['dia_chi']  ?>" class="inputbox" size="60px" />
				<?php
				}
				?>
           </span>
    </div><!-- DIA_CHI -->
    <div class='du-an'><!-- LOAI_DU_AN -->
            <span class="msts admin"><?php echo JText::_('LOAI_DU_AN') ?>:</span>
            <span  id='aj_type_id' class="bold">
					<?php
					if ( $this->status == 0 )
					{
						if (  trim($this->row['loai_du_an']) == NULL )
							{					
									echo "_";
							}
							else
							{					
								echo $this->row['loai_du_an'] ;
							}					
					}
					else
					{
						echo $this->type;
					}
					 ?>
			</span>
           
	</div><!-- LOAI_DU_AN -->
    <div class='du-an'><!--  NGAY_KHOI_CONG -->
            <span id='aj_START_DATE' class="msts admin"><?php  echo JText::_('NGAY_KHOI_CONG')  ?> </span>
            <span class="bold">
            	<?php
				if ( $this->status == 0 )
				{
						if (  trim($this->row['ngay_khoi_cong']) == NULL )
							{					
									echo "_";
							}
							else
							{					
								echo $this->row['ngay_khoi_cong'] ;
							}
				}
				else
				{
				?>
					<input type="text" class="text_area" size="25" id="start_date" name="start_date" value="<?php echo  $this->row['ngay_khoi_cong'] ?>" />
				<?php
				}
				?>
            </span>
    </div><!-- NGAY_KHOI_CONG -->
	<div class='du-an'><!-- NGAY_HOAN_THANH -->
            <span id='aj_END_DATE' class="msts admin"><?php  echo JText::_('NGAY_HOAN_THANH')  ?></span>
            <span class="bold">
            <?php
			if ( $this->status == 0 )
			{
					if (  trim($this->row['ngay_hoan_thanh']) == NULL )
					{					
							echo "_";
					}
					else
					{					
						echo $this->row['ngay_hoan_thanh'] ;
					}			
			}
			else
			{
			?>
				<input type="text" class="text_area" size="25" id="end_date" name="end_date" value="<?php echo  $this->row['ngay_hoan_thanh'] ?>" />
			<?php
			}
			?>            
            </span>
    </div><!-- NGAY_HOAN_THANH -->
   	<div class='du-an'><!-- NHA_DAU_TU -->
            <span class="msts admin"><?php  echo JText::_('NHA_DAU_TU')  ?></span>
            <span class="bold">
          		<?php
				if ( $this->status == 0 )
				{
					if (  trim($this->row['nha_dau_tu']) == NULL )
					{					
							echo "_";
					}
					else
					{					
						echo $this->row['nha_dau_tu'] ;
					}				
				}
				else
				{
				?>
					<input id="investor" size="25" type="text" name="investor" value="<?php echo  $this->row['nha_dau_tu'] ?>" class="inputbox" size="50" />
				<?php
				}
				?>
            </span>
    </div><!-- NHA_DAU_TU -->

</div>      <!-- THONG_TIN_TONG_QUAN -->
<div class='properties-detail clear'><!-- GIOI_THIEU -->
		<div id="info-detail-title">
			<span id='aj_INTRODUCE'>
				<?php  echo JText::_('GIOI_THIEU')  ?>
			</span>
		</div>
		<div class='noidung'>
<?php
if ( $this->status != 0 )
{
?>
			<!--	mô tả ngắn	-->
		<span id='aj_SHORT_DESCRIPTION'>
			<?php echo JText::_('MO_TA_NGAN') ?>
		</span>
		:
		<p>
		 <?php //echo $editor->display( 'short_description',  $this->row['mo_ta_ngan'] , '100%', '400', '75', '20', false ) ;?>
		 <textarea rows="5" cols="97" id="short_description"><?php echo $this->row['mo_ta_ngan'];?></textarea>
		 </p>
		 <?php 		
}
?>
<?php
	if( $this->status ==0 )
	{
		echo $this->row['mo_ta_day_du'];
	}
	else
	{
		?>
		<span id='aj_DESCRIPTION'>
			<?php echo JText::_('MO_TA_DAY_DU') ?>
		</span>
			:
		   <p>
		  <?php	echo $editor->display( 'description',  $this->row['mo_ta_day_du'] , '100%', '400', '75', '20', false ) ; ?>
		  </p>
<?php
	}
	
?>
</div>
		</div>
		
		<?php 
if ( $this->status == 0 )
{
?>
<div class="info-structure"><!--DU_AN_LIEN_QUAN-->
				<div id="info-detail-title">
				<span>
				<?php  echo JText::_('DU_AN_LIEN_QUAN')  ?>
				
				</span>
				</div>
				<?php 
				foreach ( $this->duanlienquan as $dalq)
				{
				?>
				<li class='du-an-lq'>
					<a href="index.php?option=com_u_re&controller=projects&Itemid=24&id=<?php echo $dalq['id']?>" >
						<?php echo $dalq['ten']?>
					</a>
				</li>
				<?php 
				}
				?>
				
</div><!-- DU_AN_LIEN_QUAN -->
<?php 
}
?>
</div><!-- PROJECT -->

	<div class="box" ><!--  BAN_DO_VI_TRI -->
		<?php
		// ban do vi tri
		if ( $this->status == 0 )
		{
			 echo $this->row['ban_do_vi_tri'];
		}
		else
		{
			echo $editor->display( 'plane_area',  $this->row['ban_do_vi_tri'] , '100%', '400', '75', '20', false );
		}
		?>
	</div><!-- BAN_DO_VI_TRI -->

	<div class="box" ><!-- SO_DO_MAT_BANG -->
		<?php
		// so do mat bang
		if ( $this->status == 0 )
		{
			echo $this->row['so_do_mat_bang'];
		}
		else
		{
			echo $editor->display( 'plain_diagram',  $this->row['so_do_mat_bang'] , '100%', '400', '75', '20', false ) ;
		}
		?>
	</div><!-- SO_DO_MAT_BANG -->

	<div class="box" ><!-- TIEN_DO -->
		<?php
		// tien do
		if ( $this->status == 0 )
		{
			 echo $this->row['tien_do'] ;
		}
		else
		{
			echo $editor->display( 'progress',  $this->row['tien_do'] , '100%', '400', '75', '20', false ) ;
		}
		?>
	</div><!-- TIEN_DO -->
	<div class="box" ><!-- DOI_TAC -->
		<?php
		// doi tac
		if ( $this->status == 0 )
		{
			echo $this->row['doi_tac'] ;
		}
		else
		{
			echo $editor->display( 'partners',  $this->row['doi_tac'] , '100%', '400', '75', '20', false ) ;
		}
		?>
	</div><!-- DOI_TAC -->
	<div class="box" >
		<?php
		//thanh toan
		if ( $this->status == 0 )
		{
			echo $this->row['thanh_toan'];
		}
		else
		{
			echo $editor->display( 'payment',  $this->row['thanh_toan'] , '100%', '400', '75', '20', false ) ;
		}
		?>
	</div>

	<div class="box" ><!-- LIEN_HE -->
		<?php
		// lien he
		if ( $this->status == 0 )
		{
			echo $this->row['lien_he'];
		}
		else
		{
			echo $editor->display( 'contacts',  $this->row['lien_he'] , '100%', '400', '75', '20', false ) ;
		}
		?>
	</div><!-- LIEN_HE -->
  <input type="hidden" name="task" value="" />
  <input type="hidden" name="zip_code" value="084" />
  <input type="hidden" name="id" value="<?php echo $this->row['id'] ?>" />
  <?php echo JHTML::_( 'form.token' ) ?>


     
<!-- phan hidden thay doi theo ngon ngu -->
	<input type="hidden" name="tmp" id="tmp"  value="<?php echo $this->lang ?>" />
	<!-- tieng viet -->
	
	<input type="hidden" name="vi_plane_area"  id="vi_plane_area"  value=" " />
	
	<input type="hidden" name="vi_hidden_name" id="vi_hidden_name" value=" " />
	<input type="hidden" name="vi_hidden_address" id="vi_hidden_address"  value=" " />
	<input type="hidden" name="vi_hidden_description" id="vi_hidden_description"  value=" " />
	<input type="hidden" name="vi_hidden_short_description" id="vi_hidden_short_description"  value=" " />
	<input type="hidden" name="vi_hidden_investor"  id="vi_hidden_investor" value=" " />
	<input type="hidden" name="vi_hidden_implement_unit" id="vi_hidden_implement_unit" value=" " />
	<input type="hidden" name="vi_hidden_management_unit"  id="vi_hidden_management_unit" value=" " />
	<input type="hidden" name="vi_hidden_design_unit"  id="vi_hidden_design_unit" value=" " />
	<input type="hidden" name="vi_hidden_scheme"  id="vi_hidden_scheme" value=" " />
	<input type="hidden" name="vi_hidden_plain_diagram"  id="vi_hidden_plain_diagram" value=" " />
	<input type="hidden" name="vi_hidden_progress"  id="vi_hidden_progress" value=" " />
	<input type="hidden" name="vi_hidden_contacts"  id="vi_hidden_contacts" value=" " />
	<input type="hidden" name="vi_hidden_partners"  id="vi_hidden_partners" value=" " />
	<input type="hidden" name="vi_hidden_contact_address"  id="vi_hidden_contact_address" value=" " />
	<input type="hidden" name="vi_hidden_contact_name"  id="vi_hidden_contact_name" value=" " />
	<input type="hidden" name="vi_hidden_payment"  id="vi_hidden_payment" value=" " />
	<input type="hidden" name="vi_hidden_page_title" id="vi_hidden_page_title" value=" " />
	<input type="hidden" name="vi_hidden_page_keywords"  id="vi_hidden_page_keywords" value=" " />
	<input type="hidden" name="vi_hidden_page_description"  id="vi_hidden_page_description"  value=" " />
	<!-- tieng anh -->
	<input type="hidden" name="en_hidden_name" id="en_hidden_name" value="<?php echo $this->rowEn['ten']?>"/>
	<input type="hidden" name="en_hidden_address" id="en_hidden_address"  value="<?php echo $this->rowEn['dia_chi']?>" />
	<input type="hidden" name="en_hidden_description" id="en_hidden_description"  value="<?php echo $this->rowEn['mo_ta_day_du']?>" />
	<input type="hidden" name="en_hidden_short_description" id="en_hidden_short_description"  value="<?php echo $this->rowEn['mo_ta_ngan']?>" />
	<input type="hidden" name="en_hidden_investor"  id="en_hidden_investor" value="<?php echo $this->rowEn['nha_dau_tu']?>" />
	<input type="hidden" name="en_hidden_implement_unit" id="en_hidden_implement_unit" value="<?php echo $this->rowEn['don_vi_thi_cong']?>" />
	<input type="hidden" name="en_hidden_management_unit"  id="en_hidden_management_unit" value="<?php echo $this->rowEn['don_vi_quan_li']?>" />
	<input type="hidden" name="en_hidden_design_unit"  id="en_hidden_design_unit" value="<?php echo $this->rowEn['don_vi_thiet_ke']?>" />
	<input type="hidden" name="en_hidden_scheme"  id="en_hidden_scheme" value="<?php echo $this->rowEn['quy_hoach_tong_the']?>" />
	<input type="hidden" name="en_hidden_plain_diagram"  id="en_hidden_plain_diagram" value="<?php echo $this->rowEn['so_do_mat_bang']?>" />
	<input type="hidden" name="en_hidden_progress"  id="en_hidden_progress" value="<?php echo $this->rowEn['tien_do']?>" />
	<input type="hidden" name="en_hidden_contacts"  id="en_hidden_contacts" value="<?php echo $this->rowEn['lien_he']?>" />
	<input type="hidden" name="en_hidden_partners"  id="en_hidden_partners" value="<?php echo $this->rowEn['doi_tac']?>" />
	<input type="hidden" name="en_hidden_contact_address"  id="en_hidden_contact_address" value="<?php echo $this->rowEn['dia_chi_lien_he']?>" />
	<input type="hidden" name="en_hidden_contact_name"  id="en_hidden_contact_name" value="<?php echo $this->rowEn['ten_lien_he']?>" />
	<input type="hidden" name="en_hidden_payment"  id="en_hidden_payment" value="<?php echo $this->rowEn['thanh_toan']?>" />
	<input type="hidden" name="en_hidden_page_title" id="en_hidden_page_title" value="<?php echo $this->rowEn['tieu_de_trang']?>" />
	<input type="hidden" name="en_hidden_page_keywords"  id="en_hidden_page_keywords" value="<?php echo $this->rowEn['tu_khoa_trang']?>" />
	<input type="hidden" name="en_hidden_page_description"  id="en_hidden_page_description"  value="<?php echo $this->rowEn['mo_ta_trang']?>" />
	
	<input type="hidden" name="vi_loai_du_an" id="vi_loai_du_an"  value="<?php echo $this->row['loai_du_an'] ?>" />
	<input type="hidden" name="en_loai_du_an" id="en_loai_du_an"  value="<?php echo $this->row['loai_du_an'] ?>" />
	
			<?php
		if ( $this->status == 2 )
		{
		?>
			<input type="button" onclick="submitbutton_duan()" name="save" class="button" value="<?php echo JText::_('LUU') ?>" />
			<input type="button" onclick="submitbutton('cancel')" name="huy" class="button" value="<?php echo JText::_('CENCEL') ?>" />
		<?php
		}		
		echo "</div>";
		?>
</form>


<script language="javascript" type="text/javascript">
	Element.cleanWhitespace('content');
	init();
</script>
<input type="hidden" name="tab_current" id="tab_current"  value="tab_OVERVIEW" />