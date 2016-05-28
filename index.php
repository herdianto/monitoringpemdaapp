<?php include 'templates/header.php'; ?>


  <div class="container-fluid">
      <br>
      <br>

      <div class="row">
        <div class="col-md-4">
        <?php include 'connection.php'; ?>
      
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
          <form action="" role="search">
                    <div class="form-group-stylish row">
                        <div class="col-md-8">
                            <input type="text" class="form-control" placeholder="Mencari Website Pemda">
                        </div>
                        <div class="col-sm-2">
                            <button class="btn btn-primary" type="submit">Search</button>
                        </div>

                    </div>
                </form>
        </div>
          
        <div class="col-md-8">
             <?php 
              
              $sql = "SELECT result.id_pemda , pemda.nama_pemda,pemda.url , AVG(((((sejarah*0.1946+motto_daerah*0.1933+lambang*0.1983+lokasi*0.2122+visi_misi*0.2016)*0.1988+(pemerintahan_daerah*0.1946)+(geografi*0.2059)+(peraturan_daerah*0.2036)+(buku_tamu*0.1971))*0.2341+SEO_pagerank*0.2393+frekuensi_update*0.2636+frekuensi_aktif*0.2630)*0.5425+ ((facebook*0.5+fu_facebook*0.5)*0.4778+(twitter*0.5+fu_twitter*0.5)*0.3667+(youtube*0.5+fu_youtube*0.5)*0.1556)*0.4575)) AS totalscore
                      FROM pemda INNER JOIN result
                      ON result.id_pemda = pemda.id_pemda
                      GROUP BY id_pemda
                      ORDER BY totalscore DESC
                      LIMIT 10;
                      ";
              $result = $conn->query($sql);

              while ($row = $result->fetch_assoc()) {
                  $id_pemda[]       = $row["id_pemda"];
                  $nama_pemda[]     = $row["nama_pemda"];
                  $totalscore[]     = $row["totalscore"];
                  $url[]            = $row["url"];
              }
             ?>

          <h3 class="text-center">10 Website Pemda Terbaik Pada Bulan Maret </h3>
          <hr>
          <div id="webpemdaterbaik" style="height: 400px"></div>
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
              $sql = "SELECT result.id_pemda , pemda.nama_pemda,pemda.url , AVG(((((sejarah*0.1946+motto_daerah*0.1933+lambang*0.1983+lokasi*0.2122+visi_misi*0.2016)*0.1988+(pemerintahan_daerah*0.1946)+(geografi*0.2059)+(peraturan_daerah*0.2036)+(buku_tamu*0.1971))*0.2341+SEO_pagerank*0.2393+frekuensi_update*0.2636+frekuensi_aktif*0.2630)*0.5425+ ((facebook*0.5+fu_facebook*0.5)*0.4778+(twitter*0.5+fu_twitter*0.5)*0.3667+(youtube*0.5+fu_youtube*0.5)*0.1556)*0.4575)) AS totalscore FROM pemda INNER JOIN result ON result.id_pemda = pemda.id_pemda WHERE pemda.tipe ='PROV' GROUP BY id_pemda ORDER BY totalscore DESC LIMIT 10;
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
              $sql = "SELECT result.id_pemda , pemda.nama_pemda,pemda.url , AVG(((((sejarah*0.1946+motto_daerah*0.1933+lambang*0.1983+lokasi*0.2122+visi_misi*0.2016)*0.1988+(pemerintahan_daerah*0.1946)+(geografi*0.2059)+(peraturan_daerah*0.2036)+(buku_tamu*0.1971))*0.2341+SEO_pagerank*0.2393+frekuensi_update*0.2636+frekuensi_aktif*0.2630)*0.5425+ ((facebook*0.5+fu_facebook*0.5)*0.4778+(twitter*0.5+fu_twitter*0.5)*0.3667+(youtube*0.5+fu_youtube*0.5)*0.1556)*0.4575)) AS totalscore FROM pemda INNER JOIN result ON result.id_pemda = pemda.id_pemda WHERE pemda.tipe ='KAB' GROUP BY id_pemda ORDER BY totalscore DESC LIMIT 10;
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
              $sql = "SELECT result.id_pemda , pemda.nama_pemda,pemda.url , AVG(((((sejarah*0.1946+motto_daerah*0.1933+lambang*0.1983+lokasi*0.2122+visi_misi*0.2016)*0.1988+(pemerintahan_daerah*0.1946)+(geografi*0.2059)+(peraturan_daerah*0.2036)+(buku_tamu*0.1971))*0.2341+SEO_pagerank*0.2393+frekuensi_update*0.2636+frekuensi_aktif*0.2630)*0.5425+ ((facebook*0.5+fu_facebook*0.5)*0.4778+(twitter*0.5+fu_twitter*0.5)*0.3667+(youtube*0.5+fu_youtube*0.5)*0.1556)*0.4575)) AS totalscore FROM pemda INNER JOIN result ON result.id_pemda = pemda.id_pemda WHERE pemda.tipe ='KOTA' GROUP BY id_pemda ORDER BY totalscore DESC LIMIT 10;
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
              <td><?php echo $url[$i]; ?></td>
              <td><?php echo $totalscore[$i]; ?></td>
              <td><a href="detail.php?id_pemda=<?php echo $id_pemda[$i]; ?>" >Click Here</td>
            </tr>
          <?php  } ?>
            

        </tbody>
      </table>
    </div>
  </div>

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
                          categories: [<?php echo $nama ="'".join("','",$nama_pemda)."'";?>]
                      },
                      yAxis: {
                          title: {
                              text: 'Total Skor'
                          }
                      },
                      series: [{
                          showInLegend: false,
                          data: [<?php echo $nilai =join(",",$totalscore) ; ?>]
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
                          showInLegend: false,
                          data: [<?php echo $nilai =join(",",$totalscore_kota) ; ?>]
                      }]
                })

              });
              </script>
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