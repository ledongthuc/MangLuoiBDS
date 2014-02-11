<?php // no direct access
defined('_JEXEC') or die('Restricted access');
JHTML::stylesheet('jea.css', 'media/com_jea/css/');

if(!$this->row->id){
    echo JText::_('This property doesn\'t exists anymore');
    return;
}

?>

<p class="pagenavigation">
  <?php //echo $this->getPrevNextItems( $this->row->id ) ?>
</p>
<font size="4px" class="title_prj"><?php echo $this->row->value?></font>
{magictabs}
<?php  echo JText::_('Tổng quan')  ?>::
 <table width="99%"  style="font-weight:normal;font-size:12px;color: rgb(68, 68, 68); border: 1px solid rgb(204, 204, 204);">
  <tr>
    <td rowspan="13" valign="top" width="1%"><table width="100%">
      <tr>
        <td style="padding-right:5px;">
		 <?php
        $img = is_file(JPATH_ROOT.DS.'images'.DS.'com_jea'.DS.'images'.DS."Plan_".$this->row->id.DS.'min.jpg');
        $img2 = is_file(JPATH_ROOT.DS.'images'.DS.'com_jea'.DS.'images'.DS."Plan_".$this->row->id.DS.'preview.jpg') ;
        if(  $img !=1 || $img2 !=1 )
        {
        ?>
         <div> <img id="img_preview" src="images/NoImage.jpg" alt="preview.jpg"  /> </div>
        <?php 
        }
        else
        {
        ?>
	 	 <div> <img id="img_preview" src="<?php echo $this->main_image['preview_url'] ?>" alt="preview.jpg"  /> </div>
         <?php }?>
        </td>
      </tr>
      <tr>
        <td>
         <?php if( !empty($this->secondaries_images)): ?>
		<div class="snd_imgs2" >
		<?php 
 		if(  $img !=1 || $img2 !=1 )
        {
        ?>
         <img id="img_preview" src="images/NoImage.jpg" style="height:70px;width:70px" alt="preview.jpg"  />
        <?php 
        }
        else
        {
        ?>
	 	 <img src="<?php echo $this->main_image['min_url'] ?>" alt="<?php echo $this->main_image['name'] ?>" title="<?php echo JText::_('Enlarge')?>" onclick="swapImage('<?php echo $this->main_image['preview_url'] ?>')" />
        <?php }?>	 	  
	<?php foreach($this->secondaries_images as $image) : ?>
      <img src="<?php echo $image['min_url'] ?>"  alt="<?php echo $image['name'] ?>" 
	  title="<?php echo JText::_('Enlarge')?>" onclick="swapImage('<?php echo $image['preview_url'] ?>')" /> 
    <?php endforeach ?>
</div>
<?php endif ?>
        </td>
      </tr>
    </table></td>
<!--    <td height="23" colspan="2"><?php echo $this->row->value?></td>-->
  </tr>
  <tr>
    <td><?php  echo JText::_('ADRESS')  ?></td>
    <td><strong><?php echo $this->row->address?></strong></td>
  </tr>
  <tr>
    <td width="120px"><?php  echo JText::_('loaihinh')  ?></td>
    <td>
    <strong><?php echo  $this->loaihinh ?></strong>
    </td>
  </tr>

  <tr>
    <td><?php  echo JText::_('ngaykhoicong')  ?></td>
    <td><strong><?php if (!empty($this->row->start_date)) echo date("d-m-Y", strtotime($this->row->start_date))?></strong></td>
  </tr>
  <tr>
    <td><?php  echo JText::_('ngayhoanthanh')  ?></td>
    <td><strong><?php if (!empty($this->row->end_date)) echo date("d-m-Y", strtotime($this->row->end_date))?></strong></td>
  </tr> 
   <tr>
    <td><?php  echo JText::_('chudautu')  ?></td>
    <td><strong><?php echo $this->row->investor?></strong></td>
  </tr>
 
  <tr>
  
   
    <td colspan="2">
    <?php 
    if($this->row->contactname != "" || $this->row->contactaddress !="" || $this->row->contactphone )
    {
    ?>
    
     <div class="contact">
	                                <div class="contactT">	             
	                                 <?php echo JText::_('hotline');?>:    
	                                </div>
		                                <div class="contactT" style="padding-left:30px">
                               		<?php 	echo $this->row->contactname;
                               		
                               		 	echo "<br/>";
                               		 	    echo $this->row->contactaddress;
    echo "<br/>";
    echo "<font size='6px' color='red'>".$this->row->contactphone."</font>";
                               		 	?>
									   
                               		
                               			 </div>
       </div>
                                
     <?php
    }
    ?>
    </td>
  </tr>
 
