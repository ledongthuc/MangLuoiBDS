<?php
session_start();
ob_start();
extract($_REQUEST);

//Connect to db
mysql_select_db($db_name,mysql_connect($hostname,$username,$passwd));

//get table column data
$sqlc = "show columns from $table_name";
$rsdc = mysql_query($sqlc);
$cols = mysql_num_rows($rsdc);

//get table contents
$start = ($page-1)*10;
$sql = "select * from $table_name order by $order_by limit $start,$per_page";
$rsd = mysql_query($sql);
?>
<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<title>Result</title>
</head>
<body>
<div align="center" id="content">
	<table border="0" cellpadding="2" cellspacing="2" width="100%" id="table1">
		<tr>
		<td>Sl. No</td>
		<?php
		//Print the column headings
		while($rsc = mysql_fetch_array($rsdc))
		{
		?>
			<td><?=$rsc[0]?></td>
		<?php
		}
		?>
		</tr>
		<?php
		//Print the contents
		$i = $start;
		while($rs = mysql_fetch_array($rsd))
		{
			$i++;
		?>
		<tr>
			<td><?=$i?>&nbsp;</td>
			<?php
			for($j=0; $j<$cols; $j++)
			{
			?>
			<td><?=$rs[$j]?></td>
			<?php
			} //for
			?>
		</tr>
		<?php
		} //while
		?>
	</table>
</div>
</body>
</html>