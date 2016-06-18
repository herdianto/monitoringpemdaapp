<!DOCTYPE html>
<html>
  <head>
    <title>Monitoring Web Pemda App</title>


    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css"/>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.min.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>
    <link href="css/style.css" rel="stylesheet">

  </head>
  <body>


<div id="custom-bootstrap-menu" class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header"><a class="navbar-brand" href="#">Monitoring Web Pemda App</a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse navbar-menubuilder">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/monitoringpemdaapp/index.php">Home</a>
                </li>
                <li><a href="/monitoringpemdaapp/data.php">Data</a>
                </li>
                <li><a href="">About Us</a>
                </li>
                <?php 
                include 'connection.php';
                session_start();
                
                if (isset($_SESSION['login_user'])) {
                  ?><li>
                  <a href="logout.php">Log Out</a>
                  
                  </li> <?php  
                } else{
                ?>   
                  <li>
                  <a href="login.php">Login</a>
                  
                  </li> <?php
                } ;
                ?>
            </ul>
        </div>
    </div>
</div>