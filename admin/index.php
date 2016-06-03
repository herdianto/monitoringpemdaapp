<?php include 'templates/header_admin.php'; ?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome Back Admin ! 
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
                                        <div class="huge">26</div>
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
                                        <div class="huge">12</div>
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
                        <div class="alert alert-info">
                          <strong>Info!</strong> Last Crawl on 12-06-2016 ! Click this button Below to start Crawling
                        </div>

                        <button class="btn btn-default orange-circle-button " href="">Start<br />Crawling!<br /><span class="orange-circle-greater-than"></span></button>
                        <p><br></p>
                    </div>   
                    
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
                    <button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Add User</button>                 
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
                    
                        <tr>
                          <td>1</td>
                          <td>aditmay</td>
                          <td>Aditya Mayapada</td>
                          <td>Bontang Kota</td>
                          <td>2016-05-30 00:27:58</td>
                          <td><a href="#"><span class="glyphicon glyphicon-edit" aria-hidden="true">  </span></a>
                          <a onclick="return confirm('Are you want deleting data')" href="#"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                          </td>
                        </tr>
                                    <tr>
                          <td>2</td>
                          <td>aditmay</td>
                          <td>Aditya Mayapada</td>
                          <td>Bontang Kota</td>
                          <td>2016-05-30 00:27:58</td>
                          <td><a href="#"><span class="glyphicon glyphicon-edit" aria-hidden="true">  </span></a>
                          <a onclick="return confirm('Are you want deleting data')" href="#"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                          </td>
                        </tr>
                                    <tr>
                          <td>3</td>
                          <td>aditmay</td>
                          <td>Aditya Mayapada</td>
                          <td>Bontang Kota</td>
                          <td>2016-05-30 00:27:58</td>
                          <td><a href="#"><span class="glyphicon glyphicon-edit" aria-hidden="true">  </span></a>
                          <a onclick="return confirm('Are you want deleting data')" href="#"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                          </td>
                        </tr>
                                    <tr>
                          <td>4</td>
                          <td>aditmay</td>
                          <td>Aditya Mayapada</td>
                          <td>Bontang Kota</td>
                          <td>2016-05-30 00:27:58</td>
                          <td><a href="#"><span class="glyphicon glyphicon-edit" aria-hidden="true">  </span></a>
                          <a onclick="return confirm('Are you want deleting data')" href="#"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                          </td>
                        </tr>
                                    <tr>
                          <td>5</td>
                          <td>aditmay</td>
                          <td>Aditya Mayapada</td>
                          <td>Bontang Kota</td>
                          <td>2016-05-30 00:27:58</td>
                          <td><a href="#"><span class="glyphicon glyphicon-edit" aria-hidden="true">  </span></a>
                          <a onclick="return confirm('Are you want deleting data')" href="#"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                          </td>
                        </tr>
                      
                        

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
                    
                        <tr>
                          <td>1</td>
                          <td>aditmay</td>
                          <td>KOTA BONTANG</td>
                          <td>http://bontangkota.go.id</td>
                          <td>http://kotabontang.go.id</td>
                          <td>2016-05-30 00:27:58</td>
                          <td><a href="#"><span class="glyphicon glyphicon-ok" aria-hidden="true">  </span></a>
                          <a href="#"><span class="glyphicon glyphicon-edit" aria-hidden="true">  </span></a>
                          <a onclick="return confirm('Are you want decline the request?')" href="#"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                          </td>
                        </tr>
                                    
                        

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
