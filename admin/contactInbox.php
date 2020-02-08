<?php include'inc/header.php'; ?>
<?php include'inc/sidebar.php'; ?>
<?php include_once '../classes/Contact.php';  ?>
  
<div class="grid_10">
<div class="box round first grid">
    <h2>Inbox</h2>
    <div class="block">
    <!-- Seen box er kaj -->
<?php
$cn = new Contact();
	if (isset($_GET['seenid'])) {
		$seenid = $_GET['seenid'];

		$sendseenMsg = $cn->sendseenMsg($seenid);
		if ($sendseenMsg) {
	   		echo $sendseenMsg;
	   }
	}
?>
<!-- Seen BOx er kaj -->        
        <table class="data display datatable" id="example">
		<thead>
			<tr>
				<th>Serial No.</th>
				<th>Name</th>
				<th>Email</th>
				<th>Message</th>
				<th>Date</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
<?php
	
	$msg = $cn->getUnseenMsg();
	
	if ($msg) {
		$i = 0;
		while ($result = $msg->fetch_assoc()) {
		$i++;
?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $result['name']; ?></td>
				<td><?php echo $result['email']; ?></td>
				<td><?php echo  $cn->fm->textshorten($result['body'],50); ?></td>
				<td><?php echo  $cn->fm->formatDate($result['date']); ?></td>
				<td><a href="viewmsg.php?viewid=<?php echo $result['id']; ?>">View</a> || 
					<a href="replaymsg.php?replayid=<?php echo $result['id']; ?>">Replay</a> || 
					<a onclick="return confirm('Are u sure to Move Seen File')" 
					 href="?seenid=<?php echo $result['id']; ?>">Seen</a>
				</td>
			</tr>
<?php  } } ?>			
		</tbody>
	</table>
   </div>
</div>




<!-- Seen Message -->


<div class="box round first grid">
    <h2>Seen Message</h2>
<?php
    if (isset($_GET['delid']) ) {
        $delid = $_GET['delid'];

	   $delSeenMsg = $cn->delSeenMsg($delid);

	   if ($delSeenMsg) {
	   		echo $delSeenMsg;
	   }
	}

?>
    <div class="block">        
        <table class="data display datatable" id="example">
		<thead>
			<tr>
				<th>Serial No.</th>
				<th>Name</th>
				<th>Email</th>
				<th>Message</th>
				<th>Date</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
<?php
	$msg = $cn->getSeenMsg();

	if ($msg) {
		$i = 0;
		while ($result = $msg->fetch_assoc()) {
		$i++;
?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $result['name']; ?></td>
				<td><?php echo $result['email']; ?></td>
				<td><?php echo $cn->fm->textshorten($result['body'],50); ?></td>
				<td><?php echo $cn->fm->formatDate($result['date']); ?></td>
				<td><a href="viewmsg.php?viewid=<?php echo $result['id']; ?>">View</a> ||
				<a onclick="return confirm('Are u sure to Delete')" 
				 href="?delid=<?php echo $result['id']; ?>">Delete</a></td>
			</tr>
<?php  } } ?>			
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

