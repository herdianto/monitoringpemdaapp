<?php 

function aktif($sites){
		//initialize curl
		$curlInit = curl_init($sites);
		curl_setopt($curlInit, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($curlInit, CURLOPT_HEADER, true);
		curl_setopt($curlInit, CURLOPT_NOBODY, true);
		curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, true);

		//get answer
		$response = curl_exec($curlInit);
		
		curl_close($curlInit);

		if ($response) return true;

		return false;
	}

   // function get_active($sites){
   //    $headers = get_headers($sites , 1 );
   //    var_dump($headers);
   //    if ($headers[0] == 'HTTP/1.0 200 OK') {
   //       echo "VALID";
   //    } elseif ($headers[0] == 'HTTP/1.1 301 Moved Permanently') {
   //       echo "go";
   //    } else {
   //       echo "down";
   //    }
   // }


	function get_url($sites){
   		//$twitterUrl = file_get_contents($site);
   		//var_dump($twitterUrl);
   		// if(preg_match('#https?://(www\.)?twitter\.com/(\w*)#', $site, $matches,PREG_OFFSET_CAPTURE)){
   		
   		// var_dump($matches);
   		// $ch = curl_init();
   		// $timeout = 5;
   		// curl_setopt($ch, CURLOPT_URL, $sites);
   		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   		// curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
   		// $data = curl_exec($ch);
   		// return $data;

         $html = file_get_html($sites);
         foreach ($html->find('a') as $element) {
         $currentContent[] =  $element->href;
         }
         
         return $currentContentToString = implode(" ", $currentContent);
     }
   

	function frekuensi_update($sites){
   		
   		$html = file_get_html($sites);
   		// $savePath = "cachedPages/";
   		// $fileName = "webpemda".".csv";
   		// $oldContent = "";

   		$currentContent = get_url($sites);
         
         // if (file_exists($savePath.$fileName)) {
         //    $oldContent = file_get_contents($savePath.$fileName);
         // }

         // if($oldContent && $currentContent != $oldContent){
         //    echo "different";
         // } else {
         //    echo "sama";
         // }
         
         file_put_contents($savePath.$fileName,$currentContent);
         
         echo "<br>";

         print_r($currentContent);

         echo "<br>";

         var_dump($oldContent);

         // foreach ($html->find('a') as $element) {
         //    echo $element->href;         }
	}

	function findtwitter($isi){
         if(preg_match('#https?://(www\.)?twitter\.com/(?!share)(\w*)#', $isi, $matches)){      
         return $matches[0]; 
         } else{
         return 0;
         }
   }

   	
   function findyoutube($isi){
         if(preg_match('#https?://(www\.)?youtube\.com/user/(\w*)#', $isi, $matches)){
         return $matches[0];
         } else {
         return 0;
         } 
   }
		

	function findfacebook($isi){
         if(preg_match('#https?://(www\.)?facebook\.com/(\w*)?#', $isi, $matches)){
         return $matches[0];
         } else {
         return 0;
         } 
	}


 ?>