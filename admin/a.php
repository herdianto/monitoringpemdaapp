
<?php 
   require_once 'lib/simple_html_dom.php';
   include '../connection.php';
   include 'function.php';
   require_once('lib/TwitterAPIExchange.php');

      # START CRAWLING
      $mycsvfile = array();
      $fold = fopen('cachedPages/webpageoldcopy.csv', "r");
      if ($fold !== false) {
         while (($data = fgetcsv($fold , 100000 , ",")) !== false) {
         $mycsvfile[] = $data;
         }

         fclose($fold);
      }

      
      $mycsvfilenew = array();
      $fnew = fopen('cachedPages/webpagenew.csv', "r");
      if ($fnew !== false) {
         while (($data = fgetcsv($fnew , 100000 , ",")) !== false) {
         $mycsvfilenew[] = $data;
         }


         fclose($fnew);
      }

      for ($i=1; $i <= count($mycsvfile) ; $i++) { 
            if (!isset($mycsvfilenew[$i-1][21]) || !isset($mycsvfile[$i-1][21])) {
                  $web_update = 0;
               }else{
                     if ($mycsvfilenew[$i-1][21] == $mycsvfile[$i-1][21]) {
                        $web_update =0;
                     } else{
                        $web_update =1;
                     }
               }
               
            echo "web update untuk id: ".$i." adalah : ".$web_update."<br>";

      }
      var_dump(count($count));

      // if ($mycsvfilenew[6][21] == $mycsvfile[6][21] ) {
      //    $web_update = 0;
      // } else {
      //    $web_update = 1;
      // }
      // echo $web_update;
      

      
      


            

         #INSERT TO CSV
            
         
         #END INSERT CSV
      #END CRAWLING


            

      #WEBPAGENEW.CSV == WEBPAGEOLD.CSV
      // $input   = fopen('cachedPages/webpagenew.csv', 'r');  //open for reading
      // $output  = fopen('cachedPages/webpageold.csv', 'w');  //open for writing

      // while (($data = fgetcsv($input , 1000 , ",")) !== false ) {
      //    fputcsv($output, $data);
      // }

      // fclose($input);
      // fclose($output);
      #END OF WEBPAGENEW.CSV == WEBPAGEOLD.CSV

      echo "Done Update Webpage At " . date("h:i:s");




   

 ?>