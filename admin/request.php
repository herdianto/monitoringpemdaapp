<?php include 'templates/header_admin.php'; ?>
<div class="container-fluid">
	  <div class="row">
        <div class="col-lg-12">
                <h1 class="page-header">
                    Halaman Request
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-table"></i> Daftar Request Update Pemda
                    </li>
                </ol>
        </div>
    </div>
	<div class="row">
    <div class="col-md-12">
      <table id="maintable" class="table table-hover table-condensed table-striped">
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
              <td><a href="#"><span class="glyphicon glyphicon-pencil" aria-hidden="true">  </span></a>
              <a onclick="return confirm('Are you want deleting data')" href="#"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
              </td>
            </tr>
                        
            

        </tbody>
      </table>
    </div>
    <!-- end of table div -->
   </div> 
   <!-- end of row div -->