<link rel="stylesheet" href="../../css/templates.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	$data[1]=array(
		"title"=>"Nha ban khu hoang Hoa tham",
		"img"=>"http://localhost/iLand_Agency_Web1/Source/images/noimage.jpg",
		"diachi"=>"TP.HCM",
		"dientich"=>"15x90 m",
		"ngay"=>"1/4/2011",
		"quan"=>"quan 12",
		"gia"=>"20trieu/m2"
		
	);
		$data[2]=array(
		"title"=>"Nha ban khu hoang Hoa tham",
		"img"=>"http://localhost/iLand_Agency_Web1/Source/images/noimage.jpg",
		"diachi"=>"TP.HCM",
		"dientich"=>"15x90 m",
		"ngay"=>"1/4/2011",
		"quan"=>"quan 12",
		"gia"=>"20trieu/m2"
		
	);
	$data[3]=array(
		"title"=>"Nha ban khu hoang Hoa tham",
		"img"=>"http://localhost/iLand_Agency_Web1/Source/images/noimage.jpg",
		"diachi"=>"TP.HCM",
		"dientich"=>"15x90 m",
		"ngay"=>"1/4/2011",
		"quan"=>"quan 12",
		"gia"=>"20trieu/m2"
		
	);
	$data[4]=array(
		"title"=>"Nha ban khu hoang Hoa tham",
		"img"=>"http://localhost/iLand_Agency_Web1/Source/images/noimage.jpg",
		"diachi"=>"TP.HCM",
		"dientich"=>"15x90 m",
		"ngay"=>"1/4/2011",
		"quan"=>"quan 12",
		"gia"=>"20trieu/m2"
		
	);
	$data[5]=array(
		"title"=>"Nha ban khu hoang Hoa tham",
		"img"=>"http://localhost/iLand_Agency_Web1/Source/images/noimage.jpg",
		"diachi"=>"TP.HCM",
		"dientich"=>"15x90 m",
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
		"dientich"=>"15x90 m",
		"ngay"=>"1/4/2011",
		"quan"=>"quan 12",
		"gia"=>"20trieu/m2"
		
	);
	$data[8]=array(
		"title"=>"Nha ban khu hoang Hoa tham",
		"img"=>"http://localhost/iLand_Agency_Web1/Source/images/noimage.jpg",
		"diachi"=>"TP.HCM",
		"dientich"=>"15x90 m",
		"ngay"=>"1/4/2011",
		"quan"=>"quan 12",
		"gia"=>"20trieu/m2"
		
	);
	$data[9]=array(
		"title"=>"Nha ban khu hoang Hoa tham",
		"img"=>"http://localhost/iLand_Agency_Web1/Source/images/noimage.jpg",
		"diachi"=>"TP.HCM",
		"dientich"=>"15x90 m",
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

	
	<?php 
	foreach($data as $item)
	{
		?>
		
		<ul id='items'>
		<img src='<?php echo $item['img']; ?>'>
		<li ><h3 class='items-link'><a href='#'><?php echo $item['title']; ?></a></h3></li>
		<li class="mts">Mã tài sản: 123456
		</li>
		<li class='items-add'><?php echo $item['diachi'] ?></li>
		<li class='list-area'><?php echo $item['dientich'] ?></li>
		<li class='items-price'><?php echo $item['gia'] ?></li>
		<li>
	Don vi tinh <?php //echo  @modJeaEmphasisHelper::getAjaxButton($row->price_unit,$row->price_area_unit,$row->price,$pageid); ?>
		</li>
		</ul>
		
		<?php 
	}
	echo"<div class='clear'></div>"
?>
 
	