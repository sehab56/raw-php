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

<?php include_once($filepath.'/../classes/Customer.php');?>
<?php
    if (isset($_GET['customerID'])) {
        $customerID = $_GET['customerID'];
    }

?>
<div class="grid_10">
<div class="box round first grid">
<h2>Show Your Profile </h2>
<div class="block">               
 <form action="" method="POST" enctype="">
    <table class="form">
 <?php 
    $cus = new Customer();
    $getallOrder = $cus->AdmingetCustomer($customerID);

    if ($getallOrder) {
        $i = "0";
        while ($result = $getallOrder->fetch_assoc()) {
            $i++;
?>
        <tr>
            <td>
                <label>Customer Id:</label>
            </td>
            <td>
                <?php echo $result['id']; ?>
            </td>
        </tr>
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
                <label>Address</label>
            </td>
            <td>
                <?php echo $result['address']; ?>
            </td>
        </tr>

        <tr>
            <td>
                <label>City</label>
            </td>
            <td>
                <?php echo $result['city']; ?>
            </td>
        </tr>
        <tr>
            <td>
                <label>Country</label>
            </td>
            <td>
                <?php echo $result['country']; ?>
            </td>
        </tr>
        <tr>
            <td>
                <label>Zip Code:</label>
            </td>
            <td>
                <?php echo $result['zip']; ?>
            </td>
        </tr>
        <tr>
            <td>
                <label>Phone</label>
            </td>
            <td>
                <?php echo $result['phone']; ?>
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


