<link rel="stylesheet" href="<?php echo JURI::root()?>templates/mlbds/html/mod_jea_search/js/tabs.css" type="text/css" media="screen">
  <div class='clear searchmlbds'>

<ul class="tabs">
	<li id='tab1'><a href="#" class="current">
		Tìm kiếm theo điều kiện	
			<span class='itls'>
				(theo khu vực, loại bđs, diện tích, giá tiền,...)
			</span>
		</a>
	</li>
	<li id='tab2'><a href="#">Tìm kiếm theo khu vực<span class='itls'>
				(theo vùng miền, quận huyện và loại bđs)
			</span></a></li>
	<li id='tab3'><a href="#">Tìm kiếm trên bản đồ<span class='itls'>(hiển thị dưới dạng bản đồ)</span></a></li>
</ul>

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
				<li>
					<span class='tinhthanh'>
						
					</span>
					<span class='clear'>
						<?php echo $tinh_thanh;?>
					</span>
				</li>
				<li>
					<span class='quanhuyen'>
						
					</span>
					<span class='clear' id="quan_huyen_search">
						<?php echo $quan_huyen;?>
					</span>
				</li>
				<li>
					<span class='duongpho'>
						
					</span>
					<span class='clear'>
						<input id="duong_pho" name="duong_pho" type="text" 
							value="<?php if ( !empty($_GET['duong_pho']) ) echo $_GET['duong_pho']?>" 
							class="input-s1">
					</span>
				</li>
				<li>
					<span class='thuocduan'>
						
					</span>
					<span class='clear'>
						<?php echo $duAnHTML;?>
						
					</span>
				</li>
				
				<li id="dien_tich_su_dung" class="dtsd_tkdk">
					<span class='dtsd'>
						
					</span>
					<span class='clear'>
						<input id="dien_tich_su_dung_toi_thieu" name="dien_tich_su_dung_toi_thieu"
							value="<?php if ( !empty($_GET['dien_tich_su_dung_toi_thieu']) ) 
							{
								echo $_GET['dien_tich_su_dung_toi_thieu'];	
							}							
							?>" 
							type="text" class="input-s1"> 
					</span>
				</li>
				
				<li id="phong_ngu">
					<span class='phongngu'>
						
					</span>
					<span class='clear'>
						<input id="phong_ngu_toi_thieu" name="so_phong_ngu_toi_thieu"
							value="<?php if ( !empty($_GET['phong_ngu_toi_thieu']) ) echo $_GET['phong_ngu_toi_thieu']?>" 
							type="text" class="input-s1"> 
					</span>
				</li>
				
				<li id="phong_tam">
					<span class='phongtam'>
						
					</span>
					<span class='clear'>
						<input id="phong_tam_toi_thieu" name="phong_tam_toi_thieu" 
							value="<?php if ( !empty($_GET['phong_tam_toi_thieu']) ) echo $_GET['phong_tam_toi_thieu']?>"
							type="text" class="input-s1"> 
					</span>
				</li>
				
				<li id="muc_gia">
					<span class='mucgia'>
						
					</span>
					<span class='clear'>
						<div style='float:left;padding:0;height: 21px;width: 140px;'>
							<input id="muc_gia_toi_da" name="muc_gia_toi_da" type="text"
								onkeyup="formatThousandPoint(this, this.value)"
								value="<?php if ( !empty($_GET['muc_gia_toi_da']) ) echo $_GET['muc_gia_toi_da']?>" class="input-s3"> 
						</div>
						<div id="loai_gia_div" style='float: left;padding: 0;height: 20px;width: 101px;font-size: 12px;line-height: 17px;margin-top: -6px;'>
							<input id="loai_gia_nguyen_can" name="loai_gia" type="radio" 
								onclick="currentLoaiGia='nguyen_can'"
								value="nguyen_can" <?php if ( ( empty( $_GET['loai_gia'] ) || $_GET['loai_gia'] != 'm2' ) ) echo 'checked';?> />
							<label id="nguyen_can_text">nguyên căn</label>
							<br />
							<input id="loai_gia_m2" name="loai_gia" type="radio" 
								onclick="currentLoaiGia='m2'"
								value="m2" <?php if ( ( !empty( $_GET['loai_gia'] ) && $_GET['loai_gia'] == 'm2' ) ) echo 'checked';?> /><span id="m2_text">m<sup>2</sup></span>
						</div>
						
					</span>
				</li>
				
				<li style='margin-top:13px;width:122px'>
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
						type="checkbox"/> 
						Chính chủ
					</span>
				</li>
			
				
				<li>
					<span style='float:right' id="tim_kiem_co_ban">
						<input type="button" value="Tìm kiếm" class='btn-search' onclick="submitSearchForm('abc')">
						<span class='clear check'>
							<a href="javascript:;" onclick="showAdvanceSearch()" class='link'>Tìm kiếm nâng cao </a>
						</span>
					</span>
				</li>
			</ul>
			</div>
		<div id="tknc" style=''>
