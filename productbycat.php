<?php include 'inc/header.php'; ?>
<?php
    if (!isset($_GET['catid']) || $_GET['catid'] == NULL ) {
       // header("location:catlist.php");
        echo "<script>window.location ='index.php'; </script>";
    }else{
        $catid = $_GET['catid'];
    } 
?> 
<div class="main">
<div class="content">
<div class="content_top">
	<div class="heading">
	<h3><?php  
	$getcat = $cat->getonecatagory($catid);

	while ( $resss = $getcat->fetch_assoc()) {
		echo "Latest from ".$resss['name'];
	}

	


	?></h3>
	</div>
	<div class="clear"></div>
</div>
  <div class="section group">
  <?php 
		$catget = $pd->getCatPro($catid);

		if ($catget) {
			while ($result = $catget->fetch_assoc()) {
	?>
	<div class="grid_1_of_4 images_1_of_4">
		 <a href="preview.php?proid=<?php echo $result['productId'];?>">
		 <img width="222px" height="222px" src="admin/<?php echo $result['image'];?>" alt="" /></a>
		 <h2><?php echo $result['productName'];?></h2>
		 <p><?php echo $fm->textshorten($result['body'],50);?></p>
		 <p><span class="price">$<?php echo $result['price'];?></span></p>
	     <div class="button"><span>
	     <a href="preview.php?proid=<?php echo $result['productId'];?>" class="details">Details</a></span></div>
	</div>
<?php } }else{
	echo "<span   style='color:green;	color: green;  text-align: center;  display: block; padding: 29px 20px;	border: 1px solid black;'>This Catagory No Product Available...
	<br> Plesase Next Time Try</span>";
	}	?>
	</div>



</div>
 </div>
</div>
  <?php include 'inc/footer.php'; ?>
   
