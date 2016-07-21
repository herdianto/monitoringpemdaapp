<?php include '../connection.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Verifikasi</title>
</head>
<body>
<?php if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
    
    $email = mysql_escape_string($_GET['email']);
    $hash = mysql_escape_string($_GET['hash']);
    $search = mysqli_query($conn,"SELECT email, hash,status FROM user WHERE email='".$email."' AND hash='".$hash."' AND status='0'") or die(mysql_error()); 
    $match  = mysqli_num_rows($search);

    if($match > 0){
        // We have a match, activate the account
        mysqli_query($conn,"UPDATE user SET status='1' WHERE email='".$email."' AND hash='".$hash."' AND status='0'") or die(mysql_error());
        echo '<div class="statusmsg">Your account has been activated, you can now login</div>';
    }else{
        // No match -> invalid url or account has already been activated.
        echo '<div class="statusmsg">The url is either invalid or you already have activated your account.</div>';
    }
}else{
    echo '<div class="statusmsg">Invalid approach, please use the link that has been send to your email.</div>';
} ?>
</body>
</html>