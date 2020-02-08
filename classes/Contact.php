<?php   $filepath = realpath(dirname(__FILE__));    ?>

<?php include_once($filepath.'/../lib/Database.php');?>
<?php include_once($filepath.'/../helpers/format.php');?>
<?php
    /**
    * 
    */
    class Contact{
        public $db;
        public $fm;

        
        function __construct(){
            $this->db = new Database();
            $this->fm = new format();
        }
        public function getallContact($data){
            $name       = mysqli_real_escape_string($this->db->link, $data['name']);
            $email = mysqli_real_escape_string($this->db->link, $data['email']);
            $mobile = mysqli_real_escape_string($this->db->link, $data['mobile']);
            $body = mysqli_real_escape_string($this->db->link, $data['body']);

            if ($name == "" || $email == "" || $mobile == "" || $body == "") {
                $productmss = "<span style='color:red'>Plz all field Must be fillup</span>";
                return $productmss;
            }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                $productmss = "<span style='color:red'>Plz enter Valid Email Address</span>";
                return $productmss;
            }else{
                $query = "INSERT INTO tbl_contact(name, email , mobile, body) 
                VALUES  ('$name','$email','$mobile', '$body')";
                $addpost = $this->db->insert($query);
                if($addpost){
                 $productmss = "<span style='color:green'>Your Messages Sent Successfully</span>";
                    return $productmss;
                }else{
         $productmss = "<span style='color:red'>Your Messages Not Sent(Something Wrong)</span>";
                    return $productmss;
                }
            }
            
            
        }

       public function getUnseenMsg(){
           $query = "SELECT * FROM tbl_contact WHERE status = '0' ORDER BY id DESC";
            $msg = $this->db->select($query);
            return $msg;
       }


       public function sendseenMsg($seenid){
            $seenid = mysqli_real_escape_string($this->db->link,$seenid);
            $query = "UPDATE tbl_contact SET status = '1' WHERE id='$seenid' ";
            $update_row = $this->db->update($query);
            
            if ($update_row){
               $msg = "<span class='success'>Message Send in the Seen box.</span>";
               return $msg;
            }else{
                $msg = "<span class='error'>Message did't Send in the Seen box.</span>";
                return $msg;
            }
            
       }

       public function getSeenMsg(){
           $query = "SELECT * FROM tbl_contact WHERE status = '1' ORDER BY id DESC";
            $msg = $this->db->select($query);
            return $msg;
       }



       public function delSeenMsg($delid){
            $delquery = "DELETE FROM tbl_contact WHERE id = '$delid'";
            $deldata = $this->db->delete($delquery);
            if ($deldata){
                    $msss  =  "<script>alert('Message Delete successfully.');</script>";
                    return $msss;
            }else{
                $msss = "<script>alert('Message Delete Not successfully.');</script>";
                return $msss;
            }
                
       }

       public function getSingleMsg($viewid){
            $query = "SELECT * FROM tbl_contact WHERE id = '$viewid'";
            $msg = $this->db->select($query);
            return $msg;
       }

        
        






    }

?>