<?php include 'inc/header.php'; ?>

 <div class="main">
    <div class="content">
<?php
	$getband = $bd->getAllcatagory();
	if (isset($getband)) {
		while ($result = $getband->fetch_assoc()) {
?>    
    	<div class="content_top">
    		<div class="heading">
    		<h3>Latest from <?php $band = $result['id']; echo $result['brandname']; ?></h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
<?php
	$gedall = $pd->getProductWithBrand($band);
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

<?php } } ?>			
    </div>
 </div>
</div>


<?php include 'inc/footer.php'; ?>
   

