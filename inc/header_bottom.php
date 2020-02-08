<div class="header_bottom">
<div class="header_bottom_left">
<div class="section group">
<?php
	$getFirst = $pd->getFirstProduct();

	if (isset($getFirst)) {
		while ($result = $getFirst->fetch_assoc()) { 
?>
	<div class="listview_1_of_2 images_1_of_2">
		<div class="listimg listimg_2_of_1">
			 <a href="preview.php?proid=<?php echo $result['productId'];?>"> 
			 <img src="admin/<?php echo $result['image'];?>" alt="" /></a>
		</div>
	    <div class="text list_2_of_1">

			<h2><?php echo $result['brandname'];?></h2>
		
			<p><?php echo $result['productName'];	?></p>
			<div class="button"><span>
			<a href="preview.php?proid=<?php echo $result['productId'];?>">
			Details</a></span></div>
	   </div>
   </div>
  <?php  } } ?>	
  <?php
	$getFirst = $pd->getSecondProduct();

	if (isset($getFirst)) {
		while ($result = $getFirst->fetch_assoc()) { 
?>
	<div class="listview_1_of_2 images_1_of_2">
		<div class="listimg listimg_2_of_1">
			 <a href="preview.php?proid=<?php echo $result['productId'];?>"> 
			 <img src="admin/<?php echo $result['image'];?>" alt="" /></a>
		</div>
	    <div class="text list_2_of_1">

			<h2><?php echo $result['brandname'];?></h2>
		
			<p><?php echo $result['productName'];	?></p>
			<div class="button"><span>
			<a href="preview.php?proid=<?php echo $result['productId'];?>">
			Details</a></span></div>
	   </div>
   </div>
  <?php  } } ?>	
  </div>
  <div class="section group">
<?php
	$getFirst = $pd->getThirtProduct();

	if (isset($getFirst)) {
		while ($result = $getFirst->fetch_assoc()) { 
?>
	<div class="listview_1_of_2 images_1_of_2">
		<div class="listimg listimg_2_of_1">
			 <a href="preview.php?proid=<?php echo $result['productId'];?>"> 
			 <img src="admin/<?php echo $result['image'];?>" alt="" /></a>
		</div>
	    <div class="text list_2_of_1">

			<h2><?php echo $result['brandname'];?></h2>
		
			<p><?php echo $result['productName'];	?></p>
			<div class="button"><span>
			<a href="preview.php?proid=<?php echo $result['productId'];?>">
			Details</a></span></div>
	   </div>
   </div>
  <?php  } } ?>	
<?php
	$getFirst = $pd->get4thProduct();

	if (isset($getFirst)) {
		while ($result = $getFirst->fetch_assoc()) { 
?>
	<div class="listview_1_of_2 images_1_of_2">
		<div class="listimg listimg_2_of_1">
			 <a href="preview.php?proid=<?php echo $result['productId'];?>"> 
			 <img src="admin/<?php echo $result['image'];?>" alt="" /></a>
		</div>
	    <div class="text list_2_of_1">

			<h2><?php echo $result['brandname'];?></h2>
		
			<p><?php echo $result['productName'];	?></p>
			<div class="button"><span>
			<a href="preview.php?proid=<?php echo $result['productId'];?>">
			Details</a></span></div>
	   </div>
   </div>
  <?php  } } ?>	
  </div>		
<div class="clear"></div>
</div>