<!--		<span class='clear check'>-->
<!--							<a href="javascript:;" onclick="showBasicSearch()" class='link'>Tìm kiếm nâng cao </a>-->
<!--						</span>-->
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
							onclick="clearDefaultValue( this, 'Từ' )" onblur="setDefaultValue( this, 'Từ' )"> 
						<input id="dien_tich_su_dung_den" name="dien_tich_su_dung_den" type="text" class="input-s2" 
							value="<?php if ( !empty( $_GET['dien_tich_su_dung_den'] ) ) {
								echo $_GET['dien_tich_su_dung_den']; 
							} else { echo 'Đến'; }
							?>"
							onclick="clearDefaultValue( this, 'Đến' )" onblur="setDefaultValue( this, 'Đến' )"> 
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
							onclick="clearDefaultValue( this, 'Từ' )" onblur="setDefaultValue( this, 'Từ' )"> 
						<input id="phong_ngu_den" name="phong_ngu_den" type="text" class="input-s2" 
							value="<?php if ( !empty( $_GET['phong_ngu_den'] ) ) {
								echo $_GET['phong_ngu_den']; 
							} else { echo 'Đến'; }
							?>"
							onclick="clearDefaultValue( this, 'Đến' )" onblur="setDefaultValue( this, 'Đến' )"> 
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
							onclick="clearDefaultValue( this, 'Từ' )" onblur="setDefaultValue( this, 'Từ' )"> 
						<input id="dien_tich_san_den" name="dien_tich_san_den" type="text" class="input-s2" 
							value="<?php if ( !empty( $_GET['dien_tich_san_den'] ) ) {
								echo $_GET['dien_tich_san_den']; 
							} else { echo 'Đến'; }
							?>"
							onclick="clearDefaultValue( this, 'Đến' )" onblur="setDefaultValue( this, 'Đến' )"> 
					</span>
			</li>
			
			<li id="phong_tam_nc">
					<span class="sophongtam">
						
					</span>
					<span class="clear">
						<input id="phong_tam_tu" name="phong_tam_tu" type="text" class="input-s2" 
							value="<?php if ( !empty( $_GET['phong_tam_tu'] ) ) {
								echo $_GET['phong_tam_tu']; 
							} else { echo 'Từ'; }
							?>"
							onclick="clearDefaultValue( this, 'Từ' )" onblur="setDefaultValue( this, 'Từ' )"> 
						<input id="phong_tam_den" name="phong_tam_den" type="text" class="input-s2" 
							value="<?php if ( !empty( $_GET['phong_tam_den'] ) ) {
								echo $_GET['phong_tam_den']; 
							} else { echo 'Đến'; }
							?>"
							onclick="clearDefaultValue( this, 'Đến' )" onblur="setDefaultValue( this, 'Đến' )"> 
					</span>
			</li>
			
			<li id="muc_gia_nc" class='muc_gia_nc'>
					<span class='mucgia1 muc_gia_nc'>
						
					</span>
					<span class='clear'>
						<div style='float:left;padding:0;height: 21px;width: 230px;'>
							<input id="muc_gia_tu" name="muc_gia_tu" style='width:105px' type="text" class="input-s2" 
								onkeyup="formatThousandPoint(this, this.value)"
								value="<?php if ( !empty( $_GET['muc_gia_tu'] ) ) {
								echo $_GET['muc_gia_tu']; 
							} else { echo 'Từ'; }
							?>"
								onclick="clearDefaultValue( this, 'Từ' )" onblur="setDefaultValue( this, 'Từ' )">
							<input id="muc_gia_den" style='width:105px' name="muc_gia_den" type="text" class="input-s2" 
								onkeyup="formatThousandPoint(this, this.value)"
								value="<?php if ( !empty( $_GET['muc_gia_den'] ) ) {
								echo $_GET['muc_gia_den']; 
							} else { echo 'Đến'; }
							?>"onclick="clearDefaultValue( this, 'Đến' )" onblur="setDefaultValue( this, 'Đến' )">
						</div>
						<div style='float: left;padding: 0;height: 20px;width: 93px;font-size: 12px;line-height: 17px;margin-top: -6px;'>
							<input id="loai_gia_nguyen_can_nc" name="loai_gia_nc" type="radio" 
								onclick="currentLoaiGia='nguyen_can'"
								value="nguyen_can" <?php if ( ( empty( $_GET['loai_gia'] ) || $_GET['loai_gia'] != 'm2' ) ) echo 'checked';?> />
							<label id="nguyen_can_text_nc">nguyên căn</label>
							<input id="loai_gia_m2_nc" name="loai_gia_nc" type="radio" 
								onclick="currentLoaiGia='m2'"
								value="m2" <?php if ( ( !empty( $_GET['loai_gia'] ) && $_GET['loai_gia'] == 'm2' ) ) echo 'checked';?> />
							<span id="m2_text_nc">m<sup>2</sup></span>
						</div>
						
					</span>
				</li>
			
			<li>
					<span class="sotang">
					
					</span>
					<span class="clear">
						<input id="so_tang_tu" name="so_tang_tu" type="text" class="input-s2"
							value="<?php if ( !empty( $_GET['so_tang_tu'] ) ) {
								echo $_GET['so_tang_tu']; 
							} else { echo 'Từ'; }
							?>"
							onclick="clearDefaultValue( this, 'Từ' )" onblur="setDefaultValue( this, 'Từ' )"> 
						<input id="so_tang_den" name="so_tang_den" type="text" class="input-s2" 
							value="<?php if ( !empty( $_GET['so_tang_den'] ) ) {
								echo $_GET['so_tang_den']; 
							} else { echo 'Đến'; }
							?>"
							onclick="clearDefaultValue( this, 'Đến' )" onblur="setDefaultValue( this, 'Đến' )"> 
					</span>
			</li>
			<li>
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
			<li class='clear' style='width:80%;margin-right:0'>
					<span class="csvc">
					
					</span>
					<span class="clear">
					<!-- tien ich -->
						<?php echo $tienIchHTML;?>
					</span>
			</li>
			<li style="padding-top: 17px;" id="tim_kiem_nang_cao">
					<span style="float:right">
						<input type="button" value="Tìm kiếm" class="btn-search" onclick="submitSearchForm('abc')">
						<span class="clear check">
							<a href="javascript:;" onclick="showBasicSearch()" class="link">Tìm kiếm nhanh</a>
						</span>
					</span>
				</li>
		</ul>
				
		</div>
		</div>

	</div>
