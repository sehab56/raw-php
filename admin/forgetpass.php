<?php 
	include '../lib/Session.php';
	
	Session::checklogin();

?>

<?php
	$db = new Database();
	$fm = new format();
?>


<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Password Recovery</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$email = $fm->validation($_POST['email']);
	$email = mysqli_real_escape_string($db->link, $email);
	if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
	echo "<span style='color:red; font-size:15px;'>This email is not valid: </span>".$email; 
	 }else{
		$mailquery = "SELECT * FROM tbl_user WHERE email = '$email' limit 1 ";
	    $mailcheck = $db->select($mailquery);
	    if ($mailcheck != false ) {
       	 	while ($value = $mailcheck->fatch_assoc()) {
       	 		$userid = $value['id'];
       	 		$username = $value['username'];
       	 	}
       	 	$text = substr($email,0,3);
       	 	$rand = rand(10000, 99999);
       	 	$newpass = "$text$rand";
       	 	$password = md5($newpass);
       	 	$updatequery = "UPDATE tbl_user SET password = '$password' WHERE id = '$userid' ";
       	 	$updaterow = $db->update($updatequery);

       	 	$to = "$email";
       	 	$from  = 'momin1998.m@gmail.com';
       	 	$headers = "From: $from\n";
       	 	$headers .= 'MIME-Version: 1.0' . "\r\n";
       	 	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
       	 	$subject = "Your Password";
       	 	$message = "Your Username is ".$username."and Password is ".$newpass."Plz Vist Our website to login";

       	 	$sendmail = mail($to, $subject, $message,$headers);
       	 	if ($sendmail) {
       	 		echo "<span style='color:green; font-size:15px;'> Plz check Your Email Address</span>";
       	 	}else{
       	 		echo "<span style='color:red; font-size:15px;'> Somethig Problem</span>";
       	 	}

    	}
		
	
		else{
			echo "<span style='color:red; font-size:15px;'> Email Not Exits</span>";
		}
	}
}

?>

		<form action="" method="post">
			<h1>Password Recovery</h1>
			<div>
				<input type="text" placeholder="Enter Valid email" required name="email"/>
			</div>
			<div>
				<input type="submit" value="Send Email" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="login.php">Login !</a>
		</div>
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>