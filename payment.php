<?php include 'inc/header.php'; ?>
<?php
	$login = Session::get("customerLOgin");
	if ($login == false) {
		header("Location:login.php");
	}

?>
<style type="text/css">
	.payment{width:500px;min-height: 200px;text-align: center;border: 1px solid #ddd;margin:0 auto;
		padding: 50px;}
	.payment h2{border-bottom: 1px solid #ddd;margin-bottom: 40px; padding-bottom: 10px;}
	.payment a{background:#3A393E; border: 3px; color: #fff;font-size: 25px;padding: 5px 30px;
	}
	.payment a:hover{background: #643091;}
	.back a{width: 160px; margin: 5px auto 0;padding: 7px;text-align: center;display: block;background: #555;border:1px; color: #fff;border-radius: 3px;
	}

</style>
 <div class="main">
<div class="content">
<div class="cartoption">		
<div class="payment">
	<h2>Choose Payment Option</h2>
	<a href="paymentOffline.php">Offline Payment</a>			
	<a href="online.php">Online Payment</a>			
</div>
	<div class="back">
		<a href="cart.php">Previous</a>
	</div>
</div>
</div>
<?php include 'inc/footer.php'; ?>

