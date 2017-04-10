<?php
$conn= new mysqli("localhost","root","","vithub");
if ($conn->connect_error){
	die("Communication Failed!!:".$conn->connect_error);
}
$admin='Suryansh';

$url_home = 'index.php';

$design = 'default';

include('init.php');

$conn->close();
?>