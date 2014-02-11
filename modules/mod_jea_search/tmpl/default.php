
<?php // no direct access
defined('_JEXEC') or die('Restricted access');

$use_ajax = $params->get('use_ajax', 0);
$styleBds = $params->get('styleBds');
$document =& JFactory::getDocument();
$document->addStyleDeclaration("
	#jea_search_form select {
		width:14em;
		height:20px;
		margin-left:23px;
		margin-top:5px;
	}");
$colorLink=$params->get( 'colorLink' );
$colorText=$params->get( 'colorText' );

$searchFor=$params->get( 'searchFor' );
$textAll = JText::_('ALL');

// Get price title and price value from admin config
	$priceTitleStr = $params->get("priceTitles");
	$priceValueStr = $params->get("priceValues");

?>

<script>
// gia bao gom gia_tu, gia_den
function selectPrice(gia)
{
	// parse gia
	var gia_arr = gia.split(";");
	var gia_tu = gia_arr[0];
	var gia_den = gia_arr[1];
	
	var formSearch = document.forms["jea_search_form"];

	formSearch["gia_tu"].value = gia_tu;
	formSearch["gia_den"].value = gia_den;
}
</script>

<div  class="jea_search" style=' <?php if($colorText) echo "color:$colorText;"  ?> ' >
<form action="index.php?option=com_jea&task=search&Itemid=45" method="post" id="jea_search_form" name="fSearch" enctype="application/x-www-form-urlencoded" >
<?php  if($searchFor=='plan'): ?>
	<?php echo getHtmlList('#__jea_towns', 'Tỉnh/Thành Phố', 'town_id',true ) ?>
     <span id="view_area"> <select name="area_id"><option value="0">--Tất Cả--</option></select></span>
    <?php echo getHtmlList('#__jea_project_group', 'Loại Dự Án','projectGroup', '1') ?>
    <input type="text" value="Nội dung tìm kiếm" name="key_search" onclick="this.value=''"/>
	<input type="submit" class="button" value="<?php echo JText::_('Search') ?>" />
	<input type="hidden" name="Itemid" value="<?php echo JRequest::getInt('Itemid', 0) ?>" />
    <?php echo JHTML::_( 'form.token' ) // Do not remove this ?>	
<?php else : ?>
	<?php if($params->get( 'styleSearch' )=='simple') : ?>	
            <?php echo getHtmlList('#__jea_types', 'Nhu Cầu', 'type_id') ?>
        <select name="cat" class="inputbox">
            <option value="all">Danh Mục</option>
            <option value="all">Tất cả</option>
            <option value="selling">Cần bán</option>
            <option value="renting">Cho thuê</option>
            <option value="needbuying">Cần mua</option>
            <option value="needrenting">cần thuê</option>	
        </select>
        <?php echo getHtmlList('#__jea_towns', 'Địa Phương', 'town_id' ) ?>
        <input type="submit" class="button" value="<?php echo JText::_('Search') ?>" />
        <input type="hidden" name="Itemid" value="<?php echo JRequest::getInt('Itemid', 0) ?>" />
        
        <?php echo JHTML::_( 'form.token' ) // Do not remove this ?>
    <?php elseif($params->get( 'styleSearch' )=='advance') : ?>	
    <!-- hang them -->
    <table width="100%" border="0">
  <tr>
    <td> <label for="loai_dia_oc"><?php echo JText::_('PROPERTY TYPE') ?></label></td>
    <td><?php
        if($styleBds=='list')
        echo getHtmlCheckBox('#__jea_types',$colorLink); 
        else
        echo getHtmlList('#__jea_types', '--'. $textAll .'--', 'type_id' );
        ?></td>
    <td><label for="tinh_thanh"><?php echo JText::_('TRANSACTION_TYPE') ?></label></td>
    <td><select name="cat" class="inputbox">          
            <option value="all"><?php echo '--'. $textAll .'--'?></option>
            <option value="selling">Cần bán</option>
            <option value="renting">Cho thuê</option>
<!--            <option value="needbuying">Cần mua</option>-->
<!--            <option value="needrenting">cần thuê</option>	-->
        </select></td>
  </tr>
  <tr>
    <td><label for="tinh_thanh"><?php echo JText::_('Town') ?></label></td>
    <td><?php echo getHtmlList('#__jea_towns', '--'. $textAll .'--', 'town_id',true ) ?></td>
    <td> <label for="quan_huyen"><?php echo JText::_('Area') ?></label></td>
    <td><?php //echo getHtmlList('#__jea_areas', '--Tất Cả--', 'area_id' ) ?> 
        
        <span id="view_area"> <select name="area_id"><option value="0"><?php echo '--'. $textAll .'--'?></option></select></span> 
           </td>
  </tr>
  <tr>
    <td><label for="gia"><?php echo JText::_('PRICE_FROM') ?></label></td>
    <td><?php echo getPriceSelectBox($priceTitleStr, $priceValueStr);?></td>
    <td>&nbsp;</td>
    <td style="padding-left:23px;"><input type="submit" class="button1" value="<?php echo JText::_('Search') ?>" /></td>
  </tr>
</table>
        <input type="hidden" name="gia_tu" value="-1"></input>
        <input type="hidden" name="gia_den" value="-1"></input>
        	<input type="hidden" name="Itemid" value="45" />
        
        <?php echo JHTML::_( 'form.token' ) // Do not remove this ?>
      
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
<!--    <b>    Tìm kiếm bất động sản </b>-->
        <table style="width:100%;background-color:#f1f1f1;height:149px;">
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
        	<td colspan="4">
        		<table>
        		<tr>
		            <td align="left">Giá</td>
		            <td align="left">Từ:</td>
		            <td align="left"><input type="text" name="gia_tu" size="6"/></td>
		            <td align="left">triệu &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		            <td align="left">Đến:</td>
		            <td align="left"><input type="text"  name="gia_den" size="6" /></td>
		            <td align="left">triệu</td>
	            </tr>           
        		<tr>
		            <td align="left">Diện Tích &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		            <td align="left">Từ:</td>
		            <td align="left"><input type="text"  name="dientich_tu" size="6"/></td>
		            <td align="left">m2</td>
		            <td align="left">Đến:</td>
		            <td align="left"><input type="text"  name="dientich_den" size="6" /></td>
		            <td align="left">m2</td>
	            </tr>
	            </table>
            </td>
        </tr>
        <tr>
            <td align="left">Từ Khóa</td>
            <td align="left"><input type="text"  name="key_search" size="12"/></td>
            <td colspan="2" align="left">
            
            <input type="submit" class="button" value="<?php echo JText::_('Search') ?>"  style="width: 90px"/>
            <input type="hidden" name="Itemid" value="<?php echo JRequest::getInt('Itemid', 0) ?>" />
            <?php echo JHTML::_( 'form.token' ) // Do not remove this ?>
            </td>
        </tr>
        </table>
	<?php endif ?>
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
