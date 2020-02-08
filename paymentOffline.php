<?php include 'inc/header.php'; ?>
<link href="css/next.css" rel="stylesheet" type="text/css" media="all"/>

 <div class="main">
<div class="content">
<div class="section group">		
<div class="devition">
	<h2>Choose Payment Offline</h2>
	<div class="divition">
		<table class="tbltwo">
			<tr>
				<th >NO</th>
				<th >Product</th>
				<th >Price</th>
				<th >Quantity</th>
				<th >Total Price</th>
			</tr>
<?php 
	$sum = 0;
	$product = 0;
	$getall = $ct->getallcat();
	Session::set("getcatall",$getall);
	if ($getall) {
		$i = 0;
		while ($result = $getall->fetch_assoc()) {
			$i++;
?>

					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $result['productName']; ?></td>
						<td>Tk.<?php echo $result['price']; ?></td>
						<td><?php echo $result['quantity']; ?></td>
						<td>$<?php $allprice = $result['quantity'] * $result['price'];
							echo $allprice; 
						?></td>
					</tr>
<?php $sum = $sum + $allprice; } }  ?>
				</table>		

			
<?php if ($getall) { ?>
		<table style="float:right;text-align:left;" class="tblthree" width="40%">
					<tr>
						<th>Sub Total : </th>
						<td>$<?php echo $sum;?></td>
					</tr>
					<tr>
						<th>VAT : 	10% 	:</th>
						<td>$<?php echo $vat = $sum * 0.10 ;?></td>
					</tr>
					<tr>
						<th>Grand Total :</th>
						<td>$<?php echo $total = $sum + $vat;
								Session::set("total",$total);
								Session::set("product",$product);
								?></td>
					</tr>
		   	</table>
<?php } ?>
	</div>
	<div class="divition">
		<table class="tblone">

<?php 
    $cusId = Session::get("customerId");
    $showallcusss = $cus->customerProfileShow($cusId);
    
    if($showallcusss){
        while ($result = $showallcusss->fetch_assoc()) {
  
 ?>  
        <tr>
            <td width="20%">Name</td>
            <td width="5%">:</td>
            <td>
                <?php echo $result['name']; ?>
            </td>
        </tr>
        <tr>
            <td>Adress</td>
            <td>:</td>
            <td>
                <?php echo $result['address']; ?>
            </td>
        </tr>

        <tr>
            <td>City</td>
            <td>:</td>
            <td>
                <?php echo $result['city']; ?>
            </td>
        </tr>
        <tr>
            <td>Country</td>
            <td>:</td>
            <td>
                <?php echo $result['country']; ?>
            </td>
        </tr>
        <tr>
            <td>Zip</td>
            <td>:</td>
            <td>
                <?php echo $result['zip']; ?>
            </td>
        </tr>
        <tr>
            <td>Phone</td>
            <td>:</td>
            <td>
                <?php echo $result['phone']; ?>
            </td>
        </tr>
        <tr>
            <td>Email</td>
            <td>:</td>
            <td>
                <?php echo $result['email']; ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td width="100%">
            <a href='editproFile.php' class="grey">You Change YOur Profile
            </a>
            </td>
        </tr>
        
    <?php } }    ?> 
    </table>
   
	</div>


</div>
</div>
<div class="button"><a href="sucess.php?order=<?php echo $cusId; ?>">Order Now</a></div>
<?php include 'inc/footer.php'; ?>

