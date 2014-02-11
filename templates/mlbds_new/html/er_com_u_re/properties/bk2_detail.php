<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
	<script type="text/javascript" src="<?php echo JURI::root()?>libraries/com_u_re/js/admin_utils.js"></script>
	<script type="text/javascript" src="<?php echo JURI::root()?>libraries/js/ajax.js"></script>

<?php
if ( $this->status == 2 )
{
?>
	<!-- backend -->	
	<!--
	<img src="../images/vi.gif"  style="cursor:pointer" onclick="getAdvantageValues('advantagedValue', 'advantagesGetValue'), getDataLang('vi'), getCompoChangeLang('vi-VN', 2)" />
	<img src="../images/us.gif"  style="cursor:pointer"  onclick="getAdvantageValues('advantagedValue', 'advantagesGetValue'), getDataLang('en'),getCompoChangeLang('en-GB', 2)" />
-->
	<!-- fontend -->
	<!-- <img src="./images/vi.gif"  style="cursor:pointer" onclick="getDataLang('vi'), getCompoChangeLang('vi-VN', 1)" />
	<img src="./images/us.gif"  style="cursor:pointer"  onclick="getDataLang('en'),getCompoChangeLang('en-GB', 1)" /> -->

<!--
	<img src="./images/vi.gif"  style="cursor:pointer" onclick="getAdvantageValues('advantagedValue', 'advantagesGetValue'), getDataLang('vi'), getCompoChangeLang('vi-VN', 1)" />
	<img src="./images/us.gif"  style="cursor:pointer"  onclick="getAdvantageValues('advantagedValue', 'advantagesGetValue'), getDataLang('en'),getCompoChangeLang('en-GB', 1)" />
-->
<?php
}
?>

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
	if ( !is_array($this->propertyData) || empty($this->propertyData) || $this->propertyData['id']=='' )
	{
	    echo JText::_('THIS_PROPERTY_DO_NOT_EXISTS_ANYMORE');
	    return;
	}
}
?>

<?php
if ( $this->status == 2)
{
	echo "<div style='width: 625px'>";
?>
<form action="index.php?option=com_jea&controller=properties&cat=needrenting&task=save" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data" />

<?php
}
else
if ( $this->status == 1)
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
		if ( $usergid == '0' && $this->status == 1)
		{
			echo  "<center><h3>".JText::_('USER_PHAI_DANG_NHAP')."</h3></center";
		}
		
		
 if ( $this->status == 2 ) 
		{
			?>
			<div style="width:700px" >
				<center>
						<input type="button" onclick="submitForm_backend(<?php echo $op ?>,'3','<?php echo $this->lang?>')" name="save_review" class="button" value="<?php echo JText::_('LUU') ?>" />
					<span id ='ajCancael'>
						 <input type="button" onclick="submitCancel('cancel')" name="save_cancel" class="button" value="<?php echo JText::_('HUY') ?>" />
					</span>
				</center>
		    </div>
			<?php 
		echo "	<hr class='margin_hr_dangtin'>";
		}
		
?>


		<!-- MA_SO_TAI_SAN -->				
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
					if ( $this->status == 2)
					{
					?>
					<div class="dangtinadminbds">
							<span id='PROPERTIES_UNIT'><?php echo JText::_('MA_SO_TAI_SAN') ; ?></span>
					</div>
					<div class="seo_bds_admin_textarea">
							<input type='text'  id='properties_key'  name='properties_key' value='<?php echo $this->properties_key ?>' class='inputbox_id'/>
							<input type='hidden'  id='path' value='<?php echo JURI::root() ?>'/>
					</div>
					<?php
				//	echo "<span id='PROPERTIES_UNIT' class='msts admin'>".JText::_('MA_SO_TAI_SAN').":"."</span>";
				//	echo "<input type='text' id='properties_key'  name='properties_key' value='". $this->properties_key ."' class='inputbox_id'/>";
					}
					else
					if ( $this->status == 1)
					{
					echo "<input type='hidden' id='properties_key'  name='properties_key' value='". $this->properties_key ."' class='inputbox_id'/>";
					}
					?>		
		 <!-- end MA_SO_TAI_SAN -->
	
