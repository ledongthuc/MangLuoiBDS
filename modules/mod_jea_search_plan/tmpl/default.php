<?php // no direct access
defined('_JEXEC') or die('Restricted access');

$use_ajax = $params->get('use_ajax', 0);
$styleBds = $params->get('styleBds');
$document =& JFactory::getDocument();
$document->addStyleDeclaration("
	#jea_search_form select {
		width:8em;
	}");
$colorLink=$params->get( 'colorLink' );
$colorText=$params->get( 'colorText' );
?>

<div style=' <?php if($colorText) echo "color:$colorText;"  ?> ' >
<form action="index.php?option=com_jea&amp;task=search" method="post" id="jea_search_form" name="fSearch" enctype="application/x-www-form-urlencoded" >
<span style="color:#FF6633;font-weight:bold">TÌM KIẾM DỰ ÁN</span>
<?php if($params->get( 'styleSearch' )=='simple') : ?>	
	<?php echo getHtmlList('#__jea_towns', 'Tỉnh/Thành Phố', 'town_id',true ) ?>
     <span id="view_area"> <select name="area_id"><option value="0">Quận/Huyện</option></select></span>
    <?php echo getHtmlList('#__jea_project_group', 'Loại Dự Án', '1') ?>
    <input type="text" value="Nội dung tìm kiếm" name="key" onclick="this.value=''"/>
	<input type="submit" class="button" value="<?php echo JText::_('Search') ?>" />
	<input type="hidden" name="Itemid" value="<?php echo JRequest::getInt('Itemid', 0) ?>" />
    <?php echo JHTML::_( 'form.token' ) // Do not remove this ?>
<?php elseif($params->get( 'styleSearch' )=='advance') : ?>	
	 <p>
	<label for="loai_dia_oc"><?php echo JText::_('LoaiDiaOc') ?></label><br>
	<?php 
	if($styleBds=='list')
	echo getHtmlCheckBox('#__jea_types',$colorLink); 
	else
	echo getHtmlList('#__jea_types', '-- Tất cả --', 'type_id' );
	?>
	<hr>
	</p>  
   	<p>
	<?php //echo getHtmlList('#__jea_types', '--'.JText::_( 'Property type' ).'--', 'type_id' ) ?>
	<?php //echo getHtmlList('#__jea_departments', '--'.JText::_( 'Department' ).'--', 'department_id' ) ?>
  	<?php //echo getHtmlList('#__jea_towns', '--'.JText::_( 'Town' ).'--', 'town_id' ) ?>
	
  	</p>  
<?php //endif ?>

 <p>
	<label for="loai_bds"><?php echo JText::_('LoaiBatDongSan') ?></label><br />
	<input type="radio" name="cat" id="selling" value="selling"  <?php echo $use_ajax ? 'onclick="refreshForm()"' : '' ?> />
    <label for="selling"><a style="color:<?=$colorLink?> !important" href=# onclick="SetValues('fSearch','cat',true,'0')"><?php echo JText::_('Selling') ?></a></label><br>
    <input type="radio" name="cat" id="renting" value="renting"  <?php echo $use_ajax ? 'onclick="refreshForm()"' : '' ?> />
    <label for="renting"><a style="color:<?=$colorLink?> !important" href=# onclick="SetValues('fSearch','cat',true,'1')"><?php echo JText::_('Renting') ?></a></label><br>   
	<input type="radio" name="cat" id="needbuying" value="needbuying"  <?php echo $use_ajax ? 'onclick="refreshForm()"' : '' ?> />	
	<label for="needbuying"><a style="color:<?=$colorLink?> !important" href=# onclick="SetValues('fSearch','cat',true,'2')"><?php echo JText::_('Buying') ?></a></label><br>	
    <input type="radio" name="cat" id="needrenting" value="needrenting" <?php echo $use_ajax ? 'onclick="refreshForm()"' : '' ?> />
    <label for="needrenting"><a style="color:<?=$colorLink?> !important" href=# onclick="SetValues('fSearch','cat',true,'3')"><?php echo JText::_('Cần Thuê') ?></a></label><br>
	
	
	<input type="radio" name="cat" id="all" value="all" checked="checked" <?php echo $use_ajax ? 'onclick="refreshForm()"' : '' ?> />
    <label for="all"><a style="color:<?=$colorLink?> !important" href=# onclick="SetValues('fSearch','cat',true,'4')"><?php echo JText::_('All') ?></a></label>
	<hr>
    </p>  
	
	<p>
	<label for="tinh_thanh"><?php echo JText::_('Town') ?></label><br>
	<?php echo getHtmlList('#__jea_towns', '--Tất Cả--', 'town_id',true ) ?>
	</p>
	
 	 <p>
 	<label for="quan_huyen"><?php echo JText::_('Area') ?></label><br>
	<?php //echo getHtmlList('#__jea_areas', '--Tất Cả--', 'area_id' ) ?> 
	
    <span id="view_area"> <select name="area_id"><option value="0">--Tất Cả--</option></select></span>
    
	</p>   
    
	<hr>
	<p>
	<label for="gia"><?php echo JText::_('gia') ?></label><br>
	<table>
	<tr><td><?php echo JText::_('gia_tu') ?></td><td ><input type="text" id="gia_tu" name="gia_tu" size="15"/></td></tr>
	<tr><td><?php echo JText::_('gia_den') ?></td><td ><input type="text" id="gia_den" name="gia_den" size="15" /></td></tr>
	</table>
	<br />
	
	</p>
	<hr>  
  	<p align="center"><input type="submit" class="button" value="<?php echo JText::_('Search') ?>" />
    <input type="hidden" name="Itemid" value="<?php echo JRequest::getInt('Itemid', 0) ?>" />
    <?php echo JHTML::_( 'form.token' ) // Do not remove this ?>
    </p>
