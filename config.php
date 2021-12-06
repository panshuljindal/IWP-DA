<?php
$server = 'localhost';
$username = 'root';
$password = '';
$dbname = 'da1';
$db = mysqli_connect($server,$username,$password,$dbname);
if($db === false)
die("Connectin Error");
?>