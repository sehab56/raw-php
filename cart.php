<?php include 'inc/header.php'; ?>
<?php
	if (Session::get("getcatall") == false) {
		header("Location:index.php");
	}
?>

<?php
	if (isset($_GET['delcart'])) {
		$delcart = $_GET['delcart'];

		
		$delelter = $ct->delCart($delcart);
		
	}


?>
<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$quantity = $_POST['quantity'];
		$cartId = $_POST['cartId'];

		if ($quantity <= 0) {
			$delelter = $ct->delCart($cartId);
		}else{
			$updateQuery = $ct->UpdateQuantity($quantity,$cartId);
		}
	}

?>

 <div class="main">
<div class="content">
<div class="cartoption">		
	<div class="cartpage">

	    	<h2>Your Cart</h2>
				<table class="tblone">
					<tr>
						<th width="5%">Id</th>
						<th width="30%">Product Name</th>
						<th width="20%">Image</th>
						<th width="10%">Price</th>
						<th width="20%">Quantity</th>
						<th width="10%">Total Price</th>
						<th width="5%">Action</th>
					</tr>
<?php 
	$sum = 0;
	$product = 0;
	$getall = $ct->getallcat();
	Session::set("getcatall",$getall);
	if ($getall) {
		$i = 0;
		while ($result = $getall->fetch_assoc()) {
			$i++;
?>

					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $result['productName']; ?></td>
						<td><img src="admin/<?php echo $result['image']; ?>" alt=""/></td>
						<td>Tk.<?php echo $result['price']; ?></td>
						<td>

	<form action="" method="post">
		<input type="hidden" name="cartId" value="<?php echo $result['cartId']; ?>"/>
		<input type="number" name="quantity" value="<?php echo $result['quantity']; ?>"/>
		<input type="submit" name="submit" value="Update"/>
	</form>
<?php
	$product = $product + $result['quantity'] ;

?>

						</td>
						<td>$<?php $allprice = $result['quantity'] * $result['price'];
							echo $allprice; 
						?></td>
						<td><a onclick="return confirm('Are u sure to Delete')"
							href="?delcart=<?php echo $result['cartId']; ?>">X</a></td>
					</tr>
<?php $sum = $sum + $allprice; } }  ?>
				
				</table>		

			
<?php if ($getall) { ?>
		<table style="float:right;text-align:left;" width="40%">
					<tr>
						<th>Sub Total : </th>
						<td>$<?php echo $sum;?></td>
					</tr>
					<tr>
						<th>VAT : 	10% 	:</th>
						<td>$<?php echo $vat = $sum * 0.10 ;?></td>
					</tr>
					<tr>
						<th>Grand Total :</th>
						<td>$<?php echo $total = $sum + $vat;
								Session::set("total",$total);
								Session::set("product",$product);
								?></td>
					</tr>
		   	</table>
<?php } ?>

			
		</div>
		<?php	

if(isset($delelter)){
	 echo $delelter;
}
if(isset($updateQuery)){
	 echo $updateQuery;
		
}	?>	
			<div class="shopping">
				<div class="shopleft">
					<a href="index.php"> <img src="images/shop.png" alt="" /></a>
				</div>

				<div class="shopright">
				<?php
					$customerLOgin = Session::get("customerLOgin");
					if ($customerLOgin != true) { ?>
						<a href="login.php"> <img src="images/check.png" alt="" /></a>
			<?php		}else{	?>
					<a href="payment.php"> <img src="images/check.png" alt="" /></a>
				<?php } ?>
				</div>

			</div>
</div>  	
<div class="clear"></div>
</div>
 </div>
</div>


<?php include 'inc/footer.php'; ?>

