
                        <?php
                        include 'connection.php';
                        session_start(); 
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
                        <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php if (isset($error)){echo $error;}; ?></div>
					
            </div>
				
         </div>
			
      </div>