<div class='clear searchmlbds'>
<style type="text/css">
.wrapper1col {
margin-top: 0px!important;
margin-bottom: 0px!important;
}
</style>
<!-- tab "panes" -->
<div class="panes">
<!-- tim kiếm theo điều kiện-->
	<div style="display: block; ">
		<div id="search_dk" class='search-dk'>
		<div class='show-search' >
			<ul>
				<li>
					<span class='lgd'>
						
					</span>
					<span class='clear'>
						<?php echo $loai_giao_dich;?>
					</span>
				</li>
				<li>
					<span class='lbds'>
						
					</span>
					<span class='clear'>
						<?php echo $loai_bds;?>
					</span>
				</li>
				<?php include_once ('templates/mlbds/html/mod_jea_search/quanhuyen.php');?>
				<li>
					<span class='duongpho'>
						
					</span>
					<span class='clear'>
						<input id="duong_pho" name="duong_pho" type="text" 
							value="<?php if ( !empty($_GET['duong_pho']) ) echo $_GET['duong_pho']?>" 
							class="input-s1" />
					</span>
				</li>
				<li>
					<span class='thuocduan'>
						
					</span>
					<span id ='duanie-taoyeucau' class='clear ' style='background: none repeat scroll 0 0 red;'>
						<?php echo $duAnHTML;?>
						
						
					</span>
				<!-- 	<select name="du_an_id_test" id="du_an_id_test" class="input-s" size="1" style="width: 219px;">
						</select> -->
				</li>
				
				<li id="muc_gia">
					<span class='mucgia'>
						
					
					<span class='clear'>
						<div style='float:left;padding:0;height: 21px;width: 149px;'>
							<input id="muc_gia_toi_da" name="muc_gia_toi_da" type="text"
								onkeyup="formatThousandPoint(this, this.value)"
								value="<?php if ( !empty($_GET['muc_gia_toi_da']) ) echo $_GET['muc_gia_toi_da']?>" class="input-s3" /> 
						</div>
						<div id="loai_gia_div" style='float: left;padding: 0;height: 20px;width: 111px;font-size: 12px;line-height: 17px;margin-top: -2px;text-align: left;margin-left: 4px;'>
							<input id="loai_gia_nguyen_can" name="loai_gia" type="radio" 
								onclick="currentLoaiGia='nguyen_can'"
								value="nguyen_can" <?php if ( ( empty( $_GET['loai_gia'] ) || $_GET['loai_gia'] != 'm2' ) ) echo 'checked="checked"';?> />
							<label id="nguyen_can_text">nguyên căn</label>
							<br />
							<input id="loai_gia_m2" name="loai_gia" type="radio" 
								onclick="currentLoaiGia='m2'"
								value="m2" <?php if ( ( !empty( $_GET['loai_gia'] ) && $_GET['loai_gia'] == 'm2' ) ) echo 'checked="checked"';?> /><span id="m2_text">m<sup>2</sup></span>
						</div>
						
					</span>
					</span>
				</li>
				<li id="muc_gia_nc" style="display:none"> 
					<span class='mucgia1'>
						
					</span>
					<div class="clear">
						<div style="text-align:left;float:left;padding:0;height: 21px;width: 246px;">
							<input id="muc_gia_tu" name="muc_gia_tu" style='width:92px' type="text" class="input-s2" 
								onkeyup="formatThousandPoint(this, this.value)"
								value="<?php if ( !empty( $_GET['muc_gia_tu'] ) ) {
								echo $_GET['muc_gia_tu']; 
							} else { echo 'Từ'; }
							?>"
								onclick="clearDefaultValue( this, 'Từ' )" onblur="setDefaultValue( this, 'Từ' )" />
							<input id="muc_gia_den" style='width:92px' name="muc_gia_den" type="text" class="input-s2" 
								onkeyup="formatThousandPoint(this, this.value)"
								value="<?php if ( !empty( $_GET['muc_gia_den'] ) ) {
								echo $_GET['muc_gia_den']; 
							} else { echo 'Đến'; }
							?>" onclick="clearDefaultValue( this, 'Đến' )" onblur="setDefaultValue( this, 'Đến' )" />
						</div>
						<div style='float: left;padding: 0;height: 20px;width: 101px;font-size: 12px;line-height: 17px;margin-top: -2px;text-align: left;margin-left: -4px;'>
							<input id="loai_gia_nguyen_can_nc" name="loai_gia_nc" type="radio" 
								onclick="currentLoaiGia='nguyen_can'"
								value="nguyen_can" <?php if ( ( empty( $_GET['loai_gia'] ) || $_GET['loai_gia'] != 'm2' ) ) echo 'checked';?> />
							<label id="nguyen_can_text_nc">nguyên căn</label> <br/>
							<input id="loai_gia_m2_nc" name="loai_gia_nc" type="radio" 
								onclick="currentLoaiGia='m2'"
								value="m2" <?php if ( ( !empty( $_GET['loai_gia'] ) && $_GET['loai_gia'] == 'm2' ) ) echo 'checked';?> />
							<span id="m2_text_nc">m<sup>2</sup></span>
						</div>
						
					</div>
				</li>
				
				
				<li id="dien_tich_su_dung" class="dtsd_tkdk clear">
					<span class='dtsd'>
						
					</span>
					<span class='clear'>
						<input id="dien_tich_su_dung_toi_thieu" name="dien_tich_su_dung_toi_thieu"
							value="<?php if ( !empty($_GET['dien_tich_su_dung_toi_thieu']) ) 
							{
								echo $_GET['dien_tich_su_dung_toi_thieu'];	
							}							
							?>" 
							type="text" class="input-s1" /> 
					</span>
				</li>
				
				<li id="phong_ngu">
					<span class='phongngu'>
						
					</span>
					<span class='clear'>
						<input id="phong_ngu_toi_thieu" name="so_phong_ngu_toi_thieu"
							value="<?php if ( !empty($_GET['phong_ngu_toi_thieu']) ) echo $_GET['phong_ngu_toi_thieu']?>" 
							type="text" class="input-s1" /> 
					</span>
				</li>
				
				<li id="phong_tam" style='margin-right:0'>
					<span class='phongtam'>
						
					</span>
					<span class='clear'>
						<input id="phong_tam_toi_thieu" name="phong_tam_toi_thieu" 
							value="<?php if ( !empty($_GET['phong_tam_toi_thieu']) ) echo $_GET['phong_tam_toi_thieu']?>"
							type="text" class="input-s1" /> 
					</span>
				</li>
				
				
				
				<li style='  margin-right: 0; margin-top: 23px;width: 96px; text-align: left;'>
					<span class='clear check'>
						<label><input id="speak_english" name="speak_english"
							<?php if ( !empty($_GET['speak_english']) ) echo 'checked="checked"';?> 
							type="checkbox" /> 
						</label>
							<label>Speak English</label>
					</span>
					<span class='clear check'>
					<input id="chinh_chu" name="chinh_chu"
						<?php if ( !empty($_GET['chinh_chu']) ) echo 'checked="checked"';?> 
						type="checkbox" /> 
						Chính chủ
					</span>
				</li>
			
				
				<li class='but-search' id="tim_kiem_co_ban" style='margin-right: 0;'>
					<span style='float:right' >
						<!--<input type="button" value="Tìm trên danh sách" class='btn-search-ds' onclick="submitSearchForm('dk')">
						<span class='clear check'>-->
						<input type="button" value="" class='btn-search-bd' onclick="submitSearchForm('map')" />
						<span class='clear check'style="margin-left: 11px;">
							<a href="javascript:;" onclick="showAdvanceSearch()" class='link'>Tìm kiếm nâng cao </a>
							&nbsp;&nbsp;
							<a href="javascript:;" onclick="setSearchFieldDefaultValue()" class='link'>Xoá toàn bộ </a>
						</span>
					</span>
				</li>
			</ul>
			</div>
		<div id="tknc" style='display: none'>
		<ul>
			<li id="dien_tich_su_dung_nc">
					<span class="dientichsudung">
						
					</span>
					<span class="clear">
						<input id="dien_tich_su_dung_tu" name="dien_tich_su_dung_tu" type="text" class="input-s2" 
							value="<?php if ( !empty( $_GET['dien_tich_su_dung_tu'] ) ) {
								echo $_GET['dien_tich_su_dung_tu']; 
							} else { echo 'Từ'; }
							?>" 
							onclick="clearDefaultValue( this, 'Từ' )" onblur="setDefaultValue( this, 'Từ' )" /> 
						<input id="dien_tich_su_dung_den" name="dien_tich_su_dung_den" type="text" class="input-s2" 
							value="<?php if ( !empty( $_GET['dien_tich_su_dung_den'] ) ) {
								echo $_GET['dien_tich_su_dung_den']; 
							} else { echo 'Đến'; }
							?>"
							onclick="clearDefaultValue( this, 'Đến' )" onblur="setDefaultValue( this, 'Đến' )" /> 
					</span>
			</li>
			
			<li id="phong_ngu_nc">
					<span class="sophongngu">
						
					</span>
					<span class="clear">
						<input id="phong_ngu_tu" name="phong_ngu_tu" type="text" class="input-s2" 
							value="<?php if ( !empty( $_GET['phong_ngu_tu'] ) ) {
								echo $_GET['phong_ngu_tu']; 
							} else { echo 'Từ'; }
							?>"
							onclick="clearDefaultValue( this, 'Từ' )" onblur="setDefaultValue( this, 'Từ' )" /> 
						<input id="phong_ngu_den" name="phong_ngu_den" type="text" class="input-s2" 
							value="<?php if ( !empty( $_GET['phong_ngu_den'] ) ) {
								echo $_GET['phong_ngu_den']; 
							} else { echo 'Đến'; }
							?>"
							onclick="clearDefaultValue( this, 'Đến' )" onblur="setDefaultValue( this, 'Đến' )" /> 
					</span>
			</li>
			
			<li id="dien_tich_san_nc">
					<span class="dientichsan">
						
					</span>
					<span class="clear">
						<input id="dien_tich_san_tu" name="dien_tich_san_tu" type="text" class="input-s2" 
							value="<?php if ( !empty( $_GET['dien_tich_san_tu'] ) ) {
								echo $_GET['dien_tich_san_tu']; 
							} else { echo 'Từ'; }
							?>"
							onclick="clearDefaultValue( this, 'Từ' )" onblur="setDefaultValue( this, 'Từ' )" /> 
						<input id="dien_tich_san_den" name="dien_tich_san_den" type="text" class="input-s2" 
							value="<?php if ( !empty( $_GET['dien_tich_san_den'] ) ) {
								echo $_GET['dien_tich_san_den']; 
							} else { echo 'Đến'; }
							?>"
							onclick="clearDefaultValue( this, 'Đến' )" onblur="setDefaultValue( this, 'Đến' )" /> 
					</span>
			</li>
			
			<li id="phong_tam_nc">
					<span class="sophongtam">
						
					</span>
					<span class="clear">
						<input id="phong_tam_tu" name="phong_tam_tu" type="text" style="width: 92px;" class="input-s2" 
							value="<?php if ( !empty( $_GET['phong_tam_tu'] ) ) {
								echo $_GET['phong_tam_tu']; 
							} else { echo 'Từ'; }
							?>"
							onclick="clearDefaultValue( this, 'Từ' )" onblur="setDefaultValue( this, 'Từ' )" /> 
						<input id="phong_tam_den" name="phong_tam_den" type="text" style="width: 92px;margin-right:3px;" class="input-s2" 
							value="<?php if ( !empty( $_GET['phong_tam_den'] ) ) {
								echo $_GET['phong_tam_den']; 
							} else { echo 'Đến'; }
							?>"
							onclick="clearDefaultValue( this, 'Đến' )" onblur="setDefaultValue( this, 'Đến' )" /> 
					</span>
			</li>
			<!-- 
			<li id="muc_gia_nc" class='muc_gia_nc'>
					<span class='mucgia1 muc_gia_nc'>
						
					
					<span class='clear'>
						<div style='float:left;padding:0;height: 21px;width: 246px;'>
							<input id="muc_gia_tu" name="muc_gia_tu" style='width:99px' type="text" class="input-s2" 
								onkeyup="formatThousandPoint(this, this.value)"
								value="<?php if ( !empty( $_GET['muc_gia_tu'] ) ) {
								echo $_GET['muc_gia_tu']; 
							} else { echo 'Từ'; }
							?>"
								onclick="clearDefaultValue( this, 'Từ' )" onblur="setDefaultValue( this, 'Từ' )">
							<input id="muc_gia_den" style='width:99px' name="muc_gia_den" type="text" class="input-s2" 
								onkeyup="formatThousandPoint(this, this.value)"
								value="<?php if ( !empty( $_GET['muc_gia_den'] ) ) {
								echo $_GET['muc_gia_den']; 
							} else { echo 'Đến'; }
							?>" onclick="clearDefaultValue( this, 'Đến' )" onblur="setDefaultValue( this, 'Đến' )">
						</div>
						<div style='float: left;padding: 0;height: 20px;width: 93px;font-size: 12px;line-height: 17px;margin-top: -6px;'>
							<input id="loai_gia_nguyen_can_nc" name="loai_gia_nc" type="radio" 
								onclick="currentLoaiGia='nguyen_can'"
								value="nguyen_can" <?php if ( ( empty( $_GET['loai_gia'] ) || $_GET['loai_gia'] != 'm2' ) ) echo 'checked';?> />
							<label id="nguyen_can_text_nc">nguyên căn</label> <br/>
							<input id="loai_gia_m2_nc" name="loai_gia_nc" type="radio" 
								onclick="currentLoaiGia='m2'"
								value="m2" <?php if ( ( !empty( $_GET['loai_gia'] ) && $_GET['loai_gia'] == 'm2' ) ) echo 'checked';?> />
							<span id="m2_text_nc">m<sup>2</sup></span>
						</div>
						
					</span>
					</span>
				</li>
			 -->
			<li>
					<span class="sotang">
					
					</span>
					<span class="clear">
						<input id="so_tang_tu" name="so_tang_tu" type="text" class="input-s2"
							value="<?php if ( !empty( $_GET['so_tang_tu'] ) ) {
								echo $_GET['so_tang_tu']; 
							} else { echo 'Từ'; }
							?>"
							onclick="clearDefaultValue( this, 'Từ' )" onblur="setDefaultValue( this, 'Từ' )" /> 
						<input id="so_tang_den" name="so_tang_den" type="text" class="input-s2" 
							value="<?php if ( !empty( $_GET['so_tang_den'] ) ) {
								echo $_GET['so_tang_den']; 
							} else { echo 'Đến'; }
							?>"
							onclick="clearDefaultValue( this, 'Đến' )" onblur="setDefaultValue( this, 'Đến' )" /> 
					</span>
			</li>
			<li style='width:221px'>
					<span class="huong">
					
					</span>
					<span class="clear">
						<?php echo $huongHTML;?>
					</span>
			</li>
			<li>
					<span class="tinhtrangnoithat">
					
					</span>
					<span class="clear">
						<select id="tinh_trang_noi_that" name="tinh_trang_noi_that">
							<option value="-1" <?php if ( !isset ( $_GET['tinh_trang_noi_that'] ) || $_GET['tinh_trang_noi_that'] == -1 ) {?> selected <?php }?>>Bất kỳ</option>
							<option value="1" <?php if ( isset ( $_GET['tinh_trang_noi_that'] ) && $_GET['tinh_trang_noi_that'] == 1 ) {?> selected <?php }?>>Có</option>
							<option value="0" <?php if ( isset ( $_GET['tinh_trang_noi_that'] ) && $_GET['tinh_trang_noi_that'] == 0 ) {?> selected <?php }?>>Không</option>
						</select>
					</span>
			</li>
			<li class='clear' style='width:75%;margin-right:0'>
					<span class="csvc">
					
					</span>
					<span class="clear">
					<!-- tien ich -->
						<?php echo $tienIchHTML;?>
					</span>
			</li>
			<li class='but-search' style="margin-top:13px" id="tim_kiem_nang_cao">
					<span style='float:right' >
						<!--<input type="button" value="Tìm trên danh sách" class='btn-search-ds' onclick="submitSearchForm('dk_nang_cao')" />-->
						<span class='clear check'>
						<input type="button" value="" class='btn-search-bd' onclick="submitSearchForm('map_nang_cao')" />
						<span class='clear check'style="margin-left: 11px;">
							<a href="javascript:;" onclick="showBasicSearch()" class='link'>Tìm kiếm nhanh </a>
							&nbsp;&nbsp;
							<a href="javascript:;" onclick="setSearchFieldDefaultValue()" class='link'>Xoá toàn bộ </a>
						</span>
					</span>
					</span>
				</li>
		</ul>
				
		</div>
		</div>

	</div>
