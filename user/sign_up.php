<?php include'../templates/header.php'; ?>
<br>
<br>
<br>

<div class="container">

<form class="form-horizontal">
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
    <button id="singlebutton" name="singlebutton" class="btn btn-primary">Register</button>
  </div>
</div>

</fieldset>
</form>
</div>