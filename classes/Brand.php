<?php   $filepath = realpath(dirname(__FILE__));    ?>

<?php include_once($filepath.'/../lib/Database.php');?>
<?php include_once($filepath.'/../helpers/format.php');?>
<?php
    /**
    * 
    */
    class Brand{
        public $db;
        public $fm;

        
        function __construct(){
            $this->db = new Database();
            $this->fm = new format();
        }
        public function adcatagory($name){
            $name = mysqli_real_escape_string($this->db->link,$name);
            $name = $this->fm->validation( $name);
            
            if(empty($name)){
                $adcatmess = "<span class='error'>Field Must not be empty</span>";
                return $adcatmess;
            }else{
                $query = "INSERT INTO tbl_brand (brandname) VALUES ('$name')";
                $catinsert = $this->db->insert($query);
            
                if ($catinsert){
                   $adcatmess = "<span class='success'>Brand Insert successfully.</span>";
                   return $adcatmess;
                }else{
                    $adcatmess = "<span class='error'>Brand not Insert</span>";
                    return $adcatmess;
                }
            }
        }

        public function getAllcatagory(){
            $query = "SELECT * FROM tbl_brand ORDER BY id DESC";
            $Category = $this->db->select($query);
                return $Category;
        }


        public function deletecat($pageid){
            $pageid = mysqli_real_escape_string($this->db->link,$_GET['dalcat']);
            $dalcat = $pageid;
            $delquery = " DELETE FROM tbl_brand WHERE id = '$dalcat' ";
            $deldata = $this->db->delete($delquery);
            if ($deldata){
                   $delid =  "<span class='success'>Brand Deleted successfully.</span>";
                   return $delid;
                }else{
                    $delid = "<span class='error'>Brand not Deleted</span>";
                    return $delid;
                }
            }
        public function editcategory($name,$id){
            $name = mysqli_real_escape_string($this->db->link, $name);
                if(empty($name)){
                    $updatemss = "<span class='error'>Field Must not be empty</span>";
                    return $updatemss;
                }else{
                    $query = "UPDATE tbl_brand SET brandname = '$name' WHERE id='$id' ";
                    $update_row = $this->db->update($query);
                
                    if ($update_row){
                       $updatemss = "<span class='success'>Brand UPDATE successfully.</span>";
                       return $updatemss;
                    }else{
                        $updatemss = "<span class='error'>Brand not UPDATE</span>";
                        return $updatemss;
                    }
                }
            }
        public function getonecatagory($id){
            $query = "SELECT * FROM tbl_brand WHERE id = '$id'";
            $Category = $this->db->select($query);
                return $Category;
        }





    }

?>

