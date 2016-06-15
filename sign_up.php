<?php include'templates/header.php'; ?>
<br>
<br>
<br>

<div class="container">

<form class="form-horizontal" method="post" action="">
<fieldset>

<!-- Form Name -->
<legend>Sign Up</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="username">Username</label>  
  <div class="col-md-4">
  <input id="username" name="username" type="text" placeholder="Username" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="password">Password</label>
  <div class="col-md-4">
    <input id="password" name="password" type="password" placeholder="Password" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="namalengkap">Nama Lengkap</label>  
  <div class="col-md-4">
  <input id="namalengkap" name="namalengkap" type="text" placeholder="Nama Lengkap" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Search input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="asaldaerah">Asal Daerah</label>
  <div class="col-md-4">
    <input id="asaldaerah" name="asaldaerah" type="search" placeholder="Asal Daerah" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button id="submit" name="submit" class="btn btn-primary">Register</button>
  </div>
</div>

</fieldset>
</form>
      <?php include 'connection.php'; 
    
    if (isset($_POST['submit'])) {
    $sql = "SELECT username FROM user WHERE username = '".$_POST['username']."' or die(mysql_error())";
    $result = $conn->query($sql);
            $namalengkap  = $_POST['namalengkap'];
            $username   = $_POST['username'];
            $password   = $_POST['password'];
            $asaldaerah   = $_POST['asaldaerah'];
            $sql = "INSERT INTO user(previlege,username,password,nama_lengkap,asal_daerah) VALUES (2,'$username','$password','$namalengkap','$asaldaerah');";
            $result = $conn->query($sql);
            var_dump($sql);
           
    }    
    



      ?>
</div>