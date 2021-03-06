<?php include 'templates/header.php'; ?>


  <div class="container-fluid">
      <br>
      <br>

      <div class="row">
        <div class="col-md-4">
        <?php include 'connection.php'; ?>
        <?php include 'function.php' ?>
      
          <!-- <h4>Total Website Terdaftar</h4>
          <h4>Total Website Aktif</h4>
          <h4>Total Website Update</h4>
          <h4>Rataan Kelengkapan Website</h4>
          <h4>Total Website</h4> -->
<!--           <ul class="nav nav-tabs nav-stacked">
            <li>Total Website Aktif</li>
            <li></li>
            <li></li>
            <li></li>
          </ul>
 -->      
          <?php 
            $sql='SELECT COUNT(pemda.nama_pemda) AS jumlah ,(COUNT(pemda.nama_pemda)-(SUM(CASE WHEN pemda.url = "-" THEN 1 ELSE 0 END))) AS pemda_terdaftar FROM pemda;'; 
            $result=$conn->query($sql); 
            while ($row=$result->fetch_assoc()) {
               $total_pemda = $row['jumlah'];
               $total_pemda_terdaftar = $row['pemda_terdaftar'];
             }; 
           ?>

           <?php 
            $sql='SELECT 
                  SUM(CASE WHEN result.frekuensi_aktif = 1 THEN 1 ELSE 0 END) AS totalaktif,
                  SUM(CASE WHEN result.frekuensi_update = 1 THEN 1 ELSE 0 END) AS totalupdate,   
                  ROUND(AVG((sejarah*0.1946+motto_daerah*0.1933+lambang*0.1983+lokasi*0.2122+visi_misi*0.2016)*0.1988+(pemerintahan_daerah*0.1946)+(geografi*0.2059)+(peraturan_daerah*0.2036)+(buku_tamu*0.1971)),2)*100 AS rata_kelengkapan,
                  MAX(date) AS tanggal_terakhir
                  FROM result
                  WHERE result.date = ( SELECT MAX(date) FROM result);'; 
            $result=$conn->query($sql); 
            while ($row=$result->fetch_assoc()) {
               $totalaktif = $row['totalaktif'];
               $totalupdate = $row['totalupdate'];
               $rata_kelengkapan = $row['rata_kelengkapan'];
               $tanggal_terakhir = $row['tanggal_terakhir'];
             }; 
           ?>
          <h3>Daily Stats </h3>

          <hr>
          <div class="sidebar">
             <h4 style="line-height: 1.5">Total Pemerintah Daerah<span class = "badge pull-right"><?php echo $total_pemda;?></span></h4>
             <h4 style="line-height: 1.5">Total Website Terdaftar<span class = "badge pull-right"><?php echo $total_pemda_terdaftar;?></span></h4>
             <h4 style="line-height: 1.5">Total Website Aktif <span class ="badge pull-right"><?php echo $totalaktif; ?></span></h4>
             <h4 style="line-height: 1.5">Total Website Update <span class = "badge pull-right"><?php echo $totalupdate; ?></span></h4>
             <h4 style="line-height: 1.5">Rata-Rata Kelengkapan Website <span class = "badge pull-right"><?php echo $rata_kelengkapan; ?>%</span></h4>
             <h4 style="line-height: 1.5">Tanggal Crawling <span class = "badge pull-right"><?php echo $tanggal_terakhir; ?></span></h4>
          </div>
          <br>
          

          <form action="detail.php" role="search" method="get">
                    <div class="form-group-stylish row">
                        <div class="col-md-8">
                            <select id="search_web" name="id_pemda" type="text" class="form-control" value="" placeholder="Mencari Website Pemda"></select>
                        </div>
                        
                        <div class="col-sm-2">
                            <input class="btn btn-primary" type="submit" value="Search" />
                        </div>

                    </div>
                
                </form>
                
        </div>
          
        <div class="col-md-8">
             <?php 
              $sql = "SELECT result.id_pemda , pemda.tipe , pemda.nama_pemda,pemda.url , ROUND(AVG(((((sejarah*0.1946+motto_daerah*0.1933+lambang*0.1983+lokasi*0.2122+visi_misi*0.2016)*0.1988+(pemerintahan_daerah*0.1946)+(geografi*0.2059)+(peraturan_daerah*0.2036)+(buku_tamu*0.1971))*0.3077+frekuensi_update*0.3465+frekuensi_aktif*0.3458)*0.5425+ ((facebook*0.5+fu_facebook*0.5)*0.4778+(twitter*0.5+fu_twitter*0.5)*0.3667+(youtube*0.5+fu_youtube*0.5)*0.1556)*0.4575)),2) AS totalscore
                      FROM pemda INNER JOIN result
                      ON result.id_pemda = pemda.id_pemda
                      WHERE DATE_FORMAT(NOW(),'%c')
                      GROUP BY id_pemda
                      ORDER BY totalscore DESC
                      limit 10;
                      ";
              $result = $conn->query($sql);

              while ($row = $result->fetch_assoc()) {
                  $id_pemda_terbaik[]       = $row["id_pemda"];
                  $nama_pemda_terbaik[]     = $row["nama_pemda"];
                  $totalscore_terbaik[]     = $row["totalscore"];
                  $url_terbaik[]            = $row["url"];
                  $tipe[]                   = $row["tipe"];
              }
              $sql = "SELECT result.id_pemda ,pemda.tipe, pemda.nama_pemda,pemda.url , ROUND(AVG(((((sejarah*0.1946+motto_daerah*0.1933+lambang*0.1983+lokasi*0.2122+visi_misi*0.2016)*0.1988+(pemerintahan_daerah*0.1946)+(geografi*0.2059)+(peraturan_daerah*0.2036)+(buku_tamu*0.1971))*0.3077+frekuensi_update*0.3465+frekuensi_aktif*0.3458)*0.5425+ ((facebook*0.5+fu_facebook*0.5)*0.4778+(twitter*0.5+fu_twitter*0.5)*0.3667+(youtube*0.5+fu_youtube*0.5)*0.1556)*0.4575)),2) AS totalscore
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
                  $tipe_allpemda[]  = $row["tipe"];
              }
              //menghitung standar deviasi
              $kuadrat = array();
              $avg = array_sum($totalscore)/count($totalscore);

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
              $new_totalscore = array();
              for ($i=0; $i < count($totalscore); $i++) { 
                if ($totalscore[$i]==0) {
                  $new_totalscore[] = 0.01;
                }else{
                  $new_totalscore[] = $totalscore[$i];
                }
              }
              //end menghitung standar deviasi

             ?>


         <ul class="nav nav-tabs">
            <li class="nav active"><a href="#A" data-toggle="tab">Nilai Website Terbaik</a></li>
            <li class="nav"><a href="#B" data-toggle="tab">Semua Pemda</a></li>
            <li class="nav"><a href="#C" data-toggle="tab">Rata-Rata Skor</a></li>
            
            
        </ul>
        <style type="text/css">
          .tab-content > .tab-pane:not(.active) {
              display: block;
              height: 0;
              overflow-y: hidden;
          }
        </style>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" id="A">
              <h3 class="text-center">10 Website Pemda Terbaik Pada Bulan <?php $bln=date("m"); echo bulan($bln); ?> </h3>
              
              <div id="webpemdaterbaik" style="height: 400px"></div>
            </div>
            <div class="tab-pane fade " id="B">
              <h3 class="text-center">Menampilkan Semua Pemda</h3>
              
              <div id="allpemda" style="height: 400px"></div>
            </div>
            <div class="tab-pane fade " id="C">
              <h3 class="text-center">Menampilkan Rata-Rata Skor </h3>
              
              <div id="sdev" style="height: 400px"></div>
            </div>
        </div>


          

          
        </div>
      </div>

      <div class="row">
    <div class="col-md-12">
      <table id="maintable" class="table table-hover table-condensed table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Nama Pemda</th>
            <th>Link URL</th>
            <th>Total Skor</th>
            <th>Detail</th>
          </tr>
        </thead>
        <tbody>
        <?php 
              $sql = "SELECT result.id_pemda , pemda.nama_pemda,pemda.url , ROUND(AVG(((((sejarah*0.1946+motto_daerah*0.1933+lambang*0.1983+lokasi*0.2122+visi_misi*0.2016)*0.1988+(pemerintahan_daerah*0.1946)+(geografi*0.2059)+(peraturan_daerah*0.2036)+(buku_tamu*0.1971))*0.3077+frekuensi_update*0.3465+frekuensi_aktif*0.3458)*0.5425+ ((facebook*0.5+fu_facebook*0.5)*0.4778+(twitter*0.5+fu_twitter*0.5)*0.3667+(youtube*0.5+fu_youtube*0.5)*0.1556)*0.4575)),2) AS totalscore
                      FROM pemda INNER JOIN result ON result.id_pemda = pemda.id_pemda WHERE pemda.tipe ='PROV' AND DATE_FORMAT(NOW(),'%c') GROUP BY id_pemda ORDER BY totalscore DESC LIMIT 10;
                      ";
              $result = $conn->query($sql);

              while ($row = $result->fetch_assoc()) {
                  $id_pemda_prov[]       = $row["id_pemda"];
                  $nama_pemda_prov[]     = $row["nama_pemda"];
                  $totalscore_prov[]     = $row["totalscore"];
                  $url_prov[]            = $row["url"];
              }
         ?>
        <?php 
              $sql = "SELECT result.id_pemda , pemda.nama_pemda,pemda.url , ROUND(AVG(((((sejarah*0.1946+motto_daerah*0.1933+lambang*0.1983+lokasi*0.2122+visi_misi*0.2016)*0.1988+(pemerintahan_daerah*0.1946)+(geografi*0.2059)+(peraturan_daerah*0.2036)+(buku_tamu*0.1971))*0.3077+frekuensi_update*0.3465+frekuensi_aktif*0.3458)*0.5425+ ((facebook*0.5+fu_facebook*0.5)*0.4778+(twitter*0.5+fu_twitter*0.5)*0.3667+(youtube*0.5+fu_youtube*0.5)*0.1556)*0.4575)),2) AS totalscore
                      FROM pemda INNER JOIN result ON result.id_pemda = pemda.id_pemda WHERE pemda.tipe ='KAB' AND DATE_FORMAT(NOW(),'%c') GROUP BY id_pemda ORDER BY totalscore DESC LIMIT 10;
                      ";
              $result = $conn->query($sql);

              while ($row = $result->fetch_assoc()) {
                  $id_pemda_kab[]       = $row["id_pemda"];
                  $nama_pemda_kab[]     = $row["nama_pemda"];
                  $totalscore_kab[]     = $row["totalscore"];
                  $url_kab[]            = $row["url"];
              }
         ?>
        <?php 
              $sql = "SELECT result.id_pemda , pemda.nama_pemda,pemda.url , ROUND(AVG(((((sejarah*0.1946+motto_daerah*0.1933+lambang*0.1983+lokasi*0.2122+visi_misi*0.2016)*0.1988+(pemerintahan_daerah*0.1946)+(geografi*0.2059)+(peraturan_daerah*0.2036)+(buku_tamu*0.1971))*0.3077+frekuensi_update*0.3465+frekuensi_aktif*0.3458)*0.5425+ ((facebook*0.5+fu_facebook*0.5)*0.4778+(twitter*0.5+fu_twitter*0.5)*0.3667+(youtube*0.5+fu_youtube*0.5)*0.1556)*0.4575)),2) AS totalscore
                      FROM pemda INNER JOIN result ON result.id_pemda = pemda.id_pemda WHERE pemda.tipe ='KOTA' AND DATE_FORMAT(NOW(),'%c') GROUP BY id_pemda ORDER BY totalscore DESC LIMIT 10;
                      ";
              $result = $conn->query($sql);

              while ($row = $result->fetch_assoc()) {
                  $id_pemda_kota[]       = $row["id_pemda"];
                  $nama_pemda_kota[]     = $row["nama_pemda"];
                  $totalscore_kota[]     = $row["totalscore"];
                  $url_kota[]            = $row["url"];
              }
         ?>
          <?php for ($i=0; $i <10 ; $i++) { ?>
            <tr>
              <td><?php echo $i+1; ?></td>
              <td><?php echo $nama_pemda[$i]; ?></td>
              <td><a href="<?php echo "$url[$i]"; ?>"><?php echo $url[$i]; ?></a></td>
              <td><?php echo $totalscore[$i]; ?></td>
              <td><a href="detail.php?id_pemda=<?php echo $id_pemda[$i]; ?>" >Click Here</td>
            </tr>
          <?php  } ?>
            

        </tbody>
      </table>
    </div>
  </div>
          <?php 
          $tipe_color=array();
          for ($i=0; $i < count($tipe) ; $i++) { 
            if ($tipe[$i]=='PROV') {
              $tipe_color[]='#990000';
            } elseif ($tipe[$i]=='KAB') {
              $tipe_color[]='#00802b';
            }elseif ($tipe[$i]=='KOTA') {
              $tipe_color[]='#0000ff';
            }else{
              $tipe_color[]='#0000ff';
            }

          }

          $color_allpemda = array();
          for ($i=0; $i < count($tipe_allpemda) ; $i++) { 
            if ($tipe_allpemda[$i]=='PROV') {
              $color_allpemda[]='#990000';
            } elseif ($tipe_allpemda[$i]=='KAB') {
              $color_allpemda[]='#00802b';
            }elseif ($tipe_allpemda[$i]=='KOTA') {
              $color_allpemda[]='#0000ff';
            }else{
              $color_allpemda[]='#0000ff';
            }

          }
          ?>

          <?php 
          $merge_data = array() ;
          for ($i=0; $i < count($tipe) ; $i++) { 
            $merge_data[]="{y:".$totalscore_terbaik[$i].", color:'".$tipe_color[$i]."'},";
          }

          $merge_allpemda = array();
          for ($i=0; $i < count($tipe_allpemda) ; $i++) { 
            $merge_allpemda[]="{y:".$totalscore[$i].", color:'".$color_allpemda[$i]."'},";
          }

          ?>

          <script> 
                $(document).ready(function(){

                    
                var chart1 = new Highcharts.Chart({

                      chart: {
                          renderTo: 'webpemdaterbaik',
                          type: 'column'
                      },
                      title: {
                          text: ''
                      },
                      xAxis: {
                          categories: [<?php echo $nama ="'".join("','",$nama_pemda_terbaik)."'";?>],

                      },
                      yAxis: {
                          title: {
                              text: 'Total Skor'
                          }
                      },

                      // plotOptions:{ // for different color of bar
                      // series:{ colorByPoint: true}
                      // },
                      series: [{
   
                          showInLegend: false,
                          name: 'Nilai',
                          data: [<?php echo $aa =join(",",$merge_data) ; ?>]
                      }]

                  });
                //  
                var allpemda = new Highcharts.Chart({

                      chart: {
                          renderTo: 'allpemda',
                          type: 'column'
                      },
                      title: {
                          text: ''
                      },
                      xAxis: {
                          categories: [<?php echo $nama ="'".join("','",$nama_pemda)."'";?>],

                      },
                      yAxis: {
                          title: {
                              text: 'Total Skor'
                          }
                      },
                      plotOptions:{
                          series:{
                              turboThreshold:50000
                          }
                      },
                      legend: {
                          useHTML:true,
                          layout: 'vertical',
                          floating: true,
                          align: 'right',
                          verticalAlign: 'top',
                          // labelFormat: "<span style='color:{color}'</span>: <b>+- 1SD</b><br/> <span style='color:#002db3'</span>: <b>+- 2SD</b><br/><span style='color:#00ff55'</span>: <b>+- 3SD</b><br/>"
                          
                      },
                      series: [{
                          showInLegend: false,
                          data: [<?php echo $nilai =join(",",$merge_allpemda) ; ?>]
                      },{
                          name:'Provinsi',
                          color:'#990000',
                          data:{},
                          marker:{symbol:'square',radius:12}
                      },{
                          name:'Kabupaten',
                          color:'#00802b',
                          data:{},
                          marker:{symbol:'square',radius:12}
                      },{
                          name:'Kota',
                          color:'#0000ff',
                          data:{},
                          marker:{symbol:'square',radius:12}
                      }]

                  });

                var sdev = new Highcharts.Chart({

                      chart: {
                          renderTo: 'sdev',
                          type: 'column'
                      },
                      title: {
                          text: ''
                      },
                      xAxis: {
                          categories: [<?php echo $nama ="'".join("','",$nama_pemda)."'";?>],

                      },
                      yAxis: {
                          title: {
                              text: 'Total Skor'
                          },
                          plotLines: [{
                              value: <?php echo $avg ?>,
                              color: 'green',
                              dashStyle: 'shortdash',
                              width: 2,
                              label: {
                                  text: 'Rata-Rata = <?php echo round($avg,3) ?>',
                                  align: 'right'
                              }
                          }]
                      },
                      legend: {
                          useHTML:true,
                          layout: 'vertical',
                          floating: true,
                          align: 'right',
                          verticalAlign: 'top',
                          // labelFormat: "<span style='color:{color}'</span>: <b>+- 1SD</b><br/> <span style='color:#002db3'</span>: <b>+- 2SD</b><br/><span style='color:#00ff55'</span>: <b>+- 3SD</b><br/>"
                          
                      },
                      series: [{
                          showInLegend: false,
                          name: 'Nilai',
                          data: [<?php echo $nilai =join(",",$new_totalscore) ; ?>],
                          zones:[{
                            value:<?php echo $avg - $stdDev; ?>,
                            color:'#002db3'
                          },{
                            value:<?php echo $avg + $stdDev; ?>,
                          },{
                            value:<?php echo $avg + (2*$stdDev); ?>,
                            color:'#002db3'
                          },{
                            value:<?php echo $avg + (3*$stdDev); ?>,
                            color:'#00ff55'
                          }]
                      },{

                            name:'+- 1SD',
                            color:'#80bfff',
                            data:{},
                            marker:{symbol:'square',radius:12},
                        },{

                            name:'+- 2SD',
                            data:{},
                            color:'#002db3',
                            marker:{symbol:'square',radius:12},
                        },{

                            name:'+- 3SD',
                            data:{},
                            color:'#00ff55',
                            marker:{symbol:'square',radius:12},
                        }]

                  });


                var chart2 = new Highcharts.Chart({
                  chart: {
                          renderTo: 'webpemdaprov',
                          type: 'bar'
                      },
                      title: {
                          text: ''
                      },
                      xAxis: {
                          categories: [<?php echo $nama ="'".join("','",$nama_pemda_prov)."'";?>]
                      },
                      yAxis: {
                          title: {
                              text: 'Total Skor'
                          }
                      },
                      series: [{
                          color: '#990000',
                          showInLegend: false,
                          data: [<?php echo $nilai =join(",",$totalscore_prov) ; ?>]
                      }]
                })

                var chart3 = new Highcharts.Chart({
                  chart: {
                          renderTo: 'webpemdakab',
                          type: 'bar'
                      },
                      title: {
                          text: ''
                      },
                      xAxis: {
                          categories: [<?php echo $nama ="'".join("','",$nama_pemda_kab)."'";?>]
                      },
                      yAxis: {
                          title: {
                              text: 'Total Skor'
                          }
                      },
                      series: [{
                          color:'#00802b',
                          showInLegend: false,
                          data: [<?php echo $nilai =join(",",$totalscore_kab) ; ?>]
                      }]
                })

                var chart4 = new Highcharts.Chart({
                  chart: {
                          renderTo: 'webpemdakota',
                          type: 'bar'
                      },
                      title: {
                          text: ''
                      },
                      xAxis: {
                          categories: [<?php echo $nama ="'".join("','",$nama_pemda_kota)."'";?>]
                      },
                      yAxis: {
                          title: {
                              text: 'Total Skor'
                          }
                      },
                      series: [{
                          color:'#0000ff',
                          showInLegend: false,
                          data: [<?php echo $nilai =join(",",$totalscore_kota) ; ?>]
                      }]
                })

              });
              </script>
              <script src="http://code.highcharts.com/modules/exporting.js"></script>
              <!-- optional -->
              <script src="http://code.highcharts.com/modules/offline-exporting.js"></script>
      <div class="row">
        <div class="col-md-4">
          <h5 class="text-center">Website Provinsi Terbaik</h5>
          <div id="webpemdaprov" style="height: 250px"></div>
        </div>
        <div class="col-md-4">
          <h5 class="text-center">Website Kabupaten Terbaik</h5>
          <div id="webpemdakab" style="height: 250px"></div>
        </div>
        <div class="col-md-4">
          <h5 class="text-center">Website Kota Terbaik</h5>
          <div id="webpemdakota" style="height: 250px"></div>
        </div>
      </div>

  
  <div class="row">
    <div class="col-md-4">

<?php include 'templates/footer.php' ?>