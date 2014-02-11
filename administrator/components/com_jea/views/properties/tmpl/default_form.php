<?php

if ( $this->status != 0 )
{
?>
	<!-- backend -->
	<script type="text/javascript" src="../libraries/js/ajax.js"></script>
	<img src="../images/vi.gif"  style="cursor:pointer" onclick="getAdvantageValues('advantagedValue', 'advantagesGetValue'), getDataLang('vi'), getCompoChangeLang('vi-VN', 2)" />
	<img src="../images/us.gif"  style="cursor:pointer"  onclick="getAdvantageValues('advantagedValue', 'advantagesGetValue'), getDataLang('en'),getCompoChangeLang('en-GB', 2)" />

	<!-- fontend -->
	<img src="./images/vi.gif"  style="cursor:pointer" onclick="getAdvantageValues('advantagedValue', 'advantagesGetValue'), getDataLang('vi'), getCompoChangeLang('vi-VN', 1)" />
	<img src="./images/us.gif"  style="cursor:pointer"  onclick="getAdvantageValues('advantagedValue', 'advantagesGetValue'), getDataLang('en'),getCompoChangeLang('en-GB', 1)" />
<?php
}
?>

<?php
// $this->Status = 2;   hien thi layout dang tin o backend
// $this->Status = 1;   hien thi layout dang tin o fontend
// $this->Status = 0;	hien thi layout chi tiet bds o fontend

/*
$data = array(
    		0 => "Test title",
    		1 => "Test property type",
    		2 => "Test transaction type",
    		3 => "Test town",
    		4 => "Test area",
    		5 => "Test created by",
    		6 => "Test direction ",
    		7 => "Test project",
    		8 => "Test legal",
    		9 => "Test currency",
    		10 => "Test price area unit",
    		11 => "Test position",
    		12 => "Test traffice",
    		13 => "Test realtor",
    		14 => "Test price",
    		15 => "Test address",
    		16 => "Test living space",
    		17 => "Test rooms",
    		18 => "Test main room",
    		19 => "Test bedroom",
    		20 => "Test bathroom",
    		21 => "Test toilets",
    		22 => "Test floor",
    		23 => "Test advantages",
    		24 => "Test description", 
    		25 => "Test published",
    		26 => "Test ordering",
    		27 => "Test emphasis",
    		28 => "Test date created",
    		29 => "Test date modified",
    		30 => "Test checkout",
    		31 => "Test checkout time",
    		32 => "Test contact name",
    		33 => "Test contact phone",
    		34 => "Test contact email",
    		35 => "Test contact note",
    		36 => "Test living width",
    		37 => "Test living length",
    		38 => "Test project group",
    		49 => "Test ward",
    		40 => "Test street",
    		41 => "Test construction width",
    		42 => "Test construction length",
    		43 => "Test project group",
    		44 => "Test area width",
    		45 => "Test area length",
    		46 => "Test page title",
    		47 => "Test page description",
    		48 => "Test page keywords",
    		49 => "Test map lat",
    		50 => "Test map lng",
    	);
*/

defined('_JEXEC') or die('Restricted access');

$editor =& JFactory::getEditor();
$user		= & JFactory::getUser();
$usertype	= $user->get('usertype');
JHTML::stylesheet('jea.css', 'media/com_jea/css/');

if( $this->status == 0 )
{
	if ( !is_array($this->row) || empty($this->row) )
	{
	    echo JText::_('THIS_PROPERTY_DO_NOT_EXISTS_ANYMORE');
	    return;
	}
}
?>

<!--<script type="text/javascript" src="libraries/js/ham-tien-ich.js"></script>-->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<?php
if ( $this->status == 2 )
if ( is_array($this->row) && !empty($this->row) )
	{
?>
		<!-- dang tin o backend -->
		<div style='width:770px' >
		<form action="index.php?option=com_jea&controller=properties&cat=<?php echo $this->get('category') ?>" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data" >
<?php
	}
else
	{
	?>
		<!-- dang tin o fontend -->
		<form action="<?php echo JRoute::_('&task=save') ?>" method="post" name="jeaForm" id="jeaForm" enctype="multipart/form-data" onsubmit="return checkForm()" >
<?php
	}
?>

