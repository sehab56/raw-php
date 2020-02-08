<?php include_once'inc/header.php'; ?>



<?php include_once'inc/sidebar.php'; ?>
<div class="grid_10">

<div class="box round first grid">
<h2>Add New Pages</h2>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = mysqli_real_escape_string($db->link,$_POST['name']);
    $body = mysqli_real_escape_string($db->link,$_POST['body']);
   
 
    if ($name == "" || $body == "" ) {
       echo "<span class='error'>filed must not be empty .</span>";
    
    }else{
                
       $query = "INSERT INTO tbl_page (name, body) VALUES ('$name','$body') ";
        $addpage = $db->insert($query);
        if($addpage){
            echo "<span style='color:green'>Page INSERT Successfully</span>";
        }else{
            echo "<span style='color:red'>Page NOt Insert Successfully</span>";
        }
}
}

    ?>
<div class="block">               
<form action="addpage.php" method="POST">
<table class="form">
   
    <tr>
        <td>
            <label>Page Name</label>
        </td>
        <td>
            <input type="text" name="name" placeholder="Enter page name..." class="medium" />
        </td>
    </tr>
 	<tr>
        <td style="vertical-align: top; padding-top: 9px;">
            <label>Content</label>
        </td>
        <td>
            <textarea name="body" class="tinymce"></textarea>
        </td>
    </tr>
	<tr>
        <td></td>
        <td>
            <input type="submit" name="submit" Value="Create Page" />
        </td>
    </tr>
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




