<?php include_once '../classes/Admin.php';  
$ad = new Admin();
?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php  if ($role != '0') {
    header("Location:index.php");
}

?>

<div class="grid_10">
<div class="box round first grid">
<h2>thisd New Post</h2>
<div class="block"> 
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
    
    $AddAdminUser = $ad->AddAdminUser($_POST);
 } 
 
?>              
 <form action="" method="POST" >
    <table class="form">
       
        <tr>
            <td>
                <label>User Name</label>
            </td>
            <td>
                <input type="text" name="username" placeholder="Enter User Name..." class="medium" />
            </td>
        </tr>
        <tr>
            <td>
                <label>Password</label>
            </td>
            <td>
                <input type="text/password" name="password" placeholder="Enter Password ..." class="medium" />
            </td>
        </tr>
        <tr>
            <td>
                <label>Email </label>
            </td>
            <td>
                <input type="text" name="email" placeholder="Enter Valid Email..." class="medium" />
            </td>
        </tr>
     
        <tr>
            <td>
                <label>User Role</label>
            </td>
            <td>
                <select id="select" name="role">
                    <option value="">Select A Catagory</option>
                    <option value="0">admin</option>
                    <option value="1">Author</option>
                    <option value="2">Editor</option>
                </select>
            </td>

		<tr>
            <td></td>
            <td>
                <input type="submit" name="submit" Value="Add User" />
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