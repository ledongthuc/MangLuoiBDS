<!DOCTYPE html>
<!-- saved from url=(0047)http://www.jquerytools.org/demos/tabs/index.htm -->
<html><!--
   This is a jQuery Tools standalone demo. Feel free to copy/paste.
   http://flowplayer.org/tools/demos/

   Do *not* reference CSS files and images from flowplayer.org when in
   production Enjoy!
--><head><meta http-equiv="Content-Type" content="text/html; charset=windows-1258">
  <title>jQuery Tools standalone demo</title>

    <!-- include the Tools -->
  <script src="modules/mod_search_mlbds/js/jquery.tools.min.js"></script>
  
  <!-- standalone page styling (can be removed) -->
 
  <link rel="stylesheet" type="text/css" href="modules/mod_search_mlbds/js/standalone.css">

  <link rel="stylesheet" href="modules/mod_search_mlbds/js/tabs.css" type="text/css" media="screen">
<link rel="stylesheet" href="modules/mod_search_mlbds/js/tabs-panes.css" type="text/css" media="screen">
</head>
<body><!-- the tabs -->
<ul class="tabs">
	<li id='tab1'><a href="#" class="current">Tìm kiếm theo điều kiện</a></li>
	<li id='tab2'><a href="#">Tìm kiếm theo khu vực</a></li>
	<li id='tab3'><a href="#">Tìm kiếm trên bản đồ</a></li>
</ul>

<!-- tab "panes" -->
<div class="panes">
<!-- tim kiếm theo điều kiện-->
	<div style="display: block; ">
		<div class='search-dk'>
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
						<input type="button" value="Tìm kiếm" class='btn-search'>
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
<!-- end tiềm kiếm theo điều kiện -->
	<div class='search-dk' style="display: none; ">
		<div class='search-area'>
			<ul>
				<li>
					<span class='mienbac'>
					
					</span>
					<span class='clear'>
						 <a href='#'>Hà Nội</a>
					</span>
					<span class='clear'>
						<a href='#'>Hải Phòng</a>
					</span>
					<span class='clear'>
						<a href='#'>Hải Dương</a>
					</span>
					<span class='clear'>
						<a href='#'>Hà Nội</a>
					</span>
					<span class='clear'>
						<a href='#'>Hải Phòng</a>
					</span>
					<span class='clear'>
						<a href='#'>Hải Dương</a>
					</span>
				</li>
				<li>
					<span class='mientrung'>
					
					</span>
					<span class='clear'>
						<a href='#'>Đà Nẵng</a>
					</span>
					<span class='clear'>
						<a href='#'>Huế</a>
					</span>
					<span class='clear'>
						<a href='#'>Nha Trang</a>
					</span>
					<span class='clear'>
						<a href='#'>Nha Trang</a>
					</span>
					<span class='clear'>
						<a href='#'>Nha Trang</a>
					</span>
					<span class='clear'>
						<a href='#'>Nha Trang</a>
					</span>
				</li>
				<li>
					<span class='miennam'>
					
					</span>
					<span class='clear'>
						<a href='#'>Đà Nẵng</a>
					</span>
					<span class='clear'>
						<a href='#'>Huế</a>
					</span>
					<span class='clear'>
						<a href='#'>Nha Trang</a>
					</span>
					<span class='clear'>
						<a href='#'>Nha Trang</a>
					</span>
					<span class='clear'>
						<a href='#'>Nha Trang</a>
					</span>
					<span class='clear'>
						<a href='#'>Nha Trang</a>
					</span>
				</li>
				<li>
					<span class="quanhuyen">
						
					</span>
					<span class="clear">
						<select class="input-s">
							<option>
								Tất cả
							</option>
						</select>
						
					</span>
					<span class="lbds">
						
					</span>
					<span class="clear">
						<select class="input-s">
							<option>
								Bất kỳ
							</option>
						</select>
						
					</span>
					<span style="float:right">
						<input type="button" value="Tìm kiếm" class="btn-search">
						<span class="clear check">
							<a href="#" onclick="showFind()" class="link">Tìm kiếm nâng cao </a>
						</span>
					</span>
				</li>
			</ul>
		</div>
	
	
	
	
	
	</div>
	<div  class='search-dk' style="display: none; ">
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
							<input type="radio" name="loai" value="nguyên căn" checked='checked' />nguyên căn
							<input type="radio" name="loai" value="chính chủ" />chính chủ
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
						<input type="button" value="Tìm kiếm" class='btn-search'>
						<span class='clear check'>
							<a href="#" id="timkiemnc" class='link'>Tìm kiếm nâng cao </a>
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

<script>
// perform JavaScript after the document is scriptable.
$(function() {
    // setup ul.tabs to work as tabs for each div directly under div.panes
    $("ul.tabs").tabs("div.panes > div");
    $("#tknc").css('display','none');
});
function showFind(){
	$("#tknc").slideToggle("slow");
}
</script>

</body></html>