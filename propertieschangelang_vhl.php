<?php

define( '_JEXEC', 1 );
define( 'DS', DIRECTORY_SEPARATOR );
define('JPATH_BASE', dirname(__FILE__) );
define('JPATH_COMPONENT', JPATH_BASE . 'components/com_u_re' );

require_once JPATH_BASE.DS.'includes'.DS.'defines.php';
require_once JPATH_BASE.DS.'includes'.DS.'framework.php';
//require_once 'libraries/joomla/application/component/view.php';
$mainframe =& JFactory::getApplication('site');
//include_once ('libraries'.DS.'unisonlib'.DS.'com_jea_lib.php');
require_once('libraries/com_u_re/php/common_utils.php');
//include_once  "view.html.php";

// phan lay ngon ngu
$language= $_REQUEST['lang'];
$lang = substr($language,0,2);
$lang1 = JFactory::getLanguage();
$extension = 'com_u_re';
$basePath = JPATH_BASE;
$lang1->load($extension, $basePath, $language, true);


// gia tri sau khi load neu co
$ch_kind_id= $_REQUEST['ch_kind_id'];
$ch_type_id= $_REQUEST['ch_type_id'];
// $ch_position= $_REQUEST['ch_position'];
$ch_town_id= $_REQUEST['ch_town_id'];
$ch_area_id= $_REQUEST['ch_area_id'];
$ch_legal_status= $_REQUEST['ch_legal_status'];
$ch_direction_id= $_REQUEST['ch_direction_id'];
$ch_price_area_unit =  $_REQUEST['price_area_unit'];
$advantage = $_REQUEST['advantage'];
$fontend = $_REQUEST['fontend'];
$isArea= $_REQUEST['Area'];
$ch_price_unit= $_REQUEST['price_unit'];

$user		= & JFactory::getUser();
$usertype	= $user->get('usertype');



// phan checkbox tien ich
// $tienIchIds = '1-1,1-2,1-3';
$tienIchIds = $_REQUEST['tienich'];
$templateName = JFactory::getApplication()->getTemplate();
$templatePath = JPATH_THEMES . DS . $templateName . DS . "html" . DS . "com_u_re" 
										. DS . "properties";
$templateName = 'admin_tien_ich';



if ( $isArea == "area")
{
	//$ch_town_id=1;
	echo ilandCommonUtils::getSelectBox('quan_huyen', 'area_id', '',$ch_area_id,"",$ch_town_id,  "style='width:137px'");
	return;
}
// echo "vao toi pro";
// exit;
$strbreak = '--||ABC||--'; // Gan gia tri de split ra khi dem vao ajax
//getSelectBox($language, $table, $name,$title,$checked,$onchange=NULL,$Town_id =NULL, $style=NULL, $class = NULL)
// [0] loai tin rao: can ban, can mua..
echo ilandCommonUtils::getSelectBox('loai_giao_dich','kind_id', JText::_('PROPERTIES_KINDS'),$ch_kind_id,'','','','class=dangtin_backend_bds_combobox',$lang);
echo $strbreak;
// [1] phap ly: so do, so hong...
echo ilandCommonUtils::getSelectBox('phap_ly','legal_status', JText::_('SELECT_LEGAL'),$ch_legal_status,'onchange=getonchangvalue(\'legal_status\',\'divlegalstatus\',\'\',0)','',"style='width:148px'",'class=dangtin_backend_bds_combobox',$lang);
echo $strbreak;

// [2]vi tri: mat tien duong....
echo ilandCommonUtils::getSelectBox('vi_tri','position', JText::_('position'),$ch_position,'','','','',$lang);
echo $strbreak;

// [3]huong: huong dong, huong tay...
echo ilandCommonUtils::getSelectBox('huong','direction_id', JText::_('Directions'),$ch_direction_id,'','','','',$lang);
echo $strbreak;

// [4] don vi nha dat: m2, nguyen can...
echo ilandCommonUtils::getSelectBox('don_vi_dien_tich', 'price_area_unit','',$ch_price_area_unit,'','', '','class=dangtin_donvitien',$lang);
echo $strbreak;

// [5]loai bds: nha tam, biet thu...
echo ilandCommonUtils::getSelectBox('loai_bds','type_id', JText::_('PROPERTIES_TYPE'), $ch_type_id,'onchange="jea_types_filter(this.value); onchange=getonchangvalue(\'type_id\',\'divtype\',\'\',0)"','','','class=dangtin_backend_bds_combobox',$lang);
echo $strbreak;

// [6]tinh thanh: hcm, ha noi...
echo ilandCommonUtils::getSelectBox('tinh_thanh', 'town_id',JText::_('town'),$ch_town_id,"onchange=getCompoChangeLang('$lang','$fontend','area')", "",  "style='width:137px'",'',$lang);
echo $strbreak;

// [7]quan huyen: quan thu duc...
echo ilandCommonUtils::getSelectBox('quan_huyen', 'area_id', '',$ch_area_id,"",$ch_town_id,  "style='width:137px'",'',$lang);
echo $strbreak;
	?>
<?php // [8] don vi tien: vnd, usd....
$selectedtr='';
$selectedti='';
$selectedusd ='';
$selectedsjc='';
switch ( $ch_price_unit )
{
	case '8' : 	$selectedtr="selected";
	break;
	case '7' : 	$selectedti="selected";
	break;
	case '2' : 	$selectedusd="selected";
	break;
	case '3' : 	$selectedsjc="selected";
	break;
}

