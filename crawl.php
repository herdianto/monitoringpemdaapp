
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
                     $twitter_lu = 0;
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
                  

                  #get twitter is update
                  
                  if ($mycsvfile[$i-1][0] == $i) {
                     if ($mycsvfile[$i-1][16] == $twitter_lu ) {
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
               $buku_tamu = 1;
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
               'twitter_lu'   => $twitter_lu, #16
               'twitter_update'    => $twitter_update, #17
               'youtube_update'    => $youtube_update, #18
               'facebook_update'   => $facebook_update, #19
               'web_update'   => $web_update, #20
               'isi'          => $isi #21
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
            $selayang_pandang = ($data[6] * 0.1946 + $data[7] * 0.2016 + $data[5] * 0.1933 + $data[4] * 0.1983 + $data[9] * 0.2122) ;
            $kelengkapan = ($data[3] * 0.2059 + $data[10] * 0.2036 + $data[11] * 0.1971 + $data[8] * 0.1964 + $selayang_pandang * 0.1988) ;
            $score_website = ($data[2] * 0.2630 + $data[20] * 0.2630 + $data[12] * 0.2394 + $kelengkapan * 0.2341) ;
            $score_sosmed =  ((($data[13] * 0.5 + $data[17] * 0.5) * 0.3667)+ (($data[14] * 0.5 + $data[18] * 0.5) * 0.4778) + (($data[15] * 0.5 + $data[19] * 0.5) * 0.1156));

            $total_score = ($score_website * 0.5425 + $score_sosmed * 0.4575);
            
            $sql = "INSERT INTO `result`(`date`, `id_pemda`, `website`, `kelengkapan_website`, `selayang_pandang`, `sejarah`, `motto_daerah`, `lambang`, `lokasi`, `visi_misi`, `pemerintahan_daerah`,`geografi`, `peraturan_daerah`, `buku_tamu`, `SEO_pagerank`, `frekuensi_update`, `frekuensi_aktif`, `sosial_media`, `facebook`, `twitter`, `youtube`, `fu_facebook`, `fu_twitter`, `fu_youtube`, `nilai_total`) 
            VALUES (CURRENT_DATE(),".$data[0].",".$score_website.",".$kelengkapan.",".$selayang_pandang.",".$data[6].",".$data[5].",".$data[4].",".$data[9].",".$data[7].",".$data[8].",".$data[3].",".$data[10].",".$data[11].",".$data[12].",".$data[20].",".$data[2].",".$score_sosmed.",".$data[14].",".$data[13].",".$data[15].",".$data[19].",".$data[17].",".$data[18].",".$total_score.");";

            $result = $conn->query($sql);



            
         }

      }
      #END INSERT TO MYSQL

      // #WEBPAGENEW.CSV == WEBPAGEOLD.CSV
      // $input   = fopen('cachedPages/webpagenew.csv', 'r');  //open for reading
      // $output  = fopen('cachedPages/webpageold.csv', 'w');  //open for writing

      // while (($data = fgetcsv($input , 1000 , ",")) !== false ) {
      //    fputcsv($output, $data);
      // }

      // fclose($input);
      // fclose($output);
      // #END OF WEBPAGENEW.CSV == WEBPAGEOLD.CSV





   

 ?>