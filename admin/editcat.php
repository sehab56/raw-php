<?php include'inc/header.php'; ?>
<?php include'inc/sidebar.php'; ?>

<?php include '../classes/Catagory.php';  ?>

<?php 
    
    if (!isset($_GET['catid']) || $_GET['catid'] == NULL ) {
       // header("location:catlist.php");
        echo "<script>window.location ='catlist.php'; </script>";
    }else{
        $id = $_GET['catid'];
    }

    $Catagory = new Catagory();

    
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
       $name = $_POST['name'];
       $editcat = $Catagory->editcategory($name,$id);
    }

?>

<div class="grid_10">

<div class="box round first grid">
<h2>Category Edit</h2>
<?php
    if (isset($editcat)) {
        echo $editcat;
    }
    $Category = $Catagory->getonecatagory($id);
    if ($Category) {
        while ($result = $Category->fetch_assoc()) {
?>
<div class="block copyblock"> 
 <form action="" method="POST">
    <table class="form">	
				
        <tr>
            <td>
                <input type="text" name="name" value="<?php echo $result['name'];?>" class="medium" />
            </td>
        </tr>
         <?php } } ?>
		<tr> 
            <td>
                <input type="submit" name="submit" Value="Save" />
            </td>
        </tr>
    </table>
   
    </form>
</div>
</div>
</div>

<?php include'inc/footer.php'; ?>
