<?php include 'inc/header.php'; ?>
<style type="text/css">
    .tblone{
        width: 450px;
        margin:0 auto;
        border:2px solid #ddd;
        display: block;
    }


</style>
 <div class="main">
    <div class="content">
        <div class="section group">  
        <h2>Edit Your Profile </h2>
<?php 

    $cusId = Session::get("customerId");

    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
        
        $editCustomerDetails = $cus->editCustomerDetails($_POST,$cusId);
    }


?>          
 <form action="" method="POST" >
    <table class="tblone">

<?php 
    if (isset($editCustomerDetails)) {
        echo "$editCustomerDetails";
    }
    
    $showallcusss = $cus->customerProfileShow($cusId);
    
    if($showallcusss){
        while ($result = $showallcusss->fetch_assoc()) {
  
 ?>  
        <tr>
            <td width="20%">Name</td>
            <td width="5%">:</td>
            <td >
                <input type="text" name="name" value="<?php echo $result['name']; ?>" class="medium" />
            </td>
        </tr>
        <tr>
            <td>Adress</td>
            <td>:</td>
            <td>
                <input type="text" name="address" value="<?php echo $result['address']; ?>" class="medium" />
            </td>
        </tr>

        <tr>
            <td>City</td>
            <td>:</td>
            <td>
                <input type="text" name="city" value="<?php echo $result['city']; ?>" class="medium" />
            </td>
        </tr>
        <tr>
            <td>>Zip</td>
            <td>:</td>
            <td>
                <input type="text" name="country" value="<?php echo $result['country']; ?>" class="medium" />
            </td>
        </tr>
        <tr>
            <td>>Zip</td>
            <td>:</td>
            <td>
                <input type="text" name="zip" value="<?php echo $result['zip']; ?>" class="medium" />
            </td>
        </tr>
        <tr>
            <td>Phone</td>
            <td>:</td>
            <td>
                <input type="text" name="phone" value="<?php echo $result['phone']; ?>" class="medium" />
            </td>
        </tr>
        <tr>
            <td>Email</td>
            <td>:</td>
            <td>
                <input type="text" name="email" value="<?php echo $result['email']; ?>" class="medium" />
            </td>
        </tr>
        
        <tr>
            <td></td>
            <td><input type="submit" name="submit" Value="Update" /></td>
            <td>
                <a href='changeproFilepass.php' class="grey">You Change Your Password
            </a>
            </td>
        </tr>
        
    <?php } }    ?> 
    </table>

    </form>
       

</div>
</div>
</div>
<div class="clear">
</div>
</div>
 
    
 <?php include 'inc/footer.php'; ?>
