<?php include 'templates/header_admin.php'; ?>
        <div id="page-wrapper">

        <?php include 'connection.php'; 
        session_start();
        if ($_SESSION['previlege']!=1) {
          header("Location:../index.php");
        }

        $sql = "SELECT user.username, user.nama_lengkap,pemda.nama_pemda,user.timestamp
                FROM user join pemda on user.asal_daerah = pemda.id_pemda where previlege=2
                ";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
        $nama_user[]       = $row["username"];
        $nama_lengkap[]       = $row["nama_lengkap"];
        $asal_daerah[]     = $row["nama_pemda"];
        $waktu_daftar[]      = $row["timestamp"];
        }
        if (isset($nama_user)) {
          $count = count($nama_user);  
        } else{
          $count = 0;
        }
        
                  
        $sql = "SELECT addpemda.id, user.username,pemda.nama_pemda,pemda.url,addpemda.new_pemda,addpemda.timestamp 
                          FROM addpemda join pemda 
                          ON addpemda.id_pemda = pemda.id_pemda join user 
                          ON addpemda.id_user = user.id 

                          ";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
        $id[]             = $row["id"];
        $user_name[]       = $row["username"];
        $nama_pemda[]     = $row["nama_pemda"];
        $url[]            = $row["url"];
        $new_pemda[]      = $row["new_pemda"];
        $timestamp[]      = $row["timestamp"];
        }
        
        if (isset($user_name)) {
          $jmlreq = count($user_name);
        }else{
          $jmlreq = 0;
        }          

        $sql = "SELECT max(date) AS tanggal_terakhir, CURRENT_DATE() as tanggal_sekarang FROM result";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        ?>
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome Back, Admin ! 
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Summary
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                
              
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-users fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $count; ?></div>
                                        <div>Total User Terdaftar</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-send fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $jmlreq; ?></div>
                                        <div>Request Url Pemda Baru</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-newspaper-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">12</div>
                                        <div>Website Pemda Baru</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                <!-- /.row -->
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-globe"></i> Crawling
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                    <?php if ($row['tanggal_terakhir']==$row['tanggal_sekarang']){ ?>
                      <div class="alert alert-info">
                          <strong>Info!</strong> Last Crawl on <?php echo $row['tanggal_terakhir']; ?> ! Click this button Below to start Crawling
                        </div>

                        <a href="" onclick="alert('Anda sudah melakukan Crawling hari ini')"><span class="btn btn-default orange-circle-button"><span class="orange-circle-greater-than">Start<br />Crawling!<br /></span></span></a>
                        <p><br></p>
                    </div>   
                    <?php } else{ ?>
                        <div class="alert alert-info">
                          <strong>Info!</strong> Last Crawl on <?php echo $row['tanggal_terakhir']; ?> ! Click this button Below to start Crawling
                        </div>

                        <a href="crawl.php" onclick="window.open(this.href); return false;" onkeypress="window.open(this.href); return false;"><span class="btn btn-default orange-circle-button"><span class="orange-circle-greater-than">Start<br />Crawling!<br /></span></span></a>
                        <p><br></p>
                    </div>   
                    <?php } ?>
                    
                </div>  <!-- end of row button-->
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-globe"></i> Daftar User
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-12">
                  
                  <table id="tableuser" class="table table-hover table-condensed table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Nama User</th>
                        <th>Asal Daerah</th>
                        <th>Tanggal Daftar</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                    for ($i=0; $i < $count ; $i++) { ?>
                      <tr>
                          <td><?php echo $i+1; ?></td>
                          <td><?php echo $nama_user[$i]; ?></td>
                          <td><?php echo $nama_lengkap[$i]; ?></td>
                          <td><?php echo $asal_daerah[$i]; ?></td>
                          <td><?php echo $waktu_daftar[$i]; ?></td>
                          <td>
                          <a onclick="return confirm('Are you want decline the request?')" href="crud/delete_user.php?nama_user=<?php echo $nama_user[$i]; ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"> </span></a>
                          
                          </td>
                        </tr>
                    <?php } ?>
                        
                                    
                    </tbody>
                  </table>
                </div>
                 
                <!-- end of table div USER-->
               </div> 
               <!-- end of row div USER -->
               <div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-table"></i> Daftar Request User
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-12">
                <?php 
                  

                          // $result = mysqli_query($conn,$sql);
                          // $row[] = mysqli_fetch_array($result,MYSQLI_ASSOC);

                 ?>
                  <table id="tablerequest" class="table table-hover table-condensed table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Nama Pemda</th>
                        <th>Url Lama</th>
                        <th>Url Baru</th>
                        <th>Waktu Request</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                    for ($i=0; $i < $jmlreq ; $i++) { ?>
                      <tr>
                          <td><?php echo $id[$i]; ?></td>
                          <td><?php echo $user_name[$i]; ?></td>
                          <td><?php echo $nama_pemda[$i]; ?></td>
                          <td><?php echo $url[$i]; ?></td>
                          <td><?php echo $new_pemda[$i]; ?></td>
                          <td><?php echo $timestamp[$i]; ?></td>
                          <td>
                          
                          <a href="crud/validate.php?id_request=<?php echo $id[$i]; ?>&nama_pemda=<?php echo $nama_pemda[$i]; ?>&url_baru=<?php echo $new_pemda[$i]; ?>"><span class="glyphicon glyphicon-ok" aria-hidden="true"> </span></a>
                          <a onclick="return confirm('Are you want decline the request?')" href="crud/delete.php?id_request=<?php echo $id[$i]; ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"> </span></a>
                          
                          
                          </td>
                        </tr>
                    <?php }

                     ?>
                        
                                    
                        

                    </tbody>
                  </table>
                </div>
                <!-- end of table div -->
               </div> 
               <!-- end of row div -->


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->


</body>

</html>
