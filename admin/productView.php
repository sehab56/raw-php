
<?php include '../classes/Catagory.php';  ?>
<?php include '../classes/Brand.php'; ?>

<?php include '../classes/Product.php';  ?>


<?php include'inc/header.php'; ?>
<?php include'inc/sidebar.php'; ?>

<div class="grid_10">
<div class="box round first grid">
<h2>Update Post</h2>
    
<div class="block">    
<?php
    if (!isset($_GET['viewproductid']) || $_GET['viewproductid'] == NULL ) {
       // header("location:catlist.php");
        echo "<script>window.location ='productlist.php'; </script>";
    }else{
        $viewproductid = $_GET['viewproductid'];
        $product = new Product();
        $onepost = $product->getproduct($viewproductid);
         if(isset($onepost)) {
            while ($post = $onepost->fetch_assoc()) {
        
?>


<form action="productlist.php" method="POST" enctype="multipart/form-data">
<table class="form">
   
    <tr>
        <td>
            <label>Product Name</label>
        </td>
        <td>
            <input type="text" readonly value="<?php echo $post['productName']; ?>" class="medium" />
        </td>
    </tr>
 
    <tr>
        <td>
            <label>Category</label>
        </td>
        <td>
            <select id="select" readonly >
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
            <select id="select" readonly >
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
            <textarea readonly class="tinymce">
                <?php echo $post['body']; ?>
            </textarea>
        </td>
    </tr>
    <tr>
        <td>
            <label>Price</label>
        </td>
        <td>
            <input type="text" readonly value="<?php echo "$".$post['price']; ?>" class="medium" />
        </td>
    </tr>
    <tr>
        <td>
            <label>Upload Image</label>
        </td>
        <td>
            <img src="<?php echo $post['image']; ?>" height="100" weidht="200"/><br>
        </td>
    </tr>
    <tr>
        <td>
            <label>Product Type</label>
        </td>
        <td>
            <select readonly name="type" id="select">
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
            <input type="submit" name="submit" Value="OK" />
        </td>
    </tr>
    <?php } } }  ?>
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
