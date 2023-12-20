<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "online_quiz_db";

// If statement to connect to phpmyadmin
if (!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
    die("failed to connect!");
}