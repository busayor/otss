<?php 
include '../config/config.php';

$totalmembers = mysql_query("select * from ticket");
$nummem = mysql_num_rows($totalmembers);

echo 'Total number of tickets created: '.$nummem;

?>