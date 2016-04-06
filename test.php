
<?php 
	require_once 'lib/simple_html_dom.php';
   include 'connection.php';
   include 'function.php';

      
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
                  if (empty($urltwit)) {
                     $urltwit = findtwitter($isi);
                     $sql = "UPDATE pemda SET url_twitter ='". $urltwit ."' WHERE id_pemda=".$i.";";
                     $result = $conn->query($sql);
                  } else{
                     $urltwit;
                  } 

                  // $fu;
                  // $fold = fopen('webpageold.csv', 'r');
                  // if ($fold !== false) {
                  //    while ($data = fgetcsv($fold , 1000 , "")) {
                  //       $data[]

                  //    }
                  // }

               } else {
                  $isaktif = 0;
                  $isi     = 0;
               }
               

            $list = array ( 
               'id_pemda'  => $idpemda, 
               'url'       => $url, 
               'isaktif'   => $isaktif, 
               'urltwit'   => $urltwit, 
               'urlfb'     => $urlfb, 
               'urlyt'     => $urlyt,
               'isi'       => $isi
            );
            
            array_push($semualist, $list);
            }
         }


         $output =  fopen("webpagenew.csv", 'w') or die("can't open webpagenew.csv");
         foreach ($semualist as $line) {
            fputcsv($output, $line , ',');
         }
   


      // $row  = 1;
      // $fh   = fopen('webpagenew.csv', "r");
      // $fold = fopen('webpageold.csv', "r");

      // if ($fh !== false) {
      //    while (($data = fgetcsv($fh , 1000 , "," )) && ($data = fgetcsv($fold , 1000 , "," )) !== false){
      //       $num = count($data);
      //       echo "<p>" . $num . "fields in line" . $row;
            


      //       $sql = "INSERT INTO tes (`date`, `id_pemda`, `isaktif` , `urltwit` , `urlfb`) 
      //       VALUES ( CURRENT_DATE(),".$row.",".$data[1].",'". $data[2] ."','". $data[3] ."');";
      //       $result = $conn->query($sql);

      //       var_dump($sql);
            
      //       $row++;

      //    }

      // }






   

 ?>