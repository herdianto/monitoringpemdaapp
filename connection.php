<?php 
$servername = "localhost";
$username 	= "root";
$password	= "";
$dbname		= "TA";

//create connection 
$conn = new mysqli($servername , $username , $password , $dbname);

//check connection

if ($conn->connect_error) {
	die("connection failed: " . $conn->connection_error);
}

 ?>