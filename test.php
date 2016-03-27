
<?php 
	require_once 'lib/simple_html_dom.php';
	include 'connection.php';
	include 'function.php';

   
      // for ($i = 1; $i <= 3 ; $i++) { 
      //    $sql = "SELECT url FROM pemda WHERE id_pemda=".$i;
      //    $result = $conn->query($sql);
      
      //    while ( $row = $result->fetch_assoc()) {
      //    $url = $row["url"];

      //    $nl      = "\n";
      //       if (aktif($url)) {
      //          $isaktif = 1;
      //          $isi     = get_url($url);
      //          $urltwit = findtwitter($isi);
      //          $urlyt   = findyoutube($isi);
      //          $urlfb   = findfacebook($isi);
      //       } else {
      //          $isaktif = 0;
      //          $isi     = 0;
      //          $urltwit = 0;
      //          $urlyt   = 0;
      //          $urlfb   = 0;
      //       }
            

      //    $list = array ( "$url , $isaktif , $urltwit , $urlfb , $isi , $nl");
      //       $fh = fopen('webpage.csv', 'a') or die("Can't open file");
      //       foreach ($list as $line) {
      //       fputcsv($fh, explode(',', $line));
      //       }
      //    }   
      // }
   


      $row  = 1;
      $fh   = fopen('webpage.csv', "r");

      if ($fh !== false) {
         while (($data = fgetcsv($fh , 1000 , "," )) !== false){
            $num = count($data);
            echo "<p>" . $num . "fields in line" . $row;
            

            $sql = "INSERT INTO tes (`date`, `id_pemda`, `isaktif` , `urltwit` , `urlfb`) 
            VALUES ( CURRENT_DATE(),".$row.",".$data[1].",'". $data[2] ."','". $data[3] ."');";
            $result = $conn->query($sql);

            var_dump($sql);
            
            $row++;

         }

      }




   

 ?>