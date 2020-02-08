<?php   $filepath = realpath(dirname(__FILE__));    ?>

<?php include_once($filepath.'/../lib/Database.php');?>
<?php include_once($filepath.'/../helpers/format.php');?>
<?php
    /**
    * 
    */
    class Compare{
        public $db;
        public $fm;

        
        function __construct(){
            $this->db = new Database();
            $this->fm = new format();
        }

        public function addCompare($compare,$customerId){
            $compare = mysqli_real_escape_string($this->db->link,$compare);


            $squery = "SELECT * FROM tbl_product WHERE productId = '$compare'";
            $result = $this->db->select($squery)->fetch_assoc();

            $productName = $result['productName'];
            $price = $result['price'];
            $image = $result['image'];


            
            $check = "SELECT * FROM tbl_compare WHERE productId ='$compare' 
            AND cmrId = '$customerId'";
            $checkquery = $this->db->select($check);
            if ($checkquery) {
                $message =  "This Product Already To Compare..";
                return $message;
            }else{
                $query = "INSERT INTO tbl_compare(cmrId,productId , productName, price ,image) VALUES 
                ('$customerId','$compare','$productName', '$price','$image') ";
                $addpost = $this->db->insert($query);
                if($addpost){
                    header('Location:compare.php');
                    }
            }
        }

        public function getallCompare($customerId){
            $query = "SELECT * FROM tbl_compare	WHERE cmrId = '$customerId' ORDER BY  id DESC";
            $Category = $this->db->select($query);
                return $Category;
        }


        public function dellallforId($customerId){
            $query = "DELETE FROM tbl_compare WHERE cmrId  = '$customerId'";
            $delc = $this->db->delete($query);
        }











}        