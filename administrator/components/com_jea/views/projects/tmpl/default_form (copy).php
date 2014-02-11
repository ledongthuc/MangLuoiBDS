

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

<script language="javascript" type="text/javascript">

function submitbutton( pressbutton, section ) {
	var form = document.adminForm;
	if (pressbutton == 'apply' || pressbutton == 'save') {
		
		if ( form.value.value == "" ) {
			alert( "<?php echo JText::_('Plan must have a name') ?>" );
			return;
		} //else if ( form.project_group_ids.length == "0" ) {
			//alert( "<?php echo JText::_('Select a group of plan') ?>" );
			//return;
		//}
	}
	
	<?php echo $editor->save( 'description' ) ?>
	submitform(pressbutton);
	return;
}

</script>
<script type="text/javascript" defer="defer">
var arrTopic= new Array();
// Hiển thị dropdownlist Topic ứng với catid
function HienThiTopic(parent_Id,checked,textCbo,nameCbo)
{
	var topic;
	var html = "<select  name='"+nameCbo+"'>";
	html += "<option value='0'>"+textCbo+"</option>";
	//alert('id checked: '+checked);
	for(i=0; i<arrTopic.length; i++)
	{
		topic = arrTopic[i];
		if(topic.parent_id == parent_Id)
			{
				if(topic.id==checked)
				{
				html += "<option value='" + topic.id + "' selected=\"selected\">" + topic.text + "</option>" ;
				}
				else
				html += "<option value='" + topic.id + "' >" + topic.text + "</option>" ;
			}
	}
	html += "</select>";
	return html;
}
//end hien thi tuong ung

function Topic(id, text, parent_Id)
{ this.id = id;  this.text = text;  this.parent_id = parent_Id; }

function jea_change_form_plans(id,idInner,checked)
{ 

  <?php
    $sql = "SELECT * FROM #__jea_planchilds" ;
	$db = & JFactory::getDBO();
	$db->setQuery($sql);
	$result = $db->loadObjectList();

	if ( $db->getErrorNum() ) {
		JError::raiseWarning( 200, $db->getErrorMsg() );
	}
    $du_lieu = " arrTopic=[]; ";
    $i=0;
	foreach($result as $row)
    {		
		$id = $row->id;
		$text = $row->value;
		$parent_id = $row->plan_id;
		$du_lieu .= "\n arrTopic[$i] = new Topic($id, '$text', $parent_id);";
		$i++;
    }
    echo $du_lieu;  
	?>
//	alert('checked plan'+checked);
	document.getElementById(idInner).innerHTML = HienThiTopic(id,checked,'--Dự Án--','plan_id');
}
function jea_change_form_towns(id,idInner,checked)
{ 
//alert('id checked:'+checked);
//alert(idInner);
  <?php
    $sql = "SELECT * FROM #__jea_areas" ;
	$db = & JFactory::getDBO();
	$db->setQuery($sql);
	$result = $db->loadObjectList();

	if ( $db->getErrorNum() ) {
		JError::raiseWarning( 200, $db->getErrorMsg() );
	}
   $du_lieu = " arrTopic=[]; ";
    $i=0;
	foreach($result as $row)
    {		
		$id = $row->id;
		$text = $row->value;
		$parent_id = $row->town_id;
		$du_lieu .= "\n arrTopic[$i] = new Topic($id, '$text', $parent_id);";
		$i++;
    }
    echo $du_lieu;  
	?>
	document.getElementById(idInner).innerHTML = HienThiTopic(id,checked,'--Quận/Huyện--','area_id');
}