<!-- end tiềm kiếm theo điều kiện -->
	
	<div id="search_map" class='search-dk' style="display: none; ">
		
	</div>
</div>
</div>
<div id="coduantrongtaoyeucau" value="0" style="display: none"></div>
<!--  <script type="text/javascript" src="<?php echo JURI::root()?>templates/mlbds/js/jquery-1.4.4.js"></script> -->
<link rel="stylesheet" href="<?php echo JURI::root()?>templates/mlbds/html/mod_jea_search/js/tabs.css" type="text/css" media="screen" />
<script src="<?php echo JURI::root()?>templates/mlbds/html/mod_jea_search/js/jquery.tools.min.js" type="text/javascript"></script>
<script src="<?php echo JURI::root()?>templates/mlbds/html/mod_jea_search/js/jquery.searchabledropdown-1.0.8.src.js" type="text/javascript"></script>
<script src="<?php echo JURI::root()?>libraries/js/ajax.js" type="text/javascript"></script>
<script type="text/javascript">
var currentTinhThanhTKKVId = 1;
var currentTinhThanhTKKVValue = "tp.ho-chi-minh";

var currentDuAnId = 0;
var currentDuAnTitle = "";

<?php if ( !empty( $_GET['du_an_id'] ) ) {?>
currentDuAnId = "<?php echo $_GET['du_an_id']?>";
currentDuAnTitle = "<?php echo JRequest::getVar('du_an_title')?>";
<?php }?>

