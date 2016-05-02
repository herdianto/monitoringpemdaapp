<?php
	
	require_once 'lib/simple_html_dom.php';
   	include 'connection.php';
   	include 'function.php';

  	
   	$sites = 'http://balikpapan.go.id/index';
  	$listUrl =  get_url($sites);

  	$geografis = geografis($listUrl);
	$lambang = lambang($listUrl);
	$motto = motto($listUrl);
	$sejarah = sejarah($listUrl);
	$visimisi = visimisi($listUrl);
	$kepala_daerah = kepala_daerah($listUrl);
	$peta = peta($listUrl);
	$perda = perda($listUrl);

	echo "sites : ".$sites." geografis : ".$geografis ." lambang : ".$lambang." motto : ".$motto." sejarah : ".$sejarah. " visi dan misi : ".$visimisi." kepala daerah : ".$kepala_daerah." peta : ".$peta." perda : ".$perda;




	


?>