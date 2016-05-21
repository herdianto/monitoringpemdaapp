<?php 
require_once 'lib/simple_html_dom.php';
   include 'connection.php';
   include 'function.php';
   require_once('lib/TwitterAPIExchange.php');
// include 'connection.php';
// $sql = "SELECT * FROM pemda";
// $result = $conn->query($sql);


// while ($row = $result->fetch_assoc()) {
// 	$nama_pemda[]     = $row["nama_pemda"];
	
// }
// 	for ($i=0; $i < count($nama_pemda) ; $i++) { 
// 		$napem = $nama_pemda[$i];
// 		if (preg_match("#KOTA#i", $napem, $matches)) {
// 			$id = $i +1;
// 			echo "UPDATE `pemda` SET `tipe`='KOTA' WHERE id_pemda=".$id.";";
// 			echo "<br>";
// 		}
// 	}
	// file_get_contents("htttp://www.acehsingkilkab.go.id");
	// var_dump($http_response_header);

 	// require_once 'lib/simple_html_dom.php';
  //  	include 'connection.php';
  //  	include 'function.php';
  //  	require_once('lib/TwitterAPIExchange.php');

  //     function get_content($url){
  //              $ch = curl_init($url);
  //              curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  //              curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.110 Safari/537.36');
  //              curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
  //              curl_setopt($ch, CURLOPT_HEADER, true);
  //              $curl_scraped_page = curl_exec($ch);
                     
  //              $html = new simple_html_dom();
  //              $html->load($curl_scraped_page, true, false);  
  //              foreach ($html->find('a') as $element) {
  //              $currentContent[] =  $element->href;
  //              }
               
  //              if (isset($currentContent)) {
  //                 return $currentContent;
  //              }else{
  //                 return 0;
  //              }
               
  //           }

  //  	for ($i = 1; $i <= 13 ; $i++) { 
  //        $sql = "SELECT url FROM pemda WHERE id_pemda=".$i.";";
  //        $result = $conn->query($sql);
         
  //        while ( $row = $result->fetch_assoc()) {

  //         $url       = $row["url"];
             
            

  //           if ($a = get_content($url)) {
  //              echo "url :".$url." AKTIF<br>";
  //              var_dump($a);
  //              echo "<br>";
  //           }else{
  //              echo "url :".$url." NONAKTIF<br>";
               
  //           }



  //        }

  //     }


      // $url = get_url('http://acehtimurkab.go.id/index.php');
      // $fb = findfacebook(implode(" ",$url));
      // $a = get_facebook_lu($fb);

      // echo "Facebook url Is ".$fb."<br>";
      // echo "facebook last Update is".$a."<br>";

      //   $ch = curl_init('https://www.facebook.com/profile.php?id=100008358437050');
      //  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      //  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
      //  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.110 Safari/537.36');
      //  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
      //  curl_setopt($ch, CURLOPT_HEADER, FALSE);
      //  $data = curl_exec( $ch );
      //  echo $data;
    
            // $mycsvfile = array();
            // $fold = fopen('cachedPages/webpagenew.csv', "r");
            // if ($fold !== false) {
            //    while (($data = fgetcsv($fold , 1000 , ",")) !== false) {
            //    $mycsvfile[] = $data;
            //    }

            //    fclose($fold);
            // }

            // print_r($mycsvfile);

      $a = get_url('http://www.palembang.go.id/');
      print_r($a);
     
   ?>