<?php
 if ( $this->status != 0)
{	
?>
		<!-- Cấu hình SEO + hiển thị  -->
		<span id='SEO_CONFIG'><?php echo JText::_('SEO_CONFIG') ; ?> </span>	
		<table>
			<tr>
				<td>
				<span id='SEO_PAGE_TITLE'><?php echo JText::_('SEO_PAGE_TITLE') ; ?></span>
				</td>
				
				<td>
					<input type='text' size='58' id='page_title' name='page_title' value='<?php echo  $this->row->page_title ?>' class='inputbox_seo' />
				</td>
			</tr>
			
			<tr>
				<td>
					<span id='SEO_PAGE_KEYWORDS'><?php 	echo JText::_('SEO_PAGE_KEYWORDS') ; ?></span>
				</td>
				<td>
					<input  type='text' size='58' id='page_keywords' name='page_keywords' value='<?php echo  $this->row->page_keywords ?>' class='inputbox_seo' />
				</td>
			</tr>

			<tr>
				<td>
					<span id='SEO_PAGE_DESCRIPTION'><?php 	echo JText::_('SEO_PAGE_DESCRIPTION') ; ?></span>
				</td>
				<td>
					<input type='text' size='58' id='page_description'  name='page_description' value='<?php echo  $this->row->page_description ?>' class='inputbox_seo' />
				</td>
			</tr>
			
	<?php
	echo "<tr><td>";
	// hien thi dang tin noi bat neu la admin
	if($usertype == "Super Administrator")
		{
		// tin noi bat
		
		?>
		<span id='EMPHASIS'><?php echo JText::_('EMPHASIS') ; ?> </span>
				</td>
				<td>
					<input type='checkbox' value='1' id='emphasis' name='emphasis' <?php echo $this->emphasisChecked ?> />
				</td>
			</tr>

			<tr>
				<td>
		<span id='NEWSEST'><?php	echo JText::_('NEWSEST') ; //tin moi nhat		?></span>
				</td>
				<td>
					<input type='checkbox' value='1' id='newsest' name='newsest' <?php echo  $this->newsestChecked ?> />
				</td>
			</tr>
	<?php
	}
	?>
	</table>
	<!-- end Cấu hình SEO + hiển thị -->
		<?php
		/* hien thi Published o dang tin admin */
		if ( $this->status == 2)
		{
		?>
			<br/>
			<span id='PUBLISHED'><?php echo JText::_('PUBLISHED') ?> </span>
		<?php
			echo $this->published;
		}
			echo "<hr>";
}
?>
<div class="bds1"><!--div big-->
	<div class="total"><!-- div chua title-->
        <div class="title_details">
	        <?php
	        if ( $this->status == 0)
	        {
	        	echo "<h1>".$this->row[1]."</h1>";
	        }
	        else
	        {
?>
				<table>
					<tr>
						<td style="width:70px">
						<span id='REF_SAVE'><?php echo JText::_('REF_SAVE').": "; ?></span>
						</td>
						
						<td>
							<input type='text'  size='70px' id='ref' name='ref' value='<?php echo $this->row->ref ?>' class='inputbox_seo' /> 
						</td>
					</tr>
				</table>
<?php
	        }
