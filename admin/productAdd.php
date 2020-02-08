<?php include_once '../classes/Catagory.php';  ?>
<?php include_once '../classes/Brand.php'; ?>

<?php include_once '../classes/Product.php';  ?>




<?php include_once'inc/header.php'; ?>
<?php include_once'inc/sidebar.php'; ?>


<div class="grid_10">

<div class="box round first grid">
<h2>Add New Post</h2>
<?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $productName = $_POST['productName'];
        $catId = $_POST['catId'];
        
        $brandId = $_POST['brandId'];
        $body = $_POST['body'];
        $price = $_POST['price'];
        $type = $_POST['type'];

        $permited   = array('jpg','jpeg','png','gif');
        $file_name  = $_FILES['image']['name']; 
        $file_size  = $_FILES['image']['size']; 
        $file_temp  = $_FILES['image']['tmp_name'];

        $div = explode('.',$file_name);
        $file_ext = strtolower(end($div));
        $uniqre_image = substr(md5(time()),0,10).'.'.$file_ext;
        $uploaded_image = "upload/".$uniqre_image ;

     
        if ($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || 
            $type == "" || $file_name == "") {
           $productmss =  "<span class='error'>filed must not be empty .</span>";
            echo $productmss;
        
        }elseif($file_size > 1000000){
             $productmss = "<span style='color:red'>U can't file select 1MB Upper </span>";
             echo $productmss;
       
       }elseif(in_array($file_ext,$permited) === false){
                $productmss = "<span style='color:red'>Ypu Can Upload Only :- ".implode(' ,',$permited)." </span>";
                echo $productmss;
        
        }else{
            move_uploaded_file($file_temp,$uploaded_image);
                    
            $prod = new Product();

            $insetted = $prod->insertProduct($productName,$catId,$brandId,$body,$price,
                $uploaded_image,$type);
            if (isset($insetted)) {
                echo $insetted;
            }
    }
}

    ?>
<div class="block">               
<form action="" method="POST" enctype="multipart/form-data">
<table class="form">
   
    <tr>
        <td>
            <label>Product Name</label>
        </td>
        <td>
            <input type="text" name="productName" placeholder="Enter Post Title..." class="medium" />
        </td>
    </tr>
 
    <tr>
        <td>
            <label>Category</label>
        </td>
        <td>
            <select id="select" name="catId">
                <option value="">Category Select</option>
                <?php
                    $Catagory = new Catagory();
                    $Category = $Catagory->getAllcatagory(); 
                    if($Category){
                        while ($result = $Category->fetch_assoc()) {
                ?>
                <option value="<?php echo $result['id']; ?>"><?php echo $result['name']; ?></option>

               <?php } } ?> 
            </select>
        </td>
    </tr>
     <tr>
        <td>
            <label>Brand</label>
        </td>
        <td>
            <select id="select" name="brandId">
                <option value="">Brand Select</option>
                <?php
                    $Brand = new Brand();
                    $showbrand = $Brand->getAllcatagory(); 
                    if($showbrand){
                        while ($brsfs = $showbrand->fetch_assoc()) {
                ?>
                <option value="<?php echo $brsfs['id']; ?>"><?php echo $brsfs['brandname']; ?>
                 </option>
                <?php } } ?> 
            </select>
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
        <td>
            <label>Price</label>
        </td>
        <td>
            <input type="number" name="price" placeholder="Enter Post Title..." class="medium" />
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
            <label>Product Type</label>
        </td>
        <td>
            <select name="type" id="select">
                <option    value=""     >Select Type</option>
                <option value="1">Featured</option>
                <option value="2">Non-Featured</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>
            <label>Author</label>
        </td>
        <td>
            <input type="text" readonly name="author" value="<?php echo Session::get('username'); ?>" class="medium" />
            <input type="hidden" readonly name="userid" value="<?php echo Session::get('UserId'); ?>" class="medium" />
        </td>
    </tr>


	<tr>
        <td></td>
        <td>
            <input type="submit" name="submit" Value="Save" />
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
