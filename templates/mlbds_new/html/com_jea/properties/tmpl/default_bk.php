<link rel="stylesheet" href="../../css/templates.css" />
<?php
	$data[1]=array(
		"title"=>"Nha ban khu hoang Hoa tham",
		"img"=>"http://localhost/iLand_Agency_Web1/Source/images/noimage.jpg",
		"diachi"=>"TP.HCM",
		"dientich"=>"200m2",
		"ngay"=>"1/4/2011",
		"quan"=>"quan 12",
		"gia"=>"20trieu/m2"
		
	);
		$data[2]=array(
		"title"=>"Nha ban khu hoang Hoa tham",
		"img"=>"http://localhost/iLand_Agency_Web1/Source/images/noimage.jpg",
		"diachi"=>"TP.HCM",
		"dientich"=>"200m2",
		"ngay"=>"1/4/2011",
		"quan"=>"quan 12",
		"gia"=>"20trieu/m2"
		
	);
	$data[3]=array(
		"title"=>"Nha ban khu hoang Hoa tham",
		"img"=>"http://localhost/iLand_Agency_Web1/Source/images/noimage.jpg",
		"diachi"=>"TP.HCM",
		"dientich"=>"200m2",
		"ngay"=>"1/4/2011",
		"quan"=>"quan 12",
		"gia"=>"20trieu/m2"
		
	);
	$data[4]=array(
		"title"=>"Nha ban khu hoang Hoa tham",
		"img"=>"http://localhost/iLand_Agency_Web1/Source/images/noimage.jpg",
		"diachi"=>"TP.HCM",
		"dientich"=>"200m2",
		"ngay"=>"1/4/2011",
		"quan"=>"quan 12",
		"gia"=>"20trieu/m2"
		
	);
	$data[5]=array(
		"title"=>"Nha ban khu hoang Hoa tham",
		"img"=>"http://localhost/iLand_Agency_Web1/Source/images/noimage.jpg",
		"diachi"=>"TP.HCM",
		"dientich"=>"200m2",
		"ngay"=>"1/4/2011",
		"quan"=>"quan 12",
		"gia"=>"20trieu/m2"
		
	);
	$data[6]=array(
		"title"=>"Nha ban khu hoang Hoa tham",
		"img"=>"http://localhost/iLand_Agency_Web1/Source/images/noimage.jpg",
		"diachi"=>"TP.HCM",
		"dientich"=>"200m2",
		"ngay"=>"1/4/2011",
		"quan"=>"quan 12",
		"gia"=>"20trieu/m2"
		
	);
	$data[7]=array(
		"title"=>"Nha ban khu hoang Hoa tham",
		"img"=>"http://localhost/iLand_Agency_Web1/Source/images/noimage.jpg",
		"diachi"=>"TP.HCM",
		"dientich"=>"200m2",
		"ngay"=>"1/4/2011",
		"quan"=>"quan 12",
		"gia"=>"20trieu/m2"
		
	);
	$data[8]=array(
		"title"=>"Nha ban khu hoang Hoa tham",
		"img"=>"http://localhost/iLand_Agency_Web1/Source/images/noimage.jpg",
		"diachi"=>"TP.HCM",
		"dientich"=>"200m2",
		"ngay"=>"1/4/2011",
		"quan"=>"quan 12",
		"gia"=>"20trieu/m2"
		
	);
	$data[9]=array(
		"title"=>"Nha ban khu hoang Hoa tham",
		"img"=>"http://localhost/iLand_Agency_Web1/Source/images/noimage.jpg",
		"diachi"=>"TP.HCM",
		"dientich"=>"200m2",
		"ngay"=>"1/4/2011",
		"quan"=>"quan 12",
		"gia"=>"20trieu/m2"
		
	);
	$data[10]=array(
		"title"=>"Nha ban khu hoang Hoa tham",
		"img"=>"http://localhost/iLand_Agency_Web1/Source/images/noimage.jpg",
		"diachi"=>"TP.HCM",
		"dientich"=>"200m2",
		"ngay"=>"1/4/2011",
		"quan"=>"quan 12",
		"gia"=>"20trieu/m2"
		
	);
	$data[11]=array(
		"title"=>"Nha ban khu hoang Hoa tham",
		"img"=>"http://localhost/iLand_Agency_Web1/Source/images/noimage.jpg",
		"diachi"=>"TP.HCM",
		"dientich"=>"200m2",
		"ngay"=>"1/4/2011",
		"quan"=>"quan 12",
		"gia"=>"20trieu/m2"
		
	);
	$data[12]=array(
		"title"=>"Nha ban khu hoang Hoa tham",
		"img"=>"http://localhost/iLand_Agency_Web1/Source/images/noimage.jpg",
		"diachi"=>"TP.HCM",
		"dientich"=>"200m2",
		"ngay"=>"1/4/2011",
		"quan"=>"quan 12",
		"gia"=>"20trieu/m2"
		
	);
	?>
		<h2 class="list-title">
Danh sách bất động sản
	</h2>
	<?php 
	
	foreach($data as $item)
	{
		?>
		<div id='items-list'>
		<div class='item-pro'>
		<img src=<?php echo $item['img']?>>
			<div>
				 <a href='#'><?php echo$item['title']?></a>
			</div>
			<div class='list3'>
				<li class='list-area1'>DT:<?php echo $item['dientich']?></li>
				<li class='list-price'>Gia: <span class='items-price'><?php echo $item['gia']?></span></li>
				<li class='list-date'><?php echo $item['ngay']?></li>
			</div>
		</div>
		<div class='list2'>
				<li class='items-link'><?php echo $item['diachi']?></li>
				<li><?php echo $item['quan']?></li>		
		</div>
		</div>
        <div class='clear'></div>
		<?php 
	}
	?>
<div id="pagination">
&lt;&lt;
<a class="pagenav">Bắt đầu</a> 
&lt;
<a href="#" class="pagenav">Lùi</a>
<a href="#" class="pagenav">1</a>
<a href="#" class="pagenav">2</a>
<a href="#" class="pagenav">3</a>
<a href="#" class="pagenav">4</a>
<a href="#" class="pagenav">Cuối</a>
</div>

 
	