<!-- end tiềm kiếm theo điều kiện -->
	<div class='search-dk' style="display: none; ">
		<div class='search-area'>
			<ul>
				<li style='width:208px;margin-right:0;'>
					<span class='mienbac'>
					
					</span>
					<span class='clear1'>
						 <a 
						 	<?php if ( $ix_tinh_thanh_id == 2 ) {?>
							style="color:red" 
							<?php }?>
						 	id="ha-noi" class="tinh_thanh_list" href='javascript:void();' title='2'>Hà Nội</a>
					</span>
					<span class='clear1'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 14 ) {?>
							style="color:red" 
							<?php }?>
							id="bac-ninh" class="tinh_thanh_list" href='javascript:void();' title='14'>Bắc Ninh</a>
					</span>
					<span class='clear1'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 35 ) {?>
							style="color:red" 
							<?php }?>
							id="hai-phong" class="tinh_thanh_list" href='javascript:void();' title='35'>Hải Phòng</a>
					</span>
					
					<span class='clear1'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 34 ) {?>
							style="color:red" 
							<?php }?>
							id="hai-duong" class="tinh_thanh_list" href='javascript:void();' title='34'>Hải Dương</a>
					</span>
					<span class='clear1'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 47 ) {?>
							style="color:red" 
							<?php }?>
							id="nam-dinh" class="tinh_thanh_list" href='javascript:void();' title='47'>Nam Định</a>
					</span>
					<span class='clear1'>
							<a 
								<?php if ( $ix_tinh_thanh_id == 56 ) {?>
								style="color:red" 
								<?php }?>
								id="quang-ninh" class="tinh_thanh_list" href='javascript:void();' title='56'>Quảng Ninh</a>
					</span>
					<span class='clear1'>
							<a 
								<?php if ( $ix_tinh_thanh_id == 30 ) {?>
								style="color:red" 
								<?php }?>
								id="ha-giang" class="tinh_thanh_list" href='javascript:void();' title='30'>Hà Giang</a>
						</span>
						<span class='clear1'>
							<a 
								<?php if ( $ix_tinh_thanh_id == 21 ) {?>
								style="color:red" 
								<?php }?>
								id="cao-bang" class="tinh_thanh_list" href='javascript:void();' title='21'>Cao Bằng</a>
						</span>
						
						<span class='clear1'>
							<a 
								<?php if ( $ix_tinh_thanh_id == 45 ) {?>
								style="color:red" 
								<?php }?>
								id="lao-cai" class="tinh_thanh_list" href='javascript:void();' title='45'>Lào Cai</a>
						</span>
						<span class='clear1'>
							<a 
								<?php if ( $ix_tinh_thanh_id == 12 ) {?>
								style="color:red" 
								<?php }?>
								id="bac-kan" class="tinh_thanh_list" href='javascript:void();' title='12'>Bắc Kạn</a>
						</span>
						<span class='clear1'>
							<a 
								<?php if ( $ix_tinh_thanh_id == 44 ) {?>
								style="color:red" 
								<?php }?>
								id="lang-son" class="tinh_thanh_list" href='javascript:void();' title='44'>Lạng Sơn</a>
						</span>
						<span class='clear1'>
							<a 
								<?php if ( $ix_tinh_thanh_id == 67 ) {?>
								style="color:red" 
								<?php }?>
								id="tuyen-quang" class="tinh_thanh_list" href='javascript:void();' title='67'>Tuyên Quang</a>
						</span>
						
						<span class='clear1'>
							<a 
								<?php if ( $ix_tinh_thanh_id == 70 ) {?>
								style="color:red" 
								<?php }?>
								id="yen-bai" class="tinh_thanh_list" href='javascript:void();' title='70'>Yên Bái</a>
						</span>
						<span class='clear1'>
							<a 
								<?php if ( $ix_tinh_thanh_id == 62 ) {?>
								style="color:red" 
								<?php }?>
								id="thai-nguyen" class="tinh_thanh_list" href='javascript:void();' title='62'>Thái Nguyên</a>
						</span>
					
						
						
					<!-- <div id="kv_mien_bac" style="display:none">
						
						
						
						
						
						<span class='clear'>
							<a 
								<?php if ( $ix_tinh_thanh_id == 42 ) {?>
								style="color:red" 
								<?php }?>
								id="lai-chau" class="tinh_thanh_list" href='javascript:void();' title='42'>Lai Châu</a>
						</span>
						<span class='clear'>
							<a 
								<?php if ( $ix_tinh_thanh_id == 59 ) {?>
								style="color:red" 
								<?php }?>
								id="son-la" class="tinh_thanh_list" href='javascript:void();' title='59'>Sơn La</a>
						</span>
						<span class='clear'>
							<a 
								<?php if ( $ix_tinh_thanh_id == 37 ) {?>
								style="color:red" 
								<?php }?>
								id="hoa-binh" class="tinh_thanh_list" href='javascript:void();' title='37'>Hoà Bình</a>
						</span>
						<span class='clear'>
							<a 
								<?php if ( $ix_tinh_thanh_id == 31 ) {?>
								style="color:red" 
								<?php }?>
								id="ha-nam" class="tinh_thanh_list" href='javascript:void();' title='31'>Hà Nam</a>
						</span>
						<span class='clear'>
							<a 
								<?php if ( $ix_tinh_thanh_id == 38 ) {?>
								style="color:red" 
								<?php }?>
								id="hung-yen" class="tinh_thanh_list" href='javascript:void();' title='38'>Hưng Yên</a>
						</span>
						<span class='clear'>
							<a 
								<?php if ( $ix_tinh_thanh_id == 69 ) {?>
								style="color:red" 
								<?php }?>
								id="vinh-phuc" class="tinh_thanh_list" href='javascript:void();' title='69'>Vĩnh Phúc</a>
						</span>
						
						<span class='clear'>
							<a 
								<?php if ( $ix_tinh_thanh_id == 49 ) {?>
								style="color:red" 
								<?php }?>
								id="ninh-binh" class="tinh_thanh_list" href='javascript:void();' title='49'>Ninh Bình</a>
						</span>
						<span class='clear'>
							<a 
								<?php if ( $ix_tinh_thanh_id == 49 ) {?>
								style="color:red" 
								<?php }?>
								id="ninh-binh" class="tinh_thanh_list" href='javascript:void();' title='49'>Ninh Bình</a>
						</span>
						<span class='clear'>
							<a 
								<?php if ( $ix_tinh_thanh_id == 61 ) {?>
								style="color:red" 
								<?php }?>
								id="thai-binh" class="tinh_thanh_list" href='javascript:void();' title='61'>Thái Bình</a>
						</span>
					</div> -->
					<!-- end div cac tinh mien bac -->
					
				</li>
				<li style='margin-right:0'>
					<span class='mientrung'>
					
					</span>
					
					<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 5 ) {?>
							style="color:red" 
							<?php }?>
							id="da-nang" class="tinh_thanh_list" href='javascript:void();' title='5'>Đà Nẵng</a>
					</span>
					<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 64 ) {?>
							style="color:red" 
							<?php }?>
							id="hue" class="tinh_thanh_list" href='javascript:void();' title='64'>Huế</a>
					</span>
					<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 48 ) {?>
							style="color:red" 
							<?php }?>
							id="nghe-an" class="tinh_thanh_list" href='javascript:void();' title='48'>Nghệ An</a>
					</span>
					<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 39 ) {?>
							style="color:red" 
							<?php }?>
							id="khanh-hoa" class="tinh_thanh_list" href='javascript:void();' title='39'>Khánh Hoà</a>
					</span>
					<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 52 ) {?>
							style="color:red" 
							<?php }?>
							id="phu-yen" class="tinh_thanh_list" href='javascript:void();' title='52'>Phú Yên</a>
					</span>
					<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 63 ) {?>
							style="color:red" 
							<?php }?>
							id="thanh-hoa" class="tinh_thanh_list" href='javascript:void();' title='63'>Thanh Hoá</a>
					</span>
					<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 17 ) {?>
							style="color:red" 
							<?php }?>
							id="binh-dinh" class="tinh_thanh_list" href='javascript:void();' title='17'>Bình Định</a>
						</span>
					<!-- <div id="kv_mien_trung" style="display:none">
						
						<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 33 ) {?>
							style="color:red" 
							<?php }?>
							id="ha-tinh" class="tinh_thanh_list" href='javascript:void();' title='33'>Hà Tĩnh</a>
						</span>
						<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 53 ) {?>
							style="color:red" 
							<?php }?>
							id="quang-binh" class="tinh_thanh_list" href='javascript:void();' title='53'>Quảng Bình</a>
						</span>
						<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 57 ) {?>
							style="color:red" 
							<?php }?>
							id="quang-tri" class="tinh_thanh_list" href='javascript:void();' title='57'>Quảng Trị</a>
						</span>
						<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 54 ) {?>
							style="color:red" 
							<?php }?>
							id="quang-nam" class="tinh_thanh_list" href='javascript:void();' title='54'>Quảng Nam</a>
						</span>
						<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 55 ) {?>
							style="color:red" 
							<?php }?>
							id="quang-ngai" class="tinh_thanh_list" href='javascript:void();' title='55'>Quảng Ngãi</a>
						</span>
						<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 50 ) {?>
							style="color:red" 
							<?php }?>
							id="ninh-thuan" class="tinh_thanh_list" href='javascript:void();' title='50'>Ninh Thuận</a>
						</span>
						<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 19 ) {?>
							style="color:red" 
							<?php }?>
							id="binh-thuan" class="tinh_thanh_list" href='javascript:void();' title='19'>Bình Thuận</a>
						</span>
					</div> -->
					
				</li>
				<li style='margin-right:0's>
					<span class='miennam'>
					
					</span>
					
					<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 1 || $ix_tinh_thanh_id == 0 ) {?>
							style="color:red" 
							<?php }?>
							id="tp-ho-chi-minh" class="tinh_thanh_list" href='javascript:void();' title='1'>TP.Hồ Chí Minh</a>
					</span>
					<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 16 ) {?>
							style="color:red" 
							<?php }?>
							id="binh-duong" class="tinh_thanh_list" href='javascript:void();' title='16'>Bình Dương</a>
					</span>
					<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 27 ) {?>
							style="color:red" 
							<?php }?>
							id="dong-nai" class="tinh_thanh_list" href='javascript:void();' title='27'>Đồng Nai</a>
					</span>
					<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 22 ) {?>
							style="color:red" 
							<?php }?>
							id="can-tho" class="tinh_thanh_list" href='javascript:void();' title='22'>Cần Thơ</a>
					</span>
					<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 10 ) {?>
							style="color:red" 
							<?php }?>
							id="ba-ria-vung-tau" class="tinh_thanh_list" href='javascript:void();' title='10'>Bà Rịa Vũng Tàu</a>
					</span>
					<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 46 ) {?>
							style="color:red" 
							<?php }?>
							id="long-an" class="tinh_thanh_list" href='javascript:void();' title='46'>Long An</a>
					</span>
					<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 18 ) {?>
							style="color:red" 
							<?php }?>
							id="binh-phuoc" class="tinh_thanh_list" href='javascript:void();' title='18'>Bình Phước</a>
						</span>
					<!-- <div id="kv_mien_nam" style="display:none">
						
						<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 28 ) {?>
							style="color:red" 
							<?php }?>
							id="dong-thap" class="tinh_thanh_list" href='javascript:void();' title='28'>Đồng Tháp</a>
						</span>
						<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 65 ) {?>
							style="color:red" 
							<?php }?>
							id="tien-giang" class="tinh_thanh_list" href='javascript:void();' title='28'>Tiền Giang</a>
						</span>
						<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 9 ) {?>
							style="color:red" 
							<?php }?>
							id="an-giang" class="tinh_thanh_list" href='javascript:void();' title='9'>An Giang</a>
						</span>
						<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 15 ) {?>
							style="color:red" 
							<?php }?>
							id="ben-tre" class="tinh_thanh_list" href='javascript:void();' title='15'>Bến Tre</a>
						</span>
						<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 68 ) {?>
							style="color:red" 
							<?php }?>
							id="vinh-long" class="tinh_thanh_list" href='javascript:void();' title='68'>Vĩnh Long</a>
						</span>
						<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 66 ) {?>
							style="color:red" 
							<?php }?>
							id="tra-vinh" class="tinh_thanh_list" href='javascript:void();' title='68'>Trà Vinh</a>
						</span>
						<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 36 ) {?>
							style="color:red" 
							<?php }?>
							id="hau-giang" class="tinh_thanh_list" href='javascript:void();' title='36'>Hậu Giang</a>
						</span>
						<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 40 ) {?>
							style="color:red" 
							<?php }?>
							id="kien-giang" class="tinh_thanh_list" href='javascript:void();' title='36'>Kiên Giang</a>
						</span>
						<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 58 ) {?>
							style="color:red" 
							<?php }?>
							id="soc-trang" class="tinh_thanh_list" href='javascript:void();' title='58'>Sóc Trăng</a>
						</span>
						<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 11 ) {?>
							style="color:red" 
							<?php }?>
							id="bac-lieu" class="tinh_thanh_list" href='javascript:void();' title='58'>Bạc Liêu</a>
						</span>
						<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 20 ) {?>
							style="color:red" 
							<?php }?>
							id="ca-mau" class="tinh_thanh_list" href='javascript:void();' title='58'>Cà Mau</a>
						</span>
					</div> -->
				</li>
				<li style='margin-right:0'>
					<span class="quanhuyen">
						
					</span>
					
					<span class="clear">
						<?php echo $quanHuyenTKKVHTML?>
					</span>
					<span class="lbds" style="margin-top: 10px">
					</span>
					<span class="clear">
						<?php echo $loai_bds_tkkv?>
					</span>
					<span style="float:right;margin-top: 5px">
						<input type="button" value="Tìm kiếm" class="btn-search" onclick="submitTKKVSearchForm('abc')">
						<span id="btn_tkkv_co_ban" class='clear check'>
							<a href="javascript:;" onclick="showTKKVAdvanceSearch()" class='link'>Tìm kiếm nâng cao </a>
						</span>
						<span id="btn_tkkv_nang_cao" class='clear check' style="display:none">
							<a href="javascript:;" onclick="showTKKVBasicSearch()" class='link'>Tìm kiếm cơ bản </a>
						</span>
					</span>
				</li>
			</ul>
		</div>
	
		<div id="tknc_kv" style="display:none">
			<ul>
				<li style="width:208px;margin-right:0">
						
						<span class='clear1'>
							<a 
								<?php if ( $ix_tinh_thanh_id == 51 ) {?>
								style="color:red" 
								<?php }?>
								id="phu-tho" class="tinh_thanh_list bt" href='javascript:void();' title='51'>Phú Thọ</a>
						</span>
						<span class='clear1'>
							<a 
								<?php if ( $ix_tinh_thanh_id == 13 ) {?>
								style="color:red" 
								<?php }?>
								id="bac-giang" class="tinh_thanh_list bt" href='javascript:void();' title='13'>Bắc Giang</a>
						</span>
					
						<span class='clear1'>
							<a 
								<?php if ( $ix_tinh_thanh_id == 26 ) {?>
								style="color:red" 
								<?php }?>
								id="dien-bien" class="tinh_thanh_list bt" href='javascript:void();' title='26'>Điện Biên</a>
						</span>
						<span class='clear1'>
							<a 
								<?php if ( $ix_tinh_thanh_id == 42 ) {?>
								style="color:red" 
								<?php }?>
								id="lai-chau" class="tinh_thanh_list bt" href='javascript:void();' title='42'>Lai Châu</a>
						</span>
						<span class='clear1'>
							<a 
								<?php if ( $ix_tinh_thanh_id == 59 ) {?>
								style="color:red" 
								<?php }?>
								id="son-la" class="tinh_thanh_list bt" href='javascript:void();' title='59'>Sơn La</a>
						</span>
						<span class='clear1'>
							<a 
								<?php if ( $ix_tinh_thanh_id == 37 ) {?>
								style="color:red" 
								<?php }?>
								id="hoa-binh" class="tinh_thanh_list bt" href='javascript:void();' title='37'>Hoà Bình</a>
						</span>
						<span class='clear1'>
							<a 
								<?php if ( $ix_tinh_thanh_id == 31 ) {?>
								style="color:red" 
								<?php }?>
								id="ha-nam" class="tinh_thanh_list bt" href='javascript:void();' title='31'>Hà Nam</a>
						</span>
						<span class='clear1'>
							<a 
								<?php if ( $ix_tinh_thanh_id == 38 ) {?>
								style="color:red" 
								<?php }?>
								id="hung-yen" class="tinh_thanh_list bt" href='javascript:void();' title='38'>Hưng Yên</a>
						</span>
						<span class='clear1'>
							<a 
								<?php if ( $ix_tinh_thanh_id == 69 ) {?>
								style="color:red" 
								<?php }?>
								id="vinh-phuc" class="tinh_thanh_list bt" href='javascript:void();' title='69'>Vĩnh Phúc</a>
						</span>
					
						<span class='clear1'>
							<a 
								<?php if ( $ix_tinh_thanh_id == 49 ) {?>
								style="color:red" 
								<?php }?>
								id="ninh-binh" class="tinh_thanh_list bt" href='javascript:void();' title='49'>Ninh Bình</a>
						</span>
					
						<span class='clear1'>
							<a 
								<?php if ( $ix_tinh_thanh_id == 61 ) {?>
								style="color:red" 
								<?php }?>
								id="thai-binh" class="tinh_thanh_list bt" href='javascript:void();' title='61'>Thái Bình</a>
						</span>
					<!-- end div cac tinh mien bac -->
				</li>
				<li style="width:150px;margin-right:0">
						<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 33 ) {?>
							style="color:red" 
							<?php }?>
							id="ha-tinh" class="tinh_thanh_list bt" href='javascript:void();' title='33'>Hà Tĩnh</a>
						</span>
						<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 53 ) {?>
							style="color:red" 
							<?php }?>
							id="quang-binh" class="tinh_thanh_list bt" href='javascript:void();' title='53'>Quảng Bình</a>
						</span>
						<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 57 ) {?>
							style="color:red" 
							<?php }?>
							id="quang-tri" class="tinh_thanh_list bt" href='javascript:void();' title='57'>Quảng Trị</a>
						</span>
						<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 54 ) {?>
							style="color:red" 
							<?php }?>
							id="quang-nam" class="tinh_thanh_list bt" href='javascript:void();' title='54'>Quảng Nam</a>
						</span>
						<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 55 ) {?>
							style="color:red" 
							<?php }?>
							id="quang-ngai" class="tinh_thanh_list bt" href='javascript:void();' title='55'>Quảng Ngãi</a>
						</span>
						<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 50 ) {?>
							style="color:red" 
							<?php }?>
							id="ninh-thuan" class="tinh_thanh_list bt" href='javascript:void();' title='50'>Ninh Thuận</a>
						</span>
						<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 19 ) {?>
							style="color:red" 
							<?php }?>
							id="binh-thuan" class="tinh_thanh_list bt" href='javascript:void();' title='19'>Bình Thuận</a>
						</span>
				</li>
				
				<li style="width:150px;margin-right:0">
						<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 28 ) {?>
							style="color:red" 
							<?php }?>
							id="dong-thap" class="tinh_thanh_list bt" href='javascript:void();' title='28'>Đồng Tháp</a>
						</span>
						<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 65 ) {?>
							style="color:red" 
							<?php }?>
							id="tien-giang" class="tinh_thanh_list bt" href='javascript:void();' title='28'>Tiền Giang</a>
						</span>
						<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 9 ) {?>
							style="color:red" 
							<?php }?>
							id="an-giang" class="tinh_thanh_list bt" href='javascript:void();' title='9'>An Giang</a>
						</span>
						<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 15 ) {?>
							style="color:red" 
							<?php }?>
							id="ben-tre" class="tinh_thanh_list bt" href='javascript:void();' title='15'>Bến Tre</a>
						</span>
						<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 68 ) {?>
							style="color:red" 
							<?php }?>
							id="vinh-long" class="tinh_thanh_list bt" href='javascript:void();' title='68'>Vĩnh Long</a>
						</span>
						<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 66 ) {?>
							style="color:red" 
							<?php }?>
							id="tra-vinh" class="tinh_thanh_list bt" href='javascript:void();' title='68'>Trà Vinh</a>
						</span>
						<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 36 ) {?>
							style="color:red" 
							<?php }?>
							id="hau-giang" class="tinh_thanh_list bt" href='javascript:void();' title='36'>Hậu Giang</a>
						</span>
						<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 40 ) {?>
							style="color:red" 
							<?php }?>
							id="kien-giang" class="tinh_thanh_list bt" href='javascript:void();' title='36'>Kiên Giang</a>
						</span>
						<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 58 ) {?>
							style="color:red" 
							<?php }?>
							id="soc-trang" class="tinh_thanh_list bt" href='javascript:void();' title='58'>Sóc Trăng</a>
						</span>
						<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 11 ) {?>
							style="color:red" 
							<?php }?>
							id="bac-lieu" class="tinh_thanh_list bt" href='javascript:void();' title='11'>Bạc Liêu</a>
						</span>
						<span class='clear'>
						<a 
							<?php if ( $ix_tinh_thanh_id == 20 ) {?>
							style="color:red" 
							<?php }?>
							id="ca-mau" class="tinh_thanh_list bt" href='javascript:void();' title='20'>Cà Mau</a>
						</span>
				</li>
			</ul>
		</div>
	
	
	
	</div>
	<div id="search_map" class='search-dk' style="display: none; ">
	<div>
		<div class='show-search'>
			<ul>
				<li>
					<span class='lgd'>
						
					</span>
					<span class='clear'>
						<select class='input-s'>
							<option>
								Cần bán
							</option>
						</select>
						
					</span>
				</li>
				<li>
					<span class='lbds'>
						
					</span>
					<span class='clear'>
						<select class='input-s'>
							<option>
								Bất kỳ
							</option>
						</select>
						
					</span>
				</li>
				<li>
					<span class='tinhthanh'>
						
					</span>
					<span class='clear'>
						<select class='input-s'>
							<option>
								Tất cả
							</option>
						</select>
						
					</span>
				</li>
				<li>
					<span class='quanhuyen'>
						
					</span>
					<span class='clear'>
						<select class='input-s'>
							<option>
								Tất cả
							</option>
						</select>
						
					</span>
				</li>
				<li>
					<span class='duongpho'>
						
					</span>
					<span class='clear'>
						<select class='input-s'>
							<option>
								Tất cả
							</option>
						</select>
						
					</span>
				</li>
				<li>
					<span class='thuocduan'>
						
					</span>
					<span class='clear'>
						<select class='input-s'>
							<option>
								Tất cả
							</option>
						</select>
						
					</span>
				</li>
				<li>
					<span class='dtsd'>
						
					</span>
					<span class='clear'>
					<input type="text" class="input-s1"> 
						
						
					</span>
				</li>
				<li>
					<span class='phongngu'>
						
					</span>
					<span class='clear'>
						<input type="text" class="input-s1"> 
						
					</span>
				</li>
				<li>
					<span class='phongtam'>
						
					</span>
					<span class='clear'>
						<input type="text" class="input-s1"> 
						
					</span>
				</li>
				<li>
					<span class='mucgia'>
						
					</span>
					<span class='clear'>
						<div style='float:left;padding:0;height: 21px;width: 140px;'>
							<input type="text" class="input-s2"> VND
						</div>
						<div style='float: left;padding: 0;height: 20px;width: 83px;font-size: 12px;line-height: 12px;margin-top: -6px;'>
							<input type="radio" value="nguyên căn" checked='checked'>nguyên căn
							<input type="radio" value="chính chủ">chính chủ
						</div>
						
					</span>
				</li>
				<li style='margin-top:13px;'>
					<span class='clear check'>
						<input type="checkbox" /> 
							Speak English
					</span>
					<span class='clear check'>
					<input type="checkbox" /> 
						Chính chủ
					</span>
				</li>
				<li>
					<span style='float:right'>
						<input type="button" value="Tìm kiếm" class='btn-search' onclick="submitSearchForm( 'abc' )">
						<span class='clear check'>
							<a href="#" onclick="showFind()" class='link'>Tìm kiếm nâng cao </a>
						</span>
					</span>
				</li>
			</ul>
			</div>
		<div id="tknc" style='clear:both;z-index:9999;position: absolute ;height:100px;background:#99defd;border-top: 4px solid #01459B;background: #99DEFD;border-bottom: 4px solid #01459B;'>
		<ul>
			<li>
					<span class="dientichsan">
						
					</span>
					<span class="clear">
						<input type="text" class="input-s2" value='Từ'> 
						<input type="text" class="input-s2" value='Đến'> 
					</span>
			</li>
			<li>
					<span class="sotang">
					
					</span>
					<span class="clear">
						<input type="text" class="input-s2" value='Từ'> 
						<input type="text" class="input-s2" value='Đến'> 
					</span>
			</li>
			<li class='clear'>
					<span class="csvc">
					
					</span>
					<span class="clear">
						<span class='ck'><input type="checkbox"> 
							Thích hợp ở
						</span>
						<span class='ck'><input type="checkbox"> 
							Thích hợp ở
						</span class='ck'>
						<span><input type="checkbox"> 
							Thích hợp ở
						</span>
					</span>
			</li>
		</ul>
		</div>
		</div>
	</div>
