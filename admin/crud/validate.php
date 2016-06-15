<?php 
include '../connection.php' ;
$sql = "UPDATE `pemda` SET `url`='".$_GET['url_baru']."' WHERE nama_pemda='".$_GET['nama_pemda']."';";
$result = $conn->query($sql);
$sql = "DELETE FROM addpemda where id='".$_GET['id_request']."';";
$result = $conn->query($sql);
header("Location:../index.php");

?>
