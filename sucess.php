<?php include 'inc/header.php'; ?>
<style type="text/css">
	.payment {    width: 500px;display: block;border: 2px solid;padding: 82px; text-align: left; padding-left: 000; margin: 0 auto;}
.payment h2{    text-align: center;
    border-bottom: 1px solid;
    padding: 20px;
    margin: 0 auto;
    color: green;
    display: block;
    border: 1px solid blue;
    background: bisque;
    width: 129px;}
	.payment p{font-size: 24px;color: blue; padding: 13px;}
	.payment a{font-size: 24px;color: blue; padding: 13px;}
	.payment a:hover{margin:0 auto; width: 100px; text-align:center;padding:20px;font-size: 24px;color:white;background:green;border:1px solid; padding: 13px;}


</style>
<?php 
    if (isset($_GET['order'])) {
        $customerId = Session::get("customerId");
        $allOrder = $ct->addAllorder($customerId);
        $deldata = $ct->delCustomerCart();

        
    }
?>

 <div class="main">
    <div class="content">
    	 <div class="payment">
    	 	<h2>Payment</h2>
    	 	<?php 
				$customerId = Session::get("customerId");
    	 		$vatandAmount = $ct->vatandAmount($customerId);
	    	 	if ($vatandAmount == true) {
	    	 		$totalPrice = "";
	                while ($result = $vatandAmount->fetch_assoc()) {
	                	$price = $result['price'];
	                    $totalPrice = $totalPrice + $price;
	                }
	            }else{
	            	header("Location:index.php");
	            }
    	 	 ?>
    	 	<p><br/>Total payable(Amount Vat):$<?php $vat = $totalPrice * 0.1;
    	 	$total =  $totalPrice + $vat;  echo $total; ?></p>
    	 	<p>Thanks for purchase .Recive Your Order Succesfully.We will contact Your  ASAP with delivery details.Here Is your Order details.....</p>
    	 	<a href="orderList.php?orderId=<?php echo $customerId;?>">Visit Here</a>

    	 </div>


    </div>
 </div>
</div>


 <?php include 'inc/footer.php'; ?>

 