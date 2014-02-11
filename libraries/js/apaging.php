<?
//***************************************
// This is downloaded from www.plus2net.com //
/// You can distribute this code with the link to www.plus2net.com ///
//  Please don't  remove the link to www.plus2net.com ///
// This is for your learning only not for commercial use. ///////
//The author is not responsible for any type of loss or problem or damage on using this script.//
/// You can use it at your own risk. /////
//*****************************************
//error_reporting(E_ERROR | E_PARSE | E_CORE_ERROR);
////// Your Database Details here /////////
/*
$dbservertype='mysql';
$servername='127.0.0.1';
$dbusername='';
$dbpassword='';
$dbname='';

////////////////////////////////////////
////// DONOT EDIT BELOW  /////////
///////////////////////////////////////

connecttodb($servername,$dbname,$dbusername,$dbpassword);
function connecttodb($servername,$dbname,$dbuser,$dbpassword)
{
global $link;
$link=mysql_connect ("$servername","$dbuser","$dbpassword");
if(!$link){die("Could not connect to MySQL");}
mysql_select_db("$dbname",$link) or die ("could not open db".mysql_error());
}
//////////////////////////////// Main Code sarts /////////////////////////////////////////////
$endrecord=$_GET['endrecord'];// To take care global variable if OFF
if(strlen($endrecord) > 0 and !is_numeric($endrecord)){
echo "Data Error";
exit;
} 

$limit=10;// Number of records per page
$nume=mysql_num_rows(mysql_query("select * from student"));
//echo "endrecord=$endrecord limit=$limit ";
if($endrecord < $limit) {$endrecord = 0;}

switch($_GET['direction'])
{
case "fw":
$eu = $endrecord ;
break;

case "bk":
$eu = $endrecord - 2*$limit;
break;

default:
echo "Data Error";
exit;
break;
}
if($eu < 0){$eu=0;}
$endrecord =$eu+$limit;

$t=mysql_query("select * from student limit $eu,$limit");

$str= "{ \"data\" : [";

while($nt=mysql_fetch_array($t)){
$str=$str."{\"id\" : \"$nt[id]\", \"name\" : \"$nt[name]\", \"myclass\" : \"$nt[class]\", \"mark\" : \"$nt[mark]\"},";
//$str=$str."{\"myclass\" : \"$nt[class]\"},";

}
$str=substr($str,0,(strLen($str)-1));

if(($endrecord) < $nume ){$end="yes";}
else{$end="no";}

if(($endrecord) > $limit ){$startrecord="yes";}
else{$startrecord="no";}


$str=$str."],\"value\" : [{\"endrecord\" : $endrecord,\"limit\" : $limit,\"end\" : \"$end\",\"startrecord\" : \"$startrecord\"}]}";
echo $str;
//echo json_encode($str);

*/



//////////////////////////////////////////////


//

//
//$sql = $_REQUEST['sql'];
//echo $_REQUEST['f'];
//echo $_REQUEST['t'];
//set $sql query
$idKind =  split(",", $_REQUEST[idKind]);

//echo implode(',',$idKind);	
$measure=$_REQUEST['measure'];
$tPage= $_REQUEST['tPage'];
$pc= $_REQUEST['pc'];
$f= $_REQUEST['f'];
$t= $_REQUEST['t'];
$style=$_REQUEST['style'];
$order_by=$_REQUEST['order_by'];
//$idKind=$_REQUEST['idKind'];
//echo $style;

echo $pc;
echo '<br>duong dan ne: '.realpath(__FILE__);
echo "<div id=\"page_nagi\" align=\"center\"> Trang: ";
for($i=1;$i<=$tPage;$i++)
{
$f=$i*$t-$t;

//echo 'sql: '.$sql;

//if($pc==$i)
//{
echo "<a onClick=\"apaging_modJeaEmphasis('paging','$f','$t','$style','$order_by','$i','$tPage','m')\" style=\"cursor:pointer;color:#0066CC; \"><strong> $i &nbsp;</strong></a>";
} 
?>