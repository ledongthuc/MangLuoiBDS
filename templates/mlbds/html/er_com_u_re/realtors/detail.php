<?php 
//echo "vao toi realtor 66666";
//exit;

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ) ;

JFilterOutput::objectHTMLSafe( $this->row, ENT_QUOTES, array('ref', 'adress') );
JHTML::_( 'behavior.calendar' );

jimport( 'joomla.html.pane' );
$pane =& JPane::getInstance('sliders');
$editor =& JFactory::getEditor();

JHTML::stylesheet('jea.admin.css', 'media/com_jea/css/');
?>
<form action="index.php?option=com_jea&controller=realtors" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data" >
  
  <table cellspacing="0" cellpadding="0" border="0" width="100%" id="jea-edit" >
  <tr>
  <td valign="top">
	  <table class="adminform">
		<tr>
		  <td nowrap="nowrap"><label for="name"><?php echo JText::_('Name') ?> : </label></td>
		  <td width="100%">
		  	<input id="name" type="text" size="70" name="ten" value="<?php echo $this->escape( $this->row['ten'] ) ?>" class="inputbox" />
		  </td>
		</tr>
        
		<tr>
		  <td nowrap="nowrap"><label for="adress"><?php echo JText::_('Address') ?> :</label></td>
		  <td width="100%" >
		  	<input id="address" type="text" name="dia_chi" value="<?php echo $this->escape( $this->row['dia_chi'] ) ?>" class="inputbox" size="70" />
		  </td>		  
		</tr>		
<!--		hoan dang lam-->
		<tr>
		  <td nowrap="nowrap"><label for="phone"><?php echo JText::_('phone') ?> :</label></td>
		  <td width="100%" >
		  	<input id="phone" type="text" name="dien_thoai" value="<?php echo $this->escape( $this->row['dien_thoai'] ) ?>" class="inputbox" size="70" />
		  </td>		  
		</tr>
		
		<tr>
		  <td nowrap="nowrap"><label for="email"><?php echo JText::_('email') ?> :</label></td>
		  <td width="100%" >
		  	<input id="email" type="text" name="email" value="<?php echo $this->escape( $this->row['email'] ) ?>" class="inputbox" size="70" />
		  </td>		  
		</tr>
		
		<tr>
		  <td nowrap="nowrap"><label for="slogan"><?php echo JText::_('slogan') ?> :</label></td>
		  <td width="100%" >
		  	<input id="slogan" type="text" name="khau_hieu" value="<?php echo $this->escape( $this->row['khau_hieu'] ) ?>" class="inputbox" size="70" />
		  </td>		  
		</tr>
		
		<tr>
		  <td nowrap="nowrap"><label for="website"><?php echo JText::_('website') ?> :</label></td>
		  <td width="100%" >
		  	<input id="website" type="text" name="website" value="<?php echo $this->escape( $this->row['website'] ) ?>" class="inputbox" size="70" />
		  </td>		  
		</tr>
		
		<tr>
		  <td nowrap="nowrap"><label for="employee_type"><?php echo JText::_('employee_type') ?> :</label></td>
		  <td width="100%" >
		  	<input id="employee_type" type="text" name="loai_nhan_vien" value="<?php echo $this->escape( $this->row['loai_nhan_vien'] ) ?>" class="inputbox" size="70" />
		  </td>		  
		</tr>
		
		<tr>
		  <td nowrap="nowrap"><label for="adress"><?php echo JText::_('Operational_range') ?> :</label></td>
		  <td width="100%" >
		  	<input id="address" type="text" name="pham_vi_hoat_dong" value="<?php echo $this->escape( $this->row['pham_vi_hoat_dong'] ) ?>" class="inputbox" size="70" />
		  </td>
		</tr>			
		<tr>
		
		  <td nowrap="nowrap"><?php echo JText::_('Published') ?> : </td>
		  <td><?php echo JHTML::_('select.booleanlist',  'published' , 'class="inputbox"' , $this->row['hien_thi_ra_ngoai'] ) ; ?></td>
		</tr>
		
		<tr>
		
		<td colspan="2">
		  <fieldset><legend style="font-size:11px"><?php echo JText::_('Avatar') ?></legend>
			  <input type="file" name="image" value=""  size="30"/> 
			  
				<?php if ( is_file($this->image['isfile'])) : ?>
				<fieldset style="margin-top:10px;">
					<img src="<?php echo $this->image['thumbnail'] ?>" >
					<a href="<?php echo $this->image['xoa'] ?>">
					<?php echo JText::_('Delete') ?></a>
				</fieldset>
				<?php endif ?>
				
				
		  </fieldset>
		  </td>
		</tr>
		
		<tr>
		  <td valign="top" colspan="2"><?php echo JText::_('Introduction') ?> :</td>
		</tr>
		
		<tr>
		  <td colspan="2" style="vertical-align:top">
		  <?php
				// parameters : areaname, content, width, height, cols, rows, show buttons
				echo $editor->display( 'mo_ta',  $this->row['mo_ta'] , '100%', '400', '75', '20', false ) ;
		  ?>
		  
		  </td>
		</tr>
		
</table>
  </td>
  
  </tr>
  </table>
  <input type="hidden" name="task" value="" />
  <input type="hidden" name="zip_code" value="084" />
  <input type="hidden" name="id" value="<?php echo $this->row['id'] ?>" />
  <?php echo JHTML::_( 'form.token' ) ?>
</form>