var currentLoaiGia = "";

<?php if ( !empty( $_GET['loai_gia'] ) ) {?>
currentLoaiGia = "<?php echo $_GET['loai_gia']?>";
<?php }?>

<?php if ( !empty( $_GET['tinh_thanh_id'] ) ) {?>
currentTinhThanhTKKVId = <?php echo $_GET['tinh_thanh_id']?>;
<?php }?>

// have 3 search type: co_ban, nang_cao, map, khu_vuc
var searchType = "";
searchType = "<?php echo $_GET['searchType']?>";
if ( searchType == "" )
{
	searchType = "co_ban";
}
function changeLoaiGia()
{
	if ( $("#loai_giao_dich_id").val() == "2" )
	{
		// cho thue
		//$("#muc_gia").css( 'marginRight', "0px" );
		//$("#loai_gia_div").css( 'width', "101px" );			
		
		$("#nguyen_can_text").html("nguyên căn/th");
		$("#m2_text").html("m<sup>2</sup>/th");
		$("#nguyen_can_text_nc").html("nguyên căn/th");
		$("#m2_text_nc").html("m<sup>2</sup>/th");
	}
	else 
	{
		// can ban
		//$("#muc_gia").removeAttr('style');
		//$("#loai_gia_div").css( 'width', "83px" );
			
		$("#nguyen_can_text").html("nguyên căn");
		$("#m2_text").html("m<sup>2</sup>");
		$("#nguyen_can_text_nc").html("nguyên căn");
		$("#m2_text_nc").html("m<sup>2</sup>");

	}
}

