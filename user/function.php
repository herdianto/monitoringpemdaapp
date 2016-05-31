<?php 
	include($_SERVER['DOCUMENT_ROOT']."/monitoringpemdaapp/connection.php");

	function NewUser(){
		$namalengkap 	= $_POST['namalengkap'];
		$username		= $_POST['username'];
		$password		= $_POST['password'];
		$asaldaerah		= $_POST['asaldaerah'];
		$sql = "INSERT INTO user(previledge,username,password,nama_lengkap,asal_daerah) VALUES (2,'$username','$password','$namalengkap','asaldaerah');";
		$result = $conn->query($sql);
		if ($result) {
			echo "YOUR REGISTRATION IS COMPLETED...";
		} else {
			echo "failed";
		}
		
	}

	function SignUp(){
		include ($_SERVER['DOCUMENT_ROOT']."/monitoringpemdaapp/connection.php");
		$sql = "SELECT * FROM user WHERE username = 'asu' or die(mysql_error())";
		$result = $conn->query($sql);
		if ($row = $result->fetch_assoc()) {
			NewUser();
		} else {
			echo "USER".$_POST['username']."ALREADY REGISTERED";
		}
		
	}

	if (isset($_POST['submit'])) {
		SignUp();
	} else {
		
	}
	


 ?>