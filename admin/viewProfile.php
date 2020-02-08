<?php include_once '../classes/Admin.php';  
$ad = new Admin();
?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; 

    $userid   = Session::get('UserId');
    $userrole = Session::get('userRole');


?>
<?php  
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
        
        $updatedate = $ad->userprofilUpdate($_POST,$userid);
    }
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['ok'])) {
        
        header("Location:index.php");
    }

?>

 <div class="grid_10">
<div class="box round first grid">
<h2>Show Your Profile </h2>
<div class="block">               
 <form action="" method="POST" enctype="">
    <table class="form">

<?php 
    if (isset($updatedate)) {
        echo "$updatedate";
    }
    
    

    $query = "SELECT * FROM tbl_user WHERE id = '$userid' ";
    $selquery = $ad->db->select($query);
    if (isset($selquery)) {
        while ($result = $selquery->fetch_assoc()) {
 ?>
        <tr>
            <td>
                <label>Name</label>
            </td>
            <td>
                <input type="text" name="name" value="<?php echo $result['name']; ?>" class="medium" />
            </td>
        </tr>
        <tr>
            <td>
                <label>User Name</label>
            </td>
            <td>
                <input type="text" name="username" value="<?php echo $result['username']; ?>" class="medium" />
            </td>
        </tr>

        <tr>
            <td>
                <label>Email</label>
            </td>
            <td>
                <input type="text" name="email" value="<?php echo $result['email']; ?>" class="medium" />
            </td>
        </tr>
        <tr>

        <tr>
            <td style="vertical-align: top; padding-top: 9px;">
                <label>Details</label>
            </td>
            <td>
                <textarea name="details" class="tinymce"><?php echo $result['details']; ?></textarea>
            </td>
        </tr>
    <?php } } ?>
        <tr>
            <td><input type="submit" name="ok" Value="OK" /></td>
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


