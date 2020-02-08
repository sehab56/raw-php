
<?php
  //set headers to NOT cache a page
  header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1
  header("Pragma: no-cache"); //HTTP 1.0
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  // Date in the past
  //or, if you DO want a file to cache, use:
  header("Cache-Control: max-age=2592000"); 
//30days (60sec * 60min * 24hours * 30days)
?>


<?php
// this for session destroy 
include 'lib/Session.php';
 Session::init();

?>
<?php 
	include_once'lib/Database.php';
	include_once'helpers/format.php';

	spl_autoload_register(function($class){
		include_once "classes/".$class.".php";
	});

	$db = new Database();
	$fm = new format();
	$pd = new Product();
	$bd = new Brand();
	$cat = new Catagory();
	$ct = new Cart();
	$cus = new Customer();
	$cp = new Compare();
	$wl = new WishList();
	$cn = new Contact();


?>


<!DOCTYPE HTML>
<head>
<title>Store Website</title>
<?php include 'scripts/css.php'; ?>
<?php include 'scripts/js.php'; ?>
</head>
<body>
  <div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img width="230px" height="100px" src="images/logo.png" alt="" /></a>
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
				    <form>
				    	<input type="text" value="Search for Products" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search for Products';}"><input type="submit" value="SEARCH">
				    </form>
			    </div>
			    <div class="shopping_cart">
					<div class="cart">
						<a href="#" title="View my shopping cart" rel="nofollow">
								<span class="cart_title">Cart</span>
								<span class="no_product">
									<?php 
									$getData = $ct->getCheck();
									if ($getData) {
										$total = Session::get("total");
										$product = Session::get("product");
										echo "($".$total.")".$product;
									}else{?>(empty)			
									<?php } ?>
								</span>
							</a>
						</div>
			      </div>
<?php
	if (isset($_GET['logout'])) {
		$customerId = Session::get("customerId");
		$deldata = $ct->delCustomerCart();
		$delCompare = $cp->dellallforId($customerId);


		Session::destroy();
	
	}
?>		   <div class="login">
		   <?php
		   		$customerLOgin = Session::get("customerLOgin"); 
		   		if ($customerLOgin == false) { ?>
		   		<a href="login.php">login</a>

		  <?php  }else{ ?>
		   		<a href="?logout=<?php echo Session::get("customerId");?>">logout</a>
		   		<?php  } ?>
		   	</div>
		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>
<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li><a href="index.php">Home</a></li>
	  <li><a href="products.php">Products</a> </li>
<?php
	$getall = $ct->getallcat();
	if ($getall == true) {  ?>
		<li><a href="cart.php">Cart</a></li>
<?php	}  ?>
<?php
	if ($getall == true && $customerLOgin == true) {  ?>
		<li><a href="payment.php">Payment</a></li>
<?php	}  ?>	  
<?php  ?>	
	  <?php if ($customerLOgin == true) { ?>
	  		<li><a href="profile.php">Profile</a> </li>
<?php	}  ?>
<?php
	$customerId = Session::get("customerId");
	$getall = $ct->getallOrder($customerId);
	if ($getall == true) {  ?>
		<li><a href="orderList.php">Order</a></li>
<?php	}  ?>
<?php 
	$getall = $cp->getallCompare($customerId);
	if ($customerLOgin == true && $getall == true) {
 ?>	  
	  <li><a href="compare.php">Compare</a> </li>
<?php } ?>
<?php 
	$getallWish = $wl->getallWish($customerId);
	if ($customerLOgin == true && $getallWish == true) {
 ?>
	<li><a href="wishList.php">WishList</a> </li>
<?php } ?>
	  <li><a href="contact.php">Contact</a> </li>
	  <div class="clear"></div>
	</ul>
</div>


