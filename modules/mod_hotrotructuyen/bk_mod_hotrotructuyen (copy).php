<!--<link rel="stylesheet" type="text/css" href="sample.css" />-->


<style>
div.sample_popup { z-index: 1; }

div.sample_popup div.menu_form_header
{
  border: 1px solid black;
  border-bottom: none;

  width: 200px;

  height:      20px;
  line-height: 19px;
  vertical-align: middle;

  background: url('images/stories/kp/form_header.png') no-repeat;

  text-decoration: none;
  font-family: Times New Roman, Serif;
  font-weight: 900;
  font-size:  13px;
  color:   #206040;
  cursor:  default;
}
.body_img
{
	margin: 4px 5px 0px 0px;
}
div.sample_popup div.menu_form_body
{
  width: 200px;
  border: 1px solid black;
  background: url('images/stories/kp/form.png') no-repeat left bottom;
}

div.sample_popup img.menu_form_exit
{
  float:  right;
  margin: 4px 5px 0px 0px;
  cursor: pointer;
}

div.sample_popup table
{
  width: 100%;
  border-collapse: collapse;
}

div.sample_popup th
{
  width: 1%;
  padding: 0px 5px 1px 0px;

  text-align: left;

  font-family: Times New Roman, Serif;
  font-weight: 900;
  font-size:  13px;
  color:   #004060;
}

div.sample_popup td
{
  width: 99%;
  padding: 0px 0px 1px 0px;
}

div.sample_popup form
{
  margin:  0px;
  padding: 8px 10px 10px 10px;
}

div.sample_popup input.field
{
  width: 95%;
  border: 1px solid #808080;

  font-family: Verdana, Sans-Serif;
  font-size: 12px;
}

div.sample_popup input.btn
{
  margin-top: 2px;
  border: 1px solid #808080;

  background-color: #DDFFDD;

  font-family: Verdana, Sans-Serif;
  font-size: 11px;
}

</style>
<script type="text/javascript">
function popup_exit()
{
  var element_drag = document.getElementById('popup');
  element_drag.style.display = 'none';
}

// ***** popup_show ************************************************************
function popup_show(id, exit_id)
{
  var element      = document.getElementById(id);
  var exit_element = document.getElementById(exit_id);
  var width        = window.innerWidth  ? window.innerWidth  : document.documentElement.clientWidth;
  var height       = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight;
//alert(width);
//alert(height);
  element.style.position = "absolute";
  element.style.display  = "block";

  element.style.left = (document.documentElement.scrollLeft+(width -element.clientWidth )/2)+'px';
  element.style.top  = (document.documentElement.scrollTop +(height-element.clientHeight)/2)+'px';
 
  exit_element.onclick     = popup_exit;
}
</script>

<table border="0">
<tbody>
<tr>
<?php 
//jimport( 'joomla.application.application' );
global $mainframe;
$user =& JFactory::getUser();
if($user->get('name'))
{
	echo "<td><a href=\"index.php?option=com_user&task=logout+&Itemid=1&lang=vi\">Đăng xuất |</a></td>";
}
else
{	
	echo "<td><a href=\"index.php?option=com_user&amp;view=register&amp;Itemid=19&amp;lang=vi\">Đăng ký  |</a></td>";
	echo "<td><a href=\"index.php?option=com_user&amp;view=login&amp;Itemid=19&amp;lang=vi\">Đăng nhập </a></td>";
}
//echo "<td><a href=\"#\" onclick=\"popup_show('popup','popup_exit')\">Tiện ích</a></td>";

if(JFactory::getURI()->getVar("task") == 'logout')
{
	$mainframe->redirect('index.php');
}
?>
</tr>
</tbody>
</table>

<div class="sample_popup"     id="popup" style="display: none;">
    <div class="menu_form_header" id="popup_drag">
    <img class="menu_form_exit"   id="popup_exit" src="images/stories/kp/form_exit.png" alt="" />
    <div align="right">Tiện ích</div>
    </div>
    
    <div class="menu_form_body">
    
    <div align="left">     
    <a href="http://www.vietcombank.com.vn/exchangerates/" target="_blank">
    <img id="body_img" src="images/stories/kp/tigia.png"/>
    Tỷ giá ngoại tệ</a>
    </div>
    <br />
    
    <a href="http://hcm.24h.com.vn/ttcb/giavang/giavang.php" target="_blank">Giá vàng</a>
     <br />
    <a href="http://vnexpress.net/User/ck/hcm/"  target="_blank">Thị trường chứng khoán</a>
    </div>

</div>
