<?php include '../classes/AdminLogin.php';  ?>
<?php 
	$admin = new AdminLogin();
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$adminuser = ($_POST['username']);
		$adminpass = (md5($_POST['password']));

		$matchadmin = $admin->adminlogin($adminuser,$adminpass);
	}

  ?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
	
		<form action="login.php" method="post">
			<h1>Admin Login</h1>
	<?php
		if (isset($matchadmin)) {
			echo $matchadmin;
		}
	?>
			<div>
				<input type="text" placeholder="Username" required="" name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required="" name="password"/>
			</div>
			
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="forgetpass.php">Forget Password</a>
		</div>
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>