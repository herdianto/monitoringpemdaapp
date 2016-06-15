<?php 
include '../connection.php' ;
$sql = "DELETE FROM user where username='".$_GET['nama_user']."';";
$result = $conn->query($sql);
header("Location:../index.php");
 ?>