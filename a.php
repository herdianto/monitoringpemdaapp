<?php 
	require_once 'lib/simple_html_dom.php';
  	include 'function.php';


  	$a = findtwitter('http://www.twitter.com/');
  	if (empty($a)){
  		$twit = 0;
  	} else {
  		$twit = 1;
  	}

  	echo $a;
  	echo $twit;
 ?>