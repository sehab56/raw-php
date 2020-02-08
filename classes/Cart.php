<?php   $filepath = realpath(dirname(__FILE__));    ?>

<?php include_once($filepath.'/../lib/Database.php');?>
<?php include_once($filepath.'/../helpers/format.php');?>
<?php
    /**

    * 
    */
    class Cart{
        public $db;
        public $fm;

        
        function __construct(){
            $this->db = new Database();
            $this->fm = new format();
        }

        public function addtoCart($quantity,$proid){
            $quantity = mysqli_real_escape_string($this->db->link,$quantity);
            $proid = mysqli_real_escape_string($this->db->link,$proid);
            $sId = session_id();

            $quantity = $this->fm->validation( $quantity);

            $squery = "SELECT * FROM tbl_product WHERE productId = '$proid'";
            $result = $this->db->select($squery)->fetch_assoc();

            $productName = $result['productName'];
            $price = $result['price'];
            $image = $result['image'];


            
            $check = "SELECT * FROM tbl_cart WHERE productId ='$proid' AND sId = '$sId'";
            $checkquery = $this->db->select($check);
            if ($checkquery) {
                $message =  "This Product Already To Cart..";
                return $message;
            }else{
                $query = "INSERT INTO tbl_cart(sId, productId , productName, price , 
                quantity ,image) VALUES 
                ('$sId','$proid','$productName', '$price','$quantity','$image') ";
                $addpost = $this->db->insert($query);
                if($addpost){
                    header('Location:cart.php');
                    }else{
                 
                   header('Location:priview.php');
                }
            }
        }

        public function getallcat(){
            $sId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sId ='$sId' ORDER BY   cartId DESC";
            $Category = $this->db->select($query);
                return $Category;
        }

        public function delCart($delcart){
            $delquery = " DELETE FROM tbl_cart WHERE cartId = '$delcart' ";
            $deldata = $this->db->delete($delquery);
             $deldata =  "<span style='color:green'>Product Remove successfully.</span>";
                   return $deldata;
        }

        public function UpdateQuantity($quantity,$cartId){
            $update = "UPDATE tbl_cart SET quantity = '$quantity' 
            WHERE cartId = '$cartId'";
            $udateQuerey = $this->db->update($update);
            $udateQuerey =  "<span style='color:green'>Product Update successfully.</span>";
                   return $udateQuerey;
        }

        public function haveDate(){
            $sId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sId ='$sId'";
            $Category = $this->db->select($query);
                return $Category;
        }
        //////

        public function delCustomerCart(){
            $sId = session_id();
            $query = "DELETE FROM tbl_cart WHERE sId ='$sId'";
            $Category = $this->db->delete($query);
            
              
        }
        

        public function addAllorder($customerId){
            $sId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sId ='$sId'";
            $Category = $this->db->select($query);
            if ($Category) {
                while ($result = $Category->fetch_assoc()) {
                    $productId  = $result['productId'];
                $productName    = $result['productName'];
                    $quantity   = $result['quantity'];
                    $price      = $result['price'] * $quantity;
                    $image      = $result['image'];

                $query = "INSERT INTO tbl_order(cmrId, productId , productName, price , 
                quantity ,image) VALUES 
                ('$customerId','$productId','$productName', '$price','$quantity','$image') ";
                $addpost = $this->db->insert($query);

                }
            }
        }


        public function getCheck(){
            $sId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sId ='$sId'";
            $Category = $this->db->select($query);
            return $Category;
        }


        public function vatandAmount($customerId){
            $query = "SELECT price FROM tbl_order WHERE cmrId ='$customerId' ";
            $Category = $this->db->select($query);
            return $Category;
        }

        public function getallOrder($customerId){
            $query = "SELECT * FROM tbl_order WHERE cmrId ='$customerId' ORDER BY   id DESC";
            $Category = $this->db->select($query);
                return $Category;
        }

        public function delOrder($delcart){
            $delquery = " DELETE FROM tbl_order WHERE id = '$delcart' ";
            $deldata = $this->db->delete($delquery);
                   return $deldata;
        }


        public function AdmingetallOrder(){
            $query = "SELECT * FROM tbl_order ORDER BY id DESC";
            $Category = $this->db->select($query);
                return $Category;
        }


        public function productShifted($cmrId,$productId,$date){
            $cmrId      = mysqli_real_escape_string($this->db->link,$cmrId);
            $productId  = mysqli_real_escape_string($this->db->link,$productId);
            $date       = mysqli_real_escape_string($this->db->link,$date);

            $update = "UPDATE tbl_order SET status = '1' 
         WHERE cmrId = '$cmrId' AND productId = '$productId' AND date = '$date'";
            $udateQuerey = $this->db->update($update);
            $dafsdQuerey =  "<span style='color:green'>This Product is Siffed.</span>";
                   return $dafsdQuerey;
        }

        public function productRemoveing($cmrId,$productId,$date){
            $cmrId      = mysqli_real_escape_string($this->db->link,$cmrId);
            $productId  = mysqli_real_escape_string($this->db->link,$productId);
            $date       = mysqli_real_escape_string($this->db->link,$date);

            $update = "UPDATE tbl_order SET status = '2' 
         WHERE cmrId = '$cmrId' AND productId = '$productId' AND date = '$date'";
            $udateQuerey = $this->db->update($update);
   $dafsdQuerey =  "<span style='color:green'>This Product is Delivery successfully.</span>";
                   return $dafsdQuerey;
        }


        public function productDelete($cmrId,$productId,$date){
            $cmrId      = mysqli_real_escape_string($this->db->link,$cmrId);
            $productId  = mysqli_real_escape_string($this->db->link,$productId);
            $date       = mysqli_real_escape_string($this->db->link,$date);

            $update = "DELETE FROM tbl_order
         WHERE cmrId = '$cmrId' AND productId = '$productId' AND date = '$date'";
            $udateQuerey = $this->db->update($update);
   $dafsdQuerey =  "<span style='color:green'>This Product is Remove for this list.</span>";
                   return $dafsdQuerey;
        }
        


        public function Ordersuces($deleveredId){
            $update = "UPDATE tbl_order SET status = '2' 
         WHERE id = '$deleveredId'";
            $udateQuerey = $this->db->update($update);
   $dafsdQuerey =  "<span style='color:green'>This Product is Delivery successfully.</span>";
                   return $dafsdQuerey;
        }


}


?>