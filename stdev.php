<?php 
include 'connection.php';
$sql = "SELECT result.id_pemda , pemda.nama_pemda,pemda.url , ROUND(AVG(((((sejarah*0.1946+motto_daerah*0.1933+lambang*0.1983+lokasi*0.2122+visi_misi*0.2016)*0.1988+(pemerintahan_daerah*0.1946)+(geografi*0.2059)+(peraturan_daerah*0.2036)+(buku_tamu*0.1971))*0.3077+frekuensi_update*0.3465+frekuensi_aktif*0.3458)*0.5425+ ((facebook*0.5+fu_facebook*0.5)*0.4778+(twitter*0.5+fu_twitter*0.5)*0.3667+(youtube*0.5+fu_youtube*0.5)*0.1556)*0.4575)),2) AS totalscore
                      FROM pemda INNER JOIN result
                      ON result.id_pemda = pemda.id_pemda
                      WHERE DATE_FORMAT(NOW(),'%c')
                      GROUP BY id_pemda
                      ORDER BY totalscore DESC
                      ;
                      ";
              $result = $conn->query($sql);

              while ($row = $result->fetch_assoc()) {
                  $id_pemda[]       = $row["id_pemda"];
                  $nama_pemda[]     = $row["nama_pemda"];
                  $totalscore[]     = $row["totalscore"];
                  $url[]            = $row["url"];
              }
$kuadrat = array();
$avg = array_sum($totalscore)/count($totalscore);
var_dump($avg);
for ($i=0; $i <count($totalscore) ; $i++) { 
	// print_r($totalscore[$i]-$avg);

	$kuadrat[] = ($totalscore[$i]-$avg)*($totalscore[$i]-$avg);


}
$stdDev = sqrt(array_sum($kuadrat)/(count($totalscore)-1));


$rata_stdDev = array();
              for ($i=0; $i < count($totalscore) ; $i++) { 
                $rata_std = $totalscore[$i]/$stdDev ;  
                $rata_stdDev[] = round($rata_std,2);
              }

             var_dump($stdDev);
              
              // echo $totalscore[0]/$stdDev ."<br>";
              // for ($i=0; $i < count($totalscore) ; $i++) { 
              // 	echo $totalscore[$i]."<br>";
              // }
 
// echo $nilai =join(",",$totalscore_terbaik) ;
?> 

