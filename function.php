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
         if (!$html = file_get_html($sites)) {
            $currentContentToString = 0;
         } else{
            foreach ($html->find('a') as $element) {
            $currentContent[] =  $element->href;
            }
         }
         return $currentContent;
         //return $currentContentToString = implode(" ", $currentContent);

     }
   

	function findtwitter($isi){
         
         if(preg_match('#https?://(www\.)?twitter\.com/(?!share)(\w+)#', $isi, $matches)){      
         return $matches[0]; 
         } else{
         return 0;
         }
   }
   	
   function findyoutube($isi){
         if(preg_match('#https?://(www\.)?youtube\.com/(user|channel)/(\w*)#', $isi, $matches)){
         return $matches[0];
         } else {
         return 0;
         } 
   }
		

	function findfacebook($isi){
         if(preg_match('#https?://(www\.)?facebook\.com/(\S+)#', $isi, $matches)){
         return $matches[0];
         } else {
         return 0;
         } 
	}

   function gethtml($sites){
      $ch = curl_init($sites);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

      return $html = curl_exec($ch);
   }

   function checkabsUrl($sites,$url){
         if(gethtml($url)){
         return $url;
      }else{
         $absUrl =  $sites.$url;
         return $absUrl;
      }
   }

   #function kelengkapan

   function geografis($listUrl){
      for ($i=0; $i < count($listUrl) ; $i++) { 
         $regex = "#letak|luas|sebelah|batas|wilayah|geografi#i";
           if (preg_match_all($regex, $listUrl[$i], $matches)) {
            $url = $listUrl[$i];
           }else{
              continue;
           }
      }
      
      if (empty($url) ) {
         return 0;
      }else{
         $html = gethtml($url);

         if (preg_match_all($regex, $html, $matches)) {
            return 1;
         }else{
            return 0;
         }
      } 
   }

   function motto($listUrl){
      for ($i=0; $i < count($listUrl) ; $i++) { 
         $regex = "#motto|slogan#i";
           if (preg_match_all($regex, $listUrl[$i], $matches)) {
            $url = $listUrl[$i];
           }else{
              continue;
           }
      }
      
       if (empty($url) ) {
         return 0;
      }else{
         $html = gethtml($url);

         if (preg_match_all($regex, $html, $matches)) {
            return 1;
         }else{
            return 0;
         }
      } 
   }

   function lambang($listUrl){
      for ($i=0; $i < count($listUrl) ; $i++) { 
          $regex = "#warna|lambang|gambar#i";
           if (preg_match_all($regex, $listUrl[$i], $matches)) {
            $url = $listUrl[$i];
           }else{
              continue;
           }
      }
      
       if (empty($url) ) {
         return 0;
      }else{
         $html = gethtml($url);

         if (preg_match_all($regex, $html, $matches)) {
            return 1;
         }else{
            return 0;
         }
      } 
   }

   function sejarah($listUrl){
      for ($i=0; $i < count($listUrl) ; $i++) { 
         $regex = "#tahun|tanggal|sejarah#i";
           if (preg_match_all($regex, $listUrl[$i], $matches)) {
            $url = $listUrl[$i];
           }else{
              continue;
           }
      }
      
       if (empty($url) ) {
         return 0;
      }else{
         $html = gethtml($url);

         if (preg_match_all($regex, $html, $matches)) {
            return 1;
         }else{
            return 0;
         }
      } 
   }

   function visimisi($listUrl){
      for ($i=0; $i < count($listUrl) ; $i++) { 
         $regex = "#visi|misi|mewujudkan#i";
           if (preg_match_all($regex, $listUrl[$i], $matches)) {
            $url = $listUrl[$i];
           }else{
              continue;
           }
      }
      
       if (empty($url) ) {
         return 0;
      }else{
         $html = gethtml($url);

         if (preg_match_all($regex, $html, $matches)) {
            return 1;
         }else{
            return 0;
         }
      } 
   }

   function kepala_daerah($listUrl){
      for ($i=0; $i < count($listUrl) ; $i++) { 
          $regex = "#profil|wakil|pejabat|bupati|gubernur|struktur|organisasi|kepala|walikota#i";
           if (preg_match_all($regex, $listUrl[$i], $matches)) {
            $url = $listUrl[$i];
           }else{
              continue;
           }
      }
      
       if (empty($url) ) {
         return 0;
      }else{
         $html = gethtml($url);

         if (preg_match_all($regex, $html, $matches)) {
            return 1;
         }else{
            return 0;
         }
      } 
   }

   function peta($listUrl){
      for ($i=0; $i < count($listUrl) ; $i++) { 
         $regex = "#map|peta#i";
           if (preg_match_all($regex, $listUrl[$i], $matches)) {
            $url = $listUrl[$i];
           }else{
              continue;
           }
      }
      
       if (empty($url) ) {
         return 0;
      }else{
         $html = gethtml($url);

         if (preg_match_all($regex, $html, $matches)) {
            return 1;
         }else{
            return 0;
         }
      } 
   }

   function perda($listUrl){
      for ($i=0; $i < count($listUrl) ; $i++) { 
          $regex = "#perda|peraturan|daerah#i";
           if (preg_match_all($regex, $listUrl[$i], $matches)) {
            $url = $listUrl[$i];
           }else{
              continue;
           }
      }
      
       if (empty($url) ) {
         return 0;
      }else{
         $html = gethtml($url);

         if (preg_match_all($regex, $html, $matches)) {
            return 1;
         }else{
            return 0;
         }
      } 
   }
   #end kelengkapan
   
   function get_twitter_fu($nama_pemda){

    $settings = array(
        'oauth_access_token'    =>  "228025597-YUcY0ZzKu6UKRvHbCWmNVkWJX6KA2q6iXMYJm2aX",
        'oauth_access_token_secret' =>  "jt1Nm1VDPrsiMF6hewuteeQPnDnrBUrzzpsCd2IgyIdiW",
        'consumer_key'        =>  "NSY2Z4FZFVxfj79oDurQ4dzuu",
        'consumer_secret'     =>  "iU76267myutQgMjFqVdBL2N8VGCynDVIXwVUWVkUxrwZtqrpMd"
      );

    $url = "https://api.twitter.com/1.1/statuses/user_timeline.json";

    $requestMethod = "GET";


    $getfield = '?screen_name='.$nama_pemda.'&count=1';

    $twitter = new TwitterAPIExchange($settings);
    $contenttwitter = $twitter->setGetfield($getfield)
                 ->buildOauth($url, $requestMethod)
                 ->performRequest();


    $decodejson = json_decode($contenttwitter);

    return $decodejson[0]->{'created_at'};

  }

  function get_youtube_fu($link_yt){
      $ch = curl_init($link_yt);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

      $html = curl_exec($ch);

      //var_dump($html);
      $regexp = "#</li><li>(.*)</li></ul>#";
      if(preg_match_all($regexp, $html, $matches)){
        $res = implode(" ", $matches[1]);
      }

      if (preg_match("/1 hari yang lalu|1 day ago/", $res, $abc)) {
        return 1;
      } else {
        return 0;
      }
  }


 ?>