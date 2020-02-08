<?php include 'inc/header.php'; ?>
<style type="text/css">
	#maadfdsf{ font-size: 18px;
    color: black;
    padding: 8px;
    outline: none;
    margin: 5px 0;
    width: 340px;
}

</style>

<div class="main">
<div class="content">
 <div class="login_panel">
	<h3>Existing Customers</h3>
	<p>Sign in with the form below.</p>
	<?php

		if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
		$checkLogin = $cus->checkLogin($_POST);
	}
	
		if (isset($checkLogin)) {
			echo $checkLogin;
		}

	?>
	<form action="" method="POST" id="member">
            <input name="loginemail" type="text" placeholder="Enter Login Email" class="field" >
            <input name="password" type="password" placeholder="Enter Login Password" class="field" >
            <div class="search"><div>
   <button name="login"  class="grey">login </button></div></div>
    <div class="clear"></div>
     </form>
</div>
<div class="register_account">
	<h3>Register New Account</h3>
	<?php

		if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registation'])) {
		$addcustomer = $cus->insertCustomer($_POST);
	}
	
		if (isset($addcustomer)) {
			echo $addcustomer;
		}

	?>
	<form action=""  method="POST">
			<table>
   				<tbody>
				<tr>
	<td>
		<div>
		<input type="text" name="name" placeholder="Enter User Name"  >
		</div>
		<div> 
		   <input type="text" name="address" placeholder="Enter Your Address" >
		</div>
		<div>
		   <input type="text" name="city" placeholder="Enter Your city" >
		</div>
		
		<div>
			<input type="text" name="country" placeholder="country">
		</div>
	</td>
	<td>
		<div>
			<input type="text" name="zip"	placeholder="Enter Your zip">
		</div>
	
    
		<div>
			<input type="text" name="phone" placeholder="Enter Your phone">
		</div>
		<div>
			<input type="email" id="maadfdsf" name="email" placeholder="Enter Your email">
		</div>		        
		<div>
      		<input type="password" id="maadfdsf" name="pass" placeholder="Enter Your Password">
      	</div>
  </td>
    </tr> 
    </tbody></table> 
   <div class="search"><div>
   <button name="registation" class="grey">Create Account</button></div></div>
    <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
    <div class="clear"></div>
    </form>
</div>  	
<div class="clear"></div>
</div>
</div>
</div>

<?php include 'inc/footer.php'; ?>


