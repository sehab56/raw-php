<?php include 'inc/header.php'; ?>

<?php include 'inc/header_bottom.php'; ?>

<?php include 'inc/slider.php'; ?>


			 	    </div>
	  <div class="clear"></div>
  </div>	

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Feature Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
<?php
	$gerpd = $pd->getfeatureProduct();

	if (isset($gerpd)) {
		while ($result = $gerpd->fetch_assoc()) { ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview.php?proid=<?php echo $result['productId']  ?>">
				<img src="admin/<?php echo $result['image'];?>" height="222px"width="222px" alt="" /></a>
					 <h2><?php echo $fm->textshorten($result['productName'],27);?></h2>
					 <p><?php echo $fm->textshorten($result['body'],50);?></p>
					 <p><span class="price">$<?php echo $result['price'];?>
					 </span></p>
				     <div class="button"><span>
				     <a href="preview.php?proid=<?php echo $result['productId']  ?>" 
				     class="details">Details</a></span></div>
				</div>
		<?php	} } ?>
			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>New Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
<?php
	$gedall = $pd->getfeatureAll();
	if (isset($gedall)) {
		while ($newres = $gedall->fetch_assoc()) {
?>			
			<div class="grid_1_of_4 images_1_of_4">
				 <a href="preview.php?proid=<?php echo $newres['productId']  ?>">
			<img src="admin/<?php echo $newres['image'];?>" height="222px"width="222px" alt="" /></a>
				 <h2><?php echo $fm->textshorten($newres['productName'],27);?></h2>
				 <p><?php echo $fm->textshorten($newres['body'],50);?></p>
				 <p><span class="price">$<?php echo $newres['price'];?>
				 </span></p>
			     <div class="button"><span>
			     <a href="preview.php?proid=<?php echo $newres['productId']  ?>" 
			     class="details">Details</a></span></div>
			</div>
<?php	} } ?>
			</div>
    </div>
 </div>

<?php include 'inc/footer.php'; ?>
   