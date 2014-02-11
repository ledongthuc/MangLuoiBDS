<?php
phpinfo();
/* 
mysql_connect("localhost", "appstore", "RG4CrBwz") or
    die("Could not connect: " . mysql_error());
mysql_select_db("appstore");

$result = mysql_query("SELECT * from jos_app");

while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    echo "<pre>";
    print_r($row);
    echo "</pre>";
}
mysql_free_result($result);

function table_exists ($table, $db) { 
	$tables = mysql_list_tables ($db); 
	while (list ($temp) = mysql_fetch_array ($tables)) {
		if ($temp == $table) {
			return TRUE;
		}
	}
	return FALSE;
}

/** How to use it 
$table = $_GET['table'];
if (table_exists($table, 'appstore')) {
	echo"Yes the table ".$table." is there.";
}else{
	echo" No the table ".$table." is there.";
}
*/
?>