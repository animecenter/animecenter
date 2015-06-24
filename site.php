<?
$con = mysql_connect("localhost", "subbedanime", "6vvczWBchcXaxVyn");
if ( ! $con) {
    die('Could not connect: ' . mysql_error());
}
$mytime = "2012-03-21 06:22:02";
$time = strtotime($mytime);
echo $time;
/*
mysql_select_db("subbedanime") or die(mysql_error());

$query = "SELECT * FROM an_series WHERE 1";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) {
	$url = "http://beta.animecenter.tv/";
	$title = $row['a_title'];
	$type = $row['a_type2']."-anime/";
	$title = str_replace(" ","-",strtolower($title));
	echo '<a href="'.$url.$type.$title.'">'.$url.$type.$title.'</a><br/>';
}
*/
?>
