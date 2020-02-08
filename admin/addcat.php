<?php include_once'inc/header.php'; ?>

<?php include_once'inc/sidebar.php'; ?>

<?php include_once '../classes/Catagory.php';  ?>

<?php 
    $Catagory = new Catagory();
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $name = $_POST['name'];

        $adcat = $Catagory->adcatagory($name);
    }
  ?>

<div class="grid_10">
<div class="box round first grid">
<h2>Add New Category</h2>
<div class="block copyblock"> 
<?php
    if (isset($adcat)) {
        echo $adcat;
    }

?>

 <form action="" method="POST">
    <table class="form">					
        <tr>
            <td>
                <input type="text" name="name" placeholder="Enter Category Name..." class="medium" />
            </td>
        </tr>
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