<?php elseif($params->get( 'styleSearch' )=='list_area') : ?>
<?php
$town_id=$params->get('town_id');
$colCount=$params->get('col_area');

$sql="SELECT * FROM jos_jea_areas WHERE town_id IN ($town_id) ORDER BY id";
$db=JFactory::getDBO();
$db->setQuery($sql);
$listArea=$db->loadObjectList();
?>
<table style="font-size:<?=$params->get( 'fontSize' )?>;">
<?php
$listAreaCount = count($listArea);
for($i=0;$i<$listAreaCount;$i++): 
//$value=
?>
    <tr>
        <?php for($j=0;$j<$colCount;$j++): 
			if (!empty($listArea[$i+$j])){
				$value=str_replace('Quận','Q.',$listArea[$i+$j]->value);
				$value=str_replace('quận','Q.',$value);
				$value=str_replace('Huyện','H.',$value);
				$value=str_replace('huyện','H.',$value);
			} else {
				break;
			}	
		?>
            <td style="padding: 0;"><img src="modules/mod_jea_search/tmpl/arrow.gif" /><a href="index.php?option=com_jea&task=search&area_id=<?php echo $listArea[$i+$j]->id;?>" >
            <?php echo $value;?>
            </a></td>
        <?php endfor ;$i+=$colCount-1?>
    </tr>
   <?php endfor ?>
</table>
<?php else: ?>
<b>    Tìm kiếm bất động sản </b>
    <table>
    <tr>
    	<td align="left"><?php echo JText::_('LoaiBatDongSan') ?></td>
        <td align="left"><select name="cat" class="inputbox" class="jea_search_form select">
	
		<option value="all">Tất cả</option>
		<option value="selling">Cần bán</option>
		<option value="renting">Cho thuê</option>
		<option value="needbuying">Cần mua</option>
		<option value="needrenting">cần thuê</option>	
	</select></td>
        <td align="left"><?php echo JText::_('Town') ?></td>
        <td><?php echo getHtmlList('#__jea_towns', '--Tất Cả--', 'town_id',true ) ?></td>
    </tr>
    <tr>
        <td align="left"><?php echo JText::_('LoaiDiaOc') ?></td>
        <td align="left"><?php echo getHtmlList('#__jea_types', 'Tất Cả', 'type_id') ?></td>
        <td align="left"><?php echo JText::_('Area') ?></td>
        <td align="left"><span id="view_area"> <select name="area_id"><option value="0">--Tất Cả--</option></select></span></td>
    </tr>
    <tr>
    	<td align="left">Giá <?php for($i=0;$i<15;$i++) echo "&nbsp;"; ?>Từ:</td>
        <td align="left"><input type="text" name="gia_tu" size="12"/></td>
        <td align="left">Đến:</td>
        <td align="left"><input type="text"  name="gia_den" size="12" /></td>
    </tr>
     <tr>
    	<td align="left">Diện Tích<?php for($i=0;$i<5;$i++) echo "&nbsp;"; ?>Từ:</td>
        <td align="left"><input type="text"  name="dientich_tu" size="12"/></td>
        <td align="left">Đến:</td>
        <td align="left"><input type="text"  name="dientich_den" size="12" /></td>
    </tr>
    <tr>
    	<td align="left">Từ Khóa</td>
        <td align="left"><input type="text"  name="key_search" size="12"/></td>
        <td colspan="2" align="left"><input type="submit" class="button" value="<?php echo JText::_('Search') ?>"  style="width: 90px"/>
        <input type="hidden" name="Itemid" value="<?php echo JRequest::getInt('Itemid', 0) ?>" />
	    <?php echo JHTML::_( 'form.token' ) // Do not remove this ?>
        </td>
    </tr>
    </table>
    <?php endif ?>
</form>
</div>
<script type="text/javascript" defer="defer">
var arrTopic= new Array();
// Hiển thị dropdownlist Topic ứng với catid
function HienThiTopic(town_Id)
{
var topic;
var html = "<select  name='area_id'>";
html += "<option value='0'>--Tất Cả--</option>";
for(i=0; i<arrTopic.length; i++)
{
topic = arrTopic[i];
if(topic.town_id == town_Id)
	{
		html += "<option value='" + topic.id + "'>" + topic.text + "</option>" ;
	}
}
html += "</select>";
return html;
}
//end hien thi tuong ung
function Topic(id, text, town_Id)
{ this.id = id;  this.text = text;  this.town_id = town_Id; }
function town_change(id)
{ 


// this creat dimetion for topics list

  <?php
  	$sql = "SELECT * FROM #__jea_areas" ;
	$db = & JFactory::getDBO();
	$db->setQuery($sql);
	$result = $db->loadObjectList();

	if ( $db->getErrorNum() ) {
		JError::raiseWarning( 200, $db->getErrorMsg() );
	}
    $du_lieu = "";
    $i=0;
	foreach($result as $row)
    {		
	$id = $row->id;
    $text = $row->value;
    $town_id = $row->town_id;
    $du_lieu .= "\n arrTopic[$i] = new Topic($id, '$text', $town_id);";
    $i++;
    }
    echo $du_lieu;  
	?>
	document.getElementById("view_area").innerHTML = HienThiTopic(id);
}
	
</script>
