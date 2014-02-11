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
		
		<div id='items-icon2'>
		<div class="left">
		<h4 class='items-link'><a href='#'><?php echo$item['title']?></a></h4>
		</div>
        <div class="date-em font11">
        11/4/2011
        </div>
		<div>
	

				<li class='items-add'>
                <span class="font11">Địa chỉ:</span>
				<?php echo $item['diachi']?>
                </li>
				<li class='list-area-icon'>
                <span class="font11">Diện tích:</span> 
				<?php echo $item['dientich']?>
              <li class="list-area-icon">
                <span class="font11">Mặt tiền rộng: </span><?php echo '12'?>
              </li>
                </li>
				<li class='list-date list-area-icon'><span class="font11">Hướng:</span><?php echo $item['ngay']?></li>
                <li class="list-area-icon">
                <span class="font11">Chiều dài: </span><?php echo '20'?>
                </li>
		</div>
		<div>
		<div class='items-price left'><span class="font11">Giá:</span><?php echo $item['gia']?>Đơn vị tính</div>
        <span class="date-em"><a href="#" class="readon">Chi tiết</a></span>
		</div>
        <div class="clear"/></div>
		</div>
		
	<?php 	
	}
?>

 
	