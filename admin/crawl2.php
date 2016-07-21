
<?php 
   require_once 'lib/simple_html_dom.php';
   include '../connection.php';
   include 'function.php';
   require_once('lib/TwitterAPIExchange.php');

      # START CRAWLING
      $mycsvfile = array();
      $fold = fopen('cachedPages/webpageold2.csv', "r");
      if ($fold !== false) {
         while (($data = fgetcsv($fold , 100000 , ",")) !== false) {
         $mycsvfile[] = $data;
         }

         fclose($fold);
      }


      $output =  fopen("cachedPages/webpagenew2.csv", 'w') or die("can't open webpagenew.csv");
      
      
      for ($i = 250; $i <= 530 ; $i++) { 
         $sql = "SELECT id_pemda,url FROM pemda WHERE id_pemda=".$i.";";
         $result = $conn->query($sql);
         
         while ( $row = $result->fetch_assoc()) {
          $url       = $row["url"];
          $idpemda = $row["id_pemda"];
          


          
          if ($isiarr = get_url($url)) {
            

             
             $isaktif = 1;
             // $isiarr  = get_url($url);
             $isi     = implode(" ",$isiarr);
                  $urltwit = findtwitter($isi);
                  if (empty($urltwit)){
                     $twit = 0;
                     $twitter_lu = 0;
                  } else {
                     $twit = 1;
                     $twitter_lu =  get_twitter_lu($urltwit);
                  }
                  $urlfb   = findfacebook($isi);
                  if (empty($urlfb)){
                     $fb = 0;
                     $facebook_lu = 0;
                  } else {
                     $fb = 1;
                     $facebook_lu = get_facebook_lu($urlfb);
                  }
                  $urlyt   = findyoutube($isi);
                  if (empty($urlyt)){
                     $yt = 0;
                     $youtube_update = 0;
                  } else {
                     $yt = 1;
                     $youtube_update = get_youtube_lu($urlyt);
                  }
                  

                  #get twitter is update
                  if (!isset($mycsvfile[$i-1][16])) {
                     $twitter_update=0;
                  } else {
                     if ($twit == 0) {
                        $twitter_update=0;
                     }else{
                        if ($mycsvfile[$i-1][16] == $twitter_lu ) {
                           $twitter_update = 0;
                        } else{
                           $twitter_update = 1;
                        }
                     }
                  }

                  #get facebook is update
                  if (!isset($mycsvfile[$i-1][22])) {
                     $facebook_update=0;
                  } else {
                     if ($fb == 0) {
                        $facebook_update=0;
                     }else{
                        if ($mycsvfile[$i-1][22] == $facebook_lu ) {
                           $facebook_update = 0;
                        } else{
                           $facebook_update = 1;
                        }
                     }
                  }

                  #get website is update
               if (!isset($isi) || !isset($mycsvfile[$i-1][21])) {
                  $web_update = 0;
               }else{
                     if ($isi == $mycsvfile[$i-1][21]) {
                        $web_update =0;
                     } else{
                        $web_update =1;
                     }
               }
               
            
          } else {
               $isaktif = 0;
               $isi     = 0;
               $isiarr  = 0;
               $youtube_update = 0;
               $twitter_update = 0;
               $twitter_lu =0;
               $web_update=0;
               $twit =0;
               $fb =0;
               $yt =0;
               $facebook_update=0;
               $facebook_lu =0;

         }
                     
                         $geografis = geografis($isiarr);
                           $lambang = lambang($isiarr);
                           $motto = motto($isiarr);
                           $sejarah = sejarah($isiarr);
                           $visimisi = visimisi($isiarr);
                           $kepala_daerah = kepala_daerah($isiarr);
                           $peta = peta($isiarr);
                           $perda = perda($isiarr);
                           $buku_tamu = buku_tamu($isi);

                           #under construction
                           
                           $pagerank = 1;

         


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
               'twitter_lu'   => $twitter_lu, #16
               'twitter_update'    => $twitter_update, #17
               'youtube_update'    => $youtube_update, #18
               'facebook_update'   => $facebook_update, #19
               'web_update'   => $web_update, #20
               'isi'          => $isi, #21
               'facebook_lu'  => $facebook_lu, #22

            );
            
            fputcsv($output, $list , ',');

            
         }
      }

         #INSERT TO CSV
            
         fclose($output);
         #END INSERT CSV
      #END CRAWLING


      #INSERT TO MYSQL
      $fh   = fopen('cachedPages/webpagenew2.csv', "r");


      if ($fh !== false) {
         while (($data = fgetcsv($fh , 100000 , "," )) !== false){
            
            $sql = "INSERT INTO `result`(`date`, `id_pemda`,`sejarah`, `motto_daerah`, `lambang`, `lokasi`, `visi_misi`, `pemerintahan_daerah`,`geografi`, `peraturan_daerah`, `buku_tamu`,`frekuensi_update`, `frekuensi_aktif`,`facebook`, `twitter`, `youtube`, `fu_facebook`, `fu_twitter`, `fu_youtube`) 
                                 VALUES (CURRENT_DATE(),".$data[0].",".$data[6].",".$data[5].",".$data[4].",".$data[9].",".$data[7].",".$data[8].",".$data[3].",".$data[10].",".$data[11].",".$data[20].",".$data[2].",".$data[14].",".$data[13].",".$data[15].",".$data[19].",".$data[17].",".$data[18].");";
    
            $result = $conn->query($sql);

     




            
         }
         echo "Done Crawling At " . date("h:i:s");

      }
      #END INSERT TO MYSQL

      #WEBPAGENEW.CSV == WEBPAGEOLD.CSV
      $input   = fopen('cachedPages/webpagenew2.csv', 'r');  //open for reading
      $output  = fopen('cachedPages/webpageold2.csv', 'w');  //open for writing

      while (($data = fgetcsv($input , 100000 , ",")) !== false ) {
         fputcsv($output, $data);
      }

      fclose($input);
      fclose($output);
      #END OF WEBPAGENEW.CSV == WEBPAGEOLD.CSV

      echo "Done Update Webpage At " . date("h:i:s");




   

 ?>