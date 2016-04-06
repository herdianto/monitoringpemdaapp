<?php 
   $resultnew  = array();
   $resultold   = array();
   $csvFiles   =  array(
      'webpagenew.csv' => 'webpagenew',
      'webpageold.csv' => 'webpageold'
   );   

   foreach ($csvFiles as $csvFile => $type) {
      if ($handle = fopen($csvFile, 'r')) {

      while ($data = fgetcsv($handle, 1000 , ',')) {


         switch ($type) {
            case 'webpagenew':
               $record = array(
                  'id_pemda'  => $data[0] , 
                  'url'       => $data[1] , 
                  'isaktif'   => $data[2] , 
                  'urltwit'   => $data[3] 
               );

               $idpemda = $record['id_pemda'];
               $resultnew[$idpemda]  = $record;
               break;
            
            case 'webpageold':
               $record = array(
                  'id_pemda'  => $data[0] , 
                  'url'       => $data[1] , 
                  'isaktif'   => $data[2] , 
                  'urltwit'   => $data[3] 
               );

               $idpemda = $record['id_pemda'];
               $resultold[$idpemda]  = $record;
               break;
               
         }
      }


      }
   }

      foreach (array_map(null, $resultold , $resultnew) as list ($itemOld,$itemNew) ) {
         if ($itemOld['urltwit'] == $itemNew['urltwit']){
            $fu = 0;
         } else {
            $fu = 1;
         }

         echo "Apakah ada update dari id : <br>";
         echo "hasilnya : ".$fu . "<br>";
      }




?>