</script>
<form action="index.php?option=com_jea&controller=projects" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data" >
  
  <table cellspacing="0" cellpadding="0" border="0" width="100%" id="jea-edit" >
  <tr>
  <td valign="top">
	  <table class="adminform">
	
		<tr>
		  <td nowrap="nowrap"><label for="ref"><?php echo JText::_('Reference') ?> : </label></td>
		  <td>
		  	<input id="value" type="text" size="87" name="value" value="<?php echo $this->escape( $this->row->value ) ?>" class="inputbox" />
		<tr>
		  <td nowrap="nowrap"><label for="adress"><?php echo JText::_('Address') ?> :</label></td>
		  <td>
		  	<input id="address" type="text" name="address" value="<?php echo $this->escape( $this->row->address ) ?>" class="inputbox" size="87" />
		  </td>
		</tr>
		<tr>
		  <td nowrap="nowrap"><label for="type_id"><?php echo JText::_('Project Group') ?> :</label></td>
		  <td>
		  <div style="width: 500px" >
		  <?php echo  $this->getCheckBoxProjectGroupList() ?>
		  </div>
		  </td>
		</tr>
		  <tr>
    	<td><label for="investor"><?php echo JText::_('Investor') ?> : </label></td>
        <td><input id="investor" size="87" type="text" name="investor" value="<?php echo $this->escape( $this->row->investor ) ?>" class="inputbox" size="50" /></td>
    	</tr>  
    	<tr>
		<td>
		<label for="start_date"><?php echo JText::_('Start date') ?> : </label></td>
			<td><input type="text" class="text_area" size="87" id="start_date" name="start_date" value="<?php echo  $this->row->start_date ?>" />
			</td>
		</tr>	
	    <tr>
	    <td>
		<label for="end_date"><?php echo JText::_('End date') ?> : </label></td>
			<td><input type="text" class="text_area" size="87" id="end_date" name="end_date" value="<?php echo  $this->row->end_date ?>" />
			</td>
		</tr>	
		
    	 <tr>
		  <td nowrap="nowrap"><label for="contactname"><?php echo JText::_('CONTACTNAME') ?> : </label></td>
		 <td>
		  	<input id="contactname" type="text" size="87" name="contactname" value="<?php echo $this->escape( $this->row->contactname ) ?>" class="inputbox" />
		  </td>	 
		  </tr>
		  
		   <tr>
		  <td nowrap="nowrap"><label for="contactaddress"><?php echo JText::_('contactaddress') ?> : </label></td>
		 <td>
		  	<input id="contactaddress" type="text" size="87" name="contactaddress" value="<?php echo $this->escape( $this->row->contactaddress ) ?>" class="inputbox" />
		  </td>	 
		  </tr>
		  
		   <tr>
		  <td nowrap="nowrap"><label for="contactphone"><?php echo JText::_('contactphone') ?> : </label></td>
		 <td>
		  	<input id="contactphone" type="text" size="87" name="contactphone" value="<?php echo $this->escape( $this->row->contactphone ) ?>" class="inputbox" />
		  </td>	 
		  </tr>
		  <tr>
		  <td nowrap="nowrap"><label for="emphasis"><?php echo JText::_('EMPHASISPROJ') ?> : </label></td>
		  <td>
		  	<input type="checkbox" value="1" id="emphasis" name="emphasis"  <?php if ( $this->row->emphasis ) echo 'checked="checked"' ?> />
		  </td>		 
		  </tr>
		  
		   <tr>
		   <td nowrap="nowrap" class="font-bold"><label for="Tin mới nhất"><?php echo JText::_('duanmoinhat') ?>: </label></td>
		   <td nowrap="nowrap" class="font-bold">
		  	<input type="checkbox" value="1" id="newsest" name="newsest"  <?php if ( $this->row->newsest ) echo 'checked="checked"' ?> />
		  </td>
		</tr>
		<tr>
		
		</tr>
		<tr>
		  <td nowrap="nowrap"><?php echo JText::_('Published') ?> : </td>
		  <td><?php echo JHTML::_('select.booleanlist',  'published' , 'class="inputbox"' , $this->row->published ) ; ?></td>		  	  	   
		</tr>
	
		<!--	mô tả ngắn	-->
		<tr>
		  <td valign="top" colspan="4"><?php echo JText::_('Short description') ?> :</td>
		</tr>
		<tr>
		  <td colspan="4" style="vertical-align:top">	  
		  <?php echo $editor->display( 'short_desc',  $this->row->short_desc , '100%', '400', '75', '20', false ) ; ?>
		  </td>
		</tr>
		
		<tr>
		  <td valign="top" colspan="4"><?php echo JText::_('Description') ?> :</td>
		</tr>
		<tr>
		  <td colspan="4" style="vertical-align:top">
		  <?php
				// parameters : areaname, content, width, height, cols, rows, show buttons
				echo $editor->display( 'desc',  $this->row->desc , '100%', '400', '75', '20', false ) ;
		  ?>
		  
		  </td>
		</tr>




	
	
	
		
		
	  </table>
  </td>
  
  <td valign="top" width="330" nowrap="nowrap" style="padding: 7px 0 0 5px" >
  <?php echo $pane->startPane("content-pane") ?>
  
  <?php echo $pane->startPanel( JText::_('Specifications') , "params-pane" ) ?>
    <table width="100%">	
		 <tr>
	    <th colspan="2" style="text" ><?php echo JText::_('Pictures') ?></th>
	  </tr>
	  