<!-- Cấu hình SEO + hiển thị ra ngoài -->	
<?php
 if ( $this->status == 2 || ($user->usertype=='Super Administrator' && $this->status != 0))
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
			
	<?php
	// hien thi dang tin noi bat neu la admin
	if($usertype == "Super Administrator")
		{
		// tin noi bat
		
		?>
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

	<!-- end Cấu hình SEO + hiển thị ra ngoài -->
		<?php
		/* hien thi Published o dang tin admin */
		if ( $this->status == 2)
		{
		?>
			<br/>
			<span id='PUBLISHED'><?php echo JText::_('DANG_TIN') ?> </span>
		<?php
			echo $this->published;
		}
			echo "<hr class='margin_hr_dangtin'>";
}
else 
{
?>
	<input type="hidden" name="tieu_de_trang" value="" />
	<input type="hidden" name="tu_khoa_trang" value="" />
	<input type="hidden" name="mo_ta_trang" value="" />
	<input type='checkbox' id='newsest' name='moi_nhat' checked="checked"  style="display:none"/>
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
	        	<!--
				<a href='<?php echo $this->propertyData['link'];?>'>
				-->
				<a href='#'>
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
							<input type='text'  size='70' id='ref' name='tieu_de' value='<?php echo $this->propertyData['tieu_de'] ?>' class='inputbox_seo' />
						</td>
					</tr>
				</table>
<?php
	        }
?>
        </div>
	</div>
	<!--  thong tin co ban -->
	<div class='properties-detail'>
		<div id='info-detail-title'> <!--  TIEU DE -->
			<span> <?php  echo JText::_('THONG_TIN_CO_BAN'); ?></span>
		</div> <!--  KET THUC TIEU DE -->
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
				<span id='aj_LOAI_BDS' >
					<?php  echo JText::_('LOAI_BDS'); ?>
				</span>
			</li>
			<li id ='aj_types'><?php echo $this->types; ?> </li>
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
				<!--  <span id='ADDRESS' class='items-add1_b'><?php echo JText::_('DIA_CHI');?></span>-->
			<!-- TINH_THANH -->
			<div class='layout-admin'>
				<li class='msts admin'>
					<span id='ja_TINH_THANH' ><?php echo JText::_('TINH_THANH');?>:</span>
				</li>
				<li>
					<span id='ja_town'>	<?php echo $this->towns;// thanh pho ?> </span>
				</li>	
			</div>	
			<!-- TINH_THANH -->		
			<!-- QUAN_HUYEN -->
			<div class='layout-admin'>	
				<li class='msts admin'>
					<span id='ja_QUAN_HUYEN' ><?php echo JText::_('QUAN_HUYEN');?>:</span>
				</li>
				<li>
					<div id="quanhuyen">
						<?php echo $this->areas;// quan huyen?>
					</div>
					<!--<div id="innerTown" ></div>-->
				</li>	
			</div>
			
			<!-- PHUONG XA -->	
			<div class='layout-admin'>
				<li class='msts admin' id='STREET'>
					<span id='ja_PHUONG_XA' ><?php  echo JText::_('PHUONG_XA')?>:</span>
				</li>
				<li>
					<div id="phuong_xa_select"><?php echo $this->phuongXaListHTML;?>
<!--					<input type="text" id="phuong_xa" name="phuong_xa" value="<?php  echo $this->propertyData['phuong_xa'] ?>" class="inputbox_address" size="42" />-->
					</div>
				</li>
			</div>	
			
			<!-- SO NHA -->	
			<div class='layout-admin'>
				<li class='msts admin' id='HOUSENUM'>
					<span id='ja_HOUSENUM'><?php  echo JText::_('HOUSENUM')?>:</span>
				</li>
				<li>
					<input type="text" id="housenum" name="so_nha" value="<?php  echo $this->propertyData['so_nha']; ?>" class="inputbox_sonha" size="10" />
				</li>
			</div>	
			
			<!-- DUONG PHO -->	
			<div class='layout-admin'>
				<li class='msts admin' id='STREET'>
					<span id='ja_STREET'><?php  echo JText::_('STREET')?>:</span>
				</li>
				<li>
					<?php 
					//echo 'id :'.$this->propertyData['duong_pho_id'];
					//echo 'ten :'.$this->propertyData['duong_pho'];
						if($this->propertyData['duong_pho_id']=='0' && $this->propertyData['duong_pho']!=''){?>
							<div id="duong_pho_select" style="float: left; display: none;width: 160px;"><?php echo $this->duongPhoListHTML?></div>
							<div id="duong_pho_text" style="float: left;width: 160px;">
								<input type="text" name="vi_duong_pho_text" id="vi_duong_pho_text" style="width: 158px; " value="<?php echo $this->propertyData['duong_pho'];?>"/>
							</div>
							<input id="orderinput" type="checkbox" onclick="doiNhapLieuDuongPho(this);" checked="checked"/> Khác
					<?php }else{?>
							<div id="duong_pho_select" style="float: left;width: 160px;"><?php echo $this->duongPhoListHTML?></div>
							<div id="duong_pho_text" style="float: left; display: none;width: 160px;">
								<input type="text" name="vi_duong_pho_text" id="vi_duong_pho_text" style="width: 158px; " value=""/>
							</div>
							<input id="orderinput" type="checkbox" onclick="doiNhapLieuDuongPho(this);" /> <?php  echo JText::_('KHAC'); ?>
					<?php } ?>
									
					
				</li>
			</div>	
   
   			
			
			<!-- GIA -->
			<div class='layout-admin'>
				<li class='msts admin' id='PRICE'>
					<?php  echo JText::_('PRICE'); ?>:
				</li>
				<li>
					<input  id="price" type="text" name="gia" value="<?php echo $this->InsertPrice;//$this->propertyData['gia'] ?>" class="numberbox new2"  />
			 	
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
		
