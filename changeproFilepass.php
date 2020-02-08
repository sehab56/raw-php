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
        <h2>Edit Your Profile Password</h2>
<?php 

    $cusId = Session::get("customerId");

    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
        
        $editCustomerDetails = $cus->editCustomerpass($_POST,$cusId);
    }


?>          
 <form action="" method="POST" >
    <table class="tblone">

<?php 
    if (isset($editCustomerDetails)) {
        echo "$editCustomerDetails";
    }
  
 ?>  
       <tr>
            <td>Old PassWord</td>
            <td>:</td>
            <td>
                <input type="password" name="pass" placeholder="Enter Old Password" class="medium" />
            </td>
        </tr>
        <tr>
            <td>New PassWord</td>
            <td>:</td>
            <td>
                <input type="password" name="new"  placeholder="Enter New Password" class="medium" />
            </td>
        </tr>
        <tr>
            <td>Confirm PassWord</td>
            <td>:</td>
            <td>
                <input type="password" name="old" placeholder="Enter Confirm Password" class="medium" />
            </td>
        </tr>
        <tr>
            <td><a href="profile.php">Now Show Profile</a></td>
            <td></td>
            <td>
                <input type="submit" name="submit" value="Update Password" class="medium" />
            </td>
        </tr>
    </table>

    </form>
       

</div>
</div>
</div>
<div class="clear">
</div>
</div>
 
    
 <?php include 'inc/footer.php'; ?>
        