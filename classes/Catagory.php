<?php   $filepath = realpath(dirname(__FILE__));    ?>

<?php include_once($filepath.'/../lib/Database.php');?>
<?php include_once($filepath.'/../helpers/format.php');?>
<?php
	/**
	* 
	*/
	class Catagory{
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
                $query = "INSERT INTO tbl_category (name) VALUES ('$name')";
                $catinsert = $this->db->insert($query);
            
                if ($catinsert){
                   $adcatmess = "<span class='success'>Category Insert successfully.</span>";
                   return $adcatmess;
                }else{
                    $adcatmess = "<span class='error'>Category not Insert</span>";
                    return $adcatmess;
                }
            }
		}

		public function getAllcatagory(){
			$query = "SELECT * FROM tbl_category ORDER BY id DESC";
			$Category = $this->db->select($query);
				return $Category;
		}


		public function deletecat($pageid){
			$pageid = mysqli_real_escape_string($this->db->link,$_GET['dalcat']);
			$dalcat = $pageid;
			$delquery = " DELETE FROM tbl_category WHERE id = '$dalcat' ";
			$deldata = $this->db->delete($delquery);
		    if ($deldata){
                   $delid =  "<span class='success'>Category Deleted successfully.</span>";
                   return $delid;
                }else{
                    $delid = "<span class='error'>Category not Deleted</span>";
                    return $delid;
                }
            }
		public function editcategory($name,$id){
			$name = mysqli_real_escape_string($this->db->link, $name);
                if(empty($name)){
                    $updatemss = "<span class='error'>Field Must not be empty</span>";
                    return $updatemss;
                }else{
                    $query = "UPDATE tbl_category SET name = '$name' WHERE id='$id' ";
                    $update_row = $this->db->update($query);
                
                    if ($update_row){
                       $updatemss = "<span class='success'>Category UPDATE successfully.</span>";
                       return $updatemss;
                    }else{
                        $updatemss = "<span class='error'>Category not UPDATE</span>";
                        return $updatemss;
                    }
                }
            }
        public function getonecatagory($id){
        	$query = "SELECT * FROM tbl_category WHERE id = '$id'";
			$Category = $this->db->select($query);
				return $Category;
        }


        

        




	}

?>