<!-- dia_chi -->
<?php
if ( $this->status == 0 )
{
?>
		<div class='layout-admin'> 

					<li class="msts admin ">
			        <?php  echo JText::_('dia_chi')?>
			        </li>
			        <li class='bold'>
			        	<?php echo $this->propertyData['dia_chi']?>
			        </li>
		</div> 
<?php
}
?>
<!-- end dia_chi -->
	
<!-- loai_bds -->
<?php
if ( $this->status == 0 )
{
?>
		<div class='layout-admin'> 

					<li class="msts admin ">
			        <?php  echo JText::_('loai_bds')?>
			        </li>
			        <li class='bold'>
			        	<?php echo $this->propertyData['loai_bds']?>
			        </li>
		</div> 
<?php
}
?>
<!-- end loai_bds -->
	
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
		<!--  end PHAP_LY-->
		
		
		<!-- huong-->
		<div class='layout-admin' id="usearea" > 
					<li id='ajt_legal' class="msts admin"><?php echo JText::_('huong');?>
					</li>
					<li class='bold'>
					<span >
								    <?php
									if( $this->status == 0 )
									{
								    		echo $this->propertyData['huong'];
									}
									else
									{
									?>
									<span id='aj_directions'><?php echo $this->directions; ?></span>
									<?php
									}
								    ?>
					</li>
		</div>
		<!--  end huong-->

		<!-- GIA -->
		<?php if ( $this->status == 0 )
		{
		?>
					<div class='layout-admin'> 
					<li class="msts giaban">
					<?php if ( empty($titleStrings) ) 
							{
								echo JText::_('GIA');
							}
							else 
							{
								echo $titleStrings['GIA'];
							}?>
					</li>
						<?php
                                   		if($this->status == 0)
                                   		{
											echo $this->tienHTML;
                                   		}
                                   		
                                   		?>
					</div>
				<?php
				}
				?>
			<!--end  GIA -->
			
					<div class='layout-admin'> <!--  PHONG -->
						<?php
						if( $this->status == 0 )
						{

						}
						                else
                                        {
		                                     
                                        	 echo "<div id='showRooms'></div>";
               
                                        } // end else
?>

               
                                </div>
                                
                                 <!-- HUONG -->
								 
					<!-- CAU_TRUC -->
