<?php

$connecti = new mysqli("localhost", "root","","VITHUB");

if ($connecti->connect_error) {
    die("Connection failed: " . $connecti->connect_error);
}

$sql1 = "CREATE TABLE categories(id number(6) NOT NULL,name varchar(256) NOT NULL,description varchar(256) NOT NULL,position number(6) NOT NULL,PRIMARY KEY(id))";

$sql2 = "CREATE TABLE pm (
  id int(20) NOT NULL,
  id2 int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `user1` int(20) NOT NULL,
  `user2` int(20) NOT NULL,
  `message` text NOT NULL,
  `timestamp` int(10) NOT NULL,
  `user1read` varchar(3) NOT NULL,
  `user2read` varchar(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8";


$sql3 = "CREATE TABLE topics (
  `parent` int(6) NOT NULL,
  `id` int(11) NOT NULL,
  `id2` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `message` longtext NOT NULL,
  `authorid` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `timestamp2` int(11) NOT NULL,
  PRIMARY KEY  (`id`,`id2`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8";

$sql4 = "CREATE TABLE users (
  `id` int(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `avatar` text NOT NULL,
  `signup_date` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8";

if ($connecti->query($sql1) === TRUE){
    echo "Table1 created successfully"."<br/>";
} else {
    echo "Error creating table1: " . $connecti->error."<br/>";
}

if ($connecti->query($sql2) === TRUE){
    echo "Table2 created successfully"."<br/>";
} else {
    echo "Error creating table2: " . $connecti->error."<br/>";
}

if ($connecti->query($sql3) === TRUE){
    echo "Table3 created successfully"."<br/>";
} else {
    echo "Error creating table3: " . $connecti->error."<br/>";
}

if ($connecti->query($sql4) === TRUE){
    echo "Table4 created successfully"."<br/>";
} else {
    echo "Error creating table4: " . $connecti->error."<br/>";
}

$connecti->close();

?>