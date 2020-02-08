<?php   $filepath = realpath(dirname(__FILE__));    ?>

<?php include_once($filepath.'/../lib/Database.php');?>
<?php include_once($filepath.'/../helpers/format.php');?>
<?php
    /**
    * 
    */
    class Product{
        public $db;
        public $fm;

        
        function __construct(){
            $this->db = new Database();
            $this->fm = new format();
        }
        public function insertProduct($productName,$catId,$brandId,$body,$price,
                $uploaded_image,$type){
            $productName = mysqli_real_escape_string($this->db->link,$productName);
            $catId = mysqli_real_escape_string($this->db->link,$catId);
            // $image = mysqli_real_escape_string($db->link,$_POST['image']);
            $brandId = mysqli_real_escape_string($this->db->link,$brandId);
            $body = mysqli_real_escape_string($this->db->link,$body);
            $price = mysqli_real_escape_string($this->db->link,$price);
            $uploaded_image =   $uploaded_image;
            $type = mysqli_real_escape_string($this->db->link,$type);

            $query = "INSERT INTO tbl_product(productName, catId , brandId, body , price ,image ,type ) 
            VALUES 
            ('$productName','$catId','$brandId', '$body','$price','$uploaded_image','$type') ";
            $addpost = $this->db->insert($query);
            if($addpost){
                $productmss = "<span style='color:green'>Data INSERT Successfully</span>";
                return $productmss;
            }else{
                $productmss = "<span style='color:red'>Data NOt Insert Successfully</span>";
                return $productmss;
            }
            
            
        }

        public function getAllproduct(){
                /* Alias er Beboher e
            $query = "SELECT p.*,c.name,b.brandname 
                FROM tbl_product as p,tbl_category as c,tbl_brand as b
                WHERE p.catId = c.id AND p.brandId = c.id 
                ORDER BY p.productId DESC
            ";*/


            $query = "SELECT tbl_product.*,tbl_category.name,tbl_brand.brandname FROM tbl_product
            INNER JOIN tbl_category ON 
            tbl_product.catId = tbl_category.id
            INNER JOIN tbl_brand ON
            tbl_product.brandId = tbl_brand.id
            ORDER BY tbl_product.productId DESC "; 
            $post = $this->db->select($query);
            return $post;
        }

        public function getproduct($viewproductid){
            $query = "SELECT * FROM tbl_product WHERE productId = '$viewproductid' ";
            $rewsew = $this->db->select($query);
            return $rewsew;
        }


        public function unlinkimage($delid){
            $query  = "SELECT * FROM tbl_product WHERE productId = '$delid'";
            $getData = $this->db->select($query);
            if ($getData) {
              while ($delimg = $getData->fetch_assoc()) {
                $dellink = $delimg['image'];
                return $dellink;
              }
            }
        }

        public function productDelete($delid){
            $delquery = "DELETE FROM tbl_product WHERE productId = '$delid'";
            $deldata = $this->db->delete($delquery);
            if ($deldata){
                $delmess = "<script>alert('Data Delete successfully.');</script>";
                return $delmess;
            }else{
                $delmess = "<script>alert('Data Delete Not successfully.');</script>";
                return $delmess;
            }
        }

        public function udateProduct($productName,$catId,$brandId,$body,$price,$type,
            $viewproductid){
            $productName = mysqli_real_escape_string($this->db->link,$productName);
            $catId = mysqli_real_escape_string($this->db->link,$catId);
            // $image = mysqli_real_escape_string($db->link,$_POST['image']);
            $brandId = mysqli_real_escape_string($this->db->link,$brandId);
            $body = mysqli_real_escape_string($this->db->link,$body);
            $price = mysqli_real_escape_string($this->db->link,$price);
            $type = mysqli_real_escape_string($this->db->link,$type);
            $viewproductid =   $viewproductid;

            $query = "UPDATE tbl_product SET 
                    productName = '$productName',
                    catId = '$catId',
                    brandId = '$brandId',
                    body = '$body',
                    price = '$price',
                    type = '$type'
                    WHERE productId ='$viewproductid' ";


            $updatepost = $this->db->update($query);
            if($updatepost){
                $updatemss = "<span style='color:green'>Data Update Successfully</span>";
                return $updatemss;
            }else{
                $updatemss = "<span style='color:red'>Data NOt Update Successfully</span>";
                return $updatemss;
            }
        }


        public function udateProducton($productName,$catId,$brandId,$body,$price,$type,$viewproductid,$uploaded_image){
            
            $productName = mysqli_real_escape_string($this->db->link,$productName);
            $catId = mysqli_real_escape_string($this->db->link,$catId);
            // $image = mysqli_real_escape_string($db->link,$_POST['image']);
            $brandId = mysqli_real_escape_string($this->db->link,$brandId);
            $body = mysqli_real_escape_string($this->db->link,$body);
            $price = mysqli_real_escape_string($this->db->link,$price);
            $type = mysqli_real_escape_string($this->db->link,$type);
            $viewproductid =   $viewproductid;
            $uploaded_image = $uploaded_image;

            $query = "UPDATE tbl_product SET 
                    productName = '$productName',
                    catId = '$catId',
                    brandId = '$brandId',
                    body = '$body',
                    price = '$price',
                    type = '$type',
                    image = '$uploaded_image'
                    WHERE productId ='$viewproductid' ";


            $updatepost = $this->db->update($query);
            if($updatepost){
                $updatemss = "<span style='color:green'>Data Update Successfully</span>";
                return $updatemss;
            }else{
            $updatemss = "<span style='color:red'>Data NOt Update Successfully</span>";
                return $updatemss;
            }
        }

        public function getfeatureProduct(){
            $query  = "SELECT * FROM tbl_product WHERE type = '1' ORDER BY productId DESC LIMIT 4";
            $result = $this->db->select($query);
            return $result;
        }

        public function getfeatureAll(){
            $query  = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT 4";
            $result = $this->db->select($query);
            return $result;
        }

        public function getOneShow($proid){
            $query  = "SELECT * FROM tbl_product WHERE productId = '$proid' ";
            $result = $this->db->select($query);
            return $result;
        }

        public function getONeproduct($proid){
            $query = "SELECT p.*,c.name,b.brandname 
                FROM tbl_product as p,tbl_category as c,tbl_brand as b
                WHERE p.catId = c.id AND p.brandId = b.id AND p.productId = '$proid'";
            $result = $this->db->select($query);
            return $result;
        }
        ///////////////

        public function getFirstProduct(){
            $query = "SELECT p.*,b.brandname 
                FROM tbl_product as p,tbl_brand as b
                WHERE p.brandId = '1' AND p.brandId = b.id LIMIT 1 ";
            $Category = $this->db->select($query);
                return $Category;
        }

        public function getSecondProduct(){
           $query = "SELECT p.*,b.brandname 
                FROM tbl_product as p,tbl_brand as b
                WHERE p.brandId = '2' AND p.brandId = b.id LIMIT 1 ";
            $Category = $this->db->select($query);
                return $Category;
        }

        public function getThirtProduct(){
            $query = "SELECT p.*,b.brandname 
                FROM tbl_product as p,tbl_brand as b
                WHERE p.brandId = '3' AND p.brandId = b.id LIMIT 1 ";
            $Category = $this->db->select($query);
                return $Category;
        }

        public function get4thProduct(){
            $query = "SELECT p.*,b.brandname 
                FROM tbl_product as p,tbl_brand as b
                WHERE p.brandId = '4' AND p.brandId = b.id LIMIT 1 ";
            $Category = $this->db->select($query);
                return $Category;
        }



        public function getCatPro($catid){
            $query  = "SELECT * FROM tbl_product WHERE catId = '$catid' ORDER BY productId DESC";
            $result = $this->db->select($query);
            return $result;
        }


        public function AdmingetCustomer($order){
            $query = "SELECT * FROM tbl_product WHERE productId = '$order'";
            $Category = $this->db->select($query);
                return $Category;
        }


        public function addCompare($compare){
            $query = "SELECT * FROM tbl_product WHERE productId = '$compare'";
            $Category = $this->db->select($query);
            while ($result = $Category->fetch_assoc()) {
                $productId      = $result['productId'];
                $productName    = $result['productName'];
                $price          = $result['price'];
                $image          = $result['image'];

               $query = "INSERT INTO tbl_compare(productId, productName , price, image) 
                VALUES 
                ('$productId','$productName','$price', '$image') ";
                $addpost = $this->db->insert($query);
                return $addpost;
            }
        }


        public function getallCompare(){
            $query = "SELECT * FROM tbl_compare ORDER BY id DESC'";
            $Category = $this->db->select($query);
            return $Category;  
        }



        public function getProductWithBrand($band){
            $query  = "SELECT * FROM tbl_product WHERE brandId = '$band' ORDER BY productId DESC LIMIT 4";
            $result = $this->db->select($query);
            return $result;
        }

        
        






    }

?>