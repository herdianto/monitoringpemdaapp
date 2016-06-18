
                        <?php
                        include 'connection.php';
                        
                        include 'templates/header.php';
	                      if($_SERVER["REQUEST_METHOD"] == "POST"){
	                    
	                        $myusername = mysqli_real_escape_string($conn,$_POST['username']);
	                        $mypassword = mysqli_real_escape_string($conn,$_POST['password']);
	                       
	                        

	                        $sql = "SELECT id , previlege FROM user WHERE username = '$myusername' and password = '$mypassword'";
	                        
	                        $result = mysqli_query($conn,$sql);
	                        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	                        

	                        $count = mysqli_num_rows($result);

	        

	                        if ($count == 1 ) {
	                          $_SESSION['login_user'] = $myusername;
	                          $_SESSION['previlege']  = $row['previlege'];
	                          $_SESSION['id']		  = $row['id'];

	                          if ($_SESSION['previlege']==1) {
	                          echo "<script type='text/javascript'>window.location.href = 'admin/index.php';</script>";	
	                          }else{
	                          echo "<script type='text/javascript'>window.location.href = 'index.php';</script>";	
	                          }
	                          
	                          exit();
	                        }else{
	                          $error = "Your Login Name or Password is Invalid";
	                        }
	                      }

                      ?>
                      <br>
                      <br>
                      <br>
                      <br>
    <div class="container">
        
       <form class="form-horizontal" action = "" method = "post">
       	
       	<legend>Log In</legend>
       	<div class="form-group">
          <label class="col-md-4 control-label" for="username">UserName </label>
        <div class="col-md-4">
        <input type = "text" name = "username" class="form-control input-md" placeholder="Username" required="">
        </div>
		</div>

		<div class="form-group">
		  <label class="col-md-4 control-label" for="password">Password</label>
		  <div class="col-md-4">
		    <input id="password" name="password" type="password" placeholder="Password" class="form-control input-md" required="">  
		  </div>
		</div>
          
        <div class="form-group">
		  <label class="col-md-4 control-label" for="singlebutton"></label>
		  <div class="col-md-4">
		    <button id="submit" name="submit" class="btn btn-primary">Log In</button>
		  </div>
		</div>
       </form>

       <div class="form-group">
		  <label class="col-md-4 control-label" for="password"><a href="sign_up.php">Register Here</a></label>
		</div>
       
       <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php if (isset($error)){echo $error;}; ?></div>
					
    </div>
		