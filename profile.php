<?php include 'inc/header.php'; ?>
<style type="text/css">
    .tblone{
        width: 550px;
        margin:0 auto;
        border:2px solid #ddd;
         .tblone li{
        border:2px solid #ddd;
    }

</style>
 <div class="main">
    <div class="content">
        <div class="section group">
    <h2>Show Your Profile </h2>             
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
<div class="clear">
</div>
</div>
 
    
 <?php include 'inc/footer.php'; ?>
