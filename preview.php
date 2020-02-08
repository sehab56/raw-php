<?php include 'inc/header.php'; ?>
<?php
    if (isset($_GET['proid'])) {
    	$proid = $_GET['proid'];
    }
     
?> 
<?php 
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
        $quantity = $_POST['quantity'];

	     if ($quantity >= 1) {
	     	$addCart = $ct->addtoCart($quantity,$proid);
	     }else{
	     	$addCart = "Vai fazlami Koren";
	     } 
    }
  ?>
<?php
	if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['compare'])) {
        $compare = $_POST['productId'];

        $customerId = Session::get("customerId");

        $addCompare = $cp->addCompare($compare,$customerId);
        
	    
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['wishlist'])) {
        $compare = $_POST['productId'];

        $customerId = Session::get("customerId");

        $addwish = $wl->addwishList($compare,$customerId);
        
	    
    }
	
?>
 <div class="main">
    <div class="content">
    	<div class="section group">
    	<?php
    		$rwefsdf = $pd->getONeproduct($proid);
    		if (isset($rwefsdf)) {
    			while ($result = $rwefsdf->fetch_assoc()) {
    	?>
		<div class="cont-desc span_1_of_2">				
					<div class="grid images_3_of_2">
						<img src="admin/<?php echo $result['image'];?>" height="222px"width="222px" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result['productName'];?></h2>					
					<div class="price">
						<p>Price: <span>$<?php echo $result['price'];?></span></p>
						<p>Category: <span><?php echo $result['name']; ?></span></p>
						<p>Brand: <span><?php echo $result['brandname']; ?></span></p>
					</div>
			<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" name="quantity" value="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
					</form>					
			</div>
			<?php if ($customerId == true) {?>
			<div class="add-cart">
				<form action="" method="post">
					<input type="hidden"  name="productId" 
					value="<?php echo $result['productId'];?>"/>
					<input type="submit" class="buysubmit" name="compare" value="Add Compare"/>
					
					<input type="submit" class="buysubmit" name="wishlist" value="Add Wish List"/>
				</form>
			</div>
			<?php } ?>
			<?php
				if (isset($addCart)) {
					echo "	<span style='color:green'>$addCart</span>";
				}
				if (isset($addCompare)) {
					echo "	<span style='color:green'>$addCompare</span>";
				}
				if (isset($addwish)) {
					echo "	<span style='color:green'>$addwish</span>";
				}
			?>
			</div>
			
				<div class="product-desc">
				<h2>Product Details</h2>
				<p><?php echo $result['body'];?> </p>
	    	</div>
	    	<?php } } ?>
				
	</div>
<div class="rightsidebar span_3_of_1">
	<h2>CATEGORIES</h2>
	<ul>
<?php 
	$getallcat = $cat->getAllcatagory();
	if ($getallcat) {
		while ($result = $getallcat->fetch_assoc()) {
?>	
		<li><a href="productbycat.php?catid=<?php echo $result['id']; ?>">
			<?php echo $result['name']; ?></a></li>
<?php } } ?>
	</ul>
</div>
 		</div>
 	</div>
	</div>
<?php include 'inc/footer.php'; ?>

   