<!-- hinh anh ne -->
<tr>
	  <td colspan="2">
	  <fieldset><legend style="font-size:11px"><?php echo JText::_('Main property picture') ?></legend>
		  <input type="file" name="main_image" value=""  size="30"/> <input class="button" type="button" value="<?php echo JText::_('Send') ?>" onclick="submitbutton('apply')" />
			<?php if (!empty($this->main_image)) : ?>
			<fieldset style="margin-top:10px;">
				<img src="<?php echo $this->main_image['min_url'] ?>" alt="preview.jpg" title="<?php echo $this->main_image['width'].'X'.$this->main_image['height'].'px - '.$this->main_image['weight'].' ko' ?>" />
				<a href="<?php echo $this->main_image['delete_url'] ?>"><?php echo JText::_('Delete') ?></a>
			</fieldset>
			<?php endif ?>
	  </fieldset>
	  <fieldset><legend style="font-size:11px"><?php echo JText::_('Secondaries property pictures') ?></legend>
		  <input type="file" name="second_image" value=""  size="30"/> <input class="button" type="button" value="<?php echo JText::_('Send') ?>" onclick="submitbutton('apply')" />
		  <div style="height:200px; overflow:auto;">
		  <?php foreach($this->secondaries_images as $image) : ?>
			<fieldset style="margin-top:10px;">
			<img src="<?php echo $image['min_url'] ?>" alt="<?php echo $image['name'] ?>" title="<?php echo $image['width'].'X'.$image['height'].'px - '.$image['weight'].' ko' ?>" />
			<a href="<?php echo $image['delete_url'] ?>"><?php echo JText::_('Delete') ?></a>
			</fieldset>
		  <?php endforeach ?>
		  </div>
	  </fieldset>
	  
	  </td>
	</tr>
<!-- ket thuc hinh anh -->	  
	   <tr>
	    <th colspan="2" style="text" ><?php echo JText::_('SEO Config') ?></th>
	  </tr>
	  <tr>
		 <td nowrap="nowrap"><label for="page_title"><?php echo JText::_('page_title') ?> :</label></td>
			<td>
			  <input id="page_title" type="text" size="58" name="page_title" value="<?php echo $this->escape( $this->row->page_title ) ?>" class="inputbox" />
	  		</td>
	  </tr>
	  <tr>
		 <td nowrap="nowrap"><label for="page_keywords"><?php echo JText::_('page_keywords') ?> :</label></td>
			<td>
			  <input id="page_keywords" type="text" size="58" name="page_keywords" value="<?php echo $this->escape( $this->row->page_keywords ) ?>" class="inputbox" />
	  		</td>
	  </tr>
	  <tr>
		 <td nowrap="nowrap"><label for="page_description"><?php echo JText::_('page_description') ?> :</label></td>
			<td>
			  <input id="page_description" type="text" size="58" name="page_description" value="<?php echo $this->escape( $this->row->page_description ) ?>" class="inputbox" />
	  		</td>
	  </tr>
  </table> 
  <?php echo  $pane->endPanel() ?>  
  <?php echo $pane->endPane() ?>
  </td>
  
  </tr>
  </table>







{magictabs}
<?php  echo JText::_('Tổng quan')  ?>::
 <table width="99%"  style="font-weight:normal;font-size:12px;color: rgb(68, 68, 68); border: 1px solid rgb(204, 204, 204);">
  <tr>
    <td rowspan="13" valign="top" width="1%"><table width="100%">
      <tr>
        <td style="padding-right:5px;">
		 <?php
        $img = is_file('/var/www/html/X4/Source/'.DS.'images'.DS.'com_jea'.DS.'images'.DS."Plan_31".DS.'min.jpg');
        $img2 = is_file('/var/www/html/X4/Source/'.DS.'images'.DS.'com_jea'.DS.'images'.DS."Plan_31".DS.'preview.jpg') ;
//print_r(JPATH_ROOT);
        if(  $img !=1 || $img2 !=1 )
        {
        ?>
         <div> <img id="img_preview" src="images/NoImage.jpg" alt="preview.jpg"  /> </div>
        <?php 
        }
        else
        {
        ?>
	 	 <div> 
<img id="img_preview" src="../images/com_jea/images/Plan_31/preview.jpg" alt="preview.jpg"  />

</div>
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
    <strong><?php echo  'this->loaihinh' ?></strong>
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
 <?php  echo JText::_('plane_area')  ?> ::
<?php
// ban do vi tri
echo $editor->display( 'plane_area',  $this->row->plane_area , '100%', '400', '75', '20', false ); 
?>
|||| 
 <?php  echo JText::_('plane_diagram')  ?> ::
<?php
// so do mat bang
echo $editor->display( 'plane_diagram',  $this->row->plane_diagram , '100%', '400', '75', '20', false ) ;
?>
 ||||
  <?php  echo JText::_('progress')  ?>::
<?php
// tien do
echo $editor->display( 'progress',  $this->row->progress , '100%', '400', '75', '20', false ) ;
?>
 ||||
 <?php  echo JText::_('doitac')  ?> ::
<?php
// doi tac
echo $editor->display( 'doitac',  $this->row->doitac , '100%', '400', '75', '20', false ) ;
?>
  ||||
 <?php  echo JText::_('thanhtoan')  ?> ::
<?php
//thanh toan
echo $editor->display( 'thanhtoan',  $this->row->thanhtoan , '100%', '400', '75', '20', false ) ;
?>
   ||||
  <?php  echo JText::_('contacts')  ?>::
<?php
// lien he
	echo $editor->display( 'contacts',  $this->row->contacts , '100%', '400', '75', '20', false ) ;
?>

{/magictabs}
 




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