function selectTinhThanh( ele )
{
	// set style select
	$(".tinh_thanh_list").css("color", "#206CCA");
	ele.style.color = "red";
	currentTinhThanhTKKVId = ele.title;
	currentTinhThanhTKKVValue = ele.id; 
	
	// get quan huyen tuong ung
	layseachquanhuyen('quan_huyen_tkkv_id',ele.title,'vi-VN',
						'<?php echo JURI::base();?>', 
						'quan_huyen_tkkv_id', 'input-s');
}

// perform JavaScript after the document is scriptable.
$(function() {
    // setup ul.tabs to work as tabs for each div directly under div.panes
    /*$("#du_an_id_test").click(function(){
    	var dulieu = $("#du_an_id").html();
    	$("#du_an_id_test").html() = dulieu;
    	
    });*/
	if(jQuery.browser.msie){
		
	}else{
		jQuery("#du_an_id").searchable();
	}
    var dulieu = $("#du_an_id").html();
	$("#select_search").html(dulieu);

	$("#du_an_id").change(function(){
		currentDuAnId = $("#du_an_id option:selected").val();
		//currentDuAnTitle = $("#du_an_id option:selected").attr('title');
		currentDuAnTitle = ChangeTitle($("#du_an_id option:selected").text());
	});
	
    /*$("#search_duan").click(function(){
    	var dulieu = $("#du_an_id").html();
		$("#select_search").html(dulieu);
    });*/

    $("#du_an_id").css('width','219px');
    //$("ul.tabs").tabs("div.panes > div");
	$("#tknc").css('display','none');
	
	if ( searchType == "map_nang_cao" || searchType == "dk_nang_cao" )
	{
		showAdvanceSearch();
	}
	else 
	{
		//showBasicSearch();
	}
	
	// set onchange for loai giao dich ==> chuyen don vi gia
	$("#loai_giao_dich_id").change(function() {
		changeLoaiGia();
    });

	$(".tinh_thanh_list").click(function() {
		selectTinhThanh(this);
    });

	// change loai gia tuy theo loai giao dich
	changeLoaiGia();

	// bat su kien thuoc du an click
	/*$('[name="multiselect_quan_huyen_id"]').each(function(){
		   $(this).click(function(){
		          alert('hello sss');
		   });
		});*/
	setTimeout(function () { 
		$('[name="multiselect_quan_huyen_id"]').each(function(){
			   $(this).click(function(){
			          //alert(this.value);
					  			          
			          var selectedValueTemp = $("#quan_huyen_id").val();
			          var selectedValue = '';
			          if ( selectedValueTemp != null )
			          {
				          selectedValue = selectedValueTemp.toString();
			          }
			          if ( selectedValue != null )
			          {
				          if ( selectedValue.indexOf( this.value ) >= 0 )
				          {
				        	  selectedValue.replace( this.value, '' );
					          if ( selectedValue.indexOf( ',' ) == 0 )
					          {
					        	  selectedValue.replace( ',', '' );
					          }
				          }
				          else
				          {
					          selectedValue += "," + this.value; 
				          }
			          }
			          layDanhSachDuAn1(selectedValue,'vi-VN','<?php echo JURI::base();?>');
			   });
			}); 

		$(".ui-multiselect-all").each(function(){
			   $(this).click(function(){
			          //alert(this.value);
					  			          
			          var selectedValueTemp = $("#quan_huyen_id").val();
			          
			          layDanhSachDuAn1(selectedValueTemp,'vi-VN','<?php echo JURI::base();?>');
			   });
			});

		$(".ui-multiselect-none").each(function(){
			   $(this).click(function(){
			          //alert(this.value);
					  			          
			          var selectedValueTemp = $("#quan_huyen_id").val();
			          
			          layDanhSachDuAn1(selectedValueTemp,'vi-VN','<?php echo JURI::base();?>');
			   });
			});
		
    } , 1000);
	
});

/*$(document).ready(function() {
	$('[name="multiselect_quan_huyen_id"]').each(function(){
		   $(this).click(function(){
		          alert('hello sss');
		   });
		});
	});*/

function getTitleFromSelectedValue( selectedId, selectedValue )
{
	var ele = document.getElementById( selectedId );
	alert('length = ' + ele.options[i].length);
	for ( var i = 0; i < ele.options.length ; i++ )
	{
		if ( ele.options[i].value == selectedValue )
		{
			return ele.options[i].title;
		}
	}
	return '';
		
}
	
