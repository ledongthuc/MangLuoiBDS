<?php 
require("class.phpmailer.php");
$mailphp = new PHPMailer();
if($_POST)
{
	$mailfrom	=	trim($_REQUEST['mailfrom']);
	$mailto		=	trim($_REQUEST['mailto']);
	$subject	=	trim($_REQUEST['subject']);
	$content	=	trim($_REQUEST['content']);
	
	if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", $mailfrom))
	{
		echo "<script>alert('Email gửi không đúng')</script>";
	}
	
	else if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", $mailto))
	{
		echo "<script>alert('Email nhận không đúng')</script>";
	}
	
	else if($subject=="Tiêu đề thư")
	{
		echo "<script>alert('Nhập tiêu đề thư')</script>";
	}
	
	elseif ( strlen($content) < 20 )
	{
		echo "<script>alert('Nội dung phải trên 20 ký tự')</script>";
	}
	else
	{
		$mailphp->From = $mailfrom;
		$mailphp->FromName = "Mạng lưới Bất động sản";
		$mailphp->AddAddress($mailto);
		$mailphp->Subject=$subject;
		$mailphp->Body = $content;
		$mailphp->CharSet='UTF-8';
		$se = $mailphp->Send();
		if($se){
		    echo "<script>document.getElementById('showbox').style.display = 'none';alert('Đã gửi!')</script>";
		}
		else {
			echo "<script>alert('Thất bại!')</script>";
		}
		
	}
	
}
?>