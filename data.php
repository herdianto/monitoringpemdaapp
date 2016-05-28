<?php include 'templates/header.php'; ?>
<br>
<br>
<br>
 <?php 
    include 'connection.php';
      $sql = "SELECT result.id_pemda , pemda.nama_pemda,pemda.url , AVG(((((sejarah*0.1946+motto_daerah*0.1933+lambang*0.1983+lokasi*0.2122+visi_misi*0.2016)*0.1988+(pemerintahan_daerah*0.1946)+(geografi*0.2059)+(peraturan_daerah*0.2036)+(buku_tamu*0.1971))*0.2341+SEO_pagerank*0.2393+frekuensi_update*0.2636+frekuensi_aktif*0.2630)*0.5425+ ((facebook*0.5+fu_facebook*0.5)*0.4778+(twitter*0.5+fu_twitter*0.5)*0.3667+(youtube*0.5+fu_youtube*0.5)*0.1556)*0.4575)) AS totalscore
              FROM pemda INNER JOIN result
              ON result.id_pemda = pemda.id_pemda
              GROUP BY id_pemda
              ORDER BY totalscore DESC
              LIMIT 530
              ";
      $result = $conn->query($sql);

      while ($row = $result->fetch_assoc()) {
          $id_pemda[]       = $row["id_pemda"];
          $nama_pemda[]     = $row["nama_pemda"];
          $totalscore[]     = $row["totalscore"];
          $url[]            = $row["url"];
      }
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
                                <div class="list-group">
                                <span href="#" class="list-group-item active">
                                    Submenu
                                    <span class="pull-right" id="slide-submenu">
                                        <i class="fa fa-times"></i>
                                    </span>
                                </span>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-comment-o"></i> Nilai Website Pemda
                                </a>
                                <a href="#" class="list-group-item"> Pemda yang Belum Memiliki Website
                                    <i class="fa fa-search"></i> 
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-user"></i> Website Pemda Terbaru
                                </a>
                                </div>

            <div class="panel panel-default">
                <div class="panel-heading">Menambahkan Website Pemda</div>
                <div class="panel-body">
                    <form action="" role="input">
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" class="form-control" placeholder="Masukkan Nama Pemda">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" class="form-control" placeholder="Masukkan URL Pemda">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-2">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div>
                        </form>
                  </div>
                    
              </div>
          </div>    
        
        <div class="col-md-9">
            <div class="table-responsive">
                        <table id="tabeldata" class="table table-hover table-condensed table-striped">
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

                              <?php for ($i=0; $i <530 ; $i++) { ?>
                                <tr>

                                  <td><?php echo $id_pemda[$i]; ?></td>
                                  <td><?php echo $nama_pemda[$i]; ?></td>
                                  <td><?php echo $url[$i]; ?></td>
                                  <td><?php echo $totalscore[$i]; ?></td>
                                  <td><a href="detail.php?id_pemda=<?php echo $id_pemda[$i]; ?>" >Click Here</td>
                                </tr>
                              <?php  } ?>
                            </tbody>
                          </table>
                            <style type="text/css">
/*                            table{
                                table-layout: fixed;
                                width: 100%;
                            }*/
                            </style>
                          <script>
                            $(document).ready( function () {
                                $('#tabeldata').DataTable({
                                    "bPaginate": true,
                                    "bLengthChange": false,
                                    "bFilter": true,
                                    "bInfo": false,
                                    "bAutoWidth": false
                                });

                            } );
                          </script>
            </div>
        </div>
      </div>

        
    </div>
        
</div>