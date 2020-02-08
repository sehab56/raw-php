<?php include_once'inc/header.php'; ?>
<?php include_once'inc/sidebar.php'; ?>
<div class="grid_10">

<div class="box round first grid">
<h2>Add New Slider Image</h2>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $title  = mysqli_real_escape_string($db->link, $_POST['title']);
    $link   = mysqli_real_escape_string($db->link, $_POST['link']);


    $permited   = array('jpg','jpeg','png','gif');
    $file_name  = $_FILES['image']['name']; 
    $file_size  = $_FILES['image']['size']; 
    $file_temp  = $_FILES['image']['tmp_name'];

    $div = explode('.',$file_name);
    $file_ext = strtolower(end($div));
    $uniqre_image = substr(md5(time()),0,10).'.'.$file_ext;
    $uploaded_image = "upload/slider/".$uniqre_image ;
   if (!filter_var($link,FILTER_VALIDATE_URL)) {
       echo "<span class='error'>Plz enter validate  url .</span>";
    }elseif ($file_name == "" || $title == "" || $link == "" ) {
       echo "<span class='error'>filed must not be empty .</span>";
    
    }elseif($file_size > 1000000){
            echo "<span style='color:red'>U can't file select 1MB Upper </span>";
   
   }elseif(in_array($file_ext,$permited) === false){
            echo "<span style='color:red'>Ypu Can Upload Only :- ".implode(' ,',$permited)." </span>";
    
    }else{
        move_uploaded_file($file_temp,$uploaded_image);
                
       $imgquery = "INSERT INTO tbl_slider (title, link, image ) VALUES ( '$title','$link','$uploaded_image') ";
        $addimge = $db->insert($imgquery);
        if($addimge){
            echo "<span style='color:green'>Image INSERT Successfully</span>";
        }else{
            echo "<span style='color:red'>Image NOt Insert Successfully</span>";
        }
}
}

    ?>
<div class="block">               
<form action="" method="POST" enctype="multipart/form-data">
<table class="form">
    <tr>
        <td>
            <label>Title</label>
        </td>
        <td>
            <input type="text" name="title" placeholder="Enter Post Title..." class="medium" />
        </td>
    </tr>
    <tr>
        <td>
            <label>Upload Image</label>
        </td>
        <td>
            <input name="image" type="file" />
        </td>
    </tr>
     <tr>
        <td>
            <label>Image Link</label>
        </td>
        <td>
            <input type="text" name="link" placeholder="Enter Img link..." class="medium" />
        </td>
    </tr>

	<tr>
        <td></td>
        <td>
            <input type="submit" name="submit" Value="Add New Image " />
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