function showAdvanceSearch(){

	searchType = "nang_cao";
	// change some search fields
	//var searchFieldArray = new Array("dien_tich_su_dung", "phong_ngu", "phong_tam", "muc_gia");
	var searchFieldArray = new Array("dien_tich_su_dung", "phong_ngu", "phong_tam");
	searchFieldArray.length;

	var dienTichSuDungToiThieu = $("#dien_tich_su_dung_toi_thieu").val();
	var phongTamToiThieu = $("#phong_tam_toi_thieu").val();
	var phongNguToiThieu = $("#phong_ngu_toi_thieu").val();
	var mucGiaToiDa = $("#muc_gia_toi_da").val();
	var tempVal = $("#dien_tich_su_dung_toi_thieu").val();

	for ( var i = 0; i < searchFieldArray.length; i++ )
	{
		var oldEle = document.getElementById(searchFieldArray[i]);
		var newEle = document.getElementById(searchFieldArray[i] + "_nc");

		var temp = oldEle.innerHTML;
		oldEle.innerHTML = newEle.innerHTML;
		newEle.innerHTML = temp;
		
		newEle.style.display = "none";
	}

	document.getElementById("muc_gia").style.display = "none";
	document.getElementById("muc_gia_nc").style.display = "block";
	
	if ( jQuery.trim( dienTichSuDungToiThieu ) != "" )
	{
		$("#dien_tich_su_dung_tu").val( dienTichSuDungToiThieu );
	}

	if ( jQuery.trim( phongNguToiThieu ) != "" )
	{
		$("#phong_ngu_tu").val( phongNguToiThieu );
	}

	if ( jQuery.trim( phongTamToiThieu ) != "" )
	{
		$("#phong_tam_tu").val( phongTamToiThieu );
	}
	
	if ( jQuery.trim( mucGiaToiDa ) != "" )
	{
		$("#muc_gia_den").val( mucGiaToiDa );
	}

	//changeLoaiGia();
	if ( currentLoaiGia == "m2" )
	{
		$("#loai_gia_m2_nc").attr( 'checked', true );
	}
	else 
	{
		$("#loai_gia_nguyen_can_nc").attr( 'checked', true );
	}
	
	// an nut tim kiem co ban
	document.getElementById("tim_kiem_co_ban").style.display="none";
	
	$("#tknc").slideToggle('slow');

	$(".moduletablegiahung").css("marginTop","150px");

	if ( document.getElementById("mainleft") != null )
	{
		document.getElementById("mainleft").style.marginTop = "150px";
	}
	if ( document.getElementById("mainleft1") != null )
	{
		document.getElementById("mainleft1").style.marginTop = "186px";
	}
	if ( document.getElementById("mainright1") != null )
	{
		document.getElementById("mainright1").style.marginTop = "0px";
	}
	$(".mainleft1").css("marginTop","186px");
	$(".mainright1").css("marginTop","150px");
	$(".moduletabletimkiem").animate({height:"420px"},'slow');
	
}

function showBasicSearch()
{
	searchType = "co_ban";
	
	//var searchFieldArray = new Array("dien_tich_su_dung", "phong_ngu", "phong_tam", "muc_gia");
	var searchFieldArray = new Array("dien_tich_su_dung", "phong_ngu", "phong_tam");
	searchFieldArray.length;

	var dienTichSuDungToiThieu = $("#dien_tich_su_dung_tu").val();
	var phongTamToiThieu = $("#phong_tam_tu").val();
	var phongNguToiThieu = $("#phong_ngu_tu").val();
	var mucGiaToiDa = $("#muc_gia_den").val();
	var tempVal = $("#dien_tich_su_dung_toi_thieu").val();
	
	for ( var i = 0; i < searchFieldArray.length; i++ )
	{
		var oldEle = document.getElementById(searchFieldArray[i] + "_nc");
		var newEle = document.getElementById(searchFieldArray[i]);
		var temp = oldEle.innerHTML;
		oldEle.innerHTML = newEle.innerHTML;
		newEle.innerHTML = temp;
	}

	document.getElementById("muc_gia_nc").style.display = "none";
	document.getElementById("muc_gia").style.display = "block";
	
	if ( jQuery.trim( dienTichSuDungToiThieu ) != "" && dienTichSuDungToiThieu != "Từ" )
	{
		$("#dien_tich_su_dung_toi_thieu").val( dienTichSuDungToiThieu );
	}
	
	if ( jQuery.trim( phongNguToiThieu ) != "" && phongNguToiThieu != "Từ" )
	{
		$("#phong_ngu_toi_thieu").val( phongNguToiThieu );
	}

	if ( jQuery.trim( phongTamToiThieu ) != "" && phongTamToiThieu != "Từ" )
	{
		$("#phong_tam_toi_thieu").val( phongTamToiThieu );
	}

	if ( jQuery.trim( mucGiaToiDa ) != "" && mucGiaToiDa != "Đến" )
	{
		$("#muc_gia_toi_da").val( mucGiaToiDa );
	}

	//changeLoaiGia();
	if ( currentLoaiGia == "m2" )
	{
		$("#loai_gia_m2").attr( 'checked', true );
		//$("#loai_gia_nguyen_can").removeAttr( 'checked' );
	}
	else 
	{
		$("#loai_gia_nguyen_can").attr( 'checked', true );
		//$("#loai_gia_m2").removeAttr( 'checked' );
	}
	
	// hien thi nut tim kiem co ban
	document.getElementById("tim_kiem_co_ban").style.display="block";

	$("#tknc").slideUp('slow');
	$(".moduletablegiahung").css("marginTop","0px");
	if ( document.getElementById("mainleft") != null )
	{
		document.getElementById("mainleft").style.marginTop = "0px";
	}

	$(".mainleft1").css("marginTop","36px");
	$(".mainright1").css("marginTop","0px");
	$(".moduletabletimkiem").animate({height:"258px",marginBottom:"13px"},'slow');

	// document.getElementById("mainright").style.marginTop = "0px";
}

