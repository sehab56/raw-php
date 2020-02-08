<?php include'inc/header.php'; ?>
<?php include'inc/sidebar.php'; ?>

<?php
    if (!isset($_GET['pageid'])  ||  $_GET['pageid'] == NULL ) {
       // header("location:catlist.php");
        echo "<script>window.location ='index.php'; </script>";
    }else{
        $pageid = mysqli_real_escape_string($db->link,$_GET['pageid']);
    }
?>
<div class="grid_10">
<div class="box round first grid">
<?php
    $show_query = "SELECT * FROM tbl_page WHERE id='$pageid'";
    $page = $db->select($show_query);
    if($page){
        while ($result = $page->fetch_assoc()) {
?> 
<h2><?php echo $result['name']; ?> Page</h2>

<?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = mysqli_real_escape_string($db->link, $_POST['name']);
    $body = mysqli_real_escape_string($db->link, $_POST['body']);
   
 
    if ($name == "" || $body == "" ) {
       echo "<span class='error'>filed must not be empty .</span>";
    
    }else{
        $uquery = "UPDATE tbl_page SET name = '$name', body = '$body' WHERE id='$pageid'";
        $update_page = $db->update($uquery);
        if ($update_page){
           echo "<span class='success'>Page UPDATE successfully.</span>";
        }else{
            echo "<span class='error'>Page not UPDATEd</span>";
        }
    }

}

?>

<div class="block">               
<form action="" method="POST">
<table class="form">
    <tr>
        <td>
            <label>Page Name</label>
        </td>
        <td>
            <input type="text" name="name" value="<?php echo $result['name']; ?>" class="medium" />
        </td>
    </tr>
 	<tr>
        <td style="vertical-align: top; padding-top: 9px;">
            <label>Content</label>
        </td>
        <td>
            <textarea name="body" class="tinymce"><?php echo $result['body']; ?></textarea>
        </td>
    </tr>
	<tr>
        <td></td>
        <td>
            <input type="submit" name="submit" Value="Update" />
            <span class="actiondel"><a onclick="return confirm('Are u sure to Delete The Page')"
            href="delpage.php?delpageid=<?php echo $result['id']; ?>">Delete</a></span>
        </td>
    </tr>
<?php } } ?>
</table>
</form>
</div>
</div>
</div>
<style type="text/css">.actiondel{background:#DDDDDD; border: 1px solid #ddd;color: #444;cursor: pointer;
    font-size: 20px;    padding: 2px 10px;}</style>

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




