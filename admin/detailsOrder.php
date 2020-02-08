<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<style type="text/css">
    table.form {    width: 500px;
    margin: 0 auto;
    border: 2px solid #FFFFFF;
    padding-top: 42px;}
    table.form tr td{    border: 1px solid #FFFFFF;
    text-align: center;
    padding: 18px;
    background: #204562;
    color: white;}
    button.button{    width: 139px;
    margin: 0 auto;
    text-align: center;
    background: #204562;
    color: white;
    padding: 19px;
    font-size: 22px;}

</style>
<?php   $filepath = realpath(dirname(__FILE__));    ?>

<?php include_once($filepath.'/../classes/Product.php');?>
<?php
    if (isset($_GET['order'])) {
        $order = $_GET['order'];
    }

?>
<div class="grid_10">
<div class="box round first grid">
<h2>Show Customer Product</h2>
<div class="block">               
 <form action="" method="POST" enctype="">
    <table class="form">
 <?php 
    $pd = new Product();
    $getallOrder = $pd->AdmingetCustomer($order);

    if ($getallOrder) {
        $i = "0";
        while ($result = $getallOrder->fetch_assoc()) {
            $i++;
?>
        <tr>
            <td>
                <label>Product Id:</label>
            </td>
            <td>
                <?php echo $result['productId']; ?>
            </td>
        </tr>
        <tr>
            <td>
                <label>Product</label>
            </td>
            <td>
                <?php echo $result['productName']; ?>
            </td>
        </tr>
        <tr>
            <td>
                <label>Category Name</label>
            </td>
            <td>
                <?php 
                    $catId = $result['catId']; 
                    $query = "SELECT name FROM tbl_category WHERE id = '$catId'";
                    $getcat = $pd->db->select($query)->fetch_assoc();
                    echo $getcat['name'];
                ?>
            </td>
        </tr>

        <tr>
            <td>
                <label>Brand Name</label>
            </td>
            <td>
            <?php
                    $brandId = $result['brandId']; 
                    $query = "SELECT brandname FROM tbl_brand WHERE id = '$brandId'";
                    $getcat = $pd->db->select($query)->fetch_assoc();
                    echo $getcat['brandname'];
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <label>Body</label>
            </td>
            <td>
                <?php echo $result['body']; ?>
            </td>
        </tr>
        <tr>
            <td>
                <label>Price</label>
            </td>
            <td>
                $<?php echo $result['price']; ?>
            </td>
        </tr>
        <tr>
            <td>
                <label>Image</label>
            </td>
            <td>
                <img width="100px" height="100px" src="<?php echo $result['image']; ?>" >
            </td>
        </tr>
    <?php } } ?>
    </table>

    </form>
</div>
<a href="inbox.php"><button class="button">Back</button></a>

</div>
</div>
<div class="clear">
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
    
 <?php include 'inc/footer.php'; ?>


