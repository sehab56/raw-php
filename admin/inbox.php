<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php   $filepath = realpath(dirname(__FILE__));    ?>

<?php include_once($filepath.'/../classes/Cart.php');?>
<?php
	$ct = new Cart();

	if (isset($_GET['shiftId'])) {
		$cmrId 		= $_GET['shiftId'];
		$productId 	= $_GET['pdId'];
		$date 		= $_GET['time'];

		$shift = $ct->productShifted($cmrId,$productId,$date);		
	}

	if (isset($_GET['pandding'])) {
		$cmrId 		= $_GET['pandding'];
		$productId 	= $_GET['pdId'];
		$date 		= $_GET['time'];

		$remove = $ct->productRemoveing($cmrId,$productId,$date);		
	}

	if (isset($_GET['remove'])) {
		$cmrId 		= $_GET['remove'];
		$productId 	= $_GET['pdId'];
		$date 		= $_GET['time'];

		$deletepro = $ct->productDelete($cmrId,$productId,$date);		
	}

?>
<div class="grid_10">
<div class="box round first grid">
<h2>Inbox</h2>
<div class="block">        
    <table class="data display datatable" id="example">
	<thead>
		<tr>
			<th>ID.</th>
			<th>User Id</th>
			<th>Date & Time</th>
			<th>Product Id</th>
			<th>Product</th>
			<th>Quantity</th>
			<th>Price</th>
			<th>Details</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
<?php 
	
	$getallOrder = $ct->AdmingetallOrder();

	if ($getallOrder) {
		$i = "0";
		while ($result = $getallOrder->fetch_assoc()) {
			$i++;
?>
	<tr class="odd gradeX">
		<td><?php echo $i;?></td>
		<td><a href="detailsCustomer.php?customerID=<?php echo $result['cmrId'];?>">
		<?php echo $result['cmrId'];?></a></td>
		<td><?php echo $ct->fm->formatDate($result['date']); ?></td>
		<td><?php echo $result['productId'];?></td>
		<td><?php echo $result['productName'];?></td>
		<td><?php echo $result['quantity'];?></td>
		<td><?php echo $result['price'];?></td>
		<td><a href="detailsOrder.php?order=<?php echo $result['productId'];?>">Product Details</a></td>
		<td>
		<?php if($result['status'] == '0'){ ?>
		<a href="?shiftId=<?php echo $result['cmrId'];?>&pdId=<?php echo $result['productId'];?>&time=<?php echo $result['date'];?>">Shifted</a> 
		<?php }elseif($result['status'] == '1'){  ?>
		<a href="?pandding=<?php echo $result['cmrId'];?>&pdId=<?php echo $result['productId'];?>&time=<?php echo $result['date'];?>">Pandding</a> 
		<?php }else{ ?>
		<a href="?remove=<?php echo $result['cmrId'];?>&pdId=<?php echo $result['productId'];?>&time=<?php echo $result['date'];?>">Remove</a> 
		<?php } ?>
		</td>
	</tr>
<?php 	}	}	?>
	</tbody>
</table>
</div>
</div>
</div>
        
 
<script type="text/javascript">

        $(document).ready(function () {
            setupLeftMenu();

            $('.datatable').dataTable();
            setSidebarHeight();


        });
    </script>
 <?php include 'inc/footer.php'; ?>