?>
        </div>
	</div>
		
   <div class="details">
        <div id="wrapper"><!--div chua phan google map-->
			<div id="content">
					<span onMouseDown="changeStatusTabMap('tab_image', 'tab_map')" id="tab_image" class="tab_active" title="first">
						<div id="title_real">
								<center><span id='PICTURE'><?php  echo JText::_('PICTURE'); ?></span></center>
						</div>
					</span>
					<?php
					if( $this->googlemapDisplay == '1')
					{
						if( $this->googlemapEnable == '1')
						{
					?>
							<span onMouseDown="changeStatusTabMap('tab_map', 'tab_image')" id='tab_map' class='tab_inactive'  title='first'>
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
							<center><span id='MAP'><?php  echo JText::_('MAP'); ?></span></center>
						</div>
						</span>
		
<?php
					}
?>
			<div class="boxholder"><!--boxholder-->
				
				<!-- box hien thi hinh anh -->
				<div class="box" >
					<?php
					if( $this->status == 0)
					{
					?>	
						<!-- anh chinh -->
						<!-- TODO: add SEO advance -->
						<img id="main_image" src="<?php echo $this->mainImage['preview_url'];?>" alt="" title="" />
					
						<?php if ( !empty( $this->secondariesImages ) ) {?>
						<div class="snd_imgs" >
							<!-- list sub images -->
							
							<!-- thumbnail of main image -->
							<img src="<?php echo $this->mainImage['min_url'];?>" 
								 alt="<?php  $this->mainImage['alt']; ?>"
								 title="<?php $this->mainImage['title'];?>" 
								 onclick="swapImage('main_image', '<?php echo $this->mainImage['preview_url'];?>')" 
							/>
							
							<?php
								$countSubImages = count( $this->secondariesImages );
								foreach( $this->secondariesImages as $subImage )
								{ 
							?>
									<img src="<?php echo $subImage['min_url'];?>" 
										 alt="<?php echo $subImage['alt']; ?>"
										 title="<?php echo $subImage['title'];?>" 
										 onclick="swapImage('main_image','<?php echo $subImage['preview_url'];?>')" 
									/>				
							<?php 
								} // end for
							?>
							
						</div>
						<?php } // end if secondary image?>
						<?php						
					 }
					else
					{
						?>
							<!-- anh chinh -->
						<div style="height:400px">
						<table>
							<tr>
								<td width="90px">
								<span id='MAIN_PROPERTY_PICTURE'><?php echo JText::_('MAIN_PROPERTY_PICTURE') ?></span>
								</td>
								
								<td>
									 <input type="file" id="main_image" name="main_image" value=""  size="30" />
								</td>
							</tr>
						</table>
								<?php echo $this->mainImageEdit ?>
									<br/>
							<!-- anh phu -->
						<input type="hidden" id="CountImage" name="CountImage" value='0' />
						<table id="tblUpload"">
							<tbody>
								<tr>
									<td width="90px">
										<span id='SECONDARIES'><?php echo JText::_('SECONDARIES') ?></span>
									</td>
									<td valign="top" colspan="2">
										<input name="secondaries_images0" type="file" id="secondaries_images0" class="SForm" style="width: 50;" size="30" onchange="javascript:UploadImg(this)" />
									</td>
								</tr>
							</tbody>
						</table>
						  <!-- hien thi edit anh phu -->
						  <?php echo $this->SecondariesImageEdit; ?>
						</div>
						<br/>
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
							<input type="button" onclick="onChangeAddress()" value="<?php echo JText::_('UPDATE_MAP');?>" />
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
 		<div class="info"><!--div chua info-->
					<div class="msts">
					<!--
                    <div style="HEIGHT: 60px" class="mstst">
					<img src="images/ico_chothue.gif" width="31" height="23"/>
                    </div>
					-->
					<?php
					if ( $this->status == 0)
					{
						echo  "<div class='mstsf'>";
						echo JText::_('PROPERTIES_UNIT').":";
						echo "<span>";
						//echo $this->row->id;
						echo $this->row[54];
						echo "</span>";
						echo "</div>";
					}
					else
					{
						echo "<span id='PROPERTIES_UNIT'>".JText::_('PROPERTIES_UNIT').":"."</span>";
						echo "<input type='text' id='properties_key'  name='properties_key' value='". $this->properties_key ."' class='inputbox_id'/>";
					}
					?>
					</div>
			
<?php
	if( $this->status != 0 )
	{
	?>
		<!--  loại tin rao -->
		<span id ='aj_kinds'><?php echo $this->kinds; ?> </span>
		<!--  // loai bds -->
		<span id ='aj_types'><?php echo $this->types; ?> </span>
		<!--  //vi tri -->
		<span id ='aj_position'><?php echo $this->position; ?> </span>
	<?php
	}
?>
      <h2>
<?php
		if ($this->status == 0)
		{
			// hien thi thong tin day du
			//echo $this->row->pro_total_info;
			echo $this->row[53];
		}
		else
		{			
				?>
				<span id='ADDRESS'><?php echo JText::_('ADDRESS');?></span>			
			<table>
				<tr>
					<td>
					<span id='ja_town'>	<?php echo $this->towns;// thanh pho ?> </span>
					</td>
					<td>
						<div id="innerTown" >
							<?php
							// quan huyen
							echo $this->areas;
							?>
						</div>
					</td>
				</tr>
			</table>
			<br/>
			     <span id='STREET'><?php  echo JText::_('STREET')?></span>
			       	<input type="text" id="address" name="address" value="<?php  echo $this->row->address ?>" class="inputbox_address" size="30" />
			         <td width="100%">
			         <br/>
				<span id='PRICE'><?php  echo JText::_('PRICE'); ?></span>:
            		<input  id="price" type="text" name="price" value="<?php echo $this->InsertPrice ?>" class="numberbox new2"  />
			 	
				<span id='aj_priceunit'> <?php echo  $this->PriceUnit; ?> </span>
				/
				<span id='aj_unit'> <?php echo $this->Unit;?></span>
				<?php
		}
 ?>
  	     </td>
     </h2>
                    <div class="bds2"><!--bds2-->
                            <div id="money">
                                   		<?php
                                   		if($this->status == 0)
                                   		{
											//echo $this->ShowAjax;
											echo $this->ajaxPaging;
                                   		}
                                   		
                                   		?>
                                <div style="clear:both">
                                </div>
                                <div class="dt"><!--price-->
	                                <span class="phong">
		                                <?php
		                                 if( $this->status == 0 )
                                        {
		                                echo JText::_('ROOM');
                                        }
		                                ?>
	                                </span>
<?php
						if( $this->status == 0 )
						{
?>

                           <div class="dtA">      <!--  thong tin-->
                                 <span title="Phòng Khách" class="phongkhach">
                                        <?php
										
                                       		echo JText::_('CLIEN_ROOM') . ':' . $this->row[19] ;
                                          
                                        ?>
                                        </span>
                                       <span title="Phòng Ngủ" class="phongngu">
                                        <?php
                                         if( $this->status == 0 )
                                        {
	                                        // bedroom
                                        	echo JText::_('BEDROOM') . ':' . $this->row[21];
	                                        
                                        }
                                        ?></span>
                                        <span title="Phòng Tắm / WC" class="phongtam">
                                        <?php
                                        if( $this->status == 0 )
                                        {
                                        	// bathroom
	                                        echo JText::_('BATHROOM') . ':' . $this->row[23] ;
                                        }
                                        ?></span>
                                      <span title="Phòng Khác" class="phongkhac">
                                        <?php
                                        if( $this->status == 0 )
                                        {
                                        	// cac phong khac
                                        	echo JText::_('ORTHER_ROOM') . ':' . $this->row[18];
                                        }
                                        ?></span>
			       				 </div><!-- thong tin-->

<?php
						}
                                        else
                                        {
		                                     
                                        	 echo "<div id='showRooms'></div>";
                                        }
?>

                              <span>
<div id="usearea">
                              <span id='aj_SITE_AREA'><?php  echo JText::_('SITE_AREA').':';?></span>
 <!-- </div>  -->
                                   
                                   <strong>
                                   <?php
                                   if ( $this->status == 0 )
                                   {
	                                   echo $this->areaInfoString;
                                   }
                                   else
                                   {
                                   	?>
                                   	          <td width="100%">
											   <?php echo JText::_('D');?>: <input id="kv_width" type="text" name="kv_width" value="<?php echo $this->row->kv_width ?>" class="numberbox area" size="7" onChange="getonchangvalue(this.value,'divkv_width','m',1)" />m X

<?php
echo JText::_('R');
?>:
<input id="kv_length" type="text" name="kv_length" value="<?php echo $this->row->kv_length ?>" class="numberbox area" size="7" onChange="getonchangvalue(this.value,'divkv_length','m',1)"/>m
</td>
                                   	<?php
                                   }
                                    ?>
                                    </strong>
  <br/>
<!-- <div id="usearea"> -->
                                  <span id='USE_AREA' ><?php echo JText::_('USE_AREA').':';?></span>
<!-- </div> -->

								<strong>
								  <?php
								  if( $this->status == 0 )
								  {
							      		echo $this->usedAreaInfoString; 
								  }
								  else
								  {
								  
								  	?>

								  	<input id="living_space" type="text" name="living_space" value="<?php echo $this->row->living_space ?>" class="numberbox livinguse" size="7" onChange="getonchangvalue(this.value,'divliving_space','m<sup>2',1)"/>m<sup>2</sup>

								  	<?php
								  }
								 ?>

								  </strong>
                               
                               <br/>
								<div id="usearea">
								    <span id='ajt_legal'><?php echo JText::_('LEGAL');?>:</span>
								</div>

								<strong>
								    <?php
									if( $this->status == 0 )
									{
									    //$id=$this->row->id;
									    	echo $this->legalStatusList;
									}
									else
									{
									?>
									<span id='aj_legal'><?php echo $this->Legal; ?></span>
									<?php
									}
								    ?>
								    </strong>
                                </span>
                                </div>
                                
                                <?php
                                if( $this->status == 0)
                                {
                                ?>
                                <div class="contact"><!-- thong tin lien hê-->
	                                <div class="contactT">
	                                 <?php echo JText::_('CONTACT');?>:
	                                </div>
	                                <div>
	                           			<?php if (!empty($this->row->realtor_link['profile']))
										{
										?>
		                                <div class="contactT" style="float:left;width:30%">
		                                	<a href="<?php echo $this->row->realtor_link['profile'];?>">
			                                	<img src="<?php echo $this->row->realtor_avatar;?>" width="75" height="75"></img>
			                                </a>
		                                </div>
		                                <?php 
										$width_percent = "68%";
										}
										else
										{
										$width_percent = "98%";
										}
										?>
		                                
		                                <div class="contactT" style="float:right;width:<?php echo $width_percent;?>;line-height:24px;">
			                                <?php
			                               if( empty ( $this->row->name_vl )
			                                  && empty( $this->row->phone_vl )
			                                  && empty( $this->row->address_vl ) )
			                               {
			                                echo JText::_('UPDATTING');			                              
			                               }
			                                else
											{
			                               ?>
			                                <div class="name">
			                                	<?php if ($this->row->has_realtor) {?>
			                                	<a href="<?php echo $this->row->realtor_link['profile'];?>">
			                               			<?php echo $this->row->name_vl; ?>
			                               		</a>
			                               		<?php } else {
			                               			echo $this->row->name_vl;
			                               		}
			                               		?>
			                                </div>
			                                <div class="phone">
			                                 <?php echo $this->row->phone_vl?>
			                                </div>
			                                <?php
			                                if ( !empty($this->row->realtor_link) && is_array( $this->row->realtor_link ) ) { ?>
			                                <div class="profile">
			                                	<!--  <a href="<?php echo $this->row->realtor_link['profile'];?>">
			                                		<?php echo JText::_('VIEW_PROFILE');?>
			                                	</a>

			                                	&nbsp;|&nbsp;-->

			                                </div>
			                                <div class="listing">
                          	<a href="<?php echo $this->row->realtor_link['listing'];?>">

			                                		<?php echo JText::_('VIEW_LISTING');?>
			                                	</a>
			                                </div>
		                                <?php } // if realtor link?>
		                                <?php } // end else?>
		                                </div>
	                                </div>
	                                
                                <div style="clear:both"></div>
                                
                                </div><!-- thong tin lien he-->
                                
                                <?php
                                }
                                else
                                {
								if ( $this->status == 2 )
								{
									// phan nha moi gioi
									?>
									<div id="usearea">
									   <?php
									   echo JText::_('REALTORS');
									   ?>:
									</div>
									<?php
										echo $this->realtors;
								}

								$user =& JFactory::getUser();
								if( $this->row->name_vl)
								{
									 $ten= $this->row->name_vl ;
									 $phone= $this->row->phone_vl ;
									
								}
								else
								{
									$ten=$user->name;
									$phone=$user->phone;
									
								}
?>
<div class="contact"><!-- thong tin lien hê-->
<div class="contactT">
	                            <span id='ajCONTACT'><?php echo JText::_('CONTACT_TITLE');?>:</span>
	                                </div>

<table>
	<tr>
		<td><span id='CONTACT_FULLNAME'><?php echo JText::_('CONTACT_FULLNAME');?>:</span></td>
		<td>
		<input type="text" id="name_vl"  name="name_vl" class="inputbox_contact" value="<?php echo $ten; ?>" /></td>
		</tr>
	<tr>
		<td><span id='CONTACT_ADDRESS'><?php echo JText::_('CONTACT_ADDRESS');?>:</span></td>
		<td><input type="text" id="address_vl"  name="address_vl" class="inputbox_contact" value="<?php echo $this->row->address_vl ?>"/></td>
		</tr>
	<tr>
		<td><span id='CONTACT_PHONE'><?php echo JText::_('CONTACT_PHONE');?>:</span></td>
		<td><input type="text" name="phone_vl" class="inputbox_contact" value="<?php echo $phone; ?>"/></td>
	</tr>
	<tr>

		<td><span id='CONTACT_NOTE'><?php echo JText::_('CONTACT_NOTE');?>:</span></td>
		
		<td>
		<textarea  id="ghichu" name="ghichu" rows="2" cols="5" class="inputbox_contact">
			<?php echo $this->row->ghichu  ?>
		</textarea>
		</td>
	</tr>
</table>
</div>

                                <?php
                                }
                                ?>
                                
                            </div>
                    </div><!--bds2-->
       </div><!--div chua info-->
     </div>  <!-- phan chua noi dung-->
   </div>  
    <div class="infodetail">
		<div id="box8content_title">
			<div>
					<h3>
						<div id="a"><span id='DETAIL_INFO'><?php echo JText::_('DETAIL_INFO');?></span>
						</div>
					</h3>
			</div>
		</div>
		<p class="space">
		         <?php
		         if( $this->status == 0)
		         {
		         	//echo $this->row->description;
		         	echo $this->row[26];
		         }
		         else
		         {
				 //hoan dang lam
		         	 // parameters : areaname, content, width, height, cols, rows, show buttons
				  echo $this->editor->display('description',  $this->row->description , '100%', '300', '75', '20', false ) ;
		         }
		         ?>
		    </p>
		    
            <div class="Structure">
            <div id="box8content_title">
				<div>
					<h3>
						<div id="a"><span id='STRUCTURE'><?php echo JText::_('STRUCTURE');?></span>
							</div>
					</h3>
				</div>
			</div>
		
			<div class="StructureC">
			<table width="100%" border="0" class="boderleft">
  			<tr>
			    <td  class="bg1">
				<span id='ajsTOTAL_AREA_USED'>
				<?php
				// TONG DIEN TICH SU DUNG PHAN HIEN THI O DUOI
				echo JText::_('TOTAL_AREA_USED');?>:
				</span>
				<strong>
				<?php
				if( $this->status == 0)
				{
					 echo $this->livingSpaceString;
				}
				else
				{
					echo "<span id='divliving_space'>_</span>";
				}
				?>
				</strong>
				</strong>
			    
			    </td>
    <td  class="bg1">
	    <span id='ajPROPERTIES_TYPE'><?php echo JText::_('PROPERTIES_TYPE');?>:</span>
	    <strong>
	    <?php
	    if ( $this->status == 0)
	    {
			//echo  $this->row->type ;
			echo $this->row[2];
	    }
		else
	    {
			echo "<span id='divtype'>_</span>";
	    }
	    ?>
	    </strong>
    </td>
    <td  class="bg1">
    <span id='ajsBEDROOM'><?php echo JText::_('BEDROOM');?>:</span>
    <strong>
    <?php
	if ( $this->status == 0)
	{
		echo $this->row[21];
	}
	else
	{
		echo "<span id='divroom'>_</span>";
	}
    
     ?></strong></td>
  </tr>
  <tr>
    <td class="bg2">
		<strong>
		<span id='ajDTKV'><?php echo JText::_('DTKV'); ?></span>
			:&nbsp;&nbsp;
		</strong>
		
		<span id='ajLENGTH'><?php echo JText::_('LENGTH'); ?>:</span>
		<strong>
		<?php
		if ($this->status == 0)
		{
			echo $this->row[18];
		}
		else
		{
			echo "<span id='divkv_length'>_</span>";
		}
		?>
		</strong>
 &nbsp;
<span id='ajWIDTH'> <?php echo JText::_('WIDTH'); ?></span>

<strong>
<?php
	if ( $this->status == 0)
	{
		echo $this->row[19];
	}
	else
	{
		echo "<span id='divkv_width'>_</span>";
	}
?>
</strong>
</td>
    <td class="bg2"><span id='ajt2_legal'><?php echo JText::_('LEGAL');?></span>: <strong>

 				<?php
 				if( $this->status == 0)
 				{
				    $id=$this->row->id;
				    if($this->legalstatusList =="")
				    {
				    	echo "_";
				    }
				    else
				    {
				    	echo $this->legalStatusList;
				    }
 				}
 				else
 				{
					echo "<span id='divlegalstatus'>_</span>";
 				}
 					
			    ?>
    </strong></td>
    <td class="bg2"><span id='ajsBATHROOM'><?php echo JText::_('BATHROOM');?></span>:  <strong>
    <?php
	if ( $this->status == 0)
	{
		
		// bathroom
		echo $this->row[21];
			
	}
	else
	{
		echo "<span id='divtoilets'>_</span>";
	}
    ?> </strong></td>
  </tr>
  <tr>
    <td  class="bg1"><strong>
    <span id='ajDTXD'><?php    echo JText::_('DTXD');?>:&nbsp;&nbsp;</span>
    </strong>
   <span id='ajxLENGTH'> <?php    echo JText::_('LENGTH');?></span>:
    <strong>
    <?php 
	if ( $this->status == 0 )
	{
		// chieu dai dien tich xay dung
		echo $this->row[44];
	}
	else
	{
		$livinglength = $this->row->xd_length;
	echo "<input  id=\"living_length\" type=\"text\" name=\"xd_length\" value=\"$livinglength\" class=\"numberbox area\" size=\"2\" />";
	}
    ?>
    </strong>
    &nbsp;
    <span id='ajxWIDTH'>  <?php    echo JText::_('WIDTH');  ?></span>:
    <strong>
    <?php
    if ( $this->status == 0 )
	{
		// chieu rong dien tich xay dung
		echo $this->row[43];
	}
	else
	{
		$livingwidth = $this->row->xd_width;
		echo "<input  id=\"livingwidth\" type=\"text\" name=\"xd_width\" value=\"$livingwidth\" class=\"numberbox area\" size=\"2\" />";
	}
      ?>
      </strong></td>
    <td  class="bg1"><span id='ajtDIRECTION'><?php echo JText::_('DIRECTION');?></span>: <strong><a href="#"><strong></strong></a><strong>
    <?php
    if ( $this->status == 0)
    {
    	// huong
	    echo $this->row[7];
    }
    else
    {
	?>
    	<span id='aj_directions'> <?php echo $this->directions; ?> </span>
    <?php
	}
    ?>
    </strong></strong></td>
    <td  class="bg1"><span id='ajsORTHER_ROOM'><?php echo JText::_('ORTHER_ROOM');?></span>: <strong><?php
	if ( $this->status == 0 )
	{
		// cac phong khac
		echo $this->row[18];
	}
	else
	{
		echo "<span id='divhighrooms'>_</span>";
	}
    ?>
    </strong></td>
  </tr>
</table>
                </div>
            </div>
            
            <?php
            if ( $this->status == 0 )
            {
	            if( !empty( $this->advantagesList ) )
	            {
		            ?>
				        <div class="Structure">
				            <div id="box8content_title">
									<div>
											<h3>
												<div id="a"><?php echo JText::_('ADVANTAGES');?>
												</div>
											</h3>
									</div>
							</div>
							
						 <div class="StructureC">
			             <table width="100%" border="0" class="boderleft">
							  <?php
							  echo $this->advantagesList;
							  ?>
			
						</table>
						</div>
						</div>
					
					<?php
           		}
            }
            else
            {
			?>
            <div id="box8content_title">
				<div>
					<h3>
						<div id="a">
							<span id="aj_ADVANTAGES"><?php echo JText::_('ADVANTAGES'); ?> </span>
						</div>
					</h3>
				</div>
			</div>
			<span id="ajbackend_ADVANTAGES"> <?php echo $this->Advantage; ?></span>
			<?php
            }
            
?>
       <div class="AddThis">
		       
       </div>
    </div>

<?php
if( $this->status == 0)
{
						
			if( !empty($this->sameProperties ) )
			{
			?>
			  <div class="Structure">
			            <div id="box8content_title">
			            <div>
			          
			          			<div>
			   								 <h3 >
			   								 <div  id="a" style="float:left; background: none;" >
			   								  	<?php  echo JText::_('REAL_ESTATE_RELATED');?>
											</div>
											<div class="right1" style="padding-top:6px;" >
											<?php 
												echo "Test paging";
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
							//echo $this->SamPro;
							//JeaViewProperties::GetBDSLienQuan();
							echo $this->sameProperties;
						?>
						</div>
			<?php
						}
			?>
			
			 <div class="AddThis">
			 
			            <div id="box8content_title">
													<div>
															<h3>
																<div id="a"><?php echo JText::_('SHARE');?>
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
         
   <?php
	} /* tat bds lien quan va chia se*/
	
   ?>
         </div>
<?php
if ( $this->status == 0)
{
	
}
else
{
	if( $this->status == 1 )
{
     echo "<hr>";
	//global $mainframe;
	//set the argument below to true if you need to show vertically( 3 cells one below the other)
	//$mainframe->triggerEvent('onShowOSOLCaptcha', array(false));
	
	$op=0;
	if( isset($user->approved) && $user->approved == "0" )
	{
		$op=1;
	}
	?>
	     <center>
		<span id ='ajSAVE_REVIEW'>
	 	 <input type="button" onclick="submitForm(<?php echo $op ?>,'1')" name="save_review" class="button1" value="<?php echo JText::_('SAVE_REVIEW') ?>" />
		</span>
		<span id ='ajSAVE_PUBLISHED'>
	     <input type="button" onclick="submitForm(<?php echo $op ?>,'2')" name="save_published" class="button1" value="<?php echo JText::_('SAVE_PUBLISHED') ?>" />
		</span>
		<span id ='ajSAVE_DRAFT'>
	     <input type="button" onclick="submitForm('0','3')" name="save_draft" class="button1" value="<?php echo JText::_('SAVE_DRAFT') ?>" />
		</span>
	     <input type="hidden" id="re_link" name="re_link"/>
	     <input type="hidden" id="published" name="published"/>
	     <input type="hidden" id="getKnowId" name="getKnowId"/>
	     </center>
	  </p>
	
<?php
}
}
?>
<!--  begin google map -->

<!-- map position -->
  <input id="map_lat" type="hidden" name="map_lat" value="<?php echo $this->row->map_lat;?>" />
  <input id="map_lng" type="hidden" name="map_lng" value="<?php echo $this->row->map_lng;?>" />
 <input id="pro_total_info" type="hidden" name="pro_total_info" value="3" />

  
  <style type="text/css">
            #map{width:447px;margin-top:5px;margin-left:5px;border:1px solid dashed;
                 height:330px;}
</style>


<script language="javascript" type="text/javascript">
<?php
if ( $this->status == 2 )
{
?>
	function submitbutton( pressbutton, section )
	{
		addinfo();
		var form = document.adminForm;
		if (pressbutton == 'apply' || pressbutton == 'save')
		{
			if ( form.ref.value == "" )
			{
				alert( "<?php echo JText::_('PROPERTY_MUST_HAVE_A_REFERENCE') ?>" );
				form.ref.focus();
				form.ref.style.borderColor="#FF0000";
				return;
			}
			else if ( form.type_id.value == "0" )
			{
				alert( "<?php echo JText::_('SELECT_A_TYPE_OF_PROPERTY') ?>" );
				form.type_id.focus();
				form.type_id.style.borderColor="#FF0000";
				return;
			}
			
			else if ( form.town_id.value =="0" )
			{
				
				alert( "<?php echo JText::_('SELECT_A_TOWN_OF_PROPERTY') ?>" );
				form.town_id.focus();
				form.town_id.style.borderColor="#FF0000";
				return;
			}
			else
			{
				addinfo();
			}
		}
		<?php echo $this->editor->save( 'description' ) ?>
		submitform(pressbutton);
		return;

	}

<?php
}
?>


</script>

<script language="javascript" type="text/javascript" src="libraries/js/mailBDS.js"></script>
<script type="text/javascript">
function init()
{
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
	 if ( $this->status == 0)
	{
	?>
		<script language="javascript">
		init();
		
		</script>
		<?php
	}
		?>
		
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
    innerHtml+="<td nowrap=\"nowrap\" class=\"label\"><label for=\"mainrooms\"><span id='ajCLIEN_ROOM'><?php echo JText::_('CLIEN_ROOM') ?></span>:</label>";
    innerHtml+="<select class='newroom' name ='mainrooms' onchange=getonchangvalue(this.value,'divmainrooms',\'\',1)> <?php   for($i=0;$i<=9;$i++)   	{   $selected="" ; if($this->row->mainrooms == $i){	$selected="selected"; }  echo "<option  $selected value=$i>$i</option>";  } 	?>	</select> ";
    innerHtml+="<label for=\"rooms\"><span id='ajBEDROOM'><?php echo JText::_('BEDROOM') ?><span>:</label>";
    innerHtml+="<select class='newroom' name ='rooms' onchange=getonchangvalue(this.value,'divroom',\'\',1) ><?php   for($i=0;$i<=9;$i++)   	{  $selected="" ; if($this->row->rooms == $i){	$selected="selected"; }   echo "<option $selected value=$i>$i</option>";  } 	?>	</select> ";
	  innerHtml+="<label for=\"rooms\"><span id='ajBATHROOM'><?php echo JText::_('BATHROOM') ?></span>:</label>";
	innerHtml+="<select class='newroom' name ='toilets' onchange=getonchangvalue(this.value,'divtoilets',\'\',1) ><?php   for($i=0;$i<=9;$i++)   	{  $selected="" ; if($this->row->toilets == $i){	$selected="selected"; }   echo "<option $selected value=$i>$i</option>";  } 	?>	</select> ";
    innerHtml+="<label for=\"toilets\"><span id='ajORTHER_ROOM'><?php echo JText::_('ORTHER_ROOM') ?></span>:</label> <select class='newroom' name ='highrooms' onchange=getonchangvalue(this.value,'divhighrooms',\'\',1) ><?php   for($i=0;$i<=9;$i++)   	{  $selected="" ; if($this->row->highrooms == $i){	$selected="selected"; }   echo "<option $selected value=$i>$i</option>";  } 	?>	</select>    	</td></tr></table>";
if(idType==1 || idType==2 || idType==3 || idType==4 || idType==5 || idType==15)
document.getElementById("showRooms").innerHTML=innerHtml;
else
document.getElementById("showRooms").innerHTML='';

document.getElementById("divroom").innerHTML= '_';
document.getElementById("divhighrooms").innerHTML= '_';
document.getElementById("divtoilets").innerHTML= '_';
}

<?php
if ( $this->status == 1 )
{
?>
	/* kiem tra 3 nut dang tin*/
	function submitForm(published,re_link)
	{
	// o fontend
		 var form = document.jeaForm;
			var ms="";
			var check=true;
			//addinfo();
			if ( form.ref.value == "" )
			{
				ms+= "<?php echo  JText::_('PROPERTY_MUST_HAVE_A_REFERENCE') ?>\n";
				form.ref.style.borderColor="#FF0000";
			 
				form.ref.focus();
				check= false;
			}

			if ( form.type_id.value == "0" ) {
				 ms+= "<?php echo  JText::_('SELECT_A_TYPE_OF_PROPERTY')?> \n";
				 form.type_id.style.borderColor="#FF0000";
				form.type_id.focus();
				check= false;
			}
			if ( form.town_id.value == "0" ) {
				 ms+= "<?php echo  JText::_('SELECT_A_TOWN_OF_PROPERTY') ?> \n";
				 form.town_id.style.borderColor="#FF0000";
				form.town_id.focus();
				check= false;
			}

			if(check==false)
			{
				alert(ms);
				return false;
			}
			else
			{
			addinfo();
			var form = document.forms['jeaForm'];
			form.published.value = published;
			form.re_link.value = re_link;
			form.submit();
			}
	}
<?php
}
?>
	</script>

<?php
if ( $this->status != 0 )
{
	if($this->row->type_id)
	{
	?>
		<script type="text/javascript" defer="defer" >
			jea_types_filter(<?=$this->row->type_id?>);
		</script>
	<?php
	}
}
?>

<?php
// o trang dang tin
if ($this->status != 0 )
{
?>
	
<?php
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
		document.getElementById("toolbar-save").className = "buttoname";
		document.getElementById("toolbar-apply").className = "buttoname";
		document.getElementById("toolbar-cancel").className = "buttoname";
	}
	</script>
	

	<input type="hidden" name="task" value="" />
	<input type="hidden" name="zip_code" value="084" />
	<input type="hidden" name="id" value="<?php echo $this->row->id ?>" />
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
	<input type="hidden" name="en_hidden_ref" id="en_hidden_ref" value=" " />
	<input type="hidden" name="en_hidden_address" id="en_hidden_address"  value=" " />
	<input type="hidden" name="en_hidden_description" id="en_hidden_description"  value=" " />
	<input type="hidden" name="en_hidden_name_vl" id="en_hidden_name_vl"  value=" " />
	<input type="hidden" name="en_hidden_address_vl"  id="en_hidden_address_vl" value=" " />
	<input type="hidden" name="en_hidden_ghichu" id="en_hidden_ghichu" value=" " />
	<input type="hidden" name="en_hidden_page_title" id="en_hidden_page_title" value=" " />
	<input type="hidden" name="en_hidden_page_keywords"  id="en_hidden_page_keywords" value=" " />
	<input type="hidden" name="en_hidden_page_description"  id="en_hidden_page_description"  value=" " />
	<input type="hidden" name="en_hidden_properties_key" id="en_hidden_properties_key"  value=" " />
	<input type="hidden" name="advantagesGetValue" id="advantagesGetValue"  value=" " />

<?php
}
?>
</form>

<!-- add javascript & init script -->
<?php if ( $this->status == 0 ) {?>
<script type="text/javascript" src="libraries/com_u_re/js/utils.js"></script>
<script language="javascript">
// init map
showMap( 'map_canvas', <?php echo $this->row[51] . "," . 
		 $this->row[52] . ",'" . $this->row[1] . "',16" ?>);
</script>
<?php }
else 
{
?>
<!--  load script admin -->
<script type="text/javascript" src="../libraries/com_u_re/js/admin_utils.js"></script>
<?php }?>
<?php
if ( $this->status == 2 )
{
?>
	<link rel="stylesheet" href="../templates/webkp/css/template.css" type="text/css" />
	<script type="text/javascript" src="../libraries/js/prototype.lite.js"></script>
	<script type="text/javascript" src="../libraries/js/moo.fx.js"></script>
	<script type="text/javascript" src="../libraries/js/moo.fx.pack.js"></script>
	<script type="text/javascript" src="../libraries/js/ham-tien-ich.js"></script>
<?php
}
?>