?>
		<select id="price_unit" name="price_unit" class="inputbox" style="width:50px">
			<option <?php echo $selectedtr ?> value="8">Triệu</option>
			<option <?php echo $selectedti ?> value="7">Tỉ</option>
			<option <?php echo $selectedusd ?> value="2">USD</option>
			<option <?php echo $selectedsjc ?> value="3">SJC</option>
		</select>
<?php
echo $strbreak;
// [9]
echo JText::_('CAU_HINH_SEO') ;
echo $strbreak;
// [10]
echo JText::_('TIEU_DE_SEO') ;
echo $strbreak;
// [11]
echo JText::_('TU_KHOA_SEO') ;
echo $strbreak;
// [12]
echo JText::_('DIEN_GIAI_SEO') ;
echo $strbreak;
// [13]
echo JText::_('DANG_TIN_NOI_BAT') ;
echo $strbreak;
// [14]
echo JText::_('DANG_TIN_MOI_NHAT') ;
echo $strbreak;
// [15]
echo JText::_('HIEN_THI_RA_NGOAI') ;
echo $strbreak;
// [16]
echo JText::_('TIEU_DE') ;
echo $strbreak;
// [17]
echo JText::_('HINH_ANH') ;
echo $strbreak;
// [18]
echo JText::_('BAN_DO') ;
echo $strbreak;
// [19]
echo JText::_('ANH_CHINH') ;
echo $strbreak;
// [20]
echo JText::_('ANH_PHU') ;
echo $strbreak;
// [21]
echo JText::_('MA_SO_TAI_SAN') ;
echo $strbreak;
// [22]
echo JText::_('DIA_CHI') ;
echo $strbreak;
// [23]
echo JText::_('PRICE') ;
echo $strbreak;
// [24]
echo JText::_('D_T_K_V') ;
echo $strbreak;
// [25]
echo JText::_('DIEN_TICH_SU_DUNG') ;
echo $strbreak;
// [26]
echo JText::_('PHAP_LY') ;
echo $strbreak;
// [27]
echo JText::_('LIEN_HE') ;
echo $strbreak;
// [28]
echo JText::_('HO_TEN') ;
echo $strbreak;
// [29]
echo JText::_('DIA_CHI') ;
echo $strbreak;
// [30]
echo JText::_('DIEN_THOAI') ;
echo $strbreak;
// [31]
echo JText::_('GHI_CHU') ;
echo $strbreak;
// [32]
echo JText::_('DETAIL_INFO') ;
echo $strbreak;
// [33]
echo JText::_('STRUCTURE') ;
echo $strbreak;
// [34]
echo JText::_('ADVANTAGES') ;
echo $strbreak;
// [35]
echo JText::_('PHONG_KHACH') ;
echo $strbreak;
// [36]
echo JText::_('PHONG_NGU') ;
echo $strbreak;
// [37]
echo JText::_('PHONG_TAM') ;
echo $strbreak;
// [38]
echo JText::_('PHONG_KHAC') ;
echo $strbreak;
// [39]
echo JText::_('HUONG') ;
echo $strbreak;
// [40]
echo JText::_('STREET') ;
echo $strbreak;
// [41]
echo JText::_('LOAI_BDS') ;
echo $strbreak;
// [42]
echo JText::_('DTKV') ;
echo $strbreak;
// [43]
echo JText::_('CHIEU_RONG_R') ;
echo $strbreak;
// [44]
echo JText::_('CHIEU_DAI_D') ;
echo $strbreak;
// [45]
echo JText::_('DTXD') ;
echo $strbreak;

// [46]
$user	= & JFactory::getUser();
$op=0;
if( isset($user->approved) && $user->approved == "0" )
{
	$op=1;
}




echo "<input type=\"button\" onclick=\"submitForm('$usertype', $op,  $op ,'1', '$lang' )\" name=\"save_review\" class=\"button1\" value=\" ". JText::_('LUU_VA_XEM_LAI') ." \" />";
echo $strbreak;

// [47]
echo "<input type=\"button\" onclick=\"submitForm( '$usertype', $op, $op ,'2', '$lang' )\" name=\"save_published\" class=\"button1\" value=\" ". JText::_('LUU_TIN') ." \" />";
echo $strbreak;

// [48]
echo "<input type=\"button\" onclick=\"submitForm('$usertype', $op,  '0' ,'3', '$lang' )\" name=\"save_draft\" class=\"button1\" value=\" ". JText::_('LUU_NHAP') ." \" />";
echo $strbreak;

// [49]
echo "<input type=\"button\" onclick=\"onChangeAddress()\" value=\" ". JText::_('CAP_NHAT_BAN_DO') ." \" />";
echo $strbreak;

// [50]
echo  U_ReModelProperties::fetchTienIchTemplate( $tienIchIds, $templatePath, $templateName, true, $lang );
echo $strbreak;

// [51]
echo JText::_('TINH_THANH') ;
echo $strbreak;

// [52]
echo JText::_('QUAN_HUYEN') ;
echo $strbreak;

// [53]
echo JText::_('LOAI_HINH_GIAO_DICH') ;
echo $strbreak;

// [54]
echo JText::_('LOAI_BDS') ;
echo $strbreak;

// [55]
echo JText::_('CHIEU_DAI_D') ;
echo $strbreak;

// [56]
echo JText::_('CHIEU_RONG_R') ;
echo $strbreak;

// [57]
echo JText::_('CAU_TRUC') ;
echo $strbreak;

// [58]
echo JText::_('MO_TA') ;
echo $strbreak;

// [59]
echo JText::_('STREET') ;
echo $strbreak;

// [60]
echo "<input type=\"button\" onclick=\"resetImage(20)\" value=\" ". JText::_('DANG_HINH_LAI_TU_DAU') ." \" />";
echo $strbreak;
?>
	