function validateSearchValue( searchTypeGroup )
{
	// co ban
	if ( searchTypeGroup == "co_ban" )
	{
		tempParamValue = document.getElementById("muc_gia_toi_da").value;
		if ( tempParamValue != "" )
		{
			if ( isNaN( tempParamValue.replace( /\,/g,"" ) ) )
			{
				alert( "Mức giá tối đa phải là kiểu số" );
				document.getElementById("muc_gia_toi_da").focus();
				return false;
			}
		}

		tempParamValue = document.getElementById("dien_tich_su_dung_toi_thieu").value;
		if ( tempParamValue != "" )
		{
			if ( isNaN( tempParamValue ) )
			{
				alert( "Diện tích tối thiểu phải là kiểu số" );
				document.getElementById("dien_tich_su_dung_toi_thieu").focus();
				return false;
			}
		}

		tempParamValue = document.getElementById("phong_ngu_toi_thieu").value;
		if ( tempParamValue != "" )
		{
			if ( isNaN( tempParamValue ) )
			{
				alert( "Phòng ngủ tối thiểu phải là kiểu số" );
				document.getElementById("phong_ngu_toi_thieu").focus();
				return false;
			}
		}

		tempParamValue = document.getElementById("phong_tam_toi_thieu").value;
		if ( tempParamValue != "" )
		{
			if ( isNaN( tempParamValue ) )
			{
				alert( "Phòng tắm phải là kiểu số" );
				document.getElementById("phong_tam_toi_thieu").focus();
				return false;
			}
		}
	}

	// nang cao
	if ( searchTypeGroup == "nang_cao" ) 
	{
		tempParamValue = document.getElementById("muc_gia_tu").value;
		if ( tempParamValue != "" && tempParamValue != "Từ" && tempParamValue != "Đến" )
		{
			//if ( isNaN( tempParamValue ) )
			if ( isNaN( tempParamValue.replace( /\,/g,"" ) ) )
			{
				alert( "Mức giá từ phải là kiểu số" );
				document.getElementById("muc_gia_tu").focus();
				return false;
			}
		}
	
		tempParamValue = document.getElementById("muc_gia_den").value;
		if ( tempParamValue != "" && tempParamValue != "Từ" && tempParamValue != "Đến" )
		{
			// if ( isNaN( tempParamValue ) )
			if ( isNaN( tempParamValue.replace( /\,/g,"" ) ) )
			{
				alert( "Mức giá đến phải là kiểu số" );
				document.getElementById("muc_gia_den").focus();
				return false;
			}
		}

		tempParamValue = document.getElementById("dien_tich_su_dung_tu").value;
		if ( tempParamValue != "" && tempParamValue != "Từ" && tempParamValue != "Đến" )
		{
			if ( isNaN( tempParamValue ) )
			{
				alert( "Diện tích sử dụng từ phải là kiểu số" );
				document.getElementById("dien_tich_su_dung_tu").focus();
				return false;
			}
		}
	
		tempParamValue = document.getElementById("dien_tich_su_dung_den").value;
		if ( tempParamValue != "" && tempParamValue != "Từ" && tempParamValue != "Đến" )
		{
			if ( isNaN( tempParamValue ) )
			{
				alert( "Diện tích sử dụng đến phải là kiểu số" );
				document.getElementById("dien_tich_su_dung_den").focus();
				return false;
			}
		}

		tempParamValue = document.getElementById("phong_ngu_tu").value;
		if ( tempParamValue != "" && tempParamValue != "Từ" && tempParamValue != "Đến" )
		{
			if ( isNaN( tempParamValue ) )
			{
				alert( "Phòng ngủ từ phải là kiểu số" );
				document.getElementById("phong_ngu_tu").focus();
				return false;
			}
		}
	
		tempParamValue = document.getElementById("phong_ngu_den").value;
		if ( tempParamValue != "" && tempParamValue != "Từ" && tempParamValue != "Đến" )
		{
			if ( isNaN( tempParamValue ) )
			{
				alert( "Phòng ngủ đến phải là kiểu số" );
				document.getElementById("phong_ngu_den").focus();
				return false;
			}
		}

		tempParamValue = document.getElementById("phong_tam_tu").value;
		if ( tempParamValue != "" && tempParamValue != "Từ" && tempParamValue != "Đến" )
		{
			if ( isNaN( tempParamValue ) )
			{
				alert( "Phòng tắm từ phải là kiểu số" );
				document.getElementById("phong_tam_tu").focus();
				return false;
			}
		}
	
		tempParamValue = document.getElementById("phong_tam_den").value;
		if ( tempParamValue != "" && tempParamValue != "Từ" && tempParamValue != "Đến" )
		{
			if ( isNaN( tempParamValue ) )
			{
				alert( "Phòng tắm đến phải là kiểu số" );
				document.getElementById("phong_tam_den").focus();
				return false;
			}
		}

		tempParamValue = document.getElementById("dien_tich_san_tu").value;
		if ( tempParamValue != "" && tempParamValue != "Từ" && tempParamValue != "Đến" )
		{
			if ( isNaN( tempParamValue ) )
			{
				alert( "Diện tích sàn từ phải là kiểu số" );
				document.getElementById("dien_tich_san_tu").focus();
				return false;
			}
		}
	
		tempParamValue = document.getElementById("dien_tich_san_den").value;
		if ( tempParamValue != "" && tempParamValue != "Từ" && tempParamValue != "Đến" )
		{
			if ( isNaN( tempParamValue ) )
			{
				alert( "Diện tích sàn đến phải là kiểu số" );
				document.getElementById("dien_tich_san_den").focus();
				return false;
			}
		}

		tempParamValue = document.getElementById("so_tang_tu").value;
		if ( tempParamValue != "" && tempParamValue != "Từ" && tempParamValue != "Đến" )
		{
			if ( isNaN( tempParamValue ) )
			{
				alert( "Số tầng từ phải là kiểu số" );
				document.getElementById("so_tang_tu").focus();
				return false;
			}
		}
	
		tempParamValue = document.getElementById("so_tang_den").value;
		if ( tempParamValue != "" && tempParamValue != "Từ" && tempParamValue != "Đến" )
		{
			if ( isNaN( tempParamValue ) )
			{
				alert( "Số tầng đến phải là kiểu số" );
				document.getElementById("so_tang_den").focus();
				return false;
			}
		}
	}
	
	return true;
}

function getListCheckBoxValue( listCheckName )
{
	// multiselect_quan_huyen_id
	var result = "";
	$('[name="' + listCheckName + '"]').each(
		function () 
		{
			alert('value = ' + this.value);
			alert('value = ' + this.checked);
			if ( this.checked == true )
			{
				result += this.value + ",";
			}
		}		
	);
	alert('result ' + result);
	if ( result.indexOf( "," ) > 0 )
	{
		result = result.substring(0, result.length - 1);
	}	
	alert('result ' + result );
	return result;
}

