<link rel="stylesheet" href="../templates/webenrichland_new/css/templates.css" />
<script type="text/javascript" src="<?php echo JURI::root()?>libraries/com_u_re/js/utils.js"></script>
<script type="text/javascript" src="<?php echo JURI::root()?>libraries/com_u_re/js/admin_utils.js"></script>
<script type="text/javascript" src="<?php echo JURI::root()?>libraries/com_u_re/js/jstab.js"></script>

<?php
if ($this->status == 2 )
{
	echo "<div>";
?>

<script type="text/javascript" src="../libraries/js/ajax.js"></script>
<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>-->
<!--<script>-->
<!--$(function(){-->
<!--	$("#idCat").change(function(){-->
<!--		var idCat=$(this).val();-->
<!--		$("#listart").load("../getListArticle.php?idcat="+ idCat);-->
<!--	});-->
<!--});-->
<!--</script>-->
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
<input type="button" onclick="submitbutton('cancel')" name="huy" class="button" value="<?php echo JText::_('CANCEL') ?>" />
<hr class='margin_hr_dangtin'>
     <li>
           <span id='aj_EMPHASISPROJ' class="msts admin">
				<?php echo JText::_('DU_AN_NOI_BAT') ?> :
		   </span>
           <span class="bold">
			<input type="checkbox" value="1" id="emphasis" name="noi_bat"  <?php if ( $this->row['noi_bat'] ) echo 'checked="checked"' ?> />
			</span>
			   <?php echo JText::_(' &nbsp &nbsp Hình quảng cáo dự án nổi bật') ?> <input type="file" name="hinh_quang_cao" value=""  size="30"/>
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
<div class="total" style='float:left; width:100%' > <!--  div chua title-->
               

                <?php
				if( $this->status == 0 )
				{?>
				<h2 class='title_details' style='float:left'>
				 <?php echo $this->row['ten'];?>
				</h2>
				<?php 
					if($this->hien_thi_luot_xem == 1)
					{?>
				<div class='luotxem' style='float:right'>
					<?php  echo JText::_('LUOT_XEM').': '.$this->row['luot_xem'];?> 
				</div>
				<?php }
				}
				else
				{
				?>
				
				<span id='aj_PROJECT_NAME'>	<?php  echo JText::_('TEN_DU_AN'); ?></span>
				<input id="name" type="text" size="87" name="name" value="<?php echo $this->row['ten'] ?>" class="inputbox" />
				<br/>
				<span id='aj_ALIAS'>	<?php  echo JText::_('ALIAS'); ?></span>
				<input id="alias" type="text" size="87" name="alias" value="<?php echo $this->row['alias'] ?>" class="inputbox" />
				<?php
				}
				 ?>
               
 </div> <!--  div chua title-->
<div id="content" style='float:left; width:100%'><!-- CONTENT -->
	<div class="smoothness"> <!-- div chua tab-->
		<ul id="tabheader" class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
			<li rel="subtab1" class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active"> <!--chua tab tong quan-->
				<span class="tab_active">
					<a><?php  echo JText::_('TONG_QUAN'); ?></a>
				</span>
			</li>
			<li rel="subtab2" class="ui-state-default ui-corner-top"><!-- bản đồ vị trí-->
				<span class="tab_inactive">
					<a><?php  echo JText::_('BAN_DO_VI_TRI'); ?></a>
				</span>		
			</li><!-- bản đồ vị trí-->
			<li rel="subtab3" class="ui-state-default ui-corner-top"><!-- tiện ích-->
				<span class="tab_inactive">
					<a><?php  echo JText::_('TIEN_ICH'); ?></a>
				</span>		
			</li><!-- tiện ích -->
			<li rel="subtab4" class="ui-state-default ui-corner-top"><!-- Sơ đồ mặt bằng-->
				<span class="tab_inactive">
					<a><?php  echo JText::_('SO_DO_MAT_BANG'); ?></a>
				</span>
			</li><!-- Sơ đồ mặt bằng-->
			<li rel="subtab5" class="ui-state-default ui-corner-top"> <!-- tin tức liên quan -->
				<span class="tab_inactive">
					<a><?php  echo JText::_('TIN_TUC'); ?></a>
				</span>
			</li><!-- tin tức liên quan-->
			<li rel="subtab6" class="ui-state-default ui-corner-top"> <!-- Hình ảnh thực tế-->
				<span class="tab_inactive">
					<a><?php  echo JText::_('HINH_ANH'); ?></a>						
				</span>
			</li><!-- Hình ảnh thực tế-->
			<li rel="subtab7" class="ui-state-default ui-corner-top"> <!--Video clip-->
				<span class="tab_inactive">
					<a><?php  echo JText::_('VIDEO'); ?></a>						
				</span>
			</li><!-- Video clip-->
			<li rel="subtab8" id ='tab8' lass="ui-state-default ui-corner-top"><!-- liên hệ-->
				<span class="tab_inactive">
					<a><?php  echo JText::_('LIEN_HE'); ?></a>
				</span>
			</li><!--Liên hệ-->
		</ul>
	</div><!-- div chua tab-->
   
	<div class="boxholder">
		<div id="subtab1" class="box"><!-- THONG_TIN_TONG_QUAN -->
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

     
<div class='properties-detail clear'><!-- GIOI_THIEU -->
		
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

				 
			
		</div> <!-- THONG_TIN_TONG_QUAN -->
		</div> 
		<div id="subtab2" class="box" style="display:none"><!-- BAN_DO_VI_TRI -->
			<?php
			// ban do vi tri
			if ( $this->status == 0 )
			{
				if($this->row['ban_do_vi_tri']!='' && trim($this->row['ban_do_vi_tri'])!='<br mce_bogus="1">' && trim($this->row['ban_do_vi_tri'])!='<p><br mce_bogus="1"></p>')
					 	echo $this->row['ban_do_vi_tri'];
					 else
					 	echo JText::_('CHUA_CO_DU_LIEU');
			}
			else
			{	
				echo JText::_('BAN_DO_VI_TRI') ;
				echo $editor->display( 'plane_area',  $this->row['ban_do_vi_tri'] , '100%', '400', '75', '20', false );
			}
			?>
		</div><!-- BAN_DO_VI_TRI -->
		
		<div id="subtab3" class="box" style="display:none"><!-- TIEN_ICH -->
			<?php
			// so do mat bang
			if ( $this->status == 0 )
			{
				if($this->row['tien_ich']!='' && trim($this->row['tien_ich'])!='<br mce_bogus="1">' && trim($this->row['tien_ich'])!='<p><br mce_bogus="1"></p>')
					 	echo $this->row['tien_ich'];
					 else
					 	echo JText::_('CHUA_CO_DU_LIEU');
			}
			else
			{
				echo JText::_('TIEN_ICH') ;
				echo $editor->display( 'plain_diagram',  $this->row['tien_ich'] , '100%', '400', '75', '20', false ) ;
			}
			?>
		</div><!-- TIEN ICH DU AN -->
		
		<div id="subtab4" class="box" style="display:none"><!-- SO_DO_MAT_BANG -->
			<?php
			// so do mat bang
			if ( $this->status == 0 )
			{
				if($this->row['so_do_mat_bang']!='' && trim($this->row['so_do_mat_bang'])!='<br mce_bogus="1">' && trim($this->row['so_do_mat_bang'])!='<p><br mce_bogus="1"></p>')
					 	echo $this->row['so_do_mat_bang'];
					 else
					 	echo JText::_('CHUA_CO_DU_LIEU');
			}
			else
			{
				echo JText::_('SO_DO_MAT_BANG') ;
				echo $editor->display( 'plain_diagram',  $this->row['so_do_mat_bang'] , '100%', '400', '75', '20', false ) ;
			}
			?>
		</div><!-- SO_DO_MAT_BANG -->
		
		<div id="subtab5" class="box" style="display:none"><!-- TIN_TUC_LIEN_QUAN -->
			<?php
			// tien do
			if ( $this->status == 0 )
			{
				$dem= count($this->article);
				 if($dem!=0)
				 
					foreach ($this->article as $articles){
						if($dem==1){
							echo $articles->title;
							echo $articles->introtext;
						}else{
							require_once (JPATH_SITE.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'route.php');
							$link=JRoute::_(ContentHelperRoute::getArticleRoute($articles->id,$this->row['tintuc'], $this->alias->section));
							//$link=ilandCommonUtils::getPropertyLink($this->alias[0],$articles->id,209);
							//$link= JURI::base()."vi/".$this->alias['alias']."/".$articles->id."-".$articles;
							echo "<a href=".$link.">".$articles->title."</a><br/>";
						}
					}				
						
				 else
					 echo JText::_('CHUA_CO_DU_LIEU');
			}
			else
			{
				echo JText::_('TIN_TUC') ;
				//echo $this->row['tintuc'];
			?>
			<br/>
			<table>
				<tr>
					<th>Chọn chủ đề</th>
					<td>
						<select name="tintuc" id="tintuc">
					     <?php foreach ($this->cat as $cats){
					     	$select='';
					     		if($cats->id==$this->row['tintuc']) $select='selected="selected"';
					     ?>
					     			<option value="<?php echo $cats->id;?>" <?php echo $select ?> ><?php echo $cats->title;?></option>
					     <?php }?>
					    </select>
					</td>
				</tr>
				<br/>
<!--				<div id="listart"></div>-->
			</table>
				
						
			<?php
				//echo $editor->display( 'tintuc',  $this->row['tintuc'] , '100%', '400', '75', '20', false ) ;
				
			}
			?>
		</div><!-- TIN_TUC_LIEN_QUAN -->
		
		<div id="subtab6" class="box" style="display:none"> <!-- HINH_ANH -->
		 <div class="properties-detail-w">
					 <div class="project-images">
						<?php if (!empty( $this->imageBlockHTML ) )
						{
							echo $this->imageBlockHTML;
						}?>  
					 </div>
				 
				</div>
			<?php
			// tien do
			//if ( $this->status == 0 )
			//{
			//	 if($this->row['hinh_anh']!='' && trim($this->row['hinh_anh'])!='<br mce_bogus="1">' && trim($this->row['hinh_anh'])!='<p><br mce_bogus="1"></p>')
			//		 	echo $this->row['hinh_anh'];
			//		 else
			///		 	echo JText::_('CHUA_CO_DU_LIEU');
		//	}
		//	else
		//	{
		//		echo JText::_('HINH_ANH') ;
		//		echo $editor->display( 'hinhanh',  $this->row['hinh_anh'] , '100%', '400', '75', '20', false ) ;
		//	}
			?>
		</div><!-- HINH_ANH -->
		
		<div id="subtab7" class="box" style="display:none"><!-- VIDEO -->
			<?php
			//thanh toan
			if ( $this->status == 0 )
			{
				if($this->row['video']!='' && trim($this->row['video'])!='<br mce_bogus="1">' && trim($this->row['video'])!='<p><br mce_bogus="1"></p>'){
						echo $this->row['video']; 
				}else{
					 	echo JText::_('CHUA_CO_DU_LIEU');
				
			}
			}else
			{
				echo JText::_('VIDEO') ;
				echo $editor->display( 'video',  $this->row['video'] , '100%', '400', '75', '20', false ) ;
			}
			?>
		</div> <!-- VIDEO -->
			
		<div id="subtab8" class="box" style="display:none"><!-- LIEN-HE -->
			<?php
			// lien he
			if ( $this->status == 0 )
			{
				if($this->row['lien_he']!='' && trim($this->row['lien_he'])!='<br mce_bogus="1">' && trim($this->row['lien_he'])!='<p><br mce_bogus="1"></p>' )
					echo $this->row['lien_he'];
				else
					echo JText::_('CHUA_CO_DU_LIEU');
						
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
<script language=javascript>window.onload=initalizetab("tabheader")</script>
   <div class="properties-detail clear"><!-- THONG_TIN_TONG_QUAN -->
			
    
		
		<?php 
if ( $this->status == 0 )
{
?>
<div class="info-structure"><!--DU_AN_LIEN_QUAN-->
				<div class="componentheading">
				<span class='componentheading_s'>
				<?php  echo JText::_('DU_AN_LIEN_QUAN')  ?>
				
				</span>
				</div>
				<?php 
				$Itemid =& JRequest::getVar('Itemid', 31);
				foreach ( $this->duanlienquan as $dalq)
				{
					if ( empty( $dalq['alias'] ) )
					{
						$dalq['alias'] = str_replace(' ', '-', $dalq['ten']);
					}
					$itemLink = ilandCommonUtils::getProjectLink(  $dalq['alias'], $dalq['id'], $Itemid );
				?>
				<li class='du-an-lq'>
					<a href="<?php echo $itemLink;?>" >
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
  <input type="hidden" name="task" value="" />
  <input type="hidden" name="zip_code" value="084" />
  <input type="hidden" name="id" value="<?php echo $this->row['id'] ?>" />
  <?php echo JHTML::_( 'form.token' ) ?>

</div>
     
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
	<input type="hidden" name="vi_hidden_hinhanh"  id="vi_hidden_hinhanh" value=" " />
	<input type="hidden" name="vi_hidden_video"  id="vi_hidden_video" value=" " />
	<input type="hidden" name="vi_hidden_tintuc"  id="vi_hidden_tintuc" value=" " />
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
	<input type="hidden" name="en_hidden_hinhanh"  id="en_hidden_hinhanh" value=" <?php echo $this->rowEn['hinh_anh']?>" />
	<input type="hidden" name="en_hidden_video"  id="en_hidden_video" value=" <?php echo $this->rowEn['video']?>" />
	<input type="hidden" name="en_hidden_tintuc"  id="en_hidden_tintuc" value="<?php echo $this->rowEn['tintuc']?> " />
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
			<input type="button" onclick="submitbutton('cancel')" name="huy" class="button" value="<?php echo JText::_('CANCEL') ?>" />
		<?php
		}		
		//echo "</div>";
		?>
</form>


<script language="javascript" type="text/javascript">
	//Element.cleanWhitespace('content');
	//init();
</script>
<input type="hidden" name="tab_current" id="tab_current"  value="tab_OVERVIEW" />