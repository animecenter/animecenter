<?php
$dbhost = 'localhost';
$dbuser = 'subbedanime';
$dbpass = '6vvczWBchcXaxVyn';
$dbname = 'subbedanime';

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db($dbname);
