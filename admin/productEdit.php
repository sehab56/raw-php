<?php include_once '../classes/Catagory.php';  ?>
<?php include_once '../classes/Brand.php'; ?>

<?php include_once '../classes/Product.php';  ?>


<?php include_once'inc/header.php'; ?>
<?php include_once'inc/sidebar.php'; ?>
<?php
    if (!isset($_GET['editproductid']) || $_GET['editproductid'] == NULL ) {
       // header("location:catlist.php");
        echo "<script>window.location ='productlist.php'; </script>";
    }else{
        $viewproductid = $_GET['editproductid'];
    }


?>

<div class="grid_10">
<div class="box round first grid">
<h2>Update Product</h2>
<?php
    $product = new Product();


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


        if ($file_name == "") {
          if ($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $type == "") {
               $productmss =  "<span class='error'>filed must not be empty .</span>";
                echo $productmss;
            
            }else{

                $updateinset = $product->udateProduct($productName,$catId,$brandId,$body,$price,$type,$viewproductid);
                if (isset($updateinset)) {
                    echo $updateinset;
                }
            }
        }else{
            if ($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $type == "") {
               $productmss =  "<span class='error'>filed must not be empty .</span>";
                echo $productmss;
            }elseif($file_size > 1000000){
                    echo "<span style='color:red'>U can't file select 1MB Upper </span>";
            }elseif(in_array($file_ext,$permited) === false){
echo "<span style='color:red'>Ypu Can Upload Only :- ".implode(' ,',$permited)." </span>";
            }else{
                move_uploaded_file($file_temp,$uploaded_image);

             $updateinset = $product->udateProducton($productName,$catId,$brandId,$body,$price,$type,$viewproductid,$uploaded_image);
                if (isset($updateinset)) {
                    echo $updateinset;
                }

            }
        }

    }
?>

<div class="block">    
<?php
    
        
        $onepost = $product->getproduct($viewproductid);
         if(isset($onepost)) {
            while ($post = $onepost->fetch_assoc()) {
        
?>


<form action="" method="POST" enctype="multipart/form-data">
<table class="form">
   
    <tr>
        <td>
            <label>Product Name</label>
        </td>
        <td>
            <input type="text" name="productName"
             value="<?php echo $post['productName']; ?>" class="medium" />
        </td>
    </tr>
 
    <tr>
        <td>
            <label>Category</label>
        </td>
        <td>
            <select name="catId" id="select"  >
                <?php
                    $Catagory = new Catagory();

                    $adfds = $Catagory->getAllcatagory();
                    if($adfds){
                        while ($rrr = $adfds->fetch_assoc()) {
                ?>
                <option 
                <?php if ($post['catId'] == $rrr['id'] ){ ?>
                    selected = "selected"
                <?php } ?> value="<?php echo $rrr['id']; ?>"><?php echo $rrr['name']; ?></option>

               <?php } } ?> 
            </select>
        </td>
    </tr>
    <tr>
        <td>
            <label>Brand</label>
        </td>
        <td>
            <select name="brandId" id="select"  >
                <?php
                    $brand = new Brand();

                    $breadasfsd = $brand->getAllcatagory();
                    if($breadasfsd){
                        while ($result = $breadasfsd->fetch_assoc()) {
                ?>
                <option 
                <?php if ($post['brandId'] == $result['id'] ){ ?>
                    selected = "selected"
                <?php } ?> value="<?php echo $result['id']; ?>"><?php echo $result['brandname']; ?></option>

               <?php } } ?> 
            </select>
        </td>
    </tr>
    <tr>
        <td style="vertical-align: top; padding-top: 9px;">
            <label>Content</label>
        </td>
        <td>
            <textarea name="body"  class="tinymce">
                <?php echo $post['body']; ?>
            </textarea>
        </td>
    </tr>
    <tr>
        <td>
            <label>Price</label>
        </td>
        <td>
            <input type="text" name="price"  value="<?php echo $post['price']; ?>" class="medium" />
        </td>
    </tr>
    <tr>
        <td>
            <label>Image</label>
        </td>
        <td>
            <img  src="<?php echo $post['image']; ?>" height="100" weidht="200"/><br>
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
            <select  name="type" id="select">
                <option >Select Type</option>
            <?php if ($post['type'] == '1' ) { ?>
                <option selected = "selected" value="1">Featured</option>
                <option value="2">Non-Featured</option> 
            <?php }else{ ?>
                <option value="1">Featured</option>
                <option selected = "selected" value="2">Non-Featured</option>
                <?php } ?>
            </select>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <input type="submit" name="submit" Value="Udate" />
        </td>
    </tr>
    <?php } }   ?>
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