<div class="info-structure">
            <div class="info-structure-title">
				<span id='aj_CAU_TRUC'><?php echo JText::_('CAU_TRUC');?></span>							
			</div>
			
			<div class="StructureC">
			<div class="boderleft">
  			
			<!-- 	// TONG DIEN TICH SU DUNG PHAN HIEN THI O DUOI -->
			    <div  class="bg1 cautruc1">
						<li id='ajsTOTAL_AREA_USED'>
									<?php	echo JText::_('DIEN_TICH_KHUON_VIEN');?>	
						</li>
						<li class='bold'>
						<?php
						if( $this->status == 0)
						{					
							 if ($this->propertyData['dien_tich_khuon_vien'] != 0 )
							{					
								echo "<li id='divliving_space'>".$this->propertyData['dien_tich_khuon_vien']."m<sup>2</sup></li>";
							}
							else
							{
								echo "<li id='divliving_space'>_</li>";
							}
						}
						else
						{				
						?>
									   <input type="text" name="dien_tich_khuon_vien" 
																	 value="<?php echo $this->propertyData['dien_tich_khuon_vien'] ?>" 
																	 class="numberbox area" size="5"  />m<sup>2</sup>
						<?php
						}		
						?>
						</li> 
			    </div>
				<!-- 	end  TONG DIEN TICH SU DUNG PHAN HIEN THI O DUOI -->
				
				
	
    <div  class="bg1 cautruc1">
	    <li id='ajPROPERTIES_TYPE'><?php echo JText::_('CHIEU_RONG');?></li>
	    <li class='bold'>
	    <?php
	    if ( $this->status == 0)
	    {
		  if ($this->propertyData['dien_tich_khuon_vien_rong'] != 0 )
			{
				echo "<li id='divtype'>".$this->propertyData['dien_tich_khuon_vien_rong']."m</li>";
			}
			else
			{
				echo "<li id='divtype'>_</li>";
			}
	    }
		else
	    {
			?>
			   <input type="text" name="dien_tich_khuon_vien_rong" 
								   			 value="<?php echo $this->propertyData['dien_tich_khuon_vien_rong'] ?>" 
								   			 class="numberbox area" size="5"  />m	
			<?php
	    }
	    ?>
	    </li>
    </div>
	
	
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
		
		?>
		<select class='newroom' name ='phong_ngu'  >
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
		
	<?php 
	/*
		if ($this->propertyData['phong_ngu'] != 0 )
		{
			echo "<li id='divroom'>".$this->propertyData['phong_ngu']."</li>";
		}
		else
		{
			 echo "<li id='divroom'>_</li>";
		}
		*/

	}
    
     ?></li>
     </div>
	 
	 <!-- dien tich khuo -->
    <div class="bg2 cautruc1 clear">
		<li id='USE_AREA'><?php echo JText::_('D_T_S_D').":"; ?></li>
		<li class='bold'>
		
			<?php		
		if ($this->status == 0)
		{
			echo $this->livingSpaceString;		
		}
		else
		{
		?>							   
								   <input type="text" name="dien_tich_su_dung" 
								   			 value="<?php echo $this->propertyData['dien_tich_su_dung'] ?>" 
								   			 class="numberbox area" size="5"  />m<sup>2</sup>			   	
								   																						
			<?php
		}
		?>
		</li>
</div>
<!-- end dien tich su dung -->

