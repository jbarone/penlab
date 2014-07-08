<?php
$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error connecting to mysql');
mysql_select_db($dbname) or die(mysql_error($conn) . '<p><b>SQL Statement:</b>' . $query);
?>
