<?php include'inc/header.php'; ?>
<?php include'inc/sidebar.php'; ?>
<?php 
    if (isset($_GET['sliderid'])) {
        $sliderid = $_GET['sliderid'];

        $delquery = ("SELECT * FROM tbl_slider WHERE id = '$sliderid'");
        $getimg = $db->select($delquery);
        if ($getimg) {
            while ($delimage = $getimg->fetch_assoc()) {
                $dellink = $delimage['image'];
                unlink($dellink); 
            }
        }

        $query = "DELETE FROM tbl_slider WHERE id = '$sliderid'";
        $delslider = $db->delete($query);
    }

 ?>

<div class="grid_10">
<div class="box round first grid">
<h2>Slider Image List</h2>
<div class="block">  
<table class="data display datatable" id="example">
<thead>
<tr>
    <th>No. </th>
    <th>Slider Title</th>
    <th>Slider Image</th>
    <th>Slider Link</th>
    <th>Action</th>
</tr>
</thead>
<tbody>
<?php
    $query = "SELECT * FROM tbl_slider "; 
    $slider = $db->select($query);
    if ($slider) {
        $i = 0 ;
        while ($result = $slider->fetch_assoc()) {
        $i++;
?>
<tr class="odd grades">
    <td><?php echo $i; ?></th>
    <td><?php echo $result['title']; ?></td>
    <td><img src="<?php echo $result['image']; ?>" height="40px" width="40px" /></td>
    <td><?php echo $result['link']; ?></td>
<td>
    <a href="viewslider.php?viewslider=<?php echo $result['id'];?>">View</a> 
<?php if ( Session::get('userRole') == '0' ) {  ?>  
     || <a href="editslider.php?editslider=<?php echo $result['id'];?>">Edit</a> || 
    <a onclick="return confirm('Are u sure to Delete')" href="?sliderid=<?php echo $result['id'];?>">Delete</a></td>
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