function submitSearchForm( searchTypeParam )
{
	var searchTypeGroup = "co_ban";
	if ( searchTypeParam == "dk_nang_cao" || searchTypeParam == "map_nang_cao")
	{
		searchTypeGroup = "nang_cao";
	}
	
	if ( !validateSearchValue(searchTypeGroup) )
	{
		return false;
	}
	
	if ( searchType != "" && searchType != "abc" )
	{
		searchType = searchTypeParam;
	}
	
	// build sef url
	var searchURL = "<?php echo JURI::base();?>" + "nhadat/";
	var sefFieldStr = "<?php echo $sefFieldStr?>";
	var sefFieldArr = sefFieldStr.split( ',' );
	var sefFieldTypeStr = "<?php echo $sefFieldTypeStr?>";
	var sefFieldTypeArr = sefFieldTypeStr.split( ',' );
	
	var countSEFField = sefFieldArr.length;
	sefIndexStr = "";
	sefValueStr = "";
	var tempValue = "";
	var tempSearchValue = "";
	for ( var i = 0; i < countSEFField; i++ )
	{
		tempValue = "";
		tempSearchValue = "";
		if ( sefFieldTypeArr[i] == 'select' )
		{
			var selectElement = document.getElementById( sefFieldArr[i] );

			// check if multi quan huyen
			if ( selectElement != null && sefFieldArr[i] == "quan_huyen_id" )
			{
				var array_of_checked_values = $("#quan_huyen_id").val();
				//var array_of_checked_values = getListCheckBoxValue( "multiselect_quan_huyen_id" );
				tempSearchValue = array_of_checked_values;
				if ( selectElement.selectedIndex >= 0 )
				{
					tempValue = selectElement.options[selectElement.selectedIndex].title;
				}
				else 
				{
					tempValue = '';
				}
			}
			else if ( selectElement != null && sefFieldArr[i] == "du_an_id" )
			{
				//alert('index = ' + $("#select_search").searchable().selectedIndex);
				// var selectedText = document.getElementById('search_duan').value;
				// var selectedDuAnIndex = getValueFromSelectedText( 'select_search', selectedText );
				// alert( selectedText );
				// alert( selectedDuAnIndex );
				//alert( currentDuAnId );  
				//selectElement = document.getElementById('select_search');
				tempSearchValue = currentDuAnId;
				tempValue = currentDuAnTitle;
			}
			else if ( selectElement != null && ( selectElement.selectedIndex > 0 || sefFieldArr[i] == "loai_giao_dich_id") )
			{
				tempSearchValue = selectElement.options[selectElement.selectedIndex].value;
				tempValue = selectElement.options[selectElement.selectedIndex].title;
			}
		}
		else if ( sefFieldTypeArr[i] == 'text' )
		{
			if ( document.getElementById( sefFieldArr[i] ) != null )
			{
				tempValue = document.getElementById( sefFieldArr[i] ).value;
			}
		}
		
		if ( tempValue != "" )
		{
			searchURL += tempValue + "/";
			sefIndexStr += i + "-";
			sefValueStr += tempSearchValue + "-"; 
		}
	} 
	// add search & item id at the end
	
	if ( searchType == "map" || searchType == "map_nang_cao" )
	{
		searchURL += sefIndexStr + "/" + sefValueStr + "/search/244/";
	}
	else{
		searchURL += sefIndexStr + "/" + sefValueStr + "/search/229/";
	}
	
	
	searchURL += "?";
	
	// append params
	
	var cbparamStr = "<?php echo $cbparamStr?>";
	var cbparamTypeStr = "<?php echo $cbparamTypeStr?>";
	
	var paramStr = "<?php echo $paramStr?>";
	var paramTypeStr = "<?php echo $paramTypeStr?>";

	if ( searchType == "dk" || searchType == "map" )
	{
		paramStr = cbparamStr;
		paramTypeStr = cbparamTypeStr;
	}
	
	var paramArr = paramStr.split( ',' );
	var paramTypeArr = paramTypeStr.split( ',' ); 
	var countParam = paramArr.length;
	var tempParamValue = "";
	for ( i = 0; i < countParam; i++ )
	{
		tempParamValue = "";
		if ( paramTypeArr[i] == 'select' )
		{
			selectElement = document.getElementById( paramArr[i] );
			if ( selectElement != null && selectElement.selectedIndex > 0 )
			{
				tempParamValue = selectElement.options[selectElement.selectedIndex].value;
			}
		}
		else if ( paramTypeArr[i] == 'text' || paramTypeArr[i] == 'radio' )
		{
			if ( document.getElementById( paramArr[i] ) != null )
			{
				tempParamValue = document.getElementById( paramArr[i] ).value;
			}
		}	
		else if ( paramTypeArr[i] == 'check')
		{
			if ( document.getElementById( paramArr[i] ) != null )
			{
				tempParamValue = document.getElementById( paramArr[i] ).checked;
			}
		}
			
		if ( tempParamValue != "" && tempParamValue != "Từ" && tempParamValue != "Đến" )
		{
			searchURL += "&" + paramArr[i] + "=" + tempParamValue;
		}
	} 

	// them loai gia
	var loaiGiaValue = "";
	if ( searchType == "dk" || searchType == "map" )
	{
		if ( document.getElementById("loai_gia_nguyen_can").checked )
		{
			loaiGiaValue = "nguyen_can";
		}
		else 
		{
			loaiGiaValue = "m2";
		}
	}
	else if ( searchType == "dk_nang_cao" || searchType == "map_nang_cao" )
	{
		if ( document.getElementById("loai_gia_nguyen_can_nc").checked )
		{
			loaiGiaValue = "nguyen_can";
		}
		else 
		{
			loaiGiaValue = "m2";
		}
	}

	searchURL += "&loai_gia=" + loaiGiaValue;

	// lay duong pho
	if ( jQuery.trim( $("#duong_pho").val() ) )
	{
		searchURL += "&duong_pho=" + $("#duong_pho").val();
	}
	
	// lay gia tri search theo thong tin them ( list check box )
	var listThongTinThem = document.getElementsByName( "list_thong_tin_them" );
	var listThongTinThemValue="";
	for(var i = 0; i < listThongTinThem.length; i++)
	{
		if( listThongTinThem[i].checked ) 
		{
			listThongTinThemValue += '1-' + listThongTinThem[i].value + ",";
		}
	}

	if ( listThongTinThemValue != "" )
	{
		searchURL += "&thong_tin_them=" + listThongTinThemValue;
	}
	
	searchURL += "&searchType=" + searchType;
	
	searchURL = searchURL.replace( "?&", "?" );

	//alert( searchURL );
	
	// go to search url
	window.location = searchURL;
}

