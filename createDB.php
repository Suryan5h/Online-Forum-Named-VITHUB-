<?php

$connecti = new mysqli("localhost", "root","");

if ($connecti->connect_error) {
    die("Connection failed: " . $connecti->connect_error);
}


$sql = "CREATE DATABASE VITHUB";
if ($connecti->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $connecti->error;
}
$connecti->close();
?>

