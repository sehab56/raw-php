<?php   $filepath = realpath(dirname(__FILE__));    ?>

<?php include_once($filepath.'/../lib/Database.php');?>
<?php include_once($filepath.'/../helpers/format.php');?>
<?php
    /**
    *  
    */
    class WishList{
        public $db;
        public $fm;

        
        function __construct(){
            $this->db = new Database();
            $this->fm = new format();
        }

        public function addwishList($compare,$customerId){
            $compare = mysqli_real_escape_string($this->db->link,$compare);


            $squery = "SELECT * FROM tbl_product WHERE productId = '$compare'";
            $result = $this->db->select($squery)->fetch_assoc();

            $productName = $result['productName'];
            $price = $result['price'];
            $image = $result['image'];


            
            $check = "SELECT * FROM tbl_wishlist WHERE productId ='$compare' 
            AND cmrId = '$customerId'";
            $checkquery = $this->db->select($check);
            if ($checkquery) {
                $message =  "This Product Already To Compare..";
                return $message;
            }else{
                $query = "INSERT INTO tbl_wishlist(cmrId,productId , productName, price ,image) VALUES 
                ('$customerId','$compare','$productName', '$price','$image') ";
                $addpost = $this->db->insert($query);
                if($addpost){
                    header('Location:wishList.php');
                    }
            }
        }

        public function getallWish($customerId){
            $query = "SELECT * FROM tbl_wishlist	WHERE cmrId = '$customerId' ORDER BY  id DESC";
            $Category = $this->db->select($query);
                return $Category;
        }

        public function delsinglewish($delwish,$customerId){
            $query = "DELETE FROM tbl_wishlist WHERE productId = '$delwish' AND cmrId  = 
            '$customerId'";
            $delc = $this->db->delete($query);
            if ($delc) {
          $rss = "<span style='color:green'>You are Successfully Remove From Wish List</span>";
                return $rss;
            }
        }

        












}        