<?php
//By Jason Yang
$db_hostname = 'localhost';
$db_database = 'jlsilang_DB';
$db_username = 'jlsilang_jc';
$db_password = 'Runescape1';
$db_server = mysql_connect($db_hostname, $db_username, $db_password);
if(!$db_server) die("Unable to connect to MYSQL: " . mysql_error()); 
mysql_select_db($db_database) or die("Unable to connect to database: ". mysql_error());
$query = "DELETE FROM WEATHER WHERE CREATE_DATE < DATE_SUB(NOW(), INTERVAL 21 DAY)";	
$result = mysql_query($query);
if (!$result) die ("Database deletion failed.");
else{
	echo "Weather successfully updated!";
}
mysql_close($db_server);
?>