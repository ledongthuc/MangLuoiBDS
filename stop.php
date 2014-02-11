<?php 
	// CHECK 2 PARAMS
	if ((!isset($_GET['code']))||(!isset($_GET['id']))) header('location:index.php');
	// CHECK MATCHING ~
	require_once 'configuration.php';
	$config=new JConfig;
	mysql_connect('localhost',$config->user,$config->password);
	mysql_select_db($config->db);
	mysql_query('SET NAMES "utf-8"');
	$cmd='SELECT * FROM `jos_users` WHERE id='.$_GET['id'];
	$info=mysql_fetch_assoc(mysql_query($cmd));
	$hash=md5(sha1($info['id'].$info['email']));
	if ($hash!=$_GET['code']) header('location:index.php');
	$cmd='UPDATE `jos_yeu_cau_bds` SET nhan_mail=0 WHERE user_id='.$_GET['id'];
	mysql_query($cmd);
	echo '<meta charset="utf-8"/><script>
		alert("Bạn đã tắt tính năng nhận mail. Để bật lại tính năng này, vui lòng tạo lại yêu cầu BĐS !");
		window.location="http://mangluoibds.vn"; 
	</script>'; 
?>