</div>
  </div>
<script type="text/javascript" src="<?php echo JURI::root()?>templates/mlbds/js/jquery-1.4.4.js"></script>
<script src="<?php echo JURI::root()?>templates/mlbds/html/mod_jea_search/js/jquery.tools.min.js"></script>
<script src="<?php echo JURI::root()?>libraries/js/ajax.js"></script>
<script type="text/javascript">

var currentTinhThanhTKKVId = 1;
var currentTinhThanhTKKVValue = "tp.ho-chi-minh";

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

	// change nguyen can, m2
	/*if ( currentLoaiGia == "m2" )
	{
		if ( searchType == "nang_cao" )
		{
			$("#loai_gia_m2_nc").attr( 'checked', true );
			$("#loai_gia_nguyen_can_nc").removeAttr( 'checked' );
		}
		else if ( searchType == "co_ban" )
		{
			$("#loai_gia_m2").attr( 'checked', true );
			$("#loai_gia_nguyen_can").removeAttr( 'checked' );
		}
	} else
	{
		if ( searchTYpe == "nang_cao" )
		{
			$("#loai_gia_nguyen_can_nc").attr( 'checked', true );
			$("#loai_gia_m2_nc").removeAttr( 'checked' );
		}
		else if ( searchType == "co_ban" )
		{
			$("#loai_gia_nguyen_can").attr( 'checked', true );
			$("#loai_gia_m2").removeAttr( 'checked' );
		}
	}*/
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
    $("ul.tabs").tabs("div.panes > div");
	$("#tknc").css('display','none');

	if ( searchType == "map" )
	{
		$("ul.tabs").data("tabs").click(2);
		$('#tab1 a.current').removeClass("current");
	}

	else if ( searchType == "khu_vuc" )
	{
		$("ul.tabs").data("tabs").click(1);
		$('#tab1 a.current').removeClass("current");
	}

	else if ( searchType == "khu_vuc_nc" )
	{
		$("ul.tabs").data("tabs").click(1);
		$('#tab1 a.current').removeClass("current");
		showTKKVAdvanceSearch();
	}
	
	else if ( searchType == "nang_cao" )
	{
		showAdvanceSearch();
	}
	
	// set onchange for loai giao dich ==> chuyen don vi gia
	$("#loai_giao_dich_id").change(function() {
		changeLoaiGia();
		/*if ( $("#loai_giao_dich_id").val() == "2" )
		{
			// cho thue
			//$("#muc_gia").css( 'marginRight', "0px" );
			//$("#loai_gia_div").css( 'width', "101px" );			
			
			$("#nguyen_can_text").html("nguyên căn/th");
			$("#m2_text").html("m<sup>2</sup>/th");
		}
		else 
		{
			// can ban
			//$("#muc_gia").removeAttr('style');
			//$("#loai_gia_div").css( 'width', "83px" );
				
			$("#nguyen_can_text").html("nguyên căn");
			$("#m2_text").html("m<sup>2</sup>");

		}*/
    });

	$(".tinh_thanh_list").click(function() {
		selectTinhThanh(this);
    });

	$("#tab1").click(function() {
		searchType = "co_ban";
		document.getElementById("mainright").style.marginTop = "0px";
    });
	
	$("#tab2").click(function() {
		searchType = "khu_vuc";
		document.getElementById("mainright").style.marginTop = "0px";
    });
	
	$("#tab3").click(function() {
		searchType = "map";
		$("#search_map").html( $("#search_dk").html() );
    });

	// change loai gia tuy theo loai giao dich
	changeLoaiGia();
});

