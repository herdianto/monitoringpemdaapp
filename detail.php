<?php include 'templates/header.php'; ?>
<br>
<br>
<br>
<br>
<div class="container">

	<div class="row">
		<div class="col-md-12">
			<?php    
              include 'connection.php';
              $sql = "SELECT result.fu_twitter, result.fu_facebook,result.fu_youtube,result.sejarah, result.frekuensi_aktif,result.frekuensi_update, result.date,result.id_pemda , pemda.nama_pemda,pemda.url ,

              round(( ( 
                  (sejarah*0.1946)+(motto_daerah*0.1933)+(lambang*0.1983)+(lokasi*0.2122)+(visi_misi*0.2016)
                  )*0.1988 + (pemerintahan_daerah*0.1946)+(geografi*0.2059)+(peraturan_daerah*0.2036)+(buku_tamu*0.1971)
                ),2) as kelengkapan_website,
                  
                  round(
              ((
              (
                ( ( 
                  (sejarah*0.1946)+(motto_daerah*0.1933)+(lambang*0.1983)+(lokasi*0.2122)+(visi_misi*0.2016)
                  )*0.1988 + (pemerintahan_daerah*0.1946)+(geografi*0.2059)+(peraturan_daerah*0.2036)+(buku_tamu*0.1971)
                ) * 0.3077) +
                  (frekuensi_update*0.3465)+
                  (frekuensi_aktif*0.3458)
                  )* 0.5425)
                  +
                        ((((facebook*0.5+fu_facebook*0.5)*0.4778)+((twitter*0.5+fu_twitter*0.5)*0.3667)+((youtube*0.5+fu_youtube*0.5)*0.1556))* 0.4572)
               ,2) AS totalscore
    
    
                      FROM pemda INNER JOIN result ON result.id_pemda = pemda.id_pemda WHERE result.id_pemda =".$_GET["id_pemda"]." GROUP BY result.date LIMIT 30";
              $result = $conn->query($sql);

              while ($row = $result->fetch_assoc()) {
              	  $result_date[]	= $row["date"];
                  $id_pemda[]       = $row["id_pemda"];
                  $isaktif[]        = $row["frekuensi_aktif"];
                  $isupdate[]       = $row["frekuensi_update"];
                  $sejarah[]        = $row["sejarah"];
                  $nama_pemda[]     = $row["nama_pemda"];
                  $kelengkapan[]    = $row["kelengkapan_website"];
                  $totalscore[]     = $row["totalscore"];
                  $url[]            = $row["url"];
                  $twitter[]        = $row["fu_twitter"];
                  $facebook[]       = $row["fu_facebook"];
                  $youtube[]        = $row["fu_youtube"];
              }
              
             ?>
		<h3 class="text-center">GRAFIK PERTUMBUHAN NILAI WEBSITE <?php echo $nama_pemda[1]; ?></h3>

            <div id="grafikdetail"></div>
           <script>
           	$(document).ready(function(){
				var grafik_detail = new Highcharts.Chart({
					chart: {
                          renderTo: 'grafikdetail',
                          type: 'line'
                      },
                      title: {
                          text: ''
                      },
                      xAxis: {
                          categories: [<?php echo $nama ="'".join("','",$result_date)."'";?>]
                      },
                      yAxis: {
                          title: {
                              text: 'Total Skor'
                          }
                      },
                      plotOptions: {

                          series: {
                              dataLabels: {
                                  enabled: true,
                                  borderRadius: 5,
                                  backgroundColor: 'rgba(252, 255, 197, 0.7)',
                                  borderWidth: 1,
                                  borderColor: '#AAA',
                                  y: -6
                              }
                          }
                      },
                      series: [{
                          showInLegend: false,
                          data: [<?php echo $nilai =join(",",$totalscore) ; ?>]
                      }]
				});

			});
           </script>
		</div>
	</div>	
	
	<div class="row">
		<div class="col-md-12">
		<script>
        $(document).ready( function () {
            $('#tabeldetail').DataTable({
                "bPaginate": true,
                "bLengthChange": false,
                "bFilter": true,
                "bInfo": false,
                "bAutoWidth": false
            });

        } );
    	</script>

			<div id="">
				<table id="tabeldetail" class="table table-hover table-condensed table-striped">
                            <thead>
                              <tr>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Website Update</th>
                                <th>Twitter Update</th>
                                <th>Facebook Update</th>
                                <th>Youtube Update</th>
                                <th>Nilai Kelengkapan</th>
                                <th>Total Nilai</th>
                                
                              </tr>
                            </thead>
                            <tbody>
                              <?php for ($i=0; $i <count($result_date) ; $i++) { ?>
                                <tr>
                                  <td><?php echo $result_date[$i]; ?></td>
                                  <td><?php $isaktif[$i];
                                            if ($isaktif[$i] == 1) {
                                              echo '<span class="glyphicon glyphicon-circle-arrow-up"></span>';
                                            } else{
                                              echo '<span class="glyphicon glyphicon-circle-arrow-down"></span>';
                                            };
                                   ?></td>
                                  <td><?php $isupdate[$i]; 
                                            if ($isupdate[$i] == 1) {
                                              echo '<span class="glyphicon glyphicon-ok-sign"></span>';
                                            } else {
                                              echo '<span class="glyphicon glyphicon-remove-sign"></span>';
                                            };
                                            
                                  ?></td>
                                  <td><?php if ($twitter[$i] == 1) {
                                              echo '<span class="glyphicon glyphicon-ok-sign"></span>';
                                            } else {
                                              echo '<span class="glyphicon glyphicon-remove-sign"></span>';
                                            }; ?></td>
                                  <td><?php if ($facebook[$i] == 1) {
                                              echo '<span class="glyphicon glyphicon-ok-sign"></span>';
                                            } else {
                                              echo '<span class="glyphicon glyphicon-remove-sign"></span>';
                                            }; ?></td>
                                  <td><?php if ($youtube[$i] == 1) {
                                              echo '<span class="glyphicon glyphicon-ok-sign"></span>';
                                            } else {
                                              echo '<span class="glyphicon glyphicon-remove-sign"></span>';
                                            }; ?></td>
                                  <td><?php echo $kelengkapan[$i]; ?></td> 
                                  <td><?php echo $totalscore[$i]; ?></td>
                                </tr>
                              <?php  } ?>
                            </tbody>
                          </table>


			</div>
		</div>
	</div>
</div>