<div  class="bg1 cautruc1">
	    <li id='ajPROPERTIES_TYPE'><?php echo JText::_('CHIEU_DAI');?></li>
	    <li class='bold'>
	    <?php
	    if ( $this->status == 0)
	    {
		  if ($this->propertyData['dien_tich_khuon_vien_dai'] != 0 )
			{
				echo "<li id='divtype'>".$this->propertyData['dien_tich_khuon_vien_dai']."m</li>";
			}
			else
			{
				echo "<li id='divtype'>_</li>";
			}
	    }
		else
	    {
			?>
			   <input type="text" name="dien_tich_khuon_vien_dai" 
								   			 value="<?php echo $this->propertyData['dien_tich_khuon_vien_dai'] ?>" 
								   			 class="numberbox area" size="5"  />m	
			<?php
			
	    }
	    ?>
	    </li>
    </div>
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
		
		?>
		<select class='newroom' name ='phong_tam'  >
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
		
	<?php 
		
		/*
		if ($this->propertyData['phong_tam'] != 0 )
		{
			echo "<li id='divtoilets'>".$this->propertyData['phong_tam']."</li>";
		}
		else
		{
			echo "<li id='divtoilets'>_</li>";
		}
		*/
	}
    ?> </li>
    </div>
   <div class="bg1 cautruc1 clear"> 
  &nbsp&nbsp
    </div>
 <div class="bg1 cautruc1"> 
 &nbsp&nbsp
    </div>
    <div  class="bg1 cautruc1">
    <li id='ajsORTHER_ROOM'><?php echo JText::_('PHONG_KHACH');?></li>
    <li class='bold'><?php
    //hoan dang lam
    // print_r( $this->propertyData['phong_khach'] );
	if ( $this->status == 0 )
	{
		// cac phong khac
		echo $this->propertyData['phong_khach'];
	}
	else
	{		
		?>
		<select class='newroom' name ='phong_khach'  >
	<?php 
	for($i=0;$i<=9;$i++) 
		{ 
			$selected="" ;
			 if($this->propertyData['phong_khach'] == $i)
			 {	
			 	$selected="selected";
			  } 
			    echo "<option $selected value=$i>$i</option>"; 
		 } 
		 	?>
		 	</select>
		
	<?php 
	  
	   /*
   
		if ($this->propertyData['phong_khach'] != 0 )
		{
			echo "<li id='divhighrooms'>".$this->propertyData['phong_khach']."</li>";
		}
		else
		{
			echo "<li id='divhighrooms'>_</li>";
		}
		*/
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
	            if( !empty( $this->tienIchHTML ) && !empty( $this->propertyData['tien_ich_id'] ) )
	            {
		            ?>
				        <div class="info-structure">
				            <div class="info-structure-title">
									
											<span>
											<?php echo JText::_('TIEN_ICH');?>
											</span>
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
					
							<span id="aj_ADVANTAGES"><?php echo JText::_('TIEN_ICH'); ?> </span>				
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
		
<!-- MO TA -->
<div class="info-structure">
				<div class='info-structure-title'>
				
				<span id='aj_MO_TA'> <?php echo JText::_('MO_TA'); ?> </span>
				</div>


<div class="space">
		         <?php
		         if( $this->status == 0){
		         	echo $this->propertyData['mo_ta_chi_tiet'];
		         }
		         else{
				   echo $this->editor->display('mo_ta_chi_tiet', $this->propertyData['mo_ta_chi_tiet'] , '100%', '300', '75', '20', false ) ;
		         }
		         ?>
		  	
</div>
</div>
<!-- MO TA -->
			
	</div>
	<!--  ket thuc thong tin co ban -->
        <div id="properties-detail_w"><!--div chua phan google map-->
			<div>
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
			<div class="boxholder"><!--boxholder-->
				
				<!-- box hien thi hinh anh -->
				<div id='box_id' class="box" >
					<?php
					// if( $this->status == 0)
					//if ( 1 )
					// {
					?>
						<!-- anh chinh -->
						<!-- TODO: add SEO advance -->
						<!--<img id="main_image" src="<?php echo $this->mainImage['preview_url'];?>" alt="" title="" />-->
						<!--<?php if ( $this->status != 0 ) {?>
							<input type="file" id="main_image" name="main_image" value=""  size="30" />
						<?php } // end if?>-->
						
						<?php
								 if ( is_file($this->mainImage['isfile']))
								 {
								 ?>
									 <img  id="img_preview" src="<?php echo $this->mainImage['preview_url'] ?>" 
								 alt="<?php echo $this->mainImage['title'] ?>" title="<?php echo JText::_('Enlarge')?>" />
								 <?php 
								 }
								 else 
								 {
								 ?>
								 	<img id="img_preview" src="<?php echo JURI::root()?>images/noimage.jpg"  alt="preview.jpg"  /> 
								 <?php 
								 }
								?>
								
								<?php  // the input de dua hinh anh chinh
							if ( $this->status != 0 )
							{
							?>
						
							<?php 
							}
							?><div class="snd_imgs" ><!--hình ảnh thumbsnail-->
					             	<li>
					             	<?php
					             	// thumbsnaul cua anh chinh
									 if ( is_file($this->mainImage['isfile']))
									 {
									 	// print_r($this->row['id']);
									 ?>
									 	<img src="<?php echo $this->mainImage['min_url'] ?>" 
									 	alt="<?php echo $this->mainImage['title'] ?>" title="<?php echo JText::_('Enlarge')?>" 
									 	onclick="swapImage('img_preview','<?php echo $this->mainImage['preview_url'] ?>')" />
									 	
									 		<?php // xoa hinh anh chinh
										 	if ( $this->status != 0 )
										 	{
										 	?>
										 		 <a href="<?php echo JURI::root() . 'index.php?option=com_u_re'
			            						.'&amp;controller=properties&amp;task=deleteimg&amp;id='. $this->propertyData['id']?>" ><?php echo JText::_('DELETE') ?></a>	
										 	<?php	
										 	}
										 	?>
								 	
									 <?php 
									 }	
									 ?>
					             	</li>
									
					                <?php 
										if ( !empty($this->secondariesImages) && is_array($this->secondariesImages) ) { 
										foreach($this->secondariesImages as $image) { ?>
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
					                <?php } }?>
									  </div>
									
					                
					                <?php // the input de dua hinh anh phu len
									if ( $this->status != 0 )
									{
									?>
									
									<div class="clear">												
									<div>
									<!--  ANH_CHINH -->
								<span id='aj_MAIN_PROPERTY_PICTURE'>
									<?php echo JText::_('ANH_CHINH') ?>
								</span>
								<span class="input_hinhanhchinh_dangtin" >
						  			<input id='main_image' type="file" name="main_image" value=""  size="30"/><input type="button" value="Reset" onclick='resetImage(20)'>
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
													     <input name="secondaries_images0" type="file" id="secondaries_images0" class="SForm" size="30" onchange="javascript:UploadImg(this)" />
													</span>
													</td>
											</tr>
										</tbody>
									</table>
									</div>
									<?php 
									}
									?>
			           
						
						
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
		</div><!--div chua phan hinh anh-->
 		
					
     				<!-- gia tien -->
                    <div>
                                <?php
                                if( $this->status == 0)
                                {
                                ?>
                             
                             			<?php
                             			// Neu khong co thong tin lien he thi khong hien thi phan lien he 
			                               if( !empty ( $this->propertyData['ten_nguoi_lien_he'] )
			                                  || !empty( $this->propertyData['dien_thoai_nguoi_lien_he'] )
			                                  || !empty( $this->propertyData['dia_chi_nguoi_lien_he'] )
			                                  || !empty( $this->propertyData['has_realtor'] ) )
			                               {
//			                               
			                            ?>
                                <div class="info-structure"><!-- thong tin lien hê-->
	                               <div class="info-structure-title">
	                               <span>
	                                 <?php echo JText::_('LIEN_HE');?>:
	                                 </span>
	                                </div>
	                                <div class="item-contact1"><!--div chua thong tin nguoi dang-->
	                           			
										<div>
											<div class="name_user">
								       		<?php 
								       			if ( !empty( $this->propertyData['has_realtor'] ) ) {
								       				//echo "<span class='admin'>".JText::_('HO_TEN').":</span>" ;?>
			                                	<a href="<?php echo $this->propertyData->realtor_link['profile'];?>">
			                               			<?php echo $this->propertyData['ten_nguoi_lien_he']; ?>
			                               		</a>
			                               		<?php } else {
			                               			//echo "<span class='admin'>".JText::_('HO_TEN').":</span>" ;
			                               			echo $this->propertyData['ten_nguoi_lien_he'];
			                               		}
			                               		?>
			                               	</div>
			                               	<div class="address_user">
			                               		<?php
			                               		 	if(!empty($this->propertyData['dia_chi_nguoi_lien_he'])){
			                               		 		echo "<span class='admin'>".JText::_('DIA_CHI')."</span>" ;
			                               		 		echo $this->propertyData['dia_chi_nguoi_lien_he'];	
			                               		 	}		                               		 
			                               		 ?>
			                               	</div>
			                               	<div class="phone">
			                               		<?php
			                               		 	if(!empty($this->propertyData['dien_thoai_nguoi_lien_he'])){
			                               		 		echo "<span class='admin'>".JText::_('DIEN_THOAI'). ': '."</span>" ;
			                               		 		echo $this->propertyData['dien_thoai_nguoi_lien_he'];	
			                               		 	}		                               		 
			                               		 ?>			                                
			                                </div>
			                                <div class="note_user">
			                               		<?php
			                               		 	if(!empty($this->propertyData['ghi_chu_nguoi_lien_he'])){
			                               		 		//echo "<span class='admin'>".JText::_('GHI_CHU'). ': '."</span>" ;
			                               		 		echo $this->propertyData['ghi_chu_nguoi_lien_he'];
			                               		 	}		                               		 	
			                               		 ?>
			                               	</div>
			                                 <?php
			                                if ( !empty($this->propertyData->realtor_link) && is_array( $this->propertyData->realtor_link ) ) { ?>
			                                <div class="profile">
			                                	<!--  <a href="<?php echo $this->propertyData->realtor_link['profile'];?>">
			                                		<?php echo JText::_('XEM_HO_SO');?>
			                                	</a>

			                                	&nbsp;|&nbsp;-->

			                                </div>
			                                <div class="listing">
                          	<a href="<?php echo $this->propertyData->realtor_link['listing'];?>">

			                                		<?php echo JText::_('TAI_SAN_DA_DANG');?>
			                                	</a>
			                                </div>
			                                <?php } // if realtor link?>
								        <br class="clear"/>
								        </div>
	                                </div>
                                
                                </div><!-- thong tin lien he-->
                           		<?php } // end if lien he?>
                                </div>
                                <?php
                                }
                                else
                                {
								/*
									if ( $this->status == 2 )
									{
										// phan nha moi gioi
										?>
										<div id="usearea">
										   <?php
										   echo JText::_('NHA_MOI_GIOI');
										   ?>:
										</div>
										<?php
									}
									*/

								//$user =& JFactory::getUser();
?>
<div class="info-structure"><!-- thong tin lien hê-->
<div class="info-structure-title">
	                            <span id='ajCONTACT'><?php echo JText::_('LIEN_HE');?>:</span>
	                                </div>
<?php if($this->propertyData['id']==''){?>
<table>
	<tr>
		<td><span id='CONTACT_FULLNAME'><?php echo JText::_('HO_TEN');?>:</span></td>
		<td>
		<input type="text" id="name_vl"  name="name_vl" class="inputbox_contact" value="<?php echo $user->name; ?>" /></td>
		</tr>
	<tr>
		<td><span id='CONTACT_ADDRESS'><?php echo JText::_('DIA_CHI');?></span></td>
		<td><input type="text" id="address_vl"  name="address_vl" class="inputbox_contact" value="<?php echo $user->address; ?>"/></td>
		</tr>
	<tr>
		<td><span id='CONTACT_PHONE'><?php echo JText::_('DIEN_THOAI');?>:</span></td>
		<td><input type="text" name="phone_vl" class="inputbox_contact" value="<?php echo $user->phone; ?>"/></td>
	</tr>
	<tr>

		<td><span id='CONTACT_NOTE'><?php echo JText::_('GHI_CHU');?>:</span></td>
		
		<td>
		<textarea  id="ghichu" name="ghichu" rows="2" cols="5" class="inputbox_contact"><?php if($this->propertyData['ghi_chu_nguoi_lien_he']!='')echo $this->propertyData['ghi_chu_nguoi_lien_he'];  ?></textarea>
		</td>
	</tr>
</table>
<?php }else{?>
<table>
	<tr>
		<td><span id='CONTACT_FULLNAME'><?php echo JText::_('HO_TEN');?>:</span></td>
		<td>
		<input type="text" id="name_vl"  name="name_vl" class="inputbox_contact" value="<?php echo $this->propertyData['ten_nguoi_lien_he']; ?>" /></td>
		</tr>
	<tr>
		<td><span id='CONTACT_ADDRESS'><?php echo JText::_('DIA_CHI');?></span></td>
		<td><input type="text" id="address_vl"  name="address_vl" class="inputbox_contact" value="<?php echo $this->propertyData['dia_chi_nguoi_lien_he'] ?>"/></td>
		</tr>
	<tr>
		<td><span id='CONTACT_PHONE'><?php echo JText::_('DIEN_THOAI');?>:</span></td>
		<td><input type="text" name="phone_vl" class="inputbox_contact" value="<?php echo $this->propertyData['dien_thoai_nguoi_lien_he']; ?>"/></td>
	</tr>
	<tr>

		<td><span id='CONTACT_NOTE'><?php echo JText::_('GHI_CHU');?>:</span></td>
		
		<td>
		<textarea  id="ghichu" name="ghichu" rows="2" cols="5" class="inputbox_contact"><?php if($this->propertyData['ghi_chu_nguoi_lien_he']!='')echo $this->propertyData['ghi_chu_nguoi_lien_he'];  ?></textarea>
		</td>
	</tr>
</table>
<?php }?>

</div>

<?php } // END ELSE ?>              
       </div><!--div chua info-->
       
       <!--  CHIA_SE-->
       <?php if ( $this->status == 0 ) { ?>
       
       <div class="info-structure">   
			 
			            <div class="info-structure-title">
																<?php echo JText::_('CHIA_SE');?>
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
			   </div>            
        <?php } // end if chia se?>   
<!--           CHIA_SE -->
       <?php
if( $this->status == 0) // if bat dong san lien quan
{
	if( !empty( $this->samePropertiesHTML ) && trim( $this->samePropertiesHTML ) != '' )
	{
	?>
	  <div class="info-structure1">
            <div class="info-structure-title">
   					  	<?php  echo JText::_('BAT_DONG_SAN_LIEN_QUAN');?>
					
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
		</div> 
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
		
		
		//echo 'language:' .$this->lang;
		?>
			<div style="width:700px" >
		     <center>
			<span id ='ajSAVE_REVIEW'>
		 	 <input type="button" onclick="submitForm('<?php echo $usertype ?>','<?php echo $op ?>',<?php echo $op ?>,'1','<?php echo $this->lang?>')" name="save_review" class="button" value="<?php echo JText::_('LUU_VA_XEM_LAI') ?>" />
			</span>
			<span id ='ajSAVE_PUBLISHED'>
		     <input type="button" onclick="submitForm('<?php echo $usertype ?>','<?php echo $op ?>',<?php echo $op ?>,'2','<?php echo $this->lang?>')" name="save_published" class="button" value="<?php echo JText::_('LUU_TIN') ?>" />
			</span>
			<span id ='ajSAVE_DRAFT'>
		     <input type="button" onclick="submitForm('<?php echo  $usertype ?>','<?php echo $op ?>','0','2','<?php echo $this->lang?>')" name="save_draft" class="button" value="<?php echo JText::_('LUU_NHAP') ?>" />
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

 <input type="button" onclick="submitForm_backend(<?php echo $op ?>,'3','<?php echo $this->lang?>')" name="save_review" class="button" value="<?php echo JText::_('LUU') ?>" />
				<span id ='ajCancael'>
			     <input type="button" onclick="submitCancel('cancel')" name="save_cancel" class="button" value="<?php echo JText::_('HUY') ?>" />
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
	Element.cleanWhitespace('content');
</script>

<script type="text/javascript">
/* lay phong khach,phong ngu, phong tam... */
function jea_types_filter(idType)
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
}

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
			jea_types_filter(<?=$this->propertyData['type_id']?>);
		</script>
	<?php
	}
}
?>


<?php
if ($this->status == 2 )
{
?>
	<script type="text/javascript" defer="defer">
	// bo css cua footer vaf toolbar
	function divfooter()
	{
		document.getElementById("footer").style.display ="none";
		//document.getElementById("toolbar-save").className = "buttoname";
		//document.getElementById("toolbar-apply").className = "buttoname";
		//document.getElementById("toolbar-cancel").className = "buttoname";
	}
	</script>
	

	<input type="hidden" name="task" value="" />
	<input type="hidden" name="zip_code" value="084" />
	<input type="hidden" name="id" id="idobj" value="<?php echo $this->propertyData['id'] ?>" />
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
	<input type="hidden" name="customer" id="customer"  value="<?php echo $user->id ?>" />
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
	<input type="hidden" name="vi_phuong_xa" id="vi_phuong_xa"  value=" " />
	<input type="hidden" name="vi_duong_pho" id="vi_duong_pho"  value=" " />
	<input type="hidden" name="vi_tien_ich" id="vi_tien_ich"  value=" " />
	<input type="hidden" name="vi_huong" id="vi_huong"  value=" " />
	<input type="hidden" name="vi_vi_tri" id="vi_vi_tri"  value=" " />
	<input type="hidden" name="vi_nha_moi_gioi" id="vi_nha_moi_gioi"  value=" " />
	

	<!--  tieng anh -->
	<input type="hidden" name="en_loai_bds" id="en_loai_bds"  value="<?php echo $this->propertyDataen['loai_bds'] ?>" />
	<input type="hidden" name="en_loai_giao_dich" id="en_loai_giao_dich"  value="<?php echo $this->propertyDataen['loai_giao_dich'] ?>" />
	<input type="hidden" name="en_phap_ly" id="en_phap_ly"  value="<?php echo $this->propertyDataen['phap_ly'] ?>" />
	<input type="hidden" name="en_don_vi_dien_tich" id="en_don_vi_dien_tich"  value="<?php echo $this->propertyDataen['don_vi_dien_tich'] ?>" />
	<input type="hidden" name="en_don_vi_tien" id="en_don_vi_tien"  value="<?php echo $this->propertyDataen['don_vi_tien'] ?>" />
	<!-- <input type="hidden" name="en_nha_moi_gioi_ten" id="en_nha_moi_gioi_ten"  value="<?php echo $this->propertyDataen['nha_moi_gioi_ten'] ?>" /> -->
	<input type="hidden" name="en_tinh_thanh" id="en_tinh_thanh"  value="<?php echo $this->propertyDataen['tinh_thanh'] ?>" />
	<input type="hidden" name="en_quan_huyen" id="en_quan_huyen"  value="<?php echo $this->propertyDataen['quan_huyen'] ?>" />
	<input type="hidden" name="en_phuong_xa" id="en_phuong_xa"  value="<?php echo $this->propertyDataen['phuong_xa'] ?>" />
	<input type="hidden" name="en_duong_pho" id="en_duong_pho"  value="<?php echo $this->propertyDataen['duong_pho'] ?>" />
	<input type="hidden" name="en_tien_ich" id="en_tien_ich"  value="<?php echo $this->propertyDataen['tien_ich'] ?>" />
	<input type="hidden" name="en_huong" id="en_huong"  value="<?php echo $this->propertyDataen['huong'] ?>" />
	<input type="hidden" name="en_vi_tri" id="en_vi_tri"  value=" " />
	<input type="hidden" name="en_nha_moi_gioi" id="en_nha_moi_gioi"  value=" " />
	
<?php
}
if ( $this->status == 2 )
{
	echo "</div>";
}
?>
</form>

	<link rel="stylesheet" href="<?php echo JURI::root()?>templates/webenrichland_new/css/templates.css" type="text/css" />
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
		 $this->propertyData['vi_do'] . ",'" . $this->propertyData['id'] . "'," . $this->mapZoom ?>);
</script>
<?php }
else
{
?>
<!--  load script admin -->
<!--<script type="text/javascript" src="<?php echo JURI::root()?>libraries/com_u_re/js/admin_utils.js"></script>-->
<?php }?>
<script language="javascript">
initTab('box', 'tab_image', 'tab_map');
</script>