function showAdvanceSearch(){

	searchType = "nang_cao";
	// change some search fields
	var searchFieldArray = new Array("dien_tich_su_dung", "phong_ngu", "phong_tam", "muc_gia");
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
		//$("#loai_gia_nguyen_can").removeAttr( 'checked' );
	}
	else 
	{
		$("#loai_gia_nguyen_can_nc").attr( 'checked', true );
		//$("#loai_gia_m2").removeAttr( 'checked' );
	}
	
	// an nut tim kiem co ban
	document.getElementById("tim_kiem_co_ban").style.display="none";
	
	$("#tknc").slideToggle('slow');

	document.getElementById("mainright").style.marginTop = "138px";
}

function showBasicSearch()
{
	searchType = "co_ban";
	
	var searchFieldArray = new Array("dien_tich_su_dung", "phong_ngu", "phong_tam", "muc_gia");
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
	document.getElementById("mainright").style.marginTop = "0px";
}

function submitSearchForm( formId )
{
	if ( searchType == "map" )
	{
		alert("Chức năng đang được cập nhật, xin vui lòng quay lại sau!");
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
			if ( selectElement != null && ( selectElement.selectedIndex > 0 || sefFieldArr[i] == "loai_giao_dich_id") )
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
	searchURL += sefIndexStr + "/" + sefValueStr + "/search/229/";

	searchURL += "?";
	
	// append params
	var paramStr = "<?php echo $paramStr?>";
	var paramArr = paramStr.split( ',' );
	var paramTypeStr = "<?php echo $paramTypeStr?>";
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
	if ( searchType == "co_ban" )
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
	else if ( searchType == "nang_cao" )
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
</script>