</table>
<br />
<div style="width:99%;border:1px solid #ececec">
<div id="box8content_title">
<div>
<h3>
<div id="a">
<?php  echo JText::_('gioithieu')  ?>
</div>
</h3>
</div>
</div>
<div class="content_proj"><?php echo $this->row->desc?></div>
</div>


|||| 
 <?php  echo JText::_('bandovitri')  ?> ::
 <?php echo $this->row->plane_area ?>
 |||| 
 <?php  echo JText::_('sodomatbang')  ?> ::
 <?php echo $this->row->plane_diagram ?>
 ||||
  <?php  echo JText::_('tiendo')  ?>::
 <?php echo $this->row->progress ?>
 ||||
 <?php  echo JText::_('doitac')  ?> ::
 <?php echo $this->row->doitac ?>
  ||||
 <?php  echo JText::_('thanhtoan')  ?> ::
 <?php echo $this->row->thanhtoan ?>
   ||||
  <?php  echo JText::_('lienhe')  ?>::
 <?php echo $this->row->contacts ?>
{/magictabs}
 

<p><a href="javascript:window.history.back()" class="jea_return_link" ><?php echo JText::_('Back')?></a></p>

<!-- Chau add: list other projects and same investor projects -->
<table width="100%">
	<tr>
	<?php 
	if(count($this->listOther) > 0)
	{
	?>
		<td valign="top" style="padding-left:5px;">
			<table>
			<!-- list other projects -->
		 	<th class='moduletable'><?php  echo JText::_('cacduanlienquan')  ?></th>			
				<?php
					foreach($this->listOther as $otherProj)
					{
					?>
						<tr> <td valign='top' class='item'><img  style='padding-right:3px' src='modules/mod_jea_search/tmpl/arrow.gif'>
					  			<span onmouseover="showttip( '<?php echo htmlentities($otherProj->project_spec, ENT_QUOTES, 'UTF-8'); ?>', 400);" onmouseout="hidettip();"/>
					  				<a href="<?php echo $otherProj->link; ?>"><?php echo $otherProj->value; ?></a>
					  			</span>
					  		</td>
					  	</tr>
					<?php }
				?>
			</table>

	 	</td>
	<?php 
	}
	?>
	 		<?php 
	if(count($this->listSameInvestor) > 0)
	{
	?>
	 <!--	 same investor projects -->
	 	<td valign="top" style="padding-left:20px;">
	 		<table>
		 	<!-- list same investor projects -->
		 	<th class='moduletable'><?php  echo JText::_('cacduancungchudautu')  ?></th>			
				<?php
					foreach($this->listSameInvestor as $sameProj)
					{
					?>
						<tr> <td valign='top' class='item'><img  style='padding-right:3px' src='modules/mod_jea_search/tmpl/arrow.gif'>
					  		<span onmouseover="showttip( '<?php echo $sameProj->project_spec ?>', 340);" onmouseout="hidettip();"/><a href="<?php echo $sameProj->link ?>"><?php echo $sameProj->value; ?></a>
					  	</td></tr>
					<?php }
				?>
			</table>	 	
	 	</td>
	 		<?php 
	}
	?>
	</tr>
	
</table>
<!-- end add -->