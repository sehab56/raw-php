<?php include 'inc/header.php'; ?>
<?php
	if (isset($_GET['delwish'])) {
		$delwish = $_GET['delwish'];

		$delWishList = $wl->delsinglewish($delwish,$customerId);
	}
?>
<div class="main">
<div class="content">
<div class="cartoption">		
	<div class="cartpage">
			<h2>Your WishList</h2>
				<table class="tblone">
					<tr>
						<th width="5%">Id</th>
						<th width="5%">Product Id.</th>
						<th width="40%">Product Name</th>
						<th width="10%">Price</th>
						<th width="10%">Image</th>
						<th width="30%">Action</th>
					</tr>
<?php 
	
	$getall = $wl->getallWish($customerId);
	if ($getall  == true) {
		$i = 0;
		while ($result = $getall->fetch_assoc()) {
			$i++;
?>

					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $result['productId']; ?></td>
						<td><?php echo $result['productName']; ?></td>
						<td><img src="admin/<?php echo $result['image']; ?>" alt=""/></td>
						<td>Tk.<?php echo $result['price']; ?></td>
						
						<td>
							<a href="preview.php?proid=<?php echo $result['productId']  ?>" 
			    			 class="details">Details</a>||
			     			<a href="?delwish=<?php echo $result['productId']  ?>" 
			     			class="details">Remove</a>
			     		</td>
					</tr>
<?php } }else{
	header("Location:index.php");
	}  ?>
				
				</table>		
			</div>
			<div class="shopping">
				<div class="shopleft">
					<a href="index.php"> <img src="images/shop.png" alt="" /></a>
				</div>

			</div>
</div>  	
<div class="clear"></div>
</div>
 </div>
</div>


<?php include 'inc/footer.php'; ?>