function submitTKKVSearchForm( formId )
{
	// build sef url
	var searchURL = "<?php echo JURI::base();?>" + "nhadat/";

	var sefIndex = "/1-2-3-/";
	var sefIndexValue = "";
	
	// build sef loai bds
	var loaiBDSTKKVEle = document.getElementById("loai_bds_tkkv_id");
	if ( loaiBDSTKKVEle.options.length > 0 )
	{
		searchURL += loaiBDSTKKVEle.options[loaiBDSTKKVEle.selectedIndex].title + "/";
		sefIndexValue += loaiBDSTKKVEle.options[loaiBDSTKKVEle.selectedIndex].value + "-";
	}
	else 
	{
		alert( "Không có bất động sản phù hợp với yêu cầu tìm kiếm" );
		return;
	}
	
	// build sef tinh thanh
	searchURL += currentTinhThanhTKKVValue + "/";
	sefIndexValue += currentTinhThanhTKKVId + "-";
	
	// build sef quan huyen
	var quanHuyenTKKVEle = document.getElementById("quan_huyen_tkkv_id");
	searchURL += quanHuyenTKKVEle[quanHuyenTKKVEle.selectedIndex].title;
	sefIndexValue += quanHuyenTKKVEle[quanHuyenTKKVEle.selectedIndex].value;
	
	// add search & item id at the end
	searchURL += sefIndex + sefIndexValue + "-/search/229/";

	searchURL += "?searchType=" + searchType;
	
	window.location = searchURL;
}

function clearDefaultValue( inputEle, defaultValue )
{
	if ( inputEle.value == defaultValue )
	{
		inputEle.value = "";
	}
}

function setDefaultValue( inputEle, defaultValue )
{
	if ( inputEle.value == "" )
	{
		inputEle.value = defaultValue;
	}	
}

function formatThousandPoint(ele, value){
	var tmp1='';
	for (i=0;i<=value.length-1;i++) if ((value[i]!=',')&&(value[i]!=' ')) tmp1+=value[i];
	if (tmp1.length>3){
		var tmp=''; var sub=''; var dem=0;		
		for (i=tmp1.length-1;i>=0;i--){
			tmp=tmp1[i]+tmp; dem++;
			if (dem%3==0){dem=0; (i==0)?sub=tmp+sub:sub= ','+tmp+sub; tmp='';}
		}			
		ele.value=tmp1.substr(0,tmp1.length%3)+sub;
	}
}

function showTKKVAdvanceSearch()
{
	searchType = "khu_vuc_nc";
	
	$("#kv_mien_nam").css("display","block");
	$("#kv_mien_trung").css("display","block");
	$("#kv_mien_bac").css("display","block");

	//$("#tknc").slideUp('slow');
	
	$("#btn_tkkv_co_ban").css("display","none");
	$("#btn_tkkv_nang_cao").css("display","block");

	$("#tknc_kv").slideToggle('slow');
	document.getElementById("mainright").style.marginTop = "225px";
}

function showTKKVBasicSearch()
{
	searchType = "khu_vuc";
	
	// an cac tinh thanh khac
	$("#kv_mien_nam").css("display","none");
	$("#kv_mien_trung").css("display","none");
	$("#kv_mien_bac").css("display","none");

	// cuon thanh tim kiem len	
	//$("#tknc").slideUp('slow');
	
	$("#btn_tkkv_co_ban").css("display","block");
	$("#btn_tkkv_nang_cao").css("display","none");

	$("#tknc_kv").slideUp('slow');
	document.getElementById("mainright").style.marginTop = "0px";
}

function setDefault()
{
	document.getElementById("tinh_thanh_id").selectedIndex = 1;
	$("#tinh_thanh_id").trigger("change");
}


function setSearchFieldDefaultValue()
{
	// khai bao mang cac field va cac gia tri mac dinh
	var defaultTextValueArr = [
		["duong_pho", ""],
		["muc_gia_toi_da", ""],
		["muc_gia_tu", "Từ"],
		["muc_gia_den", "Đến"],
		["dien_tich_su_dung_toi_thieu", ""],
		["dien_tich_su_dung_tu", "Từ"],
		["dien_tich_su_dung_den", "Đến"],
		["phong_ngu_toi_thieu", ""],
		["phong_ngu_tu", "Từ"],
		["phong_ngu_den", "Đến"],
		["phong_tam_toi_thieu", ""],
		["phong_tam_tu", "Từ"],
		["phong_tam_den", "Đến"],
		["dien_tich_san_tu", "Từ"],
		["dien_tich_san_den", "Đến"],
		["so_tang_tu", "Từ"],
		["so_tang_den", "Đến"]
	                    	];

	var count = defaultTextValueArr.length;
	var i = 0;
	for ( i = 0; i < count; i++ )
	{
		document.getElementById( defaultTextValueArr[i][0] ).value = defaultTextValueArr[i][1];
	}
	
 	var defaultRadioValueArr = [
		["chinh_chu","0"],
		["speak_english","0"],
 	                        	];
 	$("#chinh_chu").attr('checked', false);
 	$("#speak_english").attr('checked', false);
 	
 	// nguyen can / m2
	$('#loai_gia_nguyen_can_nc').attr('checked', 'checked');   	
	$('#loai_gia_nguyen_can').attr('checked', 'checked');
	//$('#loai_gia_m2_nc').attr('checked', '');
	//$('#loai_gia_m2').attr('checked', '');

 	var listCheckBoxName = "list_thong_tin_them";

	$("input[name=list_thong_tin_them]").attr('checked', false);

	var defaultSelectValueArr = [
	                     		["loai_giao_dich_id",0],
	                     		["loai_bds_id",0],
	                     		["tinh_thanh_id",0],
	                     		["quan_huyen_id",0],
	                     		["du_an_id",0],
	                     		["huong_id",0],
	                     		["tinh_trang_noi_that",0]	
	                     		                         	];

    count = defaultSelectValueArr.length;
    for ( i = 0; i < count; i++ )
    {
    	document.getElementById(defaultSelectValueArr[i][0]).selectedIndex = defaultSelectValueArr[i][0];
        $("#" + defaultSelectValueArr[i][0]).trigger("change");
    }

    document.getElementById("loai_giao_dich_id").selectedIndex = 0;
    $("#loai_giao_dich_id").trigger("change");    
}

</script>

