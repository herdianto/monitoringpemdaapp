
<?php 
	require_once 'lib/simple_html_dom.php';
   include 'connection.php';
   include 'function.php';

      # START CRAWLING
      $mycsvfile = array();
      $fold = fopen('cachedPages/webpageold.csv', "r");
      if ($fold !== false) {
         while (($data = fgetcsv($fold , 1000 , ",")) !== false) {
         $num = count($data);
         $mycsvfile[] = $data;
         }

         fclose($fold);
      }


      $semualist = array();
      for ($i = 1; $i <= 3 ; $i++) { 
         $sql = "SELECT url,url_twitter,url_facebook,url_youtube FROM pemda WHERE id_pemda=".$i.";";
         $result = $conn->query($sql);
         
         while ( $row = $result->fetch_assoc()) {
          $url       = $row["url"];
          $urltwit   = $row["url_twitter"];
          $urlfb     = $row["url_facebook"];
          $urlyt     = $row["url_youtube"];

          $idpemda = $i;
               if (aktif($url)) {
                  $isaktif = 1;
                  $isi     = get_url($url);
                  $urltwit = findtwitter($isi);
                  if (empty($urltwit)){
                     $twit = 0;
                  } else {
                     $twit = 1;
                  }
                  $urlfb   = findfacebook($isi);
                  if (empty($urlfb)){
                     $fb = 0;
                  } else {
                     $fb = 1;
                  }
                  $urlyt   = findyoutube($isi);
                  if (empty($urlyt)){
                     $yt = 0;
                  } else {
                     $yt = 1;
                  }
                  
                  if ($mycsvfile[$i-1][0] == $i) {
                     if ($mycsvfile[$i-1][7] == $isi ) {
                        $fu = 0;
                     } else{
                        $fu = 1;
                     }
                  }
                     
               } else {
                  $isaktif = 0;
                  $isi     = 0;
               }
                  }
               

            $list = array ( 
               'id_pemda'     => $idpemda, 
               'url'          => $url, 
               'isaktif'      => $isaktif, 
               'urltwit'      => $twit, 
               'urlfb'        => $fb, 
               'urlyt'        => $yt,
               'web_update'   => $fu,   
               'isi'          => $isi
            );
            
            array_push($semualist, $list);
            
         }

         #INSERT TO CSV
         $output =  fopen("cachedPages/webpagenew.csv", 'w') or die("can't open webpagenew.csv");
         foreach ($semualist as $line) {
            fputcsv($output, $line , ',');
         }
         #END INSERT CSV
      #END CRAWLING


      #INSERT TO MYSQL
      $fh   = fopen('cachedPages/webpagenew.csv', "r");


      if ($fh !== false) {
         while (($data = fgetcsv($fh , 1000 , "," )) !== false){

            $sql = "INSERT INTO tes (`date`, `id_pemda`, `isaktif` , `twitter` , `facebook` ,`youtube` ,`webupdate`) 
            VALUES ( CURRENT_DATE(),".$data[0].",'". $data[2] ."','". $data[3] ."','".$data[4]."','".$data[5]."',".$data[6].");";
            // $result = $conn->query($sql);

            echo $sql;

         }

      }
      #END INSERT TO MYSQL

      #WEBPAGENEW.CSV == WEBPAGEOLD.CSV
      $input   = fopen('cachedPages/webpagenew.csv', 'r');  //open for reading
      $output  = fopen('cachedPages/webpageold.csv', 'w');  //open for writing

      while (($data = fgetcsv($input , 1000 , ",")) !== false ) {
         fputcsv($output, $data);
      }

      fclose($input);
      fclose($output);
      #END OF WEBPAGENEW.CSV == WEBPAGEOLD.CSV





   

 ?>