
<?php 
	require_once 'lib/simple_html_dom.php';
   include 'connection.php';
   include 'function.php';
   require_once('lib/TwitterAPIExchange.php');

      # START CRAWLING
      $mycsvfile = array();
      $fold = fopen('cachedPages/webpageold.csv', "r");
      if ($fold !== false) {
         while (($data = fgetcsv($fold , 1000 , ",")) !== false) {
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
                  $isiarr  = get_url($url);
                  $isi     = implode(" ",$isiarr);
                  $urltwit = findtwitter($isi);
                  if (empty($urltwit)){
                     $twit = 0;
                  } else {
                     $twit = 1;
                     $twitter_lu =  get_twitter_lu($urltwit);
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
                     $youtube_update = 0;
                  } else {
                     $yt = 1;
                     $youtube_update = get_youtube_lu($urlyt);
                  }
                  

                  #get twitter is update -under construction
                  if ($mycsvfile[$i-1][0] == $i) {
                     if ($mycsvfile[$i-1][13] == $twitter_lu ) {
                        $twitter_update = 0;
                     } else{
                        $twitter_update = 1;
                     }
                  }


                  #get website is update
                  if ($mycsvfile[$i-1][0] == $i) {
                     if ($mycsvfile[$i-1][20] == $isi ) {
                        $web_update = 0;
                     } else{
                        $web_update = 1;
                     }
                  }


                     
               } else {
                  $isaktif = 0;
                  $isi     = 0;
               }
                  }
               
               $geografis = geografis($isiarr);
               $lambang = lambang($isiarr);
               $motto = motto($isiarr);
               $sejarah = sejarah($isiarr);
               $visimisi = visimisi($isiarr);
               $kepala_daerah = kepala_daerah($isiarr);
               $peta = peta($isiarr);
               $perda = perda($isiarr);

               #under construction
               $buku_tamu = 0;
               $pagerank = 0;
               $facebook_update =0;

               #

            $list = array ( 
               'id_pemda'     => $idpemda, #0
               'url'          => $url, #1
               'isaktif'      => $isaktif, #2
               'geografis'    => $geografis, #3
               'lambang'      => $lambang, #4
               'motto'        => $motto, #5
               'sejarah'      => $sejarah, #6
               'visimisi'     => $visimisi, #7
               'kepala_daerah'=> $kepala_daerah, #8
               'peta'         => $peta, #9
               'perda'        => $perda, #10
               'buku_tamu'    => $buku_tamu, #11
               'pagerank'     => $pagerank, #12
               'urltwit'      => $twit, #13
               'urlfb'        => $fb, #14
               'urlyt'        => $yt, #15
               'twitter_update'    => $twitter_update, #16
               'youtube_update'    => $youtube_update, #17
               'facebook_update'   => $facebook_update, #18
               'web_update'   => $web_update, #19
               'isi'          => $isi #20
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
            #Total Score Logic

            $kelengkapan = $data[3] * 0.2059 +
            $totalScore = ($data[2] * 0.5 + ($data[3] * 0.33 + $data[4] * 0.33 + $data[5] * 0.33) * 0.2 + $data[6] * 0.3)*100  ;

            $sql = "INSERT INTO tes (`date`, `id_pemda`, `isaktif` , `twitter` , `facebook` ,`youtube` ,`webupdate`,`totalscore`) 
            VALUES ( CURRENT_DATE(),".$data[0].",'". $data[2] ."','". $data[3] ."','".$data[4]."','".$data[5]."',".$data[6].",".$totalScore.");";
            $result = $conn->query($sql);

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