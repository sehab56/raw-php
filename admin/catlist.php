<?php include'inc/header.php'; ?>
<?php include'inc/sidebar.php'; ?>

<?php include '../classes/Catagory.php';  ?>
<?php 
    $Catagory = new Catagory();
    
  ?>
<div class="grid_10">
<div class="box round first grid">
<h2>Category List</h2>
<?php

	if (isset($_GET['dalcat']) ) {
		$pageid = $_GET['dalcat'];

		$deletecategory = $Catagory->deletecat($pageid);
		if (isset($deletecategory)) {
			echo $deletecategory;
		}
	}

		

?>

<div class="block">        
    <table class="data display datatable" id="example">
	<thead>
		<tr>
			<th>Serial No.</th>
			<th>Category Name</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
<?php
	$Category = $Catagory->getAllcatagory();
	if ($Category) {
		$i = 0;
		while ($result = $Category->fetch_assoc()) {
		$i++;
?>

		<tr class="odd gradeX">
			<td><?php echo "$i"; ?></td>
			<td><?php echo $result['name'];?></td>
			<td><a href="editcat.php?catid=<?php echo $result['id'];?>">Edit</a> || 
			<a onclick="return confirm('Are u sure to Delete')" href="?dalcat=<?php echo $result['id'];?>">Delete</a></td>
		</tr>
<?php } } ?>
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

<?php include'inc/footer.php'; ?>