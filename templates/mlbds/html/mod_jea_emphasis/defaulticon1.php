<link rel="stylesheet" href="../../css/templates.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	$data[1]=array(
		"title"=>"Nha ban khu hoang Hoa tham",
		"img"=>"http://localhost/iLand_Agency_Web1/Source/images/noimage.jpg",
		"diachi"=>"TP.HCM",
		"dientich"=>"30x15m",
		"ngay"=>"1/4/2011",
		"quan"=>"quan 12",
		"gia"=>"20trieu/m2"
		
	);
		$data[2]=array(
		"title"=>"Nha ban khu hoang Hoa tham",
		"img"=>"http://localhost/iLand_Agency_Web1/Source/images/noimage.jpg",
		"diachi"=>"TP.HCM",
		"dientich"=>"30x15m",
		"ngay"=>"1/4/2011",
		"quan"=>"quan 12",
		"gia"=>"20trieu/m2"
		
	);
	$data[3]=array(
		"title"=>"Nha ban khu hoang Hoa tham",
		"img"=>"http://localhost/iLand_Agency_Web1/Source/images/noimage.jpg",
		"diachi"=>"TP.HCM",
		"dientich"=>"30x15m",
		"ngay"=>"1/4/2011",
		"quan"=>"quan 12",
		"gia"=>"20trieu/m2"
		
	);
	$data[4]=array(
		"title"=>"Nha ban khu hoang Hoa tham",
		"img"=>"http://localhost/iLand_Agency_Web1/Source/images/noimage.jpg",
		"diachi"=>"TP.HCM",
		"dientich"=>"30x15m",
		"ngay"=>"1/4/2011",
		"quan"=>"quan 12",
		"gia"=>"20trieu/m2"
		
	);
	$data[5]=array(
		"title"=>"Nha ban khu hoang Hoa tham",
		"img"=>"http://localhost/iLand_Agency_Web1/Source/images/noimage.jpg",
		"diachi"=>"TP.HCM",
		"dientich"=>"30x15m",
		"ngay"=>"1/4/2011",
		"quan"=>"quan 12",
		"gia"=>"20trieu/m2"
		
	);
	$data[6]=array(
		"title"=>"Nha ban khu hoang Hoa tham",
		"img"=>"http://localhost/iLand_Agency_Web1/Source/images/noimage.jpg",
		"diachi"=>"TP.HCM",
		"dientich"=>"30x15m",
		"ngay"=>"1/4/2011",
		"quan"=>"quan 12",
		"gia"=>"20trieu/m2"
		
	);
	$data[7]=array(
		"title"=>"Nha ban khu hoang Hoa tham",
		"img"=>"http://localhost/iLand_Agency_Web1/Source/images/noimage.jpg",
		"diachi"=>"TP.HCM",
		"dientich"=>"30x15m",
		"ngay"=>"1/4/2011",
		"quan"=>"quan 12",
		"gia"=>"20trieu/m2"
		
	);
	$data[8]=array(
		"title"=>"Nha ban khu hoang Hoa tham",
		"img"=>"http://localhost/iLand_Agency_Web1/Source/images/noimage.jpg",
		"diachi"=>"TP.HCM",
		"dientich"=>"30x15m",
		"ngay"=>"1/4/2011",
		"quan"=>"quan 12",
		"gia"=>"20trieu/m2"
		
	);
	$data[9]=array(
		"title"=>"Nha ban khu hoang Hoa tham",
		"img"=>"http://localhost/iLand_Agency_Web1/Source/images/noimage.jpg",
		"diachi"=>"TP.HCM",
		"dientich"=>"30x15m",
		"ngay"=>"1/4/2011",
		"quan"=>"quan 12",
		"gia"=>"20trieu/m2"
		
	);
	$data[10]=array(
		"title"=>"Nha ban khu hoang Hoa tham",
		"img"=>"http://localhost/iLand_Agency_Web1/Source/images/noimage.jpg",
		"diachi"=>"TP.HCM",
		"dientich"=>"30x15m",
		"ngay"=>"1/4/2011",
		"quan"=>"quan 12",
		"gia"=>"20trieu/m2"
		
	);
	$data[11]=array(
		"title"=>"Nha ban khu hoang Hoa tham",
		"img"=>"http://localhost/iLand_Agency_Web1/Source/images/noimage.jpg",
		"diachi"=>"TP.HCM",
		"dientich"=>"30x15m",
		"ngay"=>"1/4/2011",
		"quan"=>"quan 12",
		"gia"=>"20trieu/m2"
		
	);
	$data[12]=array(
		"title"=>"Nha ban khu hoang Hoa tham",
		"img"=>"http://localhost/iLand_Agency_Web1/Source/images/noimage.jpg",
		"diachi"=>"TP.HCM",
		"dientich"=>"30x15m",
		"ngay"=>"1/4/2011",
		"quan"=>"quan 12",
		"gia"=>"20trieu/m2"
	);
	
	?>
		
	
	<?php 
	$i=1;
	foreach($data as $item)
	{
		?>
		
		<div id='items-icon'>
		<div>
		<h3 class='items-link'><a href='#'><?php echo$item['title']?></a></h3>
		</div>
		<div>
		<div class='f-l'>
		<img src=<?php echo $item['img']?>>
		</div>
		<div class=f-r>
				<li class='items-add'>Dia chi: <?php echo $item['diachi']?></li>
				<li class='list-area'>KT: <?php echo $item['dientich']?></li>
				<li class='list-date'>Ngay :<?php echo $item['ngay']?></li>
				<li class='mts'>Mã tài sản: 123456</li>
		</div>
		</div>
		<div class='clear'>
		<span class='items-price'><?php echo $item['gia']?></span>
		<span>Đơn vị tính</span>
		</div>
		</div>
		
	<?php 	
	}
?>

 
	