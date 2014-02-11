<?php 
/**
 * This file is part of Joomla Estate Agency - Joomla! extension for real estate agency
 * 
 * @version     0.9 2009-10-14
 * @package		Jea.admin
 * @copyright	Copyright (C) 2008 PHILIP Sylvain. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla Estate Agency is free software. This version may have been modified pursuant to the
 * GNU General Public License, and as distributed it includes or is derivative
 * of works licensed under the GNU General Public License or other free or open
 * source software licenses.
 * 
 */

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
		  	<input id="name" type="text" size="70" name="name" value="<?php echo $this->escape( $this->row->name ) ?>" class="inputbox" />
		  </td>
		</tr>
        
		<tr>
		  <td nowrap="nowrap"><label for="adress"><?php echo JText::_('Address') ?> :</label></td>
		  <td width="100%" >
		  	<input id="address" type="text" name="address" value="<?php echo $this->escape( $this->row->address ) ?>" class="inputbox" size="70" />
		  </td>		  
		</tr>		
<!--		hoan dang lam-->
		<tr>
		  <td nowrap="nowrap"><label for="phone"><?php echo JText::_('phone') ?> :</label></td>
		  <td width="100%" >
		  	<input id="phone" type="text" name="phone" value="<?php echo $this->escape( $this->row->phone ) ?>" class="inputbox" size="70" />
		  </td>		  
		</tr>
		
		<tr>
		  <td nowrap="nowrap"><label for="email"><?php echo JText::_('email') ?> :</label></td>
		  <td width="100%" >
		  	<input id="email" type="text" name="email" value="<?php echo $this->escape( $this->row->email ) ?>" class="inputbox" size="70" />
		  </td>		  
		</tr>
		
		<tr>
		  <td nowrap="nowrap"><label for="slogan"><?php echo JText::_('slogan') ?> :</label></td>
		  <td width="100%" >
		  	<input id="slogan" type="text" name="slogan" value="<?php echo $this->escape( $this->row->slogan ) ?>" class="inputbox" size="70" />
		  </td>		  
		</tr>
		
		<tr>
		  <td nowrap="nowrap"><label for="website"><?php echo JText::_('website') ?> :</label></td>
		  <td width="100%" >
		  	<input id="website" type="text" name="website" value="<?php echo $this->escape( $this->row->website ) ?>" class="inputbox" size="70" />
		  </td>		  
		</tr>
		
		<tr>
		  <td nowrap="nowrap"><label for="employee_type"><?php echo JText::_('employee_type') ?> :</label></td>
		  <td width="100%" >
		  	<input id="employee_type" type="text" name="employee_type" value="<?php echo $this->escape( $this->row->employee_type ) ?>" class="inputbox" size="70" />
		  </td>		  
		</tr>
		
		<tr>
		  <td nowrap="nowrap"><label for="adress"><?php echo JText::_('Operational_range') ?> :</label></td>
		  <td width="100%" >
		  	<input id="address" type="text" name="operational_range" value="<?php echo $this->escape( $this->row->operational_range ) ?>" class="inputbox" size="70" />
		  </td>
		</tr>			
		<tr>
		
		  <td nowrap="nowrap"><?php echo JText::_('Published') ?> : </td>
		  <td><?php echo JHTML::_('select.booleanlist',  'published' , 'class="inputbox"' , $this->row->published ) ; ?></td>
		</tr>
		
		<tr>
		
		<td colspan="2">
		  <fieldset><legend style="font-size:11px"><?php echo JText::_('Avatar') ?></legend>
			  <input type="file" name="image" value=""  size="30"/> 
				<?php if (!empty($this->image)) : ?>
				<fieldset style="margin-top:10px;">
				
					<img src="<?php echo $this->image['name'] ?>" >
					<a href="<?php echo $this->image['delete_url'] ?>"><?php echo JText::_('Delete') ?></a>
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
				echo $editor->display( 'description',  $this->row->description , '100%', '400', '75', '20', false ) ;
		  ?>
		  
		  </td>
		</tr>
		
</table>
  </td>
  
  </tr>
  </table>
  <input type="hidden" name="task" value="" />
  <input type="hidden" name="zip_code" value="084" />
  <input type="hidden" name="id" value="<?php echo $this->row->id ?>" />
  <?php echo JHTML::_( 'form.token' ) ?>
</form>

<?php
if($this->row->town_id == true && $this->row->area_id==true){?>
<script type="text/javascript" defer="defer">
jea_change_form_towns('<?=$this->row->town_id?>','view_area_dangtin','<?=$this->row->area_id?>');
</script>
<?php } ?>	

