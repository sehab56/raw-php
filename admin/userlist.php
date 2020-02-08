<?php include_once '../classes/Admin.php';  
$ad = new Admin();
?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; 
	if (isset($_GET['del'])) {
		$delid = $_GET['del'];
		$query = "DELETE FROM tbl_user WHERE id = '$delid'";
		$delquery = $ad->db->delete($query);
	}

?>


<div class="grid_10">
<div class="box round first grid">
<h2>User List</h2>
<div class="block">

<table class="data display datatable" id="example">
<thead>
	<tr>
		<th width="10%">User NO.</th>
		<th width="10%">Name</th>
		<th width="10%">User Name</th>
		<th width="10%">Email</th>
		<th width="10%">Details</th>
		<th width="10%">Role</th>
		<th width="10%">Action</th>
	</tr>
</thead>

<tbody>
	<tr class="odd gradeX">
	<?php 
	$query = "SELECT * FROM tbl_user ";
	$selquery = $ad->db->select($query);
	if ($selquery) {
		$i = 0;
		while ($result = $selquery->fetch_assoc()) {
			$i++;
 ?>  
		<td width="10%"><?php echo $i; ?></td>
		<td width="15%"><?php echo $result['name']; ?></td>
		<td width="15%"><?php echo $result['username']; ?></td>
		<td width="15%"><?php echo $result['email']; ?></td>
		<td width="25%"><?php echo $ad->fm->textshorten($result['details'],20); ?></td>
		<td width="10%"><?php 
					if ($result['role'] == '0') {
						echo "Admin";
					}elseif ($result['role'] == '1') {
						echo "Author";
					}elseif ($result['role'] == '2') {
						echo "Editor";
					}
			?></td>
		<td width="10%"><a href="viewuser.php?viewid=<?php echo $result['id']; ?>">View</a> 
	<?php if (Session::get('userRole') == '0') {  ?>
		|| <a onclick="return confirm('Are u sure to Delete')"
		href="?del=<?php echo $result['id'];?>">Delete</a>
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
    <div class="clear">
    </div>
	<script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
            $('.datatable').dataTable();
			setSidebarHeight();
        });
    </script>
 <?php include 'inc/footer.php'; ?>