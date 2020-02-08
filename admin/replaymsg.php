<?php include'inc/header.php'; ?>
<?php include'inc/sidebar.php'; ?>
<?php include_once '../classes/Contact.php';  ?>
<div class="grid_10">
<div class="box round first grid">
<h2>View Message</h2>
<?php
    $cn = new Contact();
    if (!isset($_GET['replayid']) || $_GET['replayid'] == NULL ) {
       // header("location:catlist.php");
        echo "<script>window.location ='contactInbox.php'; </script>";
    }else{
        $replayid = $_GET['replayid'];
    }
?>
<div class="block">               
<form action="" method="POST">
<table class="form">
<?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $toEmail    = $cn->fm->validation($_POST['toEmail']);
        $fromEmail  = $cn->fm->validation($_POST['fromEmail']);
        $Subject    = $cn->fm->validation($_POST['Subject']);
        $msg        = $cn->fm->validation($_POST['msg']);
        if ($toEmail == "" || $fromEmail == "" || $Subject == "" || $msg == "") {
            echo "Field Must NOt be Empty";
        }else{
            $sendemail = mail($toEmail, $Subject, $msg, $fromEmail);
            if ($sendemail) {
                echo "<span style='color:green; font-size:15px;'> Message send sucessfully </span>"; 
            }else{
                echo "<span style='color:red; font-size:15px;'>Something Went Wrong</span>";
            }
        }
    }

?>
<?php
    $query = " SELECT * FROM tbl_contact WHERE  id = '$replayid' ";
    $showmsg = $cn->db->select($query);
    while($result = $showmsg->fetch_assoc()){
?> 
    <tr>
        <td>
            <label>To</label>
        </td>
        <td>
            <input type="text" readonly name="toEmail" value="<?php echo $result['email']; ?>" class="medium" />
        </td>
    </tr>
    <?php }  ?>
    <tr>
        <td>
            <label>From</label>
        </td>
        <td>
            <input type="text" name="fromEmail" placeholder="Enter Your Email Addreess.." class="medium" />
        </td>
    </tr>
    <tr>
        <td>
            <label>Subject</label>
        </td>
        <td>
            <input type="text" name="Subject" placeholder="Enter Your Subject" class="medium" />
        </td>
    </tr>
 	<tr>
        <td>
            <label>Message</label>
        </td>
        <td>
            <textarea name="msg"  class="tinymce"> 

            </textarea>
        </td>
    </tr>

	<tr>
        <td></td>
        <td>
            <input type="submit" name="submit" Value="Ok" />
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
