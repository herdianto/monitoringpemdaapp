<?php 

function aktif($sites){
		//initialize curl
		$ch = curl_init($sites);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.110 Safari/537.36');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_HEADER, true);

		//get answer
		$response = curl_exec($ch);
		
		curl_close($ch);

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
    function getTimeToMicroseconds() {
        $t = microtime(true);
        $micro = sprintf("%06d", ($t - floor($t)) * 1000000);
        $d = new DateTime(date('H:i:s.' . $micro, $t));

        return $d->format("H:i:s.u"); 
    }

	function get_url($sites){
         $ch = curl_init($sites);
               curl_setopt($ch, CURLOPT_TIMEOUT, 100);
               curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 100);
               
               curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
               curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
               curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.110 Safari/537.36');
               curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
               curl_setopt($ch, CURLOPT_HEADER, true);
               $curl_scraped_page = curl_exec($ch);
                     
               $html = new simple_html_dom();
               $html->load($curl_scraped_page, true, false);  
               foreach ($html->find('a') as $element) {
               $currentContent[] =  $element->href;
               }
               
               if (isset($currentContent)) {
                  return $currentContent;
               }else{
                  return 0;
               }
     }
   

	function findtwitter($isi){
         
         if(preg_match('#https?://(www\.)?twitter\.com/(?!share|intent)(\w+)#', $isi, $matches)){      
         return $matches[2]; 
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
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
      curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.110 Safari/537.36');
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
      curl_setopt($ch, CURLOPT_HEADER, true);

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
   function buku_tamu($html){
      if (preg_match_all('#buku|tamu#', $html, $matches)) {
            return 1;
         }else{
            return 0;
         }
   }

   function geografis($listUrl){
      for ($i=0; $i < count($listUrl) ; $i++) { 
         $regex = "#letak|luas|sebelah|batas|wilayah|geografi|topografi#i";
           if (preg_match_all($regex, $listUrl[$i], $matches)) {
            $match = 1;
            } else {
              continue;
            }

      }
      if (isset($match)) {
              return 1;
            }else{
              return 0;
            } 
   }

   function motto($listUrl){
      for ($i=0; $i < count($listUrl) ; $i++) { 
         $regex = "#motto|slogan#i";
           if (preg_match_all($regex, $listUrl[$i], $matches)) {
            $match = 1;
            } else {
              continue;
            }

      } 
      if (isset($match)) {
              return 1;
            }else{
              return 0;
            }
   }

   function lambang($listUrl){
      for ($i=0; $i < count($listUrl) ; $i++) { 
          $regex = "#warna|lambang|logo|gambar#i";
           if (preg_match_all($regex, $listUrl[$i], $matches)) {
            $match = 1;
            } else {
              continue;
            }

      }
      if (isset($match)) {
              return 1;
            }else{
              return 0;
            } 
   }

   function sejarah($listUrl){
      for ($i=0; $i < count($listUrl) ; $i++) { 
         $regex = "#tahun|tanggal|sejarah#i";
           if (preg_match_all($regex, $listUrl[$i], $matches)) {
            $match = 1;
            } else {
              continue;
            }


      } 
      if (isset($match)) {
              return 1;
            }else{
              return 0;
            }
   }

   function visimisi($listUrl){
      for ($i=0; $i < count($listUrl) ; $i++) { 
         $regex = "#visi|misi|mewujudkan#i";
         
           if (preg_match_all($regex, $listUrl[$i], $matches)){ 
              $match = 1;
            } else {
              continue;
            }
      }

      if (isset($match)) {
              return 1;
            }else{
              return 0;
            }
   }

   function kepala_daerah($listUrl){
      for ($i=0; $i < count($listUrl) ; $i++) { 
          $regex = "#profil|wakil|pejabat|bupati|gubernur|struktur|organisasi|kepala|walikota#i";
           if (preg_match_all($regex, $listUrl[$i], $matches)) {
            $match =1;
            } else {
              continue;
            }

            

      } 
      if (isset($match)) {
              return 1;
            }else{
              return 0;
            }
   }

   function peta($listUrl){
      for ($i=0; $i < count($listUrl) ; $i++) { 
         $regex = "#map|peta#i";
           if (preg_match_all($regex, $listUrl[$i], $matches)) {
            $match = 1;
            } else {
              continue;
            }    

      } 
      if (isset($match)) {
              return 1;
            }else{
              return 0;
            }
   }

   function perda($listUrl){
      for ($i=0; $i < count($listUrl) ; $i++) { 
          $regex = "#perda|peraturan|daerah|produk|hukum#i";
           if (preg_match_all($regex, $listUrl[$i], $matches)) {
              $match =1;
            } else {
              continue;
            }

            

      } 
      if (isset($match)) {
              return 1;
            }else{
              return 0;
            }
    }
   #end kelengkapan
   function twitterAccountExists($username){
    $headers = get_headers("https://twitter.com/".$username);
    if(strpos($headers[0], '404') !== false ) {
        return true;
    } else {
        return false;
    }
  }

   function get_twitter_lu($nama_pemda){
    if ($nama_pemda !==0) {
        if (!twitterAccountExists($nama_pemda)) {
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


        if ($decodejson = (array) json_decode($contenttwitter)) {
          return $decodejson[0]->{'created_at'}; 
            
          }else{
          return 0;
        }
        } else{
          return 0;
        }
    }else{
      return 0;
    }
  }

  function get_youtube_lu($link_yt){
      $ch = curl_init($link_yt);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

      $html = curl_exec($ch);

      //var_dump($html);
      $regexp = "#</li><li>(.*)</li></ul>#";
      if(preg_match_all($regexp, $html, $matches)){
        $res = implode(" ", $matches[1]);
      }else{
        return 0;
      }

      if (preg_match("/1 hari yang lalu|1 day ago/", $res, $abc)) {
        return 1;
      } else {
        return 0;
      }
  }

  function get_facebook_lu($sites){
       $ch = curl_init($sites);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       curl_setopt($ch, CURLOPT_FOLLOWLOCATION, FALSE);
       curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.110 Safari/537.36');
       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
       curl_setopt($ch, CURLOPT_HEADER, FALSE);
       $data = curl_exec( $ch );
       if(preg_match_all('#<abbr title="(.*?)"#', $data, $matches)){
         return implode(" ",$matches[1]);
       }else{
        return 0;
       }
  }



 ?>