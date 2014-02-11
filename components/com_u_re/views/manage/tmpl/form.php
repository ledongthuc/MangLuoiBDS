<?php
echo "ddd";
exit; 
/**
 * This file is part of Joomla Estate Agency - Joomla! extension for real estate agency
 * 
 * @version     0.9 2009-10-14
 * @package     Jea.admin
 * @copyright   Copyright (C) 2008 PHILIP Sylvain. All rights reserved.
 * @license     GNU/GPL, see LICENSE.php
 * Joomla Estate Agency is free software. This version may have been modified pursuant to the
 * GNU General Public License, and as distributed it includes or is derivative
 * of works licensed under the GNU General Public License or other free or open
 * source software licenses.
 * 
 */
	
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ) ;

JHTML::stylesheet('jea.admin.css', 'media/com_jea/css/');

JHTML::_( 'behavior.calendar' );

JFilterOutput::objectHTMLSafe( $this->row );
$editor =& JFactory::getEditor();

$document=& JFactory::getDocument();
$document->addScriptDeclaration( '
function checkForm() {
    var form = document.jeaForm;
    var ms="";
	var check=true;
	
    if ( form.ref.value == "" ) {
        ms+= "' . JText::_('* Bạn chưa điền tiêu đề') . '\n";
        form.ref.style.borderColor="#FF0000";
     
        form.ref.focus();       	
        check= false;
    } 
	if ( form.kind_id.value == "" ) {
         ms+= "' . JText::_('') . '\n";            
        check= false;	
    }
	if ( form.type_id.value == "0" ) {
         ms+= "' . JText::_('* Bạn chưa chọn loại') . '\n";
         form.type_id.style.borderColor="#FF0000";
        form.type_id.focus(); 
        check= false;	
    }
	if ( form.town_id.value == "0" ) {
         ms+= "' . JText::_('* Bạn chưa chọn Tỉnh/Thành') . '\n";
         form.town_id.style.borderColor="#FF0000";
        form.town_id.focus(); 
        check= false;
    }
	if ( form.town_id.value == "0" ) {
         ms+= "' . JText::_('* Bạn chưa chọn Quận/Huyện') . '\n";
        form.town_id.style.borderColor="#FF0000";
        form.town_id.focus(); 
        check= false;
    }
    
//	if ( form.contact.value == "" ) {
//         ms+= "' . JText::_('* Bạn chưa điền phần Liên Hệ') . '\n";
//         form.contact.style.borderColor="#FF0000";
//        form.contact.focus(); 
//        check= false;
//    }
    
    
    if(check==false)
	{
		alert(ms);
		return false;
	}
    ' . $editor->save( 'description' ) .' 
    return true;
}');
    $user		= & JFactory::getUser();
$usertype	= $user->get('usertype');
?>

<script type="text/javascript" defer="defer">
var arrTopic= new Array();
// Hiển thị dropdownlist Topic ứng với catid
function HienThiTopic2(town_Id,checked,nameCbo,textCbo)
{
	//alert(nameCbo);
	var topic;
	var html = "<select  name='"+nameCbo+"' style=\"width:150px\">";
	html += "<option value='0'>"+textCbo+"</option>";
	for(i=0; i<arrTopic.length; i++)
	{
	topic = arrTopic[i];
	if(topic.town_id == town_Id)
		{
			if(topic.id==checked)
			html += "<option value='" + topic.id + "' selected=\"selected\">" + topic.text + "</option>" ;
			else
			html += "<option value='" + topic.id + "' >" + topic.text + "</option>" ;
		}
	}
	html += "</select>";
	return html;
}

//end hien thi tuong ung
function Topic(id, text, town_Id)
{ this.id = id;  this.text = text;  this.town_id = town_Id; }
function jea_change_form_plans(id,innerId,checked)
{ 
//alert(innerId);
// this creat dimetion for topics list
  <?php
//  	$sql = "SELECT * FROM #__jea_areas" ;
$sql = "SELECT * FROM #__jea_planchilds" ;
	$db = & JFactory::getDBO();
	$db->setQuery($sql);
	$result = $db->loadObjectList();

	if ( $db->getErrorNum() ) {
		JError::raiseWarning( 200, $db->getErrorMsg() );
	}
    $du_lieu = "arrTopic=[];";
	//$du_lieu = "";
	
    $i=0;
	foreach($result as $row)
    {		
		$id = $row->id;
		$text = $row->value;
		//$town_id = $row->town_id;
		$town_id = $row->plan_id;
		$du_lieu .= "\n arrTopic[$i] = new Topic($id, '$text', $town_id);";
		$i++;
    }
    echo $du_lieu;  
	?>
	document.getElementById(innerId).innerHTML = HienThiTopic2(id,checked,'plan_id','--Dự Án--');
}
function jea_change_form_towns(id,innerId,checked)
{ 
//alert(innerId);
// this creat dimetion for topics list
  <?php
  	$sql = "SELECT * FROM #__jea_areas ORDER BY ordering" ;
//$sql = "SELECT * FROM #__jea_planchilds" ;
	$db = & JFactory::getDBO();
	$db->setQuery($sql);
	$result = $db->loadObjectList();
	
	if ( $db->getErrorNum() ) {
		JError::raiseWarning( 200, $db->getErrorMsg() );
	}
    $du_lieu = "arrTopic=[];";
	//$du_lieu = "";
    $i=0;
	foreach($result as $row)
    {		
		$id = $row->id;
		$text = $row->value;
		$town_id = $row->town_id;
		//$town_id = $row->plan_id;
		$du_lieu .= "\n arrTopic[$i] = new Topic($id, '$text', $town_id);";
		$i++;
    }
    echo $du_lieu;  
	?>
	document.getElementById(innerId).innerHTML = HienThiTopic2(id,checked,'area_id','--Quận/Huyện--');
}
</script>

<?php 

$user = &JFactory::getUser();
	if ($user->id == 0) {
?>

<dl id="system-message">
<dt class="error">Lỗi</dt>
<dd class="error message fade">
	<ul>
		<li><?php echo JText::_( 'NEED_LOGIN' ) . " " . "<a href='index.php?option=com_user&task=register&Itemid=82'>" . JText::_( 'REGISTER_USER_LINK' ) . "</a>"; ?></li>
	</ul>
</dd>
</dl>
<?php  }?>

<h1><?php //echo $this->page_title 
echo JText::_('Add new property' ); ?></h1>
<!--hoan-->
<!--<form action="<?php echo $dd ?>" method="post" name="jeaForm" id="jeaForm" enctype="multipart/form-data" >-->
<!--<form action="<?php echo $dd  ?>" method="post" name="jeaForm" id="jeaForm" enctype="multipart/form-data" onsubmit="return checkForm()" >-->
<form action="<?php echo JRoute::_('&task=save') ?>" method="post" name="jeaForm" id="jeaForm" enctype="multipart/form-data" onsubmit="return checkForm()" >
 
  
 <div class="tin"><div class="dangtin"><?php echo JText::_('Thông tin cơ bản') ?></div>
      <table class="adminform" style="width:90%">
        <tr>
		<td width="8%" nowrap="nowrap" class="font-bold"><label for="is_renting"><?php echo JText::_('KIND') ?>: <font color="#FF0000"> * </font></label></td>
		<td colspan="3">	
		 <?php echo $this->getRadioList(); ?>	
		</td>
		</tr>
		
        <tr>
          <td nowrap="nowrap" class="font-bold"><label for="type_id"><?php echo JText::_('Property type') ?>: <font color="#FF0000"> * </font>  </label></td>
          <td><?php echo  $this->getHtmlList('types', $this->row->type_id,true) ?>     
          </td>    
<!--   hoan chua sua       -->
          <td width="8%" nowrap="nowrap" class="font-bold"><label for="type_id"><?php echo JText::_('Vị trí') ?>:</label></td>
         <td>
       		<?php
			$checked=$this->row->vitri;
		   echo $this->getVitri("Chọn vị trí",$checked);	  
		  	?>      
          </td>         
        </tr>
        
<!--  
        <tr>
          <td nowrap="nowrap"><label for="adress"><?php //echo JText::_('Adress') ?>:</label></td>
          <td width="100%" >
            <input id="adress" type="text" name="adress" value="<?php // echo $this->escape( $this->row->adress ) ?>" class="inputbox" size="70" />
          </td>
        </tr>    
  -->   
           <tr>
<!--    hoan chua sua       -->
 <td nowrap="nowrap" class="font-bold"><label for="type_id"><?php echo JText::_('Quốc gia') ?>:</label></td>
          <td >
          <select name="quocgia"  style="width:150px">
          <option>Việt Nam</option>
          </select>    
          </td>   
         
<!--         -->
          <td nowrap="nowrap" class="font-bold"><label for="zip_code"><?php echo JText::_('TOWN') ?>: <font color="#FF0000"> * </font></label></td>
          <td width="40%" >
              <span >  <!-- style="margin-left:25px" -->
              <?php echo $this->getHtmlList('towns', $this->row->town_id,false,false,true,'innerTown') ?>              </span>          </td>
        </tr>       
		<tr>
        <td nowrap="nowrap" class="font-bold"><?php echo JText::_('AREA') ?>: </td>
          <td width="44%">
          <div id="innerTown" >
           <select name="area_id" style="width:150px">
          <option value=\'0\'>- Quận/Huyện -</option>
          </select></div>
		</td>
		
<!-- hoan chua sua -->
<td nowrap="nowrap" class="font-bold"><?php echo JText::_('Phường / Xã') ?>:</td>
          <td width="40%">          
            <input id="adress" type="text" name="phuongxa" value="<?php  echo $this->escape( $this->row->phuongxa ) ?>" class="inputbox" size="24" />
		</td>
<!---->

        </tr>  
        <tr>
   <!-- hoan chua sua -->
<td nowrap="nowrap" class="font-bold"><?php echo JText::_('Đường / phố') ?>:</td>
          <td width="44%">
            <input id="adress" type="text" name="duongpho" value="<?php  echo $this->escape( $this->row->duongpho ) ?>" class="inputbox" size="24" />          
		</td>
        <td nowrap="nowrap" class="font-bold"><?php echo JText::_('DIRECTION') ?>:</td>
          <td width="40%">
          <?php echo $this->getHtmlList('directions', $this->row->direction_id) ?>          </td>
          
        </tr>
        <!--      
         <tr>
          <td nowrap="nowrap" class="font-bold"><?php //echo JText::_('Published') ?>: </td>
          <td><?php //echo JHTML::_('select.booleanlist',  'published' , 'class="inputbox"' , $this->row->published?$this->row->published:'1') ; ?></td>
        </tr>
		 <input type="hidden" name="published" value="<?php //echo $this->row->published?$this->row->published:'1' ?>" />
		-->
		 
        <tr >
		  <td nowrap="nowrap" class="font-bold"><label for="emphasis"><?php echo JText::_('Emphasis') ?>: </label></td>
		  <td width="44%" >
		  	<input type="checkbox" value="1" id="emphasis" name="emphasis"  <?php if ( $this->row->emphasis ) echo 'checked="checked"' ?> />
		  </td>
		  <td nowrap="nowrap" class="font-bold"><label for="Tin mới nhất"><?php echo JText::_('newsest') ?>: </label></td>
		  <td width="44%" >
		  	<input type="checkbox" value="1" id="newsest" name="newsest"  <?php if ( $this->row->newsest ) echo 'checked="checked"' ?> />
		  </td>
		</tr>
		 
		  <tr>
		  <td nowrap="nowrap" class="font-bold"><label for="emphasis"><?php echo JText::_('Pháp lý') ?>: </label></td>
		  <td width="44%" >
		   <?php
			(substr($this->row->legal_status,1,1)>0)?$checked=substr($this->row->legal_status,1,1):$checked=0;
		   echo $this->getLegal_StatusCheckBoxList("Chọn pháp lý",$checked);	  
		  	?>
		  </td>
		</tr>
		 </table>
		  </div>
		   <div class="tin"><div class="dangtin"><?php echo JText::_('Mô tả chi tiết tài sản') ?></div>
		 <table>			
		<tr>				  
		 <td nowrap="nowrap" class="font-bold"><label for="ref"><?php echo JText::_('Reference') ?>:  <font color="#FF0000"> * </font> </label></td>
          <td width="100%">
            <input id="ref" type="text" size="102" name="ref" value="<?php echo $this->escape( $this->row->ref ) ?>" class="inputbox" />
          </td>
		</tr>
        <tr>
          <td valign="top" colspan="2" class="font-bold"><?php echo JText::_('Description') ?>:</td>
        </tr>
        <tr>
          <td colspan="4" style="vertical-align:top">
          <?php
                // parameters : areaname, content, width, height, cols, rows, show buttons
                echo $editor->display( 'description',  $this->row->description , '100%', '300', '75', '20', false ) ;
          ?>
          
          </td>
        </tr>
      </table>
      </div>
      <div class="tin"><div class="dangtin"><?php echo JText::_('INFO_BDS') ?></div>
      <table>
      <!-- 
      <tr>
      <td nowrap="nowrap"><label for="project_group"><?php echo JText::_('Dự án') ?>: </label></td>
      <td>
       &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
       <?php $this->getProject_Group(); ?> 
      
      </td>
      </tr>
       -->
        <tr>
          <td nowrap="nowrap" class="label">
            <label for="price" ><?php echo JText::_('Giá');?>:</label>
          </td>
          <td width="100%">
             &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; <input  id="price" type="text" name="price" value="<?php 
             $tientien=$this->row->price;
			$selected2="";
			$selected3="";
			$selectedti="";
			$selectedtr="";
			if($this->row->price_unit==2)
			{
				$selected2="selected";
			}else if($this->row->price_unit==3)
			{
				$selected3="selected";
			}
             if($tientien/1000000000 >1)
             {
             	echo $tientien/1000000000;
             	$selectedti="selected";
             }
             else if($tientien/1000000 >1)
             {
             	echo $tientien/1000000;
             	$selectedtr="selected";
             }
             else
             {
             	echo $tientien;             	
             	$selected="selected";
             
             }
             
          
             ?>" class="numberbox new1"  /> 
 <?php $this->getTiente($selectedti,$selectedtr,$selected2,$selected3);echo " / "; $this->getDonVi(); ?>  	     
           
          </td>
      </tr>
          
		
        <tr>
          <td nowrap="nowrap" class="label">
            <label for="living_space"><?php echo JText::_('Diện tích sử dụng') ?>:</label>
          </td>
          <td width="100%">
		  <?php echo JText::_('Dài');?>:  <input  id="living_width" type="text" name="living_width" value="<?php echo $this->row->living_width ?>" class="numberbox new1" size="7" onChange="TinhTongDT(this.value,document.getElementById('living_length').value,'tongDT')" /> 
			<?php echo JText::_('Rộng');?>: <input  id="living_length" type="text" name="living_length" value="<?php echo $this->row->living_length ?>" class="numberbox new1" size="7" onChange="TinhTongDT(document.getElementById('living_width').value,this.value,'tongDT')" /> 
            <?php echo JText::_('Tổng DT');?>:<span id="tongDT"><input  id="living_space" type="text" name="living_space" value="<?php echo $this->row->living_space ?>" class="numberbox new1" size="7" /> </span>
            <?php echo $this->params->get('surface_measure', 'M&sup2;') ?> 
          
          </td>
		 
<!-- hoan chua sua		-->
 		 <tr>
		  <td nowrap="nowrap" class="label">
            <label for="living_space"><?php echo JText::_('Diện tích khuôn viên') ?>:</label>
          </td>
         
          <td width="100%">
		   <?php echo JText::_('Dài');?>: <input id="kv_width" type="text" name="kv_width" value="<?php echo $this->row->kv_width ?>" class="numberbox new1" size="7" onChange="TinhTongDT(this.value,document.getElementById('kv_length').value,'dtkv')" /> 
			<?php echo JText::_('Rộng');?>: <input id="kv_length" type="text" name="kv_length" value="<?php echo $this->row->kv_length ?>" class="numberbox new1" size="7" onChange="TinhTongDT(document.getElementById('kv_width').value,this.value,'dtkv')" /> 
<!--            Tổng DT:<span id="dtkv"><input id="dtkv_space" type="text" name="dtkv_space" value="<?php //echo $this->row->living_space ?>" class="numberbox" size="7" /> </span>-->
            <?php //echo $this->params->get('surface_measure', 'M&sup2;') ?>           
          </td>
         
		   </tr>
<!--		  -->
<!-- hoan chua sua	-->	
 		 <tr>
		  <td nowrap="nowrap" class="label">
            <label for="living_space"><?php echo JText::_('Diện tích xây dựng') ?>:</label>
          </td>
         
         <td width="100%">
		  <?php echo JText::_('Dài');?>: <input  id="living_width" type="text" name="xd_width" value="<?php echo $this->row->xd_width ?>" class="numberbox new1" size="7" onChange="TinhTongDT(this.value,document.getElementById('xd_length').value,'tongDT2')" /> 
		<?php echo JText::_('Rộng');?>: <input  id="living_length" type="text" name="xd_length" value="<?php echo $this->row->xd_length ?>" class="numberbox new1" size="7" onChange="TinhTongDT(document.getElementById('xd_width').value,this.value,'tongDT2')" /> 
<!--            Tổng DT:<span id="tongDT"><input id="living_space" type="text" name="living_space" value="<?php //echo $this->row->living_space ?>" class="numberbox" size="7" /> </span>-->
            <?php // echo $this->params->get('surface_measure', 'M&sup2;') ?> 
          </td>
         
		   </tr>
<!--		  --><!--

        
        
        <tr>
          <td nowrap="nowrap" class="label"><label for="contact"><?php //echo JText::_('Contact') ?> :</label></td>
          <td width="100%"><input id="contact" type="text" name="contact" value="<?php //echo $this->row->contact ?>" class="inputbox" size="70" /><font color="#FF0000"> * </font> </td>
        </tr>
            
    --></table>
    </div>
        <div id="showRooms"></div>
<!--        
    <?php $chuQuyen[0]=16;$chuQuyen[1]=17; ?>
     <fieldset><legend><?php //echo JText::_('Chủ Quyền') ?></legend>
    <?php //echo $this->getAdvantagesRadioList(true,$chuQuyen,true)?>
 
    </fieldset>
-->
    <div class="tin"><div class="dangtin"><?php echo JText::_('Thông tin tiện ích') ?></div>
   <div style="height:110px;"> <?php echo $this->getAdvantagesRadioList(true,$chuQuyen,false) ?></div>
    </div>
<!--    <div class="tin"><div class="dangtin"><?php echo JText::_('Giao thông đi lại') ?></div>-->
<!--    <div style="height:55px;"><?php echo $this->gettrafficmovement(true,$chuQuyen,false) ?></div>-->
<!--	</div>-->
     <div class="tin">
  <table width="100%" border="0">
  <tr>
<!--  hoan -->
    <td><div class="left"><span class="tieudienanh"><?php echo JText::_('Main property picture') ?></span></div>
      <div class="right"><input type="file" id="main_image" name="main_image" value=""  size="30" /><!-- <input class="button" type="button" value="<?php //echo JText::_('Send') ?>" onclick="if (checkForm()) this.form.submit()" /> -->
        </div>
		<?php 
		
		if ( is_file( JPATH_ROOT.DS.'images'.DS.'com_jea'.DS.'images'.DS.$this->row->id.DS.'min.jpg' ) ):
			/*if (!empty($this->main_image)) : */
		?>
		
        <fieldset style="margin-top:10px;">
            <img src="<?php echo $this->main_image['min_url'] ?>" alt="preview.jpg" title="<?php echo $this->main_image['width'].'X'.$this->main_image['height'].'px - '.$this->main_image['weight'].' ko' ?>" />
            <a href="<?php echo $this->main_image['delete_url'] ?>"><?php echo JText::_('Delete') ?></a>
    
        <?php endif ?>
  </fieldset>
  </td>
    <td> <div class="left"><span class="anhphu"><?php echo JText::_('SECONDARIES') ?></span></div>
     <div class="right"> <input type="file" name="second_image1" value=""  size="30"/> <!-- <input class="button" type="button" value="<?php //echo JText::_('Send') ?>" onclick="if (checkForm()) this.form.submit()" /> -->
         </div>   <?php foreach($this->secondaries_images1 as $image1) : ?>
            
        <fieldset style="margin-top:10px;">  
             <img src="<?php echo $image1['min_url'] ?>" alt="<?php echo $image1['name'] ?>" title="<?php echo $image1['width'].'X'.$image1['height'].'px - '.$image1['weight'].' ko' ?>" />
        <a href="<?php echo $image1['delete_url'] ?>"><?php echo JText::_('Delete') ?></a>        
         <?php endforeach ?>
        
        </td>
  </tr>
  <tr>
    <td>  
   <div class="left"> <span class="anhphu"><?php echo JText::_('SECONDARIES') ?></span></div>
     <div class="right"> <input type="file" name="second_image2" value=""  size="30"/> <!-- <input class="button" type="button" value="<?php //echo JText::_('Send') ?>" onclick="if (checkForm()) this.form.submit()" /> --></div>
                
        </td>
    <td> 
    <div class="left"><span class="anhphu"><?php echo JText::_('SECONDARIES') ?></span></div>
      <div class="right"><input type="file" name="second_image3" value=""  size="30"/> <!-- <input class="button" type="button" value="<?php //echo JText::_('Send') ?>" onclick="if (checkForm()) this.form.submit()" /> -->
           </div> 
      
        </td>
  </tr>
</table>
</div>
      </div>
  <div class="tin">
<div class="dangtin"><?php echo JText::_('Liên hệ với người đăng tin');?></div>
<div style="background:#EEECFF">
  <?php
  	$sql = "SELECT `introtext` FROM `#__content` WHERE `id` ='".$this->params->get('id_LienHe')."'" ;
	$db = & JFactory::getDBO();
	$db->setQuery($sql);
	$result = $db->loadObjectList();

	if ( $db->getErrorNum() ) {
		JError::raiseWarning( 200, $db->getErrorMsg() );
	}
	foreach($result as $row)
    {		
	echo $id = $row->introtext.'<br>';
    }
	$giatien=$this->params->get('gia_tien');
	?>
</div>

<?php 
$user =& JFactory::getUser();
if($this->escape( $this->row->name_vl))
{
	 $ten=$this->escape( $this->row->name_vl );
	 $phone= $this->escape( $this->row->phone_vl );
	
}
else
{
	$ten=$user->name;
	$phone=$user->phone;
	
}



?>
<div id="thanhtien">
<table>
<tr>
	<td><?php echo JText::_('Họ tên người đăng');?>:</td>
    <td>
    <input type="text" name="name_vl" size="58" class="inputbox" value="<?php echo $ten; ?>" id="ten";" /></td>
    </tr>
<tr>
    <td><?php echo JText::_('Địa chỉ');?>:</td>
    <td><input type="text" name="address_vl" size="58" class="inputbox" value="<?php echo $this->escape( $this->row->address_vl ) ?>"/></td>
    </tr>
<tr>
    <td><?php echo JText::_('Điện thoại');?>:</td>
    <td><input type="text" name="phone_vl" size="58" class="inputbox" value="<?php echo $phone; ?>"/></td>
</tr>
<tr>
    <td><?php echo JText::_('Ghi chú');?>: </td>
    
  <td>
    
<textarea name="ghichu" rows="5" cols="54" class="new111">
<?php echo $this->escape( $this->row->ghichu ) ?>
</textarea>
</td>
</tr>
</table>
</div>

</div>  
    <p style="margin-top:20px">
      <input type="hidden" name="id" value="<?php echo $this->row->id ?>" />
	  <input type="hidden" name="zip_code" value="084" />
      <?php echo JHTML::_( 'form.token' ) ?>
      <div style="height:110px; overflow:auto;">
      <?php
      
global $mainframe;
//set the argument below to true if you need to show vertically( 3 cells one below the other)
$mainframe->triggerEvent('onShowOSOLCaptcha', array(false));

$op=0;
if( isset($user->approved) && $user->approved == 0 )
{
	$op=1;
}
?> 
     <center> 
 	 <input type="button" onclick="submitForm(<?php echo $op ?>,'1')" name="save_review" class="button1" value="<?php echo JText::_('save_review') ?>" />
     <input type="button" onclick="submitForm(<?php echo $op ?>,'2')" name="save_published" class="button1" value="<?php echo JText::_('save_published') ?>" />
     <input type="button" onclick="submitForm('0','3')" name="save_draft" class="button1" value="<?php echo JText::_('save_draft') ?>" />
     <input type="hidden" id="re_link" name="re_link"/>
     <input type="hidden" id="published" name="published"/>
     <input type="hidden" id="getKnowId" name="getKnowId"/>
     </center>
<!--hoan-->
  </p>  
</form>
<?php
if($this->row->town_id == true && $this->row->area_id==true) { ?>
<script type="text/javascript" defer="defer">


	jea_change_form_towns('<?=$this->row->town_id?>','innerTown','<?=$this->row->area_id?>');
</script>
<?php } ?>

<!--<?php if($this->row->plan_parent_id == true && $this->row->plan_id==true) { ?>
		  <script type="text/javascript" defer="defer">
		 jea_change_form_plans('<?=$this->row->plan_parent_id?>','innerPlan','<?=$this->row->plan_id?>');
          </script>
<?php } 

?>
--><script type="text/javascript" defer="defer" >

function jea_types_filter(idType)
{
	var innerHtml="<table><tr>";
	var i=0;
	
    innerHtml+="<td nowrap=\"nowrap\" class=\"label\"><label for=\"mainrooms\"><?php echo JText::_('số phòng khách') ?>:</label>";
    innerHtml+="<select class='new1' name ='mainrooms' style='width:100px'><?php   for($i=0;$i<=10;$i++)   	{    echo "<option value=$i>$i</option>";  } 	?>	</select> ";  		
    innerHtml+="<label for=\"rooms\"><?php echo JText::_('Number of rooms') ?>:</label>";
    innerHtml+="<select class='new1' name ='rooms' style='width:100px'><?php   for($i=0;$i<=10;$i++)   	{    echo "<option value=$i>$i</option>";  } 	?>	</select> ";
    innerHtml+="<label for=\"toilets\"><?php echo JText::_('NUMBER OF BATHROOMS') ?>:</label></td><td width=\"100%\">       <select class='new1' name ='toilets' style='width:100px'><?php   for($i=0;$i<=10;$i++)   	{    echo "<option value=$i>$i</option>";  } 	?>	</select>    	</td></tr></table>";
if(idType==1 || idType==2 || idType==3 || idType==4 || idType==5 || idType==15) 
document.getElementById("showRooms").innerHTML=innerHtml;	
else
document.getElementById("showRooms").innerHTML='';	
}  


function submitForm(published,re_link)
{

	/* neu chua dang nhap thi strUsername se bang NULL */
	/* strusernamavalue bang NUll thi se return ==> ko co luu */
	var strUsernameValue = '<?php echo $user->username; ?>';	
	if	(	strUsernameValue == '' )
	{
		alert('<?php echo JText::_('Login Messenger Save') ?>');
		return;
	}	

	 var form = document.jeaForm;
	    var ms="";
		var check=true;
		
	    if ( form.ref.value == "" ) {
	        ms+= " <?php echo  JText::_('* Bạn chưa điền tiêu đề') ?>\n";
	        form.ref.style.borderColor="#FF0000";
	     
	        form.ref.focus();       	
	        check= false;
	    } 
//		if ( form.kind_id.value == "" ) {
//	         ms+= " <?php //echo JText::_('* Loại bất động sản') ?> \n";            
//	        check= false;	
//	    }
		if ( form.type_id.value == "0" ) {
	         ms+= "<?php echo  JText::_('* Bạn chưa chọn loại')?> \n";
	         form.type_id.style.borderColor="#FF0000";
	        form.type_id.focus(); 
	        check= false;	
	    }
		if ( form.town_id.value == "0" ) {
	         ms+= " <?php echo  JText::_('* Bạn chưa chọn Tỉnh/Thành') ?> \n";
	         form.town_id.style.borderColor="#FF0000";
	        form.town_id.focus(); 
	        check= false;
	    }
//		if ( form.town_id.value == "0" ) {
//	         ms+= " <?php echo  JText::_('* Bạn chưa chọn Quận/Huyện')?>\n";
//	        form.town_id.style.borderColor="#FF0000";
//	        form.town_id.focus(); 
//	        check= false;
//	    }
	    if(check==false)
		{
			alert(ms);
			return false;
		}
	    else
	    {
		var form = document.forms['jeaForm'];
		form.published.value = published;
		form.re_link.value = re_link;
//		form.getKnowId.value = getKnowId;
		form.submit();
	    }
}

</script>
<?php
if($this->row->type_id)
{?>	
<script type="text/javascript" defer="defer" >
jea_types_filter(<?=$this->row->type_id?>);
</script>
<?php }

?>

