<?php include_once '../classes/Admin.php';  
$ad = new Admin();
?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; 
    $userid = Session::get("UserId");

?>
<div class="grid_10">

<div class="box round first grid">
<h2>Change Password</h2>
<div class="block">
<?php
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
        
        $changePassword = $ad->changeuserPassword($_POST,$userid);
    }
?>               
<form action="" method="POST">
<table class="form">
    <tr>
        <td>
            <label>Old Password</label>
        </td>
        <td>
            <input type="password" name="old" placeholder="Enter Old Password..."  name="title" class="medium" />
        </td>
    </tr>
	 <tr>
        <td>
            <label>New Password</label>
        </td>
        <td>
            <input type="password" name="new" placeholder="Enter New Password..." name="slogan" class="medium" />
        </td>
    </tr>
	<tr>
        <td>
            <label>Confirm Password</label>
        </td>
        <td>
            <input type="password" name="confirm" placeholder="Enter Confirm Password..." name="slogan" class="medium" />
        </td>
    </tr> 
	<tr>
        <td>
        </td>
        <td>
            <input type="submit" name="submit" Value="Update" />
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
