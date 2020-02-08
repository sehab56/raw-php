<?php include'inc/header.php'; ?>
<?php include'inc/sidebar.php'; ?>
<?php include_once '../classes/Contact.php';  ?>
<div class="grid_10">
<div class="box round first grid">
<h2>View Message</h2>
<?php
    $cn = new Contact();
    if (!isset($_GET['viewid']) || $_GET['viewid'] == NULL ) {
       // header("location:catlist.php");
        echo "<script>window.location ='contactInbox.php'; </script>";
    }else{
        $viewid = $_GET['viewid'];
    }
?>
<div class="block">               
<form action="contactInbox.php" method="POST">
<table class="form">
<?php
    $getSingleMsg = $cn->getSingleMsg($viewid); 
    if ($getSingleMsg) {
        while($result = $getSingleMsg->fetch_assoc()){
?>   
    <tr>
        <td>
            <label>Name</label>
        </td>
        <td>
            <?php echo $result['name']; ?>
        </td>
    </tr>
    <tr>
        <td>
            <label>Email</label>
        </td>
        <td>
            <?php echo $result['email']; ?>
        </td>
    </tr>
    <tr>
        <td>
            <label>Date</label>
        </td>
        <td>
            <?php echo $cn->fm->formatDate($result['date']); ?>
        </td>
    </tr>
 	<tr>
        <td>
            <label>Content</label>
        </td>
        <td>
            <?php echo $result['body']; ?>
        </td>
    </tr>

	<tr>
        <td></td>
        <td>
            <input type="submit" name="submit" Value="Ok" />
        </td>
    </tr>
    <?php } } ?>
</table>
</form>
</div>
</div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function () {
    setupTinyMCE();
    setDatePicker('date-picker');
    $('input[type="checkbox"]').fancybutton();
    $('input[type="radio"]').fancybutton();
});
</script>
<!-- Load TinyMCE -->

<?php include'inc/footer.php'; ?>
