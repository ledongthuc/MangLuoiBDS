<?php // no direct access
defined('_JEXEC') or die('Restricted access');
$use_ajax = $params->get('use_ajax', 0);
$styleBds = $params->get('styleBds');
$document =& JFactory::getDocument();
$document->addStyleDeclaration("
	#jea_search_form select {
		width:16em;
		height:22px;
		margin-top:5px;
		margin-bottom:5px;	
	}");
$colorLink=$params->get( 'colorLink' );
$colorText=$params->get( 'colorText' );
$searchFor=$params->get( 'searchFor' );
$textAll = JText::_('ALL_kp');

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
	//alert(formSearch["gia_tu"].value );
}
</script>

<div  class="jea_search" style=' <?php if($colorText) echo "color:$colorText;"  ?>;' >
<!--<div  class="jea_search" style=' <?php if($colorText) echo "color:$colorText;"  ?> '>-->
<form action="index.php?option=com_jea&task=search&Itemid=20" method="post" id="jea_search_form" name="fSearch" enctype="application/x-www-form-urlencoded" >
  
  
  
    <table width="100%" border="0">
  		<tr> 
   			<td>
			    <?php 
			        if($styleBds=='list')
			        echo getHtmlCheckBox('#__jea_types',$colorLink); 
			        else
			        echo getHtmlList('#__jea_types', 'Loại hình giao dịch', 'type_id' );
			     ?>
		    </td>
		  </tr>
		  <tr>
		    <td>
		    	<select name="cat" class="inputbox">          
		            <option value="all"><?php echo 'Loại bất động sản'?></option>
		            <option value="selling">Cần bán</option>
		            <option value="renting">Cho thuê</option>
		            <option value="needbuying">Cần mua</option>
		            <option value="needrenting">cần thuê</option>	
		        </select>
		    </td>
		  </tr>
		  <tr>
		    <td>
		    	<?php echo getHtmlList('#__jea_towns', 'Tỉnh/ Thành', 'town_id',true ) ?>
	    	</td>
	      </tr>
		  <tr>
		    <td>
      		  <span id="view_area"> <select name="area_id"><option value="0"><?php echo 'Quận/ Huyện'?></option></select></span> 
           	</td>
          </tr>
		  <tr>
   			 <td>
   			      <?php echo getPriceSelectBox($priceTitleStr, $priceValueStr);?>
       		 </td>
       	  </tr>
		  <tr>
  			<td style="padding-left:20px;">
  			<div align="center">
   				 <input type="submit" class="button1" value="<?php echo JText::_('Search') ?>" />
   			 </div>
   			</td>
		  </tr>
</table>
		<input type="hidden" name="gia_tu" value="-1"></input>
        <input type="hidden" name="gia_den" value="-1"></input>	
		<input type="hidden" name="Itemid" value="45" />
</form>
</div>
<script type="text/javascript" defer="defer">
var arrTopic= new Array();
// Hiển thị dropdownlist Topic ứng với catid
function HienThiTopic(town_Id)
{
var topic;
var html = "<select  name='area_id'>";
html += "<option value='0'>Quận/ Huyện</option>";
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
