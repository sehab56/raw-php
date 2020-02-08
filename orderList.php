<?php include 'inc/header.php'; ?>
<?php
	$getall = $ct->getallOrder($customerId);
	if ($getall == false) {
		header("Location:index.php");
	}

	if (isset($_GET['orderId'])) {
		$cmrId = $_GET['orderId'];
	}
?>

<?php
	if (isset($_GET['delcart'])) {
		$delcart = $_GET['delcart'];
		
		$delelter = $ct->delOrder($delcart);
		
	}


?>
<?php
	if (isset($_GET['deleveredId'])) {
		$deleveredId = $_GET['deleveredId'];
		
		$Ordersuces = $ct->Ordersuces($deleveredId);
		
	}


?>
<div class="main">
<div class="content">
<div class="cartoption">		
	<div class="cartpage">

	    	<h2>Your Cart</h2>
<?php
	if (isset($Ordersuces)) {
		echo $Ordersuces;
	}
?>
				<table class="tblone">
					<tr>
						<th width="5%">Id</th>
						<th width="20%">Product Name</th>
						<th width="10%">Image</th>
						<th width="10%">Quantity</th>
						<th width="10%">Price</th>
						<th width="30%">Date</th>
						<th width="10%">Status</th>
						<th width="5%">Action</th>
					</tr>
<?php 
	$sum = 0;
	$product = 0;
	$customerId = Session::get("customerId");
	
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
		<td><?php echo $result['quantity']; ?></td>
		<td>Tk.<?php echo $result['price']; ?></td>
		<td><?php echo $fm->formatDate($result['date']); ?></td>
		<td><?php
						if ($result['status'] == "0") {
						 	echo "Panding";
						 }elseif($result['status'] == "1"){
						 	echo "Shifed"; 
						 }else{
						 	echo "Delevery Ok";
						 } 
					?>
		</td>
		<td>
		<?php
			if ($result['status'] == "1"){
		?>
		<a onclick="return confirm('Apni Delevery Peyechen ke')"
			href="?deleveredId=<?php echo $result['id']; ?>">Delevered
			</a>
		<?php }elseif($result['status'] == "0"){
		 echo "N/A";
		 	}else{
		 		echo "Ok";
		 	}

		 	 ?>
</td>
	</tr>
	<?php } 	}	?>
				
				</table>		

			


			
		</div>

</div>  	
<div class="clear"></div>
</div>
 </div>
</div>


<?php include 'inc/footer.php'; ?>

