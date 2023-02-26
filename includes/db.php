<?php
// Connect to database
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "candy";
$db = mysqli_connect($servername, $username, $password, $dbname);
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
