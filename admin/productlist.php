
<?php include_once '../classes/Catagory.php';  ?>
<?php include_once '../classes/Brand.php'; ?>

<?php include_once '../classes/Product.php';  ?>
<?php
	$product = new Product();
	if (isset($_GET['productdel'])) {
		$delid = $_GET['productdel'];

		$imgunlink = $product->unlinkimage($delid);
		if (isset($imgunlink)) {
			unlink($imgunlink);
		}
		$delelter = $product->productDelete($delid);
		if (isset($delelter)) {
			echo $delelter;
		}
	}


?>



<?php include'inc/header.php'; ?>
<?php include'inc/sidebar.php'; ?>
<div class="grid_10">
<div class="box round first grid">
<h2>Post List</h2>
<div class="block">  
<table class="data display datatable" id="example">
<thead>
<tr>
	<th>No. </th>
	<th>Product Name</th>
	<th>Catagory</th>
	<th>Brand</th>
	<th>Body</th>
	<th>Price</th>
	<th>Image</th>
	<th>Type</th>
	<th>Action</th>
</tr>
</thead>
<tbody>
<?php
	
	$post = $product->getAllproduct();
	 if(isset($post)) {
		$i = 0 ;
		while ($result = $post->fetch_assoc()) {
		$i++;
?>
<tr class="odd grades">
	<td><?php echo $i; ?></th>
	<td><?php echo $result['productName']; ?></td>
	<td><?php echo $result['name']; ?></td>
	<td><?php echo $result['brandname']; ?></td>
	<td><?php echo $product->fm->textshorten($result['body'],30); ?></td>
	<td><?php echo "$".$result['price']; ?></td>
	<td><img src="<?php echo $result['image']; ?>" height="40px" width="40px" /></td>
	<td><?php if ($result['type'] == 1) { echo "Featurd";}else{ echo "Non_Featurd";} ?></td>
<td>
	<a href="productView.php?viewproductid=<?php echo $result['productId'];?>">View</a> 
<?php if (Session::get('userRole') == '0' ) {  ?>	
	 || <a href="productEdit.php?editproductid=<?php echo $result['productId'];?>">Edit</a> || 
	<a onclick="return confirm('Are u sure to Delete')" href="?productdel=<?php echo $result['productId'];?>">Delete</a></td>
<?php } ?>

</tr>
<?php } } ?>
</tbody>
</table>

</div>
</div>
</div>
<div class="clear">
</div>
</div>

<script type="text/javascript">
$(document).ready(function () {
setupLeftMenu();
$('.datatable').dataTable();
setSidebarHeight();
});
</script>
<?php include'inc/footer.php'; ?>