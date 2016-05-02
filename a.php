<?php 
	
	require_once 'lib/simple_html_dom.php';
   	include 'connection.php';
   	include 'function.php';
	
   	$a = implode(" ",get_url('http://portal.bandung.go.id'));

	$b = findtwitter($a);
	var_dump($b);

 ?>