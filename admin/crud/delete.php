<?php 
include '../connection.php' ;
$sql = "DELETE FROM addpemda where id='".$_GET['id_request']."';";
$result = $conn->query($sql);
header("Location:../index.php");
 ?>