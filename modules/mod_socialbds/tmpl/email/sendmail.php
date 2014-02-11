<?php 
require("class.phpmailer.php");
$mailphp = new PHPMailer();
if($_POST)
{
	$mailfrom	=	trim($_REQUEST['mailfrombds']);
	$mailto		=	trim($_REQUEST['mailtobds']);
	$subject	=	trim($_REQUEST['subjectbds']);
	$content	=	trim($_REQUEST['contentbds']);
	$link		=	trim($_REQUEST['link']);
	$url		=	trim($_REQUEST['url']);
	
	if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", $mailfrom))
	{
		echo "<script>alert('Email gửi không đúng');return false;</script>";
	}
	
	else if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", $mailto))
	{
		echo "<script>alert('Email nhận không đúng');document.getElementById('mailfrombds').style.borderColor = 'red';return false;</script>";
	}
	
	else if($subject=="Tiêu đề thư")
	{
		echo "<script>alert('Nhập tiêu đề thư');document.getElementById('subjectbds').style.borderColor = 'red';return false;</script>";
	}
	
	elseif ( strlen($content) < 20 )
	{
		echo "<script>alert('Nội dung phải trên 20 ký tự');document.getElementById('contentbds').style.borderColor = 'red';return false;</script>";
	}
	else
	{
		$content = "Chào bạn,<br /><br />Bạn nhận được một chia sẻ về bất động sản: <a href='".$link."' > ".$subject."</a>với nội dung<br /><br />".$content."<br /><br />Chúc bạn một ngày tốt lành.<br /><br />

www.mangluoibds.vn<br /><br />
Hỗ trợ khách hàng: info@mangluoibds.vn hoặc 0933 68 69 64<br /><img src='".$url."images/hinhlienhe.png' width='458' height='42' />
		";
		
		$mailphp->From = $mailfrom;
		$mailphp->FromName = "Mạng lưới Bất động sản";
		$mailphp->AddAddress($mailto);
		$mailphp->Subject=$subject;
		$mailphp->MsgHTML($content);
		$mailphp->CharSet='UTF-8';
		$se = $mailphp->Send();
		if($se){
		    echo "<script>alert('Đã gửi thành công!')</script>";
		}
		else {
			echo "<script>alert('Thất bại!')</script>";
		}
		
	}
	
}
?>