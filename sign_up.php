<?php include'templates/header.php'; 
require("lib/PHPMailerAutoload.php");?>
<br>
<br>
<br>

<div class="container">

<form class="form-horizontal" method="post" action="">
<fieldset>

<!-- Form Name -->
<legend>Sign Up</legend>
<?php 
if (isset($_POST['submit'])) {
    $sql = "SELECT username FROM user WHERE username = '".$_POST['username']."' or die(mysql_error())";
    $result = $conn->query($sql);
            $namalengkap  = $_POST['namalengkap'];
            $username   = $_POST['username'];
            $password   = $_POST['password'];
            $asaldaerah   = $_POST['asaldaerah'];
            $email        = $_POST['email'];
            $hash = md5( rand(0,1000) );
            $sql = "INSERT INTO user(username,password,nama_lengkap,email,asal_daerah,hash) VALUES ('$username','$password','$namalengkap','$email','$asaldaerah','$hash');";
            $result = $conn->query($sql);
            $msg = '<strong>Akun anda berhasil dibuat!</strong>, silakan lakukan verifikasi dengan klik link aktivasi pada email anda!.';
            
            $to      = $email; // Send email to our user
            $subject = 'Verifikasi Pendaftaran E-GovBench'; // Give the email a subject 
            $message = '
             
            Terimakasih telah mendaftar!<br>
            Akun anda telah berhasil dibuat, Anda dapat login dengan menggunakan data berikut setelah melakukan aktivasi dengan klik link dibawah.<br><br>
             
            ------------------------<br>
            Username: '.$username.' <br>
            Password: '.$password.' <br>
            ------------------------<br><br>
             
            Silakan klik untuk aktivasi akuna anda:<br>
            <a href="localhost/monitoringpemdaapp/verify.php?email='.$email.'&hash='.$hash.'">localhost/monitoringpemdaapp/verify.php?email='.$email.'&hash='.$hash.'</a>
             
            '; // Our message above including the link
                                 
            #php mailer start
            
            $mail = new PHPMailer();

            // set mailer to use SMTP
            $mail->IsSMTP();

            // As this email.php script lives on the same server as our email server
            // we are setting the HOST to localhost
            $mail->Host = 'smtp.gmail.com';  // specify main and backup server

            $mail->SMTPAuth = true;     // turn on SMTP authentication

            // When sending email using PHPMailer, you need to send from a valid email address
            // In this case, we setup a test email account with the following credentials:
            // email: send_from_PHPMailer@bradm.inmotiontesting.com
            // pass: password
            $mail->Username = "aditya.mayapada12@mhs.is.its.ac.id";  // SMTP username
            $mail->Password = "aditadit"; // SMTP password

            // $email is the user's email address the specified
            // on our contact us page. We set this variable at
            // the top of this page with:
            // $email = $_REQUEST['email'] ;
            $mail->setFrom('noreply@egovbench.its.ac.id', 'EGOV Bench');
            $mail->From = $email;

            // below we want to set the email address we will be sending our email to.
            $mail->AddAddress($email);

            // set word wrap to 50 characters
            $mail->WordWrap = 50;
            // set email format to HTML
            $mail->IsHTML(true);

            $mail->Subject = $subject;

            // $message is the user's message they typed in
            // on our contact us page. We set this variable at
            // the top of this page with:
            // $message = $_REQUEST['message'] ;
            $mail->Body    = $message;


            if(!$mail->Send())
            {
               echo "Message could not be sent. <p>";
               echo "Mailer Error: " . $mail->ErrorInfo;
               exit;
            }

            echo "Message has been sent";

            #php mailer end
                }    
 ?>
<!-- Text input-->
<?php if (isset($msg)) {
  ?>
  <div class="alert alert-success">
  <?php echo $msg ?>
  </div>
<?php } ?>
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
<!-- email input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="email">Email</label>
  <div class="col-md-4">
    <input id="email" name="email" type="text" placeholder="Email" class="form-control input-md" required="">
    
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
    <select id="search_web" name="asaldaerah" class="form-control" placeholder="Masukkan Nama Pemda"></select>
    
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
    
    
    



      ?>
</div>