<!DOCTYPE html>
<html>
  <head>
    <title>Monitoring Web Pemda App</title>


    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
     
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>


  </head>
  <body>


  <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
         <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
      </button> <a class="navbar-brand" href="#">Monitoring Web Pemda App</a>
    </div>
  </nav>


  <div class="container-fluid">
      <br>
      <br>

      <div class="row">
        <div class="col-md-4">
          <h3>Daily Stats</h3>
          <hr>
          <h4>Total Website Terdaftar</h4>
          <h4>Total Website Aktif</h4>
          <h4>Total Website Update</h4>
          <h4>Rataan Kelengkapan Website</h4>
          <h4>Total Website</h4>
        </div>
          
        <div class="col-md-8">
             <?php 
              require_once 'lib/simple_html_dom.php';
              include 'connection.php';
              include 'function.php';
              $sql = "SELECT tes.id_pemda, tes.totalscore , pemda.nama_pemda FROM tes INNER JOIN pemda ON tes.id_pemda=pemda.id_pemda;";
              $result = $conn->query($sql);

              while ($row = $result->fetch_assoc()) {
                  $id_pemda[]       = $row["id_pemda"];
                  $nama_pemda[]     = $row["nama_pemda"];
                  $totalscore[]     = $row["totalscore"];

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
                          categories: [<?php echo $nama ="'".join("','",$nama_pemda)."'";?>]
                      },
                      yAxis: {
                          title: {
                              text: 'Total Skor'
                          }
                      },
                      series: [{
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
                          categories: [<?php echo $nama ="'".join("','",$nama_pemda)."'";?>]
                      },
                      yAxis: {
                          title: {
                              text: 'Total Skor'
                          }
                      },
                      series: [{
                          data: [<?php echo $nilai =join(",",$totalscore) ; ?>]
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
                          categories: [<?php echo $nama ="'".join("','",$nama_pemda)."'";?>]
                      },
                      yAxis: {
                          title: {
                              text: 'Total Skor'
                          }
                      },
                      series: [{
                          data: [<?php echo $nilai =join(",",$totalscore) ; ?>]
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
                          categories: [<?php echo $nama ="'".join("','",$nama_pemda)."'";?>]
                      },
                      yAxis: {
                          title: {
                              text: 'Total Skor'
                          }
                      },
                      series: [{
                          data: [<?php echo $nilai =join(",",$totalscore) ; ?>]
                      }]
                })

              });
              </script>
          <h3 class="text-center">10 Website Pemda Terbaik Pada Bulan Maret </h3>
          <hr>
          <div id="webpemdaterbaik" style="height: 400px"></div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <h5 class="text-center">Web Pemda terbaik berdasarkan Provinsi</h5>
          <div id="webpemdaprov" style="height: 250px"></div>
        </div>
        <div class="col-md-4">
          <h5 class="text-center">Web Pemda terbaik berdasarkan Kabupaten</h5>
          <div id="webpemdakab" style="height: 250px"></div>
        </div>
        <div class="col-md-4">
          <h5 class="text-center">Web Pemda terbaik berdasarkan Kota</h5>
          <div id="webpemdakota" style="height: 250px"></div>
        </div>
      </div>
  <div class="row">
    <div class="col-md-12">
      <table class="table table-hover table-condensed table-striped">
        <thead>
          <tr>
            <th>
              #
            </th>
            <th>
              Nama Pemda
            </th>
            <th>
              Link URL
            </th>
            <th>
              Total Skor
            </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              1
            </td>
            <td>
              PROVINSI NAD
            </td>
            <td>
              http://www.acehprov.go.id/
            </td>
            <td>
              93.2
            </td>
          </tr>
          <tr>
            <td>
              2
            </td>
            <td>
              KAB. ACEH SELATAN
            </td>
            <td>
              http://www.acehselatankab.go.id/
            </td>
            <td>
              80
            </td>
          </tr>
          <tr>
            <td>
              3
            </td>
            <td>
              KAB. ACEH TENGGARA
            </td>
            <td>
              http://www.acehtenggarakab.go.id/
            </td>
            <td>
              56.6
            </td>
          </tr>
          <tr>
            <td>
              
            </td>
            <td>
              
            </td>
            <td>
              
            </td>
            <td>
              
            </td>
          </tr>
          <tr>
            <td>
             
            </td>
            <td>
             
            </td>
            <td>
             
            </td>
            <td>
             
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
       
      <address>
         <strong>Aditya Mayapada</strong><br>Information System Department<br> Sepuluh Nopember Institut of Technology <br>Surabaya, Indonesia<br> <abbr title="Phone">P:</abbr> +62 852 4668 0093
      </address>
    </div>
    <!-- <div class="col-md-4">
       
      <address>
         <strong>Twitter, Inc.</strong><br> 795 Folsom Ave, Suite 600<br> San Francisco, CA 94107<br> <abbr title="Phone">P:</abbr> (123) 456-7890
      </address>
    </div>
    <div class="col-md-4">
       
      <address>
         <strong>Twitter, Inc.</strong><br> 795 Folsom Ave, Suite 600<br> San Francisco, CA 94107<br> <abbr title="Phone">P:</abbr> (123) 456-7890
      </address>
    </div> -->
  </div>
</div>

  <!-- <script src="js/jquery.min.js"></script>
       <script src="js/bootstrap.min.js"></script>
       <script src="js/scripts.js"></script>
  -->
       
  </body>
</html>